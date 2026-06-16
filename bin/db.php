<?php

/**
 * Cross-platform DB management script.
 *
 *   php bin/db.php schema   - apply db/schema.sql
 *   php bin/db.php seed     - apply db/seed.sql
 *   php bin/db.php reset    - schema + seed
 *   php bin/db.php fresh    - DROP DATABASE, then schema + seed (destructive)
 *
 * Reads connection details from .env. Works on macOS, Linux and Windows
 * because it uses PDO directly (no shell pipes, no `mysql` CLI).
 */

declare(strict_types=1);

require_once __DIR__ . '/../config/env.php';

$action = $argv[1] ?? '';

$valid = ['schema', 'seed', 'reset', 'fresh'];

if (!in_array($action, $valid, true)) {
    fwrite(STDERR, "Usage: php bin/db.php <" . implode('|', $valid) . ">\n");
    exit(1);
}

$root      = dirname(__DIR__);
$host      = env('DB_HOST', 'localhost');
$port      = (int) env('DB_PORT', 3306);
$dbname    = env('DB_NAME', 'portfolio_db');
$username  = env('DB_USER', 'root');
$password  = env('DB_PASS', '');
$charset   = env('DB_CHARSET', 'utf8mb4');

$serverDsn = "mysql:host={$host};port={$port};charset={$charset}";
$options   = [
    PDO::ATTR_ERRMODE         => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_MULTI_STATEMENTS => true,
];

function info(string $msg): void
{
    echo "  · {$msg}\n";
}

function ok(string $msg): void
{
    echo "  \u{2713} {$msg}\n";
}

function fail(string $msg): never
{
    fwrite(STDERR, "  \u{2717} {$msg}\n");
    exit(1);
}

function run_sql_file(PDO $pdo, string $path): void
{
    if (!is_readable($path)) {
        fail("SQL file not found: {$path}");
    }

    $sql = file_get_contents($path);

    if ($sql === false || trim($sql) === '') {
        fail("SQL file is empty: {$path}");
    }

    $pdo->exec($sql);
}

try {

    $serverPdo = new PDO($serverDsn, $username, $password, $options);

} catch (PDOException $e) {
    fail("Cannot connect to MySQL at {$host}:{$port} as {$username} — " . $e->getMessage());
}

if ($action === 'fresh') {
    info("Dropping database `{$dbname}`...");
    $serverPdo->exec("DROP DATABASE IF EXISTS `{$dbname}`");
    ok("dropped");
}

if (in_array($action, ['schema', 'reset', 'fresh'], true)) {
    info("Applying db/schema.sql...");
    run_sql_file($serverPdo, "{$root}/db/schema.sql");
    ok("schema applied");
}

if (in_array($action, ['seed', 'reset', 'fresh'], true)) {
    info("Applying db/seed.sql...");
    run_sql_file($serverPdo, "{$root}/db/seed.sql");
    ok("seed applied");
}

ok("done.");
