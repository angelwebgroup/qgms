<?php
/**
 * QGMS - Quality Giving Management System
 * Run by QGM Inc. - System Provider for Non-Profit Aid Logistics & IK Campaigns
 * The Kindness Station - Home Page
 */

require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/includes/gate.php';

// Enforce Video Gatekeeper
VideoGate::requireUnlocked();

$pageTitle = "QGMS - Quality Giving Management System | Run by QGM Inc.";
$pageDesc = "QGMS, operated by QGM Inc., provides enterprise system infrastructure optimizing non-profit aid logistics and powering the Inspiring Kindness campaign.";
$currentPage = "index";

require_once __DIR__ . '/includes/header.php';
?>

<!-- Hero Banner: The Kindness Station & QGMS Platform -->
<section class="page-hero-wrapper text-center">
    <div class="page-hero-grid-pattern"></div>
    <div class="container page-hero-content">
        <div class="hero-tag-badge home-hero-badge">
            <i class="fa fa-cubes"></i> Operated by QGM Inc. &bull; System Provider for Non-Profit Aid Logistics
        </div>
        <h1 class="page-hero-title mb-3">
            THE <span class="hero-highlight-text">KINDNESS</span> STATION
        </h1>
        <p class="h4 font-weight-light mb-3" style="color: #bae6fd; max-width: 780px; margin: 0 auto; font-size: 20px; line-height: 1.5; text-shadow: 0 2px 10px rgba(0,0,0,0.4);">
            Enterprise Technology Optimizing Non-Profit Aid Logistics &amp; Goodness Worldwide
        </p>
        <p class="lead mb-4" style="color: #e2e8f0; max-width: 760px; margin: 0 auto; font-size: 16px; line-height: 1.8;">
            QGMS is the system provider for the Inspiring Kindness (IK) campaign run by non-profit organizations &mdash; delivering auditable aid logistics, digital beneficiary intake, and community-wide recognition.
        </p>
        <div class="d-flex flex-wrap justify-content-center gap-3 mt-4">
            <a href="aid-logistics.php" class="btn btn-donate mr-sm-3 mb-2" style="padding: 14px 34px; font-size: 15px;">
                <i class="fa fa-sliders mr-1"></i> Aid Logistics Solutions
            </a>
            <a href="register.php" class="btn btn-hero-glass mr-sm-3 mb-2">
                <i class="fa fa-user-plus mr-1"></i> Register Now
            </a>
            <a href="about.php" class="btn btn-hero-glass mb-2">
                <span>The IK Campaign &rarr;</span>
            </a>
        </div>
    </div>
</section>

