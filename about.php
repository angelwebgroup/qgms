<?php
/**
 * QGMS - Quality Giving Management System
 * Run by QGM Inc. - System Provider for Non-Profit Aid Logistics & IK Campaigns
 * About QGMS & The Inspiring Kindness Campaign
 */

require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/includes/gate.php';

// Enforce Video Gatekeeper
VideoGate::requireUnlocked();

$pageTitle = "About QGMS & The IK Campaign | Run by QGM Inc.";
$pageDesc = "Learn about QGMS, operated by QGM Inc. as the enterprise system provider powering non-profit aid logistics and the Inspiring Kindness campaign.";
$currentPage = "about";

require_once __DIR__ . '/includes/header.php';
?>

<!-- Hero Banner: About Our Movement -->
<section class="page-hero-wrapper text-center">
    <div class="page-hero-grid-pattern"></div>
    <div class="container page-hero-content">
        <div class="hero-tag-badge">
            <i class="fa fa-info-circle"></i> Run by QGM Inc. &bull; System Provider
        </div>
        <h1 class="page-hero-title">
            ABOUT <span class="hero-highlight-text">QGMS &amp; IK CAMPAIGN</span>
        </h1>
        <p class="page-hero-subtitle">
            Enterprise technology powering non-profit aid logistics and transforming everyday compassion into a measurable global ripple effect.
        </p>
        <div class="hero-breadcrumb">
            <a href="index.php"><i class="fa fa-home"></i> Home</a>
            <span>&bull;</span>
            <span class="text-white">About</span>
        </div>
    </div>
</section>

<!-- Main About Content -->
<section class="py-5" style="background: #ffffff;">
    <div class="container">
        <div class="row align-items-center mb-5">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <span class="badge badge-pill badge-primary px-3 py-2 text-uppercase mb-3" style="background: var(--primary-brand); font-size: 12px;">System Provider</span>
                <h2 class="font-weight-bold mb-4" style="color: #0f172a; font-size: 34px;">
                    QGMS &amp; The <span style="color: var(--primary-brand);">Inspiring Kindness Campaign</span>
                </h2>
                <p style="font-size: 15px; line-height: 1.8; color: #475569;">
                    <strong>QGMS (Quality Giving Management System)</strong> is operated by <strong>QGM Inc.</strong> We are the dedicated system provider providing the software, intake workflows, and auditable logistics architecture for the <strong>Inspiring Kindness (IK) campaign</strong>, which is run by independent non-profit organizations.
                </p>
                <p style="font-size: 15px; line-height: 1.8; color: #475569;">
                    For more than a decade, our team has developed and refined a unique methodology built on emotional intelligence, behavioral science, and real-world compassion. This approach &mdash; <strong>Catch. Recognize. Reward. Inspire.</strong> &mdash; transforms everyday moments of kindness into an ongoing chain of positive action.
                </p>
                <p style="font-size: 15px; line-height: 1.8; color: #475569;">
                    By bridging cutting-edge digital infrastructure with non-profit humanitarian aid, QGMS equips charities and county welfare organizations to manage program logistics, distribute verified aid vouchers, and reward positive civic contributions.
                </p>
            </div>
            <div class="col-lg-6">
                <div class="rounded-2xl overflow-hidden shadow-xl" style="border-radius: 20px;">
                    <img src="images/about/a1.jpeg" alt="Inspiring Kindness Movement" class="img-fluid w-100">
                </div>
            </div>
        </div>

        <!-- Vision and Mission -->
        <div class="row pt-4">
            <div class="col-md-6 mb-4">
                <div class="card h-100 border-0 shadow-sm p-4" style="border-radius: 20px; border-top: 5px solid var(--primary-brand);">
                    <div class="d-flex align-items-center mb-3">
                        <div class="mr-3 p-3 rounded-circle" style="background: rgba(0, 154, 209, 0.1); color: var(--primary-brand); font-size: 24px;">
                            <i class="fa fa-eye"></i>
                        </div>
                        <h3 class="font-weight-bold mb-0" style="color: #0f172a;">Our Vision</h3>
                    </div>
                    <p style="font-size: 14.5px; line-height: 1.8; color: #475569;">
                        We envision a world where kindness is not random, but recognized &mdash; where caring for others is a natural part of everyday life and the driving force of social change. A world where compassion is valued as a strength, not a sentiment, and where the attention we give is directed toward people and actions that truly make a difference.
                    </p>
                    <p style="font-size: 14.5px; line-height: 1.8; color: #475569;">
                        In this world, technology doesn't divide &mdash; it unites. It amplifies empathy, highlights human goodness, and turns small, genuine moments of care into an ongoing chain of inspiration.
                    </p>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card h-100 border-0 shadow-sm p-4" style="border-radius: 20px; border-top: 5px solid #3b82f6;">
                    <div class="d-flex align-items-center mb-3">
                        <div class="mr-3 p-3 rounded-circle" style="background: rgba(59, 130, 246, 0.1); color: #3b82f6; font-size: 24px;">
                            <i class="fa fa-bullseye"></i>
                        </div>
                        <h3 class="font-weight-bold mb-0" style="color: #0f172a;">Our Mission</h3>
                    </div>
                    <p style="font-size: 14.5px; line-height: 1.8; color: #475569;">
                        Our mission is to transform care and kindness from ideas into measurable, sustainable action. We do this by inspiring individuals, organizations, and communities to catch, recognize, reward, and share real acts of compassion &mdash; creating a continuous ripple of positive emotional and social impact.
                    </p>
                    <p style="font-size: 14.5px; line-height: 1.8; color: #475569;">
                        We aim to bridge the gap between emotion and action, translating what science already knows &mdash; that kindness heals, connects, and sustains &mdash; into practical, everyday behavior.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Methodology Detail Section -->
