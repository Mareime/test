<?php
include("connection.php");

// Initialize errors array
$errors = [];

// Check if the 'id' parameter is set
if (isset($_GET['id'])) {
    $id_entreprise = mysqli_real_escape_string($con, $_GET['id']);
    $select = "SELECT * FROM entreprise WHERE id = $id_entreprise";
    $results = mysqli_query($con, $select);

    if ($results) {
        $result = mysqli_fetch_assoc($results);
    } else {
        $errors[] = "Error retrieving record: " . mysqli_error($con);
    }
} else {
    $errors[] = "ID not provided.";
}

if (isset($_POST['modifier'])) {
    $nom = mysqli_real_escape_string($con, $_POST["Name"]);
    $adresse = mysqli_real_escape_string($con, $_POST["adresse"]);
    $code_postal = mysqli_real_escape_string($con, $_POST["code_postal"]);
    $tel = mysqli_real_escape_string($con, $_POST["tel"]);
    $email = mysqli_real_escape_string($con, $_POST["email"]);
    $password = mysqli_real_escape_string($con, $_POST["password"]);
    $description = mysqli_real_escape_string($con, $_POST["description"]);
    $site_web=mysqli_real_escape_string($con, $_POST["site_web"]);
    $image = $_FILES['image']['name'];

    // Renommer et déplacer le fichier image téléchargé
    if ($image) {
        $imageExtension = strtolower(pathinfo($image, PATHINFO_EXTENSION));
        $newImageName = $nom . substr($tel, 0, 4) . "." . $imageExtension;
        $imageDestination = "img/" . $newImageName;
        if (!move_uploaded_file($_FILES['image']['tmp_name'], $imageDestination)) {
            $errors[] = "Error uploading image.";
        }
    }

    // Construction de la requête SQL d'update
    $modifier_entreprise = "UPDATE entreprise SET 
                            nom='$nom', 
                            adresse='$adresse', 
                            code_postal='$code_postal', 
                            tel='$tel', 
                            email='$email', 
                            password='$password', 
                            description='$description',site_web='$site_web'";

    if ($image) {
        $modifier_entreprise .= ", logo='$newImageName'";
    }

    $modifier_entreprise .= " WHERE id = $id_entreprise";

    if (!mysqli_query($con, $modifier_entreprise)) {
        $errors[] = "Error updating record: " . mysqli_error($con);
    } else {
        header("Location: admis_entreprise.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Demandeur</title>
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
                    <h2>Modifier entreprise</h2>
                </div>
                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li><?php echo htmlspecialchars($error); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <form method="post" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="companyName">Nom de entreprise</label>
                            <input type="text" class="form-control" id="companyName" name="Name" value="<?php echo htmlspecialchars($result["nom"]); ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="prenom">Adresse</label>
                            <input type="text" class="form-control" id="adresse" name="adresse" value="<?php echo htmlspecialchars($result["adresse"]); ?>" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="domaine">Description</label>
                            <input type="text" class="form-control" id="description" name="description" value="<?php echo htmlspecialchars($result["description"]); ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="tel">Téléphone</label>
                            <input type="number" class="form-control" id="tel" name="tel" value="<?php echo htmlspecialchars($result["tel"]); ?>" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($result["email"]); ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="password">Mot de passe</label>
                            <input type="password" class="form-control" id="password" name="password" value="<?php echo htmlspecialchars($result["password"]); ?>" required>
                            <label for="password">site_web</label>
                            <input type="url" class="form-control" id="password" name="site_web" value="<?php echo htmlspecialchars($result["site_web"]); ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="code_postal">Code Postal</label>
                            <input type="number" class="form-control" id="code_postal" name="code_postal" value="<?php echo htmlspecialchars($result["code_postal"]); ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="image">Image</label>
                            <input type="file" class="form-control" id="image" name="image" accept=".jpg, .jpeg, .png">
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary" name="modifier" value="Modifier">
                </form>
                <div id="errorContainer" class="alert alert-danger" style="display: none;"></div>
                <div id="successMessage" class="alert alert-success" style="display: none;">Record updated successfully!</div>
            </div>
        </div>
    </div>

    <script src="assets/js/main.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
