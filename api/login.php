<?php
/**
 * QGMS - User Login API
 */

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/security.php';

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    Security::jsonResponse(['error' => 'Method not allowed'], 405);
}

if (!Security::checkRateLimit('login', 5, 60)) {
    Security::jsonResponse(['error' => 'Too many login attempts. Please wait 1 minute.'], 429);
}

$csrfToken = $_POST['csrf_token'] ?? '';
if (!Security::verifyCsrf($csrfToken)) {
    Security::jsonResponse(['error' => 'Invalid security token. Please refresh the page.'], 403);
}

$username = Security::sanitize($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

if (empty($username) || empty($password)) {
    Security::jsonResponse(['error' => 'Please provide both username/email and password.'], 400);
}

try {
    $pdo = Database::getConnection();
    $stmt = $pdo->prepare("SELECT id, username, email, password_hash, role FROM users WHERE username = ? OR email = ? LIMIT 1");
    $stmt->execute([$username, $username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password_hash'])) {
        // Regenerate session id to prevent fixation
        session_regenerate_id(true);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = $user['role'];

        Security::jsonResponse([
            'success' => true,
            'message' => 'Login successful! Welcome back, ' . htmlspecialchars($user['username']),
            'redirect' => BASE_URL . 'index.php'
        ]);
    } else {
        Security::jsonResponse(['error' => 'Invalid username or password.'], 401);
    }
} catch (Exception $e) {
    error_log("Login error: " . $e->getMessage());
    Security::jsonResponse(['error' => 'An authentication error occurred. Please try again.'], 500);
}
