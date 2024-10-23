<?php include 'sendemail.php'; ?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Contactez-nous </title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Sriracha&display=swap');

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Poppins", sans-serif;
    }

    body {
      min-height: 100vh;
      background: url(background.jpg) no-repeat;
      background-size: cover;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
    }

    .contact-section {
      width: 100%;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .contact-info {
      color: #fff;
      max-width: 500px;
      line-height: 65px;
      padding-left: 50px;
      font-size: 18px;
    }

    .contact-info i {
      margin-right: 20px;
      font-size: 25px;
    }

    .contact-form {
      max-width: 700px;
      margin-right: 50px;
    }

    .contact-info,
    .contact-form {
      flex: 1;
    }

    .contact-form h2 {
      color: #fff;
      text-align: center;
      font-size: 35px;
      text-transform: uppercase;
      margin-bottom: 30px;
    }

    .contact-form .text-box {
      background: #000;
      color: #fff;
      border: none;
      width: calc(50% - 10px);
      height: 50px;
      padding: 12px;
      font-size: 15px;
      border-radius: 5px;
      box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
      margin-bottom: 20px;
      opacity: 0.9;
    }

    .contact-form .text-box:first-child {
      margin-right: 15px;
    }

    .contact-form textarea {
      background: #000;
      color: #fff;
      border: none;
      width: 100%;
      padding: 12px;
      font-size: 15px;
      min-height: 200px;
      max-height: 400px;
      resize: vertical;
      border-radius: 5px;
      box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
      margin-bottom: 20px;
      opacity: 0.9;
    }

    .contact-form .send-btn {
      float: right;
      background: #2E94E3;
      color: #fff;
      border: none;
      width: 120px;
      height: 40px;
      font-size: 15px;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 2px;
      border-radius: 5px;
      cursor: pointer;
      transition: 0.3s;
      transition-property: background;
    }

    .contact-form .send-btn:hover {
      background: #0582E3;
    }

    @media screen and (max-width: 950px) {
      .contact-section {
        flex-direction: column;
      }

      .contact-info,
      .contact-form {
        margin: 30px 50px;
      }

      .contact-form h2 {
        font-size: 30px;
      }

      .contact-form .text-box {
        width: 100%;
      }
    }

    .alert-success {
      z-index: 1;
      background: #D4EDDA;
      font-size: 18px;
      padding: 20px 40px;
      min-width: 420px;
      position: fixed;
      right: 0;
      top: 10px;
      border-left: 8px solid #3AD66E;
      border-radius: 4px;
    }

    .alert-error {
      z-index: 1;
      background: #FFF3CD;
      font-size: 18px;
      padding: 20px 40px;
      min-width: 420px;
      position: fixed;
      right: 0;
      top: 10px;
      border-left: 8px solid #FFA502;
      border-radius: 4px;
    }

    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #f5f5f5;
      width: 100%;
      padding: 10px 50px;
    }

    .header .logo img {
      height: 50px;
    }

    .nav-items {
      display: flex;
      justify-content: space-around;
      align-items: center;
    }

    .nav-items a {
      text-decoration: none;
      color: #000;
      padding: 35px 20px;
    }

    .footer {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #302f49;
      width: 100%;
      padding: 40px 10px; /* Hauteur du footer réduite */
    }

    .footer .copy {
      color: #fff;
    }

    .bottom-links {
      display: flex;
      justify-content: space-around;
      align-items: center;
      padding: 20px 0; /* Hauteur du footer réduite */
    }

    .bottom-links .links {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      padding: 0 20px;
    }

    .bottom-links .links span {
      font-size: 20px;
      color: #fff;
      text-transform: uppercase;
      margin: 10px 0;
    }

    .bottom-links .links a {
      text-decoration: none;
      color: #a1a1a1;
      padding: 10px 20px;
    }
  </style>
</head>

<body>
  <header class="header">
    <a href="index.html" class="logo">
      <img src="logo.jpg" alt="Logo">
    </a>
    <nav class="nav-items">
      <a href="home.php">Accueil</a>
      <a href="about.php">À propos</a>
      <a href="contact.php">Contacter-nous</a>
    </nav>
  </header>

  <!--alert messages start-->
  <?php echo $alert; ?>
  <!--alert messages end-->

  <!--contact section start-->
  <div class="contact-section">
    <div class="contact-info">
      <div><i class="fas fa-map-marker-alt"></i>Adresse, Ville, Pays</div>
      <div><i class="fas fa-envelope"></i>Admis2@gmail.com</div>
      <div><i class="fas fa-phone"></i>+49703610</div>
      <div><i class="fas fa-clock"></i>Lun - Ven 8:00 à 17:00</div>
    </div>
    <div class="contact-form">
      <h2>Contactez-nous</h2>
      <form class="contact" action="" method="post">
        <input type="text" name="name" class="text-box" placeholder="Votre Nom" required>
        <input type="email" name="email" class="text-box" placeholder="Votre Email" required>
        <textarea name="message" rows="5" placeholder="Votre Message" required></textarea>
        <input type="submit" name="submit" class="send-btn" value="Envoyer">
      </form>
    </div>
  </div>
  <!--contact section end-->

  <footer class="footer">
    <div class="copy">&copy; 2024 Développeur</div>
    <div class="bottom-links">
      <div class="links">
        <span>Plus d'infos</span>
        <a href="home.php">Accueil</a>
        <a href="about.php">À propos</a>
        <a href="contact.php">Contact</a>
      </div>
      <div class="links">
        <span>Liens Sociaux</span>
        <a href="#"><i class="fab fa-facebook"></i></a>
        <a href="#"><i class="fab fa-twitter"></i></a>
        <a href="#"><i class="fab fa-instagram"></i></a>
      </div>
    </div>
  </footer>

  <script type="text/javascript">
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }
  </script>

</body>

</html>
