<?php
/**
 * QGMS - Inspiring Kindness Foundation
 * Contact Us Page
 */

require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/includes/gate.php';
require_once __DIR__ . '/includes/security.php';

// Enforce Video Gatekeeper
VideoGate::requireUnlocked();

$pageTitle = "Contact Us - Inspiring Kindness Foundation | QGMS";
$pageDesc = "Get in touch with Henrik and the Inspiring Kindness Foundation team.";
$currentPage = "contact";

require_once __DIR__ . '/includes/header.php';
?>

<!-- Hero Banner: Get in Touch -->
<section class="page-hero-wrapper text-center">
    <div class="page-hero-grid-pattern"></div>
    <div class="container page-hero-content">
        <div class="hero-tag-badge">
            <i class="fa fa-envelope-open"></i> Connect &bull; Collaborate &bull; Share
        </div>
        <h1 class="page-hero-title">
            GET IN <span class="hero-highlight-text">TOUCH</span>
        </h1>
        <p class="page-hero-subtitle">
            We would love to hear from you. Reach out with inquiries, partnerships, sponsorship ideas, or inspiring kindness stories.
        </p>
        <div class="hero-breadcrumb">
            <a href="index.php"><i class="fa fa-home"></i> Home</a>
            <span>&bull;</span>
            <span class="text-white">Contact Us</span>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="py-5" style="background: #ffffff;">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-4 mb-3">
                <div class="p-4 bg-light rounded-xl text-center h-100 shadow-sm" style="border-radius: 20px;">
                    <div class="mx-auto mb-3" style="width: 64px; height: 64px; border-radius: 50%; background: rgba(0, 154, 209, 0.1); color: var(--primary-brand); display: flex; align-items: center; justify-content: center; font-size: 26px;">
                        <i class="fa fa-map-marker"></i>
                    </div>
                    <h5 class="font-weight-bold mb-2">Our Office</h5>
                    <p class="text-muted mb-0" style="font-size: 14.5px;"><?= SITE_ADDRESS ?></p>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="p-4 bg-light rounded-xl text-center h-100 shadow-sm" style="border-radius: 20px;">
                    <div class="mx-auto mb-3" style="width: 64px; height: 64px; border-radius: 50%; background: rgba(0, 154, 209, 0.1); color: var(--primary-brand); display: flex; align-items: center; justify-content: center; font-size: 26px;">
                        <i class="fa fa-envelope"></i>
                    </div>
                    <h5 class="font-weight-bold mb-2">Direct Email</h5>
                    <p class="text-muted mb-0" style="font-size: 14.5px;"><a href="mailto:<?= SITE_EMAIL ?>" class="text-dark font-weight-bold"><?= SITE_EMAIL ?></a></p>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="p-4 bg-light rounded-xl text-center h-100 shadow-sm" style="border-radius: 20px;">
                    <div class="mx-auto mb-3" style="width: 64px; height: 64px; border-radius: 50%; background: rgba(0, 154, 209, 0.1); color: var(--primary-brand); display: flex; align-items: center; justify-content: center; font-size: 26px;">
                        <i class="fa fa-phone"></i>
                    </div>
                    <h5 class="font-weight-bold mb-2">Phone Inquiries</h5>
                    <p class="text-muted mb-0" style="font-size: 14.5px;"><a href="tel:<?= str_replace([' ', '.'], '', SITE_PHONE) ?>" class="text-dark font-weight-bold"><?= SITE_PHONE ?></a></p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="card border-0 shadow-sm p-4 p-md-5" style="border-radius: 24px;">
                    <h3 class="font-weight-bold mb-2" style="color: #0f172a;">Send Us a Message</h3>
                    <p class="text-muted mb-4" style="font-size: 14px;">Fill out the form below and Henrik will review your submission directly.</p>

                    <form id="page-contact-form">
                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(Security::getCsrfToken()) ?>">
                        
                        <div class="form-group mb-3">
                            <label class="font-weight-bold text-dark" style="font-size: 13.5px;">Your Name *</label>
                            <input type="text" name="name" class="form-control" placeholder="John Doe" required style="border-radius: 10px; padding: 14px;">
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6 mb-3">
                                <label class="font-weight-bold text-dark" style="font-size: 13.5px;">Email Address *</label>
                                <input type="email" name="email" class="form-control" placeholder="john@example.com" required style="border-radius: 10px; padding: 14px;">
                            </div>
                            <div class="form-group col-md-6 mb-3">
                                <label class="font-weight-bold text-dark" style="font-size: 13.5px;">Phone Number</label>
                                <input type="text" name="phone" class="form-control" placeholder="+1 669 000 0000" style="border-radius: 10px; padding: 14px;">
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label class="font-weight-bold text-dark" style="font-size: 13.5px;">Message *</label>
                            <textarea name="message" class="form-control" rows="5" placeholder="Write your message here..." required style="border-radius: 10px; padding: 14px;"></textarea>
                        </div>

                        <button type="submit" class="btn btn-donate w-100" style="padding: 14px; font-size: 16px; border-radius: 12px;">
                            Submit Message
                        </button>

                        <div id="page-contact-msg" class="mt-3 text-center" style="display: none; font-weight: 600;"></div>
                    </form>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="rounded-2xl overflow-hidden shadow-sm h-100" style="border-radius: 24px; min-height: 440px;">
                    <iframe src="https://maps.google.com/maps?q=2241%20Churchill%20Dr.%20Milpitas,%20CA%2095035&t=&z=13&ie=UTF8&iwloc=&output=embed" width="100%" height="100%" style="border:0; min-height: 440px;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.getElementById('page-contact-form')?.addEventListener('submit', function(e) {
    e.preventDefault();
    const form = this;
    const msg = document.getElementById('page-contact-msg');
    const formData = new FormData(form);

    fetch('api/contact.php', {
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
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
