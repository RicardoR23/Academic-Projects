# CreatorKart Gear

CreatorKart Gear is a fully documented PHP + MySQL course project that demonstrates a responsive e-commerce website with:

- public and private areas
- customer registration and authentication
- product catalog with 20 records
- cart, checkout, and order history
- ratings and reviews
- dynamic quote and support forms
- admin dashboard
- 3 site-wide templates
- monitoring page
- help wiki
- installation documentation
- local image, video, and audio assets

## Demo credentials

- **Admin**
  - Email: `admin@creatorkart.local`
  - Password: `Admin123!`

- **Customer**
  - Email: `customer@creatorkart.local`
  - Password: `Admin123!`

## Folder map

- `index.php` - storefront landing page
- `catalog.php` - searchable product catalog
- `product.php` - generic product page
- `product-01.php` to `product-20.php` - unique product entry pages
- `quote.php` - dynamic setup bundle form
- `support.php` - dynamic support form with upload
- `profile.php`, `orders.php`, `cart.php`, `checkout.php` - private customer features
- `admin/` - admin dashboard, products, users, orders, requests, settings
- `help/` - 5 static wiki/help pages
- `sql/schema.sql` - full MySQL schema and seed data
- `docs/INSTALL.md` - deployment steps
- `docs/DATABASE-DESIGN.md` - database explanation
- `docs/GRADING-CHECKLIST.md` - rubric mapping
- `.gitignore` and `docs/GITHUB-SETUP.md` - repository guidance

## Notes

- Update `config.php` with your MySQL credentials before deployment.
- Upload the full folder structure to `myweb.cs.uwindsor.ca` with FileZilla.
- Import `sql/schema.sql` into your MySQL database.
- The monitor page is useful for proving service status during gradng.
