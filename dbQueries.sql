-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 23, 2016 at 01:20 PM
-- Server version: 5.5.40-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ksec_sq_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `acl_modules`
--

CREATE TABLE IF NOT EXISTS `acl_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module` varchar(50) NOT NULL,
  `task` varchar(100) DEFAULT NULL,
  `controller` varchar(100) NOT NULL,
  `action` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `module_2` (`module`,`task`,`controller`,`action`),
  KEY `module` (`module`),
  KEY `task` (`task`),
  KEY `controller` (`controller`),
  KEY `action` (`action`),
  KEY `created_at` (`created_at`),
  KEY `deleted_at` (`deleted_at`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=185 ;

--
-- Dumping data for table `acl_modules`
--

INSERT INTO `acl_modules` (`id`, `module`, `task`, `controller`, `action`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'shape', 'add', 'shapes', 'create', '2015-12-26 23:26:53', '2015-12-26 23:26:53', NULL),
(2, 'shape', 'add', 'shapes', 'store', '2015-12-26 23:29:21', '2015-12-26 23:29:21', NULL),
(3, 'shape', 'edit', 'shapes', 'edit', '2015-12-26 23:29:21', '2015-12-26 23:29:21', NULL),
(4, 'shape', 'edit', 'shapes', 'update', '2015-12-26 23:29:21', '2015-12-26 23:29:21', NULL),
(5, 'shape', 'delete', 'shapes', 'destory', '2015-12-26 23:29:21', '2015-12-26 23:29:21', NULL),
(6, 'shape', 'view', 'shapes', 'index', '2015-12-26 23:29:21', '2015-12-26 23:29:21', NULL),
(7, 'color', 'add', 'color', 'create', '2015-12-26 23:53:25', '2015-12-26 23:53:25', NULL),
(8, 'color', 'add', 'color', 'store', '2015-12-26 23:54:44', '2015-12-26 23:54:44', NULL),
(9, 'color', 'edit', 'color', 'edit', '2015-12-26 23:54:44', '2015-12-26 23:54:44', NULL),
(10, 'color', 'edit', 'color', 'update', '2015-12-26 23:54:44', '2015-12-26 23:54:44', NULL),
(11, 'color', 'delete', 'color', 'destroy', '2015-12-26 23:54:44', '2015-12-26 23:54:44', NULL),
(12, 'color', 'view', 'color', 'index', '2015-12-26 23:54:44', '2015-12-26 23:54:44', NULL),
(13, 'store', 'add', 'stores', 'create', '2015-12-26 23:59:11', '2015-12-26 23:59:11', NULL),
(14, 'store', 'add', 'stores', 'store', '2015-12-26 23:59:11', '2015-12-26 23:59:11', NULL),
(15, 'store', 'edit', 'stores', 'edit', '2015-12-26 23:59:11', '2015-12-26 23:59:11', NULL),
(16, 'store', 'edit', 'stores', 'update', '2015-12-26 23:59:11', '2015-12-26 23:59:11', NULL),
(17, 'store', 'delete', 'stores', 'destroy', '2015-12-26 23:59:11', '2015-12-26 23:59:11', NULL),
(18, 'store', 'view', 'stores', 'index', '2015-12-26 23:59:11', '2015-12-26 23:59:11', NULL),
(19, 'group', 'add', 'group', 'create', '2015-12-27 00:00:43', '2015-12-27 00:00:43', NULL),
(20, 'group', 'add', 'group', 'store', '2015-12-27 00:01:51', '2015-12-27 00:01:51', NULL),
(21, 'group', 'edit', 'group', 'edit', '2015-12-27 00:01:51', '2015-12-27 00:01:51', NULL),
(22, 'group', 'edit', 'group', 'update', '2015-12-27 00:01:51', '2015-12-27 00:01:51', NULL),
(23, 'group', 'view', 'group', 'index', '2015-12-27 00:01:51', '2015-12-27 00:01:51', NULL),
(24, 'manufacturer', 'add', 'account', 'create', '2015-12-27 00:03:01', '2015-12-27 00:03:01', NULL),
(25, 'manufacturer', 'add', 'account', 'store', '2015-12-27 00:04:09', '2015-12-27 00:04:09', NULL),
(26, 'manufacturer', 'edit', 'account', 'edit', '2015-12-27 00:04:09', '2015-12-27 00:04:09', NULL),
(27, 'manufacturer', 'edit', 'account', 'update', '2015-12-27 00:04:09', '2015-12-27 00:04:09', NULL),
(28, 'manufacturer', 'delete', 'account', 'destroy', '2015-12-27 00:04:09', '2015-12-27 00:04:09', NULL),
(29, 'manufacturer', 'view', 'account', 'index', '2015-12-27 00:04:09', '2015-12-27 00:04:09', NULL),
(30, 'type', 'add', 'type', 'create', '2015-12-27 00:06:55', '2015-12-27 00:06:55', NULL),
(31, 'type', 'add', 'type', 'store', '2015-12-27 00:06:55', '2015-12-27 00:06:55', NULL),
(32, 'type', 'edit', 'type', 'edit', '2015-12-27 00:07:20', '2015-12-27 00:07:20', NULL),
(33, 'type', 'edit', 'type', 'update', '2015-12-27 00:07:56', '2015-12-27 00:07:56', NULL),
(34, 'type', 'delete', 'type', 'destroy', '2015-12-27 00:07:56', '2015-12-27 00:07:56', NULL),
(35, 'type', 'view', 'type', 'index', '2015-12-27 00:07:56', '2015-12-27 00:07:56', NULL),
(36, 'necksize', 'add', 'necksize', 'create', '2015-12-27 00:09:38', '2015-12-27 00:09:38', NULL),
(37, 'necksize', 'add', 'necksize', 'store', '2015-12-27 00:12:40', '2015-12-27 00:12:40', NULL),
(38, 'necksize', 'edit', 'necksize', 'edit', '2015-12-27 00:12:40', '2015-12-27 00:12:40', NULL),
(39, 'necksize', 'edit', 'necksize', 'update', '2015-12-27 00:12:40', '2015-12-27 00:12:40', NULL),
(40, 'necksize', 'delete', 'necksize', 'destroy', '2015-12-27 00:12:40', '2015-12-27 00:12:40', NULL),
(41, 'necksize', 'view', 'necksize', 'index', '2015-12-27 00:12:41', '2015-12-27 00:12:41', NULL),
(42, 'code_value', 'add', 'codevalue', 'create', '2015-12-27 00:15:02', '2015-12-27 00:15:02', NULL),
(43, 'code_value', 'add', 'codevalue', 'store', '2015-12-27 00:15:49', '2015-12-27 00:15:49', NULL),
(44, 'code_value', 'edit', 'codevalue', 'edit', '2015-12-27 00:15:49', '2015-12-27 00:15:49', NULL),
(45, 'code_value', 'edit', 'codevalue', 'update', '2015-12-27 00:15:49', '2015-12-27 00:15:49', NULL),
(46, 'code_value', 'view', 'codevalue', 'index', '2015-12-27 00:15:49', '2015-12-27 00:15:49', NULL),
(47, 'user', 'add', 'user', 'create', '2015-12-27 00:18:01', '2015-12-27 00:18:01', NULL),
(48, 'user', 'add', 'user', 'store', '2015-12-27 00:19:26', '2015-12-27 00:19:26', NULL),
(49, 'user', 'edit', 'user', 'edit', '2015-12-27 00:19:27', '2015-12-27 00:19:27', NULL),
(50, 'user', 'edit', 'user', 'update', '2015-12-27 00:19:27', '2015-12-27 00:19:27', NULL),
(51, 'user', 'view', 'user', 'index', '2015-12-27 00:19:27', '2015-12-27 00:19:27', NULL),
(52, 'user', 'reset_password', 'user', 'resetpassword', '2015-12-27 00:19:27', '2015-12-27 00:19:27', NULL),
(53, 'drawing', 'add', 'drawing', 'create', '2015-12-27 00:30:08', '2015-12-27 00:30:08', NULL),
(54, 'drawing', 'add', 'drawing', 'store', '2015-12-27 00:34:48', '2015-12-27 00:34:48', NULL),
(55, 'drawing', 'edit', 'drawing', 'edit', '2015-12-27 00:34:48', '2015-12-27 00:34:48', NULL),
(56, 'drawing', 'edit', 'drawing', 'update', '2015-12-27 00:34:48', '2015-12-27 00:34:48', NULL),
(57, 'drawing', 'delete', 'drawing', 'destroy', '2015-12-27 00:34:48', '2015-12-27 00:34:48', NULL),
(58, 'drawing', 'view', 'drawing', 'index', '2015-12-27 00:34:48', '2015-12-27 00:34:48', NULL),
(59, 'drawing', 'export', 'drawing', 'exporttoexcel', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(60, 'drawing', 'download_drawing', 'admin', 'download', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(61, 'drawing', 'download_attachement', 'admin', 'downloadattachment', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(62, 'drawing', 'download_attachement', 'admin', 'deleteattachment', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(63, 'authentication', 'login', 'admin', 'login', '2015-12-27 00:46:29', '2015-12-27 00:46:29', NULL),
(64, 'authentication', 'login', 'admin', 'logout', '2015-12-27 00:47:53', '2015-12-27 00:47:53', NULL),
(65, 'authentication', 'update_profile', 'admin', 'profile', '2015-12-27 00:47:53', '2015-12-27 00:47:53', NULL),
(66, 'authentication', 'update_profile', 'admin', 'updateprofile', '2015-12-27 00:47:53', '2015-12-27 00:47:53', NULL),
(67, 'authentication', 'change_password', 'admin', 'changepassword', '2015-12-27 00:47:53', '2015-12-27 00:47:53', NULL),
(68, 'authentication', 'login', 'admin', 'getunit', '2015-12-27 00:47:53', '2015-12-27 00:47:53', NULL),
(69, 'authentication', 'change_password', 'admin', 'updatepassword', '2015-12-27 00:47:53', '2015-12-27 00:47:53', NULL),
(70, 'authentication', 'login', 'dashboard', 'index', '2015-12-27 00:47:53', '2015-12-27 00:47:53', NULL),
(71, 'mold', 'export', 'mold', 'exporttoexcel', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(72, 'mold', 'add', 'mold', 'create', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(73, 'mold', 'add', 'mold', 'store', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(74, 'mold', 'edit', 'mold', 'edit', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(75, 'mold', 'edit', 'mold', 'update', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(76, 'mold', 'delete', 'mold', 'destroy', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(77, 'mold', 'view', 'mold', 'index', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(78, 'mold', 'add', 'drawing', 'getmoldtradename', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(79, 'mold', 'edit', 'drawing', 'getmoldtradename', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(80, 'machine_model', 'add', 'machinemodel', 'create', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(81, 'machine_model', 'add', 'machinemodel', 'store', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(82, 'machine_model', 'edit', 'machinemodel', 'edit', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(83, 'machine_model', 'edit', 'machinemodel', 'update', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(84, 'machine_model', 'delete', 'machinemodel', 'destroy', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(85, 'machine_model', 'view', 'machinemodel', 'index', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(86, 'machine_model', 'export', 'machinemodel', 'exporttoexcel', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(87, 'machine', 'add', 'machine', 'create', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(88, 'machine', 'add', 'machine', 'store', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(89, 'machine', 'edit', 'machine', 'edit', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(90, 'machine', 'edit', 'machine', 'update', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(91, 'machine', 'delete', 'machine', 'destroy', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(92, 'machine', 'view', 'machine', 'index', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(93, 'machine', 'export', 'machine', 'exporttoexcel', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(94, 'downtime', 'export', 'downtime', 'exporttoexcel', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(95, 'downtime', 'add', 'downtime', 'create', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(96, 'downtime', 'add', 'downtime', 'store', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(97, 'downtime', 'edit', 'downtime', 'edit', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(98, 'downtime', 'edit', 'downtime', 'update', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(99, 'downtime', 'delete', 'downtime', 'destroy', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(100, 'downtime', 'view', 'downtime', 'index', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(101, 'defect', 'export', 'defect', 'exporttoexcel', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(102, 'defect', 'add', 'defect', 'create', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(103, 'defect', 'add', 'defect', 'store', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(104, 'defect', 'edit', 'defect', 'edit', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(105, 'defect', 'edit', 'defect', 'update', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(106, 'defect', 'delete', 'defect', 'destroy', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(107, 'defect', 'view', 'defect', 'index', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(108, 'product', 'export', 'product', 'exporttoexcel', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(109, 'product', 'add', 'product', 'create', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(110, 'product', 'add', 'product', 'store', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(111, 'product', 'edit', 'product', 'edit', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(112, 'product', 'edit', 'product', 'update', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(113, 'product', 'delete', 'product', 'destroy', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(114, 'product', 'view', 'product', 'index', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(115, 'product', 'add', 'drawing', 'getmoldtradename', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(116, 'product', 'edit', 'drawing', 'getmoldtradename', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(117, 'item', 'export', 'item', 'exporttoexcel', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(118, 'item', 'add', 'item', 'create', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(119, 'item', 'add', 'item', 'store', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(120, 'item', 'edit', 'item', 'edit', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(121, 'item', 'edit', 'item', 'update', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(122, 'item', 'view', 'item', 'index', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(123, 'planning', 'view', 'planning', 'index', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(124, 'planning', 'add', 'planning', 'create', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(125, 'planning', 'add', 'planning', 'getmolds', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(126, 'planning', 'add', 'planning', 'addplanning', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(127, 'planning', 'edit', 'planning', 'getmolds', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(128, 'planning', 'edit', 'planning', 'edit', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(129, 'planning', 'edit', 'planning', 'update', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(130, 'planning', 'edit', 'planning', 'getproducts', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(131, 'planning', 'add', 'planning', 'getproducts', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(132, 'planning', 'add', 'planning', 'getplanningformachine', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(133, 'planning', 'edit', 'planning', 'getplanningformachine', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(134, 'planning', 'edit', 'planning', 'checkplandate', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(135, 'planning', 'add', 'planning', 'checkplandate', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(136, 'planning', 'add', 'planning', 'calculatetime', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(137, 'planning', 'edit', 'planning', 'calculatetime', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(138, 'hourly_entry', 'view', 'hourlyentry', 'index', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(139, 'hourly_entry', 'add', 'hourlyentry', 'create', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(140, 'hourly_entry', 'add', 'hourlyentry', 'loadallhourlydata', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(141, 'hourly_entry', 'add', 'hourlyentry', 'savehourlydata', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(142, 'hourly_entry', 'edit', 'hourlyentry', 'edit', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(143, 'hourly_entry', 'edit', 'hourlyentry', 'savehourlydata', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(144, 'hourly_entry', 'delete', 'hourlyentry', 'deletehourlyentry', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(145, 'hourly_entry', 'view', 'hourlyentry', 'show', '2015-12-27 00:34:49', '2015-12-27 00:34:49', NULL),
(146, 'daily_entry', 'view', 'dailyentry', 'index', '2015-12-28 23:51:27', '2015-12-28 23:51:27', NULL),
(147, 'daily_entry', 'view', 'dailyentry', 'showdailyentry', '2015-12-28 23:51:27', '2015-12-28 23:51:27', NULL),
(148, 'daily_entry', 'add', 'dailyentry', 'create', '2015-12-28 23:51:27', '2015-12-28 23:51:27', NULL),
(149, 'daily_entry', 'add', 'dailyentry', 'loadallmachines', '2015-12-28 23:51:27', '2015-12-28 23:51:27', NULL),
(150, 'daily_entry', 'add', 'dailyentry', 'savedailyentry', '2015-12-28 23:51:27', '2015-12-28 23:51:27', NULL),
(151, 'daily_entry', 'add', 'dailyentry', 'getrejection', '2015-12-28 23:51:27', '2015-12-28 23:51:27', NULL),
(152, 'daily_entry', 'add', 'dailyentry', 'getdowntime', '2015-12-28 23:51:27', '2015-12-28 23:51:27', NULL),
(153, 'daily_entry', 'add', 'dailyentry', 'saverejection', '2015-12-28 23:51:27', '2015-12-28 23:51:27', NULL),
(154, 'daily_entry', 'add', 'dailyentry', 'savedowntime', '2015-12-28 23:51:27', '2015-12-28 23:51:27', NULL),
(155, 'daily_entry', 'delete', 'dailyentry', 'destroy', '2015-12-28 23:51:27', '2015-12-28 23:51:27', NULL),
(156, 'packing_matrix', 'add', 'packing', 'create', '2015-12-28 23:51:27', '2015-12-28 23:51:27', NULL),
(157, 'packing_matrix', 'add', 'packing', 'store', '2015-12-28 23:51:27', '2015-12-28 23:51:27', NULL),
(158, 'packing_matrix', 'edit', 'packing', 'edit', '2015-12-28 23:51:27', '2015-12-28 23:51:27', NULL),
(159, 'packing_matrix', 'edit', 'packing', 'update', '2015-12-28 23:51:27', '2015-12-28 23:51:27', NULL),
(160, 'packing_matrix', 'view', 'packing', 'index', '2015-12-28 23:51:27', '2015-12-28 23:51:27', NULL),
(161, 'fg_inward', 'view', 'invert', 'index', '2015-12-28 23:51:27', '2015-12-28 23:51:27', NULL),
(162, 'fg_inward', 'view', 'invert', 'show', '2015-12-28 23:51:27', '2015-12-28 23:51:27', NULL),
(163, 'fg_inward', 'view', 'invert', 'showinvertdata', '2015-12-28 23:51:27', '2015-12-28 23:51:27', NULL),
(164, 'fg_inward', 'add', 'invert', 'create', '2015-12-28 23:51:27', '2015-12-28 23:51:27', NULL),
(165, 'fg_inward', 'add', 'invert', 'loadallinvert', '2015-12-28 23:51:27', '2015-12-28 23:51:27', NULL),
(166, 'fg_inward', 'add', 'invert', 'saveinvertdata', '2015-12-28 23:51:27', '2015-12-28 23:51:27', NULL),
(167, 'fg_inward', 'add', 'invert', 'getquantityperbox', '2015-12-28 23:51:27', '2015-12-28 23:51:27', NULL),
(168, 'fg_inward', 'add', 'invert', 'gettypeofpacking', '2015-12-28 23:51:27', '2015-12-28 23:51:27', NULL),
(169, 'rejection', 'view', 'rejection', 'index', '2015-12-28 23:51:27', '2015-12-28 23:51:27', NULL),
(170, 'rejection', 'view', 'rejection', 'show', '2015-12-28 23:51:27', '2015-12-28 23:51:27', NULL),
(171, 'rejection', 'view', 'rejection', 'showrejectiondata', '2015-12-28 23:51:27', '2015-12-28 23:51:27', NULL),
(172, 'rejection', 'add', 'rejection', 'create', '2015-12-28 23:51:27', '2015-12-28 23:51:27', NULL),
(173, 'rejection', 'add', 'rejection', 'saveproductionrejection', '2015-12-28 23:51:27', '2015-12-28 23:51:27', NULL),
(174, 'rejection', 'add', 'rejection', 'savecustomerrejection', '2015-12-28 23:51:27', '2015-12-28 23:51:27', NULL),
(175, 'rejection', 'add', 'rejection', 'loadrejectionslip', '2015-12-28 23:51:27', '2015-12-28 23:51:27', NULL),
(176, 'rejection', 'delete', 'rejection', 'deleterejectionentry', '2015-12-28 23:51:27', '2015-12-28 23:51:27', NULL),
(177, 'role', 'view', 'role', 'index ', '2015-12-26 23:26:53', '2015-12-26 23:26:53', NULL),
(178, 'role', 'edit', 'role', 'update ', '2015-12-26 23:26:53', '2015-12-26 23:26:53', NULL),
(179, 'role', 'edit', 'role', 'edit ', '2015-12-26 23:26:53', '2015-12-26 23:26:53', NULL),
(180, 'report', 'daily_production_report', 'report', 'productionreport', '2015-12-26 23:26:53', '2015-12-26 23:26:53', NULL),
(181, 'report', 'daily_production_report', 'report', 'dailyproductionreport', '2015-12-26 23:26:53', '2015-12-26 23:26:53', NULL),
(182, 'report', 'daily_production_report', 'report', 'dailyproductionpdf', '2015-12-26 23:26:53', '2015-12-26 23:26:53', NULL),
(183, 'report', 'management_report', 'report', 'managementreport', '2015-12-26 23:26:53', '2015-12-26 23:26:53', NULL),
(184, 'report', 'management_report', 'report', 'managementreportpdf', '2015-12-26 23:26:53', '2015-12-26 23:26:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `activations`
--

CREATE TABLE IF NOT EXISTS `activations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=20 ;

--
-- Dumping data for table `activations`
--

INSERT INTO `activations` (`id`, `user_id`, `code`, `completed`, `completed_at`, `created_at`, `updated_at`) VALUES
(1, 1, '5iKthvQl590mhikvWc10HxlSAbmw3C5X', 1, '2015-10-07 17:51:03', '2015-10-07 17:51:03', '2015-10-07 17:51:03'),
(2, 2, 'cXmEtIAUm2kUAGTNXjryLeBt2aWGqKv5', 1, '2015-12-29 07:28:31', '2015-12-29 07:28:31', '2015-12-29 07:28:31'),
(3, 3, '4BtCvxIgc3Iwrj56t4xVqbScswAlvvwV', 1, '2016-01-11 21:52:39', '2016-01-11 21:52:39', '2016-01-11 21:52:39'),
(4, 4, 'tWf0lHcG31QL8amkD5qU3aXb7fTDsCOr', 1, '2016-01-11 23:00:52', '2016-01-11 23:00:52', '2016-01-11 23:00:52'),
(5, 5, 'enDRxUwX14yoabe9DWUhAXLaC1SE4jHy', 1, '2016-01-11 23:07:18', '2016-01-11 23:07:18', '2016-01-11 23:07:18'),
(6, 6, 'QVdBULZCcGDmr2RErqd5fy93nbZEChuY', 1, '2016-01-12 00:44:22', '2016-01-12 00:44:22', '2016-01-12 00:44:22'),
(7, 7, 'FcGX4NtvLSV2QhVIQxcWdKtNL26JVgAc', 1, '2016-01-18 20:32:51', '2016-01-18 20:32:51', '2016-01-18 20:32:51'),
(8, 8, 'hdbJzNHUa8QjTJFFuZ217tJqwrfpu5Qr', 1, '2016-02-16 06:22:34', '2016-02-16 06:22:34', '2016-02-16 06:22:34'),
(9, 9, 'P7cvh8rTJMIzFDSnjyFvX4GwNo4kOpsM', 1, '2016-02-19 22:30:35', '2016-02-19 22:30:35', '2016-02-19 22:30:35'),
(10, 10, 'iI820KkkjdzF28F33PNSYIl3xGDDUcDG', 1, '2016-02-19 22:32:21', '2016-02-19 22:32:21', '2016-02-19 22:32:21'),
(11, 11, 'wc9qT8RTWz5XMxpx0CHSSVGOCH6Of2Fm', 1, '2016-03-31 19:44:00', '2016-03-31 19:44:00', '2016-03-31 19:44:00'),
(12, 12, '0ekdbhhUu8vAc4yatpdVgAbPxoMpyum1', 1, '2016-05-19 22:46:01', '2016-05-19 22:46:01', '2016-05-19 22:46:01'),
(13, 13, 'mLbVMXUVJos6NkaF0FkBISqRlaMlrTZy', 1, '2016-05-19 22:50:19', '2016-05-19 22:50:19', '2016-05-19 22:50:19'),
(14, 14, 'yzVprpt5kmrCmx6QULwqd72CWNS6zm86', 1, '2016-06-10 18:17:02', '2016-06-10 18:17:02', '2016-06-10 18:17:02'),
(15, 2, 'tCGFSdCGxTuulvafEow2xAqmGLFGOyNt', 1, '2016-06-14 18:13:28', '2016-06-14 18:13:28', '2016-06-14 18:13:28'),
(16, 3, 'RLraDrBIB1jxQOM7jMLZa1OkeuyHAipn', 1, '2016-06-15 17:56:59', '2016-06-15 17:56:59', '2016-06-15 17:56:59'),
(17, 1, 'W1iZkPR5NneNrv33fsLKoKJxdVE8OuSH', 1, '2016-06-15 17:58:46', '2016-06-15 17:58:46', '2016-06-15 17:58:46'),
(18, 2, 'pyl8kzPRfuS2jTkROWaDo6j6Kga9mqXx', 1, '2016-06-20 18:54:46', '2016-06-20 18:54:46', '2016-06-20 18:54:46'),
(19, 3, 'yzrdQDToCVLXMtnHOt769gXnmA7c1OTg', 1, '2016-10-18 16:09:19', '2016-10-18 16:09:19', '2016-10-18 16:09:19');

-- --------------------------------------------------------

--
-- Table structure for table `call_types`
--

CREATE TABLE IF NOT EXISTS `call_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `call_type` varchar(100) NOT NULL,
  `status` enum('A','I') NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `call_type_UNIQUE` (`call_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `call_types`
--

INSERT INTO `call_types` (`id`, `call_type`, `status`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Call type 1', 'A', 'testing', '2016-10-01 20:50:00', '2016-10-04 22:38:50', NULL),
(2, 'Call type one', 'A', 'Test call type one', '2016-10-04 22:22:48', '2016-10-04 22:22:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `call_types_sub`
--

CREATE TABLE IF NOT EXISTS `call_types_sub` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `subcall_type` varchar(100) NOT NULL,
  `call_type_id` int(10) unsigned DEFAULT NULL,
  `status` enum('A','I') NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `subcall_type_UNIQUE` (`subcall_type`),
  KEY `fk_call_types_sub_1_idx` (`call_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `call_types_sub`
--

INSERT INTO `call_types_sub` (`id`, `subcall_type`, `call_type_id`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Sub-call type 1', 1, 'A', '2016-10-01 20:50:00', '2016-10-01 20:50:00', NULL),
(2, 'Sub-call type 2', 1, 'A', '2016-10-01 20:50:00', '2016-10-01 20:50:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE IF NOT EXISTS `cities` (
  `id` int(10) unsigned NOT NULL,
  `city` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `City_UNIQUE` (`city`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `city`) VALUES
(2, 'Ahmedabad'),
(1, 'Mumbai'),
(0, 'NA');

-- --------------------------------------------------------

--
-- Table structure for table `code`
--

CREATE TABLE IF NOT EXISTS `code` (
  `id` int(10) NOT NULL,
  `code` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `code`
--

INSERT INTO `code` (`id`, `code`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Employee Category', '2016-10-02 11:52:52', '2016-10-02 11:52:52', NULL),
(2, 'Call Duration', '2016-10-02 11:52:52', '2016-10-02 11:52:52', NULL),
(3, 'Fatal Reason', '2016-10-02 11:52:52', '2016-10-02 11:52:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `code_values`
--

CREATE TABLE IF NOT EXISTS `code_values` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code_id` int(11) NOT NULL,
  `code_value` varchar(255) NOT NULL,
  `status` enum('A','I') NOT NULL DEFAULT 'A',
  `description` text,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_code_values_1_idx` (`code_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `code_values`
--

INSERT INTO `code_values` (`id`, `code_id`, `code_value`, `status`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Production', 'A', 'Production', '2016-10-02 17:23:33', '2016-10-02 17:23:33', NULL),
(2, 2, '1', 'A', 'call duration - 1', '2016-10-16 19:14:05', '2016-10-16 19:14:05', NULL),
(3, 3, 'Reason one', 'A', 'Reason One', '2016-10-18 22:45:51', '2016-10-18 22:45:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE IF NOT EXISTS `departments` (
  `id` smallint(5) unsigned NOT NULL,
  `name` varchar(45) NOT NULL,
  `status` enum('A','I') NOT NULL DEFAULT 'A',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(0, 'NA', 'A', '2016-06-15 22:44:53', '2016-06-15 22:44:53', NULL),
(1, 'BoC', 'A', '2016-06-15 22:44:53', '2016-06-15 22:44:53', NULL),
(2, 'Debit Card', 'A', '2016-06-15 22:45:19', '2016-06-15 22:45:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE IF NOT EXISTS `employees` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `emp_code` int(10) unsigned NOT NULL,
  `system_id` varchar(100) NOT NULL,
  `department_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `emp_name` varchar(100) NOT NULL,
  `mobile` varchar(45) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `manager_id` int(10) unsigned DEFAULT '0',
  `tl_id` int(10) unsigned DEFAULT '0',
  `emp_type_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `password` varchar(255) NOT NULL,
  `status` enum('A','I') NOT NULL DEFAULT 'A',
  `allow_login` enum('Y','N') NOT NULL DEFAULT 'N',
  `lwd` date DEFAULT NULL COMMENT 'last work day',
  `doj` date NOT NULL COMMENT 'date of joining',
  `last_login` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `city_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `emp_code_UNIQUE` (`emp_code`),
  UNIQUE KEY `system_id_UNIQUE` (`system_id`),
  UNIQUE KEY `mobile_UNIQUE` (`mobile`),
  KEY `fk_employees_1_idx` (`department_id`),
  KEY `fk_employees_2_idx` (`emp_type_id`),
  KEY `fk_employees_3_idx` (`city_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `emp_code`, `system_id`, `department_id`, `emp_name`, `mobile`, `email`, `manager_id`, `tl_id`, `emp_type_id`, `password`, `status`, `allow_login`, `lwd`, `doj`, `last_login`, `created_at`, `updated_at`, `deleted_at`, `city_id`) VALUES
(1, 101349, 'sachin.bansode', 1, 'Sachin Bansode', '7045597879', 'sachin.bansode@idfcbank.com', 0, 0, 1, '$2y$10$bgDpCgXyMcLMXpsvO7AC2.Nfz.v.IszESe579Dn7OAEwucWEzht4a', 'A', 'Y', NULL, '0000-00-00', '2016-10-23 13:04:48', '2016-06-15 23:28:46', '2016-10-23 13:04:48', NULL, 0),
(2, 101400, 'Supriya.khankar', 0, 'Supriya Khankar', '9820098200', '123@idfcbank.com', 1, 0, 2, '$2y$10$A1kSYisDkZOAHDQwXAGmWe5bJUH/rxclNhkzribWJonxBgA36TJJy', 'A', 'Y', NULL, '0000-00-00', '0000-00-00 00:00:00', '2016-06-21 00:24:46', '2016-10-18 21:37:25', NULL, 1),
(3, 272, 'ss.ss', 0, 'ss', '7654325678', 'ss@yopmail.com', 1, 2, 3, '$2y$10$toszc3Tjwc75DZ6PGZusf.Vw4v7uDCjF8pANXyi4smBMCksLniziK', 'A', 'Y', NULL, '0000-00-00', '2016-10-18 22:37:56', '2016-10-18 21:39:19', '2016-10-18 22:37:56', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `employees_categories`
--

CREATE TABLE IF NOT EXISTS `employees_categories` (
  `id` int(10) unsigned NOT NULL,
  `category` varchar(100) NOT NULL,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `category_UNIQUE` (`category`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees_categories`
--

INSERT INTO `employees_categories` (`id`, `category`, `status`) VALUES
(0, 'NA', 'I'),
(1, 'Production', 'A'),
(2, 'OJT', 'A'),
(3, 'Diagnostic', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `emp_types`
--

CREATE TABLE IF NOT EXISTS `emp_types` (
  `id` smallint(5) unsigned NOT NULL,
  `emp_type` varchar(45) NOT NULL,
  `status` enum('A','I') NOT NULL DEFAULT 'A',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emp_types`
--

INSERT INTO `emp_types` (`id`, `emp_type`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(0, 'NA', 'A', '2016-10-01 22:42:46', '2016-10-01 22:42:46', NULL),
(1, 'Manager', 'A', '2016-10-01 22:42:46', '2016-10-01 22:42:46', NULL),
(2, 'Team Lead', 'A', '2016-10-01 22:42:46', '2016-06-15 22:43:28', NULL),
(3, 'Agent', 'A', '2016-06-15 22:43:29', '2016-06-15 22:43:29', NULL),
(4, 'Quality Auditor', 'A', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `persistences`
--

CREATE TABLE IF NOT EXISTS `persistences` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `persistences_code_unique` (`code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1817 ;

--
-- Dumping data for table `persistences`
--

INSERT INTO `persistences` (`id`, `user_id`, `code`, `created_at`, `updated_at`) VALUES
(682, 2, 'cgwlwZyEYwyusx7DODNfJ1VEHqolo14c', '2015-12-31 06:35:56', '2015-12-31 06:35:56'),
(700, 2, 'IZrHLWERAnARAivjJYUXFANBXFYjeoDr', '2016-01-06 23:46:12', '2016-01-06 23:46:12'),
(735, 2, 'XgigFkiH4jR8cES3YKwf5erGyRnsSTh4', '2016-01-09 04:14:03', '2016-01-09 04:14:03'),
(738, 2, 'RkodvB7tLvNPXjIWdPe1VC63rLX5uK48', '2016-01-09 06:15:55', '2016-01-09 06:15:55'),
(740, 2, 'sTqiv8eD8Wfpxj7vLmBTmrlER3gjmzt9', '2016-01-10 01:44:04', '2016-01-10 01:44:04'),
(741, 2, 'Xrs7zs1k97Lm3nXwpJYXkqtuK1LZOykC', '2016-01-10 01:44:40', '2016-01-10 01:44:40'),
(749, 4, 'YPUU9iFpf7aJVbw1yT0J5icmAP0TsZbn', '2016-01-11 23:31:36', '2016-01-11 23:31:36'),
(764, 2, '0YlsodH8KT1a6Cos0c4uf1PRJ2yiq0Pn', '2016-01-12 06:08:22', '2016-01-12 06:08:22'),
(772, 3, 'BAx6lhdMMoiFWHVZF2OJOeIDYrJvLDS5', '2016-01-13 20:25:55', '2016-01-13 20:25:55'),
(777, 3, '4E8rQiGKT4n2z4sYUHX7d2RmXmV51rjx', '2016-01-15 20:31:41', '2016-01-15 20:31:41'),
(779, 4, 'jbCgsBlBQyFnwsVK8pK0l1Co6BVICcat', '2016-01-15 22:32:01', '2016-01-15 22:32:01'),
(782, 3, 'YsrpR95b2iez50K0fv9uX0dy2q86gqBG', '2016-01-15 23:46:10', '2016-01-15 23:46:10'),
(788, 4, 'eKJQJAvRndALNx9Ew0kiiXYol8VRHlMn', '2016-01-16 18:03:39', '2016-01-16 18:03:39'),
(792, 2, 'NL3fXMxrwf2RJw4jD0Z9YjopbJTDTjJQ', '2016-01-16 22:25:01', '2016-01-16 22:25:01'),
(796, 2, 'voNxdq1KmuXT5eKDLkhQHRmubOvbmtIT', '2016-01-17 20:08:15', '2016-01-17 20:08:15'),
(797, 2, 's4ywk9PiwCQrGW29Xt3hDLMYSV72oVY4', '2016-01-17 22:45:02', '2016-01-17 22:45:02'),
(798, 2, 't3GUpnpwMBGMKDygduYIL6Do0HFBTRwS', '2016-01-17 23:26:58', '2016-01-17 23:26:58'),
(808, 2, 'xJs1JX8VCd6iSOLYy4OeB0NfwvQvAFCK', '2016-01-18 20:35:01', '2016-01-18 20:35:01'),
(818, 3, '3r70ZZjZJi8PsbYXzMYhbilUhOXdwWj1', '2016-01-19 18:32:31', '2016-01-19 18:32:31'),
(831, 7, 'yjpVWG5SXuun34m9tcHXb2hQwCpBO7X9', '2016-01-20 06:55:28', '2016-01-20 06:55:28'),
(839, 2, '8tTW3I8k9pVHBbKKBZtcsB5ozdhwSNMM', '2016-01-21 17:01:30', '2016-01-21 17:01:30'),
(841, 3, 'Q9tMx53BcKCiDDNOk5Y9pg7w4k90mXMX', '2016-01-21 17:53:16', '2016-01-21 17:53:16'),
(853, 2, '9NW4ZXNhSVyiGv6hTUtnTKMnOUDl3hZc', '2016-01-22 05:27:25', '2016-01-22 05:27:25'),
(857, 2, 'T0WamOndHTfAVvPRo1IeBb7m2DzEmvfh', '2016-01-23 02:38:18', '2016-01-23 02:38:18'),
(858, 2, 'a8qMLnXVlJDsO05JTY63EcpO4yoINeGQ', '2016-01-23 19:32:05', '2016-01-23 19:32:05'),
(861, 2, 'VRfENxM4ig6ikSXYJUIcNGa4hFUhxUic', '2016-01-23 22:18:59', '2016-01-23 22:18:59'),
(863, 2, 'm0hlLvH8VrxwVUOIQTgWthgPk4ult2rD', '2016-01-24 02:18:03', '2016-01-24 02:18:03'),
(864, 2, '7MxFfDl0xobvYb0u1ZhDYFMfLUcUA0AA', '2016-01-24 04:13:14', '2016-01-24 04:13:14'),
(865, 2, '8FmQPU2QUlt7KvEyCdtUf5lVLj5cHWnr', '2016-01-24 05:03:44', '2016-01-24 05:03:44'),
(866, 2, 'OG4oj0gciPyWqB05GA1uQlXHJIiM4fif', '2016-01-24 06:56:55', '2016-01-24 06:56:55'),
(867, 2, 'Cc8A7DNHHuWprVXkxgNKIJtrZlq8mWF4', '2016-01-24 17:39:19', '2016-01-24 17:39:19'),
(868, 2, 'qOGd5qb52Ff6zFrH8XL5p44Qvn2k8u2m', '2016-01-24 18:16:44', '2016-01-24 18:16:44'),
(869, 2, 'b7AnSDBtDPVDf9OSZwlCkoSE5HeepctI', '2016-01-24 19:33:32', '2016-01-24 19:33:32'),
(870, 2, 'AGzLo0n2xJPfuwjSV0UHigwcsGAv0Qq5', '2016-01-24 19:34:25', '2016-01-24 19:34:25'),
(871, 2, 'wiFsrwS0XYgmJRx3yqxXPK8DpDexrVXa', '2016-01-24 21:04:39', '2016-01-24 21:04:39'),
(872, 2, 'LbZgrffYq9mPvrwQNJrgTZFyfT49jiLq', '2016-01-24 21:16:01', '2016-01-24 21:16:01'),
(874, 3, 'KJyg3XVNsQoOQYZ3tK3m6552dUbqtEpY', '2016-01-25 18:14:14', '2016-01-25 18:14:14'),
(881, 3, 'RVsmi2LAJQaFfTKWD3GDrtfMgtCzP4aK', '2016-01-25 21:09:18', '2016-01-25 21:09:18'),
(892, 3, 'rgN6qANOULOx9fuz4JFxKM3F6rdNoCzn', '2016-01-27 17:25:48', '2016-01-27 17:25:48'),
(893, 3, 'KyJ6Yij4bJCLVaOI7WYhqrWQOSfObDVI', '2016-01-27 17:31:10', '2016-01-27 17:31:10'),
(899, 2, 'pXPb56U8M28zz6riYerOiRsrrrSuMzTf', '2016-01-28 06:15:17', '2016-01-28 06:15:17'),
(909, 2, 'QSiiRPKFfI85h1QI2YYLWthr543yWi7t', '2016-01-30 06:27:17', '2016-01-30 06:27:17'),
(910, 2, 'qeK8STslL6Q76GsaEygbTeuwme28WCqm', '2016-01-30 07:09:13', '2016-01-30 07:09:13'),
(923, 2, '1GRhHHd72CLRqJBAxx61j5oUdQrNnHms', '2016-01-31 00:38:08', '2016-01-31 00:38:08'),
(927, 2, 'kkhsoitc8z3IWVN3OOMQevhPXpUpkf2q', '2016-01-31 01:14:23', '2016-01-31 01:14:23'),
(929, 2, 'oyV4sn9Y4RfLs8qyDfY9QBlSEaZFT60p', '2016-01-31 19:52:50', '2016-01-31 19:52:50'),
(930, 2, 'j6FA35pS3chstUVO7ogSL8Z5y1ICTLnX', '2016-01-31 21:49:37', '2016-01-31 21:49:37'),
(939, 2, 'P0MUfeO1scY7DBOAT36Qj6q9w5IcQsel', '2016-02-02 05:11:32', '2016-02-02 05:11:32'),
(940, 2, 'uoyfmaOqpFtebCAy1FfULST36a2Xg57Q', '2016-02-02 07:05:13', '2016-02-02 07:05:13'),
(949, 4, 'FSDKboCKCwMBRCAigZ0ZhjIjgB2nEdPi', '2016-02-02 22:07:57', '2016-02-02 22:07:57'),
(953, 2, 'sZkdoT7ScbdXCjozkUn11DI73lneigwD', '2016-02-03 04:41:11', '2016-02-03 04:41:11'),
(957, 4, 'hx7wgYCV38bAmFAgOjLn4CTDFSmS9NRY', '2016-02-03 18:31:45', '2016-02-03 18:31:45'),
(958, 4, 'gWHszzjjRpxC3Wmuf3nDS9gkIVV8z2wD', '2016-02-03 21:19:11', '2016-02-03 21:19:11'),
(959, 4, '8RTltM2fQLB1jdyya8ZpypRiHKtC610h', '2016-02-03 21:19:12', '2016-02-03 21:19:12'),
(960, 4, 'l8oqTAyzqDA8aKuj4z0f11UoL07esq1t', '2016-02-03 22:48:09', '2016-02-03 22:48:09'),
(971, 4, 'oqCQ4w2JGOPsjBJShFKRJdxbdTKYByD1', '2016-02-05 18:35:21', '2016-02-05 18:35:21'),
(972, 4, 'CyYQoUdBG5VNAQI4HvjYLd6nVly8aTuV', '2016-02-05 19:45:26', '2016-02-05 19:45:26'),
(978, 4, 'iQX9WLigHJfjM3EwBb0BEOGwX2m6T82T', '2016-02-06 21:47:20', '2016-02-06 21:47:20'),
(979, 4, '7SXPQ2wKaO5tlC6LKK5rbwPL9JuCNehK', '2016-02-06 22:10:17', '2016-02-06 22:10:17'),
(983, 2, 'gfg24XdWOrywR2JNraiEXkNEHPvasWpk', '2016-02-08 07:18:34', '2016-02-08 07:18:34'),
(984, 2, 'G4y7dluQYXKadC8aKAE7wbAVLdXq4IkI', '2016-02-08 08:09:43', '2016-02-08 08:09:43'),
(992, 4, 'WCG7PWrfXwrBvINuq6IoCaUOowqKnHV8', '2016-02-09 22:22:39', '2016-02-09 22:22:39'),
(1003, 7, 'jdXgKdpsrqqRNeW4aqsTyvNn34wvQYGa', '2016-02-10 18:59:43', '2016-02-10 18:59:43'),
(1006, 7, 'c0TF1cSi4HQ7JOI2PFGVhx87SnDczZum', '2016-02-10 19:37:06', '2016-02-10 19:37:06'),
(1007, 2, 'eE2KVfHXX1nOJKMV340hXLAFbwvscIUq', '2016-02-10 19:43:40', '2016-02-10 19:43:40'),
(1009, 7, '8Pheryb3zJTyTwX7bqInjIoQ12MtL5dO', '2016-02-10 21:57:54', '2016-02-10 21:57:54'),
(1014, 2, 'kbNHK3e3DiSTpkgdRabghd9Yxd7AFxE2', '2016-02-10 23:46:14', '2016-02-10 23:46:14'),
(1018, 3, 'VIVw8riuov3258MMLh1VJYZSsT3gp7Um', '2016-02-11 20:30:44', '2016-02-11 20:30:44'),
(1022, 7, 'UbKMvusP4oGxiIEh2AMgLbEQ3dCZFLvB', '2016-02-13 09:17:08', '2016-02-13 09:17:08'),
(1026, 2, 'xHxiYi2fPijQYcHADXsbsqMD0aNJ7oo9', '2016-02-14 04:29:14', '2016-02-14 04:29:14'),
(1027, 2, '5Tth6JCKzwzSOJYEJ3VKXwRLeYFDTNYJ', '2016-02-14 21:16:34', '2016-02-14 21:16:34'),
(1028, 2, 'mOlBrmmyD0FlYXh5h76cBHUxCIoB9KsG', '2016-02-14 21:43:13', '2016-02-14 21:43:13'),
(1029, 2, 'IQ6ud6N5hDEHKJ5w8ZKDDAxqVEaZ6JeM', '2016-02-14 22:43:39', '2016-02-14 22:43:39'),
(1030, 7, 'YRPVgEVuOMkaGTzcWxgISMfbfimzwBGh', '2016-02-15 05:22:00', '2016-02-15 05:22:00'),
(1035, 4, '19Jvv4taWfhXdCa38zCGYF79UPirB1RL', '2016-02-15 21:31:29', '2016-02-15 21:31:29'),
(1040, 3, 'QamvIHGi8EgapZz2SYCWTlz7qMxH4phB', '2016-02-16 00:48:08', '2016-02-16 00:48:08'),
(1044, 8, 'D9jwL667mLTQJaTpV6tQPdacYs9oiHlQ', '2016-02-16 04:59:31', '2016-02-16 04:59:31'),
(1046, 3, 'gPBAPyZgQ9jRK1QOnEZfi57fzqxaNimH', '2016-02-16 21:19:24', '2016-02-16 21:19:24'),
(1055, 2, 'eUQxeY3b3Og6KyGJ67mv6k9Wa5eLpa8e', '2016-02-17 05:15:25', '2016-02-17 05:15:25'),
(1056, 2, 'Ohr6hf0qEFD6miAo8E2z7LVjJY2Ch2l5', '2016-02-17 05:17:45', '2016-02-17 05:17:45'),
(1057, 2, 'TIUwtRZtNixwZWsr5rLvlV6VDODQZQGn', '2016-02-17 05:47:39', '2016-02-17 05:47:39'),
(1058, 2, 'p2r9QdEXcRLweILQthRED9CCFrWur4WZ', '2016-02-17 07:12:27', '2016-02-17 07:12:27'),
(1062, 3, 'CPvH6gUDtKcG77OZxq1ZHLUI2YCoRXkw', '2016-02-17 20:39:11', '2016-02-17 20:39:11'),
(1065, 3, 'rfYwySMuzgr6xWegmA4VuoM80KlfJW6W', '2016-02-17 23:13:06', '2016-02-17 23:13:06'),
(1067, 2, 'ZiFjwDP840Etwf7dINknewse5dvxEAhd', '2016-02-18 02:14:01', '2016-02-18 02:14:01'),
(1068, 2, 'Yh5jue8bYbDuGsenhnpJD8w1QoAEZfQD', '2016-02-18 04:54:38', '2016-02-18 04:54:38'),
(1069, 2, '8yrDcopoUpwtqJN18b0BGO6ySDI9YWEK', '2016-02-18 05:25:49', '2016-02-18 05:25:49'),
(1070, 2, 'r02Mlt5D1eg3lZ0OL7kCVESBFfhdBcyD', '2016-02-18 17:15:37', '2016-02-18 17:15:37'),
(1079, 2, 'ocbhJHZURk8pQs0hTCMv0o7HypX26SBQ', '2016-02-19 04:31:04', '2016-02-19 04:31:04'),
(1080, 7, 'tCV4qe7acAjqstWOfEonfNDmLwM4N2KC', '2016-02-19 04:39:15', '2016-02-19 04:39:15'),
(1081, 2, 'JRSWS9sOQ8tL3joBK1OLajGY1UEBXso6', '2016-02-19 05:22:25', '2016-02-19 05:22:25'),
(1083, 7, 's26bQB9DgRHuMmbYdESGJZVVHGPRXt8F', '2016-02-19 05:56:16', '2016-02-19 05:56:16'),
(1090, 3, '6JyPNx2VSph2B4CqkK7AuQgMlBE6Nxhh', '2016-02-19 20:07:30', '2016-02-19 20:07:30'),
(1099, 2, '4K0zKJ92HAwoBALfGOeGTkX1DGH9jFoz', '2016-02-21 04:32:26', '2016-02-21 04:32:26'),
(1106, 2, 'CLMFAQR60MZSgHBQxXcugNWewiaGLRcz', '2016-02-25 18:47:01', '2016-02-25 18:47:01'),
(1108, 3, 'RYBu6m8xURHpVATmJpQjE8kUwlribmEI', '2016-02-25 23:13:13', '2016-02-25 23:13:13'),
(1112, 2, 'DXThvSDjdY4A9lnVmWDM7raRuXGbt8Hd', '2016-02-26 06:18:27', '2016-02-26 06:18:27'),
(1113, 2, '6gdbb9ZcBdlbeEo9OCMtEEp3xd3iEKHS', '2016-02-26 06:46:43', '2016-02-26 06:46:43'),
(1119, 3, 'cBJozbuOwrqE9A1bKh9ioDSaEEJM3i5g', '2016-02-26 20:46:43', '2016-02-26 20:46:43'),
(1120, 4, '5XJHjIn6soKG4Dd3qLaqOTq51NUuOMh9', '2016-02-26 21:20:28', '2016-02-26 21:20:28'),
(1123, 3, 'NXH7PLgAV5He6AZF04Fc7MzWC9ZZTTqP', '2016-02-27 01:15:07', '2016-02-27 01:15:07'),
(1125, 4, 'iJRxLJc1nW05WYSiXzH3UGolhdhHQYnL', '2016-02-27 21:41:09', '2016-02-27 21:41:09'),
(1135, 5, 'd1srJ7lH8Xh63SBov3rRZvJfzlsII7Ms', '2016-02-29 23:33:50', '2016-02-29 23:33:50'),
(1150, 2, 'ijpbwrJNm4XJ6Z9YxVbqqQvEyRlviqi6', '2016-03-02 07:00:18', '2016-03-02 07:00:18'),
(1152, 2, 'yEIfs9BfAZ9LWMiOfF9ysqIyobUt7Hgf', '2016-03-03 06:34:35', '2016-03-03 06:34:35'),
(1153, 2, 'SGLxR83piY85iN80J7Gcbk4JLPXCB36a', '2016-03-03 17:48:26', '2016-03-03 17:48:26'),
(1158, 8, '7aM8FlwzgAkQyNsKCYBZXZGuEiKTGeUi', '2016-03-04 06:56:34', '2016-03-04 06:56:34'),
(1159, 2, 'qsFn1AHFJReOQ2G2jk5kFaijPuOE2ipx', '2016-03-04 06:57:52', '2016-03-04 06:57:52'),
(1160, 2, 'jtrO0c8AzQjigeeQdiqNc52Zl8TMKfUf', '2016-03-04 07:26:37', '2016-03-04 07:26:37'),
(1162, 2, 'YOtUOB0K52plkqKZmFCd6Ujc9z13HxFN', '2016-03-04 19:25:02', '2016-03-04 19:25:02'),
(1171, 2, 'i3LxOX6WJLjZ0KBfFzZkIy1Atsvusv8K', '2016-03-05 19:44:18', '2016-03-05 19:44:18'),
(1175, 2, 'l581TTA0csbgjRR2ZF0seN9ZxNQBlEb9', '2016-03-07 04:16:35', '2016-03-07 04:16:35'),
(1176, 2, 'vtJuzcKifbV2gQ9XAQtcfq66i8CECyUu', '2016-03-07 04:40:25', '2016-03-07 04:40:25'),
(1177, 2, 'rLKyegEBoTGKET1oNNBnASIZphtSkmac', '2016-03-07 05:05:28', '2016-03-07 05:05:28'),
(1178, 2, 'HC6oDfz1eMNi6rx4ExCsyBvL8HnTbQkX', '2016-03-07 05:24:30', '2016-03-07 05:24:30'),
(1179, 2, '4FM6PcRy7j8RnVrBM8zpbNQadmUmkIw9', '2016-03-07 05:39:56', '2016-03-07 05:39:56'),
(1180, 2, 'fcfwl0mJkiKk72kC0EWTHI6NuaKfgFjy', '2016-03-07 06:00:25', '2016-03-07 06:00:25'),
(1192, 3, 'JmXrU69cwQlGrGtfoSd4VV2PyVDBzG7h', '2016-03-22 20:14:47', '2016-03-22 20:14:47'),
(1195, 8, 'xennSPROfgeHqNQbFI1Cfyxst6WktVtO', '2016-03-30 08:03:31', '2016-03-30 08:03:31'),
(1206, 2, 'cnBdm2ts6b46AYbclHPVMKoQDA2K6xyp', '2016-04-02 18:10:20', '2016-04-02 18:10:20'),
(1208, 2, '3zLJuMiOu7SalWZOStr8ominz0nNrEXh', '2016-04-02 18:39:13', '2016-04-02 18:39:13'),
(1209, 6, 'zKvlgPLPjpQuyDQWCLxUlkzYZdFYVvrv', '2016-04-02 18:44:17', '2016-04-02 18:44:17'),
(1210, 6, 'EZOUD4ei1txrzEAkBNohd848TxyKvaJq', '2016-04-02 19:02:56', '2016-04-02 19:02:56'),
(1211, 2, '80ireRvLT7ZNerflP86EhHvnk5SsDjkF', '2016-04-02 20:18:20', '2016-04-02 20:18:20'),
(1212, 6, 'NUy2vcFebNoRBlBgbdhsUK3FW0wDsBAH', '2016-04-02 20:19:52', '2016-04-02 20:19:52'),
(1213, 2, 'gywGM080EqrOrS0TB0o7oBIGVOnKNvON', '2016-04-04 19:10:56', '2016-04-04 19:10:56'),
(1222, 6, 'FY8rAAuZtgp79ywbzZ9Ba5SL3xzddPwR', '2016-04-06 19:14:12', '2016-04-06 19:14:12'),
(1228, 6, '7IcPAmysU22kjgi7PGeX6SKBrcySuAZI', '2016-04-07 03:16:54', '2016-04-07 03:16:54'),
(1231, 6, 'xV8d43l4zlcgiH7AKsnlExTOk2bHOK0n', '2016-04-08 22:29:23', '2016-04-08 22:29:23'),
(1242, 6, 'OkLHnl5sOqMaMG8gsiBWaO1fFAtpYxNR', '2016-04-09 21:17:08', '2016-04-09 21:17:08'),
(1244, 6, 'E9sDOmkHqHGgNVGoWtuUIzN3bRzdvNh0', '2016-04-09 22:30:39', '2016-04-09 22:30:39'),
(1246, 6, '4km2hy6ExzWURNDlVLS7L2i2hR2ew4X1', '2016-04-10 02:07:33', '2016-04-10 02:07:33'),
(1250, 6, 'XoK9LyMdKQ1P7iOky2VARNVtzcPD74OP', '2016-04-10 19:52:57', '2016-04-10 19:52:57'),
(1251, 6, 'NY8FDRF8qLatfWrYF1zUko3LEiYdC3n3', '2016-04-11 16:34:33', '2016-04-11 16:34:33'),
(1254, 6, '65gYEiWUiQilTNSrg7kXW0rxy05e3NUN', '2016-04-12 16:50:48', '2016-04-12 16:50:48'),
(1256, 6, 'nEH1ZSDn2trzqWHeaZpWStcCZA1fGhvI', '2016-04-12 20:37:49', '2016-04-12 20:37:49'),
(1262, 6, 'lP44YgydEpbXY8oqvqAKbYfyl7M7aWqs', '2016-04-12 23:01:12', '2016-04-12 23:01:12'),
(1265, 2, '3X8YjeTm7ZNe0jq4NYYJA8bjHeT1IS0U', '2016-04-13 00:09:07', '2016-04-13 00:09:07'),
(1269, 6, '3G773gLOgxaVQiCQ6amMxmdVVLJgO1bw', '2016-04-13 02:58:36', '2016-04-13 02:58:36'),
(1270, 6, 'ZvDSxhqvBUeIGhCl2xVTgjHhVV7RCHOW', '2016-04-13 16:13:00', '2016-04-13 16:13:00'),
(1274, 6, 'guDMFWnEFkk4Mne2Vu9owM2zfIjIAa3o', '2016-04-13 21:05:39', '2016-04-13 21:05:39'),
(1279, 6, 'c90wNknumkpyeR90r0jb4gvXRAwlWZ4B', '2016-04-13 22:35:27', '2016-04-13 22:35:27'),
(1284, 6, 'JelUQlUsszqxFN0UF6idRzEH9Sw04kJm', '2016-04-14 03:00:43', '2016-04-14 03:00:43'),
(1285, 6, 'Gj2RTFRq43xXnDePKyb9j8dOEtZppdXH', '2016-04-14 15:55:50', '2016-04-14 15:55:50'),
(1298, 6, 'K4C709gWM1hDqLTH28uDX4kgdJAsY3tF', '2016-04-14 23:12:17', '2016-04-14 23:12:17'),
(1301, 9, 'rRFtdVNxKC9Rr4HbH8YwRsHc7M1nFLxn', '2016-04-14 23:03:07', '2016-04-14 23:03:07'),
(1303, 6, 'Y2sNTVbrwuAglelsi1ajkmpN2VCJpVp8', '2016-04-15 01:06:26', '2016-04-15 01:06:26'),
(1304, 6, 'oa2YnbWRjLrpYSQztJJ2XS06KK0MBxbN', '2016-04-15 01:06:27', '2016-04-15 01:06:27'),
(1305, 6, 'TiGCGUl7tFsBKiPUXMWEcuiQtvQTbs1y', '2016-04-15 02:26:30', '2016-04-15 02:26:30'),
(1308, 6, 'lQGWw02bNU75MUt5WM3gg4PNuUDt6K3Q', '2016-04-15 16:04:06', '2016-04-15 16:04:06'),
(1309, 6, 'vfXpUHjmkuTvTx8NvSjXHcJ4FpzQK1Q0', '2016-04-15 16:04:08', '2016-04-15 16:04:08'),
(1311, 6, '3kHgj9TWcgeefF5YdvM2Sgv9x5fXmjNk', '2016-04-15 17:46:48', '2016-04-15 17:46:48'),
(1312, 6, 'n1WtaIQvOuU2KnejOpcfOAucMIq17svu', '2016-04-15 17:54:01', '2016-04-15 17:54:01'),
(1323, 6, 'nJOfCtKAvWURKYcuQWhhVlZDWrOFQJBh', '2016-04-16 02:56:21', '2016-04-16 02:56:21'),
(1326, 6, 'Ty4Dj9doCymY1elyzWjQJcbg9q20Oxo1', '2016-04-16 16:00:19', '2016-04-16 16:00:19'),
(1327, 6, 'eJCxZAZIsLxM0Ht2kMdpFejkZrXWBSy7', '2016-04-16 16:44:05', '2016-04-16 16:44:05'),
(1331, 6, 'QwTfCgclnEstBDa3YOGEml2WdPdPnYJk', '2016-04-16 19:59:41', '2016-04-16 19:59:41'),
(1332, 6, 'Ghp7NKrMIu2zFcZRpPnrRCYShjED1uZz', '2016-04-16 22:28:36', '2016-04-16 22:28:36'),
(1334, 9, 'pMCVvg9dSBcb08qsMlNSYGBEYAnsgXwX', '2016-04-17 01:07:38', '2016-04-17 01:07:38'),
(1338, 6, 'I5lk990wbzNJSGUv1lbwJCYb6mezp0E5', '2016-04-17 16:30:43', '2016-04-17 16:30:43'),
(1340, 6, 'HhU4nvyvREAeiiKUzDc38UlE5XGB82SF', '2016-04-18 04:43:41', '2016-04-18 04:43:41'),
(1341, 6, 'rME4eanIJ8dbFuvVDOS7kobUW5ZrRfpb', '2016-04-18 15:23:31', '2016-04-18 15:23:31'),
(1342, 6, 'kh5i59AO5i11hthGIUWCrHC8pC04oNF5', '2016-04-18 16:21:26', '2016-04-18 16:21:26'),
(1343, 6, 'cOD1clZUgJXMvmqp1x7rPcsEXh03wDxW', '2016-04-19 00:30:52', '2016-04-19 00:30:52'),
(1344, 6, '64aYg0YjQBoMMgKvcXLJcEHBfaABakL3', '2016-04-19 02:25:07', '2016-04-19 02:25:07'),
(1346, 6, 'FVIzeb3fOIjSdBu9Tom9ODB1qORZpzBE', '2016-04-19 15:00:25', '2016-04-19 15:00:25'),
(1347, 6, 'ziTdQh8NjA2c9Tlt0jnFZCTydBx2vESZ', '2016-04-19 15:44:11', '2016-04-19 15:44:11'),
(1348, 6, 'oauXODqxIILiyGXS5fbvUYTQhFTi0gaT', '2016-04-19 16:12:33', '2016-04-19 16:12:33'),
(1349, 6, 'rbZEyHUnq04dwll8Eq9q2jsvH4rbIqtc', '2016-04-19 16:18:45', '2016-04-19 16:18:45'),
(1357, 6, 'OIYj1SWD52TBVLXQHjOY1C6StZgo5WZY', '2016-04-19 19:26:41', '2016-04-19 19:26:41'),
(1358, 6, '7qnojiRWdCYcQnadO35g1UFs0UMnlhkz', '2016-04-20 01:27:10', '2016-04-20 01:27:10'),
(1359, 6, 'pjMrA0KgZtgbY7AIUjvtj63KNtq7vndn', '2016-04-20 03:13:45', '2016-04-20 03:13:45'),
(1360, 6, '2mFZP0ThjdtgZJ6ulrKg8xpDFer0tOsY', '2016-04-20 16:15:12', '2016-04-20 16:15:12'),
(1361, 6, 'eavtOP8VqKg2S0GBifQaKtuSEFaou3eI', '2016-04-20 18:03:56', '2016-04-20 18:03:56'),
(1362, 6, 'juX58vPW8Q7CgmBFFwooBU9abiS4vOb2', '2016-04-20 18:54:24', '2016-04-20 18:54:24'),
(1364, 4, '13Z97gTgNAvjKmjClLQ14F6mReWI0rvP', '2016-04-20 22:51:44', '2016-04-20 22:51:44'),
(1365, 6, '4YzKotlJc1TII0H9guqhLdfnzlp4mnDm', '2016-04-20 22:52:35', '2016-04-20 22:52:35'),
(1366, 6, 'ut3BgclKyyH2SpiJKXUA6DGV8w7nxVy9', '2016-04-20 23:17:13', '2016-04-20 23:17:13'),
(1369, 9, 'CnrkZmsee3KwhVZW4tR2FE0ziBfBZYAP', '2016-04-21 01:21:11', '2016-04-21 01:21:11'),
(1370, 6, 'S5VvwCAnqKgFcF6XLJ6SggaqRqNVU7af', '2016-04-21 03:25:12', '2016-04-21 03:25:12'),
(1371, 6, '1IIjwo7hxfR88TQpT5Bwd5BezSX2qnsT', '2016-04-21 03:36:46', '2016-04-21 03:36:46'),
(1372, 6, 'hdtfZNjrquUOqQZmJ2Q30T3F871E9VI6', '2016-04-21 15:35:34', '2016-04-21 15:35:34'),
(1374, 4, '7yA0cUU9OOIr69oZr7r6sPdLlB5rk09v', '2016-04-21 19:40:10', '2016-04-21 19:40:10'),
(1376, 6, 'UHn6JSlZvaooveO6WsC9IlBwcgCE3xp8', '2016-04-22 00:31:28', '2016-04-22 00:31:28'),
(1379, 6, 'J2iNHH4vj03yEIkJnBmKZeyuwI8TCN01', '2016-04-22 04:23:21', '2016-04-22 04:23:21'),
(1380, 6, 'RBmtggpgFSVeLhV7A6o2g30G952paxDi', '2016-04-22 15:15:08', '2016-04-22 15:15:08'),
(1381, 6, 'F8SYVvlV1vBSPeAIgKiLTLrWYf1fgCWL', '2016-04-22 16:06:20', '2016-04-22 16:06:20'),
(1383, 6, 'nlFA7LUJRak3Oi1rRQnw3kd7LNx2OcjN', '2016-04-22 17:09:35', '2016-04-22 17:09:35'),
(1384, 6, 'ZRRLuaDMOhzu2tdOsvk7Orq9i1yDq2Gk', '2016-04-22 17:33:19', '2016-04-22 17:33:19'),
(1387, 6, 'rV6FkXRZ7EZBvFODq1tXMqXzWVWSc3xl', '2016-04-23 14:58:17', '2016-04-23 14:58:17'),
(1390, 6, 'UXvhSglonrb1VtUuoYZWQzxhmwGkZI07', '2016-04-23 17:25:22', '2016-04-23 17:25:22'),
(1392, 11, 'JKU47ESAiajpoqpOSIGcHbLjlfg3Guqi', '2016-04-24 02:07:51', '2016-04-24 02:07:51'),
(1395, 6, 'xOgshwmwhpPA1X671ZfAUzCyhO5Bhuoa', '2016-04-25 02:16:34', '2016-04-25 02:16:34'),
(1396, 6, 'fiFAjPXSsaWKEm6AGBA4ErLXBXCDhY2D', '2016-04-25 17:08:25', '2016-04-25 17:08:25'),
(1399, 6, 'CkSYqYwdhLfKxA2FyVqLdVAKbSXX2EyE', '2016-04-25 18:37:37', '2016-04-25 18:37:37'),
(1400, 11, 'u6H45o5AFlcTkmAEiSCiKlLTOhYu5pvI', '2016-04-25 22:26:27', '2016-04-25 22:26:27'),
(1402, 6, 'Slkl60XQIPn3DsVZuaMCroBZLccyBzkA', '2016-04-26 16:42:36', '2016-04-26 16:42:36'),
(1403, 10, 'rkLeSuWo7lVKEkbgKkK8TRwu03lSrbQD', '2016-04-26 16:40:45', '2016-04-26 16:40:45'),
(1406, 6, 'Oe3LHpJLhtaRgqp3LdncKeVXjncBerK5', '2016-04-26 21:25:20', '2016-04-26 21:25:20'),
(1407, 6, 'uiddjhwMFUkEirfmq4IBFxpNOmotWih8', '2016-04-27 03:47:48', '2016-04-27 03:47:48'),
(1408, 11, 'XJqN9dsDXZ0gwUYhP08vBRDreif82BeP', '2016-04-27 14:53:03', '2016-04-27 14:53:03'),
(1409, 11, 'VSZadhrbeOcyKR0x5BEwv9EW1e7W8nEi', '2016-04-27 15:38:16', '2016-04-27 15:38:16'),
(1411, 11, '4QwNTFknfXloM3y9Fh4lCmNehVBXTgo5', '2016-04-27 16:49:00', '2016-04-27 16:49:00'),
(1412, 6, 'v2vi9XgMUyR7pZSCuZUAG5qB8GonqNuQ', '2016-04-27 17:24:26', '2016-04-27 17:24:26'),
(1413, 4, '6lzth60I6zNaXdP07ymvsW2FxMHRMxBF', '2016-04-27 18:02:29', '2016-04-27 18:02:29'),
(1417, 6, '0UJWrPEuF2IPoCFB5IY1A3iF7bayfs14', '2016-04-28 03:49:24', '2016-04-28 03:49:24'),
(1421, 6, 'GIg2KEwVG0RAWEZMd2Qp4U07jylVuQlx', '2016-04-28 16:11:45', '2016-04-28 16:11:45'),
(1423, 6, 'b76AFep9QO7hQWVppFUJxHw8OYQWpYH2', '2016-04-29 01:54:44', '2016-04-29 01:54:44'),
(1427, 6, 'ajhtmm3FBT7Xkgs2QGAnVqQcQ7XCunsB', '2016-04-29 16:28:31', '2016-04-29 16:28:31'),
(1428, 6, 'OP5yzDCOwe5jjLLMpHMkjYG3W12NHqsZ', '2016-04-29 17:11:27', '2016-04-29 17:11:27'),
(1433, 6, 'KIKYpOTNvB5OkFWRSoFpLoeyYwqTbQcO', '2016-04-30 02:48:51', '2016-04-30 02:48:51'),
(1434, 6, 'e5lJNawCLxAOb5pUyfVJcVXwuFCQatee', '2016-04-30 02:56:31', '2016-04-30 02:56:31'),
(1441, 4, 'skBvHNsQNCDttTWgsGa5nLSran5TsBXw', '2016-04-30 18:31:36', '2016-04-30 18:31:36'),
(1442, 6, 'G2Sa6CWypJYtCq1kDfsLKan7gsjlAerp', '2016-04-30 18:57:37', '2016-04-30 18:57:37'),
(1443, 6, 'glM94TwzOt7jZNF2eubPU3Xa7twprlou', '2016-04-30 18:57:37', '2016-04-30 18:57:37'),
(1444, 6, 'PzBheFapnjoTmvy97sbvrmJjaQliFgF0', '2016-05-01 00:00:38', '2016-05-01 00:00:38'),
(1445, 6, 'j4RHKlGecRG5JRQ4cJBOUGxTyDzrPaQr', '2016-05-01 01:59:54', '2016-05-01 01:59:54'),
(1446, 6, 'JokXBLtfHOwDC2h9FIF9k0HEBuBWsIS1', '2016-05-01 06:17:35', '2016-05-01 06:17:35'),
(1447, 6, 'Qb1yJBr9fkjCv7yvVUaruxxiZxhGRb7j', '2016-05-02 16:00:09', '2016-05-02 16:00:09'),
(1451, 9, 'HwRjL1d37vZ7Hmp8Sr3n716FnmmwzWNM', '2016-05-02 22:44:23', '2016-05-02 22:44:23'),
(1454, 6, 'ZDfK1WdG89XpHKAG3HNqOH8EXhpHnYP9', '2016-05-03 05:42:10', '2016-05-03 05:42:10'),
(1455, 6, 'Hg0vtc2KJAeTaFzBaSEspiFADyI8oojs', '2016-05-03 15:10:48', '2016-05-03 15:10:48'),
(1457, 6, 'hvcW3Jp6Evxx1JuoG7rWSheYBnS7wCTa', '2016-05-03 17:23:25', '2016-05-03 17:23:25'),
(1458, 4, 'NvQY6K1ejZMgWPDAfo6bqCTIBX9salUw', '2016-05-03 17:24:05', '2016-05-03 17:24:05'),
(1459, 6, 'QWOb2UjA1CornGhq4uP9lc1tyavopu4K', '2016-05-03 21:49:07', '2016-05-03 21:49:07'),
(1460, 6, 'b6FZs4rkvEDNeQpCgYduwfTe3ALEfERt', '2016-05-03 21:49:08', '2016-05-03 21:49:08'),
(1462, 6, 'J6N64vMYawvw6vIqkMSKBXmtNnDdNGtP', '2016-05-04 02:38:00', '2016-05-04 02:38:00'),
(1463, 6, 'RxR5Lq5qLatYJd4nABXn5kVd8F28naiC', '2016-05-04 03:37:10', '2016-05-04 03:37:10'),
(1465, 4, 'y9YJkelkuBJdB84lVz4ugiVjrN8wz1mu', '2016-05-04 17:06:09', '2016-05-04 17:06:09'),
(1466, 6, 'uN5hRWe79H8AtDD1Aj33yYI5M9PXW5w6', '2016-05-04 17:18:29', '2016-05-04 17:18:29'),
(1468, 6, 'XoGLMndYLx58k14F8c0flBXQnsEGuJHW', '2016-05-04 22:56:31', '2016-05-04 22:56:31'),
(1470, 6, 'R8kW2ofCsA3oUa67Yly7F7lhQiSIIJXT', '2016-05-05 01:35:48', '2016-05-05 01:35:48'),
(1471, 6, 'IMaO0tBvPC5LFOkoD2VBCWkBasUAzlt4', '2016-05-05 16:10:54', '2016-05-05 16:10:54'),
(1473, 6, 'DdjxVusQsClVejxn9hje15CufIWGVGXz', '2016-05-05 20:51:21', '2016-05-05 20:51:21'),
(1476, 6, 'NLdHv2dV544vVZKUy9mSIiWei4NBIBfo', '2016-05-05 22:51:24', '2016-05-05 22:51:24'),
(1478, 6, 'MXKbBqA1SLiviecG96MwXM6rPjJ1CkMp', '2016-05-06 16:12:40', '2016-05-06 16:12:40'),
(1480, 6, 'EbITxef7e3VY8WJn0aXDEjTh5reLVVvf', '2016-05-06 17:27:11', '2016-05-06 17:27:11'),
(1483, 6, 'pQ5hMD16UNAEvThrCVZkOZSiqZaPkPUl', '2016-05-07 01:14:45', '2016-05-07 01:14:45'),
(1484, 6, 'b1w7sDjgouyJGov8oQBkvzTJpqT3mAB0', '2016-05-07 04:15:59', '2016-05-07 04:15:59'),
(1485, 6, 'qFJmmGAZXhNoo5sJVyEDAdmCunQbDdyI', '2016-05-07 14:45:05', '2016-05-07 14:45:05'),
(1486, 6, 'XAmWgpBie59C0N7psSduhhpAX7jrzPNq', '2016-05-07 14:48:17', '2016-05-07 14:48:17'),
(1487, 6, 'bVuaJhkbcRfVfXlXAOlvwnteKtmuy5iv', '2016-05-07 14:57:12', '2016-05-07 14:57:12'),
(1489, 6, '9sAKFVSYeLccfVH2cLpAECb5Yxa7rOv3', '2016-05-07 17:12:15', '2016-05-07 17:12:15'),
(1493, 6, 'zfOMoBGfvM0PQFm1cMW3n1Fat3MNy4zy', '2016-05-07 22:52:02', '2016-05-07 22:52:02'),
(1495, 6, 'b05KdEW6jMVMBRnBbBqqXibmx9ygSNdl', '2016-05-08 02:31:10', '2016-05-08 02:31:10'),
(1496, 6, 'dmzefZYYns9sJKt4KuBQ8aaFgclxGyeS', '2016-05-08 16:43:28', '2016-05-08 16:43:28'),
(1499, 6, 'G9hl28GzDqma1QhTT8q8P0FFqETjaNap', '2016-05-09 03:06:53', '2016-05-09 03:06:53'),
(1500, 6, 'DL2hOvEHhhYmkbMzv6sXdAoLB3hQRRJL', '2016-05-09 16:09:25', '2016-05-09 16:09:25'),
(1502, 6, 'QgRouCt8vvjPdaLFFXy7sZ87sIIwMpLt', '2016-05-09 17:20:05', '2016-05-09 17:20:05'),
(1505, 6, 'cyTX8FmyibXDpTiAGq9wdccbvTeIJbCU', '2016-05-09 18:43:33', '2016-05-09 18:43:33'),
(1506, 6, 'K4WHXXfb9uY7xp4azKEWCRCfjRAHTNJV', '2016-05-09 19:18:22', '2016-05-09 19:18:22'),
(1507, 6, 'cpiBDNzzX1j8wEdkVv4T0nn8NRfPK3Lx', '2016-05-09 22:47:17', '2016-05-09 22:47:17'),
(1508, 6, 'N76q74LDjlaJFtJCOfi8JQxGcRVvsSgl', '2016-05-10 16:38:48', '2016-05-10 16:38:48'),
(1510, 6, '5pfN3VfQM8kuaYqLH4y9YQR921GV2GQ8', '2016-05-10 17:45:09', '2016-05-10 17:45:09'),
(1512, 6, 'YfheX24uwhjsoors2WKyaRAPJm6XZIqu', '2016-05-11 02:52:30', '2016-05-11 02:52:30'),
(1516, 6, 'T1Bf9qPgRShZBXtyE31WCwU8Pa2Y0Q2J', '2016-05-11 03:41:53', '2016-05-11 03:41:53'),
(1517, 4, 'De2rSahXW6ldyvdYGcd7v4yFzEhAqa66', '2016-05-11 04:02:54', '2016-05-11 04:02:54'),
(1518, 6, 'SAnDytzeBEeVvXXj1Qv0AzBXweP9xYRn', '2016-05-11 16:18:29', '2016-05-11 16:18:29'),
(1520, 6, 'SBL1kd8fFwf3CuYhreWdANVhiX5HLh2C', '2016-05-11 17:58:36', '2016-05-11 17:58:36'),
(1521, 4, 'RbEqgVfvhLwm1XYQRHqb4zNcteSuNpnR', '2016-05-11 18:11:26', '2016-05-11 18:11:26'),
(1522, 6, 'QEScqCTwVnOr8WaKRnpecJyrqzUrp93d', '2016-05-11 20:05:57', '2016-05-11 20:05:57'),
(1525, 3, 'KIFBytUdyjV3XjNX6ekZe2rgePPWRHT7', '2016-05-11 22:17:02', '2016-05-11 22:17:02'),
(1533, 6, 'kdzOzHUdhMDtOiCnAlBWeW0IxCqEMpF8', '2016-05-12 02:24:28', '2016-05-12 02:24:28'),
(1535, 6, '1yuja1Yqm0Qgy666dxDeGDoagRiNubU3', '2016-05-12 16:22:55', '2016-05-12 16:22:55'),
(1537, 4, 'NsRUJghySiP3Ai7uR8y4np3HbsBMfR9w', '2016-05-12 17:32:14', '2016-05-12 17:32:14'),
(1538, 6, 'pm8LLm8eW1dBKeyFgNQxXkoKkUohOPTj', '2016-05-12 17:36:42', '2016-05-12 17:36:42'),
(1539, 6, 'nC4nAjqr0mLqXlOLDG3ksfQdEsAIiTBW', '2016-05-12 23:20:39', '2016-05-12 23:20:39'),
(1540, 6, 'lXIlnebNLF2XBCH3gGPEeCN1YGcFdJVe', '2016-05-13 03:05:29', '2016-05-13 03:05:29'),
(1541, 6, 'aWaEZbVN0UUa8rafUTjGU0gX31HvxIwl', '2016-05-13 03:51:23', '2016-05-13 03:51:23'),
(1542, 6, 'yrfu4wxPJYtjeYH8Vawu1q9BVqD4KxDd', '2016-05-13 15:57:47', '2016-05-13 15:57:47'),
(1543, 6, 'OwJWuKXzlmiEaL8j1yognW1qnVfHE9HV', '2016-05-13 17:42:30', '2016-05-13 17:42:30'),
(1549, 6, '2BT4zwfArB4RSD13piRMjxz3SNz2vbNk', '2016-05-14 01:32:22', '2016-05-14 01:32:22'),
(1550, 2, '0zc3N2arlchUM6CyQvqFhAupqzh6jlC3', '2016-05-14 05:03:20', '2016-05-14 05:03:20'),
(1551, 2, 'l9WYah2JUr7FfrLO32rj50SQ9BCvKJyX', '2016-05-14 05:26:28', '2016-05-14 05:26:28'),
(1552, 6, '8hQfGbc7NKI6JvszoIMbJxmPhHs7t59g', '2016-05-14 17:07:40', '2016-05-14 17:07:40'),
(1553, 6, 'rPLBD5VJyQ4UnzVKoTIv8TXKxk9Swkc1', '2016-05-14 17:57:37', '2016-05-14 17:57:37'),
(1554, 4, 'qJ541uWibcxS7O8WNPm6Ai9UUcN6VsuF', '2016-05-14 17:59:55', '2016-05-14 17:59:55'),
(1555, 4, 'wnnvI3hY62gdzN5cy9WQP7qlbTWeDGPs', '2016-05-14 19:46:42', '2016-05-14 19:46:42'),
(1556, 11, 'jjVuVFjH7dXNabgk4v3is29Cw33xGMrz', '2016-05-15 01:29:40', '2016-05-15 01:29:40'),
(1557, 6, 'oulgsc4ldday7TCrc6O8l2j13rXJW1u7', '2016-05-15 03:29:16', '2016-05-15 03:29:16'),
(1558, 6, 'Gvc9yW5GFIEoZweQgK0ZqJOsLPH4lmh1', '2016-05-15 17:43:50', '2016-05-15 17:43:50'),
(1559, 6, 'ZEK2BWRSIeo0IDWwDKSLj4X8yqIz79td', '2016-05-15 18:41:04', '2016-05-15 18:41:04'),
(1560, 6, 'GREeEohYfmJpL5FKQ1JFir4c3TxqlR6X', '2016-05-15 19:28:42', '2016-05-15 19:28:42'),
(1561, 6, '6jkNAvCeVSbFPMz2OOn8O7wnPrlRKaGA', '2016-05-16 16:18:05', '2016-05-16 16:18:05'),
(1562, 6, 'DQbP8P2UQfOtn2F2Z9NgrtJBPV8MQaiH', '2016-05-16 17:03:35', '2016-05-16 17:03:35'),
(1566, 4, 'GAI8goRwXK6EbLPefnLGjmOtojrZ53sp', '2016-05-16 18:14:42', '2016-05-16 18:14:42'),
(1570, 6, 'VdmloJU4k7ermAvdw0AFzXiI2HZAxK7q', '2016-05-16 23:47:11', '2016-05-16 23:47:11'),
(1571, 6, 'vkVGIqsGoNkoYoBXJTkYQT9q7KPCUXqq', '2016-05-17 00:29:11', '2016-05-17 00:29:11'),
(1572, 6, '4QgC5RC8pd12Zmlvj5qzD9AkD5wuGqm6', '2016-05-17 16:16:35', '2016-05-17 16:16:35'),
(1574, 6, '1bGVbh3gNXbYfLBbT32wFz6LANiIRKUp', '2016-05-17 17:26:44', '2016-05-17 17:26:44'),
(1575, 6, 'XqgYeVyH9aFlKn1MCxVcXOiMxAsJn6mZ', '2016-05-18 02:12:53', '2016-05-18 02:12:53'),
(1576, 6, 'xLvaIgAiCUxW1J0nnQ1z1xibPB3C9UP4', '2016-05-18 14:52:30', '2016-05-18 14:52:30'),
(1577, 6, 'EL9AKwTjDInY8TftQFM2UEVCG73gihBQ', '2016-05-18 16:12:09', '2016-05-18 16:12:09'),
(1579, 6, 'tLJvPoFsZOixWytDJ2R3ZJRCIypMUflT', '2016-05-18 17:47:40', '2016-05-18 17:47:40'),
(1580, 6, 'AmfErWX8JhyjCPKOS47txEx8ybIsplYG', '2016-05-18 18:53:38', '2016-05-18 18:53:38'),
(1583, 7, 'NN2yUkKmZlHSt3XS9Q69DkN4Aw993ZID', '2016-05-19 07:32:12', '2016-05-19 07:32:12'),
(1584, 6, 'egfS298BatShUw5OW6gL1pvFTK5dXsKc', '2016-05-19 14:25:53', '2016-05-19 14:25:53'),
(1585, 6, 't71vezEZvOLXypY6lEkGZ10icS8aIapm', '2016-05-19 16:12:21', '2016-05-19 16:12:21'),
(1586, 6, 'ETGM4ywlZxAyelsLQZqTZbkWJU8Xappr', '2016-05-19 17:14:33', '2016-05-19 17:14:33'),
(1599, 6, '4bt4Z6HGsvciUN5jyEL3alAcBAZ0vST6', '2016-05-20 02:12:10', '2016-05-20 02:12:10'),
(1600, 6, 'uJUZYtmjJx3tm28p2kDTv8fgps9UkZ1X', '2016-05-20 14:35:04', '2016-05-20 14:35:04'),
(1601, 6, 'xRVSyToKKwps87mNiLpgRJTPUWnP7IUi', '2016-05-20 16:28:11', '2016-05-20 16:28:11'),
(1602, 11, 'xEtcKmcO5JcPdhHdmbQyJW0zTCTz1Rdx', '2016-05-20 18:25:53', '2016-05-20 18:25:53'),
(1603, 6, 'Bq2AT9BpfgfphVkpYM8o77csD9WmxzVB', '2016-05-21 05:00:08', '2016-05-21 05:00:08'),
(1605, 6, 'dakrM1kior3losR1mNviS4ueaI94WEDO', '2016-05-21 14:34:37', '2016-05-21 14:34:37'),
(1606, 6, 'd4AdIIZ9bAEPiSaKfT0ZK4q4L9NSTrNi', '2016-05-21 15:11:50', '2016-05-21 15:11:50'),
(1607, 6, 'cBgZqSUeRfemU0pDiMzmZHQgzukIkxbu', '2016-05-21 15:50:29', '2016-05-21 15:50:29'),
(1608, 6, 'FxqBKJDr4WpNDKS4dNQLSZsXo9frJBHs', '2016-05-22 06:23:58', '2016-05-22 06:23:58'),
(1610, 6, 'Z0PJZ4JYrgWufoobzHZIw0cSycYdmdUK', '2016-05-22 16:42:08', '2016-05-22 16:42:08'),
(1612, 6, 'D171t0p6fB6tp5UzQuGmMJuT9164kxt5', '2016-05-23 03:49:53', '2016-05-23 03:49:53'),
(1613, 6, 'JN2pKGdg3ET1GlfJPFxr22TQOu4GjlqI', '2016-05-23 06:11:32', '2016-05-23 06:11:32'),
(1614, 6, 'uJTB6ZfyNRXnFC0dxfhZi2IiJR7Ri0TZ', '2016-05-23 06:11:44', '2016-05-23 06:11:44'),
(1615, 6, '9yBwXtkzZ9FkDk3SfSMhtCwatZlVyb9P', '2016-05-23 15:24:40', '2016-05-23 15:24:40'),
(1616, 6, 'J0IOuZsezV9v9tqSRQkfvg67F4QkEaW9', '2016-05-23 15:29:58', '2016-05-23 15:29:58'),
(1617, 6, 'QwUjZGCqgA7lTSsgYQd3zJkLZrZUKL5W', '2016-05-23 17:40:39', '2016-05-23 17:40:39'),
(1618, 6, 'Z7Vr38u0pxSCCSnWT0MXgmRdbXbU0LkZ', '2016-05-23 17:43:08', '2016-05-23 17:43:08'),
(1619, 6, 'XTsRokRXmcSFKeK8O4JG4bxGVPZbJKdO', '2016-05-23 21:41:03', '2016-05-23 21:41:03'),
(1620, 6, 'WLUpPWFg2G56ckfw2pjggHw86fK9pYwA', '2016-05-24 04:17:47', '2016-05-24 04:17:47'),
(1621, 6, 'N76R61TeATsIvUXltBPBO0gyd09h5KzG', '2016-05-24 05:57:36', '2016-05-24 05:57:36'),
(1622, 6, 'O6Ik0VsLDq4cuInXT2RmSKUwBQoiqVXV', '2016-05-24 14:21:07', '2016-05-24 14:21:07'),
(1623, 6, 'DzIych1kLGMhFVuIimUSCd2WpQaSUJVp', '2016-05-24 16:57:58', '2016-05-24 16:57:58'),
(1625, 2, 'U7YnSrKhwUZdvxjnzHtwMOm8XQDWEMhH', '2016-05-26 17:40:10', '2016-05-26 17:40:10'),
(1626, 4, 'a60TD3aWexfHQ0Rj7FD80hYk64lrJaM1', '2016-05-26 17:47:04', '2016-05-26 17:47:04'),
(1630, 6, 'Tl6pjn3U6QgK6DmTAWTHb0iRckZTmCZS', '2016-05-27 05:19:23', '2016-05-27 05:19:23'),
(1631, 6, 'jUTvVnPGNJudLpwz8GDrnbeuKbHdhld4', '2016-05-27 07:36:00', '2016-05-27 07:36:00'),
(1632, 6, '5JaSobFyEyNg1deb5P51AzSTEwPG4Vqp', '2016-05-27 15:15:16', '2016-05-27 15:15:16'),
(1633, 6, '65yk2dPUfngz5dvFw80uic2NqcV4lREg', '2016-05-27 16:11:22', '2016-05-27 16:11:22'),
(1634, 6, 'edTj0b5aLACmEqDHDW7aOrzmEpMwJiFg', '2016-05-27 16:48:04', '2016-05-27 16:48:04'),
(1635, 6, 'mIICIPJTedVzs2DwycUsVSjuJiL6xVgy', '2016-05-27 17:13:21', '2016-05-27 17:13:21'),
(1636, 4, 'NR4GVgJbC4YVMvjavojWkrlo15E7nuip', '2016-05-27 17:42:14', '2016-05-27 17:42:14'),
(1637, 6, 'eyxTV7Q0GGgQHrcS2M5L71m5gwkVXddZ', '2016-05-27 18:00:44', '2016-05-27 18:00:44'),
(1638, 6, 'TbrMjyrIE3vJFEeE5kQ5yWpnM5qWt9ys', '2016-05-27 19:49:57', '2016-05-27 19:49:57'),
(1639, 6, '8u7sLG3hftYyb66iWvJqjo6MQuHCNbH7', '2016-05-27 20:45:56', '2016-05-27 20:45:56'),
(1643, 6, 'J4ZjTtyII5C6ZW4fMddbPiHbdK2ofa4s', '2016-05-28 17:08:58', '2016-05-28 17:08:58'),
(1645, 6, '3DgRkJjBMkOgluWn5OfPeBbgGQbCCiAW', '2016-05-28 18:25:18', '2016-05-28 18:25:18'),
(1646, 6, 'PJZ8MjWViduu6L6FClmIfCbXkUZHxOqX', '2016-05-29 01:54:25', '2016-05-29 01:54:25'),
(1647, 6, 'UpzXTb8f9qU08z8Yi36beyAjWti9Jycb', '2016-05-29 02:30:37', '2016-05-29 02:30:37'),
(1648, 6, 'yLcgKW0S6MA2jDZFEiexfDCjjqV2BFHU', '2016-05-29 05:19:16', '2016-05-29 05:19:16'),
(1649, 6, 'RDMsoSSIhKa00AXmuADRxUukyAtQZFxT', '2016-05-29 16:52:01', '2016-05-29 16:52:01'),
(1650, 6, 'd0gK6ptKL39BAEJZirtzdNfnPGPYOfkQ', '2016-05-29 17:13:01', '2016-05-29 17:13:01'),
(1651, 6, 'pCSppk0swca8GoCGpK5maKNFLb8ndL5I', '2016-05-29 17:22:18', '2016-05-29 17:22:18'),
(1653, 6, '2bg16jbSSkXcasJhVz2bWhFhCRlBbX6N', '2016-05-29 20:23:49', '2016-05-29 20:23:49'),
(1654, 6, 'yfsNIYJEWlbvlOE3wW6JMQHzjyBomFPJ', '2016-05-30 02:11:02', '2016-05-30 02:11:02'),
(1655, 6, '3iewRkwzJtAD2EBnKas5IVq7MRxwtfi7', '2016-05-30 02:38:33', '2016-05-30 02:38:33'),
(1656, 6, 'wX9uWpeiUaZ8BIVHgbJfS6GaT1r3Wa2z', '2016-05-30 16:19:57', '2016-05-30 16:19:57'),
(1657, 6, 'Ze0Ta22X24FWVliXtuJKxk7uBYVg6BkF', '2016-05-30 17:29:36', '2016-05-30 17:29:36'),
(1658, 6, 'TDQK0q4fYNuiV9KbVuVwhPO3hytAYKJU', '2016-05-30 22:29:04', '2016-05-30 22:29:04'),
(1660, 6, '4wPhUNdsBUzDUgkjMH6uBqO3U6e2TB4I', '2016-05-31 02:32:15', '2016-05-31 02:32:15'),
(1661, 6, 'GhWlocts5Bby1bczQXYceyP0i7347GfT', '2016-05-31 05:25:35', '2016-05-31 05:25:35'),
(1662, 6, 'fr8tda2hNEYRdJB7UV5eSGFmFQ6FlxL8', '2016-05-31 15:16:03', '2016-05-31 15:16:03'),
(1663, 6, '7aeEwYrf8sgS70CItumPDfGiRPSHY6NV', '2016-05-31 16:58:15', '2016-05-31 16:58:15'),
(1664, 6, 'jlyXpEfyFC9oGu5DN0pUb71qpC4RUWw2', '2016-06-01 01:22:50', '2016-06-01 01:22:50'),
(1665, 6, 'fJVtxBhuXBhBkaxormrxkp70sWNoESvD', '2016-06-01 15:00:19', '2016-06-01 15:00:19'),
(1666, 6, 'gnlCt5zlF7zBTqdVBDxK01E9I745GUA6', '2016-06-01 16:04:05', '2016-06-01 16:04:05'),
(1667, 6, 'bcOfjPTwRIXTPNmrp9Av4B65SHvISoSC', '2016-06-01 21:00:35', '2016-06-01 21:00:35'),
(1668, 6, '0vIpIRsb1wNItvyXhWpFJuMGBHfc57Ba', '2016-06-02 01:44:27', '2016-06-02 01:44:27'),
(1669, 6, 'VVApQx6zrK1s2trYpHwEIp9H4fZ0Be9n', '2016-06-02 14:51:43', '2016-06-02 14:51:43'),
(1670, 6, 'eYKrdsXicMrv1jOdFVhrJj5zXQaM2lEm', '2016-06-02 15:19:05', '2016-06-02 15:19:05'),
(1672, 6, '7QeLMGreVBeLQTYNlbudrswdlKmxcwIR', '2016-06-02 22:40:00', '2016-06-02 22:40:00'),
(1683, 6, 'i3VSI5c5PQSmP8FWaLLUYjD1gyDfvUh5', '2016-06-03 01:00:45', '2016-06-03 01:00:45'),
(1684, 6, 'np2qnkIvf9DvBFcfxTekjHVAPzxye1WE', '2016-06-03 03:01:11', '2016-06-03 03:01:11'),
(1685, 6, 'KlvxpKVLyx5ScYjj5iOAqW3WVXJM4FvN', '2016-06-03 03:21:18', '2016-06-03 03:21:18'),
(1686, 6, 'dTLThKZ4RxHeDl4j9CuQSSSPf3k0tgRd', '2016-06-03 16:34:46', '2016-06-03 16:34:46'),
(1688, 6, 'RnPrOXtq6GZCipCCLKcMU0Y30jENnIbv', '2016-06-03 20:27:00', '2016-06-03 20:27:00'),
(1692, 6, 'rjQx7m4AIqb7TmUoDhDuy21xgAyoY3Cy', '2016-06-04 03:32:09', '2016-06-04 03:32:09'),
(1693, 6, '3INnlofNaOPczMo2VM2UaK28vXXYlAzH', '2016-06-04 14:59:28', '2016-06-04 14:59:28'),
(1694, 6, 'aT53y9hq0TYzUA2cWDc2ibqGpCMcBjkt', '2016-06-04 15:17:37', '2016-06-04 15:17:37'),
(1695, 6, 'zhFTpDLpEFan9PzeiikjoTJFTMsNJ6KS', '2016-06-04 16:09:50', '2016-06-04 16:09:50'),
(1697, 6, '4y5K1hfwp54cr4xaaOrQBK6Y9CrDfp0r', '2016-06-04 19:22:18', '2016-06-04 19:22:18'),
(1701, 6, 'kRbC8Sqdlc9WVo3LkNPtxtf2qPoq4uzK', '2016-06-05 15:00:32', '2016-06-05 15:00:32'),
(1703, 6, '9NCF18N2c5pi68IAzeZI1beKmeTBC8Hh', '2016-06-06 03:04:10', '2016-06-06 03:04:10'),
(1704, 6, 'CAknjiDHqWWERgbTW2MKIS6sp07FU3We', '2016-06-06 15:59:46', '2016-06-06 15:59:46'),
(1707, 4, 'rIavYvEtLJPCgiY68g4MoTBOyvQfcz7k', '2016-06-06 22:15:14', '2016-06-06 22:15:14'),
(1709, 6, 'NTg9d0XRV0HJUi98Miog1fJKDC6wX97F', '2016-06-07 00:46:15', '2016-06-07 00:46:15'),
(1710, 6, 'yRTWGRdjKLf2aztO7bYj2aLRqqv95TYp', '2016-06-07 15:05:22', '2016-06-07 15:05:22'),
(1711, 6, 'XBeA9fwwYu060GgSibj1YMBlZsAxG4n6', '2016-06-07 16:18:31', '2016-06-07 16:18:31'),
(1713, 6, 'llYNPaVjtJ7kW4w7YCyBxdIEmXbIkYHc', '2016-06-07 17:52:34', '2016-06-07 17:52:34'),
(1714, 6, 'Oq7XZEv9vq6VaVnNXgsXs50Jv0LdfiCj', '2016-06-07 23:56:25', '2016-06-07 23:56:25'),
(1715, 6, 'JzDHXXvqBpTVxD7sP02VgP2WvxZUpSLD', '2016-06-08 14:56:42', '2016-06-08 14:56:42'),
(1716, 6, 'QTVD6ZeRhIg4ditJ3YTcwMSlc1XCKK3R', '2016-06-08 16:24:18', '2016-06-08 16:24:18'),
(1720, 6, 'jKpGxT6MICyz7AdILxxBqCnRa03QvfbS', '2016-06-08 18:46:00', '2016-06-08 18:46:00'),
(1721, 6, 'nkoUuNClqDjwMIg8Ny44Q9yT30tbHR9g', '2016-06-09 06:51:14', '2016-06-09 06:51:14'),
(1722, 6, '8NSxbrwLKtcTzmFcMU6gIKlVUYEkQzWf', '2016-06-09 07:12:14', '2016-06-09 07:12:14'),
(1723, 6, 'iUodeieeliBVOm6Be4Qw4ISSf79njJSq', '2016-06-09 14:47:03', '2016-06-09 14:47:03'),
(1724, 6, 'V1mC7SdCj7DupXblCazxDFjcpQZTYLcZ', '2016-06-09 16:10:44', '2016-06-09 16:10:44'),
(1725, 6, 'XSwQCs4675gyuZ2YEH5p16df1EU5XAQX', '2016-06-09 23:51:56', '2016-06-09 23:51:56'),
(1726, 6, 'KIZkPL8nf19OoGnhy6X5sGpjqMcjxt8T', '2016-06-10 07:41:22', '2016-06-10 07:41:22'),
(1727, 6, 'u38JqPU35cniLCBfNWS5qp3vCh7yMEpl', '2016-06-10 13:43:07', '2016-06-10 13:43:07'),
(1728, 6, 'oh8vRbpZIw4VP6po0FNssZLwn97nIDAC', '2016-06-10 16:04:05', '2016-06-10 16:04:05'),
(1731, 6, 'e7rbqAoMVpvHe0eUJLfVKOyQDIr03Ruf', '2016-06-10 23:46:01', '2016-06-10 23:46:01'),
(1732, 6, 'N66z75xJNTQK4JxXBxHKJ2yXDP94wy48', '2016-06-11 02:11:02', '2016-06-11 02:11:02'),
(1733, 6, 'Il9VkO61z573L3kG4HB2EGm4cnuZhwmb', '2016-06-11 15:44:22', '2016-06-11 15:44:22'),
(1734, 6, 'lat3ZLpccSJZEbshTA2kvAen5Wcz895s', '2016-06-11 17:06:00', '2016-06-11 17:06:00'),
(1735, 6, 'pNiMYSkDdDHr8epr6W38j2HDXggGdQo4', '2016-06-12 02:25:53', '2016-06-12 02:25:53'),
(1737, 6, 'Lgk50LOJ3Wpvv2ZdBmxYUP69d0e7aTkF', '2016-06-12 06:27:21', '2016-06-12 06:27:21'),
(1738, 6, 'sWXpKvEV0Bx7c6LV8HOxKPzl39Z97s17', '2016-06-12 15:36:09', '2016-06-12 15:36:09'),
(1739, 6, 'YMYQNE0Vf1pU7gmBV8zIipCQqhILv7kS', '2016-06-12 16:38:27', '2016-06-12 16:38:27'),
(1740, 6, 'U7Y1nHVemDMdofuSVXh3Tn25AneC4CZm', '2016-06-12 17:45:13', '2016-06-12 17:45:13'),
(1741, 6, 'ueNJZnICc014tmdfqPjITEB9p7nqVgsl', '2016-06-12 19:01:56', '2016-06-12 19:01:56'),
(1743, 6, 'tyvgOroKNRLUsXQFevVTI8hZFUXD4R1h', '2016-06-13 15:20:35', '2016-06-13 15:20:35'),
(1744, 6, 'psoffr6aJGSD8kMVpiOamRJfM1qx9gSu', '2016-06-13 16:47:05', '2016-06-13 16:47:05'),
(1745, 6, 'WsTgIENc1FMjOKjD8oOrpO94Le0OR6yQ', '2016-06-13 21:10:11', '2016-06-13 21:10:11'),
(1746, 6, 'p41rVNsJNNUPgTDla7UywP23jVsBMPBj', '2016-06-14 15:14:59', '2016-06-14 15:14:59'),
(1747, 6, 'XTgxnbYFQKbohMXnzapxoYMaebe8v1rz', '2016-06-14 16:31:06', '2016-06-14 16:31:06'),
(1748, 6, 'hNH2sL3akUmQkxd7EXteB97qzFI2kjoe', '2016-06-15 02:59:47', '2016-06-15 02:59:47'),
(1749, 2, 'Ii3ASfvWr3tpiYhZdpgF2IQDItNUoNT9', '2016-06-14 18:17:39', '2016-06-14 18:17:39'),
(1750, 2, 'yakJlS3TzzshXsyZPKux90bwr5Ov4qOT', '2016-06-15 16:13:54', '2016-06-15 16:13:54'),
(1774, 10, '51XPgGurk6LR1G5ebrWIOXeHe1arUXje', '2016-06-20 18:22:52', '2016-06-20 18:22:52'),
(1778, 1, 'd6aK12DcTVWj9wU0ENOKdTIaMVR3kIzl', '2016-07-20 09:32:31', '2016-07-20 09:32:31'),
(1780, 1, 'zMyQK4LJil5AwzOTBbHJRQHfvKvoeK9i', '2016-10-02 06:47:00', '2016-10-02 06:47:00'),
(1781, 1, 'ykRz5Mlj7lIqlLO2712fRjQQnLOLfke0', '2016-10-02 07:21:57', '2016-10-02 07:21:57'),
(1782, 1, 'vActUwFwuFgGoEZF6N0cqWkkdTCXHRBQ', '2016-10-02 10:15:02', '2016-10-02 10:15:02'),
(1783, 1, 'uRC7rnpKjYqdKVTDSnj1x644mbNsJFAo', '2016-10-02 10:54:33', '2016-10-02 10:54:33'),
(1784, 1, 'kfFv9lPHM7atTFU4Hs11HeRsFVPcpg5r', '2016-10-02 11:30:01', '2016-10-02 11:30:01'),
(1785, 1, '1Nzz6MgzqrMOY2sE3JEXReUO9KD6LXGI', '2016-10-02 11:36:24', '2016-10-02 11:36:24'),
(1786, 1, 'LSZrtjeU93LP3xHlxSiIYOIFb8WN1J5v', '2016-10-02 17:18:11', '2016-10-02 17:18:11'),
(1787, 1, 'x6O7xSIzrKf7bNTdKHnMUgcek5mWeGun', '2016-10-02 17:44:47', '2016-10-02 17:44:47'),
(1788, 1, 'Z61BKu0wKxYaVm44fqf5nliq7jcvHuup', '2016-10-02 18:38:06', '2016-10-02 18:38:06'),
(1789, 1, 'YT7TqmFzNuusH66ZzSMhq9ey8KVdwv4C', '2016-10-03 12:56:04', '2016-10-03 12:56:04'),
(1790, 1, 'XfMjjEO2OzvOQJIi03PwSs9JABWn6zyl', '2016-10-03 18:29:57', '2016-10-03 18:29:57'),
(1791, 1, 'Xl9sP6HG3LsHxcIHFGAcS2R8XPdw00fd', '2016-10-04 05:58:56', '2016-10-04 05:58:56'),
(1792, 1, 'RO7hysGgpdKupkOmqtiQ8OykJIaD1uC1', '2016-10-04 16:12:14', '2016-10-04 16:12:14'),
(1793, 1, 'a01sEYtUqfKmg7cOH9vlJCy5GRGkkLpG', '2016-10-04 18:06:24', '2016-10-04 18:06:24'),
(1794, 1, 'QMrE67MquYmFfYBazI1nLm7c0mAKnxgf', '2016-10-05 15:22:56', '2016-10-05 15:22:56'),
(1796, 1, '3Jso1hVczkLG5uKXluEum3USK0Ndod7G', '2016-10-10 12:34:48', '2016-10-10 12:34:48'),
(1798, 1, 'X1cv81uGRPryzPJjvoIM4Roor79U0VFQ', '2016-10-12 14:34:06', '2016-10-12 14:34:06'),
(1799, 1, 'YnOVyjMlPiDMmbx1bx8PjRIO2hUbZUMW', '2016-10-13 07:45:04', '2016-10-13 07:45:04'),
(1800, 1, 'Rw3OrxHchlAniPRX9fAD28Cn93ul1quD', '2016-10-16 08:11:09', '2016-10-16 08:11:09'),
(1801, 1, 'PzrlMfXWh1nb8afnLCoAxd5GwQoNRkyD', '2016-10-16 10:00:36', '2016-10-16 10:00:36'),
(1802, 1, 'yaoiVruda2wepeBYF4SWAXKueI0kSa7m', '2016-10-16 13:29:35', '2016-10-16 13:29:35'),
(1803, 1, 'y17iQmVQLovzbFYzhIrxyUSDvoUd7gd6', '2016-10-16 18:24:26', '2016-10-16 18:24:26'),
(1804, 1, 'CtrenudlUHi9IqIDC6TdeDbgSI4ktX1C', '2016-10-17 15:26:58', '2016-10-17 15:26:58'),
(1805, 1, 'ZxcUka3bsRo9rIKDbFfQ3fIV0bqCV8RA', '2016-10-18 15:49:41', '2016-10-18 15:49:41'),
(1807, 1, 'DIsKmXHbVlgjgPdbXDyVza8sXm5hHbma', '2016-10-18 17:56:52', '2016-10-18 17:56:52'),
(1808, 1, '3RhDs3czpm5FsNmnHpmPpll6834Drf4d', '2016-10-19 16:32:27', '2016-10-19 16:32:27'),
(1809, 1, 'cDghW3RQln4TiuaYQvF1faKozo2zCtfA', '2016-10-19 16:55:29', '2016-10-19 16:55:29'),
(1810, 1, 'HgWxrqhq4r98DNwCdI5lQ5LP2hxyrqSm', '2016-10-22 17:20:48', '2016-10-22 17:20:48'),
(1811, 1, 'UcLoWtACf9J8MLkTXF0xpV1DgbIMIb1V', '2016-10-22 18:28:53', '2016-10-22 18:28:53'),
(1812, 1, 'Gu7a1q6tcmoK2sUP29drBOcBtyGpfNN1', '2016-10-22 19:47:24', '2016-10-22 19:47:24'),
(1813, 1, '1R4vdQfqHZ1hsYqe6l3ZH6jfsU4goT9c', '2016-10-22 20:10:53', '2016-10-22 20:10:53'),
(1814, 1, 'gkKYAdBWtvYc2Z8TVJBJ9rr9p7nXpbqY', '2016-10-23 04:31:17', '2016-10-23 04:31:17'),
(1815, 1, 'o4Fuh0vUQ1AIySSQCRZTEDQwzcnFtmsN', '2016-10-23 06:55:52', '2016-10-23 06:55:52'),
(1816, 1, 'oPU2nswFavLko7gebrAv3KrDh1HUMSBC', '2016-10-23 07:34:48', '2016-10-23 07:34:48');

-- --------------------------------------------------------

--
-- Table structure for table `processes`
--

CREATE TABLE IF NOT EXISTS `processes` (
  `id` smallint(5) unsigned NOT NULL,
  `process` varchar(45) NOT NULL,
  `status` enum('A','I') NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `process_UNIQUE` (`process`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `processes`
--

INSERT INTO `processes` (`id`, `process`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(0, 'NA', 'I', '2016-10-01 20:32:00', '2016-10-01 20:32:00', NULL),
(1, 'General Outbound', 'A', '2016-10-01 20:32:00', '2016-10-01 20:32:00', NULL),
(2, 'CT', 'A', '2016-10-01 20:32:00', '2016-10-01 20:32:00', NULL),
(3, 'CS', 'A', '2016-10-01 20:32:00', '2016-10-01 20:32:00', NULL),
(4, 'Offline', 'A', '2016-10-01 20:32:00', '2016-10-01 20:32:00', NULL),
(5, 'KPS', 'A', '2016-10-01 20:32:00', '2016-10-01 20:32:00', NULL),
(6, 'Commodities', 'A', '2016-10-01 20:32:00', '2016-10-01 20:32:00', NULL),
(7, 'KNAP- Voice', 'A', '2016-10-01 20:32:00', '2016-10-01 20:32:00', NULL),
(8, 'Outbound', 'A', '2016-10-01 20:32:00', '2016-10-01 20:32:00', NULL),
(9, 'FNO-MF', 'A', '2016-10-01 20:32:00', '2016-10-01 20:32:00', NULL),
(10, 'Branch- Voice', 'A', '2016-10-01 20:32:00', '2016-10-01 20:32:00', NULL),
(11, 'Welcome Calling', 'A', '2016-10-01 20:32:00', '2016-10-01 20:32:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `status` enum('A','I') NOT NULL DEFAULT 'A',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(9, 'Debit Card- Personal Banking', '<p>Debit Card- Personal Banking</p>', 'A', '2016-06-17 10:18:57', '2016-06-22 13:13:59', NULL),
(10, 'Debit Card- Business Banking', 'Debit Card- Business Banking', 'A', '2016-06-17 10:21:51', '2016-06-17 10:21:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE IF NOT EXISTS `product_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `status` enum('A','I') NOT NULL DEFAULT 'A',
  `product_id` int(10) unsigned NOT NULL,
  `has_subcategory` enum('Y','N') NOT NULL DEFAULT 'N',
  `description` text NOT NULL,
  `created_by_id` int(10) unsigned NOT NULL,
  `updated_by_id` int(10) unsigned NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_product_categories_1_idx` (`product_id`),
  KEY `status` (`status`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `name`, `status`, `product_id`, `has_subcategory`, `description`, `created_by_id`, `updated_by_id`, `created_at`, `updated_at`) VALUES
(1, 'Category 2', 'A', 10, 'N', 'WERTG', 1, 1, '2016-06-20 20:52:45', '2016-06-21 00:21:09');

-- --------------------------------------------------------

--
-- Table structure for table `product_departments`
--

CREATE TABLE IF NOT EXISTS `product_departments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned NOT NULL,
  `department_id` smallint(5) unsigned NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_product_departments_1_idx` (`product_id`),
  KEY `fk_product_departments_2_idx` (`department_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `product_departments`
--

INSERT INTO `product_departments` (`id`, `product_id`, `department_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(10, 10, 1, '2016-06-20 20:13:06', '2016-06-20 20:13:06', NULL),
(11, 10, 2, '2016-06-20 20:13:06', '2016-06-20 20:13:06', NULL),
(25, 9, 2, '2016-06-22 13:13:59', '2016-06-22 13:13:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_experts`
--

CREATE TABLE IF NOT EXISTS `product_experts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned NOT NULL,
  `employee_id` int(10) unsigned NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_product_experts_1_idx` (`employee_id`),
  KEY `fk_product_experts_2_idx` (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `product_experts`
--

INSERT INTO `product_experts` (`id`, `product_id`, `employee_id`, `created_at`, `updated_at`) VALUES
(13, 9, 1, '2016-06-22 13:13:59', '2016-06-22 13:13:59');

-- --------------------------------------------------------

--
-- Table structure for table `product_subcategories`
--

CREATE TABLE IF NOT EXISTS `product_subcategories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_category_id` int(10) unsigned NOT NULL,
  `name` varchar(150) NOT NULL,
  `status` enum('A','I') NOT NULL DEFAULT 'A',
  `description` text NOT NULL,
  `created_by_id` int(10) unsigned NOT NULL,
  `updated_by_id` int(10) unsigned NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_product_subcategories_1_idx` (`product_category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `product_subcategories`
--

INSERT INTO `product_subcategories` (`id`, `product_category_id`, `name`, `status`, `description`, `created_by_id`, `updated_by_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'Subcategory 1', 'A', '<p><strong>Requirement: </strong>A mobile app as a sales aid so that sales force/front end can use it to access information on the product and reach out to the product group in case of a query.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Scope:</strong></p>\r\n\r\n<ol>\r\n	<li>\r\n	<p>Repository of Product information:</p>\r\n	</li>\r\n</ol>\r\n\r\n<ol>\r\n	<li>\r\n	<ol>\r\n		<li>\r\n		<p>Personal Debit Cards</p>\r\n		</li>\r\n	</ol>\r\n	</li>\r\n</ol>\r\n\r\n<p>Product features: <em>Illustrative list</em></p>\r\n\r\n<ol>\r\n	<li>\r\n	<ol>\r\n		<li>\r\n		<ol>\r\n			<li>\r\n			<p>2 free airport lounge accesses per quarter (leading to list of lounges)</p>\r\n			</li>\r\n			<li>\r\n			<p>Fuel surcharge waiver (leading to details required)</p>\r\n			</li>\r\n			<li>\r\n			<p>Attractive insurance proposition</p>\r\n			</li>\r\n		</ol>\r\n		</li>\r\n	</ol>\r\n	</li>\r\n</ol>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Offers: <em>Illustrative list</em></p>\r\n\r\n<ol>\r\n	<li>\r\n	<p>First purchase offer (leading to details)</p>\r\n	</li>\r\n	<li>\r\n	<p>Bookmyshow offer (leading to details)</p>\r\n	</li>\r\n	<li>\r\n	<p>Dining, spa, etc. (leading to offer listing)</p>\r\n	</li>\r\n</ol>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ol>\r\n	<li>\r\n	<ol>\r\n		<li>\r\n		<p>Business Debit Cards (in similar format as Personal Debit Cards)</p>\r\n		</li>\r\n	</ol>\r\n	</li>\r\n</ol>\r\n\r\n<p>Product features</p>\r\n\r\n<p>Offers</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ol>\r\n	<li>\r\n	<p>Facility would be required to regularly update the above information.</p>\r\n	</li>\r\n</ol>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ol>\r\n	<li>\r\n	<p>An in-app chat facility limited to the product group so that a sales officer on the field can reach out to the product group in case of any query so that the query can be addressed at the earliest time possible.</p>\r\n	</li>\r\n</ol>\r\n\r\n<p><br />\r\n&nbsp;</p>\r\n\r\n<ol>\r\n	<li>\r\n	<p>Authentication module will be required for this app.</p>\r\n	</li>\r\n</ol>\r\n\r\n<p><br />\r\n&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>', 1, 1, '2016-06-20 21:43:52', '2016-06-21 21:02:59');

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE IF NOT EXISTS `profiles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_slug_unique` (`slug`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `slug`, `name`, `permissions`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Admin', NULL, '2016-06-14 18:05:51', '2016-06-14 18:05:51'),
(2, 'user', 'User', NULL, '2016-06-15 16:42:03', '2016-06-15 16:42:03'),
(3, 'super_user', 'Super User', NULL, '2016-06-15 16:42:21', '2016-06-15 16:42:21');

-- --------------------------------------------------------

--
-- Table structure for table `reminders`
--

CREATE TABLE IF NOT EXISTS `reminders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `role_users`
--

CREATE TABLE IF NOT EXISTS `role_users` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`,`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role_users`
--

INSERT INTO `role_users` (`user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2016-06-15 17:58:46', '2016-06-15 17:58:46'),
(2, 3, '2016-06-20 18:54:46', '2016-06-20 18:54:46'),
(3, 2, '2016-10-18 16:09:19', '2016-10-18 16:09:19');

-- --------------------------------------------------------

--
-- Table structure for table `sq_adherence`
--

CREATE TABLE IF NOT EXISTS `sq_adherence` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sq_head_id` int(10) unsigned NOT NULL,
  `aik` varchar(45) NOT NULL,
  `sv` varchar(45) NOT NULL,
  `cbs` varchar(45) NOT NULL,
  `other` varchar(45) NOT NULL,
  `comment` varchar(500) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sq_head_id_UNIQUE` (`sq_head_id`),
  KEY `fk_sq_adherence_1_idx` (`sq_head_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sq_fatal`
--

CREATE TABLE IF NOT EXISTS `sq_fatal` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sq_head_id` int(10) unsigned NOT NULL,
  `reason1_id` int(10) unsigned DEFAULT NULL,
  `reason2_id` int(10) unsigned DEFAULT NULL,
  `comment` varchar(500) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sq_head_id_UNIQUE` (`sq_head_id`),
  KEY `fk_sq_fatal_1_idx` (`sq_head_id`),
  KEY `fk_sq_fatal_2_idx` (`reason1_id`),
  KEY `fk_sq_fatal_3_idx` (`reason2_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `sq_fatal`
--

INSERT INTO `sq_fatal` (`id`, `sq_head_id`, `reason1_id`, `reason2_id`, `comment`, `created_at`, `updated_at`) VALUES
(1, 2, 3, NULL, 'testing', '2016-10-18 23:25:03', '2016-10-18 23:25:03'),
(2, 1, 3, NULL, 'Testing', '2016-10-22 22:52:28', '2016-10-22 22:52:28');

-- --------------------------------------------------------

--
-- Table structure for table `sq_forms`
--

CREATE TABLE IF NOT EXISTS `sq_forms` (
  `id` int(10) unsigned NOT NULL,
  `formname` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `formname_UNIQUE` (`formname`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sq_forms`
--

INSERT INTO `sq_forms` (`id`, `formname`) VALUES
(2, 'Emails'),
(1, 'Voice');

-- --------------------------------------------------------

--
-- Table structure for table `sq_head`
--

CREATE TABLE IF NOT EXISTS `sq_head` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `trdate` date DEFAULT NULL,
  `process_id` smallint(5) unsigned NOT NULL,
  `agent_id` int(10) unsigned NOT NULL,
  `tl_id` int(10) unsigned NOT NULL,
  `manager_id` int(10) unsigned NOT NULL,
  `cat_id` int(10) unsigned NOT NULL,
  `client_id` varchar(45) DEFAULT NULL,
  `call_id` varchar(500) DEFAULT NULL,
  `duration_id` int(11) unsigned NOT NULL,
  `calltype_id` int(10) unsigned NOT NULL,
  `subcalltype_id` int(10) unsigned NOT NULL,
  `fatal` enum('Y','N') DEFAULT NULL,
  `adherence` enum('Y','N') DEFAULT NULL,
  `quality_max` float(5,3) unsigned DEFAULT NULL,
  `quality_ach` float(5,3) unsigned DEFAULT NULL,
  `quality_per` float(5,3) unsigned DEFAULT NULL,
  `appr` enum('Y','N') DEFAULT NULL,
  `form_id` smallint(2) NOT NULL DEFAULT '0',
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `deleted_by` int(11) unsigned DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_sq_head_1_idx` (`process_id`),
  KEY `fk_sq_head_2_idx` (`calltype_id`),
  KEY `fk_sq_head_3_idx` (`subcalltype_id`),
  KEY `fk_sq_head_4_idx` (`agent_id`),
  KEY `fk_sq_head_5_idx` (`tl_id`),
  KEY `fk_sq_head_6_idx` (`manager_id`),
  KEY `fk_sq_head_7_idx` (`cat_id`),
  KEY `fk_sq_head_8_idx` (`duration_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `sq_head`
--

INSERT INTO `sq_head` (`id`, `trdate`, `process_id`, `agent_id`, `tl_id`, `manager_id`, `cat_id`, `client_id`, `call_id`, `duration_id`, `calltype_id`, `subcalltype_id`, `fatal`, `adherence`, `quality_max`, `quality_ach`, `quality_per`, `appr`, `form_id`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '2016-10-22', 10, 3, 2, 1, 1, '23', 'wee', 2, 1, 1, 'Y', NULL, NULL, NULL, NULL, NULL, 1, 1, 1, NULL, '2016-10-22 22:52:28', '2016-10-22 22:52:28', NULL),
(2, '2016-10-18', 10, 3, 2, 1, 1, 'rrr', 'wwww', 2, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1, 3, 3, NULL, '2016-10-18 23:25:03', '2016-10-18 23:25:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sq_quality_voice`
--

CREATE TABLE IF NOT EXISTS `sq_quality_voice` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sq_head_id` int(10) unsigned NOT NULL,
  `tm` varchar(45) NOT NULL,
  `tm_max` float NOT NULL,
  `tm_ach` float NOT NULL,
  `comm` varchar(45) NOT NULL,
  `comm_max` float NOT NULL,
  `comm_ach` float NOT NULL,
  `chp` varchar(45) NOT NULL,
  `chp_max` float NOT NULL,
  `chp_ach` float NOT NULL,
  `pao` varchar(45) NOT NULL,
  `pao_max` float NOT NULL,
  `pao_ach` float NOT NULL,
  `du` varchar(45) NOT NULL,
  `du_max` float NOT NULL,
  `du_ach` float NOT NULL,
  `su` varchar(45) NOT NULL,
  `su_max` float NOT NULL,
  `su_ach` float NOT NULL,
  `cct` varchar(45) NOT NULL,
  `cct_max` float NOT NULL,
  `cct_ach` float NOT NULL,
  `ocr` varchar(45) NOT NULL,
  `ocr_max` float NOT NULL,
  `ocr_ach` float NOT NULL,
  `pg` varchar(45) NOT NULL,
  `osat` varchar(45) NOT NULL,
  `rsat` varchar(45) NOT NULL,
  `appr` varchar(45) NOT NULL,
  `comment1` varchar(500) DEFAULT NULL,
  `comment2` varchar(500) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sq_head_id_UNIQUE` (`sq_head_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sq_scorematrix`
--

CREATE TABLE IF NOT EXISTS `sq_scorematrix` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `formname` varchar(200) NOT NULL,
  `parameter` varchar(100) NOT NULL,
  `score` varchar(50) NOT NULL,
  `maxscore` float(5,2) NOT NULL,
  `achscore` float(5,2) NOT NULL,
  `paraorder` smallint(2) NOT NULL,
  `status` enum('A','I') NOT NULL DEFAULT 'A',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `sq_scorematrix`
--

INSERT INTO `sq_scorematrix` (`id`, `formname`, `parameter`, `score`, `maxscore`, `achscore`, `paraorder`, `status`) VALUES
(1, 'sq_quality_voice', 'Tone Manner', 'Y+', 10.00, 10.00, 1, 'A'),
(2, 'sq_quality_voice', 'Tone Manner', 'Y', 10.00, 7.00, 2, 'A'),
(3, 'sq_quality_voice', 'Tone Manner', 'N', 10.00, 0.00, 3, 'A'),
(4, 'sq_quality_voice', 'Tone Manner', 'NA', 0.00, 0.00, 4, 'A'),
(5, 'sq_quality_voice', 'Communication', 'Y+', 10.00, 10.00, 1, 'A'),
(6, 'sq_quality_voice', 'Communication', 'Y', 10.00, 7.00, 2, 'A'),
(7, 'sq_quality_voice', 'Communication', 'N', 10.00, 0.00, 3, 'A'),
(8, 'sq_quality_voice', 'Communication', 'NA', 0.00, 0.00, 4, 'A'),
(9, 'sq_quality_voice', 'Correct Hold Procedure', 'Y+', 10.00, 10.00, 1, 'A'),
(10, 'sq_quality_voice', 'Correct Hold Procedure', 'Y', 10.00, 7.00, 2, 'A'),
(11, 'sq_quality_voice', 'Correct Hold Procedure', 'N', 10.00, 0.00, 3, 'A'),
(12, 'sq_quality_voice', 'Correct Hold Procedure', 'NA', 0.00, 0.00, 4, 'A'),
(13, 'sq_quality_voice', 'Personal Accountability and Ownership', 'Y+', 10.00, 10.00, 1, 'A'),
(14, 'sq_quality_voice', 'Personal Accountability and Ownership', 'Y', 10.00, 7.00, 2, 'A'),
(15, 'sq_quality_voice', 'Personal Accountability and Ownership', 'N', 10.00, 0.00, 3, 'A'),
(16, 'sq_quality_voice', 'Personal Accountability and Ownership', 'NA', 0.00, 0.00, 4, 'A'),
(17, 'sq_quality_voice', 'Delighters used on the call', 'Y+', 10.00, 10.00, 1, 'A'),
(18, 'sq_quality_voice', 'Delighters used on the call', 'Y', 10.00, 7.00, 2, 'A'),
(19, 'sq_quality_voice', 'Delighters used on the call', 'N', 10.00, 0.00, 3, 'A'),
(20, 'sq_quality_voice', 'Delighters used on the call', 'NA', 0.00, 0.00, 4, 'A'),
(21, 'sq_quality_voice', 'System Usage', 'Y', 5.00, 5.00, 1, 'A'),
(22, 'sq_quality_voice', 'System Usage', 'N', 5.00, 0.00, 2, 'A'),
(23, 'sq_quality_voice', 'System Usage', 'NA', 0.00, 0.00, 3, 'A'),
(24, 'sq_quality_voice', 'Correct CT and SCT', 'Y', 5.00, 5.00, 1, 'A'),
(25, 'sq_quality_voice', 'Correct CT and SCT', 'N', 5.00, 0.00, 2, 'A'),
(26, 'sq_quality_voice', 'Correct CT and SCT', 'NA', 0.00, 0.00, 3, 'A'),
(27, 'sq_quality_voice', 'OCR', 'Y', 40.00, 40.00, 1, 'A'),
(28, 'sq_quality_voice', 'OCR', 'N', 40.00, 0.00, 2, 'A'),
(29, 'sq_quality_voice', 'OCR', 'NA', 0.00, 0.00, 3, 'A');

-- --------------------------------------------------------

--
-- Table structure for table `throttle`
--

CREATE TABLE IF NOT EXISTS `throttle` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `throttle_user_id_index` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=593 ;

--
-- Dumping data for table `throttle`
--

INSERT INTO `throttle` (`id`, `user_id`, `type`, `ip`, `created_at`, `updated_at`) VALUES
(1, NULL, 'global', NULL, '2015-10-08 01:05:11', '2015-10-08 01:05:11'),
(2, NULL, 'ip', '14.97.187.141', '2015-10-08 01:05:11', '2015-10-08 01:05:11'),
(3, 1, 'user', NULL, '2015-10-08 01:05:11', '2015-10-08 01:05:11'),
(4, NULL, 'global', NULL, '2015-10-16 00:43:06', '2015-10-16 00:43:06'),
(5, NULL, 'ip', '182.237.149.17', '2015-10-16 00:43:06', '2015-10-16 00:43:06'),
(6, 1, 'user', NULL, '2015-10-16 00:43:06', '2015-10-16 00:43:06'),
(7, NULL, 'global', NULL, '2015-10-21 20:01:21', '2015-10-21 20:01:21'),
(8, NULL, 'ip', '45.64.194.58', '2015-10-21 20:01:21', '2015-10-21 20:01:21'),
(9, 1, 'user', NULL, '2015-10-21 20:01:21', '2015-10-21 20:01:21'),
(10, NULL, 'global', NULL, '2015-10-24 16:24:39', '2015-10-24 16:24:39'),
(11, NULL, 'ip', '14.97.228.213', '2015-10-24 16:24:39', '2015-10-24 16:24:39'),
(12, 1, 'user', NULL, '2015-10-24 16:24:39', '2015-10-24 16:24:39'),
(13, NULL, 'global', NULL, '2015-10-24 18:50:09', '2015-10-24 18:50:09'),
(14, NULL, 'ip', '1.39.8.244', '2015-10-24 18:50:09', '2015-10-24 18:50:09'),
(15, 1, 'user', NULL, '2015-10-24 18:50:09', '2015-10-24 18:50:09'),
(16, NULL, 'global', NULL, '2015-11-03 06:46:49', '2015-11-03 06:46:49'),
(17, NULL, 'ip', '202.177.227.75', '2015-11-03 06:46:49', '2015-11-03 06:46:49'),
(18, 1, 'user', NULL, '2015-11-03 06:46:49', '2015-11-03 06:46:49'),
(19, NULL, 'global', NULL, '2015-11-07 21:39:40', '2015-11-07 21:39:40'),
(20, NULL, 'ip', '202.177.227.75', '2015-11-07 21:39:40', '2015-11-07 21:39:40'),
(21, 1, 'user', NULL, '2015-11-07 21:39:40', '2015-11-07 21:39:40'),
(22, NULL, 'global', NULL, '2015-11-26 23:01:00', '2015-11-26 23:01:00'),
(23, NULL, 'ip', '120.63.159.8', '2015-11-26 23:01:00', '2015-11-26 23:01:00'),
(24, 1, 'user', NULL, '2015-11-26 23:01:00', '2015-11-26 23:01:00'),
(25, NULL, 'global', NULL, '2015-11-26 23:01:11', '2015-11-26 23:01:11'),
(26, NULL, 'ip', '120.63.159.8', '2015-11-26 23:01:11', '2015-11-26 23:01:11'),
(27, 1, 'user', NULL, '2015-11-26 23:01:11', '2015-11-26 23:01:11'),
(28, NULL, 'global', NULL, '2015-11-26 23:01:26', '2015-11-26 23:01:26'),
(29, NULL, 'ip', '120.63.159.8', '2015-11-26 23:01:26', '2015-11-26 23:01:26'),
(30, 1, 'user', NULL, '2015-11-26 23:01:26', '2015-11-26 23:01:26'),
(31, NULL, 'global', NULL, '2015-11-26 23:01:45', '2015-11-26 23:01:45'),
(32, NULL, 'ip', '120.63.159.8', '2015-11-26 23:01:45', '2015-11-26 23:01:45'),
(33, 1, 'user', NULL, '2015-11-26 23:01:45', '2015-11-26 23:01:45'),
(34, NULL, 'global', NULL, '2015-11-27 19:11:13', '2015-11-27 19:11:13'),
(35, NULL, 'ip', '120.63.159.8', '2015-11-27 19:11:13', '2015-11-27 19:11:13'),
(36, 1, 'user', NULL, '2015-11-27 19:11:13', '2015-11-27 19:11:13'),
(37, NULL, 'global', NULL, '2015-11-27 19:11:23', '2015-11-27 19:11:23'),
(38, NULL, 'ip', '120.63.159.8', '2015-11-27 19:11:23', '2015-11-27 19:11:23'),
(39, 1, 'user', NULL, '2015-11-27 19:11:23', '2015-11-27 19:11:23'),
(40, NULL, 'global', NULL, '2015-11-27 19:17:47', '2015-11-27 19:17:47'),
(41, NULL, 'ip', '120.63.159.8', '2015-11-27 19:17:47', '2015-11-27 19:17:47'),
(42, 1, 'user', NULL, '2015-11-27 19:17:47', '2015-11-27 19:17:47'),
(43, NULL, 'global', NULL, '2015-11-27 19:17:57', '2015-11-27 19:17:57'),
(44, NULL, 'ip', '120.63.159.8', '2015-11-27 19:17:57', '2015-11-27 19:17:57'),
(45, 1, 'user', NULL, '2015-11-27 19:17:57', '2015-11-27 19:17:57'),
(46, NULL, 'global', NULL, '2015-11-27 19:18:08', '2015-11-27 19:18:08'),
(47, NULL, 'ip', '120.63.159.8', '2015-11-27 19:18:08', '2015-11-27 19:18:08'),
(48, 1, 'user', NULL, '2015-11-27 19:18:08', '2015-11-27 19:18:08'),
(49, NULL, 'global', NULL, '2015-11-27 19:56:32', '2015-11-27 19:56:32'),
(50, NULL, 'ip', '120.63.159.8', '2015-11-27 19:56:32', '2015-11-27 19:56:32'),
(51, 1, 'user', NULL, '2015-11-27 19:56:32', '2015-11-27 19:56:32'),
(52, NULL, 'global', NULL, '2015-11-27 19:56:41', '2015-11-27 19:56:41'),
(53, NULL, 'ip', '120.63.159.8', '2015-11-27 19:56:41', '2015-11-27 19:56:41'),
(54, 1, 'user', NULL, '2015-11-27 19:56:41', '2015-11-27 19:56:41'),
(55, NULL, 'global', NULL, '2015-11-30 19:23:38', '2015-11-30 19:23:38'),
(56, NULL, 'ip', '120.63.159.8', '2015-11-30 19:23:38', '2015-11-30 19:23:38'),
(57, 1, 'user', NULL, '2015-11-30 19:23:38', '2015-11-30 19:23:38'),
(58, NULL, 'global', NULL, '2015-11-30 19:24:04', '2015-11-30 19:24:04'),
(59, NULL, 'ip', '120.63.159.8', '2015-11-30 19:24:04', '2015-11-30 19:24:04'),
(60, 1, 'user', NULL, '2015-11-30 19:24:04', '2015-11-30 19:24:04'),
(61, NULL, 'global', NULL, '2015-12-02 22:33:27', '2015-12-02 22:33:27'),
(62, NULL, 'ip', '120.63.159.8', '2015-12-02 22:33:27', '2015-12-02 22:33:27'),
(63, 1, 'user', NULL, '2015-12-02 22:33:27', '2015-12-02 22:33:27'),
(64, NULL, 'global', NULL, '2015-12-10 20:21:51', '2015-12-10 20:21:51'),
(65, NULL, 'ip', '120.63.159.8', '2015-12-10 20:21:51', '2015-12-10 20:21:51'),
(66, 1, 'user', NULL, '2015-12-10 20:21:51', '2015-12-10 20:21:51'),
(67, NULL, 'global', NULL, '2015-12-10 20:21:59', '2015-12-10 20:21:59'),
(68, NULL, 'ip', '120.63.159.8', '2015-12-10 20:21:59', '2015-12-10 20:21:59'),
(69, 1, 'user', NULL, '2015-12-10 20:21:59', '2015-12-10 20:21:59'),
(70, NULL, 'global', NULL, '2015-12-27 16:48:26', '2015-12-27 16:48:26'),
(71, NULL, 'ip', '1.39.11.239', '2015-12-27 16:48:26', '2015-12-27 16:48:26'),
(72, 1, 'user', NULL, '2015-12-27 16:48:26', '2015-12-27 16:48:26'),
(73, NULL, 'global', NULL, '2015-12-27 16:48:40', '2015-12-27 16:48:40'),
(74, NULL, 'ip', '1.39.11.239', '2015-12-27 16:48:40', '2015-12-27 16:48:40'),
(75, 1, 'user', NULL, '2015-12-27 16:48:40', '2015-12-27 16:48:40'),
(76, NULL, 'global', NULL, '2015-12-30 19:00:28', '2015-12-30 19:00:28'),
(77, NULL, 'ip', '103.233.169.62', '2015-12-30 19:00:28', '2015-12-30 19:00:28'),
(78, 1, 'user', NULL, '2015-12-30 19:00:28', '2015-12-30 19:00:28'),
(79, NULL, 'global', NULL, '2016-01-06 05:53:50', '2016-01-06 05:53:50'),
(80, NULL, 'ip', '14.97.153.249', '2016-01-06 05:53:50', '2016-01-06 05:53:50'),
(81, 2, 'user', NULL, '2016-01-06 05:53:50', '2016-01-06 05:53:50'),
(82, NULL, 'global', NULL, '2016-01-08 23:49:47', '2016-01-08 23:49:47'),
(83, NULL, 'ip', '120.63.159.8', '2016-01-08 23:49:47', '2016-01-08 23:49:47'),
(84, 1, 'user', NULL, '2016-01-08 23:49:47', '2016-01-08 23:49:47'),
(85, NULL, 'global', NULL, '2016-01-11 21:55:01', '2016-01-11 21:55:01'),
(86, NULL, 'ip', '120.63.159.8', '2016-01-11 21:55:01', '2016-01-11 21:55:01'),
(87, 1, 'user', NULL, '2016-01-11 21:55:01', '2016-01-11 21:55:01'),
(88, NULL, 'global', NULL, '2016-01-11 21:55:56', '2016-01-11 21:55:56'),
(89, NULL, 'ip', '120.63.159.8', '2016-01-11 21:55:56', '2016-01-11 21:55:56'),
(90, 1, 'user', NULL, '2016-01-11 21:55:56', '2016-01-11 21:55:56'),
(91, NULL, 'global', NULL, '2016-01-11 22:57:47', '2016-01-11 22:57:47'),
(92, NULL, 'ip', '120.63.159.8', '2016-01-11 22:57:47', '2016-01-11 22:57:47'),
(93, 1, 'user', NULL, '2016-01-11 22:57:47', '2016-01-11 22:57:47'),
(94, NULL, 'global', NULL, '2016-01-11 23:38:49', '2016-01-11 23:38:49'),
(95, NULL, 'ip', '120.63.159.8', '2016-01-11 23:38:49', '2016-01-11 23:38:49'),
(96, 5, 'user', NULL, '2016-01-11 23:38:49', '2016-01-11 23:38:49'),
(97, NULL, 'global', NULL, '2016-01-12 00:36:09', '2016-01-12 00:36:09'),
(98, NULL, 'ip', '120.63.159.8', '2016-01-12 00:36:09', '2016-01-12 00:36:09'),
(99, 1, 'user', NULL, '2016-01-12 00:36:09', '2016-01-12 00:36:09'),
(100, NULL, 'global', NULL, '2016-01-12 00:36:40', '2016-01-12 00:36:40'),
(101, NULL, 'ip', '120.63.159.8', '2016-01-12 00:36:40', '2016-01-12 00:36:40'),
(102, 1, 'user', NULL, '2016-01-12 00:36:40', '2016-01-12 00:36:40'),
(103, NULL, 'global', NULL, '2016-01-12 00:42:54', '2016-01-12 00:42:54'),
(104, NULL, 'ip', '120.63.159.8', '2016-01-12 00:42:54', '2016-01-12 00:42:54'),
(105, 1, 'user', NULL, '2016-01-12 00:42:54', '2016-01-12 00:42:54'),
(106, NULL, 'global', NULL, '2016-01-12 17:24:47', '2016-01-12 17:24:47'),
(107, NULL, 'ip', '120.63.159.8', '2016-01-12 17:24:47', '2016-01-12 17:24:47'),
(108, 1, 'user', NULL, '2016-01-12 17:24:47', '2016-01-12 17:24:47'),
(109, NULL, 'global', NULL, '2016-01-12 17:25:00', '2016-01-12 17:25:00'),
(110, NULL, 'ip', '120.63.159.8', '2016-01-12 17:25:00', '2016-01-12 17:25:00'),
(111, 1, 'user', NULL, '2016-01-12 17:25:00', '2016-01-12 17:25:00'),
(112, NULL, 'global', NULL, '2016-01-13 01:03:06', '2016-01-13 01:03:06'),
(113, NULL, 'ip', '103.233.169.62', '2016-01-13 01:03:06', '2016-01-13 01:03:06'),
(114, 4, 'user', NULL, '2016-01-13 01:03:06', '2016-01-13 01:03:06'),
(115, NULL, 'global', NULL, '2016-01-13 20:25:27', '2016-01-13 20:25:27'),
(116, NULL, 'ip', '120.63.159.8', '2016-01-13 20:25:27', '2016-01-13 20:25:27'),
(117, 1, 'user', NULL, '2016-01-13 20:25:27', '2016-01-13 20:25:27'),
(118, NULL, 'global', NULL, '2016-01-15 19:50:35', '2016-01-15 19:50:35'),
(119, NULL, 'ip', '120.63.159.8', '2016-01-15 19:50:35', '2016-01-15 19:50:35'),
(120, 1, 'user', NULL, '2016-01-15 19:50:35', '2016-01-15 19:50:35'),
(121, NULL, 'global', NULL, '2016-01-15 21:39:01', '2016-01-15 21:39:01'),
(122, NULL, 'ip', '120.63.159.8', '2016-01-15 21:39:01', '2016-01-15 21:39:01'),
(123, 3, 'user', NULL, '2016-01-15 21:39:01', '2016-01-15 21:39:01'),
(124, NULL, 'global', NULL, '2016-01-15 23:39:32', '2016-01-15 23:39:32'),
(125, NULL, 'ip', '120.63.159.8', '2016-01-15 23:39:32', '2016-01-15 23:39:32'),
(126, 1, 'user', NULL, '2016-01-15 23:39:32', '2016-01-15 23:39:32'),
(127, NULL, 'global', NULL, '2016-01-16 00:42:46', '2016-01-16 00:42:46'),
(128, NULL, 'ip', '120.63.159.8', '2016-01-16 00:42:46', '2016-01-16 00:42:46'),
(129, 3, 'user', NULL, '2016-01-16 00:42:46', '2016-01-16 00:42:46'),
(130, NULL, 'global', NULL, '2016-01-16 22:24:49', '2016-01-16 22:24:49'),
(131, NULL, 'ip', '45.64.194.58', '2016-01-16 22:24:49', '2016-01-16 22:24:49'),
(132, 1, 'user', NULL, '2016-01-16 22:24:49', '2016-01-16 22:24:49'),
(133, NULL, 'global', NULL, '2016-01-16 22:30:27', '2016-01-16 22:30:27'),
(134, NULL, 'ip', '120.63.159.8', '2016-01-16 22:30:27', '2016-01-16 22:30:27'),
(135, 1, 'user', NULL, '2016-01-16 22:30:27', '2016-01-16 22:30:27'),
(136, NULL, 'global', NULL, '2016-01-16 22:30:35', '2016-01-16 22:30:35'),
(137, NULL, 'ip', '120.63.159.8', '2016-01-16 22:30:35', '2016-01-16 22:30:35'),
(138, 1, 'user', NULL, '2016-01-16 22:30:35', '2016-01-16 22:30:35'),
(139, NULL, 'global', NULL, '2016-01-16 22:30:49', '2016-01-16 22:30:49'),
(140, NULL, 'ip', '120.63.159.8', '2016-01-16 22:30:49', '2016-01-16 22:30:49'),
(141, 1, 'user', NULL, '2016-01-16 22:30:49', '2016-01-16 22:30:49'),
(142, NULL, 'global', NULL, '2016-01-18 20:08:10', '2016-01-18 20:08:10'),
(143, NULL, 'ip', '120.63.159.8', '2016-01-18 20:08:10', '2016-01-18 20:08:10'),
(144, 1, 'user', NULL, '2016-01-18 20:08:10', '2016-01-18 20:08:10'),
(145, NULL, 'global', NULL, '2016-01-18 22:09:11', '2016-01-18 22:09:11'),
(146, NULL, 'ip', '120.63.159.8', '2016-01-18 22:09:11', '2016-01-18 22:09:11'),
(147, 1, 'user', NULL, '2016-01-18 22:09:11', '2016-01-18 22:09:11'),
(148, NULL, 'global', NULL, '2016-01-19 22:24:31', '2016-01-19 22:24:31'),
(149, NULL, 'ip', '120.63.159.8', '2016-01-19 22:24:31', '2016-01-19 22:24:31'),
(150, 3, 'user', NULL, '2016-01-19 22:24:31', '2016-01-19 22:24:31'),
(151, NULL, 'global', NULL, '2016-01-20 06:55:21', '2016-01-20 06:55:21'),
(152, NULL, 'ip', '115.117.225.101', '2016-01-20 06:55:21', '2016-01-20 06:55:21'),
(153, 7, 'user', NULL, '2016-01-20 06:55:21', '2016-01-20 06:55:21'),
(154, NULL, 'global', NULL, '2016-01-25 21:14:01', '2016-01-25 21:14:01'),
(155, NULL, 'ip', '120.63.159.8', '2016-01-25 21:14:01', '2016-01-25 21:14:01'),
(156, 1, 'user', NULL, '2016-01-25 21:14:01', '2016-01-25 21:14:01'),
(157, NULL, 'global', NULL, '2016-01-27 23:42:22', '2016-01-27 23:42:22'),
(158, NULL, 'ip', '103.233.169.62', '2016-01-27 23:42:22', '2016-01-27 23:42:22'),
(159, 1, 'user', NULL, '2016-01-27 23:42:22', '2016-01-27 23:42:22'),
(160, NULL, 'global', NULL, '2016-01-30 22:39:59', '2016-01-30 22:39:59'),
(161, NULL, 'ip', '103.233.169.62', '2016-01-30 22:39:59', '2016-01-30 22:39:59'),
(162, 1, 'user', NULL, '2016-01-30 22:39:59', '2016-01-30 22:39:59'),
(163, NULL, 'global', NULL, '2016-02-01 19:53:50', '2016-02-01 19:53:50'),
(164, NULL, 'ip', '103.233.169.62', '2016-02-01 19:53:50', '2016-02-01 19:53:50'),
(165, 1, 'user', NULL, '2016-02-01 19:53:50', '2016-02-01 19:53:50'),
(166, NULL, 'global', NULL, '2016-02-01 22:32:44', '2016-02-01 22:32:44'),
(167, NULL, 'ip', '103.233.169.62', '2016-02-01 22:32:44', '2016-02-01 22:32:44'),
(168, 1, 'user', NULL, '2016-02-01 22:32:44', '2016-02-01 22:32:44'),
(169, NULL, 'global', NULL, '2016-02-02 18:00:51', '2016-02-02 18:00:51'),
(170, NULL, 'ip', '103.233.169.62', '2016-02-02 18:00:51', '2016-02-02 18:00:51'),
(171, 1, 'user', NULL, '2016-02-02 18:00:51', '2016-02-02 18:00:51'),
(172, NULL, 'global', NULL, '2016-02-02 22:00:25', '2016-02-02 22:00:25'),
(173, NULL, 'ip', '103.233.169.62', '2016-02-02 22:00:25', '2016-02-02 22:00:25'),
(174, 4, 'user', NULL, '2016-02-02 22:00:25', '2016-02-02 22:00:25'),
(175, NULL, 'global', NULL, '2016-02-03 00:11:43', '2016-02-03 00:11:43'),
(176, NULL, 'ip', '103.233.169.62', '2016-02-03 00:11:43', '2016-02-03 00:11:43'),
(177, 4, 'user', NULL, '2016-02-03 00:11:43', '2016-02-03 00:11:43'),
(178, NULL, 'global', NULL, '2016-02-03 01:16:53', '2016-02-03 01:16:53'),
(179, NULL, 'ip', '120.63.159.8', '2016-02-03 01:16:53', '2016-02-03 01:16:53'),
(180, 3, 'user', NULL, '2016-02-03 01:16:53', '2016-02-03 01:16:53'),
(181, NULL, 'global', NULL, '2016-02-03 01:17:03', '2016-02-03 01:17:03'),
(182, NULL, 'ip', '120.63.159.8', '2016-02-03 01:17:03', '2016-02-03 01:17:03'),
(183, 3, 'user', NULL, '2016-02-03 01:17:03', '2016-02-03 01:17:03'),
(184, NULL, 'global', NULL, '2016-02-03 01:17:18', '2016-02-03 01:17:18'),
(185, NULL, 'ip', '120.63.159.8', '2016-02-03 01:17:18', '2016-02-03 01:17:18'),
(186, 3, 'user', NULL, '2016-02-03 01:17:18', '2016-02-03 01:17:18'),
(187, NULL, 'global', NULL, '2016-02-06 17:40:34', '2016-02-06 17:40:34'),
(188, NULL, 'ip', '103.233.169.62', '2016-02-06 17:40:34', '2016-02-06 17:40:34'),
(189, 1, 'user', NULL, '2016-02-06 17:40:34', '2016-02-06 17:40:34'),
(190, NULL, 'global', NULL, '2016-02-06 17:40:48', '2016-02-06 17:40:48'),
(191, NULL, 'ip', '103.233.169.62', '2016-02-06 17:40:48', '2016-02-06 17:40:48'),
(192, 1, 'user', NULL, '2016-02-06 17:40:48', '2016-02-06 17:40:48'),
(193, NULL, 'global', NULL, '2016-02-06 17:41:17', '2016-02-06 17:41:17'),
(194, NULL, 'ip', '103.233.169.62', '2016-02-06 17:41:17', '2016-02-06 17:41:17'),
(195, 1, 'user', NULL, '2016-02-06 17:41:17', '2016-02-06 17:41:17'),
(196, NULL, 'global', NULL, '2016-02-06 17:41:52', '2016-02-06 17:41:52'),
(197, NULL, 'ip', '103.233.169.62', '2016-02-06 17:41:52', '2016-02-06 17:41:52'),
(198, 1, 'user', NULL, '2016-02-06 17:41:52', '2016-02-06 17:41:52'),
(199, NULL, 'global', NULL, '2016-02-06 17:42:21', '2016-02-06 17:42:21'),
(200, NULL, 'ip', '103.233.169.62', '2016-02-06 17:42:21', '2016-02-06 17:42:21'),
(201, 4, 'user', NULL, '2016-02-06 17:42:21', '2016-02-06 17:42:21'),
(202, NULL, 'global', NULL, '2016-02-10 18:58:17', '2016-02-10 18:58:17'),
(203, NULL, 'ip', '202.130.40.55', '2016-02-10 18:58:17', '2016-02-10 18:58:17'),
(204, 1, 'user', NULL, '2016-02-10 18:58:17', '2016-02-10 18:58:17'),
(205, NULL, 'global', NULL, '2016-02-10 22:50:22', '2016-02-10 22:50:22'),
(206, NULL, 'ip', '103.233.169.62', '2016-02-10 22:50:22', '2016-02-10 22:50:22'),
(207, 4, 'user', NULL, '2016-02-10 22:50:22', '2016-02-10 22:50:22'),
(208, NULL, 'global', NULL, '2016-02-10 23:32:10', '2016-02-10 23:32:10'),
(209, NULL, 'ip', '103.233.169.62', '2016-02-10 23:32:10', '2016-02-10 23:32:10'),
(210, 1, 'user', NULL, '2016-02-10 23:32:10', '2016-02-10 23:32:10'),
(211, NULL, 'global', NULL, '2016-02-10 23:32:28', '2016-02-10 23:32:28'),
(212, NULL, 'ip', '103.233.169.62', '2016-02-10 23:32:28', '2016-02-10 23:32:28'),
(213, 1, 'user', NULL, '2016-02-10 23:32:28', '2016-02-10 23:32:28'),
(214, NULL, 'global', NULL, '2016-02-16 00:13:25', '2016-02-16 00:13:25'),
(215, NULL, 'ip', '120.63.159.8', '2016-02-16 00:13:25', '2016-02-16 00:13:25'),
(216, 3, 'user', NULL, '2016-02-16 00:13:25', '2016-02-16 00:13:25'),
(217, NULL, 'global', NULL, '2016-02-17 00:37:42', '2016-02-17 00:37:42'),
(218, NULL, 'ip', '120.63.159.8', '2016-02-17 00:37:42', '2016-02-17 00:37:42'),
(219, NULL, 'global', NULL, '2016-02-17 05:17:31', '2016-02-17 05:17:31'),
(220, NULL, 'ip', '58.146.99.222', '2016-02-17 05:17:31', '2016-02-17 05:17:31'),
(221, 1, 'user', NULL, '2016-02-17 05:17:31', '2016-02-17 05:17:31'),
(222, NULL, 'global', NULL, '2016-02-18 17:26:52', '2016-02-18 17:26:52'),
(223, NULL, 'ip', '103.233.169.62', '2016-02-18 17:26:52', '2016-02-18 17:26:52'),
(224, 1, 'user', NULL, '2016-02-18 17:26:52', '2016-02-18 17:26:52'),
(225, NULL, 'global', NULL, '2016-02-19 18:45:23', '2016-02-19 18:45:23'),
(226, NULL, 'ip', '120.63.159.8', '2016-02-19 18:45:23', '2016-02-19 18:45:23'),
(227, 1, 'user', NULL, '2016-02-19 18:45:23', '2016-02-19 18:45:23'),
(228, NULL, 'global', NULL, '2016-02-19 20:03:38', '2016-02-19 20:03:38'),
(229, NULL, 'ip', '120.63.159.8', '2016-02-19 20:03:38', '2016-02-19 20:03:38'),
(230, NULL, 'global', NULL, '2016-02-19 22:26:50', '2016-02-19 22:26:50'),
(231, NULL, 'ip', '120.63.159.8', '2016-02-19 22:26:50', '2016-02-19 22:26:50'),
(232, NULL, 'global', NULL, '2016-02-19 22:27:39', '2016-02-19 22:27:39'),
(233, NULL, 'ip', '120.63.159.8', '2016-02-19 22:27:39', '2016-02-19 22:27:39'),
(234, NULL, 'global', NULL, '2016-02-20 17:13:13', '2016-02-20 17:13:13'),
(235, NULL, 'ip', '103.233.169.62', '2016-02-20 17:13:13', '2016-02-20 17:13:13'),
(236, 1, 'user', NULL, '2016-02-20 17:13:13', '2016-02-20 17:13:13'),
(237, NULL, 'global', NULL, '2016-02-20 17:43:08', '2016-02-20 17:43:08'),
(238, NULL, 'ip', '103.233.169.62', '2016-02-20 17:43:08', '2016-02-20 17:43:08'),
(239, 1, 'user', NULL, '2016-02-20 17:43:08', '2016-02-20 17:43:08'),
(240, NULL, 'global', NULL, '2016-02-20 17:43:36', '2016-02-20 17:43:36'),
(241, NULL, 'ip', '103.233.169.62', '2016-02-20 17:43:36', '2016-02-20 17:43:36'),
(242, 1, 'user', NULL, '2016-02-20 17:43:36', '2016-02-20 17:43:36'),
(243, NULL, 'global', NULL, '2016-02-20 17:44:12', '2016-02-20 17:44:12'),
(244, NULL, 'ip', '103.233.169.62', '2016-02-20 17:44:12', '2016-02-20 17:44:12'),
(245, 1, 'user', NULL, '2016-02-20 17:44:12', '2016-02-20 17:44:12'),
(246, NULL, 'global', NULL, '2016-02-20 17:44:32', '2016-02-20 17:44:32'),
(247, NULL, 'ip', '103.233.169.62', '2016-02-20 17:44:32', '2016-02-20 17:44:32'),
(248, 4, 'user', NULL, '2016-02-20 17:44:32', '2016-02-20 17:44:32'),
(249, NULL, 'global', NULL, '2016-02-26 17:42:05', '2016-02-26 17:42:05'),
(250, NULL, 'ip', '103.233.169.62', '2016-02-26 17:42:05', '2016-02-26 17:42:05'),
(251, 1, 'user', NULL, '2016-02-26 17:42:05', '2016-02-26 17:42:05'),
(252, NULL, 'global', NULL, '2016-02-26 17:42:23', '2016-02-26 17:42:23'),
(253, NULL, 'ip', '103.233.169.62', '2016-02-26 17:42:23', '2016-02-26 17:42:23'),
(254, 1, 'user', NULL, '2016-02-26 17:42:23', '2016-02-26 17:42:23'),
(255, NULL, 'global', NULL, '2016-02-26 17:42:59', '2016-02-26 17:42:59'),
(256, NULL, 'ip', '103.233.169.62', '2016-02-26 17:42:59', '2016-02-26 17:42:59'),
(257, 1, 'user', NULL, '2016-02-26 17:42:59', '2016-02-26 17:42:59'),
(258, NULL, 'global', NULL, '2016-02-26 17:43:16', '2016-02-26 17:43:16'),
(259, NULL, 'ip', '103.233.169.62', '2016-02-26 17:43:16', '2016-02-26 17:43:16'),
(260, 4, 'user', NULL, '2016-02-26 17:43:16', '2016-02-26 17:43:16'),
(261, NULL, 'global', NULL, '2016-02-26 17:46:05', '2016-02-26 17:46:05'),
(262, NULL, 'ip', '103.233.169.62', '2016-02-26 17:46:05', '2016-02-26 17:46:05'),
(263, 1, 'user', NULL, '2016-02-26 17:46:05', '2016-02-26 17:46:05'),
(264, NULL, 'global', NULL, '2016-02-26 21:43:48', '2016-02-26 21:43:48'),
(265, NULL, 'ip', '103.233.169.62', '2016-02-26 21:43:48', '2016-02-26 21:43:48'),
(266, 4, 'user', NULL, '2016-02-26 21:43:48', '2016-02-26 21:43:48'),
(267, NULL, 'global', NULL, '2016-02-26 21:44:03', '2016-02-26 21:44:03'),
(268, NULL, 'ip', '103.233.169.62', '2016-02-26 21:44:03', '2016-02-26 21:44:03'),
(269, 4, 'user', NULL, '2016-02-26 21:44:03', '2016-02-26 21:44:03'),
(270, NULL, 'global', NULL, '2016-03-01 18:43:00', '2016-03-01 18:43:00'),
(271, NULL, 'ip', '103.233.169.62', '2016-03-01 18:43:00', '2016-03-01 18:43:00'),
(272, 1, 'user', NULL, '2016-03-01 18:43:00', '2016-03-01 18:43:00'),
(273, NULL, 'global', NULL, '2016-03-01 18:43:18', '2016-03-01 18:43:18'),
(274, NULL, 'ip', '103.233.169.62', '2016-03-01 18:43:18', '2016-03-01 18:43:18'),
(275, 1, 'user', NULL, '2016-03-01 18:43:18', '2016-03-01 18:43:18'),
(276, NULL, 'global', NULL, '2016-03-01 19:11:05', '2016-03-01 19:11:05'),
(277, NULL, 'ip', '103.233.169.62', '2016-03-01 19:11:05', '2016-03-01 19:11:05'),
(278, 1, 'user', NULL, '2016-03-01 19:11:05', '2016-03-01 19:11:05'),
(279, NULL, 'global', NULL, '2016-03-01 19:11:27', '2016-03-01 19:11:27'),
(280, NULL, 'ip', '103.233.169.62', '2016-03-01 19:11:27', '2016-03-01 19:11:27'),
(281, 4, 'user', NULL, '2016-03-01 19:11:27', '2016-03-01 19:11:27'),
(282, NULL, 'global', NULL, '2016-03-12 19:02:46', '2016-03-12 19:02:46'),
(283, NULL, 'ip', '117.218.167.14', '2016-03-12 19:02:46', '2016-03-12 19:02:46'),
(284, 1, 'user', NULL, '2016-03-12 19:02:46', '2016-03-12 19:02:46'),
(285, NULL, 'global', NULL, '2016-03-29 19:23:25', '2016-03-29 19:23:25'),
(286, NULL, 'ip', '103.233.169.62', '2016-03-29 19:23:25', '2016-03-29 19:23:25'),
(287, NULL, 'global', NULL, '2016-03-29 19:24:07', '2016-03-29 19:24:07'),
(288, NULL, 'ip', '103.233.169.62', '2016-03-29 19:24:07', '2016-03-29 19:24:07'),
(289, NULL, 'global', NULL, '2016-03-29 19:25:01', '2016-03-29 19:25:01'),
(290, NULL, 'ip', '103.233.169.62', '2016-03-29 19:25:01', '2016-03-29 19:25:01'),
(291, NULL, 'global', NULL, '2016-03-29 19:29:09', '2016-03-29 19:29:09'),
(292, NULL, 'ip', '103.233.169.62', '2016-03-29 19:29:09', '2016-03-29 19:29:09'),
(293, NULL, 'global', NULL, '2016-03-29 19:29:09', '2016-03-29 19:29:09'),
(294, NULL, 'ip', '103.233.169.62', '2016-03-29 19:29:09', '2016-03-29 19:29:09'),
(295, NULL, 'global', NULL, '2016-03-29 19:29:11', '2016-03-29 19:29:11'),
(296, NULL, 'ip', '103.233.169.62', '2016-03-29 19:29:11', '2016-03-29 19:29:11'),
(297, NULL, 'global', NULL, '2016-03-29 19:41:53', '2016-03-29 19:41:53'),
(298, NULL, 'ip', '103.233.169.62', '2016-03-29 19:41:53', '2016-03-29 19:41:53'),
(299, NULL, 'global', NULL, '2016-03-29 19:42:20', '2016-03-29 19:42:20'),
(300, NULL, 'ip', '103.233.169.62', '2016-03-29 19:42:20', '2016-03-29 19:42:20'),
(301, NULL, 'global', NULL, '2016-03-29 19:42:23', '2016-03-29 19:42:23'),
(302, NULL, 'ip', '103.233.169.62', '2016-03-29 19:42:23', '2016-03-29 19:42:23'),
(303, NULL, 'global', NULL, '2016-03-31 00:01:12', '2016-03-31 00:01:12'),
(304, NULL, 'ip', '120.63.159.8', '2016-03-31 00:01:12', '2016-03-31 00:01:12'),
(305, NULL, 'global', NULL, '2016-03-31 18:29:51', '2016-03-31 18:29:51'),
(306, NULL, 'ip', '103.233.169.62', '2016-03-31 18:29:51', '2016-03-31 18:29:51'),
(307, 4, 'user', NULL, '2016-03-31 18:29:51', '2016-03-31 18:29:51'),
(308, NULL, 'global', NULL, '2016-03-31 19:37:09', '2016-03-31 19:37:09'),
(309, NULL, 'ip', '120.63.159.8', '2016-03-31 19:37:09', '2016-03-31 19:37:09'),
(310, 1, 'user', NULL, '2016-03-31 19:37:09', '2016-03-31 19:37:09'),
(311, NULL, 'global', NULL, '2016-03-31 19:37:32', '2016-03-31 19:37:32'),
(312, NULL, 'ip', '120.63.159.8', '2016-03-31 19:37:32', '2016-03-31 19:37:32'),
(313, 1, 'user', NULL, '2016-03-31 19:37:32', '2016-03-31 19:37:32'),
(314, NULL, 'global', NULL, '2016-04-02 18:11:34', '2016-04-02 18:11:34'),
(315, NULL, 'ip', '115.117.226.175', '2016-04-02 18:11:34', '2016-04-02 18:11:34'),
(316, 6, 'user', NULL, '2016-04-02 18:11:34', '2016-04-02 18:11:34'),
(317, NULL, 'global', NULL, '2016-04-05 23:05:09', '2016-04-05 23:05:09'),
(318, NULL, 'ip', '103.233.169.62', '2016-04-05 23:05:09', '2016-04-05 23:05:09'),
(319, 1, 'user', NULL, '2016-04-05 23:05:09', '2016-04-05 23:05:09'),
(320, NULL, 'global', NULL, '2016-04-06 18:00:10', '2016-04-06 18:00:10'),
(321, NULL, 'ip', '103.233.169.62', '2016-04-06 18:00:10', '2016-04-06 18:00:10'),
(322, 1, 'user', NULL, '2016-04-06 18:00:10', '2016-04-06 18:00:10'),
(323, NULL, 'global', NULL, '2016-04-06 18:08:46', '2016-04-06 18:08:46'),
(324, NULL, 'ip', '103.233.169.62', '2016-04-06 18:08:46', '2016-04-06 18:08:46'),
(325, 11, 'user', NULL, '2016-04-06 18:08:46', '2016-04-06 18:08:46'),
(326, NULL, 'global', NULL, '2016-04-06 18:59:28', '2016-04-06 18:59:28'),
(327, NULL, 'ip', '103.233.169.62', '2016-04-06 18:59:28', '2016-04-06 18:59:28'),
(328, 1, 'user', NULL, '2016-04-06 18:59:28', '2016-04-06 18:59:28'),
(329, NULL, 'global', NULL, '2016-04-06 18:59:49', '2016-04-06 18:59:49'),
(330, NULL, 'ip', '103.233.169.62', '2016-04-06 18:59:49', '2016-04-06 18:59:49'),
(331, 1, 'user', NULL, '2016-04-06 18:59:49', '2016-04-06 18:59:49'),
(332, NULL, 'global', NULL, '2016-04-06 22:37:31', '2016-04-06 22:37:31'),
(333, NULL, 'ip', '103.233.169.62', '2016-04-06 22:37:31', '2016-04-06 22:37:31'),
(334, 1, 'user', NULL, '2016-04-06 22:37:31', '2016-04-06 22:37:31'),
(335, NULL, 'global', NULL, '2016-04-07 02:08:17', '2016-04-07 02:08:17'),
(336, NULL, 'ip', '103.233.169.62', '2016-04-07 02:08:17', '2016-04-07 02:08:17'),
(337, 1, 'user', NULL, '2016-04-07 02:08:17', '2016-04-07 02:08:17'),
(338, NULL, 'global', NULL, '2016-04-08 00:35:08', '2016-04-08 00:35:08'),
(339, NULL, 'ip', '120.63.159.8', '2016-04-08 00:35:08', '2016-04-08 00:35:08'),
(340, 1, 'user', NULL, '2016-04-08 00:35:08', '2016-04-08 00:35:08'),
(341, NULL, 'global', NULL, '2016-04-08 23:30:56', '2016-04-08 23:30:56'),
(342, NULL, 'ip', '103.233.169.62', '2016-04-08 23:30:56', '2016-04-08 23:30:56'),
(343, 1, 'user', NULL, '2016-04-08 23:30:56', '2016-04-08 23:30:56'),
(344, NULL, 'global', NULL, '2016-04-08 23:31:22', '2016-04-08 23:31:22'),
(345, NULL, 'ip', '103.233.169.62', '2016-04-08 23:31:22', '2016-04-08 23:31:22'),
(346, 1, 'user', NULL, '2016-04-08 23:31:22', '2016-04-08 23:31:22'),
(347, NULL, 'global', NULL, '2016-04-08 23:33:06', '2016-04-08 23:33:06'),
(348, NULL, 'ip', '103.233.169.62', '2016-04-08 23:33:06', '2016-04-08 23:33:06'),
(349, 1, 'user', NULL, '2016-04-08 23:33:06', '2016-04-08 23:33:06'),
(350, NULL, 'global', NULL, '2016-04-08 23:34:39', '2016-04-08 23:34:39'),
(351, NULL, 'ip', '103.233.169.62', '2016-04-08 23:34:39', '2016-04-08 23:34:39'),
(352, 1, 'user', NULL, '2016-04-08 23:34:39', '2016-04-08 23:34:39'),
(353, NULL, 'global', NULL, '2016-04-08 23:35:28', '2016-04-08 23:35:28'),
(354, NULL, 'ip', '103.233.169.62', '2016-04-08 23:35:28', '2016-04-08 23:35:28'),
(355, 1, 'user', NULL, '2016-04-08 23:35:28', '2016-04-08 23:35:28'),
(356, NULL, 'global', NULL, '2016-04-08 23:48:09', '2016-04-08 23:48:09'),
(357, NULL, 'ip', '103.233.169.62', '2016-04-08 23:48:09', '2016-04-08 23:48:09'),
(358, 1, 'user', NULL, '2016-04-08 23:48:09', '2016-04-08 23:48:09'),
(359, NULL, 'global', NULL, '2016-04-09 19:45:24', '2016-04-09 19:45:24'),
(360, NULL, 'ip', '103.233.169.62', '2016-04-09 19:45:24', '2016-04-09 19:45:24'),
(361, 6, 'user', NULL, '2016-04-09 19:45:24', '2016-04-09 19:45:24'),
(362, NULL, 'global', NULL, '2016-04-10 19:52:38', '2016-04-10 19:52:38'),
(363, NULL, 'ip', '103.233.169.62', '2016-04-10 19:52:38', '2016-04-10 19:52:38'),
(364, 6, 'user', NULL, '2016-04-10 19:52:38', '2016-04-10 19:52:38'),
(365, NULL, 'global', NULL, '2016-04-12 21:57:14', '2016-04-12 21:57:14'),
(366, NULL, 'ip', '103.233.169.62', '2016-04-12 21:57:14', '2016-04-12 21:57:14'),
(367, 1, 'user', NULL, '2016-04-12 21:57:14', '2016-04-12 21:57:14'),
(368, NULL, 'global', NULL, '2016-04-12 22:43:00', '2016-04-12 22:43:00'),
(369, NULL, 'ip', '103.233.169.62', '2016-04-12 22:43:00', '2016-04-12 22:43:00'),
(370, 1, 'user', NULL, '2016-04-12 22:43:00', '2016-04-12 22:43:00'),
(371, NULL, 'global', NULL, '2016-04-12 22:43:17', '2016-04-12 22:43:17'),
(372, NULL, 'ip', '103.233.169.62', '2016-04-12 22:43:17', '2016-04-12 22:43:17'),
(373, 1, 'user', NULL, '2016-04-12 22:43:17', '2016-04-12 22:43:17'),
(374, NULL, 'global', NULL, '2016-04-13 00:41:26', '2016-04-13 00:41:26'),
(375, NULL, 'ip', '103.233.169.62', '2016-04-13 00:41:26', '2016-04-13 00:41:26'),
(376, 4, 'user', NULL, '2016-04-13 00:41:26', '2016-04-13 00:41:26'),
(377, NULL, 'global', NULL, '2016-04-13 17:38:22', '2016-04-13 17:38:22'),
(378, NULL, 'ip', '103.233.169.62', '2016-04-13 17:38:22', '2016-04-13 17:38:22'),
(379, 1, 'user', NULL, '2016-04-13 17:38:22', '2016-04-13 17:38:22'),
(380, NULL, 'global', NULL, '2016-04-13 21:22:35', '2016-04-13 21:22:35'),
(381, NULL, 'ip', '103.233.169.62', '2016-04-13 21:22:35', '2016-04-13 21:22:35'),
(382, 6, 'user', NULL, '2016-04-13 21:22:35', '2016-04-13 21:22:35'),
(383, NULL, 'global', NULL, '2016-04-13 22:35:09', '2016-04-13 22:35:09'),
(384, NULL, 'ip', '103.233.169.62', '2016-04-13 22:35:09', '2016-04-13 22:35:09'),
(385, 6, 'user', NULL, '2016-04-13 22:35:09', '2016-04-13 22:35:09'),
(386, NULL, 'global', NULL, '2016-04-14 21:15:16', '2016-04-14 21:15:16'),
(387, NULL, 'ip', '120.63.159.8', '2016-04-14 21:15:16', '2016-04-14 21:15:16'),
(388, NULL, 'global', NULL, '2016-04-14 21:15:51', '2016-04-14 21:15:51'),
(389, NULL, 'ip', '120.63.159.8', '2016-04-14 21:15:51', '2016-04-14 21:15:51'),
(390, NULL, 'global', NULL, '2016-04-14 21:18:59', '2016-04-14 21:18:59'),
(391, NULL, 'ip', '120.63.159.8', '2016-04-14 21:18:59', '2016-04-14 21:18:59'),
(392, NULL, 'global', NULL, '2016-04-15 00:32:52', '2016-04-15 00:32:52'),
(393, NULL, 'ip', '120.63.159.8', '2016-04-15 00:32:52', '2016-04-15 00:32:52'),
(394, NULL, 'global', NULL, '2016-04-15 02:38:35', '2016-04-15 02:38:35'),
(395, NULL, 'ip', '103.233.169.62', '2016-04-15 02:38:35', '2016-04-15 02:38:35'),
(396, 11, 'user', NULL, '2016-04-15 02:38:35', '2016-04-15 02:38:35'),
(397, NULL, 'global', NULL, '2016-04-15 02:38:46', '2016-04-15 02:38:46'),
(398, NULL, 'ip', '103.233.169.62', '2016-04-15 02:38:46', '2016-04-15 02:38:46'),
(399, 11, 'user', NULL, '2016-04-15 02:38:46', '2016-04-15 02:38:46'),
(400, NULL, 'global', NULL, '2016-04-15 02:39:22', '2016-04-15 02:39:22'),
(401, NULL, 'ip', '103.233.169.62', '2016-04-15 02:39:22', '2016-04-15 02:39:22'),
(402, 6, 'user', NULL, '2016-04-15 02:39:22', '2016-04-15 02:39:22'),
(403, NULL, 'global', NULL, '2016-04-15 02:39:29', '2016-04-15 02:39:29'),
(404, NULL, 'ip', '103.233.169.62', '2016-04-15 02:39:29', '2016-04-15 02:39:29'),
(405, 6, 'user', NULL, '2016-04-15 02:39:29', '2016-04-15 02:39:29'),
(406, NULL, 'global', NULL, '2016-04-15 02:39:36', '2016-04-15 02:39:36'),
(407, NULL, 'ip', '103.233.169.62', '2016-04-15 02:39:36', '2016-04-15 02:39:36'),
(408, 6, 'user', NULL, '2016-04-15 02:39:36', '2016-04-15 02:39:36'),
(409, NULL, 'global', NULL, '2016-04-15 02:39:51', '2016-04-15 02:39:51'),
(410, NULL, 'ip', '103.233.169.62', '2016-04-15 02:39:51', '2016-04-15 02:39:51'),
(411, 6, 'user', NULL, '2016-04-15 02:39:51', '2016-04-15 02:39:51'),
(412, NULL, 'global', NULL, '2016-04-16 17:42:09', '2016-04-16 17:42:09'),
(413, NULL, 'ip', '103.233.169.62', '2016-04-16 17:42:09', '2016-04-16 17:42:09'),
(414, 4, 'user', NULL, '2016-04-16 17:42:09', '2016-04-16 17:42:09'),
(415, NULL, 'global', NULL, '2016-04-17 03:51:45', '2016-04-17 03:51:45'),
(416, NULL, 'ip', '120.63.159.8', '2016-04-17 03:51:45', '2016-04-17 03:51:45'),
(417, NULL, 'global', NULL, '2016-04-17 21:07:11', '2016-04-17 21:07:11'),
(418, NULL, 'ip', '103.233.169.62', '2016-04-17 21:07:11', '2016-04-17 21:07:11'),
(419, NULL, 'global', NULL, '2016-04-18 16:20:57', '2016-04-18 16:20:57'),
(420, NULL, 'ip', '103.233.169.62', '2016-04-18 16:20:57', '2016-04-18 16:20:57'),
(421, 6, 'user', NULL, '2016-04-18 16:20:57', '2016-04-18 16:20:57'),
(422, NULL, 'global', NULL, '2016-04-19 01:46:56', '2016-04-19 01:46:56'),
(423, NULL, 'ip', '103.233.169.62', '2016-04-19 01:46:56', '2016-04-19 01:46:56'),
(424, NULL, 'global', NULL, '2016-04-19 18:44:44', '2016-04-19 18:44:44'),
(425, NULL, 'ip', '103.233.169.62', '2016-04-19 18:44:44', '2016-04-19 18:44:44'),
(426, 6, 'user', NULL, '2016-04-19 18:44:44', '2016-04-19 18:44:44'),
(427, NULL, 'global', NULL, '2016-04-20 23:15:46', '2016-04-20 23:15:46'),
(428, NULL, 'ip', '103.233.169.62', '2016-04-20 23:15:46', '2016-04-20 23:15:46'),
(429, 6, 'user', NULL, '2016-04-20 23:15:46', '2016-04-20 23:15:46'),
(430, NULL, 'global', NULL, '2016-04-20 23:16:02', '2016-04-20 23:16:02'),
(431, NULL, 'ip', '103.233.169.62', '2016-04-20 23:16:02', '2016-04-20 23:16:02'),
(432, 6, 'user', NULL, '2016-04-20 23:16:02', '2016-04-20 23:16:02'),
(433, NULL, 'global', NULL, '2016-04-20 23:16:07', '2016-04-20 23:16:07'),
(434, NULL, 'ip', '103.233.169.62', '2016-04-20 23:16:07', '2016-04-20 23:16:07'),
(435, 6, 'user', NULL, '2016-04-20 23:16:07', '2016-04-20 23:16:07'),
(436, NULL, 'global', NULL, '2016-04-20 23:16:45', '2016-04-20 23:16:45'),
(437, NULL, 'ip', '103.233.169.62', '2016-04-20 23:16:45', '2016-04-20 23:16:45'),
(438, 6, 'user', NULL, '2016-04-20 23:16:45', '2016-04-20 23:16:45'),
(439, NULL, 'global', NULL, '2016-04-26 16:26:25', '2016-04-26 16:26:25'),
(440, NULL, 'ip', '103.233.169.62', '2016-04-26 16:26:25', '2016-04-26 16:26:25'),
(441, 6, 'user', NULL, '2016-04-26 16:26:25', '2016-04-26 16:26:25'),
(442, NULL, 'global', NULL, '2016-04-26 16:27:10', '2016-04-26 16:27:10'),
(443, NULL, 'ip', '103.233.169.62', '2016-04-26 16:27:10', '2016-04-26 16:27:10'),
(444, 6, 'user', NULL, '2016-04-26 16:27:10', '2016-04-26 16:27:10'),
(445, NULL, 'global', NULL, '2016-04-26 16:28:31', '2016-04-26 16:28:31'),
(446, NULL, 'ip', '103.233.169.62', '2016-04-26 16:28:31', '2016-04-26 16:28:31'),
(447, 6, 'user', NULL, '2016-04-26 16:28:31', '2016-04-26 16:28:31'),
(448, NULL, 'global', NULL, '2016-04-26 16:29:27', '2016-04-26 16:29:27'),
(449, NULL, 'ip', '103.233.169.62', '2016-04-26 16:29:27', '2016-04-26 16:29:27'),
(450, 6, 'user', NULL, '2016-04-26 16:29:27', '2016-04-26 16:29:27'),
(451, NULL, 'global', NULL, '2016-04-26 16:30:09', '2016-04-26 16:30:09'),
(452, NULL, 'ip', '103.233.169.62', '2016-04-26 16:30:09', '2016-04-26 16:30:09'),
(453, 6, 'user', NULL, '2016-04-26 16:30:09', '2016-04-26 16:30:09'),
(454, NULL, 'global', NULL, '2016-04-26 16:36:22', '2016-04-26 16:36:22'),
(455, NULL, 'ip', '103.233.169.62', '2016-04-26 16:36:22', '2016-04-26 16:36:22'),
(456, 6, 'user', NULL, '2016-04-26 16:36:22', '2016-04-26 16:36:22'),
(457, NULL, 'global', NULL, '2016-04-26 16:39:10', '2016-04-26 16:39:10'),
(458, NULL, 'ip', '176.205.73.253', '2016-04-26 16:39:10', '2016-04-26 16:39:10'),
(459, NULL, 'global', NULL, '2016-04-30 02:48:38', '2016-04-30 02:48:38'),
(460, NULL, 'ip', '103.233.169.62', '2016-04-30 02:48:38', '2016-04-30 02:48:38'),
(461, 6, 'user', NULL, '2016-04-30 02:48:38', '2016-04-30 02:48:38'),
(462, NULL, 'global', NULL, '2016-04-30 01:42:17', '2016-04-30 01:42:17'),
(463, NULL, 'ip', '2.51.51.216', '2016-04-30 01:42:17', '2016-04-30 01:42:17'),
(464, NULL, 'global', NULL, '2016-04-30 15:11:59', '2016-04-30 15:11:59'),
(465, NULL, 'ip', '103.233.169.62', '2016-04-30 15:11:59', '2016-04-30 15:11:59'),
(466, 6, 'user', NULL, '2016-04-30 15:11:59', '2016-04-30 15:11:59'),
(467, NULL, 'global', NULL, '2016-04-30 18:00:23', '2016-04-30 18:00:23'),
(468, NULL, 'ip', '103.233.169.62', '2016-04-30 18:00:23', '2016-04-30 18:00:23'),
(469, 4, 'user', NULL, '2016-04-30 18:00:23', '2016-04-30 18:00:23'),
(470, NULL, 'global', NULL, '2016-05-01 01:59:29', '2016-05-01 01:59:29'),
(471, NULL, 'ip', '117.218.167.14', '2016-05-01 01:59:29', '2016-05-01 01:59:29'),
(472, 6, 'user', NULL, '2016-05-01 01:59:29', '2016-05-01 01:59:29'),
(473, NULL, 'global', NULL, '2016-05-03 13:40:39', '2016-05-03 13:40:39'),
(474, NULL, 'ip', '103.233.169.62', '2016-05-03 13:40:39', '2016-05-03 13:40:39'),
(475, NULL, 'global', NULL, '2016-05-11 01:48:28', '2016-05-11 01:48:28'),
(476, NULL, 'ip', '120.63.159.8', '2016-05-11 01:48:28', '2016-05-11 01:48:28'),
(477, 9, 'user', NULL, '2016-05-11 01:48:28', '2016-05-11 01:48:28'),
(478, NULL, 'global', NULL, '2016-05-11 02:05:06', '2016-05-11 02:05:06'),
(479, NULL, 'ip', '120.63.159.8', '2016-05-11 02:05:06', '2016-05-11 02:05:06'),
(480, 9, 'user', NULL, '2016-05-11 02:05:06', '2016-05-11 02:05:06'),
(481, NULL, 'global', NULL, '2016-05-11 22:14:37', '2016-05-11 22:14:37'),
(482, NULL, 'ip', '120.63.159.8', '2016-05-11 22:14:37', '2016-05-11 22:14:37'),
(483, 3, 'user', NULL, '2016-05-11 22:14:37', '2016-05-11 22:14:37'),
(484, NULL, 'global', NULL, '2016-05-16 17:23:03', '2016-05-16 17:23:03'),
(485, NULL, 'ip', '103.233.169.62', '2016-05-16 17:23:03', '2016-05-16 17:23:03'),
(486, 4, 'user', NULL, '2016-05-16 17:23:03', '2016-05-16 17:23:03'),
(487, NULL, 'global', NULL, '2016-05-18 14:52:04', '2016-05-18 14:52:04'),
(488, NULL, 'ip', '103.233.169.62', '2016-05-18 14:52:04', '2016-05-18 14:52:04'),
(489, 6, 'user', NULL, '2016-05-18 14:52:04', '2016-05-18 14:52:04'),
(490, NULL, 'global', NULL, '2016-05-19 05:58:28', '2016-05-19 05:58:28'),
(491, NULL, 'ip', '86.98.107.168', '2016-05-19 05:58:28', '2016-05-19 05:58:28'),
(492, NULL, 'global', NULL, '2016-05-19 06:01:35', '2016-05-19 06:01:35'),
(493, NULL, 'ip', '86.98.107.168', '2016-05-19 06:01:35', '2016-05-19 06:01:35'),
(494, 10, 'user', NULL, '2016-05-19 06:01:35', '2016-05-19 06:01:35'),
(495, NULL, 'global', NULL, '2016-05-19 06:01:45', '2016-05-19 06:01:45'),
(496, NULL, 'ip', '86.98.107.168', '2016-05-19 06:01:45', '2016-05-19 06:01:45'),
(497, 10, 'user', NULL, '2016-05-19 06:01:45', '2016-05-19 06:01:45'),
(498, NULL, 'global', NULL, '2016-05-19 06:01:55', '2016-05-19 06:01:55'),
(499, NULL, 'ip', '86.98.107.168', '2016-05-19 06:01:55', '2016-05-19 06:01:55'),
(500, 10, 'user', NULL, '2016-05-19 06:01:55', '2016-05-19 06:01:55'),
(501, NULL, 'global', NULL, '2016-05-22 18:24:37', '2016-05-22 18:24:37'),
(502, NULL, 'ip', '103.233.169.62', '2016-05-22 18:24:37', '2016-05-22 18:24:37'),
(503, 11, 'user', NULL, '2016-05-22 18:24:37', '2016-05-22 18:24:37'),
(504, NULL, 'global', NULL, '2016-05-23 05:43:02', '2016-05-23 05:43:02'),
(505, NULL, 'ip', '103.233.169.62', '2016-05-23 05:43:02', '2016-05-23 05:43:02'),
(506, 6, 'user', NULL, '2016-05-23 05:43:02', '2016-05-23 05:43:02'),
(507, NULL, 'global', NULL, '2016-05-26 17:51:08', '2016-05-26 17:51:08'),
(508, NULL, 'ip', '103.233.169.62', '2016-05-26 17:51:08', '2016-05-26 17:51:08'),
(509, 4, 'user', NULL, '2016-05-26 17:51:08', '2016-05-26 17:51:08'),
(510, NULL, 'global', NULL, '2016-05-26 19:16:56', '2016-05-26 19:16:56'),
(511, NULL, 'ip', '117.218.167.14', '2016-05-26 19:16:56', '2016-05-26 19:16:56'),
(512, 6, 'user', NULL, '2016-05-26 19:16:56', '2016-05-26 19:16:56'),
(513, NULL, 'global', NULL, '2016-05-26 19:17:07', '2016-05-26 19:17:07'),
(514, NULL, 'ip', '117.218.167.14', '2016-05-26 19:17:07', '2016-05-26 19:17:07'),
(515, 6, 'user', NULL, '2016-05-26 19:17:07', '2016-05-26 19:17:07'),
(516, NULL, 'global', NULL, '2016-05-26 19:17:16', '2016-05-26 19:17:16'),
(517, NULL, 'ip', '117.218.167.14', '2016-05-26 19:17:16', '2016-05-26 19:17:16'),
(518, 6, 'user', NULL, '2016-05-26 19:17:16', '2016-05-26 19:17:16'),
(519, NULL, 'global', NULL, '2016-06-02 22:52:39', '2016-06-02 22:52:39'),
(520, NULL, 'ip', '120.63.159.8', '2016-06-02 22:52:39', '2016-06-02 22:52:39'),
(521, 1, 'user', NULL, '2016-06-02 22:52:39', '2016-06-02 22:52:39'),
(522, NULL, 'global', NULL, '2016-06-16 05:30:25', '2016-06-16 05:30:25'),
(523, NULL, 'ip', '127.0.0.1', '2016-06-16 05:30:25', '2016-06-16 05:30:25'),
(524, NULL, 'global', NULL, '2016-06-16 05:30:47', '2016-06-16 05:30:47'),
(525, NULL, 'ip', '127.0.0.1', '2016-06-16 05:30:47', '2016-06-16 05:30:47'),
(526, NULL, 'global', NULL, '2016-06-16 05:33:01', '2016-06-16 05:33:01'),
(527, NULL, 'ip', '127.0.0.1', '2016-06-16 05:33:01', '2016-06-16 05:33:01'),
(528, NULL, 'global', NULL, '2016-06-16 05:39:13', '2016-06-16 05:39:13'),
(529, NULL, 'ip', '127.0.0.1', '2016-06-16 05:39:13', '2016-06-16 05:39:13'),
(530, NULL, 'global', NULL, '2016-06-16 05:39:37', '2016-06-16 05:39:37'),
(531, NULL, 'ip', '127.0.0.1', '2016-06-16 05:39:37', '2016-06-16 05:39:37'),
(532, NULL, 'global', NULL, '2016-06-16 05:41:51', '2016-06-16 05:41:51'),
(533, NULL, 'ip', '127.0.0.1', '2016-06-16 05:41:52', '2016-06-16 05:41:52'),
(534, NULL, 'global', NULL, '2016-06-16 05:46:32', '2016-06-16 05:46:32'),
(535, NULL, 'ip', '127.0.0.1', '2016-06-16 05:46:32', '2016-06-16 05:46:32'),
(536, NULL, 'global', NULL, '2016-06-16 05:50:25', '2016-06-16 05:50:25'),
(537, NULL, 'ip', '127.0.0.1', '2016-06-16 05:50:25', '2016-06-16 05:50:25'),
(538, NULL, 'global', NULL, '2016-06-16 05:50:35', '2016-06-16 05:50:35'),
(539, NULL, 'ip', '127.0.0.1', '2016-06-16 05:50:35', '2016-06-16 05:50:35'),
(540, NULL, 'global', NULL, '2016-06-16 15:29:02', '2016-06-16 15:29:02'),
(541, NULL, 'ip', '127.0.0.1', '2016-06-16 15:29:03', '2016-06-16 15:29:03'),
(542, NULL, 'global', NULL, '2016-06-16 15:29:22', '2016-06-16 15:29:22'),
(543, NULL, 'ip', '127.0.0.1', '2016-06-16 15:29:22', '2016-06-16 15:29:22'),
(544, NULL, 'global', NULL, '2016-06-16 15:29:52', '2016-06-16 15:29:52'),
(545, NULL, 'ip', '127.0.0.1', '2016-06-16 15:29:52', '2016-06-16 15:29:52'),
(546, NULL, 'global', NULL, '2016-06-16 15:30:34', '2016-06-16 15:30:34'),
(547, NULL, 'ip', '127.0.0.1', '2016-06-16 15:30:34', '2016-06-16 15:30:34'),
(548, NULL, 'global', NULL, '2016-06-16 15:30:50', '2016-06-16 15:30:50'),
(549, NULL, 'ip', '127.0.0.1', '2016-06-16 15:30:50', '2016-06-16 15:30:50'),
(550, NULL, 'global', NULL, '2016-06-16 16:21:20', '2016-06-16 16:21:20'),
(551, NULL, 'ip', '127.0.0.1', '2016-06-16 16:21:21', '2016-06-16 16:21:21'),
(552, NULL, 'global', NULL, '2016-06-16 16:23:15', '2016-06-16 16:23:15'),
(553, NULL, 'ip', '127.0.0.1', '2016-06-16 16:23:15', '2016-06-16 16:23:15'),
(554, NULL, 'global', NULL, '2016-06-17 05:04:45', '2016-06-17 05:04:45'),
(555, NULL, 'ip', '127.0.0.1', '2016-06-17 05:04:45', '2016-06-17 05:04:45'),
(556, 1, 'user', NULL, '2016-06-17 05:04:45', '2016-06-17 05:04:45'),
(557, NULL, 'global', NULL, '2016-06-17 05:04:53', '2016-06-17 05:04:53'),
(558, NULL, 'ip', '127.0.0.1', '2016-06-17 05:04:54', '2016-06-17 05:04:54'),
(559, 1, 'user', NULL, '2016-06-17 05:04:54', '2016-06-17 05:04:54'),
(560, NULL, 'global', NULL, '2016-06-17 05:14:42', '2016-06-17 05:14:42'),
(561, NULL, 'ip', '127.0.0.1', '2016-06-17 05:14:42', '2016-06-17 05:14:42'),
(562, 1, 'user', NULL, '2016-06-17 05:14:42', '2016-06-17 05:14:42'),
(563, NULL, 'global', NULL, '2016-06-17 05:19:37', '2016-06-17 05:19:37'),
(564, NULL, 'ip', '127.0.0.1', '2016-06-17 05:19:37', '2016-06-17 05:19:37'),
(565, 1, 'user', NULL, '2016-06-17 05:19:37', '2016-06-17 05:19:37'),
(566, NULL, 'global', NULL, '2016-06-17 06:22:19', '2016-06-17 06:22:19'),
(567, NULL, 'ip', '127.0.0.1', '2016-06-17 06:22:20', '2016-06-17 06:22:20'),
(568, 1, 'user', NULL, '2016-06-17 06:22:20', '2016-06-17 06:22:20'),
(569, NULL, 'global', NULL, '2016-06-21 13:56:26', '2016-06-21 13:56:26'),
(570, NULL, 'ip', '127.0.0.1', '2016-06-21 13:56:26', '2016-06-21 13:56:26'),
(571, 1, 'user', NULL, '2016-06-21 13:56:26', '2016-06-21 13:56:26'),
(572, NULL, 'global', NULL, '2016-07-20 09:32:15', '2016-07-20 09:32:15'),
(573, NULL, 'ip', '127.0.0.1', '2016-07-20 09:32:15', '2016-07-20 09:32:15'),
(574, 1, 'user', NULL, '2016-07-20 09:32:15', '2016-07-20 09:32:15'),
(575, NULL, 'global', NULL, '2016-07-20 09:32:20', '2016-07-20 09:32:20'),
(576, NULL, 'ip', '127.0.0.1', '2016-07-20 09:32:20', '2016-07-20 09:32:20'),
(577, 1, 'user', NULL, '2016-07-20 09:32:20', '2016-07-20 09:32:20'),
(578, NULL, 'global', NULL, '2016-10-02 10:14:52', '2016-10-02 10:14:52'),
(579, NULL, 'ip', '127.0.0.1', '2016-10-02 10:14:52', '2016-10-02 10:14:52'),
(580, 1, 'user', NULL, '2016-10-02 10:14:52', '2016-10-02 10:14:52'),
(581, NULL, 'global', NULL, '2016-10-04 16:12:07', '2016-10-04 16:12:07'),
(582, NULL, 'ip', '127.0.0.1', '2016-10-04 16:12:07', '2016-10-04 16:12:07'),
(583, 1, 'user', NULL, '2016-10-04 16:12:07', '2016-10-04 16:12:07'),
(584, NULL, 'global', NULL, '2016-10-04 18:06:11', '2016-10-04 18:06:11'),
(585, NULL, 'ip', '127.0.0.1', '2016-10-04 18:06:11', '2016-10-04 18:06:11'),
(586, 1, 'user', NULL, '2016-10-04 18:06:11', '2016-10-04 18:06:11'),
(587, NULL, 'global', NULL, '2016-10-16 13:29:28', '2016-10-16 13:29:28'),
(588, NULL, 'ip', '127.0.0.1', '2016-10-16 13:29:29', '2016-10-16 13:29:29'),
(589, 1, 'user', NULL, '2016-10-16 13:29:29', '2016-10-16 13:29:29'),
(590, NULL, 'global', NULL, '2016-10-23 04:31:09', '2016-10-23 04:31:09'),
(591, NULL, 'ip', '127.0.0.1', '2016-10-23 04:31:09', '2016-10-23 04:31:09'),
(592, 1, 'user', NULL, '2016-10-23 04:31:09', '2016-10-23 04:31:09');

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_product_search`
--
CREATE TABLE IF NOT EXISTS `v_product_search` (
`id` int(11) unsigned
,`name` varchar(150)
,`description` text
,`pageType` varchar(18)
);
-- --------------------------------------------------------

--
-- Structure for view `v_product_search`
--
DROP TABLE IF EXISTS `v_product_search`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_product_search` AS select `p`.`id` AS `id`,`p`.`name` AS `name`,`p`.`description` AS `description`,'Product' AS `pageType` from `products` `p` where (((`p`.`name` like '%debit card%') or (`p`.`description` like '%debit%')) and (`p`.`status` = 'A')) union select `pc`.`id` AS `id`,`pc`.`name` AS `name`,`pc`.`description` AS `description`,'productCategory' AS `pageType` from `product_categories` `pc` where (((`pc`.`name` like '%debit card%') or (`pc`.`description` like '%cat%')) and (`pc`.`status` = 'A')) union select `psc`.`id` AS `id`,`psc`.`name` AS `name`,`psc`.`description` AS `description`,'productSubCategory' AS `pageType` from `product_subcategories` `psc` where (((`psc`.`name` like '%debit card%') or (`psc`.`description` like '%Scope%')) and (`psc`.`status` = 'A'));

--
-- Constraints for dumped tables
--

--
-- Constraints for table `call_types_sub`
--
ALTER TABLE `call_types_sub`
  ADD CONSTRAINT `fk_call_types_sub_1` FOREIGN KEY (`call_type_id`) REFERENCES `call_types` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `code_values`
--
ALTER TABLE `code_values`
  ADD CONSTRAINT `fk_code_values_1` FOREIGN KEY (`code_id`) REFERENCES `code` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `fk_employees_1` FOREIGN KEY (`emp_type_id`) REFERENCES `emp_types` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_employees_2` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_employees_3` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD CONSTRAINT `fk_product_categories_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_departments`
--
ALTER TABLE `product_departments`
  ADD CONSTRAINT `fk_product_departments_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_departments_2` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_experts`
--
ALTER TABLE `product_experts`
  ADD CONSTRAINT `fk_product_experts_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_experts_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_subcategories`
--
ALTER TABLE `product_subcategories`
  ADD CONSTRAINT `fk_product_subcategories_1` FOREIGN KEY (`product_category_id`) REFERENCES `product_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sq_adherence`
--
ALTER TABLE `sq_adherence`
  ADD CONSTRAINT `fk_sq_adherence_1` FOREIGN KEY (`sq_head_id`) REFERENCES `sq_head` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sq_fatal`
--
ALTER TABLE `sq_fatal`
  ADD CONSTRAINT `fk_sq_fatal_1` FOREIGN KEY (`sq_head_id`) REFERENCES `sq_head` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sq_fatal_2` FOREIGN KEY (`reason1_id`) REFERENCES `code_values` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_sq_fatal_3` FOREIGN KEY (`reason2_id`) REFERENCES `code_values` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `sq_head`
--
ALTER TABLE `sq_head`
  ADD CONSTRAINT `fk_sq_head_1` FOREIGN KEY (`process_id`) REFERENCES `processes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_sq_head_2` FOREIGN KEY (`calltype_id`) REFERENCES `call_types` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_sq_head_3` FOREIGN KEY (`subcalltype_id`) REFERENCES `call_types_sub` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_sq_head_4` FOREIGN KEY (`agent_id`) REFERENCES `employees` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_sq_head_5` FOREIGN KEY (`tl_id`) REFERENCES `employees` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_sq_head_6` FOREIGN KEY (`manager_id`) REFERENCES `employees` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_sq_head_7` FOREIGN KEY (`cat_id`) REFERENCES `code_values` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_sq_head_8` FOREIGN KEY (`duration_id`) REFERENCES `code_values` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `sq_quality_voice`
--
ALTER TABLE `sq_quality_voice`
  ADD CONSTRAINT `fk_sq_quality_voice_1` FOREIGN KEY (`sq_head_id`) REFERENCES `sq_head` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
