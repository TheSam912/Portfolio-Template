<?php
$editItem = null;
if ($edit) {
    foreach ($items as $item) {
        if ((int) $item['id'] === $edit) { $editItem = $item; break; }
    }
}
$title    = 'Experience';
$subtitle = 'Jobs and bullet points — timeline preview shows exactly what visitors read.';
require __DIR__ . '/partials/page-header.php';
?>

<div class="editor-layout">
    <div class="editor-form">
        <section class="panel">
            <div class="panel__head">
                <h2><?= $editItem ? 'Edit experience' : 'Add experience'; ?></h2>
                <?php if ($editItem): ?>
                    <a href="<?= e(admin_url('experiences')); ?>" class="btn btn--ghost btn--sm">Cancel</a>
                <?php endif; ?>
            </div>

            <form method="post" action="<?= e(admin_url('experiences')); ?>" class="form-grid">
                <input type="hidden" name="_csrf" value="<?= e(csrf_token()); ?>">
                <input type="hidden" name="id" value="<?= (int) ($editItem['id'] ?? 0); ?>">

                <div class="field">
                    <label>Date range</label>
                    <input name="date_range" value="<?= e($editItem['date_range'] ?? ''); ?>" placeholder="Oct 2023 — Present" required>
                </div>
                <div class="field">
                    <label>Position</label>
                    <input name="position" value="<?= e($editItem['position'] ?? ''); ?>" required>
                </div>
                <div class="field">
                    <label>Company</label>
                    <input name="company" value="<?= e($editItem['company'] ?? ''); ?>" required>
                </div>
                <div class="field">
                    <label>Bullet points <span class="field-hint">(one per line)</span></label>
                    <textarea name="bullets" rows="8" placeholder="Built X using Y…&#10;Led team of Z…"><?= e(implode("\n", $bullets ?? [])); ?></textarea>
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
                        <i class="fa-solid fa-floppy-disk"></i> Save experience
                    </button>
                </div>
            </form>
        </section>
    </div>

    <div class="preview-panel">
        <section class="panel">
            <div class="panel__head">
                <h2>Timeline — live</h2>
                <span class="badge badge--count"><?= count($items); ?> roles</span>
            </div>

            <?php if ($items): ?>
                <div class="timeline-preview">
                    <?php foreach ($items as $item): ?>
                        <?php $itemBullets = $allBullets[(int) $item['id']] ?? []; ?>
                        <article class="exp-card<?= $edit && (int) $item['id'] === $edit ? ' is-editing' : ''; ?>">
                            <div class="exp-card__date"><?= e($item['date_range']); ?></div>
                            <h3><?= e($item['position']); ?></h3>
                            <h4><?= e($item['company']); ?></h4>
                            <?php if ($itemBullets): ?>
                                <ul>
                                    <?php foreach (array_slice($itemBullets, 0, 4) as $bullet): ?>
                                        <li><?= e(admin_excerpt($bullet, 120)); ?></li>
                                    <?php endforeach; ?>
                                    <?php if (count($itemBullets) > 4): ?>
                                        <li class="muted">+<?= count($itemBullets) - 4; ?> more…</li>
                                    <?php endif; ?>
                                </ul>
                            <?php endif; ?>
                            <?php if (!$item['is_published']): ?>
                                <span class="badge badge--draft">Draft</span>
                            <?php endif; ?>
                            <div class="exp-card__actions">
                                <a href="<?= e(admin_url('experiences?edit=' . $item['id'])); ?>" class="btn btn--ghost btn--sm">Edit</a>
                                <form method="post" action="<?= e(admin_url('experiences')); ?>" onsubmit="return confirm('Delete this experience?');">
                                    <input type="hidden" name="_csrf" value="<?= e(csrf_token()); ?>">
                                    <input type="hidden" name="delete_id" value="<?= (int) $item['id']; ?>">
                                    <button type="submit" class="btn btn--danger btn--sm">Delete</button>
                                </form>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="empty-state">
                    <i class="fa-solid fa-briefcase"></i>
                    <p>No experience entries yet.</p>
                </div>
            <?php endif; ?>
        </section>
    </div>
</div>
