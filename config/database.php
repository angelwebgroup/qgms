<?php
/**
 * QGMS - Inspiring Kindness Foundation
 * PDO Database Connection & Schema Management
 */

require_once __DIR__ . '/config.php';

class Database {
    private static ?PDO $instance = null;

    public static function getConnection(): PDO {
        if (self::$instance === null) {
            $dsn = "mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci"
            ];

            try {
                self::$instance = new PDO($dsn, DB_USER, DB_PASS, $options);
                self::ensureSchema(self::$instance);
            } catch (PDOException $e) {
                error_log("Database connection failed: " . $e->getMessage());
                throw new RuntimeException("Database connection error. Please contact administrator.");
            }
        }

        return self::$instance;
    }

    private static function ensureSchema(PDO $pdo): void {
        $queries = [
            // Video unlock verification logs
            "CREATE TABLE IF NOT EXISTS video_unlock_logs (
                id INT AUTO_INCREMENT PRIMARY KEY,
                session_id VARCHAR(128) NOT NULL,
                video_id VARCHAR(64) NOT NULL,
                duration_watched INT DEFAULT 0,
                ip_address VARCHAR(45) NOT NULL,
                user_agent TEXT,
                completed_at DATETIME DEFAULT CURRENT_TIMESTAMP,
                INDEX idx_session (session_id),
                INDEX idx_ip (ip_address)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;",

            // Contact inquiries
            "CREATE TABLE IF NOT EXISTS inquiries (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(150) NOT NULL,
                email VARCHAR(191) NOT NULL,
                phone VARCHAR(50) DEFAULT NULL,
                message TEXT NOT NULL,
                ip_address VARCHAR(45) DEFAULT NULL,
                status VARCHAR(30) DEFAULT 'new',
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
                INDEX idx_email (email)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;",

            // Newsletter subscribers
            "CREATE TABLE IF NOT EXISTS newsletter_subscribers (
                id INT AUTO_INCREMENT PRIMARY KEY,
                email VARCHAR(191) NOT NULL UNIQUE,
                ip_address VARCHAR(45) DEFAULT NULL,
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;",

            // User accounts
            "CREATE TABLE IF NOT EXISTS users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                username VARCHAR(100) NOT NULL UNIQUE,
                email VARCHAR(191) NOT NULL UNIQUE,
                password_hash VARCHAR(255) NOT NULL,
                role ENUM('admin', 'guardian', 'donor', 'user') DEFAULT 'user',
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;",

            // Registration applications (e.g. Calfresh, EAhousing, NCCP, etc.)
            "CREATE TABLE IF NOT EXISTS registrations (
                id INT AUTO_INCREMENT PRIMARY KEY,
                full_name VARCHAR(150) NOT NULL,
                email VARCHAR(191) NOT NULL,
                phone VARCHAR(50) NOT NULL,
                category VARCHAR(60) NOT NULL,
                notes TEXT DEFAULT NULL,
                video_verified TINYINT(1) DEFAULT 1,
                ip_address VARCHAR(45) DEFAULT NULL,
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
                INDEX idx_email (email),
                INDEX idx_cat (category)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;",

            // Wishes & Kindness catches
            "CREATE TABLE IF NOT EXISTS wishes (
                id INT AUTO_INCREMENT PRIMARY KEY,
                child_name VARCHAR(120) NOT NULL,
                category VARCHAR(60) NOT NULL,
                title VARCHAR(255) NOT NULL,
                description TEXT NOT NULL,
                amount_needed DECIMAL(10,2) DEFAULT 0.00,
                amount_raised DECIMAL(10,2) DEFAULT 0.00,
                image_url VARCHAR(255) DEFAULT NULL,
                status ENUM('active', 'funded', 'completed') DEFAULT 'active',
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;"
        ];

        foreach ($queries as $sql) {
            $pdo->exec($sql);
        }

        // Seed sample wishes if empty
        $stmt = $pdo->query("SELECT COUNT(*) FROM wishes");
        if ((int)$stmt->fetchColumn() === 0) {
            $seed = $pdo->prepare("INSERT INTO wishes (child_name, category, title, description, amount_needed, amount_raised, image_url) VALUES 
                ('Marcus T.', 'Calfresh', 'Nutritional Support & Fresh Produce Box', 'Providing monthly organic fresh fruit and vegetable hampers for Marcus and his sibling.', 120.00, 85.00, 'images/courses/k1.jpeg'),
                ('Elena R.', 'EAhousing', 'School Supplies & Warm Winter Clothing', 'Essential educational kit, backpack, notebooks, and a warm winter jacket for 3rd grade.', 150.00, 150.00, 'images/courses/k2.jpg'),
                ('Liam S.', 'NCCP', 'Pediatric Therapy & Creative Learning Kit', 'Specialized learning toys and developmental tools supporting Liam with special needs.', 200.00, 140.00, 'images/courses/k3.jpeg'),
                ('Sophia K.', 'Santa Clara County', 'Art & Music Enrichment Supplies', 'Inspiring young creative expression with paints, canvases, and keyboard music lessons.', 95.00, 60.00, 'images/about/b1.jpg')
            ");
            $seed->execute();
        }

        // Seed default admin user if not exists (username: admin, pass: Admin@QGMS2026!)
        $adminStmt = $pdo->query("SELECT COUNT(*) FROM users WHERE username = 'admin'");
        if ((int)$adminStmt->fetchColumn() === 0) {
            $adminPass = password_hash('Admin@QGMS2026!', PASSWORD_BCRYPT);
            $seedAdmin = $pdo->prepare("INSERT INTO users (username, email, password_hash, role) VALUES ('admin', 'Henrik@qg-ms.com', ?, 'admin')");
            $seedAdmin->execute([$adminPass]);
        }
    }
}
