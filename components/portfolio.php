<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/helpers.php';

$projects = [];

try {

    $stmt = $pdo->query(
        "SELECT id, title, image_path, project_url
         FROM projects
         WHERE is_published = 1
         ORDER BY sort_order ASC, id ASC"
    );

    $projects = $stmt->fetchAll();

} catch (PDOException $e) {

    error_log('[portfolio] ' . $e->getMessage());
}

// Fallback: if the DB returned no rows, render the original 6 hardcoded tiles
// so the section never looks empty / broken.
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

?>

<section id="portfolio" class="portfolio-section">

    <div class="portfolio-head">

        <span class="section-tag">

            <span class="tag-dot"></span>

            PORTFOLIO

        </span>

        <h2 class="portfolio-title">

            Selected

            <span>Projects.</span>

        </h2>

    </div>

    <div class="portfolio-grid">

        <?php foreach ($projects as $project): ?>

            <?php
                $tile = '<div class="portfolio-item">'
                    . '<img src="' . e($project['image_path']) . '"'
                    . ' alt="' . e($project['title']) . '"'
                    . ' loading="lazy" decoding="async"'
                    . ' width="800" height="600">'
                    . '</div>';
            ?>

            <?php if (!empty($project['project_url'])): ?>

                <a
                    href="<?= e($project['project_url']); ?>"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="portfolio-link">
                    <?= $tile; ?>
                </a>

            <?php else: ?>

                <?= $tile; ?>

            <?php endif; ?>

        <?php endforeach; ?>

    </div>

</section>
