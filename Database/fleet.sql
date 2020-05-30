-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3308
-- Généré le :  mer. 11 mars 2020 à 08:35
-- Version du serveur :  8.0.18
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
-- Base de données :  `fleet`
--

-- --------------------------------------------------------

--
-- Structure de la table `fiche_methode`
--

DROP TABLE IF EXISTS `fiche_methode`;
CREATE TABLE IF NOT EXISTS `fiche_methode` (
  `met_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`met_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `fiche_methode`
--

INSERT INTO `fiche_methode` (`met_name`) VALUES
('bla '),
('blabla');

-- --------------------------------------------------------

--
-- Structure de la table `fiche_offre`
--

DROP TABLE IF EXISTS `fiche_offre`;
CREATE TABLE IF NOT EXISTS `fiche_offre` (
  `off_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `off_designation` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `off_descriptif` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `off_date_debut` date NOT NULL,
  `off_date_fin` date NOT NULL,
  PRIMARY KEY (`off_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `fiche_offre`
--

INSERT INTO `fiche_offre` (`off_id`, `off_designation`, `off_descriptif`, `off_date_debut`, `off_date_fin`) VALUES
('HR000101', 'Watch 2019', 'Offre Basic Fleet 2019', '2019-01-01', '2019-12-31'),
('HR000102', 'Pilot 2019', 'Offre Basic Fleet 2019', '2019-01-01', '2019-12-31'),
('HR000103', 'Rent 2019', 'Offre Basic Fleet 2019', '2019-01-01', '2019-12-31');

-- --------------------------------------------------------

--
-- Structure de la table `fiche_option`
--

DROP TABLE IF EXISTS `fiche_option`;
CREATE TABLE IF NOT EXISTS `fiche_option` (
  `opt_id` int(11) NOT NULL AUTO_INCREMENT,
  `off_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `met_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `opt_field` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `opt_active` tinyint(1) NOT NULL,
  PRIMARY KEY (`opt_id`),
  KEY `fk_met_name` (`met_name`),
  KEY `fk_off_id` (`off_id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `fiche_option`
--

INSERT INTO `fiche_option` (`opt_id`, `off_id`, `met_name`, `opt_field`, `opt_active`) VALUES
(7, 'HR000102', 'bla', 'retr', 0),
(19, 'HR000101', 'bla', 'rethr', 0),
(22, 'HR000101', 'blabla', 'tgs', 0),
(26, 'HR000101', 'bla', 'hufdtf', 1),
(28, 'HR000101', 'bla', 'hufdtf', 0),
(32, 'HR000101', 'bla', 'tgs', 0),
(35, 'HR000101', 'bla', 'trhr', 0);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `fiche_option`
--
ALTER TABLE `fiche_option`
  ADD CONSTRAINT `fk_met_name` FOREIGN KEY (`met_name`) REFERENCES `fiche_methode` (`met_name`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_off_id` FOREIGN KEY (`off_id`) REFERENCES `fiche_offre` (`off_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
