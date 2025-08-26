<?php
require_once 'config.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = $_GET['id'];

try {
    $stmt = $db->prepare("SELECT * FROM huisarts WHERE id = ?");
    $stmt->execute([$id]);
    $huisarts = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$huisarts) {
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
            <a href="bewerken.php?id=<?= $huisarts['id'] ?>" class="btn btn-warning">Bewerken</a>
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
                            <th style="width: 150px;">Naam:</th>
                            <td><?= htmlspecialchars($huisarts['voornaam'] . ' ' . $huisarts['achternaam']) ?></td>
                        </tr>
                        <tr>
                             <th>Geboortedatum:</th>
                            <td><?= date('d-m-Y', strtotime($huisarts['geboortedatum'])) ?></td>
                        </tr>
                        <tr>
                            <th>Verzekeringsnr:</th>
                            <td><?= htmlspecialchars($huisarts['verzekeringsnummer']) ?></td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <h5 class="card-title">Contactgegevens</h5>
                    <table class="table table-borderless">
                        <tr>
                            <th style="width: 150px;">Adres:</th>
                            <td><?= htmlspecialchars($huisarts['adres']) ?></td>
                        </tr>
                        <tr>
                            <th>Postcode:</th>
                            <td><?= htmlspecialchars($huisarts['postcode']) ?></td>
                        </tr>
                        <tr>
                            <th>Woonplaats:</th>
                            <td><?= htmlspecialchars($huisarts['woonplaats']) ?></td>
                        </tr>
                        <tr>
                            <th>Telefoon:</th>
                            <td><?= htmlspecialchars($huisarts['telefoonnummer']) ?></td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="mt-4">
                <h5 class="card-title">Notities</h5>
                <div class="card">
                    <div class="card-body bg-light">
                        <?php if (!empty($huisarts['notities'])): ?>
                            <?= nl2br(htmlspecialchars($huisarts['notities'])) ?>
                        <?php else: ?>
                            <em>Geen notities beschikbaar</em>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>