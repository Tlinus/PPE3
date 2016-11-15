-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 11 Janvier 2016 à 16:18
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `ppe3`
--

-- --------------------------------------------------------

--
-- Structure de la table `conversation`
--

CREATE TABLE IF NOT EXISTS `conversation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=37 ;

--
-- Contenu de la table `conversation`
--

INSERT INTO `conversation` (`id`) VALUES
(36);

-- --------------------------------------------------------

--
-- Structure de la table `directory`
--

CREATE TABLE IF NOT EXISTS `directory` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `virtualName` varchar(255) NOT NULL,
  `parentDirectory` int(20) DEFAULT NULL,
  `project` int(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parentDirectory` (`parentDirectory`),
  KEY `project` (`project`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `directory`
--

INSERT INTO `directory` (`id`, `virtualName`, `parentDirectory`, `project`) VALUES
(1, 'root', NULL, NULL),
(2, 'test', 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `file`
--

CREATE TABLE IF NOT EXISTS `file` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `virtualName` varchar(255) NOT NULL,
  `parentDirectory` int(20) NOT NULL,
  `src` varchar(2000) NOT NULL,
  `type` varchar(255) NOT NULL,
  `project` int(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parentDirectory` (`parentDirectory`),
  KEY `project` (`project`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `file`
--

INSERT INTO `file` (`id`, `virtualName`, `parentDirectory`, `src`, `type`, `project`) VALUES
(1, 'Depositphotos3558738.jpg', 2, '../uploads/d40e903548265d1ac8ee0a0f53c035c5.jpg', 'FileImage', NULL),
(2, 'style.css', 1, '../uploads/b734f1634513e461d15ee86baad16bda.css', 'FileCode', NULL),
(3, 'index.php', 1, '../uploads/0cbbe42bba534bb413ac8536d3f3108d.php', 'FileCode', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int(11) NOT NULL,
  `id_conversation` int(11) NOT NULL,
  `message` text COLLATE utf8_bin NOT NULL,
  `date_message` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_utilisateur` (`id_utilisateur`,`id_conversation`),
  KEY `id_conversation` (`id_conversation`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `participant_conversation`
--

CREATE TABLE IF NOT EXISTS `participant_conversation` (
  `id_conversation` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  KEY `id_conversation` (`id_conversation`,`id_utilisateur`),
  KEY `id_utilisateur` (`id_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `participant_conversation`
--

INSERT INTO `participant_conversation` (`id_conversation`, `id_utilisateur`) VALUES
(36, 2),
(36, 3);

-- --------------------------------------------------------

--
-- Structure de la table `projet`
--

CREATE TABLE IF NOT EXISTS `projet` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) COLLATE utf8_general_mysql500_ci NOT NULL,
  `dead_line` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id_utilisateur` int(10) NOT NULL,
  `id_projet` int(10) NOT NULL,
  `fonction` varchar(20) COLLATE utf8_general_mysql500_ci DEFAULT '1',
  `type` tinyint(1) NOT NULL,
  KEY `id_utilisateur` (`id_utilisateur`),
  KEY `id_projet` (`id_projet`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
  `password` varchar(255) CHARACTER SET utf8 NOT NULL,
  `email` varchar(75) COLLATE utf8_general_mysql500_ci NOT NULL,
  `fonction` varchar(75) COLLATE utf8_general_mysql500_ci NOT NULL,
  `application` tinyint(1) DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8_general_mysql500_ci NOT NULL,
  `last_connection` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci AUTO_INCREMENT=5 ;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `password`, `email`, `fonction`, `application`, `avatar`, `last_connection`) VALUES
(2, 'test1', 'je', 'suis', 't@t.com', 'chef', 0, 'none', '2016-01-06 19:18:15'),
(3, 'test2', 'je', 'suis', 't@t.com', 'chef', 0, 'none', '2016-01-06 19:18:12'),
(4, 'test3', 'je', 'suis', 't@t.com', 'chef', 0, 'none', '2016-01-05 13:56:49');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `directory`
--
ALTER TABLE `directory`
  ADD CONSTRAINT `directory_ibfk_1` FOREIGN KEY (`parentDirectory`) REFERENCES `directory` (`id`),
  ADD CONSTRAINT `directory_ibfk_2` FOREIGN KEY (`project`) REFERENCES `projet` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `file`
--
ALTER TABLE `file`
  ADD CONSTRAINT `file_ibfk_1` FOREIGN KEY (`parentDirectory`) REFERENCES `directory` (`id`),
  ADD CONSTRAINT `file_ibfk_2` FOREIGN KEY (`project`) REFERENCES `projet` (`id`);

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`id_conversation`) REFERENCES `conversation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `participant_conversation`
--
ALTER TABLE `participant_conversation`
  ADD CONSTRAINT `participant_conversation_ibfk_1` FOREIGN KEY (`id_conversation`) REFERENCES `conversation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `participant_conversation_ibfk_2` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
