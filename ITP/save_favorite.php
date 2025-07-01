<?php
    // DB-Verbindung
    $conn = new mysqli("localhost", "root", "", "recarnation");

    if ($conn->connect_error) {
        die("Verbindung fehlgeschlagen: " . $conn->connect_error);
    }

    // JSON-Daten auslesen
    $data = json_decode(file_get_contents("php://input"));

    $car_id = intval($data->car_id);
    $user_id = intval($data->user_id);

    // Eintrag speichern
    $sql = "INSERT IGNORE INTO watch_list (Car_id, User_id) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $car_id, $user_id);

    if ($stmt->execute()) {
        echo "Auto wurde zur Merkliste hinzugefügt.";
    } else {
        echo "Fehler: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
?>
