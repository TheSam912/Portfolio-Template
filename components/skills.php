<?php

$skills = [
    ['name' => 'Flutter',     'icon' => 'flutter.png'],
    ['name' => 'PHP',         'icon' => 'php.png'],
    ['name' => 'Laravel',     'icon' => 'laravel.png'],
    ['name' => 'JavaScript',  'icon' => 'js.png'],
    ['name' => 'HTML',        'icon' => 'html.png'],
    ['name' => 'CSS',         'icon' => 'css.png'],
    ['name' => 'Vue.js',      'icon' => 'vue.png'],
    ['name' => 'Figma',       'icon' => 'figma.png'],
    ['name' => 'Java',        'icon' => 'java.png'],
    ['name' => 'MySQL',       'icon' => 'mysql.png'],
    ['name' => 'MongoDB',     'icon' => 'mongodb.png'],
    ['name' => 'Swift',       'icon' => 'swift.png'],
    ['name' => 'WordPress',   'icon' => 'wordpress.png'],
    ['name' => 'Git',         'icon' => 'git.png'],
    ['name' => 'Docker',      'icon' => 'docker.png'],
    ['name' => 'Node.js',     'icon' => 'nodejs.png'],
    ['name' => 'AWS',         'icon' => 'aws.png'],
    ['name' => 'Bootstrap',   'icon' => 'bootstrap.png'],
];

// Split roughly in half for two opposing rows.
$rowA = array_slice($skills, 0, 9);
$rowB = array_slice($skills, 9);

$render_track = function (array $items): string {
    $tile = static function (array $skill): string {
        return sprintf(
            '<div class="skill-item">'
                . '<img src="assets/images/skills/%s" alt="%s" loading="lazy" decoding="async" width="48" height="48">'
                . '<span>%s</span>'
            . '</div>',
            htmlspecialchars($skill['icon'], ENT_QUOTES),
            htmlspecialchars($skill['name'], ENT_QUOTES),
            htmlspecialchars($skill['name'], ENT_QUOTES)
        );
    };

    $tiles = array_map($tile, $items);
    // Duplicate for seamless loop.
    return implode('', $tiles) . implode('', $tiles);
};

?>

<section id="skills" class="skills-section">

    <div
        class="skills-head"
        data-reveal="up">

        <span class="section-tag">

            <span class="tag-dot"></span>

            TECH STACK

        </span>

        <h2 class="skills-title">

            Technologies I Use To Build

            <span class="gradient-text">Modern Products.</span>

        </h2>

    </div>

    <div
        class="skills-marquee"
        data-reveal="fade">

        <div class="skills-track">
            <?= $render_track($rowA); ?>
        </div>

        <div class="skills-track skills-track--reverse">
            <?= $render_track($rowB); ?>
        </div>

    </div>

</section>
