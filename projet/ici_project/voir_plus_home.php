<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>En Savoir Plus - Application de Gestion de Services</title>
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  <style>
    @import url('https://fonts.googleapis.com/css2?family=Sriracha&display=swap');

    body {
      margin: 0;
      box-sizing: border-box;
      font-family: 'Sriracha', cursive;
    }

    /* CSS for header */
    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #f5f5f5;
      padding: 10px 80px;
    }

    .header .logo img {
      height: 50px;
    }

    .nav-items {
      display: flex;
      justify-content: space-around;
      align-items: center;
      background-color: #f5f5f5;
    }

    .nav-items a {
      text-decoration: none;
      color: #333;
      padding: 10px 20px;
      font-size: 18px;
    }

    /* CSS for main element */
    .intro {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      width: 100%;
      height: 520px;
      background: linear-gradient(to bottom, rgba(0, 0, 0, 0.5) 0%, rgba(0, 0, 0, 0.5) 100%), url("https://images.unsplash.com/photo-1587620962725-abab7fe55159?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1031&q=80");
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      color: #fff;
      text-align: center;
      padding: 80px;
      box-sizing: border-box;
    }

    .intro h1 {
      font-size: 60px;
      font-weight: bold;
      text-transform: uppercase;
      margin-bottom: 20px;
    }

    .intro p {
      font-size: 24px;
      text-transform: uppercase;
      margin-bottom: 40px;
    }

    .intro button {
      background-color: #5edaf0;
      color: #000;
      padding: 15px 30px;
      border: none;
      border-radius: 5px;
      font-size: 20px;
      font-weight: bold;
      cursor: pointer;
      box-shadow: 0px 0px 20px rgba(255, 255, 255, 0.4);
      text-transform: uppercase;
    }

    .intro button:hover {
      background-color: #4ec2d4;
    }

    .achievements {
      display: flex;
      justify-content: space-around;
      align-items: flex-start;
      padding: 40px 80px;
      background-color: #f5f5f5;
    }

    .achievements .work {
      text-align: center;
      padding: 0 20px;
      max-width: 300px;
      margin-bottom: 40px;
    }

    .achievements .work i {
      font-size: 50px;
      color: #333333;
      border-radius: 50%;
      border: 2px solid #333333;
      padding: 20px;
      margin-bottom: 20px;
    }

    .achievements .work .work-heading {
      font-size: 24px;
      color: #333333;
      text-transform: uppercase;
      margin-bottom: 10px;
    }

    .achievements .work .work-text {
      font-size: 18px;
      color: #585858;
      line-height: 1.6;
    }

    .about-me {
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 80px;
      background-color: #eaeaea;
    }

    .about-me img {
      width: 300px;
      height: auto;
      border-radius: 10px;
      margin-right: 40px;
    }

    .about-me-text {
      text-align: left;
      max-width: 600px;
    }

    .about-me-text h2 {
      font-size: 36px;
      color: #333333;
      text-transform: uppercase;
      margin-bottom: 20px;
    }

    .about-me-text p {
      font-size: 18px;
      color: #585858;
      line-height: 1.6;
    }

    /* CSS for footer */
    .footer {
      background-color: #302f49;
      padding: 40px 80px;
      color: #fff;
      text-align: center;
    }

    .bottom-links {
      display: flex;
      justify-content: space-around;
      align-items: center;
      margin-top: 20px;
    }

    .bottom-links .links {
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .bottom-links .links span {
      font-size: 18px;
      margin-bottom: 10px;
      text-transform: uppercase;
    }

    .bottom-links .links a {
      text-decoration: none;
      color: #a1a1a1;
      padding: 10px 20px;
      font-size: 18px;
    }

    .bottom-links .links a:hover {
      color: #fff;
    }
    body {
      margin: 0;
      box-sizing: border-box;
      font-family: 'Sriracha', cursive;
    }

    .btn-link {
      text-decoration: none;
      color: inherit;
    }
  </style>
</head>

<body>
  <header class="header">
    <div class="logo">
      <img src="logo.jpg" alt="Logo">
    </div>
    <nav class="nav-items">
      <a href="home.php">Accueil</a>
      <a href="about.php">À Propos</a>
      <a href="signup.php">Inscription</a>
      <a href="index.php">Contact</a>
    </nav>
  </header>

  <main>

    <section class="achievements">
      <div class="work">
        <i class="fas fa-user-friends"></i>
        <p class="work-heading">Demandeurs d'emploi</p>
        <p class="work-text">Facilitons la recherche d'opportunités professionnelles pour les demandeurs d'emploi, en les connectant à des offres correspondant à leurs compétences.</p>
        <!-- <button type="button" class="btn btn-light"><a href="logindem.php">ici</a></button> -->
      </div>
      <div class="work">
        <i class="fas fa-users"></i>
        <p class="work-heading">Particuliers</p>
        <p class="work-text">Trouvez des prestataires qualifiés pour divers services comme la rénovation, les soins à domicile, et bien plus, assurant fiabilité et compétence.</p>
        <!-- <button type="button" class="btn btn-light"><a href="login.php">ici</a></button> -->
      </div>
      <div class="work">
        <i class="fas fa-building"></i>
        <p class="work-heading">Entreprises</p>
        <p class="work-text">Optimisez vos opérations en accédant à une base de données de prestataires vérifiés, répondant à vos besoins spécifiques en services et en expertise.</p>
        <!-- <button type="button" class="btn btn-light"><a href="login.php">ici</a></button> -->
      </div>
    </section>

    <section class="about-me">
      <img src="logo.jpg" alt="À propos de nous">
      <div class="about-me-text">
        <h2>À propos de nous</h2>
        <p>Nous sommes une équipe passionnée dédiée à simplifier la recherche et la prestation de services à travers une plateforme intuitive et sécurisée.</p>
      </div>
    </section>
    <div class="about-me">
      <div class="about-me-text">
        <h2>Sur moi</h2>
        <p>Bienvenue sur notre plateforme conçue pour mettre en relation les particuliers, les entreprises et les professionnels avec des prestataires qualifiés et fiables. Dans un monde de plus en plus interconnecté et concurrentiel, trouver des prestataires de services qualifiés est devenu un besoin essentiel. Notre application répond à cette demande en offrant une solution efficace pour faciliter les connexions entre les demandeurs de services et les fournisseurs.</p>
      </div>
      <img src="logo.jpg" alt="me">
    </div>
  </main>

  <footer class="footer">
    <div class="copy">&copy; 2023 Developer</div>
    <div class="bottom-links">
      <div class="links">
        <span>Plus d'informations</span>
        <a href="home.php">Accueil</a>
        <a href="about.php">À Propos</a>
        <a href="index.phpx">Contact</a>
      </div>
      <div class="links">
        <span>Liens Sociaux</span>
        <a href="#"><i class="fab fa-facebook"></i></a>
        <a href="#"><i class="fab fa-twitter"></i></a>
        <a href="#"><i class="fab fa-instagram"></i></a>
      </div>
  </footer>
</body>

</html>
