<?php
require_once __DIR__ . '/includes/bootstrap.php';

$pageKey = 'about';
$pageTitle = page_title('About');
$pageDescription = 'Business case and project scope for CreatorKart Gear.';
include __DIR__ . '/includes/header.php';
?>
<section class="content-panel prose">
    <p class="eyebrow">Business Case</p>
    <h1>About CreatorKart Gear</h1>
    <p>CreatorKart Gear is a fictional e-commerce business focused on gaming, creator, and desk setup products. The business case is simple: students, streamers, gamers, and remote workers often want a cleaner, better-performing setup but do not always know which accessories fit their goals or budget. This website solves that by presenting a searchable catalog of 20 products, each with at least two selectable options, along with bundle-building, customer accounts, order history, ratings, support forms, theme customization, and an admin area that manages the store from the backend. The site was intentionally designed to satisfy a full PHP and MySQL course project rubric while still feeling like a realistic online store.</p>

    <h2>Project highlights</h2>
    <ul>
        <li>Responsive storefront with HTML5, CSS, and JavaScript</li>
        <li>Public and private areas with registration, authentication, and profiles</li>
        <li>Admin tools for product editing, user administration, and template switching</li>
        <li>Help wiki, installation guide, SEO tags, and monitoring dashboard</li>
        <li>Local images, videos, audio, interactive chart, and embedded map</li>
    </ul>
</section>
<?php include __DIR__ . '/includes/footer.php'; ?>
