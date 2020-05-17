-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2020 at 07:17 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pashania`
--

-- --------------------------------------------------------

--
-- Table structure for table `bobot_data_training`
--

CREATE TABLE `bobot_data_training` (
  `id` int(250) NOT NULL,
  `bobot` double NOT NULL,
  `id_data_training` int(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `data_static`
--

CREATE TABLE `data_static` (
  `id` int(255) NOT NULL,
  `maxEpoch` int(5) NOT NULL DEFAULT '5',
  `minError` float NOT NULL DEFAULT '0.1',
  `learningRate` float NOT NULL DEFAULT '0.05'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_static`
--

INSERT INTO `data_static` (`id`, `maxEpoch`, `minError`, `learningRate`) VALUES
(1, 5, 0.1, 0.05);

-- --------------------------------------------------------

--
-- Table structure for table `data_training`
--

CREATE TABLE `data_training` (
  `idTraining` int(250) NOT NULL,
  `filePath` text NOT NULL,
  `artiKata` varchar(255) NOT NULL,
  `kataKorea` varchar(250) NOT NULL,
  `kataKanjiKorea` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL DEFAULT 'Aktif'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_training`
--

INSERT INTO `data_training` (`idTraining`, `filePath`, `artiKata`, `kataKorea`, `kataKanjiKorea`, `status`) VALUES
(23, 'assets/uploaded/image_3A235748.png', 'orang', 'a', '213', 'Aktif'),
(24, 'assets/uploaded/image_3A235747.png', 'wanita', 'ae', '581', 'Aktif'),
(25, 'assets/uploaded/image_3A235746.png', 'hei', 'han', '?', 'Aktif'),
(36, 'assets/uploaded/image_3A245984.png', 'xdk', 'trey', 'fh', 'Aktif'),
(37, 'assets/uploaded/image_3A245984.png', 'cb', 'temhbolok', 'trhe', 'Aktif'),
(38, 'assets/uploaded/image_3A245984.png', 'dhdh', 'joko', 'jaka', 'Aktif'),
(39, 'assets/uploaded/image_3A245984.png', 'xbxg', 'dhdh', 'xxhh', 'Aktif'),
(40, 'assets/uploaded/image_3A245984.png', 'ridho', 'fhdh', 'xhddh', 'Aktif'),
(41, 'assets/uploaded/image_3A245984.png', 'dd', 'V', 'zwwe ', 'Aktif'),
(42, 'assets/uploaded/image_3A245984.png', 'shdh', 'fhfh', 'dhdh', 'Aktif'),
(43, 'assets/uploaded/image_3A245984.png', 'wgwhw', 'hehheh', 'heheh', 'Aktif');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bobot_data_training`
--
ALTER TABLE `bobot_data_training`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_static`
--
ALTER TABLE `data_static`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_training`
--
ALTER TABLE `data_training`
  ADD PRIMARY KEY (`idTraining`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bobot_data_training`
--
ALTER TABLE `bobot_data_training`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `data_static`
--
ALTER TABLE `data_static`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `data_training`
--
ALTER TABLE `data_training`
  MODIFY `idTraining` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
