<?php
/**
 * Shared bootstrap loaded by all public and admin pages.
 */

if (session_status() === PHP_SESSION_NONE) {
    session_name('creatorkart_session');
    session_start();
}

$config = require __DIR__ . '/../config.php';
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/auth.php';
