<?php
$editItem = null;
if ($edit) {
    foreach ($items as $item) {
        if ((int) $item['id'] === $edit) { $editItem = $item; break; }
    }
}
$title    = 'Skills';
$subtitle = 'Tech stack with logos — edit on the left, see your full grid on the right.';
require __DIR__ . '/partials/page-header.php';
?>

<div class="editor-layout">
    <div class="editor-form">
        <section class="panel">
            <div class="panel__head">
                <h2><?= $editItem ? 'Edit skill' : 'Add skill'; ?></h2>
                <?php if ($editItem): ?>
                    <a href="<?= e(admin_url('skills')); ?>" class="btn btn--ghost btn--sm">Cancel</a>
                <?php endif; ?>
            </div>

            <form method="post" action="<?= e(admin_url('skills')); ?>" enctype="multipart/form-data" class="form-grid">
                <input type="hidden" name="_csrf" value="<?= e(csrf_token()); ?>">
                <input type="hidden" name="id" value="<?= (int) ($editItem['id'] ?? 0); ?>">

                <div class="field">
                    <label>Name</label>
                    <input name="name" value="<?= e($editItem['name'] ?? ''); ?>" required placeholder="PHP, React, Docker…">
                </div>
                <div class="field">
                    <label>Icon path</label>
                    <input name="icon_path" value="<?= e($editItem['icon_path'] ?? ''); ?>" placeholder="assets/images/skills/php.png">
                </div>
                <div class="field">
                    <label>Or upload icon</label>
                    <div class="file-drop">
                        <input type="file" name="icon_upload" accept="image/*" data-preview-target="skill-upload-preview">
                        <p class="file-name field-hint">PNG or SVG recommended</p>
                    </div>
                </div>
                <?php if (!empty($editItem['icon_path'])): ?>
                    <img id="skill-upload-preview" src="<?= e(asset_url($editItem['icon_path'])); ?>" alt="" style="width:52px;height:52px;object-fit:contain">
                <?php else: ?>
                    <img id="skill-upload-preview" src="" alt="" style="display:none;width:52px;height:52px;object-fit:contain">
                <?php endif; ?>
                <div class="field-row">
                    <div class="field">
                        <label>Sort order</label>
                        <input type="number" name="sort_order" value="<?= (int) ($editItem['sort_order'] ?? 0); ?>">
                    </div>
                    <label class="field-check" style="align-self:end;padding-bottom:12px">
                        <input type="checkbox" name="is_published" <?= !isset($editItem) || $editItem['is_published'] ? 'checked' : ''; ?>>
                        Published on site
                    </label>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn--primary">
                        <i class="fa-solid fa-floppy-disk"></i> Save skill
                    </button>
                </div>
            </form>
        </section>
    </div>

    <div class="preview-panel">
        <section class="panel">
            <div class="panel__head">
                <h2>Current skills on site</h2>
                <span class="badge badge--count"><?= count($items); ?> total</span>
            </div>

            <?php if ($items): ?>
                <div class="item-grid">
                    <?php foreach ($items as $item): ?>
                        <article class="item-card<?= $edit && (int) $item['id'] === $edit ? ' is-editing' : ''; ?>">
                            <div class="item-card__media item-card__media--icon">
                                <?php if (!empty($item['icon_path'])): ?>
                                    <img src="<?= e(asset_url($item['icon_path'])); ?>" alt="<?= e($item['name']); ?>">
                                <?php else: ?>
                                    <i class="fa-solid fa-code" style="font-size:2rem;color:var(--adm-dim)"></i>
                                <?php endif; ?>
                            </div>
                            <div class="item-card__body">
                                <div class="item-card__meta">
                                    <h3><?= e($item['name']); ?></h3>
                                    <span>#<?= (int) $item['sort_order']; ?></span>
                                </div>
                                <?php if (!$item['is_published']): ?>
                                    <span class="badge badge--draft">Draft</span>
                                <?php endif; ?>
                                <div class="item-card__actions">
                                    <a href="<?= e(admin_url('skills?edit=' . $item['id'])); ?>" class="btn btn--ghost btn--sm">Edit</a>
                                    <form method="post" action="<?= e(admin_url('skills')); ?>" onsubmit="return confirm('Delete this skill?');">
                                        <input type="hidden" name="_csrf" value="<?= e(csrf_token()); ?>">
                                        <input type="hidden" name="delete_id" value="<?= (int) $item['id']; ?>">
                                        <button type="submit" class="btn btn--danger btn--sm">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="empty-state">
                    <i class="fa-solid fa-code"></i>
                    <p>No skills yet. Add your first one using the form.</p>
                </div>
            <?php endif; ?>
        </section>
    </div>
</div>
