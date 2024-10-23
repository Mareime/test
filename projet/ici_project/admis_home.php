<?php
session_start();
if (!$_SESSION["admis_email"] &&  !$_SESSION["admis_password"] && !$_SESSION["admis"]) {
    header("Location: login.php");
} 
include('connection.php');

$query = "SELECT COUNT(*) AS total_enterprises FROM entreprise";
$result = mysqli_query($con, $query);
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $total_enterprises = $row['total_enterprises'];
}

$query = "SELECT COUNT(*) AS total_demandeurs FROM demandeur";
$result = mysqli_query($con, $query);
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $total_demandeurs = $row['total_demandeurs'];
}

$query = "SELECT COUNT(*) AS total_particulier FROM particulier";
$result = mysqli_query($con, $query);
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $total_particulier = $row['total_particulier'];
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Admin Dashboard</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="admis_home.css">
</head>

<body>
    
    <!-- =============== Navigation ================ -->
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

                <div class="user">
                    <img src="logo.jpg" alt="Admin">
                </div>
            </div>

            <!-- ======================= Cards ================== -->
            <div class="cardBox">
                <div class="card">
                    <div>
                        <div class="cardName">Entriprise</div>
                        <div class="numbers"><?php echo $total_enterprises; ?></div>

                    </div>

                    <div class="iconBx">
                        <ion-icon name="entreprise-outline"></ion-icon>
                    </div>
                </div>
                <div class="card">
                    <div>
                        <div class="cardName">Particulier</div>

                        <div class="numbers"><?php echo  $total_particulier; ?></div>
                    </div>
                </div>
                <div class="card">
                    <div>

                        <div class="cardName">Demandeurs</div>
                        <div class="numbers"><?php echo  $total_demandeurs; ?></div>
                    </div>
                </div>
            </div>
        </div>




        <!-- =========== Scripts =========  -->
        <script src="main.js"></script>

        <!-- ====== ionicons ======= -->
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>