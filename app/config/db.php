<?php

$ini = parse_ini_file(__DIR__ . '/dbconfig.ini');

try {
    $db = new PDO("mysql:host=" . $ini['servername'] .
                ";port=" . $ini['port'] .
                ";dbname=" . $ini['dbname'],
                $ini['username'], 
                $ini['password']);

    // Disable emulated prepared statements
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    // Set error mode to exception handling
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Set character encoding to UTF-8
    $db->exec("SET NAMES utf8mb4");
} catch (PDOException $e) {
    error_log("Connection failed: " . $e->getMessage());
    exit("Database connection failed.");
}
