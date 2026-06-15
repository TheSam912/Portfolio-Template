<?php

/** @var array $content */

?>

<section id="hero" class="hero">

    <div class="hero-left">

        <div class="hero-badge">

            <?= $content['hero_badge']; ?>

        </div>

        <h1 class="hero-title">

            <?= $content['hero_title_line_1']; ?>

            <br>

            <span>

                <?= $content['hero_title_line_2']; ?>

            </span>

            <br>

            <?= $content['hero_title_line_3']; ?>

        </h1>

        <p class="hero-description">

            <?= $content['hero_description']; ?>

        </p>

        <div class="hero-buttons">

            <a
                href="#portfolio"
                class="hero-btn-primary">

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

    <div class="hero-right">

        <img
            src="assets/images/hero.webp"
            alt="Hero Image">

    </div>

</section>