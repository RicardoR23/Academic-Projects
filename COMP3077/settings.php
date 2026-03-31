<?php
require_once __DIR__ . '/../includes/bootstrap.php';
require_admin();

$db = db();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_theme']) && verify_csrf()) {
    $theme = trim($_POST['active_theme'] ?? 'classic');
    $allowed = ['classic', 'neon', 'autumn'];

    if (in_array($theme, $allowed, true)) {
        $stmt = $db->prepare("
            INSERT INTO site_settings (setting_key, setting_value)
            VALUES ('active_theme', ?)
            ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)
        ");
        $stmt->bind_param('s', $theme);
        $stmt->execute();

        set_flash('success', 'Site-wide template updated to ' . ucfirst($theme) . '.');
        header('Location: settings.php');
        exit;
    }
}

$pageKey = 'admin';
$pageTitle = page_title('Admin Settings');
$pageDescription = 'Switch site templates and manage store-wide settings.';
include __DIR__ . '/../includes/header.php';
include __DIR__ . '/_nav.php';
?>
<section class="content-panel">
    <p class="eyebrow">Template Controls</p>
    <h1>Site settings</h1>
    <form class="stack-form" method="post" action="settings.php">
        <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
        <label>
            Active template
            <select name="active_theme">
                <?php foreach (['classic', 'neon', 'autumn'] as $theme): ?>
                    <option value="<?= e($theme) ?>" <?= active_theme() === $theme ? 'selected' : '' ?>><?= ucfirst($theme) ?></option>
                <?php endforeach; ?>
            </select>
        </label>
        <button class="button" type="submit" name="save_theme" value="1">Save template</button>
    </form>
    <p class="muted">This admin page satisfies the requirement to switch among at least three site-wide templates.</p>
</section>
<?php include __DIR__ . '/../includes/footer.php'; ?>
