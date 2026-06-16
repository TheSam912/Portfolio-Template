<?php

/** @var array $content */

?>

<section id="experience" class="experience-section">

    <div
        class="experience-head"
        data-reveal="up">

        <span class="section-tag">

            <span class="tag-dot"></span>

            EXPERIENCE

        </span>

        <h2 class="experience-title">

            Professional

            <span class="gradient-text">Journey.</span>

        </h2>

    </div>

    <div class="timeline">

        <?php foreach ($content['experiences'] as $i => $experience): ?>

            <div
                class="timeline-item"
                data-reveal="<?= $i % 2 === 0 ? 'left' : 'right'; ?>"
                data-reveal-delay="<?= $i * 80; ?>">

                <div class="timeline-dot"></div>

                <div class="timeline-card">

                    <span class="experience-date">
                        <?= $experience['date']; ?>
                    </span>

                    <h3>
                        <?= $experience['position']; ?>
                    </h3>

                    <h4>
                        <?= $experience['company']; ?>
                    </h4>

                    <ul>
                        <?php foreach ($experience['items'] as $item): ?>
                            <li>
                                <?= $item; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>

                </div>

            </div>

        <?php endforeach; ?>

    </div>

</section>
