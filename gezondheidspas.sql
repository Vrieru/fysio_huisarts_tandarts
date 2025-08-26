-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2025 at 08:52 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gezondheidspas`
--

-- --------------------------------------------------------

--
-- Table structure for table `fysio`
--

CREATE TABLE `fysio` (
  `id` int(11) NOT NULL,
  `patientnummer` int(11) NOT NULL,
  `naam` varchar(255) NOT NULL,
  `geboortedatum` varchar(255) NOT NULL,
  `straat` varchar(255) NOT NULL,
  `huisnummer` varchar(255) NOT NULL,
  `postcode` int(255) NOT NULL,
  `plaats` varchar(255) NOT NULL,
  `verzekeringsnummer` int(11) NOT NULL,
  `klachten` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fysio`
--

INSERT INTO `fysio` (`id`, `patientnummer`, `naam`, `geboortedatum`, `straat`, `huisnummer`, `postcode`, `plaats`, `verzekeringsnummer`, `klachten`) VALUES
(1, 1, 'ruben', '1970-01-01', 'Straat', '1', 1234, 'Terneuzen', 0, 'geen :)');

-- --------------------------------------------------------

--
-- Table structure for table `huisarts`
--

CREATE TABLE `huisarts` (
  `id` int(11) NOT NULL,
  `voornaam` varchar(255) NOT NULL,
  `achternaam` varchar(255) NOT NULL,
  `geboortedatum` varchar(255) NOT NULL,
  `adres` varchar(255) NOT NULL,
  `postcode` varchar(255) NOT NULL,
  `woonplaats` varchar(255) NOT NULL,
  `verzekeringsnummer` int(11) NOT NULL,
  `telefoonnummer` int(11) NOT NULL,
  `notities` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `huisarts`
--

INSERT INTO `huisarts` (`id`, `voornaam`, `achternaam`, `geboortedatum`, `adres`, `postcode`, `woonplaats`, `verzekeringsnummer`, `telefoonnummer`, `notities`) VALUES
(2, 'Emma', 'Verblind', '1970-01-01', 'straat 5', '1234AB', 'Terneuzen', 5, 123456789, 'Geen notities :)');

-- --------------------------------------------------------

--
-- Table structure for table `tandarts`
--

CREATE TABLE `tandarts` (
  `id` int(11) NOT NULL,
  `voornaam` varchar(255) NOT NULL,
  `achternaam` varchar(255) NOT NULL,
  `geboortedatum` varchar(255) NOT NULL,
  `adres` varchar(255) NOT NULL,
  `postcode` varchar(255) NOT NULL,
  `woonplaats` varchar(255) NOT NULL,
  `verzekeringsnummer` int(11) NOT NULL,
  `laatste_behandeling` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tandarts`
--

INSERT INTO `tandarts` (`id`, `voornaam`, `achternaam`, `geboortedatum`, `adres`, `postcode`, `woonplaats`, `verzekeringsnummer`, `laatste_behandeling`) VALUES
(1, 'Ruben', 'de Vries', '2025-08-25', 'straat 12', '1234AB', 'Terneuzen', 123456, '2025-08-25'),
(2, 'Ires', 'Duiv', '1970-02-01', 'straat 4', '1234AB', 'Terneuzen', 4, '2025-08-06'),
(3, 'Adem', 'Brug', '1970-01-01', 'straat 2', '1234AB', 'Terneuzen', 1, '2025-08-25'),
(4, 'Erik', 'Vroostraat', '1970-01-01', 'straat 3', '1234AB', 'Terneuzen', 3, '2025-08-25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fysio`
--
ALTER TABLE `fysio`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `huisarts`
--
ALTER TABLE `huisarts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tandarts`
--
ALTER TABLE `tandarts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `verzekeringsnummer` (`verzekeringsnummer`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fysio`
--
ALTER TABLE `fysio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `huisarts`
--
ALTER TABLE `huisarts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tandarts`
--
ALTER TABLE `tandarts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
