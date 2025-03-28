<?php
$host = "localhost";
$dbname = "recarnation";
$user = "root";
$pass = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Felder aus dem Formular
        $username = htmlspecialchars($_POST["username"]);
        $email = htmlspecialchars($_POST["email"]);
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

        // Checkt auf doppelte E-Mail
        $check = $pdo->prepare("SELECT * FROM user WHERE email = ?");
        $check->execute([$email]);
        if ($check->rowCount() > 0) {
            echo "Diese E-Mail ist bereits registriert.";
            exit;
        }

        // Neuer Benutzers
        $stmt = $pdo->prepare("INSERT INTO user (username, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$username, $email, $password]);

        echo "Registrierung erfolgreich!";
    }
} catch (PDOException $e) {
    echo "Verbindungsfehler: " . $e->getMessage();
}
?>
