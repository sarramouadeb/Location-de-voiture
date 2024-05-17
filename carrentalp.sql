-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 14 mai 2024 à 13:43
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `carrentalp`
--

-- --------------------------------------------------------

--
-- Structure de la table `cars`
--

CREATE TABLE `cars` (
  `car_id` int(20) NOT NULL,
  `car_name` varchar(50) NOT NULL,
  `car_nameplate` varchar(50) NOT NULL,
  `car_img` varchar(50) DEFAULT 'NA',
  `ac_price` float NOT NULL,
  `non_ac_price` float NOT NULL,
  `ac_price_per_day` float NOT NULL,
  `non_ac_price_per_day` float NOT NULL,
  `car_availability` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `cars`
--

INSERT INTO `cars` (`car_id`, `car_name`, `car_nameplate`, `car_img`, `ac_price`, `non_ac_price`, `ac_price_per_day`, `non_ac_price_per_day`, `car_availability`) VALUES
(7, 'VOLKSWAGEN PASSAT', 'TN17MS1818', 'assets/img/cars/car5.jpg', 60, 25, 50, 20, 'no'),
(9, 'SKODA OCTAVIA TUNISIE', 'TN17MS2022', 'assets/img/cars/car4.jpg', 50, 30, 40, 25, 'yes'),
(10, 'SKODA FABIA', 'TN17MS2017', 'assets/img/cars/car2.jpg', 25, 15, 20, 10, 'no'),
(11, 'BMW SERIE 3', 'TN17MS2020', 'assets/img/cars/car5.jpg', 75, 50, 65, 45, 'yes'),
(12, 'CITROEN C3 (AC)', 'TN17MS2014', 'assets/img/cars/car3.jpg', 30, 26, 20, 19, 'yes'),
(15, 'Audi A4', 'TN17MS2000', 'assets/img/cars/audi-a4.jpg', 36, 26, 29, 23, 'no'),
(16, 'Hyundai Creta', 'TN17MS2015', 'assets/img/cars/creta.jpg', 40, 25, 35, 20, 'no'),
(17, 'TN18MS2018', 'TN19MS5555', 'assets/img/cars/bmw6.jpg', 39, 25, 30, 20, 'yes'),
(18, 'Mercedes-Benz E-Class', 'TN16MS2024', 'assets/img/cars/mcec.jpg', 45, 19, 40, 15, 'yes'),
(19, 'Ford EcoSport ', 'TN19MS2019', 'assets/img/cars/ecosport.png', 70, 50, 60, 40, 'yes'),
(20, 'Honda Amaze', 'TN22MS2022', 'assets/img/cars/amaze.png', 60, 39, 55, 29, 'yes'),
(21, ' Range Rover Sport', 'TN20MS2020', 'assets/img/cars/rangero.jpg', 90, 49, 80, 40, 'yes'),
(22, 'MG Hector', 'TN13RS2022', 'assets/img/cars/mghector.jpg', 40, 25, 35, 23, 'yes'),
(23, 'Honda CR-V', 'TN17MS1997', 'assets/img/cars/hondacr.jpg', 80, 35, 69, 30, 'yes'),
(24, 'Mahindra XUV 500', 'TN120EX2023', 'assets/img/cars/Mahindra XUV.jpg', 90, 50, 70, 39, 'yes'),
(25, 'Toyota Fortuner', 'TN10XS2022', 'assets/img/cars/Fortuner.png', 60, 27, 50, 22, 'yes'),
(26, 'Hyundai Veloster', 'TN14HS2014', 'assets/img/cars/hyundai0.png', 80, 55, 70, 45, 'yes'),
(27, 'Jaguar XF', 'TN19BS2012', 'assets/img/cars/jaguarxf.jpg', 89, 45, 79, 40, 'yes'),
(28, 'HYUNDAI I10', 'TN12CH2024', 'assets/img/cars/car1.jpg', 70, 50, 60, 40, 'no'),
(51, 'ford', '2222222255555', 'assets/img/cars/ford.jpg', 50, 25, 30, 50, 'yes'),
(52, 'ford', 'TNN22333', 'assets/img/cars/ford.jpg', 50, 25, 30, 20, 'yes'),
(53, 'passat', 'TN0012', 'assets/img/cars/passat.jpg', 50, 25, 30, 20, 'yes');

-- --------------------------------------------------------

--
-- Structure de la table `clientcars`
--

CREATE TABLE `clientcars` (
  `car_id` int(20) NOT NULL,
  `client_username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `clientcars`
--

INSERT INTO `clientcars` (`car_id`, `client_username`) VALUES
(15, 'chiHEb'),
(16, 'chiHEb'),
(19, 'chiHEb'),
(20, 'chiHEb'),
(21, 'chiHEb'),
(26, 'chiHEb'),
(52, 'chiHEb'),
(53, 'chiHEb'),
(17, 'selma'),
(18, 'selma'),
(23, 'selma'),
(24, 'selma'),
(25, 'selma'),
(27, 'selma');

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `client_username` varchar(50) NOT NULL,
  `client_name` varchar(50) NOT NULL,
  `client_phone` varchar(15) NOT NULL,
  `client_email` varchar(25) NOT NULL,
  `client_address` varchar(50) CHARACTER SET utf8 COLLATE utf8_estonian_ci NOT NULL,
  `client_password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`client_username`, `client_name`, `client_phone`, `client_email`, `client_address`, `client_password`) VALUES
('chiHEb', 'sarra mouaddeb', '93074479', 'meddebsarra72@gmail.com', '56 Rue Habib Bourguiba', '1122'),
('selma', 'selma', '99526152', 'selma02@gmail.com', '56 Rue Habib Bourguiba', '01234'),
('sm', 'Sarra Etudiante en Génie Electrique Mouadeb', '93074479', 'meddebsarra72@gmail.com', '56 Rue Habib Bourguiba', '1234');

-- --------------------------------------------------------

--
-- Structure de la table `customers`
--

CREATE TABLE `customers` (
  `customer_username` varchar(50) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `customer_phone` varchar(15) NOT NULL,
  `customer_email` varchar(25) NOT NULL,
  `customer_address` varchar(50) NOT NULL,
  `customer_password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `customers`
--

INSERT INTO `customers` (`customer_username`, `customer_name`, `customer_phone`, `customer_email`, `customer_address`, `customer_password`) VALUES
('BILL', 'bill', '99861375', 'kkkkkkkkk@gmail.com', 'Rue Habib Bourguiba', '1122'),
('chooc', 'shefia', '99861375', 'shefialak@gmail.com', '56 Rue Habib Bourguiba', '1122'),
('chouchou', 'shefia', '99861375', 'shefialak@gmail.com', '56 Rue Habib Bourguiba', '1122'),
('mohamed', 'mohamed', '93074479', 'mohamed@gmail.com', '56 Rue Habib Bourguiba', '0000'),
('samar01', 'samar lakhdher', '99012147', 'samarlak@gmail.c', 'Kebili', 'samar01'),
('sarra', 'sarra mouaddeb', '93074479', 'meddebsarra72@gmail.com', '56 Rue Habib Bourguiba', 'sarramed'),
('sousou', 'saousen', '22114455', 'saousen01@gmail.com', 'zarmeddine', '1234'),
('Youssef', 'Hadded', '22013547', 'youssef01@gmail.com', 'Sousse', 'youuss');

-- --------------------------------------------------------

--
-- Structure de la table `driver`
--

CREATE TABLE `driver` (
  `driver_id` int(20) NOT NULL,
  `driver_name` varchar(50) NOT NULL,
  `dl_number` varchar(50) NOT NULL,
  `driver_phone` varchar(15) NOT NULL,
  `driver_address` varchar(50) NOT NULL,
  `driver_gender` varchar(10) NOT NULL,
  `client_username` varchar(50) NOT NULL,
  `driver_availability` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `driver`
--

INSERT INTO `driver` (`driver_id`, `driver_name`, `dl_number`, `driver_phone`, `driver_address`, `driver_gender`, `client_username`, `driver_availability`) VALUES
(9, 'Fathi Ben salem', '27840218', '9547863157', 'Kef', 'Male', 'chiHEb', 'no'),
(10, 'Salem Khalil', '03191563', '99012632', 'Tunis', 'Male', 'selma', 'yes'),
(11, 'Amira Sassi', '32346288', '97777012', 'Hammamet', 'Female', 'chiHEb', 'yes'),
(12, 'Sana Gharsallah', '04316015', '99014789', 'Mahdia', 'Female', 'selma', 'no'),
(13, 'Mahdi Touati', '68799466', '98017012', 'Sousse', 'Male', 'chiHEb', 'yes'),
(14, 'Alia Bouazizi', '36740186', '98012655', 'Zaghouan', 'Female', 'chiHEb', 'yes'),
(15, 'Walid Mansouri', '44919316', '95012147', 'Djerba', 'Male', 'selma', 'yes'),
(16, 'Houda Youssef', '94592817', '22014568', 'Beja', 'Female', 'selma', 'yes');

-- --------------------------------------------------------

--
-- Structure de la table `feedback`
--

CREATE TABLE `feedback` (
  `name` varchar(20) NOT NULL,
  `e_mail` varchar(30) NOT NULL,
  `message` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `feedback`
--

INSERT INTO `feedback` (`name`, `e_mail`, `message`) VALUES
('Amine', 'mbdamine@yahoo.com', 'Great experience and services');

-- --------------------------------------------------------

--
-- Structure de la table `rentedcars`
--

CREATE TABLE `rentedcars` (
  `id` int(100) NOT NULL,
  `customer_username` varchar(50) NOT NULL,
  `car_id` int(20) NOT NULL,
  `driver_id` int(20) NOT NULL,
  `booking_date` date NOT NULL,
  `rent_start_date` date NOT NULL,
  `rent_end_date` date NOT NULL,
  `car_return_date` date DEFAULT NULL,
  `fare` double NOT NULL,
  `charge_type` varchar(25) NOT NULL DEFAULT 'days',
  `distance` double DEFAULT NULL,
  `no_of_days` int(50) DEFAULT NULL,
  `total_amount` double DEFAULT NULL,
  `return_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `rentedcars`
--

INSERT INTO `rentedcars` (`id`, `customer_username`, `car_id`, `driver_id`, `booking_date`, `rent_start_date`, `rent_end_date`, `car_return_date`, `fare`, `charge_type`, `distance`, `no_of_days`, `total_amount`, `return_status`) VALUES
(574681397, 'mohamed', 18, 14, '2024-05-12', '2024-05-14', '2024-05-31', '2024-05-12', 45, 'km', 500, 17, 22500, 'R'),
(574681399, 'mohamed', 24, 15, '2024-05-12', '2024-05-16', '2024-06-09', '2024-05-12', 39, 'days', NULL, 24, 936, 'R'),
(574681400, 'mohamed', 17, 11, '2024-05-12', '2024-05-16', '2024-06-08', '2024-05-12', 20, 'days', NULL, 23, 460, 'R'),
(574681403, 'sousou', 11, 14, '2024-05-12', '2024-05-16', '2024-05-23', '2024-05-12', 45, 'days', NULL, 7, 315, 'R'),
(574681404, 'BILL', 11, 10, '2024-05-12', '2024-05-22', '2024-06-06', '2024-05-12', 45, 'days', NULL, 15, 675, 'R');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `cars`
--

ALTER TABLE `cars`
  ADD PRIMARY KEY (`car_id`),
  ADD UNIQUE KEY `car_nameplate` (`car_nameplate`);

--
-- Index pour la table `clientcars`
--
ALTER TABLE `clientcars`
  ADD PRIMARY KEY (`car_id`),
  ADD KEY `client_username` (`client_username`);

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_username`);

--
-- Index pour la table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_username`);

--
-- Index pour la table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`driver_id`),
  ADD UNIQUE KEY `dl_number` (`dl_number`),
  ADD KEY `client_username` (`client_username`);

