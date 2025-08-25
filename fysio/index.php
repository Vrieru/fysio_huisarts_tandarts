<?php
require_once 'config.php';
require_once 'header.php';

$stmt = $db->query("SELECT * FROM fysio ORDER BY naam");
$patienten = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
                    <th>Patientnummer</th>
                    <th>Naam</th>
                    <th>Geboortedatum</th>
                    <th>Adres</th>
                    <th>Acties</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($patienten as $patient): ?>
                    <tr>
                        <td><?= htmlspecialchars($patient['patientnummer']) ?></td>
                        <td><?= htmlspecialchars($patient['naam']) ?></td>
                        <td><?= htmlspecialchars($patient['geboortedatum']) ?></td>
                        <td>
                            <?= htmlspecialchars($patient['straat'] . ' ' . $patient['huisnummer']) ?><br>
                            <?= htmlspecialchars($patient['postcode'] . ' ' . $patient['plaats']) ?>
                        </td>
                        <td>
                            <a href="bekijken.php?id=<?= $patient['id'] ?>" class="btn btn-sm btn-info">Bekijken</a>
                            <a href="bewerken.php?id=<?= $patient['id'] ?>" class="btn btn-sm btn-warning">Bewerken</a>
                            <a href="verwijderen.php?id=<?= $patient['id'] ?>" class="btn btn-sm btn-danger"
                               onclick="return confirm('Weet u zeker dat u deze patiënt wilt verwijderen?')">Verwijderen</a>
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
