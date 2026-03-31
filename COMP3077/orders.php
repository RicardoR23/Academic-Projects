<?php
require_once __DIR__ . '/includes/bootstrap.php';
require_login();

$db = db();
$orders = [];

if ($db) {
    $stmt = $db->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC");
    $userId = current_user()['id'];
    $stmt->bind_param('i', $userId);
    $stmt->execute();
    $orders = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

$pageKey = 'orders';
$pageTitle = page_title('Order History');
$pageDescription = 'Track previous CreatorKart Gear orders.';
include __DIR__ . '/includes/header.php';
?>
<section class="section-head">
    <div>
        <p class="eyebrow">Order History</p>
        <h1>Your orders</h1>
    </div>
    <a href="catalog.php">Shop again</a>
</section>

<?php if ($orders): ?>
    <div class="stack-grid">
        <?php foreach ($orders as $order): ?>
            <article class="content-panel">
                <h2><?= e($order['order_number']) ?></h2>
                <p><strong>Status:</strong> <?= e($order['status']) ?></p>
                <p><strong>Total:</strong> <?= currency((float) $order['total_amount']) ?></p>
                <p><strong>Placed:</strong> <?= e($order['created_at']) ?></p>
                <p><strong>Shipping address:</strong> <?= e($order['shipping_address']) ?></p>
            </article>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <section class="content-panel">
        <p>You do not have any orders yet.</p>
    </section>
<?php endif; ?>
<?php include __DIR__ . '/includes/footer.php'; ?>
