-- phpMyAdmin SQL Dump
-- version 4.6.0
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 11, 2016 at 05:34 PM
-- Server version: 5.5.47-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projet_rio`
--

-- --------------------------------------------------------

--
-- Table structure for table `epreuve`
--

CREATE TABLE `epreuve` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `epreuve`
--

INSERT INTO `epreuve` (`id`, `name`, `description`, `path`, `date`) VALUES
(1, 'Natation', 'Epreuve qui nécessite de savoir nager', '9cf1c5cc76f23138c6b1706662281911.jpeg', '2016-08-11 00:00:00'),
(2, 'Golf', 'Epreuve qui necessite d\'avoir joué au mini-golf petit.', '9fb13cc3b097ad29012404a62cef7dc6.jpeg', '2016-08-10 00:00:00'),
(3, 'Escrime', 'Epreuve qui nécessite de savoir manier l\'épée au moins au niveau de Perceval et Karadoc', '9ea6b7b5ad619ee1036688d26c59b893.jpeg', '2016-08-08 00:00:00'),
(4, 'Lancer de marteur', 'Il faut vraiment être marteau', '213283b252b2de0259eb7c2872dda929.jpeg', '2016-08-06 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `fos_user`
--

CREATE TABLE `fos_user` (
  `id` int(11) NOT NULL,
  `username` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `fos_user`
--

INSERT INTO `fos_user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`) VALUES
(1, 'julian', 'julian', 'julian@julian.fr', 'julian@julian.fr', 1, 'h51oe8a0yjw4swwkgkcwcsgkk0cwkk0', '$2y$13$h51oe8a0yjw4swwkgkcwceQroY9P4I5oTjuzgzK53Ir2Mjc/qNGFO', '2016-08-11 14:05:09', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `participant`
--

CREATE TABLE `participant` (
  `id` int(11) NOT NULL,
  `idepreuve` int(11) NOT NULL,
  `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `participant`
--

INSERT INTO `participant` (`id`, `idepreuve`, `firstname`, `lastname`) VALUES
(1, 1, 'Jean', 'Nagelibre'),
(2, 1, 'Jean', 'Crawl'),
(3, 1, 'Jean', 'Brasse'),
(4, 1, 'Jean', 'Saispasnager'),
(5, 1, 'Jean', 'Sans maillot'),
(6, 2, 'Pierre', 'Dalaballe'),
(7, 2, 'Pierre', 'Swingparfait'),
(8, 2, 'Pierre', 'Duclub'),
(9, 2, 'Pierre', 'Enuncoup'),
(10, 2, 'Pierre', 'TIgerwoods'),
(11, 3, 'Paul', 'Epée'),
(12, 3, 'Paul', 'Fleuret'),
(13, 3, 'Paul', 'Sabrelaser'),
(14, 3, 'Paul', 'Excalibur'),
(15, 3, 'Paul', 'Dartagan');

-- --------------------------------------------------------

--
-- Table structure for table `vote`
--

CREATE TABLE `vote` (
  `id` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `idepreuve` int(11) NOT NULL,
  `idathlete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `vote`
--

INSERT INTO `vote` (`id`, `iduser`, `idepreuve`, `idathlete`) VALUES
(1, 1, 2, 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `epreuve`
--
ALTER TABLE `epreuve`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fos_user`
--
ALTER TABLE `fos_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_957A647992FC23A8` (`username_canonical`),
  ADD UNIQUE KEY `UNIQ_957A6479A0D96FBF` (`email_canonical`);

--
-- Indexes for table `participant`
--
ALTER TABLE `participant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vote`
--
ALTER TABLE `vote`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `epreuve`
--
ALTER TABLE `epreuve`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `fos_user`
--
ALTER TABLE `fos_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `participant`
--
ALTER TABLE `participant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `vote`
--
ALTER TABLE `vote`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
