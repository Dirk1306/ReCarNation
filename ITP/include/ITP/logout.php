<?php
session_start(); // Startet die Session, falls sie noch nicht gestartet wurde

// Entfernt die Login-Informationen, aber behält andere Session-Daten
unset($_SESSION['username']); // Entfernt nur den Benutzernamen

// Optional: Setze eine Nachricht oder einen Hinweis in der Session
$_SESSION['message'] = "Du wurdest erfolgreich ausgeloggt. Melde dich erneut an, wenn du möchtest.";
if($_SESSION['user']['status'] === "Deactivated")
    $_SESSION['message'] = "Dein Account ist deaktiviert!";
// Weiterleitung zur Login-Seite
header("Location: home.php");
exit();
