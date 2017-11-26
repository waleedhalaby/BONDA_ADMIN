-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 26, 2017 at 04:47 PM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jewelrydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

DROP TABLE IF EXISTS `currencies`;
CREATE TABLE IF NOT EXISTS `currencies` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CURRENCY` varchar(5) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`ID`, `CURRENCY`) VALUES
(1, 'EGP');

-- --------------------------------------------------------

--
-- Table structure for table `data_types`
--

DROP TABLE IF EXISTS `data_types`;
CREATE TABLE IF NOT EXISTS `data_types` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TYPE` varchar(200) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_types`
--

INSERT INTO `data_types` (`ID`, `TYPE`) VALUES
(1, 'STRING'),
(2, 'DATETIME'),
(3, 'INTEGER'),
(4, 'DECIMAL'),
(5, 'DOUBLE'),
(6, 'BOOLEAN');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
CREATE TABLE IF NOT EXISTS `pages` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TITLE` varchar(150) NOT NULL,
  `LINK` varchar(200) NOT NULL,
  `ICON` varchar(150) NOT NULL,
  `PARENT` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`ID`, `TITLE`, `LINK`, `ICON`, `PARENT`) VALUES
(1, 'Dashboard', 'Pages/Dashboard.php', 'icon-dashboard', 0),
(2, 'Pages Portal', 'Pages/Pages.php', 'icon-file', 0),
(3, 'Products Portal', '#', 'icon-star', 0),
(4, 'Orders Portal', 'Pages/Orders.php', 'icon-envelope', 0),
(5, 'Administration', '#', 'icon-lock', 0),
(6, 'Members', 'Pages/Admins.php', 'icon-user', 5),
(7, 'Members Privileges', 'Pages/AdminsPrivileges.php', 'icon-eye-open', 5),
(9, 'Products', 'Pages/Products.php', 'icon-gift', 3),
(10, 'Categories', 'Pages/Categories.php', 'icon-tasks', 3),
(11, 'Product Features', 'Pages/ProductFeatures.php', 'icon-briefcase', 3);

-- --------------------------------------------------------

--
-- Table structure for table `persons`
--

