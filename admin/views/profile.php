<?php
$title    = 'Profile & Contact';
$subtitle = 'Hero summary, about bio, CV, and contact links — with a live preview of what visitors see.';
require __DIR__ . '/partials/page-header.php';
?>

<div class="editor-layout">
    <div class="editor-form">
        <form method="post" action="<?= e(admin_url('profile')); ?>" enctype="multipart/form-data" class="panel">
            <div class="panel__head">
                <h2>Update profile</h2>
            </div>

            <input type="hidden" name="_csrf" value="<?= e(csrf_token()); ?>">

            <div class="form-grid">
                <div class="form-section">
                    <p class="form-section__title"><i class="fa-solid fa-quote-left"></i> Summary</p>
                    <div class="field">
                        <label for="short_summary">Short summary (hero)</label>
                        <textarea id="short_summary" name="short_summary" rows="3" required><?= e($profile['short_summary'] ?? ''); ?></textarea>
                    </div>
                    <div class="field">
                        <label for="about_summary">About bio</label>
                        <textarea id="about_summary" name="about_summary" rows="6" required><?= e($profile['about_summary'] ?? ''); ?></textarea>
                    </div>
                </div>

                <div class="form-section">
                    <p class="form-section__title"><i class="fa-solid fa-file-pdf"></i> CV / Resume</p>
                    <div class="field">
                        <label for="resume_file">Current file path</label>
                        <input id="resume_file" type="text" name="resume_file" value="<?= e($profile['resume_file'] ?? ''); ?>" placeholder="assets/files/Sobhan-Resume.pdf">
                    </div>
                    <div class="field">
                        <label>Or upload new PDF</label>
                        <div class="file-drop">
                            <input type="file" name="resume_upload" accept="application/pdf">
                            <p class="file-name field-hint">No file chosen</p>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <p class="form-section__title"><i class="fa-solid fa-address-book"></i> Contact</p>
                    <div class="field">
                        <label for="contact_email">Email</label>
                        <input id="contact_email" type="email" name="contact_email" value="<?= e($profile['contact_email'] ?? ''); ?>" required>
                    </div>
                    <div class="field-row">
                        <div class="field">
                            <label for="contact_linkedin">LinkedIn URL</label>
                            <input id="contact_linkedin" type="url" name="contact_linkedin" value="<?= e($profile['contact_linkedin'] ?? ''); ?>">
                        </div>
                        <div class="field">
                            <label for="contact_linkedin_text">LinkedIn label</label>
                            <input id="contact_linkedin_text" type="text" name="contact_linkedin_text" value="<?= e($profile['contact_linkedin_text'] ?? ''); ?>">
                        </div>
                    </div>
                    <div class="field-row">
                        <div class="field">
                            <label for="contact_github">GitHub URL</label>
                            <input id="contact_github" type="url" name="contact_github" value="<?= e($profile['contact_github'] ?? ''); ?>">
                        </div>
                        <div class="field">
                            <label for="contact_github_text">GitHub label</label>
                            <input id="contact_github_text" type="text" name="contact_github_text" value="<?= e($profile['contact_github_text'] ?? ''); ?>">
                        </div>
                    </div>
                    <div class="field">
                        <label for="contact_location">Location</label>
                        <input id="contact_location" type="text" name="contact_location" value="<?= e($profile['contact_location'] ?? ''); ?>">
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn--primary">
                        <i class="fa-solid fa-floppy-disk"></i> Save profile
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="preview-panel">
        <div class="preview-stack">
            <div class="preview-card">
                <div class="preview-card__label">
                    <span class="badge badge--live"><i class="fa-solid fa-circle"></i> Live preview</span>
                </div>
                <div class="preview-card__body">
                    <div class="preview-hero">
                        <span class="pill"><i class="fa-solid fa-sparkles"></i> Hero section</span>
                        <h3 id="preview-short-summary" data-fallback="Your short summary appears here"><?= e($profile['short_summary'] ?? ''); ?></h3>
                        <p id="preview-about-summary" data-fallback="Your about bio appears here"><?= e(admin_excerpt($profile['about_summary'] ?? '', 280)); ?></p>
                    </div>
                </div>
            </div>

            <div class="preview-card">
                <div class="preview-card__label">Contact block</div>
                <div class="preview-card__body">
                    <div class="preview-contact">
                        <span><i class="fa-solid fa-envelope"></i> <span id="preview-email" data-fallback="email@example.com"><?= e($profile['contact_email'] ?? ''); ?></span></span>
                        <span><i class="fa-brands fa-linkedin-in"></i> <span id="preview-linkedin" data-fallback="LinkedIn"><?= e($profile['contact_linkedin_text'] ?? ''); ?></span></span>
                        <span><i class="fa-brands fa-github"></i> <span id="preview-github" data-fallback="GitHub"><?= e($profile['contact_github_text'] ?? ''); ?></span></span>
                        <span><i class="fa-solid fa-location-dot"></i> <span id="preview-location" data-fallback="Location"><?= e($profile['contact_location'] ?? ''); ?></span></span>
                    </div>
                </div>
            </div>

            <div class="preview-card">
                <div class="preview-card__label">CV download</div>
                <div class="preview-card__body">
                    <div class="preview-cv">
                        <i class="fa-solid fa-file-pdf"></i>
                        <div>
                            <strong>Resume file</strong>
                            <span id="preview-resume-path" data-fallback="No CV uploaded"><?= e(basename($profile['resume_file'] ?? '') ?: 'No CV uploaded'); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
