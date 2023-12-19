-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2023 at 06:00 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

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
  `ImageURL` varchar(60) NOT NULL,
  `Qty` int(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`ItemID`, `Name`, `Description`, `Category`, `Brand`, `Price`, `ImageURL`) VALUES
(7, 'Nike essentials T-Shirt', 'Black Nike T Shirt, featuring the classic Nike Logo in white. Made with 100% cotton. Perfect for every occasion.', 'Tops', 'Nike', 23, 'backend/itemimages/65810c28ecf207.24067671.jpg', 205),
(8, 'Nike Athletic T-Shirt', 'Featuring Nike\\\'s slogan &quot;Just Do It!&quot; in a 100% cotton white shirt. Perfect for every occasion.', 'Tops', 'Nike', 21, 'backend/itemimages/65810eaf68afb3.92016855.jpg', 205),
(9, 'Nike Grey Sweatpants', 'Get Comfy and Cozy this winter with the Nike fleece lined grey sweatpants. Perfect for casual wear.', 'Bottoms', 'Nike', 55, 'backend/itemimages/6581102e3ff339.30782791.jpg', 205),
(10, 'Nike Athletic Sweatpants', 'Comfy with an Athletic fit, these sweatpants is popular among the athletes for its comfort. Featuring a combination of 80% cotton and 20% polyester, this is perfect for athletes on-the-go.', 'Bottoms', 'Nike', 60, 'backend/itemimages/658114f946c536.81634930.jpg', 205),
(11, 'Nike Backpack', 'Made for durability. Constructed with fine synthetic fibers, this backpack has a high storage capacity of 20L.', 'Accessories', 'Nike', 45, 'backend/itemimages/6581154aa8b5b6.19080964.jpg', 205),
(12, 'Nike Hat', 'Black Nike essential hat. Perfect for everyday wear.', 'Accessories', 'Nike', 15, 'backend/itemimages/6581157d80a340.53721800.jpg', 205),
(13, 'Nike Air Force Sneaker', 'Upper made with patent leather, and bottom with Nikes Air Force technology. This is a must have for its style and comfort.', 'Accessories', 'Nike', 120, 'backend/itemimages/658115bf769b91.86056945.jpg', 205),
(14, 'Adidas Originals Shirt', 'Black regular fit adidas shirt. Featuring the originals logo in white. Perfect for casual wear.', 'Tops', 'Adidas', 20, 'backend/itemimages/6581163baa4742.17957064.jpg', 205),
(15, 'Adidas Stripes Shirt', 'Athletic Dry Fit shirt in white. Featuring black stripes along the shoulders, and a minimal originals logo by the chest.', 'Tops', 'Adidas', 22, 'backend/itemimages/6581168182cab3.69875458.jpg', 205),
(16, 'Adidas Originals Trackpants', 'The iconic adidas originals track pants in the black colorway. These pants have a comfortable and athletic fit, perfect for athletes on-the-go.', 'Bottoms', 'Adidas', 67, 'backend/itemimages/658116d482d8f2.40977023.jpg', 205),
(17, 'Adidas Track Pants', 'Featuring a tapered ankle, made for comfort and durability, these white track pants are great for all season.', 'Bottoms', 'Adidas', 58, 'backend/itemimages/65811731417db5.74806311.jpg', 205),
(18, 'Adidas Originals Shoes', 'From the 2022 Adidas Originals Collection, this dad-shoe gives the perfect chunky look to the oversized style.', 'Accessories', 'Adidas', 100, 'backend/itemimages/6581178a91fd97.71440216.jpg', 205),
(19, 'Adidas Athletic Hat', 'Adidas classic athletic hat in black colorway. Features an adjustable width to fit any size!', 'Accessories', 'Adidas', 18, 'backend/itemimages/658117e282a3f6.17221899.jpg', 205),
(20, 'Adidas Essential Backpack', 'Inspired from the minimalistic design, this backpack features two zipper compartments. Fitting up to 16L of storage. Perfect for school and sporting events.', 'Accessories', 'Adidas', 45, 'backend/itemimages/658118714fbf87.87517446.jpg', 205),
(21, 'Reebok Bold Shirt', 'Featuring the classic Reebok logo, this black shirt is an essential for everyday wear. Inspired from the 1990s Reebok fall collection. Comfort from its 100% cotton material.', 'Tops', 'Reebok', 25, 'backend/itemimages/6581190bb231f3.54227979.jpg', 205),
(22, 'Reebok Modern Shirt', 'White athletic fit shirt with Reebok\\\'s classic logo in black. This shirt features a 80% cotton and 20% polyester construction, made for durability.', 'Tops', 'Reebok', 22, 'backend/itemimages/658119671d56b9.27311820.jpg', 205),
(23, 'Reebok Modern Joggers', 'Inspired from Rally racer track suits, this jogger features a mix of red, yellow and blue colors. Made for a baggy and relaxed fit.', 'Bottoms', 'Reebok', 54, 'backend/itemimages/658119d6491441.75988483.jpg', 205),
(24, 'Reebok Monotone Sweatpants', 'Inspired from parachute pants and racer collection, made from 70% cotton, 30% polyester. Wear these to any occasion while feeling comfy.', 'Bottoms', 'Reebok', 47, 'backend/itemimages/65811cff378148.72412965.jpg', 205),
(25, 'Reebok Backpack', 'Made for a massive storing capacity, this backpack stores up to 22L. Constructed with fine synthetic fiber for long lasting durability. Perfect for school, work &amp; recreation.', 'Accessories', 'Reebok', 62, 'backend/itemimages/65811d56dc4362.28839996.jpg', 205),
(26, 'Jordan Supreme Shirt', 'From the Jordan x Supreme Collaboration collection. Features a premium cotton finish, and the classic Jordan logo in red over the Supreme logo.', 'Tops', 'Jordan', 55, 'backend/itemimages/65811daf409449.45723438.jpg', 205),
(27, 'Jordan Essential Shirt', 'Black Jordan shirt with a minimal logo on the chest area. This provides comfort with its 80% cotton construction. Perfect for everyday wear.', 'Tops', 'Jordan', 26, 'backend/itemimages/65811df56c2186.27168807.jpg', 205),
(28, 'Jordan Grey Sweatpants', 'Classic Jordan Grey sweatpants with a comfy fleece lined interior. Made for everyday comfort.', 'Bottoms', 'Jordan', 67, 'backend/itemimages/65811e323156a1.30946470.jpg', 205),
(29, 'Jordan Bred Trackpants', 'A modern style with bold red accent on the black track pants. These track pants create a relaxed, baggy fit.', 'Bottoms', 'Jordan', 59, 'backend/itemimages/65811e89481762.33434354.jpg', 205),
(30, 'Jordan Headband', 'Perfect for intensive physical activity, made for athletes. Features classic Jordan jumpman logo.', 'Accessories', 'Jordan', 24, 'backend/itemimages/65811ed6855107.75865601.jpg', 205),
(31, 'Jordan Backpack', 'Features two zipper compartments, fitting up to 18L of storage capacity. Made for comfort with padded shoulder support, and features the accent Jordan Jumpman logo.', 'Accessories', 'Jordan', 54, 'backend/itemimages/65811f2fbf3128.62665791.jpg', 205);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `OrderID` bigint(20) NOT NULL,
  `CustomerID` bigint(20) NOT NULL,
  `DatePurchase` varchar(30) NOT NULL,
  `TotalCost` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`OrderID`, `CustomerID`, `DatePurchase`, `TotalCost`) VALUES
(99428, 689569493090891064, '2023-12-18', 46),
(2517926, 689569493090891064, '2023-12-02', 255),
(889990995206, 689569493090891064, '2023-12-02', 224),
(5463347731394, 32699, '2023-12-01', 269),
(22961120920048, 689569493090891064, '2023-12-18', 45),
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(2517926, 1, 'Jonathan Marghetis', 'test', 'test', 45, '', 1),
(99428, 3, 'White Shirt', 'Shirt', 'Nike', 46, 'backend/itemimages/656b2590ed2262.81130387.jpg', 1),
(22961120920048, 1, 'Jonathan Marghetis', 'test', 'test', 45, '', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `FirstName`, `LastName`, `Email`, `Password`, `Rank`) VALUES
(3879, 'L', 'L', 'leonli1928@gmail.com', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'user'),
(32699, 'Jim', 'Sim', 'jim@mail.com', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'user'),
(67068534624678948, 'test', 'test', 'testingmail@gmail.com', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'user'),
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
  MODIFY `ItemID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

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
