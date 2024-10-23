<?php
session_start();
if (!isset($_SESSION["admis_email"], $_SESSION["admis_password"], $_SESSION["admis"])) {
    header("Location: login.php");
    exit;
}

include("connection.php");

$bool = false;
$errors = [];

if (isset($_POST["btn_search"])) {
    $search = $_POST["search"];
    $search_query = "SELECT * FROM entreprise WHERE nom LIKE ? OR adresse LIKE ? OR code_postal LIKE ? OR tel LIKE ? OR site_web LIKE ?";
    $stmt = $con->prepare($search_query);
    $search_param = "%" . $search . "%";
    $stmt->bind_param("sssss", $search_param, $search_param, $search_param, $search_param,$search_param);
    $stmt->execute();
    $search_result = $stmt->get_result();
    $num_rows = $search_result->num_rows;
    if ($num_rows > 0) {
        $bool = true;
    }
    $stmt->close();
}

$select_entreprise = "SELECT * FROM entreprise";
$squery = $con->query($select_entreprise);

if (isset($_POST["delete"])) {
    $id_entreprise = $_POST["id_entreprise"];
    $delete_query = "DELETE FROM entreprise WHERE id = ?";
    $stmt = $con->prepare($delete_query);
    $stmt->bind_param("i", $id_entreprise);
    if (!$stmt->execute()) {
        $errors[] = "Error deleting record: " . $stmt->error;
    } else {
        header("Location: admis_entreprise.php");
        exit;
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
    <title>Entreprise</title>
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
                <div class="toggle"><ion-icon name="menu-outline"></ion-icon></div>
                <div class="search">
                    <form method="post">
                        <input type="text" placeholder="Search here" name="search" class="se" style="border: 1px solid #2a2185; padding: 10px; width: 300px; border-radius: 20px;">
                        <button type="submit" name="btn_search" style="text-decoration: none; color: white; background-color: #2a2185; padding: 10px; border-radius: 30px; cursor: pointer;">Search</button>
                    </form>
                </div>
                <div class="user">
                    <img src="logo.jpg" alt="Admin">
                </div>
            </div>
            <div class="ajoute" style="transform: translate(50%); margin-top: 19px; display: inline-block;">
                <a href="admis_ajoute_entreprise.php" style="text-decoration: none; color: white; background-color: #2a2185; padding: 10px; border-radius: 30px;">Ajoute</a>
            </div>
            
            <div class="card-body">
                <div class="table-responsive">
                    <table style="width: 90%;">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>nom</th>
                                <th>email</th>
                                <th>telephone</th>
                                <th>adresse</th>
                                <th>description</th>
                                <th>code postal</th>
                                <th>logo</th>
                                <th>site_web</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($bool) {
                                while ($row_search = $search_result->fetch_assoc()) {
                            ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($row_search['id']); ?></td>
                                        <td><?php echo htmlspecialchars($row_search['nom']); ?></td>
                                        <td><?php echo htmlspecialchars($row_search['email']); ?></td>
                                        <td><?php echo htmlspecialchars($row_search['tel']); ?></td>
                                        <td><?php echo htmlspecialchars($row_search['adresse']); ?></td>
                                        <td><?php echo htmlspecialchars($row_search['description']); ?></td>
                                        <td><?php echo htmlspecialchars($row_search['code_postal']); ?></td>
                                        <td><img src="img/<?php echo htmlspecialchars($row_search['logo']); ?>" alt="Logo" style="max-width: 100px;"></td>
                                        <td><?php echo htmlspecialchars($row_search['site_web']); ?></td>
                                        <td class="td">
                                        
                                            <form method="post">
                                                <input type="hidden" name="id_entreprise" value="<?php echo htmlspecialchars($row_search['id']); ?>">
                                                <input class="submit" type="submit" value="delete" name="delete" style="text-decoration: none; color: white; background-color: #2a2185; padding: 10px; border-radius: 30px; cursor: pointer;">
                                                <a href="admis_modifie_entreprise.php?id=<?php echo htmlspecialchars($row_search['id']); ?>" style="text-decoration: none; color: white; background-color: #2a2185; padding: 10px; border-radius: 30px;">Update</a>
                                            </form>
                                        </td>
                                    </tr>
                                <?php
                                }
                            } else {
                                while ($row = $squery->fetch_assoc()) {
                                ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                                        <td><?php echo htmlspecialchars($row['nom']); ?></td>
                                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                                        <td><?php echo htmlspecialchars($row['tel']); ?></td>
                                        <td><?php echo htmlspecialchars($row['adresse']); ?></td>
                                        <td><?php echo htmlspecialchars($row['description']); ?></td>
                                        <td><?php echo htmlspecialchars($row['code_postal']); ?></td>
                                        <td><img src="img/<?php echo htmlspecialchars($row['logo']); ?>" alt="Logo" style="max-width: 100px;"></td>
                                        <td><?php echo $row['site_web']; ?></td>
                                        
                                        <td class="td">
                                       
                                            <form method="post">
                                                <input type="hidden" name="id_entreprise" value="<?php echo htmlspecialchars($row['id']); ?>">
                                                <input class="submit" type="submit" value="delete" name="delete" style="text-decoration: none; color: white; background-color: #2a2185; padding: 10px; border-radius: 30px; cursor: pointer;">
                                                <a href="admis_modifie_entreprise.php?id=<?php echo htmlspecialchars($row['id']); ?>" style="text-decoration: none; color: white; background-color: #2a2185; padding: 10px; border-radius: 30px;">Update</a>
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
        </div>
    </div>
    <script src="assets/js/main.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script src="assets/js/main.js"></script>
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
        <script src="main.js"></script>

<!-- ====== ionicons ======= -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>
</html>

