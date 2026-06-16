<div class="login-card">
    <h1>Portfolio CMS</h1>
    <p class="muted">Hidden admin panel — keep this URL private.</p>

    <form method="post" action="<?= e(admin_url('login')); ?>">
        <input type="hidden" name="_csrf" value="<?= e(csrf_token()); ?>">

        <label>
            Username
            <input type="text" name="username" required autocomplete="username">
        </label>

        <label>
            Password
            <input type="password" name="password" required autocomplete="current-password">
        </label>

        <button type="submit">Sign in</button>
    </form>
</div>
