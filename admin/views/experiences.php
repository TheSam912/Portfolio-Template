<?php
$editItem = null;
if ($edit) {
    foreach ($items as $item) {
        if ((int) $item['id'] === $edit) { $editItem = $item; break; }
    }
}
?>
<h1>Experience</h1>
<div class="split">
    <section class="panel">
        <h2><?= $editItem ? 'Edit experience' : 'Add experience'; ?></h2>
        <form method="post" action="<?= e(admin_url('experiences')); ?>" class="form-grid">
            <input type="hidden" name="_csrf" value="<?= e(csrf_token()); ?>">
            <input type="hidden" name="id" value="<?= (int) ($editItem['id'] ?? 0); ?>">
            <label>Date range<input name="date_range" value="<?= e($editItem['date_range'] ?? ''); ?>" placeholder="Oct 2023 — Present" required></label>
            <label>Position<input name="position" value="<?= e($editItem['position'] ?? ''); ?>" required></label>
            <label>Company<input name="company" value="<?= e($editItem['company'] ?? ''); ?>" required></label>
            <label>Bullet points <span class="muted">(one per line)</span>
                <textarea name="bullets" rows="6"><?= e(implode("\n", $bullets ?? [])); ?></textarea>
            </label>
            <label>Sort order<input type="number" name="sort_order" value="<?= (int) ($editItem['sort_order'] ?? 0); ?>"></label>
            <label class="checkbox"><input type="checkbox" name="is_published" <?= !isset($editItem) || $editItem['is_published'] ? 'checked' : ''; ?>> Published</label>
            <button type="submit">Save</button>
        </form>
    </section>
    <section class="panel">
        <h2>All experiences</h2>
        <table>
            <thead><tr><th>Position</th><th>Company</th><th></th></tr></thead>
            <tbody>
            <?php foreach ($items as $item): ?>
                <tr>
                    <td><?= e($item['position']); ?></td>
                    <td><?= e($item['company']); ?></td>
                    <td class="actions">
                        <a href="<?= e(admin_url('experiences?edit=' . $item['id'])); ?>">Edit</a>
                        <form method="post" action="<?= e(admin_url('experiences')); ?>" onsubmit="return confirm('Delete?');">
                            <input type="hidden" name="_csrf" value="<?= e(csrf_token()); ?>">
                            <input type="hidden" name="delete_id" value="<?= (int) $item['id']; ?>">
                            <button type="submit" class="danger">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</div>
