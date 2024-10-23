<?php
session_start();
include_once "connection.php";
$mail = $_SESSION["email"];
$password = $_SESSION["password"];

// Récupérer l'ID du particulier connecté
$part_query = "SELECT id_particulier FROM `particulier` WHERE email=? AND password=?";
$stmt_part = mysqli_prepare($con, $part_query);
mysqli_stmt_bind_param($stmt_part, "ss", $mail, $password);
mysqli_stmt_execute($stmt_part);
$part_result = mysqli_stmt_get_result($stmt_part);

if ($part_result && mysqli_num_rows($part_result) > 0) {
    $particulier = mysqli_fetch_assoc($part_result);
    $particulier_id = $particulier['id_particulier'];

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
            $update_query = "UPDATE `publicationsoffresp` SET titre=?, description=?, exigences=?, date_limite=? WHERE offreP_id=?";
            $stmt_update = mysqli_prepare($con, $update_query);
            mysqli_stmt_bind_param($stmt_update, "ssssi", $titre, $description, $exigences, $date_limite, $offreE_id);
            mysqli_stmt_execute($stmt_update);

            // Vérifier si la mise à jour a réussi
            if (mysqli_stmt_affected_rows($stmt_update) > 0) {
                header("Location: particulier_mon_offre.php");
                exit();
            } else {
                header("Location: particulier_mon_offre.php");
            }
        } elseif ($_POST["action"] == "delete" && isset($_POST["offreE_id"])) {
            // Récupérer l'ID de l'offre à supprimer
            $offreE_id = $_POST["offreE_id"];

            // Préparer et exécuter la requête de suppression
            $delete_query = "DELETE FROM `publicationsoffresp` WHERE offreP_id=?";
            $stmt_delete = mysqli_prepare($con, $delete_query);
            mysqli_stmt_bind_param($stmt_delete, "i", $offreE_id);
            mysqli_stmt_execute($stmt_delete);

            // Vérifier si la suppression a réussi
            if (mysqli_stmt_affected_rows($stmt_delete) > 0) {
                header("Location: particulier_mon_offre.php");
                exit();
            } else {
                echo "Aucune offre n'a été supprimée.";
            }
        }
    }

    // Récupérer les offres créées par ce particulier
    $off_query = "SELECT * FROM `publicationsoffresp` WHERE particulier_id=?";
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
   /* Réinitialisation des styles et styles de base */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background-color: #f8f9fa;
    color: #333;
    line-height: 1.6;
}

.container {
    width: 80%;
    margin: 50px auto;
    max-width: 1200px;
}

h1, h2, h3 {
    margin-bottom: 20px;
    color: #007bff;
}

/* Tableau */
.table {
    width: 100%;
    margin-bottom: 30px;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    background-color: #fff;
}

.table th, .table td {
    padding: 12px 15px;
    text-align: left;
    vertical-align: middle;
    border-bottom: 1px solid #dee2e6;
}

.table th {
    background-color: #007bff;
    color: #fff;
    border-color: #007bff;
    text-transform: uppercase;
}

.table-hover tbody tr:hover {
    background-color: #f5f5f5;
}

/* Boutons */
.btn {
    display: inline-block;
    padding: 8px 12px;
    font-size: 14px;
    text-align: center;
    text-decoration: none;
    cursor: pointer;
    border: none;
    border-radius: 4px;
    transition: background-color 0.3s ease;
}

.btn-primary {
    background-color: #007bff;
    color: #fff;
}

.btn-primary:hover {
    background-color: #0056b3;
}

.btn-danger {
    background-color: #dc3545;
    color: #fff;
}

.btn-danger:hover {
    background-color: #c82333;
}

.btn-success {
    background-color: #28a745;
    color: #fff;
}

.btn-success:hover {
    background-color: #218838;
}

.btn-secondary {
    background-color: #6c757d;
    color: #fff;
}

.btn-secondary:hover {
    background-color: #5a6268;
}

/* Formulaires */
.form-group {
    margin-bottom: 20px;
}

.form-control {
    width: 100%;
    padding: 8px;
    font-size: 14px;
    border: 1px solid #ced4da;
    border-radius: 4px;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.form-control:focus {
    border-color: #007bff;
    outline: 0;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

/* Formulaire d'édition */
#editFormDiv {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #fff;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
    z-index: 1000;
    width: 90%;
    max-width: 600px;
}

@media (max-width: 768px) {
    .container {
        width: 90%;
    }
}

</style>
<script>
    function showEditForm(offre) {
        console.log(offre); // Debugging: Log the offer data
        var editFormDiv = document.getElementById('editFormDiv');
        editFormDiv.style.display = 'block';
        document.getElementById('offreE_id').value = offre.offreP_id;
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
                                <form action="particulier_mon_offre.php" method="POST" style="display: inline-block;" onsubmit="return confirmDelete();">
                                    <input type="hidden" name="offreE_id" value="<?php echo $offre['offreP_id']; ?>">
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
            <form action="particulier_mon_offre.php" method="POST">
                <input type="hidden" id="offreE_id" name="offreE_id">
                <div class="form-group">
                    <label for="titre">Titre</label>
                    <input type="text" class="form-control" id="titre" name="titre" required>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" required></textarea>
                </div>
                <div class="form-group">
                    <label for="exigences">Exigences</label>
                    <textarea class="form-control" id="exigences" name="exigences" required></textarea>
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
