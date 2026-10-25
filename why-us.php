<?php
/**
 * QGMS - Inspiring Kindness Foundation
 * Why Us & Why Kindness Matters Page
 */

require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/includes/gate.php';

// Enforce Video Gatekeeper
VideoGate::requireUnlocked();

$pageTitle = "Why Us? Why Kindness Matters - Inspiring Kindness Foundation";
$pageDesc = "Discover why acts of kindness heal, connect, and inspire measurable social transformation.";
$currentPage = "why-us";

require_once __DIR__ . '/includes/header.php';
?>

<!-- Header Banner -->
<section class="py-5 text-white" style="background: linear-gradient(135deg, #1e1b4b 0%, #4c1d95 100%);">
    <div class="container text-center">
        <h1 class="display-4 font-weight-bold mb-2">Why Kindness Matters</h1>
        <p class="lead" style="color: #cbd5e1; font-size: 16px;">The physiological, emotional, and societal imperative for proactive compassion.</p>
    </div>
</section>

<!-- Content -->
<section class="py-5" style="background: #ffffff;">
    <div class="container">
        <div class="row align-items-center mb-5">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <span class="badge badge-pill badge-primary px-3 py-2 text-uppercase mb-3" style="background: var(--primary-brand); font-size: 12px;">Scientific Foundations</span>
                <h2 class="font-weight-bold mb-3" style="color: #0f172a; font-size: 34px;">
                    Kindness is Not Just Good &mdash; <span style="color: var(--primary-brand);">It's Medicine</span>
                </h2>
                <p style="font-size: 15px; line-height: 1.8; color: #475569;">
                    Even in a world more connected than ever, millions of people feel divided, unseen, and emotionally burned out. Science confirms what our hearts already know &mdash; that acts of kindness don't just help others; they heal, connect, and inspire us all.
                </p>
                <p style="font-size: 15px; line-height: 1.8; color: #475569;">
                    Inspiring Kindness turns that fundamental truth into concrete action &mdash; creating an evidence-based ripple effect that transforms individual moments of care into measurable community trust and social cohesion.
                </p>
            </div>
            <div class="col-lg-6">
                <div class="rounded-2xl overflow-hidden shadow-xl" style="border-radius: 20px;">
                    <img src="images/courses/k1.jpeg" alt="Kindness Heals" class="img-fluid w-100">
                </div>
            </div>
        </div>

        <!-- 3 Pillars -->
        <div class="row pt-4">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 border-0 shadow-sm p-4 text-center" style="border-radius: 20px;">
                    <div class="mx-auto mb-3 p-3 rounded-circle" style="background: #eff6ff; color: #3b82f6; width: 70px; height: 70px; display: flex; align-items: center; justify-content: center; font-size: 26px;">
                        <i class="fa fa-heartbeat"></i>
                    </div>
                    <h4 class="font-weight-bold mb-3">Physiological Healing</h4>
                    <p class="text-muted" style="font-size: 14px; line-height: 1.7;">
                        Acts of kindness release dopamine, oxytocin, and serotonin &mdash; the body's natural neurochemicals that reduce stress, suppress inflammation, and promote cardiovascular vitality.
                    </p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 border-0 shadow-sm p-4 text-center" style="border-radius: 20px;">
                    <div class="mx-auto mb-3 p-3 rounded-circle" style="background: #f0f9ff; color: var(--primary-brand); width: 70px; height: 70px; display: flex; align-items: center; justify-content: center; font-size: 26px;">
                        <i class="fa fa-users"></i>
                    </div>
                    <h4 class="font-weight-bold mb-3">Social Bonding</h4>
                    <p class="text-muted" style="font-size: 14px; line-height: 1.7;">
                        Recognizing and celebrating good deeds restores interpersonal faith and replaces hostility with empathy in schools, neighborhoods, and corporate environments.
                    </p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 border-0 shadow-sm p-4 text-center" style="border-radius: 20px;">
                    <div class="mx-auto mb-3 p-3 rounded-circle" style="background: #ecfdf5; color: #10b981; width: 70px; height: 70px; display: flex; align-items: center; justify-content: center; font-size: 26px;">
                        <i class="fa fa-globe"></i>
                    </div>
                    <h4 class="font-weight-bold mb-3">Global Inspiration</h4>
                    <p class="text-muted" style="font-size: 14px; line-height: 1.7;">
                        By leveraging technology to make kindness visible rather than conflict, we foster a scalable cultural transformation that benefits generations to come.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
