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
        $stmt = $db->prepare("UPDATE fysio SET 
            naam = :naam,
            geboortedatum = :geboortedatum,
            straat = :straat,
            huisnummer = :huisnummer,
            postcode = :postcode,
            plaats = :plaats,
            email = :email,
            verzekeringsnummer = :verzekeringsnummer,
            klachten = :klachten
            WHERE id = :id");

        $stmt->execute([
            ':id' => $id,
            ':naam' => htmlspecialchars($_POST['naam']),
            ':geboortedatum' => htmlspecialchars($_POST['geboortedatum']),
            ':straat' => htmlspecialchars($_POST['straat']),
            ':huisnummer' => htmlspecialchars($_POST['huisnummer']),
            ':postcode' => htmlspecialchars($_POST['postcode']),
            ':plaats' => htmlspecialchars($_POST['plaats']),
            ':email' => htmlspecialchars($_POST['email']),
            ':verzekeringsnummer' => htmlspecialchars($_POST['verzekeringsnummer']),
            ':klachten' => htmlspecialchars($_POST['klachten'])
        ]);

        header('Location: index.php');
        exit;
    } catch(PDOException $e) {
        $error = "Er is een fout opgetreden: " . $e->getMessage();
    }
}

$stmt = $db->prepare("SELECT * FROM fysio WHERE id = ?");
$stmt->execute([$id]);
$patient = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$patient) {
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
                <label for="patientnummer" class="form-label">Patientnummer</label>
                <input type="number" class="form-control" id="patientnummer"
                       value="<?= htmlspecialchars($patient['patientnummer']) ?>" readonly>
            </div>
            <div class="col-md-6 mb-3">
                <label for="naam" class="form-label">Naam</label>
                <input type="text" class="form-control" id="naam" name="naam"
                       value="<?= htmlspecialchars($patient['naam']) ?>" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="geboortedatum" class="form-label">Geboortedatum</label>
            <input type="date" class="form-control" id="geboortedatum" name="geboortedatum"
                   value="<?= htmlspecialchars($patient['geboortedatum']) ?>" required>
        </div>

        <div class="row">
            <div class="col-md-8 mb-3">
                <label for="straat" class="form-label">Straat</label>
                <input type="text" class="form-control" id="straat" name="straat"
                       value="<?= htmlspecialchars($patient['straat']) ?>" required>
            </div>
            <div class="col-md-4 mb-3">
                <label for="huisnummer" class="form-label">Huisnummer</label>
                <input type="text" class="form-control" id="huisnummer" name="huisnummer"
                       value="<?= htmlspecialchars($patient['huisnummer']) ?>" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="postcode" class="form-label">Postcode</label>
                <input type="text" class="form-control" id="postcode" name="postcode"
                       value="<?= htmlspecialchars($patient['postcode']) ?>" required>
            </div>
            <div class="col-md-8 mb-3">
                <label for="plaats" class="form-label">Plaats</label>
                <input type="text" class="form-control" id="plaats" name="plaats"
                       value="<?= htmlspecialchars($patient['plaats']) ?>" required>
            </div>
        </div>
        
        <div class="mb-3">
            <label for="email" class="form-label">E-mailadres</label>
            <input type="email" class="form-control" id="email" name="email"
                   value="<?= htmlspecialchars($patient['email'] ?? '') ?>">
        </div>

        <div class="mb-3">
            <label for="verzekeringsnummer" class="form-label">Verzekeringsnummer</label>
            <input type="text" class="form-control" id="verzekeringsnummer" name="verzekeringsnummer"
                   value="<?= htmlspecialchars($patient['verzekeringsnummer']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="klachten" class="form-label">Klachten</label>
            <textarea class="form-control" id="klachten" name="klachten" rows="4"><?= htmlspecialchars($patient['klachten']) ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Opslaan</button>
        <a href="index.php" class="btn btn-secondary">Annuleren</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>