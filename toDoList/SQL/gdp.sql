-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 04 Janvier 2016 à 22:47
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `gdp`
--

-- --------------------------------------------------------

--
-- Structure de la table `arboressence`
--

CREATE TABLE IF NOT EXISTS `arboressence` (
  `id_projet` int(10) NOT NULL,
  `chemin` varchar(255) COLLATE utf8_general_mysql500_ci NOT NULL,
  `nom` varchar(50) COLLATE utf8_general_mysql500_ci NOT NULL,
  PRIMARY KEY (`chemin`),
  KEY `id_projet` (`id_projet`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fichier`
--

CREATE TABLE IF NOT EXISTS `fichier` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nom_client` varchar(255) COLLATE utf8_general_mysql500_ci NOT NULL,
  `emplacement` varchar(50) COLLATE utf8_general_mysql500_ci NOT NULL,
  `id_projet` int(10) NOT NULL,
  `type` varchar(10) COLLATE utf8_general_mysql500_ci NOT NULL,
  `nom_serveur` varchar(15) COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_projet` (`id_projet`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `projet`
--

CREATE TABLE IF NOT EXISTS `projet` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) COLLATE utf8_general_mysql500_ci NOT NULL,
  `dead_line` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci AUTO_INCREMENT=34 ;

--
-- Contenu de la table `projet`
--

INSERT INTO `projet` (`id`, `titre`, `dead_line`) VALUES
(16, '2nd projet	', '2015-12-24 00:00:00'),
(17, '2nd projet', '2015-12-25 12:00:00'),
(18, '3Ã©me Projet', '2015-12-24 00:00:00'),
(19, '4eme Projet', '2015-12-25 00:00:00'),
(20, '5eme Projet', '2015-12-30 00:00:00'),
(21, '6eme Projet', '2015-12-30 00:00:00'),
(22, '1er projet', '2015-12-24 00:00:00'),
(32, '7eme Projet', '2016-01-03 00:00:00'),
(33, '7eme Projet	bis', '2016-01-21 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id_utilisateur` int(10) NOT NULL,
  `id_projet` int(10) NOT NULL,
  `fonction_attribue` varchar(20) COLLATE utf8_general_mysql500_ci DEFAULT '1',
  KEY `id_utilisateur` (`id_utilisateur`),
  KEY `id_projet` (`id_projet`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

--
-- Contenu de la table `role`
--

INSERT INTO `role` (`id_utilisateur`, `id_projet`, `fonction_attribue`) VALUES
(4, 16, '1'),
(7, 16, '1');

-- --------------------------------------------------------

--
-- Structure de la table `tache`
--

CREATE TABLE IF NOT EXISTS `tache` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `commentaire` varchar(255) DEFAULT '',
  `intitule` varchar(255) NOT NULL,
  `id_projet` int(10) NOT NULL,
  `dead_line` datetime NOT NULL,
  `sous_tache_id` int(10) NOT NULL,
  `is_sstache` tinyint(1) DEFAULT NULL,
  `done` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_projet` (`id_projet`),
  KEY `sous_tache` (`sous_tache_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

--
-- Contenu de la table `tache`
--

INSERT INTO `tache` (`id`, `commentaire`, `intitule`, `id_projet`, `dead_line`, `sous_tache_id`, `is_sstache`, `done`) VALUES
(29, 'RAS', 'tache 2 du second projet', 16, '2015-12-25 00:00:00', 0, 0, NULL),
(33, 'Essai de sous tache', 'sous tache 1 de la tache mere 2', 16, '2015-12-30 00:00:00', 29, 1, NULL),
(34, 'Ca va etre chaud', 'finir le projet', 33, '2016-01-01 00:00:00', 0, 0, NULL),
(35, 'c''est bien parti', 'Aller', 33, '2016-01-03 00:00:00', 34, 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `ticket`
--

CREATE TABLE IF NOT EXISTS `ticket` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_projet` int(10) NOT NULL,
  `id_utilisateur` int(10) NOT NULL,
  `titre` varchar(90) COLLATE utf8_general_mysql500_ci NOT NULL,
  `message` text COLLATE utf8_general_mysql500_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_projet` (`id_projet`),
  KEY `id_utilisateur` (`id_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nom` varchar(55) COLLATE utf8_general_mysql500_ci NOT NULL,
  `prenom` varchar(55) COLLATE utf8_general_mysql500_ci NOT NULL,
  `email` varchar(75) COLLATE utf8_general_mysql500_ci NOT NULL,
  `fonction` varchar(75) COLLATE utf8_general_mysql500_ci NOT NULL,
  `application` tinyint(1) DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8_general_mysql500_ci NOT NULL,
  `mdp` varchar(100) COLLATE utf8_general_mysql500_ci NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci AUTO_INCREMENT=8 ;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `email`, `fonction`, `application`, `avatar`, `mdp`, `is_admin`) VALUES
(4, 'bedon', 'mikael', 'mik@lori.com', 'dev', NULL, 'http://findicons.com/files/icons/1072/face_avatars/300/c05.png', 'azerty', 0),
(5, 'LEM', 'Thibault', 'azerty@azerty.com', 'Dev', NULL, '', 'onsefout', 0),
(6, 'azerty', 'azerty', 'azerty@azerty.com', 'aller', NULL, '', 'onsefout', 0),
(7, 'azertyy', 'azertyy', 'azerty@azerty.com', 'azerty', NULL, '', 'azerty', 1);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `arboressence`
--
ALTER TABLE `arboressence`
  ADD CONSTRAINT `arboressence_ibfk_1` FOREIGN KEY (`id_projet`) REFERENCES `projet` (`id`);

--
-- Contraintes pour la table `fichier`
--
ALTER TABLE `fichier`
  ADD CONSTRAINT `fichier_ibfk_1` FOREIGN KEY (`id_projet`) REFERENCES `projet` (`id`);

--
-- Contraintes pour la table `role`
--
ALTER TABLE `role`
  ADD CONSTRAINT `role_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`),
  ADD CONSTRAINT `role_ibfk_2` FOREIGN KEY (`id_projet`) REFERENCES `projet` (`id`);

--
-- Contraintes pour la table `tache`
--
ALTER TABLE `tache`
  ADD CONSTRAINT `tache_ibfk_1` FOREIGN KEY (`id_projet`) REFERENCES `projet` (`id`);

--
-- Contraintes pour la table `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `ticket_ibfk_1` FOREIGN KEY (`id_projet`) REFERENCES `projet` (`id`),
  ADD CONSTRAINT `ticket_ibfk_2` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
