<?php
include_once "connection.php";
session_start();
$mail = mysqli_real_escape_string($con, $_SESSION["email"]);
$password = mysqli_real_escape_string($con, $_SESSION["password"]);

$id_query = "SELECT id_particulier FROM particulier WHERE email='$mail' and password='$password'";
$result = mysqli_query($con, $id_query);
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $id_p = $row['id_particulier'];
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $titre = mysqli_real_escape_string($con, $_POST["titre"]);
        $description = mysqli_real_escape_string($con, $_POST["description"]); 
        $exigences = mysqli_real_escape_string($con, $_POST["exigences"]); 
        $date_limite = mysqli_real_escape_string($con, $_POST["date_limite"]); 
        $offre_part = "INSERT INTO `publicationsoffresp`(`particulier_id`, `titre`, `description`, `exigences`, `date_limite`) VALUES ('$id_p','$titre','$description','$exigences','$date_limite')";
        
        if (mysqli_query($con, $offre_part)) {
            echo "<script>alert('Offre créée avec succès!'); window.location.href='pour_particulier.php';</script>";
        } else {
            echo "<script>alert('Erreur lors de la création de l\'offre.'); window.location.href='cree_offer_particulier.php';</script>";
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
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .container {
            margin-top: 50px;
            background-color: #f8f9fa;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
        }

        h2 {
            color: #007bff;
            text-align: center;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        label {
            font-weight: bold;
        }

        .form-control {
            border: 1px solid #ced4da;
            border-radius: 5px;
            padding: 12px;
            font-size: 16px;
            transition: border-color 0.3s ease-in-out;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            width: 100%;
            padding: 12px;
            font-size: 18px;
            transition: background-color 0.3s ease-in-out;
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
                padding: 20px;
            }
        }

        @media (max-width: 576px) {
            .container {
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Créer une offre particulier</h2>
        <form action="cree_offer_particulier.php" method="post">
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
    <script src="main.js"></script>
</body>
</html>
