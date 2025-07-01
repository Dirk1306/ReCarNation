<?php
session_start();

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link ref="stylesheet" href="css/styles.css">

</head>
<nav class="navbar navbar-expand-lg navbar-light custom-navbar">
    <div class="container-fluid">
        <a class="navbar-brand" href="home.php"> <img src="img/logo.png" alt="Logo">ReCarNation</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="home.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="carsite.php">Autos</a></li>
                <li class="nav-item"><a class="nav-link" href="impressum.php">Impressum</a></li>
                <?php 
                    
                    if (!isset($_SESSION['username'])) {
                      // Nicht eingeloggt
                       echo ('<li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>');  
                    } else {
                     // Eingeloggt
                      if (isset($_SESSION['user']['roll']) && $_SESSION['user']['roll'] === 'admin') {
                      // Admin
                      echo ('<li class="nav-item"><a class="nav-link" href="admin_offers.php">Adminbereich</a></li>');
                      echo ('<li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>');
                      } else {
                      // Normaler User
                        echo ('<li class="nav-item"><a class="nav-link" href="watchlist.php">Merkliste</a></li>');
                        echo ('<li class="nav-item"><a class="nav-link" href="profile.php">Profil</a></li>');
                        echo ('<li class="nav-item"><a class="nav-link" href="sell-Site.php">Auto verkaufen</a></li>');
                        echo ('<li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>');
                     }
                   }
                ?>

                    
            </ul>
        </div>
    </div>
</nav>