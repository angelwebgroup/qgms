<?php
/**
 * QGMS - Quality Giving Management System
 * Run by QGM Inc. - System Provider for Non-Profit Aid Logistics & IK Campaigns
 * Leadership Team Page
 */

require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/includes/gate.php';

// Enforce Video Gatekeeper
VideoGate::requireUnlocked();

$pageTitle = "Leadership Team - QGMS | Run by QGM Inc.";
$pageDesc = "Meet Henrik and the dedicated team driving QGMS system architecture and non-profit logistics.";
$currentPage = "team";

require_once __DIR__ . '/includes/header.php';
?>

<!-- Hero Banner: Our Leadership Team -->
<section class="page-hero-wrapper text-center">
    <div class="page-hero-grid-pattern"></div>
    <div class="container page-hero-content">
        <div class="hero-tag-badge">
            <i class="fa fa-users"></i> Visionaries &bull; Leaders &bull; Engineers
        </div>
        <h1 class="page-hero-title">
            OUR <span class="hero-highlight-text">LEADERSHIP TEAM</span>
        </h1>
        <p class="page-hero-subtitle">
            Passionate visionaries, system engineers, and community advocates dedicated to empowering non-profit aid logistics worldwide.
        </p>
        <div class="hero-breadcrumb">
            <a href="index.php"><i class="fa fa-home"></i> Home</a>
            <span>&bull;</span>
            <span class="text-white">Our Team</span>
        </div>
    </div>
</section>

<!-- Team Content -->
<section class="py-5" style="background: #ffffff;">
    <div class="container">
        <!-- Henrik Feature Profile -->
        <div class="row align-items-center mb-5 pb-4 border-bottom">
            <div class="col-lg-5 mb-4 mb-lg-0 text-center">
                <div class="rounded-2xl overflow-hidden shadow-xl d-inline-block" style="border-radius: 24px; max-width: 380px; border: 6px solid #fff;">
                    <img src="images/team/henrik.jpg" alt="Henrik - Founder" class="img-fluid w-100">
                </div>
            </div>
            <div class="col-lg-7">
                <span class="badge badge-pill badge-primary px-3 py-2 text-uppercase mb-3" style="background: var(--primary-brand); font-size: 12px;">Founder &amp; Chief Visionary</span>
                <h2 class="font-weight-bold mb-2" style="color: #0f172a; font-size: 34px;">Henrik</h2>
                <p class="text-muted font-italic mb-3" style="font-size: 15px;">Quality Giving Management &bull; QGM Inc.</p>
                
                <p style="font-size: 15px; line-height: 1.8; color: #475569;">
                    For over a decade, Henrik has spearheaded research and real-world initiatives dedicated to transforming human attention into practical compassion. Recognizing the profound deficits caused by divisive social media algorithms, Henrik developed the unique Inspiring Kindness methodology: <em>Catch, Recognize, Reward, Inspire</em>.
                </p>
                <p style="font-size: 15px; line-height: 1.8; color: #475569;">
                    Under his leadership, QGM Inc. provides QGMS to non-profits, law enforcement agencies, and community foundations to implement measurable acts of kindness and optimize aid logistics that directly uplift underprivileged children and families.
                </p>
                <div class="d-flex gap-3 mt-4">
                    <a href="mailto:<?= SITE_EMAIL ?>" class="btn btn-outline-dark mr-3" style="border-radius: 50px; padding: 10px 26px; font-weight: 600;">
                        <i class="fa fa-envelope mr-2"></i> Contact Henrik
                    </a>
                    <a href="tel:<?= str_replace([' ', '.'], '', SITE_PHONE) ?>" class="btn btn-donate" style="padding: 10px 26px;">
                        <i class="fa fa-phone mr-2"></i> <?= SITE_PHONE ?>
                    </a>
                </div>
            </div>
        </div>

        <!-- Additional Advisory & Community Leaders -->
        <div class="text-center mb-5 mt-4">
            <h3 class="font-weight-bold" style="color: #0f172a;">System Advisors &amp; Community Champions</h3>
            <p class="text-muted">Uniting cross-disciplinary expertise in social welfare, technology, and community outreach.</p>
        </div>

        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card h-100 border-0 shadow-sm p-4 text-center" style="border-radius: 20px;">
                    <div class="mx-auto mb-3" style="width: 100px; height: 100px; border-radius: 50%; overflow: hidden; background: #f1f5f9;">
                        <img src="images/about/b1.jpg" alt="Program Director" class="w-100 h-100" style="object-fit: cover;">
                    </div>
                    <h5 class="font-weight-bold mb-1" style="color: #0f172a;">Elena Rostova</h5>
                    <p class="text-muted mb-3" style="font-size: 13.5px;">Director of Child Advocacy</p>
                    <p class="text-muted" style="font-size: 13.5px; line-height: 1.6;">
                        Oversees partnerships with Calfresh, EAhousing, and NCCP to ensure direct aid reaches children in urgent need.
                    </p>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card h-100 border-0 shadow-sm p-4 text-center" style="border-radius: 20px;">
                    <div class="mx-auto mb-3" style="width: 100px; height: 100px; border-radius: 50%; overflow: hidden; background: #f1f5f9;">
                        <img src="images/about/b2.jpg" alt="Community Outreach" class="w-100 h-100" style="object-fit: cover;">
                    </div>
                    <h5 class="font-weight-bold mb-1" style="color: #0f172a;">Marcus Vance</h5>
                    <p class="text-muted mb-3" style="font-size: 13.5px;">Community Engagement Lead</p>
                    <p class="text-muted" style="font-size: 13.5px; line-height: 1.6;">
                        Leads local grassroots campaigns and law-enforcement kindness alliances across Santa Clara and Marin counties.
                    </p>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card h-100 border-0 shadow-sm p-4 text-center" style="border-radius: 20px;">
                    <div class="mx-auto mb-3" style="width: 100px; height: 100px; border-radius: 50%; overflow: hidden; background: #f1f5f9;">
                        <img src="images/about/b3.webp" alt="Technology & Verification" class="w-100 h-100" style="object-fit: cover;">
                    </div>
                    <h5 class="font-weight-bold mb-1" style="color: #0f172a;">David Chen</h5>
                    <p class="text-muted mb-3" style="font-size: 13.5px;">Director of Digital Platforms</p>
                    <p class="text-muted" style="font-size: 13.5px; line-height: 1.6;">
                        Directs the QGMS verification systems and Gift Card for Giving mobile delivery infrastructure.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
