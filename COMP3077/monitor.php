<?php
require_once __DIR__ . '/includes/bootstrap.php';

$pageKey = 'monitor';
$pageTitle = page_title('System Monitor');
$pageDescription = 'Monitoring page showing the working status of website services.';
$checks = monitor_checks();
include __DIR__ . '/includes/header.php';
?>
<section class="section-head">
    <div>
        <p class="eyebrow">Backend Monitor</p>
        <h1>System status dashboard</h1>
    </div>
    <a href="admin/index.php">Open admin dashboard</a>
</section>

<section class="monitor-grid">
    <?php foreach ($checks as $check): ?>
        <article class="monitor-card <?= strtolower($check['status']) === 'online' ? 'ok' : 'bad' ?>">
            <h2><?= e($check['label']) ?></h2>
            <p class="status"><?= e($check['status']) ?></p>
            <p><?= e($check['detail']) ?></p>
        </article>
    <?php endforeach; ?>
</section>
<?php include __DIR__ . '/includes/footer.php'; ?>
