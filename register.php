<?php
/**
 * QGMS - Inspiring Kindness Foundation
 * Registration Portal with Category Video Gate (Calfresh, EAhousing, NCCP, etc.)
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

<!-- Registration Video Gate Modal -->
<div id="reg-video-modal-overlay" class="qgms-modal-overlay active">
    <div class="qgms-modal-card reg-video-modal">
        <div class="qgms-modal-stripe"></div>
        <div class="text-center mb-3">
            <h2 style="font-size: 22px; font-weight: 800; color: #111; margin: 0 0 6px;">🎬 WELCOME! PLEASE WATCH THIS VIDEO</h2>
            <p style="font-size: 14px; color: #555; margin: 0;">Please watch the full video to continue with registration.</p>
        </div>

        <!-- Category Tabs -->
        <div class="reg-tabs" id="category-tabs">
            <button type="button" class="reg-tab-btn active" data-key="calfresh" data-videoid="NjVX7b7fDaA">Calfresh</button>
            <button type="button" class="reg-tab-btn" data-key="eahousing" data-videoid="pCh1aEDI9f0">EAhousing</button>
            <button type="button" class="reg-tab-btn" data-key="nccp" data-videoid="Ot2GaZcXcW0">NCCP</button>
            <button type="button" class="reg-tab-btn" data-key="santaclaracounty" data-videoid="_KOzaYGq8A8">Santa Clara County</button>
            <button type="button" class="reg-tab-btn" data-key="assistanceleague" data-videoid="xTTFi9Z-ybQ">Assistance League</button>
            <button type="button" class="reg-tab-btn" data-key="marincounty" data-videoid="TQfEozhzvxk">Marin County</button>
        </div>

        <!-- Video Embed -->
        <div class="video-wrapper mb-3" style="aspect-ratio: 16 / 9; max-width: 100%; border-radius: 12px; overflow: hidden; background: #000;">
            <div id="reg-youtube-player"></div>
        </div>

        <!-- Warning Message -->
        <div id="reg-warning" class="reg-warning-box">
            <i class="fa fa-exclamation-triangle" style="font-size: 16px;"></i>
            <span>Please watch the full video to enable the continue button</span>
        </div>

        <!-- Continue Button -->
        <button type="button" id="btn-reg-continue" class="btn btn-donate w-100 disabled" style="border-radius: 12px; padding: 14px; font-size: 15px; background: #cbd5e1 !important; color: #64748b !important; cursor: not-allowed; box-shadow: none;" disabled>
            Watch Full Video to Continue
        </button>
    </div>
</div>

<!-- Main Registration Form Container (Revealed after modal continue) -->
<main class="py-5" style="background: linear-gradient(180deg, #f8fafc 0%, #edf2f7 100%); min-height: 80vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7 col-md-9">
                <div class="card border-0 shadow-lg rounded-2xl p-4 p-md-5" style="border-radius: 24px;">
                    <div class="text-center mb-4">
                        <span class="badge badge-pill badge-primary px-3 py-2 text-uppercase mb-2" id="selected-category-badge" style="background: var(--primary-pink); font-size: 12px;">Calfresh Application</span>
                        <h2 class="font-weight-bold" style="color: #0f172a;">Complete Your Registration</h2>
                        <p class="text-muted" style="font-size: 14px;">Fill out the details below to complete your enrollment with QGMS Inspiring Kindness.</p>
                    </div>

                    <form id="main-registration-form">
                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(Security::getCsrfToken()) ?>">
                        <input type="hidden" name="category" id="form-category-input" value="calfresh">

                        <div class="form-group mb-3">
                            <label class="font-weight-bold text-dark" style="font-size: 13.5px;">Full Name *</label>
                            <input type="text" name="full_name" class="form-control" placeholder="Enter your full legal name" required style="border-radius: 10px; padding: 14px;">
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6 mb-3">
                                <label class="font-weight-bold text-dark" style="font-size: 13.5px;">Email Address *</label>
                                <input type="email" name="email" class="form-control" placeholder="name@example.com" required style="border-radius: 10px; padding: 14px;">
                            </div>
                            <div class="form-group col-md-6 mb-3">
                                <label class="font-weight-bold text-dark" style="font-size: 13.5px;">Phone Number *</label>
                                <input type="text" name="phone" class="form-control" placeholder="+1 (555) 000-0000" required style="border-radius: 10px; padding: 14px;">
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label class="font-weight-bold text-dark" style="font-size: 13.5px;">Additional Notes or Inquiries</label>
                            <textarea name="notes" class="form-control" rows="3" placeholder="Tell us about the child or organization needing assistance..." style="border-radius: 10px; padding: 14px;"></textarea>
                        </div>

                        <button type="submit" class="btn btn-donate w-100" style="padding: 15px; font-size: 16px; border-radius: 12px;">
                            Submit Application
                        </button>

                        <div id="reg-msg" class="mt-3 text-center" style="display: none; font-weight: 600;"></div>
                    </form>

                    <div class="text-center mt-4 pt-3 border-top">
                        <p class="text-muted mb-0" style="font-size: 13.5px;">Already have an account? <a href="login.php" style="color: var(--primary-pink); font-weight: 700;">Sign in here</a></p>
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
    let videoWatched = false;

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
        if (regPlayer) {
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
                    if (e.data === window.YT.PlayerState.ENDED) {
                        enableContinue();
                    }
                }
            }
        });
    }

    function enableContinue() {
        videoWatched = true;
        const btn = document.getElementById('btn-reg-continue');
        const warn = document.getElementById('reg-warning');

        btn.disabled = false;
        btn.classList.remove('disabled');
        btn.style.background = 'var(--primary-pink)';
        btn.style.color = '#ffffff';
        btn.style.cursor = 'pointer';
        btn.textContent = 'Continue with Registration →';

        warn.style.background = '#ecfdf5';
        warn.style.borderColor = '#a7f3d0';
        warn.style.color = '#065f46';
        warn.innerHTML = '<i class="fa fa-check-circle"></i> Video watched! You can now proceed to registration.';
    }

    // Tab clicks
    document.querySelectorAll('.reg-tab-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.reg-tab-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            currentCategoryKey = this.getAttribute('data-key');
            currentVideoId = this.getAttribute('data-videoid');

            document.getElementById('form-category-input').value = currentCategoryKey;
            document.getElementById('selected-category-badge').textContent = this.textContent + ' Application';

            // Reset video watched state for new category
            videoWatched = false;
            const continueBtn = document.getElementById('btn-reg-continue');
            continueBtn.disabled = true;
            continueBtn.classList.add('disabled');
            continueBtn.style.background = '#cbd5e1';
            continueBtn.style.color = '#64748b';
            continueBtn.style.cursor = 'not-allowed';
            continueBtn.textContent = 'Watch Full Video to Continue';

            const warn = document.getElementById('reg-warning');
            warn.style.background = '#fefce8';
            warn.style.borderColor = '#fef08a';
            warn.style.color = '#854d0e';
            warn.innerHTML = '<i class="fa fa-exclamation-triangle"></i> Please watch the full video to enable the continue button';

            createPlayer(currentVideoId);
        });
    });

    // Continue button click closes modal and focuses on registration form
    document.getElementById('btn-reg-continue').addEventListener('click', function() {
        if (!videoWatched) return;
        document.getElementById('reg-video-modal-overlay').classList.remove('active');
        window.scrollTo({ top: 150, behavior: 'smooth' });
    });

    // Form submit AJAX
    document.getElementById('main-registration-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const form = this;
        const msg = document.getElementById('reg-msg');
        const formData = new FormData(form);

        fetch('api/register.php', {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            msg.style.display = 'block';
            if (data.success) {
                msg.style.color = '#10b981';
                msg.textContent = data.message;
                form.reset();
            } else {
                msg.style.color = '#ef4444';
                msg.textContent = data.error || 'Submission error.';
            }
        })
        .catch(() => {
            msg.style.display = 'block';
            msg.style.color = '#ef4444';
            msg.textContent = 'Server connection error. Please try again.';
        });
    });

    // Init player on DOM load
    document.addEventListener('DOMContentLoaded', initRegPlayer);
})();
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
