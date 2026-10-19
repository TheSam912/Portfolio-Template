<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/helpers.php';

$projects = [];

try {

    $stmt = $pdo->query(
        "SELECT id, title, description, image_path, project_url
         FROM projects
         WHERE is_published = 1
         ORDER BY sort_order ASC, id ASC"
    );

    $projects = $stmt->fetchAll();

} catch (PDOException $e) {
    error_log('[portfolio] ' . $e->getMessage());
}

if (empty($projects)) {
    for ($i = 1; $i <= 6; $i++) {
        $projects[] = [
            'id'          => $i,
            'title'       => 'Project ' . $i,
            'image_path'  => "assets/images/portfolio/project-{$i}.webp",
            'project_url' => null,
        ];
    }
}

$projectCount = count($projects);

?>

<section id="portfolio" class="portfolio-section">

    <div
        class="portfolio-head"
        data-reveal="up">

        <span class="section-tag">

            <span class="tag-dot"></span>

            <?= e(setting('portfolio_tag', 'PORTFOLIO')); ?>

        </span>

        <div class="portfolio-head__row">
            <h2 class="portfolio-title">

                <?= e(setting('portfolio_title_line_1', 'Selected')); ?>

                <span class="gradient-text"><?= e(setting('portfolio_title_line_2', 'Projects.')); ?></span>

            </h2>

            <?php if ($projectCount > 1): ?>
                <p class="portfolio-swipe-hint" aria-hidden="true">
                    <i class="fa-solid fa-hand-pointer"></i>
                    Swipe
                </p>
            <?php endif; ?>
        </div>

    </div>

    <div class="portfolio-carousel" data-portfolio-carousel>

        <div
            class="portfolio-grid"
            data-reveal-stagger
            data-reveal="fade"
            tabindex="0"
            role="list"
            aria-label="Selected projects">

            <?php foreach ($projects as $i => $project): ?>
                <button
                    type="button"
                    class="portfolio-slide"
                    data-portfolio-slide
                    data-lightbox-index="<?= (int) $i; ?>"
                    role="listitem"
                    aria-label="View <?= e($project['title']); ?>">
                    <div class="portfolio-item">
                        <img
                            src="<?= e($project['image_path']); ?>"
                            alt="<?= e($project['title']); ?>"
                            loading="lazy"
                            decoding="async"
                            width="800"
                            height="600">
                        <div class="portfolio-overlay">
                            <h4><?= e($project['title']); ?></h4>
                            <span class="portfolio-view-hint">
                                <i class="fa-solid fa-expand" aria-hidden="true"></i>
                                View
                            </span>
                        </div>
                    </div>
                </button>
            <?php endforeach; ?>

        </div>

        <?php if ($projectCount > 1): ?>
            <div class="portfolio-dots" data-portfolio-dots aria-hidden="true"></div>
        <?php endif; ?>

    </div>

</section>

<dialog class="portfolio-lightbox" data-portfolio-lightbox aria-label="Project preview">
    <div class="portfolio-lightbox__panel">
        <button type="button" class="portfolio-lightbox__close" data-lightbox-close aria-label="Close preview">
            <i class="fa-solid fa-xmark"></i>
        </button>

        <button type="button" class="portfolio-lightbox__nav portfolio-lightbox__nav--prev" data-lightbox-prev aria-label="Previous project">
            <i class="fa-solid fa-chevron-left"></i>
        </button>

        <figure class="portfolio-lightbox__figure">
            <img src="" alt="" data-lightbox-image>
            <figcaption class="portfolio-lightbox__caption">
                <div class="portfolio-lightbox__copy">
                    <h3 data-lightbox-title></h3>
                    <p data-lightbox-desc></p>
                </div>
                <a
                    class="portfolio-lightbox__link"
                    data-lightbox-link
                    href="#"
                    target="_blank"
                    rel="noopener noreferrer"
                    hidden>
                    Visit project
                    <i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></i>
                </a>
            </figcaption>
        </figure>

        <button type="button" class="portfolio-lightbox__nav portfolio-lightbox__nav--next" data-lightbox-next aria-label="Next project">
            <i class="fa-solid fa-chevron-right"></i>
        </button>
    </div>
</dialog>

<script type="application/json" id="portfolio-lightbox-data">
<?= json_encode(
    array_map(static function (array $project): array {
        return [
            'title' => (string) ($project['title'] ?? ''),
            'desc'  => (string) ($project['description'] ?? ''),
            'image' => (string) ($project['image_path'] ?? ''),
            'url'   => $project['project_url'] ? (string) $project['project_url'] : null,
        ];
    }, $projects),
    JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP
); ?>
</script>
