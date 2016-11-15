-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 10 Février 2016 à 11:34
-- Version du serveur :  5.6.26
-- Version de PHP :  5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `gdp`
--

-- --------------------------------------------------------

--
-- Structure de la table `conversation`
--

CREATE TABLE IF NOT EXISTS `conversation` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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
  `id` int(20) NOT NULL,
  `virtualName` varchar(255) NOT NULL,
  `parentDirectory` int(20) DEFAULT NULL,
  `project` int(20) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

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
  `id` int(20) NOT NULL,
  `virtualName` varchar(255) NOT NULL,
  `parentDirectory` int(20) NOT NULL,
  `src` varchar(2000) NOT NULL,
  `type` varchar(255) NOT NULL,
  `project` int(20) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

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
  `id` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_conversation` int(11) NOT NULL,
  `message` text COLLATE utf8_bin NOT NULL,
  `date_message` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `participant_conversation`
--

CREATE TABLE IF NOT EXISTS `participant_conversation` (
  `id_conversation` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL
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
  `id` int(10) NOT NULL,
  `titre` varchar(255) COLLATE utf8_general_mysql500_ci NOT NULL,
  `dead_line` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id_utilisateur` int(10) NOT NULL,
  `id_projet` int(10) NOT NULL,
  `fonction_attribue` varchar(20) COLLATE utf8_general_mysql500_ci DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

-- --------------------------------------------------------

--
-- Structure de la table `tache`
--

CREATE TABLE IF NOT EXISTS `tache` (
  `id` int(10) NOT NULL,
  `commentaire` varchar(255) DEFAULT '',
  `intitule` varchar(255) NOT NULL,
  `id_projet` int(10) NOT NULL,
  `dead_line` datetime NOT NULL,
  `sous_tache_id` int(10) NOT NULL,
  `is_sstache` tinyint(1) DEFAULT NULL,
  `done` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `ticket`
--

CREATE TABLE IF NOT EXISTS `ticket` (
  `id` int(10) NOT NULL,
  `id_projet` int(10) NOT NULL,
  `id_utilisateur` int(10) NOT NULL,
  `titre` varchar(90) COLLATE utf8_general_mysql500_ci NOT NULL,
  `message` text COLLATE utf8_general_mysql500_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int(10) NOT NULL,
  `nom` varchar(55) COLLATE utf8_general_mysql500_ci NOT NULL,
  `prenom` varchar(55) COLLATE utf8_general_mysql500_ci NOT NULL,
  `mdp` varchar(255) CHARACTER SET utf8 NOT NULL,
  `email` varchar(75) COLLATE utf8_general_mysql500_ci NOT NULL,
  `fonction` varchar(75) COLLATE utf8_general_mysql500_ci NOT NULL,
  `application` tinyint(1) DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8_general_mysql500_ci NOT NULL,
  `last_connection` datetime NOT NULL,
  `is_admin` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `mdp`, `email`, `fonction`, `application`, `avatar`, `last_connection`, `is_admin`) VALUES
(2, 'test1', 'je', 'suis', 't@t.com', 'chef', 0, 'none', '2016-01-06 19:18:15', 0),
(3, 'test2', 'je', 'suis', 't@t.com', 'chef', 0, 'none', '2016-01-06 19:18:12', 0),
(4, 'test3', 'je', 'suis', 't@t.com', 'chef', 0, 'none', '2016-01-05 13:56:49', 0);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `conversation`
--
ALTER TABLE `conversation`
  ADD PRIMARY KEY (`id`);

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
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_utilisateur` (`id_utilisateur`,`id_conversation`),
  ADD KEY `id_conversation` (`id_conversation`);

--
-- Index pour la table `participant_conversation`
--
ALTER TABLE `participant_conversation`
  ADD KEY `id_conversation` (`id_conversation`,`id_utilisateur`),
  ADD KEY `id_utilisateur` (`id_utilisateur`);

--
-- Index pour la table `projet`
--
ALTER TABLE `projet`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD KEY `id_utilisateur` (`id_utilisateur`),
  ADD KEY `id_projet` (`id_projet`);

--
-- Index pour la table `tache`
--
ALTER TABLE `tache`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_projet` (`id_projet`),
  ADD KEY `sous_tache` (`sous_tache_id`);

--
-- Index pour la table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_projet` (`id_projet`),
  ADD KEY `id_utilisateur` (`id_utilisateur`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `conversation`
--
ALTER TABLE `conversation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT pour la table `directory`
--
ALTER TABLE `directory`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `file`
--
ALTER TABLE `file`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `projet`
--
ALTER TABLE `projet`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `tache`
--
ALTER TABLE `tache`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
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
