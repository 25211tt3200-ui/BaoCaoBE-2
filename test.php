<?php
require __DIR__ . '/config.php';
header('Content-Type: text/plain; charset=utf-8');

$ch = curl_init('https://generativelanguage.googleapis.com/v1beta/models?pageSize=100');
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 20,
    CURLOPT_SSL_VERIFYPEER => CURL_VERIFY_SSL,
    CURLOPT_HTTPHEADER => ['x-goog-api-key: ' . GEMINI_API_KEY],
]);
$res = curl_exec($ch);
echo "HTTP " . curl_getinfo($ch, CURLINFO_HTTP_CODE) . " | cURL: " . curl_error($ch) . "\n\n";
foreach (json_decode((string)$res, true)['models'] ?? [] as $m) {
    if (in_array('generateContent', $m['supportedGenerationMethods'] ?? [])) {
        echo str_replace('models/', '', $m['name']) . "\n";
    }
}