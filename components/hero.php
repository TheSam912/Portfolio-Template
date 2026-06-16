<?php

/** @var array $content */

?>

<section id="hero" class="hero">

    <div class="hero-left">

        <div
            class="hero-badge"
            data-reveal="fade">

            <?= $content['hero_badge']; ?>

        </div>

        <h1
            class="hero-title"
            data-reveal="up"
            data-reveal-delay="80">

            <?= $content['hero_title_line_1']; ?>

            <br>

            <span class="gradient-text">

                <?= $content['hero_title_line_2']; ?>

            </span>

            <br>

            <?= $content['hero_title_line_3']; ?>

        </h1>

        <p
            class="hero-description"
            data-reveal="up"
            data-reveal-delay="180">

            <?= $content['hero_description']; ?>

        </p>

        <div
            class="hero-buttons"
            data-reveal="up"
            data-reveal-delay="280">

            <a
                href="#portfolio"
                class="hero-btn-primary"
                data-magnetic>

                <?= $content['hero_btn_primary']; ?>

            </a>

            <a
                href="assets/files/Sobhan-Resume.pdf"
                class="hero-btn-secondary"
                download>

                <?= $content['hero_btn_secondary']; ?>

            </a>

        </div>

    </div>

    <div
        class="hero-right"
        data-reveal="scale"
        data-reveal-delay="200">

        <img
            src="assets/images/hero.webp"
            alt="Sobhan (Sam) Nolan"
            fetchpriority="high"
            decoding="async"
            width="600"
            height="600">

    </div>

</section>
