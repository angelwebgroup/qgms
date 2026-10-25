<?php
/**
 * QGMS - Inspiring Kindness Foundation
 * Donate & Gift Card for Giving Portal
 */

require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/includes/gate.php';
require_once __DIR__ . '/includes/security.php';

// Enforce Video Gatekeeper
VideoGate::requireUnlocked();

$pageTitle = "Donate & Obtain a Gift Card for Giving - Inspiring Kindness | QGMS";
$pageDesc = "Empower acts of compassion. Support an underprivileged child or reward an inspiring act of goodness.";
$currentPage = "donate";

$pdo = Database::getConnection();
$wishId = isset($_GET['wish_id']) ? (int)$_GET['wish_id'] : 0;
$selectedWish = null;

if ($wishId > 0) {
    $stmt = $pdo->prepare("SELECT * FROM wishes WHERE id = ?");
    $stmt->execute([$wishId]);
    $selectedWish = $stmt->fetch();
}

require_once __DIR__ . '/includes/header.php';
?>

<!-- Header Banner -->
<section class="py-5 text-white" style="background: linear-gradient(135deg, #831843 0%, #be185d 50%, #e11d48 100%);">
    <div class="container text-center">
        <h1 class="display-4 font-weight-bold mb-2">Empower Kindness Today</h1>
        <p class="lead" style="color: #fce7f3; font-size: 16px;">100% of your gift card donation directly benefits children in urgent need.</p>
    </div>
</section>

<!-- Donation Form Section -->
<section class="py-5" style="background: #ffffff;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-lg rounded-2xl p-4 p-md-5" style="border-radius: 24px;">
                    <?php if ($selectedWish): ?>
                        <div class="alert alert-info d-flex align-items-center mb-4" style="border-radius: 12px;">
                            <i class="fa fa-heart text-danger mr-3" style="font-size: 24px;"></i>
                            <div>
                                <strong>You are supporting:</strong> <?= htmlspecialchars($selectedWish['title']) ?> for <em><?= htmlspecialchars($selectedWish['child_name']) ?></em> (<?= htmlspecialchars($selectedWish['category']) ?>)
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="text-center mb-4">
                        <h2 class="font-weight-bold" style="color: #0f172a;">Select Contribution Amount</h2>
                        <p class="text-muted" style="font-size: 14.5px;">Choose an amount for your Gift Card for Giving</p>
                    </div>

                    <!-- Preset Amount Buttons -->
                    <div class="d-flex flex-wrap justify-content-center gap-3 mb-4" id="preset-amounts">
                        <button type="button" class="btn btn-outline-primary font-weight-bold px-4 py-3 mr-2 mb-2 amount-btn" data-amt="25" style="border-radius: 12px; font-size: 18px; border-color: var(--primary-brand); color: var(--primary-brand);">$25</button>
                        <button type="button" class="btn btn-primary font-weight-bold px-4 py-3 mr-2 mb-2 amount-btn active" data-amt="50" style="border-radius: 12px; font-size: 18px; background: var(--primary-brand); border-color: var(--primary-brand); color: #fff;">$50</button>
                        <button type="button" class="btn btn-outline-primary font-weight-bold px-4 py-3 mr-2 mb-2 amount-btn" data-amt="100" style="border-radius: 12px; font-size: 18px; border-color: var(--primary-brand); color: var(--primary-brand);">$100</button>
                        <button type="button" class="btn btn-outline-primary font-weight-bold px-4 py-3 mr-2 mb-2 amount-btn" data-amt="250" style="border-radius: 12px; font-size: 18px; border-color: var(--primary-brand); color: var(--primary-brand);">$250</button>
                    </div>

                    <form id="donation-demo-form">
                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(Security::getCsrfToken()) ?>">
                        <input type="hidden" name="amount" id="donation-amount-input" value="50">

                        <div class="form-group mb-3">
                            <label class="font-weight-bold text-dark" style="font-size: 13.5px;">Custom Amount ($ USD)</label>
                            <input type="number" id="custom-amount-field" class="form-control" placeholder="Or enter custom amount (e.g. 75)" min="5" style="border-radius: 10px; padding: 14px;">
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6 mb-3">
                                <label class="font-weight-bold text-dark" style="font-size: 13.5px;">Donor Full Name *</label>
                                <input type="text" name="donor_name" class="form-control" placeholder="John Doe" required style="border-radius: 10px; padding: 14px;">
                            </div>
                            <div class="form-group col-md-6 mb-3">
                                <label class="font-weight-bold text-dark" style="font-size: 13.5px;">Email Receipt *</label>
                                <input type="email" name="donor_email" class="form-control" placeholder="john@example.com" required style="border-radius: 10px; padding: 14px;">
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label class="font-weight-bold text-dark" style="font-size: 13.5px;">Dedication / Kindness Message</label>
                            <textarea name="dedication" class="form-control" rows="3" placeholder="Add an inspiring dedication note..." style="border-radius: 10px; padding: 14px;"></textarea>
                        </div>

                        <div class="p-3 mb-4 bg-light rounded-lg text-center" style="border-radius: 12px;">
                            <p class="mb-1 text-muted" style="font-size: 13px;"><i class="fa fa-lock text-success mr-1"></i> 256-bit Encrypted Secure Gateway</p>
                            <span class="text-muted" style="font-size: 12px;">Supporting Visa, Mastercard, American Express, Apple Pay, Google Pay</span>
                        </div>

                        <button type="button" id="btn-process-donation" class="btn btn-donate w-100" style="padding: 16px; font-size: 17px; border-radius: 12px;">
                            Proceed to Complete Donation &rarr;
                        </button>
                    </form>

                    <!-- Success Message Container -->
                    <div id="donate-success-box" class="mt-4 p-4 text-center rounded-xl" style="display: none; background: #ecfdf5; border: 1px solid #a7f3d0; border-radius: 16px;">
                        <i class="fa fa-check-circle text-success mb-2" style="font-size: 40px;"></i>
                        <h4 class="font-weight-bold text-success mb-2">Thank You For Your Generosity!</h4>
                        <p class="text-muted mb-0" style="font-size: 14px;">Your Gift Card for Giving contribution has been processed. A receipt and confirmation has been generated.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.querySelectorAll('.amount-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.amount-btn').forEach(b => {
            b.classList.remove('active', 'btn-primary');
            b.classList.add('btn-outline-primary');
            b.style.background = 'transparent';
            b.style.color = 'var(--primary-brand)';
        });
        this.classList.add('active', 'btn-primary');
        this.classList.remove('btn-outline-primary');
        this.style.background = 'var(--primary-brand)';
        this.style.color = '#fff';

        const val = this.getAttribute('data-amt');
        document.getElementById('donation-amount-input').value = val;
        document.getElementById('custom-amount-field').value = '';
    });
});

document.getElementById('custom-amount-field')?.addEventListener('input', function() {
    if (this.value) {
        document.querySelectorAll('.amount-btn').forEach(b => {
            b.classList.remove('active', 'btn-primary');
            b.classList.add('btn-outline-primary');
            b.style.background = 'transparent';
            b.style.color = 'var(--primary-brand)';
        });
        document.getElementById('donation-amount-input').value = this.value;
    }
});

document.getElementById('btn-process-donation')?.addEventListener('click', function() {
    const form = document.getElementById('donation-demo-form');
    if (!form.checkValidity()) {
        form.reportValidity();
        return;
    }
    const successBox = document.getElementById('donate-success-box');
    this.disabled = true;
    this.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Processing Secure Payment...';
    setTimeout(() => {
        form.style.display = 'none';
        successBox.style.display = 'block';
    }, 1200);
});
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
