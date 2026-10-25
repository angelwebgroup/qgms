<?php
/**
 * QGMS - Inspiring Kindness Foundation
 * Introductory Video Access Gatekeeper
 * 
 * Requirement: Watch https://www.youtube.com/watch?v=1QEXfgps-xI completely to unlock website.
 */

require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/includes/security.php';
require_once __DIR__ . '/includes/gate.php';

$pageTitle = "Unlock Your Exclusive Access - Inspiring Kindness Foundation";
$pageDesc = "Watch the introductory video to completion to unlock your app download links and website access.";
$currentPage = "intro";

// Check if user has already unlocked
$alreadyUnlocked = VideoGate::isUnlocked();

require_once __DIR__ . '/includes/header.php';
?>

<!-- Confetti JS for celebratory unlock -->
<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>

<main class="gate-hero">
    <div class="container text-center">
        <!-- Title & Subtitle -->
        <div class="mb-4">
            <h1 class="gate-title">Unlock Your Exclusive Access Now</h1>
            <p class="gate-subtitle">
                You're just one step away. Watch the short video below to completion to unlock your app download links and experience the future of QGMS.
            </p>
            <?php if (isset($_GET['gate']) && $_GET['gate'] === 'required' && !$alreadyUnlocked): ?>
                <div class="alert alert-warning d-inline-block px-4 py-2 mb-4" style="border-radius: 30px; font-weight: 600; font-size: 14px;">
                    <i class="fa fa-lock mr-2"></i> Access Restricted: Please watch the video below to completion to enter the website.
                </div>
            <?php endif; ?>
        </div>

        <!-- Video Player Container -->
        <div class="video-wrapper">
            <div id="youtube-player"></div>
            <div id="watch-badge" class="watch-badge">
                <span class="pulse-dot"></span>
                <span id="watch-percent"><?= $alreadyUnlocked ? '100% Completed!' : '0% Watched' ?></span>
            </div>
        </div>

        <!-- Progress Bar Indicator -->
        <div class="progress-container">
            <div class="progress-bar-wrap">
                <div id="watch-progress-fill" class="progress-bar-fill" style="width: <?= $alreadyUnlocked ? '100%' : '0%' ?>; <?= $alreadyUnlocked ? 'background: #10b981;' : '' ?>"></div>
            </div>
        </div>

        <!-- Action Area -->
        <div class="gate-actions">
            <h2 id="gate-action-title" class="gate-actions-title <?= $alreadyUnlocked ? 'unlocked' : 'locked' ?>">
                <?= $alreadyUnlocked ? '🎉 Access Unlocked! Download Now' : 'Complete the video to unlock access' ?>
            </h2>

            <div class="d-flex flex-wrap justify-content-center align-items-center">
                <!-- iOS Download Button -->
                <button type="button" id="btn-download-ios" class="btn-download-app btn-download-ios trigger-app-modal <?= $alreadyUnlocked ? '' : 'disabled' ?>">
                    <i class="fa fa-apple" style="font-size: 22px;"></i>
                    <span>Download for iOS</span>
                </button>

                <!-- Android Download Button -->
                <button type="button" id="btn-download-android" class="btn-download-app btn-download-android trigger-app-modal <?= $alreadyUnlocked ? '' : 'disabled' ?>">
                    <i class="fa fa-android" style="font-size: 22px;"></i>
                    <span>Download for Android</span>
                </button>
            </div>

            <!-- Enter Website Button (Appears when unlocked) -->
            <div id="enter-website-container" style="display: <?= $alreadyUnlocked ? 'block' : 'none' ?>; margin-top: 25px;">
                <a href="index.php" class="btn-enter-website">
                    <i class="fa fa-heart"></i>
                    <span>Enter Kindness Station (Website) &rarr;</span>
                </a>
                <p class="text-muted mt-2" style="font-size: 13px;">
                    Your access is permanently remembered for 30 days on this device.
                </p>
            </div>
        </div>
    </div>
</main>

<!-- Configuration passed to video-gate.js -->
<script>
window.QGMS_CONFIG = {
    videoId: '<?= INTRO_VIDEO_ID ?>',
    minPercent: <?= INTRO_MIN_WATCH_PERCENT ?>,
    csrfToken: '<?= Security::getCsrfToken() ?>',
    unlockApiUrl: 'api/unlock-access.php',
    heartbeatApiUrl: 'api/video-heartbeat.php',
    redirectUrl: 'index.php',
    alreadyUnlocked: <?= $alreadyUnlocked ? 'true' : 'false' ?>
};
</script>
<script src="js/video-gate.js"></script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
