<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>Portfolio Admin<?= !empty($title) ? ' — ' . e($title) : ''; ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="/assets/css/admin.css">
</head>
<body class="<?= admin_logged_in() ? 'admin-app' : 'admin-login' ?>">

<?php if ($flash): ?>
    <div class="flash flash-<?= e($flash['type']); ?>"><?= e($flash['message']); ?></div>
<?php endif; ?>

<?php if (admin_logged_in() && ($view ?? '') !== 'login'): ?>
    <aside class="sidebar">
        <div class="brand">
            <div class="brand__icon"><i class="fa-solid fa-layer-group"></i></div>
            <div class="brand__text">
                <strong>Portfolio CMS</strong>
                <span>Sam Nolan</span>
            </div>
        </div>

        <nav>
            <span class="nav-label">Overview</span>
            <a href="<?= e(admin_url()); ?>" class="<?= admin_nav_class('dashboard'); ?>">
                <i class="fa-solid fa-gauge-high"></i> Dashboard
            </a>

            <span class="nav-label">Content</span>
            <a href="<?= e(admin_url('profile')); ?>" class="<?= admin_nav_class('profile'); ?>">
                <i class="fa-solid fa-user-pen"></i> Profile & Contact
            </a>
            <a href="<?= e(admin_url('skills')); ?>" class="<?= admin_nav_class('skills'); ?>">
                <i class="fa-solid fa-code"></i> Skills
            </a>
            <a href="<?= e(admin_url('experiences')); ?>" class="<?= admin_nav_class('experiences'); ?>">
                <i class="fa-solid fa-briefcase"></i> Experience
            </a>
            <a href="<?= e(admin_url('projects')); ?>" class="<?= admin_nav_class('projects'); ?>">
                <i class="fa-solid fa-folder-open"></i> Projects
            </a>

            <span class="nav-label">Inbox</span>
            <a href="<?= e(admin_url('messages')); ?>" class="<?= admin_nav_class('messages'); ?>">
                <i class="fa-solid fa-inbox"></i> Messages
            </a>

            <span class="nav-label">System</span>
            <a href="<?= e(admin_url('account')); ?>" class="<?= admin_nav_class('account'); ?>">
                <i class="fa-solid fa-shield-halved"></i> Account
            </a>
            <a href="/" target="_blank" rel="noopener" class="nav-external">
                <i class="fa-solid fa-arrow-up-right-from-square"></i> View live site
            </a>
            <a href="<?= e(admin_url('logout')); ?>">
                <i class="fa-solid fa-right-from-bracket"></i> Logout
            </a>
        </nav>

        <div class="sidebar-footer">
            <p class="admin-user">Signed in as <strong><?= e($user['username'] ?? 'admin'); ?></strong></p>
            <p class="admin-url"><?= e(admin_url()); ?></p>
        </div>
    </aside>

    <main class="content">
        <?php require __DIR__ . '/' . $view . '.php'; ?>
    </main>
<?php else: ?>
    <?php require __DIR__ . '/' . ($view ?? 'login') . '.php'; ?>
<?php endif; ?>

<script src="/assets/js/admin.js" defer></script>
</body>
</html>
