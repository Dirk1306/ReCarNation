<?php

include 'include/navbar.php';
$host = "localhost";
$user = "root";
$pass = "";
$db = "recarnation";

$db_obj = new mysqli($host, $user, $pass, $db);
if ($db_obj->connect_error) {
    die("Verbindung fehlgeschlagen: " . $db_obj->connect_error);
}

// Statusupdate verarbeiten
if (isset($_POST['update_status'])) {
    $offer_id = $_POST['offer_id'];
    $new_status = $_POST['status'];

    $stmt = $db_obj->prepare("UPDATE offers SET status = ? WHERE User_id = ?");
    $stmt->bind_param("si", $new_status, $offer_id);
    $stmt->execute();
    $stmt->close();
}

// Angebote abrufen
$result = $db_obj->query("SELECT User_id, Username, offerdetails, mileage, Priceoffer, date, Offerpicture, status FROM offers ORDER BY date DESC");

$offers = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $offers[] = $row;
    }
    $result->free();
}
$db_obj->close();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin Angebote Übersicht</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="display-5 fw-bold">Admin - Angebote Übersicht</h1>
        <p class="text-muted">Verwalte eingereichte Fahrzeugangebote</p>
    </div>

    <div class="table-responsive shadow-sm border rounded bg-white p-3">
        <table class="table table-hover table-bordered align-middle mb-0">
            <thead class="table-dark text-center">
                <tr>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Angebotsdetails</th>
                    <th>Kilometerstand</th>
                    <th>Preis</th>
                    <th>Datum</th>
                    <th>Bild</th>
                    <th>Status</th>
                    <th>Aktion</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($offers as $offer): ?>
                <tr>
                    <td class="text-center"><?= htmlspecialchars($offer['User_id']) ?></td>
                    <td><?= htmlspecialchars($offer['Username']) ?></td>
                    <td><?= nl2br(htmlspecialchars($offer['offerdetails'])) ?></td>
                    <td class="text-center"><?= htmlspecialchars($offer['mileage']) ?> km</td>
                    <td class="text-end"><?= number_format($offer['Priceoffer'], 2, ',', '.') ?> €</td>
                    <td class="text-center"><?= htmlspecialchars($offer['date']) ?></td>
                    <td class="text-center">
                        <?php if (!empty($offer['Offerpicture'])): ?>
                            <img src="data:image/jpeg;base64,<?= base64_encode($offer['Offerpicture']) ?>" 
                                class="img-thumbnail" style="max-width: 100px; max-height: 100px; cursor:pointer;" 
                                data-bs-toggle="modal" data-bs-target="#imageModal" 
                                onclick="document.getElementById('modalImage').src=this.src;" />
                        <?php else: ?>
                            <span class="text-muted">Kein Bild</span>
                        <?php endif; ?>
                    </td>
                    <td class="text-center">
                        <span class="badge px-3 py-2 
                            <?php 
                                if ($offer['status'] === 'aufgenommen') echo 'bg-success'; 
                                elseif ($offer['status'] === 'zurückgewiesen') echo 'bg-danger'; 
                                else echo 'bg-secondary'; 
                            ?>">
                            <?= htmlspecialchars($offer['status']) ?>
                        </span>
                    </td>
                    <td>
                        <form method="post" class="d-flex flex-column gap-2">
                            <input type="hidden" name="offer_id" value="<?= htmlspecialchars($offer['User_id']) ?>">
                            <select name="status" class="form-select form-select-sm" required>
                                <option value="" disabled selected>Status wählen</option>
                                <option value="aufgenommen">aufgenommen</option>
                                <option value="zurückgewiesen">zurückgewiesen</option>
                            </select>
                            <button type="submit" name="update_status" class="btn btn-sm btn-primary w-100">Ändern</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-body text-center">
        <img id="modalImage" src="" class="img-fluid rounded" alt="Angebotsbild" />
      </div>
    </div>
  </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
