<?php

declare(strict_types=1);

function admin_handle_post(string $path): void
{
    match ($path) {
        '/login'       => admin_action_login(),
        '/settings'    => admin_action_settings(),
        '/stats'       => admin_action_stats(),
        '/services'    => admin_action_services(),
        '/skills'      => admin_action_skills(),
        '/experiences' => admin_action_experiences(),
        '/projects'    => admin_action_projects(),
        '/messages'    => admin_action_messages(),
        '/account'     => admin_action_account(),
        default        => (function () {
            http_response_code(404);
            exit('Not found.');
        })(),
    };
}

function admin_action_login(): void
{
    admin_verify_post();
    global $pdo;

    $username = trim((string) ($_POST['username'] ?? ''));
    $password = (string) ($_POST['password'] ?? '');

    $stmt = $pdo->prepare('SELECT id, password_hash FROM admin_users WHERE username = ? LIMIT 1');
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if (!$user || !password_verify($password, $user['password_hash'])) {
        flash_set('error', 'Invalid username or password.');
        admin_redirect('login');
    }

    session_regenerate_id(true);
    $_SESSION['admin_id'] = (int) $user['id'];
    admin_redirect('', 'success', 'Welcome back.');
}

function admin_action_settings(): void
{
    admin_require_auth();
    admin_verify_post();

    $groups = [
        'site_title' => ['group' => 'seo'],
        'meta_description' => ['group' => 'seo'],
        'hero_badge' => ['group' => 'hero'],
        'hero_title_line_1' => ['group' => 'hero'],
        'hero_title_line_2' => ['group' => 'hero'],
        'hero_title_line_3' => ['group' => 'hero'],
        'hero_description' => ['group' => 'hero'],
        'hero_btn_primary' => ['group' => 'hero'],
        'hero_btn_secondary' => ['group' => 'hero'],
        'about_tag' => ['group' => 'about'],
        'about_title_line_1' => ['group' => 'about'],
        'about_title_line_2' => ['group' => 'about'],
        'about_title_line_3' => ['group' => 'about'],
        'about_description' => ['group' => 'about'],
        'about_name_label' => ['group' => 'about'],
        'about_name_value' => ['group' => 'about'],
        'about_email_label' => ['group' => 'about'],
        'about_email_value' => ['group' => 'about'],
        'about_degree_label' => ['group' => 'about'],
        'about_degree_value' => ['group' => 'about'],
        'about_location_label' => ['group' => 'about'],
        'about_location_value' => ['group' => 'about'],
        'about_availability_label' => ['group' => 'about'],
        'about_availability_value' => ['group' => 'about'],
        'services_tag' => ['group' => 'services'],
        'services_title_line_1' => ['group' => 'services'],
        'services_title_line_2' => ['group' => 'services'],
        'skills_tag' => ['group' => 'skills'],
        'skills_title_line_1' => ['group' => 'skills'],
        'skills_title_line_2' => ['group' => 'skills'],
        'experience_tag' => ['group' => 'experience'],
        'experience_title_line_1' => ['group' => 'experience'],
        'experience_title_line_2' => ['group' => 'experience'],
        'portfolio_tag' => ['group' => 'portfolio'],
        'portfolio_title_line_1' => ['group' => 'portfolio'],
        'portfolio_title_line_2' => ['group' => 'portfolio'],
        'contact_tag' => ['group' => 'contact'],
        'contact_title_line_1' => ['group' => 'contact'],
        'contact_title_line_2' => ['group' => 'contact'],
        'contact_name_placeholder' => ['group' => 'contact'],
        'contact_email_placeholder' => ['group' => 'contact'],
        'contact_message_placeholder' => ['group' => 'contact'],
        'contact_button' => ['group' => 'contact'],
        'contact_info_tag' => ['group' => 'contact'],
        'contact_email' => ['group' => 'contact'],
        'contact_linkedin' => ['group' => 'contact'],
        'contact_linkedin_text' => ['group' => 'contact'],
        'contact_github' => ['group' => 'contact'],
        'contact_github_text' => ['group' => 'contact'],
        'contact_location' => ['group' => 'contact'],
        'footer_copyright' => ['group' => 'footer'],
        'footer_github' => ['group' => 'footer'],
        'footer_linkedin' => ['group' => 'footer'],
        'footer_email' => ['group' => 'footer'],
        'navbar_cta_text' => ['group' => 'navbar'],
        'modal_success_title' => ['group' => 'modal'],
        'modal_success_text' => ['group' => 'modal'],
        'modal_success_button' => ['group' => 'modal'],
        'hero_image' => ['group' => 'media'],
        'text_logo_image' => ['group' => 'media'],
        'logo_image' => ['group' => 'media'],
        'banner_image' => ['group' => 'media'],
        'footer_wave_image' => ['group' => 'media'],
        'resume_file' => ['group' => 'media'],
    ];

    admin_save_settings($groups);

    $uploads = [
        'hero_image_upload'        => ['key' => 'hero_image',        'subdir' => 'hero'],
        'text_logo_image_upload'   => ['key' => 'text_logo_image',   'subdir' => 'logos'],
        'logo_image_upload'        => ['key' => 'logo_image',        'subdir' => 'logos'],
        'banner_image_upload'      => ['key' => 'banner_image',      'subdir' => 'banner'],
        'footer_wave_image_upload' => ['key' => 'footer_wave_image', 'subdir' => 'footer'],
        'resume_file_upload'       => ['key' => 'resume_file',       'subdir' => 'files', 'types' => ['application/pdf']],
    ];

    global $pdo;
    $stmt = $pdo->prepare(
        'INSERT INTO settings (setting_key, setting_value, setting_group)
         VALUES (?, ?, ?)
         ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)'
    );

    foreach ($uploads as $field => $meta) {
        if (empty($_FILES[$field]['tmp_name'])) {
            continue;
        }

        $allowed = $meta['types'] ?? ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
        $result  = handle_upload($field, $meta['subdir'], $allowed);

        if ($result['ok']) {
            $stmt->execute([$meta['key'], $result['path'], 'media']);
        }
    }

    admin_redirect('settings', 'success', 'Settings saved.');
}

