<?php
/**
 * QGMS - Inspiring Kindness Foundation
 * Registration Portal with Program Options (Calfresh, EAhousing, NCCP, etc.)
 * - Updated with official Logo Azure Blue (#009ad1) and Violet branding
 * - Includes close ('✕') / skip button so users can navigate freely
 */

require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/includes/gate.php';
require_once __DIR__ . '/includes/security.php';

// Enforce initial site access gate
VideoGate::requireUnlocked();

$pageTitle = "Register - Inspiring Kindness Foundation | QGMS";
$pageDesc = "Register for community programs, support, and kindness partner networks.";
$currentPage = "register";

require_once __DIR__ . '/includes/header.php';
?>

<!-- Confetti JS for celebration -->
<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>

<!-- Optional Program Orientation Video Modal -->
<div id="reg-video-modal-overlay" class="qgms-modal-overlay">
    <div class="qgms-modal-card reg-video-modal position-relative">
        <div class="qgms-modal-stripe"></div>

        <!-- Close / Cross (Cors) Button to skip directly to form -->
        <button type="button" class="reg-modal-close-btn" id="btn-close-category-video" title="Skip video and proceed to registration form" aria-label="Close modal">
            <i class="fa fa-times"></i>
        </button>

        <div class="text-left mb-3 pr-4">
            <span class="reg-modal-badge">
                <i class="fa fa-play-circle text-primary"></i> Program Orientation Video
            </span>
            <h2 style="font-size: 22px; font-weight: 800; color: #0f172a; margin: 4px 0 6px;">Program Orientation Video</h2>
            <p style="font-size: 14px; color: #64748b; margin: 0;">Watch this short orientation for your selected program, or close this modal to proceed directly to the registration form.</p>
        </div>

        <!-- Category Tabs -->
        <div class="reg-tabs" id="category-tabs">
            <button type="button" class="reg-tab-btn active" data-key="calfresh" data-videoid="NjVX7b7fDaA"><i class="fa fa-cutlery mr-1"></i> Calfresh</button>
            <button type="button" class="reg-tab-btn" data-key="eahousing" data-videoid="pCh1aEDI9f0"><i class="fa fa-home mr-1"></i> EAhousing</button>
            <button type="button" class="reg-tab-btn" data-key="nccp" data-videoid="Ot2GaZcXcW0"><i class="fa fa-child mr-1"></i> NCCP</button>
            <button type="button" class="reg-tab-btn" data-key="santaclaracounty" data-videoid="_KOzaYGq8A8"><i class="fa fa-map-marker mr-1"></i> Santa Clara County</button>
            <button type="button" class="reg-tab-btn" data-key="assistanceleague" data-videoid="xTTFi9Z-ybQ"><i class="fa fa-heart mr-1"></i> Assistance League</button>
            <button type="button" class="reg-tab-btn" data-key="marincounty" data-videoid="TQfEozhzvxk"><i class="fa fa-building mr-1"></i> Marin County</button>
        </div>

        <!-- Video Embed -->
        <div class="video-wrapper mb-3" style="aspect-ratio: 16 / 9; max-width: 100%; border-radius: 14px; overflow: hidden; background: #000;">
            <div id="reg-youtube-player"></div>
        </div>

        <!-- Action Row -->
        <div class="d-flex flex-column flex-sm-row gap-2 mt-3">
            <button type="button" id="btn-reg-continue" class="btn-reg-submit flex-fill" style="padding: 13px;">
                <i class="fa fa-check-circle"></i> Proceed to Registration Form
            </button>
            <button type="button" id="btn-reg-skip-video" class="btn-reg-skip flex-fill" style="padding: 13px;">
                Skip Video &amp; Fill Form Direct &rarr;
            </button>
        </div>
    </div>
</div>

