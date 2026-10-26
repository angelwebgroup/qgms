<?php
/**
 * QGMS - Inspiring Kindness Foundation
 * Video Gating Middleware
 */

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/security.php';
require_once __DIR__ . '/../config/database.php';

class VideoGate {

    /**
     * Checks if the user has watched the required introductory video
     */
    public static function isUnlocked(): bool {
        // 1. Check active session
        if (!empty($_SESSION['qgsm_video_unlocked']) && $_SESSION['qgsm_video_unlocked'] === true) {
            return true;
        }

        // 2. Check developer or preview bypass parameter
        if (isset($_GET['dev_unlock']) && $_GET['dev_unlock'] === DEV_BYPASS_TOKEN) {
            self::markUnlocked('dev_bypass', 100);
            return true;
        }

        // 3. Check persistent secure HMAC cookie
        if (!empty($_COOKIE['qgsm_access_token'])) {
            $payload = Security::verifySignedToken($_COOKIE['qgsm_access_token']);
            if ($payload) {
                $parts = explode(':', $payload);
                if (count($parts) >= 2 && $parts[0] === 'unlocked') {
                    // Rehydrate session
                    $_SESSION['qgsm_video_unlocked'] = true;
                    $_SESSION['qgsm_unlocked_at'] = (int)($parts[1] ?? time());
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Enforces the gate. If not unlocked, redirects to intro.php
     */
    public static function requireUnlocked(): void {
        if (!self::isUnlocked()) {
            $target = BASE_URL . 'intro.php';
            if (isset($_SERVER['REQUEST_URI']) && strpos($_SERVER['REQUEST_URI'], 'intro.php') === false) {
                $_SESSION['redirect_after_intro'] = $_SERVER['REQUEST_URI'];
            }
            header("Location: " . $target . "?gate=required");
            exit;
        }
    }

    /**
     * Grants access after video completion
     */
    public static function markUnlocked(string $videoId = INTRO_VIDEO_ID, int $durationWatched = 0): bool {
        $_SESSION['qgsm_video_unlocked'] = true;
        $_SESSION['qgsm_unlocked_at'] = time();

        // Generate signed token valid for 30 days
        $payload = 'unlocked:' . time() . ':' . ($_SERVER['REMOTE_ADDR'] ?? 'unknown');
        $signedToken = Security::generateSignedToken($payload);

        // Set secure cookie
        setcookie(
            'qgsm_access_token',
            $signedToken,
            [
                'expires' => time() + (86400 * 30),
                'path' => '/qgms/',
                'httponly' => true,
                'samesite' => 'Lax'
            ]
        );

        // Log completion in database
        try {
            $pdo = Database::getConnection();
            if ($pdo) {
                $stmt = $pdo->prepare("INSERT INTO video_unlock_logs (session_id, video_id, duration_watched, ip_address, user_agent) VALUES (?, ?, ?, ?, ?)");
                $stmt->execute([
                    session_id(),
                    $videoId,
                    $durationWatched,
                    $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1',
                    $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown'
                ]);
            }
        } catch (Throwable $e) {
            error_log("Failed to log video unlock: " . $e->getMessage());
        }

        return true;
    }
}
