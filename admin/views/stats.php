<?php
$editItem = null;
if ($edit) {
    foreach ($items as $item) {
        if ((int) $item['id'] === $edit) {
            $editItem = $item;
            break;
        }
    }
}
?>
<h1>Stats</h1>

<div class="split">
    <section class="panel">
        <h2><?= $editItem ? 'Edit stat' : 'Add stat'; ?></h2>
        <form method="post" action="<?= e(admin_url('stats')); ?>" class="form-grid">
            <input type="hidden" name="_csrf" value="<?= e(csrf_token()); ?>">
            <input type="hidden" name="id" value="<?= (int) ($editItem['id'] ?? 0); ?>">
            <label>Icon class (Font Awesome)<input name="icon_class" value="<?= e($editItem['icon_class'] ?? 'fa-solid fa-star'); ?>" required></label>
            <label>Count value<input name="count_value" value="<?= e($editItem['count_value'] ?? ''); ?>" placeholder="80+" required></label>
            <label>Label<input name="label_text" value="<?= e($editItem['label_text'] ?? ''); ?>" required></label>
            <label>Sort order<input type="number" name="sort_order" value="<?= (int) ($editItem['sort_order'] ?? 0); ?>"></label>
            <label class="checkbox"><input type="checkbox" name="is_published" <?= !isset($editItem) || $editItem['is_published'] ? 'checked' : ''; ?>> Published</label>
            <button type="submit">Save</button>
        </form>
    </section>

    <section class="panel">
        <h2>All stats</h2>
        <table>
            <thead><tr><th>Count</th><th>Label</th><th>Order</th><th></th></tr></thead>
            <tbody>
            <?php foreach ($items as $item): ?>
                <tr>
                    <td><?= e($item['count_value']); ?></td>
                    <td><?= e($item['label_text']); ?></td>
                    <td><?= (int) $item['sort_order']; ?></td>
                    <td class="actions">
                        <a href="<?= e(admin_url('stats?edit=' . $item['id'])); ?>">Edit</a>
                        <form method="post" action="<?= e(admin_url('stats')); ?>" onsubmit="return confirm('Delete?');">
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
