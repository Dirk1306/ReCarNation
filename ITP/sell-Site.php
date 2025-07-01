<?php include 'include/navbar.php'; ?>
<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <title>Auto verkaufen</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="css/styles.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

  <div class="container py-5">
    <h1 class="display-5 fw-semibold mb-4 text-center">Auto verkaufen</h1>

    <form action="submit_offer.php" method="POST" enctype="multipart/form-data" class="p-4 bg-white rounded shadow-sm needs-validation" novalidate>
        
        <div class="mb-3">
        <label for="details" class="form-label">Fahrzeugdetails</label>
        <textarea id="details" name="details" rows="5" class="form-control" placeholder="Marke, Modell, Baujahr, Zustand usw." required></textarea>
        <div class="invalid-feedback">
            Bitte gib die Fahrzeugdetails an.
        </div>
        </div>

        <div class="mb-3">
        <label for="kilometer" class="form-label">Kilometerstand</label>
        <input type="number" id="kilometer" name="kilometer" class="form-control" placeholder="z.B. 120000" required min="0">
        <div class="invalid-feedback">
            Bitte gib einen gültigen Kilometerstand an.
        </div>
        </div>

        <div class="mb-3">
        <label for="preis" class="form-label">Preis (€)</label>
        <input type="number" id="preis" name="preis" class="form-control" placeholder="z.B. 8500" required min="0">
        <div class="invalid-feedback">
            Bitte gib einen gültigen Preis an.
        </div>
        </div>

        <div class="mb-3">
        <label for="bilder" class="form-label">Bilder vom Fahrzeug (JPG, PNG)</label>
        <input type="file" id="bilder" name="bilder[]" class="form-control" accept=".jpg,.jpeg,.png" multiple required>
        <div class="invalid-feedback">
            Bitte lade mindestens ein Bild hoch.
        </div>
        </div>

        <div class="d-grid">
        <button type="submit" class="btn btn-black btn-lg">Angebot erstellen</button>
        </div>
     </form>
   </div>

<!-- Bootstrap Form Validation Script -->
<script>
  (function () {
    'use strict';
    const forms = document.querySelectorAll('.needs-validation');
    Array.from(forms).forEach(form => {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  })();
</script>


</body>
</html>

