<?php

/** @var array $content */

?>

<section id="experience" class="experience-section">

    <div class="experience-head">

        <span class="section-tag">

            <span class="tag-dot"></span>

            EXPERIENCE

        </span>

        <h2 class="experience-title">

            Professional

            <span>Journey.</span>

        </h2>

    </div>

    <div class="timeline">

        <?php foreach($content['experiences'] as $experience): ?>

            <div class="timeline-item">

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

                        <?php foreach($experience['items'] as $item): ?>

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