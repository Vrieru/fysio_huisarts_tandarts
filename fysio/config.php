<?php
$db_host = 'localhost';
$db_name = 'gezondheidspas';
$db_user = 'root';
$db_pass = '';

try {
    $db = new PDO("mysql:host={$db_host};dbname={$db_name};charset=utf8mb4", $db_user, $db_pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die('Verbinding mislukt: ' . $e->getMessage());
}
