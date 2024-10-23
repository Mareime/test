<?php
// Include the database connection file
require_once 'connection.php';

if (isset($_POST["ajoute"])) {
    // Get form data
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $website = $_POST['website'];
    $password = $_POST['password'];
    $description = $_POST['description'];
    $adresse = $_POST['adresse'];
    $code_postal=$_POST["code_postal"];
    // Initialize an array to hold error messages
    $errors = [];

    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image_name = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_extension = pathinfo($image_name, PATHINFO_EXTENSION);

        // Generate unique image name based on entreprise name and first 4 digits of phone number
        $company_name = preg_replace('/\s+/', '_', $nom); // Replace spaces with underscores
        $phone_prefix = substr($phone, 0, 4); // Get first 4 digits of phone number
        $new_image_name = $company_name . '_' . $phone_prefix . '.' . $image_extension; // Unique filename

        // Destination folder for the image
        $folder = 'img/' . $new_image_name;

        // Move uploaded image to destination
        if (move_uploaded_file($image_tmp, $folder)) {
            // Prepare SQL statement
            $sql = "INSERT INTO entreprise (nom, email, tel, site_web, password, logo, description, adresse,code_postal) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?)";
            if ($stmt = $con->prepare($sql)) {
                // Bind parameters
                $stmt->bind_param("ssssssssS", $nom, $email, $phone, $website, $password, $new_image_name, $description, $adresse);

                // Execute statement
                if ($stmt->execute()) {
                    // Success message or redirect to success page
                    header("Location: admis_entreprise.php");
                    exit;
                } else {
                    // Error executing SQL statement
                    $errors[] = "Error executing SQL statement: " . $stmt->error;
                }

                $stmt->close();
            } else {
                // Error preparing SQL statement
                $errors[] = "Error preparing SQL statement: " . $con->error;
            }
        } else {
            // Error moving uploaded file
            $errors[] = "Error moving uploaded file to destination. Check file permissions.";
        }
    } else {
        // No image uploaded or upload error
        $errors[] = "No image uploaded or upload error: " . $_FILES['image']['error'];
    }

    // Close database connection
    $con->close();

    // Display errors if any
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p>Error: $error</p>";
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter Entreprise</title>
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
                    <h2>Ajouter Entreprise</h2>
                </div>
                <form id="entrepriseForm" enctype="multipart/form-data" method="post" action="admis_ajoute_entreprise.php">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nom">Nom</label>
                            <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="phone">Téléphone</label>
                            <input type="tel" class="form-control" id="phone" name="phone" placeholder="Téléphone" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="website">Site Web</label>
                            <input type="url" class="form-control" id="website" name="website" placeholder="URL">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="password">Mot de passe</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe" required>
                            <label for="password">code_postal</label>
                            <input type="number" class="form-control" id="password" name="code_postal" placeholder="code_postal" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="logo">LOGO</label>
                            <input type="file" class="form-control" id="file" name="image" placeholder="Logo" accept=".jpeg, .jpg, .png">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="logo"><Address></Address></label>
                            <input type="text" class="form-control" id="adresse" name="adresse" placeholder="Adresse">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" cols="100" placeholder="Description"></textarea>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary" name="ajoute" value="Ajouter">  
                </form>
            </div>
        </div>
    </div>

    <script src="assets/js/main.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>
