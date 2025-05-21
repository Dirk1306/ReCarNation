<?php
include 'include/navbar.php';

// Nur für eingeloggte Nutzer
if (!isset($_SESSION['user']['id'])) {
    header("Location: login.php");
    exit();
}

// DB-Verbindung
$host = "localhost";
$user = "root";
$pass = "";
$db = "recarnation";

$db_obj = new mysqli($host, $user, $pass, $db);
if ($db_obj->connect_error) {
    die("Verbindungsfehler: " . $db_obj->connect_error);
}

$user_id = $_SESSION['user']['id'];

// Autos aus der Watchlist des Nutzers abrufen
$sql = "
    SELECT car.*
    FROM watch_list
    JOIN car ON watch_list.Car_id = car.Car_id
    WHERE watch_list.User_id = ?
";

$stmt = $db_obj->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="de">
<head>
     <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ReCarnation – Startseite</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Meine gemerkten Autos</h2>

    <?php if ($result->num_rows > 0): ?>
        <div class="row">
            <?php while ($car = $result->fetch_assoc()): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <?php if (!empty($car['image'])): ?>
                            <img src="<?= htmlspecialchars($car['image']) ?>" class="card-img-top" alt="Auto Bild">
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($car['Brand']) . ' ' . htmlspecialchars($car['Model']) ?></h5>
                            <p class="card-text">
                                <strong>Name:</strong> <?= htmlspecialchars($car['Name']) ?><br>
                                <strong>Baujahr:</strong> <?= htmlspecialchars($car['year_of_construction']) ?><br>
                                <strong>Preis:</strong> <?= number_format($car['Price'], 0, ',', '.') ?> €<br>
                                <strong>Beschreibung:</strong><br> <?= nl2br(htmlspecialchars($car['Information'])) ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p>Du hast noch keine Autos in deiner Merkliste.</p>
    <?php endif; ?>
</div>
</body>
</html>
