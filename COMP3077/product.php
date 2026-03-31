<?php
require_once __DIR__ . '/includes/bootstrap.php';

$slug = trim($_GET['slug'] ?? ($forcedSlug ?? ''));
$product = find_product_by_slug($slug);

if (!$product) {
    http_response_code(404);
    $pageKey = 'product';
    $pageTitle = page_title('Product not found');
    include __DIR__ . '/includes/header.php';
    echo '<section class="content-panel"><h1>Product not found</h1><p>The requested product could not be located.</p></section>';
    include __DIR__ . '/includes/footer.php';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    if (!verify_csrf()) {
        set_flash('danger', 'Security token mismatch. Please try again.');
        header('Location: product.php?slug=' . urlencode($product['slug']));
        exit;
    }

    add_to_cart(
        $product,
        (int) ($_POST['quantity'] ?? 1),
        trim($_POST['option_one'] ?? ''),
        trim($_POST['option_two'] ?? '')
    );
    set_flash('success', $product['name'] . ' was added to your cart.');
    header('Location: cart.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_review'])) {
    require_login();

    if (verify_csrf()) {
        $rating = max(1, min(5, (int) ($_POST['rating'] ?? 5)));
        $comment = trim($_POST['comment'] ?? '');

        if ($comment !== '') {
            create_review((int) $product['id'], (int) current_user()['id'], $rating, $comment);
            set_flash('success', 'Thank you. Your review has been saved.');
        } else {
            set_flash('warning', 'Please add a short review comment.');
        }
    }

    header('Location: product.php?slug=' . urlencode($product['slug']) . '#reviews');
    exit;
}

$pageKey = 'product';
$pageTitle = page_title($product['name']);
$pageDescription = $product['summary'];

$extraHead = '
<script type="application/ld+json">
{
  "@context":"https://schema.org",
  "@type":"Product",
  "name":"' . e($product['name']) . '",
  "description":"' . e($product['summary']) . '",
  "image":"' . e(base_url($product['image'])) . '",
  "offers":{"@type":"Offer","price":"' . number_format((float)$product['price'], 2, '.', '') . '","priceCurrency":"CAD"}
}
</script>';

include __DIR__ . '/includes/header.php';

$optionOneList = explode('|', $product['option1_values']);
$optionTwoList = explode('|', $product['option2_values']);
$reviews = product_reviews((int) $product['id']);
?>
<section class="product-layout">
    <article class="product-media">
        <img class="product-detail-image" src="<?= e($product['image']) ?>" alt="<?= e($product['name']) ?>">
        <div class="media-row">
            <video controls preload="metadata" width="100%">
                <source src="<?= e($product['video_file']) ?>" type="video/mp4">
            </video>
        </div>
        <audio controls>
            <source src="<?= e($product['audio_file']) ?>" type="audio/wav">
        </audio>
    </article>

    <article class="product-details">
        <p class="product-category"><?= e($product['category']) ?></p>
        <h1><?= e($product['name']) ?></h1>
        <p class="price-tag"><?= currency((float) $product['price']) ?></p>
        <p><?= e($product['description']) ?></p>

        <div class="rating-line">
            <span><?= number_format(average_rating((int) $product['id']), 1) ?>/5 average rating</span>
            <span><?= review_count((int) $product['id']) ?> review(s)</span>
            <span><?= (int) $product['stock'] ?> in stock</span>
        </div>

        <form class="stack-form" method="post" action="product.php?slug=<?= e($product['slug']) ?>">
            <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
            <label>
                <?= e($product['option1_name']) ?>
                <select name="option_one" required>
                    <?php foreach ($optionOneList as $option): ?>
                        <option value="<?= e($option) ?>"><?= e($option) ?></option>
                    <?php endforeach; ?>
                </select>
            </label>
            <label>
                <?= e($product['option2_name']) ?>
                <select name="option_two" required>
                    <?php foreach ($optionTwoList as $option): ?>
                        <option value="<?= e($option) ?>"><?= e($option) ?></option>
                    <?php endforeach; ?>
                </select>
            </label>
            <label>
                Quantity
                <input type="number" name="quantity" min="1" max="10" value="1">
            </label>
            <button class="button" type="submit" name="add_to_cart" value="1">Add to cart</button>
        </form>
    </article>
</section>

<section id="reviews" class="review-grid">
    <article class="content-panel">
        <h2>Customer reviews</h2>
        <?php if ($reviews): ?>
            <?php foreach ($reviews as $review): ?>
                <article class="review-card">
                    <strong><?= e($review['full_name']) ?></strong>
                    <span><?= str_repeat('★', (int) $review['rating']) ?></span>
                    <p><?= e($review['comment']) ?></p>
                </article>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No reviews yet. Be the first to leave one.</p>
        <?php endif; ?>
    </article>

    <article class="content-panel">
        <h2>Leave a review</h2>
        <?php if (is_logged_in()): ?>
            <form class="stack-form" method="post" action="product.php?slug=<?= e($product['slug']) ?>#reviews">
                <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
                <label>
                    Rating
                    <select name="rating">
                        <option value="5">5 - Excellent</option>
                        <option value="4">4 - Very good</option>
                        <option value="3">3 - Good</option>
                        <option value="2">2 - Fair</option>
                        <option value="1">1 - Poor</option>
                    </select>
                </label>
                <label>
                    Review
                    <textarea name="comment" rows="5" placeholder="Share your experience"></textarea>
                </label>
                <button class="button" type="submit" name="add_review" value="1">Submit review</button>
            </form>
        <?php else: ?>
            <p>You need an account to post a review.</p>
            <a class="button tiny" href="login.php">Login</a>
        <?php endif; ?>
    </article>
</section>
<?php include __DIR__ . '/includes/footer.php'; ?>
