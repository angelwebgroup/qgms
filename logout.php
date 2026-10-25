<?php
/**
 * QGMS - Logout Script
 */

require_once __DIR__ . '/config/config.php';

// Unset user session
unset($_SESSION['user_id']);
unset($_SESSION['username']);
unset($_SESSION['email']);
unset($_SESSION['role']);

// Redirect to home
header("Location: index.php");
exit;
