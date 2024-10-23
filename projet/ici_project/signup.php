<?php
session_start();
include('connection.php');

$emailExists = false;

if (isset($_POST["submit"])) {
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $email = $_POST["email"];
    $tel = $_POST["tel"];
    $password = $_POST["password"];
    $domaine = $_POST["domaine"];

    // Vérifier si l'email existe déjà dans n'importe quelle table
    $stmt = $con->prepare("SELECT email FROM demandeur WHERE email = ? UNION SELECT email FROM entreprise WHERE email = ? ");
    $stmt->bind_param("ss", $email, $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $emailExists = $result->num_rows > 0;
    $stmt->close();

    if ($emailExists) {
    } else {
        // Insérer un nouveau demandeur
        $stmt = $con->prepare("INSERT INTO demandeur (nom, prenom, email, domain, tel, password) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $nom, $prenom, $email, $domaine, $tel, $password);
        if ($stmt->execute()) {
            // Inscription réussie
            $_SESSION["mail"] = $email;
            $_SESSION["passwrd"] = $password;
            header("Location: demandaire_voir_plus.php");
            exit;
        } 
        $stmt->close();
    }
}
mysqli_close($con);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inscription</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="style1.css">
    <script src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>
    <script>
        (function() {
            emailjs.init('uCc2m3GbmIWfNmyiN');
        })();

        let otp_val = "";

        function envoyerOTP() {
            otp_val = Math.floor(1000 + Math.random() * 9000).toString();
            const to = document.getElementById('email').value;
            const params = {
                to,
                message: `Votre code OTP est : ${otp_val}`
            };
            const service = "service_00p6c3c";
            const template = "template_3u066ot";

            emailjs.send(service, template, params)
                .then(function(response) {
                    alert('Le code de vérification a été envoyé à votre email');
                }, function(error) {
                    alert('Échec de l\'envoi du code de vérification');
                });
        }

        function verifierOTP() {
            const code_ver = document.getElementById('code').value;
            if (code_ver === otp_val) {
                document.getElementById('nom').disabled = false;
                document.getElementById('prenom').disabled = false;
                document.getElementById('domaine').disabled = false;
                document.getElementById('tel').disabled = false;
                document.getElementById('password').disabled = false;
                document.querySelector('.create-account').disabled = false;
                alert('Email vérifié avec succès');
            } else {
                alert("Le code n'est pas valide");
            }
        }
    </script>
</head>

<body>
    <div class="registration-form">
        <form id="signup-form" method="post" enctype="multipart/form-data">
            <div class="form-icon">
                <span><i class="icon icon-user"></i></span>
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" id="nom" name="nom" placeholder="Nom" disabled>
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" id="prenom" name="prenom" placeholder="Prénom" disabled>
            </div>
            <div class="form-group">
                <input type="email" class="form-control item" id="email" name="email" placeholder="Email">
                <button type="button" class="btn btn-primary" onclick="envoyerOTP()">Envoyer le code de vérification</button>
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" id="code" name="code" placeholder="Entrez le code de vérification">
                <button type="button" id="verify" class="btn btn-primary" onclick="verifierOTP()">Vérifier le code</button>
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" id="domaine" name="domaine" placeholder="Domaine" disabled>
            </div>
            <div class="form-group">
                <input type="tel" class="form-control item" id="tel" name="tel" placeholder="Téléphone" pattern="[234][0-9]{7}" disabled>
            </div>
            <div class="form-group">
                <input type="password" class="form-control item" id="password" name="password" placeholder="Mot de passe" disabled>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-block create-account" name="submit" value="Créer un compte" disabled>
            </div>
            <div class="form-group">
                <p id="error" style="color:red; <?php if (!$emailExists) echo 'display:none;'; ?>">Cet email existe déjà</p>
                <p>Vous avez un compte? <a href="login.php">Connectez-vous</a></p>
            </div>
        </form>
    </div>
</body>

</html>
