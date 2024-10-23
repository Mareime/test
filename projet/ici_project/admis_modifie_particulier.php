<?php
include("connection.php");

// Check if the 'id' parameter is set
if (isset($_GET['id'])) {
    $id_particulier = mysqli_real_escape_string($con, $_GET['id']);
    $select = "SELECT * FROM particulier WHERE id_particulier = $id_particulier";
    $results = mysqli_query($con, $select);

    if ($results) {
        $result = mysqli_fetch_assoc($results);
    } else {
        $errors[] = "Error retrieving record: " . mysqli_error($con);
    }
} else {
    $errors[] = "ID not provided.";
}

$errors = [];

if (isset($_POST['modifier'])) {
    $nom = mysqli_real_escape_string($con, $_POST["companyName"]);
    $prenom = mysqli_real_escape_string($con, $_POST["prenom"]);
    $tel = mysqli_real_escape_string($con, $_POST["tel"]);
    $email = mysqli_real_escape_string($con, $_POST["email"]);
    $password = mysqli_real_escape_string($con, $_POST["password"]);

    $modifier_particulier = "UPDATE particulier SET nom='$nom', prenom='$prenom', tel='$tel', email='$email', password='$password' WHERE id_particulier = $id_particulier";
    if (!mysqli_query($con, $modifier_particulier)) {
        $errors[] = "Error updating record: " . mysqli_error($con);
    } else {
       header("location:admis_particulier.php");
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
    <title>Modifier particulier</title>
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
                    <h2>Modifier particulier</h2>
                </div>
                <form method="post">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="companyName">Nom de Particulier</label>
                            <input type="text" class="form-control" id="companyName" name="companyName" value="<?php echo htmlspecialchars($result["nom"]); ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="prenom">Prenom</label>
                            <input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo htmlspecialchars($result["prenom"]); ?>" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="tel">Téléphone</label>
                            <input type="number" class="form-control" id="tel" name="tel" value="<?php echo htmlspecialchars($result["tel"]); ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($result["email"]); ?>" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="password">Mot de passe</label>
                            <input type="password" class="form-control" id="password" name="password" value="<?php echo htmlspecialchars($result["password"]); ?>" required>
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
    <script>
        // $(document).ready(function() {
        //     $('#modifierForm').submit(function(e) {
        //         e.preventDefault();

        //         var formData = $(this).serialize();

        //         $.ajax({
        //             url: 'modify_particulier.php',
        //             type: 'POST',
        //             data: formData,
        //             success: function(response) {
        //                 var responseData = JSON.parse(response);
        //                 if (responseData.success) {
        //                     $('#successMessage').show();
        //                     $('#errorContainer').hide();
        //                 } else {
        //                     $('#errorContainer').html('');
        //                     $.each(responseData.errors, function(index, error) {
        //                         $('#errorContainer').append('<p>' + error + '</p>');
        //                     });
        //                     $('#errorContainer').show();
        //                     $('#successMessage').hide();
        //                 }
        //             }
        //         });
        //     });
        // });
    </script>
      <!-- ====== ionicons ======= -->
      <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
