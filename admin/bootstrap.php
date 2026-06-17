<?php

declare(strict_types=1);

require_once __DIR__ . '/../config/env.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/helpers.php';

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

function admin_logged_in(): bool
{
    return !empty($_SESSION['admin_id']);
}

function admin_require_auth(): void
{
    if (!admin_logged_in()) {
        header('Location: ' . admin_url('login'));
        exit;
    }
}

function admin_user(): ?array
{
    global $pdo;

    if (!admin_logged_in()) {
        return null;
    }

    static $user = null;

    if ($user === null) {
        $stmt = $pdo->prepare('SELECT id, username FROM admin_users WHERE id = ? LIMIT 1');
        $stmt->execute([(int) $_SESSION['admin_id']]);
        $user = $stmt->fetch() ?: null;
    }

    return $user;
}

function admin_subpath(): string
{
    $path = $_SERVER['ADMIN_SUBPATH'] ?? '/';

    return '/' . trim($path, '/');
}

function admin_redirect(string $subpath, ?string $flashType = null, ?string $flashMsg = null): never
{
    if ($flashType && $flashMsg) {
        flash_set($flashType, $flashMsg);
    }

    header('Location: ' . admin_url($subpath));
    exit;
}

function admin_verify_post(): void
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        exit('Method not allowed.');
    }

    if (!csrf_verify($_POST['_csrf'] ?? null)) {
        http_response_code(419);
        exit('Invalid CSRF token. Refresh and try again.');
    }
}

/** @return list<string> */
function admin_setting_keys(string $group): array
{
    global $pdo;

    $stmt = $pdo->prepare(
        'SELECT setting_key FROM settings WHERE setting_group = ? ORDER BY setting_key ASC'
    );
    $stmt->execute([$group]);

    return array_column($stmt->fetchAll(), 'setting_key');
}

function admin_save_settings(array $keys): void
{
    global $pdo;

    $stmt = $pdo->prepare(
        'INSERT INTO settings (setting_key, setting_value, setting_group)
         VALUES (?, ?, ?)
         ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value), setting_group = VALUES(setting_group)'
    );

    foreach ($keys as $key => $meta) {
        $value = trim((string) ($_POST[$key] ?? ''));
        $group = $meta['group'];
        $stmt->execute([$key, $value, $group]);
    }
}

function admin_render(string $view, array $data = []): void
{
    extract($data, EXTR_SKIP);
    $flash       = flash_get();
    $user        = admin_user();
    $currentPath = admin_subpath();
    require __DIR__ . '/views/layout.php';
}

function admin_nav_is(string $segment): bool
{
    $path = admin_subpath();

    if ($segment === '' || $segment === 'dashboard') {
        return $path === '/' || $path === '/dashboard';
    }

    return $path === '/' . $segment || str_starts_with($path, '/' . $segment . '/');
}

function admin_nav_class(string $segment): string
{
    return admin_nav_is($segment) ? ' active' : '';
}

function asset_url(string $path): string
{
    return '/' . ltrim($path, '/');
}

function admin_excerpt(?string $text, int $length = 140): string
{
    $text = trim((string) $text);

    if ($text === '') {
        return '';
    }

    if (mb_strlen($text) <= $length) {
        return $text;
    }

    return mb_strimwidth($text, 0, $length, '…');
}
