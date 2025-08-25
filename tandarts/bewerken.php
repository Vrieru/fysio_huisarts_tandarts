<?php
require_once 'config.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $stmt = $db->prepare("UPDATE tandarts SET 
            voornaam = :voornaam,
            achternaam = :achternaam,
            geboortedatum = :geboortedatum,
            adres = :adres,
            postcode = :postcode,
            woonplaats = :woonplaats,
            verzekeringsnummer = :verzekeringsnummer,
            laatste_behandeling = :laatste_behandeling
            WHERE id = :id"); //INJECT ATTACK, can inject by editing the link

        $stmt->execute([
            ':id' => $id,
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

// Haal bestaande gegevens op
$stmt = $db->prepare("SELECT * FROM tandarts WHERE id = ?");
$stmt->execute([$id]);
$tandarts = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$tandarts) {
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Tandarts Bewerken</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h1>Tandarts Bewerken</h1>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form method="post">
        <div class="mb-3">
            <label for="voornaam" class="form-label">Voornaam</label>
            <input type="text" class="form-control" id="voornaam" name="voornaam" value="<?= htmlspecialchars($tandarts['voornaam']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="achternaam" class="form-label">Achternaam</label>
            <input type="text" class="form-control" id="achternaam" name="achternaam" value="<?= htmlspecialchars($tandarts['achternaam']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="geboortedatum" class="form-label">Geboortedatum</label>
            <input type="date" class="form-control" id="geboortedatum" name="geboortedatum" value="<?= htmlspecialchars($tandarts['geboortedatum']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="adres" class="form-label">Adres</label>
            <input type="text" class="form-control" id="adres" name="adres" value="<?= htmlspecialchars($tandarts['adres']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="postcode" class="form-label">Postcode</label>
            <input type="text" class="form-control" id="postcode" name="postcode" value="<?= htmlspecialchars($tandarts['postcode']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="woonplaats" class="form-label">Woonplaats</label>
            <input type="text" class="form-control" id="woonplaats" name="woonplaats" value="<?= htmlspecialchars($tandarts['woonplaats']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="verzekeringsnummer" class="form-label">Verzekeringsnummer</label>
            <input type="text" class="form-control" id="verzekeringsnummer" name="verzekeringsnummer" value="<?= htmlspecialchars($tandarts['verzekeringsnummer']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="laatste_behandeling" class="form-label">Laatste behandeling</label>
            <input type="date" class="form-control" id="laatste_behandeling" name="laatste_behandeling" value="<?= htmlspecialchars($tandarts['laatste_behandeling']) ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Opslaan</button>
        <a href="index.php" class="btn btn-secondary">Annuleren</a>
    </form>
</div>
</body>
</html>