DROP TABLE IF EXISTS `persons`;
CREATE TABLE IF NOT EXISTS `persons` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `FIRST_NAME` varchar(150) NOT NULL,
  `LAST_NAME` varchar(150) NOT NULL,
  `EMAIL` varchar(200) NOT NULL,
  `PASSWORD` varchar(200) NOT NULL,
  `PERSON_TYPE_ID` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `PERSON_TYPE_ID` (`PERSON_TYPE_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=111125 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `persons`
--

INSERT INTO `persons` (`ID`, `FIRST_NAME`, `LAST_NAME`, `EMAIL`, `PASSWORD`, `PERSON_TYPE_ID`) VALUES
(111111, 'Waleed', 'Halaby', 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', 1),
(111123, 'Ahmed', 'Mohamed', 'ahmed@ahmed.com', '4297f44b13955235245b2497399d7a93', 1),
(111124, 'Tamer', 'Hosny', 'tamer@tamer.com', '4297f44b13955235245b2497399d7a93', 1);

-- --------------------------------------------------------

--
-- Table structure for table `person_features`
--

DROP TABLE IF EXISTS `person_features`;
CREATE TABLE IF NOT EXISTS `person_features` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `FEATURE` varchar(200) NOT NULL,
  `PERSON_TYPE_ID` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `PERSON_TYPE_ID` (`PERSON_TYPE_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `person_features`
--

INSERT INTO `person_features` (`ID`, `FEATURE`, `PERSON_TYPE_ID`) VALUES
(2, 'STATUS', 1);

-- --------------------------------------------------------

--
-- Table structure for table `person_feature_values`
--

DROP TABLE IF EXISTS `person_feature_values`;
CREATE TABLE IF NOT EXISTS `person_feature_values` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `PERSON_ID` int(11) NOT NULL,
  `PERSON_FEATURE_ID` int(11) NOT NULL,
  `VALUE` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `PERSON_ID` (`PERSON_ID`,`PERSON_FEATURE_ID`),
  KEY `FEATURE_ID` (`PERSON_FEATURE_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `person_feature_values`
--

INSERT INTO `person_feature_values` (`ID`, `PERSON_ID`, `PERSON_FEATURE_ID`, `VALUE`) VALUES
(6, 111111, 2, 'ACTIVE'),
(7, 111123, 2, 'INACTIVE'),
(8, 111124, 2, 'INACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `person_privileges`
--

DROP TABLE IF EXISTS `person_privileges`;
CREATE TABLE IF NOT EXISTS `person_privileges` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `PRIVILEGE_ID` int(11) NOT NULL,
  `PERSON_ID` int(11) NOT NULL,
  `VALUE` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `PRIVILEGE_ID` (`PRIVILEGE_ID`,`PERSON_ID`),
  KEY `PERSON_ID` (`PERSON_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=161 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `person_privileges`
--

INSERT INTO `person_privileges` (`ID`, `PRIVILEGE_ID`, `PERSON_ID`, `VALUE`) VALUES
(11, 1, 111123, 1),
(12, 2, 111123, 0),
(13, 3, 111123, 0),
(14, 4, 111123, 0),
(15, 5, 111123, 1),
(16, 6, 111123, 0),
(17, 7, 111123, 0),
(18, 8, 111123, 0),
(19, 9, 111123, 0),
(20, 10, 111123, 0),
(21, 1, 111111, 1),
(22, 2, 111111, 1),
(23, 3, 111111, 1),
(24, 4, 111111, 1),
(25, 5, 111111, 1),
(26, 6, 111111, 1),
(27, 7, 111111, 1),
(28, 8, 111111, 1),
(29, 9, 111111, 1),
(30, 10, 111111, 1),
(41, 11, 111111, 1),
(42, 11, 111123, 0),
(61, 14, 111111, 1),
(62, 14, 111123, 0),
(64, 15, 111111, 1),
(65, 15, 111123, 0),
(145, 16, 111111, 1),
(146, 16, 111123, 0),
(147, 1, 111124, 0),
(148, 2, 111124, 0),
(149, 3, 111124, 0),
(150, 4, 111124, 0),
(151, 5, 111124, 0),
(152, 6, 111124, 0),
(153, 7, 111124, 0),
(154, 8, 111124, 0),
(155, 9, 111124, 0),
(156, 10, 111124, 0),
(157, 11, 111124, 0),
(158, 14, 111124, 0),
(159, 15, 111124, 0),
(160, 16, 111124, 0);

-- --------------------------------------------------------

--
-- Table structure for table `person_types`
--

DROP TABLE IF EXISTS `person_types`;
CREATE TABLE IF NOT EXISTS `person_types` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TYPE` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `person_types`
--

INSERT INTO `person_types` (`ID`, `TYPE`) VALUES
(1, 'ADMIN'),
(2, 'USER');

-- --------------------------------------------------------

--
-- Table structure for table `privileges`
--

DROP TABLE IF EXISTS `privileges`;
CREATE TABLE IF NOT EXISTS `privileges` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `PRIVILEGE` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `privileges`
--

INSERT INTO `privileges` (`ID`, `PRIVILEGE`) VALUES
(1, 'ADD_PRODUCT'),
(2, 'EDIT_PRODUCT'),
(3, 'DELETE_PRODUCT'),
(4, 'ADD_MEMBER'),
(5, 'EDIT_MEMBER'),
(6, 'DELETE_MEMBER'),
(7, 'ADD_PAGE'),
(8, 'EDIT_PAGE'),
(9, 'DELETE_PAGE'),
(10, 'UPDATE_PRIVILEGES'),
(11, 'ADD_PRIVILEGES'),
(14, 'ADD_CATEGORY'),
(15, 'UPDATE_CATEGORY'),
(16, 'ADD_PRODUCT_FEATURE');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `SKU_ID` varchar(20) DEFAULT NULL,
  `NAME` varchar(255) NOT NULL,
  `PRICE` decimal(10,2) NOT NULL,
  `CURRENCY_ID` int(11) NOT NULL,
  `DESCRIPTION` varchar(255) DEFAULT NULL,
  `CATEGORY_ID` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `CATEGORY_ID` (`CATEGORY_ID`),
  KEY `CURRENCY_ID` (`CURRENCY_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=10106 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ID`, `SKU_ID`, `NAME`, `PRICE`, `CURRENCY_ID`, `DESCRIPTION`, `CATEGORY_ID`) VALUES
(10103, '#Y7CE77B5', 'Blouse', '123.94', 1, 'These are great blouses', 2),
(10104, '#15SAMC0R', 'Pants', '324.12', 1, 'Best pants ever', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products_images`
--

DROP TABLE IF EXISTS `products_images`;
CREATE TABLE IF NOT EXISTS `products_images` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `PRODUCT_ID` int(11) NOT NULL,
  `IMAGE_PATH` varchar(200) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `PRODUCT_ID` (`PRODUCT_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products_images`
--

INSERT INTO `products_images` (`ID`, `PRODUCT_ID`, `IMAGE_PATH`) VALUES
(62, 10103, 'Assets/blouse.jpg'),
(63, 10103, 'Assets/blouse2.jpg'),
(64, 10104, 'Assets/8149171_fpx.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

DROP TABLE IF EXISTS `product_categories`;
CREATE TABLE IF NOT EXISTS `product_categories` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CATEGORY` varchar(200) NOT NULL,
  `IS_ACTIVE` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`ID`, `CATEGORY`, `IS_ACTIVE`) VALUES
(1, 'Earrings', 1),
(2, 'Neclaces', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_features`
--

DROP TABLE IF EXISTS `product_features`;
CREATE TABLE IF NOT EXISTS `product_features` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `FEATURE` varchar(200) NOT NULL,
  `DATA_TYPE_ID` int(200) NOT NULL,
  `IS_ACTIVE` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `DATA_TYPE_ID` (`DATA_TYPE_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_features`
--

INSERT INTO `product_features` (`ID`, `FEATURE`, `DATA_TYPE_ID`, `IS_ACTIVE`) VALUES
(4, 'Entry date', 2, 1),
(5, 'Stock', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_feature_values`
--

DROP TABLE IF EXISTS `product_feature_values`;
CREATE TABLE IF NOT EXISTS `product_feature_values` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `PRODUCT_ID` int(11) NOT NULL,
  `FEATURE_ID` int(11) NOT NULL,
  `VALUE` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `PRODUCT_ID` (`PRODUCT_ID`,`FEATURE_ID`),
  KEY `FEATURE_ID` (`FEATURE_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_feature_values`
--

INSERT INTO `product_feature_values` (`ID`, `PRODUCT_ID`, `FEATURE_ID`, `VALUE`) VALUES
(11, 10103, 4, '2017-11-21'),
(12, 10104, 4, '2017-11-13'),
(13, 10104, 5, '231');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `persons`
--
ALTER TABLE `persons`
  ADD CONSTRAINT `persons_ibfk_1` FOREIGN KEY (`PERSON_TYPE_ID`) REFERENCES `person_types` (`ID`);

--
-- Constraints for table `person_features`
--
ALTER TABLE `person_features`
  ADD CONSTRAINT `person_features_ibfk_1` FOREIGN KEY (`PERSON_TYPE_ID`) REFERENCES `person_types` (`ID`);

--
-- Constraints for table `person_feature_values`
--
ALTER TABLE `person_feature_values`
  ADD CONSTRAINT `person_feature_values_ibfk_1` FOREIGN KEY (`PERSON_FEATURE_ID`) REFERENCES `person_features` (`ID`),
  ADD CONSTRAINT `person_feature_values_ibfk_2` FOREIGN KEY (`PERSON_ID`) REFERENCES `persons` (`ID`);

--
-- Constraints for table `person_privileges`
--
ALTER TABLE `person_privileges`
  ADD CONSTRAINT `person_privileges_ibfk_1` FOREIGN KEY (`PRIVILEGE_ID`) REFERENCES `privileges` (`ID`),
  ADD CONSTRAINT `person_privileges_ibfk_2` FOREIGN KEY (`PERSON_ID`) REFERENCES `persons` (`ID`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`CATEGORY_ID`) REFERENCES `product_categories` (`ID`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`CURRENCY_ID`) REFERENCES `currencies` (`ID`);

--
-- Constraints for table `products_images`
--
ALTER TABLE `products_images`
  ADD CONSTRAINT `products_images_ibfk_1` FOREIGN KEY (`PRODUCT_ID`) REFERENCES `products` (`ID`);

--
-- Constraints for table `product_features`
--
ALTER TABLE `product_features`
  ADD CONSTRAINT `product_features_ibfk_1` FOREIGN KEY (`DATA_TYPE_ID`) REFERENCES `data_types` (`ID`);

--
-- Constraints for table `product_feature_values`
--
ALTER TABLE `product_feature_values`
  ADD CONSTRAINT `product_feature_values_ibfk_1` FOREIGN KEY (`PRODUCT_ID`) REFERENCES `products` (`ID`),
  ADD CONSTRAINT `product_feature_values_ibfk_2` FOREIGN KEY (`FEATURE_ID`) REFERENCES `product_features` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
