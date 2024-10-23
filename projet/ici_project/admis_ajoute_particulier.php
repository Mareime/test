<?php
include("connection.php");

if (isset($_POST['ajoute'])) {
    $nom = $_POST["companyName"];
    $prenom = $_POST["prenom"];
    $tel = $_POST["tel"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    // Prepare an insert statement
    $stmt = "INSERT INTO `particulier`(`nom`, `prenom`, `tel`, `email`, `password`) VALUES ('$nom', '$prenom', '$tel', '$email', '$password')";
   if(mysqli_query($con,$stmt)){
    header("location:admis_particulier.php");
   }
    
   
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter Particulier</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="admis_modifie_entreprise.css">
</head>
<body>
    <div class="container">
        <div class="navigation">
        <ul>
                <li>
                    <a href="home.php">
                        <img src="logo.jpg" alt="Logo" style="width: 254px;height: 66px;">
                    </a>
                </li>

                <li>
                    <a href="admis_home.php">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
                
                <li>
                    <a href="admis_entreprise.php">
                        <span class="icon">
                        <ion-icon name="business-outline"></ion-icon>
                        </span>
                        <span class="title">Entreprise</span>
                    </a>
                </li>
                <li>
                    <a href="admis_particulier.php">
                        <span class="icon">
                        <ion-icon name="person-circle-outline"></ion-icon>                        </span>
                        <span class="title">Particulier</span>
                    </a>
                </li>
                <li>
                    <a href="admis_demandeur.php">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">Demandaire</span>
                    </a>
                </li>
                <li>
                    <a href="login.php">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span class="title">Sign Out</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="main">
            <div class="topbar">
                <div class="toggle"><ion-icon name="menu-outline"></ion-icon></div>
            </div>

            <div class="form-containere">
                <div class="form-header">
                    <h2>Ajouter Particulier</h2>
                </div>
                <form method="post" action="admis_ajoute_particulier.php">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="companyName">Nom de l'entreprise</label>
                            <input type="text" class="form-control" id="companyName" name="companyName" placeholder="Nom" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="prenom">Prenom</label>
                            <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Prenom" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="tel">Téléphone</label>
                            <input type="tel" class="form-control" id="tel" name="tel" placeholder="Téléphone" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="password">Mot de passe</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe" required>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary" name="ajoute" value="Ajouter">
                </form>
                <div id="errorMessages" class="alert alert-danger" style="display: none;"></div>
            </div>
        </div>
    </div>

    <script src="assets/js/main.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>
