<?php
require_once __DIR__ . '/includes/bootstrap.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    if (!verify_csrf()) {
        set_flash('danger', 'Security token mismatch.');
        header('Location: register.php');
        exit;
    }

    $fullName = trim($_POST['full_name'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($fullName && filter_var($email, FILTER_VALIDATE_EMAIL) && strlen($password) >= 8) {
        if (register_user($fullName, $email, $password)) {
            set_flash('success', 'Registration complete. Please log in.');
            header('Location: login.php');
            exit;
        }

        set_flash('danger', 'Registration failed. This email might already exist.');
    } else {
        set_flash('warning', 'Enter a valid name, email, and password of at least 8 characters.');
    }
}

$pageKey = 'register';
$pageTitle = page_title('Register');
$pageDescription = 'Create a customer account for CreatorKart Gear.';
include __DIR__ . '/includes/header.php';
?>
<section class="auth-shell">
    <article class="content-panel auth-panel">
        <p class="eyebrow">Customer Account</p>
        <h1>Create your account</h1>
        <form class="stack-form" method="post" action="register.php">
            <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
            <label>
                Full name
                <input type="text" name="full_name" required>
            </label>
            <label>
                Email
                <input type="email" name="email" required>
            </label>
            <label>
                Password
                <input type="password" name="password" minlength="8" required>
            </label>
            <button class="button" type="submit" name="register" value="1">Register</button>
        </form>
    </article>
</section>
<?php include __DIR__ . '/includes/footer.php'; ?>
