<?php

/** @var array $content */
/** @var array $profile */

?>

<section id="hero" class="hero">

    <div class="hero-left">

        <div class="hero-badge" data-reveal="fade">
            <?= e(setting('hero_badge')); ?>
        </div>

        <h1 class="hero-title" data-reveal="up" data-reveal-delay="80">
            <?= e(setting('hero_title_line_1')); ?>
            <br>
            <span class="gradient-text"><?= e(setting('hero_title_line_2')); ?></span>
            <br>
            <?= e(setting('hero_title_line_3')); ?>
        </h1>

        <p class="hero-description" data-reveal="up" data-reveal-delay="180">
            <?= e(profile('short_summary')); ?>
        </p>

        <div class="hero-meta" data-reveal="up" data-reveal-delay="220">
            <span class="hero-meta__chip">
                <i class="fa-solid fa-briefcase" aria-hidden="true"></i>
                8+ Years Experience
            </span>
            <span class="hero-meta__chip">
                <i class="fa-solid fa-chart-line" aria-hidden="true"></i>
                45% Peak Engagement Uplift
            </span>
            <span class="hero-meta__chip">
                <i class="fa-solid fa-layer-group" aria-hidden="true"></i>
                15+ Apps &amp; Platforms
            </span>
            <span class="hero-meta__chip">
                <i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
                SEO/GEO Search &amp; AI Visibility
            </span>
        </div>

        <div class="hero-buttons" data-reveal="up" data-reveal-delay="280">
            <a href="#live" class="hero-btn-primary" data-magnetic>
                <span><?= e(setting('hero_btn_primary')); ?></span>
                <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
            </a>
            <a href="<?= e(profile('resume_file')); ?>" class="hero-btn-secondary" download>
                <i class="fa-solid fa-download" aria-hidden="true"></i>
                <span><?= e(setting('hero_btn_secondary')); ?></span>
            </a>
        </div>

    </div>

    <div class="hero-right" data-reveal="scale" data-reveal-delay="200">
        <img
            src="<?= e(setting('hero_image')); ?>"
            alt="Sobhan Daroogheh"
            fetchpriority="high"
            decoding="async"
            width="600"
            height="600">
    </div>

</section>
