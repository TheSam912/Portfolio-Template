<?php

/** @var list<array<string, mixed>> $services */

?>

<section id="services" class="services-section">

    <div
        class="services-head"
        data-reveal="up">

        <span class="section-tag">

            <span class="tag-dot"></span>

            <?= e(setting('services_tag')); ?>

        </span>

        <h2 class="services-title">

            <?= e(setting('services_title_line_1')); ?>

            <span class="gradient-text">

                <?= e(setting('services_title_line_2')); ?>

            </span>

        </h2>

    </div>

    <div
        class="services-grid"
        data-reveal-stagger
        data-reveal="fade">

        <?php foreach ($services as $service): ?>

            <div class="service-card">

                <div class="service-top">

                    <div class="service-icon">
                        <i class="<?= e($service['icon_class']); ?>"></i>
                    </div>

                    <h3><?= e($service['title']); ?></h3>

                </div>

                <p><?= e($service['description']); ?></p>

            </div>

        <?php endforeach; ?>

    </div>

</section>
