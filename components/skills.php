<?php

$skillGroups = require __DIR__ . '/../config/core-skills.php';
if (!is_array($skillGroups)) {
    $skillGroups = [];
}

$skillGroups = array_values(array_filter(
    $skillGroups,
    static fn ($group): bool => is_array($group) && !empty($group['items'])
));

$totalSkills = 0;
foreach ($skillGroups as $group) {
    $totalSkills += count($group['items']);
}

$renderIcon = static function (array $item): string {
    $icon = trim((string) ($item['icon'] ?? ''));
    $name = e((string) ($item['name'] ?? ''));

    if (str_starts_with($icon, 'fa:')) {
        $fa = e(substr($icon, 3));

        return '<span class="skill-chip__fa" aria-hidden="true"><i class="' . $fa . '"></i></span>';
    }

    if ($icon !== '') {
        return '<img src="' . e($icon) . '" alt="" loading="lazy" decoding="async" width="28" height="28">';
    }

    return '<span class="skill-chip__fa" aria-hidden="true"><i class="fa-solid fa-circle-nodes"></i></span>';
};

?>

<section id="skills" class="skills-section">

    <div class="skills-head" data-reveal="up">

        <span class="section-tag">
            <span class="tag-dot"></span>
            <?= e(setting('skills_tag', 'TECH STACK')); ?>
        </span>

        <div class="skills-head__row">
            <h2 class="skills-title">
                <?= e(setting('skills_title_line_1', 'Technologies And')); ?>
                <span class="gradient-text"><?= e(setting('skills_title_line_2', 'Specializations.')); ?></span>
            </h2>

            <p class="skills-lead">
                <?= e(setting(
                    'skills_lead',
                    'The same core skills listed on my resume — mobile, web & backend, SEO & GEO, AI, and tools & cloud.'
                )); ?>
            </p>
        </div>

        <?php if ($totalSkills > 0): ?>
            <div class="skills-head__meta" aria-hidden="true">
                <span class="skills-head__pill">
                    <i class="fa-solid fa-layer-group"></i>
                    <?= (int) $totalSkills; ?> skills
                </span>
                <span class="skills-head__pill skills-head__pill--soft">
                    <?= (int) count($skillGroups); ?> resume categories
                </span>
            </div>
        <?php endif; ?>

    </div>

    <?php if ($skillGroups): ?>

        <div class="skills-board">

            <?php foreach ($skillGroups as $group): ?>
                <article class="skills-panel">

                    <header class="skills-panel__head">
                        <div class="skills-panel__icon" aria-hidden="true">
                            <i class="<?= e((string) ($group['icon'] ?? 'fa-solid fa-cube')); ?>"></i>
                        </div>
                        <div class="skills-panel__copy">
                            <h3><?= e((string) ($group['label'] ?? '')); ?></h3>
                            <?php if (!empty($group['desc'])): ?>
                                <p><?= e((string) $group['desc']); ?></p>
                            <?php endif; ?>
                        </div>
                        <span class="skills-panel__count"><?= (int) count($group['items']); ?></span>
                    </header>

                    <ul class="skills-panel__grid">
                        <?php foreach ($group['items'] as $item): ?>
                            <li class="skill-chip">
                                <?= $renderIcon($item); ?>
                                <span><?= e((string) ($item['name'] ?? '')); ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>

                </article>
            <?php endforeach; ?>

        </div>

    <?php endif; ?>

</section>
