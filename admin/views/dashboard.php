<h1>Dashboard</h1>
<p class="muted">Manage every piece of content on your portfolio from here.</p>

<div class="cards">
    <div class="card"><strong><?= (int) $counts['messages']; ?></strong><span>Messages</span></div>
    <div class="card"><strong><?= (int) $counts['projects']; ?></strong><span>Projects</span></div>
    <div class="card"><strong><?= (int) $counts['skills']; ?></strong><span>Skills</span></div>
    <div class="card"><strong><?= (int) $counts['services']; ?></strong><span>Services</span></div>
</div>

<div class="panel">
    <h2>Admin URL</h2>
    <p>Your panel is at: <code><?= e(admin_url()); ?></code></p>
    <p class="muted">Change <code>ADMIN_PATH</code> in your <code>.env</code> to something only you know, then restart the server.</p>
</div>
