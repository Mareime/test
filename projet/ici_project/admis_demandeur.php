<?php
session_start();
if (!$_SESSION["admis_email"] &&  !$_SESSION["admis_password"] && !$_SESSION["admis"]) {
    header("Location: login.php");
} 
include("connection.php");

$bool = false;
if (isset($_POST["btn_search"])) {
    $search = $_POST["search"];
    $search_query = "SELECT * FROM demandeur WHERE nom LIKE '%$search%' OR prenom LIKE '%$search%' OR domain LIKE '%$search%'";
    $search_result = mysqli_query($con, $search_query);
    $num_rows = mysqli_num_rows($search_result);
    if ($num_rows > 0) {
        $bool = true;
    }
}



$select_demandeur = "SELECT * FROM demandeur";
$squery = mysqli_query($con, $select_demandeur);
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entreprise</title>
    <!-- ======= Styles ======= -->
    <link rel="stylesheet" href="admis_home.css">
</head>
<style>

</style>
</style>

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
            </ul>>
           
        </div>

        <!-- ========================= Main ==================== -->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                <div class="search">
                    <form method="post">
                        <input type="text" placeholder="Search here" name="search" class="se" style="border: 1px solid #2a2185;padding: 10px;width: 300px;border-radius: 20px;">
                        <button type="submit" name="btn_search" style="text-decoration: none;color: white;background-color: #2a2185;padding: 10px;border-radius: 30px;cursor: pointer;">Search</button>
                    </form>
                </div>

                <div class="user">
                    <img src="logo.jpg" alt="Admin">
                </div>
            </div>

            <!-- ================ Order Details List ================= -->

            <div class="card-body">
                <div class="table-responsive">
                    <table>
                        <thead>
                            <th>id</th>
                            <th>nom</th>
                            <th>prenom</th>
                            <th>domaine</th>
                            <th>email</th>
                            <th>adresse</th>
                            <th>Photo</th>
                            <th>regarde</th>
                            <th>Telecharger</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <?php
                            if ($bool) {
                                while ($row_search = mysqli_fetch_assoc($search_result)) {
                                    $file = $row_search['cv'];
                                    $fileUrl = "http://localhost/pdf/" . $file;
                            ?>
                                    <tr>
                                        <td><?php echo $row_search['id_demandeur']; ?></td>
                                        <td><?php echo $row_search['nom']; ?></td>
                                        <td><?php echo $row_search['prenom']; ?></td>
                                        <td><?php echo $row_search['domain']; ?></td>
                                        <td><?php echo $row_search['email']; ?></td>
                                        <td><?php echo $row_search['adresse']; ?></td>
                                        <td><img src="img/<?php echo $row_search['image']; ?>" width="100"></td>
                                        <td><a href="pdf/<?php echo $file; ?>">View</a></td>
                                        <td><a href="pdf/<?php echo $file; ?>" download>Download</a></td>
                                        <td>
                                        <form method="post" style="display:flex">
                                                <input type="hidden" name="id_demandeur" value="<?php echo $row_search['id_demandeur']; ?>">
                                                <input type="submit" class="submit" type="submit" id="delete" onclick='deleteIntervenant("<?php echo $row_search["id_demandeur"]; ?>")'  value="delete" name="delete" style="text-decoration: none;color: white;background-color: #2a2185;padding: 10px;border-radius: 30px; cursor: pointer;">
                                                <a href="admis_modifie_demandeur.php?id=<?php echo $row_search['id_demandeur']?>"style="text-decoration: none;color: white;background-color: #2a2185;padding: 10px;border-radius: 30px;">Update</a>
                                            </form>
                                        </td>
                                    </tr>
                                <?php
                                }
                            } else {

                                while ($row_search = mysqli_fetch_assoc($squery)) {
                                    $file = $row_search['cv'];
                                    // $fileUrl = "http://localhost/demander/pdf/" . $file;
                                ?>
                                    <tr>
                                        <td><?php echo $row_search['id_demandeur']; ?></td>
                                        <td><?php echo $row_search['nom']; ?></td>
                                        <td><?php echo $row_search['prenom']; ?></td>
                                        <td><?php echo $row_search['domain']; ?></td>
                                        <td><?php echo $row_search['email']; ?></td>
                                       
                                        <td><?php echo $row_search['adresse']; ?></td>
                                        <td><img src="img/<?php echo $row_search['image']; ?>" width="100"></td>
                                        <td><a href="pdf/<?php echo $file; ?>">View</a></td>
                                        <td><a href="pdf/<?php echo $file; ?>" download>Download</a></td>
                                        <td>
                                        <form method="post" style="display:flex">
                                                <input type="hidden" name="id_demandeur" value="<?php echo $row_search['id_demandeur']; ?>">
                                                <input type="submit" class="submit" type="submit" onclick='deleteIntervenant("<?php echo $row_search["id_demandeur"]; ?>")' id="delete" value="delete" name="delete"style="text-decoration: none;color: white;background-color: #2a2185;padding: 10px;border-radius: 30px; cursor: pointer;">
                                                <a href="admis_modifie_demandeur.php?id=<?php echo $row_search['id_demandeur']?>"style="text-decoration: none;color: white;background-color: #2a2185;padding: 10px;border-radius: 30px;">Update</a>
                                            </form>
                                        </td>
                                    </tr>
                            <?php     }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <script src="assets/js/main.js"></script>
        <!-- ====== ionicons ======= -->
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    </div>
    <script>
        function deleteIntervenant(id) {
            if (confirm("Are you sure you want to delete this user?")) {
            // AJAX request
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "admis_demandeur.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Request was successful, reload the page
                        window.location.reload();
                    } else {
                        // Request failed, handle error
                        console.error("Error deleting user:", xhr.responseText);
                    }
                }
            };
            xhr.send("delete_id=" + id);
        }
    }

    </script>
    <script src="main.js"></script>

<!-- ====== ionicons ======= -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>


</html>
<?php
// Add this at the top of your PHP code
if(isset($_POST["delete_id"])) {
    $id_demandeur = $_POST["delete_id"];
    $delete_query = "DELETE FROM demandeur WHERE id_demandeur = '$id_demandeur'";
    if(mysqli_query($con, $delete_query)) {
        header("location:admis_demandeur.php");
        // exit; // Exiting to prevent further execution
    } else {
        // Error deleting user
        exit; // Exiting to prevent further execution
    }
}
?>
