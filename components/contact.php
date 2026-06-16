<section id="contact" class="contact-section">

    <div class="contact-wrapper">

        <div class="contact-form" data-reveal="left">

            <span class="section-tag">
                <span class="tag-dot"></span>
                <?= e(setting('contact_tag')); ?>
            </span>

            <h2 class="contact-title">
                <?= e(setting('contact_title_line_1')); ?>
                <span class="gradient-text"><?= e(setting('contact_title_line_2')); ?></span>
            </h2>

            <form id="contactForm" action="api/contact.php" method="POST" novalidate>

                <input type="text" name="_hp" tabindex="-1" autocomplete="off"
                    style="position:absolute;left:-9999px;width:1px;height:1px;opacity:0;" aria-hidden="true">

                <div class="input-box">
                    <i class="fa-regular fa-user"></i>
                    <input type="text" name="name"
                        placeholder="<?= e(setting('contact_name_placeholder')); ?>"
                        maxlength="255" required>
                </div>

                <div class="input-box">
                    <i class="fa-regular fa-envelope"></i>
                    <input type="email" name="email"
                        placeholder="<?= e(setting('contact_email_placeholder')); ?>" required>
                </div>

                <div class="input-box textarea-box">
                    <i class="fa-regular fa-message"></i>
                    <textarea name="message"
                        placeholder="<?= e(setting('contact_message_placeholder')); ?>" required></textarea>
                </div>

                <button type="submit" class="primary-btn" data-magnetic>
                    <?= e(setting('contact_button')); ?>
                </button>

            </form>

        </div>

        <div class="contact-info" data-reveal="right" data-reveal-delay="120">

            <span class="section-tag">
                <span class="tag-dot"></span>
                <?= e(setting('contact_info_tag')); ?>
            </span>

            <div class="contact-links">

                <a href="mailto:<?= e(setting('contact_email')); ?>" class="contact-link">
                    <i class="fa-regular fa-envelope"></i>
                    <span><?= e(setting('contact_email')); ?></span>
                </a>

                <a href="<?= e(setting('contact_linkedin')); ?>" target="_blank" rel="noopener noreferrer" class="contact-link">
                    <i class="fa-brands fa-linkedin-in"></i>
                    <span><?= e(setting('contact_linkedin_text')); ?></span>
                </a>

                <a href="<?= e(setting('contact_github')); ?>" target="_blank" rel="noopener noreferrer" class="contact-link">
                    <i class="fa-brands fa-github"></i>
                    <span><?= e(setting('contact_github_text')); ?></span>
                </a>

                <div class="contact-link">
                    <i class="fa-solid fa-location-dot"></i>
                    <span><?= e(setting('contact_location')); ?></span>
                </div>

            </div>

        </div>

    </div>

</section>
