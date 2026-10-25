<?php
/**
 * QGMS - Inspiring Kindness Foundation
 * Common Header Template
 */

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/security.php';

$currentPage = $currentPage ?? basename($_SERVER['PHP_SELF'], '.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="<?= htmlspecialchars(Security::getCsrfToken()) ?>">
    <title><?= htmlspecialchars($pageTitle ?? SITE_NAME) ?></title>
    <meta name="description" content="<?= htmlspecialchars($pageDesc ?? 'Inspiring Kindness is the world\'s first platform transforming real acts of care into a positive ripple effect.') ?>">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="images/about/logo.png">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Raleway:ital,wght@0,300..900;1,300..900&family=Outfit:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Core Stylesheets -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
    <link href="css/slick.css" rel="stylesheet">
    <link href="css/slick-theme.css" rel="stylesheet">
    <link href="css/animations.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
</head>
<body>

    <!-- Top Bar -->
    <div class="qgms-topbar">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="topbar-contact">
                <a href="mailto:<?= SITE_EMAIL ?>"><i class="fa fa-envelope"></i> <?= SITE_EMAIL ?></a>
                <a href="tel:<?= str_replace([' ', '.'], '', SITE_PHONE) ?>"><i class="fa fa-phone"></i> <?= SITE_PHONE ?></a>
            </div>
            <div class="topbar-social d-none d-md-block">
                <a href="<?= LINK_FACEBOOK ?>" target="_blank" rel="noopener"><i class="fa fa-facebook"></i></a>
                <a href="<?= LINK_TWITTER ?>" target="_blank" rel="noopener"><i class="fa fa-twitter"></i></a>
                <a href="<?= LINK_LINKEDIN ?>" target="_blank" rel="noopener"><i class="fa fa-linkedin"></i></a>
                <a href="<?= LINK_YOUTUBE ?>" target="_blank" rel="noopener"><i class="fa fa-youtube-play"></i></a>
            </div>
        </div>
    </div>

    <!-- Main Navigation Bar -->
    <header class="qgms-navbar">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light p-0">
                <a class="navbar-brand qgms-brand" href="index.php">
                    <img src="images/about/logo.png" alt="Inspiring Kindness Logo">
                    <div class="qgms-brand-text">
                        <span class="qgms-brand-title">Inspiring Kindness</span>
                        <span class="qgms-brand-sub">Foundation &bull; QGMS</span>
                    </div>
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#qgmsNav" aria-controls="qgmsNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="qgmsNav">
                    <ul class="navbar-nav ml-auto align-items-lg-center">
                        <li class="nav-item <?= $currentPage === 'index' ? 'active' : '' ?>">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item dropdown <?= in_array($currentPage, ['about', 'why-us']) ? 'active' : '' ?>">
                            <a class="nav-link dropdown-toggle" href="about.php" id="aboutDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                About Us
                            </a>
                            <div class="dropdown-menu shadow-sm border-0" aria-labelledby="aboutDropdown">
                                <a class="dropdown-item" href="about.php">Our Movement & Mission</a>
                                <a class="dropdown-item" href="why-us.php">Why Kindness Matters</a>
                                <a class="dropdown-item" href="about.php#methodology">The Methodology</a>
                            </div>
                        </li>
                        <li class="nav-item <?= $currentPage === 'why-us' ? 'active' : '' ?>">
                            <a class="nav-link" href="why-us.php">Why Us?</a>
                        </li>
                        <li class="nav-item <?= $currentPage === 'team' ? 'active' : '' ?>">
                            <a class="nav-link" href="team.php">Team</a>
                        </li>
                        <li class="nav-item <?= $currentPage === 'wishes' ? 'active' : '' ?>">
                            <a class="nav-link" href="wishes.php">Wishes</a>
                        </li>
                        <li class="nav-item <?= $currentPage === 'contact' ? 'active' : '' ?>">
                            <a class="nav-link" href="contact.php">Contact</a>
                        </li>
                        <?php if (!empty($_SESSION['user_id'])): ?>
                            <li class="nav-item">
                                <a class="nav-link text-primary font-weight-bold" href="profile.php"><i class="fa fa-user-circle"></i> <?= htmlspecialchars($_SESSION['username']) ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="logout.php">Logout</a>
                            </li>
                        <?php else: ?>
                            <li class="nav-item <?= $currentPage === 'login' ? 'active' : '' ?>">
                                <a class="nav-link" href="login.php">Login</a>
                            </li>
                            <li class="nav-item <?= $currentPage === 'register' ? 'active' : '' ?>">
                                <a class="nav-link" href="register.php">Register</a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item ml-lg-2">
                            <a href="donate.php" class="btn btn-donate">Donate</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>
