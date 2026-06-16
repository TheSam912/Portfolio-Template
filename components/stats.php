<?php

/** @var list<array<string, mixed>> $stats */

?>

<section class="stats-section">

    <div
        class="stats-wrapper"
        data-reveal-stagger>

        <?php foreach ($stats as $stat): ?>

            <div class="stats-item" data-reveal="up">

                <div class="stats-icon">
                    <i class="<?= e($stat['icon_class']); ?>"></i>
                </div>

                <div class="stats-content">
                    <h3><?= e($stat['count_value']); ?></h3>
                    <p><?= e($stat['label_text']); ?></p>
                </div>

            </div>

        <?php endforeach; ?>

    </div>

</section>