<!-- Main Registration Form Container -->
<main class="py-5" style="background: linear-gradient(180deg, #f0f9ff 0%, #e2e8f0 100%); min-height: 85vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card border-0 shadow-lg position-relative overflow-hidden" style="border-radius: 24px; border: 1px solid rgba(0, 154, 209, 0.15);">
                    <div class="qgms-modal-stripe"></div>
                    
                    <!-- Close / Back to Home cross button -->
                    <a href="index.php" class="reg-modal-close-btn" title="Return to Home" aria-label="Return to Home">
                        <i class="fa fa-times"></i>
                    </a>

                    <div class="card-body p-4 p-md-5">
                        <div class="text-center mb-4">
                            <span class="reg-modal-badge" id="selected-category-badge">
                                <i class="fa fa-bookmark"></i> Calfresh Application
                            </span>
                            <h1 class="font-weight-bold" style="color: #0f172a; font-size: 28px; margin-top: 6px;">Complete Your Registration</h1>
                            <p class="text-muted" style="font-size: 14.5px; max-width: 540px; margin: 0 auto;">Fill out your details below to submit your enrollment with Inspiring Kindness Foundation &bull; QGMS.</p>
                        </div>

                        <!-- Select Program Category -->
                        <div class="mb-4">
                            <label class="reg-label">Select Application Category:</label>
                            <div class="reg-category-selector" id="form-category-pills">
                                <span class="reg-pill active" data-key="calfresh"><i class="fa fa-cutlery"></i> Calfresh</span>
                                <span class="reg-pill" data-key="eahousing"><i class="fa fa-home"></i> EA Housing</span>
                                <span class="reg-pill" data-key="nccp"><i class="fa fa-child"></i> NCCP Care</span>
                                <span class="reg-pill" data-key="santaclaracounty"><i class="fa fa-map-marker"></i> Santa Clara County</span>
                                <span class="reg-pill" data-key="assistanceleague"><i class="fa fa-heart"></i> Assistance League</span>
                                <span class="reg-pill" data-key="marincounty"><i class="fa fa-building"></i> Marin County</span>
                                <span class="reg-pill" data-key="kindness_ambassador"><i class="fa fa-star"></i> Kindness Ambassador</span>
                            </div>
                        </div>

                        <form id="main-registration-form" novalidate>
                            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(Security::getCsrfToken()) ?>">
                            <input type="hidden" name="category" id="form-category-input" value="calfresh">

                            <div class="reg-field-group">
                                <label class="reg-label">Full Legal Name *</label>
                                <div class="reg-input-wrapper">
                                    <i class="fa fa-user reg-input-icon"></i>
                                    <input type="text" name="full_name" class="reg-input" placeholder="e.g. Maria Gonzalez" required autocomplete="name">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-6 reg-field-group">
                                    <label class="reg-label">Email Address *</label>
                                    <div class="reg-input-wrapper">
                                        <i class="fa fa-envelope reg-input-icon"></i>
                                        <input type="email" name="email" class="reg-input" placeholder="maria@example.com" required autocomplete="email">
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
                                <label class="reg-label">Additional Notes or Inquiries</label>
                                <textarea name="notes" class="reg-textarea" rows="3" placeholder="Tell us about the family, child, or community organization needing assistance..."></textarea>
                            </div>

                            <div id="reg-msg" class="alert mb-3" style="display: none; border-radius: 12px; font-weight: 600; font-size: 14px;"></div>

                            <div class="mt-4">
                                <button type="submit" id="btn-submit-main-reg" class="btn-reg-submit" style="font-size: 16px; padding: 15px;">
                                    <i class="fa fa-paper-plane mr-2"></i> Submit Application &rarr;
                                </button>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-3 pt-2">
                                <a href="index.php" class="text-muted" style="font-size: 13.5px;"><i class="fa fa-arrow-left mr-1"></i> Skip &amp; Return to Home</a>
                                <button type="button" id="btn-open-orientation" class="btn btn-link text-primary p-0" style="font-size: 13.5px; font-weight: 700;">
                                    <i class="fa fa-play-circle mr-1"></i> Watch Program Video
                                </button>
                            </div>
                        </form>

                        <div class="text-center mt-4 pt-3 border-top">
                            <p class="text-muted mb-0" style="font-size: 13.5px;">Already have an account? <a href="login.php" style="color: var(--primary-brand); font-weight: 700;">Sign in here</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
