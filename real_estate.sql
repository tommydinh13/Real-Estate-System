-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2022 at 06:37 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `real_estate`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `email` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `addressid` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `postalcode` varchar(255) NOT NULL,
  `streetname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`addressid`, `number`, `postalcode`, `streetname`) VALUES
(1, 111, 'T2B4X6', 'Arhum Avenue'),
(2, 222, 'T3B4J9', 'Desly Drive'),
(5, 333, 'T5Q7R3', 'Tommy Street');

-- --------------------------------------------------------

--
-- Table structure for table `agent`
--

CREATE TABLE `agent` (
  `agentid` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `cid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `cityid` int(11) NOT NULL,
  `province` varchar(255) NOT NULL,
  `cityname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`cityid`, `province`, `cityname`) VALUES
(1, 'quebec', 'montreal'),
(2, 'alberta', 'calgary');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `clientid` int(11) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `cid` int(11) NOT NULL,
  `cemail` varchar(255) NOT NULL,
  `cphone` int(11) NOT NULL,
  `cname` varchar(255) NOT NULL,
  `addressid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`cid`, `cemail`, `cphone`, `cname`, `addressid`) VALUES
(1, 'arhum@company.com', 2032123222, 'Arhum Company', 1),
(2, 'desly@company.com', 1234567890, 'Desly Company ', 2),
(3, 'tommy@company.com', 1987654321, 'Tommy Company', 5);

-- --------------------------------------------------------

--
-- Table structure for table `house`
--

CREATE TABLE `house` (
  `hid` int(11) NOT NULL,
  `bathroom` int(11) NOT NULL,
  `bedroom` int(11) NOT NULL,
  `floor` int(11) NOT NULL,
  `listingtype` varchar(255) NOT NULL,
  `totalarea` decimal(10,0) NOT NULL,
  `furnishstate` varchar(255) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `photo` blob DEFAULT NULL,
  `sellerid` int(11) DEFAULT NULL,
  `agentid` int(11) DEFAULT NULL,
  `cid` int(11) DEFAULT NULL,
  `housetype` varchar(255) NOT NULL,
  `addressid` int(11) NOT NULL,
  `cityid` int(11) NOT NULL,
  `neighbourhood` varchar(255) NOT NULL,
  `quadrant` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `independent_seller`
--

CREATE TABLE `independent_seller` (
  `sellerid` int(11) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `messageid` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `senderEmail` varchar(255) NOT NULL,
  `receiverEmail` varchar(255) NOT NULL,
  `text` varchar(1024) NOT NULL,
  `subject` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`addressid`);

--
-- Indexes for table `agent`
--
ALTER TABLE `agent`
  ADD PRIMARY KEY (`agentid`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`cityid`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`clientid`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`cid`),
  ADD KEY `addressid` (`addressid`);

--
-- Indexes for table `house`
--
ALTER TABLE `house`
  ADD PRIMARY KEY (`hid`),
  ADD KEY `sellerid` (`sellerid`),
  ADD KEY `agentid` (`agentid`),
  ADD KEY `cid` (`cid`),
  ADD KEY `addressid` (`addressid`),
  ADD KEY `cityid` (`cityid`);

--
-- Indexes for table `independent_seller`
--
ALTER TABLE `independent_seller`
  ADD PRIMARY KEY (`sellerid`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`messageid`),
  ADD KEY `receiverEmail` (`receiverEmail`),
  ADD KEY `senderEmail` (`senderEmail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `addressid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `agent`
--
ALTER TABLE `agent`
  MODIFY `agentid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `cityid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `clientid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `house`
--
ALTER TABLE `house`
  MODIFY `hid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `independent_seller`
--
ALTER TABLE `independent_seller`
  MODIFY `sellerid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `messageid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `agent`
--
ALTER TABLE `agent`
  ADD CONSTRAINT `agent_ibfk_1` FOREIGN KEY (`email`) REFERENCES `account` (`email`);

--
-- Constraints for table `client`
--
ALTER TABLE `client`
  ADD CONSTRAINT `client_ibfk_1` FOREIGN KEY (`email`) REFERENCES `account` (`email`);

--
-- Constraints for table `company`
--
ALTER TABLE `company`
  ADD CONSTRAINT `company_ibfk_1` FOREIGN KEY (`addressid`) REFERENCES `address` (`addressid`);

--
-- Constraints for table `house`
--
ALTER TABLE `house`
  ADD CONSTRAINT `house_ibfk_1` FOREIGN KEY (`sellerid`) REFERENCES `independent_seller` (`sellerid`),
  ADD CONSTRAINT `house_ibfk_2` FOREIGN KEY (`agentid`) REFERENCES `agent` (`agentid`),
  ADD CONSTRAINT `house_ibfk_3` FOREIGN KEY (`cid`) REFERENCES `company` (`cid`),
  ADD CONSTRAINT `house_ibfk_4` FOREIGN KEY (`addressid`) REFERENCES `address` (`addressid`),
  ADD CONSTRAINT `house_ibfk_5` FOREIGN KEY (`cityid`) REFERENCES `city` (`cityid`);

--
-- Constraints for table `independent_seller`
--
ALTER TABLE `independent_seller`
  ADD CONSTRAINT `independent_seller_ibfk_1` FOREIGN KEY (`email`) REFERENCES `account` (`email`);

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`receiverEmail`) REFERENCES `account` (`email`),
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`senderEmail`) REFERENCES `account` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
