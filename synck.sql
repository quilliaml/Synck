-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 20 juil. 2020 à 13:14
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
-- Base de données :  `synck`
--

-- --------------------------------------------------------

--
-- Structure de la table `files`
--

DROP TABLE IF EXISTS `files`;
CREATE TABLE IF NOT EXISTS `files` (
  `f_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `f_filename` varchar(255) DEFAULT NULL,
  `f_filesize` int(10) UNSIGNED DEFAULT 0,
  `f_date` datetime DEFAULT NULL,
  `f_type` varchar(10) DEFAULT NULL,
  `RH` tinyint(1) NOT NULL DEFAULT 0,
  `NetworkTeam` tinyint(1) NOT NULL DEFAULT 0,
  `Accounting` tinyint(1) NOT NULL DEFAULT 0,
  `Developers` tinyint(1) NOT NULL DEFAULT 0,
  `Project` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`f_id`),
  UNIQUE KEY `f_id` (`f_id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `files`
--

INSERT INTO `files` (`f_id`, `f_filename`, `f_filesize`, `f_date`, `f_type`, `RH`, `NetworkTeam`, `Accounting`, `Developers`, `Project`) VALUES
(1, 'TEST 1RH.docx', 11959, '2020-07-20 14:34:45', 'docx', 1, 0, 0, 0, 0),
(2, 'TEST 1RH.pdf', 30155, '2020-07-20 14:35:07', 'pdf', 1, 0, 0, 0, 0),
(3, 'TEST 1RH.png', 6019, '2020-07-20 14:35:12', 'png', 1, 0, 0, 0, 0),
(4, 'TEST 2RH.docx', 12043, '2020-07-20 14:35:27', 'docx', 1, 0, 0, 0, 0),
(5, 'TEST 2RH.pdf', 30469, '2020-07-20 14:35:51', 'pdf', 1, 0, 0, 0, 0),
(6, 'TEST 2RH.png', 4062, '2020-07-20 14:35:58', 'png', 1, 0, 0, 0, 0),
(7, 'TEST 1NET.pdf', 29727, '2020-07-20 14:37:15', 'pdf', 0, 1, 0, 0, 0),
(8, 'TEST 2NET.pdf', 30055, '2020-07-20 14:37:22', 'pdf', 0, 1, 0, 0, 0),
(9, 'TEST 1NET.docx', 11973, '2020-07-20 14:37:28', 'docx', 0, 1, 0, 0, 0),
(10, 'TEST 2NET.docx', 12009, '2020-07-20 14:37:33', 'docx', 0, 1, 0, 0, 0),
(11, 'TEST 1NET.png', 6019, '2020-07-20 14:37:38', 'png', 0, 1, 0, 0, 0),
(12, 'TEST 2NET.png', 4062, '2020-07-20 14:37:43', 'png', 0, 1, 0, 0, 0),
(13, 'TEST 1ACC.pdf', 30395, '2020-07-20 14:37:59', 'pdf', 0, 0, 1, 0, 0),
(14, 'TEST 2ACC.pdf', 30720, '2020-07-20 14:38:08', 'pdf', 0, 0, 1, 0, 0),
(15, 'TEST 1ACC.docx', 11962, '2020-07-20 14:38:13', 'docx', 0, 0, 1, 0, 0),
(16, 'TEST 2ACC.docx', 12001, '2020-07-20 14:38:18', 'docx', 0, 0, 1, 0, 0),
(17, 'TEST 1ACC.png', 6019, '2020-07-20 14:38:23', 'png', 0, 0, 1, 0, 0),
(18, 'TEST 2ACC.png', 4062, '2020-07-20 14:38:31', 'png', 0, 0, 1, 0, 0),
(19, 'TEST 1DEV.pdf', 29950, '2020-07-20 14:38:53', 'pdf', 0, 0, 0, 1, 0),
(20, 'TEST 2DEV.pdf', 30258, '2020-07-20 14:38:58', 'pdf', 0, 0, 0, 1, 0),
(21, 'TEST 1DEV.docx', 11982, '2020-07-20 14:39:01', 'docx', 0, 0, 0, 1, 0),
(22, 'TEST 2DEV.docx', 12019, '2020-07-20 14:39:05', 'docx', 0, 0, 0, 1, 0),
(23, 'TEST 1DEV.png', 6019, '2020-07-20 14:39:12', 'png', 0, 0, 0, 1, 0),
(24, 'TEST 2DEV.png', 4062, '2020-07-20 14:39:28', 'png', 0, 0, 0, 1, 0),
(25, 'TEST 1PROJ.pdf', 31095, '2020-07-20 14:40:03', 'pdf', 0, 0, 0, 0, 1),
(30, 'TEST 2PROJ.pdf', 31447, '2020-07-20 14:43:21', 'pdf', 0, 0, 0, 0, 1),
(27, 'TEST 1PROJ.docx', 11979, '2020-07-20 14:40:22', 'docx', 0, 0, 0, 0, 1),
(28, 'TEST 2PROJ.docx', 12024, '2020-07-20 14:40:27', 'docx', 0, 0, 0, 0, 1),
(29, 'TEST 2PROJ.png', 4062, '2020-07-20 14:40:40', 'png', 0, 0, 0, 0, 1),
(31, 'TEST 1PROJ.png', 6019, '2020-07-20 14:43:53', 'png', 0, 0, 0, 0, 1),
(32, 'TEST 1ACC.mp3', 18128, '2020-07-20 14:57:07', 'mp3', 0, 0, 1, 0, 0),
(33, 'TEST 1NET.mp3', 18128, '2020-07-20 14:58:12', 'mp3', 0, 1, 0, 0, 0),
(34, 'TEST 1RH.mp3', 18128, '2020-07-20 14:59:02', 'mp3', 1, 0, 0, 0, 0),
(35, 'TEST 1DEV.mp3', 18128, '2020-07-20 14:59:47', 'mp3', 0, 0, 0, 1, 0),
(36, 'TEST 1PROJ.mp3', 18128, '2020-07-20 15:00:30', 'mp3', 0, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(250) NOT NULL,
  `first_name` varchar(250) NOT NULL,
  `last_name` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0,
  `write` tinyint(1) NOT NULL DEFAULT 0,
  `RH` tinyint(1) NOT NULL DEFAULT 0,
  `NetworkTeam` tinyint(1) NOT NULL DEFAULT 0,
  `Accounting` tinyint(1) NOT NULL DEFAULT 0,
  `Developers` tinyint(1) NOT NULL DEFAULT 0,
  `Project` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pseudo` (`pseudo`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `pseudo`, `first_name`, `last_name`, `password`, `email`, `admin`, `write`, `RH`, `NetworkTeam`, `Accounting`, `Developers`, `Project`) VALUES
(1, 'admin', 'admin', 'admin', '$2y$10$vkggFSRkQiT0f/Y8Cx6Mx.B4oLAIeIX8j9JBMCz30KQYDykwwX51K', 'admin@admin.fr', 1, 0, 1, 1, 1, 1, 1),
(2, 'admin2', 'admin2', 'admin2', '$2y$10$o23mPKDg9LjKtcqu9Oo9/O4DugLzXnCoeP7Quipc53vidcoNbPjqS', 'admin2@admin2.fr', 1, 0, 1, 0, 1, 1, 0),
(3, 'user', 'user', 'user', '$2y$10$GmlRntSUKGM0U1ndtLXhfOrgQTVc6eKYYPIHkOe4fmDChE0OZ94AS', 'user@user.fr', 0, 0, 1, 0, 0, 1, 1),
(4, 'user2', 'user2', 'user2', '$2y$10$DkSPaDnOtAqHRAt3q2Uga.N2N4L/UPCZ/2Vpixz8DC7INNNXKZSnq', 'user2@user2.fr', 0, 0, 1, 0, 0, 0, 0),
(5, 'user3', 'user3', 'user3', '$2y$10$vRZlKaR3IvQBZTvEOoRun.WQcVFmfdbkzReEr/gaf2oFKHSZmWWcC', 'user3@user3.fr', 0, 0, 1, 0, 0, 0, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
