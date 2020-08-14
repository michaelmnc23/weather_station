-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 14, 2020 at 02:27 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `weather_station`
--

-- --------------------------------------------------------

--
-- Table structure for table `node_data`
--

CREATE TABLE `node_data` (
  `ID` int(11) NOT NULL,
  `Node` int(11) NOT NULL,
  `Temperature` int(11) NOT NULL,
  `Humidity` int(11) NOT NULL,
  `Pressure` int(11) NOT NULL,
  `Rain` int(11) NOT NULL,
  `TIme` time NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `node_data`
--

-- contoh data(asli)
INSERT INTO `node_data` (`ID`, `Node`, `Temperature`, `Humidity`, `Pressure`, `Rain`, `TIme`, `Date`) VALUES
(1741, 2, 27, 77, 923, 8, '11:01:00', '2020-06-16'),
(1742, 1, 26, 78, 924, 19, '11:01:04', '2020-06-16'),
(1743, 1, 26, 78, 924, 19, '11:01:16', '2020-06-16'),
(1744, 2, 27, 77, 923, 9, '11:01:16', '2020-06-16'),
(1745, 1, 26, 78, 924, 19, '11:01:26', '2020-06-16'),
(1746, 2, 27, 77, 923, 9, '11:01:32', '2020-06-16'),
(1747, 1, 26, 78, 924, 19, '11:01:37', '2020-06-16'),
(1748, 2, 27, 77, 923, 8, '11:01:50', '2020-06-16'),
(1749, 1, 26, 78, 924, 20, '11:01:53', '2020-06-16'),
(1750, 1, 26, 78, 924, 19, '11:02:00', '2020-06-16'),
(1751, 2, 27, 77, 923, 8, '11:02:09', '2020-06-16'),
(1752, 1, 26, 78, 924, 20, '11:02:11', '2020-06-16');

-- --------------------------------------------------------

--
-- Table structure for table `weather_history`
--

CREATE TABLE `weather_history` (
  `ID` int(11) NOT NULL,
  `Weather` varchar(20) NOT NULL,
  `Temp` int(11) NOT NULL,
  `Humidity` int(11) NOT NULL,
  `Pressure` int(11) NOT NULL,
  `Rain` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contoh data(asli)
--

INSERT INTO `weather_history` (`ID`, `Weather`, `Temp`, `Humidity`, `Pressure`, `Rain`, `Date`, `Time`) VALUES
(10, 'Mendung', 28, 84, 964, 0, '2020-04-27', '04:29:11'),
(11, 'Hujan', 27, 85, 982, 652, '2020-04-27', '06:19:15'),
(12, 'Mendung', 24, 88, 925, 1, '2020-04-28', '06:53:53'),
(13, 'Berawan', 27, 90, 923, 0, '2020-05-28', '14:11:46'),
(14, 'Mendung', 26, 77, 923, 11, '2020-05-29', '15:50:51'),
(15, 'Gerimis', 26, 80, 924, 347, '2020-05-29', '16:20:49'),
(16, 'Hujan', 26, 81, 924, 700, '2020-05-29', '16:20:58'),
(17, 'Gerimis', 25, 88, 924, 371, '2020-05-30', '16:48:22'),
(18, 'Hujan', 25, 92, 924, 68, '2020-05-30', '16:48:25'),
(20, 'Mendung', 26, 90, 924, 11, '2020-05-30', '17:01:10'),
(21, 'Gerimis', 25, 83, 924, 55, '2020-06-16', '01:41:37'),
(22, 'Mendung', 25, 75, 923, 8, '2020-06-16', '01:45:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `node_data`
--
ALTER TABLE `node_data`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `weather_history`
--
ALTER TABLE `weather_history`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `node_data`
--
ALTER TABLE `node_data`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1753;

--
-- AUTO_INCREMENT for table `weather_history`
--
ALTER TABLE `weather_history`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
