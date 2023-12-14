-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2023 at 12:53 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.1.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `irims-phase2`
--

-- --------------------------------------------------------

--
-- Table structure for table `risk_information_tooltips`
--

CREATE TABLE `risk_information_tooltips` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `label_name` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `risk_information_tooltips`
--

INSERT INTO `risk_information_tooltips` (`id`, `name`, `label_name`, `created`, `modified`) VALUES
(2, 'Tooltips Program Kerja', 'Program Kerja', '2012-11-12 12:07:26', NULL),
(3, 'Tooltips Aktivitas', 'Aktivitas', '2012-11-12 12:07:26', NULL),
(4, 'Tooltips Lingkup', 'Lingkup', '2012-11-12 12:07:26', NULL),
(5, 'Tooltips Kriteria', 'Kriteria', '2012-11-12 12:07:26', NULL),
(6, 'Tooltips Konteks Eksternal', 'Konteks Eksternal', '2012-11-12 12:07:26', NULL),
(7, 'Tooltips Konteks Internal', 'Konteks Internal', '2012-11-12 12:07:26', NULL),
(177, 'Tooltips Sasaran Organisasi', 'Sasaran Organisasi', '2012-11-12 12:07:26', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `risk_information_tooltips`
--
ALTER TABLE `risk_information_tooltips`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `label_name` (`label_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `risk_information_tooltips`
--
ALTER TABLE `risk_information_tooltips`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=178;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
