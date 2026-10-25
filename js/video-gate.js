/**
 * QGMS - Video Gatekeeper Script
 * Implements YouTube IFrame API with anti-tamper progress tracking & unlocking
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
        redirectUrl: 'index.php'
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
        if (badgeText) {
            badgeText.textContent = percent + '% Watched';
        }

        const progressBar = document.getElementById('watch-progress-fill');
        if (progressBar) {
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
            badgeText.style.background = '#10b981';
        }

        const progressBar = document.getElementById('watch-progress-fill');
        if (progressBar) {
            progressBar.style.width = '100%';
            progressBar.style.background = '#10b981';
        }

        // Notify Server to unlock session and issue secure signed token
        const payload = {
            csrf_token: config.csrfToken,
            video_id: config.videoId,
            watched_seconds: Math.floor(maxWatchedTime),
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
                triggerUnlockUI(data.redirect || config.redirectUrl);
            } else {
                alert(data.error || 'Verification failed. Please complete the video.');
                isUnlocked = false;
            }
        })
        .catch(function (err) {
            console.error('Unlock error:', err);
            // Fallback unlock UI
            triggerUnlockUI(config.redirectUrl);
        });
    }

    function triggerUnlockUI(redirectUrl) {
        // Change title
        const gateTitle = document.getElementById('gate-action-title');
        if (gateTitle) {
            gateTitle.innerHTML = '🎉 Access Unlocked! Download Now';
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

        // Reveal Enter Website Button
        const enterContainer = document.getElementById('enter-website-container');
        if (enterContainer) {
            enterContainer.style.display = 'block';
            enterContainer.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }

        // Launch celebrate confetti if canvas exists
        if (window.confetti) {
            window.confetti({
                particleCount: 100,
                spread: 70,
                origin: { y: 0.6 }
            });
        }
    }

    // Initialize when DOM is ready
    document.addEventListener('DOMContentLoaded', function () {
        loadYouTubeApi();

        // Attach modal triggers for Download buttons
        const downloadBtns = document.querySelectorAll('.trigger-app-modal');
        const modalOverlay = document.getElementById('app-download-modal');
        const modalClose = document.getElementById('close-app-modal');

        downloadBtns.forEach(function (btn) {
            btn.addEventListener('click', function (e) {
                if (btn.classList.contains('disabled')) {
                    e.preventDefault();
                    return;
                }
                e.preventDefault();
                if (modalOverlay) {
                    modalOverlay.classList.add('active');
                }
            });
        });

        if (modalClose && modalOverlay) {
            modalClose.addEventListener('click', function () {
                modalOverlay.classList.remove('active');
            });
            modalOverlay.addEventListener('click', function (e) {
                if (e.target === modalOverlay) {
                    modalOverlay.classList.remove('active');
                }
            });
        }
    });

})();
