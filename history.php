<?php
require __DIR__ . '/../config.php';
header('Content-Type: application/json; charset=utf-8');

$session = preg_replace('/[^a-zA-Z0-9_-]/', '', (string)($_GET['session_id'] ?? ''));
$st = db()->prepare('SELECT question, answer FROM chat_history WHERE session_id = ? ORDER BY id DESC LIMIT 20');
$st->execute([$session]);
echo json_encode(array_reverse($st->fetchAll()), JSON_UNESCAPED_UNICODE);
