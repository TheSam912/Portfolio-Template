<h1>Messages</h1>
<p class="muted">Contact form submissions saved to your database.</p>

<div class="panel">
    <table>
        <thead>
            <tr><th>Date</th><th>Name</th><th>Email</th><th>Message</th><th></th></tr>
        </thead>
        <tbody>
        <?php if (!$items): ?>
            <tr><td colspan="5" class="muted">No messages yet.</td></tr>
        <?php endif; ?>
        <?php foreach ($items as $item): ?>
            <tr>
                <td><?= e($item['created_at']); ?></td>
                <td><?= e($item['name']); ?></td>
                <td><a href="mailto:<?= e($item['email']); ?>"><?= e($item['email']); ?></a></td>
                <td><?= e(mb_strimwidth($item['message'], 0, 120, '…')); ?></td>
                <td>
                    <form method="post" action="<?= e(admin_url('messages')); ?>" onsubmit="return confirm('Delete message?');">
                        <input type="hidden" name="_csrf" value="<?= e(csrf_token()); ?>">
                        <input type="hidden" name="delete_id" value="<?= (int) $item['id']; ?>">
                        <button type="submit" class="danger">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
