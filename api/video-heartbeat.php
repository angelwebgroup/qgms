<?php
/**
 * QGMS - Video Heartbeat API
 * Tracks playback progress and verifies continuous watch
 */

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/security.php';

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    Security::jsonResponse(['error' => 'Method not allowed'], 405);
}

// Read JSON input
$raw = file_get_contents('php://input');
$data = json_decode($raw, true) ?? [];

$csrfToken = $data['csrf_token'] ?? ($_POST['csrf_token'] ?? '');
if (!Security::verifyCsrf($csrfToken)) {
    Security::jsonResponse(['error' => 'Invalid or expired security token'], 403);
}

$currentTime = (float)($data['current_time'] ?? 0);
$duration = (float)($data['duration'] ?? 0);
$videoId = Security::sanitize($data['video_id'] ?? INTRO_VIDEO_ID);

if (!isset($_SESSION['playback_tracker'])) {
    $_SESSION['playback_tracker'] = [
        'start_time' => time(),
        'ticks' => 0,
        'max_time' => 0,
        'last_ping' => time()
    ];
}

$tracker = &$_SESSION['playback_tracker'];
$now = time();

// Update tracker
$tracker['ticks']++;
$tracker['last_ping'] = $now;
if ($currentTime > $tracker['max_time']) {
    $tracker['max_time'] = $currentTime;
}

$percent = $duration > 0 ? round(($currentTime / $duration) * 100, 1) : 0;

Security::jsonResponse([
    'status' => 'tracked',
    'percent' => $percent,
    'current_time' => $currentTime,
    'duration' => $duration
]);
