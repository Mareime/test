<?php
session_start();
if (!isset($_SESSION["admis_email"]) || !isset($_SESSION["admis_password"]) || !isset($_SESSION["admis"])) {
    header("Location: login.php");
    exit();
}

include("connection.php");

$bool = false;
$errors = [];

if (isset($_POST["btn_search"])) {
    $search = $_POST["search"];
    $search_query = "SELECT * FROM particulier WHERE nom LIKE ? OR prenom LIKE ? OR email LIKE ? OR tel LIKE ?";
    $stmt = $con->prepare($search_query);
    $search_param = "%" . $search . "%";
    $stmt->bind_param("ssss", $search_param, $search_param, $search_param, $search_param);
    $stmt->execute();
    $search_result = $stmt->get_result();
    $num_rows = $search_result->num_rows;
    if ($num_rows > 0) {
        $bool = true;
    }
    $stmt->close();
}

$select_particulier = "SELECT * FROM particulier";
$squery = mysqli_query($con, $select_particulier);

if (isset($_POST["delete"])) {
    $id_particulier = $_POST["id_particulier"];
    $delete_query = "DELETE FROM particulier WHERE id_particulier = ?";
    $stmt = $con->prepare($delete_query);
    $stmt->bind_param("i", $id_particulier);
    if (!$stmt->execute()) {
        $errors[] = "Error deleting record: " . $stmt->error;
    } else {
        header("Location: admis_particulier.php");
        exit();
    }
    $stmt->close();
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>particulier</title>
    <!-- ======= Styles ======= -->
    <link rel="stylesheet" href="admis_home.css">

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
            <div class="ajoute" style="transform:translate(50%);margin-top:19px;display:inline-block;">
                    <a href="admis_ajoute_particulier.php" style="text-decoration: none;color: white;background-color: #2a2185;padding: 10px;border-radius: 30px;">Ajoute</a>
                </div>



            <div class="card-body">
                <div class="table-responsive">
                    <table style="width: 90%;">
                        <thead>
                            <th>id</th>
                            <th>nom</th>
                            <th>prenom</th>
                            <th>email</th>
                            <th>telephone</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <?php
                            if ($bool) {
                                while ($row_search = mysqli_fetch_assoc($search_result)) {
                            ?>
                                    <tr>
                                        <td><?php echo $row_search['id_particulier']; ?></td>
                                        <td><?php echo $row_search['nom']; ?></td>
                                        <td><?php echo $row_search['prenom']; ?></td>
                                        <td><?php echo $row_search['email']; ?></td>
                                        <td><?php echo $row_search['tel']; ?></td>
                                        
                                        <td class="td" >
                                            <form method="post" style="display:flex;" >
                                                <input type="hidden" name="id_particulier" value="<?php echo $row_search['id_particulier']; ?>">
                                                <input class="submit" type="submit" value="delete" name="delete"style="text-decoration: none;color: white;background-color: #2a2185;padding: 10px;border-radius: 30px; cursor: pointer; margin-right:5px;">
                                                <a href="admis_modifie_particulier.php?id=<?php echo $row_search['id_particulier']?>"style="text-decoration: none;color: white;background-color: #2a2185;padding: 10px;border-radius: 30px;">Update</a>
                                                <!-- <a href="admis_modifie_entreprise.php"> <button type="submit" class="submit showUpdateForm" name="show" value="Update">Update</button></a> -->

                                            </form>
                                        </td>
                                    </tr>
                                <?php
                                }
                            } else {
                                while ($row_search = mysqli_fetch_assoc($squery)) {
                                ?>
                                    <tr>
                                    <td><?php echo $row_search['id_particulier']; ?></td>
                                        <td><?php echo $row_search['nom']; ?></td>
                                        <td><?php echo $row_search['prenom']; ?></td>
                                        <td><?php echo $row_search['email']; ?></td>
                                        <td><?php echo $row_search['tel']; ?></td>
                                        
                                        <td class="td" >
                                            <form method="post" style="display:flex;">
                                                <input type="hidden" name="id_particulier" value="<?php echo $row_search['id_particulier']; ?>">
                                                <input class="submit" type="submit" value="delete" name="delete"style="text-decoration: none;color: white;background-color: #2a2185;padding: 10px;border-radius: 30px; cursor: pointer; margin-right:5px;">
                                                <a href="admis_modifie_particulier.php?id=<?php echo $row_search['id_particulier']?>"style="text-decoration: none;color: white;background-color: #2a2185;padding: 10px;border-radius: 30px;">Update</a>

                                                <!-- <a href="admis_modifie_entreprise.php"> <button type="submit" class="submit showUpdateForm" name="show" value="Update">Update</button></a>  -->
                                            </form>
                                        </td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- <div class="error-message"></div> -->

        </div>

        <script src="assets/js/main.js"></script>
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
        <!-- ====== ionicons ======= -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



    </div>
    <!-- <script>
    $(document).ready(function() {
        $('form').submit(function(event) {
            event.preventDefault();
            $.ajax({
                type: $(this).attr('method'),
                url: $(this).attr('action'),
                data: $(this).serialize(),
                success: function(response) {
                    // Check if there are errors
                    if (response.errors.length > 0) {
                        // Display errors to the user
                        var errorMessage = '<div class="alert alert-danger">';
                        response.errors.forEach(function(error) {
                            errorMessage += '<p>' + error + '</p>';
                        });
                        errorMessage += '</div>';
                        $('.error-message').html(errorMessage);
                    } else {
                        // Handle success
                    }
                }
            });
        });
    }); -->
</script>
  <!-- ====== ionicons ======= -->
         <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>