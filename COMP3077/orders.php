<?php
require_once __DIR__ . '/../includes/bootstrap.php';
require_admin();

$db = db();
$orders = [];
if ($db) {
    $result = $db->query("SELECT * FROM orders ORDER BY created_at DESC");
    $orders = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
}

$pageKey = 'admin';
$pageTitle = page_title('Admin Orders');
$pageDescription = 'Admin order history and tracking.';
include __DIR__ . '/../includes/header.php';
include __DIR__ . '/_nav.php';
?>
<section class="section-head">
    <div>
        <p class="eyebrow">Orders</p>
        <h1>Customer orders</h1>
    </div>
</section>

<div class="table-wrap">
    <table class="data-table">
        <thead>
            <tr>
                <th>Order #</th>
                <th>User ID</th>
                <th>Total</th>
                <th>Status</th>
                <th>Created</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?= e($order['order_number']) ?></td>
                    <td><?= (int) $order['user_id'] ?></td>
                    <td><?= currency((float) $order['total_amount']) ?></td>
                    <td><?= e($order['status']) ?></td>
                    <td><?= e($order['created_at']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php include __DIR__ . '/../includes/footer.php'; ?>
