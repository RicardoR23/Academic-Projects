<?php
/**
 * Shared HTML head and site navigation.
 *
 * Supported variables:
 * $pageKey
 * $pageTitle
 * $pageDescription
 * $pageKeywords
 * $pageRobots
 * $extraHead
 */

$pageKey = $pageKey ?? 'index';
$pageTitle = $pageTitle ?? page_title();
$pageDescription = $pageDescription ?? 'CreatorKart Gear is a PHP and MySQL storefront for creator, gaming, and desk setup products.';
$pageKeywords = $pageKeywords ?? 'gaming gear, creator setup, php mysql ecommerce, desk accessories, streaming gear';
$pageRobots = $pageRobots ?? 'index,follow';
$extraHead = $extraHead ?? '';
$theme = active_theme();
$currentUser = current_user();
$rootPrefix = (strpos($_SERVER['SCRIPT_NAME'] ?? '', '/admin/') !== false) ? '../' : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($pageTitle) ?></title>
    <meta name="description" content="<?= e($pageDescription) ?>">
    <meta name="keywords" content="<?= e($pageKeywords) ?>">
    <meta name="robots" content="<?= e($pageRobots) ?>">
    <link rel="icon" type="image/svg+xml" href="<?= e($rootPrefix) ?>assets/img/favicon.svg">
    <link rel="canonical" href="<?= e(canonical_url()) ?>">
    <meta property="og:title" content="<?= e($pageTitle) ?>">
    <meta property="og:description" content="<?= e($pageDescription) ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= e(canonical_url()) ?>">
    <meta property="og:image" content="<?= e(base_url('assets/img/logo.svg')) ?>">
    <meta name="twitter:card" content="summary_large_image">
    <base href="<?= e((strpos($_SERVER['SCRIPT_NAME'] ?? '', '/admin/') !== false) ? base_url('admin/') : base_url()) ?>">
    <link rel="stylesheet" href="<?= e($rootPrefix) ?>assets/css/style.css">
    <script defer src="<?= e($rootPrefix) ?>assets/js/app.js"></script>
    <?= $extraHead ?>
</head>
<body class="theme-<?= e($theme) ?>">
<header class="site-header">
    <div class="container topbar">
        <a href="<?= e($rootPrefix) ?>index.php" class="brand">
            <img src="<?= e($rootPrefix) ?>assets/img/logo.svg" alt="CreatorKart Gear logo">
        </a>

        <button class="menu-toggle" aria-expanded="false" aria-controls="main-nav">Menu</button>

        <nav id="main-nav" class="main-nav">
            <a href="<?= e($rootPrefix) ?>index.php">Home</a>
            <a href="<?= e($rootPrefix) ?>about.php">About</a>
            <a href="<?= e($rootPrefix) ?>catalog.php">Catalog</a>
            <a href="<?= e($rootPrefix) ?>quote.php">Bundle Builder</a>
            <a href="<?= e($rootPrefix) ?>support.php">Support</a>
            <a href="<?= e($rootPrefix) ?>contact.php">Contact</a>
            <a href="<?= e($rootPrefix) ?>monitor.php">Monitor</a>
            <?php if (is_admin()): ?>
                <a href="<?= e($rootPrefix) ?>admin/index.php">Admin</a>
            <?php endif; ?>
        </nav>

        <div class="header-actions">
            <a class="cart-link" href="<?= e($rootPrefix) ?>cart.php">Cart (<?= cart_count() ?>)</a>
            <?php if ($currentUser): ?>
                <a href="<?= e($rootPrefix) ?>profile.php"><?= e($currentUser['full_name']) ?></a>
                <a href="<?= e($rootPrefix) ?>logout.php">Logout</a>
            <?php else: ?>
                <a href="<?= e($rootPrefix) ?>login.php">Login</a>
                <a href="<?= e($rootPrefix) ?>register.php" class="button tiny">Register</a>
            <?php endif; ?>
        </div>
    </div>
</header>

<div class="help-chip">
    <a href="<?= e(context_help_link($pageKey)) ?>" target="_blank" rel="noopener">Context Help</a>
</div>

<main class="site-main">
    <div class="container">
        <?php foreach (get_flashes() as $flash): ?>
            <div class="flash flash-<?= e($flash['type']) ?>"><?= e($flash['message']) ?></div>
        <?php endforeach; ?>
