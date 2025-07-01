<?php
    include 'include/navbar.php';

    // Falls der Benutzer bereits eingeloggt ist, umleiten
    if (isset($_SESSION['username'])) {
        header("Location: home.php");
        exit();
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login & Registrierung</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/styles.css" rel="stylesheet">
</head>
<body>

<div class="container">
  <div class="form-container">
    <ul class="nav nav-tabs mb-3" id="formTabs">
      <li class="nav-item">
        <a class="nav-link active tab-button" data-bs-toggle="tab" data-bs-target="#loginForm">Login</a>
      </li>
      <li class="nav-item">
        <a class="nav-link tab-button" data-bs-toggle="tab" data-bs-target="#registerForm">Registrieren</a>
      </li>
    </ul>

    <div class="tab-content">
      <!-- Login-Formular -->
        <div class="tab-pane fade show active" id="loginForm">
          <form action="process_login.php" method="POST">
            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" id="username" name="username" placeholder="Username eingeben">
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Passwort</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Passwort eingeben">
            </div>
            <?php
                if (isset($_SESSION['error'])) {
                    echo "<div class='alert alert-danger'>" . $_SESSION['error'] . "</div>";
                    unset($_SESSION['error']);
                }
            ?>
            <button type="submit" class="btn btn-primary w-100">Einloggen</button>
        </div>
      </form>
      <!-- Registrierungs-Formular -->
      <div class="tab-pane fade" id="registerForm">
        <form action = "process_register.php" method="POST">
          <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" class="form-control" name="username" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Firstname</label>
            <input type="text" class="form-control" name="firstname" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Lastname</label>
            <input type="text" class="form-control" name="lastname" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" name="email" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Phonenumber</label>
            <input type="number" class="form-control" name="phonenumber" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Gender</label>
            <select class="form-control" name="gender" required>
              <option value="">Bitte wählen</option>
              <option value="Männlich">Männlich</option>
              <option value="Weiblich">Weiblich</option>
              <option value="Divers">Divers</option>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Birthdate</label>
            <input type="date" class="form-control" name="birthdate" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Passwort</label>
            <input type="password" class="form-control" name="password" required>
          </div>
          <button type="submit" class="btn btn-success w-100">Registrieren</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
