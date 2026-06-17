<?php
$title    = 'Messages';
$subtitle = 'Contact form submissions saved to your database.';
require __DIR__ . '/partials/page-header.php';
?>

<section class="panel">
    <div class="panel__head">
        <h2>Inbox</h2>
        <span class="badge badge--count"><?= count($items); ?> messages</span>
    </div>

    <?php if ($items): ?>
        <div class="message-list">
            <?php foreach ($items as $item): ?>
                <article class="message-card">
                    <div class="message-card__top">
                        <strong><?= e($item['name']); ?></strong>
                        <time><?= e($item['created_at']); ?></time>
                    </div>
                    <a class="message-card__email" href="mailto:<?= e($item['email']); ?>"><?= e($item['email']); ?></a>
                    <p class="message-card__body"><?= e($item['message']); ?></p>
                    <div class="message-card__actions">
                        <form method="post" action="<?= e(admin_url('messages')); ?>" onsubmit="return confirm('Delete this message?');">
                            <input type="hidden" name="_csrf" value="<?= e(csrf_token()); ?>">
                            <input type="hidden" name="delete_id" value="<?= (int) $item['id']; ?>">
                            <button type="submit" class="btn btn--danger btn--sm">
                                <i class="fa-solid fa-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="empty-state">
            <i class="fa-solid fa-inbox"></i>
            <p>No messages yet. Submissions from your contact form will appear here.</p>
        </div>
    <?php endif; ?>
</section>
