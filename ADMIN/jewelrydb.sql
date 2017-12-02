-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 02, 2017 at 02:17 AM
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
-- Table structure for table `carts`
--

DROP TABLE IF EXISTS `carts`;
CREATE TABLE IF NOT EXISTS `carts` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `PERSON_ID` int(11) NOT NULL,
  `TOTAL` decimal(10,2) NOT NULL,
  `CART_STATUS_ID` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `PERSON_ID` (`PERSON_ID`),
  KEY `CART_STATUS_ID` (`CART_STATUS_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cart_details`
--

DROP TABLE IF EXISTS `cart_details`;
CREATE TABLE IF NOT EXISTS `cart_details` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `PRODUCT_ID` int(11) NOT NULL,
  `QUANTITY` int(11) NOT NULL,
  `PRICE` decimal(10,2) NOT NULL,
  `CART_ID` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `PRODUCT_ID` (`PRODUCT_ID`),
  KEY `CART_ID` (`CART_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cart_status`
--

DROP TABLE IF EXISTS `cart_status`;
CREATE TABLE IF NOT EXISTS `cart_status` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `STATUS` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cart_status`
--

INSERT INTO `cart_status` (`ID`, `STATUS`) VALUES
(1, 'PENDING'),
(2, 'ORDERED');

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
-- Table structure for table `log_activities`
--

DROP TABLE IF EXISTS `log_activities`;
CREATE TABLE IF NOT EXISTS `log_activities` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `DATE_TIME` datetime NOT NULL,
  `PERSON_ID` int(11) NOT NULL,
  `PAGE_ID` int(11) NOT NULL,
  `VALUE` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `PERSON_ID` (`PERSON_ID`),
  KEY `PAGE_ID` (`PAGE_ID`),
  KEY `PERSON_ID_2` (`PERSON_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NOTIFY_DATE_TIME` datetime NOT NULL,
  `ICON` varchar(150) NOT NULL,
  `COLOR` varchar(100) NOT NULL,
  `PAGE_URL` varchar(255) NOT NULL,
  `DESCRIPTION` varchar(255) NOT NULL,
  `IS_SEEN` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

DROP TABLE IF EXISTS `order_status`;
CREATE TABLE IF NOT EXISTS `order_status` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `STATUS` varchar(30) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

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

DROP TABLE IF EXISTS `pages`;
CREATE TABLE IF NOT EXISTS `pages` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TITLE` varchar(150) NOT NULL,
  `LINK` varchar(200) NOT NULL,
  `ICON` varchar(150) NOT NULL,
  `PARENT` int(11) NOT NULL,
  `IS_VISIBLE` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`ID`, `TITLE`, `LINK`, `ICON`, `PARENT`, `IS_VISIBLE`) VALUES
(1, 'Dashboard', 'Pages/Dashboard.php', 'icon-dashboard', 0, 1),
(2, 'Pages Portal', 'Pages/Pages.php', 'icon-file', 0, 1),
(3, 'Products Portal', '#', 'icon-star', 0, 1),
(4, 'Orders Portal', '#', 'icon-book', 0, 1),
(5, 'Administration', '#', 'icon-lock', 0, 1),
(6, 'Members', 'Pages/Admins.php', 'icon-user', 5, 1),
(7, 'Members Privileges', 'Pages/AdminsPrivileges.php', 'icon-eye-open', 5, 1),
(9, 'Products', 'Pages/Products.php', 'icon-gift', 3, 1),
(10, 'Categories', 'Pages/Categories.php', 'icon-tasks', 3, 1),
(11, 'Product Features', 'Pages/ProductFeatures.php', 'icon-briefcase', 3, 0),
(12, 'Pending Orders', 'Pages/PendingOrders.php', 'icon-envelope', 4, 1),
(13, 'Queued Orders', 'Pages/QueuedOrders.php', 'icon-envelope-alt', 4, 1),
(14, 'Shipped Orders', 'Pages/ShippedOrders.php', 'icon-truck', 4, 1),
(15, 'Delivered Orders', 'Pages/DeliveredOrders.php', 'icon-shopping-cart', 4, 1),
(16, 'Log Activities', 'Pages/LogActivities.php', 'icon-user', 0, 1),
(17, 'Cancelled Orders', 'Pages/CancelledOrders.php', 'icon-ban-circle', 4, 1),
(18, 'Member Roles', 'Pages/MemberRoles.php', 'icon-sitemap', 5, 1),
(19, 'Search Orders', 'Pages/SearchOrders.php', 'icon-search', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment_types`
--

DROP TABLE IF EXISTS `payment_types`;
CREATE TABLE IF NOT EXISTS `payment_types` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TYPE` varchar(30) NOT NULL,
  `IS_ACTIVE` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=111158 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `persons`
--

INSERT INTO `persons` (`ID`, `FIRST_NAME`, `LAST_NAME`, `EMAIL`, `PASSWORD`, `PERSON_TYPE_ID`) VALUES
(111111, 'Admin', 'Admin', 'admin@admin.com', '4297f44b13955235245b2497399d7a93', 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=584 DEFAULT CHARSET=latin1;

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
(189, 17, 111111, 1),
(206, 18, 111111, 1),
(208, 19, 111111, 1),
(210, 20, 111111, 1),
(212, 21, 111111, 1),
(308, 25, 111111, 1),
(369, 26, 111111, 1),
(413, 27, 111111, 1),
(415, 28, 111111, 1),
(417, 29, 111111, 1),
(583, 30, 111111, 1);

-- --------------------------------------------------------

--
-- Table structure for table `person_types`
--

DROP TABLE IF EXISTS `person_types`;
CREATE TABLE IF NOT EXISTS `person_types` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TYPE` varchar(100) NOT NULL,
  `IS_ACTIVE` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `person_types`
--

INSERT INTO `person_types` (`ID`, `TYPE`, `IS_ACTIVE`) VALUES
(1, 'ADMIN', 1),
(2, 'USER', 1);

-- --------------------------------------------------------

--
-- Table structure for table `privileges`
--

DROP TABLE IF EXISTS `privileges`;
CREATE TABLE IF NOT EXISTS `privileges` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `PRIVILEGE` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

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
(20, 'SHOW_CANCELLED_ORDER'),
(21, 'VIEW_LOGS'),
(25, 'UPDATE_PRODUCT_FEATURE'),
(26, 'DELETE_LOGS'),
(27, 'UPDATE_ROLE'),
(28, 'ADD_ROLE'),
(29, 'SHOW_NOTIFICATION'),
(30, 'UPDATE_SHIPPED_ORDER');

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
) ENGINE=InnoDB AUTO_INCREMENT=10156 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ID`, `SKU_ID`, `NAME`, `PRICE`, `CURRENCY_ID`, `DESCRIPTION`, `CATEGORY_ID`) VALUES
(10145, '#4KJ1LM9O', 'Gemstone Onyx', '9.99', 1, 'Handmade item, Bead Material: Gemstone, for him', 27),
(10146, '#6YI0FRLC', 'Swarovski pearls', '11.99', 1, 'hammered brass link chain, peach pink resin flower, Materials: brass leaf, for her', 27),
(10147, '#77IEQ2WE', 'CASIO G-SHOCK MT-G', '1503.49', 1, 'GPS HYBRID WAVE CEPTOR MTG-G1000SG-1AJF MENS JAPAN IMPORT, for him', 28),
(10148, '#8EP00VMC', 'Brushed Silver Mesh', '119.00', 1, 'for her', 28),
(10149, '#7ER9MNOW', 'LIVE SHOW GOLD EARRINGS LULUS', '12.19', 1, 'Take the Live Show Gold Earrings out for a night on the town! These unique antiqued gold earrings have swirling, engraved accents. Earrings measure 2\" long.', 29),
(10150, '#3RRIVN90', 'Metallic Silver Triangle Invisible', '21.88', 1, 'Dangle Geometric Clip Earrings, Non Pierced Earrings, Minimalist Clip-ons, Gift For Her', 29),
(10151, '#5RR9FKAN', 'Angel Wings Ring', '5.99', 1, 'Boho Rings, Angel Jewelry, Solid 925 Sterling Silver RIng, Christmas Gift for Women, Silver Rings, Custom Rings, Initials', 30),
(10152, '#EISN33OL', 'Rainbow Moonstone Ring', '8.99', 1, 'Boho Ring, Moon Ring, Gypsy Ring, Statement Rings, Solid 925 Sterling Silver Rings, Don Biu', 30),
(10153, '#VB6EOLAM', 'AURIFEROUS NEST RING', '4.99', 1, 'Three times around', 30),
(10154, '#QIO0REMA', 'Geometric marble pendant on gold chain', '14.49', 1, 'This would look so pretty layered with other necklaces. Drop is 16\" Colors available: white square, white rectangle, black rectangle, green rectangle', 31),
(10155, '#14FMQOAK', 'Gold & Iridescent Rhinestone Statement Necklace', '29.49', 1, 'Women\'s Statement Jewellery, handmade item', 32);

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
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products_images`
--

INSERT INTO `products_images` (`ID`, `PRODUCT_ID`, `IMAGE_PATH`) VALUES
(43, 10145, 'Assets/77d14787c43f17fc9b83bff1c0df472a.jpg'),
(44, 10146, 'Assets/e1b43693aac195ea04fd81da9c54c29c.jpg'),
(45, 10146, 'Assets/il_570xN.483022612_fmxe.jpg'),
(46, 10147, 'Assets/51cBsznlwJL.jpg'),
(47, 10148, 'Assets/joy_brushed_silver_mesjh.jpg'),
(48, 10150, 'Assets/il_570xN.1152836979_2avt.jpg'),
(49, 10151, 'Assets/il_570xN.1061071384_twd7.jpg'),
(50, 10152, 'Assets/8a4f86de23d2c6130781b21e064e9729.jpg'),
(51, 10152, 'Assets/il_570xN.697704988_sx3m.jpg'),
(52, 10153, 'Assets/6ead3e2d9b3876a54710ff2a05895bfa.jpg'),
(53, 10155, 'Assets/il_570xN.1300891573_5gnl.jpg');

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
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`ID`, `CATEGORY`, `IS_ACTIVE`) VALUES
(27, 'Bracelets', 1),
(28, 'Watches', 1),
(29, 'Earrings', 1),
(30, 'Rings', 1),
(31, 'Necklace', 1),
(32, 'Statements Necklaces', 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_features`
--

INSERT INTO `product_features` (`ID`, `FEATURE`, `DATA_TYPE_ID`, `IS_ACTIVE`) VALUES
(22, 'Stock', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_feature_values`
--

DROP TABLE IF EXISTS `product_feature_values`;
CREATE TABLE IF NOT EXISTS `product_feature_values` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `PRODUCT_ID` int(11) NOT NULL,
  `FEATURE_ID` int(11) NOT NULL,
  `VALUE` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `PRODUCT_ID` (`PRODUCT_ID`,`FEATURE_ID`),
  KEY `FEATURE_ID` (`FEATURE_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_feature_values`
--

INSERT INTO `product_feature_values` (`ID`, `PRODUCT_ID`, `FEATURE_ID`, `VALUE`) VALUES
(46, 10145, 22, NULL),
(47, 10146, 22, NULL),
(48, 10147, 22, NULL),
(49, 10148, 22, NULL),
(50, 10149, 22, NULL),
(51, 10150, 22, NULL),
(52, 10151, 22, NULL),
(53, 10152, 22, NULL),
(54, 10153, 22, NULL),
(55, 10154, 22, NULL),
(56, 10155, 22, NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_2` FOREIGN KEY (`PERSON_ID`) REFERENCES `persons` (`ID`),
  ADD CONSTRAINT `carts_ibfk_3` FOREIGN KEY (`CART_STATUS_ID`) REFERENCES `cart_status` (`ID`);

--
-- Constraints for table `cart_details`
--
ALTER TABLE `cart_details`
  ADD CONSTRAINT `cart_details_ibfk_1` FOREIGN KEY (`PRODUCT_ID`) REFERENCES `products` (`ID`),
  ADD CONSTRAINT `cart_details_ibfk_2` FOREIGN KEY (`CART_ID`) REFERENCES `carts` (`ID`);

--
-- Constraints for table `log_activities`
--
ALTER TABLE `log_activities`
  ADD CONSTRAINT `log_activities_ibfk_1` FOREIGN KEY (`PAGE_ID`) REFERENCES `pages` (`ID`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`PERSON_ID`) REFERENCES `persons` (`ID`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`ORDER_STATUS_ID`) REFERENCES `order_status` (`ID`),
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`PAYMENT_TYPE_ID`) REFERENCES `payment_types` (`ID`),
  ADD CONSTRAINT `orders_ibfk_4` FOREIGN KEY (`CART_ID`) REFERENCES `carts` (`ID`);

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
