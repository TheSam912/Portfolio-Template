<?php

/** @var array $content */

?>

<section id="hero" class="hero">

    <div class="hero-left">

        <div
            class="hero-badge"
            data-reveal="fade">

            <?= e(setting('hero_badge')); ?>

        </div>

        <h1
            class="hero-title"
            data-reveal="up"
            data-reveal-delay="80">

            <?= e(setting('hero_title_line_1')); ?>

            <br>

            <span class="gradient-text">

                <?= e(setting('hero_title_line_2')); ?>

            </span>

            <br>

            <?= e(setting('hero_title_line_3')); ?>

        </h1>

        <p
            class="hero-description"
            data-reveal="up"
            data-reveal-delay="180">

            <?= e(setting('hero_description')); ?>

        </p>

        <div
            class="hero-buttons"
            data-reveal="up"
            data-reveal-delay="280">

            <a
                href="#portfolio"
                class="hero-btn-primary"
                data-magnetic>

                <?= e(setting('hero_btn_primary')); ?>

            </a>

            <a
                href="<?= e(setting('resume_file', 'assets/files/Sobhan-Resume.pdf')); ?>"
                class="hero-btn-secondary"
                download>

                <?= e(setting('hero_btn_secondary')); ?>

            </a>

        </div>

    </div>

    <div
        class="hero-right"
        data-reveal="scale"
        data-reveal-delay="200">

        <img
            src="<?= e(setting('hero_image', 'assets/images/hero.webp')); ?>"
            alt="Sobhan (Sam) Nolan"
            fetchpriority="high"
            decoding="async"
            width="600"
            height="600">

    </div>

</section>
