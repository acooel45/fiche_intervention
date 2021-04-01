-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 01 avr. 2021 à 04:47
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `fiche_intervention`
--

-- --------------------------------------------------------

--
-- Structure de la table `assister`
--

DROP TABLE IF EXISTS `assister`;
CREATE TABLE IF NOT EXISTS `assister` (
  `emailIn` varchar(50) NOT NULL,
  `codeInt` int(11) NOT NULL,
  PRIMARY KEY (`emailIn`,`codeInt`),
  KEY `Assister_Intervention0_FK` (`codeInt`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `assister`
--

INSERT INTO `assister` (`emailIn`, `codeInt`) VALUES
('adam.blanchard@aol.fr', 17),
('adam.blanchard@aol.fr', 18),
('axel.blanchard@aol.fr', 18),
('axel.blanchard@aol.fr', 19);

-- --------------------------------------------------------

--
-- Structure de la table `demande`
--

DROP TABLE IF EXISTS `demande`;
CREATE TABLE IF NOT EXISTS `demande` (
  `codeDemande` int(11) NOT NULL AUTO_INCREMENT,
  `natureDem` varchar(500) NOT NULL,
  `Equipement` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`codeDemande`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `demande`
--

INSERT INTO `demande` (`codeDemande`, `natureDem`, `Equipement`) VALUES
(6, 'coucou', 'Coucou'),
(7, 'r&eacute;parer', 'ordi'),
(11, 'r&eacute;parer', 'anydesk');

-- --------------------------------------------------------

--
-- Structure de la table `demandeur`
--

DROP TABLE IF EXISTS `demandeur`;
CREATE TABLE IF NOT EXISTS `demandeur` (
  `codeDem` int(11) NOT NULL AUTO_INCREMENT,
  `nomDem` varchar(50) NOT NULL,
  `adresseDem` varchar(100) NOT NULL,
  `CPDem` varchar(5) NOT NULL,
  `telDem` varchar(10) NOT NULL,
  `emailDem` varchar(50) NOT NULL,
  `utilisateurDem` varchar(50) NOT NULL,
  `mdpDem` varchar(50) NOT NULL,
  PRIMARY KEY (`codeDem`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `demandeur`
--

INSERT INTO `demandeur` (`codeDem`, `nomDem`, `adresseDem`, `CPDem`, `telDem`, `emailDem`, `utilisateurDem`, `mdpDem`) VALUES
(6, 'Dion', '111 boulevard duhamel du monceau', '45160', '0636080163', 'maxime@guiltek.com', 'maxime.dion', '123456789'),
(7, 'axel', '12 rue des vignes', '45760', '0611762017', 'axel.blanchard@aol.fr', 'axel.blanchard', 'poipoi'),
(11, 'alex', '55 rue de Gascogne', '45770', '0611762017', 'alex.whitehard@aol.fr', 'alex.whitehard', '147896325');

-- --------------------------------------------------------

--
-- Structure de la table `faire`
--

DROP TABLE IF EXISTS `faire`;
CREATE TABLE IF NOT EXISTS `faire` (
  `codeDemande` int(11) NOT NULL,
  `codeDem` int(11) NOT NULL,
  `dateDem` date NOT NULL,
  PRIMARY KEY (`codeDemande`,`codeDem`),
  KEY `Faire_Demandeur0_FK` (`codeDem`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `faire`
--

INSERT INTO `faire` (`codeDemande`, `codeDem`, `dateDem`) VALUES
(6, 6, '1993-05-26'),
(7, 7, '2021-03-22'),
(11, 11, '2021-03-23');

-- --------------------------------------------------------

--
-- Structure de la table `intervenant`
--

DROP TABLE IF EXISTS `intervenant`;
CREATE TABLE IF NOT EXISTS `intervenant` (
  `emailIn` varchar(50) NOT NULL,
  `nomIn` varchar(50) NOT NULL,
  PRIMARY KEY (`emailIn`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `intervenant`
--

INSERT INTO `intervenant` (`emailIn`, `nomIn`) VALUES
('adam.blanchard@aol.fr', 'Blanchard Adam'),
('axel.blanchard@aol.fr', 'Blanchard Axel');

-- --------------------------------------------------------

--
-- Structure de la table `intervenir`
--

DROP TABLE IF EXISTS `intervenir`;
CREATE TABLE IF NOT EXISTS `intervenir` (
  `codeDemande` int(11) NOT NULL,
  `codeInt` int(11) NOT NULL,
  PRIMARY KEY (`codeDemande`,`codeInt`),
  KEY `Intervenir_Intervention0_FK` (`codeInt`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `intervenir`
--

INSERT INTO `intervenir` (`codeDemande`, `codeInt`) VALUES
(6, 17),
(6, 18),
(11, 19);

-- --------------------------------------------------------

--
-- Structure de la table `intervention`
--

DROP TABLE IF EXISTS `intervention`;
CREATE TABLE IF NOT EXISTS `intervention` (
  `codeInt` int(11) NOT NULL AUTO_INCREMENT,
  `dateDebut` timestamp NULL DEFAULT NULL,
  `dateFin` timestamp NULL DEFAULT NULL,
  `dureeInt` int(11) DEFAULT NULL,
  `natureInt` varchar(200) DEFAULT NULL,
  `etat` varchar(200) DEFAULT NULL,
  `observations` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`codeInt`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `intervention`
--

INSERT INTO `intervention` (`codeInt`, `dateDebut`, `dateFin`, `dureeInt`, `natureInt`, `etat`, `observations`) VALUES
(17, '2021-03-18 23:00:00', '2021-03-19 23:00:00', 12, 'r&eacute;paration', 'r&eacute;paration', 'coucou'),
(18, '1993-05-25 22:00:00', '1993-07-25 22:00:00', 152649, 'coucoucoucoucou', 'coucouuuuuuuu', 'coucou'),
(19, '2021-03-22 23:00:00', '2021-03-24 23:00:00', 12, 'v&eacute;rifier', 'ok', 'RAS');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `refProd` varchar(50) NOT NULL,
  `nomProd` varchar(100) NOT NULL,
  PRIMARY KEY (`refProd`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`refProd`, `nomProd`) VALUES
('cla', 'clavier'),
('ecr', 'ecran'),
('sou', 'souris'),
('sty', 'stylo');

-- --------------------------------------------------------

--
-- Structure de la table `utiliser`
--

DROP TABLE IF EXISTS `utiliser`;
CREATE TABLE IF NOT EXISTS `utiliser` (
  `codeInt` int(11) NOT NULL,
  `refProd` varchar(50) NOT NULL,
  `quantiteProd` int(11) NOT NULL,
  `PU` float NOT NULL,
  PRIMARY KEY (`codeInt`,`refProd`),
  KEY `Utiliser_Produit0_FK` (`refProd`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utiliser`
--

INSERT INTO `utiliser` (`codeInt`, `refProd`, `quantiteProd`, `PU`) VALUES
(18, 'ecr', 5, 100),
(18, 'sou', 10, 12),
(19, 'cla', 1, 105.99),
(19, 'ecr', 2, 47.5);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `assister`
--
ALTER TABLE `assister`
  ADD CONSTRAINT `Assister_Intervenant_FK` FOREIGN KEY (`emailIn`) REFERENCES `intervenant` (`emailIn`),
  ADD CONSTRAINT `Assister_Intervention0_FK` FOREIGN KEY (`codeInt`) REFERENCES `intervention` (`codeInt`);

--
-- Contraintes pour la table `faire`
--
ALTER TABLE `faire`
  ADD CONSTRAINT `Faire_Demande_FK` FOREIGN KEY (`codeDemande`) REFERENCES `demande` (`codeDemande`),
  ADD CONSTRAINT `Faire_Demandeur0_FK` FOREIGN KEY (`codeDem`) REFERENCES `demandeur` (`codeDem`);

--
-- Contraintes pour la table `intervenir`
--
ALTER TABLE `intervenir`
  ADD CONSTRAINT `Intervenir_Demande_FK` FOREIGN KEY (`codeDemande`) REFERENCES `demande` (`codeDemande`),
  ADD CONSTRAINT `Intervenir_Intervention0_FK` FOREIGN KEY (`codeInt`) REFERENCES `intervention` (`codeInt`);

--
-- Contraintes pour la table `utiliser`
--
ALTER TABLE `utiliser`
  ADD CONSTRAINT `Utiliser_Intervention_FK` FOREIGN KEY (`codeInt`) REFERENCES `intervention` (`codeInt`),
  ADD CONSTRAINT `Utiliser_Produit0_FK` FOREIGN KEY (`refProd`) REFERENCES `produit` (`refProd`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
