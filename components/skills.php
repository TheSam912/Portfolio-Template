<?php

/** @var list<array<string, mixed>> $skills */

$half     = (int) ceil(count($skills) / 2);
$rowA     = array_slice($skills, 0, $half);
$rowB     = array_slice($skills, $half);

$render_tile = static function (array $skill): string {
    return sprintf(
        '<div class="skill-item">'
            . '<img src="%s" alt="%s" loading="lazy" decoding="async" width="48" height="48">'
            . '<span>%s</span>'
        . '</div>',
        e($skill['icon_path']),
        e($skill['name']),
        e($skill['name'])
    );
};

$render_track = static function (array $items) use ($render_tile): string {
    if (!$items) {
        return '';
    }

    $tiles = array_map($render_tile, $items);

    return implode('', $tiles) . implode('', $tiles);
};

?>

<section id="skills" class="skills-section">

    <div
        class="skills-head"
        data-reveal="up">

        <span class="section-tag">

            <span class="tag-dot"></span>

            <?= e(setting('skills_tag', 'TECH STACK')); ?>

        </span>

        <h2 class="skills-title">

            <?= e(setting('skills_title_line_1', 'Technologies I Use To Build')); ?>

            <span class="gradient-text"><?= e(setting('skills_title_line_2', 'Modern Products.')); ?></span>

        </h2>

    </div>

    <?php if ($skills): ?>

        <div
            class="skills-marquee"
            data-reveal="fade">

            <?php if ($rowA): ?>
                <div class="skills-track"><?= $render_track($rowA); ?></div>
            <?php endif; ?>

            <?php if ($rowB): ?>
                <div class="skills-track skills-track--reverse"><?= $render_track($rowB); ?></div>
            <?php endif; ?>

        </div>

    <?php endif; ?>

</section>
