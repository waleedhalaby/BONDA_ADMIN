-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 26, 2017 at 10:24 PM
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`ID`, `CURRENCY`) VALUES
(1, 'EGP'),
(2, 'USD');

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
(111111, 'Waleed', 'Halaby', 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', 1);

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
(6, 111111, 2, 'ACTIVE');

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
(61, 14, 111111, 1),
(64, 15, 111111, 1),
(145, 16, 111111, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=10125 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ID`, `SKU_ID`, `NAME`, `PRICE`, `CURRENCY_ID`, `DESCRIPTION`, `CATEGORY_ID`) VALUES
(10113, '#FD53AQX9', 'Onyx gemstone', '9.99', 2, 'Best bracelet for him that is made of gemstones over onyx', 7),
(10114, '#KF1MHGEC', 'Brass leaf', '11.99', 2, 'Swarovski pearls, hammered brass link chain, peach pink resin flower', 7),
(10115, '#RRQJ4UP0', 'Casio g-shock mt-g gps', '1503.49', 2, 'Hybrid wave ceptor mtg-g1000sg-1ajf mens japan import', 8),
(10116, '#WKTIP7QQ', 'Joy brushed silver mesh', '119.00', 2, 'Most famous watch for her that is designed to comfort every typical models', 8),
(10117, '#4HZQDZ7E', 'Live show gold earrings lulus', '12.12', 2, 'Take the live show gold earrings out for a night on the town! these unique antiqued gold earrings have swirling, engraved accents. earrings measure 2\" long.', 9),
(10118, '#SK2P6EHO', 'Metallic silver triangle invisible ', '21.88', 2, 'Dangle geometric clip earrings, non pierced earrings, minimalist clip-ons', 9),
(10119, '#691ZO147', 'Angel wings ring', '5.99', 2, 'Boho rings, angel jewelry, solid 925 sterling silver ring, christmas gift for women, silver rings, custom rings, initials', 10),
(10120, '#WA2UBJU3', 'Auriferous nest ring', '3.99', 2, 'Three times around', 10),
(10121, '#CAVWQV4U', 'Beautiful geometric marble pendant on gold chain', '13.99', 2, 'This would look so pretty layered with other necklaces. drop is 16â€ colors available: white square, white rectangle, black rectangle, green rectangle', 11),
(10122, '#N3KQV3NO', 'Crystal teardrop necklace gold crystal pendant', '17.99', 2, 'Crystal necklace jewellery womens gifts delicate necklace summer necklace', 11),
(10123, '#JQCX7ME8', 'Gold & iridescent rhinestone statement necklace', '25.00', 2, 'Necklace length: 36 centimetres,pendant width: 4, materials: zinc alloy, rhinestones\r\n', 11),
(10124, '#2Q8N3HL0', 'Gold & silver rhinestone bib necklace', '16.00', 2, 'Necklace length: 18 centimetres, closure: lobster claw, adjustable length: yes, materials: zinc alloy, rhinestone', 11);

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
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products_images`
--

INSERT INTO `products_images` (`ID`, `PRODUCT_ID`, `IMAGE_PATH`) VALUES
(11, 10113, 'Assets/77d14787c43f17fc9b83bff1c0df472a.jpg'),
(12, 10114, 'Assets/e1b43693aac195ea04fd81da9c54c29c.jpg'),
(13, 10114, 'Assets/il_570xN.483022612_fmxe.jpg'),
(14, 10115, 'Assets/51cBsznlwJL.jpg'),
(15, 10116, 'Assets/joy_brushed_silver_mesjh.jpg'),
(16, 10117, 'Assets/il_570xN.1379615023_6r4g.jpg'),
(17, 10118, 'Assets/il_570xN.1152836979_2avt.jpg'),
(18, 10119, 'Assets/il_570xN.1061071384_twd7.jpg'),
(19, 10119, 'Assets/il_570xN.1061071460_nsrf.jpg'),
(20, 10120, 'Assets/6ead3e2d9b3876a54710ff2a05895bfa.jpg'),
(21, 10121, 'Assets/m_59e9d518bf6df5f5a9006af5.jpg'),
(22, 10121, 'Assets/m_59e9d5136802785f29006b1f.jpg'),
(23, 10122, 'Assets/il_570xN.1289822621_g98e.jpg'),
(24, 10122, 'Assets/il_570xN.1285983691_dgkj.jpg'),
(25, 10123, 'Assets/il_570xN.1300891573_5gnl.jpg'),
(26, 10123, 'Assets/il_570xN.1253647410_po2f.jpg'),
(27, 10124, 'Assets/il_570xN.1332352210_p1tf.jpg'),
(28, 10124, 'Assets/il_570xN.1379615023_6r4g.jpg');

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`ID`, `CATEGORY`, `IS_ACTIVE`) VALUES
(7, 'Bracelets', 1),
(8, 'Watches', 1),
(9, 'Earrings', 1),
(10, 'Rings', 1),
(11, 'Necklaces', 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_features`
--

INSERT INTO `product_features` (`ID`, `FEATURE`, `DATA_TYPE_ID`, `IS_ACTIVE`) VALUES
(9, 'Handmade', 6, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_feature_values`
--

INSERT INTO `product_feature_values` (`ID`, `PRODUCT_ID`, `FEATURE_ID`, `VALUE`) VALUES
(7, 10113, 9, 'true'),
(8, 10114, 9, 'true'),
(9, 10115, 9, 'true'),
(10, 10116, 9, 'true'),
(11, 10117, 9, 'off'),
(12, 10118, 9, 'off'),
(13, 10119, 9, 'off'),
(14, 10120, 9, 'off'),
(15, 10121, 9, 'off'),
(16, 10122, 9, 'off'),
(17, 10123, 9, 'off'),
(18, 10124, 9, 'off');

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
