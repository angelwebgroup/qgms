<?php
/**
 * QGMS - Inspiring Kindness Foundation
 * Terms and Conditions
 */

require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/includes/gate.php';

// Enforce Video Gatekeeper
VideoGate::requireUnlocked();

$pageTitle = "Terms and Conditions - Inspiring Kindness Foundation | QGMS";
$currentPage = "terms";

require_once __DIR__ . '/includes/header.php';
?>

<!-- Hero Banner: Terms & Conditions -->
<section class="page-hero-wrapper text-center">
    <div class="page-hero-grid-pattern"></div>
    <div class="container page-hero-content">
        <div class="hero-tag-badge">
            <i class="fa fa-file-text-o"></i> Governance &bull; Transparency
        </div>
        <h1 class="page-hero-title">
            TERMS &amp; <span class="hero-highlight-text">CONDITIONS</span>
        </h1>
        <p class="page-hero-subtitle">
            Guidelines, rights, and mutual agreements governing your use of Inspiring Kindness Foundation and QGMS platforms.
        </p>
        <div class="hero-breadcrumb">
            <a href="index.php"><i class="fa fa-home"></i> Home</a>
            <span>&bull;</span>
            <span class="text-white">Terms &amp; Conditions</span>
        </div>
    </div>
</section>

<section class="py-5" style="background: #ffffff;">
    <div class="container" style="max-width: 900px; line-height: 1.8; color: #334155;">
        <h3 class="font-weight-bold mb-3">1. Acceptance of Terms</h3>
        <p>
            By accessing or using the Inspiring Kindness Foundation web application, you agree to be bound by these Terms and Conditions and our Privacy Policy. If you do not agree with any part of these terms, please do not use our services.
        </p>

        <h3 class="font-weight-bold mb-3 mt-4">2. Program Participation</h3>
        <p>
            All participants, donors, and guardians registered with QGMS agree to provide truthful, accurate information when registering for support programs (such as Calfresh, EAhousing, NCCP, etc.) or when redeeming Gift Cards for Giving.
        </p>

        <h3 class="font-weight-bold mb-3 mt-4">3. Code of Conduct</h3>
        <p>
            Our community is established upon respect, dignity, and mutual empowerment. Content submitted that promotes hate speech, discrimination, commercial exploitation, or harassment will be immediately removed and the offending account terminated.
        </p>

        <h3 class="font-weight-bold mb-3 mt-4">4. Disclaimers &amp; Limitations</h3>
        <p>
            Inspiring Kindness Foundation provides this platform as a charitable vehicle for positive social mobilization. While we verify partner organizations and wishes to the highest practical standard, services are provided on an "as-is" and "as-available" basis.
        </p>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
