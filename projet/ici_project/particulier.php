<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre Page</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styledem.css">
    <style>
        .navbar-custom {
            width: 100%;
            margin: auto;
        }
    </style>
</head>
<body>
    <!-- Barre de navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-custom">
        <a class="navbar-brand" href="#">
            <img src="logo.jpg" class="logo" alt="Logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="home.php">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="voir_plus_home.php">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Contacter-nous</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Bannière -->
    <div class="banner d-flex justify-content-center align-items-center" style="background-image: url('background.jpg');">
        <div class="content text-center">
            <h1>Bienvenue sur notre site</h1>
            <button><span></span><a href="login.php">En savoir plus</a></button>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