--
-- Index pour la table `rentedcars`
--
ALTER TABLE `rentedcars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_username` (`customer_username`),
  ADD KEY `car_id` (`car_id`),
  ADD KEY `driver_id` (`driver_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `cars`
--
ALTER TABLE `cars`
  MODIFY `car_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT pour la table `driver`
--
ALTER TABLE `driver`
  MODIFY `driver_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT pour la table `rentedcars`
--
ALTER TABLE `rentedcars`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=574681405;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `clientcars`
--
ALTER TABLE `clientcars`
  ADD CONSTRAINT `clientcars_ibfk_1` FOREIGN KEY (`client_username`) REFERENCES `clients` (`client_username`),
  ADD CONSTRAINT `clientcars_ibfk_2` FOREIGN KEY (`car_id`) REFERENCES `cars` (`car_id`);

--
-- Contraintes pour la table `driver`
--
ALTER TABLE `driver`
  ADD CONSTRAINT `driver_ibfk_1` FOREIGN KEY (`client_username`) REFERENCES `clients` (`client_username`);

--
-- Contraintes pour la table `rentedcars`
--
ALTER TABLE `rentedcars`
  ADD CONSTRAINT `rentedcars_ibfk_1` FOREIGN KEY (`customer_username`) REFERENCES `customers` (`customer_username`),
  ADD CONSTRAINT `rentedcars_ibfk_2` FOREIGN KEY (`car_id`) REFERENCES `cars` (`car_id`),
  ADD CONSTRAINT `rentedcars_ibfk_3` FOREIGN KEY (`driver_id`) REFERENCES `driver` (`driver_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
