<?php
require_once 'config.php';

$stmt = $db->query("SELECT * FROM tandarts ORDER BY achternaam, voornaam");
$tandartsen = $stmt->fetchAll(PDO::FETCH_ASSOC);

function date_dutch($stringDate){ return date_format(date_create($stringDate), 'd/m/Y' ); }
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Tandarts Administratie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h1>Tandarts Administratie</h1>
    <a href="toevoegen.php" class="btn btn-success mb-3">Nieuwe Client Toevoegen</a>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>Naam</th>
            <th>Geboortedatum</th>
            <th>Adres</th>
            <th>Woonplaats</th>
            <th>Laatste behandeling</th>
            <th>Acties</th>
        </tr>
        </thead>
        <tbody>
        <?php 
        usort($tandartsen, function($a,$b){ return $a['achternaam']>$b['achternaam']; });
        foreach ($tandartsen as $tandarts): ?>
            <tr>
                <td><?= htmlspecialchars($tandarts['voornaam'] . ' ' . $tandarts['achternaam']) ?></td>
                <td><?= date_format(date_create(htmlspecialchars($tandarts['geboortedatum'])), 'd/m/Y' ) ?></td>
                <td><?= htmlspecialchars($tandarts['adres'] . ', ' . $tandarts['postcode']) ?></td>
                <td><?= htmlspecialchars($tandarts['woonplaats']) ?></td>
                <td><?= date_format(date_create(htmlspecialchars($tandarts['laatste_behandeling'])), 'd/m/Y' ) ?></td>
                <td>
                    <a href="bekijken.php?id=<?= $tandarts['id'] ?>" class="btn btn-sm btn-info">Bekijken</a>
                    <a href="bewerken.php?id=<?= $tandarts['id'] ?>" class="btn btn-primary btn-sm">Bewerken</a>
                    <a href="verwijderen.php?id=<?= $tandarts['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Weet je zeker dat je deze client wilt verwijderen?')">Verwijderen</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
