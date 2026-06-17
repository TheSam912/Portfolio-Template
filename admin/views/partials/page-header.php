<?php
/** @var string $title */
/** @var string $subtitle */
/** @var string|null $actionLabel */
/** @var string|null $actionHref */
?>
<header class="page-header">
    <div class="page-header__text">
        <p class="page-eyebrow">Portfolio CMS</p>
        <h1><?= e($title); ?></h1>
        <?php if (!empty($subtitle)): ?>
            <p class="page-subtitle"><?= e($subtitle); ?></p>
        <?php endif; ?>
    </div>
    <?php if (!empty($actionLabel) && !empty($actionHref)): ?>
        <a href="<?= e($actionHref); ?>" class="btn btn--ghost">
            <?= e($actionLabel); ?>
        </a>
    <?php endif; ?>
</header>
