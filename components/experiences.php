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

$liveProjects = [];
$liveFile = __DIR__ . '/../config/live-projects.php';
if (is_file($liveFile)) {
    $loaded = require $liveFile;
    if (is_array($loaded)) {
        $liveProjects = $loaded;
    }
}

$liveForCompany = static function (string $company) use ($liveProjects): array {
    $matches = [];
    $companyLower = strtolower($company);

    foreach ($liveProjects as $project) {
        if (!is_array($project) || empty($project['url']) || empty($project['name'])) {
            continue;
        }

        $related = strtolower(trim((string) ($project['related'] ?? '')));
        if ($related === '') {
            continue;
        }

        if (
            str_contains($companyLower, $related)
            || str_contains($related, $companyLower)
            || (
                str_contains($companyLower, 'corefinity')
                && str_contains($related, 'corefinity')
            )
            || (
                str_contains($companyLower, 'woocom')
                && str_contains($related, 'woocom')
            )
            || (
                str_contains($companyLower, 'niu')
                && str_contains($related, 'niu')
            )
            || (
                str_contains($companyLower, 'self-employed')
                && str_contains($related, 'self-employed')
            )
            || (
                str_contains($companyLower, 'fanavaran')
                && str_contains($related, 'fanavaran')
            )
        ) {
            $matches[] = $project;
        }
    }

    return $matches;
};

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
                $icon        = $expIcon($experience['position']);
                $index       = str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT);
                $isCurrent   = $i === 0;
                $hasItems    = !empty($experience['items']);
                $relatedLive = $liveForCompany((string) $experience['company']);
                $hasLive     = !empty($relatedLive);
                $hasBody     = $hasItems || $hasLive;
                $bodyId      = 'exp-body-' . ($i + 1);
                $cardClass   = 'exp-card';
                if ($isCurrent) {
                    $cardClass .= ' exp-card--current';
                }
                if ($hasBody) {
                    $cardClass .= ' exp-card--collapsible';
                }
                if ($isCurrent || !$hasBody) {
                    $cardClass .= ' is-open';
                }
                ?>

                <article class="<?= e($cardClass); ?>">

                    <div
                        class="exp-card__header<?= $hasBody ? ' exp-card__header--toggle' : ''; ?>"
                        <?php if ($hasBody): ?>
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
                            <?php if ($hasBody): ?>
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

                    <?php if ($hasBody): ?>
                        <div class="exp-card__body" id="<?= e($bodyId); ?>">
                            <div class="exp-card__body-inner">
                                <?php if ($hasItems): ?>
                                    <ul class="exp-card__list">
                                        <?php foreach ($experience['items'] as $item): ?>
                                            <li><?= e($item); ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>

                                <?php if ($hasLive): ?>
                                    <div class="exp-card__live">
                                        <span class="exp-card__live-label">
                                            <span class="live-pulse" aria-hidden="true"></span>
                                            Live work
                                        </span>
                                        <div class="exp-card__live-links">
                                            <?php foreach ($relatedLive as $live): ?>
                                                <a
                                                    href="<?= e((string) $live['url']); ?>"
                                                    target="_blank"
                                                    rel="noopener noreferrer"
                                                    class="exp-card__live-link">
                                                    <?= e((string) $live['name']); ?>
                                                    <i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></i>
                                                </a>
                                                <?php if (!empty($live['store_android'])): ?>
                                                    <a
                                                        href="<?= e((string) $live['store_android']); ?>"
                                                        target="_blank"
                                                        rel="noopener noreferrer"
                                                        class="exp-card__live-link exp-card__live-link--store">
                                                        Play Store
                                                        <i class="fa-brands fa-google-play" aria-hidden="true"></i>
                                                    </a>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                </article>

            <?php endforeach; ?>

        </div>

    <?php endif; ?>

</section>
