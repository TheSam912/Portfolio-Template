<section class="footer-wave">
    <img
        src="<?= e(setting('footer_wave_image')); ?>"
        alt="Footer Wave"
        loading="lazy"
        decoding="async"
        width="1920"
        height="200">
</section>

<footer class="footer-section" data-reveal="up">

    <div class="footer-wrapper">

        <a href="#hero" class="footer-logo">
            <img src="<?= e(setting('logo_image')); ?>" alt="Sam Nolan Logo">
        </a>

        <div class="footer-copy">
            <?= e(setting('footer_copyright')); ?>
        </div>

        <div class="footer-socials">
            <a href="<?= e(setting('footer_github')); ?>" target="_blank" rel="noopener noreferrer">
                <i class="fa-brands fa-github"></i>
            </a>
            <a href="<?= e(setting('footer_linkedin')); ?>" target="_blank" rel="noopener noreferrer">
                <i class="fa-brands fa-linkedin-in"></i>
            </a>
            <a href="mailto:<?= e(setting('footer_email')); ?>">
                <i class="fa-solid fa-envelope"></i>
            </a>
        </div>

    </div>

</footer>
