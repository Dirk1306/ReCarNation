<?php
include 'include/navbar.php';

// Zugriffsschutz – nur eingeloggt erlaubt
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

// Benutzer-ID aus Session
$user_id = $_SESSION['user']['id'];

// Wenn Formular gesendet wurde → UPDATE
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $firstname    = trim($_POST['firstname']);
    $lastname     = trim($_POST['lastname']);
    $email        = trim($_POST['email']);
    $phonenumber  = trim($_POST['phonenumber']);
    $gender       = trim($_POST['gender']);
    $birthdate    = $_POST['birthdate'];

    $stmt = $db_obj->prepare("UPDATE user SET Firstname=?, Lastname=?, Email=?, Phonenumber=?, Gender=?, Birthdate=? WHERE User_id=?");
    $stmt->bind_param("sssissi", $firstname, $lastname, $email, $phonenumber, $gender, $birthdate, $user_id);
    
    if ($stmt->execute()) {
        $success = "Profil erfolgreich aktualisiert.";
    } else {
        $error = "Fehler beim Speichern.";
    }
    $stmt->close();
}

// Aktuelle Benutzerdaten laden
$stmt = $db_obj->prepare("SELECT * FROM user WHERE User_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();
$db_obj->close();


?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ReCarnation – Profil</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/styles.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h2>Profil</h2>

  <?php if (isset($success)) echo "<div class='alert alert-success'>$success</div>"; ?>
  <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>

  <form method="POST">
    <div class="mb-3">
      <label class="form-label">Username (nicht änderbar)</label>
      <input type="text" class="form-control" value="<?= htmlspecialchars($user['Username']) ?>" disabled>
    </div>
    <div class="mb-3">
      <label class="form-label">Firstname</label>
      <input type="text" name="firstname" class="form-control" value="<?= htmlspecialchars($user['Firstname']) ?>" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Lastname</label>
      <input type="text" name="lastname" class="form-control" value="<?= htmlspecialchars($user['Lastname']) ?>" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Email</label>
      <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($user['Email']) ?>" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Phonenumber</label>
      <input type="number" name="phonenumber" class="form-control" value="<?= htmlspecialchars($user['Phonenumber']) ?>" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Gender</label>
      <select name="gender" class="form-control" required>
        <option <?= $user['Gender'] == 'Männlich' ? 'selected' : '' ?>>Männlich</option>
        <option <?= $user['Gender'] == 'Weiblich' ? 'selected' : '' ?>>Weiblich</option>
        <option <?= $user['Gender'] == 'Divers' ? 'selected' : '' ?>>Divers</option>
      </select>
    </div>
    <div class="mb-3">
      <label class="form-label">Birthdate</label>
      <input type="date" name="birthdate" class="form-control" value="<?= htmlspecialchars($user['Birthdate']) ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Speichern</button>
  </form>
</div>
</body>
</html>
