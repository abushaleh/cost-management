<?php

$dsn = 'mysql:host=localhost;dbname=cost_management';
$username = 'root';
$password = '';
$options = [];
try {
    $connection = new PDO('mysql:host=localhost;dbname=cost_management', 'root', '');
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "database connection fail" . $e->getMessage();
}
