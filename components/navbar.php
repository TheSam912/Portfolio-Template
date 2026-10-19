<?php
$navItems = [
    ['href' => '#hero',       'label' => 'Home',       'active' => true],
    ['href' => '#about',      'label' => 'About'],
    ['href' => '#services',   'label' => 'Services'],
    ['href' => '#skills',     'label' => 'Skills'],
    ['href' => '#experience', 'label' => 'Experience'],
    ['href' => '#education',  'label' => 'Education'],
    ['href' => '#live',       'label' => 'Live'],
    ['href' => '#portfolio',  'label' => 'Projects'],
    ['href' => '#contact',    'label' => 'Contact'],
];
$ctaText = setting('navbar_cta_text', 'Get In Touch');
$statusText = setting('about_availability_value', 'Available For Projects');
?>

<div class="nav-shell">
    <nav class="navbar" aria-label="Primary">

        <a class="logo" href="#hero" aria-label="Home">
            <img src="<?= e(setting('text_logo_image')); ?>" alt="The Sam">
        </a>

        <ul class="nav-links">
            <?php foreach ($navItems as $item): ?>
                <li>
                    <a
                        href="<?= e($item['href']); ?>"
                        <?= !empty($item['active']) ? 'class="active"' : ''; ?>
                    ><?= e($item['label']); ?></a>
                </li>
            <?php endforeach; ?>
        </ul>

        <div class="nav-actions">
            <span class="nav-status" title="<?= e($statusText); ?>">
                <span class="nav-status__dot" aria-hidden="true"></span>
                <span class="nav-status__text">Available</span>
            </span>

            <a href="#contact" class="talk-btn" data-magnetic>
                <span><?= e($ctaText); ?></span>
                <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
            </a>

            <button class="menu-toggle" type="button" aria-label="Open menu" aria-expanded="false">
                <span></span><span></span><span></span>
            </button>
        </div>

    </nav>
</div>

<div class="nav-overlay"></div>

<div class="mobile-menu" id="mobile-menu">
    <div class="mobile-menu__head">
        <div class="mobile-menu__brand">
            <img src="<?= e(setting('text_logo_image')); ?>" alt="">
            <span class="nav-status nav-status--menu">
                <span class="nav-status__dot" aria-hidden="true"></span>
                Available
            </span>
        </div>
        <button class="menu-close" type="button" aria-label="Close menu">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>

    <nav class="mobile-menu__nav" aria-label="Mobile">
        <?php foreach ($navItems as $i => $item): ?>
            <a href="<?= e($item['href']); ?>">
                <span class="mobile-menu__idx"><?= str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT); ?></span>
                <span class="mobile-menu__label"><?= e($item['label']); ?></span>
            </a>
        <?php endforeach; ?>
    </nav>

    <div class="mobile-menu__foot">
        <a href="#contact" class="mobile-talk-btn">
            <span><?= e($ctaText); ?></span>
            <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
        </a>
    </div>
</div>