<section id="methodology" class="py-5" style="background: #f8fafc;">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="font-weight-bold" style="font-size: 34px;">
                The Methodology: Catch, Recognize, Reward, Inspire
            </h2>
            <div class="title-bdr" style="width: 80px; height: 3px; background: var(--primary-brand); margin: 15px auto;"></div>
        </div>

        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <p style="font-size: 15px; line-height: 1.8; color: #334155;">
                    The Inspiring Kindness methodology is an innovative framework combining behavioral economics, modern gamification, and digital validation to incentivize and multiply acts of service.
                </p>
                <div class="p-3 mb-3 bg-white rounded-lg shadow-sm" style="border-left: 4px solid var(--primary-brand);">
                    <h5 class="font-weight-bold mb-1">1. Catch</h5>
                    <p class="text-muted mb-0" style="font-size: 13.5px;">Observing genuine gestures of benevolence in schools, neighborhoods, and workplaces.</p>
                </div>
                <div class="p-3 mb-3 bg-white rounded-lg shadow-sm" style="border-left: 4px solid #3b82f6;">
                    <h5 class="font-weight-bold mb-1">2. Recognize</h5>
                    <p class="text-muted mb-0" style="font-size: 13.5px;">Publicly validating and celebrating the actor with digital certificates and community acknowledgment.</p>
                </div>
                <div class="p-3 mb-3 bg-white rounded-lg shadow-sm" style="border-left: 4px solid #10b981;">
                    <h5 class="font-weight-bold mb-1">3. Reward</h5>
                    <p class="text-muted mb-0" style="font-size: 13.5px;">Issuing a Gift Card for Giving that empowers the recipient to sponsor or fulfill a wish for an underprivileged child.</p>
                </div>
                <div class="p-3 bg-white rounded-lg shadow-sm" style="border-left: 4px solid #f59e0b;">
                    <h5 class="font-weight-bold mb-1">4. Inspire</h5>
                    <p class="text-muted mb-0" style="font-size: 13.5px;">Sharing the story globally to motivate countless others to perform kind deeds.</p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="embed-responsive embed-responsive-16by9 shadow-lg rounded-xl overflow-hidden" style="border-radius: 16px;">
                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/_cJHYiNMfiI?rel=0" title="Inspiring Kindness Methodology" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
