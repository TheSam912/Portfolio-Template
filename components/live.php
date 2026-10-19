<?php

$liveProjects = require __DIR__ . '/../config/live-projects.php';
if (!is_array($liveProjects)) {
    $liveProjects = [];
}

$liveProjects = array_values(array_filter(
    $liveProjects,
    static fn ($item): bool => is_array($item) && !empty($item['url']) && !empty($item['name'])
));

$liveCount = count($liveProjects);
$typeLabel = static function (string $type): string {
    return strtolower($type) === 'app' ? 'Application' : 'Website';
};
$typeIcon = static function (string $type): string {
    return strtolower($type) === 'app' ? 'fa-solid fa-mobile-screen-button' : 'fa-solid fa-globe';
};

?>

<section id="live" class="live-section">

    <div class="live-head" data-reveal="up">

        <span class="section-tag">
            <span class="tag-dot"></span>
            <?= e(setting('live_tag', 'LIVE NOW')); ?>
        </span>

        <div class="live-head__row">
            <h2 class="live-title">
                <?= e(setting('live_title_line_1', 'Products You Can')); ?>
                <span class="gradient-text"><?= e(setting('live_title_line_2', 'Open Today.')); ?></span>
            </h2>

            <p class="live-lead">
                <?= e(setting(
                    'live_lead',
                    'Real websites and apps currently online — click through and explore them live.'
                )); ?>
            </p>
        </div>

        <?php if ($liveCount > 0): ?>
            <div class="live-head__stats" aria-hidden="true">
                <span class="live-head__pill">
                    <span class="live-pulse"></span>
                    <?= (int) $liveCount; ?> live
                </span>
            </div>
        <?php endif; ?>

    </div>

    <?php if ($liveProjects): ?>

        <div class="live-grid" data-reveal-stagger data-reveal="fade">

            <?php foreach ($liveProjects as $i => $project): ?>
                <?php
                $type = (string) ($project['type'] ?? 'website');
                $url  = (string) $project['url'];
                $host = parse_url($url, PHP_URL_HOST) ?: $url;
                $host = preg_replace('/^www\./', '', (string) $host);
                ?>
                <article class="live-card" data-reveal-child style="--i: <?= (int) $i; ?>">

                    <div class="live-card__top">
                        <span class="live-card__status">
                            <span class="live-pulse" aria-hidden="true"></span>
                            Live
                        </span>
                        <span class="live-card__type">
                            <i class="<?= e($typeIcon($type)); ?>" aria-hidden="true"></i>
                            <?= e($typeLabel($type)); ?>
                        </span>
                    </div>

                    <div class="live-card__body">
                        <h3 class="live-card__name"><?= e((string) $project['name']); ?></h3>

                        <?php if (!empty($project['blurb'])): ?>
                            <p class="live-card__blurb"><?= e((string) $project['blurb']); ?></p>
                        <?php endif; ?>

                        <?php if (!empty($project['stack'])): ?>
                            <p class="live-card__stack"><?= e((string) $project['stack']); ?></p>
                        <?php endif; ?>

                        <p class="live-card__host">
                            <i class="fa-solid fa-link" aria-hidden="true"></i>
                            <?= e((string) $host); ?>
                        </p>
                    </div>

                    <div class="live-card__actions">
                        <a
                            class="live-card__cta"
                            href="<?= e($url); ?>"
                            target="_blank"
                            rel="noopener noreferrer"
                            data-magnetic>
                            <span><?= e((string) ($project['cta'] ?? 'Open live')); ?></span>
                            <i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></i>
                        </a>

                        <?php if (!empty($project['store_android'])): ?>
                            <a
                                class="live-card__store"
                                href="<?= e((string) $project['store_android']); ?>"
                                target="_blank"
                                rel="noopener noreferrer"
                                aria-label="Google Play">
                                <i class="fa-brands fa-google-play" aria-hidden="true"></i>
                            </a>
                        <?php endif; ?>

                        <?php if (!empty($project['store_ios'])): ?>
                            <a
                                class="live-card__store"
                                href="<?= e((string) $project['store_ios']); ?>"
                                target="_blank"
                                rel="noopener noreferrer"
                                aria-label="App Store">
                                <i class="fa-brands fa-apple" aria-hidden="true"></i>
                            </a>
                        <?php endif; ?>
                    </div>

                </article>
            <?php endforeach; ?>

        </div>

    <?php else: ?>

        <div class="live-empty" data-reveal="up">
            <span class="live-pulse"></span>
            <p>Live projects will appear here soon.</p>
        </div>

    <?php endif; ?>

</section>
