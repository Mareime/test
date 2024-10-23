-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 08 juin 2024 à 15:36
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `base_pi2`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateurs`
--

DROP TABLE IF EXISTS `administrateurs`;
CREATE TABLE IF NOT EXISTS `administrateurs` (
  `administrateur_id` int NOT NULL AUTO_INCREMENT,
  `mail_utilisateur` varchar(200) NOT NULL,
  `mot_de_passe` varchar(100) NOT NULL,
  PRIMARY KEY (`administrateur_id`),
  UNIQUE KEY `mail_utilisateur` (`mail_utilisateur`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `administrateurs`
--

INSERT INTO `administrateurs` (`administrateur_id`, `mail_utilisateur`, `mot_de_passe`) VALUES
(1, '23051@supnum.mr', '23051'),
(2, '23034@supnum.mr', '23034'),
(3, '23035@supnum.mr', '23035');

-- --------------------------------------------------------

--
-- Structure de la table `demandeur`
--

DROP TABLE IF EXISTS `demandeur`;
CREATE TABLE IF NOT EXISTS `demandeur` (
  `id_demandeur` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) DEFAULT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `domain` varchar(255) DEFAULT NULL,
  `tel` varchar(20) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `cv` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT 'profile.jpg',
  `adresse` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_demandeur`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `demandeur`
--

INSERT INTO `demandeur` (`id_demandeur`, `nom`, `prenom`, `email`, `domain`, `tel`, `password`, `cv`, `image`, `adresse`) VALUES
(1, 'Aminata', 'Sow', 'bintou18@gmail.com', 'Informatique et Technologie ', '49703610', 'bintou18', 'pdf/Aminata_CV.pdf', 'aminata.sow@example.com - 2024.06.07 - 12.00.16am.jpg', '123 Street, City'),
(2, 'Boubacar', 'Diallo', 'boubacar.diallo@example.com', 'Santé et Médecine', '987654321', 'password2', 'Boubacar_CV.pdf', 'profile.jpg', '456 Street, Town'),
(3, 'Gaye', 'Diop', 'gaye.diop@example.com', 'Marketing et Communication', '456123789', 'password3', 'Gaye_CV.pdf', 'profile.jpg', '789 Avenue, Village'),
(4, 'Med El Mouktar', 'Fofana', 'medelfofana@example.com', 'Finance et Comptabilité ', '789456123', 'password4', 'med el moktar_CV.pdf', 'profile.jpg', '987 Road, District'),
(5, 'Rawia', 'Camara', 'rawia.camara@example.com', 'Ressources Humaines', '654987321', 'password5', 'Rawia_CV.pdf', 'profile.jpg', '321 Lane, County'),
(6, 'Dupont', 'Jean', 'jean.dupont@example.com', 'Ingénierie logicielle', '+123456789', 'motdepasse123', NULL, 'profile.jpg', '123 Rue de la Fontaine, 75001 Paris');

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

DROP TABLE IF EXISTS `entreprise`;
CREATE TABLE IF NOT EXISTS `entreprise` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `code_postal` varchar(20) NOT NULL,
  `tel` varchar(20) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `entreprise`
--

INSERT INTO `entreprise` (`id`, `nom`, `adresse`, `code_postal`, `tel`, `email`, `password`, `logo`) VALUES
(1, 'Tech Solutions', '123 Tech Street', '75001', '0123456789', 'bintou18@gmail.com', 'bintou18', 'logo.jpg'),
(2, 'Green Energy', '456 Green Avenue', '75002', '0987654321', 'info@greenenergy.com', 'password2', 'logo2.jpg'),
(3, 'Health Plus', '789 Health Blvd', '75003', '0112233445', 'support@healthplus.com', 'password3', 'logo3.jpg'),
(4, 'EduSmart', '101 Edu Lane', '75004', '0223344556', 'hello@edusmart.com', 'password4', 'logo4.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `particulier`
--

DROP TABLE IF EXISTS `particulier`;
CREATE TABLE IF NOT EXISTS `particulier` (
  `id_particulier` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) DEFAULT NULL,
  `prenom` varchar(100) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `tel` int DEFAULT NULL,
  `password` text,
  PRIMARY KEY (`id_particulier`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `particulier`
--

INSERT INTO `particulier` (`id_particulier`, `nom`, `prenom`, `email`, `tel`, `password`) VALUES
(1, 'John', 'Doe', 'bintou18@gmail.com', 23456789, 'bintou18');

-- --------------------------------------------------------

--
-- Structure de la table `publicationsoffrese`
--

DROP TABLE IF EXISTS `publicationsoffrese`;
CREATE TABLE IF NOT EXISTS `publicationsoffrese` (
  `offreE_id` int NOT NULL AUTO_INCREMENT,
  `entreprise_id` int DEFAULT NULL,
  `titre` varchar(100) NOT NULL,
  `description` text,
  `exigences` text,
  `date_limite` date DEFAULT NULL,
  `logo_entrp` varchar(255) DEFAULT NULL,
  `nom_entrp` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`offreE_id`),
  KEY `entreprise_id` (`entreprise_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `publicationsoffrese`
--

INSERT INTO `publicationsoffrese` (`offreE_id`, `entreprise_id`, `titre`, `description`, `exigences`, `date_limite`, `logo_entrp`, `nom_entrp`) VALUES
(1, 1, 'Offre 1 Tech Solutions', 'Description de l\'offre 1 de Tech Solutions', 'Exigences de l\'offre 1 de Tech Solutions', '2024-06-30', 'logo.jpg', 'Tech Solutions'),
(2, 2, 'Offre 2 Green Energy', 'Description de l\'offre 2 de Green Energy', 'Exigences de l\'offre 2 de Green Energy', '2024-07-15', 'logo2.jpg', 'Green Energy'),
(3, 3, 'Offre 3 Health Plus', 'Description de l\'offre 3 de Health Plus', 'Exigences de l\'offre 3 de Health Plus', '2024-07-10', 'logo3.jpg', 'Health Plus'),
(4, 4, 'Offre 4 EduSmart', 'Description de l\'offre 4 de EduSmart', 'Exigences de l\'offre 4 de EduSmart', '2024-07-20', 'logo4.jpg', 'EduSmart'),
(5, 5, 'Offre 5 TravelExperts', 'Description de l\'offre 5 de TravelExperts', 'Exigences de l\'offre 5 de TravelExperts', '2024-07-05', 'logo5.jpg', 'TravelExperts'),
(6, 5, 'Offre 5 TravelExperts', 'Description de l\'offre 5 de TravelExperts', 'Exigences de l\'offre 5 de TravelExperts', '2024-07-05', 'logo6.jpg', 'TravelExperts'),
(9, 1, 'test1', 'bintou18', 'bintou18', '2024-06-29', 'logo.jpg', 'Tech Solutions');

-- --------------------------------------------------------

--
-- Structure de la table `publicationsoffresp`
--

DROP TABLE IF EXISTS `publicationsoffresp`;
CREATE TABLE IF NOT EXISTS `publicationsoffresp` (
  `offreP_id` int NOT NULL AUTO_INCREMENT,
  `particulier_id` int DEFAULT NULL,
  `titre` varchar(100) NOT NULL,
  `description` text,
  `exigences` text,
  `date_limite` date DEFAULT NULL,
  PRIMARY KEY (`offreP_id`),
  KEY `particulier_id` (`particulier_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
