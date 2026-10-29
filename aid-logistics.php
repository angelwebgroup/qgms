<?php
/**
 * QGMS - Quality Giving Management System
 * Run by QGM Inc. - System Provider for Non-Profit Aid Logistics & IK Campaigns
 * Aid Logistics Solutions & System Capabilities Overview
 */

require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/includes/gate.php';

// Enforce Video Gatekeeper
VideoGate::requireUnlocked();

$pageTitle = "Aid Logistics Solutions - QGMS | Run by QGM Inc.";
$pageDesc = "Explore how QGMS optimizes non-profit aid logistics, digital beneficiary intake, and campaign workflows.";
$currentPage = "aid-logistics";

require_once __DIR__ . '/includes/header.php';
?>

<!-- Hero Banner: Aid Logistics & System Capabilities -->
<section class="page-hero-wrapper text-center">
    <div class="page-hero-grid-pattern"></div>
    <div class="container page-hero-content">
        <div class="hero-tag-badge">
            <i class="fa fa-cubes"></i> System Architecture &bull; Powered by QGM Inc.
        </div>
        <h1 class="page-hero-title">
            OPTIMIZING <span class="hero-highlight-text">AID LOGISTICS</span>
        </h1>
        <p class="page-hero-subtitle">
            Enterprise system infrastructure engineered to streamline non-profit operations, eliminate distribution friction, and power the Inspiring Kindness campaign.
        </p>
        <div class="hero-breadcrumb">
            <a href="index.php"><i class="fa fa-home"></i> Home</a>
            <span>&bull;</span>
            <span class="text-white">Aid Logistics Solutions</span>
        </div>
    </div>
</section>

<!-- Section 1: Executive Overview -->
<section class="py-5" style="background: #ffffff;">
    <div class="container">
        <div class="row align-items-center mb-5">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <span class="badge badge-pill badge-primary px-3 py-2 text-uppercase mb-3" style="background: var(--primary-brand); font-size: 12px;">Enterprise System Provider</span>
                <h2 class="font-weight-bold mb-3" style="color: #0f172a; font-size: 34px;">
                    Technology Infrastructure for <span style="color: var(--primary-brand);">Modern Non-Profits</span>
                </h2>
                <p style="font-size: 15.5px; line-height: 1.8; color: #475569;">
                    <strong>QGMS (Quality Giving Management System)</strong>, operated by <strong>QGM Inc.</strong>, is the dedicated system provider powering the <strong>Inspiring Kindness (IK) campaign</strong> run by non-profit organizations.
                </p>
                <p style="font-size: 15px; line-height: 1.8; color: #475569;">
                    Traditional charitable aid often struggles with fragmented logistics, slow verification, manual paperwork, and high administrative overhead. QGMS solves these systemic bottlenecks by delivering an end-to-end digital logistics backbone &mdash; enabling non-profits to optimize aid distribution, verify outcomes in real-time, and scale their community impact.
                </p>
                <div class="d-flex flex-wrap gap-3 mt-4">
                    <a href="register.php" class="btn btn-donate mr-3 mb-2" style="padding: 12px 30px;">
                        <i class="fa fa-user-plus mr-1"></i> Register Your Organization
                    </a>
                    <a href="contact.php" class="btn btn-outline-dark mb-2" style="border-radius: 50px; padding: 12px 28px; font-weight: 600;">
                        <i class="fa fa-envelope mr-1"></i> Request System Demo
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="p-4 p-md-5 rounded-2xl shadow-lg position-relative overflow-hidden" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); color: #ffffff; border-radius: 24px; border: 1px solid rgba(0, 154, 209, 0.3);">
                    <div style="position: absolute; top: -30px; right: -30px; width: 140px; height: 140px; background: rgba(0, 154, 209, 0.15); border-radius: 50%; filter: blur(30px);"></div>
                    <h3 class="font-weight-bold mb-4" style="color: #38bdf8; font-size: 22px;">
                        <i class="fa fa-sliders mr-2"></i> How QGMS Transforms Logistics
                    </h3>
                    <ul class="list-unstyled mb-0" style="font-size: 14.5px; line-height: 2.2;">
                        <li><i class="fa fa-check-circle text-info mr-2"></i> <strong>70% Faster Intake:</strong> Automated eligibility routing for CalFresh, EA Housing, &amp; NCCP.</li>
                        <li><i class="fa fa-check-circle text-info mr-2"></i> <strong>Zero Aid Leakage:</strong> Digital Gift Cards for Giving with cryptographic traceability.</li>
                        <li><i class="fa fa-check-circle text-info mr-2"></i> <strong>Multi-Agency Sync:</strong> Connects community non-profits with county social services seamlessly.</li>
                        <li><i class="fa fa-check-circle text-info mr-2"></i> <strong>Proof of Delivery:</strong> Photo/video verification before wish completion is logged.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section 2: Four Core Logistics Capabilities -->
