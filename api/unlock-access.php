<?php
/**
 * QGMS - Video Unlock Verification Endpoint
 * Validates video completion and unlocks website access
 */

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/security.php';
require_once __DIR__ . '/../includes/gate.php';

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    Security::jsonResponse(['error' => 'Method not allowed'], 405);
}

$raw = file_get_contents('php://input');
$data = json_decode($raw, true) ?? [];

$csrfToken = $data['csrf_token'] ?? ($_POST['csrf_token'] ?? '');
if (!Security::verifyCsrf($csrfToken)) {
    Security::jsonResponse(['error' => 'Invalid or expired security token. Please refresh the page.'], 403);
}

$videoId = Security::sanitize($data['video_id'] ?? INTRO_VIDEO_ID);
$watchedSeconds = (int)($data['watched_seconds'] ?? 0);
$duration = (float)($data['duration'] ?? 0);
$completed = !empty($data['completed']);

// Basic anti-tamper check
if (!$completed && ($duration > 0 && ($watchedSeconds / $duration) < (INTRO_MIN_WATCH_PERCENT / 100))) {
    Security::jsonResponse([
        'error' => 'You must watch the entire video to unlock exclusive access.',
        'required_percent' => INTRO_MIN_WATCH_PERCENT
    ], 400);
}

// Mark access unlocked in session, cookie, and database log
VideoGate::markUnlocked($videoId, $watchedSeconds);

$targetUrl = BASE_URL . 'index.php';
if (!empty($_SESSION['redirect_after_intro'])) {
    $targetUrl = $_SESSION['redirect_after_intro'];
    unset($_SESSION['redirect_after_intro']);
}

Security::jsonResponse([
    'success' => true,
    'message' => 'Congratulations! Access has been unlocked.',
    'redirect' => $targetUrl
]);
