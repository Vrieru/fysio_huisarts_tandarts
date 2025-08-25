<?php
require_once 'config.php';

if (isset($_GET['id'])) {
    try {
        $stmt = $db->prepare("DELETE FROM tandarts WHERE id = ?");
        $stmt->execute([$_GET['id']]);
    } catch(PDOException $e) {
        // Log de error
    }
}

header('Location: index.php');
exit;
