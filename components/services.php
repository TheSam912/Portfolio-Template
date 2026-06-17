<?php

/** @var array $content */

?>

<section id="services" class="services-section">

    <div class="services-head" data-reveal="up">

        <span class="section-tag">
            <span class="tag-dot"></span>
            <?= e(setting('services_tag')); ?>
        </span>

        <h2 class="services-title">
            <?= e(setting('services_title_line_1')); ?>
            <span class="gradient-text"><?= e(setting('services_title_line_2')); ?></span>
        </h2>

    </div>

    <div class="services-grid" data-reveal-stagger data-reveal="fade">

        <div class="service-card">
            <div class="service-top">
                <div class="service-icon"><i class="fa-solid fa-mobile-screen"></i></div>
                <h3><?= e(setting('service_1_title')); ?></h3>
            </div>
            <p><?= e(setting('service_1_description')); ?></p>
        </div>

        <div class="service-card">
            <div class="service-top">
                <div class="service-icon"><i class="fa-solid fa-code"></i></div>
                <h3><?= e(setting('service_2_title')); ?></h3>
            </div>
            <p><?= e(setting('service_2_description')); ?></p>
        </div>

        <div class="service-card">
            <div class="service-top">
                <div class="service-icon"><i class="fa-solid fa-database"></i></div>
                <h3><?= e(setting('service_3_title')); ?></h3>
            </div>
            <p><?= e(setting('service_3_description')); ?></p>
        </div>

        <div class="service-card">
            <div class="service-top">
                <div class="service-icon"><i class="fa-solid fa-gears"></i></div>
                <h3><?= e(setting('service_4_title')); ?></h3>
            </div>
            <p><?= e(setting('service_4_description')); ?></p>
        </div>

    </div>

</section>
