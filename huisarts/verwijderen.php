<?php
require_once 'config.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = $_GET['id'];

try {
    $stmt = $db->prepare("DELETE FROM huisarts WHERE id = ?");
    $stmt->execute([$id]);
    header('Location: index.php');
} catch(PDOException $e) {
    die('Fout bij verwijderen: ' . $e->getMessage());
}
?>
