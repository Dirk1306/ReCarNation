<?php
    include 'include/navbar.php';
?>
<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ReCarnation – Startseite</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/styles.css" rel="stylesheet">
</head>
<body>

  <div class="slider">
    <div class="slides">
        <img class="slide" src="img/car1.webp" alt="image1">
        <img class="slide" src="img/car2.1.jpg" alt="image2">
        <img class="slide" src="img/car3.1.webp" alt="image3">
    </div>
    <button class="prev" onclick="prevSlide()">&#10094</button>
    <button class="next" onclick="nextSlide()">&#10095</button>
  </div>

  <!-- Hero-Bereich -->
  <header class="bg-light text-dark text-center py-5 border-bottom">
    <div class="container">
      <h1 class="display-5 fw-semibold mb-3">Willkommen bei ReCarnation</h1>
      <p class="lead text-muted">Dein Portal für nachhaltige Wiederverwertung</p>
   </div>
  </header>

  <!-- Hauptinhalt -->
  <main class="container my-5">
    <div class="row g-4">
      <div class="col-md-4">
        <div class="card h-100">
          <img src="img/feature1.jpg" class="card-img-top" alt="Feature 1">
          <div class="card-body">
            <h5 class="card-title">Auto-Restaurierung mit Leidenschaft</h5>
            <p class="card-text">Wir hauchen alten Fahrzeugen neues Leben ein durch sorgfältige Aufarbeitung und moderne Technik entstehen einzigartige Klassiker mit Geschichte.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card h-100">
          <img src="img/feature2.jpg" class="card-img-top" alt="Feature 2">
          <div class="card-body">
            <h5 class="card-title">Marktplatz für Klassiker</h5>
            <p class="card-text">Finde dein Traumauto: Bei uns kannst du restaurierte Oldtimer und gut erhaltene Gebrauchtwagen entdecken nachhaltig, authentisch, bereit für die Straße.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card h-100">
          <img src="img/feature3.jpg" class="card-img-top" alt="Feature 3">
          <div class="card-body">
            <h5 class="card-title">Qualitätsgeprüfte Ersatzteile</h5>
            <p class="card-text">Ob selten oder gefragt wir bieten geprüfte Autoteile in Top-Zustand für Liebhaber, Schrauber und Werkstätten.</p>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- Footer -->
  <footer class="bg-light text-center py-4 mt-auto">
    <div class="container">
      <p class="mb-0">© 2025 ReCarnation. Alle Rechte vorbehalten.</p>
    </div>
  </footer>

  <script src="js/home.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

