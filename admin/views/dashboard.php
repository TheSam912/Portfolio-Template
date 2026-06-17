<?php
$title    = 'Dashboard';
$subtitle = 'Your portfolio at a glance — live previews of what visitors see right now.';
require __DIR__ . '/partials/page-header.php';
?>

<div class="stats-row">
    <div class="stat-card">
        <div class="stat-card__icon"><i class="fa-solid fa-inbox"></i></div>
        <div>
            <strong><?= (int) $counts['messages']; ?></strong>
            <span>Messages</span>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-card__icon"><i class="fa-solid fa-folder-open"></i></div>
        <div>
            <strong><?= (int) $counts['projects']; ?></strong>
            <span>Projects</span>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-card__icon"><i class="fa-solid fa-code"></i></div>
        <div>
            <strong><?= (int) $counts['skills']; ?></strong>
            <span>Skills</span>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-card__icon"><i class="fa-solid fa-briefcase"></i></div>
        <div>
            <strong><?= (int) $counts['experiences']; ?></strong>
            <span>Experience</span>
        </div>
    </div>
</div>

<div class="preview-row">
    <div class="preview-card">
        <div class="preview-card__label"><i class="fa-solid fa-eye"></i> Hero summary — live</div>
        <div class="preview-card__body">
            <div class="preview-hero">
                <span class="pill"><i class="fa-solid fa-sparkles"></i> Currently on site</span>
                <h3><?= e(admin_excerpt($profile['short_summary'] ?? '', 120) ?: 'No short summary set yet.'); ?></h3>
                <p><?= e(admin_excerpt($profile['about_summary'] ?? '', 200) ?: 'Add your about bio in Profile & Contact.'); ?></p>
            </div>
        </div>
    </div>

    <div class="preview-card">
        <div class="preview-card__label"><i class="fa-solid fa-address-card"></i> Contact — live</div>
        <div class="preview-card__body">
            <div class="preview-contact">
                <?php if (!empty($profile['contact_email'])): ?>
                    <span><i class="fa-solid fa-envelope"></i> <?= e($profile['contact_email']); ?></span>
                <?php endif; ?>
                <?php if (!empty($profile['contact_linkedin_text'])): ?>
                    <span><i class="fa-brands fa-linkedin-in"></i> <?= e($profile['contact_linkedin_text']); ?></span>
                <?php endif; ?>
                <?php if (!empty($profile['contact_github_text'])): ?>
                    <span><i class="fa-brands fa-github"></i> <?= e($profile['contact_github_text']); ?></span>
                <?php endif; ?>
                <?php if (!empty($profile['contact_location'])): ?>
                    <span><i class="fa-solid fa-location-dot"></i> <?= e($profile['contact_location']); ?></span>
                <?php endif; ?>
                <?php if (!empty($profile['resume_file'])): ?>
                    <div class="preview-cv">
                        <i class="fa-solid fa-file-pdf"></i>
                        <div>
                            <strong>CV on site</strong>
                            <span><?= e(basename($profile['resume_file'])); ?></span>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="preview-row">
    <div class="panel">
        <div class="panel__head">
            <h2><i class="fa-solid fa-code"></i> Skills preview</h2>
            <span class="badge badge--count"><?= count($skills); ?> shown</span>
        </div>
        <?php if ($skills): ?>
            <div class="skills-strip">
                <?php foreach ($skills as $skill): ?>
                    <span class="skill-chip">
                        <?php if (!empty($skill['icon_path'])): ?>
                            <img src="<?= e(asset_url($skill['icon_path'])); ?>" alt="">
                        <?php endif; ?>
                        <?= e($skill['name']); ?>
                    </span>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="muted">No skills yet. <a href="<?= e(admin_url('skills')); ?>">Add your first skill →</a></p>
        <?php endif; ?>
    </div>

    <div class="panel">
        <div class="panel__head">
            <h2><i class="fa-solid fa-folder-open"></i> Projects preview</h2>
            <a href="<?= e(admin_url('projects')); ?>" class="btn btn--ghost btn--sm">Manage</a>
        </div>
        <?php if ($projects): ?>
            <div class="project-strip">
                <?php foreach ($projects as $project): ?>
                    <div class="project-thumb" title="<?= e($project['title']); ?>">
                        <?php if (!empty($project['image_path'])): ?>
                            <img src="<?= e(asset_url($project['image_path'])); ?>" alt="<?= e($project['title']); ?>">
                        <?php else: ?>
                            <div class="empty-state" style="padding:20px"><i class="fa-solid fa-image"></i></div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="muted">No projects yet. <a href="<?= e(admin_url('projects')); ?>">Add a project →</a></p>
        <?php endif; ?>
    </div>
</div>

<?php if ($latestMessage): ?>
<div class="panel">
    <div class="panel__head">
        <h2><i class="fa-solid fa-envelope-open-text"></i> Latest message</h2>
        <a href="<?= e(admin_url('messages')); ?>" class="btn btn--ghost btn--sm">View all</a>
    </div>
    <div class="message-card" style="border:none;padding:0;background:transparent">
        <div class="message-card__top">
            <strong><?= e($latestMessage['name']); ?></strong>
            <time><?= e($latestMessage['created_at']); ?></time>
        </div>
        <a class="message-card__email" href="mailto:<?= e($latestMessage['email']); ?>"><?= e($latestMessage['email']); ?></a>
        <p class="message-card__body"><?= e(admin_excerpt($latestMessage['message'], 220)); ?></p>
    </div>
</div>
<?php endif; ?>

<div class="panel">
    <div class="panel__head">
        <h2>Quick actions</h2>
    </div>
    <div class="quick-links">
        <a href="<?= e(admin_url('profile')); ?>" class="quick-link">
            <i class="fa-solid fa-user-pen"></i>
            <span>Edit profile & contact</span>
        </a>
        <a href="<?= e(admin_url('skills')); ?>" class="quick-link">
            <i class="fa-solid fa-code"></i>
            <span>Manage skills</span>
        </a>
        <a href="<?= e(admin_url('experiences')); ?>" class="quick-link">
            <i class="fa-solid fa-briefcase"></i>
            <span>Update experience</span>
        </a>
        <a href="<?= e(admin_url('projects')); ?>" class="quick-link">
            <i class="fa-solid fa-folder-open"></i>
            <span>Add a project</span>
        </a>
    </div>
    <p class="muted" style="margin:20px 0 0;font-size:0.82rem">
        Static copy (section titles, footer, stats) lives in <code>config/static.php</code>.
        Admin URL: <code><?= e(admin_url()); ?></code>
    </p>
</div>
