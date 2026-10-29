<?php
/**
 * QGMS - Quality Giving Management System
 * Run by QGM Inc. - System Provider for Non-Profit Aid Logistics & IK Campaigns
 * Privacy Policy
 */

require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/includes/gate.php';

// Enforce Video Gatekeeper
VideoGate::requireUnlocked();

$pageTitle = "Privacy Policy - QGMS | Run by QGM Inc.";
$currentPage = "privacy";

require_once __DIR__ . '/includes/header.php';
?>

<!-- Hero Banner: Privacy Policy -->
<section class="page-hero-wrapper text-center">
    <div class="page-hero-grid-pattern"></div>
    <div class="container page-hero-content">
        <div class="hero-tag-badge">
            <i class="fa fa-shield"></i> Trust &bull; Security &bull; Protection
        </div>
        <h1 class="page-hero-title">
            PRIVACY <span class="hero-highlight-text">POLICY</span>
        </h1>
        <p class="page-hero-subtitle">
            How we protect your personal data, child privacy, and kindness recordings with industry-standard encryption and strict safeguards.
        </p>
        <div class="hero-breadcrumb">
            <a href="index.php"><i class="fa fa-home"></i> Home</a>
            <span>&bull;</span>
            <span class="text-white">Privacy Policy</span>
        </div>
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
            If you have questions regarding this Privacy Policy, please contact our administrative team at <a href="mailto:<?= SITE_EMAIL ?>" class="font-weight-bold" style="color: var(--primary-brand);"><?= SITE_EMAIL ?></a> or by telephone at <?= SITE_PHONE ?>.
        </p>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
