<?php
/**
 * QGMS - Registration API
 */

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/security.php';

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    Security::jsonResponse(['error' => 'Method not allowed'], 405);
}

if (!Security::checkRateLimit('registration', 5, 60)) {
    Security::jsonResponse(['error' => 'Too many registration requests. Please wait a moment.'], 429);
}

$csrfToken = $_POST['csrf_token'] ?? '';
if (!Security::verifyCsrf($csrfToken)) {
    Security::jsonResponse(['error' => 'Invalid security token. Please refresh the page.'], 403);
}

$fullName = Security::sanitize($_POST['full_name'] ?? '');
$email = Security::sanitizeEmail($_POST['email'] ?? '');
$phone = Security::sanitize($_POST['phone'] ?? '');
$category = Security::sanitize($_POST['category'] ?? 'calfresh');
$notes = Security::sanitize($_POST['notes'] ?? '');

if (empty($fullName) || strlen($fullName) < 2) {
    Security::jsonResponse(['error' => 'Please provide your full name.'], 400);
}

if (empty($email)) {
    Security::jsonResponse(['error' => 'Please provide a valid email address.'], 400);
}

if (empty($phone)) {
    Security::jsonResponse(['error' => 'Please provide your contact phone number.'], 400);
}

try {
    $pdo = Database::getConnection();
    if ($pdo) {
        $stmt = $pdo->prepare("INSERT INTO registrations (full_name, email, phone, category, notes, video_verified, ip_address) VALUES (?, ?, ?, ?, ?, 1, ?)");
        $stmt->execute([
            $fullName,
            $email,
            $phone,
            $category,
            $notes,
            $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1'
        ]);
    } else {
        error_log("Database offline: registration logged for " . $email . " - " . $fullName);
    }

    // Dispatch registration email notification to Henrik (henrik@qg-ms.com)
    $recipient = defined('REGISTRATION_NOTIFY_EMAIL') ? REGISTRATION_NOTIFY_EMAIL : 'henrik@qg-ms.com';
    $subject = "New QGMS Registration: " . $fullName . " (" . ucwords(str_replace('_', ' ', $category)) . ")";
    
    $headers = [
        'MIME-Version: 1.0',
        'Content-type: text/html; charset=UTF-8',
        'From: QGMS System <no-reply@qg-ms.com>',
        'Reply-To: ' . $fullName . ' <' . $email . '>',
        'X-Mailer: PHP/' . phpversion()
    ];

    $emailBody = '
    <!DOCTYPE html>
    <html>
    <head>
      <meta charset="UTF-8">
      <title>New QGMS Registration</title>
      <style>
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Arial, sans-serif; background-color: #f8fafc; color: #1e293b; padding: 20px; }
        .card { max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 12px; border: 1px solid #e2e8f0; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.06); }
        .header { background: linear-gradient(135deg, #009ad1 0%, #7e2b90 100%); color: #ffffff; padding: 24px; }
        .content { padding: 24px; }
        .row-item { margin-bottom: 16px; border-bottom: 1px solid #f1f5f9; padding-bottom: 12px; }
        .label { font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px; color: #64748b; font-weight: 700; margin-bottom: 4px; }
        .value { font-size: 15px; color: #0f172a; font-weight: 600; }
        .footer { padding: 16px 24px; background: #f8fafc; font-size: 12px; color: #94a3b8; text-align: center; }
      </style>
    </head>
    <body>
      <div class="card">
        <div class="header">
          <h2 style="margin: 0; font-size: 20px; color: #ffffff;">QGMS &bull; New Registration Received</h2>
          <p style="margin: 6px 0 0; font-size: 13px; color: #e0f2fe;">Run by QGM Inc. &bull; Non-Profit Aid Logistics System</p>
        </div>
        <div class="content">
          <div class="row-item">
            <div class="label">Full Name</div>
            <div class="value">' . htmlspecialchars($fullName) . '</div>
          </div>
          <div class="row-item">
            <div class="label">Email Address</div>
            <div class="value"><a href="mailto:' . htmlspecialchars($email) . '">' . htmlspecialchars($email) . '</a></div>
          </div>
          <div class="row-item">
            <div class="label">Phone Number</div>
            <div class="value"><a href="tel:' . htmlspecialchars($phone) . '">' . htmlspecialchars($phone) . '</a></div>
          </div>
          <div class="row-item">
            <div class="label">Application Program / Category</div>
            <div class="value">' . htmlspecialchars(ucwords(str_replace('_', ' ', $category))) . '</div>
          </div>
          <div class="row-item">
            <div class="label">Notes / Message</div>
            <div class="value" style="font-weight: 400; white-space: pre-wrap;">' . (!empty($notes) ? nl2br(htmlspecialchars($notes)) : '<em>None provided</em>') . '</div>
          </div>
          <div class="row-item" style="border-bottom: none;">
            <div class="label">Submission Details</div>
            <div class="value" style="font-size: 13px; color: #64748b; font-weight: 400;">IP: ' . htmlspecialchars($_SERVER['REMOTE_ADDR'] ?? '127.0.0.1') . ' &bull; Time: ' . gmdate('Y-m-d H:i:s') . ' UTC</div>
          </div>
        </div>
        <div class="footer">
          QGMS Quality Giving Management System &bull; Powered by QGM Inc.
        </div>
      </div>
    </body>
    </html>';

    try {
        @mail($recipient, $subject, $emailBody, implode("\r\n", $headers));
    } catch (Throwable $mailEx) {
        error_log("Failed to send registration email to " . $recipient . ": " . $mailEx->getMessage());
    }

    Security::jsonResponse([
        'success' => true,
        'message' => 'Thank you! Your registration application has been submitted successfully and delivered to our team.'
    ]);
} catch (Throwable $e) {
    error_log("Registration error: " . $e->getMessage());
    Security::jsonResponse(['error' => 'Registration could not be completed. Please try again.'], 500);
}
