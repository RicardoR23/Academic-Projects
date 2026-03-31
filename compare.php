<?php
require_once __DIR__ . '/includes/bootstrap.php';

$items = array_slice(all_products(), 0, 6);

$pageKey = 'catalog';
$pageTitle = page_title('Compare Products');
$pageDescription = 'Compare catalog products by price, stock, and options.';
include __DIR__ . '/includes/header.php';
?>
<section class="section-head">
    <div>
        <p class="eyebrow">Comparison</p>
        <h1>Quick product comparison</h1>
    </div>
    <a href="catalog.php">Back to catalog</a>
</section>

<div class="table-wrap">
    <table class="data-table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Category</th>
                <th>Price</th>
                <th>Option One</th>
                <th>Option Two</th>
                <th>Stock</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $item): ?>
                <tr>
                    <td><a href="product.php?slug=<?= e($item['slug']) ?>"><?= e($item['name']) ?></a></td>
                    <td><?= e($item['category']) ?></td>
                    <td><?= currency((float) $item['price']) ?></td>
                    <td><?= e($item['option1_name']) ?></td>
                    <td><?= e($item['option2_name']) ?></td>
                    <td><?= (int) $item['stock'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php include __DIR__ . '/includes/footer.php'; ?>
