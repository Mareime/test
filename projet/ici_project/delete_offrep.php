<?php
session_start();
include_once "connection.php";

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION["email"]) || !isset($_SESSION["password"])) {
    header("Location: login.php");
    exit();
}

// Vérifier si l'identifiant de l'offre à supprimer est présent
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['offreE_id'])) {
    $offreE_id = $_POST['offreE_id'];

    // Requête de suppression dans la base de données
    $delete_query = "DELETE FROM `publicationsoffresp` WHERE offreE_id=?";
    $stmt = mysqli_prepare($con, $delete_query);
    mysqli_stmt_bind_param($stmt, "i", $offreE_id);

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        mysqli_close($con);
        http_response_code(200); // OK - Suppression réussie
    } else {
        http_response_code(500); // Erreur interne du serveur
        echo "Erreur lors de la suppression de l'offre.";
    }
} else {
    http_response_code(400); // Requête incorrecte
    echo "Paramètres manquants pour la suppression de l'offre.";
}
?>