function admin_action_stats(): void
{
    admin_require_auth();
    admin_verify_post();
    global $pdo;

    if (isset($_POST['delete_id'])) {
        $stmt = $pdo->prepare('DELETE FROM stats WHERE id = ?');
        $stmt->execute([(int) $_POST['delete_id']]);
        admin_redirect('stats', 'success', 'Stat deleted.');
    }

    $id         = (int) ($_POST['id'] ?? 0);
    $icon       = trim((string) ($_POST['icon_class'] ?? 'fa-solid fa-star'));
    $count      = trim((string) ($_POST['count_value'] ?? ''));
    $label      = trim((string) ($_POST['label_text'] ?? ''));
    $sort       = (int) ($_POST['sort_order'] ?? 0);
    $published  = isset($_POST['is_published']) ? 1 : 0;

    if ($id > 0) {
        $stmt = $pdo->prepare(
            'UPDATE stats SET icon_class=?, count_value=?, label_text=?, sort_order=?, is_published=? WHERE id=?'
        );
        $stmt->execute([$icon, $count, $label, $sort, $published, $id]);
    } else {
        $stmt = $pdo->prepare(
            'INSERT INTO stats (icon_class, count_value, label_text, sort_order, is_published) VALUES (?,?,?,?,?)'
        );
        $stmt->execute([$icon, $count, $label, $sort, $published]);
    }

    admin_redirect('stats', 'success', 'Stat saved.');
}

