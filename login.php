<?php
/**
 * QGMS - Quality Giving Management System
 * Run by QGM Inc. - System Provider for Non-Profit Aid Logistics & IK Campaigns
 * Login Portal
 */

require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/includes/gate.php';
require_once __DIR__ . '/includes/security.php';

// Enforce Video Gatekeeper
VideoGate::requireUnlocked();

// If already logged in, redirect to home
if (!empty($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

$pageTitle = "Login - QGMS | Run by QGM Inc.";
$pageDesc = "Sign in to access your QGMS account, aid logistics, and gift card dashboard.";
$currentPage = "login";

require_once __DIR__ . '/includes/header.php';
?>

<main class="py-5" style="background: linear-gradient(180deg, #f8fafc 0%, #edf2f7 100%); min-height: 80vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-8">
                <div class="card border-0 shadow-lg rounded-2xl p-4 p-md-5" style="border-radius: 24px;">
                    <div class="text-center mb-4">
                        <div class="mx-auto mb-3" style="width: 60px; height: 60px; border-radius: 50%; background: rgba(0, 154, 209, 0.1); color: var(--primary-brand); display: flex; align-items: center; justify-content: center; font-size: 24px;">
                            <i class="fa fa-lock"></i>
                        </div>
                        <h2 class="font-weight-bold" style="color: #0f172a;">Account Login</h2>
                        <p class="text-muted" style="font-size: 14px;">Sign in to manage your giving cards and kindness reports.</p>
                    </div>

                    <form id="login-form">
                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(Security::getCsrfToken()) ?>">

                        <div class="form-group mb-3">
                            <label class="font-weight-bold text-dark" style="font-size: 13.5px;">Username or Email</label>
                            <input type="text" name="username" class="form-control" placeholder="Enter username or email" required style="border-radius: 10px; padding: 14px;">
                        </div>

                        <div class="form-group mb-4">
                            <label class="font-weight-bold text-dark" style="font-size: 13.5px;">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="••••••••" required style="border-radius: 10px; padding: 14px;">
                        </div>

                        <button type="submit" class="btn btn-donate w-100" style="padding: 14px; font-size: 16px; border-radius: 12px;">
                            Sign In
                        </button>

                        <div id="login-msg" class="mt-3 text-center" style="display: none; font-weight: 600;"></div>
                    </form>

                    <div class="text-center mt-4 pt-3 border-top">
                        <p class="text-muted mb-0" style="font-size: 13.5px;">Don't have an account? <a href="register.php" style="color: var(--primary-brand); font-weight: 700;">Create Account</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
document.getElementById('login-form')?.addEventListener('submit', function(e) {
    e.preventDefault();
    const form = this;
    const msg = document.getElementById('login-msg');
    const formData = new FormData(form);

    fetch('api/login.php', {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        msg.style.display = 'block';
        if (data.success) {
            msg.style.color = '#10b981';
            msg.textContent = data.message;
            setTimeout(() => {
                window.location.href = data.redirect || 'index.php';
            }, 800);
        } else {
            msg.style.color = '#ef4444';
            msg.textContent = data.error || 'Authentication failed.';
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
