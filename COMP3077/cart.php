<?php
require_once __DIR__ . '/includes/bootstrap.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && verify_csrf()) {
    if (isset($_POST['update_cart'])) {
        foreach (cart_items() as $key => $item) {
            $field = 'qty_' . md5($key);
            $qty = (int) ($_POST[$field] ?? $item['quantity']);
            update_cart_quantity($key, $qty);
        }
        set_flash('success', 'Cart updated successfully.');
        header('Location: cart.php');
        exit;
    }

    if (isset($_POST['remove_key'])) {
        remove_from_cart($_POST['remove_key']);
        set_flash('success', 'Item removed from cart.');
        header('Location: cart.php');
        exit;
    }
}

$pageKey = 'cart';
$pageTitle = page_title('Shopping Cart');
$pageDescription = 'Review your CreatorKart Gear cart before checkout.';
include __DIR__ . '/includes/header.php';
?>
<section class="section-head">
    <div>
        <p class="eyebrow">Shopping Cart</p>
        <h1>Review your items</h1>
    </div>
    <a href="catalog.php">Continue shopping</a>
</section>

<?php if (cart_items()): ?>
    <form method="post" action="cart.php">
        <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
        <div class="table-wrap">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Options</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Line total</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach (cart_items() as $key => $item): ?>
                        <tr>
                            <td>
                                <strong><?= e($item['name']) ?></strong>
                            </td>
                            <td><?= e($item['option_one']) ?> / <?= e($item['option_two']) ?></td>
                            <td><?= currency((float) $item['price']) ?></td>
                            <td>
                                <input type="number" name="qty_<?= md5($key) ?>" min="1" max="10" value="<?= (int) $item['quantity'] ?>">
                            </td>
                            <td><?= currency((float) $item['price'] * (int) $item['quantity']) ?></td>
                            <td>
                                <button class="button danger tiny" type="submit" name="remove_key" value="<?= e($key) ?>">Remove</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="summary-bar">
            <div>
                <strong>Cart total: <?= currency(cart_total()) ?></strong>
            </div>
            <div class="hero-actions">
                <button class="button secondary" type="submit" name="update_cart" value="1">Update cart</button>
                <a class="button" href="checkout.php">Proceed to checkout</a>
            </div>
        </div>
    </form>
<?php else: ?>
    <section class="content-panel">
        <p>Your cart is empty. Browse the catalog and add a few items first.</p>
    </section>
<?php endif; ?>
<?php include __DIR__ . '/includes/footer.php'; ?>
