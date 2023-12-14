-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 26, 2017 at 05:40 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tekvisoft-rismasys`
--

-- --------------------------------------------------------

--
-- Table structure for table `acl_resources`
--

DROP TABLE IF EXISTS `acl_resources`;
CREATE TABLE IF NOT EXISTS `acl_resources` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `type` enum('module','controller','action','other') NOT NULL DEFAULT 'other',
  `parent` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `parent` (`parent`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=53 ;

--
-- Dumping data for table `acl_resources`
--

INSERT INTO `acl_resources` (`id`, `name`, `type`, `parent`, `created`, `modified`) VALUES
(1, 'welcome', 'module', NULL, '2012-11-12 12:07:26', NULL),
(2, 'auth', 'module', NULL, '2012-11-12 04:00:23', NULL),
(3, 'auth/login', 'controller', 2, '2012-11-12 12:43:42', '2012-11-12 12:44:06'),
(4, 'auth/logout', 'controller', 2, '2012-11-12 12:43:56', NULL),
(5, 'auth/user', 'controller', 2, '2012-11-12 04:07:59', '2012-11-12 08:29:29'),
(6, 'acl', 'module', NULL, '2012-02-02 13:47:43', NULL),
(7, 'acl/resource', 'controller', 6, '2012-02-02 13:47:57', NULL),
(8, 'acl/resource/index', 'action', 7, '2012-02-02 13:48:21', NULL),
(9, 'acl/resource/add', 'action', 7, '2012-02-02 13:48:35', '2012-10-16 17:26:12'),
(10, 'acl/resource/edit', 'action', 7, '2012-02-02 13:48:50', '2012-07-09 18:44:38'),
(11, 'acl/resource/delete', 'action', 7, '2012-02-02 13:49:06', NULL),
(12, 'acl/role', 'controller', 6, '2012-07-12 17:54:16', NULL),
(13, 'acl/role/index', 'action', 12, '2012-07-12 17:55:29', NULL),
(14, 'acl/role/add', 'action', 12, '2012-07-12 17:56:00', NULL),
(15, 'acl/role/edit', 'action', 12, '2012-07-12 17:56:19', NULL),
(16, 'acl/role/delete', 'action', 12, '2012-07-12 17:56:55', NULL),
(17, 'acl/rule', 'controller', 6, '2012-07-12 17:53:04', NULL),
(18, 'acl/rule/edit', 'action', 17, '2012-07-12 17:53:25', NULL),
(19, 'auth/user/add', 'action', 5, '2017-08-15 15:43:06', NULL),
(20, 'auth/user/index', 'action', 5, '2017-08-15 15:43:39', NULL),
(21, 'auth/user/profile', 'action', 5, '2017-08-15 15:44:04', NULL),
(22, 'master', 'module', NULL, '2017-08-15 15:44:36', NULL),
(23, 'master/setting', 'controller', 22, '2017-08-15 15:45:13', NULL),
(24, 'master/setting/add', 'action', 23, '2017-08-15 15:45:42', NULL),
(25, 'master/setting/delete', 'action', 23, '2017-08-15 15:46:11', NULL),
(26, 'master/setting/edit', 'action', 23, '2017-08-15 15:46:35', NULL),
(27, 'master/setting/index', 'action', 23, '2017-08-15 15:46:59', NULL),
(28, 'master/status', 'controller', 22, '2017-08-15 15:49:24', NULL),
(29, 'master/status/add', 'action', 28, '2017-08-15 15:50:02', NULL),
(30, 'master/status/delete', 'action', 28, '2017-08-15 15:50:21', NULL),
(31, 'master/status/edit', 'action', 28, '2017-08-15 15:50:40', NULL),
(32, 'master/status/index', 'action', 28, '2017-08-15 15:50:58', NULL),
(33, 'master/unit', 'controller', 22, '2017-08-15 15:51:30', NULL),
(34, 'master/unit/add', 'action', 33, '2017-08-15 15:52:03', NULL),
(35, 'master/unit/delete', 'action', 33, '2017-08-15 15:52:20', NULL),
(36, 'master/unit/edit', 'action', 33, '2017-08-15 15:52:34', NULL),
(37, 'master/unit/index', 'action', 33, '2017-08-15 15:52:49', NULL),
(38, 'master/risk_category', 'controller', 22, '2017-09-18 23:25:43', NULL),
(39, 'master/risk_category/add', 'action', 38, '2017-09-18 23:26:45', NULL),
(40, 'master/risk_category/delete', 'action', 38, '2017-09-18 23:27:13', NULL),
(41, 'master/risk_category/edit', 'action', 38, '2017-09-18 23:27:32', NULL),
(42, 'master/risk_category/index', 'action', 38, '2017-09-18 23:27:56', NULL),
(43, 'master/risk', 'controller', 22, '2017-09-18 23:28:18', '2017-09-25 14:26:28'),
(44, 'master/risk/add', 'action', 43, '2017-09-18 23:28:42', '2017-09-25 14:26:52'),
(45, 'master/risk/delete', 'action', 43, '2017-09-18 23:29:13', '2017-09-25 14:27:05'),
(46, 'master/risk/edit', 'action', 43, '2017-09-18 23:29:27', '2017-09-25 14:27:17'),
(47, 'master/risk/index', 'action', 43, '2017-09-18 23:29:42', '2017-09-25 14:27:30'),
(48, 'master/risk_item', 'controller', 22, '2017-09-25 14:28:25', NULL),
(49, 'master/risk_item/add', 'action', 48, '2017-09-25 14:29:16', NULL),
(50, 'master/risk_item/delete', 'action', 48, '2017-09-25 14:29:33', NULL),
(51, 'master/risk_item/edit', 'action', 48, '2017-09-25 14:29:47', NULL),
(52, 'master/risk_item/index', 'action', 48, '2017-09-25 14:30:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `acl_roles`
--

DROP TABLE IF EXISTS `acl_roles`;
CREATE TABLE IF NOT EXISTS `acl_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=26 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `acl_roles`
--