<!-- Section 1: Turning Greatness Into Inspiration -->
<section class="about-sec py-5" style="background: #ffffff;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="default-title text-center mb-5">
                    <h2 class="font-weight-bold text-dark" style="font-size: 34px;">
                        TURNING GREATNESS INTO <span style="color: var(--primary-brand);">INSPIRATION</span>
                    </h2>
                    <div class="title-bdr" style="width: 80px; height: 3px; background: var(--primary-brand); margin: 15px auto;"></div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="video-container mb-4 shadow-lg rounded-xl overflow-hidden" style="border-radius: 20px; border: 4px solid #fff; box-shadow: 0 20px 50px rgba(0,0,0,0.15);">
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?= INTRO_VIDEO_ID ?>?rel=0&modestbranding=1" title="Introduction Video - Quality Giving Management" allowfullscreen allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"></iframe>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <a href="register.php" class="btn btn-default join-btn" style="background-color: var(--primary-brand); color: white; border-color: var(--primary-brand); border-radius: 50px; text-transform: uppercase; padding: 14px 40px; font-weight: 700; letter-spacing: 1px; box-shadow: 0 8px 25px var(--glow-brand);">
                        REGISTER NOW
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section 1B: Non-Profit Aid Logistics Optimization -->
<section class="py-5" style="background: linear-gradient(180deg, #f0f9ff 0%, #ffffff 100%); border-top: 1px solid #e0f2fe; border-bottom: 1px solid #e2e8f0;">
    <div class="container">
        <div class="row align-items-center mb-5">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <span class="badge badge-pill badge-primary px-3 py-2 text-uppercase mb-3" style="background: var(--primary-brand); font-size: 12px;">Enterprise Infrastructure</span>
                <h2 class="font-weight-bold mb-3" style="color: #0f172a; font-size: 32px;">
                    Optimizing Non-Profit <span style="color: var(--primary-brand);">Aid Logistics</span>
                </h2>
                <div class="title-bdr" style="width: 60px; height: 3px; background: var(--primary-brand); margin: 12px 0 20px;"></div>
                <p style="font-size: 15px; line-height: 1.8; color: #475569;">
                    <strong>QGMS is operated by QGM Inc.</strong> as the enterprise system provider for community non-profits. While non-profits run the ground campaigns (including the Inspiring Kindness campaign), QGM Inc. provides the technological infrastructure required to optimize aid distribution, track verified impact, and coordinate multi-agency operations.
                </p>
                <div class="mt-4">
                    <a href="aid-logistics.php" class="btn btn-donate mr-3" style="padding: 12px 28px;">
                        <span>Explore Full System Capabilities &rarr;</span>
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-sm-6 mb-3">
                        <div class="p-3 bg-white rounded-xl shadow-sm h-100" style="border-radius: 16px; border-left: 4px solid var(--primary-brand);">
                            <i class="fa fa-users text-primary mb-2" style="font-size: 24px;"></i>
                            <h6 class="font-weight-bold text-dark mb-1">Beneficiary Intake</h6>
                            <p class="text-muted mb-0" style="font-size: 13px; line-height: 1.6;">Automated routing for CalFresh, EA Housing, NCCP &amp; county aid.</p>
                        </div>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <div class="p-3 bg-white rounded-xl shadow-sm h-100" style="border-radius: 16px; border-left: 4px solid #7e2b90;">
                            <i class="fa fa-gift text-purple mb-2" style="font-size: 24px; color: #7e2b90;"></i>
                            <h6 class="font-weight-bold text-dark mb-1">Digital Gift Cards</h6>
                            <p class="text-muted mb-0" style="font-size: 13px; line-height: 1.6;">Zero leakage giving vouchers delivered directly to phones.</p>
                        </div>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <div class="p-3 bg-white rounded-xl shadow-sm h-100" style="border-radius: 16px; border-left: 4px solid #10b981;">
                            <i class="fa fa-sitemap text-success mb-2" style="font-size: 24px;"></i>
                            <h6 class="font-weight-bold text-dark mb-1">Multi-Agency Sync</h6>
                            <p class="text-muted mb-0" style="font-size: 13px; line-height: 1.6;">Unites non-profits, county offices, and community sponsors.</p>
                        </div>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <div class="p-3 bg-white rounded-xl shadow-sm h-100" style="border-radius: 16px; border-left: 4px solid #f59e0b;">
                            <i class="fa fa-check-square-o text-warning mb-2" style="font-size: 24px;"></i>
                            <h6 class="font-weight-bold text-dark mb-1">Delivery Verification</h6>
                            <p class="text-muted mb-0" style="font-size: 13px; line-height: 1.6;">Real-time photographic proof &amp; auditable fulfillment logs.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section 2: Inspiring Stories -->
<section class="py-5" style="background: #f8fafc;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="default-title text-center mb-5">
                    <h2 class="font-weight-bold" style="font-size: 34px;">
                        INSPIRING <span style="color: var(--primary-brand);">STORIES</span>
                    </h2>
                    <div class="title-bdr" style="width: 80px; height: 3px; background: var(--primary-brand); margin: 15px auto;"></div>
                    <p class="text-muted" style="max-width: 600px; margin: 0 auto;">Real stories of people stepping up and creating positive change in their communities.</p>
                </div>
            </div>
        </div>

        <div class="row">
            <?php
            $stories = [
                ['title' => 'Acts of Everyday Kindness', 'src' => 'https://qgms.cloud/videos/good-story1.1002566de9ac7e1964ba.mp4'],
                ['title' => 'Helping Strangers in Need', 'src' => 'https://qgms.cloud/videos/good-story2.6cced9bd451cac76e4cd.mp4'],
                ['title' => 'Community Relief in Action', 'src' => 'https://qgms.cloud/videos/good-story3.c4b1900695ef554528e3.mp4'],
                ['title' => 'Youth Inspiring Hope', 'src' => 'https://qgms.cloud/videos/good-story4.a68d415003f51d22e4ea.mp4'],
                ['title' => 'Celebrating Good Deeds', 'src' => 'https://qgms.cloud/videos/good-story5.b192d02347334285ef9a.mp4']
            ];
            foreach ($stories as $idx => $story): ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="video-card bg-white p-2 shadow-sm rounded-lg" style="border-radius: 16px; overflow: hidden; transition: transform 0.3s;" onmouseover="this.style.transform='translateY(-6px)'" onmouseout="this.style.transform='translateY(0)'">
                        <video width="100%" controls style="border-radius: 12px; max-height: 220px; background: #000;" preload="metadata">
                            <source src="<?= $story['src'] ?>" type="video/mp4">
                            Your browser does not support HTML5 video.
                        </video>
                        <div class="p-3">
                            <h5 class="font-weight-bold mb-1" style="font-size: 16px; color: #1e293b;"><?= htmlspecialchars($story['title']) ?></h5>
                            <span class="badge badge-light text-muted"><i class="fa fa-heart text-danger mr-1"></i> Inspiring Act</span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Section 3: How It Works -->
