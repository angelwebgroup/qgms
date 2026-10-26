<?php
/**
 * QGMS - Newsletter Subscription API
 */

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/security.php';

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    Security::jsonResponse(['error' => 'Method not allowed'], 405);
}

if (!Security::checkRateLimit('newsletter', 6, 60)) {
    Security::jsonResponse(['error' => 'Too many requests. Please wait.'], 429);
}

$csrfToken = $_POST['csrf_token'] ?? '';
if (!Security::verifyCsrf($csrfToken)) {
    Security::jsonResponse(['error' => 'Invalid security token. Please refresh.'], 403);
}

$email = Security::sanitizeEmail($_POST['email'] ?? '');
if (empty($email)) {
    Security::jsonResponse(['error' => 'Please enter a valid email address.'], 400);
}

try {
    $pdo = Database::getConnection();
    if ($pdo) {
        $stmt = $pdo->prepare("INSERT IGNORE INTO newsletter_subscribers (email, ip_address) VALUES (?, ?)");
        $stmt->execute([$email, $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1']);
    } else {
        error_log("Database offline: newsletter subscriber logged for " . $email);
    }

    Security::jsonResponse([
        'success' => true,
        'message' => 'Thank you for subscribing! You will receive our latest kindness updates.'
    ]);
} catch (Throwable $e) {
    error_log("Newsletter subscription error: " . $e->getMessage());
    Security::jsonResponse(['error' => 'Subscription failed. Please try again.'], 500);
}
