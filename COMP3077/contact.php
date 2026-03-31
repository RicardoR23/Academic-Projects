<?php
require_once __DIR__ . '/includes/bootstrap.php';

$pageKey = 'contact';
$pageTitle = page_title('Contact');
$pageDescription = 'Contact and map page for CreatorKart Gear.';
include __DIR__ . '/includes/header.php';
?>
<section class="two-col">
    <article class="content-panel">
        <p class="eyebrow">Contact</p>
        <h1>Find the showroom</h1>
        <p>This page demonstrates an interactive embedded map as part of the multimedia requirement.</p>
        <p><strong>Email:</strong> hello@creatorkart.local</p>
        <p><strong>Phone:</strong> (555) 010-2026</p>
        <p><strong>Hours:</strong> Monday to Friday, 9:00 AM - 6:00 PM</p>
    </article>
    <article class="content-panel">
        <iframe
            title="CreatorKart Gear Windsor map"
            src="https://www.openstreetmap.org/export/embed.html?bbox=-83.081%2C42.298%2C-82.946%2C42.344&layer=mapnik"
            class="map-frame"></iframe>
    </article>
</section>
<?php include __DIR__ . '/includes/footer.php'; ?>
