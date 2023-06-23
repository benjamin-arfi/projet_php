-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 23 juin 2023 à 11:44
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mes_produits`
--

-- --------------------------------------------------------

--
-- Structure de la table `information produit`
--

DROP TABLE IF EXISTS `information produit`;
CREATE TABLE IF NOT EXISTS `information produit` (
  `Nom du produit` varchar(50) NOT NULL,
  `Marque` varchar(50) NOT NULL,
  `Code bar` varchar(13) NOT NULL,
  `Rayon` varchar(50) NOT NULL,
  `Stock restant` varchar(2) NOT NULL,
  `id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `information produit`
--

INSERT INTO `information produit` (`Nom du produit`, `Marque`, `Code bar`, `Rayon`, `Stock restant`, `id`) VALUES
('Chocolat', 'Lindt', '3103220049297', 'Confiserie', '15', 1),
('Bonbon', 'Harribo', '3228857001835', 'Bonbon', '15', 2),
('Baguette', 'Harrys', '3228857001835', 'Pain', '5', 6),
('Vin', 'Or de la castinelle', '3760125946696', 'Spiritueux', '10', 4),
('Champignon', 'Espagne', '3222471005149', 'Fruits et legumes', '10', 5);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
