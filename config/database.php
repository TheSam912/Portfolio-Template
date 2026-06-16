<?php

require_once __DIR__ . '/env.php';
require_once __DIR__ . '/helpers.php';

$host    = env('DB_HOST', 'localhost');
$port    = (int) env('DB_PORT', 3306);
$dbname  = env('DB_NAME', 'portfolio_db');
$username = env('DB_USER', 'root');
$password = env('DB_PASS', '');
$charset  = env('DB_CHARSET', 'utf8mb4');

$dsn = "mysql:host={$host};port={$port};dbname={$dbname};charset={$charset}";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {

    error_log('[DB] Connection failed: ' . $e->getMessage());

    http_response_code(503);

    if (is_debug()) {
        die('Connection Failed: ' . $e->getMessage());
    }

    die('Service temporarily unavailable. Please try again shortly.');
}
