<?php
declare(strict_types=1);

ini_set('display_errors', '0');
ini_set('html_errors', '0');
error_reporting(E_ALL);

require __DIR__ . '/config.php';

header('Content-Type: application/json; charset=utf-8');

function out(array $data, int $code = 200): never {
    http_response_code($code);
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') out(['error' => 'Method not allowed'], 405);

$input    = json_decode(file_get_contents('php://input'), true) ?: [];
$question = trim((string)($input['question'] ?? ''));
$session  = preg_replace('/[^a-zA-Z0-9_-]/', '', (string)($input['session_id'] ?? 'guest'));

if ($question === '' || mb_strlen($question) > 500) out(['error' => 'Câu hỏi không hợp lệ (1-500 ký tự).'], 400);

try {
    // 1. Tìm dữ liệu nội bộ liên quan (chấm điểm theo số từ khóa khớp)
    $words = array_unique(array_filter(
        preg_split('/\s+/u', mb_strtolower($question)),
        fn($w) => mb_strlen($w) >= 2
    ));
    $words = array_slice($words, 0, 8);

    $docs = [];
    if ($words) {
        $scoreParts = []; $params = [];
        foreach ($words as $i => $w) {
            $scoreParts[] = "(title LIKE :t$i) * 2 + (content LIKE :c$i)";
            $params[":t$i"] = $params[":c$i"] = '%' . addcslashes($w, '%_\\') . '%';
        }
        $sql = 'SELECT id, title, content, (' . implode(' + ', $scoreParts) . ') AS score
                FROM knowledge_base HAVING score > 0 ORDER BY score DESC LIMIT 4';
        $st = db()->prepare($sql);
        $st->execute($params);
        $docs = $st->fetchAll();
    }

    // 2. Dựng prompt (RAG): chỉ trả lời dựa trên dữ liệu nội bộ
    if ($docs) {
        $context = '';
        foreach ($docs as $d) $context .= "[#{$d['id']}] {$d['title']}\n{$d['content']}\n\n";
        $prompt = "Bạn là trợ lý nội bộ của công ty. Chỉ trả lời dựa trên TÀI LIỆU bên dưới, "
                . "ngắn gọn, bằng tiếng Việt. Nếu tài liệu không đủ thông tin, hãy nói bạn không tìm thấy.\n\n"
                . "TÀI LIỆU:\n$context\nCÂU HỎI: $question";
    } else {
        $answer = 'Mình không tìm thấy thông tin nội bộ nào liên quan đến câu hỏi này.';
    }

    // 3. Gọi Gemini
    if ($docs) {
        $payload = json_encode([
            'contents' => [['parts' => [['text' => $prompt]]]],
            'generationConfig' => ['temperature' => 0.2],
        ], JSON_UNESCAPED_UNICODE);

        $ch = curl_init('https://generativelanguage.googleapis.com/v1beta/models/' . GEMINI_MODEL . ':generateContent');
        curl_setopt_array($ch, [
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => $payload,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT        => 60, 
            CURLOPT_SSL_VERIFYPEER => CURL_VERIFY_SSL,
            CURLOPT_HTTPHEADER     => ['Content-Type: application/json', 'x-goog-api-key: ' . GEMINI_API_KEY],
        ]);
        $res  = curl_exec($ch);
        $err  = curl_error($ch);
        $http = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($res === false) out(['error' => 'Không gọi được Gemini: ' . $err], 502);
        $json = json_decode($res, true);
        if ($http !== 200) out(['error' => $json['error']['message'] ?? 'Gemini trả lỗi'], 502);
        $answer = $json['candidates'][0]['content']['parts'][0]['text'] ?? 'Không có phản hồi.';
    }

    // 4. Lưu câu hỏi + câu trả lời
    $sources = implode(',', array_column($docs, 'id'));
    db()->prepare('INSERT INTO chat_history (session_id, question, answer, sources) VALUES (?,?,?,?)')
        ->execute([$session, $question, $answer, $sources]);

    out([
        'answer'  => $answer,
        'sources' => array_map(fn($d) => ['id' => $d['id'], 'title' => $d['title']], $docs),
    ]);
} catch (Throwable $e) {
    error_log($e->getMessage());
    out(['error' => 'Lỗi máy chủ.'], 500);
}
