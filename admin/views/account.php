<?php
$title    = 'Account';
$subtitle = 'Update your admin password. Use a strong, unique password.';
require __DIR__ . '/partials/page-header.php';
?>

<div class="editor-layout" style="grid-template-columns:minmax(340px,480px) 1fr">
    <section class="panel">
        <div class="panel__head">
            <h2><i class="fa-solid fa-key"></i> Change password</h2>
        </div>

        <form method="post" action="<?= e(admin_url('account')); ?>" class="form-grid">
            <input type="hidden" name="_csrf" value="<?= e(csrf_token()); ?>">

            <div class="field">
                <label>Current password</label>
                <input type="password" name="current_password" required autocomplete="current-password">
            </div>
            <div class="field">
                <label>New password</label>
                <input type="password" name="new_password" minlength="8" required autocomplete="new-password">
                <span class="field-hint">Minimum 8 characters</span>
            </div>
            <div class="field">
                <label>Confirm new password</label>
                <input type="password" name="confirm_password" minlength="8" required autocomplete="new-password">
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn--primary">
                    <i class="fa-solid fa-shield-halved"></i> Update password
                </button>
            </div>
        </form>
    </section>

    <section class="panel">
        <div class="panel__head">
            <h2>Security notes</h2>
        </div>
        <div class="preview-contact">
            <span><i class="fa-solid fa-link"></i> Admin URL: <code><?= e(admin_url()); ?></code></span>
            <span><i class="fa-solid fa-user-shield"></i> Signed in as <strong><?= e($user['username'] ?? 'admin'); ?></strong></span>
            <span><i class="fa-solid fa-eye-slash"></i> This panel is hidden from search engines</span>
            <span><i class="fa-solid fa-lock"></i> Change the default password if you haven't already</span>
        </div>
    </section>
</div>
