<?php
/**
 * Application utility functions.
 */

function e(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function current_url(): string
{
    $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $host   = $_SERVER['HTTP_HOST'] ?? 'localhost';
    $uri    = $_SERVER['REQUEST_URI'] ?? '/';
    return $scheme . '://' . $host . $uri;
}

function base_url(string $path = ''): string
{
    global $config;

    if (!empty($config['base_url'])) {
        $root = rtrim($config['base_url'], '/');
    } else {
        $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
        $host   = $_SERVER['HTTP_HOST'] ?? 'localhost';
        $script = $_SERVER['SCRIPT_NAME'] ?? '';
        $dir    = rtrim(str_replace('\\', '/', dirname($script)), '/');
        $root   = $scheme . '://' . $host . ($dir === '.' ? '' : $dir);

        // If current script is inside /admin, back out so the root remains the project folder.
        if (substr($dir, -6) === '/admin') {
            $root = $scheme . '://' . $host . substr($dir, 0, -6);
        }
    }

    return $root . '/' . ltrim($path, '/');
}

function active_theme(): string
{
    global $config;
    $fallback = $config['default_theme'] ?? 'classic';

    $db = db();
    if (!$db) {
        return $fallback;
    }

    $sql = "SELECT setting_value FROM site_settings WHERE setting_key = 'active_theme' LIMIT 1";
    if ($result = $db->query($sql)) {
        $row = $result->fetch_assoc();
        if (!empty($row['setting_value'])) {
            return $row['setting_value'];
        }
    }

    return $fallback;
}

function set_flash(string $type, string $message): void
{
    $_SESSION['flash'][] = ['type' => $type, 'message' => $message];
}

function get_flashes(): array
{
    $items = $_SESSION['flash'] ?? [];
    unset($_SESSION['flash']);
    return $items;
}

function cart_items(): array
{
    return $_SESSION['cart'] ?? [];
}

function cart_count(): int
{
    return array_sum(array_column(cart_items(), 'quantity'));
}

function cart_total(): float
{
    $total = 0.0;
    foreach (cart_items() as $item) {
        $total += ((float) $item['price'] * (int) $item['quantity']);
    }
    return $total;
}

function add_to_cart(array $product, int $quantity, string $optionOne, string $optionTwo): void
{
    $quantity = max(1, $quantity);
    $key = $product['id'] . '|' . $optionOne . '|' . $optionTwo;

    if (!isset($_SESSION['cart'][$key])) {
        $_SESSION['cart'][$key] = [
            'product_id'  => (int) $product['id'],
            'name'        => $product['name'],
            'price'       => (float) $product['price'],
            'quantity'    => $quantity,
            'image'       => $product['image'],
            'option_one'  => $optionOne,
            'option_two'  => $optionTwo,
            'slug'        => $product['slug'],
        ];
    } else {
        $_SESSION['cart'][$key]['quantity'] += $quantity;
    }
}

function remove_from_cart(string $key): void
{
    unset($_SESSION['cart'][$key]);
}

function update_cart_quantity(string $key, int $quantity): void
{
    if (!isset($_SESSION['cart'][$key])) {
        return;
    }

    if ($quantity <= 0) {
        remove_from_cart($key);
        return;
    }

    $_SESSION['cart'][$key]['quantity'] = $quantity;
}

function find_product_by_slug(string $slug): ?array
{
    $db = db();
    if (!$db) {
        return null;
    }

    $stmt = $db->prepare("SELECT * FROM products WHERE slug = ? LIMIT 1");
    $stmt->bind_param('s', $slug);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_assoc() ?: null;
}

function find_product_by_id(int $id): ?array
{
    $db = db();
    if (!$db) {
        return null;
    }

    $stmt = $db->prepare("SELECT * FROM products WHERE id = ? LIMIT 1");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_assoc() ?: null;
}

function all_products(?string $search = null, ?string $category = null): array
{
    $db = db();
    if (!$db) {
        return [];
    }

    $sql = "SELECT * FROM products WHERE 1=1";
    $params = [];
    $types  = '';

    if ($search) {
        $sql .= " AND (name LIKE ? OR category LIKE ? OR description LIKE ?)";
        $like = '%' . $search . '%';
        $params[] = $like;
        $params[] = $like;
        $params[] = $like;
        $types .= 'sss';
    }

    if ($category) {
        $sql .= " AND category = ?";
        $params[] = $category;
        $types .= 's';
    }

    $sql .= " ORDER BY is_featured DESC, name ASC";
    $stmt = $db->prepare($sql);

    if ($params) {
        $stmt->bind_param($types, ...$params);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_all(MYSQLI_ASSOC);
}

function categories(): array
{
    $db = db();
    if (!$db) {
        return [];
    }

    $result = $db->query("SELECT DISTINCT category FROM products ORDER BY category ASC");
    return $result ? array_column($result->fetch_all(MYSQLI_ASSOC), 'category') : [];
}

function featured_products(int $limit = 4): array
{
    $db = db();
    if (!$db) {
        return [];
    }

    $stmt = $db->prepare("SELECT * FROM products ORDER BY is_featured DESC, id ASC LIMIT ?");
    $stmt->bind_param('i', $limit);
    $stmt->execute();

    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

function average_rating(int $productId): float
{
    $db = db();
    if (!$db) {
        return 0.0;
    }

    $stmt = $db->prepare("SELECT AVG(rating) AS avg_rating FROM reviews WHERE product_id = ?");
    $stmt->bind_param('i', $productId);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();

    return isset($row['avg_rating']) ? round((float) $row['avg_rating'], 1) : 0.0;
}

function review_count(int $productId): int
{
    $db = db();
    if (!$db) {
        return 0;
    }

    $stmt = $db->prepare("SELECT COUNT(*) AS review_total FROM reviews WHERE product_id = ?");
    $stmt->bind_param('i', $productId);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();

    return (int) ($row['review_total'] ?? 0);
}

function product_reviews(int $productId): array
{
    $db = db();
    if (!$db) {
        return [];
    }

    $stmt = $db->prepare("
        SELECT reviews.*, users.full_name
        FROM reviews
        JOIN users ON users.id = reviews.user_id
        WHERE reviews.product_id = ?
        ORDER BY reviews.created_at DESC
    ");
    $stmt->bind_param('i', $productId);
    $stmt->execute();

    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

function create_review(int $productId, int $userId, int $rating, string $comment): bool
{
    $db = db();
    if (!$db) {
        return false;
    }

    $stmt = $db->prepare("INSERT INTO reviews (product_id, user_id, rating, comment, created_at) VALUES (?, ?, ?, ?, NOW())");
    $stmt->bind_param('iiis', $productId, $userId, $rating, $comment);

    return $stmt->execute();
}

function create_service_request(array $payload): bool
{
    $db = db();
    if (!$db) {
        return false;
    }

    $stmt = $db->prepare("
        INSERT INTO service_requests (user_id, full_name, email, subject, message, attachment_name, admin_response, status, created_at)
        VALUES (?, ?, ?, ?, ?, ?, '', 'New', NOW())
    ");
    $stmt->bind_param(
        'isssss',
        $payload['user_id'],
        $payload['full_name'],
        $payload['email'],
        $payload['subject'],
        $payload['message'],
        $payload['attachment_name']
    );

    return $stmt->execute();
}

function create_quote_request(array $payload): bool
{
    $db = db();
    if (!$db) {
        return false;
    }

    $stmt = $db->prepare("
        INSERT INTO quote_requests (full_name, email, category, budget, option_one, option_two, notes, created_at)
        VALUES (?, ?, ?, ?, ?, ?, ?, NOW())
    ");
    $stmt->bind_param(
        'sssdsss',
        $payload['full_name'],
        $payload['email'],
        $payload['category'],
        $payload['budget'],
        $payload['option_one'],
        $payload['option_two'],
        $payload['notes']
    );

    return $stmt->execute();
}

function context_help_link(string $page): string
{
    $map = [
        'index'          => 'help/index.html',
        'about'          => 'help/site-tour.html',
        'catalog'        => 'help/shopping-guide.html',
        'compare'        => 'help/shopping-guide.html',
        'search'         => 'help/shopping-guide.html',
        'product'        => 'help/shopping-guide.html',
        'cart'           => 'help/shopping-guide.html',
        'checkout'       => 'help/account-and-orders.html',
        'register'       => 'help/account-and-orders.html',
        'login'          => 'help/account-and-orders.html',
        'profile'        => 'help/account-and-orders.html',
        'orders'         => 'help/account-and-orders.html',
        'quote'          => 'help/site-tour.html',
        'support'        => 'help/troubleshooting.html',
        'contact'        => 'help/site-tour.html',
        'privacy'        => 'help/site-tour.html',
        'terms'          => 'help/site-tour.html',
        'returns'        => 'help/site-tour.html',
        'monitor'        => 'help/troubleshooting.html',
        'admin'          => 'help/admin-guide.html',
        'theme-preview'  => 'help/site-tour.html',
        '404'            => 'help/troubleshooting.html',
    ];

    return base_url($map[$page] ?? 'help/index.html');
}

function page_title(string $title = ''): string
{
    global $config;
    return trim($title) ? $title . ' | ' . $config['site_name'] : $config['site_name'];
}

function currency(float $amount): string
{
    global $config;
    return ($config['currency_symbol'] ?? '$') . number_format($amount, 2);
}

function csrf_token(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(24));
    }

    return $_SESSION['csrf_token'];
}

function verify_csrf(): bool
{
    $token = $_POST['csrf_token'] ?? '';
    return hash_equals($_SESSION['csrf_token'] ?? '', $token);
}

function monitor_checks(): array
{
    $db = db();

    $checks = [
        [
            'label' => 'PHP Runtime',
            'status' => 'Online',
            'detail' => 'PHP ' . PHP_VERSION,
        ],
        [
            'label' => 'Database Connection',
            'status' => $db ? 'Online' : 'Offline',
            'detail' => $db ? 'MySQL connection succeeded.' : 'Update config.php and import sql/schema.sql.',
        ],
        [
            'label' => 'Session Engine',
            'status' => session_status() === PHP_SESSION_ACTIVE ? 'Online' : 'Offline',
            'detail' => session_status() === PHP_SESSION_ACTIVE ? 'Sessions are active.' : 'session_start() was not successful.',
        ],
        [
            'label' => 'Uploads Folder',
            'status' => is_dir(__DIR__ . '/../uploads') && is_writable(__DIR__ . '/../uploads') ? 'Online' : 'Offline',
            'detail' => 'Writable upload directory for support attachments.',
        ],
        [
            'label' => 'Product Media',
            'status' => count(glob(__DIR__ . '/../assets/img/products/*.svg')) >= 20 ? 'Online' : 'Offline',
            'detail' => 'Checks for the minimum 20 product images requirement.',
        ],
        [
            'label' => 'Theme Engine',
            'status' => in_array(active_theme(), ['classic', 'neon', 'autumn'], true) ? 'Online' : 'Offline',
            'detail' => 'Active site-wide template: ' . active_theme(),
        ],
    ];

    return $checks;
}

function statistics_snapshot(): array
{
    $db = db();
    if (!$db) {
        return [
            'products' => 0,
            'users' => 0,
            'orders' => 0,
            'requests' => 0,
        ];
    }

    $tables = [
        'products' => 'products',
        'users' => 'users',
        'orders' => 'orders',
        'requests' => 'service_requests',
    ];

    $snapshot = [];
    foreach ($tables as $key => $table) {
        $result = $db->query("SELECT COUNT(*) AS total FROM {$table}");
        $row = $result ? $result->fetch_assoc() : ['total' => 0];
        $snapshot[$key] = (int) ($row['total'] ?? 0);
    }

    return $snapshot;
}

function canonical_url(): string
{
    $uri = strtok(current_url(), '?');
    return $uri ?: base_url();
}
