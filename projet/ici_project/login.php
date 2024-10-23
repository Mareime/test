<?php
include("connection.php");
session_start();

$emailErr = $passwordErr = "";
$email = $password = "";
$emailInvalid = $passwordInvalid = false;

if (isset($_POST["submit"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    if (empty($email) && empty($password)) {
        header("Location: home.php");
        exit();
    }
    $sql_entreprise = "SELECT email, password FROM entreprise";
    $result_entreprise = mysqli_query($con, $sql_entreprise);
    $sql_particulier = "SELECT email, password FROM particulier";
    $result_particulier = mysqli_query($con, $sql_particulier);
    $sql_demandeur = "SELECT email, password FROM demandeur";
    $result_demandeur = mysqli_query($con, $sql_demandeur);
    $sql_admis = "SELECT mail_utilisateur, mot_de_passe FROM administrateurs";
    $result_admis = mysqli_query($con, $sql_admis);

    $validEmail = false;
    $validPassword = false;

    while ($row_admis = mysqli_fetch_assoc($result_admis)) {
        if ($row_admis["mail_utilisateur"] == $email) {
            $validEmail = true;
            if ($row_admis["mot_de_passe"] == $password) {
                $_SESSION["admis_email"] = $email;
                $_SESSION["admis_password"] = $password;
                $_SESSION["admis"] = true;
                header("Location:admis_home.php");
                exit();
            }
        }
    }

    while ($row_entreprise = mysqli_fetch_assoc($result_entreprise)) {
        if ($row_entreprise["email"] == $email) {
            $validEmail = true;
            if ($row_entreprise["password"] == $password) {
                $_SESSION["email"] = $email;
                $_SESSION["password"] = $password;
                $_SESSION["entreprise"] = true;
                header("Location:entreprise_voir_plus.php");
                exit();
            }
        }
    }

    while ($row_particulier = mysqli_fetch_assoc($result_particulier)) {
        if ($row_particulier["email"] == $email) {
            $validEmail = true;
            if ($row_particulier["password"] == $password) {
                $_SESSION["email"] = $email;
                $_SESSION["password"] = $password;
                $_SESSION["particulier"] = true;
                header("Location:pour_particulier.php");
                exit();
            }
        }
    }

    // Uncomment this block if you want to check demandeur login as well
    
    while ($row_demandeur = mysqli_fetch_assoc($result_demandeur)) {
        if ($row_demandeur["email"] == $email) {
            $validEmail = true;
            if ($row_demandeur["password"] == $password) {
                $_SESSION["email"] = $email;
                $_SESSION["password"] = $password;
                $_SESSION["demandeur"] = true;
                header("Location:demandaire_voir_plus.php");
                exit();
            }
        }
    }

    if (!$validEmail) {
        $emailInvalid = true;
        $emailErr = "Votre Email est incorrect";
    } elseif (!$validPassword) {
        $passwordInvalid = true;
        $passwordErr = "Votre Mot De Passe est incorrect";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Log In</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="style1.css">
</head>
<body>
    <div class="registration-form">
        <form id="signup-form" method="post">
            <div class="form-icon">
                <span><i class="icon icon-user"></i></span>
            </div>
            <div class="form-group">
                <input type="email" class="form-control item <?php echo $emailInvalid ? 'is-invalid' : ''; ?>" id="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($email); ?>">
                <?php if ($emailInvalid): ?>
                    <div class="invalid-feedback"><?php echo $emailErr; ?></div>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <input type="password" class="form-control item <?php echo $passwordInvalid ? 'is-invalid' : ''; ?>" id="password" name="password" placeholder="Mot De Passe" value="<?php echo htmlspecialchars($password); ?>">
                <?php if ($passwordInvalid): ?>
                    <div class="invalid-feedback"><?php echo $passwordErr; ?></div>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-block create-account" name="submit" value="Log In">
            </div>
            <div class="form-group">
                <p>Vous n'avez pas un compte? 
                <a href="signup.php">Sign Up</a></p>
            </div>
        </form>
    </div>
    <script src="script.js"></script>
</body>
</html>
