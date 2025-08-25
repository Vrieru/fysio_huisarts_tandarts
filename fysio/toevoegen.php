<?php
require_once 'config.php';
require_once 'header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $stmt = $db->prepare("INSERT INTO fysio (patientnummer, naam, geboortedatum, straat, huisnummer, 
            postcode, plaats, verzekeringsnummer, klachten) 
            VALUES (:patientnummer, :naam, :geboortedatum, :straat, :huisnummer, 
            :postcode, :plaats, :verzekeringsnummer, :klachten)");

        $stmt->execute([
            ':patientnummer' => htmlspecialchars($_POST['patientnummer']),
            ':naam' => htmlspecialchars($_POST['naam']),
            ':geboortedatum' => htmlspecialchars($_POST['geboortedatum']),
            ':straat' => htmlspecialchars($_POST['straat']),
            ':huisnummer' => htmlspecialchars($_POST['huisnummer']),
            ':postcode' => htmlspecialchars($_POST['postcode']),
            ':plaats' => htmlspecialchars($_POST['plaats']),
            ':verzekeringsnummer' => htmlspecialchars($_POST['verzekeringsnummer']),
            ':klachten' => htmlspecialchars($_POST['klachten'])
        ]);

        header('Location: index.php');
        exit;
    } catch(PDOException $e) {
        $error = "Er is een fout opgetreden: " . $e->getMessage();
    }
}

// Haal laatste patientnummer op
$stmt = $db->query("SELECT MAX(patientnummer) as last_nr FROM fysio");
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$next_nr = ($result['last_nr'] ?? 0) + 1;
?>

    <div class="container">
        <h1>Nieuwe Patiënt Toevoegen</h1>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <form method="post" class="needs-validation" novalidate>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="patientnummer" class="form-label">Patientnummer</label>
                    <input type="number" class="form-control" id="patientnummer" name="patientnummer"
                           value="<?= $next_nr ?>" required readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="naam" class="form-label">Naam</label>
                    <input type="text" class="form-control" id="naam" name="naam" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="geboortedatum" class="form-label">Geboortedatum</label>
                <input type="date" class="form-control" id="geboortedatum" name="geboortedatum" required>
            </div>

            <div class="row">
                <div class="col-md-8 mb-3">
                    <label for="straat" class="form-label">Straat</label>
                    <input type="text" class="form-control" id="straat" name="straat" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="huisnummer" class="form-label">Huisnummer</label>
                    <input type="text" class="form-control" id="huisnummer" name="huisnummer" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="postcode" class="form-label">Postcode</label>
                    <input type="text" class="form-control" id="postcode" name="postcode" required>
                </div>
                <div class="col-md-8 mb-3">
                    <label for="plaats" class="form-label">Plaats</label>
                    <input type="text" class="form-control" id="plaats" name="plaats" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="verzekeringsnummer" class="form-label">Verzekeringsnummer</label>
                <input type="text" class="form-control" id="verzekeringsnummer" name="verzekeringsnummer" required>
            </div>

            <div class="mb-3">
                <label for="klachten" class="form-label">Klachten</label>
                <textarea class="form-control" id="klachten" name="klachten" rows="4"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Opslaan</button>
            <a href="index.php" class="btn btn-secondary">Annuleren</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html><?php
