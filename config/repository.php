<?php

declare(strict_types=1);

/**
 * Loads all site content from MySQL and exposes it to the frontend.
 */
final class ContentRepository
{
    private PDO $pdo;

    /** @var array<string, mixed>|null */
    private ?array $content = null;

    /** @var list<array<string, mixed>>|null */
    private ?array $stats = null;

    /** @var list<array<string, mixed>>|null */
    private ?array $services = null;

    /** @var list<array<string, mixed>>|null */
    private ?array $skills = null;

    /** @var list<array<string, mixed>>|null */
    private ?array $experiences = null;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /** @return array<string, mixed> */
    public function getContent(): array
    {
        if ($this->content === null) {
            $this->content = $this->loadSettings();
        }

        return $this->content;
    }

    /** @return list<array<string, mixed>> */
    public function getStats(): array
    {
        if ($this->stats === null) {
            $this->stats = $this->loadStats();
        }

        return $this->stats;
    }

    /** @return list<array<string, mixed>> */
    public function getServices(): array
    {
        if ($this->services === null) {
            $this->services = $this->loadServices();
        }

        return $this->services;
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

    /** @return array<string, mixed> */
    private function loadSettings(): array
    {
        try {
            $rows = $this->pdo
                ->query('SELECT setting_key, setting_value FROM settings')
                ->fetchAll(PDO::FETCH_KEY_PAIR);
        } catch (PDOException) {
            return $this->fallbackContent();
        }

        return is_array($rows) ? $rows : $this->fallbackContent();
    }

    /** @return list<array<string, mixed>> */
    private function loadStats(): array
    {
        try {
            $stmt = $this->pdo->query(
                'SELECT id, icon_class, count_value, label_text
                 FROM stats
                 WHERE is_published = 1
                 ORDER BY sort_order ASC, id ASC'
            );

            return $stmt->fetchAll() ?: [];
        } catch (PDOException) {
            return [];
        }
    }

    /** @return list<array<string, mixed>> */
    private function loadServices(): array
    {
        try {
            $stmt = $this->pdo->query(
                'SELECT id, title, description, icon_class
                 FROM services
                 WHERE is_published = 1
                 ORDER BY sort_order ASC, id ASC'
            );

            return $stmt->fetchAll() ?: [];
        } catch (PDOException) {
            return [];
        }
    }

    /** @return list<array<string, mixed>> */
    private function loadSkills(): array
    {
        try {
            $stmt = $this->pdo->query(
                'SELECT id, name, icon_path
                 FROM skills
                 WHERE is_published = 1
                 ORDER BY sort_order ASC, id ASC'
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
                'SELECT id, date_range, position, company
                 FROM experiences
                 WHERE is_published = 1
                 ORDER BY sort_order ASC, id ASC'
            );

            $experiences = $stmt->fetchAll() ?: [];

            if (!$experiences) {
                return [];
            }

            $ids = array_column($experiences, 'id');
            $placeholders = implode(',', array_fill(0, count($ids), '?'));

            $bulletStmt = $this->pdo->prepare(
                "SELECT experience_id, content
                 FROM experience_bullets
                 WHERE experience_id IN ($placeholders)
                 ORDER BY sort_order ASC, id ASC"
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

    /** Minimal fallback if DB is empty or unavailable. */
    /** @return array<string, mixed> */
    private function fallbackContent(): array
    {
        return [
            'site_title'           => 'Sam Nolan — Portfolio',
            'hero_badge'           => 'Software Engineer',
            'hero_title_line_1'    => 'Building Digital Products',
            'hero_title_line_2'    => 'With Clean Code',
            'hero_title_line_3'    => 'And Smart Solutions',
            'hero_description'     => 'Full Stack Developer focused on building exceptional digital experiences.',
            'hero_btn_primary'     => 'View My Work',
            'hero_btn_secondary'   => 'Download CV',
            'hero_image'           => 'assets/images/hero.webp',
            'text_logo_image'      => 'assets/images/textlogo.png',
            'logo_image'           => 'assets/images/logo.png',
            'banner_image'         => 'assets/images/banner3.webp',
            'footer_wave_image'    => 'assets/images/footer-wave.webp',
            'resume_file'          => 'assets/files/Sobhan-Resume.pdf',
            'navbar_cta_text'      => 'Get In Touch',
        ];
    }
}
