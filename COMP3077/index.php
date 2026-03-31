<?php
require_once __DIR__ . '/../includes/bootstrap.php';
require_admin();

$pageKey = 'admin';
$pageTitle = page_title('Admin Dashboard');
$pageDescription = 'Admin dashboard for CreatorKart Gear.';
$stats = statistics_snapshot();
$checks = monitor_checks();

include __DIR__ . '/../includes/header.php';
include __DIR__ . '/_nav.php';
?>
<section class="section-head">
    <div>
        <p class="eyebrow">Admin Area</p>
        <h1>Dashboard</h1>
    </div>
    <span>Signed in as <?= e(current_user()['full_name']) ?></span>
</section>

<section class="stats-grid">
    <article class="stat-card">
        <h3><?= $stats['products'] ?></h3>
        <p>Products</p>
    </article>
    <article class="stat-card">
        <h3><?= $stats['users'] ?></h3>
        <p>Users</p>
    </article>
    <article class="stat-card">
        <h3><?= $stats['orders'] ?></h3>
        <p>Orders</p>
    </article>
    <article class="stat-card">
        <h3><?= $stats['requests'] ?></h3>
        <p>Requests</p>
    </article>
</section>

<section class="two-col">
    <article class="content-panel">
        <h2>Current service checks</h2>
        <ul class="clean-list">
            <?php foreach ($checks as $check): ?>
                <li><strong><?= e($check['label']) ?>:</strong> <?= e($check['status']) ?></li>
            <?php endforeach; ?>
        </ul>
    </article>
    <article class="content-panel">
        <h2>Admin actions</h2>
        <ul class="clean-list">
            <li><a href="products.php">Add or edit catalog products</a></li>
            <li><a href="users.php">Disable or re-enable customer accounts</a></li>
            <li><a href="settings.php">Switch the active site template</a></li>
            <li><a href="requests.php">Respond to support requests</a></li>
        </ul>
    </article>
</section>
<?php include __DIR__ . '/../includes/footer.php'; ?>
