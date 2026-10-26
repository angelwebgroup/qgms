<?php
/**
 * QGMS - Contact Form API
 */

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/security.php';

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    Security::jsonResponse(['error' => 'Method not allowed'], 405);
}

if (!Security::checkRateLimit('contact_form', 5, 60)) {
    Security::jsonResponse(['error' => 'Too many submissions. Please wait a minute before trying again.'], 429);
}

$csrfToken = $_POST['csrf_token'] ?? '';
if (!Security::verifyCsrf($csrfToken)) {
    Security::jsonResponse(['error' => 'Invalid security token. Please refresh the page and try again.'], 403);
}

$name = Security::sanitize($_POST['name'] ?? '');
$email = Security::sanitizeEmail($_POST['email'] ?? '');
$phone = Security::sanitize($_POST['phone'] ?? '');
$message = Security::sanitize($_POST['message'] ?? '');

if (empty($name) || strlen($name) < 2) {
    Security::jsonResponse(['error' => 'Please provide your full name.'], 400);
}

if (empty($email)) {
    Security::jsonResponse(['error' => 'Please provide a valid email address.'], 400);
}

if (empty($message) || strlen($message) < 5) {
    Security::jsonResponse(['error' => 'Please provide a meaningful message.'], 400);
}

try {
    $pdo = Database::getConnection();
    if ($pdo) {
        $stmt = $pdo->prepare("INSERT INTO inquiries (name, email, phone, message, ip_address) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([
            $name,
            $email,
            $phone,
            $message,
            $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1'
        ]);
    } else {
        error_log("Database offline: contact inquiry recorded in log for " . $email . " - " . $name);
    }

    Security::jsonResponse([
        'success' => true,
        'message' => 'Thank you for reaching out! We have received your message and will get back to you shortly.'
    ]);
} catch (Throwable $e) {
    error_log("Contact submit error: " . $e->getMessage());
    Security::jsonResponse(['error' => 'An error occurred while saving your message. Please try again.'], 500);
}
