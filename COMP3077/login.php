<?php
require_once __DIR__ . '/includes/bootstrap.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    if (!verify_csrf()) {
        set_flash('danger', 'Security token mismatch.');
        header('Location: login.php');
        exit;
    }

    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (login_user($email, $password)) {
        set_flash('success', 'Welcome back.');
        if (is_admin()) {
            header('Location: admin/index.php');
        } else {
            header('Location: profile.php');
        }
        exit;
    }

    set_flash('danger', 'Login failed. Check your credentials or account status.');
}

$pageKey = 'login';
$pageTitle = page_title('Login');
$pageDescription = 'Sign in to the customer or admin area.';
include __DIR__ . '/includes/header.php';
?>
<section class="auth-shell">
    <article class="content-panel auth-panel">
        <p class="eyebrow">Sign In</p>
        <h1>Login</h1>
        <form class="stack-form" method="post" action="login.php">
            <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
            <label>
                Email
                <input type="email" name="email" required>
            </label>
            <label>
                Password
                <input type="password" name="password" required>
            </label>
            <button class="button" type="submit" name="login" value="1">Login</button>
        </form>
        <p class="muted">Seeded admin account: admin@creatorkart.local / Admin123!</p>
    </article>
</section>
<?php include __DIR__ . '/includes/footer.php'; ?>
