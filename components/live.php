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

$hostOf = static function (string $url): string {
    $host = parse_url($url, PHP_URL_HOST);
    if (!$host) {
        return $url;
    }

    return (string) preg_replace('/^www\./', '', $host);
};

$typeLabel = static function (string $type): string {
    return strtolower($type) === 'app' ? 'App' : 'Website';
};

?>

<section id="live" class="live-section">

    <div class="live-head" data-reveal="up">
        <div class="live-head__copy">
            <span class="section-tag">
                <span class="tag-dot"></span>
                <?= e(setting('live_tag', 'LIVE NOW')); ?>
            </span>

            <h2 class="live-title">
                <?= e(setting('live_title_line_1', 'Everything Here Is')); ?>
                <span class="gradient-text"><?= e(setting('live_title_line_2', 'Online Right Now.')); ?></span>
            </h2>

            <p class="live-lead">
                <?= e(setting(
                    'live_lead',
                    'Seven live websites and apps you can open instantly — each tied to real shipped work.'
                )); ?>
            </p>
        </div>

        <div class="live-head__aside" aria-hidden="true">
            <div class="live-head__count">
                <strong><?= (int) $liveCount; ?></strong>
                <span>live products</span>
            </div>
            <div class="live-head__signal">
                <span class="live-pulse"></span>
                Available to visit
            </div>
        </div>
    </div>

    <?php if ($liveProjects): ?>
        <ol class="live-list">
            <?php foreach ($liveProjects as $i => $project): ?>
                <?php
                $type = (string) ($project['type'] ?? 'website');
                $url  = (string) $project['url'];
                $num  = str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT);
                $host = $hostOf($url);
                $related = trim((string) ($project['related'] ?? ''));
                ?>
                <li class="live-row">
                    <div class="live-row__index" aria-hidden="true"><?= e($num); ?></div>

                    <div class="live-row__main">
                        <div class="live-row__badges">
                            <span class="live-row__live">
                                <span class="live-pulse" aria-hidden="true"></span>
                                Live
                            </span>
                            <span class="live-row__type"><?= e($typeLabel($type)); ?></span>
                            <?php if ($related !== ''): ?>
                                <span class="live-row__related"><?= e($related); ?></span>
                            <?php endif; ?>
                        </div>

                        <h3 class="live-row__name"><?= e((string) $project['name']); ?></h3>

                        <?php if (!empty($project['blurb'])): ?>
                            <p class="live-row__blurb"><?= e((string) $project['blurb']); ?></p>
                        <?php endif; ?>

                        <div class="live-row__meta">
                            <?php if (!empty($project['stack'])): ?>
                                <span><?= e((string) $project['stack']); ?></span>
                            <?php endif; ?>
                            <span class="live-row__host">
                                <i class="fa-solid fa-link" aria-hidden="true"></i>
                                <?= e($host); ?>
                            </span>
                        </div>
                    </div>

                    <a
                        class="live-row__cta"
                        href="<?= e($url); ?>"
                        target="_blank"
                        rel="noopener noreferrer">
                        <span><?= e((string) ($project['cta'] ?? 'Open')); ?></span>
                        <i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></i>
                    </a>
                </li>
            <?php endforeach; ?>
        </ol>
    <?php endif; ?>

</section>
