-- phpMyAdmin SQL Dump
-- version 4.9.6
-- https://www.phpmyadmin.net/
--
-- Hôte : g21w3.myd.infomaniak.com
-- Généré le :  jeu. 11 fév. 2021 à 11:19
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
(1, 1, 'https://www.depannelec-52.fr/images/no-image.png'),
(4, 1, '/src/users/admin-chapelle.png');

-- --------------------------------------------------------

--
-- Structure de la table `Markers`
--

CREATE TABLE `Markers` (
  `MarkerID` int(11) NOT NULL,
  `CategoryID` int(11) NOT NULL,
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

INSERT INTO `Markers` (`MarkerID`, `CategoryID`, `UID`, `lat`, `lon`, `Name`, `Description`, `ImageID`) VALUES
(1, 10, 1, 48.2945, 7.38842, 'Château de Ramstein', 'Château de Ramstein', 1),
(2, 10, 1, 48.3219, 7.39978, 'Château du Bernstein', 'Château du Bernstein', 1),
(3, 10, 1, 48.2958, 7.39214, 'Château de l\'Ortenbourg', 'Château de l\'Ortenbourg', 1),
(6, 4, 1, 48.9784, 7.82665, 'Refuge du Soultzerkopf', 'Refuge gratuit, de quoi faire du feu, pas d\'electricité', 1),
(7, 8, 1, 49.0326, 7.76921, 'Lac du Fleckenstein', 'Baignade toléré, non surveillée.', 1),
(8, 5, 1, 48.3263, 7.39418, 'Bivouac cheval', 'Possibilité de dormir à l\'abri de la pluie', 1),
(9, 5, 1, 48.2923, 7.38782, 'Bivouac chappelle', 'Possibilité de dormir dans la chapelle. Elle est en ruine, mais peut protéger de la pluie', 4),
(10, 6, 1, 48.9476, 7.88778, 'Robinet cimetière', 'Robinet d\'eau à l’intérieur du cimetière', 1),
(11, 7, 1, 48.9517, 7.60222, 'Source tuyau', 'Source sortante d\'un tuyau', 1);

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
-- Doublure de structure pour la vue `ViewMarker`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `ViewMarker` (
`MarkerID` int(11)
,`Name` varchar(50)
,`Description` varchar(120)
,`CategoryID` int(11)
,`CategoryName` varchar(30)
,`DataName` varchar(30)
,`DisplayName` varchar(40)
,`Color` varchar(7)
,`lat` float
,`lon` float
,`ImageID` int(11)
,`ImageURL` varchar(200)
,`UID` int(11)
,`nbVotes` bigint(21)
,`avgVotes` decimal(14,4)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `ViewUser`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `ViewUser` (
`UserID` int(11)
,`GoogleUID` int(11)
,`Name` varchar(30)
,`EMail` varchar(30)
,`Verrified` char(1)
,`ImageURL` varchar(200)
);

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

-- --------------------------------------------------------

--
-- Structure de la vue `ViewMarker`
--
DROP TABLE IF EXISTS `ViewMarker`;

CREATE ALGORITHM=UNDEFINED DEFINER=`g21w3_admin`@`%` SQL SECURITY DEFINER VIEW `ViewMarker`  AS SELECT `m`.`MarkerID` AS `MarkerID`, `m`.`Name` AS `Name`, `m`.`Description` AS `Description`, `m`.`CategoryID` AS `CategoryID`, `c`.`CategoryName` AS `CategoryName`, `c`.`DataName` AS `DataName`, `c`.`DisplayName` AS `DisplayName`, `c`.`Color` AS `Color`, `m`.`lat` AS `lat`, `m`.`lon` AS `lon`, `m`.`ImageID` AS `ImageID`, `i`.`URL` AS `ImageURL`, `m`.`UID` AS `UID`, (select count(0) from `Votes` `v` where (`v`.`MarkerID` = `m`.`MarkerID`)) AS `nbVotes`, (select avg(`v`.`Note`) from `Votes` `v` where (`v`.`MarkerID` = `m`.`MarkerID`)) AS `avgVotes` FROM ((`Markers` `m` join `Images` `i`) join `Categories` `c`) WHERE ((`m`.`CategoryID` = `c`.`CategID`) AND (`m`.`ImageID` = `i`.`ImageID`)) ;

-- --------------------------------------------------------

--
-- Structure de la vue `ViewUser`
--
DROP TABLE IF EXISTS `ViewUser`;

CREATE ALGORITHM=UNDEFINED DEFINER=`g21w3_admin`@`%` SQL SECURITY DEFINER VIEW `ViewUser`  AS SELECT `u`.`UserID` AS `UserID`, `u`.`GoogleUID` AS `GoogleUID`, `u`.`Name` AS `Name`, `u`.`EMail` AS `EMail`, `u`.`Verrified` AS `Verrified`, `i`.`URL` AS `ImageURL` FROM (`Users` `u` left join `Images` `i` on((`u`.`ImageID` = `i`.`ImageID`))) ;

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
  ADD KEY `UID` (`UID`);

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
  MODIFY `ImageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `Markers`
--
ALTER TABLE `Markers`
  MODIFY `MarkerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
