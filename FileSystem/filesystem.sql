-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Sam 09 Avril 2016 à 00:27
-- Version du serveur :  5.6.26
-- Version de PHP :  5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `filesystem`
--

-- --------------------------------------------------------

--
-- Structure de la table `directory`
--

CREATE TABLE IF NOT EXISTS `directory` (
  `id` int(20) NOT NULL,
  `virtualName` varchar(255) NOT NULL,
  `parentDirectory` int(20) DEFAULT NULL,
  `project` int(20) DEFAULT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `directory`
--

INSERT INTO `directory` (`id`, `virtualName`, `parentDirectory`, `project`, `date`) VALUES
(1, 'root', NULL, 1, '0000-00-00'),
(3, 'Test', 1, 1, '0000-00-00'),
(4, 'test2', 1, 1, '2016-04-08');

-- --------------------------------------------------------

--
-- Structure de la table `file`
--

CREATE TABLE IF NOT EXISTS `file` (
  `id` int(20) NOT NULL,
  `virtualName` varchar(255) NOT NULL,
  `parentDirectory` int(20) NOT NULL,
  `src` varchar(2000) NOT NULL,
  `project` int(20) NOT NULL,
  `type` varchar(255) NOT NULL,
  `mime` varchar(512) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `file`
--

INSERT INTO `file` (`id`, `virtualName`, `parentDirectory`, `src`, `project`, `type`, `mime`, `date`) VALUES
(1, 'BILD1633.JPG', 1, '../uploads/231c8a715aa2e825e7ba2ec1322cdbe4.JPG', 1, 'FileImage', 'image/jpeg', '2016-04-04'),
(2, 'sendCV.php', 1, '../uploads/d2427a6669299a5f7b6c51935dc8c7ed.php', 1, 'FileCode', 'application/x-httpd-php', '2016-04-08'),
(3, 'small.mp4', 1, '../uploads/f8fc076b3792413102223580b271ebf7.mp4', 1, 'FileVideo', 'video/mp4', '2016-04-08');

-- --------------------------------------------------------

--
-- Structure de la table `project`
--

CREATE TABLE IF NOT EXISTS `project` (
  `id` int(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `project`
--

INSERT INTO `project` (`id`) VALUES
(1);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `directory`
--
ALTER TABLE `directory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parentDirectory` (`parentDirectory`),
  ADD KEY `project` (`project`);

--
-- Index pour la table `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parentDirectory` (`parentDirectory`),
  ADD KEY `project` (`project`);

--
-- Index pour la table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `directory`
--
ALTER TABLE `directory`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `file`
--
ALTER TABLE `file`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `project`
--
ALTER TABLE `project`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `directory`
--
ALTER TABLE `directory`
  ADD CONSTRAINT `directory_ibfk_1` FOREIGN KEY (`parentDirectory`) REFERENCES `directory` (`id`),
  ADD CONSTRAINT `directory_ibfk_2` FOREIGN KEY (`project`) REFERENCES `project` (`id`);

--
-- Contraintes pour la table `file`
--
ALTER TABLE `file`
  ADD CONSTRAINT `file_ibfk_1` FOREIGN KEY (`parentDirectory`) REFERENCES `directory` (`id`),
  ADD CONSTRAINT `file_ibfk_2` FOREIGN KEY (`project`) REFERENCES `project` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
