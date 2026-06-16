<h1>Account</h1>
<div class="panel" style="max-width:480px">
    <form method="post" action="<?= e(admin_url('account')); ?>" class="form-grid">
        <input type="hidden" name="_csrf" value="<?= e(csrf_token()); ?>">
        <label>Current password<input type="password" name="current_password" required></label>
        <label>New password<input type="password" name="new_password" minlength="8" required></label>
        <label>Confirm new password<input type="password" name="confirm_password" minlength="8" required></label>
        <button type="submit">Update password</button>
    </form>
</div>
