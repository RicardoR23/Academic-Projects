# Grading Checklist Mapping

This checklist maps each rubric requirement to concrete project evidence.

## 1) Business case paragraph (0.5)
- Status: Complete
- Evidence:
	- `about.php` includes a full business-case paragraph and project scope.

## 2) At least 20 products, each with at least 2 options (1.0)
- Status: Complete
- Evidence:
	- `sql/schema.sql` seeds 20 products.
	- Each product has `option1_name`, `option1_values`, `option2_name`, and `option2_values`.
	- `product.php` renders both option selectors dynamically.

## 3) Three dynamic site templates and ability to switch (3.0 + 1.0)
- Status: Complete
- Evidence:
	- `assets/css/style.css` defines theme variables for `classic`, `neon`, and `autumn`.
	- `admin/settings.php` allows admin switching and persists the selected template.
	- `theme-preview.php` demonstrates all templates.

## 4) Dynamic HTML forms on at least two pages (2.0)
- Status: Complete
- Evidence:
	- `quote.php` dynamic bundle-builder form (server processing + JS live preview).
	- `support.php` dynamic support request form (server processing + optional upload).

## 5) PHP and MySQL documentation (5.0)
- Status: Complete
- Evidence:
	- PHP files contain explanatory comments and structured helper functions.
	- `docs/DATABASE-DESIGN.md` documents schema design.
	- `docs/INSTALL.md` documents deployment and setup.

## 6) Commented code across HTML/CSS/JS (2.0)
- Status: Complete
- Evidence:
	- `assets/css/style.css` includes section-level comments and clear naming.
	- `assets/js/app.js` includes functional comments for menu, quote preview, chart.
	- PHP templates and include files include concise implementation comments.

## 7) Help wiki pages and context-sensitive help links (2.5)
- Status: Complete
- Evidence:
	- Wiki pages: `help/index.html`, `help/site-tour.html`, `help/shopping-guide.html`, `help/account-and-orders.html`, `help/admin-guide.html`, `help/troubleshooting.html`.
	- Context Help button is in `includes/header.php`.
	- Page-to-help routing map is in `includes/functions.php` (`context_help_link`).

## 8) (Not listed in rubric numbering)
- Status: N/A (original rubric skips item 8).

## 9) Responsive site and menu (1.0)
- Status: Complete
- Evidence:
	- Main menu in `includes/header.php`.
	- Responsive behavior in `assets/css/style.css` + toggle logic in `assets/js/app.js`.

## 10) Content volume and assets (5.0 total across sub-parts)
- Status: Complete
- Evidence:
	- Dynamic pages: 20+ PHP pages including `product-01.php` to `product-20.php`, plus catalog/cart/checkout/admin pages.
	- External CSS: `assets/css/style.css`.
	- External JS: `assets/js/app.js`.
	- Images: 20 product images in `assets/img/products/`.
	- Video/audio: multiple files in `assets/media/` (at least 3 media files).
	- Non-programmer update instructions in `help/shopping-guide.html`.

## 11) Live website availability (0.5)
- Status: Pending deploy step
- Evidence:
	- Project is deployment-ready; upload to `myweb.cs.uwindsor.ca` and provide URL in submission.

## 12) Advanced CSS complexity (1.0)
- Status: Complete
- Evidence:
	- `assets/css/style.css` includes theming variables, layout systems, transitions, cards, menu states, and responsive breakpoints.

## 13) SEO meta tags and optimization (1.0)
- Status: Complete
- Evidence:
	- `includes/header.php` has title, description, keywords, robots, canonical, OG, and favicon tags.
	- `sitemap.php` generates XML sitemap URLs.
	- `robots.txt` references sitemap.

## Additional course criteria from project brief
- Public/private areas with registration/authentication/profile: complete (`login.php`, `register.php`, `profile.php`, `orders.php`).
- Admin editing, order/request handling, and user administration: complete (`admin/` pages).
- Monitoring page with online/offline checks: complete (`monitor.php`).
- Interactive multimedia requirements: complete (images, local video/audio, interactive chart, embedded map).
- End-user and admin documentation: complete (`help/` wiki + docs).
