<?php

declare(strict_types=1);

require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/actions.php';

$method = $_SERVER['REQUEST_METHOD'];
$path   = admin_subpath();

if ($method === 'POST') {
    admin_handle_post($path);
}

match (true) {
    $path === '/login' => admin_render('login'),

    $path === '/logout' => (function () {
        session_destroy();
        admin_redirect('login', 'success', 'Logged out.');
    })(),

    $path === '/' || $path === '/dashboard' => (function () {
        admin_require_auth();
        global $pdo;
        $counts = [
            'messages'   => (int) $pdo->query('SELECT COUNT(*) FROM messages')->fetchColumn(),
            'projects'   => (int) $pdo->query('SELECT COUNT(*) FROM projects')->fetchColumn(),
            'skills'     => (int) $pdo->query('SELECT COUNT(*) FROM skills')->fetchColumn(),
            'services'   => (int) $pdo->query('SELECT COUNT(*) FROM services')->fetchColumn(),
        ];
        admin_render('dashboard', compact('counts'));
    })(),

    $path === '/settings' => (function () {
        admin_require_auth();
        global $pdo;
        $rows = $pdo->query('SELECT setting_key, setting_value, setting_group FROM settings ORDER BY setting_group, setting_key')->fetchAll();
        admin_render('settings', ['rows' => $rows]);
    })(),

    $path === '/stats' => (function () {
        admin_require_auth();
        global $pdo;
        $items = $pdo->query('SELECT * FROM stats ORDER BY sort_order ASC, id ASC')->fetchAll();
        $edit  = isset($_GET['edit']) ? (int) $_GET['edit'] : null;
        admin_render('stats', compact('items', 'edit'));
    })(),

    $path === '/services' => (function () {
        admin_require_auth();
        global $pdo;
        $items = $pdo->query('SELECT * FROM services ORDER BY sort_order ASC, id ASC')->fetchAll();
        $edit  = isset($_GET['edit']) ? (int) $_GET['edit'] : null;
        admin_render('services', compact('items', 'edit'));
    })(),

    $path === '/skills' => (function () {
        admin_require_auth();
        global $pdo;
        $items = $pdo->query('SELECT * FROM skills ORDER BY sort_order ASC, id ASC')->fetchAll();
        $edit  = isset($_GET['edit']) ? (int) $_GET['edit'] : null;
        admin_render('skills', compact('items', 'edit'));
    })(),

    $path === '/experiences' => (function () {
        admin_require_auth();
        global $pdo;
        $items = $pdo->query('SELECT * FROM experiences ORDER BY sort_order ASC, id ASC')->fetchAll();
        $edit  = isset($_GET['edit']) ? (int) $_GET['edit'] : null;
        $bullets = [];
        if ($edit) {
            $stmt = $pdo->prepare('SELECT content FROM experience_bullets WHERE experience_id = ? ORDER BY sort_order ASC, id ASC');
            $stmt->execute([$edit]);
            $bullets = array_column($stmt->fetchAll(), 'content');
        }
        admin_render('experiences', compact('items', 'edit', 'bullets'));
    })(),

    $path === '/projects' => (function () {
        admin_require_auth();
        global $pdo;
        $items = $pdo->query('SELECT * FROM projects ORDER BY sort_order ASC, id ASC')->fetchAll();
        $edit  = isset($_GET['edit']) ? (int) $_GET['edit'] : null;
        admin_render('projects', compact('items', 'edit'));
    })(),

    $path === '/messages' => (function () {
        admin_require_auth();
        global $pdo;
        $items = $pdo->query('SELECT * FROM messages ORDER BY created_at DESC LIMIT 100')->fetchAll();
        admin_render('messages', compact('items'));
    })(),

    $path === '/account' => (function () {
        admin_require_auth();
        admin_render('account');
    })(),

    default => (function () use ($path) {
        if (admin_logged_in()) {
            http_response_code(404);
            admin_render('404', ['path' => $path]);
        } else {
            admin_redirect('login');
        }
    })(),
};
