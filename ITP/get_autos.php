<?php
header("Content-Type: application/json");

// DB-Verbindung
$host = "localhost";
$user = "root";
$pass = "";
$db = "recarnation";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["error" => "Verbindung fehlgeschlagen"]);
    exit;
}

// BLOB als base64-Bild umwandeln
$sql = "SELECT Car_id, Name, Brand, year_of_construction, Model, Price, image, Information FROM car";
$result = $conn->query($sql);

$autos = [];

while ($row = $result->fetch_assoc()) {
    $row['image'] = 'data:image/jpeg;base64,' . base64_encode($row['image']);
    $autos[] = $row;
}

echo json_encode($autos);
$conn->close();
?>
