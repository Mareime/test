<?php
session_start();
include_once "connection.php";

$email = $password = "";
$emailErr = $passwordErr = "";
$emailInvalid = $passwordInvalid = false;

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    $query = "SELECT * FROM `demandeur` WHERE email='$email'";
    $result = mysqli_query($con, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if ($row['password'] == $password) {
                $_SESSION["mail"] = $email;
                $_SESSION["passwrd"] = $password;
                header('location:demandaire_voir_plus.php');
                exit();
            } else {
                $passwordErr = "Votre Mot De Passe est incorrect";
                $passwordInvalid = true;
            }
        } else {
            $emailErr = "Votre Email est incorrect";
            $emailInvalid = true;
        }
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
<script>
    function validateForm() {
        var email = document.getElementById('email').value;
        var password = document.getElementById('password').value;
        var errorMessage = document.getElementById('error-message');
        var emailField = document.getElementById('email');
        var passwordField = document.getElementById('password');
        
        if (email === '') {
            errorMessage.innerText = 'Veuillez saisir votre email.';
            emailField.classList.add('is-invalid');
            return false;
        } else {
            emailField.classList.remove('is-invalid');
        }
        
        if (password === '') {
            errorMessage.innerText = 'Veuillez saisir votre mot de passe.';
            passwordField.classList.add('is-invalid');
            return false;
        } else {
            passwordField.classList.remove('is-invalid');
        }
        
        return true;
    }
</script>
<div class="registration-form">
    <form id="signup-form" method="post" onsubmit="return validateForm()">
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
            <p id="error-message" style="color: red;"></p>
        </div>
    </form>
</div> 
</body>
</html>