function admin_action_services(): void
{
    admin_require_auth();
    admin_verify_post();
    global $pdo;

    if (isset($_POST['delete_id'])) {
        $pdo->prepare('DELETE FROM services WHERE id = ?')->execute([(int) $_POST['delete_id']]);
        admin_redirect('services', 'success', 'Service deleted.');
    }

    $id        = (int) ($_POST['id'] ?? 0);
    $title     = trim((string) ($_POST['title'] ?? ''));
    $desc      = trim((string) ($_POST['description'] ?? ''));
    $icon      = trim((string) ($_POST['icon_class'] ?? 'fa-solid fa-code'));
    $sort      = (int) ($_POST['sort_order'] ?? 0);
    $published = isset($_POST['is_published']) ? 1 : 0;

    if ($id > 0) {
        $pdo->prepare(
            'UPDATE services SET title=?, description=?, icon_class=?, sort_order=?, is_published=? WHERE id=?'
        )->execute([$title, $desc, $icon, $sort, $published, $id]);
    } else {
        $pdo->prepare(
            'INSERT INTO services (title, description, icon_class, sort_order, is_published) VALUES (?,?,?,?,?)'
        )->execute([$title, $desc, $icon, $sort, $published]);
    }

    admin_redirect('services', 'success', 'Service saved.');
}

function admin_action_skills(): void
{
    admin_require_auth();
    admin_verify_post();
    global $pdo;

    if (isset($_POST['delete_id'])) {
        $pdo->prepare('DELETE FROM skills WHERE id = ?')->execute([(int) $_POST['delete_id']]);
        admin_redirect('skills', 'success', 'Skill deleted.');
    }

    $id        = (int) ($_POST['id'] ?? 0);
    $name      = trim((string) ($_POST['name'] ?? ''));
    $iconPath  = trim((string) ($_POST['icon_path'] ?? ''));
    $sort      = (int) ($_POST['sort_order'] ?? 0);
    $published = isset($_POST['is_published']) ? 1 : 0;

    if (!empty($_FILES['icon_upload']['tmp_name'])) {
        $upload = handle_upload('icon_upload', 'skills', ['image/jpeg', 'image/png', 'image/webp', 'image/gif', 'image/svg+xml']);
        if ($upload['ok']) {
            $iconPath = $upload['path'];
        }
    }

    if ($id > 0) {
        $pdo->prepare(
            'UPDATE skills SET name=?, icon_path=?, sort_order=?, is_published=? WHERE id=?'
        )->execute([$name, $iconPath, $sort, $published, $id]);
    } else {
        $pdo->prepare(
            'INSERT INTO skills (name, icon_path, sort_order, is_published) VALUES (?,?,?,?)'
        )->execute([$name, $iconPath, $sort, $published]);
    }

    admin_redirect('skills', 'success', 'Skill saved.');
}

function admin_action_experiences(): void
{
    admin_require_auth();
    admin_verify_post();
    global $pdo;

    if (isset($_POST['delete_id'])) {
        $pdo->prepare('DELETE FROM experiences WHERE id = ?')->execute([(int) $_POST['delete_id']]);
        admin_redirect('experiences', 'success', 'Experience deleted.');
    }

    $id       = (int) ($_POST['id'] ?? 0);
    $date     = trim((string) ($_POST['date_range'] ?? ''));
    $position = trim((string) ($_POST['position'] ?? ''));
    $company  = trim((string) ($_POST['company'] ?? ''));
    $sort     = (int) ($_POST['sort_order'] ?? 0);
    $published = isset($_POST['is_published']) ? 1 : 0;
    $bullets  = array_filter(array_map('trim', explode("\n", (string) ($_POST['bullets'] ?? ''))));

    if ($id > 0) {
        $pdo->prepare(
            'UPDATE experiences SET date_range=?, position=?, company=?, sort_order=?, is_published=? WHERE id=?'
        )->execute([$date, $position, $company, $sort, $published, $id]);
    } else {
        $pdo->prepare(
            'INSERT INTO experiences (date_range, position, company, sort_order, is_published) VALUES (?,?,?,?,?)'
        )->execute([$date, $position, $company, $sort, $published]);
        $id = (int) $pdo->lastInsertId();
    }

    $pdo->prepare('DELETE FROM experience_bullets WHERE experience_id = ?')->execute([$id]);
    $stmt = $pdo->prepare('INSERT INTO experience_bullets (experience_id, content, sort_order) VALUES (?,?,?)');
    foreach ($bullets as $i => $bullet) {
        $stmt->execute([$id, $bullet, ($i + 1) * 10]);
    }

    admin_redirect('experiences', 'success', 'Experience saved.');
}

