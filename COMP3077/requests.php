<?php
require_once __DIR__ . '/../includes/bootstrap.php';
require_admin();

$db = db();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_response']) && verify_csrf()) {
    $requestId = (int) ($_POST['request_id'] ?? 0);
    $response  = trim($_POST['admin_response'] ?? '');
    $status    = trim($_POST['status'] ?? 'Open');

    $stmt = $db->prepare("UPDATE service_requests SET admin_response = ?, status = ? WHERE id = ?");
    $stmt->bind_param('ssi', $response, $status, $requestId);
    $stmt->execute();

    set_flash('success', 'Support request updated.');
    header('Location: requests.php');
    exit;
}

$result = $db ? $db->query("SELECT * FROM service_requests ORDER BY created_at DESC") : false;
$requests = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];

$pageKey = 'admin';
$pageTitle = page_title('Admin Requests');
$pageDescription = 'Review and respond to support requests.';
include __DIR__ . '/../includes/header.php';
include __DIR__ . '/_nav.php';
?>
<section class="content-panel">
    <p class="eyebrow">Support Inbox</p>
    <h1>Requests</h1>

    <div class="stack-grid">
        <?php foreach ($requests as $request): ?>
            <article class="request-card">
                <h2><?= e($request['subject']) ?></h2>
                <p><strong>From:</strong> <?= e($request['full_name']) ?> (<?= e($request['email']) ?>)</p>
                <p><strong>Status:</strong> <?= e($request['status']) ?></p>
                <p><?= nl2br(e($request['message'])) ?></p>
                <?php if (!empty($request['attachment_name'])): ?>
                    <p><strong>Attachment:</strong> <?= e($request['attachment_name']) ?></p>
                <?php endif; ?>

                <form class="stack-form" method="post" action="requests.php">
                    <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
                    <input type="hidden" name="request_id" value="<?= (int) $request['id'] ?>">
                    <label>
                        Status
                        <select name="status">
                            <?php foreach (['New', 'Open', 'Answered', 'Closed'] as $status): ?>
                                <option value="<?= e($status) ?>" <?= $request['status'] === $status ? 'selected' : '' ?>><?= e($status) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </label>
                    <label>
                        Admin response
                        <textarea name="admin_response" rows="4"><?= e($request['admin_response']) ?></textarea>
                    </label>
                    <button class="button tiny" type="submit" name="save_response" value="1">Save response</button>
                </form>
            </article>
        <?php endforeach; ?>
    </div>
</section>
<?php include __DIR__ . '/../includes/footer.php'; ?>
