<?php
/**
 * QGMS - Inspiring Kindness Foundation
 * Child Wishes & Kindness Catches Gallery
 */

require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/includes/gate.php';

// Enforce Video Gatekeeper
VideoGate::requireUnlocked();

$pageTitle = "Child Wishes Gallery - Inspiring Kindness Foundation | QGMS";
$pageDesc = "Browse and support urgent wishes for underprivileged children through our verified partner networks.";
$currentPage = "wishes";

$pdo = Database::getConnection();
$selectedCategory = $_GET['cat'] ?? 'all';

if ($selectedCategory !== 'all') {
    $stmt = $pdo->prepare("SELECT * FROM wishes WHERE category = ? ORDER BY id DESC");
    $stmt->execute([$selectedCategory]);
} else {
    $stmt = $pdo->query("SELECT * FROM wishes ORDER BY id DESC");
}
$wishesList = $stmt->fetchAll();

require_once __DIR__ . '/includes/header.php';
?>

<!-- Header Banner -->
<section class="py-5 text-white" style="background: linear-gradient(135deg, #1e1b4b 0%, #312e81 100%);">
    <div class="container text-center">
        <h1 class="display-4 font-weight-bold mb-2">Child Wishes Gallery</h1>
        <p class="lead" style="color: #cbd5e1; font-size: 16px;">Directly fulfill wishes for children through Calfresh, EAhousing, and NCCP partnerships.</p>
    </div>
</section>

<!-- Wishes Gallery -->
<section class="py-5" style="background: #ffffff;">
    <div class="container">
        <!-- Category Filter Tabs -->
        <div class="d-flex justify-content-center flex-wrap gap-2 mb-5">
            <a href="wishes.php?cat=all" class="btn <?= $selectedCategory === 'all' ? 'btn-donate' : 'btn-outline-secondary' ?> mr-2 mb-2" style="border-radius: 30px; font-weight: 700;">All Programs</a>
            <a href="wishes.php?cat=Calfresh" class="btn <?= $selectedCategory === 'Calfresh' ? 'btn-donate' : 'btn-outline-secondary' ?> mr-2 mb-2" style="border-radius: 30px; font-weight: 700;">Calfresh</a>
            <a href="wishes.php?cat=EAhousing" class="btn <?= $selectedCategory === 'EAhousing' ? 'btn-donate' : 'btn-outline-secondary' ?> mr-2 mb-2" style="border-radius: 30px; font-weight: 700;">EAhousing</a>
            <a href="wishes.php?cat=NCCP" class="btn <?= $selectedCategory === 'NCCP' ? 'btn-donate' : 'btn-outline-secondary' ?> mr-2 mb-2" style="border-radius: 30px; font-weight: 700;">NCCP</a>
            <a href="wishes.php?cat=Santa Clara County" class="btn <?= $selectedCategory === 'Santa Clara County' ? 'btn-donate' : 'btn-outline-secondary' ?> mr-2 mb-2" style="border-radius: 30px; font-weight: 700;">Santa Clara County</a>
        </div>

        <div class="row">
            <?php if (empty($wishesList)): ?>
                <div class="col-12 text-center py-5">
                    <i class="fa fa-heart-o text-muted" style="font-size: 48px;"></i>
                    <h4 class="mt-3 text-muted">No active wishes found in this category.</h4>
                    <a href="wishes.php?cat=all" class="btn btn-outline-primary mt-2" style="border-radius: 30px;">View All Wishes</a>
                </div>
            <?php else: ?>
                <?php foreach ($wishesList as $wish): 
                    $percent = $wish['amount_needed'] > 0 ? min(100, round(($wish['amount_raised'] / $wish['amount_needed']) * 100)) : 0;
                ?>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100 border-0 shadow-sm" style="border-radius: 20px; overflow: hidden; transition: transform 0.3s;" onmouseover="this.style.transform='translateY(-6px)'" onmouseout="this.style.transform='translateY(0)'">
                            <div style="height: 220px; overflow: hidden; position: relative;">
                                <img src="<?= htmlspecialchars($wish['image_url'] ?? 'images/courses/k1.jpeg') ?>" alt="<?= htmlspecialchars($wish['title']) ?>" class="w-100 h-100" style="object-fit: cover;">
                                <span class="badge badge-pill badge-primary position-absolute" style="top: 15px; left: 15px; background: var(--primary-brand); padding: 8px 16px; font-size: 12px; font-weight: 700;">
                                    <?= htmlspecialchars($wish['category']) ?>
                                </span>
                            </div>
                            <div class="card-body p-4 d-flex flex-column justify-content-between">
                                <div>
                                    <h5 class="font-weight-bold mb-1" style="color: #0f172a;"><?= htmlspecialchars($wish['title']) ?></h5>
                                    <p class="text-muted font-italic mb-3" style="font-size: 13.5px;">For child: <strong><?= htmlspecialchars($wish['child_name']) ?></strong></p>
                                    <p class="text-muted" style="font-size: 14px; line-height: 1.6;">
                                        <?= htmlspecialchars($wish['description']) ?>
                                    </p>
                                </div>

                                <div class="mt-4 pt-3 border-top">
                                    <div class="d-flex justify-content-between align-items-center mb-2" style="font-size: 13.5px; font-weight: 700;">
                                        <span>Raised: $<?= number_format((float)$wish['amount_raised'], 2) ?></span>
                                        <span class="text-muted">Goal: $<?= number_format((float)$wish['amount_needed'], 2) ?></span>
                                    </div>
                                    <div class="progress mb-3" style="height: 8px; border-radius: 10px; background: #e2e8f0;">
                                        <div class="progress-bar" role="progressbar" style="width: <?= $percent ?>%; background: linear-gradient(90deg, #009ad1, #7e2b90); border-radius: 10px;" aria-valuenow="<?= $percent ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <a href="donate.php?wish_id=<?= $wish['id'] ?>" class="btn btn-donate w-100" style="border-radius: 12px; font-size: 14px;">
                                        Fulfill / Support This Wish
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
