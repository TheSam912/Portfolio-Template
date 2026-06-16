<h1>Site Settings</h1>
<p class="muted">All text labels, contact details, and media paths. Upload new files or paste existing paths.</p>

<form method="post" action="<?= e(admin_url('settings')); ?>" enctype="multipart/form-data" class="form-grid">
    <input type="hidden" name="_csrf" value="<?= e(csrf_token()); ?>">

    <?php
    $byGroup = [];
    foreach ($rows as $row) {
        $byGroup[$row['setting_group']][] = $row;
    }
    $values = [];
    foreach ($rows as $row) {
        $values[$row['setting_key']] = $row['setting_value'];
    }
    ?>

    <?php foreach ($byGroup as $group => $items): ?>
        <fieldset>
            <legend><?= e(ucfirst($group)); ?></legend>

            <?php foreach ($items as $item): ?>
                <?php $key = $item['setting_key']; ?>
                <label>
                    <?= e(str_replace('_', ' ', $key)); ?>
                    <?php if (str_contains($key, 'description') || str_contains($key, 'about_description')): ?>
                        <textarea name="<?= e($key); ?>" rows="4"><?= e($values[$key] ?? ''); ?></textarea>
                    <?php else: ?>
                        <input type="text" name="<?= e($key); ?>" value="<?= e($values[$key] ?? ''); ?>">
                    <?php endif; ?>
                </label>
            <?php endforeach; ?>

            <?php if ($group === 'media'): ?>
                <label>Upload hero image<input type="file" name="hero_image_upload" accept="image/*"></label>
                <label>Upload text logo<input type="file" name="text_logo_image_upload" accept="image/*"></label>
                <label>Upload footer logo<input type="file" name="logo_image_upload" accept="image/*"></label>
                <label>Upload banner<input type="file" name="banner_image_upload" accept="image/*"></label>
                <label>Upload footer wave<input type="file" name="footer_wave_image_upload" accept="image/*"></label>
                <label>Upload resume (PDF)<input type="file" name="resume_file_upload" accept="application/pdf"></label>
            <?php endif; ?>
        </fieldset>
    <?php endforeach; ?>

    <button type="submit">Save all settings</button>
</form>
