<?php
include_once "connection.php";

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $id = $_GET["id"];

    $info_offre = "SELECT * FROM `publicationsoffrese` WHERE `offreE_id`=$id";
    $result_offre = mysqli_query($con, $info_offre);

    $mail_query = "SELECT entreprise.email, entreprise.tel 
    FROM `publicationsoffrese` 
    INNER JOIN entreprise 
    ON publicationsoffrese.entreprise_id = entreprise.id 
    WHERE publicationsoffrese.offreE_id = $id";
$result_mail = mysqli_query($con, $mail_query);

if ($result_offre && $result_mail) {
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Information Offre</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="styledem.css"> -->
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #e8f5ff;
            margin: 0;
            padding: 0;
        }

        .navbar-custom {
            background-color: #343a40;
        }

        .navbar-custom .navbar-brand {
            color: #fff;
            font-weight: bold;
            font-size: 24px;
        }

        .navbar-custom .navbar-brand img {
            width: 50px;
            height: auto;
            margin-right: 10px;
        }

        .navbar-custom .navbar-nav .nav-link {
            color: #fff;
            font-weight: 500;
            transition: color 0.3s;
        }

        .navbar-custom .navbar-nav .nav-link:hover,
        .navbar-custom .navbar-nav .nav-link:focus {
            color: #f093fb;
        }

        .navbar-custom .navbar-toggler {
            border: none;
        }

        .navbar-custom .navbar-toggler-icon {
            background-image: url("data:image/svg+xml;charset=UTF8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba(255, 255, 255, 0.5)' stroke-width='2' linecap='round' linejoin='round' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
        }

        .main {
            margin: 20px auto;
            width: 90%;
        }

        .main h2 {
            color: #333;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
        }

        .card {
            background-color: #fff;
            border-radius: 18px;
            box-shadow: 1px 1px 8px 0 grey;
            padding: 20px;
            margin-bottom: 20px;
        }

        .info-container {
            display: flex;
            align-items: center;
        }

        .profile {
            margin-right: 20px;
            text-align: center;
        }

        .profile img {
            border-radius: 50%;
            box-shadow: 0px 0px 5px 1px grey;
            width: 100px;
            height: 100px;
        }

        .info-container table {
            width: 100%;
            font-size: 16px;
        }

        .info-container td {
            padding: 8px;
        }

        @media (max-width: 768px) {
            .info-container {
                flex-direction: column;
                align-items: flex-start;
            }

            .profile {
                margin-bottom: 20px;
            }

            .profile img {
                width: 80px;
                height: 80px;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light navbar-custom">
        <a class="navbar-brand" href="#">
            <img src="logo.jpg" class="logo" alt="Logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>
    
    <div class="main">
        <h2>INFORMATION</h2>
        <?php while ($row = mysqli_fetch_assoc($result_offre)) {
            $mail_row = mysqli_fetch_assoc($result_mail);
        ?>
        <div class="card">
            <div class="card-body">
                <div class="info-container">
                    <div class="profile">
                        <img src="img/<?php echo $row['logo_entrp']; ?>" alt="Logo de <?php echo $row['nom_entrp']; ?>">
                    </div>
                    <table>
                        <tbody>
                            <tr>
                                <td><strong>Titre</strong></td>
                                <td>:</td>
                                <td><?php echo $row['titre']; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Description</strong></td>
                                <td>:</td>
                                <td><?php echo $row['description']; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Exigences</strong></td>
                                <td>:</td>
                                <td><?php echo $row['exigences']; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Date limite</strong></td>
                                <td>:</td>
                                <td><?php echo $row['date_limite']; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Nom de l'entreprise</strong></td>
                                <td>:</td>
                                <td><?php echo $row['nom_entrp']; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Téléphone de l'entreprise</strong></td>
                                <td>:</td>
                                <td><?php echo $mail_row['tel']; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Email de l'entreprise</strong></td>
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

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php
    } else {
        echo "Erreur lors de la récupération des données.";
    }
}
?>
