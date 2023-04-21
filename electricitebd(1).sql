-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 10 mars 2023 à 17:03
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `electricitebd`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `idAdmin` int(100) NOT NULL,
  `addressEmail` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`idAdmin`, `addressEmail`, `mdp`) VALUES
(2, 'rifaiaya2002@gmail.com', '$2y$10$jQbiJAiiVEKHX.KUOZYmXuGutkH8ZoAMPxknIdwcRIF9.xBwRFbvm'),
(3, 'admin@gmail.com', '$2y$10$WcRX1e6Aig/uNbXG8qQZdua9moG46aRvNcQkfpUsL1Ho8dqY7BXZK');

-- --------------------------------------------------------

--
-- Structure de la table `agent`
--

CREATE TABLE `agent` (
  `id` int(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `dateOfBirth` date NOT NULL,
  `tel` varchar(45) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `anneeAimporter` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `agent`
--

INSERT INTO `agent` (`id`, `lastName`, `firstName`, `dateOfBirth`, `tel`, `email`, `mdp`, `anneeAimporter`) VALUES
(1, 'alaoui', 'ahmed', '1985-02-07', '0610417151', 'agent1@gmail.com', '$2y$10$TFjV7/dLBn4MZ6VJqZJLvuJ5gkj9xJ33saBxg1sd6ksqAu.3AjXze', 2022),
(2, 'Alami', 'Ali', '1975-02-07', '0610317151', 'agent2@gmail.com', '$2y$10$g/d59EVck3tiGJ6aPz9XJux5eOQKK6Ffb0HMGK/iUAJitQtwT7tu6', 2021),
(3, 'rifki', 'Homam', '1987-02-07', '0616517151', 'agent3@gmail.com', '$2y$10$txEr1btUvQf8FZQUdbvcp.ii8Id5tHu4sS/8wBjyDepWacRSwXtiq', 2021);

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `idClient` int(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `dateOfBirth` date NOT NULL,
  `tel` varchar(45) NOT NULL,
  `email` varchar(255) NOT NULL,
  `adressResid` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `reserve` double NOT NULL,
  `idZoneGeo` int(100) NOT NULL,
  `idAdmin` int(100) NOT NULL,
  `moisApayer` int(20) NOT NULL,
  `anneeApayer` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`idClient`, `lastName`, `firstName`, `dateOfBirth`, `tel`, `email`, `adressResid`, `mdp`, `reserve`, `idZoneGeo`, `idAdmin`, `moisApayer`, `anneeApayer`) VALUES
(42, 'RIFAI', 'Aya', '2002-02-16', '0610201030', 'aya.rifai@etu.uae.ac.ma', 'adresse3245', '$2y$10$r7HSwKHhHoHfh8IyoDYwY.gCjSDEo5tnrQE2YJd.FuYJN9oYyFLCu', 0, 2, 2, 4, 2021),
(43, 'Haki', 'Ihssan', '2003-03-17', '0610211548', 'rifaiaya2002@gmail.com', 'Wilaya Tetouan', '$2y$10$Z/AxmG62ymBjrI9iiiKAjeaW1Yixn2WNEJJtnjP2d/FIQJ2k8bfki', 0, 1, 2, 2, 2021),
(47, 'alami', 'ziad', '1992-07-15', '0612547832', 'rifaiahmed3@gmail.com', 'adresse 321', '$2y$10$GsxERvx7ugY8gMwen3PoqOeI3XtKgTfUmqvuxA8kXTOoc8nOTaTGG', 0, 3, 2, 2, 2021);

-- --------------------------------------------------------

--
-- Structure de la table `consommations`
--

CREATE TABLE `consommations` (
  `id` int(255) NOT NULL,
  `mois` int(50) NOT NULL,
  `annee` int(50) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `valCompteur` int(255) NOT NULL,
  `consomMensuelle` double DEFAULT NULL,
  `prixHT` int(255) DEFAULT NULL,
  `prixTTC` int(255) DEFAULT NULL,
  `state` int(5) NOT NULL,
  `urlFacture` varchar(255) DEFAULT NULL,
  `idClient` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `consommations`
--

INSERT INTO `consommations` (`id`, `mois`, `annee`, `image_path`, `valCompteur`, `consomMensuelle`, `prixHT`, `prixTTC`, `state`, `urlFacture`, `idClient`) VALUES
(97, 2, 2020, '../imgsCompteurs/42_2_2020_Compteur-electricite.jpg', 300, 300, 336, 383, 1, './factures/42_2_2020.pdf', 42),
(98, 3, 2020, '../imgsCompteurs/42_3_2020_im2.jpg', 700, 400, 448, 511, 1, './factures/42_3_2020.pdf', 42),
(99, 4, 2020, '../imgsCompteurs/42_4_2020_im3.jpg', 1220, 520, 582, 664, 1, './factures/42_4_2020.pdf', 42),
(100, 3, 2020, '../imgsCompteurs/43_3_2020_im2.jpg', 400, 400, 448, 511, 1, './factures/43_3_2020.pdf', 43),
(101, 4, 2020, '../imgsCompteurs/43_4_2020_im3.jpg', 900, 500, 560, 638, 1, './factures/43_4_2020.pdf', 43),
(102, 5, 2020, '../imgsCompteurs/43_5_2020_im3.jpg', 1500, 600, 672, 766, 1, './factures/43_5_2020.pdf', 43),
(103, 5, 2020, '../imgsCompteurs/42_5_2020_Compteur-electricite.jpg', 2000, 780, 874, 996, 1, './factures/42_5_2020.pdf', 42),
(104, 3, 2020, '../imgsCompteurs/47_3_2020_Compteur-electricite.jpg', 200, 200, 202, 230, 1, './factures/47_3_2020.pdf', 47),
(105, 4, 2020, '../imgsCompteurs/47_4_2020_im2.jpg', 500, 300, 336, 383, 1, './factures/47_4_2020.pdf', 47),
(106, 5, 2020, '../imgsCompteurs/47_5_2020_im3.jpg', 900, 400, 448, 511, 1, './factures/47_5_2020.pdf', 47),
(107, 6, 2020, '../imgsCompteurs/47_6_2020_Compteur-electricite.jpg', 1000, 100, 91, 104, 1, './factures/47_6_2020.pdf', 47),
(108, 7, 2020, '../imgsCompteurs/47_7_2020_Compteur-electricite.jpg', 1200, 200, 202, 230, 1, './factures/47_7_2020.pdf', 47),
(109, 8, 2020, '../imgsCompteurs/47_8_2020_im2.jpg', 1300, 100, 91, 104, 1, './factures/47_8_2020.pdf', 47),
(110, 9, 2020, '../imgsCompteurs/47_9_2020_im3.jpg', 1500, 200, 202, 230, 1, './factures/47_9_2020.pdf', 47),
(111, 10, 2020, '../imgsCompteurs/47_10_2020_im3.jpg', 1800, 300, 336, 383, 1, './factures/47_10_2020.pdf', 47),
(112, 11, 2020, '../imgsCompteurs/47_11_2020_im3.jpg', 2100, 300, 336, 383, 1, './factures/47_11_2020.pdf', 47),
(113, 12, 2020, '../imgsCompteurs/47_12_2020_im3.jpg', 2200, 100, 91, 104, 1, './factures/47_12_2020.pdf', 47),
(114, 6, 2020, '../imgsCompteurs/42_6_2020_im2.jpg', 2200, 200, 202, 230, 1, './factures/42_6_2020.pdf', 42),
(115, 7, 2020, '../imgsCompteurs/42_7_2020_im3.jpg', 2300, 100, 91, 104, 1, './factures/42_7_2020.pdf', 42),
(116, 8, 2020, '../imgsCompteurs/42_8_2020_im2.jpg', 2500, 200, 202, 230, 1, './factures/42_8_2020.pdf', 42),
(117, 9, 2020, '../imgsCompteurs/42_9_2020_im3.jpg', 2900, 400, 448, 511, 1, './factures/42_9_2020.pdf', 42),
(118, 10, 2020, '../imgsCompteurs/42_10_2020_Compteur-electricite.jpg', 3000, 100, 91, 104, 1, './factures/42_10_2020.pdf', 42),
(119, 11, 2020, '../imgsCompteurs/42_11_2020_im2.jpg', 3200, 200, 202, 230, 1, './factures/42_11_2020.pdf', 42),
(120, 12, 2020, '../imgsCompteurs/42_12_2020_im3.jpg', 3500, 300, 336, 383, 1, './factures/42_12_2020.pdf', 42),
(121, 6, 2020, '../imgsCompteurs/43_6_2020_Compteur-electricite.jpg', 1800, 300, 336, 383, 1, './factures/43_6_2020.pdf', 43),
(122, 7, 2020, '../imgsCompteurs/43_7_2020_im2.jpg', 2000, 200, 202, 230, 1, './factures/43_7_2020.pdf', 43),
(123, 8, 2020, '../imgsCompteurs/43_8_2020_im3.jpg', 2100, 100, 91, 104, 1, './factures/43_8_2020.pdf', 43),
(124, 9, 2020, '../imgsCompteurs/43_9_2020_im3.jpg', 2500, 400, 448, 511, 1, './factures/43_9_2020.pdf', 43),
(125, 10, 2020, '../imgsCompteurs/43_10_2020_im3.jpg', 2600, 100, 91, 104, 1, './factures/43_10_2020.pdf', 43),
(126, 11, 2020, '../imgsCompteurs/43_11_2020_im3.jpg', 2800, 200, 202, 230, 1, './factures/43_11_2020.pdf', 43),
(127, 12, 2020, '../imgsCompteurs/43_12_2020_im3.jpg', 3100, 300, 336, 383, 1, './factures/43_12_2020.pdf', 43),
(128, 1, 2021, '../imgsCompteurs/42_1_2021_Compteur-electricite.jpg', 3800, 300, 336, 383, 0, './factures/42_1_2021.pdf', 42),
(129, 1, 2021, '../imgsCompteurs/47_1_2021_im2.jpg', 1800, NULL, NULL, NULL, -1, NULL, 47),
(130, 2, 2021, '../imgsCompteurs/42_2_2021_Compteur-electricite.jpg', 3900, 100, 91, 104, 0, './factures/42_2_2021.pdf', 42),
(131, 1, 2021, '../imgsCompteurs/43_1_2021_im2.jpg', 3300, 200, 202, 230, 0, './factures/43_1_2021.pdf', 43),
(132, 3, 2021, '../imgsCompteurs/42_3_2021_Compteur-electricite.jpg', 4900, 1000, 1120, 1277, 0, './factures/42_3_2021.pdf', 42);

-- --------------------------------------------------------

--
-- Structure de la table `consomm_annuelle`
--

CREATE TABLE `consomm_annuelle` (
  `id` int(100) NOT NULL,
  `idClient` int(100) NOT NULL,
  `consommAnnuelle` double NOT NULL,
  `idZoneGeo` int(100) NOT NULL,
  `annee` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `consomm_annuelle`
--

INSERT INTO `consomm_annuelle` (`id`, `idClient`, `consommAnnuelle`, `idZoneGeo`, `annee`) VALUES
(16, 43, 3110, 1, 2020),
(18, 42, 3700, 2, 2020),
(19, 47, 1640, 3, 2020);

-- --------------------------------------------------------

--
-- Structure de la table `reclamations`
--

CREATE TABLE `reclamations` (
  `id` int(100) NOT NULL,
  `type` varchar(255) NOT NULL,
  `objet` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `state` int(5) NOT NULL,
  `date` date NOT NULL,
  `idClient` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reclamations`
--

INSERT INTO `reclamations` (`id`, `type`, `objet`, `description`, `state`, `date`, `idClient`) VALUES
(4, 'Fuite externe/interne', 'Fuite', 'Bonjour, s\'il vous plait j\'ai une fuite à domicile.\r\nVeuillez résoudre mon problème le plus tot possible!', 1, '2023-03-10', 42),
(5, 'Fuite externe/interne', 'o1', 'desription 1', 0, '2023-03-10', 42);

-- --------------------------------------------------------

--
-- Structure de la table `reponses`
--

CREATE TABLE `reponses` (
  `id` int(100) NOT NULL,
  `reponse` text NOT NULL,
  `date` date NOT NULL,
  `idAdmin` int(100) DEFAULT NULL,
  `idClient` int(100) DEFAULT NULL,
  `idReclamation` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reponses`
--

INSERT INTO `reponses` (`id`, `reponse`, `date`, `idAdmin`, `idClient`, `idReclamation`) VALUES
(2, 'helooooooo is there anyone here?', '2023-03-05', NULL, 42, 2),
(3, 'no answer yet?', '2023-03-05', NULL, 42, 2),
(4, 'reaally?', '2023-03-05', NULL, 42, 2),
(5, 'Pardon pour le retard de réponse!', '2023-03-05', 2, NULL, 2),
(6, 'On va résoudre ce problème!', '2023-03-05', 2, NULL, 2),
(7, 'c\'est bien résolu merci!', '2023-03-05', NULL, 42, 2),
(8, '', '2023-03-06', NULL, 42, 3),
(9, 'On va vérifier et on va vous répndre d\'ici 48h.Merci pour votre compréhension', '2023-03-07', 2, NULL, 3),
(10, 'On va vous envoyer notre technicien dans ces 24h. Merci pour votre compréhension.', '2023-03-10', 2, NULL, 4),
(11, 'lorsque le problème se résout merci de cliquer sur le bouton &quot;réclamation résolueé', '2023-03-10', 2, NULL, 4);

-- --------------------------------------------------------

--
-- Structure de la table `zonegeo`
--

CREATE TABLE `zonegeo` (
  `id` int(100) NOT NULL,
  `nomZone` varchar(100) NOT NULL,
  `idAgent` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `zonegeo`
--

INSERT INTO `zonegeo` (`id`, `nomZone`, `idAgent`) VALUES
(1, 'zone Centre Ville', 1),
(2, 'zone Martil', 2),
(3, 'zone Mdiq', 3);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`idAdmin`),
  ADD UNIQUE KEY `addressEmail` (`addressEmail`);

--
-- Index pour la table `agent`
--
ALTER TABLE `agent`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`idClient`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `consommations`
--
ALTER TABLE `consommations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `consomm_annuelle`
--
ALTER TABLE `consomm_annuelle`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reclamations`
--
ALTER TABLE `reclamations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reponses`
--
ALTER TABLE `reponses`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `zonegeo`
--
ALTER TABLE `zonegeo`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `idAdmin` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `agent`
--
ALTER TABLE `agent`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `idClient` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT pour la table `consommations`
--
ALTER TABLE `consommations`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT pour la table `consomm_annuelle`
--
ALTER TABLE `consomm_annuelle`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `reclamations`
--
ALTER TABLE `reclamations`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `reponses`
--
ALTER TABLE `reponses`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `zonegeo`
--
ALTER TABLE `zonegeo`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
