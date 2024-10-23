<?php
include_once "connection.php";
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $id = $_GET["id"];
    $info_offre = "SELECT * FROM `publicationsoffresp` WHERE `offreP_id`=$id";
    $ff = mysqli_query($con,$info_offre);
    $mail_query = "SELECT particulier.email 
    FROM publicationsoffresp
    INNER JOIN particulier
    ON publicationsoffresp.particulier_id = particulier.id_particulier
    WHERE publicationsoffresp.offreP_id = $id";

$result_mail = mysqli_query($con, $mail_query);
if ( $info_offre && $result_mail){

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre Page</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styledem.css">
    <link rel="stylesheet" href="bootstrap-4.0.0\assets\css\docs.min.css">
    <style>
        .navbar-custom {
            width: 100%;
            margin: auto;
        }
       /* Import Font Dancing Script */
@import url(https://fonts.googleapis.com/css?family=Dancing+Script);

* {
  margin: 0;
}

body {
  background-color: #e8f5ff;
  font-family: Arial;
  overflow: hidden;
}

/* NavbarTop */
.navbar-top {
  background-color: #fff;
  color: #333;
  box-shadow: 0px 4px 8px 0px grey;
  height: 70px;
}

.title {
  font-family: "Dancing Script", cursive;
  padding-top: 15px;
  position: absolute;
  left: 45%;
}

.navbar-top ul {
  float: right;
  list-style-type: none;
  margin: 0;
  overflow: hidden;
  padding: 18px 50px 0 40px;
}

.navbar-top ul li {
  float: left;
}

.navbar-top ul li a {
  color: #333;
  padding: 14px 16px;
  text-align: center;
  text-decoration: none;
}

.icon-count {
  background-color: #ff0000;
  color: #fff;
  float: right;
  font-size: 11px;
  left: -25px;
  padding: 2px;
  position: relative;
}

/* End */

/* Sidenav */
.sidenav {
  background-color: #fff;
  color: #333;
  border-bottom-right-radius: 25px;
  height: 86%;
  left: 0;
  overflow-x: hidden;
  padding-top: 20px;
  position: absolute;
  top: 70px;
  width: 250px;
}

.profile {
  margin-bottom: 20px;
  margin-top: -12px;
  text-align: center;
}

.profile img {
  border-radius: 50%;
  box-shadow: 0px 0px 5px 1px grey;
}

.name {
  font-size: 20px;
  font-weight: bold;
  padding-top: 20px;
}

.job {
  font-size: 16px;
  font-weight: bold;
  padding-top: 10px;
}

.url,
hr {
  text-align: center;
}

.url hr {
  margin-left: 20%;
  width: 60%;
}

.url a {
  color: #818181;
  display: block;
  font-size: 20px;
  margin: 10px 0;
  padding: 6px 8px;
  text-decoration: none;
}

.url a:hover,
.url .active {
  background-color: #e8f5ff;
  border-radius: 28px;
  color: #000;
  margin-left: 14%;
  width: 65%;
}

/* End */

/* Main */
.main {
  margin-top: 2%;
  margin-left: 29%;
  font-size: 28px;
  padding: 0 10px;
  width: 58%;
}

.main h2 {
  color: #333;
  font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
  font-size: 24px;
  margin-bottom: 10px;
}

.main .card {
  background-color: #fff;
  border-radius: 18px;
  box-shadow: 1px 1px 8px 0 grey;
  height: auto;
  margin-bottom: 20px;
  padding: 20px 0 20px 50px;
}

.main .card table {
  border: none;
  font-size: 16px;
  height: 270px;
  width: 80%;
}

.edit {
  position: absolute;
  color: #e7e7e8;
  right: 14%;
}

.social-media {
  text-align: center;
  width: 90%;
}

.social-media span {
  margin: 0 10px;
}

.fa-facebook:hover {
  color: #4267b3 !important;
}

.fa-twitter:hover {
  color: #1da1f2 !important;
}

.fa-instagram:hover {
  color: #ce2b94 !important;
}

.fa-invision:hover {
  color: #f83263 !important;
}

.fa-github:hover {
  color: #161414 !important;
}

.fa-whatsapp:hover {
  color: #25d366 !important;
}

.fa-snapchat:hover {
  color: #fffb01 !important;
}
.info-container {
    display: flex;
    align-items: center;
}

.profile {
    margin-right: 20px;
}
.main{
   margin-left: 350px;
}
/* End */

    </style>
</head>
<body>
    <!-- Barre de navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-custom">
        <a class="navbar-brand" href="#">
            <img src="logo.jpg" class="logo" alt="Logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>
    <div class="main">
        <h2>INFORMATION</h2>
        <?php while ($row = mysqli_fetch_assoc($ff)) {
           $mail_row = mysqli_fetch_assoc($result_mail);
        ?>
        <div class="card">
            <div class="card-body">
                 <div class="info-container"> 
                
                    <table>
                        <tbody>
                            <tr>
                                <td>Titre</td>
                                <td>:</td>
                                <td><?php echo $row['titre']; ?></td>
                            </tr>
                            <tr>
                                <td>Description</td>
                                <td>:</td>
                                <td><?php echo $row['description']; ?></td>
                            </tr>
                            <tr>
                                <td>Exigences</td>
                                <td>:</td>
                                <td><?php echo $row['exigences']; ?></td>
                            </tr>
                            <tr>
                                <td>Date_limite</td>
                                <td>:</td>
                                <td><?php echo $row['date_limite']; ?></td>
                            </tr>
                            <tr>
                                <td>Email de particulier</td>
                                <td>:</td>
                                <td><?php echo isset($mail_row['email']) ? $mail_row['email'] : "N/A"; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>


</body>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php
    } else {
        // Gérer les erreurs si la requête échoue
        echo "Erreur lors de la récupération des données.";
    }
}