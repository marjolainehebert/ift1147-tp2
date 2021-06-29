-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jun 29, 2021 at 08:17 PM
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
('admin@streamtopia.com', 'admin', 'A', 'A'),
('alice.robie39@hotmail.com', '123456789', 'A', 'M'),
('elijas1992@ewoods.com', '10293847', 'A', 'M'),
('lizawind@royalcourt.uk', 'Elizabeth2', 'I', 'M'),
('mdenis@streamtopia.com', '123456789', 'A', 'E'),
('quentin@tarantino.com', '7aRan71n0', 'A', 'M'),
('theQu33n@royalcourt.uk', 'the-Qu33n', 'A', 'M');

-- --------------------------------------------------------

--
-- Table structure for table `films`
--

CREATE TABLE `films` (
  `id` int(11) NOT NULL,
  `titre` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `realisateur` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `categorie` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `duree` int(3) NOT NULL,
  `langue` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `annee` int(4) NOT NULL,
  `pochette` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `urlPreview` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prix` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `films`
--

INSERT INTO `films` (`id`, `titre`, `realisateur`, `categorie`, `duree`, `langue`, `annee`, `pochette`, `urlPreview`, `prix`) VALUES
(8, '22 contre la Terre', 'Kevin Nolting', 'Comédie', 9, 'FR', 2021, '43cb91c2fad9231632c75757bb0841d8d6883467.jpg', 'https://www.youtube.com/embed/ngG_olwrERQ', '0.99'),
(9, 'Chaos Walking', 'Doug Liman', 'Action', 109, 'EN', 2021, '0394a8b0466ed6c0a85ac84eb4e644dd680b93ed.jpg', 'https://www.youtube.com/embed/nRf4ZgzHoVw', '2.50'),
(11, 'Inglourious Basterds', 'Quentin Tarantino', 'Action', 153, 'FR', 2009, '69bc523adff8dcd6680a15764dfb471679c97085.jpg', 'https://www.youtube.com/embed/TnyEVXNwySg', '2.99'),
(14, 'The Pianist', 'Roman Polanski', 'Drame', 150, 'EN', 2002, 'avatar.jpg', 'https://www.youtube.com/embed/BFwGqLa_oAo', '1.99'),
(15, 'Godzilla vs Kong ', 'Adam Wingard', 'Action', 113, 'FR', 2021, '2fd2eb83f4e9b063ff44de8cdbe8b2c15d039c5f.jpg', 'https://www.youtube.com/embed/ELni2ZtivQE', '1.50'),
(19, 'Moins que rien', 'Ilya Naishuller', 'Action', 92, 'FR', 2021, '664c84ef19b47439382db433180916824e362204.jpg', 'https://www.youtube.com/embed/4bPLjEek0I4', '4.99'),
(20, 'Luca', 'Enrico Casarosa', 'Comédie', 101, 'FR', 2021, 'c63ede9baaae7a4c37b4010b4dcce39bf26ec678.jpg', 'https://www.youtube.com/embed/0hgHY9k-44U', '5.67'),
(21, 'Black Panther', 'Ryan Coogler', 'Action', 134, 'FR', 2018, '3aaacb90a9459a2f9404732c94877492152e0d0f.jpg', 'https://www.youtube.com/embed/xjDjIWPwcPU', '3.33'),
(22, 'Projet X', 'Nima Nourizadeh', 'Comédie', 88, 'FR', 2012, '5dbe221c0422f3630da4b47b6541a12c61f2a78c.jpg', 'https://www.youtube.com/embed/Kfm4Z4C2NRo', '1.50'),
(23, 'Pulp Fiction', 'Quentin Tarantino', 'Thriller', 154, 'FR', 1994, 'a1f55cb781b2db0a9ad05bd990b96a8660aa18c9.jpg', 'https://www.youtube.com/embed/tGpTpVyI_OQ', '0.99'),
(24, 'Kill Bill : Volume 1', 'Quentin Tarantino', 'Action', 112, 'FR', 2003, 'b3d94ebd60023d3486faf67575ed8114e7a6655f.jpg', 'https://www.youtube.com/embed/2qYb8H9IrvY', '2.99'),
(25, 'Kill Bill : Volume 2', 'Quentin Tarantino', 'Action', 135, 'FR', 2004, '2f229bb59f9463f3cb79e78d49494314ecccf8a6.jpg', 'https://www.youtube.com/embed/49mioQd2yQY', '2.99'),
(26, 'Once Upon a Time… in Hollywood', 'Quentin Tarantino', 'Drame', 162, 'FR', 2019, '502a00fac1dffcc81e6d60988c0fc1d019553ab6.jpg', 'https://www.youtube.com/embed/rCKjRdjjjWM', '3.50'),
(27, 'La vie est belle', 'Roberto Benigni', 'Drame', 117, 'FR', 1997, 'cf0218dd1503b435bcd5412bc16c475464ddc5cb.jpg', 'https://www.youtube.com/embed/KMlK3PM85qs', '0.50'),
(28, 'La Ligne verte ', 'Frank Darabont', 'Science Fiction', 189, 'FR', 1999, '16f8bb9506dbee0c60eedbe7ed2d061e4612d856.jpg', 'https://www.youtube.com/embed/mccs8Ql8m8o', '1.99');

-- --------------------------------------------------------

--
-- Table structure for table `locationEtPaiements`
--

CREATE TABLE `locationEtPaiements` (
  `panier` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `courriel` varchar(255) COLLATE utf8_unicode_ci NOT NULL
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
('Marjolaine', 'Hébert', 'admin@streamtopia.com', 'féminin', '1980-09-24'),
('Alice', 'Robie', 'alice.robie39@hotmail.com', 'feminin', '1941-03-17'),
('Elijas', 'Woods', 'elijas1992@ewoods.com', 'masculin', '1992-02-19'),
('Elizabeth', 'Windsor', 'lizawind@royalcourt.uk', 'feminin', '1926-04-21'),
('Max', 'Denis', 'mdenis@streamtopia.com', 'masculin', '1974-09-06'),
('Quentin', 'Tarantino', 'quentin@tarantino.com', 'masculin', '1963-03-27'),
('Elisabeth II', 'Windsor', 'theQu33n@royalcourt.uk', 'feminin', '1926-04-21');

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
-- Indexes for table `locationEtPaiements`
--
ALTER TABLE `locationEtPaiements`
  ADD PRIMARY KEY (`courriel`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
