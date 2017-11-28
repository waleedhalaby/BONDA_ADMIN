-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 28, 2017 at 02:43 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `jewelrydb`
--
CREATE DATABASE IF NOT EXISTS `jewelrydb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `jewelrydb`;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE IF NOT EXISTS `carts` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `PERSON_ID` int(11) NOT NULL,
  `TOTAL` decimal(10,2) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `PERSON_ID` (`PERSON_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`ID`, `PERSON_ID`, `TOTAL`) VALUES
(7, 111126, '42.99'),
(9, 111127, '27.87');

-- --------------------------------------------------------

--
-- Table structure for table `cart_details`
--

CREATE TABLE IF NOT EXISTS `cart_details` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `PRODUCT_ID` int(11) NOT NULL,
  `QUANTITY` int(11) NOT NULL,
  `PRICE` decimal(10,2) NOT NULL,
  `CART_ID` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `PRODUCT_ID` (`PRODUCT_ID`),
  KEY `CART_ID` (`CART_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `cart_details`
--

INSERT INTO `cart_details` (`ID`, `PRODUCT_ID`, `QUANTITY`, `PRICE`, `CART_ID`) VALUES
(12, 10122, 1, '17.99', 7),
(13, 10123, 1, '25.00', 7),
(18, 10119, 1, '5.99', 9),
(19, 10118, 1, '21.88', 9);

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE IF NOT EXISTS `currencies` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CURRENCY` varchar(5) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

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

CREATE TABLE IF NOT EXISTS `data_types` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TYPE` varchar(200) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

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
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `UNIQUE_ID` varchar(20) NOT NULL,
  `PERSON_ID` int(11) NOT NULL,
  `ORDER_DATE_TIME` datetime NOT NULL,
  `SHIP_DATE_TIME` datetime DEFAULT NULL,
  `ORDER_STATUS_ID` int(11) NOT NULL,
  `PAYMENT_TYPE_ID` int(11) NOT NULL,
  `CART_ID` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `PERSON_ID` (`PERSON_ID`,`ORDER_STATUS_ID`,`PAYMENT_TYPE_ID`),
  KEY `ORDER_STATUS_ID` (`ORDER_STATUS_ID`),
  KEY `PAYMENT_TYPE_ID` (`PAYMENT_TYPE_ID`),
  KEY `CART_ID` (`CART_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`ID`, `UNIQUE_ID`, `PERSON_ID`, `ORDER_DATE_TIME`, `SHIP_DATE_TIME`, `ORDER_STATUS_ID`, `PAYMENT_TYPE_ID`, `CART_ID`) VALUES
(4, '5a1c9abeaad0f', 111126, '2017-11-28 01:07:42', NULL, 5, 1, 7),
(5, '5a1c9e4ee4213', 111127, '2017-11-28 01:22:54', NULL, 1, 1, 9);

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE IF NOT EXISTS `order_status` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `STATUS` varchar(30) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`ID`, `STATUS`) VALUES
(1, 'PENDING'),
(2, 'QUEUED'),
(3, 'SHIPPED'),
(4, 'DELIVERED'),
(5, 'CANCELLED');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TITLE` varchar(150) NOT NULL,
  `LINK` varchar(200) NOT NULL,
  `ICON` varchar(150) NOT NULL,
  `PARENT` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`ID`, `TITLE`, `LINK`, `ICON`, `PARENT`) VALUES
(1, 'Dashboard', 'Pages/Dashboard.php', 'icon-dashboard', 0),
(2, 'Pages Portal', 'Pages/Pages.php', 'icon-file', 0),
(3, 'Products Portal', '#', 'icon-star', 0),
(4, 'Orders Portal', '#', 'icon-book', 0),
(5, 'Administration', '#', 'icon-lock', 0),
(6, 'Members', 'Pages/Admins.php', 'icon-user', 5),
(7, 'Members Privileges', 'Pages/AdminsPrivileges.php', 'icon-eye-open', 5),
(9, 'Products', 'Pages/Products.php', 'icon-gift', 3),
(10, 'Categories', 'Pages/Categories.php', 'icon-tasks', 3),
(11, 'Product Features', 'Pages/ProductFeatures.php', 'icon-briefcase', 3),
(12, 'Pending Orders', 'Pages/PendingOrders.php', 'icon-envelope', 4),
(13, 'Queued Orders', 'Pages/QueuedOrders.php', 'icon-envelope-alt', 4),
(14, 'Delivered Orders', 'Pages/DeliveredOrders.php', 'icon-shopping-cart', 4),
(15, 'Cancelled Orders', 'Pages/CancelledOrders.php', 'icon-ban-circle', 4);

-- --------------------------------------------------------

--
-- Table structure for table `payment_types`
--

CREATE TABLE IF NOT EXISTS `payment_types` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TYPE` varchar(30) NOT NULL,
  `IS_ACTIVE` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `payment_types`
