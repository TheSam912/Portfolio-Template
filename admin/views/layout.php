<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>Portfolio Admin</title>
    <link rel="stylesheet" href="/assets/css/admin.css">
</head>
<body class="<?= admin_logged_in() ? 'admin-app' : 'admin-login' ?>">

<?php if ($flash): ?>
    <div class="flash flash-<?= e($flash['type']); ?>"><?= e($flash['message']); ?></div>
<?php endif; ?>

<?php if (admin_logged_in() && ($view ?? '') !== 'login'): ?>
    <aside class="sidebar">
        <div class="brand">Portfolio CMS</div>
        <nav>
            <a href="<?= e(admin_url()); ?>">Dashboard</a>
            <a href="<?= e(admin_url('settings')); ?>">Site Settings</a>
            <a href="<?= e(admin_url('stats')); ?>">Stats</a>
            <a href="<?= e(admin_url('services')); ?>">Services</a>
            <a href="<?= e(admin_url('skills')); ?>">Skills</a>
            <a href="<?= e(admin_url('experiences')); ?>">Experience</a>
            <a href="<?= e(admin_url('projects')); ?>">Projects</a>
            <a href="<?= e(admin_url('messages')); ?>">Messages</a>
            <a href="<?= e(admin_url('account')); ?>">Account</a>
            <a href="/" target="_blank" rel="noopener">View Site ↗</a>
            <a href="<?= e(admin_url('logout')); ?>">Logout</a>
        </nav>
        <p class="admin-user">Signed in as <?= e($user['username'] ?? 'admin'); ?></p>
    </aside>
    <main class="content">
        <?php require __DIR__ . '/' . $view . '.php'; ?>
    </main>
<?php else: ?>
    <?php require __DIR__ . '/' . ($view ?? 'login') . '.php'; ?>
<?php endif; ?>

</body>
</html>
