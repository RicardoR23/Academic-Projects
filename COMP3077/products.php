<?php
require_once __DIR__ . '/../includes/bootstrap.php';
require_admin();

$products = all_products();

$pageKey = 'admin';
$pageTitle = page_title('Admin Products');
$pageDescription = 'Manage products and record editing.';
include __DIR__ . '/../includes/header.php';
include __DIR__ . '/_nav.php';
?>
<section class="section-head">
    <div>
        <p class="eyebrow">Catalog Administration</p>
        <h1>Products</h1>
    </div>
    <a class="button tiny" href="product_edit.php">Add new product</a>
</section>

<div class="table-wrap">
    <table class="data-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= e($product['name']) ?></td>
                    <td><?= e($product['category']) ?></td>
                    <td><?= currency((float) $product['price']) ?></td>
                    <td><?= (int) $product['stock'] ?></td>
                    <td><a class="button tiny" href="product_edit.php?id=<?= (int) $product['id'] ?>">Edit</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php include __DIR__ . '/../includes/footer.php'; ?>
