<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <style>
   @import url('https://fonts.googleapis.com/css2?family=Sriracha&display=swap');

body {
  margin: 0;
  box-sizing: border-box;
}

/* CSS for header */
.header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background-color: #f5f5f5;
}

.header .logo img {
  height: 50px;
  margin-left: 30px;
}

.nav-items {
  display: flex;
  justify-content: space-around;
  align-items: center;
  background-color: #f5f5f5;
  margin-right: 20px;
}

.nav-items a {
  text-decoration: none;
  color: #000;
  padding: 35px 20px;
}

/* CSS for main element */
.intro {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  width: 100%;
  height: 520px;
  background: linear-gradient(to bottom, rgba(0, 0, 0, 0.5) 0%, rgba(0, 0, 0, 0.5) 100%), url("r.jpg");
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
}

.intro h1 {
  font-family: sans-serif;
  font-size: 60px;
  color: #fff;
  font-weight: bold;
  text-transform: uppercase;
  margin: 0;
}

.intro p {
  font-size: 20px;
  color: #d1d1d1;
  text-transform: uppercase;
  margin: 20px 0;
}

.intro button {
  background-color: #5edaf0;
  color: #000;
  padding: 10px 25px;
  border: none;
  border-radius: 5px;
  font-size: 20px;
  font-weight: bold;
  cursor: pointer;
  box-shadow: 0px 0px 20px rgba(255, 255, 255, 0.4)
}

.achievements {
  display: flex;
  justify-content: space-around;
  align-items: center;
  padding: 40px 80px;
}

.achievements .work {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  padding: 0 40px;
}

.achievements .work i {
  width: fit-content;
  font-size: 50px;
  color: #333333;
  border-radius: 50%;
  border: 2px solid #333333;
  padding: 12px;
}

.achievements .work .work-heading {
  font-size: 20px;
  color: #333333;
  text-transform: uppercase;
  margin: 10px 0;
}

.achievements .work .work-text {
  font-size: 15px;
  color: #585858;
  margin: 10px 0;
}

.about-me {
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 40px 80px;
  border-top: 2px solid #eeeeee;
}

.about-me img {
  width: 500px;
  max-width: 100%;
  height: auto;
  border-radius: 10px;
}

.about-me-text h2 {
  font-size: 30px;
  color: #333333;
  text-transform: uppercase;
  margin: 0;
}

.about-me-text p {
  font-size: 15px;
  color: #585858;
  margin: 10px 0;
}

/* CSS for footer */
.footer {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background-color: #302f49;
  padding: 40px 80px;
}

.footer .copy {
  color: #fff;
}

.bottom-links {
  display: flex;
  justify-content: space-around;
  align-items: center;
  padding: 40px 0;
}

.bottom-links .links {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  padding: 0 40px;
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
.intro button {
  background-color: #5edaf0;
  color: #000;
  padding: 15px 30px; /* Ajustez la taille du padding pour un meilleur espacement */
  border: none;
  border-radius: 5px;
  font-size: 20px;
  font-weight: bold;
  cursor: pointer;
  box-shadow: 0px 0px 20px rgba(255, 255, 255, 0.4);
  transition: background-color 0.3s ease; /* Ajoute une transition pour un effet plus fluide */
}

.intro button:hover {
  background-color: #4ac5d8; /* Couleur de fond au survol */
  color: #fff; /* Couleur du texte au survol */
}
/* Pour supprimer la décoration par défaut des liens */
.nav-items a,
.intro button a,
.bottom-links .links a {
  text-decoration: none; /* Supprime le soulignement */
  color: inherit; /* Utilise la couleur par défaut du texte */
}

/* Pour ajuster le style du bouton "En savoir plus" */
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
  transition: background-color 0.3s ease;
}

.intro button:hover {
  background-color: #4ac5d8;
  color: #fff;
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
    <a href="about.php">À Propos</a>
    <a href="signup.php">Inscription</a>
    <a href="index.php">Contacter-nous</a>
    <a href="login.php">Connexion</a>
  </nav>
</header>

  <main>
    <div class="intro">
  <h1>Bienvenue sur notre plateforme de prestation de services</h1>
  <p>Nous connectons efficacement les demandeurs de services aux prestataires qualifiés.</p>
  <button><a href="voir_plus_home.php">En savoir plus</a></button>
</div>
<div class="achievements">
  <div class="work">
  <a href="logindem.php"><i class="fas fa-user-friends"></i></a>
    <p class="work-heading">Demandeurs d'emploi</p>
    <p class="work-text">Facilitons la recherche d'opportunités professionnelles pour les demandeurs d'emploi, en les connectant à des offres correspondant à leurs compétences.</p>
  </div>
  <div class="work">
    <a href="login.php"><i class="fas fa-users"></i></a>
    <p class="work-heading">Particuliers</p>
    <p class="work-text">Trouvez des prestataires qualifiés pour divers services comme la rénovation, les soins à domicile, et bien plus, assurant fiabilité et compétence.</p>
  </div>
  <div class="work">
  <a href="login.php"><i class="fas fa-building"></i></a>
    <p class="work-heading">Entreprises</p>
    <p class="work-text">Offrons aux entreprises un accès à des prestataires spécialisés pour mener à bien leurs projets spécifiques, vérifiés et recommandés par d'autres utilisateurs.</p>
  </div>
</div>

 
  </main>
  <footer class="footer">
    <div class="copy">&copy; 2024 Developer</div>
    <div class="bottom-links">
      <div class="links">
        <span>More Info</span>
        <a href="home.php">Accueil</a>
        <a href="about.php">À Propos</a>
        <a href="signup.php">Inscription</a>
        <a href="index.php">Contacter-nous</a>
      </div>
      <div class="links">
        <span>Social Links</span>
        <a href="#"><i class="fab fa-facebook"></i></a>
        <a href="#"><i class="fab fa-twitter"></i></a>
        <a href="#"><i class="fab fa-instagram"></i></a>
      </div>
    </div>
  </footer>
</body>

</html>