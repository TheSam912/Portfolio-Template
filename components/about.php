<?php

/** @var array $content */

?>

<section id="about" class="about-section">

    <div class="about-wrapper">

        <!-- LEFT -->

        <div
            class="about-left"
            data-reveal="left">

            <div class="section-tag">

                <span class="tag-dot"></span>

                <?= e(setting('about_tag')); ?>

            </div>

            <h2 class="about-title">

                <?= e(setting('about_title_line_1')); ?>

                <span class="gradient-text">

                    <?= e(setting('about_title_line_2')); ?>

                </span>

                <?= e(setting('about_title_line_3')); ?>

            </h2>

            <p class="about-text">

                <?= nl2br(e(setting('about_description'))); ?>

            </p>

        </div>

        <!-- RIGHT -->

        <div
            class="about-right"
            data-reveal="right"
            data-reveal-delay="120">

            <div class="info-card">

                <div class="info-item">

                    <i class="fa-solid fa-user"></i>

                    <div>

                        <span>

                            <?= e(setting('about_name_label')); ?>

                        </span>

                        <h4>

                            <?= e(setting('about_name_value')); ?>

                        </h4>

                    </div>

                </div>

                <div class="info-item">

                    <i class="fa-solid fa-envelope"></i>

                    <div>

                        <span>

                            <?= e(setting('about_email_label')); ?>

                        </span>

                        <h4>

                            <a href="mailto:<?= e(setting('about_email_value')); ?>">

                                <?= e(setting('about_email_value')); ?>

                            </a>

                        </h4>

                    </div>

                </div>

                <div class="info-item">

                    <i class="fa-solid fa-graduation-cap"></i>

                    <div>

                        <span>

                            <?= e(setting('about_degree_label')); ?>

                        </span>

                        <h4>

                            <?= e(setting('about_degree_value')); ?>

                        </h4>

                    </div>

                </div>

                <div class="info-item">

                    <i class="fa-solid fa-earth-americas"></i>

                    <div>

                        <span>

                            <?= e(setting('about_location_label')); ?>

                        </span>

                        <h4>

                            <?= e(setting('about_location_value')); ?>

                        </h4>

                    </div>

                </div>

                <div class="info-item">

                    <i class="fa-solid fa-briefcase"></i>

                    <div>

                        <span>

                            <?= e(setting('about_availability_label')); ?>

                        </span>

                        <h4>

                            <?= e(setting('about_availability_value')); ?>

                        </h4>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>