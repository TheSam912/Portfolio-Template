<?php

$education = [
    [
        'degree'  => "Master of Cybersecurity",
        'school'  => 'University of Padua, Italy',
        'dates'   => '2022 — 2025',
        'icon'    => 'fa-solid fa-graduation-cap',
    ],
    [
        'degree'  => 'Bachelor of Computer Software Engineering',
        'school'  => 'Sadjad University of Technology, Mashhad, Iran',
        'dates'   => '2016 — 2021',
        'icon'    => 'fa-solid fa-building-columns',
    ],
];

?>

<section id="education" class="education-section">

    <div class="education-head" data-reveal="up">
        <span class="section-tag">
            <span class="tag-dot"></span>
            <?= e(setting('education_tag', 'EDUCATION')); ?>
        </span>

        <h2 class="education-title">
            <?= e(setting('education_title_line_1', 'Academic')); ?>
            <span class="gradient-text"><?= e(setting('education_title_line_2', 'Background.')); ?></span>
        </h2>
    </div>

    <div class="education-grid">
        <?php foreach ($education as $item): ?>
            <article class="education-card">
                <div class="education-card__icon" aria-hidden="true">
                    <i class="<?= e($item['icon']); ?>"></i>
                </div>
                <div class="education-card__body">
                    <p class="education-card__dates"><?= e($item['dates']); ?></p>
                    <h3><?= e($item['degree']); ?></h3>
                    <p><?= e($item['school']); ?></p>
                </div>
            </article>
        <?php endforeach; ?>
    </div>

</section>
