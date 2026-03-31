<?php
require_once __DIR__ . '/../includes/bootstrap.php';
require_admin();

$db = db();
$id = (int) ($_GET['id'] ?? 0);
$product = $id ? find_product_by_id($id) : null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_product']) && verify_csrf()) {
    $payload = [
        'slug'           => trim($_POST['slug'] ?? ''),
        'name'           => trim($_POST['name'] ?? ''),
        'category'       => trim($_POST['category'] ?? ''),
        'price'          => (float) ($_POST['price'] ?? 0),
        'summary'        => trim($_POST['summary'] ?? ''),
        'description'    => trim($_POST['description'] ?? ''),
        'stock'          => (int) ($_POST['stock'] ?? 0),
        'option1_name'   => trim($_POST['option1_name'] ?? ''),
        'option1_values' => trim($_POST['option1_values'] ?? ''),
        'option2_name'   => trim($_POST['option2_name'] ?? ''),
        'option2_values' => trim($_POST['option2_values'] ?? ''),
    ];

    if ($id && $product) {
        $stmt = $db->prepare("
            UPDATE products
            SET slug = ?, name = ?, category = ?, price = ?, summary = ?, description = ?, stock = ?,
                option1_name = ?, option1_values = ?, option2_name = ?, option2_values = ?
            WHERE id = ?
        ");
        $stmt->bind_param(
            'sssdsisssssi',
            $payload['slug'],
            $payload['name'],
            $payload['category'],
            $payload['price'],
            $payload['summary'],
            $payload['description'],
            $payload['stock'],
            $payload['option1_name'],
            $payload['option1_values'],
            $payload['option2_name'],
            $payload['option2_values'],
            $id
        );
        $stmt->execute();
        set_flash('success', 'Product updated successfully.');
    } else {
        $defaultImage = 'assets/img/products/product-01.svg';
        $defaultVideo = 'assets/media/showcase-1.mp4';
        $defaultAudio = 'assets/media/audio-1.wav';
        $isFeatured = 0;

        $stmt = $db->prepare("
            INSERT INTO products (
                slug, name, category, price, summary, description, image, stock,
                option1_name, option1_values, option2_name, option2_values,
                video_file, audio_file, is_featured, created_at
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())
        ");
        $stmt->bind_param(
            'sssdsssissssssi',
            $payload['slug'],
            $payload['name'],
            $payload['category'],
            $payload['price'],
            $payload['summary'],
            $payload['description'],
            $defaultImage,
            $payload['stock'],
            $payload['option1_name'],
            $payload['option1_values'],
            $payload['option2_name'],
            $payload['option2_values'],
            $defaultVideo,
            $defaultAudio,
            $isFeatured
        );
        $stmt->execute();
        set_flash('success', 'Product created successfully.');
    }

    header('Location: products.php');
    exit;
}

$pageKey = 'admin';
$pageTitle = page_title($product ? 'Edit Product' : 'Add Product');
$pageDescription = 'Admin product editor for catalog records.';
include __DIR__ . '/../includes/header.php';
include __DIR__ . '/_nav.php';
?>
<section class="content-panel">
    <p class="eyebrow">Record Editor</p>
    <h1><?= $product ? 'Edit product' : 'Add product' ?></h1>
    <form class="stack-form" method="post" action="">
        <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
        <label>Slug <input type="text" name="slug" value="<?= e($product['slug'] ?? '') ?>" required></label>
        <label>Name <input type="text" name="name" value="<?= e($product['name'] ?? '') ?>" required></label>
        <label>Category <input type="text" name="category" value="<?= e($product['category'] ?? '') ?>" required></label>
        <label>Price <input type="number" name="price" step="0.01" value="<?= e($product['price'] ?? '0.00') ?>" required></label>
        <label>Stock <input type="number" name="stock" value="<?= e($product['stock'] ?? '10') ?>" required></label>
        <label>Summary <textarea name="summary" rows="3"><?= e($product['summary'] ?? '') ?></textarea></label>
        <label>Description <textarea name="description" rows="5"><?= e($product['description'] ?? '') ?></textarea></label>
        <label>Option 1 Label <input type="text" name="option1_name" value="<?= e($product['option1_name'] ?? '') ?>" required></label>
        <label>Option 1 Values (pipe separated) <input type="text" name="option1_values" value="<?= e($product['option1_values'] ?? '') ?>" required></label>
        <label>Option 2 Label <input type="text" name="option2_name" value="<?= e($product['option2_name'] ?? '') ?>" required></label>
        <label>Option 2 Values (pipe separated) <input type="text" name="option2_values" value="<?= e($product['option2_values'] ?? '') ?>" required></label>
        <button class="button" type="submit" name="save_product" value="1">Save product</button>
    </form>
</section>
<?php include __DIR__ . '/../includes/footer.php'; ?>
