<?php
require_once __DIR__ . '/includes/bootstrap.php';
http_response_code(404);

$pageKey = '404';
$pageTitle = page_title('404 Not Found');
$pageDescription = 'The requested page could not be found.';
$pageRobots = 'noindex,nofollow';
include __DIR__ . '/includes/header.php';
?>
<section class="page-hero compact">
    <p class="eyebrow">404</p>
    <h1>Page not found</h1>
    <p>The URL you requested does not exist on this server.</p>
    <div class="hero-actions">
        <a class="button" href="index.php">Back to home</a>
        <a class="button secondary" href="catalog.php">Browse catalog</a>
    </div>
</section>
<?php include __DIR__ . '/includes/footer.php'; ?>
