<?php

/** @var array $content */

?>

<section class="stats-section">

    <div class="stats-wrapper">

        <!-- ITEM -->

        <div class="stats-item">

            <div class="stats-icon">
                <i class="fa-solid fa-code"></i>
            </div>

            <div class="stats-content">

                <h3><?= $content['stats_projects_count']; ?></h3>

                <p><?= $content['stats_projects_text']; ?></p>

            </div>

        </div>

        <!-- ITEM -->

        <div class="stats-item">

            <div class="stats-icon">
                <i class="fa-solid fa-star"></i>
            </div>

            <div class="stats-content">

                <h3><?= $content['stats_satisfaction_count']; ?></h3>

                <p><?= $content['stats_satisfaction_text']; ?></p>

            </div>

        </div>

        <!-- ITEM -->

        <div class="stats-item">

            <div class="stats-icon">
                <i class="fa-solid fa-users"></i>
            </div>

            <div class="stats-content">

                <h3><?= $content['stats_clients_count']; ?></h3>

                <p><?= $content['stats_clients_text']; ?></p>

            </div>

        </div>

        <!-- ITEM -->

        <div class="stats-item">

            <div class="stats-icon">
                <i class="fa-solid fa-briefcase"></i>
            </div>

            <div class="stats-content">

                <h3><?= $content['stats_experience_count']; ?></h3>

                <p><?= $content['stats_experience_text']; ?></p>

            </div>

        </div>

    </div>

</section>