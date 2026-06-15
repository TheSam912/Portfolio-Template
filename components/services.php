<?php

/** @var array $content */

?>

<section id="services" class="services-section">

    <div class="services-head">

        <span class="section-tag">

            <span class="tag-dot"></span>

            <?= $content['services_tag']; ?>

        </span>

        <h2 class="services-title">

            <?= $content['services_title_line_1']; ?>

            <span>

                <?= $content['services_title_line_2']; ?>

            </span>

        </h2>

    </div>

    <div class="services-grid">

        <!-- CARD 1 -->

        <div class="service-card">

            <div class="service-top">

                <div class="service-icon">

                    <i class="fa-solid fa-mobile-screen"></i>

                </div>

                <h3>

                    <?= $content['service_1_title']; ?>

                </h3>

            </div>

            <p>

                <?= $content['service_1_description']; ?>

            </p>

        </div>

        <!-- CARD 2 -->

        <div class="service-card">

            <div class="service-top">

                <div class="service-icon">

                    <i class="fa-solid fa-code"></i>

                </div>

                <h3>

                    <?= $content['service_2_title']; ?>

                </h3>

            </div>

            <p>

                <?= $content['service_2_description']; ?>

            </p>

        </div>

        <!-- CARD 3 -->

        <div class="service-card">

            <div class="service-top">

                <div class="service-icon">

                    <i class="fa-solid fa-database"></i>

                </div>

                <h3>

                    <?= $content['service_3_title']; ?>

                </h3>

            </div>

            <p>

                <?= $content['service_3_description']; ?>

            </p>

        </div>

        <!-- CARD 4 -->

        <div class="service-card">

            <div class="service-top">

                <div class="service-icon">

                    <i class="fa-solid fa-gears"></i>

                </div>

                <h3>

                    <?= $content['service_4_title']; ?>

                </h3>

            </div>

            <p>

                <?= $content['service_4_description']; ?>

            </p>

        </div>

    </div>

</section>