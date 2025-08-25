<?php
require_once 'config.php';
require_once 'header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $stmt = $db->prepare("INSERT INTO huisarts (voornaam, achternaam, geboortedatum, adres, postcode, 
            woonplaats, verzekeringsnummer, telefoonnummer, notities) 
            VALUES (:voornaam, :achternaam, :geboortedatum, :adres, :postcode, 
            :woonplaats, :verzekeringsnummer, :telefoonnummer, :notities)");

        $stmt->execute([
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
?>

    <div class="container">
        <h1>Nieuwe Patiënt Toevoegen</h1>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <form method="post" class="needs-validation" novalidate>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="voornaam" class="form-label">Voornaam</label>
                    <input type="text" class="form-control" id="voornaam" name="voornaam" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="achternaam" class="form-label">Achternaam</label>
                    <input type="text" class="form-control" id="achternaam" name="achternaam" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="geboortedatum" class="form-label">Geboortedatum</label>
                    <input type="date" class="form-control" id="geboortedatum" name="geboortedatum" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="telefoonnummer" class="form-label">Telefoonnummer</label>
                    <input type="tel" class="form-control" id="telefoonnummer" name="telefoonnummer" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="adres" class="form-label">Adres</label>
                <input type="text" class="form-control" id="adres" name="adres" required>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="postcode" class="form-label">Postcode</label>
                    <input type="text" class="form-control" id="postcode" name="postcode" required>
                </div>
                <div class="col-md-8 mb-3">
                    <label for="woonplaats" class="form-label">Woonplaats</label>
                    <input type="text" class="form-control" id="woonplaats" name="woonplaats" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="verzekeringsnummer" class="form-label">Verzekeringsnummer</label>
                <input type="text" class="form-control" id="verzekeringsnummer" name="verzekeringsnummer" required>
            </div>

            <div class="mb-3">
                <label for="notities" class="form-label">Notities</label>
                <textarea class="form-control" id="notities" name="notities" rows="4"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Opslaan</button>
            <a href="index.php" class="btn btn-secondary">Annuleren</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html><?php
