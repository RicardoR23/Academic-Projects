# Database Design

## Tables

### `users`
Stores customer and admin accounts.
- `role` distinguishes `customer` from `admin`
- `is_active` lets admins disable accounts

### `products`
Stores the 20 catalog records.
- each record has a slug, name, price, category, description
- `option1_*` and `option2_*` satisfy the two-option requirement
- media file paths point to local images, videos, and audio

### `orders`
Stores order headers placed by authenticated users.

### `order_items`
Stores each line item inside an order.

### `reviews`
Stores logged-in product ratings and comments.

### `service_requests`
Stores support requests and admin responses.

### `quote_requests`
Stores submissions from the dynamic bundle builder form.

### `site_settings`
Stores the active site template, allowing the admin dashboard to switch themes site-wide.
