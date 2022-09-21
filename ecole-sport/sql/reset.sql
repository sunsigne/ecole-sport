-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : jeu. 04 août 2022 à 05:27
-- Version du serveur : 8.0.29
-- Version de PHP : 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `php_expert_1`
--
DROP DATABASE IF EXISTS php_expert_1;
CREATE DATABASE IF NOT EXISTS php_expert_1 CHARACTER SET `utf8`;
USE php_expert_1;


-- --------------------------------------------------------

--
-- Structure de la table `ecole`
--

CREATE TABLE `ecole` (
  `id_ecole` int NOT NULL,
  `nom_ecole` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `ecole`
--

INSERT INTO `ecole` (`id_ecole`, `nom_ecole`) VALUES
(1, 'Ecole A'),
(2, 'Ecole B'),
(3, 'Ecole C');

-- --------------------------------------------------------

--
-- Structure de la table `eleve`
--

CREATE TABLE `eleve` (
  `id_eleve` int NOT NULL,
  `nom_eleve` varchar(64) NOT NULL,
  `id_ecole` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `enseigner`
--

CREATE TABLE `enseigner` (
  `id_enseigne` int NOT NULL,
  `id_ecole` int NOT NULL,
  `id_sport` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `pratiquer`
--

CREATE TABLE `pratiquer` (
  `id_pratiquer` int NOT NULL,
  `id_eleve` int NOT NULL,
  `id_sport` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `sport`
--

CREATE TABLE `sport` (
  `id_sport` int NOT NULL,
  `nom_sport` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `sport`
--

INSERT INTO `sport` (`id_sport`, `nom_sport`) VALUES
(1, 'boxe'),
(2, 'judo'),
(3, 'football'),
(4, 'natation'),
(5, 'cyclisme');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `ecole`
--
ALTER TABLE `ecole`
  ADD PRIMARY KEY (`id_ecole`);

--
-- Index pour la table `eleve`
--
ALTER TABLE `eleve`
  ADD PRIMARY KEY (`id_eleve`),
  ADD KEY `id_ecole` (`id_ecole`);

--
-- Index pour la table `enseigner`
--
ALTER TABLE `enseigner`
  ADD PRIMARY KEY (`id_enseigne`),
  ADD KEY `id_ecole` (`id_ecole`),
  ADD KEY `id_sport` (`id_sport`);

--
-- Index pour la table `pratiquer`
--
ALTER TABLE `pratiquer`
  ADD PRIMARY KEY (`id_pratiquer`),
  ADD KEY `id_eleve` (`id_eleve`),
  ADD KEY `id_sport` (`id_sport`);

--
-- Index pour la table `sport`
--
ALTER TABLE `sport`
  ADD PRIMARY KEY (`id_sport`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `ecole`
--
ALTER TABLE `ecole`
  MODIFY `id_ecole` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `eleve`
--
ALTER TABLE `eleve`
  MODIFY `id_eleve` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `enseigner`
--
ALTER TABLE `enseigner`
  MODIFY `id_enseigne` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pratiquer`
--
ALTER TABLE `pratiquer`
  MODIFY `id_pratiquer` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `sport`
--
ALTER TABLE `sport`
  MODIFY `id_sport` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `eleve`
--
ALTER TABLE `eleve`
  ADD CONSTRAINT `eleve_ibfk_1` FOREIGN KEY (`id_ecole`) REFERENCES `ecole` (`id_ecole`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `enseigner`
--
ALTER TABLE `enseigner`
  ADD CONSTRAINT `enseigner_ibfk_1` FOREIGN KEY (`id_ecole`) REFERENCES `ecole` (`id_ecole`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `enseigner_ibfk_2` FOREIGN KEY (`id_sport`) REFERENCES `sport` (`id_sport`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `pratiquer`
--
ALTER TABLE `pratiquer`
  ADD CONSTRAINT `pratiquer_ibfk_1` FOREIGN KEY (`id_eleve`) REFERENCES `eleve` (`id_eleve`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `pratiquer_ibfk_2` FOREIGN KEY (`id_sport`) REFERENCES `sport` (`id_sport`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
