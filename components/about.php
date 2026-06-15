<?php

/** @var array $content */

?>

<section id="about" class="about-section">

    <div class="about-wrapper">

        <!-- LEFT -->

        <div class="about-left">

            <div class="section-tag">

                <span class="tag-dot"></span>

                <?= $content['about_tag']; ?>

            </div>

            <h2 class="about-title">

                <?= $content['about_title_line_1']; ?>

                <span>

                    <?= $content['about_title_line_2']; ?>

                </span>

                <?= $content['about_title_line_3']; ?>

            </h2>

            <p class="about-text">

                <?= nl2br($content['about_description']); ?>

            </p>

        </div>

        <!-- RIGHT -->

        <div class="about-right">

            <div class="info-card">

                <div class="info-item">

                    <i class="fa-solid fa-user"></i>

                    <div>

                        <span>

                            <?= $content['about_name_label']; ?>

                        </span>

                        <h4>

                            <?= $content['about_name_value']; ?>

                        </h4>

                    </div>

                </div>

                <div class="info-item">

                    <i class="fa-solid fa-envelope"></i>

                    <div>

                        <span>

                            <?= $content['about_email_label']; ?>

                        </span>

                        <h4>

                            <a href="mailto:<?= $content['about_email_value']; ?>">

                                <?= $content['about_email_value']; ?>

                            </a>

                        </h4>

                    </div>

                </div>

                <div class="info-item">

                    <i class="fa-solid fa-graduation-cap"></i>

                    <div>

                        <span>

                            <?= $content['about_degree_label']; ?>

                        </span>

                        <h4>

                            <?= $content['about_degree_value']; ?>

                        </h4>

                    </div>

                </div>

                <div class="info-item">

                    <i class="fa-solid fa-earth-americas"></i>

                    <div>

                        <span>

                            <?= $content['about_location_label']; ?>

                        </span>

                        <h4>

                            <?= $content['about_location_value']; ?>

                        </h4>

                    </div>

                </div>

                <div class="info-item">

                    <i class="fa-solid fa-briefcase"></i>

                    <div>

                        <span>

                            <?= $content['about_availability_label']; ?>

                        </span>

                        <h4>

                            <?= $content['about_availability_value']; ?>

                        </h4>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>