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

<section class="py-5 text-white" style="background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 100%);">
    <div class="container text-center">
        <h1 class="display-4 font-weight-bold mb-2">Terms &amp; Conditions</h1>
        <p class="lead" style="color: #cbd5e1; font-size: 16px;">Guidelines and mutual agreements governing your use of QGMS platforms.</p>
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
