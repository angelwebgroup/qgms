<?php
/**
 * QGMS - Inspiring Kindness Foundation
 * Core Configuration File
 */

// Prevent direct execution
if (!defined('QGMS_INIT')) {
    define('QGMS_INIT', true);
}

// Ensure sessions are started with strict security
if (session_status() === PHP_SESSION_NONE) {
    ini_set('session.cookie_httponly', 1);
    ini_set('session.use_only_cookies', 1);
    ini_set('session.cookie_samesite', 'Lax');
    // Set session cookie lifetime (30 days)
    ini_set('session.gc_maxlifetime', 2592000);
    session_set_cookie_params([
        'lifetime' => 2592000,
        'path' => '/qgms/',
        'httponly' => true,
        'samesite' => 'Lax'
    ]);
    session_name('QGSMSESSID');
    session_start();
}

// Error reporting - change to 0 in strict production
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
ini_set('display_errors', '0');
ini_set('log_errors', '1');
ini_set('error_log', __DIR__ . '/../error.log');

// Database Configuration
define('DB_HOST', '127.0.0.1');
define('DB_PORT', '3306');
define('DB_NAME', 'qgsm_db');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');

// Site Info
define('SITE_NAME', 'Inspiring Kindness Foundation - QGMS');
define('SITE_TAGLINE', 'Catching & Recognizing Acts of Goodness');
define('SITE_EMAIL', 'Henrik@qg-ms.com');
define('SITE_PHONE', '+1 6692385620');
define('SITE_ADDRESS', '2241 Churchill Dr. Milpitas, CA 95035');
define('BASE_URL', '/qgms/');

// Security & Crypto Secrets
define('APP_SECRET_KEY', 'qgms_super_secret_hmac_key_2026_inspiring_kindness_safe_hash');
define('DEV_BYPASS_TOKEN', 'qgms2026_dev_pass');

// Video Gating Configuration
// Video required to watch: https://www.youtube.com/watch?v=1QEXfgps-xI
define('INTRO_VIDEO_ID', '1QEXfgps-xI');
define('INTRO_VIDEO_TITLE', 'Introduction video SHD 2026 - Quality Giving Management');
// Minimum playback completion ratio (e.g., 0.90 = 90% watched)
define('INTRO_MIN_WATCH_PERCENT', 90);
// Estimated duration in seconds (can be dynamically updated by client player)
define('INTRO_MIN_SECONDS', 45);

// Social Media Links
define('LINK_FACEBOOK', 'https://facebook.com');
define('LINK_TWITTER', 'https://twitter.com');
define('LINK_LINKEDIN', 'https://linkedin.com');
define('LINK_YOUTUBE', 'https://www.youtube.com/watch?v=1QEXfgps-xI');
