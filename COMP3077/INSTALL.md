# Installation Guide

## 1) Upload the files
Upload the full project folder to your hosting space with FileZilla, preserving the folders:
- `admin`
- `assets`
- `help`
- `includes`
- `sql`
- `docs`
- `uploads`

Also upload hidden files, especially `.htaccess`.

## 2) Create the MySQL database
Create a MySQL database and user in your hosting control panel or phpMyAdmin.

## 3) Import the schema
Import `sql/schema.sql`.

## 4) Configure the connection
Open `config.php` and update:

```php
'db' => [
    'host' => 'localhost',
    'name' => 'YOUR_MYSQL_DATABASE',
    'user' => 'YOUR_MYSQL_USERNAME',
    'pass' => 'YOUR_MYSQL_PASSWORD',
    'port' => 3306,
],
```

## 5) Test the site
Open:
- `index.php`
- `monitor.php`
- `login.php`
- `admin/index.php`

If the database is connected correctly, the monitor page should show the database as **Online**.

## 6) Recommended final checks
- Make sure the `uploads` folder is writable.
- Confirm that `assets/css/style.css` and `assets/js/app.js` load correctly.
- Test account creation, login, add-to-cart, checkout, admin product editing, theme switching, and support requests.

## 7) If you get "Not Found" or ErrorDocument 404 loops
- Confirm `.htaccess` exists in the project web root.
- In Apache config, ensure `AllowOverride All` is enabled for your site directory.
- Restart Apache after enabling `mod_rewrite` and changing virtual host settings.
- Test extensionless routes such as `/about` and `/catalog` as well as `/about.php`.
