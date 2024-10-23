<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>À Propos - Application de Gestion de Services</title>
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <style>
    /* Styles CSS peuvent être ajoutés ici ou liés à une feuille de style externe */
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f5f5f5;
    }

    .header {
      background-color: #ffffff;
      padding: 10px 0;
      text-align: center;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .header .logo img {
      height: 50px;
      margin-left: 20px;
    }

    .nav-items {
      display: flex;
      justify-content: center;
      align-items: center;
      margin-top: 10px;
    }

    .nav-items a {
      text-decoration: none;
      color: #333;
      padding: 10px 20px;
      margin: 0 10px;
      border-radius: 5px;
      transition: background-color 0.3s ease;
    }

    .nav-items a:hover {
      background-color: #eee;
    }

    .about-section {
      padding: 50px;
      text-align: center;
    }

    .about-section h2 {
      font-size: 36px;
      color: #333;
      margin-bottom: 20px;
    }

    .about-section p {
      font-size: 18px;
      line-height: 1.6;
      color: #666;
    }

    .about-section .features {
      display: flex;
      justify-content: space-around;
      align-items: center;
      margin-top: 50px;
    }

    .feature {
      width: 30%;
      padding: 20px;
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease;
    }

    .feature:hover {
      transform: translateY(-10px);
    }

    .feature i {
      font-size: 36px;
      color: #5edaf0;
      margin-bottom: 10px;
    }

    .feature h3 {
      font-size: 24px;
      color: #333;
      margin-bottom: 10px;
    }

    .feature p {
      font-size: 16px;
      color: #666;
    }

    .footer {
      background-color: #302f49;
      color: #fff;
      text-align: center;
      padding: 20px 0;
      position: fixed;
      bottom: 0;
      left: 0;
      width: 100%;
      box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
    }

    .footer .copy {
      font-size: 14px;
      color: #ccc;
    }

    .footer .social-links {
      margin-top: 10px;
    }

    .footer .social-links a {
      color: #5edaf0;
      font-size: 24px;
      margin: 0 10px;
      transition: color 0.3s ease;
    }

    .footer .social-links a:hover {
      color: #333;
    }
  </style>
</head>

<body>
  <header class="header">
    <div class="logo">
      <img src="logo.jpg">
    </div>
    <nav class="nav-items">
      <a href="home.php">Accueil</a>
      <a href="about.php">À Propos</a>
      <a href="index.php">Contact</a>
    </nav>
  </header>

  <div class="about-section">
    <h2>À Propos de Notre Application de prestation de Services</h2>
    <p>Dans un monde de plus en plus connecté et compétitif, la recherche de prestataires de services qualifiés et fiables est devenue une nécessité incontournable pour les particuliers, les entreprises et les professionnels. La complexité et la diversité des besoins ont créé une demande croissante pour une solution efficace qui facilite la mise en relation entre les demandeurs et les prestataires de services. C'est dans ce contexte que notre Application de Gestion de Services a été conçue.</p>
    <p>Notre application vise à répondre à plusieurs besoins spécifiques des clients :</p>
    <ul>
      <li><strong>Demandeurs d'emploi :</strong> Ceux qui souhaitent trouver des emplois temporaires ou permanents. Notre plateforme met en relation les chercheurs d'emploi avec des opportunités correspondant à leurs compétences, leur offrant ainsi un moyen efficace de pénétrer le marché du travail.</li>
      <li><strong>Particuliers :</strong> Ceux qui recherchent des prestataires fiables, qualifiés et compétents dans divers domaines de service. Que ce soit pour des travaux de rénovation, des services de santé à domicile ou des cours particuliers, notre application fournit une plateforme sécurisée pour trouver les meilleures offres.</li>
      <li><strong>Entreprises :</strong> Celles qui cherchent des prestataires spécialisés possédant l'expertise nécessaire pour mener à bien des projets spécifiques. Notre application permet aux entreprises de consulter les profils de prestataires, de vérifier leurs qualifications et de lire des avis pour faire un choix éclairé.</li>
    </ul>
    <div class="features">
      <div class="feature">
        <i class="fas fa-users"></i>
        <h3>Prestataires Qualifiés</h3>
        <p>Nous assurons que tous les prestataires de services sont qualifiés et vérifiés, offrant ainsi la tranquillité d'esprit à nos utilisateurs.</p>
      </div>
      <div class="feature">
        <i class="fas fa-handshake"></i>
        <h3>Connexions Fiables</h3>
        <p>Notre plateforme facilite des connexions fiables entre les demandeurs de services et les prestataires.</p>
      </div>
      <div class="feature">
        <i class="fas fa-cogs"></i>
        <h3>Solutions Efficaces</h3>
        <p>Nous proposons une solution efficace pour trouver et embaucher des prestataires de services dans différents domaines.</p>
      </div>
    </div>
  </div>

  <footer class="footer">
    <div class="copy">&copy; 2024 Votre Entreprise</div>
    <div class="social-links">
      <a href="#"><i class="fab fa-facebook"></i></a>
      <a href="#"><i class="fab fa-twitter"></i></a>
      <a href="#"><i class="fab fa-instagram"></i></a>
    </div>
  </footer>
</body>

</html>
