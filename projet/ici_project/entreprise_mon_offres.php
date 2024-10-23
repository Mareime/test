<?php
session_start();
include_once "connection.php";
$mail = $_SESSION["email"];
$password = $_SESSION["password"];

// Récupérer l'ID du particulier connecté
$part_query = "SELECT id FROM `entreprise` WHERE email=? AND password=?";
$stmt_part = mysqli_prepare($con, $part_query);
mysqli_stmt_bind_param($stmt_part, "ss", $mail, $password);
mysqli_stmt_execute($stmt_part);
$part_result = mysqli_stmt_get_result($stmt_part);

if ($part_result && mysqli_num_rows($part_result) > 0) {
    $particulier = mysqli_fetch_assoc($part_result);
    $particulier_id = $particulier['id'];

    // Traitement de la mise à jour ou suppression de l'offre
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"])) {
        if ($_POST["action"] == "update" && isset($_POST["offreE_id"], $_POST["titre"], $_POST["description"], $_POST["exigences"], $_POST["date_limite"])) {
            // Récupérer les données POST pour la mise à jour
            $offreE_id = $_POST["offreE_id"];
            $titre = $_POST["titre"];
            $description = $_POST["description"];
            $exigences = $_POST["exigences"];
            $date_limite = $_POST["date_limite"];

            // Préparer et exécuter la requête de mise à jour
            $update_query = "UPDATE `publicationsoffrese` SET titre=?, description=?, exigences=?, date_limite=? WHERE offreE_id=?";
            $stmt_update = mysqli_prepare($con, $update_query);
            mysqli_stmt_bind_param($stmt_update, "ssssi", $titre, $description, $exigences, $date_limite, $offreE_id);
            mysqli_stmt_execute($stmt_update);

            // Vérifier si la mise à jour a réussi
            if (mysqli_stmt_affected_rows($stmt_update) > 0) {
                header("Location: entreprise_mon_offres.php");
                exit();
            } else {
                header("Location: entreprise_mon_offres.php");
            }
        } elseif ($_POST["action"] == "delete" && isset($_POST["offreE_id"])) {
            // Récupérer l'ID de l'offre à supprimer
            $offreE_id = $_POST["offreE_id"];

            // Préparer et exécuter la requête de suppression
            $delete_query = "DELETE FROM `publicationsoffrese` WHERE offreE_id=?";
            $stmt_delete = mysqli_prepare($con, $delete_query);
            mysqli_stmt_bind_param($stmt_delete, "i", $offreE_id);
            mysqli_stmt_execute($stmt_delete);

            // Vérifier si la suppression a réussi
            if (mysqli_stmt_affected_rows($stmt_delete) > 0) {
                header("Location: entreprise_mon_offres.php");
                exit();
            } else {
                echo "Aucune offre n'a été supprimée.";
            }
        }
    }

    // Récupérer les offres créées par ce particulier
    $off_query = "SELECT * FROM `publicationsoffrese` WHERE entreprise_id=?";
    $stmt_off = mysqli_prepare($con, $off_query);
    mysqli_stmt_bind_param($stmt_off, "i", $particulier_id);
    mysqli_stmt_execute($stmt_off);
    $off_result = mysqli_stmt_get_result($stmt_off);

    $offres = [];
    if ($off_result) {
        while ($row = mysqli_fetch_assoc($off_result)) {
            $offres[] = $row;
        }
    }
} else {
    echo "Erreur: Particulier non trouvé.";
    exit();
}

mysqli_close($con);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Offres</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
       body {
            background-color: #f8f9fa;
            color: #333;
            font-family: Arial, sans-serif;
            padding-top: 50px; /* Ajustement pour une barre de navigation hypothétique */
        }
        .container {
            margin-top: 30px; /* Marge supérieure légèrement réduite */
        }
        .table {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
        }
        .table th,
        .table td {
            vertical-align: middle;
        }
        .table th {
            background-color: #007bff;
            color: #fff;
            border-color: #007bff;
        }
        .table-bordered th,
        .table-bordered td {
            border: 1px solid #dee2e6;
        }
        .btn {
            cursor: pointer;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0069d9;
            border-color: #0062cc;
        }
        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }
        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }
        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }
        .form-group {
            margin-bottom: 1rem;
        }
        #editFormDiv {
            display: none;
            position: absolute;
            top: 50px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #fff;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
            z-index: 100;
            width: 80%; /* Largeur du formulaire d'édition */
            max-width: 600px; /* Largeur maximale du formulaire, ajustez selon vos besoins */
        }
    </style>
    <script>
        function showEditForm(offre) {
            var editFormDiv = document.getElementById('editFormDiv');
            editFormDiv.style.display = 'block';
            document.getElementById('offreE_id').value = offre.offreE_id;
            document.getElementById('titre').value = offre.titre;
            document.getElementById('description').value = offre.description;
            document.getElementById('exigences').value = offre.exigences;
            document.getElementById('date_limite').value = offre.date_limite;
        }

        function closeEditForm() {
            var editFormDiv = document.getElementById('editFormDiv');
            editFormDiv.style.display = 'none';
        }

        function confirmDelete() {
            return confirm("Êtes-vous sûr de vouloir supprimer cette offre ?");
        }
    </script>
</head>
<body>
    <div class="container">
        <h1 class="mb-4">Mes Offres</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Description</th>
                    <th>Exigences</th>
                    <th>Date Limite</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($offres)) : ?>
                    <?php foreach ($offres as $offre) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($offre['titre']); ?></td>
                            <td><?php echo htmlspecialchars($offre['description']); ?></td>
                            <td><?php echo htmlspecialchars($offre['exigences']); ?></td>
                            <td><?php echo htmlspecialchars($offre['date_limite']); ?></td>
                            <td>
                                <button class="btn btn-primary btn-sm" onclick='showEditForm(<?php echo json_encode($offre); ?>)'>Edit</button>
                                <form action="entreprise_mon_offres.php" method="POST" style="display: inline-block;" onsubmit="return confirmDelete();">
                                    <input type="hidden" name="offreE_id" value="<?php echo $offre['offreE_id']; ?>">
                                    <input type="hidden" name="titre" value="<?php echo htmlspecialchars($offre['titre']); ?>">
                                    <input type="hidden" name="description" value="<?php echo htmlspecialchars($offre['description']); ?>">
                                    <input type="hidden" name="exigences" value="<?php echo htmlspecialchars($offre['exigences']); ?>">
                                    <input type="hidden" name="date_limite" value="<?php echo $offre['date_limite']; ?>">
                                    <input type="hidden" name="action" value="delete">
                                    <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="5" class="text-center">Aucune offre trouvée.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Formulaire d'édition caché -->
        <div id="editFormDiv">
            <h2>Editer l'offre</h2>
            <form action="entreprise_mon_offres.php" method="POST">
                <input type="hidden" id="offreE_id" name="offreE_id">
                <div class="form-group">
                    <label for="titre">Titre</label>
                    <input type="text" class="form-control" id="titre" name="titre" required>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="5" required></textarea>
                </div>
                <div class="form-group">
                    <label for="exigences">Exigences</label>
                    <textarea class="form-control" id="exigences" name="exigences" rows="3" required></textarea>
                </div>
                <div class="form-group">
                    <label for="date_limite">Date Limite</label>
                    <input type="date" class="form-control" id="date_limite" name="date_limite" required>
                </div>
                <input type="hidden" name="action" value="update">
                <button type="submit" class="btn btn-success">Enregistrer les modifications</button>
                <button type="button" class="btn btn-secondary" onclick="closeEditForm()">Fermer</button>
            </form>
        </div>
    </div>
</body>
</html>

