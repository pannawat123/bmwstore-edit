-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2023 at 09:29 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bmwstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `salesdata`
--

CREATE TABLE `salesdata` (
  `SaleID` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `CustomerID` int(11) NOT NULL,
  `EmployeeID` int(11) DEFAULT NULL,
  `DetailID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `salesdata`
--

INSERT INTO `salesdata` (`SaleID`, `date`, `CustomerID`, `EmployeeID`, `DetailID`) VALUES
(46, '2023-03-21 04:49:26', 34, NULL, 85),
(47, '2023-03-21 08:23:18', 1, NULL, 86);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `salesdata`
--
ALTER TABLE `salesdata`
  ADD PRIMARY KEY (`SaleID`) USING BTREE,
  ADD KEY `CustomerID` (`CustomerID`) USING BTREE,
  ADD KEY `EmployeeID` (`EmployeeID`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `salesdata`
--
ALTER TABLE `salesdata`
  MODIFY `SaleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `salesdata`
--
ALTER TABLE `salesdata`
  ADD CONSTRAINT `salesdata_ibfk_1` FOREIGN KEY (`CustomerID`) REFERENCES `customer` (`CustomerID`),
  ADD CONSTRAINT `salesdata_ibfk_2` FOREIGN KEY (`EmployeeID`) REFERENCES `employee` (`EmployeeID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
