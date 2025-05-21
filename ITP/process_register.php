<?php
    session_start();

    // DB-Verbindung
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "recarnation";

    $db_obj = new mysqli($host, $user, $pass, $db);
    if ($db_obj->connect_error) {
        die("Verbindungsfehler: " . $db_obj->connect_error);
    }

    // Eingabedaten holen
    $username     = trim($_POST['username']);
    $firstname    = trim($_POST['firstname']);
    $lastname     = trim($_POST['lastname']);
    $email        = trim($_POST['email']);
    $phonenumber  = trim($_POST['phonenumber']);
    $gender       = trim($_POST['gender']);
    $birthdate    = $_POST['birthdate'];
    $password     = trim($_POST['password']); 

    // Validierung (kann erweitert werden)
    if (empty($username) || empty($email) || empty($password)) {
        die("Pflichtfelder fehlen.");
    }

    // SQL vorbereiten
    $stmt = $db_obj->prepare("INSERT INTO user (Username, Firstname, Lastname, Email, Phonenumber, Gender, Birthdate, Password) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssisss", $username, $firstname, $lastname, $email, $phonenumber, $gender, $birthdate, $password);

    // Ausführen
    if ($stmt->execute()) {
        echo "Registrierung erfolgreich!";
        // Optional: Weiterleitung
        // header("Location: login.php");
        header("Location: login.php");
    } else {
        echo "Fehler: " . $stmt->error;
    }

    $stmt->close();
    $db_obj->close();
?>
