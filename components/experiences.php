<?php

/** @var list<array<string, mixed>> $experiences */

$expIcon = static function (string $position): string {
    $p = strtolower($position);

    if (str_contains($p, 'flutter') || str_contains($p, 'mobile') || str_contains($p, 'react native')) {
        return 'fa-solid fa-mobile-screen-button';
    }

    if (str_contains($p, 'android')) {
        return 'fa-brands fa-android';
    }

    if (str_contains($p, 'laravel') || str_contains($p, 'vue') || str_contains($p, 'php')) {
        return 'fa-solid fa-code';
    }

    if (str_contains($p, 'freelance') || str_contains($p, 'software & website')) {
        return 'fa-solid fa-globe';
    }

    if (str_contains($p, 'fullstack') || str_contains($p, 'full stack')) {
        return 'fa-solid fa-layer-group';
    }

    return 'fa-solid fa-briefcase';
};

$expCount = count($experiences);

?>

<section id="experience" class="experience-section">

    <div class="experience-head" data-reveal="up">

        <span class="section-tag">
            <span class="tag-dot"></span>
            <?= e(setting('experience_tag', 'EXPERIENCE')); ?>
        </span>

        <div class="experience-head__row">
            <h2 class="experience-title">
                <?= e(setting('experience_title_line_1', 'Professional')); ?>
                <span class="gradient-text"><?= e(setting('experience_title_line_2', 'Journey.')); ?></span>
            </h2>

            <?php if ($expCount > 0): ?>
                <div class="experience-stats">
                    <span class="experience-stats__pill">
                        <i class="fa-solid fa-briefcase"></i>
                        <?= (int) $expCount; ?> roles
                    </span>
                    <span class="experience-stats__pill">
                        <i class="fa-solid fa-chart-line"></i>
                        8+ years
                    </span>
                </div>
            <?php endif; ?>
        </div>

    </div>

    <?php if ($experiences): ?>

        <div class="experience-grid" data-reveal-stagger data-reveal="fade">

            <?php foreach ($experiences as $i => $experience): ?>
                <?php
                $icon       = $expIcon($experience['position']);
                $index      = str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT);
                $isCurrent  = $i === 0;
                $hasItems   = !empty($experience['items']);
                $bodyId     = 'exp-body-' . ($i + 1);
                $cardClass  = 'exp-card';
                if ($isCurrent) {
                    $cardClass .= ' exp-card--current';
                }
                if ($hasItems) {
                    $cardClass .= ' exp-card--collapsible';
                }
                if ($isCurrent || !$hasItems) {
                    $cardClass .= ' is-open';
                }
                ?>

                <article class="<?= e($cardClass); ?>">

                    <div
                        class="exp-card__header<?= $hasItems ? ' exp-card__header--toggle' : ''; ?>"
                        <?php if ($hasItems): ?>
                            role="button"
                            tabindex="0"
                            aria-expanded="<?= $isCurrent ? 'true' : 'false'; ?>"
                            aria-controls="<?= e($bodyId); ?>"
                        <?php endif; ?>
                    >
                        <div class="exp-card__meta">
                            <span class="exp-card__num"><?= e($index); ?></span>
                            <time class="exp-card__date"><?= e($experience['date_range']); ?></time>
                            <?php if ($isCurrent): ?>
                                <span class="exp-card__tag">Current</span>
                            <?php endif; ?>
                            <?php if ($hasItems): ?>
                                <span class="exp-card__chevron" aria-hidden="true">
                                    <i class="fa-solid fa-chevron-down"></i>
                                </span>
                            <?php endif; ?>
                        </div>

                        <div class="exp-card__main">
                            <div class="exp-card__icon">
                                <i class="<?= e($icon); ?>"></i>
                            </div>
                            <div class="exp-card__info">
                                <h3><?= e($experience['position']); ?></h3>
                                <p><?= e($experience['company']); ?></p>
                            </div>
                        </div>
                    </div>

                    <?php if ($hasItems): ?>
                        <div class="exp-card__body" id="<?= e($bodyId); ?>">
                            <div class="exp-card__body-inner">
                                <ul class="exp-card__list">
                                    <?php foreach ($experience['items'] as $item): ?>
                                        <li><?= e($item); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    <?php endif; ?>

                </article>

            <?php endforeach; ?>

        </div>

    <?php endif; ?>

</section>
