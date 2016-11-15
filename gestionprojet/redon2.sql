-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mar 31 Mai 2016 à 15:16
-- Version du serveur :  5.5.47-0+deb8u1
-- Version de PHP :  5.6.19-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `redon2`
--

-- --------------------------------------------------------

--
-- Structure de la table `conversation`
--

CREATE TABLE IF NOT EXISTS `conversation` (
`id` int(11) NOT NULL,
  `participant` varchar(255) COLLATE utf8_bin NOT NULL,
  `id_projet` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `conversation`
--

INSERT INTO `conversation` (`id`, `participant`, `id_projet`) VALUES
(1, '& 3 & 2 & 4 &', 1),
(2, '& 2 & 4 &', NULL),
(3, '& 2 & 3 &', NULL);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `directory`
--

INSERT INTO `directory` (`id`, `virtualName`, `parentDirectory`, `project`, `date`) VALUES
(0, 'root', NULL, 1, '2016-05-31'),
(2, 'root', NULL, 1, '2016-05-31');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `message`
--

INSERT INTO `message` (`id`, `id_utilisateur`, `id_conversation`, `message`, `date_message`) VALUES
(1, 2, 2, 'test', '2016-05-31 14:57:27'),
(2, 3, 3, 'test?', '2016-05-31 14:58:39');

-- --------------------------------------------------------

--
-- Structure de la table `projet`
--

CREATE TABLE IF NOT EXISTS `projet` (
`id` int(10) NOT NULL,
  `titre` varchar(255) COLLATE utf8_general_mysql500_ci NOT NULL,
  `dead_line` text COLLATE utf8_general_mysql500_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

--
-- Contenu de la table `projet`
--

INSERT INTO `projet` (`id`, `titre`, `dead_line`) VALUES
(1, '1st Project', '2016-04-15 00:00:00'),
(2, '2nd Project', '2016-04-08 00:00:00'),
(3, 'Test', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id_utilisateur` int(10) NOT NULL,
  `id_projet` int(10) NOT NULL,
  `fonction_attribue` varchar(20) COLLATE utf8_general_mysql500_ci DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

--
-- Contenu de la table `role`
--

INSERT INTO `role` (`id_utilisateur`, `id_projet`, `fonction_attribue`) VALUES
(3, 1, 'Chef'),
(2, 1, 'user'),
(4, 1, 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `tache`
--

CREATE TABLE IF NOT EXISTS `tache` (
`id` int(10) NOT NULL,
  `commentaire` varchar(255) DEFAULT '',
  `intitule` varchar(255) NOT NULL,
  `id_projet` int(10) NOT NULL,
  `dead_line` text NOT NULL,
  `sous_tache_id` int(10) NOT NULL,
  `is_sstache` tinyint(1) DEFAULT NULL,
  `done` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tache`
--

INSERT INTO `tache` (`id`, `commentaire`, `intitule`, `id_projet`, `dead_line`, `sous_tache_id`, `is_sstache`, `done`) VALUES
(1, 'Main', 'Main Task EDIT', 1, '0000-00-00 00:00:00', 0, 0, 0),
(2, 'Mini Task one', 'Mini Task 1', 1, '2016-04-08 00:50:00', 1, 1, 0),
(3, 'Mini Task Two', 'Mini Task 2', 1, '2016-04-08 00:00:00', 1, 1, 0),
(5, 'Comment 2', 'Main Task 2', 1, '2016-04-30 00:00:00', 0, 0, 0),
(6, 'Main Task for P2', 'Task P2', 2, '2016-04-12 00:00:00', 0, 0, 0),
(7, 'Mini Task for TASK 2', 'MiniTASK1', 1, '2016-04-12 00:00:00', 5, 1, 0),
(8, 'Mini Task for TASK 2', 'MiniTASK2', 2, '2016-04-12 00:00:00', 6, 1, 0),
(9, 'MEGA EDIT', 'SUPER EDIT', 1, '2016-04-29 00:59:00', 1, 1, 0),
(11, 'main test', 'Main TEST', 1, '0000-00-00 00:00:00', 0, 0, 0),
(12, 'mini test 2', 'Mini TEST 2', 1, '0000-00-00 00:00:00', 11, 1, 0),
(13, 'mini test 3', 'Mini TEST 3', 1, '0000-00-00 00:00:00', 11, 1, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `mdp`, `email`, `fonction`, `application`, `avatar`, `last_connection`, `is_admin`) VALUES
(2, 'user', 'user', 'user', 'user@user.com', 'user', 0, 'http://funny-pics-fun.com/wp-content/uploads/Very-Funny-Animal-Faces-367x480.jpg', '2016-05-31 14:58:48', 0),
(3, 'chef', 'chef', 'chef', 'chef@chef.com', 'chef', 0, 'http://roflzoo.com/pics/201409/dog-having-a-cupcake.jpg', '2016-01-06 19:18:12', 1),
(4, 'admin', 'admin', 'admin', 'admin@admin.com', 'admin', 0, 'http://static.boredpanda.com/blog/wp-content/uploads/2014/05/funny-animals-doing-yoga-21.jpg', '2016-01-05 13:56:49', 2);

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
 ADD PRIMARY KEY (`id`), ADD KEY `parentDirectory` (`parentDirectory`), ADD KEY `project` (`project`);

--
-- Index pour la table `file`
--
ALTER TABLE `file`
 ADD PRIMARY KEY (`id`), ADD KEY `parentDirectory` (`parentDirectory`), ADD KEY `project` (`project`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
 ADD PRIMARY KEY (`id`), ADD KEY `id_utilisateur` (`id_utilisateur`,`id_conversation`), ADD KEY `id_conversation` (`id_conversation`);

--
-- Index pour la table `projet`
--
ALTER TABLE `projet`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
 ADD KEY `id_utilisateur` (`id_utilisateur`), ADD KEY `id_projet` (`id_projet`);

--
-- Index pour la table `tache`
--
ALTER TABLE `tache`
 ADD PRIMARY KEY (`id`), ADD KEY `id_projet` (`id_projet`), ADD KEY `sous_tache` (`sous_tache_id`);

--
-- Index pour la table `ticket`
--
ALTER TABLE `ticket`
 ADD PRIMARY KEY (`id`), ADD KEY `id_projet` (`id_projet`), ADD KEY `id_utilisateur` (`id_utilisateur`);

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
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `projet`
--
ALTER TABLE `projet`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `tache`
--
ALTER TABLE `tache`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT pour la table `ticket`
--
ALTER TABLE `ticket`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
