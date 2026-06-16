<?php
$editItem = null;
if ($edit) {
    foreach ($items as $item) {
        if ((int) $item['id'] === $edit) { $editItem = $item; break; }
    }
}
?>
<h1>Projects</h1>
<div class="split">
    <section class="panel">
        <h2><?= $editItem ? 'Edit project' : 'Add project'; ?></h2>
        <form method="post" action="<?= e(admin_url('projects')); ?>" enctype="multipart/form-data" class="form-grid">
            <input type="hidden" name="_csrf" value="<?= e(csrf_token()); ?>">
            <input type="hidden" name="id" value="<?= (int) ($editItem['id'] ?? 0); ?>">
            <label>Title<input name="title" value="<?= e($editItem['title'] ?? ''); ?>" required></label>
            <label>Slug<input name="slug" value="<?= e($editItem['slug'] ?? ''); ?>" placeholder="auto-generated if empty"></label>
            <label>Description<textarea name="description" rows="3"><?= e($editItem['description'] ?? ''); ?></textarea></label>
            <label>Image path<input name="image_path" value="<?= e($editItem['image_path'] ?? ''); ?>"></label>
            <label>Or upload image<input type="file" name="image_upload" accept="image/*"></label>
            <?php if (!empty($editItem['image_path'])): ?>
                <img src="/<?= e(ltrim($editItem['image_path'], '/')); ?>" alt="" class="preview-img">
            <?php endif; ?>
            <label>Project URL<input name="project_url" value="<?= e($editItem['project_url'] ?? ''); ?>" placeholder="https://…"></label>
            <label>Sort order<input type="number" name="sort_order" value="<?= (int) ($editItem['sort_order'] ?? 0); ?>"></label>
            <label class="checkbox"><input type="checkbox" name="is_published" <?= !isset($editItem) || $editItem['is_published'] ? 'checked' : ''; ?>> Published</label>
            <button type="submit">Save</button>
        </form>
    </section>
    <section class="panel">
        <h2>All projects</h2>
        <table>
            <thead><tr><th>Title</th><th>Order</th><th></th></tr></thead>
            <tbody>
            <?php foreach ($items as $item): ?>
                <tr>
                    <td><?= e($item['title']); ?></td>
                    <td><?= (int) $item['sort_order']; ?></td>
                    <td class="actions">
                        <a href="<?= e(admin_url('projects?edit=' . $item['id'])); ?>">Edit</a>
                        <form method="post" action="<?= e(admin_url('projects')); ?>" onsubmit="return confirm('Delete?');">
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