INSERT INTO `acl_roles` (`id`, `name`, `created`, `modified`) VALUES
(1, 'Administrator', '2011-12-27 12:00:00', NULL),
(2, 'Guest', '2011-12-27 12:00:00', NULL),
(3, 'Staf', '2012-11-12 04:30:02', '2012-11-12 04:30:39'),
(4, 'Manager', '2012-11-12 04:30:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `acl_role_parents`
--

DROP TABLE IF EXISTS `acl_role_parents`;
CREATE TABLE IF NOT EXISTS `acl_role_parents` (
  `role_id` int(11) NOT NULL,
  `parent` int(11) NOT NULL,
  `order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`role_id`,`parent`),
  KEY `parent` (`parent`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `acl_role_parents`
--

INSERT INTO `acl_role_parents` (`role_id`, `parent`, `order`) VALUES
(3, 2, 0),
(4, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `acl_rules`
--

DROP TABLE IF EXISTS `acl_rules`;
CREATE TABLE IF NOT EXISTS `acl_rules` (
  `role_id` int(11) NOT NULL,
  `resource_id` int(11) NOT NULL,
  `access` enum('allow','deny') NOT NULL DEFAULT 'deny',
  `priviledge` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`role_id`,`resource_id`),
  KEY `resource_id` (`resource_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `acl_rules`
--

INSERT INTO `acl_rules` (`role_id`, `resource_id`, `access`, `priviledge`) VALUES
(2, 1, 'allow', NULL),
(2, 3, 'allow', NULL),
(2, 4, 'allow', NULL),
(4, 2, 'allow', NULL),
(4, 5, 'allow', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `auth_autologin`
--

DROP TABLE IF EXISTS `auth_autologin`;
CREATE TABLE IF NOT EXISTS `auth_autologin` (
  `user` int(11) NOT NULL,
  `series` varchar(255) NOT NULL,
  `key` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`user`,`series`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_autologin`
--


-- --------------------------------------------------------

--
-- Table structure for table `auth_users`
--

DROP TABLE IF EXISTS `auth_users`;
CREATE TABLE IF NOT EXISTS `auth_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `lang` varchar(2) DEFAULT NULL,
  `registered` datetime NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `expired` datetime NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_date` datetime NOT NULL,
  `photo` varchar(250) DEFAULT NULL,
  `unit_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1707 ;

--
-- Dumping data for table `auth_users`
--

INSERT INTO `auth_users` (`id`, `first_name`, `last_name`, `username`, `email`, `password`, `lang`, `registered`, `role_id`, `expired`, `status`, `created_by`, `created_date`, `updated_by`, `updated_date`, `photo`, `unit_id`) VALUES
(1, 'Administrator', 'Tea', 'admin', 'admin@tekvisoft.com', '$2a$08$8S0q0D70mS4lJ3Rp33eEK.Sxbifh6tooNU0r67E23uof6UjHBhb6G', 'en', '2012-03-15 19:23:59', 1, '2039-07-01 00:00:00', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '', 1),
(1703, 'Ardi', 'Soebrata', 'ardissoebrata', 'ardissoebrata@gmail.com', '$2a$08$KZRME/RCMM.ikhJvS9IQtOD/qQcM/922akreUjQ7fgL6BanTAwsIm', 'en', '2012-03-09 12:57:48', 4, '0000-00-00 00:00:00', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '', 0),
(1706, 'Test', 'TestLast', 'test', 'test@test.com', 'test', 'en', '2012-11-09 10:58:34', 2, '0000-00-00 00:00:00', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `auth_users_master`
--

DROP TABLE IF EXISTS `auth_users_master`;
CREATE TABLE IF NOT EXISTS `auth_users_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `registered` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1703 ;

--
-- Dumping data for table `auth_users_master`
--

INSERT INTO `auth_users_master` (`id`, `first_name`, `last_name`, `username`, `email`, `password`, `registered`) VALUES
(1002, 'Diane', 'Murphy', 'dmurphy', 'dmurphy@classicmodelcars.com', '', '2012-03-01 05:54:30'),
(1056, 'Mary', 'Patterson', 'mpatterso', 'mpatterso@classicmodelcars.com', '', '2012-03-01 05:54:30'),
(1076, 'Jeff', 'Firrelli', 'jeff.firrelli', 'jeff.firrelli@classicmodelcars.com', '', '2012-03-01 05:54:30'),
(1088, 'William', 'Patterson', 'wpatterson', 'wpatterson@classicmodelcars.com', '', '2012-03-01 05:54:30'),
(1102, 'Gerard', 'Bondur', 'gbondur', 'gbondur@classicmodelcars.com', '', '2012-03-01 05:54:30'),
(1143, 'Anthony', 'Bow', 'abow', 'abow@classicmodelcars.com', '', '2012-03-01 05:54:30'),
(1165, 'Leslie', 'Jennings', 'ljennings', 'ljennings@classicmodelcars.com', '', '2012-03-01 05:54:30'),
(1166, 'Leslie', 'Thompson', 'lthompson', 'lthompson@classicmodelcars.com', '', '2012-03-01 05:54:30'),
(1188, 'Julie', 'Firrelli', 'julie.firrelli', 'julie.firrelli@classicmodelcars.com', '', '2012-03-01 05:54:30'),
(1216, 'Steve', 'Patterson', 'spatterson', 'spatterson@classicmodelcars.com', '', '2012-03-01 05:54:30'),
(1286, 'Foon Yue', 'Tseng', 'ftseng', 'ftseng@classicmodelcars.com', '', '2012-03-01 05:54:30'),
(1323, 'George', 'Vanauf', 'gvanauf', 'gvanauf@classicmodelcars.com', '', '2012-03-01 05:54:30'),
(1337, 'Loui', 'Bondur', 'lbondur', 'lbondur@classicmodelcars.com', '', '2012-03-01 05:54:30'),
(1370, 'Gerard', 'Hernandez', 'ghernande', 'ghernande@classicmodelcars.com', '', '2012-03-01 05:54:30'),
(1401, 'Pamela', 'Castillo', 'pcastillo', 'pcastillo@classicmodelcars.com', '', '2012-03-01 05:54:30'),
(1501, 'Larry', 'Bott', 'lbott', 'lbott@classicmodelcars.com', '', '2012-03-01 05:54:30'),
(1504, 'Barry', 'Jones', 'bjones', 'bjones@classicmodelcars.com', '', '2012-03-01 05:54:30'),
(1611, 'Andy', 'Fixter', 'afixter', 'afixter@classicmodelcars.com', '', '2012-03-01 05:54:30'),
(1612, 'Peter', 'Marsh', 'pmarsh', 'pmarsh@classicmodelcars.com', '', '2012-03-01 05:54:30'),
(1619, 'Tom', 'King', 'tking', 'tking@classicmodelcars.com', '', '2012-03-01 05:54:30'),
(1621, 'Mami', 'Nishi', 'mnishi', 'mnishi@classicmodelcars.com', '', '2012-03-01 05:54:30'),
(1625, 'Yoshimi', 'Kato', 'ykato', 'ykato@classicmodelcars.com', '', '2012-03-01 05:54:30'),
(1702, 'Martin', 'Gerard', 'mgerard', 'mgerard@classicmodelcars.com', '', '2012-03-01 05:54:30');

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('0b51c5be7ead7d11294b603d3971a656', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:55.0) Gecko/20100101 Firefox/55.0', 1506413146, 'a:9:{s:9:"user_data";s:0:"";s:9:"role_name";s:13:"Administrator";s:9:"auth_user";s:1:"1";s:13:"auth_loggedin";b:1;s:4:"lang";s:2:"en";s:7:"unit_id";s:1:"1";s:7:"role_id";s:1:"1";s:10:"registered";s:19:"2012-03-15 19:23:59";s:7:"expired";s:19:"2039-07-01 00:00:00";}'),
('35bf560cc3efe204882603d0a4273c04', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:55.0) Gecko/20100101 Firefox/55.0', 1506412298, 'a:9:{s:9:"user_data";s:0:"";s:9:"role_name";s:13:"Administrator";s:9:"auth_user";s:1:"1";s:13:"auth_loggedin";b:1;s:4:"lang";s:2:"en";s:7:"unit_id";s:1:"1";s:7:"role_id";s:1:"1";s:10:"registered";s:19:"2012-03-15 19:23:59";s:7:"expired";s:19:"2039-07-01 00:00:00";}'),
('475df9086ca64c3420114cb47a191bed', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:55.0) Gecko/20100101 Firefox/55.0', 1506413453, 'a:9:{s:9:"user_data";s:0:"";s:9:"role_name";s:13:"Administrator";s:9:"auth_user";s:1:"1";s:13:"auth_loggedin";b:1;s:4:"lang";s:2:"en";s:7:"unit_id";s:1:"1";s:7:"role_id";s:1:"1";s:10:"registered";s:19:"2012-03-15 19:23:59";s:7:"expired";s:19:"2039-07-01 00:00:00";}'),
('a1b836acfad0b01fc236c541aa1212ad', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:55.0) Gecko/20100101 Firefox/55.0', 1506414280, 'a:9:{s:9:"user_data";s:0:"";s:9:"role_name";s:13:"Administrator";s:9:"auth_user";s:1:"1";s:13:"auth_loggedin";b:1;s:4:"lang";s:2:"en";s:7:"unit_id";s:1:"1";s:7:"role_id";s:1:"1";s:10:"registered";s:19:"2012-03-15 19:23:59";s:7:"expired";s:19:"2039-07-01 00:00:00";}'),
('f570ea8b313b0fbe3534c024c5541121', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:55.0) Gecko/20100101 Firefox/55.0', 1506414281, 'a:9:{s:9:"user_data";s:0:"";s:9:"role_name";s:13:"Administrator";s:9:"auth_user";s:1:"1";s:13:"auth_loggedin";b:1;s:4:"lang";s:2:"en";s:7:"unit_id";s:1:"1";s:7:"role_id";s:1:"1";s:10:"registered";s:19:"2012-03-15 19:23:59";s:7:"expired";s:19:"2039-07-01 00:00:00";}'),
('f9c7758f7c8939ac0037f5939c98fee2', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:55.0) Gecko/20100101 Firefox/55.0', 1506412777, 'a:9:{s:9:"user_data";s:0:"";s:9:"role_name";s:13:"Administrator";s:9:"auth_user";s:1:"1";s:13:"auth_loggedin";b:1;s:4:"lang";s:2:"en";s:7:"unit_id";s:1:"1";s:7:"role_id";s:1:"1";s:10:"registered";s:19:"2012-03-15 19:23:59";s:7:"expired";s:19:"2039-07-01 00:00:00";}');

-- --------------------------------------------------------

--
-- Table structure for table `mst_risks`
--

DROP TABLE IF EXISTS `mst_risks`;
CREATE TABLE IF NOT EXISTS `mst_risks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL,
  `name_alias` varchar(250) DEFAULT NULL,
  `description` text,
  `risk_category_id` int(10) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '1',
  `unit_id` int(10) DEFAULT NULL,
  `created_by` int(20) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` int(20) NOT NULL,
  `updated_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `mst_risks`
--

INSERT INTO `mst_risks` (`id`, `code`, `name`, `name_alias`, `description`, `risk_category_id`, `status`, `unit_id`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, '001/RISK/09/2017', 'Strategic Risk', 'SR', '-', 2, 1, 1, 1, '2017-09-25 06:26:20', 1, '2017-09-25 06:31:25');

-- --------------------------------------------------------

--
-- Table structure for table `mst_risk_categories`
--

DROP TABLE IF EXISTS `mst_risk_categories`;
CREATE TABLE IF NOT EXISTS `mst_risk_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL,
  `description` text,
  `status` int(2) NOT NULL DEFAULT '1',
  `unit_id` int(10) DEFAULT NULL,
  `created_by` int(20) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` int(20) NOT NULL,
  `updated_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `mst_risk_categories`
--

INSERT INTO `mst_risk_categories` (`id`, `code`, `name`, `description`, `status`, `unit_id`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, '001/RC/09/2017', 'OPSTEK', 'Operasi &amp; Teknik', 1, 1, 1, '2017-09-25 03:19:23', 1, '2017-09-25 03:20:51'),
(2, '002/RC/09/2017', 'ADKOM', 'Administration &amp; Commercial', 1, 1, 1, '2017-09-25 03:20:34', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `mst_risk_items`
--

DROP TABLE IF EXISTS `mst_risk_items`;
CREATE TABLE IF NOT EXISTS `mst_risk_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL,
  `description` text,
  `risk_id` int(10) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '1',
  `unit_id` int(10) DEFAULT NULL,
  `created_by` int(20) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` int(20) NOT NULL,
  `updated_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `mst_risk_items`
--

INSERT INTO `mst_risk_items` (`id`, `code`, `name`, `description`, `risk_id`, `status`, `unit_id`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, '001/RC/09/2017', 'Risiko terhambatnya pengembangan bandar udara', '-', 1, 1, 1, 1, '2017-09-25 06:34:09', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `mst_settings`
--

DROP TABLE IF EXISTS `mst_settings`;
CREATE TABLE IF NOT EXISTS `mst_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `name` varchar(250) CHARACTER SET latin1 DEFAULT NULL,
  `address` varchar(250) CHARACTER SET latin1 DEFAULT NULL,
  `village` varchar(150) CHARACTER SET latin1 DEFAULT NULL,
  `district` varchar(150) CHARACTER SET latin1 DEFAULT NULL,
  `city` varchar(150) CHARACTER SET latin1 DEFAULT NULL,
  `province` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `country` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `phone` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `fax` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `mobile_phone` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `email` varchar(150) CHARACTER SET latin1 DEFAULT NULL,
  `website` varchar(150) CHARACTER SET latin1 DEFAULT NULL,
  `owner` varchar(150) CHARACTER SET latin1 DEFAULT NULL,
  `photo` varchar(250) CHARACTER SET latin1 DEFAULT NULL,
  `description` text CHARACTER SET latin1,
  `status` int(2) NOT NULL DEFAULT '1',
  `unit_id` int(10) DEFAULT NULL,
  `created_by` int(20) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` int(20) NOT NULL,
  `updated_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `mst_settings`
--

INSERT INTO `mst_settings` (`id`, `code`, `name`, `address`, `village`, `district`, `city`, `province`, `country`, `phone`, `fax`, `mobile_phone`, `email`, `website`, `owner`, `photo`, `description`, `status`, `unit_id`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, '001/SET/08/2017', 'TEKVISOFT', 'Komp. Ujungberung Indah Blok 19-9', 'Cigending', 'Ujungberung', 'Bandung', 'Jawa Barat', 'Indonesia', '022-7805295', '022-7805295', '085659001233', 'info@tekvisoft.com', 'www.tekvisoft.com', 'Wildan Sawaludin', NULL, 'www.tekvisoft.com', 1, 1, 1, '2017-08-15 04:17:44', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `mst_status`
--

DROP TABLE IF EXISTS `mst_status`;
CREATE TABLE IF NOT EXISTS `mst_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `name` varchar(250) CHARACTER SET latin1 DEFAULT NULL,
  `description` text CHARACTER SET latin1,
  `status` int(2) NOT NULL DEFAULT '1',
  `unit_id` int(10) DEFAULT NULL,
  `created_by` int(20) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` int(20) NOT NULL,
  `updated_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `mst_status`
--

INSERT INTO `mst_status` (`id`, `code`, `name`, `description`, `status`, `unit_id`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, '001/STATUS/10/2015', 'Aktif', 'Status Aktif', 1, 1, 1, '2017-08-15 15:06:24', 1, '2017-08-15 15:06:34'),
(2, '002/STATUS/10/2015', 'Non Aktif', 'Status Non Aktif', 1, 1, 1, '2017-08-15 15:07:28', 1, '2017-08-15 15:07:33');

-- --------------------------------------------------------

--
-- Table structure for table `mst_units`
--

DROP TABLE IF EXISTS `mst_units`;
CREATE TABLE IF NOT EXISTS `mst_units` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `village` varchar(150) DEFAULT NULL,
  `district` varchar(150) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `province` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `fax` varchar(50) DEFAULT NULL,
  `mobile_phone` varchar(50) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `description` text NOT NULL,
  `status` int(2) DEFAULT '1',
  `unit_id` int(10) DEFAULT NULL,
  `created_by` int(20) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` int(20) NOT NULL,
  `updated_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `mst_units`
--

INSERT INTO `mst_units` (`id`, `code`, `name`, `address`, `village`, `district`, `city`, `province`, `country`, `phone`, `fax`, `mobile_phone`, `email`, `description`, `status`, `unit_id`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(1, '001/UNIT/10/2015', 'ANGKASA PURA II', 'Komp. Ujungberung Indah Blok 19-9', 'Cigending', 'Ujungberung', 'Bandung', 'Jawa Barat', 'Indonesia', '022-7805295', '022-7805295', '085659001233', 'info@tekvisoft.com', 'www.tekvisoft.com', 1, 1, 1, '2017-08-15 15:02:56', 1, '2017-09-25 03:21:43');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `acl_role_parents`
--
ALTER TABLE `acl_role_parents`
  ADD CONSTRAINT `acl_role_parents_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `acl_roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `acl_role_parents_ibfk_2` FOREIGN KEY (`parent`) REFERENCES `acl_roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `acl_rules`
--
ALTER TABLE `acl_rules`
  ADD CONSTRAINT `acl_rules_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `acl_roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `acl_rules_ibfk_2` FOREIGN KEY (`resource_id`) REFERENCES `acl_resources` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_users`
--
ALTER TABLE `auth_users`
  ADD CONSTRAINT `auth_users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `acl_roles` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
