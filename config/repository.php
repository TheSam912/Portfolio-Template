<?php

declare(strict_types=1);

/**
 * Loads only the editable profile fields + list data (skills, experience) from MySQL.
 */
final class ContentRepository
{
    private PDO $pdo;

    /** @var array<string, string>|null */
    private ?array $profile = null;

    /** @var list<array<string, mixed>>|null */
    private ?array $skills = null;

    /** @var list<array<string, mixed>>|null */
    private ?array $experiences = null;

    /** Keys stored in settings table that the admin can edit. */
    private const PROFILE_KEYS = [
        'short_summary',
        'about_summary',
        'resume_file',
        'contact_email',
        'contact_linkedin',
        'contact_linkedin_text',
        'contact_github',
        'contact_github_text',
        'contact_location',
    ];

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /** @return array<string, string> */
    public function getProfile(): array
    {
        if ($this->profile === null) {
            $this->profile = $this->loadProfile();
        }

        return $this->profile;
    }

    /** @return list<array<string, mixed>> */
    public function getSkills(): array
    {
        if ($this->skills === null) {
            $this->skills = $this->loadSkills();
        }

        return $this->skills;
    }

    /** @return list<array<string, mixed>> */
    public function getExperiences(): array
    {
        if ($this->experiences === null) {
            $this->experiences = $this->loadExperiences();
        }

        return $this->experiences;
    }

    /** @return array<string, string> */
    private function loadProfile(): array
    {
        $defaults = [
            'short_summary' => 'Full Stack Developer focused on building exceptional digital experiences with clean code and modern technologies.',
            'about_summary' => "I'm Sobhan (Sam), Motivated and experienced website and mobile app developer with expertise in Flutter, Android (Java), Laravel, and Vue.JS. Skilled in backend development, RESTful APIs (Node.js / PHP), and database management (SQL & NoSQL).",
            'resume_file' => 'assets/files/Sobhan-Resume.pdf',
            'contact_email' => 'The.Sam.Nolan1998@gmail.com',
            'contact_linkedin' => 'https://linkedin.com/in/sam912',
            'contact_linkedin_text' => 'Linkedin.com/in/sam912',
            'contact_github' => 'https://github.com/TheSam912',
            'contact_github_text' => 'Github.com/TheSam912',
            'contact_location' => 'Remote / Worldwide',
        ];

        try {
            $placeholders = implode(',', array_fill(0, count(self::PROFILE_KEYS), '?'));
            $stmt = $this->pdo->prepare(
                "SELECT setting_key, setting_value FROM settings WHERE setting_key IN ($placeholders)"
            );
            $stmt->execute(self::PROFILE_KEYS);
            $rows = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);

            foreach ($defaults as $key => $value) {
                if (!empty($rows[$key])) {
                    $defaults[$key] = (string) $rows[$key];
                }
            }
        } catch (PDOException) {
            // Use defaults if DB unavailable.
        }

        return $defaults;
    }

    /** @return list<array<string, mixed>> */
    private function loadSkills(): array
    {
        try {
            $stmt = $this->pdo->query(
                'SELECT id, name, icon_path FROM skills
                 WHERE is_published = 1 ORDER BY sort_order ASC, id ASC'
            );

            return $stmt->fetchAll() ?: [];
        } catch (PDOException) {
            return [];
        }
    }

    /** @return list<array<string, mixed>> */
    private function loadExperiences(): array
    {
        try {
            $stmt = $this->pdo->query(
                'SELECT id, date_range, position, company FROM experiences
                 WHERE is_published = 1 ORDER BY sort_order ASC, id ASC'
            );

            $experiences = $stmt->fetchAll() ?: [];
            if (!$experiences) {
                return [];
            }

            $ids = array_column($experiences, 'id');
            $placeholders = implode(',', array_fill(0, count($ids), '?'));
            $bulletStmt = $this->pdo->prepare(
                "SELECT experience_id, content FROM experience_bullets
                 WHERE experience_id IN ($placeholders) ORDER BY sort_order ASC, id ASC"
            );
            $bulletStmt->execute($ids);
            $bullets = $bulletStmt->fetchAll();

            $grouped = [];
            foreach ($bullets as $bullet) {
                $grouped[(int) $bullet['experience_id']][] = $bullet['content'];
            }

            foreach ($experiences as &$exp) {
                $exp['items'] = $grouped[(int) $exp['id']] ?? [];
            }
            unset($exp);

            return $experiences;
        } catch (PDOException) {
            return [];
        }
    }
}
