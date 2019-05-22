-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2019 at 10:55 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `osiguranje`
--

-- --------------------------------------------------------

--
-- Table structure for table `dodatni_korisnik`
--

CREATE TABLE `dodatni_korisnik` (
  `id` int(11) NOT NULL,
  `ime_prezime` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `datum_rodjenja` bigint(255) NOT NULL,
  `broj_pasosa` bigint(255) NOT NULL,
  `nosilac_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `dodatni_korisnik`
--

INSERT INTO `dodatni_korisnik` (`id`, `ime_prezime`, `datum_rodjenja`, `broj_pasosa`, `nosilac_id`) VALUES
(1, 'Clan 1', 1558562400, 441231, 2),
(2, 'Clan 2', 1557266400, 412313, 2),
(3, 'Clan 3', 1556748000, 41241, 2),
(4, 'Clan1', 1556661600, 513214, 3),
(5, 'Clan2', 1556748000, 621431, 3),
(6, 'Clan3', 1556834400, 6214123, 3);

-- --------------------------------------------------------

--
-- Table structure for table `polisa`
--

CREATE TABLE `polisa` (
  `id` int(11) NOT NULL,
  `ime_prezime` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `datum_rodjenja` bigint(255) NOT NULL,
  `broj_pasosa` bigint(255) NOT NULL,
  `telefon` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `datum_od` bigint(255) NOT NULL,
  `datum_do` bigint(255) NOT NULL,
  `trajanje` int(11) NOT NULL,
  `datum_pravljenja` bigint(255) NOT NULL,
  `tip_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `polisa`
--

INSERT INTO `polisa` (`id`, `ime_prezime`, `datum_rodjenja`, `broj_pasosa`, `telefon`, `email`, `datum_od`, `datum_do`, `trajanje`, `datum_pravljenja`, `tip_id`) VALUES
(1, 'Ignja Jokanovic', 744674400, 1414123, '', 'jokanovic.ignjat@gmail.com', 1558562400, 1558735200, 2, 1558557974, 1),
(2, 'Ignjat Jokanovic', 1308261600, 14231, '064/5800-455', 'jokanovic.ignjat@gmail.com', 1559080800, 1559253600, 2, 1558558212, 2),
(3, 'Ignjat Jokanovic', 1090015200, 1142134, '064/5800-455', 'jokanovic.ignjat@gmail.com', 1557439200, 1558735200, 15, 1558558326, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tip`
--

CREATE TABLE `tip` (
  `id` int(11) NOT NULL,
  `naziv` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tip`
--

INSERT INTO `tip` (`id`, `naziv`) VALUES
(1, 'Pojedinačno'),
(2, 'Grupno');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dodatni_korisnik`
--
ALTER TABLE `dodatni_korisnik`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nosilac_id` (`nosilac_id`);

--
-- Indexes for table `polisa`
--
ALTER TABLE `polisa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tip_id` (`tip_id`);

--
-- Indexes for table `tip`
--
ALTER TABLE `tip`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dodatni_korisnik`
--
ALTER TABLE `dodatni_korisnik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `polisa`
--
ALTER TABLE `polisa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tip`
--
ALTER TABLE `tip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dodatni_korisnik`
--
ALTER TABLE `dodatni_korisnik`
  ADD CONSTRAINT `dodatni_korisnik_ibfk_1` FOREIGN KEY (`nosilac_id`) REFERENCES `polisa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `polisa`
--
ALTER TABLE `polisa`
  ADD CONSTRAINT `polisa_ibfk_1` FOREIGN KEY (`tip_id`) REFERENCES `tip` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