<section class="py-5" style="background: #f8fafc; border-top: 1px solid #e2e8f0; border-bottom: 1px solid #e2e8f0;">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge badge-pill badge-primary px-3 py-2 text-uppercase mb-2" style="background: var(--primary-brand); font-size: 12px;">Core Capabilities</span>
            <h2 class="font-weight-bold" style="font-size: 34px; color: #0f172a;">
                What QGMS Offers to Optimize <span style="color: var(--primary-brand);">Non-Profit Aid</span>
            </h2>
            <div class="title-bdr" style="width: 80px; height: 3px; background: var(--primary-brand); margin: 15px auto;"></div>
            <p class="text-muted" style="max-width: 650px; margin: 0 auto;">Designed to address the specific operational demands of community organizations, food assistance, and emergency housing networks.</p>
        </div>

        <div class="row">
            <!-- Pillar 1 -->
            <div class="col-lg-6 mb-4">
                <div class="card h-100 border-0 shadow-sm p-4" style="border-radius: 20px; border-left: 5px solid var(--primary-brand); background: #ffffff;">
                    <div class="d-flex align-items-center mb-3">
                        <div class="mr-3 p-3 rounded-circle" style="background: rgba(0, 154, 209, 0.1); color: var(--primary-brand); font-size: 26px;">
                            <i class="fa fa-users"></i>
                        </div>
                        <div>
                            <h4 class="font-weight-bold mb-1" style="color: #0f172a;">Automated Intake &amp; Eligibility</h4>
                            <span class="badge badge-light text-muted">Program Enrollment Logistics</span>
                        </div>
                    </div>
                    <p style="font-size: 14.5px; line-height: 1.8; color: #475569;">
                        QGMS streamlines beneficiary applications across multiple assistance categories including <strong>CalFresh Support, EA Housing, NCCP Family Care, and County Assistance Networks</strong>. Digital workflows replace chaotic paper records, routing requests directly to the appropriate coordinators for rapid review and dispatch.
                    </p>
                </div>
            </div>

            <!-- Pillar 2 -->
            <div class="col-lg-6 mb-4">
                <div class="card h-100 border-0 shadow-sm p-4" style="border-radius: 20px; border-left: 5px solid #7e2b90; background: #ffffff;">
                    <div class="d-flex align-items-center mb-3">
                        <div class="mr-3 p-3 rounded-circle" style="background: rgba(126, 43, 144, 0.1); color: #7e2b90; font-size: 26px;">
                            <i class="fa fa-credit-card"></i>
                        </div>
                        <div>
                            <h4 class="font-weight-bold mb-1" style="color: #0f172a;">Gift Card for Giving Distribution</h4>
                            <span class="badge badge-light text-muted">100% Traceable Aid Logistics</span>
                        </div>
                    </div>
                    <p style="font-size: 14.5px; line-height: 1.8; color: #475569;">
                        Physical aid and cash disbursements often suffer from heavy transport costs, delays, and distribution losses. The <strong>Gift Card for Giving</strong> mechanism digitizes the entire giving cycle &mdash; issuing verified credits directly to authenticated beneficiaries to sponsor essential goods or fulfill specific children's wishes at zero cost to the recipient.
                    </p>
                </div>
            </div>

            <!-- Pillar 3 -->
            <div class="col-lg-6 mb-4">
                <div class="card h-100 border-0 shadow-sm p-4" style="border-radius: 20px; border-left: 5px solid #10b981; background: #ffffff;">
                    <div class="d-flex align-items-center mb-3">
                        <div class="mr-3 p-3 rounded-circle" style="background: rgba(16, 185, 129, 0.1); color: #10b981; font-size: 26px;">
                            <i class="fa fa-sitemap"></i>
                        </div>
                        <div>
                            <h4 class="font-weight-bold mb-1" style="color: #0f172a;">Multi-Agency Operational Sync</h4>
                            <span class="badge badge-light text-muted">Cross-Sector Coordination</span>
                        </div>
                    </div>
                    <p style="font-size: 14.5px; line-height: 1.8; color: #475569;">
                        Non-profits frequently work in silos. QGMS provides a unified ecosystem that synchronizes non-profit staff, county government agencies (such as Santa Clara County and Marin County), law enforcement champions, and community donors on a single, permission-controlled platform.
                    </p>
                </div>
            </div>

            <!-- Pillar 4 -->
            <div class="col-lg-6 mb-4">
                <div class="card h-100 border-0 shadow-sm p-4" style="border-radius: 20px; border-left: 5px solid #f59e0b; background: #ffffff;">
                    <div class="d-flex align-items-center mb-3">
                        <div class="mr-3 p-3 rounded-circle" style="background: rgba(245, 158, 11, 0.1); color: #f59e0b; font-size: 26px;">
                            <i class="fa fa-line-chart"></i>
                        </div>
                        <div>
                            <h4 class="font-weight-bold mb-1" style="color: #0f172a;">Real-Time Tracking &amp; Verification</h4>
                            <span class="badge badge-light text-muted">Auditable Delivery Validation</span>
                        </div>
                    </div>
                    <p style="font-size: 14.5px; line-height: 1.8; color: #475569;">
                        Every dollar donated, every wish sponsored, and every act of kindness recorded is tracked from initial pledge to verified fulfillment. Donors and program administrators receive instant confirmation, photographic updates, and tamper-proof verification logs.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section 3: Comparative Breakdown -->
