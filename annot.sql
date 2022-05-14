-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 20 juil. 2021 à 18:19
-- Version du serveur :  10.4.18-MariaDB
-- Version de PHP : 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `data_base_update2`
--

-- --------------------------------------------------------

--
-- Structure de la table `affectation`
--

CREATE TABLE `affectation` (
  `objectif` int(11) NOT NULL,
  `id_uti` int(11) DEFAULT NULL,
  `id_group` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `affectation`
--

INSERT INTO `affectation` (`objectif`, `id_uti`, `id_group`) VALUES
(26, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `annotation`
--

CREATE TABLE `annotation` (
  `id_annot` int(11) NOT NULL,
  `id_group` int(11) DEFAULT NULL,
  `id_type` int(11) DEFAULT NULL,
  `id_passage` int(11) DEFAULT NULL,
  `question` text DEFAULT NULL,
  `reponse` text DEFAULT NULL,
  `id_uti` int(11) DEFAULT NULL,
  `date_annotation` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `annotation`
--

INSERT INTO `annotation` (`id_annot`, `id_group`, `id_type`, `id_passage`, `question`, `reponse`, `id_uti`, `date_annotation`) VALUES
(1, 1, 1, 1, NULL, NULL, NULL, NULL),
(2, 1, 1, 1, NULL, NULL, NULL, NULL),
(3, 1, 2, 3, NULL, NULL, NULL, NULL),
(4, 1, 2, 2, NULL, NULL, NULL, NULL),
(5, 1, 1, 1, 'how?', 'because', 1, NULL),
(7, 1, 2, 2, 'so he-he-he who has the last laugh?', 'me', 1, NULL),
(8, NULL, NULL, NULL, NULL, NULL, 1, NULL),
(9, 1, 2, 1, 'ff', 'sss', 1, NULL),
(10, 1, 2, 1, 'ff', 'sss', 1, NULL),
(11, 1, 1, 1, 'fff', 'ff', 1, '2021-07-07'),
(12, 1, 2, 1, 'o', 'l', 1, '2021-07-22');

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

CREATE TABLE `groupe` (
  `id_group` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `payant` tinyint(1) DEFAULT NULL,
  `prix_par_annot` int(11) DEFAULT NULL,
  `datedebut` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `groupe`
--

INSERT INTO `groupe` (`id_group`, `nom`, `description`, `payant`, `prix_par_annot`, `datedebut`) VALUES
(1, 'bio', 'bio things', 1, 120, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `passage`
--

CREATE TABLE `passage` (
  `id_passage` int(11) NOT NULL,
  `text_passage` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `passage`
--

INSERT INTO `passage` (`id_passage`, `text_passage`) VALUES
(1, NULL),
(2, NULL),
(3, 'fff');

-- --------------------------------------------------------

--
-- Structure de la table `typequestion`
--

CREATE TABLE `typequestion` (
  `id_type` int(11) NOT NULL,
  `nom_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `typequestion`
--

INSERT INTO `typequestion` (`id_type`, `nom_type`) VALUES
(1, 'tt'),
(2, '');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id_uti` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mdp` varchar(100) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `superutilisateur` tinyint(1) DEFAULT NULL,
  `telephone` int(11) DEFAULT NULL,
  `oldmdp` char(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_uti`, `nom`, `prenom`, `email`, `mdp`, `photo`, `superutilisateur`, `telephone`, `oldmdp`) VALUES
(1, 'Bouchentouf', 'Oussama', 'oussamabouchentouf3@gmail.com', '4a7d1ed414474e4033ac29ccb8653d9b', 'ffff', NULL, NULL, NULL),
(2, 'salam', 'btata', 'oussamabouchentouf6@gmail.com', '4a7d1ed414474e4033ac29ccb8653d9b', '', NULL, 2147483647, NULL),
(3, 'btata', 'btata', '151516131@gmail.com', '4a7d1ed414474e4033ac29ccb8653d9b', '1626796538_Screenshot 2021-04-18 013428.png', NULL, 2147483647, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `affectation`
--
ALTER TABLE `affectation`
  ADD PRIMARY KEY (`objectif`),
  ADD KEY `id_uti` (`id_uti`),
  ADD KEY `id_group` (`id_group`);

--
-- Index pour la table `annotation`
--
ALTER TABLE `annotation`
  ADD PRIMARY KEY (`id_annot`),
  ADD KEY `id_group` (`id_group`),
  ADD KEY `id_type` (`id_type`),
  ADD KEY `id_passage` (`id_passage`),
  ADD KEY `id_uti` (`id_uti`);

--
-- Index pour la table `groupe`
--
ALTER TABLE `groupe`
  ADD PRIMARY KEY (`id_group`);

--
-- Index pour la table `passage`
--
ALTER TABLE `passage`
  ADD PRIMARY KEY (`id_passage`);

--
-- Index pour la table `typequestion`
--
ALTER TABLE `typequestion`
  ADD PRIMARY KEY (`id_type`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id_uti`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `annotation`
--
ALTER TABLE `annotation`
  MODIFY `id_annot` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `groupe`
--
ALTER TABLE `groupe`
  MODIFY `id_group` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `passage`
--
ALTER TABLE `passage`
  MODIFY `id_passage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `typequestion`
--
ALTER TABLE `typequestion`
  MODIFY `id_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id_uti` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `affectation`
--
ALTER TABLE `affectation`
  ADD CONSTRAINT `affectation_ibfk_1` FOREIGN KEY (`id_uti`) REFERENCES `utilisateur` (`id_uti`),
  ADD CONSTRAINT `affectation_ibfk_2` FOREIGN KEY (`id_group`) REFERENCES `groupe` (`id_group`);

--
-- Contraintes pour la table `annotation`
--
ALTER TABLE `annotation`
  ADD CONSTRAINT `annotation_ibfk_1` FOREIGN KEY (`id_group`) REFERENCES `groupe` (`id_group`),
  ADD CONSTRAINT `annotation_ibfk_2` FOREIGN KEY (`id_type`) REFERENCES `typequestion` (`id_type`),
  ADD CONSTRAINT `annotation_ibfk_3` FOREIGN KEY (`id_passage`) REFERENCES `passage` (`id_passage`),
  ADD CONSTRAINT `annotation_ibfk_4` FOREIGN KEY (`id_uti`) REFERENCES `utilisateur` (`id_uti`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
