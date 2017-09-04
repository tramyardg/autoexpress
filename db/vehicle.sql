-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 02, 2017 at 11:45 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE `vehicle` (
  `vehicleId` int(11) NOT NULL,
  `make` varchar(30) CHARACTER SET utf8 NOT NULL,
  `yearMade` year(4) NOT NULL,
  `model` varchar(35) CHARACTER SET utf8 NOT NULL,
  `price` decimal(8,0) NOT NULL,
  `mileage` int(11) NOT NULL,
  `transmission` varchar(100) CHARACTER SET utf8 NOT NULL,
  `drivetrain` varchar(100) CHARACTER SET utf8 NOT NULL,
  `engineCapacity` varchar(5) CHARACTER SET utf8 DEFAULT NULL,
  `category` varchar(40) CHARACTER SET utf8 DEFAULT 'Not specified',
  `cylinder` double DEFAULT NULL,
  `doors` int(2) DEFAULT NULL,
  `status` varchar(10) CHARACTER SET utf8 DEFAULT 'Available',
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`vehicleId`, `make`, `yearMade`, `model`, `price`, `mileage`, `transmission`, `drivetrain`, `engineCapacity`, `category`, `cylinder`, `doors`, `status`, `dateAdded`) VALUES
(20, 'Toyota', 2003, 'CELICA', '6,977', '93,020', 'Manual', 'FWD', '1.8', 'Compact car', 4, 2, 'Available', '2017-09-02 21:41:35'),
(21, 'Toyota', 2015, 'COROL', '16,890', '62,362', 'Automatic', 'FWD', '1.8', 'Subcompact car', 4, 4, 'Available', '2017-09-02 02:31:08'),
(22, 'Honda', 2017, 'ACCORD', '28,900', '34,560', 'Automatic', 'FWD', '2.4', 'Mid-size car', 4, 4, 'Available', '2017-09-02 20:14:06'),
(23, 'BMW', 2016, 'X5', '54,998', '37,114', 'Automatic', 'AWD', '3', 'Mid-size SUV', 6, 4, 'Available', '2017-09-02 20:24:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`vehicleId`),
  ADD KEY `vehicleId` (`vehicleId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `vehicleId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
