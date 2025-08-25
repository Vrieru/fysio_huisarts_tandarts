<?php
require_once 'config.php';
require_once 'header.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = $_GET['id'];

try {
    $stmt = $db->prepare("SELECT * FROM fysio WHERE id = ?");
    $stmt->execute([$id]);
    $patient = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$patient) {
        //echo"Patient $id niet gevonden";
        header('Location: index.php');
        exit;
    }
} catch(PDOException $e) {
    die('Fout bij ophalen gegevens: ' . $e->getMessage());
}
?>

    <div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Patiënt Details</h1>
        <div>
            <a href="bewerken.php?id=<?= $patient['id'] ?>" class="btn btn-warning">Bewerken</a>
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
                    <th style="width: 150px;">Patientnummer:</th>
                    <td><?= htmlspecialchars($patient['patientnummer']) ?></td>
                </tr>
                <tr>
                    <th>Naam:</th>
                    <td><?= htmlspecialchars($patient['naam']) ?></td>
                </tr>
                <tr>
                    <th>Geboortedatum:</th>
                    <td><?= htmlspecialchars($patient['geboortedatum']) ?></td>
                </tr>
                <tr>
                    <th>Verzekeringsnr:</th>
                    <td><?= htmlspecialchars($patient['verzekeringsnummer']) ?></td>
                </tr>
            </table>
        </div>
        <div class="col-md-6">
            <h5 class="card-title">Contactgegevens</h5>
            <table class="table table-borderless">
                <tr>
                    <th style="width: 150px;">Adres:</th>
                    <td><?= htmlspecialchars($patient['straat'] . ' ' . $patient['huisnummer']) ?></td>
                </tr>
                <tr>
                    <th>Postcode:</th>
                    <td><?= htmlspecialchars($patient['postcode']) ?></td>
                </tr>
                <tr>
                    <th>Woonplaats:</th>
                    <td><?= htmlspecialchars($patient['plaats']) ?></td>
                </tr>
            </table>
        </div>
    </div>

    <div class="mt-4">
        <h5 class="card-title">Klachten</h5>
        <div class="card">
            <div class="card-body bg-light">
                <?php if (!empty($patient['klachten'])): ?>
                    <?= nl2br(htmlspecialchars($patient['klachten'])) ?>
                <?php else: ?>
                    <em>Geen klachten geregistreerd</em>
                <?php endif; ?>
            </div>
        </div>
    </div>
    </div><?php
