<?php
require_once 'config.php';
require_once 'header.php';

$stmt = $db->query("SELECT * FROM huisarts ORDER BY achternaam, voornaam");
$huisartsen = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Patiënten Overzicht</h1>
            <a href="toevoegen.php" class="btn btn-primary">Nieuwe Patiënt</a>
        </div>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Naam</th>
                    <th>Geboortedatum</th>
                    <th>Adres</th>
                    <th>Telefoon</th>
                    <th>Acties</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($huisartsen as $huisarts): ?>
                    <tr>
                        <td><?= htmlspecialchars($huisarts['voornaam'] . ' ' . $huisarts['achternaam']) ?></td>
                        <td><?= htmlspecialchars($huisarts['geboortedatum']) ?></td>
                        <td>
                            <?= htmlspecialchars($huisarts['adres']) ?><br>
                            <?= htmlspecialchars($huisarts['postcode'] . ' ' . $huisarts['woonplaats']) ?>
                        </td>
                        <td><?= htmlspecialchars($huisarts['telefoonnummer']) ?></td>
                        <td>
                            <a href="bekijken.php?id=<?= $huisarts['id'] ?>" class="btn btn-sm btn-info">Bekijken</a>
                            <a href="bewerken.php?id=<?= $huisarts['id'] ?>" class="btn btn-sm btn-warning">Bewerken</a>
                            <a href="verwijderen.php?id=<?= $huisarts['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Weet u zeker dat u deze patiënt wilt verwijderen?')">Verwijderen</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html><?php
