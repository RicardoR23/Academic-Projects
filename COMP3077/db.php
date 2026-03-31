<?php
/**
 * Database helper.
 * Uses mysqli + prepared statements for dynamic queries.
 */

function db(): ?mysqli
{
    static $connection = null;
    static $attempted = false;

    if ($attempted) {
        return $connection;
    }

    $attempted = true;

    global $config;
    mysqli_report(MYSQLI_REPORT_OFF);

    try {
        $connection = @new mysqli(
            $config['db']['host'],
            $config['db']['user'],
            $config['db']['pass'],
            $config['db']['name'],
            (int) $config['db']['port']
        );

        if ($connection->connect_errno) {
            $connection = null;
            return null;
        }

        $connection->set_charset('utf8mb4');
    } catch (Throwable $exception) {
        $connection = null;
    }

    return $connection;
}
