<?php
include_once "connection.php";
session_start();

$mail = mysqli_real_escape_string($con, $_SESSION["email"]);
$password = mysqli_real_escape_string($con, $_SESSION["password"]);
// $logo =  mysqli_real_escape_string($con,$_SESSION["logo"]);
// $nom = mysqli_real_escape_string($con,$_SESSION["nom"]);
$id_query = "SELECT id,nom,logo FROM entreprise WHERE email='$mail' and password='$password'";

$result = mysqli_query($con, $id_query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $id_p = $row['id'];
    $logo = $row['logo'];
    $nom = $row["nom"];
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $titre = mysqli_real_escape_string($con, $_POST["titre"]);
        $description = mysqli_real_escape_string($con, $_POST["description"]); 
        $exigences = mysqli_real_escape_string($con, $_POST["exigences"]); 
        $date_limite = mysqli_real_escape_string($con, $_POST["date_limite"]); 
        $offre_part = "INSERT INTO `publicationsoffrese`( `entreprise_id`, `titre`, `description`, `exigences`, `date_limite`, `logo_entrp`, `nom_entrp`) VALUES ('$id_p','$titre','$description','$exigences','$date_limite','$logo','$nom')";
        
        if (mysqli_query($con, $offre_part)) {
            header("location:entreprise_voir_plus.php");
            exit(); // Add exit to stop further execution
        } else {
            // Handle errors
            echo "Erreur : " . mysqli_error($con);
        }
    }
} else {
    // Handle errors if the query fails
    echo "Erreur : " . mysqli_error($con);
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer une offre</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
   
   <style>
.container {
    margin-top: 50px;
    width: 50%;
}

.form-group {
    margin-bottom: 20px;
}

label {
    font-weight: bold;
}

.btn-primary {
    background-color: #007bff;
    border-color: #007bff;
}

.btn-primary:hover {
    background-color: #0056b3;
    border-color: #0056b3;
}

.btn-primary:focus {
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.5);
}
body {
    font-family: Arial, sans-serif;
    background-color: #f8f9fa;
    margin: 0;
    padding: 0;
}

.container {
    margin-top: 50px;
    width: 50%;
    background-color: #ffffff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    margin: 0 auto;
    max-width: 600px;
}

h2 {
    color: #007bff;
    text-align: center;
}

.form-group {
    margin-bottom: 20px;
}

label {
    font-weight: bold;
}

.btn-primary {
    background-color: #007bff;
    border-color: #007bff;
    width: 100%;
}

.btn-primary:hover {
    background-color: #0056b3;
    border-color: #0056b3;
}

.btn-primary:focus {
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.5);
}

@media (max-width: 768px) {
    .container {
        width: 80%;
    }
}

@media (max-width: 576px) {
    .container {
        width: 90%;
    }
}
   </style>
</head>
<body>
    <div class="container">
        <h2>Créer une offre</h2>
        <form action="cree_offer_entreprise.php" method="post">
            <div class="form-group">
                <label for="titre">Titre de l'offre :</label>
                <input type="text" class="form-control" id="titre" name="titre" required>
            </div>
            <div class="form-group">
                <label for="description">Description :</label>
                <textarea class="form-control" id="description" name="description" rows="5" required></textarea>
            </div>
            <div class="form-group">
                <label for="exigences">Exigences :</label>
                <textarea class="form-control" id="exigences" name="exigences" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="date_limite">Date limite :</label>
                <input type="date" class="form-control" id="date_limite" name="date_limite" required>
            </div>
            <button type="submit" class="btn btn-primary">Créer l'offre</button>
        </form>
    </div>
</body>
</html>
