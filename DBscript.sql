-- phpMyAdmin SQL Dump
-- version 4.9.6
-- https://www.phpmyadmin.net/
--
-- Hôte : g21w3.myd.infomaniak.com
-- Généré le :  mar. 09 fév. 2021 à 22:26
-- Version du serveur :  5.7.32-log
-- Version de PHP :  7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `g21w3_rando`
--

-- --------------------------------------------------------

--
-- Structure de la table `Categories`
--

CREATE TABLE `Categories` (
  `CategID` int(11) NOT NULL,
  `CategoryName` varchar(30) NOT NULL,
  `DataName` varchar(30) NOT NULL,
  `DisplayName` varchar(40) NOT NULL,
  `Color` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Categories`
--

INSERT INTO `Categories` (`CategID`, `CategoryName`, `DataName`, `DisplayName`, `Color`) VALUES
(1, 'Randonnée', 'Compostelle', 'Compostelle', '#FF00FF'),
(2, 'Randonnée', 'ViaFerrata', 'Via ferrata', '#FF00FF'),
(3, 'Randonnée', 'GR', 'GR', '#FF00FF'),
(4, 'Lieu de vie', 'Refuge', 'Refuge', '#FF00FF'),
(5, 'Lieu de vie', 'Bivouac', 'Lieu de bivouac', '#FF00FF'),
(6, 'Eau', 'WaterDrinkable', 'Eau potable', '#0000CC'),
(7, 'Eau', 'WaterSpring', 'Source d\'eau', '#0000CC'),
(8, 'Eau', 'WaterBathing', 'Lieu de baignade', '#0000CC'),
(9, 'Eau', 'WaterFalls', 'Cascade', '#7777FF'),
(10, 'Monuments', 'Ruine', 'Ruine', '#A52A2A'),
(11, 'Monuments', 'Bunker', 'Bunker', '#808080'),
(12, 'FFVL', 'LiftOff', 'Site décollage', '#77B5FE'),
(13, 'FFVL', 'Landing', 'Site atterrissage', '#5480b3'),
(14, 'FFVL', 'Beacons', 'Balises', '#333333'),
(15, 'FFVL', 'Structures', 'Structures', '#b3b3b3'),
(16, 'Autre', 'Other', 'Autre', '#000000');

-- --------------------------------------------------------

--
-- Structure de la table `Images`
--

CREATE TABLE `Images` (
  `ImageID` int(11) NOT NULL,
  `UID` int(11) NOT NULL,
  `URL` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Images`
--

INSERT INTO `Images` (`ImageID`, `UID`, `URL`) VALUES
(1, 1, 'https://www.depannelec-52.fr/images/no-image.png');

-- --------------------------------------------------------

--
-- Structure de la table `Markers`
--

CREATE TABLE `Markers` (
  `MarkerID` int(11) NOT NULL,
  `CategoryID` int(11) NOT NULL,
  `MarkerCategory` varchar(50) NOT NULL,
  `MarkerType` varchar(50) NOT NULL,
  `UID` int(11) NOT NULL,
  `lat` float NOT NULL,
  `lon` float NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Description` varchar(120) NOT NULL,
  `ImageID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Markers`
--

INSERT INTO `Markers` (`MarkerID`, `CategoryID`, `MarkerCategory`, `MarkerType`, `UID`, `lat`, `lon`, `Name`, `Description`, `ImageID`) VALUES
(1, 10, 'Monuments', 'Ruine', 1, 48.2945, 7.38842, 'Château de Ramstein', 'Château de Ramstein', 1),
(2, 10, 'Monuments', 'Ruine', 1, 48.3219, 7.39978, 'Château du Bernstein', 'Château du Bernstein', 1),
(3, 10, 'Monuments', 'Ruine', 1, 48.2958, 7.39214, 'Château de l\'Ortenbourg', 'Château de l\'Ortenbourg', 1);

-- --------------------------------------------------------

--
-- Structure de la table `Users`
--

CREATE TABLE `Users` (
  `UserID` int(11) NOT NULL,
  `GoogleUID` int(11) DEFAULT NULL,
  `ImageID` int(11) DEFAULT NULL,
  `Name` varchar(30) NOT NULL,
  `EMail` varchar(30) NOT NULL,
  `Verrified` char(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Users`
--

INSERT INTO `Users` (`UserID`, `GoogleUID`, `ImageID`, `Name`, `EMail`, `Verrified`) VALUES
(1, NULL, NULL, 'ADMIN', 'appli@depotter.fr', '1');

-- --------------------------------------------------------

--
-- Structure de la table `Votes`
--

CREATE TABLE `Votes` (
  `VoteID` int(11) NOT NULL,
  `UID` int(11) NOT NULL,
  `MarkerID` int(11) NOT NULL,
  `Note` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Categories`
--
ALTER TABLE `Categories`
  ADD PRIMARY KEY (`CategID`),
  ADD UNIQUE KEY `UNIQ` (`DataName`);

--
-- Index pour la table `Images`
--
ALTER TABLE `Images`
  ADD PRIMARY KEY (`ImageID`),
  ADD UNIQUE KEY `UID` (`UID`);

--
-- Index pour la table `Markers`
--
ALTER TABLE `Markers`
  ADD PRIMARY KEY (`MarkerID`),
  ADD KEY `_ImageID` (`ImageID`) USING BTREE,
  ADD KEY `_CategoryID` (`CategoryID`) USING BTREE,
  ADD KEY `_UID` (`UID`) USING BTREE;

--
-- Index pour la table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`UserID`),
  ADD KEY `ImageID` (`ImageID`);

--
-- Index pour la table `Votes`
--
ALTER TABLE `Votes`
  ADD PRIMARY KEY (`VoteID`),
  ADD KEY `UID` (`UID`),
  ADD KEY `MarkerID` (`MarkerID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Categories`
--
ALTER TABLE `Categories`
  MODIFY `CategID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `Images`
--
ALTER TABLE `Images`
  MODIFY `ImageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `Markers`
--
ALTER TABLE `Markers`
  MODIFY `MarkerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `Users`
--
ALTER TABLE `Users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Images`
--
ALTER TABLE `Images`
  ADD CONSTRAINT `Images_ibfk_1` FOREIGN KEY (`UID`) REFERENCES `Users` (`UserID`);

--
-- Contraintes pour la table `Markers`
--
ALTER TABLE `Markers`
  ADD CONSTRAINT `Markers_ibfk_2` FOREIGN KEY (`UID`) REFERENCES `Users` (`UserID`),
  ADD CONSTRAINT `Markers_ibfk_3` FOREIGN KEY (`CategoryID`) REFERENCES `Categories` (`CategID`),
  ADD CONSTRAINT `Markers_ibfk_4` FOREIGN KEY (`ImageID`) REFERENCES `Images` (`ImageID`);

--
-- Contraintes pour la table `Users`
--
ALTER TABLE `Users`
  ADD CONSTRAINT `Users_ibfk_1` FOREIGN KEY (`ImageID`) REFERENCES `Images` (`ImageID`);

--
-- Contraintes pour la table `Votes`
--
ALTER TABLE `Votes`
  ADD CONSTRAINT `Votes_ibfk_1` FOREIGN KEY (`UID`) REFERENCES `Users` (`UserID`),
  ADD CONSTRAINT `Votes_ibfk_2` FOREIGN KEY (`MarkerID`) REFERENCES `Markers` (`MarkerID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
