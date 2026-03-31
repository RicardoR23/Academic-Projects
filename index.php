<?php
require_once __DIR__ . '/includes/bootstrap.php';

$pageKey = 'index';
$pageTitle = page_title('Home');
$pageDescription = 'Shop 20 creator and gaming products, preview three templates, explore a PHP/MySQL storefront, and test account, cart, checkout, and admin features.';
$featured = featured_products(6);
$stats = statistics_snapshot();

$extraHead = '
<script type="application/ld+json">
{
  "@context":"https://schema.org",
  "@type":"Store",
  "name":"CreatorKart Gear",
  "url":"' . e(base_url()) . '",
  "image":"' . e(base_url('assets/img/logo.svg')) . '",
  "description":"PHP and MySQL e-commerce project for creator and gaming setup products."
}
</script>';

include __DIR__ . '/includes/header.php';
?>
<section class="hero">
    <div>
        <p class="eyebrow">Course Project Showcase</p>
        <h1>CreatorKart Gear</h1>
        <p>CreatorKart Gear is a creator-focused online store for gaming, streaming, and desk setup products. It demonstrates client-server features with PHP, MySQL, authentication, admin tools, theming, SEO, multimedia, responsive design, and end-user training materials.</p>
        <div class="hero-actions">
            <a class="button" href="catalog.php">Shop the catalog</a>
            <a class="button secondary" href="theme-preview.php">Preview 3 templates</a>
        </div>
        <div class="inline-pills">
            <span>20 products</span>
            <span>3 site templates</span>
            <span>5 help pages</span>
            <span>Admin + customer areas</span>
        </div>
    </div>
    <div class="hero-card">
        <h2>What this site proves</h2>
        <ul class="checklist">
            <li>Dynamic product pages, cart, checkout, reviews, orders, and profile history</li>
            <li>Admin product editing, user management, request handling, and template switching</li>
            <li>Interactive graph, map, responsive menu, videos, images, and accessibility-friendly layout</li>
        </ul>
    </div>
</section>

<section class="stats-grid">
    <article class="stat-card">
        <h3><?= $stats['products'] ?></h3>
        <p>Catalog items in MySQL</p>
    </article>
    <article class="stat-card">
        <h3><?= $stats['users'] ?></h3>
        <p>Users stored in database</p>
    </article>
    <article class="stat-card">
        <h3><?= $stats['orders'] ?></h3>
        <p>Orders recorded</p>
    </article>
    <article class="stat-card">
        <h3><?= $stats['requests'] ?></h3>
        <p>Support requests received</p>
    </article>
</section>

<section class="section-head">
    <div>
        <p class="eyebrow">Featured collection</p>
        <h2>Popular creator picks</h2>
    </div>
    <a href="catalog.php">View all products</a>
</section>
<section class="product-grid">
    <?php foreach ($featured as $product): ?>
        <article class="product-card">
            <img src="<?= e($product['image']) ?>" alt="<?= e($product['name']) ?>">
            <div class="product-card-body">
                <p class="product-category"><?= e($product['category']) ?></p>
                <h3><a href="product.php?slug=<?= e($product['slug']) ?>"><?= e($product['name']) ?></a></h3>
                <p><?= e($product['summary']) ?></p>
                <div class="card-bottom">
                    <strong><?= currency((float) $product['price']) ?></strong>
                    <a class="button tiny" href="product.php?slug=<?= e($product['slug']) ?>">Details</a>
                </div>
            </div>
        </article>
    <?php endforeach; ?>
</section>

<section class="media-grid">
    <article>
        <h2>Built-in multimedia</h2>
        <p>The project ships with local video and audio files so it can demonstrate HTML5 media without depending on external embeds.</p>
        <div class="video-stack">
            <video controls preload="metadata" width="100%">
                <source src="assets/media/showcase-1.mp4" type="video/mp4">
            </video>
            <audio controls>
                <source src="assets/media/audio-1.wav" type="audio/wav">
            </audio>
        </div>
    </article>
    <article class="chart-card">
        <h2>Category data visualization</h2>
        <p>This graph is drawn with JavaScript and updates from server-rendered category totals.</p>
        <?php
        $categoryCounts = [];
        foreach (categories() as $category) {
            $categoryCounts[$category] = count(all_products(null, $category));
        }
        ?>
        <canvas id="categoryChart" width="480" height="280"
            data-labels='<?= e(json_encode(array_keys($categoryCounts))) ?>'
            data-values='<?= e(json_encode(array_values($categoryCounts))) ?>'></canvas>
    </article>
</section>

<section class="callout-grid">
    <article class="callout">
        <h3>Customer experience</h3>
        <p>Register, sign in, add products to the cart, check out, review items, browse order history, and send support questions with an optional attachment.</p>
    </article>
    <article class="callout">
        <h3>Admin experience</h3>
        <p>Sign in with the seeded admin account to switch templates, edit catalog records, disable users, and review incoming orders and support requests.</p>
    </article>
    <article class="callout">
        <h3>Documentation</h3>
        <p>Visit the help wiki for site tours, user guidance, admin training, content update instructions, and troubleshooting steps.</p>
    </article>
</section>
<?php include __DIR__ . '/includes/footer.php'; ?>