<section class="features-sec py-5" style="background: #ffffff;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="default-title text-center mb-5">
                    <h2 class="font-weight-bold" style="font-size: 34px;">
                        ❤️ HOW <span style="color: var(--primary-brand);">IT WORKS</span>
                    </h2>
                    <div class="title-bdr" style="width: 80px; height: 3px; background: var(--primary-brand); margin: 15px auto;"></div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <!-- Step 1 -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card border-0 shadow-sm h-100" style="border-radius: 20px; overflow: hidden; transition: transform 0.3s;" onmouseover="this.style.transform='translateY(-6px)'" onmouseout="this.style.transform='translateY(0)'">
                    <div style="height: 230px; overflow: hidden;">
                        <img src="images/about/b1.jpg" alt="Catch Kindness" class="w-100 h-100" style="object-fit: cover;">
                    </div>
                    <div class="card-body p-4 text-center">
                        <div class="badge badge-pill badge-primary mb-3 px-3 py-2" style="background: var(--primary-brand); font-size: 13px;">STEP 1</div>
                        <h4 class="font-weight-bold mb-3" style="color: #0f172a;">Catch Kindness</h4>
                        <p class="text-muted" style="font-size: 14.5px; line-height: 1.7;">
                            See someone doing good? Capture it in a photo or short video. Share the story &mdash; big or small, every gesture matters.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card border-0 shadow-sm h-100" style="border-radius: 20px; overflow: hidden; transition: transform 0.3s;" onmouseover="this.style.transform='translateY(-6px)'" onmouseout="this.style.transform='translateY(0)'">
                    <div style="height: 230px; overflow: hidden;">
                        <img src="images/about/b2.jpg" alt="Recognize and Reward" class="w-100 h-100" style="object-fit: cover;">
                    </div>
                    <div class="card-body p-4 text-center">
                        <div class="badge badge-pill badge-primary mb-3 px-3 py-2" style="background: var(--primary-brand); font-size: 13px;">STEP 2</div>
                        <h4 class="font-weight-bold mb-3" style="color: #0f172a;">Recognize &amp; Reward</h4>
                        <p class="text-muted" style="font-size: 14.5px; line-height: 1.7;">
                            Each act of kindness earns a Gift Card for Giving &mdash; a reward that allows the recipient to help someone else in need, at no cost.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card border-0 shadow-sm h-100" style="border-radius: 20px; overflow: hidden; transition: transform 0.3s;" onmouseover="this.style.transform='translateY(-6px)'" onmouseout="this.style.transform='translateY(0)'">
                    <div style="height: 230px; overflow: hidden;">
                        <img src="images/about/b3.webp" alt="Watch the Ripple Grow" class="w-100 h-100" style="object-fit: cover;">
                    </div>
                    <div class="card-body p-4 text-center">
                        <div class="badge badge-pill badge-primary mb-3 px-3 py-2" style="background: var(--primary-brand); font-size: 13px;">STEP 3</div>
                        <h4 class="font-weight-bold mb-3" style="color: #0f172a;">Watch the Ripple Grow</h4>
                        <p class="text-muted" style="font-size: 14.5px; line-height: 1.7;">
                            See the kindness ripple expand across the world in our live interactive map and feel the transformative power of genuine care.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section 4: Welcome & Mission / Vision -->
