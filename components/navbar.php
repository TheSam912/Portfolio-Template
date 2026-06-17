<nav class="navbar">

    <div class="logo">
        <a href="#hero">
            <img src="<?= e(setting('text_logo_image')); ?>" alt="Logo">
        </a>
    </div>

    <ul class="nav-links">
        <li><a href="#hero" class="active">Home</a></li>
        <li><a href="#about">About</a></li>
        <li><a href="#services">Services</a></li>
        <li><a href="#skills">Skills</a></li>
        <li><a href="#experience">Experience</a></li>
        <li><a href="#portfolio">Portfolio</a></li>
        <li><a href="#contact">Contact</a></li>
    </ul>

    <a href="#contact" class="talk-btn" data-magnetic>
        <?= e(setting('navbar_cta_text')); ?>
    </a>

    <button class="menu-toggle" aria-label="Open menu">
        <span></span><span></span><span></span>
    </button>

</nav>

<div class="nav-overlay"></div>

<div class="mobile-menu">
    <button class="menu-close" aria-label="Close menu">
        <i class="fa-solid fa-xmark"></i>
    </button>
    <a href="#hero">Home</a>
    <a href="#about">About</a>
    <a href="#services">Services</a>
    <a href="#skills">Skills</a>
    <a href="#experience">Experience</a>
    <a href="#portfolio">Portfolio</a>
    <a href="#contact">Contact</a>
    <a href="#contact" class="mobile-talk-btn"><?= e(setting('navbar_cta_text')); ?></a>
</div>
