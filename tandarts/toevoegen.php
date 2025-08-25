<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $stmt = $db->prepare("INSERT INTO tandarts (voornaam, achternaam, geboortedatum, adres, postcode, woonplaats, verzekeringsnummer, laatste_behandeling) 
                             VALUES (:voornaam, :achternaam, :geboortedatum, :adres, :postcode, :woonplaats, :verzekeringsnummer, :laatste_behandeling)");

        $stmt->execute([
            ':voornaam' => htmlspecialchars($_POST['voornaam']),
            ':achternaam' => htmlspecialchars($_POST['achternaam']),
            ':geboortedatum' => htmlspecialchars($_POST['geboortedatum']),
            ':adres' => htmlspecialchars($_POST['adres']),
            ':postcode' => htmlspecialchars($_POST['postcode']),
            ':woonplaats' => htmlspecialchars($_POST['woonplaats']),
            ':verzekeringsnummer' => htmlspecialchars($_POST['verzekeringsnummer']),
            ':laatste_behandeling' => htmlspecialchars($_POST['laatste_behandeling'])
        ]);

        header('Location: index.php');
        exit;
    } catch(PDOException $e) {
        $error = "Er is een fout opgetreden: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Nieuwe Patient Toevoegen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h1>Nieuwe Client Toevoegen</h1>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form method="post">
        <div class="mb-3">
            <label for="voornaam" class="form-label">Voornaam</label>
            <input type="text" class="form-control" id="voornaam" name="voornaam" required>
        </div>
        <div class="mb-3">
            <label for="achternaam" class="form-label">Achternaam</label>
            <input type="text" class="form-control" id="achternaam" name="achternaam" required>
        </div>
        <div class="mb-3">
            <label for="geboortedatum" class="form-label">Geboortedatum</label>
            <input type="date" class="form-control" id="geboortedatum" name="geboortedatum" required>
        </div>
        <div class="mb-3">
            <label for="adres" class="form-label">Adres</label>
            <input type="text" class="form-control" id="adres" name="adres" required>
        </div>
        <div class="mb-3">
            <label for="postcode" class="form-label">Postcode</label>
            <input type="text" class="form-control" id="postcode" name="postcode" required>
        </div>
        <div class="mb-3">
            <label for="woonplaats" class="form-label">Woonplaats</label>
            <input type="text" class="form-control" id="woonplaats" name="woonplaats" required>
        </div>
        <div class="mb-3">
            <label for="verzekeringsnummer" class="form-label">Verzekeringsnummer</label>
            <input type="text" class="form-control" id="verzekeringsnummer" name="verzekeringsnummer" required>
        </div>
        <div class="mb-3">
            <label for="laatste_behandeling" class="form-label">Laatste behandeling</label>
            <input type="date" class="form-control" id="laatste_behandeling" name="laatste_behandeling" min="1970-1-1" required>
        </div>

        <button type="submit" class="btn btn-primary">Toevoegen</button>
        <a href="index.php" class="btn btn-secondary">Annuleren</a>
    </form>
</div>
</body>
</html>
