<?php
$editItem = null;
if ($edit) {
    foreach ($items as $item) {
        if ((int) $item['id'] === $edit) { $editItem = $item; break; }
    }
}
$title    = 'Projects';
$subtitle = 'Portfolio work with thumbnails — gallery preview updates as you edit.';
require __DIR__ . '/partials/page-header.php';
?>

<div class="editor-layout">
    <div class="editor-form">
        <section class="panel">
            <div class="panel__head">
                <h2><?= $editItem ? 'Edit project' : 'Add project'; ?></h2>
                <?php if ($editItem): ?>
                    <a href="<?= e(admin_url('projects')); ?>" class="btn btn--ghost btn--sm">Cancel</a>
                <?php endif; ?>
            </div>

            <form method="post" action="<?= e(admin_url('projects')); ?>" enctype="multipart/form-data" class="form-grid">
                <input type="hidden" name="_csrf" value="<?= e(csrf_token()); ?>">
                <input type="hidden" name="id" value="<?= (int) ($editItem['id'] ?? 0); ?>">

                <div class="field">
                    <label>Title</label>
                    <input name="title" value="<?= e($editItem['title'] ?? ''); ?>" required>
                </div>
                <div class="field">
                    <label>Slug</label>
                    <input name="slug" value="<?= e($editItem['slug'] ?? ''); ?>" placeholder="auto-generated if empty">
                </div>
                <div class="field">
                    <label>Description</label>
                    <textarea name="description" rows="3"><?= e($editItem['description'] ?? ''); ?></textarea>
                </div>
                <div class="field">
                    <label>Image path</label>
                    <input name="image_path" value="<?= e($editItem['image_path'] ?? ''); ?>" placeholder="assets/images/projects/…">
                </div>
                <div class="field">
                    <label>Or upload image</label>
                    <div class="file-drop">
                        <input type="file" name="image_upload" accept="image/*" data-preview-target="project-upload-preview">
                        <p class="file-name field-hint">JPG or PNG, 16:10 works best</p>
                    </div>
                </div>
                <?php if (!empty($editItem['image_path'])): ?>
                    <img id="project-upload-preview" src="<?= e(asset_url($editItem['image_path'])); ?>" alt="" style="width:100%;max-height:140px;object-fit:cover;border-radius:10px">
                <?php else: ?>
                    <img id="project-upload-preview" src="" alt="" style="display:none;width:100%;max-height:140px;object-fit:cover;border-radius:10px">
                <?php endif; ?>
                <div class="field">
                    <label>Project URL</label>
                    <input name="project_url" value="<?= e($editItem['project_url'] ?? ''); ?>" placeholder="https://…">
                </div>
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
                        <i class="fa-solid fa-floppy-disk"></i> Save project
                    </button>
                </div>
            </form>
        </section>
    </div>

    <div class="preview-panel">
        <section class="panel">
            <div class="panel__head">
                <h2>Project gallery — live</h2>
                <span class="badge badge--count"><?= count($items); ?> total</span>
            </div>

            <?php if ($items): ?>
                <div class="item-grid item-grid--projects">
                    <?php foreach ($items as $item): ?>
                        <article class="item-card<?= $edit && (int) $item['id'] === $edit ? ' is-editing' : ''; ?>">
                            <div class="item-card__media">
                                <?php if (!empty($item['image_path'])): ?>
                                    <img src="<?= e(asset_url($item['image_path'])); ?>" alt="<?= e($item['title']); ?>">
                                <?php else: ?>
                                    <i class="fa-solid fa-image" style="font-size:2rem;color:var(--adm-dim)"></i>
                                <?php endif; ?>
                            </div>
                            <div class="item-card__body">
                                <h3><?= e($item['title']); ?></h3>
                                <?php if (!empty($item['description'])): ?>
                                    <p class="muted" style="margin:0 0 10px;font-size:0.82rem"><?= e(admin_excerpt($item['description'], 80)); ?></p>
                                <?php endif; ?>
                                <div class="item-card__meta">
                                    <span>#<?= (int) $item['sort_order']; ?></span>
                                    <?php if (!$item['is_published']): ?>
                                        <span class="badge badge--draft">Draft</span>
                                    <?php endif; ?>
                                </div>
                                <div class="item-card__actions">
                                    <a href="<?= e(admin_url('projects?edit=' . $item['id'])); ?>" class="btn btn--ghost btn--sm">Edit</a>
                                    <form method="post" action="<?= e(admin_url('projects')); ?>" onsubmit="return confirm('Delete this project?');">
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
                    <i class="fa-solid fa-folder-open"></i>
                    <p>No projects yet. Add your first portfolio piece.</p>
                </div>
            <?php endif; ?>
        </section>
    </div>
</div>