function admin_action_projects(): void
{
    admin_require_auth();
    admin_verify_post();
    global $pdo;

    if (isset($_POST['delete_id'])) {
        $pdo->prepare('DELETE FROM projects WHERE id = ?')->execute([(int) $_POST['delete_id']]);
        admin_redirect('projects', 'success', 'Project deleted.');
    }

    $id        = (int) ($_POST['id'] ?? 0);
    $title     = trim((string) ($_POST['title'] ?? ''));
    $slug      = trim((string) ($_POST['slug'] ?? '')) ?: slugify($title);
    $desc      = trim((string) ($_POST['description'] ?? ''));
    $imagePath = trim((string) ($_POST['image_path'] ?? ''));
    $url       = trim((string) ($_POST['project_url'] ?? '')) ?: null;
    $sort      = (int) ($_POST['sort_order'] ?? 0);
    $published = isset($_POST['is_published']) ? 1 : 0;

    if (!empty($_FILES['image_upload']['tmp_name'])) {
        $upload = handle_upload('image_upload', 'portfolio', ['image/jpeg', 'image/png', 'image/webp']);
        if ($upload['ok']) {
            $imagePath = $upload['path'];
        }
    }

    if ($id > 0) {
        $pdo->prepare(
            'UPDATE projects SET title=?, slug=?, description=?, image_path=?, project_url=?, sort_order=?, is_published=? WHERE id=?'
        )->execute([$title, $slug, $desc, $imagePath, $url, $sort, $published, $id]);
    } else {
        $pdo->prepare(
            'INSERT INTO projects (title, slug, description, image_path, project_url, sort_order, is_published) VALUES (?,?,?,?,?,?,?)'
        )->execute([$title, $slug, $desc, $imagePath, $url, $sort, $published]);
    }

    admin_redirect('projects', 'success', 'Project saved.');
}

function admin_action_messages(): void
{
    admin_require_auth();
    admin_verify_post();

    if (isset($_POST['delete_id'])) {
        global $pdo;
        $pdo->prepare('DELETE FROM messages WHERE id = ?')->execute([(int) $_POST['delete_id']]);
        admin_redirect('messages', 'success', 'Message deleted.');
    }

    admin_redirect('messages');
}

function admin_action_account(): void
{
    admin_require_auth();
    admin_verify_post();
    global $pdo;

    $current = (string) ($_POST['current_password'] ?? '');
    $new     = (string) ($_POST['new_password'] ?? '');
    $confirm = (string) ($_POST['confirm_password'] ?? '');

    $stmt = $pdo->prepare('SELECT password_hash FROM admin_users WHERE id = ?');
    $stmt->execute([(int) $_SESSION['admin_id']]);
    $hash = $stmt->fetchColumn();

    if (!$hash || !password_verify($current, $hash)) {
        admin_redirect('account', 'error', 'Current password is incorrect.');
    }

    if (strlen($new) < 8 || $new !== $confirm) {
        admin_redirect('account', 'error', 'New passwords must match and be at least 8 characters.');
    }

    $pdo->prepare('UPDATE admin_users SET password_hash = ? WHERE id = ?')
        ->execute([password_hash($new, PASSWORD_DEFAULT), (int) $_SESSION['admin_id']]);

    admin_redirect('account', 'success', 'Password updated.');
}
