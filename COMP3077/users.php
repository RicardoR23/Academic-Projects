<?php
require_once __DIR__ . '/../includes/bootstrap.php';
require_admin();

$db = db();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['toggle_user']) && verify_csrf()) {
    $userId = (int) ($_POST['user_id'] ?? 0);
    $newStatus = (int) ($_POST['new_status'] ?? 0);
    $stmt = $db->prepare("UPDATE users SET is_active = ? WHERE id = ?");
    $stmt->bind_param('ii', $newStatus, $userId);
    $stmt->execute();

    set_flash('success', 'User status updated.');
    header('Location: users.php');
    exit;
}

$result = $db ? $db->query("SELECT id, full_name, email, role, is_active, created_at FROM users ORDER BY created_at DESC") : false;
$users = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];

$pageKey = 'admin';
$pageTitle = page_title('Admin Users');
$pageDescription = 'User account administration.';
include __DIR__ . '/../includes/header.php';
include __DIR__ . '/_nav.php';
?>
<section class="section-head">
    <div>
        <p class="eyebrow">User Administration</p>
        <h1>Users</h1>
    </div>
</section>

<div class="table-wrap">
    <table class="data-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Active</th>
                <th>Created</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= e($user['full_name']) ?></td>
                    <td><?= e($user['email']) ?></td>
                    <td><?= e($user['role']) ?></td>
                    <td><?= (int) $user['is_active'] ? 'Yes' : 'No' ?></td>
                    <td><?= e($user['created_at']) ?></td>
                    <td>
                        <?php if ($user['role'] !== 'admin'): ?>
                            <form method="post" action="users.php">
                                <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
                                <input type="hidden" name="user_id" value="<?= (int) $user['id'] ?>">
                                <input type="hidden" name="new_status" value="<?= (int) $user['is_active'] ? 0 : 1 ?>">
                                <button class="button tiny <?= (int) $user['is_active'] ? 'danger' : '' ?>" type="submit" name="toggle_user" value="1">
                                    <?= (int) $user['is_active'] ? 'Disable' : 'Enable' ?>
                                </button>
                            </form>
                        <?php else: ?>
                            Admin protected
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php include __DIR__ . '/../includes/footer.php'; ?>
