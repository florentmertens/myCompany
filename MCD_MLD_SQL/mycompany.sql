-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 12 oct. 2021 à 18:13
-- Version du serveur : 10.4.21-MariaDB
-- Version de PHP : 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mycompany`
--

-- --------------------------------------------------------

--
-- Structure de la table `employee`
--

CREATE TABLE `employee` (
  `no_employee` int(11) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `date_birth` varchar(255) NOT NULL,
  `job` varchar(255) NOT NULL,
  `no_manager` int(11) DEFAULT NULL,
  `hiring_date` varchar(255) NOT NULL,
  `salary` float NOT NULL,
  `role` varchar(255) NOT NULL,
  `no_service` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `employee`
--

INSERT INTO `employee` (`no_employee`, `last_name`, `first_name`, `date_birth`, `job`, `no_manager`, `hiring_date`, `salary`, `role`, `no_service`) VALUES
(1, 'Barre', 'Jerome', '30-04-1986', 'PDG', NULL, '30-04-2044', 2930, 'admin manager', 2),
(2, 'Lebon', 'Colette', '10-01-1980', 'Comptable', 1, '10-01-2023', 2662, 'employee', 2),
(3, 'Blondel', 'Jules', '13-09-2003', 'Comptable', 1, '13-09-2035', 6100, 'employee', 2),
(4, 'Schneider', 'Guy', '12-02-1992', 'DRH', 1, '12-02-2031', 5003, 'employee', 2),
(5, 'Guillot', 'Anastasie', '01-05-1991', 'Assistant(e) administrative', 1, '01-05-2039', 4138, 'employee', 2),
(6, 'Riviere', 'Roland', '03-03-1978', 'Product Owner', 1, '03-03-1998', 6764, 'manager', 3),
(7, 'Moreau', 'etienne', '17-09-1980', 'Designe(r)(euse) UX/UI', 6, '17-09-2007', 7649, 'employee', 3),
(8, 'Lefebvre', 'Alex', '19-05-2003', 'Développeu(r)(se) web front-end', 6, '19-05-2024', 5212, 'employee', 3),
(9, 'Laporte', 'Genevieve', '19-07-1998', 'Développeu(r)(se) web back-end', 6, '19-07-2016', 1629, 'employee', 3),
(10, 'Lecoq', 'Laurent', '01-01-1981', 'Scrum Master', 6, '01-01-2007', 6489, 'employee', 3),
(11, 'Besnard', 'Louise', '18-10-1988', 'Direct(eur)(rise) commercial(e)', 1, '18-10-2042', 5857, 'manager', 4),
(12, 'Lebrun', 'Danielle', '27-11-2001', 'Commercial(e)', 11, '27-11-2052', 5493, 'employee', 4),
(13, 'Adam', 'Vincent', '21-06-1980', 'Assistant(e) commercial(e)', 11, '21-06-2029', 4592, 'employee', 4),
(14, 'Louis', 'Luc', '07-07-1999', 'Commercial(e)', 11, '07-07-2051', 2969, 'employee', 4),
(15, 'Pasquier', 'Sabine', '11-10-1980', 'Assistant(e) commercial(e)', 11, '11-10-2014', 3902, 'employee', 4),
(16, 'admin', 'admin', '01-01-2021', 'admin', 0, '01-01-2021', 1500, 'admin', 1),
(17, 'manager', 'manager', '01-01-2021', 'manager', 1, '01-01-2021', 1500, 'manager', 1),
(18, 'employe', 'employee', '01-01-2021', 'employee', 17, '01-01-2021', 1500, 'employee', 1);

-- --------------------------------------------------------

--
-- Structure de la table `service`
--

CREATE TABLE `service` (
  `no_service` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `service`
--

INSERT INTO `service` (`no_service`, `name`, `city`) VALUES
(1, 'Temporaire', 'Ville'),
(2, 'Administration', 'Lyon'),
(3, 'Commercial', 'Paris'),
(4, 'Développement', 'Lille');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `no_employee` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `pseudo`, `email`, `password`, `no_employee`) VALUES
(1, 'barre.jerome', 'barre.jerome@gmail.com', '$2y$10$8eAQ0F21jIQGREPvwzoSpu5uncPu2kR8Zxp/H.BnDqCWRkAy6tUA6', 1),
(2, 'lebon.colette', 'lebon.colette@gmail.com', '$2y$10$y3r79YiVigsOTH05IC9x0O4bWz6KMqSr8Z2Iilwez5mcjzRWe/R7G', 2),
(3, 'blondel.jules', 'blondel.jules@gmail.com', '$2y$10$l6XvL08ijg/o3EGirQ4MyOyRJLlN3So5OIcln8MJEmttQXJRBGlBi', 3),
(4, 'schneider.guy', 'schneider.guy@gmail.com', '$2y$10$ZJA2DeXr67XDE3X1wEbGPOS5Xkh9vSwuRkAtPwsVtLmbpKjqlShiy', 4),
(5, 'guillot.anastasie', 'guillot.anastasie@gmail.com', '$2y$10$qe7YF8u/Un2nfkhI8Q3WJecgq9jZ81xHOqwBk/KhueHIIzhsYYaYu', 5),
(6, 'riviere.roland', 'riviere.roland@gmail.com', '$2y$10$AhIFhjvuKdGyiz45gwsD8eCOUUxn8APs2/CiPYm12afTristOlIOe', 6),
(7, 'moreau.etienne', 'moreau.etienne@gmail.com', '$2y$10$h/aVskno.EbpXTYqg4qgH.qg1egOdW6U7xKvSFA0N1HHoHAVVBL66', 7),
(8, 'lefebvre.alex', 'lefebvre.alex@gmail.com', '$2y$10$bL9mtWTZ7dJn7jk2nS0yPuxnR66iHbVkREYnnbmx0iLVJbD5ABv5q', 8),
(9, 'laporte.genevieve', 'laporte.genevieve@gmail.com', '$2y$10$TWkXDGQ9K4dvDTNUhgZwmeu4obq9W3nGkRCKT0OwGvmKRrbGW0yrq', 9),
(10, 'lecoq.laurent', 'lecoq.laurent@gmail.com', '$2y$10$CdruIYLb28M17L9U9za44OZIEKaDFo0TF36RCurNPODGEOiy1prRC', 10),
(11, 'besnard.louise', 'besnard.louise@gmail.com', '$2y$10$bGfEQAaPmnsIBMbiflsSXO92SXvk/oKop6NTmjBT3.dHlw5OE2UwS', 11),
(12, 'lebrun.danielle', 'lebrun.danielle@gmail.com', '$2y$10$A1WzAJd2SHAE1sw0vyWnZ.BNrWls9RM5zjTDlSWvnUg..I44FZZam', 12),
(13, 'adam.vincent', 'adam.vincent@gmail.com', '$2y$10$b/P0ehf9v3N8l4vODf0l4e3QPJF7AbNP5nKjDOCu.7nAGuIYSWNTq', 13),
(14, 'louis.luc', 'louis.luc@gmail.com', '$2y$10$pTq/ShiGaAMzAp4zhadn.O.xEk1IhThebfmiraxA/dMqABASV/JpO', 14),
(15, 'pasquier.sabine', 'pasquier.sabine@gmail.com', '$2y$10$76wDxi7hevC5vyhccy3r9ufIu8P5hwLrJIZ7OV/FPiv/eXa7QWn4W', 15),
(16, 'admin.admin', 'admin.admin@gmail.com', '$2y$10$573aCiq9RoTlVlGjpD55ZueFKm5JW1MXAdoFOz4OTGJ0V2cGcy64a', 16),
(17, 'manager.manager', 'manager.manager@gmail.com', '$2y$10$aMAPZIqg9K7SS/ds7UuS4eLOmFpKW4YfgfkW0JtvDVBScsnuLZ1KC', 17),
(18, 'employee.employee', 'employee.employee@gmail.com', '$2y$10$hYS648XfjpG7OCph/Oci3O5GrG2dgQJ4HxH5UE4P5bpTcDcPM4Riq', 18);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`no_employee`),
  ADD KEY `employee_service_FK` (`no_service`);

--
-- Index pour la table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`no_service`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `User_employee_AK` (`no_employee`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `employee`
--
ALTER TABLE `employee`
  MODIFY `no_employee` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `service`
--
ALTER TABLE `service`
  MODIFY `no_service` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_service_FK` FOREIGN KEY (`no_service`) REFERENCES `service` (`no_service`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `User_employee_FK` FOREIGN KEY (`no_employee`) REFERENCES `employee` (`no_employee`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
