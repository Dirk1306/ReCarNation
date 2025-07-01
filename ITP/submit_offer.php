<?php
$host = 'localhost';
$dbname = 'recarnation';
$username = 'root';
$password = '';

session_start();

if (!isset($_SESSION['user']['id']) || !isset($_SESSION['user']['username'])) {
    die("Bitte melde dich an, um ein Fahrzeug anzubieten.");
}

echo "User-ID aus Session: " . $_SESSION['user']['id'] . "<br>";
echo "Username aus Session: " . $_SESSION['user']['username'] . "<br>";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Verbindung fehlgeschlagen: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user']['id'];
    $username = $_SESSION['user']['username'];
    $details = $_POST['details'] ?? '';
    $kilometer = $_POST['kilometer'] ?? 0;
    $preis = $_POST['preis'] ?? 0;
    $status = "in Bearbeitung";

    $imageData = null;

    if (!empty($_FILES['bilder']['tmp_name'][0])) {
        $tmpName = $_FILES['bilder']['tmp_name'][0];
        $imageData = file_get_contents($tmpName);
    }

    $stmt = $pdo->prepare("
        INSERT INTO offers (User_id, Username, offerdetails, mileage, Priceoffer, Offerpicture, status)
        VALUES (?, ?, ?, ?, ?, ?,?)
    ");

    $stmt->bindParam(1, $user_id, PDO::PARAM_INT);
    $stmt->bindParam(2, $username, PDO::PARAM_STR);
    $stmt->bindParam(3, $details, PDO::PARAM_STR);
    $stmt->bindParam(4, $kilometer, PDO::PARAM_INT);
    $stmt->bindParam(5, $preis);
    $stmt->bindParam(6, $imageData, PDO::PARAM_LOB);
    $stmt->bindParam(7, $status, PDO::PARAM_STR);

    if ($stmt->execute()) {
        echo "Fahrzeugangebot erfolgreich gespeichert!";
    } else {
        echo "Fehler beim Speichern: ";
        print_r($stmt->errorInfo());
    }
}

   header("Location: offer_success.php");
   exit();

?>
