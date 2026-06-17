<?php

/** @var array $content */
/** @var array $profile */

?>

<section class="stats-section">

    <div class="stats-wrapper" data-reveal-stagger>

        <div class="stats-item" data-reveal="up">
            <div class="stats-icon"><i class="fa-solid fa-code"></i></div>
            <div class="stats-content">
                <h3><?= e(setting('stats_projects_count')); ?></h3>
                <p><?= e(setting('stats_projects_text')); ?></p>
            </div>
        </div>

        <div class="stats-item" data-reveal="up">
            <div class="stats-icon"><i class="fa-solid fa-star"></i></div>
            <div class="stats-content">
                <h3><?= e(setting('stats_satisfaction_count')); ?></h3>
                <p><?= e(setting('stats_satisfaction_text')); ?></p>
            </div>
        </div>

        <div class="stats-item" data-reveal="up">
            <div class="stats-icon"><i class="fa-solid fa-users"></i></div>
            <div class="stats-content">
                <h3><?= e(setting('stats_clients_count')); ?></h3>
                <p><?= e(setting('stats_clients_text')); ?></p>
            </div>
        </div>

        <div class="stats-item" data-reveal="up">
            <div class="stats-icon"><i class="fa-solid fa-briefcase"></i></div>
            <div class="stats-content">
                <h3><?= e(setting('stats_experience_count')); ?></h3>
                <p><?= e(setting('stats_experience_text')); ?></p>
            </div>
        </div>

    </div>

</section>
