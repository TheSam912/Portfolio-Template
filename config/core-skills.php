<?php

/**
 * Core skills — mirrored from the resume.
 * icon: image path under assets/, or "fa:..." for Font Awesome.
 */
return [

    [
        'key'   => 'mobile',
        'label' => 'Mobile Development',
        'desc'  => 'Cross-platform and native app delivery',
        'icon'  => 'fa-solid fa-mobile-screen-button',
        'items' => [
            ['name' => 'Flutter', 'icon' => 'assets/images/skills/flutter.png'],
            ['name' => 'React Native', 'icon' => 'fa:fa-brands fa-react'],
            ['name' => 'Android / iOS', 'icon' => 'fa:fa-brands fa-apple'],
            ['name' => 'BLoC / Riverpod', 'icon' => 'assets/images/skills/flutter.png'],
            ['name' => 'Dio / Chopper / GraphQL', 'icon' => 'fa:fa-solid fa-network-wired'],
            ['name' => 'Firebase', 'icon' => 'fa:fa-solid fa-fire'],
            ['name' => 'Clean Architecture', 'icon' => 'fa:fa-solid fa-sitemap'],
        ],
    ],

    [
        'key'   => 'web',
        'label' => 'Web & Backend',
        'desc'  => 'Platforms, APIs, and production backends',
        'icon'  => 'fa-solid fa-code',
        'items' => [
            ['name' => 'Laravel (PHP, Nova)', 'icon' => 'assets/images/skills/laravel.png'],
            ['name' => 'Vue.js', 'icon' => 'assets/images/skills/vue.png'],
            ['name' => 'Next.js', 'icon' => 'fa:fa-solid fa-n'],
            ['name' => 'TypeScript', 'icon' => 'assets/images/skills/js.png'],
            ['name' => 'Tailwind CSS', 'icon' => 'assets/images/skills/css.png'],
            ['name' => 'Node.js / Express', 'icon' => 'assets/images/skills/nodejs.png'],
            ['name' => 'RESTful APIs', 'icon' => 'fa:fa-solid fa-server'],
            ['name' => 'SQL & NoSQL', 'icon' => 'assets/images/skills/mysql.png'],
            ['name' => 'MongoDB / SQLite', 'icon' => 'assets/images/skills/mongodb.png'],
            ['name' => 'Docker', 'icon' => 'assets/images/skills/docker.png'],
        ],
    ],

    [
        'key'   => 'seo',
        'label' => 'SEO & GEO',
        'desc'  => 'Search visibility and AI answer engines',
        'icon'  => 'fa-solid fa-magnifying-glass-chart',
        'items' => [
            ['name' => 'Technical SEO Audits', 'icon' => 'fa:fa-solid fa-clipboard-check'],
            ['name' => 'On-page & Content SEO', 'icon' => 'fa:fa-solid fa-file-lines'],
            ['name' => 'Schema / Structured Data', 'icon' => 'fa:fa-solid fa-code'],
            ['name' => 'Core Web Vitals', 'icon' => 'fa:fa-solid fa-gauge-high'],
            ['name' => 'GEO for AI / LLM Answers', 'icon' => 'fa:fa-solid fa-robot'],
        ],
    ],

    [
        'key'   => 'ai',
        'label' => 'AI & Automation',
        'desc'  => 'Intelligent systems and workflow leverage',
        'icon'  => 'fa-solid fa-microchip',
        'items' => [
            ['name' => 'AI System Management', 'icon' => 'fa:fa-solid fa-brain'],
            ['name' => 'OpenAI API', 'icon' => 'fa:fa-solid fa-wand-magic-sparkles'],
            ['name' => 'Google ML Kit', 'icon' => 'fa:fa-brands fa-google'],
            ['name' => 'Workflow Automation', 'icon' => 'fa:fa-solid fa-gears'],
        ],
    ],

    [
        'key'   => 'tools',
        'label' => 'Tools & Cloud',
        'desc'  => 'Delivery, cloud, and design workflow',
        'icon'  => 'fa-solid fa-cloud',
        'items' => [
            ['name' => 'Git / GitHub / GitLab', 'icon' => 'assets/images/skills/git.png'],
            ['name' => 'Google Cloud', 'icon' => 'fa:fa-brands fa-google'],
            ['name' => 'AWS', 'icon' => 'assets/images/skills/aws.png'],
            ['name' => 'CI / CD', 'icon' => 'fa:fa-solid fa-rocket'],
            ['name' => 'Figma / Adobe XD / Sketch', 'icon' => 'assets/images/skills/figma.png'],
        ],
    ],

];
