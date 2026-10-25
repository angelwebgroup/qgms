<?php
/**
 * QGMS - Inspiring Kindness Foundation
 * Introductory Video Access Gatekeeper with Automatic Post-Watch Registration Form
 * 
 * Requirement: Watch introductory video to completion to unlock website.
 * Upon completion:
 * - Website activates immediately
 * - Registration Form Modal pops up automatically
 * - User can skip registration anytime via close ('✕') or skip button to enter the website
 * - Brand styling matched strictly to the official Logo (#009ad1 / #7e2b90)
 */

require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/includes/security.php';
require_once __DIR__ . '/includes/gate.php';

$pageTitle = "Unlock Your Exclusive Access - Inspiring Kindness Foundation";
$pageDesc = "Watch the introductory video to completion to activate website access and open registration.";
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
            <div class="d-inline-flex align-items-center gap-2 px-3 py-1 mb-3 rounded-pill" style="background: rgba(0, 154, 209, 0.1); border: 1px solid rgba(0, 154, 209, 0.25); color: #0284c7; font-weight: 700; font-size: 13px; letter-spacing: 0.5px;">
                <i class="fa fa-shield"></i> <?= $alreadyUnlocked ? 'ACCESS VERIFIED &bull; WELCOME' : 'MANDATORY VIDEO GATEWAY' ?>
            </div>
            <h1 class="gate-title">
                <?= $alreadyUnlocked ? 'Your Exclusive Access Is Activated' : 'Unlock Your Exclusive Access Now' ?>
            </h1>
            <p class="gate-subtitle">
                <?= $alreadyUnlocked 
                    ? 'You have successfully verified your access. You can now enter the Kindness Station, register your member profile, or download the apps.' 
                    : 'Watch the introductory video below to completion. Once finished, the website will activate and open your registration form.' ?>
            </p>
            <?php if (isset($_GET['gate']) && $_GET['gate'] === 'required' && !$alreadyUnlocked): ?>
                <div class="alert d-inline-block px-4 py-2 mb-4" style="background: #eff6ff; border: 1px solid #bfdbfe; color: #1e40af; border-radius: 30px; font-weight: 600; font-size: 14px;">
                    <i class="fa fa-lock mr-2" style="color: #0284c7;"></i> Access Restricted: Please watch the video below to completion to activate the website.
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
                <div id="watch-progress-fill" class="progress-bar-fill" style="width: <?= $alreadyUnlocked ? '100%' : '0%' ?>; <?= $alreadyUnlocked ? 'background: linear-gradient(90deg, #009ad1, #7e2b90);' : '' ?>"></div>
            </div>
        </div>

        <!-- Action Area -->
        <div class="gate-actions">
            <h2 id="gate-action-title" class="gate-actions-title <?= $alreadyUnlocked ? 'unlocked' : 'locked' ?>">
                <?= $alreadyUnlocked ? '🎉 Access Unlocked! Download Now or Enter Below' : 'Complete the video to unlock access' ?>
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

            <!-- Enter Website & Open Registration Buttons -->
            <div id="enter-website-container" style="display: <?= $alreadyUnlocked ? 'block' : 'none' ?>; margin-top: 25px;">
                <div class="d-flex flex-wrap justify-content-center align-items-center gap-3">
                    <a href="index.php" class="btn-enter-website">
                        <i class="fa fa-heart"></i>
                        <span>Enter Kindness Station (Website) &rarr;</span>
                    </a>
                    <button type="button" id="btn-reopen-reg" class="btn ml-md-3 mt-3 mt-md-0" style="background: #ffffff; color: var(--primary-brand); border: 2px solid var(--primary-brand); padding: 14px 28px; border-radius: 50px; font-weight: 700; box-shadow: 0 4px 15px rgba(0, 154, 209, 0.15); transition: all 0.2s;">
                        <i class="fa fa-user-plus mr-1"></i>
                        <span>Open Registration Form</span>
                    </button>
                </div>
                <p class="text-muted mt-3" style="font-size: 13px;">
                    <i class="fa fa-check-circle text-success mr-1"></i> Your access is permanently remembered for 30 days on this device.
                </p>
            </div>
        </div>
    </div>
</main>

<!-- =============================================================
     REGISTRATION FORM MODAL
     - Automatically triggered when video completes (100%)
     - User can skip via close ('✕') or skip button
     - Logo-matched design with Azure Blue / Violet accents
