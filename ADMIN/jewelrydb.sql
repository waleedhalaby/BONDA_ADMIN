-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 11, 2017 at 10:40 PM
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
-- Table structure for table `about_us`
--

DROP TABLE IF EXISTS `about_us`;
CREATE TABLE IF NOT EXISTS `about_us` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `PARAGRAPH` varchar(10000) DEFAULT NULL,
  `IMAGE_PATH` varchar(2222) DEFAULT NULL,
  `OWNER_NAME` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `about_us`
--

INSERT INTO `about_us` (`ID`, `PARAGRAPH`, `IMAGE_PATH`, `OWNER_NAME`) VALUES
(1, NULL, 'Assets/Contact/e2.jpg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `banner_images`
--

DROP TABLE IF EXISTS `banner_images`;
CREATE TABLE IF NOT EXISTS `banner_images` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `IMAGE_PATH` varchar(2222) DEFAULT NULL,
  `TITLE` varchar(200) DEFAULT NULL,
  `DESCRIPTION` varchar(2222) DEFAULT NULL,
  `LINK` varchar(2222) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

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
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `IMAGE_PATH` varchar(255) DEFAULT NULL,
  `CATEGORY` varchar(200) NOT NULL,
  `DESCRIPTION` varchar(255) DEFAULT NULL,
  `DESIGNER_ID` int(11) NOT NULL,
  `IS_ACTIVE` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `DESIGNER_ID` (`DESIGNER_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=1010101 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category_features`
--

DROP TABLE IF EXISTS `category_features`;
CREATE TABLE IF NOT EXISTS `category_features` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `FEATURE` varchar(255) NOT NULL,
  `DATA_TYPE_ID` int(11) NOT NULL,
  `IS_ACTIVE` tinyint(1) NOT NULL,
  `IS_VISIBLE` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `DATA_TYPE_ID` (`DATA_TYPE_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category_features`
--

INSERT INTO `category_features` (`ID`, `FEATURE`, `DATA_TYPE_ID`, `IS_ACTIVE`, `IS_VISIBLE`) VALUES
(1, 'Likes', 3, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `category_feature_values`
--

DROP TABLE IF EXISTS `category_feature_values`;
CREATE TABLE IF NOT EXISTS `category_feature_values` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `FEATURE_ID` int(11) NOT NULL,
  `CATEGORY_ID` int(11) NOT NULL,
  `VALUE` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `FEATURE_ID` (`FEATURE_ID`),
  KEY `CATEGORY_ID` (`CATEGORY_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contact_info`
--

DROP TABLE IF EXISTS `contact_info`;
CREATE TABLE IF NOT EXISTS `contact_info` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `IMAGE_PATH` varchar(2222) DEFAULT NULL,
  `LOCATION` varchar(2222) DEFAULT NULL,
  `TELEPHONE1` varchar(200) DEFAULT NULL,
  `TELEPHONE2` varchar(200) DEFAULT NULL,
  `EMAIL` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact_info`
--

INSERT INTO `contact_info` (`ID`, `IMAGE_PATH`, `LOCATION`, `TELEPHONE1`, `TELEPHONE2`, `EMAIL`) VALUES
(1, NULL, NULL, NULL, NULL, NULL);

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
-- Table structure for table `designers`
--

DROP TABLE IF EXISTS `designers`;
CREATE TABLE IF NOT EXISTS `designers` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `IMAGE_PATH` varchar(250) DEFAULT NULL,
  `DESIGNER` varchar(255) NOT NULL,
  `IS_ACTIVE` tinyint(1) NOT NULL,
  `DESCRIPTION` varchar(2222) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=101010 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `designer_features`
--

DROP TABLE IF EXISTS `designer_features`;
CREATE TABLE IF NOT EXISTS `designer_features` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `DATA_TYPE_ID` int(11) NOT NULL,
  `FEATURE` varchar(200) NOT NULL,
  `IS_ACTIVE` tinyint(1) NOT NULL,
  `IS_VISIBLE` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `DATA_TYPE_ID` (`DATA_TYPE_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `designer_features`
--

INSERT INTO `designer_features` (`ID`, `DATA_TYPE_ID`, `FEATURE`, `IS_ACTIVE`, `IS_VISIBLE`) VALUES
(1, 3, 'Likes', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `designer_feature_values`
--

DROP TABLE IF EXISTS `designer_feature_values`;
CREATE TABLE IF NOT EXISTS `designer_feature_values` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `DESIGNER_ID` int(11) NOT NULL,
  `FEATURE_ID` int(11) NOT NULL,
  `VALUE` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `DESIGNER_ID` (`DESIGNER_ID`),
  KEY `FEATURE_ID` (`FEATURE_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `TOTAL` decimal(10,2) DEFAULT NULL,
  `ORDER_STATUS_ID` int(11) NOT NULL,
  `PAYMENT_TYPE_ID` int(11) NOT NULL,
  `CART_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `PERSON_ID` (`PERSON_ID`,`ORDER_STATUS_ID`,`PAYMENT_TYPE_ID`),
  KEY `ORDER_STATUS_ID` (`ORDER_STATUS_ID`),
  KEY `PAYMENT_TYPE_ID` (`PAYMENT_TYPE_ID`),
  KEY `CART_ID` (`CART_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

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
  `LAST_VISITED` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`ID`, `TITLE`, `LINK`, `ICON`, `PARENT`, `IS_VISIBLE`, `LAST_VISITED`) VALUES
(1, 'Dashboard', 'Pages/Dashboard.php', 'icon-dashboard', 0, 1, 1),
(2, 'Pages Portal', '#', 'icon-file', 0, 1, 0),
(3, 'Products Portal', '#', 'icon-star', 0, 1, 0),
(4, 'Orders Portal', '#', 'icon-book', 0, 1, 0),
(5, 'Administration', '#', 'icon-lock', 0, 0, 0),
(6, 'Members', 'Pages/Admins.php', 'icon-user', 5, 1, 0),
(7, 'Members Privileges', 'Pages/AdminsPrivileges.php', 'icon-eye-open', 5, 1, 0),
(9, 'Products', 'Pages/Products.php', 'icon-gift', 3, 1, 0),
(10, 'Collections', 'Pages/Categories.php', 'icon-tasks', 3, 1, 0),
(11, 'Product Features', 'Pages/ProductFeatures.php', 'icon-briefcase', 3, 0, 0),
(12, 'Pending Orders', 'Pages/PendingOrders.php', 'icon-envelope', 4, 1, 0),
(13, 'Queued Orders', 'Pages/QueuedOrders.php', 'icon-envelope-alt', 4, 1, 0),
(14, 'Shipped Orders', 'Pages/ShippedOrders.php', 'icon-truck', 4, 1, 0),
(15, 'Delivered Orders', 'Pages/DeliveredOrders.php', 'icon-shopping-cart', 4, 1, 0),
(16, 'Log Activities', 'Pages/LogActivities.php', 'icon-user', 0, 1, 0),
(17, 'Cancelled Orders', 'Pages/CancelledOrders.php', 'icon-ban-circle', 4, 1, 0),
(18, 'Member Roles', 'Pages/MemberRoles.php', 'icon-sitemap', 5, 1, 0),
(19, 'Search Orders', 'Pages/SearchOrders.php', 'icon-search', 4, 1, 0),
(20, 'Designers', 'Pages/Designers.php', 'icon-magic', 3, 1, 0),
(21, 'Banners', 'Pages/Banner.php', 'icon-picture', 2, 1, 0),
(22, 'About', 'Pages/About.php', 'icon-question-sign', 2, 1, 0),
(23, 'Contact', 'Pages/Contact.php', 'icon-exclamation-sign', 2, 1, 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=111162 DEFAULT CHARSET=latin1;

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
  `IS_ACTIVE` tinyint(1) NOT NULL,
  `IS_VISIBLE` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `PERSON_TYPE_ID` (`PERSON_TYPE_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `person_features`
--

INSERT INTO `person_features` (`ID`, `FEATURE`, `PERSON_TYPE_ID`, `IS_ACTIVE`, `IS_VISIBLE`) VALUES
(2, 'STATUS', 1, 0, 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `person_feature_values`
--

INSERT INTO `person_feature_values` (`ID`, `PERSON_ID`, `PERSON_FEATURE_ID`, `VALUE`) VALUES
(6, 111111, 2, 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `person_messages`
--

DROP TABLE IF EXISTS `person_messages`;
CREATE TABLE IF NOT EXISTS `person_messages` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `FROM_PERSON_ID` int(11) NOT NULL,
  `TO_PERSON_ID` int(11) NOT NULL,
  `TITLE` varchar(255) NOT NULL,
  `DESCRIPTION` varchar(1000) NOT NULL,
  `IS_SEEN` tinyint(1) NOT NULL,
  `MESSAGE_DATE_TIME` datetime NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `FROM_PERSON_ID` (`FROM_PERSON_ID`),
  KEY `TO_PERSON_ID` (`TO_PERSON_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=126 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `person_privileges`
--

INSERT INTO `person_privileges` (`ID`, `PRIVILEGE_ID`, `PERSON_ID`, `VALUE`) VALUES
(1, 34, 111111, 1),
(2, 35, 111111, 1),
(3, 36, 111111, 1),
(4, 37, 111111, 1),
(5, 40, 111111, 1),
(6, 41, 111111, 1),
(7, 42, 111111, 1),
(8, 43, 111111, 1),
(9, 44, 111111, 1),
(10, 46, 111111, 1),
(11, 47, 111111, 1),
(12, 48, 111111, 1),
(13, 49, 111111, 1),
(14, 50, 111111, 1),
(15, 51, 111111, 1),
(16, 52, 111111, 1),
(17, 53, 111111, 1),
(18, 54, 111111, 1),
(19, 55, 111111, 0),
(20, 56, 111111, 0),
(21, 57, 111111, 0),
(22, 58, 111111, 1),
(23, 59, 111111, 1),
(24, 60, 111111, 1),
(25, 61, 111111, 1),
(26, 62, 111111, 1),
(27, 63, 111111, 1),
(28, 64, 111111, 1),
(29, 32, 111111, 0),
(30, 33, 111111, 0),
(31, 38, 111111, 1),
(32, 39, 111111, 1),
(33, 45, 111111, 0),
(34, 65, 111111, 1),
(35, 66, 111111, 1),
(71, 67, 111111, 1),
(72, 68, 111111, 1),
(73, 69, 111111, 1),
(74, 70, 111111, 1),
(75, 71, 111111, 1),
(76, 73, 111111, 1),
(77, 74, 111111, 1),
(78, 75, 111111, 1),
(79, 76, 111111, 1),
(124, 77, 111111, 1),
(125, 78, 111111, 1);

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
  `CATEGORY_ID` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `privileges`
--

INSERT INTO `privileges` (`ID`, `PRIVILEGE`, `CATEGORY_ID`) VALUES
(32, 'SHOW_NOTIFICATIONS', 600),
(33, 'SHOW_MESSAGES', 700),
(34, 'SHOW_PRODUCTS', 3),
(35, 'ADD_PRODUCT', 3),
(36, 'EDIT_PRODUCTS', 3),
(37, 'DELETE_PRODUCTS', 3),
(38, 'SHOW_PRODUCTS_PORTAL', 300),
(39, 'SHOW_ORDERS_PORTAL', 400),
(40, 'SHOW_PENDING_ORDERS', 4),
(41, 'SHOW_QUEUED_ORDERS', 4),
(42, 'SHOW_SHIPPED_ORDERS', 4),
(43, 'SHOW_DELIVERED_ORDERS', 4),
(44, 'SHOW_CANCELLED_ORDERS', 4),
(45, 'SHOW_ADMINISTRATIONS', 500),
(46, 'SHOW_MEMBERS', 5),
(47, 'SHOW_MEMBERS_PRIVILEGES', 5),
(48, 'ADD_MEMBER', 5),
(49, 'EDIT_MEMBERS', 5),
(50, 'DELETE_MEMBERS', 5),
(51, 'SHOW_CATEGORIES', 3),
(52, 'ADD_CATEGORY', 3),
(53, 'UPDATE_CATEGORY', 3),
(54, 'DELETE_CATEGORY', 3),
(55, 'SHOW_PRODUCTS_FEATURES', 6),
(56, 'ADD_PRODUCT_FEATURE', 6),
(57, 'UPDATE_PRODUCT_FEATURES', 6),
(58, 'SHOW_LOG_ACTIVITIES', 7),
(59, 'DELETE_LOG_ACTIVITIES', 7),
(60, 'ADD_MEMBER_PRIVILEGES', 5),
(61, 'EDIT_CATEGORY', 3),
(62, 'SHOW_ROLES', 5),
(63, 'ADD_ROLE', 5),
(64, 'UPDATE_ROLES', 5),
(65, 'SHOW_PAGES_PORTAL', 200),
(66, 'SHOW_DASHBOARD', 100),
(67, 'SHOW_DESIGNERS', 3),
(68, 'ADD_DESIGNER', 3),
(69, 'DELETE_DESIGNER', 3),
(70, 'EDIT_DESIGNER', 3),
(71, 'UPDATE_DESIGNER', 3),
(73, 'SHOW_BANNER', 8),
(74, 'ADD_BANNER', 8),
(75, 'EDIT_BANNER', 8),
(76, 'DELETE_BANNER', 8),
(77, 'SHOW_ABOUT', 8),
(78, 'SHOW_CONTACT', 8);

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
  `DESIGNER_ID` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `CATEGORY_ID` (`CATEGORY_ID`),
  KEY `CURRENCY_ID` (`CURRENCY_ID`),
  KEY `DESIGNER_ID` (`DESIGNER_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=10187 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=latin1;

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
  `IS_VISIBLE` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `DATA_TYPE_ID` (`DATA_TYPE_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_features`
--

INSERT INTO `product_features` (`ID`, `FEATURE`, `DATA_TYPE_ID`, `IS_ACTIVE`, `IS_VISIBLE`) VALUES
(22, 'Stock', 3, 1, 1),
(23, 'Date_Added', 2, 1, 0),
(25, 'Likes', 3, 1, 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=130 DEFAULT CHARSET=latin1;

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
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`DESIGNER_ID`) REFERENCES `designers` (`ID`);

--
-- Constraints for table `category_features`
--
ALTER TABLE `category_features`
  ADD CONSTRAINT `category_features_ibfk_1` FOREIGN KEY (`DATA_TYPE_ID`) REFERENCES `data_types` (`ID`);

--
-- Constraints for table `category_feature_values`
--
ALTER TABLE `category_feature_values`
  ADD CONSTRAINT `category_feature_values_ibfk_1` FOREIGN KEY (`CATEGORY_ID`) REFERENCES `categories` (`ID`),
  ADD CONSTRAINT `category_feature_values_ibfk_2` FOREIGN KEY (`FEATURE_ID`) REFERENCES `category_features` (`ID`);

--
-- Constraints for table `designer_features`
--
ALTER TABLE `designer_features`
  ADD CONSTRAINT `designer_features_ibfk_1` FOREIGN KEY (`DATA_TYPE_ID`) REFERENCES `data_types` (`ID`);

--
-- Constraints for table `designer_feature_values`
--
ALTER TABLE `designer_feature_values`
  ADD CONSTRAINT `designer_feature_values_ibfk_1` FOREIGN KEY (`DESIGNER_ID`) REFERENCES `designers` (`ID`),
  ADD CONSTRAINT `designer_feature_values_ibfk_2` FOREIGN KEY (`FEATURE_ID`) REFERENCES `designer_features` (`ID`);

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
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`CATEGORY_ID`) REFERENCES `categories` (`ID`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`CURRENCY_ID`) REFERENCES `currencies` (`ID`),
  ADD CONSTRAINT `products_ibfk_3` FOREIGN KEY (`DESIGNER_ID`) REFERENCES `designers` (`ID`);

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
