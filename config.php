<?php
// ===== CẤU HÌNH =====
const DB_HOST = 'localhost';
const DB_NAME = 'ai_widget';
const DB_USER = 'root';
const DB_PASS = '';            // WampServer mặc định rỗng

const GEMINI_API_KEY = '';
const GEMINI_MODEL   = 'gemini-flash-lite-latest';
define('GEMINI_MODEL', 'gemini-flash-lite-latest
');

// WampServer thường thiếu CA bundle -> lỗi SSL. Chỉ đặt false khi chạy local.
const CURL_VERIFY_SSL = false;

function db(): PDO {
    static $pdo = null;
    if ($pdo === null) {
        $pdo = new PDO(
            'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4',
            DB_USER, DB_PASS,
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
             PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
        );
    }
    return $pdo;
}
