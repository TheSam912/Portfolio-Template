<?php

/** @var list<array<string, mixed>> $skills */

$categoryMeta = [
    'mobile' => [
        'label' => 'Mobile',
        'desc'  => 'Cross-platform & native apps',
        'icon'  => 'fa-solid fa-mobile-screen-button',
    ],
    'web' => [
        'label' => 'Web & Backend',
        'desc'  => 'Sites, APIs, and platforms',
        'icon'  => 'fa-solid fa-code',
    ],
    'data' => [
        'label' => 'Data & Cloud',
        'desc'  => 'Storage, infra, and delivery',
        'icon'  => 'fa-solid fa-cloud',
    ],
    'design' => [
        'label' => 'Design & Tools',
        'desc'  => 'UI craft and workflow',
        'icon'  => 'fa-solid fa-pen-ruler',
    ],
];

$skillCategory = static function (string $name): string {
    $n = strtolower($name);

    if (preg_match('/flutter|react native|swift|java|android|ios|kotlin/', $n)) {
        return 'mobile';
    }

    if (preg_match('/mysql|mongodb|sqlite|docker|aws|git|firebase|cloud/', $n)) {
        return 'data';
    }

    if (preg_match('/figma|sketch|adobe|xd|bootstrap/', $n)) {
        return 'design';
    }

    return 'web';
};

$grouped = [
    'mobile' => [],
    'web'    => [],
    'data'   => [],
    'design' => [],
];

foreach ($skills as $skill) {
    $key = $skillCategory((string) ($skill['name'] ?? ''));
    $grouped[$key][] = $skill;
}

$grouped = array_filter($grouped);
$totalSkills = count($skills);

?>

<section id="skills" class="skills-section">

    <div class="skills-head" data-reveal="up">

        <span class="section-tag">
            <span class="tag-dot"></span>
            <?= e(setting('skills_tag', 'TECH STACK')); ?>
        </span>

        <div class="skills-head__row">
            <h2 class="skills-title">
                <?= e(setting('skills_title_line_1', 'A Clear Stack For')); ?>
                <span class="gradient-text"><?= e(setting('skills_title_line_2', 'Shipping Real Products.')); ?></span>
            </h2>

            <p class="skills-lead">
                <?= e(setting(
                    'skills_lead',
                    'Organized by how I actually build — mobile, web, data, and the tools around them.'
                )); ?>
            </p>
        </div>

        <?php if ($totalSkills > 0): ?>
            <div class="skills-head__meta" aria-hidden="true">
                <span class="skills-head__pill">
                    <i class="fa-solid fa-layer-group"></i>
                    <?= (int) $totalSkills; ?> technologies
                </span>
                <span class="skills-head__pill skills-head__pill--soft">
                    <?= (int) count($grouped); ?> focus areas
                </span>
            </div>
        <?php endif; ?>

    </div>

    <?php if ($skills): ?>

        <div class="skills-board" data-reveal-stagger data-reveal="fade">

            <?php $i = 0; foreach ($grouped as $key => $items): ?>
                <?php
                $meta = $categoryMeta[$key] ?? [
                    'label' => ucfirst($key),
                    'desc'  => '',
                    'icon'  => 'fa-solid fa-cube',
                ];
                ?>
                <article class="skills-panel" data-reveal-child style="--i: <?= (int) $i++; ?>">

                    <header class="skills-panel__head">
                        <div class="skills-panel__icon" aria-hidden="true">
                            <i class="<?= e($meta['icon']); ?>"></i>
                        </div>
                        <div class="skills-panel__copy">
                            <h3><?= e($meta['label']); ?></h3>
                            <?php if ($meta['desc'] !== ''): ?>
                                <p><?= e($meta['desc']); ?></p>
                            <?php endif; ?>
                        </div>
                        <span class="skills-panel__count"><?= (int) count($items); ?></span>
                    </header>

                    <ul class="skills-panel__grid">
                        <?php foreach ($items as $skill): ?>
                            <li class="skill-chip">
                                <img
                                    src="<?= e($skill['icon_path']); ?>"
                                    alt=""
                                    loading="lazy"
                                    decoding="async"
                                    width="28"
                                    height="28">
                                <span><?= e($skill['name']); ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>

                </article>
            <?php endforeach; ?>

        </div>

    <?php endif; ?>

</section>