============================================================= -->
<div id="reg-auto-modal-overlay" class="qgms-modal-overlay">
    <div class="qgms-modal-card reg-modal-card">
        <div class="qgms-modal-stripe"></div>
        
        <!-- Close / Cross (Cors) Button with Skip Tooltip -->
        <button type="button" class="reg-modal-close-btn" id="btn-close-reg-modal" title="Skip registration & enter website" aria-label="Skip registration">
            <i class="fa fa-times"></i>
        </button>

        <!-- Registration Form Content -->
        <div id="reg-form-content">
            <div class="d-flex align-items-center mb-2">
                <span class="reg-modal-badge">
                    <i class="fa fa-check-circle" style="color: #0284c7;"></i> Video Completed &bull; Website Unlocked
                </span>
            </div>
            <h2 class="reg-modal-title">Welcome to Inspiring Kindness!</h2>
            <p class="reg-modal-desc">
                Your website access is now activated! Please complete your registration below to enroll, or skip to enter the website directly.
            </p>

            <form id="intro-reg-form" novalidate>
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(Security::getCsrfToken()) ?>">
                <input type="hidden" name="category" id="modal-category-input" value="kindness_ambassador">

                <!-- Category Selector Pills -->
                <div class="mb-3">
                    <label class="reg-label">Select Your Program or Interest:</label>
                    <div class="reg-category-selector" id="modal-category-pills">
                        <span class="reg-pill active" data-category="kindness_ambassador"><i class="fa fa-heart"></i> Kindness Ambassador</span>
                        <span class="reg-pill" data-category="calfresh"><i class="fa fa-cutlery"></i> CalFresh Support</span>
                        <span class="reg-pill" data-category="eahousing"><i class="fa fa-home"></i> EA Housing</span>
                        <span class="reg-pill" data-category="nccp"><i class="fa fa-child"></i> NCCP Family Care</span>
                        <span class="reg-pill" data-category="volunteer"><i class="fa fa-handshake-o"></i> Volunteer &amp; Donor</span>
                        <span class="reg-pill" data-category="general"><i class="fa fa-star"></i> General Support</span>
                    </div>
                </div>

                <div class="reg-field-group">
                    <label class="reg-label">Full Name *</label>
                    <div class="reg-input-wrapper">
                        <i class="fa fa-user reg-input-icon"></i>
                        <input type="text" name="full_name" class="reg-input" placeholder="e.g. John Doe" required autocomplete="name">
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-6 reg-field-group">
                        <label class="reg-label">Email Address *</label>
                        <div class="reg-input-wrapper">
                            <i class="fa fa-envelope reg-input-icon"></i>
                            <input type="email" name="email" class="reg-input" placeholder="john@example.com" required autocomplete="email">
                        </div>
                    </div>
                    <div class="col-md-6 reg-field-group">
                        <label class="reg-label">Phone Number *</label>
                        <div class="reg-input-wrapper">
                            <i class="fa fa-phone reg-input-icon"></i>
                            <input type="tel" name="phone" class="reg-input" placeholder="+1 (555) 000-0000" required autocomplete="tel">
                        </div>
                    </div>
                </div>

                <div class="reg-field-group">
                    <label class="reg-label">Tell Us About Yourself / Message (Optional)</label>
                    <textarea name="notes" class="reg-textarea" rows="2" placeholder="Tell us how you would like to participate or if you require assistance..."></textarea>
                </div>

                <div id="intro-reg-alert" class="alert mb-3" style="display: none; border-radius: 12px; font-size: 13.5px; font-weight: 600;"></div>

                <div class="reg-actions-row">
                    <button type="submit" id="btn-submit-intro-reg" class="btn-reg-submit">
                        <i class="fa fa-check-circle"></i>
                        <span>Submit Registration &amp; Enter Website &rarr;</span>
                    </button>
                    <a href="index.php" class="btn-reg-skip" id="btn-skip-intro-reg">
                        <span>Skip for now &amp; Enter Website &rarr;</span>
                    </a>
                </div>
            </form>
        </div>

        <!-- Success Screen (Shown after successful submission) -->
        <div id="reg-form-success" class="reg-success-card" style="display: none;">
            <div class="reg-success-icon">
                <i class="fa fa-check"></i>
            </div>
            <h3 style="font-size: 24px; font-weight: 800; color: #0f172a; margin-bottom: 8px;">Registration Completed!</h3>
            <p style="font-size: 15px; color: #64748b; line-height: 1.6; margin-bottom: 24px;">
                Thank you for joining Inspiring Kindness. Your profile has been created and your access to the Kindness Station is fully unlocked.
            </p>
            <a href="index.php" class="btn-reg-submit text-decoration-none">
                <span>Enter Kindness Station Now &rarr;</span>
            </a>
            <p class="text-muted mt-3" style="font-size: 13px;">
                Redirecting automatically in <span id="reg-countdown">3</span> seconds...
            </p>
        </div>
    </div>
</div>

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
