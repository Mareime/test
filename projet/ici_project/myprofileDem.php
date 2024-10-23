<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <!-- My CSS -->
    <link rel="stylesheet" href="styleDashbord-Demandaire.css">
    <title>Demandaire - Tableau de Bord</title>
</head>
<body>
    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="myprofileDem.php" class="brand">
            <i class='bx bxs-smile'></i>
            <span class="text">Demandaire</span>
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
    <!-- SIDEBAR -->

    <!-- CONTENT -->
    <section id="content">
        <!-- NAVBAR -->
        <nav>
            <i class='bx bx-menu'></i>
            <!-- <a href="#" class="notification">
                <i class='bx bxs-bell'></i>
            </a> -->
            <!-- <a href="profile.php" class="profile">
                
            </a> -->
        </nav>
        <!-- NAVBAR -->

        <!-- MAIN -->
        <main>
            <ul class="box-info">
                <li>
				<i class='bx bxs-group'></i>
                    <span class="text">
                        <h3>
                            <?php
                            include_once "connection.php";
                            $nbr_offre_par = "SELECT COUNT(*) AS count FROM `publicationsoffresp`";
                            $rr = mysqli_query($con, $nbr_offre_par);
                            if ($rr) {
                                $cols = mysqli_fetch_assoc($rr);
                                $countp = $cols['count'];
                                echo $countp;
                            } else {
                                echo "Erreur : " . mysqli_error($con);
                            }
                            ?>
                        </h3>
                        <p>Offres pour Particuliers</p>
                    </span>
                </li>
                <li>
				<i class='bx bxs-building-house'></i>
                    <span class="text">
                        <h3>
                            <?php
                            $nbr_offre_entr = "SELECT COUNT(*) AS count FROM `publicationsoffrese`";
                            $rr = mysqli_query($con, $nbr_offre_entr);
                            if ($rr) {
                                $cols = mysqli_fetch_assoc($rr);
                                $countp = $cols['count'];
                                echo $countp;
                            } else {
                                echo "Erreur : " . mysqli_error($con);
                            }
                            ?>
                        </h3>
                        <p>Offres pour Entreprises</p>
                    </span>
                </li>
            </ul>
        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->

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
