<?php
include("connection.php");

// Initialize errors array
$errors = [];

// Check if the 'id' parameter is set
if (isset($_GET['id'])) {
    $id_demandeur = mysqli_real_escape_string($con, $_GET['id']);
    $select = "SELECT * FROM demandeur WHERE id_demandeur = $id_demandeur";
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
    $nom = mysqli_real_escape_string($con, $_POST["companyName"]);
    $prenom = mysqli_real_escape_string($con, $_POST["prenom"]);
    $domaine = mysqli_real_escape_string($con, $_POST["domaine"]);
    $tel = mysqli_real_escape_string($con, $_POST["tel"]);
    $email = mysqli_real_escape_string($con, $_POST["email"]);
    $password = mysqli_real_escape_string($con, $_POST["password"]);
    $adresse = mysqli_real_escape_string($con, $_POST["adresse"]);

    $cv = $_FILES['cv']['name'];
    $image = $_FILES['image']['name'];

    // Rename and move the uploaded CV file
    if ($cv) {
        $cvExtension = strtolower(pathinfo($cv, PATHINFO_EXTENSION));
        $newCVName = $nom . "_cv." . $cvExtension;
        $cvDestination = "pdf/" . $newCVName;
        move_uploaded_file($_FILES['cv']['tmp_name'], $cvDestination);
    }

    // Rename and move the uploaded image file
    if ($image) {
        $imageExtension = strtolower(pathinfo($image, PATHINFO_EXTENSION));
        $newImageName = $nom . substr($tel, 0, 4) . "." . $imageExtension;
        $imageDestination = "img/" . $newImageName;
        move_uploaded_file($_FILES['image']['tmp_name'], $imageDestination);
    }

    $modifier_demandeur = "UPDATE demandeur SET 
                            nom='$nom', 
                            prenom='$prenom', 
                            domain='$domaine', 
                            tel='$tel', 
                            email='$email', 
                            password='$password', 
                            adresse='$adresse'";

    if ($cv) {
        $modifier_demandeur .= ", cv='$newCVName'";
    }
    if ($image) {
        $modifier_demandeur .= ", image='$newImageName'";
    }

    $modifier_demandeur .= " WHERE id_demandeur = $id_demandeur";
    
    if (!mysqli_query($con, $modifier_demandeur)) {
        $errors[] = "Error updating record: " . mysqli_error($con);
    } else {
        header("location:admis_demandeur.php");
        exit;
    }
}

// Return errors if any
// echo json_encode(['success' => false, 'errors' => $errors]);
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
                    <h2>Modifier demandeur</h2>
                </div>
                <form method="post" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="companyName">Nom de Demandeur</label>
                            <input type="text" class="form-control" id="companyName" name="companyName" value="<?php echo htmlspecialchars($result["nom"]); ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="prenom">Prenom</label>
                            <input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo htmlspecialchars($result["prenom"]); ?>" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="domaine">Domaine</label>
                            <input type="text" class="form-control" id="domaine" name="domaine" value="<?php echo htmlspecialchars($result["domain"]); ?>" required>
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
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="cv">CV</label>
                            <input type="file" class="form-control" id="cv" name="cv" accept=".pdf" placeholder="<?php echo htmlspecialchars($result["cv"]); ?>" >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="image">Image</label>
                            <input type="file" class="form-control" id="image" name="image" accept=".jpg, .jpeg, .png">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="adresse">Adresse</label>
                            <input type="text" class="form-control" id="adresse" name="adresse" value="<?php echo $result["adresse"]; ?>">
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
