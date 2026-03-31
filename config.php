<?php
/**
 * CreatorKart Gear
 * Core configuration file.
 *
 * Update the database credentials before importing or running on myweb.cs.uwindsor.ca.
 * The app auto-detects the base URL, but you can hard-code it if needed.
 */

return [
    'site_name' => 'CreatorKart Gear',
    'base_url'  => '',
    'db' => [
        'host' => 'localhost',
        'name' => 'YOUR_MYSQL_DATABASE',
        'user' => 'YOUR_MYSQL_USERNAME',
        'pass' => 'YOUR_MYSQL_PASSWORD',
        'port' => 3306,
    ],
    'uploads_dir' => __DIR__ . '/uploads',
    'default_theme' => 'classic',
    'currency_symbol' => '$',
    'demo_admin_email' => 'admin@creatorkart.local',
];