<section class="py-5" style="background: #f8fafc;">
    <div class="container">
        <div class="row align-items-center mb-5">
            <div class="col-lg-7">
                <h1 class="font-weight-bolder mb-3" style="font-size: 38px; color: #0f172a;">
                    Welcome to <span style="color: var(--primary-brand);">Inspiring Kindness</span>
                </h1>
                <p class="lead font-weight-bold mb-4" style="color: #475569;">Help spread kindness in your community.</p>
                <p style="font-size: 15px; line-height: 1.8; color: #334155;">
                    At Inspiring Kindness, we believe that the smallest act of care can start a ripple strong enough to change the world. Our mission is simple &mdash; to inspire people everywhere to recognize, reward, and share kindness in ways that create lasting emotional and social impact.
                </p>
                <p style="font-size: 15px; line-height: 1.8; color: #334155;">
                    For more than a decade, we've developed and tested a unique methodology built on emotional intelligence, behavioral science, and real-world compassion. This approach &mdash; <strong>Catch. Recognize. Reward. Inspire.</strong> &mdash; transforms everyday moments of kindness into an ongoing chain of positive action.
                </p>
            </div>
            <div class="col-lg-5">
                <div class="rounded-2xl overflow-hidden shadow-xl" style="border-radius: 20px;">
                    <img src="images/about/a1.jpeg" alt="Inspiring Kindness Community" class="img-fluid w-100">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="p-4 bg-white rounded-xl shadow-sm h-100" style="border-radius: 16px; border-left: 5px solid var(--primary-brand);">
                    <h3 class="font-weight-bold mb-3" style="color: #0f172a;">Our Vision</h3>
                    <p style="font-size: 14.5px; line-height: 1.8; color: #475569;">
                        We envision a world where kindness is not random, but recognized &mdash; where caring for others is a natural part of everyday life and the driving force of social change. A world where compassion is valued as a strength, not a sentiment, and where the attention we give is directed toward people and actions that truly make a difference.
                    </p>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="p-4 bg-white rounded-xl shadow-sm h-100" style="border-radius: 16px; border-left: 5px solid #3b82f6;">
                    <h3 class="font-weight-bold mb-3" style="color: #0f172a;">Our Mission</h3>
                    <p style="font-size: 14.5px; line-height: 1.8; color: #475569;">
                        Our mission is to transform care and kindness from ideas into measurable, sustainable action. We do this by inspiring individuals, organizations, and communities to catch, recognize, reward, and share real acts of compassion &mdash; creating a continuous ripple of positive emotional and social impact.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section 5: Why It Matters -->
<section class="py-5" style="background: #ffffff;">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="font-weight-bold" style="font-size: 34px;">
                💖 WHY IT <span style="color: var(--primary-brand);">MATTERS</span>
            </h2>
            <div class="title-bdr" style="width: 80px; height: 3px; background: var(--primary-brand); margin: 15px auto;"></div>
            <p class="text-muted" style="max-width: 650px; margin: 0 auto;">Science confirms what our hearts already know: kindness heals, connects, and inspires us all.</p>
        </div>

        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 border-0 shadow-sm" style="border-radius: 20px; overflow: hidden;">
                    <img src="images/courses/k1.jpeg" alt="Kindness Heals" style="height: 220px; object-fit: cover;">
                    <div class="card-body p-4">
                        <h4 class="font-weight-bold mb-2">Because Kindness Heals</h4>
                        <p class="text-muted" style="font-size: 14px; line-height: 1.7;">
                            Kindness has proven physiological benefits. Acts of care release dopamine, oxytocin, and serotonin &mdash; the brain's "feel-good" chemicals that reduce stress, lower blood pressure, and increase longevity.
                        </p>
                        <p class="font-italic font-weight-bold text-dark" style="font-size: 13.5px;">"Compassion isn't only good for the world &mdash; it's medicine for the mind."</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 border-0 shadow-sm" style="border-radius: 20px; overflow: hidden;">
                    <img src="images/courses/k2.jpg" alt="Kindness Connects" style="height: 220px; object-fit: cover;">
                    <div class="card-body p-4">
                        <h4 class="font-weight-bold mb-2">Because Kindness Connects</h4>
                        <p class="text-muted" style="font-size: 14px; line-height: 1.7;">
                            Every time we recognize and reward kindness, we strengthen trust, empathy, and social bonds. It reminds us that we belong &mdash; to families, workplaces, and communities that thrive on care.
                        </p>
                        <p class="font-italic font-weight-bold text-dark" style="font-size: 13.5px;">"Connection begins the moment we choose to see the good in others."</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 border-0 shadow-sm" style="border-radius: 20px; overflow: hidden;">
                    <img src="images/courses/k3.jpeg" alt="Kindness Inspires Change" style="height: 220px; object-fit: cover;">
                    <div class="card-body p-4">
                        <h4 class="font-weight-bold mb-2">Because Kindness Inspires</h4>
                        <p class="text-muted" style="font-size: 14px; line-height: 1.7;">
                            When one act of kindness is shared, it creates a ripple &mdash; inspiring others to do the same. Through technology and storytelling, we make caring visible &mdash; turning empathy into a global movement.
                        </p>
                        <p class="font-italic font-weight-bold text-dark" style="font-size: 13.5px;">"The more we inspire, the more the world transforms."</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section 6: The Power of Attention -->
