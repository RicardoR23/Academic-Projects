<?php
require_once __DIR__ . '/includes/bootstrap.php';
header('Content-Type: application/xml; charset=utf-8');

$urls = [
    '',
    'index.php',
    'about.php',
    'catalog.php',
    'quote.php',
    'support.php',
    'contact.php',
    'monitor.php',
    'theme-preview.php',
    'help/index.html',
];

foreach (all_products() as $product) {
    $urls[] = 'product.php?slug=' . urlencode($product['slug']);
}
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <?php foreach ($urls as $item): ?>
        <url>
            <loc><?= e(base_url($item)) ?></loc>
        </url>
    <?php endforeach; ?>
</urlset>
