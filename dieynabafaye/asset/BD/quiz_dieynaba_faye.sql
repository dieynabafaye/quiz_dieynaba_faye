-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 15 juin 2020 à 10:00
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
-- Base de données :  `quiz_dieynaba_faye`
--

-- --------------------------------------------------------

--
-- Structure de la table `dejajouer`
--

DROP TABLE IF EXISTS `dejajouer`;
CREATE TABLE IF NOT EXISTS `dejajouer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numuser` int(11) NOT NULL,
  `numquestion` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `numuser` (`numuser`),
  KEY `numquestion` (`numquestion`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `dejajouer`
--

INSERT INTO `dejajouer` (`id`, `numuser`, `numquestion`) VALUES
(1, 26, 1),
(2, 26, 5),
(3, 26, 6),
(4, 26, 4);

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question` (
  `numquestion` int(11) NOT NULL AUTO_INCREMENT,
  `nomquestion` text NOT NULL,
  `nbpoint` int(11) NOT NULL,
  `type` varchar(250) NOT NULL,
  `reponse` text NOT NULL,
  `vrais` text NOT NULL,
  PRIMARY KEY (`numquestion`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `question`
--

INSERT INTO `question` (`numquestion`, `nomquestion`, `nbpoint`, `type`, `reponse`, `vrais`) VALUES
(1, 'Les langages web?', 6, 'choixMultiple', '-HTML-php-java', '-1-2-3'),
(4, 'la capital de la gambie', 11, 'choixSimple', '-Simplon-Banjul', '2'),
(5, 'la capital du SÃ©nÃ©gal?', 5, 'choixSimple', '-Dakar-Thies', '1'),
(6, 'Premier Ã©cole de codage gratuite au SÃ©nÃ©gal?', 10, 'choixSimple', '-Simplon-Orange Digital Center', '2');

-- --------------------------------------------------------

--
-- Structure de la table `score`
--

DROP TABLE IF EXISTS `score`;
CREATE TABLE IF NOT EXISTS `score` (
  `numscore` int(11) NOT NULL AUTO_INCREMENT,
  `score` varchar(250) NOT NULL,
  `numuser` int(11) NOT NULL,
  PRIMARY KEY (`numscore`),
  KEY `score_ibfk_1` (`numuser`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `score`
--

INSERT INTO `score` (`numscore`, `score`, `numuser`) VALUES
(16, '0', 24),
(18, '32', 26),
(19, '0', 27);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `numuser` int(11) NOT NULL AUTO_INCREMENT,
  `prenom` varchar(250) NOT NULL,
  `nom` varchar(250) NOT NULL,
  `login` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `role` varchar(250) NOT NULL,
  `avatar` varchar(50) NOT NULL,
  `privilege` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`numuser`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`numuser`, `prenom`, `nom`, `login`, `password`, `role`, `avatar`, `privilege`) VALUES
(3, 'Dieynaba', 'FAYE', 'diana', 'ca7669cfc26196d72f7d5297cf1bc606', 'admin', '', 1),
(5, 'Moussa', 'Dabo', 'moussa', '639583119441bd84c373c314afd2814d', 'joueur', 'IMG-20200307-WA0030[1].jpg', 1),
(8, 'Diana', 'FAYE', 'diana1', '601ada040a4381a031dd4e3d2a3d4f15', 'joueur', 'diana.jpg', 1),
(9, 'admin', 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'FB_IMG_1464614840654.jpg', 1),
(10, 'joueur', 'joueur', 'joueur', '7b68f94205ba21d3c654e65f03f7ca4e', 'joueur', 'IMG-20190101-WA0230[1].jpg', 1),
(11, 'Fatima', 'Sow', 'fatima', 'b5d5f67b30809413156655abdda382a3', 'joueur', 'FB_IMG_1464614840654.jpg', 1),
(24, 'Assane', 'Dione', 'assane', '2e94e8dc270f9e2fff107aaa6e0e04e7', 'joueur', 'IMG-20200219-WA0012[1].jpg', 1),
(26, 'Aminata', 'FAYE', 'amina', 'bd82dd2a8b944f131d0a53bc1b473029', 'joueur', 'amina[1].jpg', 1),
(27, 'Famara', 'SARR', 'famara', 'c11c10f899943c08380e4a833d7e7b2b', 'joueur', 'IMG-20190101-WA0230[1].jpg', 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `dejajouer`
--
ALTER TABLE `dejajouer`
  ADD CONSTRAINT `dejajouer_ibfk_1` FOREIGN KEY (`numuser`) REFERENCES `user` (`numuser`),
  ADD CONSTRAINT `dejajouer_ibfk_2` FOREIGN KEY (`numquestion`) REFERENCES `question` (`numquestion`);

--
-- Contraintes pour la table `score`
--
ALTER TABLE `score`
  ADD CONSTRAINT `score_ibfk_1` FOREIGN KEY (`numuser`) REFERENCES `user` (`numuser`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