<section class="py-5" style="background: #f8fafc; border-top: 1px solid #e2e8f0; border-bottom: 1px solid #e2e8f0;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h2 class="font-weight-bold mb-3" style="font-size: 32px; color: #0f172a;">
                    💡 The Power of Attention
                </h2>
                <p style="font-size: 15px; line-height: 1.8; color: #334155;">
                    Never before in human history have we had the power to reach millions of people instantly. Every view, like, and share carries influence &mdash; shaping what we see, value, and believe. Yet too often, our collective attention is drawn toward conflict, controversy, and division.
                </p>
                <p style="font-size: 15px; line-height: 1.8; color: #334155;">
                    <strong>What if we gave our attention to the good?</strong> Inspiring Kindness is built on that very idea. It uses the mechanics that make digital media powerful &mdash; visibility, recognition, and connection &mdash; but channels them toward compassion instead of competition.
                </p>
            </div>
            <div class="col-lg-6">
                <div class="rounded-2xl overflow-hidden shadow-lg" style="border-radius: 20px;">
                    <img src="images/about/santa.jpeg" alt="Community Support" class="img-fluid w-100">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section 7: The Inspiring Kindness Methodology as a Tool -->
<section id="methodology" class="py-5" style="background: #ffffff;">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="font-weight-bold" style="font-size: 32px;">
                The Inspiring Kindness Methodology as a Tool
            </h2>
            <div class="title-bdr" style="width: 80px; height: 3px; background: var(--primary-brand); margin: 15px auto;"></div>
        </div>

        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <p style="font-size: 15px; line-height: 1.8; color: #475569;">
                    There should be no doubt that modern media has made a significant impact on society. What is clear is that digital tech infrastructure makes it possible for the first time in human existence to make individual communication and positive impact.
                </p>
                <p style="font-size: 15px; line-height: 1.8; color: #475569;">
                    The Inspiring Kindness methodology, deployed on its own social media structure, opens new unique opportunities to obtain a solely positive individual impact: where it is not about ourselves, but about others.
                </p>
            </div>
            <div class="col-lg-6">
                <div class="embed-responsive embed-responsive-16by9 shadow-lg rounded-xl overflow-hidden" style="border-radius: 16px;">
                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/_cJHYiNMfiI?rel=0" title="Inspiring Kindness Methodology" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section 8: The Gift Card for Giving -->
<section class="py-5" style="background: #f8fafc;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7 mb-4 mb-lg-0">
                <h2 class="font-weight-bold mb-3" style="font-size: 32px;">
                    The Gift Card <span style="color: var(--primary-brand);">for Giving</span>
                </h2>
                <p style="font-size: 15px; line-height: 1.8; color: #334155;">
                    Our <strong>Gift Card for Giving</strong> may be the best gift anyone can receive. It is awarded in recognition of an act of kindness and enables the recipient to do even more good by helping a specifically defined underprivileged child &mdash; at no cost to them.
                </p>
                <ul class="list-unstyled" style="font-size: 15px; line-height: 2.2; color: #334155;">
                    <li><i class="fa fa-check-circle text-success mr-2"></i> Download the official mobile application</li>
                    <li><i class="fa fa-check-circle text-success mr-2"></i> Make a contribution for the Gift Card for Giving</li>
                    <li><i class="fa fa-check-circle text-success mr-2"></i> Receive the card directly on your phone and gift it forward</li>
                    <li><i class="fa fa-check-circle text-success mr-2"></i> Submit videos, pictures, or notes honoring the kindness deed</li>
                </ul>
                <a href="donate.php" class="btn btn-donate mt-3">Obtain a Gift Card</a>
            </div>
            <div class="col-lg-5 text-center">
                <img src="images/about/gcg.png" alt="Gift Card for Giving" class="img-fluid" style="max-height: 320px; filter: drop-shadow(0 15px 30px rgba(0,0,0,0.15));">
            </div>
        </div>
    </div>
