-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2023 at 02:24 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dogs_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `ItemID` bigint(20) NOT NULL,
  `Name` varchar(60) NOT NULL,
  `Description` varchar(250) NOT NULL,
  `Category` varchar(60) NOT NULL,
  `Brand` varchar(60) NOT NULL,
  `Price` float NOT NULL,
  `ImageURL` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`ItemID`, `Name`, `Description`, `Category`, `Brand`, `Price`, `ImageURL`) VALUES
(1, 'Jonathan Marghetis', 'test', 'test', 'test', 45, ''),
(2, 'Shirt', 'This is a shirt', 'summer', 'Nike', 89, ''),
(3, 'White Shirt', 'This is a white shirt.', 'Shirt', 'Nike', 46, 'backend/itemimages/656b2590ed2262.81130387.jpg'),
(5, 'Black Jeans', 'These are black jeans', 'Pants', 'old navy', 70, 'backend/itemimages/656b27bc541e13.93727413.png'),
(6, 'Straw Hat', 'A hat ready for anything', 'Hat', 'A', 100, 'backend/itemimages/656b2c71c76d99.11843789.png');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `OrderID` bigint(20) NOT NULL,
  `CustomerID` bigint(20) NOT NULL,
  `DatePurchase` varchar(30) NOT NULL,
  `TotalCost` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`OrderID`, `CustomerID`, `DatePurchase`, `TotalCost`) VALUES
(2517926, 689569493090891064, '2023-12-02', 255),
(889990995206, 689569493090891064, '2023-12-02', 224),
(5463347731394, 32699, '2023-12-01', 269),
(37126886476125, 689569493090891064, '2023-12-01', 45),
(260715786918213, 689569493090891064, '2023-12-02', 135),
(337881039272160, 8247001511, '2023-12-02', 255),
(8658764066242929774, 689569493090891064, '2023-12-02', 269);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `OrderID` bigint(20) NOT NULL,
  `ItemID` bigint(20) NOT NULL,
  `Name` varchar(60) NOT NULL,
  `Category` varchar(60) NOT NULL,
  `Brand` varchar(60) NOT NULL,
  `Price` float NOT NULL,
  `ImageURL` varchar(60) NOT NULL,
  `Qty` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`OrderID`, `ItemID`, `Name`, `Category`, `Brand`, `Price`, `ImageURL`, `Qty`) VALUES
(5463347731394, 2, 'Shirt', 'summer', 'Nike', 89, '', 1),
(5463347731394, 1, 'Jonathan Marghetis', 'test', 'test', 45, '', 4),
(889990995206, 1, 'Jonathan Marghetis', 'test', 'test', 45, '', 3),
(889990995206, 2, 'Shirt', 'summer', 'Nike', 89, '', 1),
(37126886476125, 1, 'Jonathan Marghetis', 'test', 'test', 45, '', 1),
(8658764066242929774, 1, 'Jonathan Marghetis', 'test', 'test', 45, '', 4),
(8658764066242929774, 2, 'Shirt', 'summer', 'Nike', 89, '', 1),
(260715786918213, 1, 'Jonathan Marghetis', 'test', 'test', 45, '', 3),
(337881039272160, 5, 'Black Jeans', 'pants', 'old navy', 70, 'backend/itemimages/656b27bc541e13.93727413.png', 3),
(337881039272160, 1, 'Jonathan Marghetis', 'test', 'test', 45, '', 1),
(2517926, 5, 'Black Jeans', 'pants', 'old navy', 70, 'backend/itemimages/656b27bc541e13.93727413.png', 3),
(2517926, 1, 'Jonathan Marghetis', 'test', 'test', 45, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` bigint(20) NOT NULL,
  `FirstName` varchar(20) NOT NULL,
  `LastName` varchar(20) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(64) NOT NULL,
  `Rank` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `FirstName`, `LastName`, `Email`, `Password`, `Rank`) VALUES
(32699, 'Jim', 'Sim', 'jim@mail.com', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'user'),
(689569493090891064, 'Jonathan', 'Marghetis', 'jonathanmarghetis@gmail.com', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`ItemID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderID`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD KEY `OrderID` (`OrderID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `ItemID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `OrderID` FOREIGN KEY (`OrderID`) REFERENCES `orders` (`OrderID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
