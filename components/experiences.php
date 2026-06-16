<?php

/** @var list<array<string, mixed>> $experiences */

?>

<section id="experience" class="experience-section">

    <div
        class="experience-head"
        data-reveal="up">

        <span class="section-tag">

            <span class="tag-dot"></span>

            <?= e(setting('experience_tag', 'EXPERIENCE')); ?>

        </span>

        <h2 class="experience-title">

            <?= e(setting('experience_title_line_1', 'Professional')); ?>

            <span class="gradient-text"><?= e(setting('experience_title_line_2', 'Journey.')); ?></span>

        </h2>

    </div>

    <div class="timeline">

        <?php foreach ($experiences as $i => $experience): ?>

            <div
                class="timeline-item"
                data-reveal="<?= $i % 2 === 0 ? 'left' : 'right'; ?>"
                data-reveal-delay="<?= $i * 80; ?>">

                <div class="timeline-dot"></div>

                <div class="timeline-card">

                    <span class="experience-date">
                        <?= e($experience['date_range']); ?>
                    </span>

                    <h3><?= e($experience['position']); ?></h3>

                    <h4><?= e($experience['company']); ?></h4>

                    <?php if (!empty($experience['items'])): ?>
                        <ul>
                            <?php foreach ($experience['items'] as $item): ?>
                                <li><?= e($item); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>

                </div>

            </div>

        <?php endforeach; ?>

    </div>

</section>
