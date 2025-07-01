<?php
session_start();

// DB-Verbindung
$host = "localhost";
$user = "root";
$pass = "";
$db = "recarnation";

$db_obj = new mysqli($host, $user, $pass, $db);

// Überprüfung der Anmeldedaten mit den in der Session gespeicherten Informationen
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    try {
        $sql = "SELECT * FROM user WHERE Username = '$username'";
        $result = $db_obj->query($sql);
        $row = $result->fetch_array();

        // Daten in Session speichern, inkl. Rolle
        $_SESSION['user']['id'] = $row['User_id'];
        $_SESSION['user']['username'] = $row['Username'];
        $_SESSION['user']['password'] = $row['Password'];
        $_SESSION['user']['firstname'] = $row['Firstname'];
        $_SESSION['user']['lastname'] = $row['Lastname'];
        $_SESSION['user']['roll'] = $row['roll'];  // <-- Rolle speichern

    } catch (Exception $e) {
        $_SESSION['error'] = "SQL Fehler";
        header("Location: login.php");
        exit();
    }

    // Vergleich mit den gespeicherten Daten in der Session
    if (
        $_SESSION['user']['username'] === $username &&
        $_SESSION['user']['password'] === $password
    ) {
        // Login erfolgreich
        $_SESSION['username'] = $username;
        header("Location: home.php");
        exit();
    } else {
        // Fehlerhafte Anmeldedaten
        $_SESSION['error'] = "Invalid username or password.";
        header("Location: login.php");
        exit();
    }

} else {
    // Blockiere direkten Zugriff
    header("Location: login.php");
    exit();
}

