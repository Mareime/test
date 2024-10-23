<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre Page</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* CSS existant précédemment */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #28223F;
            color: #B3B8CD;
        }

        .navbar-custom {
            background-color: #1F1A36; /* Nouvelle couleur de fond pour la barre de navigation */
            color: #fff; /* Nouvelle couleur du texte pour la barre de navigation */
            border-bottom: 1px solid #222; /* Bordure inférieure */
        }

        .navbar-brand img {
            max-width: 100px;
            height: auto;
        }

        .navbar-nav .nav-link {
            color: #fff;
        }

        .navbar-nav .nav-link:hover {
            color: #03BFCB;
        }

        .banner {
            height: 300px;
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .banner button {
            background-color: #03BFCB;
            color: #231E39;
            border: none;
            padding: 15px 30px;
            font-size: 16px;
            border-radius: 3px;
            text-transform: uppercase;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .banner button:hover {
            background-color: #02899C;
        }

        .banner button a {
            text-decoration: none; /* Supprimer la décoration du lien */
            color: inherit; /* Hériter de la couleur du texte parent */
        }

        .banner button:hover a {
            color: #fff; /* Changer la couleur du texte au survol */
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 20px; /* Réduit la marge en haut */
        }

        .profil-box {
            background-color: #231E39;
            color: #B3B8CD;
            border-radius: 5px;
            padding: 20px;
            margin: 10px; /* Réduit la marge autour des profils */
            text-align: center;
            box-shadow: 0 10px 20px -10px rgba(0, 0, 0, 0.75);
            width: calc(25% - 20px); /* Largeur des profils avec moins de marge */
            min-width: 250px; /* Largeur minimale pour un affichage correct */
        }

        .profil-pic {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 20px;
        }

        .profil-box h3 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .profil-box p {
            font-size: 16px;
            margin-bottom: 20px;
        }

        .profil-box .button {
            background-color: #03BFCB;
            color: #231E39;
            border: none;
            padding: 10px 20px;
            border-radius: 3px;
            text-decoration: none;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .profil-box .button:hover {
            background-color: #02899C;
            color: #fff;
        }

        .profil-box .button a {
            text-decoration: none; /* Supprimer la décoration du lien */
            color: inherit; /* Hériter de la couleur du texte parent */
        }

        .profil-box .button:hover a {
            color: #fff; /* Changer la couleur du texte au survol */
        }

        @media (max-width: 1200px) {
            .profil-box {
                width: calc(33.33% - 20px);
            }
        }

        @media (max-width: 992px) {
            .profil-box {
                width: calc(50% - 20px);
            }
        }

        @media (max-width: 768px) {
            .profil-box {
                width: calc(100% - 20px);
                margin-bottom: 20px; /* Ajout d'une marge en bas pour séparer les profils */
            }
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
                <li class="nav-item">
                    <a class="nav-link" href="entreprise_mon_offres.php">Mon offre</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Bannière -->
    <div class="banner d-flex justify-content-center align-items-center" style="background-image: url('background.jpg');">
        <div class="content text-center">
            <button><a href="cree_offer_entreprise.php">Créer une offre</a></button>
        </div>
    </div>

    <!-- Contenu des profils -->
    <main>
        <div class="container">
            <?php 
                // session_start();
                include("connection.php");
                $rq = "SELECT * FROM demandeur WHERE cv IS NOT NULL";
                $sql = mysqli_query($con, $rq);
                while ($row = mysqli_fetch_array($sql)) { 
            ?>
            <div class="profil-box">
                <img src="img/<?php echo $row["image"]; ?>" alt="Image de profil" class="profil-pic">
                <h3><?php echo $row["nom"]; ?></h3>
                <p><?php echo $row["domain"]; ?></p>
                <p><?php echo $row["adresse"]; ?></p>
                <a class="button" href="pdf/<?php echo $row["cv"]; ?>">Afficher</a>
            </div>
            <?php } ?>
        </div>
    </main>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
