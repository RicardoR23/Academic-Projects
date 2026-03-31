<?php
require_once __DIR__ . '/includes/bootstrap.php';

$pageKey = 'theme-preview';
$pageTitle = page_title('Theme Preview');
$pageDescription = 'Preview the three site templates available through the admin dashboard.';
include __DIR__ . '/includes/header.php';
?>
<section class="content-panel prose">
    <p class="eyebrow">Template Switching</p>
    <h1>Three site-wide templates</h1>
    <p>The admin dashboard can switch the active template for the entire site. This page previews the visual style options included in the project.</p>
</section>

<section class="theme-preview-grid">
    <article class="theme-demo classic-demo">
        <h2>Classic Theme</h2>
        <p>Clean corporate look with balanced contrast and rounded cards.</p>
    </article>
    <article class="theme-demo neon-demo">
        <h2>Neon Theme</h2>
        <p>High-energy dark interface for streaming and gaming-oriented branding.</p>
    </article>
    <article class="theme-demo autumn-demo">
        <h2>Autumn Theme</h2>
        <p>Warm seasonal palette to demonstrate a third layout style.</p>
    </article>
</section>
<?php include __DIR__ . '/includes/footer.php'; ?>
