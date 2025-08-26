<?php
require_once 'config.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = $_GET['id'];

try {
    $stmt = $db->prepare("SELECT * FROM tandarts WHERE id = ?");
    $stmt->execute([$id]);
    $tandarts = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$tandarts) {
        //echo"Patient $id niet gevonden";
        header('Location: index.php');
        exit;
    }
} catch(PDOException $e) {
    die('Fout bij ophalen gegevens: ' . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Tandarts Administratie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Tandarts Details</h1>
        <div>
            <a href="bewerken.php?id=<?= $tandarts['id'] ?>" class="btn btn-warning">Bewerken</a>
            <a href="index.php" class="btn btn-secondary">Terug naar overzicht</a>
        </div>
    </div>

    <div class="card">
    <div class="card-body">
    <div class="row">
        <div class="col-md-6">
            <h5 class="card-title">Persoonlijke Informatie</h5>
            <table class="table table-borderless">
                <tr>
                    <th style="width: 150px;">Voornaam:</th>
                    <td><?= htmlspecialchars($tandarts['voornaam']) ?></td>
                </tr>
                <tr>
                    <th>Achternaam:</th>
                    <td><?= htmlspecialchars($tandarts['achternaam']) ?></td>
                </tr>
                <tr>
                    <th>Geboortedatum:</th>
                    <td><?= date_format(date_create(htmlspecialchars($tandarts['geboortedatum'])), 'd/m/Y') ?></td>
                </tr>
                <tr>
                    <th>Verzekeringsnummer:</th>
                    <td><?= htmlspecialchars($tandarts['verzekeringsnummer']) ?></td>
                </tr>
            </table>
        </div>
        <div class="col-md-6">
            <h5 class="card-title">Contactgegevens</h5>
            <table class="table table-borderless">
                <tr>
                    <th style="width: 150px;">Adres:</th>
                    <td><?= htmlspecialchars($tandarts['adres']) ?></td>
                </tr>
                <tr>
                    <th>Postcode:</th>
                    <td><?= htmlspecialchars($tandarts['postcode']) ?></td>
                </tr>
                <tr>
                    <th>Woonplaats:</th>
                    <td><?= htmlspecialchars($tandarts['woonplaats']) ?></td>
                </tr>
            </table>
        </div>
    </div>

    <div class="mt-4">
        <h5 class="card-title">Laatste Behandeling</h5>
        <div class="card">
            <div class="card-body bg-light">
                <?php if (!empty($tandarts['laatste_behandeling'])): ?>
                    <?= nl2br(htmlspecialchars($tandarts['laatste_behandeling'])) ?>
                <?php else: ?>
                    <em>Geen klachten geregistreerd</em>
                <?php endif; ?>
            </div>
        </div>
    </div>
    </div>
</body>
</html>