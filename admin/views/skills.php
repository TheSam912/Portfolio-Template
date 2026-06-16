<?php
$editItem = null;
if ($edit) {
    foreach ($items as $item) {
        if ((int) $item['id'] === $edit) { $editItem = $item; break; }
    }
}
?>
<h1>Skills</h1>
<div class="split">
    <section class="panel">
        <h2><?= $editItem ? 'Edit skill' : 'Add skill'; ?></h2>
        <form method="post" action="<?= e(admin_url('skills')); ?>" enctype="multipart/form-data" class="form-grid">
            <input type="hidden" name="_csrf" value="<?= e(csrf_token()); ?>">
            <input type="hidden" name="id" value="<?= (int) ($editItem['id'] ?? 0); ?>">
            <label>Name<input name="name" value="<?= e($editItem['name'] ?? ''); ?>" required></label>
            <label>Icon path<input name="icon_path" value="<?= e($editItem['icon_path'] ?? ''); ?>" placeholder="assets/images/skills/php.png"></label>
            <label>Or upload icon<input type="file" name="icon_upload" accept="image/*"></label>
            <?php if (!empty($editItem['icon_path'])): ?>
                <img src="/<?= e(ltrim($editItem['icon_path'], '/')); ?>" alt="" class="preview-thumb">
            <?php endif; ?>
            <label>Sort order<input type="number" name="sort_order" value="<?= (int) ($editItem['sort_order'] ?? 0); ?>"></label>
            <label class="checkbox"><input type="checkbox" name="is_published" <?= !isset($editItem) || $editItem['is_published'] ? 'checked' : ''; ?>> Published</label>
            <button type="submit">Save</button>
        </form>
    </section>
    <section class="panel">
        <h2>All skills</h2>
        <table>
            <thead><tr><th></th><th>Name</th><th>Order</th><th></th></tr></thead>
            <tbody>
            <?php foreach ($items as $item): ?>
                <tr>
                    <td><img src="/<?= e(ltrim($item['icon_path'], '/')); ?>" alt="" class="table-thumb"></td>
                    <td><?= e($item['name']); ?></td>
                    <td><?= (int) $item['sort_order']; ?></td>
                    <td class="actions">
                        <a href="<?= e(admin_url('skills?edit=' . $item['id'])); ?>">Edit</a>
                        <form method="post" action="<?= e(admin_url('skills')); ?>" onsubmit="return confirm('Delete?');">
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
