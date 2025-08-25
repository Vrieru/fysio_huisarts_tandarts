<?php
require_once 'config.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = $_GET['id'];

try {
    $stmt = $db->prepare("DELETE FROM fysio WHERE id = ?");
    $stmt->execute([$id]);

    header('Location: index.php');
    exit;
} catch(PDOException $e) {
    die('Er is een fout opgetreden bij het verwijderen: ' . $e->getMessage());
}<?php
