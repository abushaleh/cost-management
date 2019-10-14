<?php

$dsn = 'mysql:host=localhost;dbname=cost_management';
$username = 'root';
$password = '';
$options = [];
try {
    $connection = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    echo "Connection is not successful" . $e;
}