</section>

<!-- Section 9: Get in Touch & Live Contact Form -->
<section id="contact" class="py-5" style="background: #ffffff;">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="font-weight-bold" style="font-size: 34px;">
                GET IN <span style="color: var(--primary-brand);">TOUCH</span>
            </h2>
            <div class="title-bdr" style="width: 80px; height: 3px; background: var(--primary-brand); margin: 15px auto;"></div>
            <p class="text-muted" style="max-width: 600px; margin: 0 auto;">Connect with Henrik and the QGMS / QGM Inc. team.</p>
        </div>

        <div class="row mb-5">
            <div class="col-md-4 mb-3">
                <div class="p-4 bg-light rounded-xl text-center h-100" style="border-radius: 16px;">
                    <i class="fa fa-map-marker" style="font-size: 32px; color: var(--primary-brand);"></i>
                    <h5 class="font-weight-bold mt-3 mb-1">Our Location</h5>
                    <p class="text-muted mb-0" style="font-size: 14px;"><?= SITE_ADDRESS ?></p>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="p-4 bg-light rounded-xl text-center h-100" style="border-radius: 16px;">
                    <i class="fa fa-envelope" style="font-size: 32px; color: var(--primary-brand);"></i>
                    <h5 class="font-weight-bold mt-3 mb-1">Email Us</h5>
                    <p class="text-muted mb-0" style="font-size: 14px;"><a href="mailto:<?= SITE_EMAIL ?>" class="text-muted"><?= SITE_EMAIL ?></a></p>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="p-4 bg-light rounded-xl text-center h-100" style="border-radius: 16px;">
                    <i class="fa fa-phone" style="font-size: 32px; color: var(--primary-brand);"></i>
                    <h5 class="font-weight-bold mt-3 mb-1">Call Us</h5>
                    <p class="text-muted mb-0" style="font-size: 14px;"><a href="tel:<?= str_replace([' ', '.'], '', SITE_PHONE) ?>" class="text-muted"><?= SITE_PHONE ?></a></p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 mb-4">
                <form id="home-contact-form" class="p-4 bg-light rounded-xl shadow-sm" style="border-radius: 20px;">
                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(Security::getCsrfToken()) ?>">
                    <div class="form-group mb-3">
                        <input type="text" name="name" class="form-control" placeholder="Full Name" required style="border-radius: 10px; padding: 14px;">
                    </div>
                    <div class="form-group mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email Address" required style="border-radius: 10px; padding: 14px;">
                    </div>
                    <div class="form-group mb-3">
                        <input type="text" name="phone" class="form-control" placeholder="Phone Number" style="border-radius: 10px; padding: 14px;">
                    </div>
                    <div class="form-group mb-4">
                        <textarea name="message" class="form-control" rows="5" placeholder="Your Message" required style="border-radius: 10px; padding: 14px;"></textarea>
                    </div>
                    <button type="submit" class="btn btn-donate w-100" style="padding: 14px; font-size: 16px;">Send Message</button>
                    <div id="home-contact-msg" class="mt-3 text-center" style="display:none; font-weight: 600;"></div>
                </form>
            </div>
            <div class="col-lg-6">
                <div class="rounded-xl overflow-hidden shadow-sm h-100" style="border-radius: 20px; min-height: 380px;">
                    <iframe src="https://maps.google.com/maps?q=2241%20Churchill%20Dr.%20Milpitas,%20CA%2095035&t=&z=13&ie=UTF8&iwloc=&output=embed" width="100%" height="100%" style="border:0; min-height: 380px;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
// Contact Form Submission
document.getElementById('home-contact-form')?.addEventListener('submit', function(e) {
    e.preventDefault();
    const form = this;
    const msg = document.getElementById('home-contact-msg');
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
            msg.textContent = data.error || 'Submission failed.';
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
