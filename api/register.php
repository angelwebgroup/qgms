<?php
/**
 * QGMS - Registration API
 */

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/security.php';

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    Security::jsonResponse(['error' => 'Method not allowed'], 405);
}

if (!Security::checkRateLimit('registration', 5, 60)) {
    Security::jsonResponse(['error' => 'Too many registration requests. Please wait a moment.'], 429);
}

$csrfToken = $_POST['csrf_token'] ?? '';
if (!Security::verifyCsrf($csrfToken)) {
    Security::jsonResponse(['error' => 'Invalid security token. Please refresh the page.'], 403);
}

$fullName = Security::sanitize($_POST['full_name'] ?? '');
$email = Security::sanitizeEmail($_POST['email'] ?? '');
$phone = Security::sanitize($_POST['phone'] ?? '');
$category = Security::sanitize($_POST['category'] ?? 'calfresh');
$notes = Security::sanitize($_POST['notes'] ?? '');

if (empty($fullName) || strlen($fullName) < 2) {
    Security::jsonResponse(['error' => 'Please provide your full name.'], 400);
}

if (empty($email)) {
    Security::jsonResponse(['error' => 'Please provide a valid email address.'], 400);
}

if (empty($phone)) {
    Security::jsonResponse(['error' => 'Please provide your contact phone number.'], 400);
}

try {
    $pdo = Database::getConnection();
    if ($pdo) {
        $stmt = $pdo->prepare("INSERT INTO registrations (full_name, email, phone, category, notes, video_verified, ip_address) VALUES (?, ?, ?, ?, ?, 1, ?)");
        $stmt->execute([
            $fullName,
            $email,
            $phone,
            $category,
            $notes,
            $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1'
        ]);
    } else {
        error_log("Database offline: registration logged for " . $email . " - " . $fullName);
    }

    Security::jsonResponse([
        'success' => true,
        'message' => 'Thank you! Your registration application has been submitted successfully. A representative will contact you with next steps.'
    ]);
} catch (Throwable $e) {
    error_log("Registration error: " . $e->getMessage());
    Security::jsonResponse(['error' => 'Registration could not be completed. Please try again.'], 500);
}
