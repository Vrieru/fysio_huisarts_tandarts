<?php
require_once 'config.php';
require_once 'header.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $stmt = $db->prepare("UPDATE huisarts SET 
            voornaam = :voornaam,
            achternaam = :achternaam,
            geboortedatum = :geboortedatum,
            adres = :adres,
            postcode = :postcode,
            woonplaats = :woonplaats,
            verzekeringsnummer = :verzekeringsnummer,
            telefoonnummer = :telefoonnummer,
            notities = :notities
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
            ':telefoonnummer' => htmlspecialchars($_POST['telefoonnummer']),
            ':notities' => htmlspecialchars($_POST['notities'])
        ]);

        header('Location: index.php');
        exit;
    } catch(PDOException $e) {
        $error = "Er is een fout opgetreden: " . $e->getMessage();
    }
}

$stmt = $db->prepare("SELECT * FROM huisarts WHERE id = ?");
$stmt->execute([$id]);
$huisarts = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$huisarts) {
    header('Location: index.php');
    exit;
}
?>

    <div class="container">
        <h1>Patiënt Bewerken</h1>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <form method="post" class="needs-validation" novalidate>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="voornaam" class="form-label">Voornaam</label>
                    <input type="text" class="form-control" id="voornaam" name="voornaam"
                           value="<?= htmlspecialchars($huisarts['voornaam']) ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="achternaam" class="form-label">Achternaam</label>
                    <input type="text" class="form-control" id="achternaam" name="achternaam"
                           value="<?= htmlspecialchars($huisarts['achternaam']) ?>" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="geboortedatum" class="form-label">Geboortedatum</label>
                    <input type="date" class="form-control" id="geboortedatum" name="geboortedatum"
                           value="<?= htmlspecialchars($huisarts['geboortedatum']) ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="telefoonnummer" class="form-label">Telefoonnummer</label>
                    <input type="tel" class="form-control" id="telefoonnummer" name="telefoonnummer"
                           value="<?= htmlspecialchars($huisarts['telefoonnummer']) ?>" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="adres" class="form-label">Adres</label>
                <input type="text" class="form-control" id="adres" name="adres"
                       value="<?= htmlspecialchars($huisarts['adres']) ?>" required>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="postcode" class="form-label">Postcode</label>
                    <input type="text" class="form-control" id="postcode" name="postcode"
                           value="<?= htmlspecialchars($huisarts['postcode']) ?>" required>
                </div>
                <div class="col-md-8 mb-3">
                    <label for="woonplaats" class="form-label">Woonplaats</label>
                    <input type="text" class="form-control" id="woonplaats" name="woonplaats"
                           value="<?= htmlspecialchars($huisarts['woonplaats']) ?>" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="verzekeringsnummer" class="form-label">Verzekeringsnummer</label>
                <input type="text" class="form-control" id="verzekeringsnummer" name="verzekeringsnummer"
                       value="<?= htmlspecialchars($huisarts['verzekeringsnummer']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="notities" class="form-label">Notities</label>
                <textarea class="form-control" id="notities" name="notities" rows="4"><?= htmlspecialchars($huisarts['notities']) ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Opslaan</button>
            <a href="index.php" class="btn btn-secondary">Annuleren</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html><?php
