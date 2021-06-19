-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jun 18, 2021 at 09:23 PM
-- Server version: 5.7.32
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e21bdfilms`
--
CREATE DATABASE IF NOT EXISTS `e21bdfilms` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `e21bdfilms`;

-- --------------------------------------------------------

--
-- Table structure for table `connexion`
--

CREATE TABLE `connexion` (
  `courriel` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `motDePasse` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `statut` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(1) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `connexion`
--

INSERT INTO `connexion` (`courriel`, `motDePasse`, `statut`, `role`) VALUES
('admin@streamtopia.com', 'admin', 'A', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `films`
--

CREATE TABLE `films` (
  `id` int(11) NOT NULL,
  `categorie` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `titre` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `realisateur` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `duree` int(3) NOT NULL,
  `langue` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `locationEtPaiements`
--

CREATE TABLE `locationEtPaiements` (
  `id` int(11) NOT NULL,
  `titre` int(11) NOT NULL,
  `courriel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `membres`
--

CREATE TABLE `membres` (
  `prenom` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `nom` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `courriel` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `sexe` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `naissance` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `membres`
--

INSERT INTO `membres` (`prenom`, `nom`, `courriel`, `sexe`, `naissance`) VALUES
('Marjolaine', 'Hébert', 'admin@streamtopia.com', 'féminin', '1980-09-24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `connexion`
--
ALTER TABLE `connexion`
  ADD PRIMARY KEY (`courriel`);

--
-- Indexes for table `films`
--
ALTER TABLE `films`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `membres`
--
ALTER TABLE `membres`
  ADD PRIMARY KEY (`courriel`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `films`
--
ALTER TABLE `films`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
