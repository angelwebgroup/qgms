<?php
/**
 * QGMS - Inspiring Kindness Foundation
 * Privacy Policy
 */

require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/includes/gate.php';

// Enforce Video Gatekeeper
VideoGate::requireUnlocked();

$pageTitle = "Privacy Policy - Inspiring Kindness Foundation | QGMS";
$currentPage = "privacy";

require_once __DIR__ . '/includes/header.php';
?>

<section class="py-5 text-white" style="background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 100%);">
    <div class="container text-center">
        <h1 class="display-4 font-weight-bold mb-2">Privacy Policy</h1>
        <p class="lead" style="color: #cbd5e1; font-size: 16px;">How we protect your personal data, child privacy, and kindness recordings.</p>
    </div>
</section>

<section class="py-5" style="background: #ffffff;">
    <div class="container" style="max-width: 900px; line-height: 1.8; color: #334155;">
        <h3 class="font-weight-bold mb-3">1. Information We Collect</h3>
        <p>
            When you register, submit an act of kindness, apply for child support programs (such as Calfresh, EAhousing, NCCP), or make a contribution, we may collect personal identifying information such as your name, email, phone number, and organization details.
        </p>

        <h3 class="font-weight-bold mb-3 mt-4">2. Child &amp; Guardian Privacy</h3>
        <p>
            Protecting the privacy and security of vulnerable and underprivileged children is our foremost priority. We comply with all relevant state and federal standards, including COPPA and HIPAA guidelines where applicable. Sensitive identifying records of minors are encrypted and kept strictly confidential.
        </p>

        <h3 class="font-weight-bold mb-3 mt-4">3. Use of Video &amp; Photographic Submissions</h3>
        <p>
            Acts of kindness submitted to our platform are curated to maintain high standards of dignity, positivity, and consent. Content submitted for community broadcast will only be shared with appropriate permissions.
        </p>

        <h3 class="font-weight-bold mb-3 mt-4">4. Security Measures</h3>
        <p>
            We implement state-of-the-art security architectures, including HTTPS encryption, CSRF protection, rate limiting, and parameterized database queries to ensure that your data is safe from unauthorized access.
        </p>

        <h3 class="font-weight-bold mb-3 mt-4">5. Contact Information</h3>
        <p>
            If you have questions regarding this Privacy Policy, please contact our administrative team at <a href="mailto:<?= SITE_EMAIL ?>" class="font-weight-bold" style="color: var(--primary-pink);"><?= SITE_EMAIL ?></a> or by telephone at <?= SITE_PHONE ?>.
        </p>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
