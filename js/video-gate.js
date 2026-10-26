/**
 * QGMS - Video Gatekeeper & Auto-Registration Script
 * 
 * 1. Implements YouTube IFrame API with anti-tamper playback tracking.
 * 2. On video completion:
 *    - Unlocks website access via api/unlock-access.php
 *    - Fires celebration confetti
 *    - Automatically opens the modern Registration Form Modal
 * 3. User can skip registration anytime via close ('✕') / cors button or skip link.
 * 4. Fully styled with Logo Azure Blue & Violet branding.
 */

(function () {
    'use strict';

    let player = null;
    let timer = null;
    let heartbeatTimer = null;
    let duration = 0;
    let maxWatchedTime = 0;
    let isUnlocked = false;

    const config = window.QGMS_CONFIG || {
        videoId: '1QEXfgps-xI',
        minPercent: 90,
        csrfToken: '',
        unlockApiUrl: 'api/unlock-access.php',
        heartbeatApiUrl: 'api/video-heartbeat.php',
        redirectUrl: 'index.php',
        alreadyUnlocked: false
    };

    // Load YouTube API
    function loadYouTubeApi() {
        if (window.YT && window.YT.Player) {
            initPlayer();
            return;
        }

        const tag = document.createElement('script');
        tag.src = 'https://www.youtube.com/iframe_api';
        const firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

        window.onYouTubeIframeAPIReady = function () {
            initPlayer();
        };
    }

    function initPlayer() {
        const playerContainer = document.getElementById('youtube-player');
        if (!playerContainer) return;

        player = new window.YT.Player('youtube-player', {
            videoId: config.videoId,
            playerVars: {
                autoplay: 0,
                controls: 1,
                rel: 0,
                modestbranding: 1,
                playsinline: 1,
                fs: 1
            },
            events: {
                'onReady': onPlayerReady,
                'onStateChange': onPlayerStateChange
            }
        });
    }

    function onPlayerReady(event) {
        duration = player.getDuration();
        updateUI();
    }

    function onPlayerStateChange(event) {
        // Playing
        if (event.data === window.YT.PlayerState.PLAYING) {
            // Pause background music so it doesn't conflict with video audio
            const bgAudio = document.getElementById('bg-music-player');
            if (bgAudio && !bgAudio.paused) {
                bgAudio.pause();
                const soundBtn = document.getElementById('sound-toggle');
                const soundIcon = document.getElementById('sound-toggle-icon');
                if (soundBtn) soundBtn.classList.remove('playing');
                if (soundIcon) soundIcon.className = 'fa fa-volume-off';
            }
            startTracking();
        } else {
            stopTracking();
        }

        // Ended
        if (event.data === window.YT.PlayerState.ENDED) {
            handleVideoCompleted();
        }
    }

    function startTracking() {
        if (timer) clearInterval(timer);
        if (heartbeatTimer) clearInterval(heartbeatTimer);

        timer = setInterval(function () {
            if (!player || !player.getCurrentTime) return;

            const currentTime = player.getCurrentTime();
            duration = player.getDuration() || duration;

            // Anti-seek limitation: if user skips ahead by more than 3 seconds past maxWatchedTime, snap back
            if (currentTime > maxWatchedTime + 3) {
                player.seekTo(maxWatchedTime, true);
                return;
            }

            if (currentTime > maxWatchedTime) {
                maxWatchedTime = currentTime;
            }

            updateUI();

            // Check if user reached 98%
            if (duration > 0 && (maxWatchedTime / duration) >= 0.98 && !isUnlocked) {
                handleVideoCompleted();
            }
        }, 500);

        // Heartbeat ping every 5 seconds
        heartbeatTimer = setInterval(function () {
            if (!player || !player.getCurrentTime) return;
            sendHeartbeat();
        }, 5000);
    }

    function stopTracking() {
        if (timer) clearInterval(timer);
        if (heartbeatTimer) clearInterval(heartbeatTimer);
    }

    function updateUI() {
        const percent = duration > 0 ? Math.min(100, Math.floor((maxWatchedTime / duration) * 100)) : 0;
        
        const badgeText = document.getElementById('watch-percent');
        if (badgeText && !isUnlocked) {
            badgeText.textContent = percent + '% Watched';
        }

        const progressBar = document.getElementById('watch-progress-fill');
        if (progressBar && !isUnlocked) {
            progressBar.style.width = percent + '%';
        }
    }

    function sendHeartbeat() {
        const payload = {
            csrf_token: config.csrfToken,
            video_id: config.videoId,
            current_time: maxWatchedTime,
            duration: duration
        };

        fetch(config.heartbeatApiUrl, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload)
        }).catch(function (err) {
            console.warn('Heartbeat notice:', err);
        });
    }

    function handleVideoCompleted() {
        if (isUnlocked) return;
        isUnlocked = true;
        stopTracking();

        const badgeText = document.getElementById('watch-percent');
        if (badgeText) {
            badgeText.textContent = '100% Completed!';
            badgeText.style.background = '#009ad1';
        }

        const progressBar = document.getElementById('watch-progress-fill');
        if (progressBar) {
            progressBar.style.width = '100%';
            progressBar.style.background = 'linear-gradient(90deg, #009ad1, #7e2b90)';
        }

        // Notify Server to unlock session and issue secure signed token
        const payload = {
            csrf_token: config.csrfToken,
            video_id: config.videoId,
            watched_seconds: Math.floor(maxWatchedTime || duration || 60),
            duration: duration,
            completed: true
        };

        fetch(config.unlockApiUrl, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload)
        })
        .then(function (res) { return res.json(); })
        .then(function (data) {
            if (data.success) {
                triggerUnlockUI();
                openRegistrationModal();
            } else {
                alert(data.error || 'Verification error. Please complete the video.');
                isUnlocked = false;
            }
        })
        .catch(function (err) {
            console.error('Unlock error:', err);
            // Fallback unlock UI
            triggerUnlockUI();
            openRegistrationModal();
        });
    }

    function triggerUnlockUI() {
        // Change title
        const gateTitle = document.getElementById('gate-action-title');
        if (gateTitle) {
            gateTitle.innerHTML = '🎉 Access Unlocked! Download Now or Enter Below';
            gateTitle.classList.remove('locked');
            gateTitle.classList.add('unlocked');
        }

        // Enable download buttons
        const iosBtn = document.getElementById('btn-download-ios');
        if (iosBtn) {
            iosBtn.classList.remove('disabled');
        }

        const androidBtn = document.getElementById('btn-download-android');
        if (androidBtn) {
            androidBtn.classList.remove('disabled');
        }

        // Reveal Enter Website Container
        const enterContainer = document.getElementById('enter-website-container');
        if (enterContainer) {
            enterContainer.style.display = 'block';
        }

        // Launch celebratory confetti
        if (window.confetti) {
            window.confetti({
                particleCount: 120,
                spread: 75,
                origin: { y: 0.6 }
            });
        }
    }

    // Opens the Registration Form Modal
    function openRegistrationModal(immediate) {
        const modal = document.getElementById('reg-auto-modal-overlay');
        if (!modal) return;

        const showModal = function () {
            modal.style.display = 'flex';
            modal.style.opacity = '1';
            modal.style.visibility = 'visible';
            modal.classList.add('active');

            const formContent = document.getElementById('reg-form-content');
            if (formContent) formContent.style.display = 'block';

            const successDiv = document.getElementById('reg-form-success');
            if (successDiv) successDiv.style.display = 'none';

            const firstInput = modal.querySelector('input[name="full_name"]');
            if (firstInput) {
                firstInput.focus();
            }
        };

        if (immediate) {
            showModal();
        } else {
            setTimeout(showModal, 400);
        }
    }

    function closeRegistrationModalAndEnterWebsite() {
        const modal = document.getElementById('reg-auto-modal-overlay');
        if (modal) {
            modal.classList.remove('active');
            modal.style.display = 'none';
        }
        // Navigate user straight to the activated website
        window.location.href = config.redirectUrl || 'index.php';
    }

    // Expose globally for instant inline clicks
    window.openRegistrationModal = function () { openRegistrationModal(true); };
    window.closeRegistrationModal = closeRegistrationModalAndEnterWebsite;

    // Setup interactive events
    document.addEventListener('DOMContentLoaded', function () {
        loadYouTubeApi();

        // Close / Cross (Cors) Button in Registration Modal -> Skips and enters website
        const closeRegBtn = document.getElementById('btn-close-reg-modal');
        if (closeRegBtn) {
            closeRegBtn.addEventListener('click', function (e) {
                e.preventDefault();
                closeRegistrationModalAndEnterWebsite();
            });
        }

        // Skip Link in Registration Modal -> Skips and enters website
        const skipRegBtn = document.getElementById('btn-skip-intro-reg');
        if (skipRegBtn) {
            skipRegBtn.addEventListener('click', function (e) {
                e.preventDefault();
                closeRegistrationModalAndEnterWebsite();
            });
        }

        // Re-open registration button (for already unlocked users)
        const reopenBtn = document.getElementById('btn-reopen-reg');
        if (reopenBtn) {
            reopenBtn.addEventListener('click', function (e) {
                e.preventDefault();
                const modal = document.getElementById('reg-auto-modal-overlay');
                if (modal) {
                    modal.classList.add('active');
                }
            });
        }

        // Category pills selector
        const pills = document.querySelectorAll('#modal-category-pills .reg-pill');
        const catInput = document.getElementById('modal-category-input');
        pills.forEach(function (pill) {
            pill.addEventListener('click', function () {
                pills.forEach(function (p) { p.classList.remove('active'); });
                this.classList.add('active');
                if (catInput) {
                    catInput.value = this.getAttribute('data-category') || 'kindness_ambassador';
                }
            });
        });

        // Registration form AJAX submission
        const regForm = document.getElementById('intro-reg-form');
        if (regForm) {
            regForm.addEventListener('submit', function (e) {
                e.preventDefault();
                const form = this;
                const submitBtn = document.getElementById('btn-submit-intro-reg');
                const alertBox = document.getElementById('intro-reg-alert');
                const formData = new FormData(form);

                const fullName = form.querySelector('[name="full_name"]').value.trim();
                const email = form.querySelector('[name="email"]').value.trim();
                const phone = form.querySelector('[name="phone"]').value.trim();

                if (!fullName || !email || !phone) {
                    alertBox.style.display = 'block';
                    alertBox.className = 'alert alert-danger';
                    alertBox.textContent = 'Please fill in your name, email, and phone number.';
                    return;
                }

                submitBtn.disabled = true;
                const originalHtml = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Submitting Registration...';

                fetch('api/register.php', {
                    method: 'POST',
                    body: formData
                })
                .then(function (res) { return res.json(); })
                .then(function (data) {
                    if (data.success) {
                        document.getElementById('reg-form-content').style.display = 'none';
                        const successDiv = document.getElementById('reg-form-success');
                        successDiv.style.display = 'block';

                        if (window.confetti) {
                            window.confetti({ particleCount: 100, spread: 80, origin: { y: 0.5 } });
                        }

                        let countdown = 3;
                        const cdElem = document.getElementById('reg-countdown');
                        const cdInterval = setInterval(function () {
                            countdown--;
                            if (cdElem) cdElem.textContent = countdown;
                            if (countdown <= 0) {
                                clearInterval(cdInterval);
                                window.location.href = config.redirectUrl || 'index.php';
                            }
                        }, 1000);
                    } else {
                        alertBox.style.display = 'block';
                        alertBox.className = 'alert alert-danger';
                        alertBox.textContent = data.error || 'Registration failed. Please check your details.';
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = originalHtml;
                    }
                })
                .catch(function (err) {
                    alertBox.style.display = 'block';
                    alertBox.className = 'alert alert-danger';
                    alertBox.textContent = 'Connection error. Please try again.';
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalHtml;
                });
            });
        }

        // App download triggers (Coming soon modal)
        const downloadBtns = document.querySelectorAll('.trigger-app-modal');
        const appModal = document.getElementById('app-download-modal');
        const closeAppModal = document.getElementById('close-app-modal');

        downloadBtns.forEach(function (btn) {
            btn.addEventListener('click', function (e) {
                if (btn.classList.contains('disabled')) {
                    e.preventDefault();
                    return;
                }
                e.preventDefault();
                if (appModal) {
                    appModal.classList.add('active');
                }
            });
        });

        if (closeAppModal && appModal) {
            closeAppModal.addEventListener('click', function () {
                appModal.classList.remove('active');
            });
            appModal.addEventListener('click', function (e) {
                if (e.target === appModal) {
                    appModal.classList.remove('active');
                }
            });
        }
    });

})();
