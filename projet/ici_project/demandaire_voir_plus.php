<?php
session_start();
include_once "connection.php";
$Entrep = "SELECT * FROM `publicationsoffrese` WHERE `date_limite` >= CURDATE()";
$ss = mysqli_query($con, $Entrep);
$particlier = "SELECT * FROM `publicationsoffresp` WHERE `date_limite` >= CURDATE()";
$hh = mysqli_query($con, $particlier);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre Page</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
      body {
    font-family: 'Roboto', sans-serif;
    background-color: #f8f9fa;
    margin: 0;
    padding: 0;
}

.navbar-custom {
    background-color: #343a40;
    padding: 10px 20px;
}

.navbar-custom .navbar-brand {
    color: #fff;
    font-weight: bold;
    font-size: 24px;
    display: flex;
    align-items: center;
}

.navbar-custom .navbar-brand img {
    width: 50px;
    height: auto;
    margin-right: 10px;
}

.navbar-custom .navbar-nav .nav-link {
    color: #fff;
    font-weight: 500;
    transition: color 0.3s;
}

.navbar-custom .navbar-nav .nav-link:hover,
.navbar-custom .navbar-nav .nav-link:focus {
    color: #f093fb;
}

.navbar-custom .navbar-toggler {
    border: none;
}

.navbar-custom .navbar-toggler-icon {
    background-image: url("data:image/svg+xml;charset=UTF8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba(255, 255, 255, 0.5)' stroke-width='2' linecap='round' linejoin='round' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
}

.dropdown-menu {
    background-color: #343a40;
}

.dropdown-item {
    color: #fff;
}

.dropdown-item:hover {
    background-color: #495057;
    color: #f093fb;
}

/* Common Styles for Boxes */
.single-box, .single-box1 {
    position: relative;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    width: 300px;
    border-radius: 10px;
    background: linear-gradient(135deg, #6dd5ed, #2193b0);
    color: #fff;
    text-align: center;
    margin: 20px;
    padding: 20px;
    transition: transform 0.3s, box-shadow 0.3s;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.single-box1 {
    background: linear-gradient(135deg, #f093fb, #f5576c);
}

.single-box:hover, .single-box1:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 25px rgba(0, 0, 0, 0.2);
}

.img-area {
    width: 100px;
    height: 100px;
    display: flex;
    justify-content: center;
    align-items: center;
    border: 6px solid #fff;
    border-radius: 50%;
    margin-bottom: 15px;
    overflow: hidden;
}

.img-area img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
}

.header-text, .header-text1 {
    font-size: 24px;
    font-weight: 700;
    margin-bottom: 10px;
}

.line, .line1 {
    font-size: 16px;
    color: #ddd;
}

.single-box h3, .single-box1 h3 {
    margin: 10px 0;
    font-size: 18px;
}

.single-box p, .single-box1 p {
    font-size: 15px;
    font-weight: 400;
    line-height: 1.6;
}

.single-box button, .single-box1 button {
    margin-top: 20px;
    padding: 10px 20px;
    background-color: #fff;
    color: #007bff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s, color 0.3s;
}

.single-box button a, .single-box1 button a {
    text-decoration: none;
    color: inherit;
}

.single-box button:hover, .single-box1 button:hover {
    background-color: #007bff;
    color: #fff;
}

.box-area, .box-container1 {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
    padding: 20px;
}

@media (max-width: 768px) {
    .single-box, .single-box1 {
        width: 90%;
        margin: 10px;
    }

    .navbar-custom .navbar-brand {
        font-size: 20px;
    }

    .navbar-custom .navbar-nav .nav-link {
        font-size: 14px;
    }
}

    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light navbar-custom">
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
                    <a class="nav-link" href="index.php">Contact-nous</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Mon Compte
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="myprofileDem.php">Mon espace personnel</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <main>
        <div class="box-area">
            <?php while ($row = mysqli_fetch_assoc($ss)) { ?>
                <div class="single-box">
                    <div class="img-area">
                        <img src="img/<?php echo $row['logo_entrp']; ?>" alt="Logo de <?php echo $row['nom_entrp']; ?>">
                    </div>
                    <div class="img-text">
                        <span class="header-text"><strong><?php echo $row['nom_entrp']; ?></strong></span>
                        <h3><?php echo $row['date_limite']; ?></h3>
                        <button><a href="offres_cree_par_entreprice.php?id=<?php echo $row['offreE_id']; ?>">Voir</a></button>
                    </div>
                </div>
            <?php } ?>
        </div>
    </main>
    <main class="par">
        <div class="box-container1">
            <?php while ($col = mysqli_fetch_assoc($hh)) { ?>
                <div class="single-box1">
                    <div class="img-text1">
                        <span class="header-text1"><strong><?php echo $col['titre']; ?></strong></span>
                        <h3><?php echo $col['description']; ?></h3>
                        <p><?php echo $col['date_limite']; ?></p>
                        <button><a href="offres_cree_par_particulier.php?id=<?php echo $col['offreP_id']; ?>">Voir</a></button>
                    </div>
                </div>
            <?php } ?>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