--

INSERT INTO `payment_types` (`ID`, `TYPE`, `IS_ACTIVE`) VALUES
(1, 'DELIVER', 1),
(2, 'VISA', 0);

-- --------------------------------------------------------

--
-- Table structure for table `persons`
--

CREATE TABLE IF NOT EXISTS `persons` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `FIRST_NAME` varchar(150) NOT NULL,
  `LAST_NAME` varchar(150) NOT NULL,
  `EMAIL` varchar(200) NOT NULL,
  `PASSWORD` varchar(200) NOT NULL,
  `PERSON_TYPE_ID` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `PERSON_TYPE_ID` (`PERSON_TYPE_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=111128 ;

--
-- Dumping data for table `persons`
--

INSERT INTO `persons` (`ID`, `FIRST_NAME`, `LAST_NAME`, `EMAIL`, `PASSWORD`, `PERSON_TYPE_ID`) VALUES
(111111, 'Waleed', 'Halaby', 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', 1),
(111125, 'Ahmed', 'Mostafa', 'ahmed@ahmed.com', '4297f44b13955235245b2497399d7a93', 1),
(111126, 'Hossam', 'Magdy', 'hossam@hossam.com', '4297f44b13955235245b2497399d7a93', 2),
(111127, 'Islam', 'Sami', 'islam@islam.com', '4297f44b13955235245b2497399d7a93', 2);

-- --------------------------------------------------------

--
-- Table structure for table `person_features`
--

CREATE TABLE IF NOT EXISTS `person_features` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `FEATURE` varchar(200) NOT NULL,
  `PERSON_TYPE_ID` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `PERSON_TYPE_ID` (`PERSON_TYPE_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `person_features`
--

INSERT INTO `person_features` (`ID`, `FEATURE`, `PERSON_TYPE_ID`) VALUES
(2, 'STATUS', 1);

-- --------------------------------------------------------

--
-- Table structure for table `person_feature_values`
--

CREATE TABLE IF NOT EXISTS `person_feature_values` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `PERSON_ID` int(11) NOT NULL,
  `PERSON_FEATURE_ID` int(11) NOT NULL,
  `VALUE` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `PERSON_ID` (`PERSON_ID`,`PERSON_FEATURE_ID`),
  KEY `FEATURE_ID` (`PERSON_FEATURE_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `person_feature_values`
--

INSERT INTO `person_feature_values` (`ID`, `PERSON_ID`, `PERSON_FEATURE_ID`, `VALUE`) VALUES
(6, 111111, 2, 'ACTIVE'),
(9, 111125, 2, 'INACTIVE'),
(10, 111126, 2, 'INACTIVE'),
(11, 111127, 2, 'INACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `person_privileges`
--

CREATE TABLE IF NOT EXISTS `person_privileges` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `PRIVILEGE_ID` int(11) NOT NULL,
  `PERSON_ID` int(11) NOT NULL,
  `VALUE` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `PRIVILEGE_ID` (`PRIVILEGE_ID`,`PERSON_ID`),
  KEY `PERSON_ID` (`PERSON_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=212 ;

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
(145, 16, 111111, 1),
(161, 1, 111125, 0),
(162, 2, 111125, 0),
(163, 3, 111125, 0),
(164, 4, 111125, 0),
(165, 5, 111125, 0),
(166, 6, 111125, 0),
(167, 7, 111125, 0),
(168, 8, 111125, 0),
(169, 9, 111125, 0),
(170, 10, 111125, 0),
(171, 11, 111125, 0),
(172, 14, 111125, 0),
(173, 15, 111125, 0),
(174, 16, 111125, 0),
(175, 1, 111126, 0),
(176, 2, 111126, 0),
(177, 3, 111126, 0),
(178, 4, 111126, 0),
(179, 5, 111126, 0),
(180, 6, 111126, 0),
(181, 7, 111126, 0),
(182, 8, 111126, 0),
(183, 9, 111126, 0),
(184, 10, 111126, 0),
(185, 11, 111126, 0),
(186, 14, 111126, 0),
(187, 15, 111126, 0),
(188, 16, 111126, 0),
(189, 17, 111111, 1),
(190, 17, 111125, 0),
(191, 1, 111127, 0),
(192, 2, 111127, 0),
(193, 3, 111127, 0),
(194, 4, 111127, 0),
(195, 5, 111127, 0),
(196, 6, 111127, 0),
(197, 7, 111127, 0),
(198, 8, 111127, 0),
(199, 9, 111127, 0),
(200, 10, 111127, 0),
(201, 11, 111127, 0),
(202, 14, 111127, 0),
(203, 15, 111127, 0),
(204, 16, 111127, 0),
(205, 17, 111127, 0),
(206, 18, 111111, 1),
(207, 18, 111125, 0),
(208, 19, 111111, 1),
(209, 19, 111125, 0),
(210, 20, 111111, 1),
(211, 20, 111125, 0);

-- --------------------------------------------------------

--
-- Table structure for table `person_types`
--

CREATE TABLE IF NOT EXISTS `person_types` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TYPE` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

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

CREATE TABLE IF NOT EXISTS `privileges` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `PRIVILEGE` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

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
(16, 'ADD_PRODUCT_FEATURE'),
(17, 'UPDATE_PENDING_ORDER'),
(18, 'UPDATE_QUEUED_ORDER'),
(19, 'SHOW_DELIVERED_ORDER'),
(20, 'SHOW_CANCELLED_ORDER');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10126 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ID`, `SKU_ID`, `NAME`, `PRICE`, `CURRENCY_ID`, `DESCRIPTION`, `CATEGORY_ID`) VALUES
(10113, '#FD53AQX9', 'Onyx gemstone', '9.99', 2, 'Best bracelet for him that is made of gemstones over onyx', 7),
(10114, '#KF1MHGEC', 'Brass leaf', '11.99', 2, 'Swarovski pearls, hammered brass link chain, peach pink resin flower', 7),
(10115, '#RRQJ4UP0', 'Casio g-shock mt-g gps', '1503.49', 2, 'Hybrid wave ceptor mtg-g1000sg-1ajf mens japan import', 8),
(10116, '#WKTIP7QQ', 'Joy brushed silver mesh', '119.00', 2, 'Most famous watch for her that is designed to comfort every typical models', 8),
(10117, '#4HZQDZ7E', 'Live show gold earrings lulus', '12.12', 2, 'Take the live show gold earrings out for a night on the town! these unique antiqued gold earrings have swirling, engraved accents. earrings measure 2" long.', 9),
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

CREATE TABLE IF NOT EXISTS `products_images` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `PRODUCT_ID` int(11) NOT NULL,
  `IMAGE_PATH` varchar(200) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `PRODUCT_ID` (`PRODUCT_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `products_images`
--

INSERT INTO `products_images` (`ID`, `PRODUCT_ID`, `IMAGE_PATH`) VALUES
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
(28, 10124, 'Assets/il_570xN.1379615023_6r4g.jpg'),
(29, 10113, 'Assets/77d14787c43f17fc9b83bff1c0df472a.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE IF NOT EXISTS `product_categories` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CATEGORY` varchar(200) NOT NULL,
  `IS_ACTIVE` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

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

CREATE TABLE IF NOT EXISTS `product_features` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `FEATURE` varchar(200) NOT NULL,
  `DATA_TYPE_ID` int(200) NOT NULL,
  `IS_ACTIVE` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `DATA_TYPE_ID` (`DATA_TYPE_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `product_features`
--

INSERT INTO `product_features` (`ID`, `FEATURE`, `DATA_TYPE_ID`, `IS_ACTIVE`) VALUES
(9, 'Handmade', 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_feature_values`
--

CREATE TABLE IF NOT EXISTS `product_feature_values` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `PRODUCT_ID` int(11) NOT NULL,
  `FEATURE_ID` int(11) NOT NULL,
  `VALUE` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `PRODUCT_ID` (`PRODUCT_ID`,`FEATURE_ID`),
  KEY `FEATURE_ID` (`FEATURE_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

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
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_2` FOREIGN KEY (`PERSON_ID`) REFERENCES `persons` (`ID`);

--
-- Constraints for table `cart_details`
--
ALTER TABLE `cart_details`
  ADD CONSTRAINT `cart_details_ibfk_2` FOREIGN KEY (`CART_ID`) REFERENCES `carts` (`ID`),
  ADD CONSTRAINT `cart_details_ibfk_1` FOREIGN KEY (`PRODUCT_ID`) REFERENCES `products` (`ID`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_4` FOREIGN KEY (`CART_ID`) REFERENCES `carts` (`ID`),
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`PERSON_ID`) REFERENCES `persons` (`ID`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`ORDER_STATUS_ID`) REFERENCES `order_status` (`ID`),
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`PAYMENT_TYPE_ID`) REFERENCES `payment_types` (`ID`);

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
