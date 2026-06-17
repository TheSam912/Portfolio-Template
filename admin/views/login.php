<div class="login-shell">
    <div class="login-brand">
        <h1>Portfolio CMS</h1>
        <p>Manage your profile, skills, experience, and projects. Keep this URL private.</p>
    </div>

    <div class="login-card">
        <h2>Sign in</h2>
        <p class="muted" style="margin:0 0 24px">Hidden admin panel</p>

        <form method="post" action="<?= e(admin_url('login')); ?>" class="form-grid">
            <input type="hidden" name="_csrf" value="<?= e(csrf_token()); ?>">

            <div class="field">
                <label for="username">Username</label>
                <input id="username" type="text" name="username" required autocomplete="username">
            </div>

            <div class="field">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required autocomplete="current-password">
            </div>

            <button type="submit" class="btn btn--primary">
                <i class="fa-solid fa-right-to-bracket"></i> Sign in
            </button>
        </form>
    </div>
</div>
