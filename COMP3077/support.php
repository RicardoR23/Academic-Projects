<?php
require_once __DIR__ . '/includes/bootstrap.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['send_request'])) {
    if (!verify_csrf()) {
        set_flash('danger', 'Security token mismatch.');
        header('Location: support.php');
        exit;
    }

    $attachmentName = '';

    if (!empty($_FILES['attachment']['name']) && is_uploaded_file($_FILES['attachment']['tmp_name'])) {
        $safeName = time() . '-' . preg_replace('/[^A-Za-z0-9._-]/', '-', $_FILES['attachment']['name']);
        $target = $config['uploads_dir'] . '/' . $safeName;
        if (@move_uploaded_file($_FILES['attachment']['tmp_name'], $target)) {
            $attachmentName = $safeName;
        }
    }

    $payload = [
        'user_id'         => is_logged_in() ? (int) current_user()['id'] : 0,
        'full_name'       => trim($_POST['full_name'] ?? ''),
        'email'           => trim($_POST['email'] ?? ''),
        'subject'         => trim($_POST['subject'] ?? ''),
        'message'         => trim($_POST['message'] ?? ''),
        'attachment_name' => $attachmentName,
    ];

    if ($payload['full_name'] && filter_var($payload['email'], FILTER_VALIDATE_EMAIL) && $payload['subject'] && $payload['message']) {
        create_service_request($payload);
        set_flash('success', 'Support request sent successfully.');
        header('Location: support.php');
        exit;
    }

    set_flash('warning', 'Please complete the required fields.');
}

$pageKey = 'support';
$pageTitle = page_title('Support');
$pageDescription = 'Dynamic support form with optional file attachment.';
include __DIR__ . '/includes/header.php';
?>
<section class="two-col">
    <article class="content-panel">
        <p class="eyebrow">Dynamic Form #2</p>
        <h1>Support request center</h1>
        <p>Ask a question, upload a document, and save the request to the database. Admin users can review the request inside the dashboard.</p>
        <form class="stack-form" method="post" action="support.php" enctype="multipart/form-data">
            <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
            <label>
                Full name
                <input type="text" name="full_name" value="<?= e(current_user()['full_name'] ?? '') ?>" required>
            </label>
            <label>
                Email
                <input type="email" name="email" value="<?= e(current_user()['email'] ?? '') ?>" required>
            </label>
            <label>
                Subject
                <input type="text" name="subject" required>
            </label>
            <label>
                Message
                <textarea name="message" rows="6" required></textarea>
            </label>
            <label>
                Optional attachment
                <input type="file" name="attachment">
            </label>
            <button class="button" type="submit" name="send_request" value="1">Send request</button>
        </form>
    </article>

    <article class="content-panel">
        <h2>Support workflow</h2>
        <ol class="help-steps">
            <li>Customer submits the support form.</li>
            <li>Request is saved in MySQL and optional upload is stored in the uploads folder.</li>
            <li>Admin reviews the request in the admin dashboard.</li>
            <li>Status and response can be updated by staff.</li>
        </ol>
    </article>
</section>
<?php include __DIR__ . '/includes/footer.php'; ?>
