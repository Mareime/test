<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre Page</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
   
    <style>
    /* styledem.css */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Roboto', Arial, sans-serif; /* Utilisation de la police Roboto pour un look moderne */
    background-color: #f8f9fa;
    color: #333;
    line-height: 1.6;
    margin: 0;
}

.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 20px;
    background-color: #ffffff;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.logo img {
    max-width: 100px;
    height: auto;
}

.nav-items a {
    color: #333;
    text-decoration: none;
    margin: 0 15px;
    padding: 10px;
    transition: color 0.3s;
}

.nav-items a:hover {
    color: #007bff;
}

.banner {
    height: 300px;
    background-size: cover;
    background-position: center;
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    padding: 0 20px;
}

.banner button {
    background-color: #007bff;
    color: #ffffff;
    border: none;
    padding: 12px 24px;
    font-size: 18px;
    border-radius: 5px;
    text-transform: uppercase;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.banner button:hover {
    background-color: #0056b3;
}

.container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    padding: 20px;
}

.profil-box {
    background-color: #3498db;
    color: #ffffff;
    border-radius: 10px;
    padding: 30px;
    margin: 15px;
    text-align: center;
    box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
    width: 300px;
    transition: transform 0.3s ease;
}

.profil-box:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
}

.profil-pic {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    object-fit: cover;
    margin-bottom: 20px;
    border: 4px solid #ffffff;
}

.profil-box h3 {
    font-size: 24px;
    margin-bottom: 10px;
}

.profil-box p {
    font-size: 16px;
    margin-bottom: 10px;
}

.profil-box .button {
    background-color: #ffffff;
    color: #3498db;
    border: 1px solid #ffffff;
    padding: 8px 16px;
    border-radius: 5px;
    text-decoration: none;
    transition: background-color 0.3s ease, color 0.3s ease;
}

.profil-box .button:hover {
    background-color: #3498db;
    color: #ffffff;
}

@media (max-width: 768px) {
    .container {
        padding: 10px;
    }

    .profil-box {
        width: calc(50% - 30px);
    }
}

@media (max-width: 576px) {
    .profil-box {
        width: calc(100% - 30px);
    }
}

    </style>
</head>
<body>
<header class="header">
  <a href="index.html" class="logo">
    <img src="logo.jpg" alt="Logo">
  </a>
  <nav class="nav-items">
    <a href="home.php">Accueil</a>
    <a href="voir_plus_home.php">Services</a>
    <a href="index">Contacter-nous</a>
    <a href="particulier_mon_offre.php">Mon offre</a>
  </nav>
</header>

<!-- Bannière -->
<div class="banner d-flex justify-content-center align-items-center" style="background-image: url('background.jpg');">
    <div class="content text-center">
        <button><a href="cree_offer_particulier.php" style="color: inherit; text-decoration: none;">Créer une offre</a></button>
    </div>
</div>

<!-- Contenu des profils -->
<div class="container">
    <?php 
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

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
