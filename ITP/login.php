<?php
    include 'include/navbar.php';
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
        <form>
          <div class="mb-3">
            <label for="loginEmail" class="form-label">E-Mail</label>
            <input type="email" class="form-control" id="loginEmail" placeholder="E-Mail eingeben">
          </div>
          <div class="mb-3">
            <label for="loginPassword" class="form-label">Passwort</label>
            <input type="password" class="form-control" id="loginPassword" placeholder="Passwort eingeben">
          </div>
          <button type="submit" class="btn btn-primary w-100">Einloggen</button>
        </form>
      </div>

      <!-- Registrierungs-Formular -->
      <div class="tab-pane fade" id="registerForm">
        <form>
          <div class="mb-3">
            <label for="registerName" class="form-label">Benutzername</label>
            <input type="text" class="form-control" id="registerName" placeholder="Benutzername">
          </div>
          <div class="mb-3">
            <label for="registerEmail" class="form-label">E-Mail</label>
            <input type="email" class="form-control" id="registerEmail" placeholder="E-Mail">
          </div>
          <div class="mb-3">
            <label for="registerPassword" class="form-label">Passwort</label>
            <input type="password" class="form-control" id="registerPassword" placeholder="Passwort">
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