(function() {
    let regPlayer = null;
    let currentVideoId = 'NjVX7b7fDaA';
    let currentCategoryKey = 'calfresh';

    // Load YouTube API
    function initRegPlayer() {
        if (window.YT && window.YT.Player) {
            createPlayer(currentVideoId);
        } else {
            const tag = document.createElement('script');
            tag.src = "https://www.youtube.com/iframe_api";
            document.head.appendChild(tag);
            window.onYouTubeIframeAPIReady = function() {
                createPlayer(currentVideoId);
            };
        }
    }

    function createPlayer(videoId) {
        if (regPlayer && regPlayer.destroy) {
            regPlayer.destroy();
        }
        regPlayer = new window.YT.Player('reg-youtube-player', {
            videoId: videoId,
            playerVars: {
                autoplay: 0,
                controls: 1,
                rel: 0,
                modestbranding: 1
            },
            events: {
                'onStateChange': function(e) {
                    if (e.data === window.YT.PlayerState.PLAYING) {
                        const bgAudio = document.getElementById('bg-music-player');
                        if (bgAudio && !bgAudio.paused) {
                            bgAudio.pause();
                            const soundBtn = document.getElementById('sound-toggle');
                            const soundIcon = document.getElementById('sound-toggle-icon');
                            if (soundBtn) soundBtn.classList.remove('playing');
                            if (soundIcon) soundIcon.className = 'fa fa-volume-off';
                        }
                    }
                }
            }
        });
    }

    // Category Tabs in Video Modal
    document.querySelectorAll('#category-tabs .reg-tab-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('#category-tabs .reg-tab-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            currentCategoryKey = this.getAttribute('data-key');
            currentVideoId = this.getAttribute('data-videoid');

            setCategory(currentCategoryKey, this.textContent.trim());
            createPlayer(currentVideoId);
        });
    });

    // Category Pills on Form
    document.querySelectorAll('#form-category-pills .reg-pill').forEach(pill => {
        pill.addEventListener('click', function() {
            document.querySelectorAll('#form-category-pills .reg-pill').forEach(p => p.classList.remove('active'));
            this.classList.add('active');
            const key = this.getAttribute('data-key');
            setCategory(key, this.textContent.trim());
        });
    });

    function setCategory(key, name) {
        const input = document.getElementById('form-category-input');
        const badge = document.getElementById('selected-category-badge');
        if (input) input.value = key;
        if (badge) badge.innerHTML = '<i class="fa fa-bookmark"></i> ' + name + ' Application';
    }

    // Modal dismiss triggers
    function closeVideoModal() {
        const modal = document.getElementById('reg-video-modal-overlay');
        if (modal) modal.classList.remove('active');
        if (regPlayer && regPlayer.pauseVideo) regPlayer.pauseVideo();
    }

    document.getElementById('btn-close-category-video')?.addEventListener('click', closeVideoModal);
    document.getElementById('btn-reg-continue')?.addEventListener('click', closeVideoModal);
    document.getElementById('btn-reg-skip-video')?.addEventListener('click', closeVideoModal);

    // Open video modal trigger
    document.getElementById('btn-open-orientation')?.addEventListener('click', function() {
        const modal = document.getElementById('reg-video-modal-overlay');
        if (modal) modal.classList.add('active');
        initRegPlayer();
    });

    // Form submit AJAX
    document.getElementById('main-registration-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const form = this;
        const msg = document.getElementById('reg-msg');
        const submitBtn = document.getElementById('btn-submit-main-reg');
        const formData = new FormData(form);

        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fa fa-spinner fa-spin mr-2"></i> Submitting...';

        fetch('api/register.php', {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            msg.style.display = 'block';
            if (data.success) {
                msg.className = 'alert alert-success';
                msg.innerHTML = '<i class="fa fa-check-circle mr-2"></i> ' + data.message;
                form.reset();
                if (window.confetti) {
                    window.confetti({ particleCount: 100, spread: 70, origin: { y: 0.6 } });
                }
                submitBtn.innerHTML = '<i class="fa fa-check"></i> Submitted Successfully';
                setTimeout(() => {
                    window.location.href = 'index.php';
                }, 2500);
            } else {
                msg.className = 'alert alert-danger';
                msg.innerHTML = '<i class="fa fa-exclamation-triangle mr-2"></i> ' + (data.error || 'Submission error.');
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="fa fa-paper-plane mr-2"></i> Submit Application &rarr;';
            }
        })
        .catch(() => {
            msg.style.display = 'block';
            msg.className = 'alert alert-danger';
            msg.innerHTML = '<i class="fa fa-exclamation-triangle mr-2"></i> Server connection error. Please try again.';
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<i class="fa fa-paper-plane mr-2"></i> Submit Application &rarr;';
        });
    });
})();
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
