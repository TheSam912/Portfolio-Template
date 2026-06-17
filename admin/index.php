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
        require_once __DIR__ . '/../config/repository.php';
        global $pdo;
        $repo = new ContentRepository($pdo);
        $counts = [
            'messages'    => (int) $pdo->query('SELECT COUNT(*) FROM messages')->fetchColumn(),
            'projects'    => (int) $pdo->query('SELECT COUNT(*) FROM projects')->fetchColumn(),
            'skills'      => (int) $pdo->query('SELECT COUNT(*) FROM skills')->fetchColumn(),
            'experiences' => (int) $pdo->query('SELECT COUNT(*) FROM experiences')->fetchColumn(),
        ];
        $profile  = $repo->getProfile();
        $skills   = $pdo->query('SELECT * FROM skills ORDER BY sort_order ASC, id ASC LIMIT 8')->fetchAll();
        $projects = $pdo->query('SELECT * FROM projects ORDER BY sort_order ASC, id ASC LIMIT 4')->fetchAll();
        $latestMessage = $pdo->query('SELECT * FROM messages ORDER BY created_at DESC LIMIT 1')->fetch() ?: null;
        admin_render('dashboard', compact('counts', 'profile', 'skills', 'projects', 'latestMessage'));
    })(),

    $path === '/profile' || $path === '/settings' => (function () {
        admin_require_auth();
        require_once __DIR__ . '/../config/repository.php';
        global $pdo;
        $profile = (new ContentRepository($pdo))->getProfile();
        admin_render('profile', compact('profile'));
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
        $allBullets = [];
        if ($edit) {
            $stmt = $pdo->prepare('SELECT content FROM experience_bullets WHERE experience_id = ? ORDER BY sort_order ASC, id ASC');
            $stmt->execute([$edit]);
            $bullets = array_column($stmt->fetchAll(), 'content');
        }
        $stmt = $pdo->query('SELECT experience_id, content FROM experience_bullets ORDER BY sort_order ASC, id ASC');
        foreach ($stmt->fetchAll() as $row) {
            $allBullets[(int) $row['experience_id']][] = $row['content'];
        }
        admin_render('experiences', compact('items', 'edit', 'bullets', 'allBullets'));
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
