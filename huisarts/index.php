<?php require_once 'config.php'; ?>
<?php require_once 'header.php'; ?>

<?php
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
                    <td><?= date('d-m-Y', strtotime($huisarts['geboortedatum'])) ?></td>
                    <td>
                        <?= htmlspecialchars($huisarts['adres']) ?><br>
                        <?= htmlspecialchars($huisarts['postcode'] . ' ' . $huisarts['woonplaats']) ?>
                    </td>
                    <td><?= htmlspecialchars($huisarts['telefoonnummer']) ?></td>
                    <td>
                        <button class="btn btn-sm btn-info bekijken-btn" data-id="<?= $huisarts['id'] ?>">Bekijken</button>
                        <a href="bewerken.php?id=<?= $huisarts['id'] ?>" class="btn btn-sm btn-warning">Bewerken</a>
                        <a href="verwijderen.php?id=<?= $huisarts['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Weet u zeker dat u deze patiënt wilt verwijderen?')">Verwijderen</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Bootstrap Modal -->
<div class="modal fade" id="bekijkModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Patiënt Details</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Sluiten"></button>
        </div>
        <div class="modal-body" id="modal-content">
            <!-- AJAX inhoud komt hier -->
            <p class="text-center">Bezig met laden...</p>
        </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
// AJAX modal
document.querySelectorAll('.bekijken-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        let id = this.getAttribute('data-id');
        let modal = new bootstrap.Modal(document.getElementById('bekijkModal'));
        document.getElementById('modal-content').innerHTML = '<p class="text-center">Bezig met laden...</p>';

        fetch('bekijken.php?id=' + id)
            .then(response => response.text())
            .then(data => {
                document.getElementById('modal-content').innerHTML = data;
            });

        modal.show();
    });
});
</script>
