<?php
require_once __DIR__ . '/includes/bootstrap.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['request_quote'])) {
    if (!verify_csrf()) {
        set_flash('danger', 'Security token mismatch.');
        header('Location: quote.php');
        exit;
    }

    $payload = [
        'full_name'  => trim($_POST['full_name'] ?? ''),
        'email'      => trim($_POST['email'] ?? ''),
        'category'   => trim($_POST['category'] ?? ''),
        'budget'     => (float) ($_POST['budget'] ?? 0),
        'option_one' => trim($_POST['option_one'] ?? ''),
        'option_two' => trim($_POST['option_two'] ?? ''),
        'notes'      => trim($_POST['notes'] ?? ''),
    ];

    if ($payload['full_name'] && filter_var($payload['email'], FILTER_VALIDATE_EMAIL)) {
        create_quote_request($payload);
        set_flash('success', 'Quote request submitted successfully.');
        header('Location: quote.php');
        exit;
    }

    set_flash('warning', 'Please complete the required fields.');
}

$pageKey = 'quote';
$pageTitle = page_title('Bundle Builder');
$pageDescription = 'Dynamic quote form for setup bundles.';
include __DIR__ . '/includes/header.php';
?>
<section class="two-col">
    <article class="content-panel">
        <p class="eyebrow">Dynamic Form #1</p>
        <h1>Setup bundle builder</h1>
        <p>Use this form to estimate a setup bundle based on product category, budget, and preferences. JavaScript updates the quote preview before you submit the server-side request.</p>
        <form class="stack-form" method="post" action="quote.php" id="quoteForm">
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
                Focus category
                <select name="category" id="quoteCategory">
                    <?php foreach (categories() as $category): ?>
                        <option value="<?= e($category) ?>"><?= e($category) ?></option>
                    <?php endforeach; ?>
                </select>
            </label>
            <label>
                Estimated budget
                <input type="range" name="budget" id="budgetRange" min="50" max="500" value="200">
                <span id="budgetOutput">$200</span>
            </label>
            <label>
                Preference one
                <input type="text" name="option_one" placeholder="Example: compact setup">
            </label>
            <label>
                Preference two
                <input type="text" name="option_two" placeholder="Example: white theme">
            </label>
            <label>
                Notes
                <textarea name="notes" rows="5" placeholder="Tell us about your streaming, gaming, or study setup goals."></textarea>
            </label>
            <button class="button" type="submit" name="request_quote" value="1">Submit quote request</button>
        </form>
    </article>

    <article class="content-panel">
        <h2>Live quote preview</h2>
        <div id="quotePreview" class="quote-preview">
            <p><strong>Category:</strong> <span data-preview="category">Keyboards</span></p>
            <p><strong>Budget:</strong> <span data-preview="budget">$200</span></p>
            <p><strong>Suggested tier:</strong> <span data-preview="tier">Balanced mid-range bundle</span></p>
            <p><strong>Estimated number of items:</strong> <span data-preview="items">3</span></p>
        </div>
    </article>
</section>
<?php include __DIR__ . '/includes/footer.php'; ?>
