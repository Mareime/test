<?php
session_start();
include_once "connection.php";
// Récupérer les informations de l'utilisateur connecté
$mail =  $_SESSION["mail"];
$pasw = $_SESSION["passwrd"];

// Récupérer les informations du demandeur à partir de la base de données
$query = "SELECT * FROM `demandeur` WHERE email='$mail' and password='$pasw'";
$result = mysqli_query($con, $query);

// if (!$result || mysqli_num_rows($result) == 0) {
//     // Rediriger vers la page de connexion si les informations de l'utilisateur ne sont pas valides
//     header("Location: login.php");
//     exit();
// }

$user = mysqli_fetch_assoc($result);

// Récupérer l'ID du demandeur
$sessionId = $user['id_demandeur'];
$_SESSION["id"] = $sessionId;
// Vérifier si une image est disponible, sinon utiliser une image par défaut
$image = $user["image"] ? $user["image"] : "noprofile.jpg";

// Vérifier si le demandeur a déjà un CV enregistré
$cv_query = "SELECT cv FROM `demandeur` WHERE id_demandeur = $sessionId";
$cv_result = mysqli_query($con, $cv_query);
$has_cv = false;

if ($cv_result && mysqli_num_rows($cv_result) > 0) {
    $cv_data = mysqli_fetch_assoc($cv_result);
    $cv_path = $cv_data['cv'];
    $has_cv = !empty($cv_path);
}
$dem_cv = "SELECT cv FROM `demandeur` WHERE id_demandeur=$sessionId";
$cccv = mysqli_query($con,$dem_cv);
if($cccv){
    $destination = $cv_path;
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["save"])) {
    if (isset($_FILES["cv_file"]) && $_FILES["cv_file"]["error"] == 0) {
        $firstName = $user["prenom"];
        $lastName = $user["nom"];

        $cvExtension = strtolower(pathinfo($_FILES["cv_file"]["name"], PATHINFO_EXTENSION));

        $newCVName = $lastName . "_cv." . $cvExtension;
        $destination = "pdf/" . $newCVName;

        // Déplacer le fichier téléchargé vers le dossier "pdf" avec le nouveau nom
        if (move_uploaded_file($_FILES["cv_file"]["tmp_name"], $destination)) {
            // Mettre à jour le chemin du CV dans la base de données si nécessaire
            $query = "UPDATE demandeur SET cv = '$newCVName' WHERE id_demandeur = $sessionId";
            if (mysqli_query($con, $query)) {
                // Rediriger vers la page de profil après avoir téléchargé et mis à jour le CV
                header("Location: profile.php");
                exit();
            } else {
                echo "Erreur lors de la mise à jour du CV dans la base de données.";
            }
        } else {
            echo "Erreur lors du téléchargement du fichier CV.";
        }
    } else {
        echo "Erreur lors du téléchargement du fichier CV.";
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
    $nom = $_POST["name"];
    $prenom = $_POST["prenom"];
    $tel = $_POST["telephone"];
    $adresse = $_POST["adresse"];
    $email = $_POST["email"];
    $domaine = $_POST["domaine"];

    // Mettre à jour les données dans la base de données
    $update_query = "UPDATE demandeur SET nom='$nom', prenom='$prenom', tel='$tel', adresse='$adresse', email='$email', domain='$domaine' WHERE id_demandeur=$sessionId";
    $update_result = mysqli_query($con, $update_query);

     if(!$update_result){
        echo "Erreur lors de la mise à jour des informations.";
    }
    header("Location: profile.php");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <!-- My CSS -->
    <link rel="stylesheet" href="styleDashbord-Demandaire.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <link rel="stylesheet" href="bootstrap-4.0.0\dist\css\bootstrap.min.css"> -->
    <title>Demandaire</title>
    <style>
   /* Ajoutez ces styles à votre feuille de style existante */

/* Styles pour le formulaire */
.form-container {
    background: #f8f8f8;
    padding: 20px;
    border-radius: 10px;
    width: 100%;
    max-width: 800px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
}

.profile-pic-container {
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 20px;
}

.profile-pic-container img {
    width: 150px;
    height: 150px;
    object-fit: cover;
    border-radius: 50%;
    border: 2px solid #2196F3; /* Changez la couleur de la bordure selon votre choix */
}

.upload {
    width: 125px;
    position: relative;
    margin: auto;
}

.upload .round {
    position: absolute;
    bottom: 0;
    right: 0;
    background: #00B4FF;
    width: 32px;
    height: 32px;
    line-height: 33px;
    text-align: center;
    border-radius: 50%;
    overflow: hidden;
}

.upload .round input[type="file"] {
    position: absolute;
    transform: scale(2);
    opacity: 0;
}

/* Styles pour la section de profil */
.form-section {
    flex: 2;
    margin: 10px;
}

.form-section h3 {
    text-align: center;
    margin-bottom: 20px;
}

.form-section .form-group {
    margin-bottom: 15px;
}

.form-section label {
    display: block;
    margin-bottom: 5px;
}

.form-section input[type="text"],
.form-section input[type="email"],
.form-section input[type="number"] {
    width: calc(100% - 20px);
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.form-section input[type="submit"] {
    background-color: #2196F3; /* Changez la couleur du bouton selon votre choix */
    width: calc(100% - 20px);
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    color: #fff;
    cursor: pointer;
}

.form-section button {
    width: 100%;
    padding: 10px;
    border: none;
    background-color: #2196F3; /* Changez la couleur du bouton selon votre choix */
    color: #fff;
    cursor: pointer;
    border-radius: 5px;
    margin-top: 10px;
}

.form-section button:hover {
    background-color: #0c7cd5; /* Changez la couleur du bouton au survol selon votre choix */
}

input[type="file"] {
    margin-top: 10px;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #fff;
}
/* Styles pour centrer le formulaire */
.profile-pic-container {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
}
/* Styles pour centrer le formulaire */
main {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh; /* Ajustez la hauteur selon vos besoins */
}

.form-container {
    background: #f8f8f8;
    padding: 20px;
    border-radius: 10px;
    width: 100%;
    max-width: 800px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}


    </style>
</head>
<body>
    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="#" class="brand">
            <i class='bx bxs-smile'></i>
            <span class="text">Dashboard</span>
        </a>
        <ul class="side-menu top">
    <li class="active">
        <a href="myprofileDem.php">
            <i class='bx bxs-dashboard'></i>
            <span class="text">Tableau de Bord</span>
        </a>
    </li>
    <li>
                <a href="profile.php">
                    <i class='bx bxs-user'></i>
                    <span class="text">Mon Profil</span>
                </a>
            </li>
            <li>
                <a href="logout.php">
                    <i class='bx bx-log-out'></i>
                    <span class="text">Déconnexion</span>
                </a>
            </li>
</ul>
    </section>

    <section id="content">
        <nav>
            <i class='bx bx-menu'></i>
            <form>
                <div hidden>
                    <div class="form-input">
                        <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
                    </div>
                </div>
            </form>
            <input type="checkbox" id="switch-mode" hidden>
            <label for="switch-mode" class="switch-mode" hidden></label>
            <a href="#" class="notification" hidden></a>
            <a href="#" class="profile">
                <img src="img/<?php echo $image; ?>">
            </a>
        </nav>
        <main>
            <div class="form-container">
                <div class="profile-pic-container">
                <form class="form" id = "form" action="" enctype="multipart/form-data" method="post">
      <div class="upload">
        <?php
        // session_start();
        $id = $user["id_demandeur"];
        $name = $user["email"];
        $image = $user["image"];
        $_SESSION["image"]=$user["image"];
        ?>
        <img src="img/<?php echo $image; ?>" width = 125 height = 125 title="<?php echo $image; ?>">
        <div class="round">
          <input type="hidden" name="id" value="<?php echo $id; ?>">
          <input type="hidden" name="name" value="<?php echo $name; ?>">
          <input type="file" name="image" id = "image" accept=".jpg, .jpeg, .png">
          <i class = "fa fa-camera" style = "color: #fff;"></i>
        </div>
      </div>
    </form>
    <script type="text/javascript">
      document.getElementById("image").onchange = function(){
          document.getElementById("form").submit();
      };
    </script>
<?php
if (isset($_FILES["image"]["name"])) {
    $id = $_POST["id"];
    // Récupérer le prénom et le nom du demandeur
    $firstName = $user["prenom"];
    $lastName = $user["nom"];

    $imageName = $_FILES["image"]["name"];
    $imageSize = $_FILES["image"]["size"];
    $tmpName = $_FILES["image"]["tmp_name"];

    // Image validation
    $validImageExtension = ['jpg', 'jpeg', 'png'];
    $imageExtension = explode('.', $imageName);
    $imageExtension = strtolower(end($imageExtension));

    if (!in_array($imageExtension, $validImageExtension)) {
        echo "<script>alert('Extension d'image non valide');</script>";
    } elseif ($imageSize > 1200000) {
        echo "<script>alert('La taille de l'image est trop grande');</script>";
    } else {
        // Récupérer les 4 premiers chiffres du numéro de téléphone
        $phoneNumber = substr($user["tel"], 0, 4);
        
        // Générer le nouveau nom de l'image sans l'e-mail
        $newImageName =  $lastName . "_" . $phoneNumber . "." . $imageExtension;

        // Mettre à jour le nom de l'image dans la base de données
        $query = "UPDATE demandeur SET image = '$newImageName' WHERE id_demandeur = $id";
        mysqli_query($con, $query);

        // Déplacer le fichier téléchargé vers le dossier img avec le nouveau nom
        move_uploaded_file($tmpName, 'img/' . $newImageName);

        echo "<script>alert('L'image a été mise à jour avec succès');</script>";
        echo "<script>window.location.href = 'profile.php';</script>";
    }
}
?>
    <form method="post" enctype="multipart/form-data" action="profile.php">
    <label for="cv_file"><i class='bx bxs-cloud-download' ></i></label>
    <input type="file" name="cv_file" id="cv_file" accept=".pdf">
    <input type="submit" value="Save" name="save">
</form>
<button>
        <a class="button" href="pdf/<?php echo $destination; ?>">Voir CV</a>
    </button>

                </div>
                <div class="form-section">
                    <h3>Informations personnelles</h3>
                    <form id="profile-form" method="post" action="profile.php">
                        <div class="form-group">
                            <label for="name">Nom:</label>
                            <input type="text" id="name" name="name" value="<?php echo $user["nom"] ?>"required>
                        </div>
                        <div class="form-group">
                            <label for="prenom">Prenom:</label>
                            <input type="text" id="prenom" name="prenom" value="<?php echo $user["prenom"] ?>"required>
                        </div>
                        <div class="form-group">
                            <label for="telephone">Telephone:</label>
                            <input type="number" id="telephone" name="telephone"value="<?php echo $user["tel"] ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="adresse">Adresse:</label>
                            <input type="text" id="adresse" name="adresse"value="<?php echo $user["adresse"] ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" value="<?php echo $user["email"] ?>"required>
                        </div>
                        <div class="form-group">
                            <label for="email">Domaine:</label>
                            <input type="text" id="email" name="domaine" value="<?php echo $user["domain"] ?>"required>
                        </div>
                        <div class="form-group">
                        <input type="submit" value="Save" name="update">
                        </div>
                    </form>
                </div>
            </div>
            </div>
        </main>
    </section>
	<script src="script.js"></script>
    <script>
document.addEventListener("DOMContentLoaded", function() {
    const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');

    allSideMenu.forEach(item => {
        item.addEventListener('click', function (event) {
            // Remove 'active' class from all menu items
            allSideMenu.forEach(i => {
                i.parentElement.classList.remove('active');
            });

            // Add 'active' class to the clicked menu item's parent <li>
            item.parentElement.classList.add('active');
        });
    });
});
</script>

</body>
</html>