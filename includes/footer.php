<?php
/**
 * QGMS - Inspiring Kindness Foundation
 * Common Footer Template
 */
?>
    <!-- Main Footer -->
    <footer class="main-footer over-layer-black" style="background: #0f172a; color: #94a3b8; padding: 70px 0 30px;">
        <div class="container">
            <div class="row">
                <!-- Column 1: About Us -->
                <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                    <div class="footer-about-col">
                        <h4 style="color: #fff; font-size: 18px; font-weight: 700; margin-bottom: 20px; text-transform: uppercase;">About Us</h4>
                        <p style="font-size: 13.5px; line-height: 1.7; color: #94a3b8;">
                            We are passionate about creating meaningful experiences and solutions that make a difference. Our mission is to inspire, connect, and empower people through innovative ideas and thoughtful design.
                        </p>
                        <div class="social text-left mt-3">
                            <a href="<?= LINK_FACEBOOK ?>" target="_blank" rel="noopener" class="text-white mr-3"><i class="fa fa-facebook"></i></a>
                            <a href="<?= LINK_TWITTER ?>" target="_blank" rel="noopener" class="text-white mr-3"><i class="fa fa-twitter"></i></a>
                            <a href="<?= LINK_LINKEDIN ?>" target="_blank" rel="noopener" class="text-white mr-3"><i class="fa fa-linkedin"></i></a>
                            <a href="<?= LINK_YOUTUBE ?>" target="_blank" rel="noopener" class="text-white"><i class="fa fa-youtube-play"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Column 2: Quick Links / Tags -->
                <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                    <div class="footer-tags-col">
                        <h4 style="color: #fff; font-size: 18px; font-weight: 700; margin-bottom: 20px; text-transform: uppercase;">Quick Links</h4>
                        <ul class="list-unstyled" style="font-size: 14px; line-height: 2.2;">
                            <li><a href="index.php" style="color: #94a3b8; text-decoration: none;"><i class="fa fa-angle-right mr-2 text-danger"></i> Home</a></li>
                            <li><a href="about.php" style="color: #94a3b8; text-decoration: none;"><i class="fa fa-angle-right mr-2 text-danger"></i> About Us</a></li>
                            <li><a href="why-us.php" style="color: #94a3b8; text-decoration: none;"><i class="fa fa-angle-right mr-2 text-danger"></i> Why Kindness Matters</a></li>
                            <li><a href="team.php" style="color: #94a3b8; text-decoration: none;"><i class="fa fa-angle-right mr-2 text-danger"></i> Leadership Team</a></li>
                            <li><a href="wishes.php" style="color: #94a3b8; text-decoration: none;"><i class="fa fa-angle-right mr-2 text-danger"></i> Child Wishes Gallery</a></li>
                            <li><a href="contact.php" style="color: #94a3b8; text-decoration: none;"><i class="fa fa-angle-right mr-2 text-danger"></i> Contact Us</a></li>
                            <li><a href="privacy-policy.php" style="color: #94a3b8; text-decoration: none;"><i class="fa fa-angle-right mr-2 text-danger"></i> Privacy Policy</a></li>
                            <li><a href="terms.php" style="color: #94a3b8; text-decoration: none;"><i class="fa fa-angle-right mr-2 text-danger"></i> Terms & Conditions</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Column 3: Newsletter & Contact -->
                <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                    <div class="footer-newsletter-col">
                        <h4 style="color: #fff; font-size: 18px; font-weight: 700; margin-bottom: 20px; text-transform: uppercase;">Newsletter</h4>
                        <p style="font-size: 13.5px; color: #94a3b8;">Subscribe to receive inspiring kindness updates and stories.</p>
                        
                        <form id="newsletter-form" class="mt-3">
                            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(Security::getCsrfToken()) ?>">
                            <div class="input-group mb-2">
                                <input type="email" name="email" class="form-control" placeholder="Your Email" required style="border-radius: 4px 0 0 4px; border: none; font-size: 13px;">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit" style="background: var(--primary-pink); border-color: var(--primary-pink); font-size: 13px; font-weight: 700; text-transform: uppercase;">Subscribe</button>
                                </div>
                            </div>
                            <div id="newsletter-msg" style="font-size: 12px; display: none;"></div>
                        </form>
                    </div>
                </div>

                <!-- Column 4: Contact & App Badges -->
                <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                    <div class="footer-contact-col">
                        <h4 style="color: #fff; font-size: 18px; font-weight: 700; margin-bottom: 20px; text-transform: uppercase;">Get In Touch</h4>
                        <p style="font-size: 13.5px; color: #94a3b8; margin-bottom: 8px;">
                            <i class="fa fa-phone mr-2" style="color: var(--primary-pink);"></i> <?= SITE_PHONE ?>
                        </p>
                        <p style="font-size: 13.5px; color: #94a3b8; margin-bottom: 8px;">
                            <i class="fa fa-envelope mr-2" style="color: var(--primary-pink);"></i> <?= SITE_EMAIL ?>
                        </p>
                        <p style="font-size: 13.5px; color: #94a3b8; margin-bottom: 20px;">
                            <i class="fa fa-map-marker mr-2" style="color: var(--primary-pink);"></i> <?= SITE_ADDRESS ?>
                        </p>

                        <div class="app-badges d-flex flex-column gap-2" style="gap: 10px;">
                            <a href="#" class="trigger-app-modal d-inline-block">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/7/78/Google_Play_Store_badge_EN.svg" alt="Google Play" style="height: 38px;">
                            </a>
                            <a href="#" class="trigger-app-modal d-inline-block mt-2">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/3/3c/Download_on_the_App_Store_Badge.svg" alt="App Store" style="height: 38px;">
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="border-top pt-4 mt-3 text-center" style="border-color: rgba(255,255,255,0.1) !important;">
                <p style="font-size: 13px; color: #64748b; margin: 0;">
                    &copy; <?= date('Y') ?> <?= SITE_NAME ?>. All rights reserved.
                </p>
            </div>
        </div>
    </footer>

    <!-- Coming Soon Modal for Apps -->
    <div id="app-download-modal" class="qgms-modal-overlay">
        <div class="qgms-modal-card">
            <div class="qgms-modal-stripe"></div>
            <div class="qgms-modal-icon">
                <i class="fa fa-mobile"></i>
            </div>
            <h3 class="qgms-modal-title">Coming Soon!</h3>
            <p class="qgms-modal-desc">
                We are working diligently to bring the official QGMS Inspiring Kindness app to your iOS and Android devices. The mobile apps are currently in final refinement. Stay tuned!
            </p>
            <button id="close-app-modal" type="button" class="qgms-modal-btn">Got it, thanks!</button>
        </div>
    </div>

    <!-- Floating Audio / Accessibility Button -->
    <button class="sound-toggle-btn" id="sound-toggle" title="Toggle Background Music / Audio" aria-label="Audio">
        <i class="fa fa-volume-up"></i>
    </button>

    <!-- Core Scripts -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/slick.min.js"></script>

    <script>
    // Newsletter submission AJAX
    document.getElementById('newsletter-form')?.addEventListener('submit', function(e) {
        e.preventDefault();
        const form = this;
        const msg = document.getElementById('newsletter-msg');
        const formData = new FormData(form);

        fetch('api/newsletter.php', {
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
                msg.textContent = data.error || 'Subscription failed.';
            }
        })
        .catch(() => {
            msg.style.display = 'block';
            msg.style.color = '#ef4444';
            msg.textContent = 'Server connection error. Please try again.';
        });
    });

    // Sound toggle state
    let soundEnabled = true;
    document.getElementById('sound-toggle')?.addEventListener('click', function() {
        soundEnabled = !soundEnabled;
        const icon = this.querySelector('i');
        if (soundEnabled) {
            icon.className = 'fa fa-volume-up';
        } else {
            icon.className = 'fa fa-volume-off';
        }
    });
    </script>
</body>
</html>
