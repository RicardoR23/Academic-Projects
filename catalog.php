<?php
require_once __DIR__ . '/includes/bootstrap.php';

$pageKey = 'catalog';
$pageTitle = page_title('Catalog');
$pageDescription = 'Browse the 20-product CreatorKart Gear catalog.';
$search = trim($_GET['q'] ?? '');
$category = trim($_GET['category'] ?? '');
$products = all_products($search ?: null, $category ?: null);

include __DIR__ . '/includes/header.php';
?>
<section class="section-head">
    <div>
        <p class="eyebrow">Catalog</p>
        <h1>Browse all products</h1>
    </div>
    <a href="compare.php">Product comparison view</a>
</section>

<form class="filter-bar" method="get" action="catalog.php">
    <input type="search" name="q" value="<?= e($search) ?>" placeholder="Search by keyword">
    <select name="category">
        <option value="">All categories</option>
        <?php foreach (categories() as $item): ?>
            <option value="<?= e($item) ?>" <?= $category === $item ? 'selected' : '' ?>><?= e($item) ?></option>
        <?php endforeach; ?>
    </select>
    <button class="button" type="submit">Apply filters</button>
</form>

<section class="product-grid">
    <?php foreach ($products as $product): ?>
        <article class="product-card">
            <img src="<?= e($product['image']) ?>" alt="<?= e($product['name']) ?>">
            <div class="product-card-body">
                <p class="product-category"><?= e($product['category']) ?></p>
                <h2><a href="product.php?slug=<?= e($product['slug']) ?>"><?= e($product['name']) ?></a></h2>
                <p><?= e($product['summary']) ?></p>
                <div class="rating-line">
                    <span>Rating: <?= number_format(average_rating((int) $product['id']), 1) ?>/5</span>
                    <span><?= review_count((int) $product['id']) ?> reviews</span>
                </div>
                <div class="card-bottom">
                    <strong><?= currency((float) $product['price']) ?></strong>
                    <a class="button tiny" href="product.php?slug=<?= e($product['slug']) ?>">View details</a>
                </div>
            </div>
        </article>
    <?php endforeach; ?>
</section>
<?php if (!$products): ?>
    <section class="content-panel">
        <p>No products matched your search. Try another keyword or reset the category filter.</p>
    </section>
<?php endif; ?>
<?php include __DIR__ . '/includes/footer.php'; ?>