<section class="py-5" style="background: #ffffff;">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="font-weight-bold" style="font-size: 32px; color: #0f172a;">
                Traditional Aid Operations vs. <span style="color: var(--primary-brand);">QGMS Optimization</span>
            </h2>
            <div class="title-bdr" style="width: 80px; height: 3px; background: var(--primary-brand); margin: 15px auto;"></div>
        </div>

        <div class="table-responsive shadow-sm rounded-xl overflow-hidden" style="border-radius: 16px; border: 1px solid #e2e8f0;">
            <table class="table table-hover mb-0" style="font-size: 14.5px;">
                <thead style="background: #0f172a; color: #ffffff;">
                    <tr>
                        <th style="padding: 18px 24px;">Logistics Dimension</th>
                        <th style="padding: 18px 24px; color: #94a3b8;">Traditional Non-Profit Process</th>
                        <th style="padding: 18px 24px; color: #38bdf8;">QGMS Optimized Infrastructure</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="font-weight-bold" style="padding: 18px 24px; color: #0f172a;">Beneficiary Intake</td>
                        <td style="padding: 18px 24px; color: #64748b;">Manual paper forms, delayed telephone screening, high drop-off</td>
                        <td style="padding: 18px 24px; color: #0284c7; font-weight: 600;"><i class="fa fa-check text-success mr-2"></i> Instant mobile registration &amp; program-specific pill routing</td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold" style="padding: 18px 24px; color: #0f172a;">Aid Delivery Method</td>
                        <td style="padding: 18px 24px; color: #64748b;">Physical checks, cash handling, cumbersome product shipping</td>
                        <td style="padding: 18px 24px; color: #0284c7; font-weight: 600;"><i class="fa fa-check text-success mr-2"></i> Instant digital Gift Cards for Giving on mobile devices</td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold" style="padding: 18px 24px; color: #0f172a;">Delivery Auditability</td>
                        <td style="padding: 18px 24px; color: #64748b;">Periodic manual audits with significant paperwork lag</td>
                        <td style="padding: 18px 24px; color: #0284c7; font-weight: 600;"><i class="fa fa-check text-success mr-2"></i> Real-time wish progress &amp; cryptographic transaction verification</td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold" style="padding: 18px 24px; color: #0f172a;">Inter-Agency Collaboration</td>
                        <td style="padding: 18px 24px; color: #64748b;">Isolated spreadsheets and disjointed email chains</td>
                        <td style="padding: 18px 24px; color: #0284c7; font-weight: 600;"><i class="fa fa-check text-success mr-2"></i> Synchronized multi-agency access with automated alerts to Henrik &amp; team</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- Section 4: Call to Action -->
<section class="py-5" style="background: linear-gradient(135deg, #009ad1 0%, #7e2b90 100%); color: #ffffff;">
    <div class="container text-center py-4">
        <h2 class="font-weight-bold mb-3" style="font-size: 34px;">Ready to Modernize Your Non-Profit's Aid Logistics?</h2>
        <p class="lead mb-4" style="color: #f0f9ff; max-width: 680px; margin: 0 auto; font-size: 16px;">
            Join the forward-thinking non-profits powering their giving campaigns with QGMS. Complete your registration or contact Henrik to get started.
        </p>
        <div class="d-flex flex-wrap justify-content-center gap-3">
            <a href="register.php" class="btn btn-light font-weight-bold mr-3 mb-2" style="padding: 14px 38px; border-radius: 50px; color: #009ad1; font-size: 15px; box-shadow: 0 10px 25px rgba(0,0,0,0.15);">
                <i class="fa fa-user-plus mr-1"></i> Register with QGMS
            </a>
            <a href="mailto:<?= SITE_EMAIL ?>" class="btn btn-outline-light font-weight-bold mb-2" style="padding: 14px 36px; border-radius: 50px; font-size: 15px; border-width: 2px;">
                <i class="fa fa-envelope mr-1"></i> Contact Henrik (<?= SITE_EMAIL ?>)
            </a>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
