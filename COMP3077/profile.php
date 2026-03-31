<?php
require_once __DIR__ . '/includes/bootstrap.php';
require_login();

$pageKey = 'profile';
$pageTitle = page_title('Profile');
$pageDescription = 'Manage your CreatorKart Gear profile.';
$user = current_user();

include __DIR__ . '/includes/header.php';
?>
<section class="content-panel">
    <p class="eyebrow">Private Area</p>
    <h1>Your profile</h1>
    <div class="profile-grid">
        <div>
            <h2>Account details</h2>
            <p><strong>Name:</strong> <?= e($user['full_name']) ?></p>
            <p><strong>Email:</strong> <?= e($user['email']) ?></p>
            <p><strong>Role:</strong> <?= e($user['role']) ?></p>
        </div>
        <div>
            <h2>Quick links</h2>
            <ul class="clean-list">
                <li><a href="orders.php">View order history</a></li>
                <li><a href="support.php">Open a support request</a></li>
                <li><a href="catalog.php">Continue shopping</a></li>
            </ul>
        </div>
    </div>
</section>
<?php include __DIR__ . '/includes/footer.php'; ?>
