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

            <form
                id="contactForm"
                action="<?= defined('STATIC_BUILD') ? '#' : 'api/contact.php'; ?>"
                method="POST"
                novalidate
                <?php if (defined('STATIC_BUILD')): ?>data-static-site="1" <?php endif; ?>
                data-web3forms-key="<?= e(env('WEB3FORMS_ACCESS_KEY', '')); ?>">

                <input type="text" name="_hp" tabindex="-1" autocomplete="off"
                    style="position:absolute;left:-9999px;width:1px;height:1px;opacity:0;" aria-hidden="true">

                <p class="form-feedback" id="contactFormFeedback" role="alert" hidden></p>

                <div class="input-box">
                    <i class="fa-regular fa-user"></i>
                    <input type="text" id="contactName" name="name"
                        placeholder="<?= e(setting('contact_name_placeholder')); ?>"
                        maxlength="255" required autocomplete="name">
                </div>

                <div class="input-box">
                    <i class="fa-regular fa-envelope"></i>
                    <input type="email" id="contactEmail" name="email"
                        placeholder="<?= e(setting('contact_email_placeholder')); ?>"
                        maxlength="255" required autocomplete="email">
                </div>

                <div class="input-box textarea-box">
                    <i class="fa-regular fa-message"></i>
                    <textarea id="contactMessage" name="message"
                        placeholder="<?= e(setting('contact_message_placeholder')); ?>"
                        maxlength="5000" required></textarea>
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

                <a href="mailto:<?= e(profile('contact_email')); ?>" class="contact-link">
                    <i class="fa-regular fa-envelope"></i>
                    <span><?= e(profile('contact_email')); ?></span>
                </a>

                <a href="<?= e(profile('contact_linkedin')); ?>" target="_blank" rel="noopener noreferrer" class="contact-link">
                    <i class="fa-brands fa-linkedin-in"></i>
                    <span><?= e(profile('contact_linkedin_text')); ?></span>
                </a>

                <a href="<?= e(profile('contact_github')); ?>" target="_blank" rel="noopener noreferrer" class="contact-link">
                    <i class="fa-brands fa-github"></i>
                    <span><?= e(profile('contact_github_text')); ?></span>
                </a>

                <div class="contact-link">
                    <i class="fa-solid fa-location-dot"></i>
                    <span><?= e(profile('contact_location')); ?></span>
                </div>

            </div>

        </div>

    </div>

</section>
