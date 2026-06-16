<?php
$editItem = null;
if ($edit) {
    foreach ($items as $item) {
        if ((int) $item['id'] === $edit) { $editItem = $item; break; }
    }
}
?>
<h1>Services</h1>
<div class="split">
    <section class="panel">
        <h2><?= $editItem ? 'Edit service' : 'Add service'; ?></h2>
        <form method="post" action="<?= e(admin_url('services')); ?>" class="form-grid">
            <input type="hidden" name="_csrf" value="<?= e(csrf_token()); ?>">
            <input type="hidden" name="id" value="<?= (int) ($editItem['id'] ?? 0); ?>">
            <label>Title<input name="title" value="<?= e($editItem['title'] ?? ''); ?>" required></label>
            <label>Description<textarea name="description" rows="4" required><?= e($editItem['description'] ?? ''); ?></textarea></label>
            <label>Icon class<input name="icon_class" value="<?= e($editItem['icon_class'] ?? 'fa-solid fa-code'); ?>"></label>
            <label>Sort order<input type="number" name="sort_order" value="<?= (int) ($editItem['sort_order'] ?? 0); ?>"></label>
            <label class="checkbox"><input type="checkbox" name="is_published" <?= !isset($editItem) || $editItem['is_published'] ? 'checked' : ''; ?>> Published</label>
            <button type="submit">Save</button>
        </form>
    </section>
    <section class="panel">
        <h2>All services</h2>
        <table>
            <thead><tr><th>Title</th><th>Order</th><th></th></tr></thead>
            <tbody>
            <?php foreach ($items as $item): ?>
                <tr>
                    <td><?= e($item['title']); ?></td>
                    <td><?= (int) $item['sort_order']; ?></td>
                    <td class="actions">
                        <a href="<?= e(admin_url('services?edit=' . $item['id'])); ?>">Edit</a>
                        <form method="post" action="<?= e(admin_url('services')); ?>" onsubmit="return confirm('Delete?');">
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
