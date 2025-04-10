<?php
include 'include/navbar.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);


$pdo = new PDO("mysql:host=localhost;dbname=recarnation;charset=utf8", "root", "");

// Autos abrufen
$stmt = $pdo->query("SELECT * FROM car");
$autos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Autoliste</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h1 class="mb-4 text-center">Unsere Fahrzeuge</h1>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php if (count($autos) === 0): ?>
            <p class="text-center">Aktuell sind keine Fahrzeuge verfügbar.</p>
        <?php endif; ?>

        <?php foreach ($autos as $auto): ?>
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <img src="<?= htmlspecialchars($auto['image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($auto['Name']) ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($auto['Brand'] . " " . $auto['Model']) ?></h5>
                        <p class="card-text"><?= nl2br(htmlspecialchars($auto['Information'])) ?></p>
                        <p class="card-text fw-bold text-primary"><?= number_format($auto['Price'], 0, ',', '.') ?> €</p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

</body>
</html>
