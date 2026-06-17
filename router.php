<?php

/**
 * Dev-server router.
 * Routes the hidden admin panel + serves static files + falls back to index.php.
 *
 * Usage:  php -S localhost:8000 router.php
 *         composer dev
 */

declare(strict_types=1);

require_once __DIR__ . '/config/env.php';

$uri  = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
$path = __DIR__ . rawurldecode($uri);

$adminPath = '/' . trim((string) env('ADMIN_PATH', 'samadminpanel'), '/');

if ($uri === $adminPath || str_starts_with($uri, $adminPath . '/')) {
    $_SERVER['ADMIN_SUBPATH'] = substr($uri, strlen($adminPath)) ?: '/';
    require __DIR__ . '/admin/index.php';
    return true;
}

// Serve existing static files (css, js, images, pdf…)
if ($uri !== '/' && is_file($path)) {
    return false;
}

require __DIR__ . '/index.php';
return true;