-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Client :  localhost:8889
-- Généré le :  Mer 30 Mai 2018 à 15:52
-- Version du serveur :  5.5.38
-- Version de PHP :  5.6.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `projettt`
--

--
-- Contenu de la table `advert`
--

INSERT INTO `advert` (`id`, `date`, `title`, `author`, `content`, `image_id`) VALUES
(1, '2018-05-08 00:00:00', 'Recherche Développeur Symfony', 'Adrien', 'Bonjour,\r\nDans le cadre de notre évolution nous recherchons un méga dévelopeur.\r\nMerci', 1),
(2, '2018-05-14 00:00:00', 'Recherche stagiaire', 'Bill Gates', 'Nous recherchons pour Microsoft un super stagiaire.', 2),
(3, '2018-05-22 00:00:00', 'Développeur Confirmé PHP', 'Martin', 'Notre société recherche un bon developpeur PHP. Merci de postuler à l''annonce si interressé', NULL);

--
-- Contenu de la table `image`
--

INSERT INTO `image` (`id`, `url`, `alt`) VALUES
(1, 'https://image.freepik.com/free-vector/businesswoman-gears-eye-lupe-human-resources-business-icon_18591-6322.jpg', 'icone travail'),
(2, 'https://www.neopost.fr/sites/neopost.fr/files/styles/w560/public/gde-entreprise.png', 'image société');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
