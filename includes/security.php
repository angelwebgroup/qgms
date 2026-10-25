<?php
/**
 * QGMS - Inspiring Kindness Foundation
 * Security Utilities & CSRF Defense
 */

require_once __DIR__ . '/../config/config.php';

class Security {

    public static function init(): void {
        self::sendHeaders();
        self::initCsrf();
    }

    public static function sendHeaders(): void {
        if (!headers_sent()) {
            header("X-Content-Type-Options: nosniff");
            header("X-Frame-Options: SAMEORIGIN");
            header("X-XSS-Protection: 1; mode=block");
            header("Referrer-Policy: strict-origin-when-cross-origin");
            header("Permissions-Policy: geolocation=(), microphone=(), camera=()");
        }
    }

    public static function initCsrf(): void {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
    }

    public static function getCsrfToken(): string {
        self::initCsrf();
        return $_SESSION['csrf_token'];
    }

    public static function verifyCsrf(?string $token): bool {
        if (empty($token) || empty($_SESSION['csrf_token'])) {
            return false;
        }
        return hash_equals($_SESSION['csrf_token'], $token);
    }

    public static function sanitize(string $data): string {
        return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
    }

    public static function sanitizeEmail(string $email): string {
        $clean = filter_var(trim($email), FILTER_SANITIZE_EMAIL);
        return filter_var($clean, FILTER_VALIDATE_EMAIL) ? strtolower($clean) : '';
    }

    public static function checkRateLimit(string $action, int $maxHits = 10, int $windowSeconds = 60): bool {
        $key = 'rate_' . $action . '_' . ($_SERVER['REMOTE_ADDR'] ?? '127.0.0.1');
        $now = time();

        if (!isset($_SESSION[$key])) {
            $_SESSION[$key] = ['count' => 1, 'reset_time' => $now + $windowSeconds];
            return true;
        }

        if ($now > $_SESSION[$key]['reset_time']) {
            $_SESSION[$key] = ['count' => 1, 'reset_time' => $now + $windowSeconds];
            return true;
        }

        $_SESSION[$key]['count']++;
        return $_SESSION[$key]['count'] <= $maxHits;
    }

    public static function jsonResponse(array $data, int $statusCode = 200): void {
        http_response_code($statusCode);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        exit;
    }

    public static function generateSignedToken(string $payload): string {
        $signature = hash_hmac('sha256', $payload, APP_SECRET_KEY);
        return base64_encode($payload . '::' . $signature);
    }

    public static function verifySignedToken(string $token): ?string {
        $cleanToken = strpos($token, '%') !== false ? urldecode($token) : $token;
        $decoded = base64_decode($cleanToken, true);
        if (!$decoded || strpos($decoded, '::') === false) {
            return null;
        }

        [$payload, $signature] = explode('::', $decoded, 2);
        $expectedSignature = hash_hmac('sha256', $payload, APP_SECRET_KEY);

        if (hash_equals($expectedSignature, $signature)) {
            return $payload;
        }

        return null;
    }
}

Security::init();
