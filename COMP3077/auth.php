<?php
/**
 * Authentication + authorization helpers.
 */

function current_user(): ?array
{
    if (empty($_SESSION['user'])) {
        return null;
    }

    return $_SESSION['user'];
}

function is_logged_in(): bool
{
    return current_user() !== null;
}

function is_admin(): bool
{
    return is_logged_in() && (current_user()['role'] ?? '') === 'admin';
}

function login_user(string $email, string $password): bool
{
    $db = db();
    if (!$db) {
        return false;
    }

    $stmt = $db->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();

    if (!$user || !(int) $user['is_active']) {
        return false;
    }

    if (!password_verify($password, $user['password_hash'])) {
        return false;
    }

    $_SESSION['user'] = [
        'id'        => (int) $user['id'],
        'full_name' => $user['full_name'],
        'email'     => $user['email'],
        'role'      => $user['role'],
        'is_active' => (int) $user['is_active'],
    ];

    return true;
}

function logout_user(): void
{
    unset($_SESSION['user']);
}

function register_user(string $fullName, string $email, string $password): bool
{
    $db = db();
    if (!$db) {
        return false;
    }

    $hash = password_hash($password, PASSWORD_DEFAULT);
    $role = 'customer';
    $active = 1;

    $stmt = $db->prepare("
        INSERT INTO users (full_name, email, password_hash, role, is_active, created_at)
        VALUES (?, ?, ?, ?, ?, NOW())
    ");
    $stmt->bind_param('ssssi', $fullName, $email, $hash, $role, $active);

    return $stmt->execute();
}

function require_login(): void
{
    if (!is_logged_in()) {
        set_flash('warning', 'Please sign in to access that page.');
        header('Location: ' . base_url('login.php'));
        exit;
    }
}

function require_admin(): void
{
    if (!is_admin()) {
        set_flash('danger', 'Admin access is required.');
        header('Location: ' . base_url('login.php'));
        exit;
    }
}
