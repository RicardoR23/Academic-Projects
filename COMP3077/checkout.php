<?php
require_once __DIR__ . '/includes/bootstrap.php';
require_login();

if (!cart_items()) {
    set_flash('warning', 'Your cart is empty.');
    header('Location: catalog.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['place_order'])) {
    if (!verify_csrf()) {
        set_flash('danger', 'Security check failed. Please try again.');
        header('Location: checkout.php');
        exit;
    }

    $db = db();

    if (!$db) {
        set_flash('danger', 'Database is not connected. Update config.php and import the schema first.');
        header('Location: checkout.php');
        exit;
    }

    $user = current_user();
    $address = trim($_POST['shipping_address'] ?? '');
    $notes   = trim($_POST['order_notes'] ?? '');

    if ($address === '') {
        set_flash('warning', 'Please enter a shipping address.');
        header('Location: checkout.php');
        exit;
    }

    $total = cart_total();

    $stmt = $db->prepare("
        INSERT INTO orders (user_id, order_number, total_amount, shipping_address, order_notes, status, created_at)
        VALUES (?, ?, ?, ?, ?, 'Processing', NOW())
    ");
    $orderNumber = 'CK-' . date('Ymd') . '-' . random_int(1000, 9999);
    $stmt->bind_param('isdss', $user['id'], $orderNumber, $total, $address, $notes);
    $stmt->execute();
    $orderId = $db->insert_id;

    $itemStmt = $db->prepare("
        INSERT INTO order_items (order_id, product_id, product_name, option_one, option_two, quantity, unit_price)
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ");

    foreach (cart_items() as $item) {
        $itemStmt->bind_param(
            'iisssid',
            $orderId,
            $item['product_id'],
            $item['name'],
            $item['option_one'],
            $item['option_two'],
            $item['quantity'],
            $item['price']
        );
        $itemStmt->execute();
    }

    $_SESSION['cart'] = [];
    set_flash('success', 'Order placed successfully. Your order number is ' . $orderNumber . '.');
    header('Location: orders.php');
    exit;
}

$pageKey = 'checkout';
$pageTitle = page_title('Checkout');
$pageDescription = 'Complete your order and save it in MySQL.';
include __DIR__ . '/includes/header.php';
?>
<section class="section-head">
    <div>
        <p class="eyebrow">Checkout</p>
        <h1>Complete your order</h1>
    </div>
    <span>Total: <?= currency(cart_total()) ?></span>
</section>

<div class="two-col">
    <article class="content-panel">
        <h2>Order summary</h2>
        <ul class="clean-list">
            <?php foreach (cart_items() as $item): ?>
                <li><?= e($item['name']) ?> × <?= (int) $item['quantity'] ?> - <?= currency((float) $item['price'] * (int) $item['quantity']) ?></li>
            <?php endforeach; ?>
        </ul>
    </article>

    <article class="content-panel">
        <h2>Shipping details</h2>
        <form class="stack-form" method="post" action="checkout.php">
            <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
            <label>
                Shipping address
                <textarea name="shipping_address" rows="5" placeholder="Street, city, province/state, postal code"></textarea>
            </label>
            <label>
                Order notes
                <textarea name="order_notes" rows="4" placeholder="Optional delivery notes or bundle requests"></textarea>
            </label>
            <button class="button" type="submit" name="place_order" value="1">Place order</button>
        </form>
    </article>
</div>
<?php include __DIR__ . '/includes/footer.php'; ?>
