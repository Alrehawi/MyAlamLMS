-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2020 at 10:43 PM
-- Server version: 10.4.12-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `afsch`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` int(11) NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `action` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `msg` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `ip_address` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `site_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `path`, `action`, `msg`, `created`, `ip_address`, `site_id`) VALUES
(1, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (111) ', 'By: montaserelsawy', '2020-11-25 21:08:32', '::1', 1),
(2, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (110) ', 'By: montaserelsawy', '2020-11-25 21:08:32', '::1', 1),
(3, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (109) ', 'By: montaserelsawy', '2020-11-25 21:08:32', '::1', 1),
(4, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (108) ', 'By: montaserelsawy', '2020-11-25 21:08:32', '::1', 1),
(5, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (107) ', 'By: montaserelsawy', '2020-11-25 21:08:32', '::1', 1),
(6, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (106) ', 'By: montaserelsawy', '2020-11-25 21:08:32', '::1', 1),
(7, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (105) ', 'By: montaserelsawy', '2020-11-25 21:08:32', '::1', 1),
(8, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (104) ', 'By: montaserelsawy', '2020-11-25 21:08:32', '::1', 1),
(9, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (103) ', 'By: montaserelsawy', '2020-11-25 21:08:32', '::1', 1),
(10, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (102) ', 'By: montaserelsawy', '2020-11-25 21:08:32', '::1', 1),
(11, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (101) ', 'By: montaserelsawy', '2020-11-25 21:08:32', '::1', 1),
(12, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (100) ', 'By: montaserelsawy', '2020-11-25 21:08:32', '::1', 1),
(13, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (99) ', 'By: montaserelsawy', '2020-11-25 21:08:32', '::1', 1),
(14, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (98) ', 'By: montaserelsawy', '2020-11-25 21:08:32', '::1', 1),
(15, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (97) ', 'By: montaserelsawy', '2020-11-25 21:08:32', '::1', 1),
(16, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (96) ', 'By: montaserelsawy', '2020-11-25 21:08:32', '::1', 1),
(17, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (95) ', 'By: montaserelsawy', '2020-11-25 21:08:32', '::1', 1),
(18, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (94) ', 'By: montaserelsawy', '2020-11-25 21:08:32', '::1', 1),
(19, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (93) ', 'By: montaserelsawy', '2020-11-25 21:08:32', '::1', 1),
(20, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (92) ', 'By: montaserelsawy', '2020-11-25 21:08:33', '::1', 1),
(21, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (91) ', 'By: montaserelsawy', '2020-11-25 21:08:33', '::1', 1),
(22, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (90) ', 'By: montaserelsawy', '2020-11-25 21:08:33', '::1', 1),
(23, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (89) ', 'By: montaserelsawy', '2020-11-25 21:08:33', '::1', 1),
(24, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (88) ', 'By: montaserelsawy', '2020-11-25 21:08:33', '::1', 1),
(25, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (87) ', 'By: montaserelsawy', '2020-11-25 21:08:33', '::1', 1),
(26, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (86) ', 'By: montaserelsawy', '2020-11-25 21:08:33', '::1', 1),
(27, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (85) ', 'By: montaserelsawy', '2020-11-25 21:08:33', '::1', 1),
(28, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (84) ', 'By: montaserelsawy', '2020-11-25 21:08:33', '::1', 1),
(29, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (83) ', 'By: montaserelsawy', '2020-11-25 21:08:33', '::1', 1),
(30, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (82) ', 'By: montaserelsawy', '2020-11-25 21:08:33', '::1', 1),
(31, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (81) ', 'By: montaserelsawy', '2020-11-25 21:08:33', '::1', 1),
(32, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (80) ', 'By: montaserelsawy', '2020-11-25 21:08:33', '::1', 1),
(33, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (79) ', 'By: montaserelsawy', '2020-11-25 21:08:33', '::1', 1),
(34, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (78) ', 'By: montaserelsawy', '2020-11-25 21:08:33', '::1', 1),
(35, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (77) ', 'By: montaserelsawy', '2020-11-25 21:08:33', '::1', 1),
(36, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (76) ', 'By: montaserelsawy', '2020-11-25 21:08:33', '::1', 1),
(37, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (75) ', 'By: montaserelsawy', '2020-11-25 21:08:33', '::1', 1),
(38, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (74) ', 'By: montaserelsawy', '2020-11-25 21:08:33', '::1', 1),
(39, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (73) ', 'By: montaserelsawy', '2020-11-25 21:08:33', '::1', 1),
(40, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (72) ', 'By: montaserelsawy', '2020-11-25 21:08:33', '::1', 1),
(41, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (71) ', 'By: montaserelsawy', '2020-11-25 21:08:33', '::1', 1),
(42, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (70) ', 'By: montaserelsawy', '2020-11-25 21:08:33', '::1', 1),
(43, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (69) ', 'By: montaserelsawy', '2020-11-25 21:08:33', '::1', 1),
(44, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (68) ', 'By: montaserelsawy', '2020-11-25 21:08:33', '::1', 1),
(45, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (67) ', 'By: montaserelsawy', '2020-11-25 21:08:33', '::1', 1),
(46, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (66) ', 'By: montaserelsawy', '2020-11-25 21:08:33', '::1', 1),
(47, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (65) ', 'By: montaserelsawy', '2020-11-25 21:08:33', '::1', 1),
(48, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (64) ', 'By: montaserelsawy', '2020-11-25 21:08:34', '::1', 1),
(49, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (63) ', 'By: montaserelsawy', '2020-11-25 21:08:34', '::1', 1),
(50, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (62) ', 'By: montaserelsawy', '2020-11-25 21:08:34', '::1', 1),
(51, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (61) ', 'By: montaserelsawy', '2020-11-25 21:08:34', '::1', 1),
(52, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (60) ', 'By: montaserelsawy', '2020-11-25 21:08:34', '::1', 1),
(53, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (59) ', 'By: montaserelsawy', '2020-11-25 21:08:34', '::1', 1),
(54, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (58) ', 'By: montaserelsawy', '2020-11-25 21:08:34', '::1', 1),
(55, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (57) ', 'By: montaserelsawy', '2020-11-25 21:08:34', '::1', 1),
(56, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (56) ', 'By: montaserelsawy', '2020-11-25 21:08:34', '::1', 1),
(57, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (55) ', 'By: montaserelsawy', '2020-11-25 21:08:34', '::1', 1),
(58, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (54) ', 'By: montaserelsawy', '2020-11-25 21:08:34', '::1', 1),
(59, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (53) ', 'By: montaserelsawy', '2020-11-25 21:08:34', '::1', 1),
(60, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (52) ', 'By: montaserelsawy', '2020-11-25 21:08:34', '::1', 1),
(61, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (51) ', 'By: montaserelsawy', '2020-11-25 21:08:34', '::1', 1),
(62, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (50) ', 'By: montaserelsawy', '2020-11-25 21:08:34', '::1', 1),
(63, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (49) ', 'By: montaserelsawy', '2020-11-25 21:08:34', '::1', 1),
(64, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (48) ', 'By: montaserelsawy', '2020-11-25 21:08:34', '::1', 1),
(65, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (47) ', 'By: montaserelsawy', '2020-11-25 21:08:34', '::1', 1),
(66, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (46) ', 'By: montaserelsawy', '2020-11-25 21:08:34', '::1', 1),
(67, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (45) ', 'By: montaserelsawy', '2020-11-25 21:08:34', '::1', 1),
(68, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (44) ', 'By: montaserelsawy', '2020-11-25 21:08:34', '::1', 1),
(69, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (43) ', 'By: montaserelsawy', '2020-11-25 21:08:34', '::1', 1),
(70, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (42) ', 'By: montaserelsawy', '2020-11-25 21:08:34', '::1', 1),
(71, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (41) ', 'By: montaserelsawy', '2020-11-25 21:08:34', '::1', 1),
(72, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (40) ', 'By: montaserelsawy', '2020-11-25 21:08:34', '::1', 1),
(73, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (39) ', 'By: montaserelsawy', '2020-11-25 21:08:35', '::1', 1),
(74, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (38) ', 'By: montaserelsawy', '2020-11-25 21:08:35', '::1', 1),
(75, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (37) ', 'By: montaserelsawy', '2020-11-25 21:08:35', '::1', 1),
(76, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (36) ', 'By: montaserelsawy', '2020-11-25 21:08:35', '::1', 1),
(77, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (35) ', 'By: montaserelsawy', '2020-11-25 21:08:35', '::1', 1),
(78, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (34) ', 'By: montaserelsawy', '2020-11-25 21:08:35', '::1', 1),
(79, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (33) ', 'By: montaserelsawy', '2020-11-25 21:08:35', '::1', 1),
(80, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (32) ', 'By: montaserelsawy', '2020-11-25 21:08:35', '::1', 1),
(81, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (31) ', 'By: montaserelsawy', '2020-11-25 21:08:35', '::1', 1),
(82, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (30) ', 'By: montaserelsawy', '2020-11-25 21:08:35', '::1', 1),
(83, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (29) ', 'By: montaserelsawy', '2020-11-25 21:08:35', '::1', 1),
(84, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (28) ', 'By: montaserelsawy', '2020-11-25 21:08:35', '::1', 1),
(85, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (27) ', 'By: montaserelsawy', '2020-11-25 21:08:35', '::1', 1),
(86, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (26) ', 'By: montaserelsawy', '2020-11-25 21:08:35', '::1', 1),
(87, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (25) ', 'By: montaserelsawy', '2020-11-25 21:08:35', '::1', 1),
(88, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (24) ', 'By: montaserelsawy', '2020-11-25 21:08:35', '::1', 1),
(89, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (23) ', 'By: montaserelsawy', '2020-11-25 21:08:35', '::1', 1),
(90, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (22) ', 'By: montaserelsawy', '2020-11-25 21:08:35', '::1', 1),
(91, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (21) ', 'By: montaserelsawy', '2020-11-25 21:08:35', '::1', 1),
(92, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (20) ', 'By: montaserelsawy', '2020-11-25 21:08:35', '::1', 1),
(93, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (19) ', 'By: montaserelsawy', '2020-11-25 21:08:35', '::1', 1),
(94, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (18) ', 'By: montaserelsawy', '2020-11-25 21:08:35', '::1', 1),
(95, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (17) ', 'By: montaserelsawy', '2020-11-25 21:08:36', '::1', 1),
(96, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (16) ', 'By: montaserelsawy', '2020-11-25 21:08:36', '::1', 1),
(97, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (15) ', 'By: montaserelsawy', '2020-11-25 21:08:36', '::1', 1),
(98, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (14) ', 'By: montaserelsawy', '2020-11-25 21:08:36', '::1', 1),
(99, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (13) ', 'By: montaserelsawy', '2020-11-25 21:08:36', '::1', 1),
(100, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (12) ', 'By: montaserelsawy', '2020-11-25 21:08:36', '::1', 1),
(101, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (11) ', 'By: montaserelsawy', '2020-11-25 21:08:36', '::1', 1),
(102, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (10) ', 'By: montaserelsawy', '2020-11-25 21:08:36', '::1', 1),
(103, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (9) ', 'By: montaserelsawy', '2020-11-25 21:08:36', '::1', 1),
(104, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (8) ', 'By: montaserelsawy', '2020-11-25 21:08:36', '::1', 1),
(105, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (7) ', 'By: montaserelsawy', '2020-11-25 21:08:36', '::1', 1),
(106, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (6) ', 'By: montaserelsawy', '2020-11-25 21:08:36', '::1', 1),
(107, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (5) ', 'By: montaserelsawy', '2020-11-25 21:08:36', '::1', 1),
(108, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (4) ', 'By: montaserelsawy', '2020-11-25 21:08:36', '::1', 1),
(109, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (3) ', 'By: montaserelsawy', '2020-11-25 21:08:36', '::1', 1),
(110, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (2) ', 'By: montaserelsawy', '2020-11-25 21:08:36', '::1', 1),
(111, '/afsch/public/admin/contacts/_manage.php', 'Delete Contacts  - id num : (1) ', 'By: montaserelsawy', '2020-11-25 21:08:36', '::1', 1),
(112, '/afsch/public/admin/pages/_manage.php', 'Delete Page نبذة عن وكالة الرئاسة العامة لشؤون المسجد النبوي - id num : (30) ', 'By: montaserelsawy and all related translates', '2020-11-25 23:06:07', '::1', 1),
(113, '/afsch/public/admin/pages/_manage.php', 'Delete Page التنظيم الإداري لوكالة الرئاسة العامة لشؤون المسجد النبوي - id num : (31) ', 'By: montaserelsawy and all related translates', '2020-11-25 23:06:07', '::1', 1),
(114, '/afsch/public/admin/pages/_manage.php', 'Delete Page إدارات وكالة الرئاسة العامة لشؤون المسجد النبوي بالمدينة المنورة - id num : (32) ', 'By: montaserelsawy and all related translates', '2020-11-25 23:06:07', '::1', 1),
(115, '/afsch/public/admin/pages/_manage.php', 'Delete Page فضل المسجد النبوي - id num : (33) ', 'By: montaserelsawy and all related translates', '2020-11-25 23:06:07', '::1', 1),
(116, '/afsch/public/admin/pages/_manage.php', 'Delete Page عمارة المسجد النبوي - id num : (34) ', 'By: montaserelsawy and all related translates', '2020-11-25 23:06:07', '::1', 1),
(117, '/afsch/public/admin/pages/_manage.php', 'Delete Page آداب وأحكام زيارة المسجد النبوي - id num : (35) ', 'By: montaserelsawy and all related translates', '2020-11-25 23:06:07', '::1', 1),
(118, '/afsch/public/admin/pages/_manage.php', 'Delete Page تطبيقات الوكالة - id num : (37) ', 'By: montaserelsawy and all related translates', '2020-11-25 23:06:07', '::1', 1),
(119, '/afsch/public/admin/pages/_manage.php', 'Delete Page الرئيس العام - id num : (38) ', 'By: montaserelsawy and all related translates', '2020-11-25 23:06:07', '::1', 1),
(120, '/afsch/public/admin/pages/_manage.php', 'Delete Page وكيل الرئيس العام - id num : (39) ', 'By: montaserelsawy and all related translates', '2020-11-25 23:06:07', '::1', 1),
(121, '/afsch/public/admin/pages/_manage.php', 'Delete Page الأهداف الاستراتيجية - id num : (40) ', 'By: montaserelsawy and all related translates', '2020-11-25 23:06:07', '::1', 1),
(122, '/afsch/public/admin/pages/_manage.php', 'Delete Page مقدمة - id num : (41) ', 'By: montaserelsawy and all related translates', '2020-11-25 23:06:07', '::1', 1),
(123, '/afsch/public/admin/pages/_manage.php', 'Delete Page طلب البيانات المفتوحة - id num : (42) ', 'By: montaserelsawy and all related translates', '2020-11-25 23:06:07', '::1', 1),
(124, '/afsch/public/admin/pages/_manage.php', 'Delete Page سياسة الاستخدام - id num : (43) ', 'By: montaserelsawy and all related translates', '2020-11-25 23:06:07', '::1', 1),
(125, '/afsch/public/admin/pages/_manage.php', 'Delete Page البيانات المفتوحة - id num : (44) ', 'By: montaserelsawy and all related translates', '2020-11-25 23:06:07', '::1', 1),
(126, '/afsch/public/admin/pages/_manage.php', 'Delete Page معالم المسجد النبوي - id num : (45) ', 'By: montaserelsawy and all related translates', '2020-11-25 23:06:07', '::1', 1),
(127, '/afsch/public/admin/pages/_manage.php', 'Delete Page ساحات المسجد النبوي - id num : (46) ', 'By: montaserelsawy and all related translates', '2020-11-25 23:06:07', '::1', 1),
(128, '/afsch/public/admin/pages/_manage.php', 'Delete Page الروضة الشريفة - id num : (47) ', 'By: montaserelsawy and all related translates', '2020-11-25 23:06:07', '::1', 1),
(129, '/afsch/public/admin/pages/_manage.php', 'Delete Page الحجرة النبوية الشريفة - id num : (48) ', 'By: montaserelsawy and all related translates', '2020-11-25 23:06:07', '::1', 1),
(130, '/afsch/public/admin/pages/_manage.php', 'Delete Page منبر رسول الله صلى الله عليه وسلم - id num : (49) ', 'By: montaserelsawy and all related translates', '2020-11-25 23:06:07', '::1', 1),
(131, '/afsch/public/admin/pages/_manage.php', 'Delete Page محاريب المسجد النبوي - id num : (50) ', 'By: montaserelsawy and all related translates', '2020-11-25 23:06:07', '::1', 1),
(132, '/afsch/public/admin/pages/_manage.php', 'Delete Page الأساطين المشهورة - id num : (51) ', 'By: montaserelsawy and all related translates', '2020-11-25 23:06:07', '::1', 1),
(133, '/afsch/public/admin/pages/_manage.php', 'Delete Page أبواب المسجد النبوي - id num : (52) ', 'By: montaserelsawy and all related translates', '2020-11-25 23:06:07', '::1', 1),
(134, '/afsch/public/admin/pages/_manage.php', 'Delete Page مآذن المسجد النبوي - id num : (53) ', 'By: montaserelsawy and all related translates', '2020-11-25 23:06:07', '::1', 1),
(135, '/afsch/public/admin/pages/_manage.php', 'Delete Page تطبيق زائرينا - id num : (62) ', 'By: montaserelsawy and all related translates', '2020-11-25 23:06:08', '::1', 1),
(136, '/afsch/public/admin/photos/_manage.php?photo_sec=admin', 'Delete Photo 807A8660id num : (1029)', 'By: montaserelsawy', '2020-11-25 23:06:46', '::1', 1),
(137, '/afsch/public/admin/photos/_manage.php?photo_sec=admin', 'Delete Photo 807A8656id num : (1028)', 'By: montaserelsawy', '2020-11-25 23:06:46', '::1', 1),
(138, '/afsch/public/admin/photos/_manage.php?photo_sec=admin', 'Delete Photo QJ9A8836id num : (1027)', 'By: montaserelsawy', '2020-11-25 23:06:46', '::1', 1),
(139, '/afsch/public/admin/photos/_manage.php?photo_sec=admin', 'Delete Photo DSC_0535id num : (1026)', 'By: montaserelsawy', '2020-11-25 23:06:46', '::1', 1),
(140, '/afsch/public/admin/photos/_manage.php?photo_sec=admin', 'Delete Photo 1474203436id num : (1024)', 'By: montaserelsawy', '2020-11-25 23:06:46', '::1', 1),
(141, '/afsch/public/admin/photos/_manage.php?photo_sec=admin', 'Delete Photo DSC_5382id num : (1002)', 'By: montaserelsawy', '2020-11-25 23:06:46', '::1', 1),
(142, '/afsch/public/admin/photos/_manage.php?photo_sec=admin', 'Delete Photo 4id num : (1001)', 'By: montaserelsawy', '2020-11-25 23:06:46', '::1', 1),
(143, '/afsch/public/admin/photos/_manage.php?photo_sec=admin', 'Delete Photo دليل ارشادس المسجد النبويid num : (1000)', 'By: montaserelsawy', '2020-11-25 23:06:46', '::1', 1),
(144, '/afsch/public/admin/files/_manage.php', 'Delete File دليل ارشادي المنطقة المركزية - id num : (2) ', 'By: montaserelsawy', '2020-11-25 23:07:01', '::1', 1),
(145, '/afsch/public/admin/files/_manage.php', 'Delete File الدليل الشامل لزائري المسجد النبوي - id num : (1) ', 'By: montaserelsawy', '2020-11-25 23:07:01', '::1', 1),
(146, '/afsch/public/admin/languages/_manage.php', 'Delete Language أردو - id num : (3) ', 'By: montaserelsawy and all related translates and files', '2020-11-25 23:08:32', '::1', 1),
(147, '/afsch/public/admin/languages/_manage.php', 'Delete Language Français - id num : (4) ', 'By: montaserelsawy and all related translates and files', '2020-11-25 23:08:32', '::1', 1),
(148, '/afsch/public/admin/languages/_manage.php', 'Delete Language bahasa Indonesia - id num : (5) ', 'By: montaserelsawy and all related translates and files', '2020-11-25 23:08:32', '::1', 1),
(149, '/afsch/public/admin/medias/_manage.php?gallery_id=1', 'Delete Media DSC_2240 - id num : (1) ', 'By: montaserelsawy and all related translates', '2020-11-25 23:08:50', '::1', 1),
(150, '/afsch/public/admin/medias/_manage.php?gallery_id=1', 'Delete Media DSC_5382 - id num : (2) ', 'By: montaserelsawy and all related translates', '2020-11-25 23:08:50', '::1', 1),
(151, '/afsch/public/admin/galleries/_manage.php', 'Delete Gallery مكتبة الصور - id num : (1) ', 'By: montaserelsawy and all related translates', '2020-11-25 23:08:59', '::1', 1),
(152, '/afsch/public/admin/galleries/_manage.php', 'Delete Gallery مكتبة الفيديو - id num : (2) ', 'By: montaserelsawy and all related translates', '2020-11-25 23:08:59', '::1', 1),
(153, '/afsch/public/admin/site_config/_edit.php?id=1', 'Add New Photo: مدارس عبدالرحمن فقيه النموذجية للبنين', 'By: montaserelsawy', '2020-11-25 23:14:26', '::1', 1),
(154, '/afsch/public/admin/site_config/_edit.php?id=1', 'Add New Photo: مدارس عبدالرحمن فقيه النموذجية للبنين', 'By: montaserelsawy', '2020-11-25 23:14:26', '::1', 1),
(155, '/afsch/public/admin/site_config/_edit.php?id=1', 'Update Site Config: مدارس عبدالرحمن فقيه النموذجية للبنين ', 'By: montaserelsawy', '2020-11-25 23:14:26', '::1', 1),
(156, '/afsch/public/admin/menus/_manage.php', 'Delete Menu Item عن الوكالة - id num : (271) ', 'By: montaserelsawy and all related translates', '2020-11-25 23:17:11', '::1', 1),
(157, '/afsch/public/admin/menus/_manage.php', 'Delete Menu Item المسجد النبوي - id num : (349) ', 'By: montaserelsawy and all related translates', '2020-11-25 23:17:11', '::1', 1),
(158, '/afsch/public/admin/menus/_manage.php', 'Delete Menu Item الخدمات الإلكترونية - id num : (330) ', 'By: montaserelsawy and all related translates', '2020-11-25 23:17:11', '::1', 1),
(159, '/afsch/public/admin/menus/_manage.php', 'Delete Menu Item إصدارات الوكالة - id num : (334) ', 'By: montaserelsawy and all related translates', '2020-11-25 23:17:11', '::1', 1),
(160, '/afsch/public/admin/menus/_manage.php', 'Delete Menu Item بوابة الموظفين - id num : (332) ', 'By: montaserelsawy and all related translates', '2020-11-25 23:17:49', '::1', 1),
(161, '/afsch/public/admin/layout/index.php?page_id=28', 'Update Layout: 2020-11-25 23:36:51 ', 'By: montaserelsawy', '2020-11-25 23:36:51', '::1', 1),
(162, '/afsch/public/admin/menus/_add.php?menu_type=0', 'Add New Menu Item: عن المدارس ', 'By: montaserelsawy', '2020-11-25 23:40:04', '::1', 1),
(163, '/afsch/public/admin/menus/_add.php?menu_type=0', 'Add New Menu Item: المراحل التعليمية ', 'By: montaserelsawy', '2020-11-25 23:40:15', '::1', 1),
(164, '/afsch/public/admin/menus/_add.php?menu_type=0', 'Add New Menu Item: القبول والتسجيل ', 'By: montaserelsawy', '2020-11-25 23:40:32', '::1', 1),
(165, '/afsch/public/admin/menus/_add.php?menu_type=0', 'Add New Menu Item: التعليم الالكتروني ', 'By: montaserelsawy', '2020-11-25 23:40:47', '::1', 1),
(166, '/afsch/public/admin/menus/_add.php?menu_type=0', 'Add New Menu Item: كوادرنا ', 'By: montaserelsawy', '2020-11-25 23:41:17', '::1', 1),
(167, '/afsch/public/admin/menus/_add.php?menu_type=0', 'Add New Menu Item: الوظائف ', 'By: montaserelsawy', '2020-11-25 23:41:32', '::1', 1),
(168, '/afsch/public/admin/pages/_add.php', 'Add New Page: الرؤية والرسالة والقيم ', 'By: montaserelsawy', '2020-11-25 23:52:06', '::1', 1),
(169, '/afsch/public/admin/pages/_add.php', 'Add New Page: كلمة الشيخ عبدالرحمن فقيه ', 'By: montaserelsawy', '2020-11-25 23:56:27', '::1', 1),
(170, '/afsch/public/admin/pages/_add.php', 'Add New Page: كلمة مدير عام المدارس ', 'By: montaserelsawy', '2020-11-25 23:56:47', '::1', 1),
(171, '/afsch/public/admin/pages/_add.php', 'Add New Page: مجلس الإدارة ', 'By: montaserelsawy', '2020-11-25 23:58:00', '::1', 1),
(172, '/afsch/public/admin/pages/_add.php', 'Add New Page: إدارات وشؤون المدرسة ', 'By: montaserelsawy', '2020-11-25 23:58:13', '::1', 1),
(173, '/afsch/public/admin/pages/_add.php', 'Add New Page: مدارسنا بأقلامهم ', 'By: montaserelsawy', '2020-11-25 23:58:31', '::1', 1),
(174, '/afsch/public/admin/pages/_add.php', 'Add New Page: إدارة التطوير والاشراف التربوي ', 'By: montaserelsawy', '2020-11-25 23:59:11', '::1', 1),
(175, '/afsch/public/admin/pages/_add.php', 'Add New Page: الاعتماد الدولي ', 'By: montaserelsawy', '2020-11-25 23:59:26', '::1', 1),
(176, '/afsch/public/admin/pages/_add.php', 'Add New Page: المكتبة العامة ', 'By: montaserelsawy', '2020-11-25 23:59:43', '::1', 1),
(177, '/afsch/public/admin/pages/_add.php', 'Add New Page: مصادر التعلم ', 'By: montaserelsawy', '2020-11-25 23:59:59', '::1', 1),
(178, '/afsch/public/admin/pages/_add.php', 'Add New Page: النادي الرياضي ', 'By: montaserelsawy', '2020-11-26 00:00:16', '::1', 1),
(179, '/afsch/public/admin/pages/_add.php', 'Add New Page: الورش المهنية ', 'By: montaserelsawy', '2020-11-26 00:00:27', '::1', 1),
(180, '/afsch/public/admin/menus/_add.php?menu_type=0', 'Add New Menu Item: المرحلة الابتدائية ', 'By: montaserelsawy', '2020-11-26 00:03:09', '::1', 1),
(181, '/afsch/public/admin/menus/_add.php?menu_type=0', 'Add New Menu Item: المرحلة المتوسطة ', 'By: montaserelsawy', '2020-11-26 00:03:30', '::1', 1),
(182, '/afsch/public/admin/menus/_add.php?menu_type=0', 'Add New Menu Item: المرحلة الثانوية ', 'By: montaserelsawy', '2020-11-26 00:03:46', '::1', 1),
(183, '/afsch/public/admin/mains/_manage.php', 'Delete Main Category Item أخبار الوكالة - id num : (15) ', 'By: montaserelsawy and all related translates', '2020-11-26 00:04:26', '::1', 1),
(184, '/afsch/public/admin/mains/_manage.php', 'Delete Main Category Item الفعاليات - id num : (16) ', 'By: montaserelsawy and all related translates', '2020-11-26 00:04:26', '::1', 1),
(185, '/afsch/public/admin/mains/_manage.php', 'Delete Main Category Item العرض الصحفي - id num : (17) ', 'By: montaserelsawy and all related translates', '2020-11-26 00:04:26', '::1', 1),
(186, '/afsch/public/admin/mains/_add.php', 'Add New Main Category Item: المرحلة الإبتدائية مسار وطني ', 'By: montaserelsawy', '2020-11-26 00:05:25', '::1', 1),
(187, '/afsch/public/admin/mains/_edit.php?id=1', 'Update MainCategory: المرحلة الإبتدائية مسار وطني ', 'By: montaserelsawy', '2020-11-26 00:05:51', '::1', 1),
(188, '/afsch/public/admin/mains/_add.php', 'Add New Main Category Item: المرحلة الإبتدائية مسار دولي ', 'By: montaserelsawy', '2020-11-26 00:06:32', '::1', 1),
(189, '/afsch/public/admin/mains/_add.php', 'Add New Main Category Item: المرحلة المتوسطة  مسار وطني ', 'By: montaserelsawy', '2020-11-26 00:07:00', '::1', 1),
(190, '/afsch/public/admin/mains/_add.php', 'Add New Main Category Item: المرحلة المتوسطة مسار دولي ', 'By: montaserelsawy', '2020-11-26 00:07:30', '::1', 1),
(191, '/afsch/public/admin/mains/_add.php', 'Add New Main Category Item: المرحلة الثانوية مسار وطني ', 'By: montaserelsawy', '2020-11-26 00:07:48', '::1', 1),
(192, '/afsch/public/admin/menus/_edit.php?id=425', 'Update Menu: مسار وطني ', 'By: montaserelsawy', '2020-11-26 00:08:38', '::1', 1),
(193, '/afsch/public/admin/menus/_edit.php?id=426', 'Update Menu: مسار دولي ', 'By: montaserelsawy', '2020-11-26 00:09:30', '::1', 1),
(194, '/afsch/public/admin/menus/_edit.php?id=427', 'Update Menu: مسار وطني ', 'By: montaserelsawy', '2020-11-26 00:09:41', '::1', 1),
(195, '/afsch/public/admin/menus/_edit.php?id=428', 'Update Menu: مسار دولي ', 'By: montaserelsawy', '2020-11-26 00:09:57', '::1', 1),
(196, '/afsch/public/admin/menus/_edit.php?id=429', 'Update Menu: مسار وطني ', 'By: montaserelsawy', '2020-11-26 00:10:09', '::1', 1),
(197, '/afsch/public/admin/modules/_edit.php?id=26', 'Update Module: أخبار المدرسة ', 'By: montaserelsawy', '2020-11-26 00:11:27', '::1', 1),
(198, '/afsch/public/admin/modules/_edit.php?id=26', 'Update Module: أخبار المدرسة ', 'By: montaserelsawy', '2020-11-26 00:11:35', '::1', 1),
(199, '/afsch/public/admin/modules/_manage.php', 'Delete Module اخر المنتجات - id num : (27) ', 'By: montaserelsawy and all related translates', '2020-11-26 00:11:42', '::1', 1),
(200, '/afsch/public/admin/modules/_add.php', 'Add New Module: إستمارة التسجيل ', 'By: montaserelsawy', '2020-11-26 00:12:20', '::1', 1),
(201, '/afsch/public/admin/pages/_add.php', 'Add New Page: نظام القبول والتسجيل ', 'By: montaserelsawy', '2020-11-26 00:13:37', '::1', 1),
(202, '/afsch/public/actions/join_request_upload_photo.php', 'Add New Photo: 01.png', 'By: visitor', '2020-11-26 00:17:04', '::1', 1),
(203, '/afsch/public/admin/menus/_manage.php', 'Delete Menu Item الوظائف - id num : (409) ', 'By: montaserelsawy and all related translates', '2020-11-26 00:19:34', '::1', 1),
(204, '/afsch/public/admin/pages/_add.php', 'Add New Page: الوظائف ', 'By: montaserelsawy', '2020-11-26 00:20:07', '::1', 1),
(205, '/afsch/public/admin/pages/_add.php', 'Add New Page: الرسوم الدراسية ', 'By: montaserelsawy', '2020-11-26 00:21:19', '::1', 1),
(206, '/afsch/public/admin/pages/_add.php', 'Add New Page: نظام النقل والمواصلات ', 'By: montaserelsawy', '2020-11-26 00:21:33', '::1', 1),
(207, '/afsch/public/admin/mains/_add.php', 'Add New Main Category Item: الإدارة العامة ', 'By: montaserelsawy', '2020-11-26 00:22:43', '::1', 1),
(208, '/afsch/public/admin/mains/_add.php', 'Add New Main Category Item: إدارة التطوير والاشراف التربوي ', 'By: montaserelsawy', '2020-11-26 00:23:00', '::1', 1),
(209, '/afsch/public/admin/mains/_add.php', 'Add New Main Category Item: الإدارة المالية ', 'By: montaserelsawy', '2020-11-26 00:23:11', '::1', 1),
(210, '/afsch/public/admin/mains/_add.php', 'Add New Main Category Item: المرحلة الابتدائية ', 'By: montaserelsawy', '2020-11-26 00:23:29', '::1', 1),
(211, '/afsch/public/admin/mains/_add.php', 'Add New Main Category Item: المرحلة المتوسطة ', 'By: montaserelsawy', '2020-11-26 00:23:43', '::1', 1),
(212, '/afsch/public/admin/mains/_add.php', 'Add New Main Category Item: المرحلة الثانوية ', 'By: montaserelsawy', '2020-11-26 00:23:57', '::1', 1),
(213, '/afsch/public/admin/mains/_add.php', 'Add New Main Category Item: أخبار المدرسة ', 'By: montaserelsawy', '2020-11-26 00:27:07', '::1', 1),
(214, '/afsch/public/admin/mains/_edit.php?id=1', 'Update MainCategory: المرحلة الإبتدائية مسار وطني ', 'By: montaserelsawy', '2020-11-26 00:27:50', '::1', 1),
(215, '/afsch/public/admin/mains/_edit.php?id=2', 'Update MainCategory: المرحلة الإبتدائية مسار دولي ', 'By: montaserelsawy', '2020-11-26 00:28:01', '::1', 1),
(216, '/afsch/public/admin/mains/_edit.php?id=3', 'Update MainCategory: المرحلة المتوسطة  مسار وطني ', 'By: montaserelsawy', '2020-11-26 00:28:08', '::1', 1),
(217, '/afsch/public/admin/mains/_edit.php?id=4', 'Update MainCategory: المرحلة المتوسطة مسار دولي ', 'By: montaserelsawy', '2020-11-26 00:28:17', '::1', 1),
(218, '/afsch/public/admin/mains/_edit.php?id=5', 'Update MainCategory: المرحلة الثانوية مسار وطني ', 'By: montaserelsawy', '2020-11-26 00:28:24', '::1', 1),
(219, '/afsch/public/admin/mains/_edit.php?id=6', 'Update MainCategory: الإدارة العامة ', 'By: montaserelsawy', '2020-11-26 00:28:31', '::1', 1),
(220, '/afsch/public/admin/mains/_edit.php?id=6', 'Update MainCategory: الإدارة العامة ', 'By: montaserelsawy', '2020-11-26 00:28:51', '::1', 1),
(221, '/afsch/public/admin/menus/_manage.php', 'Delete Menu Item الأخبار - id num : (326) ', 'By: montaserelsawy and all related translates', '2020-11-26 00:29:32', '::1', 1),
(222, '/afsch/public/admin/menus/_add.php?menu_type=0', 'Add New Menu Item: أحداث المدارس ', 'By: montaserelsawy', '2020-11-26 00:29:55', '::1', 1),
(223, '/afsch/public/admin/menus/_manage.php?menu_type=0', 'Delete Menu Item أحداث المدارس - id num : (441) ', 'By: montaserelsawy and all related translates', '2020-11-26 00:30:10', '::1', 1),
(224, '/afsch/public/admin/pages/_add.php', 'Add New Page: أحداث المدارس ', 'By: montaserelsawy', '2020-11-26 00:30:34', '::1', 1),
(225, '/afsch/public/admin/pages/_add.php', 'Add New Page: البث المباشر ', 'By: montaserelsawy', '2020-11-26 00:31:00', '::1', 1),
(226, '/afsch/public/admin/menus/_add.php?menu_type=0', 'Add New Menu Item: ألبومات المدارس ', 'By: montaserelsawy', '2020-11-26 00:31:25', '::1', 1),
(227, '/afsch/public/admin/galleries/_add.php', 'Add New Gallery: ألبومات المرحلة الابتدائية ', 'By: montaserelsawy', '2020-11-26 00:32:07', '::1', 1),
(228, '/afsch/public/admin/galleries/_add.php', 'Add New Gallery: ألبومات المرحلة المتوسطة ', 'By: montaserelsawy', '2020-11-26 00:32:19', '::1', 1),
(229, '/afsch/public/admin/galleries/_add.php', 'Add New Gallery: ألبومات المرحلة الثانوية ', 'By: montaserelsawy', '2020-11-26 00:32:31', '::1', 1),
(230, '/afsch/public/?module=Search&search=%D8%A7%D9%84%D9%85%D8%AA%D9%88%D8%B3%D8%B7%D8%A9&submit=Search', 'Search: المتوسطة ', 'By: Visitor', '2020-11-26 00:32:47', '::1', 1),
(231, '/afsch/public/admin/pages/_add.php', 'Add New Page: رواد الغد ', 'By: montaserelsawy', '2020-11-26 00:33:58', '::1', 1),
(232, '/afsch/public/admin/layout/index.php?page_id=28', 'Update Layout: 2020-11-26 08:13:56 ', 'By: montaserelsawy', '2020-11-26 08:13:56', '::1', 1),
(233, '/afsch/public/admin/plugins/_add.php', 'Add New Plugin: أخر الأخبار ', 'By: montaserelsawy', '2020-11-26 08:14:59', '::1', 1),
(234, '/afsch/public/admin/layout/index.php?page_id=28', 'Update Layout: 2020-11-26 08:15:14 ', 'By: montaserelsawy', '2020-11-26 08:15:14', '::1', 1),
(235, '/afsch/public/admin/plugins/_edit.php?id=66', 'Update Plugin: أخر الأخبار ', 'By: montaserelsawy', '2020-11-26 08:15:59', '::1', 1),
(236, '/afsch/public/admin/plugins/_edit.php?id=62', 'Update Plugin: تغريدات المدرسة ', 'By: montaserelsawy', '2020-12-06 06:00:58', '::1', 1),
(237, '/afsch/public/admin/plugins/_edit.php?id=62', 'Update Plugin: تغريدات المدرسة ', 'By: montaserelsawy', '2020-12-06 06:05:01', '::1', 1),
(238, '/afsch/public/admin/plugins/_edit.php?id=60', 'Update Plugin: عنوان المدرسة على خريطة جوجل ', 'By: montaserelsawy', '2020-12-06 06:07:40', '::1', 1),
(239, '/afsch/public/admin/plugins/_manage.php', 'Delete Plugin سلايدر صور البانوراما - الرئيسية - id num : (31) ', 'By: montaserelsawy and all related translates', '2020-12-06 06:10:29', '::1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE `ads` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL,
  `lang_id` int(11) DEFAULT NULL,
  `publish` int(1) DEFAULT NULL,
  `sort_id` int(1) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `target` varchar(50) DEFAULT NULL,
  `photo` int(11) DEFAULT NULL,
  `ad_type` varchar(10) DEFAULT 'image',
  `adsec_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`id`, `title`, `content`, `lang_id`, `publish`, `sort_id`, `url`, `target`, `photo`, `ad_type`, `adsec_id`, `created`, `updated`) VALUES
(3, 'بانوراما 1', 'بانوراما 1', 2, 1, 1, '#', '_self', 992, 'image', 7, '2019-12-30 10:32:53', '0000-00-00 00:00:00'),
(4, 'ابشر', NULL, 2, 1, 1, 'https://www.absher.sa/', '_blank', 1003, 'image', 9, '2020-01-25 12:23:38', NULL),
(5, 'موقع نور', NULL, 2, 1, 2, 'https://noor.moe.gov.sa/Noor/login.aspx', '_blank', 1004, 'image', 9, '2020-01-25 12:26:39', NULL),
(6, 'البريد السعودي', NULL, 2, 1, 3, 'https://www.sp.com.sa/', '_blank', 1005, 'image', 9, '2020-01-25 12:27:37', NULL),
(7, 'وزارة الصحة', NULL, 2, 1, 4, 'https://www.moh.gov.sa/', '_blank', 1006, 'image', 9, '2020-01-25 12:29:14', NULL),
(8, 'مبادرة خير امه', NULL, 2, 0, 5, 'https://khairumma.sa/', '_blank', 1007, 'image', 9, '2020-01-25 12:30:03', NULL),
(9, 'رؤية 2030', NULL, 2, 0, 1, 'https://vision2030.gov.sa/', '_blank', 1008, 'image', 10, '2020-01-25 14:27:02', NULL),
(10, 'الخدمات الإلكترونية', NULL, 2, 1, 2, 'https://eservices.wmn.gov.sa/', '_blank', 1009, 'image', 10, '2020-01-25 14:32:57', NULL),
(11, 'التواصل مع الرئيس', NULL, 2, 1, 3, 'https://eservice.gph.gov.sa/ContactShekh/ContactUs.aspx', '_blank', 1010, 'image', 10, '2020-01-25 14:33:43', NULL),
(12, 'الحرمين مباشر', NULL, 2, 0, 4, 'https://eservice.gph.gov.sa/out/stream/stream.html', '_blank', 1011, 'image', 10, '2020-01-25 14:37:31', NULL),
(13, 'استطلاع رأي الزوار', NULL, 2, 0, 5, 'https://eservices.wmn.gov.sa/haram_visitor_service/', '_blank', 1012, 'image', 10, '2020-01-25 14:38:37', NULL),
(14, 'معهد المسجد النبوي', NULL, 2, 1, 6, 'http://ins.gph.edu.sa/', '_blank', 1013, 'image', 10, '2020-01-25 14:39:36', NULL),
(15, 'منبر الحرمين', NULL, 2, 0, 7, '#', '_self', 1014, 'image', 10, '2020-01-25 14:43:05', NULL),
(16, 'التسجيل الخاص بافراد المجتمع', NULL, 2, 0, 8, 'https://eservices.wmn.gov.sa/TRS/TRS_0009.aspx', '_blank', 1015, 'image', 10, '2020-01-25 14:43:44', NULL),
(17, 'مواقيت الصلاة', NULL, 2, 0, 9, '#', '_self', 1016, 'image', 10, '2020-01-25 14:45:03', NULL),
(18, 'النادي الإجتماعي', NULL, 2, 0, 10, 'https://#', '_self', 1017, 'image', 10, '2020-01-25 14:45:50', NULL),
(19, 'جدول الأئمة', NULL, 2, 1, 11, '#', '_blank', 1018, 'image', 10, '2020-01-25 14:46:42', NULL),
(20, 'خير امه', NULL, 2, 0, 12, 'https://khairumma.sa/', '_blank', 1019, 'image', 10, '2020-01-25 14:47:40', NULL),
(21, 'هيئة تطوير منطقة المدينة المنورة', NULL, 2, 1, 6, 'https://www.mda.gov.sa/', '_blank', 1021, 'image', 9, '2020-01-28 13:50:58', NULL),
(22, 'أمانة منطقة المدينة المنورة', NULL, 2, 1, 7, 'https://www.amana-md.gov.sa/', '_blank', 1022, 'image', 9, '2020-01-28 13:58:30', NULL),
(23, 'إمارة منطقة المدينة المنورة', NULL, 2, 1, 8, 'https://www.moi.gov.sa/wps/portal/Home/emirates/madinah/!ut/p/z1/04_iUlDg4tKPAFJABjKBwtGPykssy0xPLMnMz0vM0Y_Qj4wyizfwNDHxMDQx8jbwcDM0cAx09nE1MnMzMvA31ffSj8KvIDixSL8gO1ARAOXfq0A!/', '_blank', 1023, 'image', 9, '2020-01-28 14:14:28', NULL);

--
-- Triggers `ads`
--
DELIMITER $$
CREATE TRIGGER `ads_AFTER_DELETE` AFTER DELETE ON `ads` FOR EACH ROW BEGIN
 DELETE FROM `translator` where parent_id = OLD.id and item_type='ad';
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `ads_sections`
--

CREATE TABLE `ads_sections` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `lang_id` int(11) DEFAULT NULL,
  `publish` int(1) DEFAULT NULL,
  `site_id` int(11) NOT NULL DEFAULT 1,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `ads_sections`
--

INSERT INTO `ads_sections` (`id`, `title`, `lang_id`, `publish`, `site_id`, `created`, `updated`) VALUES
(7, 'صور سلايدر الواجهة', 2, 1, 1, '2016-10-13 10:07:05', '2019-03-09 01:13:39'),
(8, 'الإعلانات الجانبية', 2, 1, 1, '2019-02-22 17:54:22', '2019-02-22 17:54:33'),
(9, 'شعارات اسفل الموقع', 2, 1, 1, '2020-01-25 12:21:56', NULL),
(10, 'ايكونات الخدمات فى الرئيسية', 2, 1, 1, '2020-01-25 14:25:34', NULL);

--
-- Triggers `ads_sections`
--
DELIMITER $$
CREATE TRIGGER `ads_sections_AFTER_DELETE` AFTER DELETE ON `ads_sections` FOR EACH ROW BEGIN
  DELETE FROM `translator` where parent_id = OLD.id and item_type='adsec';
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `msg` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `visitor_ip` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `site_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `has_link` int(1) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `lang_id` int(11) DEFAULT NULL,
  `target` varchar(10) DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `sort_id` int(11) DEFAULT NULL,
  `publish` int(1) DEFAULT NULL,
  `site_id` int(11) DEFAULT 1,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `event_config`
--

CREATE TABLE `event_config` (
  `id` int(11) NOT NULL,
  `event_date` datetime DEFAULT NULL,
  `today` int(1) DEFAULT NULL,
  `site_id` int(11) DEFAULT 1,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `event_config`
--

INSERT INTO `event_config` (`id`, `event_date`, `today`, `site_id`, `updated`) VALUES
(1, '2018-11-07 21:47:00', 0, 1, '2019-01-03 21:47:25');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `size` varchar(50) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `publish` int(1) DEFAULT NULL,
  `site_id` int(11) DEFAULT 1,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `url_alias` varchar(255) DEFAULT NULL,
  `module_id` int(11) DEFAULT NULL,
  `folder` varchar(255) DEFAULT NULL,
  `lang_id` int(11) DEFAULT NULL,
  `paging` int(4) DEFAULT NULL,
  `thumb_height` int(7) DEFAULT NULL,
  `thumb_width` int(7) DEFAULT NULL,
  `image_height` int(7) DEFAULT NULL,
  `image_width` int(7) DEFAULT NULL,
  `publish` int(1) DEFAULT NULL,
  `counter` int(11) DEFAULT 0,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `site_id` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `galleries`
--

INSERT INTO `galleries` (`id`, `title`, `url_alias`, `module_id`, `folder`, `lang_id`, `paging`, `thumb_height`, `thumb_width`, `image_height`, `image_width`, `publish`, `counter`, `created`, `updated`, `site_id`) VALUES
(1, 'ألبومات المرحلة الابتدائية', 'gallery_504767', 22, 'gallery_504767', 2, 21, 200, 200, 1500, 1500, 1, NULL, '2020-11-26 00:32:07', NULL, 1),
(2, 'ألبومات المرحلة المتوسطة', 'gallery_817227', 22, 'gallery_817227', 2, 21, 200, 200, 1500, 1500, 1, NULL, '2020-11-26 00:32:18', NULL, 1),
(3, 'ألبومات المرحلة الثانوية', 'gallery_620121', 22, 'gallery_620121', 2, 21, 200, 200, 1500, 1500, 1, NULL, '2020-11-26 00:32:31', NULL, 1);

--
-- Triggers `galleries`
--
DELIMITER $$
CREATE TRIGGER `galleries_AFTER_DELETE` AFTER DELETE ON `galleries` FOR EACH ROW BEGIN
 DELETE FROM `translator` where parent_id = OLD.id and item_type='gallery';
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `job_requests`
--

CREATE TABLE `job_requests` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `gender` int(1) DEFAULT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `file_id` int(11) NOT NULL,
  `notes` mediumtext DEFAULT NULL,
  `created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `join_requests`
--

CREATE TABLE `join_requests` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `gender` int(1) DEFAULT NULL,
  `birth_date` varchar(50) DEFAULT NULL,
  `nationality` varchar(255) DEFAULT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `id_no` int(10) NOT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `photo` int(11) NOT NULL,
  `stage_no` int(1) NOT NULL,
  `level_no` int(1) NOT NULL,
  `category_id` int(1) NOT NULL,
  `parent_full_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `parent_id_no` int(10) NOT NULL,
  `parent_mobile` varchar(50) NOT NULL,
  `parent_email` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `langs`
--

CREATE TABLE `langs` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `xml_path` varchar(100) DEFAULT NULL,
  `alias` varchar(50) DEFAULT NULL,
  `direction` varchar(50) DEFAULT NULL,
  `publish` int(1) DEFAULT NULL,
  `defaults` int(1) DEFAULT NULL,
  `css_path` varchar(100) DEFAULT NULL,
  `phrases` longtext DEFAULT NULL,
  `font` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `langs`
--

INSERT INTO `langs` (`id`, `title`, `xml_path`, `alias`, `direction`, `publish`, `defaults`, `css_path`, `phrases`, `font`) VALUES
(1, 'English', 'en.xml', 'en', 'ltr', 1, 0, 'style.css', '{\"_site_msg_filenotfound\":\"Error: File Not Found\",\"_site_adminactions_back\":\"Back\",\"_site_msg_error404\":\"Error\",\"_site_msg_pagenotfound\":\"Page not Found\",\"_site_msg_errormsg\":\"We\'re sorry, but the page you were looking for doesn\'t exist.\",\"_site_msg_backhome\":\"Back Home\",\"_site_msg_invalidsubmit\":\"Invalid submit\",\"_site_msg_donepublish\":\"Publishing Done Successfully!\",\"_site_msg_doneunpublish\":\"UnPublish Done Successfully!\",\"_site_msg_cantdo\":\"Can not do this action!\",\"_site_msg_checkonlyone\":\"You have to check only one record to do this action!\",\"_site_msg_notvalid\":\"Invalid values\",\"_site_msg_cantmoveup\":\"Can\'t move  Up\",\"_site_msg_donesort\":\"Sorting Done Successfully !\",\"_site_msg_cantmovedown\":\"Can\'t move down\",\"_site_msg_sucupdate\":\"Updated Successfully\",\"_site_msg_allrequire\":\"Please Fill In Required Fields!\",\"_site_msg_longer\":\"The Entry Can\'t Be Longer Than 255 Chars!\",\"_site_msg_notvalidurl\":\"Please enter valid URL including http:\\/\\/\",\"_site_msg_codenotfound\":\"Code not found\",\"_site_msg_nofile\":\"File not exists\",\"_site_file_msg_notfile\":\"Can not upload this file .. this is not an allowed file ext.!\",\"_site_msg_longer255\":\"The Entry Can\'t Be Longer Than 255 Chars!\",\"_site_file_msg_cantfind\":\"The File Location Is Not Avaliable!\",\"_site_msg_exists\":\"File already exists\",\"_site_msg_dirper\":\"Upload failure due to incorrect permission to upload folder.\",\"_site_filemanager_labels_download\":\"Download\",\"_site_filemanager_labels_extract\":\"Extract\",\"_site_filemanager_titles_edit\":\"Edit\",\"_site_filemanager_msg_delsuc\":\"Deleted Successfully\",\"_site_filemanager_msg_cantdel\":\"Error in deleting process\",\"_site_filemanager_labels_back\":\"Back\",\"_site_filemanager_labels_name\":\"Name\",\"_site_filemanager_labels_uncomsize\":\"Uncompressed Size\",\"_site_filemanager_labels_comsize\":\"Compressed Size\",\"_site_filemanager_labels_comratio\":\"Compressed Ratio\",\"_site_filemanager_labels_date\":\"Date\",\"_site_filemanager_labels_filein\":\"Files In\",\"_site_filemanager_msg_failed\":\"Failed\",\"_site_filemanager_msg_createsuc\":\"Created Successfully\",\"_site_filemanager_msg_cantcreate\":\"Can\'t create file\",\"_site_filemanager_msg_dirnotwritable\":\"Dirictory is not writable\",\"_site_filemanager_msg_fileexists\":\"File already exists\",\"_site_filemanager_msg_direxist\":\"Directory already exists\",\"_site_filemanager_msg_ok\":\"Done\",\"_site_filemanager_msg_uploaded\":\"File Uploaded Successfully\",\"_site_filemanager_msg_uploaderror\":\"File Upload Error\",\"_site_msg_undefined\":\"Undefined\",\"_site_msg_urlalias\":\"This alias is already exist!\",\"_site_msg_aliasexist\":\"This Alias is already exist!\",\"_site_msg_validemail\":\"Please enter a valid e-mail address!\",\"_site_msg_mailexist\":\"E-mail is exist!\",\"_site_frontend_contact_msg_captchaerror\":\"Error Verification Code\",\"_site_config_dir\":\"ltr\",\"_site_frontend_contact_msg_subject\":\"New Contact Message\",\"_site_frontend_contact_lables_name\":\"Name\",\"_site_frontend_contact_lables_email\":\"Email\",\"_site_frontend_contact_lables_phone\":\"Phone\",\"_site_frontend_contact_lables_msg\":\"Message\",\"_site_config_align\":\"left\",\"_site_frontend_contact_lables_date\":\"Date\",\"_site_frontend_contact_lables_ip\":\"IP\",\"_site_frontend_msg_sentsuccess\":\"Message Sent Successfully!\",\"_site_frontend_msg_cantsendemail\":\"Faild to send you request email\",\"_site_frontend_jobrequest_subject\":\"New job request\",\"_site_frontend_jobrequest_note\":\"Check job request\'s details in admin panel.\",\"_site_msg_sucuadd\":\"Added Successfully\",\"_site_frontend_joinrequest_subject\":\"New join request\",\"_site_frontend_joinrequest_note\":\"Check join request\'s details in admin panel.\",\"_site_frontend_subscription_subject\":\"New Subscriber\",\"_site_frontend_subscription_note\":\"Check subscriber\'s details in admin panel.\",\"_site_photos_msg_notphoto\":\"Can not upload this file .. this is not a photo!\",\"_site_frontend_newsletter_enteremail\":\"Enter Your Email\",\"_site_frontend_msg_searchlimit\":\"Keyword length must not be greater than 30 chars or less than 3 chars.\",\"_site_frontend_msg_noresult\":\"Sorry we can\'t find result for\",\"_site_frontend_search_result\":\"Search Rsesult\",\"_site_event_titles_main\":\"Events\",\"_site_config_otheralign\":\"right\",\"_site_frontend_news_labels_more\":\"Read More\",\"_site_media_titles_main\":\"Media\",\"_site_subject_titles_main\":\"Subjects \\\\ News\",\"_site_page_titles_main\":\"Pages\",\"_site_mailgroup_titles_newsletter\":\"NewsLetter\",\"_site_ad_titles_main\":\"Ads\",\"_site_join_requests_titles_main\":\"Join Requests\",\"_site_jobrequest_titles_main\":\"Job Requests\",\"_site_siteconfigs_titles_sitecounter\":\"Site visitors stats\",\"_site_siteconfigs_lables_counter\":\"Site Visitors\",\"_site_page_lables_stats\":\"All pages visits\",\"_site_gallery_lables_stats\":\"All gallery visits\",\"_site_subject_lables_stats\":\"All subjecy \\\\ news visits\",\"_site_menu_lables_target\":\"Target\",\"_site_menu_lables_none\":\"None\",\"_site_jobrequest_lables_show\":\"show\",\"_site_adminactions_selectall\":\"All\",\"_site_paging_next\":\"Next\",\"_site_paging_prev\":\"Previous\",\"_site_adminheader_lang\":\"en\",\"_site_adminheader_cpanel\":\"CPanel\",\"_site_config_admincssfilename\":\"admin_en\",\"_site_adminlogin_msg_welcome\":\"Welcome\",\"_site_adminmenu_links_home\":\"Home\",\"_site_adminmenu_links_profile\":\"Edit Profile\",\"_site_adminmenu_links_settings\":\"Site Settings\",\"_site_adminmenu_links_logout\":\"Logout\",\"_site_adminmenu_links_dashboard\":\"Dashboard\",\"_site_adminactions_search\":\"Search\",\"_site_frontend_msg_validemail\":\"Please enter a valid e-mail address!\",\"_site_frontend_contact_lables_captcha\":\"Verification Code\",\"_site_frontend_contact_lables_send\":\"Send\",\"_site_frontend_contact_lables_reset\":\"Reset\",\"_site_frontend_search_search\":\"Search\",\"_site_msg_selectitem\":\"You have to select row(s) to do this action!\",\"_site_frontend_msg_nolayout\":\"Sorry this page doesn\'t have layout yet\",\"_site_vote_lables_vote\":\"Vote\",\"_site_vote_msg_requiredmsg\":\"You must select one item\",\"_site_vote_msg_voted\":\"Voted\",\"_site_config_menu_margin\":\"2px -2px 0 0\",\"_site_config_font\":\"13px\\/15px Trebuchet MS\",\"_site_config_paddings\":\"0 18px 0 0\",\"_site_msg_noid\":\"No ID was provided.\",\"_site_msg_assigned\":\"Assigned Successfully!\",\"_site_per2rol_titles_assign\":\"Assign Permissions to Role\",\"_site_roles_titles_manage\":\"List of Roles\",\"_site_perms_titles_manage\":\"List of Permissions\",\"_site_roles_lables_name\":\"Role\",\"_site_perms_lables_name\":\"Permission\",\"_site_adminactions_assign\":\"Assign\",\"_site_adsec_titles_add\":\"Add New Section\",\"_site_adsec_titles_manage\":\"List of Ads Sections\",\"_site_adsec_lables_name\":\"Section\",\"_site_adminactions_add\":\"Add\",\"_site_msg_wesdel\":\"was deleted.\",\"_site_msg_cantdel\":\"Error in deleting process, The item could be related with other sub items, so you have to delete them at first.\",\"_site_adsec_titles_edit\":\"Edit Section\",\"_site_adminactions_translate\":\"Translate\",\"_site_main_lables_charnum\":\"2255 Chars\",\"_site_adminactions_edit\":\"Update\",\"_site_ad_titles_add\":\"Add New Ad\",\"_site_adminactions_publish\":\"Publish\",\"_site_adminactions_unpublish\":\"Unpublish\",\"_site_adminactionconf_confirmdelete\":\"Confirm Delete\",\"_site_adminactions_delete\":\"Delete\",\"_site_msg_noparent\":\"The selected ID is not found\",\"_site_msg_addedbefor\":\"Error: This entry was added before to the same language\",\"_site_msg_errorsave\":\"Error: Saving the translation entry is faild!\",\"_site_lang_titles_main\":\"Languages\",\"_site_adsec_lables_translate\":\"Translate\",\"_site_adsec_lables_charnum\":\"255 Chars\",\"_site_ad_titles_manage\":\"List of Ads\",\"_site_ad_lables_name\":\"Ad\",\"_site_ad_lables_charnum\":\"255 Chars\",\"_site_ad_lables_content\":\"Discreption\",\"_site_ad_lables_url\":\"Ad Link\",\"_site_ad_lables_target\":\"Open Ad In\",\"_site_ad_lables_self\":\"Same Page\",\"_site_ad_lables_blank\":\"New Page\",\"_site_ad_lables_photo\":\"Ad Photo\",\"_site_plugin_titles_add\":\"Add New Plugin\",\"_site_adminactions_moveup\":\"Move Up\",\"_site_adminactions_movedown\":\"Move Down\",\"_site_ad_lables_translate\":\"Translate\",\"_site_plugin_titles_manage\":\"List of Plugins\",\"_site_ad_titles_edit\":\"Edit Ad\",\"_site_event_titles_add\":\"Add New Event\",\"_site_event_titles_manage\":\"List of Events\",\"_site_event_lables_name\":\"Event\",\"_site_event_lables_startdate\":\"Start Date\",\"_site_event_lables_enddate\":\"End Date\",\"_site_event_lables_location\":\"Location\",\"_site_event_lables_haslink\":\"Has Link\",\"_site_event_lables_target\":\"Target\",\"_site_event_titles_edit\":\"Edit Event\",\"_site_event_lables_translate\":\"Translate\",\"_site_eventconfig_titles_edit\":\"Event Configurations\",\"_site_eventconfig_lables_eventdate\":\"Event Default Date\",\"_site_eventconfig_lables_today\":\"Today\",\"_site_eventconfig_lables_updated\":\"Last Update\",\"_site_filemanager_labels_delete\":\"Delete Selected\",\"_site_filemanager_labels_createfile\":\"Create File\",\"_site_filemanager_labels_createdir\":\"Create Dir\",\"_site_filemanager_labels_command\":\"Command\",\"_site_filemanager_labels_go\":\"Go\",\"_site_filemanager_labels_makebackup\":\"Make BackUp\",\"_site_filemanager_labels_save\":\"Save\",\"_site_filemanager_titles_manage\":\"List of Files\",\"_site_filemanager_labels_shell\":\"Launch Shell\",\"_site_filemanager_labels_size\":\"Size\",\"_site_filemanager_labels_type\":\"Type\",\"_site_filemanager_labels_selectall\":\"Select All\",\"_site_filemanager_titles_current\":\"Current Location\",\"_site_filemanager_labels_upload\":\"Upload\",\"_site_file_titles_add\":\"Add New File\",\"_site_file_titles_manage\":\"List of Files\",\"_site_file_lables_file\":\"Select Files\",\"_site_adminactions_uploading\":\"Uploading...\",\"_site_file_titles_edit\":\"Edit File\",\"_site_file_lables_name\":\"File\",\"_site_file_lables_type\":\"Type\",\"_site_file_lables_size\":\"Size\",\"_site_gallery_titles_add\":\"Add New Gallery\",\"_site_gallery_titles_manage\":\"List of Galleries\",\"_site_gallery_lables_name\":\"Gallery\",\"_site_gallery_lables_charnum\":\"255 Chars\",\"_site_gallery_lables_urlalias\":\"URL Alias\",\"_site_gallery_lables_folder\":\"Folder Name\",\"_site_gallery_lables_paging\":\"Paging\",\"_site_menu_lables_addtomenu\":\"Add as a menu\",\"_site_menu_lables_parent\":\"Menu Parent\",\"_site_menu_lables_toplevel\":\"Top Level\",\"_site_gallery_lables_thumbwidth\":\"Thumb Width\",\"_site_gallery_lables_thumbheight\":\"Thumb Height\",\"_site_gallery_lables_imagewidth\":\"Image Width\",\"_site_gallery_lables_imageheight\":\"Image Height\",\"_site_gallery_titles_edit\":\"Edit Gallery\",\"_site_gallery_lables_link\":\"Link\",\"_site_gallery_lables_addmedia\":\"Add Media\",\"_site_gallery_lables_counter\":\"Visitors\",\"_site_layout_titles_main\":\"Layout\",\"_site_gallery_lables_translate\":\"Translate\",\"_site_lang_titles_add\":\"Add New Language\",\"_site_lang_titles_manage\":\"List of Languages\",\"_site_lang_lables_name\":\"Name\",\"_site_lang_lables_alias\":\"Alias\",\"_site_lang_lables_direction\":\"Site Direction\",\"_site_lang_lables_ltr\":\"Left to Right\",\"_site_lang_lables_rtl\":\"Right to Left\",\"_site_lang_lables_xmlfile\":\"XML File\",\"_site_lang_lables_cssfile\":\"CSS File\",\"_site_msg_filedeleted\":\"File Deleted!\",\"_site_lang_titles_edit\":\"Edit Language\",\"_site_menu_titles_manage\":\"List of Menus\",\"_site_lang_lables_publish\":\"Publish\",\"_site_lang_lables_default\":\"Default\",\"_site_adminactions_default\":\"Default\",\"_site_jobrequest_titles_manage\":\"List of Job Requests\",\"_site_jobrequest_lables_full_name\":\"full name\",\"_site_jobrequest_lables_file_id\":\"CV\",\"_site_jobrequest_lables_mobile\":\"mobile\",\"_site_jobrequest_lables_email\":\"email\",\"_site_jobrequest_lables_name\":\"Job Request\",\"_site_jobrequest_lables_gender\":\"gender\",\"_site_jobrequest_lables_notes\":\"notes\",\"_site_adminactions_created\":\"Created\",\"_site_msg_cantfindresults\":\"Sorry We Can\'t Find Results\",\"_site_join_requests_titles_manage\":\"List of Join Requests\",\"_site_join_requests_lables_full_name\":\"full name\",\"_site_join_requests_lables_photo\":\"photo\",\"_site_join_requests_lables_birth_date\":\"birth date\",\"_site_join_requests_lables_nationality\":\"nationality\",\"_site_join_requests_lables_stage_no\":\"stage No.\",\"_site_join_requests_lables_level_no\":\"level No.\",\"_site_join_requests_lables_category_id\":\"category id\",\"_site_join_requests_lables_parent_mobile\":\"Parent Mobile\",\"_site_join_requests_lables_parent_email\":\"Parent Email\",\"_site_join_requests_lables_name\":\"Join Request\",\"_site_join_requests_lables_gender\":\"gender\",\"_site_join_requests_lables_mobile\":\"mobile\",\"_site_join_requests_lables_email\":\"email\",\"_site_join_requests_lables_id_no\":\"id no\",\"_site_join_requests_lables_address\":\"address\",\"_site_join_requests_lables_parent_full_name\":\"Full name\",\"_site_join_requests_lables_parent_id_no\":\"Parent ID No.\",\"_site_layout_validation_pageormodule\":\"Please select Page, Module or Default to apply layout\",\"_site_layout_titles_manage\":\"Layout\",\"_site_adminactions_updated\":\"Last Updated\",\"_site_layout_lables_page\":\"Select Page\",\"_site_layout_lables_module\":\"Select Module\",\"_site_layout_lables_defaults\":\"Default Layout\",\"_site_layout_lables_makedefault\":\"Apply Default Layout\",\"_site_layout_titles_apply\":\"Apply\",\"_site_layout_titles_save\":\"Save\",\"_site_adminlogin_lables_login\":\"Staff Login\",\"_site_users_lables_username\":\"Username\",\"_site_users_lables_password\":\"Password\",\"_site_adminactions_login\":\"Login\",\"_site_log_titles_logfile\":\"Log File\",\"_site_log_titles_clearlog\":\"Clear Log File\",\"_site_log_msg_cntread\":\"Could not read from log file\",\"_site_mailgroup_titles_add\":\"Add New Group\",\"_site_mailgroup_titles_manage\":\"List of Mail Group\",\"_site_mailgroup_lables_name\":\"Group\",\"_site_mailmessage_lables_charnum\":\"255 Chars\",\"_site_mailgroup_titles_edit\":\"Edit Group\",\"_site_mailgroup_lables_charnum\":\"255 Chars\",\"_site_mailgroup_lables_newsletter\":\"News Letter\",\"_site_mailgroup_lables_translate\":\"Translate\",\"_site_mail_titles_add\":\"Add New Email and Mobile\",\"_site_mail_titles_manage\":\"List of Email\",\"_site_mail_titles_addlist\":\"Add List of Emails\",\"_site_mail_lables_name\":\"Email\",\"_site_mail_lables_charnum\":\"255 Chars\",\"_site_mail_lables_mobile\":\"Mobile\",\"_site_mailgroup_titles_main\":\"Mail Group\",\"_site_mail_lables_canuse\":\"Can Use: \',\' OR \';\' OR \'NEWLINE\' to separate emails\",\"_site_mail_titles_edit\":\"Edit Email\",\"_site_part_lables_select\":\"Select\",\"_site_mailmessage_titles_manage\":\"List of Mail Messages\",\"_site_mailmessage_titles_send\":\"Send Mail Message\",\"_site_mailmessage_lables_from\":\"From\",\"_site_mailmessage_lables_subject\":\"Subject\",\"_site_mailmessage_lables_content\":\"Content\",\"_site_mailmessage_lables_date\":\"Date\",\"_site_mailmessage_lables_preview\":\"Preview\",\"_site_mailmessage_validation_cantfindmessage\":\"Sorry We Can\'t Find Message\",\"_site_mailmessage_lables_direction\":\"Direction\",\"_site_mailmessage_lables_ltr\":\"Left to Right\",\"_site_mailmessage_lables_rtl\":\"Right to Left\",\"_site_adminactions_send\":\"Send\",\"_site_main_titles_add\":\"Add New Category\",\"_site_main_titles_manage\":\"List of Categories\",\"_site_main_lables_name\":\"Category\",\"_site_main_lables_urlalias\":\"URL Alias\",\"_site_main_lables_parent\":\"Parent\",\"_site_main_lables_toplevel\":\"Top Level\",\"_site_main_lables_paging\":\"Paging\",\"_site_main_lables_layout\":\"Internal Layout\",\"_site_main_lables_subjectsort\":\"Sort subjects by\",\"_site_main_lables_content\":\"Content\",\"_site_main_titles_edit\":\"Edit Category\",\"_site_main_lables_link\":\"Link\",\"_site_main_lables_addsubject\":\"Add Subject\",\"_site_main_lables_translate\":\"Translate\",\"_site_gallery_msg_detrmingallery\":\"You have to add media to specific gallery!\",\"_site_media_titles_add\":\"Add New Media\",\"_site_media_titles_manage\":\"List of Media\",\"_site_media_lables_youtube\":\"Youtube\",\"_site_media_lables_upload\":\"Click to upload\",\"_site_media_lables_name\":\"Media\",\"_site_media_lables_charnum\":\"255 Chars\",\"_site_media_lables_link\":\"Youtube Link\",\"_site_media_lables_width\":\"Width\",\"_site_media_lables_height\":\"Height\",\"_site_media_titles_edit\":\"Edit Media\",\"_site_media_lables_thumb\":\"Thumb\",\"_site_media_lables_type\":\"Type\",\"_site_media_lables_image\":\"Image\",\"_site_media_lables_translate\":\"Translate\",\"_site_msg_notfile\":\"Can not upload this file .. this is not an allowed file ext.!\",\"_site_menu_titles_add\":\"Add New Menu\",\"_site_menu_lables_name\":\"Menu Name\",\"_site_menu_lables_charnum\":\"255 Chars\",\"_site_menu_lables_fonticon\":\"Icon\",\"_site_menu_lables_menulayout\":\"Sub Menu Layout\",\"_site_menu_lables_onecol\":\"One Column\",\"_site_menu_lables_multicol\":\"Multi Columns\",\"_site_menu_lables_hidesubmenu\":\"Hide From H-Menu\",\"_site_menu_lables_type\":\"Content Type\",\"_site_menu_lables_select\":\"Select\",\"_site_menu_lables_page\":\"Parent Page\",\"_site_menu_lables_main\":\"Parent Main Section\",\"_site_menu_lables_gallery\":\"Parent Album\",\"_site_menu_lables_module\":\"Parent Module\",\"_site_menu_lables_permission\":\"Permission\",\"_site_menu_lables_extlink\":\"External Link\",\"_site_menu_lables_link\":\"Content Link\",\"_site_menu_titles_edit\":\"Edit Menu\",\"_site_menu_lables_sortid\":\"Sorting ID\",\"_site_menu_lables_translate\":\"Translate\",\"_site_module_titles_add\":\"Add New Module\",\"_site_module_titles_manage\":\"List of Modules\",\"_site_module_lables_name\":\"Module\",\"_site_module_lables_charnum\":\"255 Chars\",\"_site_module_lables_urlalias\":\"URL Alias\",\"_site_module_lables_relatedclass\":\"Related Page\",\"_site_module_lables_keywords\":\"Meta Keywords\",\"_site_module_lables_description\":\"Meta Description\",\"_site_module_titles_edit\":\"Edit Module\",\"_site_module_lables_link\":\"Link\",\"_site_module_lables_translate\":\"Translate\",\"_site_page_titles_add\":\"Add New Page\",\"_site_page_titles_manage\":\"List of Pages\",\"_site_page_lables_name\":\"Page\",\"_site_page_lables_charnum\":\"255 Chars\",\"_site_page_lables_urlalias\":\"URL Alias\",\"_site_page_lables_content\":\"Content\",\"_site_page_lables_module\":\"Attached Module\",\"_site_page_lables_select\":\"Select\",\"_site_page_lables_keywords\":\"Meta Keywords\",\"_site_page_lables_description\":\"Meta Description\",\"_site_page_titles_edit\":\"Edit Page\",\"_site_page_lables_translate\":\"Translate\",\"_site_page_lables_link\":\"Link\",\"_site_page_lables_homepage\":\"Home Page\",\"_site_page_lables_contacts\":\"Contact Page\",\"_site_part_titles_add\":\"Add New Part\",\"_site_page_lables_counter\":\"Visitors\",\"_site_part_titles_manage\":\"List of Parts\",\"_site_part_lables_name\":\"Title\",\"_site_part_lables_charnum\":\"255 Chars\",\"_site_part_lables_page\":\"Parent Page\",\"_site_part_lables_showtitle\":\"Show Title\",\"_site_part_lables_content\":\"Content\",\"_site_part_titles_edit\":\"Edit Part\",\"_site_photos_titles_manage\":\"List of Photos\",\"_site_part_lables_translate\":\"Translate\",\"_site_perms_titles_add\":\"Add New Permission\",\"_site_perms_lables_charnum\":\"255 Chars\",\"_site_persecs_lables_name\":\"Section\",\"_site_perms_lables_pagepath\":\"Page Path\",\"_site_perms_titles_edit\":\"Edit Permission\",\"_site_persecs_titles_manage\":\"List of Per. Sections\",\"_site_persecs_titles_add\":\"Add New Section\",\"_site_persecs_lables_charnum\":\"255 Chars\",\"_site_persecs_titles_edit\":\"Edit Section\",\"_site_photos_titles_add\":\"Add New Photo\",\"_site_photos_lables_selectfile\":\"Select Photos\",\"_site_photos_lables_thumbwidth\":\"Thumb Width\",\"_site_photos_lables_thumbheight\":\"Thumb Height\",\"_site_photos_lables_imagewidth\":\"Image Width\",\"_site_photos_lables_imageheight\":\"Image Height\",\"_site_adminactions_upload\":\"Upload\",\"_site_photos_titles_edit\":\"Edit\",\"_site_photos_lables_select\":\"Select\",\"_site_photos_lables_admin\":\"Admin\",\"_site_photos_lables_image\":\"Image\",\"_site_photos_lables_caption\":\"Caption\",\"_site_photos_lables_link\":\"URL\",\"_site_photos_lables_size\":\"Size\",\"_site_photos_lables_type\":\"Type\",\"_site_photos_lables_thumb\":\"Thumb\",\"_site_photos_lables_larg\":\"Larg\",\"_site_plugin_lables_name\":\"Plugin\",\"_site_plugin_lables_charnum\":\"255 Chars\",\"_site_plugin_lables_showtitle\":\"Show Title\",\"_site_plugin_lables_hasmenu\":\"Create New Side Menu\",\"_site_plugin_lables_menu\":\"Top Level Menu\",\"_site_adminactions_select\":\"Select\",\"_site_plugin_lables_haspage\":\"Has a Page?\",\"_site_plugin_lables_relatedclass\":\"Plugin\",\"_site_plugin_lables_relatedsec\":\"Related Section\",\"_site_plugin_lables_select\":\"Select Section\",\"_site_plugin_lables_adsec\":\"Ads Section\",\"_site_plugin_lables_main\":\"Mian Category\",\"_site_plugin_lables_gallery\":\"Gallery\",\"_site_plugin_lables_selectsec\":\"Select Section\",\"_site_plugin_lables_cssclass\":\"CSS Class Name\",\"_site_plugin_lables_csscustomstyle\":\"CSS Custom Style\",\"_site_plugin_lables_csscustomstylebrief\":\"Add custum style like\",\"_site_plugin_lables_htmlid\":\"HTML ID\",\"_site_plugin_lables_content\":\"Content\",\"_site_plugin_lables_javascript\":\"Javascript\",\"_site_plugin_lables_javascriptbrief\":\"Must add your javascripts between\",\"_site_plugin_titles_edit\":\"Edit Plugin\",\"_site_plugin_lables_translate\":\"Translate\",\"_site_roles_titles_add\":\"Add New Role\",\"_site_roles_lables_site\":\"Site\",\"_site_roles_titles_edit\":\"Edit Role\",\"_site_siteconfigs_titles_add\":\"Add Site\",\"_site_siteconfigs_titles_manage\":\"List of Sites\",\"_site_siteconfigs_lables_title\":\"Website Name\",\"_site_siteconfigs_lables_logo_path\":\"Logo Image\",\"_site_siteconfigs_lables_slogan_path\":\"Slogan Image\",\"_site_siteconfigs_lables_alias\":\"Site Alias\",\"_site_siteconfigs_lables_email\":\"E-mail\",\"_site_siteconfigs_lables_phone\":\"Phone\",\"_site_siteconfigs_lables_address\":\"Address\",\"_site_siteconfigs_lables_paging\":\"Search items per page\",\"_site_siteconfigs_lables_facebook\":\"Facebook\",\"_site_siteconfigs_lables_twitter\":\"Twitter\",\"_site_siteconfigs_lables_youtube\":\"Youtube\",\"_site_siteconfigs_lables_flickr\":\"Instagram\",\"_site_siteconfigs_lables_googleplus\":\"Google Plus\",\"_site_siteconfigs_lables_linkedin\":\"LinkedIn\",\"_site_siteconfigs_lables_copyrights\":\"Copyrights\",\"_site_siteconfigs_lables_background\":\"Background\",\"_site_siteconfigs_lables_offline\":\"Put Site Offline\",\"_site_siteconfigs_lables_offlinemsg\":\"Offline Message\",\"_site_siteconfigs_lables_googleanalytics\":\"Google Analytics\",\"_site_siteconfigs_lables_keywords\":\"Site wide Meta Keywords\",\"_site_siteconfigs_lables_description\":\"Site wide Meta Description\",\"_site_siteconfigs_lables_showlang\":\"Show Language\",\"_site_siteconfigs_lables_showsites\":\"Show Sites list\",\"_site_siteconfigs_lables_seo\":\"Enable Seo\",\"_site_siteconfigs_titles_edit\":\"Edit Site\",\"_site_siteconfigs_lables_updated\":\"Last Update\",\"_site_siteconfigs_lables_translate\":\"Translate\",\"_site_subject_titles_add\":\"Add New Subject\",\"_site_subject_titles_manage\":\"List of Subjects\",\"_site_subject_lables_name\":\"Subject\",\"_site_subject_lables_charnum\":\"255 Chars\",\"_site_subject_lables_urlalias\":\"URL Alias\",\"_site_subject_lables_date\":\"Date\",\"_site_subject_lables_photo\":\"Photo\",\"_site_main_titles_main\":\"Categories\",\"_site_subject_lables_contentshort\":\"Short Content\",\"_site_subject_lables_content\":\"Content\",\"_site_subject_lables_keywords\":\"Meta Keywords\",\"_site_subject_lables_description\":\"Meta Description\",\"_site_subject_lables_showdate\":\"Show Date\",\"_site_subject_lables_allowfbcomment\":\"Allow Facebook Comments\",\"_site_subject_titles_edit\":\"Edit Subject\",\"_site_subject_lables_link\":\"Link\",\"_site_subject_lables_counter\":\"Visitors\",\"_site_subject_lables_translate\":\"Translate\",\"_site_subscription_titles_manage\":\"List of Subscriptions\",\"_site_subscription_lables_name\":\"Subscription\",\"_site_subscription_lables_fullname\":\"Full name\",\"_site_subscription_lables_gender\":\"Gender\",\"_site_subscription_lables_male\":\"Male\",\"_site_subscription_lables_female\":\"Female\",\"_site_subscription_lables_birthdate\":\"Birth date\",\"_site_subscription_lables_profession\":\"Profession\",\"_site_subscription_lables_nationality\":\"Nationality\",\"_site_subscription_lables_tel\":\"Tel\",\"_site_subscription_lables_mobile\":\"Mobile\",\"_site_subscription_lables_email\":\"Email\",\"_site_subscription_lables_country\":\"Country\",\"_site_subscription_lables_interests\":\"Interests\",\"_site_users_titles_add\":\"Add New User\",\"_site_users_titles_manage\":\"List of Users\",\"_site_users_lables_email\":\"E-Mail\",\"_site_users_titles_edit\":\"Edit User\",\"_site_votequestion_titles_add\":\"Add New Vote Question\",\"_site_votequestion_titles_manage\":\"List of Vote Questions\",\"_site_voteanswer_lables_name\":\"Vote Answer\",\"_site_voteanswer_lables_questionid\":\"Question\",\"_site_voteanswer_titles_manage\":\"List of Vote Answers\",\"_site_votequestion_titles_main\":\"Vote Questions\",\"_site_votequestion_lables_name\":\"Vote Question\",\"_site_votequestion_lables_translate\":\"Translate\",\"_site_voteanswer_titles_edit\":\"Edit Vote Answer\",\"_site_voteanswer_titles_add\":\"Add New Vote Answer\",\"_site_voteanswer_lables_translate\":\"Translate\",\"_site_votequestion_lables_addanswer\":\"Add Answer\",\"_site_votequestion_titles_edit\":\"Edit Vote Question\",\"_site_votequestion_lables_charnum\":\"255 Chars\",\"_site_vote_lables_result\":\"Vote Results\",\"_site_vote_msg_cantfindvote\":\"Can\'t find voting to view.\",\"_site_config_langalias\":\"Alias\",\"_site_frontend_login_send\":\"Send\",\"_site_subscription_lables_captcha\":\"Verification Code\",\"_site_subscription_lables_subscribe\":\"Subscribe\",\"_site_subscription_lables_reset\":\"Reset\",\"_site_msg_pluginnosec\":\"No section assigned to this plugin\",\"_site_frontend_counter_days\":\"Days\",\"_site_frontend_counter_hours\":\"Hours\",\"_site_frontend_counter_minutes\":\"Minutes\",\"_site_frontend_counter_seconds\":\"Seconds\",\"_site_frontend_counter_btnreg\":\"Register Now\",\"_site_frontend_counter_btnregmsg\":\"Please register before start date\",\"_site_frontend_home_sitename\":\"\",\"_site_frontend_home_sitebrief\":\"\",\"_site_frontend_home_homelabel\":\"Home\",\"_site_adminactions_loading\":\"Loading\",\"_site_frontend_newsletter_join\":\"Join\",\"_site_frontend_msg_donthavedefaultnewsletter\":\"You have to assign default newsletter\",\"_site_msg_notphoto\":\"Can not upload this file .. this is not a photo!\",\"_site_msg_relatedclass\":\"This Page is already assigned to other module!\",\"_site_frontend_msg_homenotassigned\":\"Home Page Not Assigned!\",\"_site_msg_atleastone\":\"You have to check at least one record to do this action!\",\"_site_photos_msg_nofile\":\"No File Was Uploaded\",\"_site_photos_msg_longer255\":\"The Entry Can\'t Be Longer Than 255 Chars!\",\"_site_photos_msg_cantfind\":\"The File Location Is Not Avaliable!\",\"_site_photos_msg_exists\":\"is already exists.\",\"_site_photos_msg_dirper\":\"Upload failure due to incorrect permission to upload folder.\",\"_site_msg_noperm\":\"Sorry! you don\'t have permission to do this action.\",\"_site_adminlogin_msg_incordata\":\"Username\\/password combination incorrect.\",\"_site_adminlogin_msg_failattemp\":\"Wrong login attempt, number of remaining attempts\",\"_site_adminlogin_msg_userlocked\":\"This user is locked for 5 minutes because is exceeded login attemps\",\"_site_adminlogin_msg_userunpublished\":\"This user is not activated, Please contact with system admin\",\"_site_msg_usernameexist\":\"This username is already exist!\",\"_site_vote_msg_iderror\":\"ERROR with ID\",\"_site_vote_msg_alreadyvoted\":\"You already voted this poll\",\"activity_logs\":\"activity logs\",\"delete_all_logs\":\"delete all logs\",\"number\":\"number\",\"path\":\"path\",\"actions\":\"actions\",\"message\":\"message\",\"date\":\"date\",\"ip_number\":\"ip number\",\"contact_us\":\"contact us\",\"default_language\":\"default language\",\"default_site\":\"default site\",\"unified_number\":\"unified number\",\"follow_us\":\"follow us\",\"alharameen_app\":\"alharameen app\",\"download_from_store\":\"download from store\",\"alharameen_app_iphone\":\"alharameen app iphone\",\"alharameen_app_android\":\"alharameen app android\",\"edit_phrases\":\"edit phrases\",\"delete_checked_items\":\"delete checked items\",\"contactus_requests\":\"contactus requests\",\"name\":\"name\",\"phone\":\"phone\",\"email\":\"email\",\"ip_address\":\"ip address\"}', 'AlegreyaSans-Regular.otf');
INSERT INTO `langs` (`id`, `title`, `xml_path`, `alias`, `direction`, `publish`, `defaults`, `css_path`, `phrases`, `font`) VALUES
(2, 'العربية', NULL, 'ar', 'rtl', 1, 1, NULL, '{\"_site_msg_filenotfound\":\"\\u062e\\u0637\\u0627 : \\u0627\\u0644\\u0645\\u0644\\u0641 \\u063a\\u064a\\u0631 \\u0645\\u0648\\u062c\\u0648\\u062f\",\"_site_adminactions_back\":\"\\u0627\\u0644\\u0631\\u062c\\u0648\\u0639\",\"_site_msg_error404\":\"\\u062d\\u062f\\u062b \\u062e\\u0637\\u0623 \\u0645\\u0627\",\"_site_msg_pagenotfound\":\"\\u0627\\u0644\\u0635\\u0641\\u062d\\u0629 \\u063a\\u064a\\u0631 \\u0645\\u0648\\u062c\\u0648\\u062f\\u0629\",\"_site_msg_errormsg\":\"\\u0639\\u0630\\u0631\\u064b\\u0627 \\u060c \\u0644\\u0643\\u0646 \\u0627\\u0644\\u0635\\u0641\\u062d\\u0629 \\u0627\\u0644\\u062a\\u064a \\u062a\\u0628\\u062d\\u062b \\u0639\\u0646\\u0647\\u0627 \\u063a\\u064a\\u0631 \\u0645\\u0648\\u062c\\u0648\\u062f\\u0629.\",\"_site_msg_backhome\":\"\\u0627\\u0644\\u0635\\u0641\\u062d\\u0629 \\u0627\\u0644\\u0631\\u0626\\u064a\\u0633\\u064a\\u0629\",\"_site_msg_invalidsubmit\":\"\\u0627\\u0633\\u062a\\u062e\\u062f\\u0627\\u0645 \\u062e\\u0627\\u0637\\u0626\",\"_site_msg_donepublish\":\"\\u0627\\u0644\\u062a\\u0641\\u0639\\u064a\\u0644 \\u062a\\u0645 \\u0628\\u0646\\u062c\\u0627\\u062d\",\"_site_msg_doneunpublish\":\"\\u0648\\u0642\\u0641 \\u0627\\u0644\\u062a\\u0641\\u0639\\u064a\\u0644 \\u062a\\u0645 \\u0628\\u0646\\u062c\\u0627\\u062d\",\"_site_msg_cantdo\":\"\\u0644\\u0627 \\u064a\\u0645\\u0643\\u0646 \\u062a\\u0646\\u0641\\u064a\\u0630 \\u0647\\u0630\\u0647 \\u0627\\u0644\\u0639\\u0645\\u0644\\u064a\\u0629\",\"_site_msg_checkonlyone\":\"\\u0644\\u0627 \\u0628\\u062f \\u0645\\u0646 \\u0627\\u062e\\u062a\\u064a\\u0627\\u0631 \\u062d\\u0642\\u0644 \\u0648\\u0627\\u062d\\u062f \\u0641\\u0642\\u0637 \\u0644\\u062a\\u0646\\u0641\\u064a\\u0630 \\u0647\\u0630\\u0647 \\u0627\\u0644\\u0639\\u0645\\u0644\\u064a\\u0629\",\"_site_msg_notvalid\":\"\\u0642\\u064a\\u0645\\u0629 \\u063a\\u064a\\u0631 \\u0635\\u062d\\u064a\\u062d\\u0629\",\"_site_msg_cantmoveup\":\"\\u0644\\u0627\\u064a\\u0645\\u0643\\u0646 \\u0627\\u0644\\u062a\\u062d\\u0631\\u064a\\u0643 \\u0644\\u0627\\u0639\\u0644\\u0649\",\"_site_msg_donesort\":\"\\u062a\\u0645 \\u0627\\u0644\\u062a\\u0631\\u062a\\u064a\\u0628 \\u0628\\u0646\\u062c\\u0627\\u062d\",\"_site_msg_cantmovedown\":\"\\u0644\\u0627\\u064a\\u0645\\u0643\\u0646 \\u0627\\u0644\\u062a\\u062d\\u0631\\u064a\\u0643 \\u0644\\u0627\\u0633\\u0641\\u0644\",\"_site_msg_sucupdate\":\"\\u062a\\u0645 \\u0627\\u0644\\u062a\\u0639\\u062f\\u064a\\u0644 \\u0628\\u0646\\u062c\\u0627\\u062d\",\"_site_msg_allrequire\":\"\\u0645\\u0646 \\u0641\\u0636\\u0644\\u0643 \\u0627\\u0645\\u0644\\u0627 \\u0627\\u0644\\u062d\\u0642\\u0648\\u0644 \\u0627\\u0644\\u0645\\u0637\\u0644\\u0648\\u0628\\u0629\",\"_site_msg_longer\":\"\\u0627\\u0644\\u0645\\u062f\\u062e\\u0644 \\u0644\\u0627\\u064a\\u0632\\u064a\\u062f \\u0639\\u0646 255 \\u062d\\u0631\\u0641\",\"_site_msg_notvalidurl\":\"\\u062e\\u0637\\u0623 \\u0641\\u0649 \\u0627\\u0644\\u0631\\u0627\\u0628\\u0637 \\u064a\\u062c\\u0628 \\u0627\\u0646 \\u064a\\u062a\\u0636\\u0645\\u0646 \\u0627\\u0644\\u0631\\u0627\\u0628\\u0637 (http:\\/\\/)\",\"_site_msg_codenotfound\":\"\\u0627\\u0644\\u0631\\u0642\\u0645 \\u063a\\u064a\\u0631 \\u0645\\u0648\\u062c\\u0648\\u062f\",\"_site_msg_nofile\":\"\\u0627\\u0644\\u0645\\u0644\\u0641 \\u063a\\u064a\\u0631 \\u0645\\u0648\\u062c\\u0648\\u062f\",\"_site_file_msg_notfile\":\"\\u0644\\u0627 \\u064a\\u0645\\u0643\\u0646 \\u062a\\u062d\\u0645\\u064a\\u0644 \\u0627\\u0644\\u0645\\u0644\\u0641 \\u0627\\u0646\\u0647 \\u0644\\u064a\\u0633 \\u0645\\u0646 \\u0627\\u0646\\u0648\\u0627\\u0639 \\u0627\\u0644\\u0645\\u0644\\u0641\\u0627\\u062a \\u0627\\u0644\\u0645\\u0633\\u0645\\u0648\\u062d \\u0628\\u0647\\u0627\",\"_site_msg_longer255\":\"\\u0627\\u0644\\u0645\\u062f\\u062e\\u0644 \\u0644\\u0627\\u064a\\u0632\\u064a\\u062f \\u0639\\u0646 255 \\u062d\\u0631\\u0641\",\"_site_file_msg_cantfind\":\"\\u0645\\u0643\\u0627\\u0646 \\u0627\\u0644\\u0645\\u0644\\u0641 \\u063a\\u064a\\u0631 \\u0645\\u062a\\u0627\\u062d\",\"_site_msg_exists\":\"\\u0627\\u0644\\u0645\\u0644\\u0641 \\u0645\\u0648\\u062c\\u0648\\u062f \\u0645\\u0633\\u0628\\u0642\\u0627\",\"_site_msg_dirper\":\"\\u0641\\u0634\\u0644 \\u0641\\u0649 \\u0627\\u0644\\u0631\\u0641\\u0639 \\u0644\\u0627\\u064a\\u0648\\u062c\\u062f \\u0635\\u0644\\u0627\\u062d\\u064a\\u0629 \\u0644\\u0627\\u062a\\u0645\\u0627\\u0645 \\u0627\\u0644\\u0639\\u0645\\u0644\\u064a\\u0629\",\"_site_filemanager_labels_download\":\"\\u062a\\u0646\\u0632\\u064a\\u0644\",\"_site_filemanager_labels_extract\":\"\\u0627\\u0633\\u062a\\u062e\\u0631\\u0627\\u062c \\u0627\\u0644\\u0645\\u0636\\u063a\\u0648\\u0637\",\"_site_filemanager_titles_edit\":\"\\u062a\\u0639\\u062f\\u064a\\u0644 \\u0645\\u0644\\u0641\",\"_site_filemanager_msg_delsuc\":\"\\u062a\\u0645 \\u0627\\u0644\\u0645\\u0633\\u062d \\u0628\\u0646\\u062c\\u0627\\u062d\",\"_site_filemanager_msg_cantdel\":\"\\u062e\\u0637\\u0627 \\u0641\\u0649 \\u0639\\u0644\\u0645\\u0644\\u064a\\u0629 \\u0627\\u0644\\u0645\\u0633\\u062d\",\"_site_filemanager_labels_back\":\"\\u0631\\u062c\\u0648\\u0639\",\"_site_filemanager_labels_name\":\"\\u0627\\u0644\\u0627\\u0633\\u0645\",\"_site_filemanager_labels_uncomsize\":\"\\u062d\\u062c\\u0645 \\u0627\\u0644\\u063a\\u064a\\u0631 \\u0645\\u0636\\u063a\\u0648\\u0637\",\"_site_filemanager_labels_comsize\":\"\\u062d\\u062c\\u0645 \\u0627\\u0644\\u0645\\u0636\\u063a\\u0648\\u0637\",\"_site_filemanager_labels_comratio\":\"\\u0645\\u0639\\u062f\\u0644 \\u0627\\u0644\\u0636\\u063a\\u0637\",\"_site_filemanager_labels_date\":\"\\u0627\\u0644\\u062a\\u0627\\u0631\\u064a\\u062e\",\"_site_filemanager_labels_filein\":\"\\u0645\\u0644\\u0641\\u0627\\u062a \\u0641\\u0649\",\"_site_filemanager_msg_failed\":\"\\u0641\\u0634\\u0644\",\"_site_filemanager_msg_createsuc\":\"\\u062a\\u0645 \\u0627\\u0644\\u0627\\u0646\\u0634\\u0627\\u0621 \\u0628\\u0645\\u062c\\u0627\\u062d\",\"_site_filemanager_msg_cantcreate\":\"\\u0644\\u0627\\u064a\\u0645\\u0643\\u0646 \\u0627\\u0646\\u0634\\u0627\\u0621 \\u0627\\u0644\\u0645\\u0644\\u0641\",\"_site_filemanager_msg_dirnotwritable\":\"\\u0627\\u0644\\u0645\\u062c\\u0644\\u062f \\u063a\\u064a\\u0631 \\u0642\\u0627\\u0628\\u0644 \\u0644\\u0644\\u062a\\u062d\\u0645\\u064a\\u0644 \\u0628\\u062f\\u0627\\u062e\\u0644\\u0647 .. \\u0645\\u0634\\u0643\\u0644\\u0629 \\u0635\\u0644\\u0627\\u062d\\u064a\\u0627\\u062a\",\"_site_filemanager_msg_fileexists\":\"\\u0627\\u0644\\u0645\\u0644\\u0641 \\u0645\\u0648\\u062c\\u0648\\u062f\",\"_site_filemanager_msg_direxist\":\"\\u0627\\u0644\\u0645\\u062c\\u0644\\u062f \\u0645\\u0648\\u062c\\u0648\\u062f\",\"_site_filemanager_msg_ok\":\"\\u062a\\u0645 \\u0628\\u0646\\u062c\\u0627\\u062d\",\"_site_filemanager_msg_uploaded\":\"\\u062a\\u0645 \\u062a\\u062d\\u0645\\u064a\\u0644 \\u0627\\u0644\\u0645\\u0644\\u0641 \\u0628\\u0646\\u062c\\u0627\\u062d\",\"_site_filemanager_msg_uploaderror\":\"\\u062e\\u0637\\u0627 \\u0641\\u0649 \\u062a\\u062d\\u0645\\u064a\\u0644 \\u0627\\u0644\\u0645\\u0644\\u0641\",\"_site_msg_undefined\":\"\\u063a\\u064a\\u0631 \\u0645\\u0639\\u0631\\u0648\\u0641\",\"_site_msg_urlalias\":\"\\u0627\\u0644\\u0627\\u0633\\u0645 \\u0627\\u0644\\u0628\\u062f\\u064a\\u0644 \\u0645\\u0648\\u062c\\u0648\\u062f .. \\u064a\\u0631\\u062c\\u0649 \\u0627\\u0628\\u062f\\u0627\\u0644\\u0647 \\u0628\\u0627\\u0633\\u0645 \\u0627\\u062e\\u0631\",\"_site_msg_aliasexist\":\"\\u0627\\u0627\\u0633\\u0645 \\u0627\\u0644\\u0628\\u062f\\u064a\\u0644 \\u0645\\u0648\\u062c\\u0648\\u062f \\u0644\\u062f\\u064a\\u0646\\u0627\",\"_site_msg_validemail\":\"\\u0627\\u062f\\u062e\\u0644 \\u0628\\u0631\\u064a\\u062f \\u0627\\u0644\\u0643\\u062a\\u0631\\u0648\\u0646\\u0649 \\u0635\\u062d\\u064a\\u062d\",\"_site_msg_mailexist\":\"\\u0627\\u0644\\u0628\\u0631\\u064a\\u062f \\u0627\\u0644\\u0627\\u0644\\u0643\\u062a\\u0631\\u0648\\u0646\\u0649 \\u0645\\u0648\\u062c\\u0648\\u062f \\u0644\\u062f\\u064a\\u0646\\u0627\",\"_site_frontend_contact_msg_captchaerror\":\"\\u062e\\u0637\\u0623 \\u0641\\u0649 \\u0643\\u0648\\u062f \\u0627\\u0644\\u062a\\u062d\\u0642\\u0642\",\"_site_config_dir\":\"rtl\",\"_site_frontend_contact_msg_subject\":\"\\u0631\\u0633\\u0627\\u0644\\u0629 \\u062c\\u062f\\u064a\\u062f\\u0629 \\u0645\\u0646 \\u0635\\u0641\\u062d\\u0629 \\u0627\\u062a\\u0635\\u0644 \\u0628\\u0646\\u0627\",\"_site_frontend_contact_lables_name\":\"\\u0627\\u0644\\u0627\\u0633\\u0645\",\"_site_frontend_contact_lables_email\":\"\\u0627\\u0644\\u0628\\u0631\\u064a\\u062f \\u0627\\u0644\\u0627\\u0644\\u0643\\u062a\\u0631\\u0648\\u0646\\u064a\",\"_site_frontend_contact_lables_phone\":\"\\u0627\\u0644\\u0647\\u0627\\u062a\\u0641\",\"_site_frontend_contact_lables_msg\":\"\\u0627\\u0644\\u0631\\u0633\\u0627\\u0644\\u0629\",\"_site_config_align\":\"right\",\"_site_frontend_contact_lables_date\":\"\\u0627\\u0644\\u062a\\u0627\\u0631\\u064a\\u062e\",\"_site_frontend_contact_lables_ip\":\"\\u0631\\u0642\\u0645 \\u0627\\u0644\\u062d\\u0627\\u0633\\u0628\",\"_site_frontend_msg_sentsuccess\":\"\\u062a\\u0645 \\u0627\\u0631\\u0633\\u0627\\u0644 \\u0627\\u0644\\u0631\\u0633\\u0627\\u0644\\u0629 \\u0628\\u0646\\u062c\\u0627\\u062d\",\"_site_frontend_msg_cantsendemail\":\"\\u0641\\u0634\\u0644 \\u0641\\u0649 \\u0627\\u0631\\u0633\\u0627\\u0644 \\u0627\\u0644\\u0628\\u0631\\u064a\\u062f \\u0627\\u0644\\u0627\\u0644\\u0643\\u062a\\u0631\\u0648\\u0646\\u0649\",\"_site_frontend_jobrequest_subject\":\"\\u0637\\u0644\\u0628 \\u062a\\u0648\\u0638\\u064a\\u0641 \\u062c\\u062f\\u064a\\u062f\",\"_site_frontend_jobrequest_note\":\"\\u064a\\u0631\\u062c\\u064a \\u0645\\u0631\\u0627\\u062c\\u0639\\u0647 \\u0628\\u064a\\u0627\\u0646\\u0627\\u062a \\u0637\\u0644\\u0628\\u0627\\u062a \\u0627\\u0644\\u062a\\u0648\\u0638\\u064a\\u0641 \\u0645\\u0646 \\u0644\\u0648\\u062d\\u0629 \\u0627\\u0644\\u062a\\u062d\\u0643\\u0645\",\"_site_msg_sucuadd\":\"\\u062a\\u0645\\u062a \\u0627\\u0644\\u0627\\u0636\\u0627\\u0641\\u0629 \\u0628\\u0646\\u062c\\u0627\\u062d\",\"_site_frontend_joinrequest_subject\":\"\\u0637\\u0644\\u0628 \\u062a\\u0633\\u062c\\u064a\\u0644 \\u062c\\u062f\\u064a\\u062f\",\"_site_frontend_joinrequest_note\":\"\\u064a\\u0631\\u062c\\u064a \\u0645\\u0631\\u0627\\u062c\\u0639\\u0647 \\u0628\\u064a\\u0627\\u0646\\u0627\\u062a \\u0637\\u0644\\u0628\\u0627\\u062a \\u0627\\u0644\\u062a\\u0633\\u062c\\u064a\\u0644 \\u0645\\u0646 \\u0644\\u0648\\u062d\\u0629 \\u0627\\u0644\\u062a\\u062d\\u0643\\u0645\",\"_site_frontend_subscription_subject\":\"\\u0645\\u0634\\u062a\\u0631\\u0643 \\u062c\\u062f\\u064a\\u062f\",\"_site_frontend_subscription_note\":\"\\u064a\\u0631\\u062c\\u064a \\u0645\\u0631\\u0627\\u062c\\u0639\\u0647 \\u0628\\u064a\\u0627\\u0646\\u0627\\u062a \\u0627\\u0644\\u0645\\u0634\\u062a\\u0631\\u0643 \\u0645\\u0646 \\u0644\\u0648\\u062d\\u0629 \\u0627\\u0644\\u062a\\u062d\\u0643\\u0645\",\"_site_photos_msg_notphoto\":\"\\u0644\\u0627 \\u064a\\u0645\\u0643\\u0646 \\u062a\\u062d\\u0645\\u064a\\u0644 \\u0627\\u0644\\u0645\\u0644\\u0641 \\u0627\\u0646\\u0647 \\u0644\\u064a\\u0633 \\u0645\\u0646 \\u0627\\u0646\\u0648\\u0627\\u0639 \\u0627\\u0644\\u0635\\u0648\\u0631\",\"_site_frontend_newsletter_enteremail\":\"\\u0627\\u062f\\u062e\\u0644 \\u0627\\u0644\\u0628\\u0631\\u064a\\u062f \\u0627\\u0644\\u0627\\u0644\\u0643\\u062a\\u0631\\u0648\\u0646\\u0649\",\"_site_frontend_msg_searchlimit\":\"\\u0643\\u0644\\u0645\\u0629 \\u0627\\u0644\\u0628\\u062d\\u062b \\u064a\\u062c\\u0628 \\u0627\\u0646 \\u0644\\u0627 \\u062a\\u0642\\u0644 \\u0639\\u0646 3 \\u062d\\u0631\\u0648\\u0641 \\u0648\\u0627\\u0644\\u0627 \\u062a\\u0632\\u064a\\u062f \\u0639\\u0646 30 \\u062d\\u0631\\u0641\",\"_site_frontend_msg_noresult\":\"\\u0646\\u0623\\u0633\\u0641 \\u0644\\u0639\\u062f\\u0645 \\u0648\\u062c\\u0648\\u062f \\u0646\\u062a\\u0627\\u0626\\u062c \\u0644\\u0640\\u0640\",\"_site_frontend_search_result\":\"\\u0646\\u062a\\u0627\\u0626\\u062c \\u0627\\u0644\\u0628\\u062d\\u062b\",\"_site_event_titles_main\":\"\\u0627\\u0644\\u0627\\u062d\\u062f\\u0627\\u062b\",\"_site_config_otheralign\":\"left\",\"_site_frontend_news_labels_more\":\"\\u0625\\u0642\\u0631\\u0623 \\u0627\\u0644\\u0645\\u0632\\u064a\\u062f\",\"_site_media_titles_main\":\"\\u0627\\u0644\\u0648\\u0633\\u0627\\u0626\\u0637\",\"_site_subject_titles_main\":\"\\u0627\\u0644\\u0645\\u0648\\u0636\\u0648\\u0639\\u0627\\u062a \\u0648\\u0627\\u0644\\u0623\\u062e\\u0628\\u0627\\u0631\",\"_site_page_titles_main\":\"\\u0627\\u0644\\u0635\\u0641\\u062d\\u0627\\u062a\",\"_site_mailgroup_titles_newsletter\":\"\\u0627\\u0644\\u0642\\u0627\\u0626\\u0645\\u0629 \\u0627\\u0644\\u0628\\u0631\\u064a\\u062f\\u064a\\u0629\",\"_site_ad_titles_main\":\"\\u0627\\u0644\\u0627\\u0639\\u0644\\u0627\\u0646\\u0627\\u062a\",\"_site_join_requests_titles_main\":\"\\u0637\\u0644\\u0628\\u0627\\u062a \\u0627\\u0644\\u062a\\u0633\\u062c\\u064a\\u0644\",\"_site_jobrequest_titles_main\":\"\\u0637\\u0644\\u0628\\u0627\\u062a \\u0627\\u0644\\u062a\\u0648\\u0638\\u064a\\u0641\",\"_site_siteconfigs_titles_sitecounter\":\"\\u0627\\u062d\\u0635\\u0627\\u0626\\u064a\\u0627\\u062a \\u0632\\u0648\\u0627\\u0631 \\u0627\\u0644\\u0645\\u0648\\u0642\\u0639\",\"_site_siteconfigs_lables_counter\":\"\\u0639\\u062f\\u062f \\u0632\\u0648\\u0627\\u0631 \\u0627\\u0644\\u0645\\u0648\\u0642\\u0639\",\"_site_page_lables_stats\":\"\\u0639\\u062f\\u062f \\u0632\\u064a\\u0627\\u0631\\u0627\\u062a \\u0627\\u0644\\u0635\\u0641\\u062d\\u0627\\u062a\",\"_site_gallery_lables_stats\":\"\\u0639\\u062f\\u062f \\u0632\\u064a\\u0627\\u0631\\u0627\\u062a \\u0627\\u0644\\u0623\\u0644\\u0628\\u0648\\u0645\\u0627\\u062a\",\"_site_subject_lables_stats\":\"\\u0639\\u062f\\u062f \\u0632\\u064a\\u0627\\u0631\\u0627\\u062a \\u0627\\u0644\\u0645\\u0648\\u0636\\u0648\\u0639\\u0627\\u062a \\u0648\\u0627\\u0644\\u0623\\u062e\\u0628\\u0627\\u0631\",\"_site_menu_lables_target\":\"\\u0627\\u0644\\u0647\\u062f\\u0641\",\"_site_menu_lables_none\":\"\\u0644\\u0627 \\u064a\\u0648\\u062c\\u062f \\u0627\\u062e\\u062a\\u064a\\u0627\\u0631\\u0627\\u062a\",\"_site_jobrequest_lables_show\":\"\\u0623\\u0639\\u0631\\u0636\",\"_site_adminactions_selectall\":\"\\u0627\\u0644\\u0643\\u0644\",\"_site_paging_next\":\"\\u0627\\u0644\\u062a\\u0627\\u0644\\u064a\",\"_site_paging_prev\":\"\\u0627\\u0644\\u0633\\u0627\\u0628\\u0642\",\"_site_adminheader_lang\":\"ar\",\"_site_adminheader_cpanel\":\"\\u0644\\u0648\\u062d\\u0629 \\u0627\\u0644\\u062a\\u062d\\u0643\\u0645\",\"_site_config_admincssfilename\":\"admin_ar\",\"_site_adminlogin_msg_welcome\":\"\\u0645\\u0631\\u062d\\u0628\\u0627\",\"_site_adminmenu_links_home\":\"\\u0627\\u0644\\u0648\\u0627\\u062c\\u0647\\u0647 \\u0627\\u0644\\u062e\\u0627\\u0631\\u062c\\u064a\\u0629\",\"_site_adminmenu_links_profile\":\"\\u062a\\u0639\\u062f\\u064a\\u0644 \\u0627\\u0644\\u0645\\u0644\\u0641 \\u0627\\u0644\\u0634\\u062e\\u0635\\u064a\",\"_site_adminmenu_links_settings\":\"\\u0627\\u0639\\u062f\\u0627\\u062f\\u0627\\u062a \\u0627\\u0644\\u0645\\u0648\\u0642\\u0639\",\"_site_adminmenu_links_logout\":\"\\u062e\\u0631\\u0648\\u062c\",\"_site_adminmenu_links_dashboard\":\"\\u0627\\u0644\\u062f\\u0627\\u0634\\u0628\\u0648\\u0631\\u062f\",\"_site_adminactions_search\":\"\\u0628\\u062d\\u062b\",\"_site_frontend_msg_validemail\":\"\\u0645\\u0646 \\u0641\\u0636\\u0644\\u0643 \\u0627\\u062f\\u062e\\u0644 \\u0627\\u0644\\u0628\\u0631\\u064a\\u062f \\u0627\\u0644\\u0627\\u0644\\u0643\\u062a\\u0631\\u0648\\u0646\\u0649 \\u0628\\u0634\\u0643\\u0644 \\u0635\\u062d\\u064a\\u062d\",\"_site_frontend_contact_lables_captcha\":\"\\u0643\\u0648\\u062f \\u0627\\u0644\\u062a\\u062d\\u0642\\u0642\",\"_site_frontend_contact_lables_send\":\"\\u0627\\u0631\\u0633\\u0627\\u0644\",\"_site_frontend_contact_lables_reset\":\"\\u0627\\u0639\\u0627\\u062f\\u0629 \\u0627\\u062f\\u062e\\u0627\\u0644\",\"_site_frontend_search_search\":\"\\u0628\\u062d\\u062b\",\"_site_msg_selectitem\":\"\\u0644\\u0627\\u0628\\u062f \\u0645\\u0646 \\u062a\\u062d\\u062f\\u064a\\u062f \\u0627\\u0644\\u062d\\u0642\\u0648\\u0644 \\u0644\\u062a\\u0646\\u0641\\u064a\\u0630 \\u0647\\u0630\\u0647 \\u0627\\u0644\\u0639\\u0645\\u0644\\u064a\\u0629\",\"_site_frontend_msg_nolayout\":\"\\u0646\\u0623\\u0633\\u0641 \\u0644\\u0639\\u062f\\u0645 \\u0639\\u0631\\u0636 \\u0627\\u0644\\u0635\\u062e\\u0629 \\u062d\\u064a\\u062b \\u0627\\u0646\\u0647\\u0627 \\u0644\\u0645 \\u064a\\u062d\\u062f\\u062f \\u0634\\u0643\\u0644 \\u0645\\u062d\\u062a\\u0648\\u0627\\u0647\\u0627\",\"_site_vote_lables_vote\":\"\\u062a\\u0635\\u0648\\u064a\\u062a\",\"_site_vote_msg_requiredmsg\":\"\\u064a\\u062c\\u0628 \\u0627\\u062e\\u062a\\u064a\\u0627\\u0631 \\u0627\\u062d\\u062f \\u0627\\u062c\\u0627\\u0628\\u0627\\u062a \\u0627\\u0644\\u062a\\u0635\\u0648\\u064a\\u062a \\u0627\\u0648\\u0644\\u0627\",\"_site_vote_msg_voted\":\"\\u0635\\u0648\\u062a\",\"_site_config_menu_margin\":\"2px 0 0 -2px\",\"_site_config_font\":\"13px\\/13px S-FontSmall\",\"_site_config_paddings\":\"0 0 0 18px\",\"_site_msg_noid\":\"\\u0644\\u0627 \\u064a\\u0648\\u062c\\u062f id \\u0644\\u062a\\u0646\\u0641\\u064a\\u0630 \\u0647\\u0630\\u0647 \\u0627\\u0644\\u0639\\u0645\\u0644\\u064a\\u0629\",\"_site_msg_assigned\":\"\\u062a\\u0645 \\u0627\\u0644\\u062a\\u062e\\u0635\\u064a\\u0635 \\u0628\\u0646\\u062c\\u0627\\u062d\",\"_site_per2rol_titles_assign\":\"\\u062a\\u062e\\u0635\\u064a\\u0635 \\u0627\\u0644\\u0635\\u0644\\u0627\\u062d\\u064a\\u0627\\u062a \\u0627\\u0644\\u0649 \\u0627\\u0644\\u0645\\u0647\\u0627\\u0645\",\"_site_roles_titles_manage\":\"\\u0642\\u0627\\u0626\\u0645\\u0629 \\u0627\\u0644\\u0645\\u0647\\u0627\\u0645\",\"_site_perms_titles_manage\":\"\\u0642\\u0627\\u0626\\u0645\\u0629 \\u0627\\u0644\\u0635\\u0644\\u0627\\u062d\\u064a\\u0627\\u062a\",\"_site_roles_lables_name\":\"\\u0627\\u0644\\u0645\\u0647\\u0645\\u0629\",\"_site_perms_lables_name\":\"\\u0627\\u0633\\u0645 \\u0627\\u0644\\u0635\\u0644\\u0627\\u062d\\u064a\\u0629\",\"_site_adminactions_assign\":\"\\u062a\\u062e\\u0635\\u064a\\u0635\",\"_site_adsec_titles_add\":\"\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0642\\u0633\\u0645 \\u062c\\u062f\\u064a\\u062f\",\"_site_adsec_titles_manage\":\"\\u0642\\u0627\\u0626\\u0645\\u0629 \\u0627\\u0642\\u0633\\u0627\\u0645 \\u0627\\u0644\\u0627\\u0639\\u0644\\u0627\\u0646\\u0627\\u062a\",\"_site_adsec_lables_name\":\"\\u0627\\u0644\\u0642\\u0633\\u0645\",\"_site_adminactions_add\":\"\\u0623\\u0636\\u0641\",\"_site_msg_wesdel\":\"\\u062a\\u0645 \\u0627\\u0644\\u0645\\u0633\\u062d \\u0628\\u0646\\u062c\\u0627\\u062d\",\"_site_msg_cantdel\":\"\\u062e\\u0637\\u0627 \\u0641\\u0649 \\u0639\\u0644\\u0645\\u0644\\u064a\\u0629 \\u0627\\u0644\\u0645\\u0633\\u062d \\u0642\\u062f \\u064a\\u0643\\u0648\\u0646 \\u0627\\u0644\\u0639\\u0646\\u0635\\u0631 \\u0645\\u0631\\u062a\\u0628\\u0637 \\u0628\\u0639\\u0646\\u0627\\u0635\\u0631 \\u0641\\u0631\\u0639\\u064a\\u0629 \\u064a\\u062c\\u0628 \\u0645\\u0633\\u062d\\u0647\\u0627 \\u0627\\u0648\\u0644\\u0627\",\"_site_adsec_titles_edit\":\"\\u062a\\u0639\\u062f\\u064a\\u0644 \\u0642\\u0633\\u0645\",\"_site_adminactions_translate\":\"\\u062a\\u0631\\u062c\\u0645\",\"_site_main_lables_charnum\":\"2255 \\u062d\\u0631\\u0641\",\"_site_adminactions_edit\":\"\\u062a\\u0639\\u062f\\u064a\\u0644\",\"_site_ad_titles_add\":\"\\u0627\\u0636\\u0641 \\u0627\\u0639\\u0644\\u0627\\u0646 \\u062c\\u062f\\u064a\\u062f\",\"_site_adminactions_publish\":\"\\u062a\\u0641\\u0639\\u064a\\u0644\",\"_site_adminactions_unpublish\":\"\\u0648\\u0642\\u0641 \\u062a\\u0641\\u0639\\u064a\\u0644\",\"_site_adminactionconf_confirmdelete\":\"\\u062a\\u0623\\u0643\\u064a\\u062f \\u0627\\u0644\\u0645\\u0633\\u062d\",\"_site_adminactions_delete\":\"\\u0645\\u0633\\u062d\",\"_site_msg_noparent\":\"\\u0627\\u0644\\u0639\\u0646\\u0635\\u0631 \\u0627\\u0644\\u0645\\u062e\\u062a\\u0627\\u0631 \\u063a\\u064a\\u0631 \\u0645\\u0648\\u062c\\u0648\\u062f\",\"_site_msg_addedbefor\":\"\\u062e\\u0637\\u0623: \\u062a\\u0645\\u062a \\u0627\\u0636\\u0627\\u0641\\u0629 \\u0647\\u0630\\u0627 \\u0627\\u0644\\u0645\\u062f\\u062e\\u0644 \\u0644\\u0646\\u0641\\u0633 \\u0644\\u0647\\u0630 \\u0627\\u0644\\u0644\\u063a\\u0629 \\u0645\\u0646 \\u0642\\u0628\\u0644\",\"_site_msg_errorsave\":\"\\u062e\\u0637\\u0623: \\u062d\\u062f\\u062b \\u0627\\u062b\\u0646\\u0627\\u0621 \\u062d\\u0641\\u0638 \\u0627\\u0644\\u062a\\u0631\\u062c\\u0645\\u0629\",\"_site_lang_titles_main\":\"\\u0627\\u0644\\u0644\\u063a\\u0627\\u062a\",\"_site_adsec_lables_translate\":\"\\u062a\\u0631\\u062c\\u0645\",\"_site_adsec_lables_charnum\":\"255 \\u062d\\u0631\\u0641\",\"_site_ad_titles_manage\":\"\\u0642\\u0627\\u0626\\u0645\\u0629 \\u0627\\u0644\\u0627\\u0639\\u0644\\u0627\\u0646\\u0627\\u062a\",\"_site_ad_lables_name\":\"\\u0627\\u0644\\u0627\\u0639\\u0644\\u0627\\u0646\",\"_site_ad_lables_charnum\":\"255 \\u062d\\u0631\\u0641\",\"_site_ad_lables_content\":\"\\u0627\\u0644\\u0648\\u0635\\u0641\",\"_site_ad_lables_url\":\"\\u0631\\u0627\\u0628\\u0637 \\u0627\\u0644\\u0627\\u0639\\u0644\\u0627\\u0646\",\"_site_ad_lables_target\":\"\\u0627\\u0644\\u0627\\u0639\\u0644\\u0627\\u0646 \\u064a\\u0641\\u062a\\u062d \\u0641\\u0649\",\"_site_ad_lables_self\":\"\\u0646\\u0641\\u0633 \\u0627\\u0644\\u0635\\u0641\\u062d\\u0629\",\"_site_ad_lables_blank\":\"\\u0635\\u0641\\u062d\\u0629 \\u0645\\u0633\\u062a\\u0642\\u0644\\u0629\",\"_site_ad_lables_photo\":\"\\u0635\\u0648\\u0631\\u0629 \\u0627\\u0644\\u0627\\u0639\\u0644\\u0627\\u0646\",\"_site_plugin_titles_add\":\"\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0645\\u0644\\u062d\\u0642 \\u062c\\u062f\\u064a\\u062f\",\"_site_adminactions_moveup\":\"\\u062a\\u062d\\u0631\\u064a\\u0643 \\u0644\\u0627\\u0639\\u0644\\u0649\",\"_site_adminactions_movedown\":\"\\u062a\\u062d\\u0631\\u064a\\u0643 \\u0644\\u0627\\u0633\\u0641\\u0644\",\"_site_ad_lables_translate\":\"\\u062a\\u0631\\u062c\\u0645\",\"_site_plugin_titles_manage\":\"\\u0642\\u0627\\u0626\\u0645\\u0629 \\u0627\\u0644\\u0645\\u0644\\u062d\\u0642\\u0627\\u062a\",\"_site_ad_titles_edit\":\"\\u062a\\u0639\\u062f\\u064a\\u0644 \\u0627\\u0644\\u0627\\u0639\\u0644\\u0627\\u0646\",\"_site_event_titles_add\":\"\\u0627\\u0636\\u0627\\u0641\\u0629 \\u062d\\u062f\\u062b \\u062c\\u062f\\u064a\\u062f\",\"_site_event_titles_manage\":\"\\u0627\\u062f\\u0627\\u0631\\u0629 \\u0627\\u0644\\u0627\\u062d\\u062f\\u0627\\u062b\",\"_site_event_lables_name\":\"\\u0627\\u0644\\u062d\\u062f\\u062b\",\"_site_event_lables_startdate\":\"\\u062a\\u0627\\u0631\\u064a\\u062e \\u0627\\u0644\\u0628\\u062f\\u0627\\u064a\\u0629\",\"_site_event_lables_enddate\":\"\\u062a\\u0627\\u0631\\u064a\\u062e \\u0627\\u0644\\u0646\\u0647\\u0627\\u064a\\u0629\",\"_site_event_lables_location\":\"\\u0627\\u0644\\u0645\\u0648\\u0642\\u0639\",\"_site_event_lables_haslink\":\"\\u064a\\u0648\\u062c\\u062f \\u0631\\u0627\\u0628\\u0637\\u061f\",\"_site_event_lables_target\":\"\\u0627\\u0644\\u0647\\u062f\\u0641\",\"_site_event_titles_edit\":\"\\u062a\\u0639\\u062f\\u064a\\u0644 \\u0627\\u0644\\u0627\\u062d\\u062f\\u0627\\u062b\",\"_site_event_lables_translate\":\"\\u062a\\u0631\\u062c\\u0645\\u0629\",\"_site_eventconfig_titles_edit\":\"\\u0627\\u0639\\u062f\\u0627\\u062f\\u0627\\u062a \\u0627\\u0644\\u0627\\u062d\\u062f\\u0627\\u062b\",\"_site_eventconfig_lables_eventdate\":\"\\u0627\\u0644\\u062a\\u0627\\u0631\\u064a\\u062e \\u0627\\u0644\\u062a\\u0644\\u0642\\u0627\\u0626\\u0649 \\u0644\\u0644\\u0627\\u062d\\u062f\\u0627\\u062b\",\"_site_eventconfig_lables_today\":\"\\u062a\\u0627\\u0631\\u064a\\u062e \\u0627\\u0644\\u064a\\u0648\\u0645\",\"_site_eventconfig_lables_updated\":\"\\u062a\\u0627\\u0631\\u064a\\u062e \\u0627\\u062e\\u0631 \\u062a\\u0639\\u062f\\u064a\\u0644\",\"_site_filemanager_labels_delete\":\"\\u0645\\u0633\\u062d \\u0627\\u0644\\u0645\\u062e\\u062a\\u0627\\u0631\",\"_site_filemanager_labels_createfile\":\"\\u0627\\u0646\\u0634\\u0627\\u0621 \\u0645\\u0644\\u0641\",\"_site_filemanager_labels_createdir\":\"\\u0627\\u0646\\u0634\\u0627\\u0621 \\u0645\\u062c\\u0644\\u062f\",\"_site_filemanager_labels_command\":\"\\u0627\\u0644\\u0627\\u0645\\u0631\",\"_site_filemanager_labels_go\":\"\\u062a\\u0646\\u0641\\u064a\\u0630\",\"_site_filemanager_labels_makebackup\":\"\\u0639\\u0645\\u0644 \\u0646\\u0633\\u062e\\u0629 \\u0627\\u062d\\u062a\\u064a\\u0627\\u0637\\u064a\\u0629\",\"_site_filemanager_labels_save\":\"\\u062d\\u0641\\u0638\",\"_site_filemanager_titles_manage\":\"\\u0627\\u062f\\u0627\\u0631\\u0629 \\u0627\\u0644\\u0645\\u0644\\u0641\\u0627\\u062a\",\"_site_filemanager_labels_shell\":\"\\u062a\\u0646\\u0641\\u064a\\u0630 \\u0627\\u0645\\u0631 \\u0634\\u064a\\u0644\",\"_site_filemanager_labels_size\":\"\\u0627\\u0644\\u062d\\u062c\\u0645\",\"_site_filemanager_labels_type\":\"\\u0627\\u0644\\u0646\\u0648\\u0639\",\"_site_filemanager_labels_selectall\":\"\\u0627\\u062e\\u062a\\u0631 \\u0627\\u0644\\u0643\\u0644\",\"_site_filemanager_titles_current\":\"\\u0627\\u0644\\u0645\\u0633\\u0627\\u0631 \\u0627\\u0644\\u062d\\u0627\\u0644\\u0649\",\"_site_filemanager_labels_upload\":\"\\u062a\\u062d\\u0645\\u064a\\u0644\",\"_site_file_titles_add\":\"\\u0627\\u0636\\u0627\\u0641\\u0629 \\u0645\\u0644\\u0641 \\u062c\\u062f\\u064a\\u062f\",\"_site_file_titles_manage\":\"\\u0627\\u062f\\u0627\\u0631\\u0629 \\u0627\\u0644\\u0645\\u0644\\u0641\\u0627\\u062a\",\"_site_file_lables_file\":\"\\u0627\\u062e\\u062a\\u0631 \\u0627\\u0644\\u0645\\u0644\\u0641\\u0627\\u062a\",\"_site_adminactions_uploading\":\"... \\u062a\\u062d\\u0645\\u064a\\u0644\",\"_site_file_titles_edit\":\"\\u062a\\u0639\\u062f\\u064a\\u0644 \\u0645\\u0644\\u0641\",\"_site_file_lables_name\":\"\\u0648\\u0635\\u0641 \\u0627\\u0644\\u0645\\u0644\\u0641\",\"_site_file_lables_type\":\"\\u0627\\u0644\\u0646\\u0648\\u0639\",\"_site_file_lables_size\":\"\\u0627\\u0644\\u062d\\u062c\\u0645\",\"_site_gallery_titles_add\":\"\\u0627\\u0636\\u0627\\u0641\\u0629 \\u0627\\u0644\\u0628\\u0648\\u0645 \\u062c\\u062f\\u064a\\u062f\",\"_site_gallery_titles_manage\":\"\\u0642\\u0627\\u0626\\u0645\\u0629 \\u0627\\u0644\\u0627\\u0644\\u0628\\u0648\\u0645\\u0627\\u062a\",\"_site_gallery_lables_name\":\"\\u0627\\u0644\\u0627\\u0644\\u0628\\u0648\\u0645\",\"_site_gallery_lables_charnum\":\"255 \\u062d\\u0631\\u0641\",\"_site_gallery_lables_urlalias\":\"\\u0627\\u0633\\u0645 \\u0627\\u0644\\u0635\\u0641\\u062d\\u0629 \\u0641\\u0649 \\u0639\\u0646\\u0648\\u0627\\u0646 \\u0627\\u0644\\u0645\\u0648\\u0642\\u0639\",\"_site_gallery_lables_folder\":\"\\u0627\\u0633\\u0645 \\u0627\\u0644\\u0645\\u062c\\u0644\\u062f\",\"_site_gallery_lables_paging\":\"\\u0627\\u0644\\u0639\\u062f\\u062f \\u0641\\u0649 \\u0643\\u0644 \\u0635\\u0641\\u062d\\u0629\",\"_site_menu_lables_addtomenu\":\"\\u0627\\u0636\\u0627\\u0641\\u0629 \\u0643\\u0642\\u0627\\u0626\\u0645\\u0629\",\"_site_menu_lables_parent\":\"\\u0627\\u0644\\u0642\\u0627\\u0626\\u0645\\u0629 \\u0627\\u0644\\u0627\\u0628\",\"_site_menu_lables_toplevel\":\"\\u0627\\u0639\\u0644\\u0649 \\u0645\\u0633\\u062a\\u0648\\u0649\",\"_site_gallery_lables_thumbwidth\":\"\\u0639\\u0631\\u0636 \\u0627\\u0644\\u0627\\u064a\\u0643\\u0648\\u0646\",\"_site_gallery_lables_thumbheight\":\"\\u0637\\u0648\\u0644 \\u0627\\u0644\\u0627\\u064a\\u0643\\u0648\\u0646\",\"_site_gallery_lables_imagewidth\":\"\\u0639\\u0631\\u0636 \\u0627\\u0644\\u0635\\u0648\\u0631\\u0629\",\"_site_gallery_lables_imageheight\":\"\\u0637\\u0648\\u0644 \\u0627\\u0644\\u0635\\u0648\\u0631\\u0629\",\"_site_gallery_titles_edit\":\"\\u062a\\u0639\\u062f\\u064a\\u0644 \\u0627\\u0644\\u0627\\u0644\\u0628\\u0648\\u0645\",\"_site_gallery_lables_link\":\"\\u0627\\u0644\\u0631\\u0627\\u0628\\u0637\",\"_site_gallery_lables_addmedia\":\"\\u0627\\u0636\\u0627\\u0641\\u0629 \\u0645\\u064a\\u062f\\u064a\\u0627\",\"_site_gallery_lables_counter\":\"\\u0639\\u062f\\u062f \\u0627\\u0644\\u0632\\u0648\\u0627\\u0631\",\"_site_layout_titles_main\":\"\\u062a\\u0635\\u0645\\u064a\\u0645 \\u0627\\u0644\\u0635\\u0641\\u062d\\u0629\",\"_site_gallery_lables_translate\":\"\\u062a\\u0631\\u062c\\u0645\\u0629\",\"_site_lang_titles_add\":\"\\u0627\\u0636\\u0627\\u0641\\u0629 \\u0644\\u063a\\u0629 \\u062c\\u062f\\u064a\\u062f\\u0629\",\"_site_lang_titles_manage\":\"\\u0642\\u0627\\u0626\\u0645\\u0629 \\u0627\\u0644\\u0644\\u063a\\u0627\\u062a\",\"_site_lang_lables_name\":\"\\u0627\\u0644\\u0627\\u0633\\u0645\",\"_site_lang_lables_alias\":\"\\u0627\\u0644\\u0627\\u0633\\u0645 \\u0627\\u0644\\u0628\\u062f\\u064a\\u0644\",\"_site_lang_lables_direction\":\"\\u0627\\u062a\\u062c\\u0627\\u0647 \\u0627\\u0644\\u0645\\u0648\\u0642\\u0639\",\"_site_lang_lables_ltr\":\"\\u0645\\u0646 \\u0627\\u0644\\u064a\\u0633\\u0627\\u0631 \\u0627\\u0644\\u0649 \\u0627\\u0644\\u064a\\u0645\\u064a\\u0646\",\"_site_lang_lables_rtl\":\"\\u0645\\u0646 \\u0627\\u0644\\u064a\\u0645\\u064a\\u0646 \\u0627\\u0644\\u0649 \\u0627\\u0644\\u064a\\u0633\\u0627\\u0631\",\"_site_lang_lables_xmlfile\":\"\\u0645\\u0644\\u0641 XML\",\"_site_lang_lables_cssfile\":\"\\u0645\\u0644\\u0641 CSS\",\"_site_msg_filedeleted\":\"\\u062a\\u0645 \\u0645\\u0633\\u062d \\u0627\\u0644\\u0645\\u0644\\u0641\",\"_site_lang_titles_edit\":\"\\u062a\\u0639\\u062f\\u064a\\u0644 \\u0627\\u0644\\u0644\\u063a\\u0629\",\"_site_menu_titles_manage\":\"\\u0639\\u0646\\u0627\\u0635\\u0631 \\u0627\\u0644\\u0642\\u0627\\u0626\\u0645\\u0629\",\"_site_lang_lables_publish\":\"\\u062a\\u0641\\u0639\\u064a\\u0644\",\"_site_lang_lables_default\":\"\\u0644\\u063a\\u0629 \\u0627\\u0644\\u0645\\u0648\\u0642\\u0639\",\"_site_adminactions_default\":\"\\u0625\\u0641\\u062a\\u0631\\u0627\\u0636\\u0649\",\"_site_jobrequest_titles_manage\":\"\\u0627\\u062f\\u0627\\u0631\\u0629 \\u0637\\u0644\\u0628\\u0627\\u062a \\u0627\\u0644\\u062a\\u0648\\u0638\\u064a\\u0641\",\"_site_jobrequest_lables_full_name\":\"\\u0627\\u0644\\u0627\\u0633\\u0645 \\u0628\\u0627\\u0644\\u0643\\u0627\\u0645\\u0644\",\"_site_jobrequest_lables_file_id\":\"\\u0627\\u0644\\u0633\\u064a\\u0631\\u0629 \\u0627\\u0644\\u0630\\u0627\\u062a\\u064a\\u0629\",\"_site_jobrequest_lables_mobile\":\"\\u0627\\u0644\\u062c\\u0648\\u0627\\u0644\",\"_site_jobrequest_lables_email\":\"\\u0627\\u0644\\u0628\\u0631\\u064a\\u062f \\u0627\\u0644\\u0627\\u0644\\u0643\\u062a\\u0631\\u0648\\u0646\\u064a\",\"_site_jobrequest_lables_name\":\"\\u0637\\u0644\\u0628 \\u062a\\u0648\\u0638\\u064a\\u0641\",\"_site_jobrequest_lables_gender\":\"\\u0627\\u0644\\u0646\\u0648\\u0639\",\"_site_jobrequest_lables_notes\":\"\\u0645\\u0644\\u0627\\u062d\\u0638\\u0627\\u062a \\u0623\\u062e\\u0631\\u064a\",\"_site_adminactions_created\":\"\\u062a\\u0627\\u0631\\u064a\\u062e \\u0627\\u0644\\u062a\\u0633\\u062c\\u064a\\u0644\",\"_site_msg_cantfindresults\":\"\\u0639\\u0641\\u0648\\u0627 \\u0644\\u0627 \\u062a\\u0648\\u062c\\u062f \\u0646\\u062a\\u0627\\u0626\\u062c\",\"_site_join_requests_titles_manage\":\"\\u0627\\u062f\\u0627\\u0631\\u0629 \\u0637\\u0644\\u0628\\u0627\\u062a \\u0627\\u0644\\u062a\\u0633\\u062c\\u064a\\u0644\",\"_site_join_requests_lables_full_name\":\"\\u0627\\u0644\\u0627\\u0633\\u0645 \\u0628\\u0627\\u0644\\u0643\\u0627\\u0645\\u0644\",\"_site_join_requests_lables_photo\":\"\\u0627\\u0644\\u0635\\u0648\\u0631\\u0629\",\"_site_join_requests_lables_birth_date\":\"\\u062a\\u0627\\u0631\\u064a\\u062e \\u0627\\u0644\\u0645\\u064a\\u0644\\u0627\\u062f\",\"_site_join_requests_lables_nationality\":\"\\u0627\\u0644\\u062c\\u0646\\u0633\\u064a\\u0629\",\"_site_join_requests_lables_stage_no\":\"\\u0627\\u0644\\u0645\\u0631\\u062d\\u0644\\u0629\",\"_site_join_requests_lables_level_no\":\"\\u0627\\u0644\\u0635\\u0641\",\"_site_join_requests_lables_category_id\":\"\\u0627\\u0644\\u0642\\u0633\\u0645\",\"_site_join_requests_lables_parent_mobile\":\"\\u062c\\u0648\\u0627\\u0644 \\u0648\\u0644\\u0649 \\u0627\\u0644\\u0627\\u0645\\u0631\",\"_site_join_requests_lables_parent_email\":\"\\u0628\\u0631\\u064a\\u062f \\u0648\\u0644\\u0649 \\u0627\\u0644\\u0627\\u0645\\u0631\",\"_site_join_requests_lables_name\":\"\\u0637\\u0644\\u0628 \\u062a\\u0633\\u062c\\u064a\\u0644\",\"_site_join_requests_lables_gender\":\"\\u0627\\u0644\\u0646\\u0648\\u0639\",\"_site_join_requests_lables_mobile\":\"\\u0627\\u0644\\u062c\\u0648\\u0627\\u0644\",\"_site_join_requests_lables_email\":\"\\u0627\\u0644\\u0628\\u0631\\u064a\\u062f \\u0627\\u0644\\u0627\\u0644\\u0643\\u062a\\u0631\\u0648\\u0646\\u064a\",\"_site_join_requests_lables_id_no\":\"\\u0631\\u0642\\u0645 \\u0627\\u0644\\u0647\\u0648\\u064a\\u0629\",\"_site_join_requests_lables_address\":\"\\u0627\\u0644\\u0639\\u0646\\u0648\\u0627\\u0646\",\"_site_join_requests_lables_parent_full_name\":\"\\u0627\\u0633\\u0645 \\u0648\\u0644\\u0649 \\u0627\\u0644\\u0627\\u0645\\u0631\",\"_site_join_requests_lables_parent_id_no\":\"\\u0631\\u0642\\u0645 \\u0647\\u0648\\u064a\\u0629 \\u0648\\u0644\\u0649 \\u0627\\u0644\\u0627\\u0645\\u0631\",\"_site_layout_validation_pageormodule\":\"\\u0645\\u0646 \\u0641\\u0636\\u0644\\u0643 \\u0627\\u062e\\u062a\\u0631 \\u0627\\u0644\\u0635\\u0641\\u062d\\u0629 \\u0627\\u0648 \\u0627\\u0644\\u0645\\u0648\\u062f\\u064a\\u0648\\u0644 \\u0627\\u0648 \\u0627\\u0644\\u0634\\u0643\\u0644 \\u0627\\u0644\\u062a\\u0644\\u0642\\u0627\\u0626\\u0649 \\u0644\\u0627\\u0633\\u062a\\u0643\\u0645\\u0627\\u0644 \\u062a\\u0637\\u0628\\u064a\\u0642 \\u0627\\u0644\\u0634\\u0643\\u0644\",\"_site_layout_titles_manage\":\"\\u062a\\u0635\\u0645\\u064a\\u0645 \\u0627\\u0644\\u0635\\u0641\\u062d\\u0629\",\"_site_adminactions_updated\":\"\\u062a\\u0627\\u0631\\u064a\\u062e \\u0627\\u0644\\u062a\\u0639\\u062f\\u064a\\u0644\",\"_site_layout_lables_page\":\"\\u0627\\u062e\\u062a\\u0631 \\u0627\\u0644\\u0635\\u0641\\u062d\\u0629\",\"_site_layout_lables_module\":\"\\u0627\\u062e\\u062a\\u0631 \\u0627\\u0644\\u0645\\u0648\\u062f\\u064a\\u0648\\u0644\",\"_site_layout_lables_defaults\":\"\\u0627\\u0644\\u0634\\u0643\\u0644 \\u0627\\u0644\\u0625\\u0641\\u062a\\u0631\\u0627\\u0636\\u0649\",\"_site_layout_lables_makedefault\":\"\\u0627\\u0633\\u062a\\u062d\\u062f\\u0627\\u0645 \\u0627\\u0644\\u0634\\u0643\\u0644 \\u0627\\u0644\\u0625\\u0641\\u062a\\u0631\\u0627\\u0636\\u0649 \\u0644\\u0647\\u0630\\u0627 \\u0627\\u0644\\u0645\\u062d\\u062a\\u0648\\u0649\",\"_site_layout_titles_apply\":\"\\u062a\\u0637\\u0628\\u064a\\u0642\",\"_site_layout_titles_save\":\"\\u062d\\u0641\\u0638\",\"_site_adminlogin_lables_login\":\"\\u062f\\u062e\\u0648\\u0644 \\u0627\\u0644\\u0645\\u062f\\u0631\\u0627\\u0621\",\"_site_users_lables_username\":\"\\u0627\\u0644\\u0645\\u0633\\u062a\\u062e\\u062f\\u0645\",\"_site_users_lables_password\":\"\\u0643\\u0644\\u0645\\u0629 \\u0627\\u0644\\u0645\\u0631\\u0648\\u0631\",\"_site_adminactions_login\":\"\\u062f\\u062e\\u0648\\u0644\",\"_site_log_titles_logfile\":\"\\u0645\\u0644\\u0641 \\u0627\\u0644\\u0644\\u0648\\u062c\",\"_site_log_titles_clearlog\":\"\\u0645\\u0633\\u062d \\u0645\\u062d\\u062a\\u0648\\u064a\\u0627\\u062a \\u0627\\u0644\\u0645\\u0644\\u0641\",\"_site_log_msg_cntread\":\"\\u0644\\u0627 \\u064a\\u0645\\u0643\\u0646 \\u0627\\u0644\\u0642\\u0631\\u0627\\u0621\\u0629 \\u0645\\u0646 \\u0645\\u0644\\u0641 \\u0627\\u0644\\u0644\\u0648\\u062c\",\"_site_mailgroup_titles_add\":\"\\u0623\\u0636\\u0641 \\u0645\\u062c\\u0645\\u0648\\u0639\\u0629 \\u062c\\u062f\\u064a\\u062f\\u064a\\u0629\",\"_site_mailgroup_titles_manage\":\"\\u0627\\u062f\\u0627\\u0631\\u0629 \\u0627\\u0644\\u0645\\u062c\\u0645\\u0648\\u0639\\u0627\\u062a\",\"_site_mailgroup_lables_name\":\"\\u0627\\u0644\\u0645\\u062c\\u0645\\u0648\\u0639\\u0629\",\"_site_mailmessage_lables_charnum\":\"\\u062d\\u0631\\u0641 255\",\"_site_mailgroup_titles_edit\":\"\\u062a\\u0639\\u062f\\u064a\\u0644 \\u0645\\u062c\\u0645\\u0648\\u0639\\u0629\",\"_site_mailgroup_lables_charnum\":\"\\u062d\\u0631\\u0641 255\",\"_site_mailgroup_lables_newsletter\":\"\\u0627\\u0644\\u0642\\u0627\\u0626\\u0645\\u0629 \\u0627\\u0644\\u0628\\u0631\\u064a\\u062f\\u064a\\u0629 \\u0627\\u0644\\u0631\\u0626\\u064a\\u0633\\u064a\\u0629\",\"_site_mailgroup_lables_translate\":\"\\u062a\\u0631\\u062c\\u0645\\u0629\",\"_site_mail_titles_add\":\"\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0627\\u064a\\u0645\\u064a\\u0644 \\u0648\\u062c\\u0648\\u0627\\u0644\",\"_site_mail_titles_manage\":\"\\u0627\\u062f\\u0627\\u0631\\u0629 \\u0627\\u0644\\u0627\\u064a\\u0645\\u064a\\u0644\\u0627\\u062a\",\"_site_mail_titles_addlist\":\"\\u0627\\u0636\\u0641 \\u0645\\u062c\\u0645\\u0648\\u0639\\u0629 \\u0645\\u0646 \\u0627\\u0644\\u0627\\u064a\\u0645\\u064a\\u0644\\u0627\\u062a\",\"_site_mail_lables_name\":\"\\u0627\\u0644\\u0627\\u064a\\u0645\\u064a\\u0644\",\"_site_mail_lables_charnum\":\"\\u062d\\u0631\\u0641 255\",\"_site_mail_lables_mobile\":\"\\u0627\\u0644\\u0647\\u0627\\u062a\\u0641 \\u0627\\u0644\\u062c\\u0648\\u0627\\u0644\",\"_site_mailgroup_titles_main\":\"\\u0627\\u0644\\u0645\\u062c\\u0645\\u0648\\u0639\\u0627\\u062a \\u0627\\u0644\\u0628\\u0631\\u064a\\u062f\\u064a\\u0629\",\"_site_mail_lables_canuse\":\"\\u064a\\u0645\\u0643\\u0646\\u0643 \\u0627\\u0633\\u062a\\u062e\\u062f\\u0627\\u0645 \',\' \\u0623\\u0648 \';\' \\u0623\\u0648 \'\\u0633\\u0637\\u0631 \\u062c\\u062f\\u064a\\u062f\' \\u0644\\u0644\\u0641\\u0635\\u0644 \\u0628\\u064a\\u0646 \\u0627\\u0644\\u0627\\u064a\\u0645\\u064a\\u0644\\u0627\\u062a\",\"_site_mail_titles_edit\":\"\\u062a\\u0639\\u062f\\u064a\\u0644 \\u0627\\u0644\\u0627\\u064a\\u0645\\u064a\\u0644\",\"_site_part_lables_select\":\"\\u0627\\u062e\\u062a\\u0631\",\"_site_mailmessage_titles_manage\":\"\\u0627\\u062f\\u0627\\u0631\\u0629 \\u0627\\u0644\\u0631\\u0633\\u0627\\u0626\\u0644 \\u0627\\u0644\\u0628\\u0631\\u064a\\u062f\\u064a\\u0629\",\"_site_mailmessage_titles_send\":\"\\u0627\\u0631\\u0633\\u0627\\u0644 \\u0627\\u0644\\u0631\\u0633\\u0627\\u0626\\u0644 \\u0627\\u0644\\u0628\\u0631\\u064a\\u062f\\u064a\\u0629\",\"_site_mailmessage_lables_from\":\"\\u0645\\u0646\",\"_site_mailmessage_lables_subject\":\"\\u0627\\u0644\\u0645\\u0648\\u0636\\u0648\\u0639\",\"_site_mailmessage_lables_content\":\"\\u0627\\u0644\\u0645\\u062d\\u062a\\u0648\\u0649\",\"_site_mailmessage_lables_date\":\"\\u0627\\u0644\\u062a\\u0627\\u0631\\u064a\\u062e\",\"_site_mailmessage_lables_preview\":\"\\u0639\\u0631\\u0636 \\u0627\\u0644\\u0645\\u062d\\u062a\\u0648\\u0649\",\"_site_mailmessage_validation_cantfindmessage\":\"\\u0646\\u0627\\u0633\\u0641 \\u0644\\u0639\\u062f\\u0645 \\u0648\\u062c\\u0648\\u062f \\u0627\\u0644\\u0631\\u0633\\u0627\\u0644\\u0629\",\"_site_mailmessage_lables_direction\":\"\\u0627\\u062a\\u062c\\u0627\\u0647 \\u0627\\u0644\\u0631\\u0633\\u0627\\u0644\\u0629\",\"_site_mailmessage_lables_ltr\":\"\\u0645\\u0646 \\u0627\\u0644\\u064a\\u0633\\u0627\\u0631 \\u0627\\u0644\\u0649 \\u0627\\u0644\\u064a\\u0645\\u064a\\u0646\",\"_site_mailmessage_lables_rtl\":\"\\u0645\\u0646 \\u0627\\u0644\\u064a\\u0645\\u064a\\u0646 \\u0627\\u0644\\u0649 \\u0627\\u0644\\u064a\\u0633\\u0627\\u0631\",\"_site_adminactions_send\":\"\\u0625\\u0631\\u0633\\u0627\\u0644\",\"_site_main_titles_add\":\"\\u0627\\u0636\\u0627\\u0641\\u0629 \\u0642\\u0633\\u0645 \\u062c\\u062f\\u064a\\u062f\",\"_site_main_titles_manage\":\"\\u0642\\u0627\\u0626\\u0645\\u0629 \\u0627\\u0644\\u0627\\u0642\\u0633\\u0627\\u0645\",\"_site_main_lables_name\":\"\\u0627\\u0644\\u0642\\u0633\\u0645\",\"_site_main_lables_urlalias\":\"\\u0627\\u0644\\u0627\\u0633\\u0645 \\u0627\\u0644\\u0628\\u062f\\u064a\\u0644 \\u0641\\u0649 \\u0639\\u0646\\u0648\\u0627\\u0646 \\u0627\\u0644\\u0645\\u0648\\u0642\\u0639\",\"_site_main_lables_parent\":\"\\u062a\\u0627\\u0628\\u0639 \\u0644\\u0640\\u0640\",\"_site_main_lables_toplevel\":\"\\u0627\\u0639\\u0644\\u0649 \\u0645\\u0633\\u062a\\u0648\\u0649\",\"_site_main_lables_paging\":\"\\u0627\\u0644\\u0639\\u062f\\u062f \\u0641\\u0649 \\u0643\\u0644 \\u0635\\u0641\\u062d\\u0629\",\"_site_main_lables_layout\":\"\\u062a\\u0635\\u0645\\u064a\\u0645 \\u0627\\u0644\\u0635\\u0641\\u062d\\u0629 \\u0627\\u0644\\u062f\\u0627\\u062e\\u0644\\u0649\",\"_site_main_lables_subjectsort\":\"\\u0637\\u0631\\u064a\\u0642\\u0629 \\u062a\\u0631\\u062a\\u064a\\u0628 \\u0627\\u0644\\u0645\\u0648\\u0636\\u0648\\u0639\\u0627\\u062a \\u062f\\u0627\\u062e\\u0644 \\u0627\\u0644\\u0642\\u0633\\u0645\",\"_site_main_lables_content\":\"\\u0627\\u0644\\u0645\\u062d\\u062a\\u0648\\u0649\",\"_site_main_titles_edit\":\"\\u062a\\u0639\\u062f\\u064a\\u0644 \\u0627\\u0644\\u0642\\u0633\\u0645\",\"_site_main_lables_link\":\"\\u0627\\u0644\\u0631\\u0627\\u0628\\u0637\",\"_site_main_lables_addsubject\":\"\\u0627\\u0636\\u0641 \\u0645\\u0648\\u0636\\u0648\\u0639\",\"_site_main_lables_translate\":\"\\u062a\\u0631\\u062c\\u0645\\u0629\",\"_site_gallery_msg_detrmingallery\":\"\\u064a\\u062c\\u0628 \\u0639\\u0644\\u064a\\u0643 \\u0627\\u0636\\u0627\\u0641\\u0629 \\u0627\\u0644\\u0645\\u0648\\u0627\\u062f \\u0628\\u0639\\u062f \\u0627\\u062e\\u062a\\u064a\\u0627\\u0631 \\u0627\\u0644\\u0628\\u0648\\u0645 \\u0645\\u062d\\u062f\\u062f\",\"_site_media_titles_add\":\"\\u0627\\u0636\\u0627\\u0641\\u0629 \\u0645\\u064a\\u062f\\u064a\\u0627\",\"_site_media_titles_manage\":\"\\u0642\\u0627\\u0626\\u0645\\u0629 \\u0627\\u0644\\u0648\\u0633\\u0627\\u0626\\u0637\",\"_site_media_lables_youtube\":\"\\u064a\\u0648\\u062a\\u064a\\u0648\\u0628\",\"_site_media_lables_upload\":\"\\u0625\\u0636\\u063a\\u0637 \\u0647\\u0646\\u0627 \\u0644\\u0644\\u062a\\u062d\\u0645\\u064a\\u0644\",\"_site_media_lables_name\":\"\\u0627\\u0644\\u0645\\u064a\\u062f\\u064a\\u0627\",\"_site_media_lables_charnum\":\"255 \\u062d\\u0631\\u0641\",\"_site_media_lables_link\":\"\\u0631\\u0627\\u0628\\u0637 \\u0627\\u0644\\u064a\\u0648\\u062a\\u064a\\u0648\\u0628\",\"_site_media_lables_width\":\"\\u0627\\u0644\\u0639\\u0631\\u0636\",\"_site_media_lables_height\":\"\\u0627\\u0644\\u0637\\u0648\\u0644\",\"_site_media_titles_edit\":\"\\u062a\\u0639\\u062f\\u064a\\u0644 \\u0627\\u0644\\u0645\\u064a\\u062f\\u064a\\u0627\",\"_site_media_lables_thumb\":\"\\u0627\\u0644\\u0635\\u0648\\u0631\\u0629\",\"_site_media_lables_type\":\"\\u0627\\u0644\\u0646\\u0648\\u0639\",\"_site_media_lables_image\":\"\\u0635\\u0648\\u0631\\u0629\",\"_site_media_lables_translate\":\"\\u062a\\u0631\\u062c\\u0645\\u0629\",\"_site_msg_notfile\":\"\\u0644\\u0627 \\u064a\\u0645\\u0643\\u0646 \\u062a\\u062d\\u0645\\u064a\\u0644 \\u0627\\u0644\\u0645\\u0644\\u0641 \\u0627\\u0646\\u0647 \\u0644\\u064a\\u0633 \\u0645\\u0646 \\u0627\\u0646\\u0648\\u0627\\u0639 \\u0627\\u0644\\u0645\\u0644\\u0641\\u0627\\u062a \\u0627\\u0644\\u0645\\u0633\\u0645\\u0648\\u062d \\u0628\\u0647\\u0627\",\"_site_menu_titles_add\":\"\\u0627\\u0636\\u0627\\u0641\\u0629 \\u0642\\u0627\\u0626\\u0645\\u0629 \\u062c\\u062f\\u064a\\u062f\\u0629\",\"_site_menu_lables_name\":\"\\u0627\\u0633\\u0645 \\u0627\\u0644\\u0642\\u0627\\u0626\\u0645\\u0629\",\"_site_menu_lables_charnum\":\"\\u062d\\u0631\\u0641 255\",\"_site_menu_lables_fonticon\":\"\\u0627\\u0644\\u0623\\u064a\\u0642\\u0648\\u0646\\u0647\",\"_site_menu_lables_menulayout\":\"\\u0634\\u0643\\u0644 \\u0627\\u0644\\u0642\\u0627\\u0626\\u0645\\u0629 \\u0627\\u0644\\u0645\\u0646\\u0633\\u062f\\u0644\\u0629\",\"_site_menu_lables_onecol\":\"\\u0639\\u0645\\u0648\\u062f \\u0648\\u0627\\u062d\\u062f\",\"_site_menu_lables_multicol\":\"\\u0645\\u062a\\u0639\\u062f\\u062f\\u0629 \\u0627\\u0644\\u0623\\u0639\\u0645\\u062f\\u0629\",\"_site_menu_lables_hidesubmenu\":\"\\u0627\\u0644\\u0627\\u062e\\u0641\\u0627\\u0621 \\u0645\\u0646 \\u0627\\u0644\\u0642\\u0627\\u0626\\u0645\\u0629 \\u0627\\u0644\\u0627\\u0641\\u0642\\u064a\\u0629\",\"_site_menu_lables_type\":\"\\u0646\\u0648\\u0639 \\u0627\\u0644\\u0645\\u062d\\u062a\\u0648\\u0649\",\"_site_menu_lables_select\":\"\\u0627\\u062e\\u062a\\u0631\",\"_site_menu_lables_page\":\"\\u0627\\u062e\\u062a\\u0631 \\u0645\\u0646 \\u0627\\u0644\\u0635\\u0641\\u062d\\u0627\\u062a\",\"_site_menu_lables_main\":\"\\u0627\\u062e\\u062a\\u0631 \\u0645\\u0646 \\u0627\\u0644\\u0627\\u0642\\u0633\\u0627\\u0645 \\u0627\\u0644\\u0631\\u0626\\u064a\\u0633\\u064a\\u0629\",\"_site_menu_lables_gallery\":\"\\u0627\\u062e\\u062a\\u0631 \\u0645\\u0646 \\u0627\\u0644\\u0627\\u0644\\u0628\\u0648\\u0645\\u0627\\u062a\",\"_site_menu_lables_module\":\"\\u0627\\u062e\\u062a\\u0631 \\u0645\\u0646 \\u0627\\u0644\\u0645\\u0648\\u062f\\u064a\\u0648\\u0644\\u0627\\u062a\",\"_site_menu_lables_permission\":\"\\u0627\\u0644\\u0635\\u0644\\u0627\\u062d\\u064a\\u0629\",\"_site_menu_lables_extlink\":\"\\u0631\\u0627\\u0628\\u0637 \\u062e\\u0627\\u0631\\u062c\\u064a\",\"_site_menu_lables_link\":\"\\u0645\\u062d\\u062a\\u0648\\u0649 \\u0627\\u0644\\u0631\\u0627\\u0628\\u0637\",\"_site_menu_titles_edit\":\"\\u062a\\u0639\\u062f\\u064a\\u0644 \\u0642\\u0627\\u0626\\u0645\\u0629\",\"_site_menu_lables_sortid\":\"\\u0627\\u0644\\u062a\\u0631\\u062a\\u064a\\u0628\",\"_site_menu_lables_translate\":\"\\u062a\\u0631\\u062c\\u0645\\u0629\",\"_site_module_titles_add\":\"\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0645\\u0648\\u062f\\u064a\\u0648\\u0644 \\u062c\\u062f\\u064a\\u062f\",\"_site_module_titles_manage\":\"\\u0642\\u0627\\u0626\\u0645\\u0629 \\u0627\\u0644\\u0645\\u0648\\u062f\\u064a\\u0648\\u0644\\u0627\\u062a\",\"_site_module_lables_name\":\"\\u0627\\u0644\\u0645\\u0648\\u062f\\u064a\\u0648\\u0644\",\"_site_module_lables_charnum\":\"255 \\u062d\\u0631\\u0641\",\"_site_module_lables_urlalias\":\"\\u0627\\u0644\\u0627\\u0633\\u0645 \\u0627\\u0644\\u0628\\u062f\\u064a\\u0644 \\u0641\\u0649 \\u0639\\u0646\\u0648\\u0627\\u0646 \\u0627\\u0644\\u0645\\u0648\\u0642\\u0639\",\"_site_module_lables_relatedclass\":\"\\u0627\\u0644\\u0635\\u0641\\u062d\\u0629 \\u0627\\u0644\\u0645\\u0644\\u062d\\u0642 \\u0628\\u0647\",\"_site_module_lables_keywords\":\"\\u0643\\u0644\\u0645\\u0627\\u062a \\u0627\\u0644\\u0628\\u062d\\u062b\",\"_site_module_lables_description\":\"\\u0627\\u0644\\u0648\\u0635\\u0641\",\"_site_module_titles_edit\":\"\\u062a\\u0639\\u062f\\u064a\\u0644 \\u0645\\u0648\\u062f\\u064a\\u0648\\u0644\",\"_site_module_lables_link\":\"\\u0627\\u0644\\u0631\\u0627\\u0628\\u0637\",\"_site_module_lables_translate\":\"\\u062a\\u0631\\u062c\\u0645\",\"_site_page_titles_add\":\"\\u0625\\u0636\\u0627\\u0641\\u0629 \\u0635\\u0641\\u062d\\u0629\",\"_site_page_titles_manage\":\"\\u0642\\u0627\\u0626\\u0645\\u0629 \\u0627\\u0644\\u0635\\u0641\\u062d\\u0627\\u062a\",\"_site_page_lables_name\":\"\\u0627\\u0644\\u0635\\u0641\\u062d\\u0629\",\"_site_page_lables_charnum\":\"255 \\u062d\\u0631\\u0641\",\"_site_page_lables_urlalias\":\"\\u0627\\u0633\\u0645 \\u0627\\u0644\\u0635\\u0641\\u062d\\u0629 \\u0641\\u0649 \\u0639\\u0646\\u0648\\u0627\\u0646 \\u0627\\u0644\\u0645\\u0648\\u0642\\u0639\",\"_site_page_lables_content\":\"\\u0627\\u0644\\u0645\\u062d\\u062a\\u0648\\u0649\",\"_site_page_lables_module\":\"\\u0627\\u0644\\u0642\\u0633\\u0645 \\u0627\\u0644\\u0645\\u0631\\u0641\\u0642\",\"_site_page_lables_select\":\"\\u0627\\u062e\\u062a\\u0631\",\"_site_page_lables_keywords\":\"\\u0643\\u0644\\u0645\\u0627\\u062a \\u0627\\u0644\\u0628\\u062d\\u062b\",\"_site_page_lables_description\":\"\\u0627\\u0644\\u0648\\u0635\\u0641\",\"_site_page_titles_edit\":\"\\u062a\\u0639\\u062f\\u064a\\u0644 \\u0635\\u0641\\u062d\\u0629\",\"_site_page_lables_translate\":\"\\u062a\\u0631\\u062c\\u0645\\u0629\",\"_site_page_lables_link\":\"\\u0627\\u0644\\u0631\\u0627\\u0628\\u0637\",\"_site_page_lables_homepage\":\"\\u0627\\u0644\\u0635\\u0641\\u062d\\u0629 \\u0627\\u0644\\u0631\\u0626\\u064a\\u0633\\u064a\\u0629\",\"_site_page_lables_contacts\":\"\\u0627\\u062a\\u0635\\u0644 \\u0628\\u0646\\u0627\",\"_site_part_titles_add\":\"\\u0627\\u0636\\u0627\\u0641\\u0629 \\u062c\\u0632\\u0621 \\u062c\\u062f\\u064a\\u062f\",\"_site_page_lables_counter\":\"\\u0639\\u062f\\u062f \\u0627\\u0644\\u0632\\u0648\\u0627\\u0631\",\"_site_part_titles_manage\":\"\\u0642\\u0627\\u0626\\u0645\\u0629 \\u0627\\u0644\\u0627\\u062c\\u0632\\u0627\\u0621\",\"_site_part_lables_name\":\"\\u0627\\u0644\\u0639\\u0646\\u0648\\u0627\\u0646\",\"_site_part_lables_charnum\":\"\\u062d\\u0631\\u0641 255\",\"_site_part_lables_page\":\"\\u0627\\u0644\\u0635\\u0641\\u062d\\u0629\",\"_site_part_lables_showtitle\":\"\\u0627\\u0638\\u0647\\u0627\\u0631 \\u0627\\u0644\\u0639\\u0646\\u0648\\u0627\\u0646\",\"_site_part_lables_content\":\"\\u0627\\u0644\\u0645\\u062d\\u062a\\u0648\\u0649\",\"_site_part_titles_edit\":\"\\u062a\\u0639\\u062f\\u064a\\u0644 \\u062c\\u0632\\u0621\",\"_site_photos_titles_manage\":\"\\u0642\\u0627\\u0626\\u0645\\u0629 \\u0627\\u0644\\u0635\\u0648\\u0631\",\"_site_part_lables_translate\":\"\\u062a\\u0631\\u062c\\u0645\\u0629\",\"_site_perms_titles_add\":\"\\u0627\\u0636\\u0627\\u0641\\u0629 \\u0635\\u0644\\u0627\\u062d\\u064a\\u0629 \\u062c\\u062f\\u064a\\u062f\\u0629\",\"_site_perms_lables_charnum\":\"255 \\u062d\\u0631\\u0641\",\"_site_persecs_lables_name\":\"\\u0627\\u0644\\u0642\\u0633\\u0645\",\"_site_perms_lables_pagepath\":\"\\u0645\\u0633\\u0627\\u0631 \\u0627\\u0644\\u0635\\u0641\\u062d\\u0629\",\"_site_perms_titles_edit\":\"\\u062a\\u0639\\u062f\\u064a\\u0644 \\u0627\\u0644\\u0635\\u0644\\u0627\\u062d\\u064a\\u0629\",\"_site_persecs_titles_manage\":\"\\u0642\\u0627\\u0626\\u0645\\u0629 \\u0627\\u0644\\u0623\\u0642\\u0633\\u0627\\u0645\",\"_site_persecs_titles_add\":\"\\u0627\\u0636\\u0627\\u0641\\u0629 \\u0642\\u0633\\u0645 \\u062c\\u062f\\u064a\\u062f\",\"_site_persecs_lables_charnum\":\"255 \\u062d\\u0631\\u0641\",\"_site_persecs_titles_edit\":\"\\u062a\\u0639\\u062f\\u064a\\u0644 \\u0642\\u0633\\u0645\",\"_site_photos_titles_add\":\"\\u0627\\u0636\\u0627\\u0641\\u0629 \\u0635\\u0648\\u0631\\u0629 \\u062c\\u062f\\u064a\\u062f\\u0629\",\"_site_photos_lables_selectfile\":\"\\u0627\\u062e\\u062a\\u0631 \\u0627\\u0644\\u0635\\u0648\\u0631\",\"_site_photos_lables_thumbwidth\":\"\\u0639\\u0631\\u0636 \\u0627\\u0644\\u0627\\u064a\\u0643\\u0648\\u0646\",\"_site_photos_lables_thumbheight\":\"\\u0637\\u0648\\u0644 \\u0627\\u0644\\u0627\\u064a\\u0643\\u0648\\u0646\",\"_site_photos_lables_imagewidth\":\"\\u0639\\u0631\\u0636 \\u0627\\u0644\\u0635\\u0648\\u0631\\u0629\",\"_site_photos_lables_imageheight\":\"\\u0637\\u0648\\u0644 \\u0627\\u0644\\u0635\\u0648\\u0631\\u0629\",\"_site_adminactions_upload\":\"\\u062a\\u062d\\u0645\\u064a\\u0644\",\"_site_photos_titles_edit\":\"Edit\",\"_site_photos_lables_select\":\"\\u0625\\u062e\\u062a\\u0631\",\"_site_photos_lables_admin\":\"\\u0627\\u0644\\u0627\\u062f\\u0645\\u0646\",\"_site_photos_lables_image\":\"\\u0627\\u0644\\u0635\\u0648\\u0631\\u0629\",\"_site_photos_lables_caption\":\"\\u0634\\u0631\\u062d\",\"_site_photos_lables_link\":\"\\u0627\\u0644\\u0631\\u0627\\u0628\\u0637\",\"_site_photos_lables_size\":\"\\u0627\\u0644\\u062d\\u062c\\u0645\",\"_site_photos_lables_type\":\"\\u0627\\u0644\\u0646\\u0648\\u0639\",\"_site_photos_lables_thumb\":\"\\u0635\\u063a\\u064a\\u0631\\u0629\",\"_site_photos_lables_larg\":\"\\u0643\\u0628\\u064a\\u0631\\u0629\",\"_site_plugin_lables_name\":\"\\u0645\\u0644\\u062d\\u0642\",\"_site_plugin_lables_charnum\":\"255 \\u062d\\u0631\\u0641\",\"_site_plugin_lables_showtitle\":\"\\u0639\\u0631\\u0636 \\u0627\\u0644\\u0639\\u0646\\u0648\\u0627\\u0646\",\"_site_plugin_lables_hasmenu\":\"\\u0627\\u0646\\u0634\\u0627\\u0621 \\u0642\\u0627\\u0626\\u0645\\u0629 \\u062c\\u0627\\u0646\\u0628\\u064a\\u0629\",\"_site_plugin_lables_menu\":\"\\u0627\\u0644\\u0642\\u0648\\u0627\\u0626\\u0645 \\u0627\\u0644\\u0627\\u0633\\u0627\\u0633\\u064a\\u0629\",\"_site_adminactions_select\":\"\\u0627\\u062e\\u062a\\u0631\",\"_site_plugin_lables_haspage\":\"\\u0645\\u0644\\u062d\\u0642\\u0629 \\u0628\\u0645\\u0644\\u0641 \\u0628\\u0631\\u0645\\u062c\\u064a\",\"_site_plugin_lables_relatedclass\":\"\\u0627\\u0644\\u0635\\u0641\\u062d\\u0629 \\u0627\\u0644\\u0645\\u0644\\u062d\\u0642\\u0629 \\u0628\\u0647\",\"_site_plugin_lables_relatedsec\":\"\\u0645\\u0631\\u062a\\u0628\\u0637 \\u0628\\u0642\\u0633\\u0645\",\"_site_plugin_lables_select\":\"\\u0627\\u062e\\u062a\\u0631 \\u0627\\u0644\\u0642\\u0633\\u0645\",\"_site_plugin_lables_adsec\":\"\\u0642\\u0633\\u0645 \\u0627\\u0639\\u0644\\u0627\\u0646\\u064a\",\"_site_plugin_lables_main\":\"\\u0627\\u0644\\u0627\\u0642\\u0633\\u0627\\u0645 \\u0627\\u0644\\u0631\\u0626\\u064a\\u0633\\u064a\\u0629\",\"_site_plugin_lables_gallery\":\"\\u0627\\u0644\\u0627\\u0644\\u0628\\u0648\\u0645\\u0627\\u062a\",\"_site_plugin_lables_selectsec\":\"\\u0627\\u062e\\u062a\\u0631 \\u0627\\u0644\\u0642\\u0633\\u0645\",\"_site_plugin_lables_cssclass\":\"\\u0627\\u0633\\u0645 \\u0627\\u0644\\u0643\\u0644\\u0627\\u0633 CSS\",\"_site_plugin_lables_csscustomstyle\":\"\\u0627\\u0636\\u0627\\u0641\\u0629 \\u0627\\u0633\\u062a\\u0627\\u064a\\u0644 CSS\",\"_site_plugin_lables_csscustomstylebrief\":\"\\u0627\\u0636\\u0627\\u0641\\u0629 \\u0627\\u0633\\u062a\\u0627\\u064a\\u0644 \\u0645\\u062b\\u0644\",\"_site_plugin_lables_htmlid\":\"HTML ID\",\"_site_plugin_lables_content\":\"\\u0627\\u0644\\u0645\\u062d\\u062a\\u0648\\u0649\",\"_site_plugin_lables_javascript\":\"\\u062c\\u0627\\u0641\\u0627 \\u0627\\u0633\\u0643\\u0631\\u0628\\u062a\",\"_site_plugin_lables_javascriptbrief\":\"\\u064a\\u062d\\u0628 \\u0627\\u0636\\u0627\\u0641\\u0629 \\u0627\\u0644\\u062c\\u0627\\u0641\\u0627 \\u0627\\u0633\\u0643\\u0631\\u0628\\u062a \\u0628\\u064a\\u0646\",\"_site_plugin_titles_edit\":\"\\u062a\\u0639\\u062f\\u064a\\u0644 \\u0645\\u0644\\u062d\\u0642\",\"_site_plugin_lables_translate\":\"\\u062a\\u0631\\u062c\\u0645\",\"_site_roles_titles_add\":\"\\u0627\\u0636\\u0627\\u0641\\u0629 \\u0645\\u0647\\u0645\\u0629 \\u062c\\u062f\\u064a\\u062f\\u0629\",\"_site_roles_lables_site\":\"\\u0627\\u0644\\u0645\\u0648\\u0642\\u0639\",\"_site_roles_titles_edit\":\"\\u062a\\u0639\\u062f\\u064a\\u0644 \\u0627\\u0644\\u0645\\u0647\\u0645\\u0629\",\"_site_siteconfigs_titles_add\":\"\\u0627\\u0636\\u0627\\u0641\\u0629 \\u0645\\u0648\\u0642\\u0639\",\"_site_siteconfigs_titles_manage\":\"\\u0642\\u0627\\u0626\\u0645\\u0629 \\u0627\\u0644\\u0645\\u0648\\u0627\\u0642\\u0639\",\"_site_siteconfigs_lables_title\":\"\\u0639\\u0646\\u0648\\u0627\\u0646 \\u0627\\u0644\\u0645\\u0648\\u0642\\u0639\",\"_site_siteconfigs_lables_logo_path\":\"\\u0635\\u0648\\u0631\\u0629 \\u0627\\u0644\\u0644\\u0648\\u062c\\u0648\",\"_site_siteconfigs_lables_slogan_path\":\"\\u0635\\u0648\\u0631\\u0629 \\u0627\\u0644\\u0643\\u0644\\u064a\\u0634\\u0629\",\"_site_siteconfigs_lables_alias\":\"\\u0627\\u0644\\u0631\\u0627\\u0628\\u0637 \\u0627\\u0644\\u0628\\u062f\\u064a\\u0644\",\"_site_siteconfigs_lables_email\":\"\\u0627\\u0644\\u0628\\u0631\\u064a\\u062f \\u0627\\u0644\\u0627\\u0644\\u0643\\u062a\\u0631\\u0648\\u0646\\u0649\",\"_site_siteconfigs_lables_phone\":\"\\u0627\\u0644\\u062a\\u0644\\u064a\\u0641\\u0648\\u0646\",\"_site_siteconfigs_lables_address\":\"\\u0627\\u0644\\u0639\\u0646\\u0648\\u0627\\u0646\",\"_site_siteconfigs_lables_paging\":\"\\u0639\\u062f\\u062f \\u0646\\u062a\\u0627\\u0626\\u062c \\u0627\\u0644\\u0628\\u062d\\u062b \\u0641\\u0649 \\u0627\\u0644\\u0635\\u0641\\u062d\\u0629\",\"_site_siteconfigs_lables_facebook\":\"\\u0627\\u0644\\u0641\\u064a\\u0633 \\u0628\\u0648\\u0643\",\"_site_siteconfigs_lables_twitter\":\"\\u0627\\u0644\\u062a\\u0648\\u064a\\u062a\\u0631\",\"_site_siteconfigs_lables_youtube\":\"\\u0627\\u0644\\u064a\\u0648\\u062a\\u064a\\u0648\\u0628\",\"_site_siteconfigs_lables_flickr\":\"\\u0627\\u0646\\u0633\\u062a\\u062c\\u0631\\u0627\\u0645\",\"_site_siteconfigs_lables_googleplus\":\"\\u062c\\u0648\\u062c\\u0644 \\u0628\\u0644\\u0633\",\"_site_siteconfigs_lables_linkedin\":\"\\u0644\\u064a\\u0646\\u0643\\u062f\\u0627\\u0646\",\"_site_siteconfigs_lables_copyrights\":\"\\u0627\\u0644\\u062d\\u0642\\u0648\\u0642\",\"_site_siteconfigs_lables_background\":\"\\u062e\\u0644\\u0641\\u064a\\u0629 \\u0627\\u0644\\u0645\\u0648\\u0642\\u0639\",\"_site_siteconfigs_lables_offline\":\"\\u0627\\u063a\\u0644\\u0627\\u0642 \\u0627\\u0644\\u0645\\u0648\\u0642\\u0639\",\"_site_siteconfigs_lables_offlinemsg\":\"\\u0631\\u0633\\u0627\\u0644\\u0629 \\u0627\\u063a\\u0644\\u0627\\u0642 \\u0627\\u0644\\u0645\\u0648\\u0642\\u0639\",\"_site_siteconfigs_lables_googleanalytics\":\"\\u062a\\u062d\\u0644\\u064a\\u0644\\u0627\\u062a \\u062c\\u0648\\u062c\\u0644\",\"_site_siteconfigs_lables_keywords\":\"\\u0643\\u0644\\u0645\\u0627\\u062a \\u0627\\u0644\\u0628\\u062d\\u062b\",\"_site_siteconfigs_lables_description\":\"\\u0648\\u0635\\u0641 \\u0627\\u0644\\u0645\\u0648\\u0642\\u0639\",\"_site_siteconfigs_lables_showlang\":\"\\u0639\\u0631\\u0636 \\u0627\\u0644\\u0644\\u063a\\u0627\\u062a\",\"_site_siteconfigs_lables_showsites\":\"\\u0639\\u0631\\u0636 \\u0642\\u0627\\u0626\\u0645\\u0629 \\u0627\\u0644\\u0645\\u0648\\u0627\\u0642\\u0639\",\"_site_siteconfigs_lables_seo\":\"\\u0627\\u062a\\u0627\\u062d\\u0629 \\u0635\\u062f\\u0627\\u0642\\u0629 \\u0645\\u062d\\u0631\\u0643\\u0627\\u062a \\u0627\\u0644\\u0628\\u062d\\u062b\",\"_site_siteconfigs_titles_edit\":\"\\u062a\\u0639\\u062f\\u064a\\u0644 \\u0645\\u0648\\u0642\\u0639\",\"_site_siteconfigs_lables_updated\":\"\\u062a\\u0627\\u0631\\u064a\\u062e \\u0627\\u062e\\u0631 \\u062a\\u0639\\u062f\\u064a\\u0644\",\"_site_siteconfigs_lables_translate\":\"\\u062a\\u0631\\u062c\\u0645\\u0629\",\"_site_subject_titles_add\":\"\\u0627\\u0636\\u0627\\u0641\\u0629 \\u0645\\u0648\\u0636\\u0648\\u0639\",\"_site_subject_titles_manage\":\"\\u0642\\u0627\\u0626\\u0645\\u0629 \\u0627\\u0644\\u0645\\u0648\\u0636\\u0648\\u0639\\u0627\\u062a\",\"_site_subject_lables_name\":\"\\u0627\\u0644\\u0645\\u0648\\u0636\\u0648\\u0639\",\"_site_subject_lables_charnum\":\"255 \\u062d\\u0631\\u0641\",\"_site_subject_lables_urlalias\":\"\\u0627\\u0644\\u0627\\u0633\\u0645 \\u0627\\u0644\\u0628\\u062f\\u064a\\u0644 \\u0641\\u0649 \\u0639\\u0646\\u0648\\u0627\\u0646 \\u0627\\u0644\\u0645\\u0648\\u0642\\u0639\",\"_site_subject_lables_date\":\"\\u0627\\u0644\\u062a\\u0627\\u0631\\u064a\\u062e\",\"_site_subject_lables_photo\":\"\\u0627\\u0644\\u0635\\u0648\\u0631\\u0629\",\"_site_main_titles_main\":\"\\u0627\\u0644\\u0627\\u0642\\u0633\\u0627\\u0645\",\"_site_subject_lables_contentshort\":\"\\u0646\\u0628\\u0630\\u0629 \\u0645\\u062e\\u062a\\u0635\\u0631\\u0629\",\"_site_subject_lables_content\":\"\\u0627\\u0644\\u0645\\u062d\\u062a\\u0648\\u0649\",\"_site_subject_lables_keywords\":\"\\u0643\\u0644\\u0645\\u0627\\u062a \\u0627\\u0644\\u0628\\u062d\\u062b\",\"_site_subject_lables_description\":\"\\u0627\\u0644\\u0648\\u0635\\u0641\",\"_site_subject_lables_showdate\":\"\\u0639\\u0631\\u0636 \\u0627\\u0644\\u062a\\u0627\\u0631\\u064a\\u062e\",\"_site_subject_lables_allowfbcomment\":\"\\u0627\\u0644\\u0633\\u0645\\u0627\\u062d \\u0628\\u062a\\u0639\\u0644\\u064a\\u0642\\u0627\\u062a \\u0627\\u0644\\u0641\\u064a\\u0633 \\u0628\\u0648\\u0643\",\"_site_subject_titles_edit\":\"\\u062a\\u0639\\u062f\\u064a\\u0644 \\u0627\\u0644\\u0645\\u0648\\u0636\\u0648\\u0639\",\"_site_subject_lables_link\":\"\\u0627\\u0644\\u0631\\u0627\\u0628\\u0637\",\"_site_subject_lables_counter\":\"\\u0639\\u062f\\u062f \\u0627\\u0644\\u0632\\u0648\\u0627\\u0631\",\"_site_subject_lables_translate\":\"\\u062a\\u0631\\u062c\\u0645\\u0629\",\"_site_subscription_titles_manage\":\"\\u0627\\u062f\\u0627\\u0631\\u0629 \\u0627\\u0644\\u0627\\u0634\\u062a\\u0631\\u0627\\u0643\\u0627\\u062a\",\"_site_subscription_lables_name\":\"\\u0627\\u0644\\u0627\\u0634\\u062a\\u0631\\u0627\\u0643\",\"_site_subscription_lables_fullname\":\"\\u0627\\u0644\\u0625\\u0633\\u0645 \\u0628\\u0627\\u0644\\u0643\\u0627\\u0645\\u0644\",\"_site_subscription_lables_gender\":\"\\u0627\\u0644\\u062c\\u0646\\u0633\",\"_site_subscription_lables_male\":\"\\u0630\\u0643\\u0631\",\"_site_subscription_lables_female\":\"\\u0623\\u0646\\u062b\\u064a\",\"_site_subscription_lables_birthdate\":\"\\u062a\\u0627\\u0631\\u064a\\u062e \\u0627\\u0644\\u0645\\u064a\\u0644\\u0627\\u062f\",\"_site_subscription_lables_profession\":\"\\u0627\\u0644\\u0645\\u0647\\u0646\\u0647\",\"_site_subscription_lables_nationality\":\"\\u0627\\u0644\\u062c\\u0646\\u0633\\u064a\\u0629\",\"_site_subscription_lables_tel\":\"\\u0627\\u0644\\u0647\\u0627\\u062a\\u0641\",\"_site_subscription_lables_mobile\":\"\\u0627\\u0644\\u062c\\u0648\\u0627\\u0644\",\"_site_subscription_lables_email\":\"\\u0627\\u0644\\u0628\\u0631\\u064a\\u062f \\u0627\\u0644\\u0625\\u0644\\u0643\\u062a\\u0631\\u0648\\u0646\\u0649\",\"_site_subscription_lables_country\":\"\\u0627\\u0644\\u062f\\u0648\\u0644\\u0629\",\"_site_subscription_lables_interests\":\"\\u0627\\u0644\\u0627\\u0647\\u062a\\u0645\\u0627\\u0645\\u0627\\u062a\",\"_site_users_titles_add\":\"\\u0627\\u0636\\u0627\\u0641\\u0629 \\u0645\\u0633\\u062a\\u062e\\u062f\\u0645 \\u062c\\u062f\\u064a\\u062f\",\"_site_users_titles_manage\":\"\\u0642\\u0627\\u0626\\u0645\\u0629 \\u0627\\u0644\\u0645\\u0633\\u062a\\u062e\\u062f\\u0645\\u064a\\u0646\",\"_site_users_lables_email\":\"\\u0627\\u0644\\u0628\\u0631\\u064a\\u062f \\u0627\\u0644\\u0627\\u0644\\u0643\\u062a\\u0631\\u0648\\u0646\\u0649\",\"_site_users_titles_edit\":\"\\u062a\\u0639\\u062f\\u064a\\u0644 \\u0627\\u0644\\u0645\\u0633\\u062a\\u062e\\u062f\\u0645\",\"_site_votequestion_titles_add\":\"\\u0627\\u0636\\u0627\\u0641\\u0629 \\u0633\\u0624\\u0627\\u0644 \\u062c\\u062f\\u064a\\u062f\",\"_site_votequestion_titles_manage\":\"\\u0627\\u062f\\u0627\\u0631\\u0629 \\u0627\\u0633\\u0626\\u0644\\u0629 \\u0627\\u0644\\u062a\\u0635\\u0648\\u064a\\u062a\",\"_site_voteanswer_lables_name\":\"\\u0627\\u0644\\u0627\\u062c\\u0627\\u0628\\u0629\",\"_site_voteanswer_lables_questionid\":\"\\u0627\\u0644\\u0633\\u0624\\u0627\\u0644\",\"_site_voteanswer_titles_manage\":\"\\u0627\\u062f\\u0627\\u0631\\u0629 \\u0627\\u0644\\u0627\\u062c\\u0627\\u0628\\u0627\\u062a\",\"_site_votequestion_titles_main\":\"\\u0627\\u0633\\u0626\\u0644\\u0629 \\u0627\\u0644\\u062a\\u0635\\u0648\\u064a\\u062a\",\"_site_votequestion_lables_name\":\"\\u0633\\u0624\\u0627\\u0644\",\"_site_votequestion_lables_translate\":\"\\u0627\\u0644\\u062a\\u0631\\u062c\\u0645\\u0629\",\"_site_voteanswer_titles_edit\":\"\\u062a\\u0639\\u062f\\u064a\\u0644 \\u0627\\u0644\\u0627\\u062c\\u0627\\u0628\\u0629\",\"_site_voteanswer_titles_add\":\"\\u0627\\u0636\\u0627\\u0641\\u0629 \\u0627\\u062c\\u0627\\u0628\\u0629 \\u062c\\u062f\\u064a\\u062f\\u0629\",\"_site_voteanswer_lables_translate\":\"\\u0627\\u0644\\u062a\\u0631\\u062c\\u0645\\u0629\",\"_site_votequestion_lables_addanswer\":\"\\u0627\\u0636\\u0641 \\u0627\\u062c\\u0627\\u0628\\u0629\",\"_site_votequestion_titles_edit\":\"\\u062a\\u0639\\u062f\\u064a\\u0644 \\u0633\\u0624\\u0627\\u0644\",\"_site_votequestion_lables_charnum\":\"\\u062d\\u0631\\u0641 255\",\"_site_vote_lables_result\":\"\\u0646\\u062a\\u0627\\u0626\\u062c \\u0627\\u0644\\u062a\\u0635\\u0648\\u064a\\u062a\",\"_site_vote_msg_cantfindvote\":\"\\u0644\\u0627 \\u064a\\u0648\\u062c\\u062f \\u062a\\u0635\\u0648\\u064a\\u062a\",\"_site_config_langalias\":\"_ar\",\"_site_frontend_login_send\":\"\\u0627\\u0631\\u0633\\u0627\\u0644\",\"_site_subscription_lables_captcha\":\"\\u0643\\u0648\\u062f \\u0627\\u0644\\u062a\\u062d\\u0642\\u0642\",\"_site_subscription_lables_subscribe\":\"\\u0627\\u0634\\u062a\\u0631\\u0643\",\"_site_subscription_lables_reset\":\"\\u0627\\u0639\\u0627\\u062f\\u0629 \\u0627\\u062f\\u062e\\u0627\\u0644\",\"_site_msg_pluginnosec\":\"\\u0644\\u0645 \\u064a\\u062a\\u0645 \\u062a\\u062e\\u0635\\u064a\\u0635 \\u0642\\u0633\\u0645 \\u0644\\u0647\\u0630\\u0627 \\u0627\\u0644\\u0645\\u0644\\u062d\\u0642\",\"_site_frontend_counter_days\":\"\\u064a\\u0648\\u0645\",\"_site_frontend_counter_hours\":\"\\u0633\\u0627\\u0639\\u0629\",\"_site_frontend_counter_minutes\":\"\\u062f\\u0642\\u064a\\u0642\\u0629\",\"_site_frontend_counter_seconds\":\"\\u062b\\u0627\\u0646\\u064a\\u0629\",\"_site_frontend_counter_btnreg\":\"\\u0633\\u062c\\u0644 \\u062d\\u0636\\u0648\\u0631\\u0643 \\u0641\\u0649 \\u0627\\u0644\\u0646\\u062f\\u0648\\u0629\",\"_site_frontend_counter_btnregmsg\":\"\\u0633\\u062c\\u0644 \\u062d\\u0636\\u0648\\u0631\\u0643 \\u0641\\u0649 \\u0627\\u0644\\u0646\\u062f\\u0648\\u0647 \\u0642\\u0628\\u0644 \\u062a\\u0627\\u0631\\u064a\\u062e \\u0627\\u0644\\u0628\\u062f\\u0627\\u064a\\u0629\",\"_site_frontend_home_sitename\":\"\",\"_site_frontend_home_sitebrief\":\"\",\"_site_frontend_home_homelabel\":\"\\u0627\\u0644\\u0631\\u0626\\u064a\\u0633\\u064a\\u0629\",\"_site_adminactions_loading\":\"\\u062a\\u062d\\u0645\\u064a\\u0644\",\"_site_frontend_newsletter_join\":\"\\u0627\\u0634\\u062a\\u0631\\u0643\",\"_site_frontend_msg_donthavedefaultnewsletter\":\"\\u064a\\u062c\\u0628 \\u0639\\u0644\\u064a\\u0643 \\u062a\\u062e\\u0635\\u064a\\u0635 \\u0627\\u0644\\u0642\\u0627\\u0626\\u0645\\u0629 \\u0627\\u0644\\u0628\\u0631\\u064a\\u062f\\u064a\\u0629\",\"_site_msg_notphoto\":\"\\u0644\\u0627 \\u064a\\u0645\\u0643\\u0646 \\u062a\\u062d\\u0645\\u064a\\u0644 \\u0627\\u0644\\u0645\\u0644\\u0641 \\u0627\\u0646\\u0647 \\u0644\\u064a\\u0633 \\u0645\\u0646 \\u0627\\u0646\\u0648\\u0627\\u0639 \\u0627\\u0644\\u0635\\u0648\\u0631\",\"_site_msg_relatedclass\":\"\\u062a\\u0645 \\u062a\\u062e\\u0635\\u064a\\u0635 \\u0647\\u0630\\u0647 \\u0627\\u0644\\u0635\\u0641\\u062d\\u0629 \\u0627\\u0644\\u0649 \\u0645\\u0648\\u062f\\u064a\\u0648\\u0644 \\u0627\\u062e\\u0631\\u0649\",\"_site_frontend_msg_homenotassigned\":\"\\u0644\\u0645 \\u064a\\u062a\\u0645 \\u062a\\u062e\\u0635\\u064a\\u0635 \\u0627\\u0644\\u0635\\u0641\\u062d\\u0629 \\u0627\\u0644\\u0631\\u0626\\u064a\\u0633\\u064a\\u0629\",\"_site_msg_atleastone\":\"\\u064a\\u062c\\u0628 \\u0627\\u062e\\u062a\\u064a\\u0627\\u0631 \\u0639\\u0644\\u0649 \\u0627\\u0644\\u0627\\u0642\\u0644 \\u062d\\u0642\\u0644 \\u0648\\u0627\\u062d\\u062f \\u0644\\u0627\\u062a\\u0645\\u0627\\u0645 \\u0647\\u0630\\u0647 \\u0627\\u0644\\u0639\\u0645\\u0644\\u064a\\u0629\",\"_site_photos_msg_nofile\":\"\\u0644\\u0627 \\u064a\\u0648\\u062c\\u062f \\u0645\\u0644\\u0641 \\u0644\\u0644\\u062a\\u062d\\u0645\\u064a\\u0644\",\"_site_photos_msg_longer255\":\"\\u0627\\u0644\\u0645\\u062f\\u062e\\u0644 \\u0644\\u0627\\u064a\\u0632\\u064a\\u062f \\u0639\\u0646 255 \\u062d\\u0631\\u0641\",\"_site_photos_msg_cantfind\":\"\\u0645\\u0643\\u0627\\u0646 \\u0627\\u0644\\u0645\\u0644\\u0641 \\u063a\\u064a\\u0631 \\u0645\\u062a\\u0627\\u062d\",\"_site_photos_msg_exists\":\"\\u0645\\u0648\\u062c\\u0648\\u062f \\u0628\\u0627\\u0644\\u0641\\u0639\\u0644\",\"_site_photos_msg_dirper\":\"\\u0641\\u0634\\u0644 \\u0641\\u0649 \\u0627\\u0644\\u0631\\u0641\\u0639 \\u0644\\u0627\\u064a\\u0648\\u062c\\u062f \\u0635\\u0644\\u0627\\u062d\\u064a\\u0629 \\u0644\\u0627\\u062a\\u0645\\u0627\\u0645 \\u0627\\u0644\\u0639\\u0645\\u0644\\u064a\\u0629\",\"_site_msg_noperm\":\"\\u0646\\u0623\\u0633\\u0641 ! \\u0644\\u064a\\u0633 \\u0644\\u062f\\u064a\\u0643 \\u0635\\u0644\\u0627\\u062d\\u064a\\u0629 \\u0644\\u062a\\u0646\\u0641\\u064a\\u0630 \\u0630\\u0644\\u0643\",\"_site_adminlogin_msg_incordata\":\"\\u0627\\u0633\\u0645 \\u0627\\u0644\\u0645\\u0633\\u062a\\u062e\\u062f\\u0645\\\\\\u0643\\u0644\\u0645\\u0629 \\u0627\\u0644\\u0645\\u0631\\u0648\\u0631 \\u063a\\u064a\\u0631 \\u0635\\u062d\\u064a\\u062d\",\"_site_adminlogin_msg_failattemp\":\"\\u0645\\u062d\\u0627\\u0648\\u0644\\u0629 \\u062e\\u0627\\u0637\\u0626\\u0629 , \\u0639\\u062f\\u062f \\u0627\\u0644\\u0645\\u062d\\u0627\\u0648\\u0644\\u0627\\u062a \\u0627\\u0644\\u0645\\u062a\\u0628\\u0642\\u064a\\u0629\",\"_site_adminlogin_msg_userlocked\":\"\\u0647\\u0630\\u0627 \\u0627\\u0644\\u0645\\u0633\\u062a\\u062e\\u062f\\u0645 \\u0645\\u062d\\u0638\\u0648\\u0631 \\u0645\\u0624\\u0642\\u062a\\u0627 \\u0644\\u0645\\u062f\\u0629 5 \\u062f\\u0642\\u0627\\u0626\\u0642 \\u0644\\u0623\\u0646\\u0647 \\u062a\\u062c\\u0627\\u0648\\u0632 \\u0627\\u0644\\u062d\\u062f \\u0627\\u0644\\u0623\\u0642\\u0635\\u064a \\u0644\\u0645\\u062d\\u0627\\u0648\\u0644\\u0627\\u062a \\u062a\\u0633\\u062c\\u064a\\u0644 \\u0627\\u0644\\u062f\\u062e\\u0648\\u0644\",\"_site_adminlogin_msg_userunpublished\":\"\\u0647\\u0630\\u0627 \\u0627\\u0644\\u0645\\u0633\\u062a\\u062e\\u062f\\u0645 \\u0645\\u0648\\u0642\\u0648\\u0641 , \\u0631\\u062c\\u0627\\u0621\\u0627 \\u062a\\u0648\\u0627\\u0635\\u0644 \\u0645\\u0639 \\u0645\\u062f\\u064a\\u0631 \\u0627\\u0644\\u0646\\u0638\\u0627\\u0645\",\"_site_msg_usernameexist\":\"\\u0627\\u0633\\u0645 \\u0627\\u0644\\u0645\\u0633\\u062a\\u062e\\u062f\\u0645 \\u0645\\u0648\\u062c\\u0648\\u062f \\u0644\\u062f\\u064a\\u0646\\u0627\",\"_site_vote_msg_iderror\":\"\\u062e\\u0637\\u0623 \\u0641\\u0649 ID \\u0627\\u0644\\u0627\\u062c\\u0627\\u0628\\u0629\",\"_site_vote_msg_alreadyvoted\":\"\\u0644\\u0642\\u062f \\u0642\\u0645\\u062a \\u0628\\u0627\\u062c\\u0631\\u0627\\u0621 \\u0627\\u0644\\u062a\\u0635\\u0648\\u064a\\u062a \\u0645\\u0646 \\u0642\\u0628\\u0644\",\"activity_logs\":\"\\u0633\\u062c\\u0644\\u0627\\u062a \\u0627\\u0644\\u0646\\u0634\\u0627\\u0637\",\"delete_all_logs\":\"\\u062d\\u0630\\u0641 \\u0643\\u0627\\u0641\\u0629 \\u0627\\u0644\\u0633\\u062c\\u0644\\u0627\\u062a\",\"number\":\"\\u0631\\u0642\\u0645\",\"path\":\"\\u0645\\u0633\\u0627\\u0631\",\"actions\":\"\\u0623\\u062c\\u0631\\u0627\\u0621\\u0627\\u062a\",\"message\":\"\\u0631\\u0633\\u0627\\u0644\\u0629\",\"date\":\"\\u062a\\u0627\\u0631\\u064a\\u062e\",\"ip_number\":\"\\u0631\\u0642\\u0645 IP\",\"contact_us\":\"\\u0627\\u062a\\u0635\\u0644 \\u0628\\u0646\\u0627\",\"contactus_requests\":\"\\u0637\\u0644\\u0628\\u0627\\u062a \\u0627\\u0644\\u0627\\u062a\\u0635\\u0627\\u0644\",\"name\":\"\\u0627\\u0633\\u0645\",\"phone\":\"\\u0647\\u0627\\u062a\\u0641\",\"email\":\"\\u0627\\u0644\\u0628\\u0631\\u064a\\u062f \\u0627\\u0644\\u0625\\u0644\\u0643\\u062a\\u0631\\u0648\\u0646\\u064a\",\"ip_address\":\"\\u0639\\u0646\\u0648\\u0627\\u0646 IP\",\"fail_in_deleting_process\":\"\\u0641\\u0634\\u0644 \\u0641\\u064a \\u062d\\u0630\\u0641 \\u0627\\u0644\\u0639\\u0645\\u0644\\u064a\\u0629\",\"delete_checked_items\":\"\\u062d\\u0630\\u0641 \\u0627\\u0644\\u0639\\u0646\\u0627\\u0635\\u0631 \\u0627\\u0644\\u0645\\u062d\\u062f\\u062f\\u0629\",\"edit_phrases\":\"\\u062a\\u062d\\u0631\\u064a\\u0631 \\u0627\\u0644\\u0639\\u0628\\u0627\\u0631\\u0627\\u062a\",\"request_of\":\"\\u0637\\u0644\\u0628\",\"default_language\":\"\\u0627\\u0644\\u0644\\u063a\\u0629 \\u0627\\u0644\\u0627\\u0641\\u062a\\u0631\\u0627\\u0636\\u064a\\u0629\",\"default_site\":\"\\u0627\\u0644\\u0645\\u0648\\u0642\\u0639 \\u0627\\u0644\\u0627\\u0641\\u062a\\u0631\\u0627\\u0636\\u064a\",\"unified_number\":\"\\u0631\\u0642\\u0645 \\u0645\\u0648\\u062d\\u062f\",\"follow_us\":\"\\u062a\\u0627\\u0628\\u0639\\u0646\\u0627\",\"alharameen_app\":\"\\u062a\\u0637\\u0628\\u064a\\u0642 \\u0627\\u0644\\u062d\\u0631\\u0645\\u064a\\u0646\",\"download_from_store\":\"\\u062a\\u062d\\u0645\\u064a\\u0644 \\u0645\\u0646 \\u0627\\u0644\\u0645\\u062a\\u062c\\u0631\",\"alharameen_app_iphone\":\"\\u062a\\u0637\\u0628\\u064a\\u0642 \\u0627\\u0644\\u062d\\u0631\\u0645\\u064a\\u0646\",\"alharameen_app_android\":\"\\u062a\\u0637\\u0628\\u064a\\u0642 \\u0627\\u0644\\u062d\\u0631\\u0645\\u064a\\u0646\",\"font_type\":\"\\u0646\\u0648\\u0639 \\u0627\\u0644\\u062e\\u0637\",\"some_error_occurred\":\"\\u062d\\u062f\\u062b \\u062e\\u0637\\u0623 \\u0645\\u0627\",\"download_app\":\"\\u062a\\u062d\\u0645\\u064a\\u0644 \\u0627\\u0644\\u062a\\u0637\\u0628\\u064a\\u0642\",\"primary\":\"\\u0627\\u0628\\u062a\\u062f\\u0627\\u0626\\u064a\",\"intermediate\":\"\\u0645\\u062a\\u0648\\u0633\\u0637\",\"secondary\":\"\\u062b\\u0627\\u0646\\u0648\\u064a\"}', 'dinar_one_medium.otf');

-- --------------------------------------------------------

--
-- Table structure for table `layout`
--

CREATE TABLE `layout` (
  `id` int(11) NOT NULL,
  `page_id` int(11) DEFAULT NULL,
  `module_id` int(11) DEFAULT NULL,
  `defaults` int(11) DEFAULT NULL,
  `top_side` varchar(255) DEFAULT NULL,
  `left_side` varchar(255) DEFAULT NULL,
  `right_side` varchar(255) DEFAULT NULL,
  `bottom_side` varchar(255) DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `site_id` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `layout`
--

INSERT INTO `layout` (`id`, `page_id`, `module_id`, `defaults`, `top_side`, `left_side`, `right_side`, `bottom_side`, `updated`, `site_id`) VALUES
(30, 28, NULL, NULL, '57,58,53,56,66', NULL, NULL, '51,49', '2020-11-26 08:15:14', 1),
(31, NULL, NULL, 1, NULL, '62', NULL, NULL, '2020-06-15 13:56:21', 1),
(32, 29, NULL, NULL, '59', NULL, NULL, '60', '2020-01-30 10:31:54', 1),
(33, NULL, 20, 2, '', '', '', '', '2019-03-03 07:20:29', 1),
(90, NULL, 22, 2, '', '', '', '', '2019-03-02 01:24:00', 1),
(91, NULL, 25, 2, '', '', '', '', '2018-12-09 23:27:29', 1),
(103, NULL, 21, 2, '', '', '', '', '2019-03-02 01:27:28', 1),
(107, NULL, 26, NULL, '', '', '', '', '2019-11-25 01:49:07', 1),
(149, NULL, NULL, 1, NULL, NULL, NULL, NULL, '2020-07-25 10:54:02', 2),
(215, 117, NULL, 2, NULL, NULL, NULL, NULL, '2020-11-25 15:09:53', 2),
(216, 118, NULL, 2, NULL, NULL, NULL, NULL, '2020-11-25 23:52:06', 1),
(217, 119, NULL, 2, NULL, NULL, NULL, NULL, '2020-11-25 23:56:27', 1),
(218, 120, NULL, 2, NULL, NULL, NULL, NULL, '2020-11-25 23:56:47', 1),
(219, 121, NULL, 2, NULL, NULL, NULL, NULL, '2020-11-25 23:58:00', 1),
(220, 122, NULL, 2, NULL, NULL, NULL, NULL, '2020-11-25 23:58:13', 1),
(221, 123, NULL, 2, NULL, NULL, NULL, NULL, '2020-11-25 23:58:31', 1),
(222, 124, NULL, 2, NULL, NULL, NULL, NULL, '2020-11-25 23:59:11', 1),
(223, 125, NULL, 2, NULL, NULL, NULL, NULL, '2020-11-25 23:59:26', 1),
(224, 126, NULL, 2, NULL, NULL, NULL, NULL, '2020-11-25 23:59:43', 1),
(225, 127, NULL, 2, NULL, NULL, NULL, NULL, '2020-11-25 23:59:59', 1),
(226, 128, NULL, 2, NULL, NULL, NULL, NULL, '2020-11-26 00:00:16', 1),
(227, 129, NULL, 2, NULL, NULL, NULL, NULL, '2020-11-26 00:00:27', 1),
(228, NULL, 27, 2, NULL, NULL, NULL, NULL, '2020-11-26 00:12:20', 1),
(229, 130, NULL, 2, NULL, NULL, NULL, NULL, '2020-11-26 00:13:37', 1),
(230, 131, NULL, 2, NULL, NULL, NULL, NULL, '2020-11-26 00:20:07', 1),
(231, 132, NULL, 2, NULL, NULL, NULL, NULL, '2020-11-26 00:21:19', 1),
(232, 133, NULL, 2, NULL, NULL, NULL, NULL, '2020-11-26 00:21:33', 1),
(233, 134, NULL, 2, NULL, NULL, NULL, NULL, '2020-11-26 00:30:34', 1),
(234, 135, NULL, 2, NULL, NULL, NULL, NULL, '2020-11-26 00:31:00', 1),
(235, 136, NULL, 2, NULL, NULL, NULL, NULL, '2020-11-26 00:33:58', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mails`
--

CREATE TABLE `mails` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `mail_groups_id` int(11) DEFAULT NULL,
  `publish` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mail_groups`
--

CREATE TABLE `mail_groups` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `lang_id` int(11) DEFAULT NULL,
  `newsletter` int(1) DEFAULT NULL,
  `publish` int(1) DEFAULT NULL,
  `site_id` int(11) DEFAULT 1,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mail_groups`
--

INSERT INTO `mail_groups` (`id`, `title`, `lang_id`, `newsletter`, `publish`, `site_id`, `created`, `updated`) VALUES
(1, 'القائمة البريدية', 2, 1, 1, 1, '2019-03-10 23:58:14', '0000-00-00 00:00:00');

--
-- Triggers `mail_groups`
--
DELIMITER $$
CREATE TRIGGER `mail_groups_AFTER_DELETE` AFTER DELETE ON `mail_groups` FOR EACH ROW BEGIN
DELETE FROM `translator` where parent_id = OLD.id and item_type='mailgroup';
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `mail_messages`
--

CREATE TABLE `mail_messages` (
  `id` int(11) NOT NULL,
  `from` varchar(50) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `direction` varchar(3) DEFAULT NULL,
  `mail_groups_id` int(11) DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mains`
--

CREATE TABLE `mains` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `url_alias` varchar(255) DEFAULT NULL,
  `module_id` int(11) DEFAULT NULL,
  `content` mediumtext DEFAULT NULL,
  `layout` int(2) DEFAULT NULL,
  `lang_id` int(11) DEFAULT NULL,
  `paging` int(4) DEFAULT NULL,
  `keywords` mediumtext DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `publish` int(1) DEFAULT NULL,
  `sort_id` int(11) DEFAULT NULL,
  `site_id` int(11) DEFAULT 1,
  `subject_sort` varchar(4) NOT NULL DEFAULT 'ASC',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mains`
--

INSERT INTO `mains` (`id`, `title`, `parent_id`, `url_alias`, `module_id`, `content`, `layout`, `lang_id`, `paging`, `keywords`, `description`, `publish`, `sort_id`, `site_id`, `subject_sort`, `created`, `updated`) VALUES
(1, 'المرحلة الإبتدائية مسار وطني', 12, 'main_516660', NULL, NULL, 1, 2, 20, NULL, NULL, 1, 1, 1, 'DESC', '2020-11-26 00:05:25', '2020-11-26 00:27:50'),
(2, 'المرحلة الإبتدائية مسار دولي', 12, 'main_79583', NULL, NULL, 1, 2, 20, NULL, NULL, 1, 2, 1, 'DESC', '2020-11-26 00:06:32', '2020-11-26 00:28:01'),
(3, 'المرحلة المتوسطة  مسار وطني', 12, 'main_528612', NULL, NULL, 1, 2, 20, NULL, NULL, 1, 3, 1, 'DESC', '2020-11-26 00:07:00', '2020-11-26 00:28:08'),
(4, 'المرحلة المتوسطة مسار دولي', 12, 'main_483005', NULL, NULL, 1, 2, 20, NULL, NULL, 1, 4, 1, 'DESC', '2020-11-26 00:07:30', '2020-11-26 00:28:17'),
(5, 'المرحلة الثانوية مسار وطني', 12, 'main_335070', NULL, NULL, 1, 2, 20, NULL, NULL, 1, 5, 1, 'DESC', '2020-11-26 00:07:48', '2020-11-26 00:28:24'),
(6, 'الإدارة العامة', NULL, 'main_641180', NULL, NULL, 2, 2, 20, NULL, NULL, 1, 6, 1, 'ASC', '2020-11-26 00:22:43', '2020-11-26 00:28:51'),
(7, 'إدارة التطوير والاشراف التربوي', NULL, 'main_49441', NULL, NULL, 2, 2, 20, NULL, NULL, 1, 7, 1, 'ASC', '2020-11-26 00:23:00', NULL),
(8, 'الإدارة المالية', NULL, 'main_220229', NULL, NULL, 2, 2, 20, NULL, NULL, 1, 8, 1, 'ASC', '2020-11-26 00:23:11', NULL),
(9, 'المرحلة الابتدائية', NULL, 'main_717406', NULL, NULL, 2, 2, 20, NULL, NULL, 1, 9, 1, 'ASC', '2020-11-26 00:23:29', NULL),
(10, 'المرحلة المتوسطة', NULL, 'main_605460', NULL, NULL, 2, 2, 20, NULL, NULL, 1, 10, 1, 'ASC', '2020-11-26 00:23:43', NULL),
(11, 'المرحلة الثانوية', NULL, 'main_128044', NULL, NULL, 2, 2, 20, NULL, NULL, 1, 11, 1, 'ASC', '2020-11-26 00:23:57', NULL),
(12, 'أخبار المدرسة', NULL, 'main_365451', NULL, NULL, 1, 2, 20, NULL, NULL, 1, 12, 1, 'DESC', '2020-11-26 00:27:07', NULL);

--
-- Triggers `mains`
--
DELIMITER $$
CREATE TRIGGER `mains_AFTER_DELETE` AFTER DELETE ON `mains` FOR EACH ROW BEGIN
DELETE FROM `translator` where parent_id = OLD.id and item_type='main';
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `medias`
--

CREATE TABLE `medias` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `gallery_id` int(11) DEFAULT NULL,
  `media_type` varchar(20) DEFAULT NULL,
  `width` int(10) DEFAULT NULL,
  `height` int(10) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `sort_id` int(11) DEFAULT NULL,
  `lang_id` int(11) DEFAULT NULL,
  `file_id` int(11) DEFAULT NULL,
  `publish` int(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Triggers `medias`
--
DELIMITER $$
CREATE TRIGGER `medias_AFTER_DELETE` AFTER DELETE ON `medias` FOR EACH ROW BEGIN
DELETE FROM `translator` where parent_id = OLD.id and item_type='media';
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `side_menu_parent_id` int(11) DEFAULT NULL,
  `type` varchar(10) DEFAULT NULL,
  `lang_id` int(11) DEFAULT NULL,
  `sort_id` int(11) DEFAULT NULL,
  `publish` int(1) DEFAULT NULL,
  `page_id` int(11) DEFAULT NULL,
  `module_id` int(11) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `target` varchar(10) DEFAULT NULL,
  `hide_submenu` int(1) DEFAULT 0,
  `menu_type` int(2) NOT NULL DEFAULT 0,
  `permission_id` int(11) DEFAULT NULL,
  `gallery_id` int(11) DEFAULT NULL,
  `main_id` int(11) DEFAULT NULL,
  `site_id` int(11) DEFAULT 1,
  `font_icon` varchar(50) DEFAULT NULL,
  `layout` int(1) NOT NULL DEFAULT 1,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `title`, `parent_id`, `side_menu_parent_id`, `type`, `lang_id`, `sort_id`, `publish`, `page_id`, `module_id`, `url`, `target`, `hide_submenu`, `menu_type`, `permission_id`, `gallery_id`, `main_id`, `site_id`, `font_icon`, `layout`, `created`, `updated`) VALUES
(40, 'القوائم', NULL, NULL, 'permission', 2, 7, 1, NULL, NULL, '', '', 0, 1, 165, NULL, NULL, 1, 'fa-list', 1, '2016-02-18 13:17:06', '2019-02-22 02:42:44'),
(41, 'قوائم الموقع', 40, NULL, 'permission', 2, 1, 1, NULL, NULL, '', '', 0, 1, 165, NULL, NULL, 1, 'fa-align-justify', 1, '2016-02-18 13:19:51', '2019-02-21 02:17:06'),
(42, 'قوائم الأدمن', 40, NULL, 'permission', 2, 2, 1, NULL, NULL, '', '', 0, 1, 279, NULL, NULL, 1, 'fa-align-right', 1, '2016-02-18 13:21:30', '2019-02-21 02:17:32'),
(43, 'تصميم الصفحة', 44, NULL, 'permission', 2, 6, 1, NULL, NULL, '', '', 0, 1, 192, NULL, NULL, 1, 'fa-trello', 1, '2016-02-21 10:27:40', '2019-02-22 00:57:35'),
(44, 'الصفحات', NULL, NULL, 'permission', 2, 2, 1, NULL, NULL, '', '', 0, 1, 104, NULL, NULL, 1, 'fa-desktop', 1, '0000-00-00 00:00:00', '2019-02-22 02:15:17'),
(47, 'الموديولات', 64, NULL, 'permission', 2, 4, 1, NULL, NULL, '', '', 0, 1, 149, NULL, NULL, 1, 'fa-archive', 1, '2016-02-21 11:27:31', '2019-02-22 00:44:08'),
(48, 'ملحقات الصفحة', 44, NULL, 'permission', 2, 5, 1, NULL, NULL, '', '', 0, 1, 189, NULL, NULL, 1, 'fa-th-large', 1, '2016-02-21 11:28:04', '2019-02-22 00:57:18'),
(49, 'الصور والملفات', NULL, NULL, 'extlink', 2, 9, 1, NULL, NULL, '#', '_self', 0, 1, NULL, NULL, NULL, 1, 'fa-files-o', 1, '2016-02-21 11:29:32', '2019-02-22 02:36:36'),
(50, 'الصور', 49, NULL, 'permission', 2, 1, 1, NULL, NULL, '', '', 0, 1, 20, NULL, NULL, 1, 'fa-photo', 1, '2016-02-21 11:30:12', '2019-02-21 02:46:44'),
(51, 'الملفات', 49, NULL, 'permission', 2, 2, 1, NULL, NULL, '', '', 0, 1, 273, NULL, NULL, 1, 'fa-file-text-o', 1, '2016-02-21 11:30:43', '2019-02-21 02:47:03'),
(52, 'إدارة ملفات \n\nالنظام', 49, NULL, 'permission', 2, 3, 1, NULL, NULL, '', '', 0, 1, 180, NULL, NULL, 1, 'fa-folder-open-o', 1, '2016-02-21 11:34:39', '2016-03-16 10:19:18'),
(53, 'إدارة الطلبات', NULL, NULL, 'permission', 2, 8, 1, NULL, NULL, NULL, NULL, 0, 1, 278, NULL, NULL, 1, 'fa-paperclip', 1, '2016-02-21 11:40:59', '2020-02-23 13:46:30'),
(54, 'الإعلانات', NULL, NULL, 'permission', 2, 4, 1, NULL, NULL, '', '', 0, 1, 120, NULL, NULL, 1, 'fa-pagelines', 1, '2016-02-21 11:41:37', '2019-02-22 02:37:40'),
(56, 'الأخبار والموضوعات', NULL, NULL, 'permission', 2, 3, 1, NULL, NULL, '', '', 0, 1, 197, NULL, NULL, 1, 'fa-list-alt', 1, '2016-02-21 11:42:58', '2019-11-25 01:31:16'),
(57, 'اضافة خبر او موضوع', 56, NULL, 'permission', 2, 3, 1, NULL, NULL, '', '', 0, 1, 200, NULL, NULL, 1, 'fa-plus-circle', 1, '2016-02-21 11:43:19', '2019-11-25 01:31:23'),
(58, 'ألبومات الصور والفيديو', NULL, NULL, 'permission', 2, 5, 1, NULL, NULL, '', '', 0, 1, 210, NULL, NULL, 1, 'fa-film', 1, '2016-02-21 11:46:11', '2019-12-25 13:23:29'),
(60, 'المجموعات البريدية', NULL, NULL, 'permission', 2, 9, 1, NULL, NULL, '#', '_self', 0, 1, 231, NULL, NULL, 1, 'fa-envelope', 1, '2016-02-21 11:47:41', '2019-02-22 02:35:37'),
(61, 'إضافة الإيميلات', 60, NULL, 'permission', 2, 2, 1, NULL, NULL, '', '', 0, 1, 237, NULL, NULL, 1, 'fa-plus-square', 1, '2016-02-21 11:48:31', '2019-02-22 00:37:38'),
(62, 'إرسال الرسائل', 60, NULL, 'permission', 2, 3, 1, NULL, NULL, '', '', 0, 1, 238, NULL, NULL, 1, 'fa-send', 1, '2016-02-21 11:48:50', '2019-02-22 00:37:20'),
(63, 'إدارة الإشتراكات', 53, NULL, 'permission', 2, 5, 1, NULL, NULL, '', '', 0, 1, 278, NULL, NULL, 1, 'fa-th-list', 1, '2016-02-21 11:54:49', '0000-00-00 00:00:00'),
(64, 'إعدادات النظام', NULL, NULL, 'permission', 2, 12, 1, NULL, NULL, '', '', 0, 1, 144, NULL, NULL, 1, 'fa-gears', 1, '2016-02-21 11:55:35', '2019-02-22 02:34:26'),
(65, 'إعدادات الموقع', 64, NULL, 'permission', 2, 1, 1, NULL, NULL, '', '', 0, 1, 144, NULL, NULL, 1, 'fa-gear', 1, '2016-02-21 11:56:17', '2019-02-21 03:07:36'),
(66, 'إدارة المستخدمين', 273, NULL, 'permission', 2, 2, 1, NULL, NULL, '', '', 0, 1, 8, NULL, NULL, 1, 'fa-users', 1, '2016-02-21 11:57:11', '2019-02-22 00:22:34'),
(67, 'إدارة المهام', 273, NULL, 'permission', 2, 3, 1, NULL, NULL, '', '', 0, 1, 12, NULL, NULL, 1, 'fa-user-md', 1, '2016-02-21 11:57:44', '2019-02-22 00:22:57'),
(68, 'الصلاحيات', 273, NULL, 'permission', 2, 4, 1, NULL, NULL, '#', '_self', 0, 1, 16, NULL, NULL, 1, 'fa-credit-card', 1, '2016-02-21 11:58:28', '2019-02-22 03:17:34'),
(69, 'إضافة صلاحية', 68, NULL, 'permission', 2, 2, 1, NULL, NULL, '', '', 0, 1, 13, NULL, NULL, 1, 'fa-plus-circle', 1, '2016-02-21 11:58:48', '2019-02-22 03:19:22'),
(70, 'اللغات', 64, NULL, 'permission', 2, 5, 1, NULL, NULL, '', '', 0, 1, 4, NULL, NULL, 1, 'fa-flag', 1, '2016-02-21 11:59:56', '2019-02-22 00:36:11'),
(71, 'حركات المستخدمين', 273, NULL, 'permission', 2, 6, 1, NULL, NULL, '', '', 0, 1, 24, NULL, NULL, 1, 'fa-align-left', 1, '2016-02-21 12:00:58', '2019-02-22 00:35:38'),
(95, 'التصويت اللإلكتروني', NULL, NULL, 'permission', 2, 7, 1, NULL, NULL, '#', '_self', 0, 1, 284, NULL, NULL, 1, 'fa-bullhorn', 1, '2016-03-17 13:38:01', '2019-02-22 02:39:58'),
(96, 'أسئلة التصويت', 95, NULL, 'permission', 2, 2, 1, NULL, NULL, '', '', 0, 1, 284, NULL, NULL, 1, 'fa-question-circle', 1, '2016-03-17 13:39:01', '2019-02-22 00:40:31'),
(97, 'إجابات التصويت', 95, NULL, 'permission', 2, 3, 1, NULL, NULL, '', '', 0, 1, 290, NULL, NULL, 1, 'fa-check', 1, '2016-03-17 13:40:04', '2019-02-22 00:40:41'),
(98, 'تقويم الأحداث', NULL, NULL, 'permission', 2, 8, 1, NULL, NULL, '', '', 0, 1, 300, NULL, NULL, 1, 'fa-bell', 1, '2016-03-17 14:14:20', '2019-02-22 02:40:39'),
(99, 'قائمة الأحداث', 98, NULL, 'permission', 2, 1, 1, NULL, NULL, '', '', 0, 1, 300, NULL, NULL, 1, 'fa-th', 1, '2016-03-17 14:17:57', '2019-02-22 01:28:15'),
(100, 'إعدادات الأحداث', 98, NULL, 'permission', 2, 2, 1, NULL, NULL, '', '', 0, 1, 301, NULL, NULL, 1, 'fa-gears', 1, '2016-03-17 14:18:42', '0000-00-00 00:00:00'),
(268, 'إدارة طلبات التسجيل', 53, NULL, 'permission', 2, 8, 1, NULL, NULL, '', '', 0, 1, 307, NULL, NULL, 1, 'fa-th-list', 1, '2019-01-02 00:55:59', '0000-00-00 00:00:00'),
(269, 'إدارة طلبات التوظيف', 53, NULL, 'permission', 2, 9, 1, NULL, NULL, '', '', 0, 1, 308, NULL, NULL, 1, 'fa-th-list', 1, '2019-01-02 00:56:26', '0000-00-00 00:00:00'),
(270, 'الرئيسية', 331, NULL, 'page', 2, 1, 1, 28, NULL, '', '', 0, 0, NULL, NULL, NULL, 1, 'fa fa-home', 1, '2019-02-21 01:29:13', '2019-12-26 08:39:36'),
(273, 'المستخدمين والصلاحيات', NULL, NULL, 'permission', 2, 14, 1, NULL, NULL, NULL, NULL, 0, 1, 8, NULL, NULL, 1, 'fa-users', 1, '2019-02-21 03:09:31', '2020-02-23 13:42:18'),
(274, 'المجموعات البريدية', 60, NULL, 'permission', 2, 1, 1, NULL, NULL, '', '', 0, 1, 231, NULL, NULL, 1, 'fa-group', 1, '2019-02-22 00:26:20', '0000-00-00 00:00:00'),
(275, 'قائمة التصويت', 95, NULL, 'permission', 2, 1, 1, NULL, NULL, '', '', 0, 1, 284, NULL, NULL, 1, 'fa-th-list', 1, '2019-02-22 00:39:56', '0000-00-00 00:00:00'),
(277, 'قائمة الصفحات', 44, NULL, 'permission', 2, 1, 1, NULL, NULL, '', '', 0, 1, 104, NULL, NULL, 1, 'fa-files-o', 1, '2019-02-22 00:56:36', '2019-02-22 16:00:42'),
(278, 'قائمة الأقسام', 56, NULL, 'permission', 2, 2, 1, NULL, NULL, '', '', 0, 1, 197, NULL, NULL, 1, 'fa-th-list', 1, '2019-02-22 00:59:32', '0000-00-00 00:00:00'),
(279, 'أقسام الصلاحيات', 68, NULL, 'permission', 2, 1, 1, NULL, NULL, '', '', 0, 1, 48, NULL, NULL, 1, 'fa-th-list', 1, '2019-02-22 03:18:39', '0000-00-00 00:00:00'),
(293, 'اتصل بنا', 331, NULL, 'page', 2, 3, 1, 29, NULL, '', '', 0, 0, NULL, NULL, NULL, 1, 'fa fa-phone-square', 1, '2019-02-22 17:01:22', '2019-12-26 08:39:58'),
(331, 'قائمة أعلى الموقع', NULL, NULL, 'extlink', 2, 21, 1, NULL, NULL, '#', '_self', 1, 0, NULL, NULL, NULL, 1, '', 1, '2019-12-26 08:26:32', '0000-00-00 00:00:00'),
(333, 'المركز الإعلامي', NULL, NULL, 'extlink', 2, 29, 1, NULL, NULL, '#', '_self', 0, 0, NULL, NULL, NULL, 1, NULL, 1, '2019-12-26 09:02:27', '2020-02-24 13:20:35'),
(335, 'روابط مهمة', NULL, NULL, 'extlink', 2, 22, 1, NULL, NULL, '#', '_self', 1, 0, NULL, NULL, NULL, 1, '', 1, '2020-01-11 12:18:09', '2020-01-11 14:00:53'),
(336, 'مواقع صديقة', NULL, NULL, 'extlink', 2, 23, 1, NULL, NULL, '#', '_self', 1, 0, NULL, NULL, NULL, 1, '', 1, '2020-01-11 12:18:25', '0000-00-00 00:00:00'),
(337, 'رئاسة المسجد الحرام', 335, NULL, 'extlink', 2, 1, 1, NULL, NULL, 'https://www.gph.gov.sa/', '_blank', 0, 0, NULL, NULL, NULL, 1, '', 1, '2020-01-11 12:20:40', '2020-01-11 13:54:06'),
(338, 'رؤية المملكة  2030', 335, NULL, 'extlink', 2, 2, 1, NULL, NULL, 'https://vision2030.gov.sa/', '_blank', 0, 0, NULL, NULL, NULL, 1, '', 1, '2020-01-11 12:21:29', '0000-00-00 00:00:00'),
(339, 'مصنع كسوة الكعبة', 335, NULL, 'extlink', 2, 3, 1, NULL, NULL, 'http://factory.alharamain.gov.sa/', '_blank', 0, 0, NULL, NULL, NULL, 1, '', 1, '2020-01-11 12:22:23', '0000-00-00 00:00:00'),
(340, 'كلية المسجد النبوي', 336, NULL, 'extlink', 2, 1, 1, NULL, NULL, 'https://pmc.edu.sa/', '_blank', 0, 0, NULL, NULL, NULL, 1, '', 1, '2020-01-11 12:23:45', '0000-00-00 00:00:00'),
(341, 'معهد المسجد النبوي', 336, NULL, 'extlink', 2, 2, 1, NULL, NULL, 'https://ins.gph.edu.sa/', '_blank', 0, 0, NULL, NULL, NULL, 1, '', 1, '2020-01-11 12:25:13', '0000-00-00 00:00:00'),
(342, 'استطلاع رأي الزوار', 336, NULL, 'extlink', 2, 3, 0, NULL, NULL, 'https://eservices.wmn.gov.sa/haram_visitor_service/', '_self', 0, 0, NULL, NULL, NULL, 1, '', 1, '2020-01-11 12:26:59', '0000-00-00 00:00:00'),
(343, 'الموسوعة الشاملة للمسجد النبوي', 335, NULL, 'extlink', 2, 4, 1, NULL, NULL, 'https://pme.gph.edu.sa/', '_blank', 0, 0, NULL, NULL, NULL, 1, '', 1, '2020-01-11 12:28:20', '2020-01-11 14:06:41'),
(344, 'مكتبة المسجد النبوي', 336, NULL, 'extlink', 2, 4, 1, NULL, NULL, '#', '_self', 0, 0, NULL, NULL, NULL, 1, '', 1, '2020-01-11 12:30:49', '0000-00-00 00:00:00'),
(345, 'أكاديمية القرآن والسنة النبوية', 336, NULL, 'extlink', 2, 5, 1, NULL, NULL, 'https://www.qm.edu.sa/', '_self', 0, 0, NULL, NULL, NULL, 1, '', 1, '2020-01-11 12:33:09', '0000-00-00 00:00:00'),
(346, 'أكاديمية المسجد النبوي', 336, NULL, 'extlink', 2, 24, 1, NULL, NULL, 'https://academy.gph.edu.sa/', '_blank', 0, 0, NULL, NULL, NULL, 1, '', 1, '2020-01-11 12:33:58', '2020-01-11 12:34:33'),
(347, 'البث المباشر', 335, NULL, 'extlink', 2, 5, 1, NULL, NULL, '#', '_self', 0, 0, NULL, NULL, NULL, 1, '', 1, '2020-01-11 12:35:33', '0000-00-00 00:00:00'),
(348, 'الخطبة باللغات الغير عربية', 335, NULL, 'extlink', 2, 6, 1, NULL, NULL, '#', '_self', 0, 0, NULL, NULL, NULL, 1, '', 1, '2020-01-11 12:35:53', '0000-00-00 00:00:00'),
(402, 'بوابة الحرمين الشريفين', 336, NULL, 'extlink', 2, 25, 1, NULL, NULL, 'http://www.alharamain.gov.sa/', '_blank', 0, 0, NULL, NULL, NULL, 1, NULL, 1, '2020-04-14 06:18:49', NULL),
(403, 'إدراة طلبات إتصل بنا', 53, NULL, 'permission', 2, 10, 1, NULL, NULL, NULL, NULL, 0, 1, 311, NULL, NULL, 1, 'fa fa-th-list', 1, '2020-07-01 12:11:43', NULL),
(404, 'عن المدارس', NULL, NULL, 'extlink', 2, 24, 1, NULL, NULL, '#', '_self', 0, 0, NULL, NULL, NULL, 1, NULL, 1, '2020-11-25 23:40:04', NULL),
(405, 'المراحل التعليمية', NULL, NULL, 'extlink', 2, 25, 1, NULL, NULL, '#', '_self', 0, 0, NULL, NULL, NULL, 1, NULL, 1, '2020-11-25 23:40:15', NULL),
(406, 'القبول والتسجيل', NULL, NULL, 'extlink', 2, 26, 1, NULL, NULL, '#', '_self', 0, 0, NULL, NULL, NULL, 1, NULL, 1, '2020-11-25 23:40:32', NULL),
(407, 'التعليم الالكتروني', NULL, NULL, 'extlink', 2, 27, 1, NULL, NULL, '#', '_self', 0, 0, NULL, NULL, NULL, 1, NULL, 1, '2020-11-25 23:40:47', NULL),
(408, 'كوادرنا', NULL, NULL, 'extlink', 2, 28, 1, NULL, NULL, '#', '_self', 0, 0, NULL, NULL, NULL, 1, NULL, 1, '2020-11-25 23:41:17', NULL),
(410, 'الرؤية والرسالة والقيم', 404, NULL, 'page', 2, 1, 1, 118, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 1, NULL, 1, '2020-11-25 23:52:06', NULL),
(411, 'كلمة الشيخ عبدالرحمن فقيه', 404, NULL, 'page', 2, 2, 1, 119, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 1, NULL, 1, '2020-11-25 23:56:27', NULL),
(412, 'كلمة مدير عام المدارس', 404, NULL, 'page', 2, 3, 1, 120, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 1, NULL, 1, '2020-11-25 23:56:47', NULL),
(413, 'مجلس الإدارة', 404, NULL, 'page', 2, 4, 1, 121, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 1, NULL, 1, '2020-11-25 23:58:00', NULL),
(414, 'إدارات وشؤون المدرسة', 404, NULL, 'page', 2, 5, 1, 122, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 1, NULL, 1, '2020-11-25 23:58:13', NULL),
(415, 'مدارسنا بأقلامهم', 404, NULL, 'page', 2, 6, 1, 123, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 1, NULL, 1, '2020-11-25 23:58:31', NULL),
(416, 'إدارة التطوير والاشراف التربوي', 414, NULL, 'page', 2, 1, 1, 124, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 1, NULL, 1, '2020-11-25 23:59:11', NULL),
(417, 'الاعتماد الدولي', 414, NULL, 'page', 2, 2, 1, 125, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 1, NULL, 1, '2020-11-25 23:59:26', NULL),
(418, 'المكتبة العامة', 414, NULL, 'page', 2, 3, 1, 126, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 1, NULL, 1, '2020-11-25 23:59:43', NULL),
(419, 'مصادر التعلم', 414, NULL, 'page', 2, 4, 1, 127, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 1, NULL, 1, '2020-11-25 23:59:59', NULL),
(420, 'النادي الرياضي', 414, NULL, 'page', 2, 5, 1, 128, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 1, NULL, 1, '2020-11-26 00:00:16', NULL),
(421, 'الورش المهنية', 414, NULL, 'page', 2, 6, 1, 129, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 1, NULL, 1, '2020-11-26 00:00:27', NULL),
(422, 'المرحلة الابتدائية', 405, NULL, 'extlink', 2, 1, 1, NULL, NULL, '#', '_self', 0, 0, NULL, NULL, NULL, 1, NULL, 1, '2020-11-26 00:03:09', NULL),
(423, 'المرحلة المتوسطة', 405, NULL, 'extlink', 2, 2, 1, NULL, NULL, '#', '_self', 0, 0, NULL, NULL, NULL, 1, NULL, 1, '2020-11-26 00:03:30', NULL),
(424, 'المرحلة الثانوية', 405, NULL, 'extlink', 2, 3, 1, NULL, NULL, '#', '_self', 0, 0, NULL, NULL, NULL, 1, NULL, 1, '2020-11-26 00:03:46', NULL),
(425, 'مسار وطني', 422, NULL, 'main', 2, 1, 1, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 1, 1, NULL, 1, '2020-11-26 00:05:25', '2020-11-26 00:08:38'),
(426, 'مسار دولي', 422, NULL, 'main', 2, 2, 1, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 2, 1, NULL, 1, '2020-11-26 00:06:32', '2020-11-26 00:09:30'),
(427, 'مسار وطني', 423, NULL, 'main', 2, 1, 1, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 3, 1, NULL, 1, '2020-11-26 00:07:00', '2020-11-26 00:09:41'),
(428, 'مسار دولي', 423, NULL, 'main', 2, 2, 1, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 4, 1, NULL, 1, '2020-11-26 00:07:30', '2020-11-26 00:09:57'),
(429, 'مسار وطني', 424, NULL, 'main', 2, 1, 1, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 5, 1, NULL, 1, '2020-11-26 00:07:48', '2020-11-26 00:10:09'),
(430, 'نظام القبول والتسجيل', 406, NULL, 'page', 2, 1, 1, 130, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 1, NULL, 1, '2020-11-26 00:13:37', NULL),
(431, 'الوظائف', NULL, NULL, 'page', 2, 30, 1, 131, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 1, NULL, 1, '2020-11-26 00:20:07', NULL),
(432, 'الرسوم الدراسية', 406, NULL, 'page', 2, 2, 1, 132, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 1, NULL, 1, '2020-11-26 00:21:19', NULL),
(433, 'نظام النقل والمواصلات', 406, NULL, 'page', 2, 3, 1, 133, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 1, NULL, 1, '2020-11-26 00:21:33', NULL),
(434, 'الإدارة العامة', 408, NULL, 'main', 2, 1, 1, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 6, 1, NULL, 1, '2020-11-26 00:22:43', NULL),
(435, 'إدارة التطوير والاشراف التربوي', 408, NULL, 'main', 2, 2, 1, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 7, 1, NULL, 1, '2020-11-26 00:23:00', NULL),
(436, 'الإدارة المالية', 408, NULL, 'main', 2, 3, 1, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 8, 1, NULL, 1, '2020-11-26 00:23:11', NULL),
(437, 'المرحلة الابتدائية', 408, NULL, 'main', 2, 4, 1, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 9, 1, NULL, 1, '2020-11-26 00:23:29', NULL),
(438, 'المرحلة المتوسطة', 408, NULL, 'main', 2, 5, 1, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 10, 1, NULL, 1, '2020-11-26 00:23:43', NULL),
(439, 'المرحلة الثانوية', 408, NULL, 'main', 2, 6, 1, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 11, 1, NULL, 1, '2020-11-26 00:23:57', NULL),
(440, 'أخبار المدرسة', 333, NULL, 'main', 2, 2, 1, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 12, 1, NULL, 1, '2020-11-26 00:27:07', NULL),
(441, 'أحداث المدارس', 333, NULL, 'page', 2, 3, 1, 134, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 1, NULL, 1, '2020-11-26 00:30:34', NULL),
(442, 'البث المباشر', 333, NULL, 'page', 2, 4, 1, 135, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 1, NULL, 1, '2020-11-26 00:31:00', NULL),
(443, 'ألبومات المدارس', 333, NULL, 'extlink', 2, 5, 1, NULL, NULL, '#', '_self', 0, 0, NULL, NULL, NULL, 1, NULL, 1, '2020-11-26 00:31:25', NULL),
(444, 'ألبومات المرحلة الابتدائية', 443, NULL, 'gallery', 2, 1, 1, NULL, NULL, NULL, NULL, 0, 0, NULL, 1, NULL, 1, NULL, 1, '2020-11-26 00:32:07', NULL),
(445, 'ألبومات المرحلة المتوسطة', 443, NULL, 'gallery', 2, 2, 1, NULL, NULL, NULL, NULL, 0, 0, NULL, 2, NULL, 1, NULL, 1, '2020-11-26 00:32:18', NULL),
(446, 'ألبومات المرحلة الثانوية', 443, NULL, 'gallery', 2, 3, 1, NULL, NULL, NULL, NULL, 0, 0, NULL, 3, NULL, 1, NULL, 1, '2020-11-26 00:32:31', NULL),
(447, 'رواد الغد', 333, NULL, 'page', 2, 6, 1, 136, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 1, NULL, 1, '2020-11-26 00:33:58', NULL);

--
-- Triggers `menus`
--
DELIMITER $$
CREATE TRIGGER `menus_AFTER_DELETE` AFTER DELETE ON `menus` FOR EACH ROW BEGIN
DELETE FROM `translator` where parent_id = OLD.id and item_type='menu';
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `url_alias` varchar(255) DEFAULT NULL,
  `related_class` varchar(255) DEFAULT NULL,
  `lang_id` int(11) DEFAULT NULL,
  `publish` int(1) DEFAULT NULL,
  `keywords` mediumtext DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `site_id` int(11) DEFAULT 1,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `title`, `url_alias`, `related_class`, `lang_id`, `publish`, `keywords`, `description`, `site_id`, `created`, `updated`) VALUES
(20, 'الأقسام الرئيسية', 'module_894348', 'module_main_subject.php', 2, 1, '', '', 1, '2016-10-13 10:57:19', '2018-08-13 11:30:53'),
(21, 'البحث', 'Search', 'module_search.php', 2, 1, '', '', 1, '2016-10-13 10:57:36', '2017-01-11 11:42:30'),
(22, 'البومات الموقع', 'module_658268', 'module_gallery.php', 2, 1, '', '', 1, '2016-10-13 10:57:54', '2018-09-06 22:23:43'),
(25, 'استمارة التقديم على وظيفة', 'module_397646', 'module_job_requests.php', 2, 1, '', '', 1, '2018-12-09 23:27:29', '0000-00-00 00:00:00'),
(26, 'أخبار المدرسة', 'news', 'module_all_news.php', 2, 1, NULL, NULL, 1, '2019-03-15 18:05:54', '2020-11-26 00:11:35'),
(27, 'إستمارة التسجيل', 'module_369379', 'module_join_requests.php', 2, 1, NULL, NULL, 1, '2020-11-26 00:12:20', NULL);

--
-- Triggers `modules`
--
DELIMITER $$
CREATE TRIGGER `modules_AFTER_DELETE` AFTER DELETE ON `modules` FOR EACH ROW BEGIN
DELETE FROM `translator` where parent_id = OLD.id and item_type='module';
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `url_alias` varchar(255) DEFAULT NULL,
  `sort_id` int(11) DEFAULT NULL,
  `publish` int(1) DEFAULT 0,
  `lang_id` int(11) DEFAULT NULL,
  `keywords` mediumtext DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `module_id` int(11) DEFAULT NULL,
  `home` int(1) DEFAULT NULL,
  `contact` int(1) DEFAULT NULL,
  `counter` int(11) DEFAULT 0,
  `site_id` int(11) DEFAULT 1,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `content`, `url_alias`, `sort_id`, `publish`, `lang_id`, `keywords`, `description`, `module_id`, `home`, `contact`, `counter`, `site_id`, `created`, `updated`) VALUES
(28, 'الرئيسية', NULL, 'Home', 1, 1, 2, NULL, NULL, NULL, 1, 0, NULL, 1, '2016-10-13 09:59:09', '2020-03-02 11:59:26'),
(29, 'اتصل بنا', NULL, 'contact-us', 2, 1, 2, NULL, NULL, NULL, 0, 1, 10170, 1, '2016-10-13 10:00:14', '2020-01-30 10:30:23'),
(117, 'الرئيسية', NULL, 'page_144724', 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2020-11-25 15:09:53', NULL),
(118, 'الرؤية والرسالة والقيم', '<h2 dir=\"RTL\"><strong>رؤيتنا : </strong></h2>\r\n\r\n<p dir=\"RTL\">بناء جيل وتطويره وفق معايير الجودة بما يحقق رؤية المملكة 2030</p>\r\n\r\n<h2 dir=\"RTL\"><strong>رسالتنا : </strong></h2>\r\n\r\n<p dir=\"RTL\">- التأكيد على الولاء لله ثم المليك ثم الوطن</p>\r\n\r\n<p dir=\"RTL\">- ترسيخ القيم والمبادئ الإسلامية</p>\r\n\r\n<p dir=\"RTL\">- إيجاد بيئة تعليمية حديثة متطورة</p>\r\n\r\n<p dir=\"RTL\">- استثمار الكوادر البشرية عالية التأهيل</p>\r\n\r\n<p dir=\"RTL\">- تفعيل دور الأنشطة التربوية مع اكتشاف الموهوبين ورعايتهم</p>\r\n\r\n<p dir=\"RTL\">- المشاركة المجتمعية الفاعلة</p>\r\n\r\n<p dir=\"RTL\">- وجود آليه لضمان الجودة والتميز</p>\r\n\r\n<h2 dir=\"RTL\"><strong>قيمنا :</strong></h2>', 'page_745170', 3, 1, 2, NULL, NULL, NULL, NULL, NULL, 11, 1, '2020-11-25 23:52:06', NULL),
(119, 'كلمة الشيخ عبدالرحمن فقيه', NULL, 'page_354869', 4, 1, 2, NULL, NULL, NULL, NULL, NULL, 1, 1, '2020-11-25 23:56:27', NULL),
(120, 'كلمة مدير عام المدارس', NULL, 'page_90306', 5, 1, 2, NULL, NULL, NULL, NULL, NULL, 1, 1, '2020-11-25 23:56:47', NULL),
(121, 'مجلس الإدارة', NULL, 'page_35087', 6, 1, 2, NULL, NULL, NULL, NULL, NULL, 1, 1, '2020-11-25 23:58:00', NULL),
(122, 'إدارات وشؤون المدرسة', NULL, 'page_550305', 7, 1, 2, NULL, NULL, NULL, NULL, NULL, 1, 1, '2020-11-25 23:58:13', NULL),
(123, 'مدارسنا بأقلامهم', NULL, 'page_905305', 8, 1, 2, NULL, NULL, NULL, NULL, NULL, 2, 1, '2020-11-25 23:58:30', NULL),
(124, 'إدارة التطوير والاشراف التربوي', NULL, 'page_305077', 9, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2020-11-25 23:59:11', NULL),
(125, 'الاعتماد الدولي', NULL, 'page_544169', 10, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2020-11-25 23:59:26', NULL),
(126, 'المكتبة العامة', NULL, 'page_204013', 11, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2020-11-25 23:59:43', NULL),
(127, 'مصادر التعلم', NULL, 'page_718695', 12, 1, 2, NULL, NULL, NULL, NULL, NULL, 4, 1, '2020-11-25 23:59:59', NULL),
(128, 'النادي الرياضي', NULL, 'page_516222', 13, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2020-11-26 00:00:16', NULL),
(129, 'الورش المهنية', NULL, 'page_463332', 14, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2020-11-26 00:00:27', NULL),
(130, 'نظام القبول والتسجيل', NULL, 'page_629320', 15, 1, 2, NULL, NULL, 27, NULL, NULL, 12, 1, '2020-11-26 00:13:37', NULL),
(131, 'الوظائف', NULL, 'page_732950', 16, 1, 2, NULL, NULL, 25, NULL, NULL, 4, 1, '2020-11-26 00:20:07', NULL),
(132, 'الرسوم الدراسية', NULL, 'page_503632', 17, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2020-11-26 00:21:19', NULL),
(133, 'نظام النقل والمواصلات', NULL, 'page_955146', 18, 1, 2, NULL, NULL, NULL, NULL, NULL, 1, 1, '2020-11-26 00:21:33', NULL),
(134, 'أحداث المدارس', NULL, 'page_697790', 19, 1, 2, NULL, NULL, NULL, NULL, NULL, 1, 1, '2020-11-26 00:30:34', NULL),
(135, 'البث المباشر', NULL, 'page_523706', 20, 1, 2, NULL, NULL, NULL, NULL, NULL, 2, 1, '2020-11-26 00:31:00', NULL),
(136, 'رواد الغد', NULL, 'page_926447', 21, 1, 2, NULL, NULL, NULL, NULL, NULL, 1, 1, '2020-11-26 00:33:58', NULL);

--
-- Triggers `pages`
--
DELIMITER $$
CREATE TRIGGER `pages_AFTER_DELETE` AFTER DELETE ON `pages` FOR EACH ROW BEGIN
DELETE FROM `translator` where parent_id = OLD.id and item_type='page';
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `parts`
--

CREATE TABLE `parts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `lang_id` int(11) DEFAULT NULL,
  `sort_id` int(11) DEFAULT NULL,
  `publish` int(1) DEFAULT NULL,
  `page_id` int(11) DEFAULT NULL,
  `show_title` int(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `parts`
--

INSERT INTO `parts` (`id`, `title`, `content`, `lang_id`, `sort_id`, `publish`, `page_id`, `show_title`, `created`, `updated`) VALUES
(30, 'الرئيسية', '', 2, 1, 1, 28, 0, '2016-10-13 09:59:09', '0000-00-00 00:00:00'),
(31, 'اتصل بنا', '<p>\r\n	&nbsp;</p>\r\n<p>\r\n	<iframe allowfullscreen=\"\" frameborder=\"0\" height=\"300\" scrolling=\"no\" src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3605.6042322957137!2d49.587338814852735!3d25.35105823166245!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e37914818595059%3A0x36eb8fd705ef31cc!2sDar+Al+Aloum+Private+Schools!5e0!3m2!1sen!2ssa!4v1541314138355\" style=\"border:0\" width=\"100%\"></iframe></p>\r\n<p>\r\n	&nbsp;</p>\r\n<h4 style=\"direction: rtl;\">\r\n	للإتصال بنا يمكنك الاتصال بنا في أى وقت ومن أى مكان من خلال معلومات الاتصال بنا:</h4>', 2, 1, 1, 29, 0, '2016-10-13 10:00:14', '2018-11-04 10:01:06');

--
-- Triggers `parts`
--
DELIMITER $$
CREATE TRIGGER `parts_AFTER_DELETE` AFTER DELETE ON `parts` FOR EACH ROW BEGIN
DELETE FROM `translator` where parent_id = OLD.id and item_type='part';
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `persec_id` int(11) DEFAULT NULL,
  `page_path` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `title`, `persec_id`, `page_path`) VALUES
(2, 'LanguageEdit', 1, 'languages/_edit.php'),
(3, 'LanguageDelete', 1, 'languages/_delete.php'),
(4, 'LanguageView', 1, 'languages/_manage.php'),
(5, 'UserAdd', 2, 'users/_add.php'),
(7, 'UserDelete', 2, 'users/_delte.php'),
(8, 'UserView', 2, 'users/_manage.php'),
(9, 'RoleAdd', 3, 'roles/_add.php'),
(10, 'RoleEdit', 3, 'roles/_edit.php'),
(12, 'RoleView', 3, 'roles/_manage.php'),
(13, 'PermissionAdd', 4, 'permissions/_add.php'),
(14, 'PermissionEdit', 4, 'permissions/_edit.php'),
(15, 'PermissionDelete', 4, 'permissions/_delete.php'),
(16, 'PermissionView', 4, 'permissions/_manage.php'),
(17, 'PhotoAdd', 5, 'photos/_add.php'),
(18, 'PhotoEdit', 5, 'photos/_edit.php'),
(19, 'PhotoDelete', 5, 'photos/_delete.php'),
(20, 'PhotoView', 5, 'photos/_manage.php?photo_sec=admin'),
(21, 'LogFileClear', 6, 'logs/'),
(23, 'RoleAssign', 3, 'roles/_manage.php'),
(24, 'LogFileView', 6, 'logs/'),
(25, 'PhotoMove', 5, 'photos/_manage.php'),
(26, 'PhotoPublish', 5, 'photos/_manage.php'),
(27, 'LanguageAdd', 1, 'languages/_add.php'),
(28, 'UserEdit', 2, 'users/_edit.php'),
(30, 'LanguagePublish', 1, 'languages/_manage.php'),
(35, 'LanguageDefault', 1, 'languages/_manage.php'),
(43, 'RoleDelete', 3, 'roles/_delete.php'),
(44, 'UserPublish', 2, 'users/_manage.php'),
(45, 'PerSecAdd', 4, 'persec/_add.php'),
(46, 'PerSecEdit', 4, 'persec/_edit.php'),
(47, 'PerSecDelete', 4, 'persec/_delete.php'),
(48, 'PerSecView', 4, 'persec/_manage.php'),
(88, 'Search', 18, NULL),
(101, 'PageAdd', 19, 'pages/_add.php'),
(102, 'PageEdit', 19, 'pages/_edit.php'),
(103, 'PageDelete', 19, 'pages/_delete.php'),
(104, 'PageView', 19, 'pages/_manage.php'),
(105, 'PagePublish', 19, 'pages/_manage.php'),
(106, 'PageMove', 19, 'pages/_manage.php'),
(107, 'PageTranslate', 19, 'pages/_manage.php'),
(108, 'PageShow', 19, 'pages/_manage.php'),
(117, 'AdSectionAdd', 21, 'ads_sections/_add.php'),
(118, 'AdSectionEdit', 21, 'ads_sections/_edit.php'),
(119, 'AdSectionDelete', 21, 'ads_sections/_delete.php'),
(120, 'AdSectionView', 21, 'ads_sections/_manage.php'),
(121, 'AdSectionPublish', 21, 'ads_sections/_manage.php'),
(122, 'AdSectionTranslate', 21, 'ads_sections/_manage.php'),
(123, 'AdAdd', 22, 'ads/_add.php'),
(124, 'AdEdit', 22, 'ads/_edit.php'),
(125, 'AdDelete', 22, 'ads/_delete.php'),
(126, 'AdView', 22, 'ads/_manage.php'),
(127, 'AdPublish', 22, 'ads/_manage.php'),
(128, 'AdMove', 22, 'ads/_manage.php'),
(129, 'AdTranslate', 22, 'ads/_manage.php'),
(144, 'SiteConfigEdit', 25, 'site_config/_manage.php'),
(145, 'SiteConfigTranslate', 25, 'site_config/_manage.php'),
(146, 'ModuleAdd', 26, 'modules/_add.php'),
(147, 'ModuleEdit', 26, 'modules/_edit.php'),
(148, 'ModuleDelete', 26, 'modules/_delete.php'),
(149, 'ModuleView', 26, 'modules/_manage.php'),
(150, 'ModuleTranslate', 26, 'modules/_manage.php'),
(151, 'ModulePublish', 26, 'modules/_manage.php'),
(152, 'PartAdd', 27, 'parts/_add.php'),
(153, 'PartEdit', 27, 'parts/_edit.php'),
(154, 'PartDelete', 27, 'parts/_delete.php'),
(155, 'PartView', 27, 'parts/_manage.php'),
(156, 'PartMove', 27, 'parts/_manage.php'),
(157, 'PartPublish', 27, 'parts/_manage.php'),
(158, 'PartTranslate', 27, 'parts/_manage.php'),
(159, 'PageMakeHome', 19, 'pages/_manage.php'),
(160, 'PageMakeContact', 19, 'pages/_manage.php'),
(162, 'MenuAdd', 28, 'menus/_add.php'),
(163, 'MenuEdit', 28, 'menus/_edit.php'),
(164, 'MenuDelete', 28, 'menus/_delete.php'),
(165, 'MenuView', 28, 'menus/_manage.php'),
(166, 'MenuMove', 28, 'menus/_manage.php'),
(167, 'MenuPublish', 28, 'menus/_manage.php'),
(168, 'MenuTranslate', 28, 'menus/_manage.php'),
(177, 'FileManagerUpload', 30, 'file_manager/?\n\ndir=Qzpcd2FtcFx3d3dcaGFyYW1fcG9ydGFsXFxwdWJsaWNcU2F3eUNNUw=='),
(178, 'FileManagerCreateFile', 30, 'file_manager/?dir=Qzpcd2FtcFx3d3dcaGFyYW1fcG9ydGFsXFxwdWJsaWNcU2F3eUNNUw=='),
(179, 'FileManagerCreateDir', 30, 'file_manager/?dir=Qzpcd2FtcFx3d3dcaGFyYW1fcG9ydGFsXFxwdWJsaWNcU2F3eUNNUw=='),
(180, 'FileManagerView', 30, 'file_manager/'),
(181, 'FileManagerDownload', 30, 'file_manager/?dir=Qzpcd2FtcFx3d3dcaGFyYW1fcG9ydGFsXFxwdWJsaWNcU2F3eUNNUw=='),
(182, 'FileManagerEdit', 30, 'file_manager/?dir=Qzpcd2FtcFx3d3dcaGFyYW1fcG9ydGFsXFxwdWJsaWNcU2F3eUNNUw=='),
(183, 'FileManagerDelete', 30, 'file_manager/?\n\ndir=Qzpcd2FtcFx3d3dcaGFyYW1fcG9ydGFsXFxwdWJsaWNcU2F3eUNNUw=='),
(184, 'FileManagerExtract', 30, 'file_manager/?dir=Qzpcd2FtcFx3d3dcaGFyYW1fcG9ydGFsXFxwdWJsaWNcU2F3eUNNUw=='),
(185, 'FileManagerLaunchShell', 30, 'file_manager/?dir=Qzpcd2FtcFx3d3dcaGFyYW1fcG9ydGFsXFxwdWJsaWNcU2F3eUNNUw=='),
(186, 'PluginAdd', 31, 'plugins/_add.php'),
(187, 'PluginEdit', 31, 'plugins/_edit.php'),
(188, 'PluginDelete', 31, 'plugins/_delte.php'),
(189, 'PluginView', 31, 'plugins/_manage.php'),
(190, 'PluginPublish', 31, 'plugins/_manage.php'),
(191, 'PluginTranslate', 31, 'plugins/_manage.php'),
(192, 'LayoutView', 32, 'layout/?defaults=do'),
(193, 'LayoutSave', 32, 'layout/?defaults=do'),
(194, 'MainCategoryAdd', 33, 'mains/_add.php'),
(195, 'MainCategoryEdit', 33, 'mains/_edit.php'),
(196, 'MainCategoryDelete', 33, 'mains/_delete.php'),
(197, 'MainCategoryView', 33, 'mains/_manage.php'),
(198, 'MainCategoryTranslate', 33, 'mains/_manage.php'),
(199, 'MainCategoryPublish', 33, 'mains/_manage.php'),
(200, 'SubjectAdd', 34, 'subjects/_add.php'),
(201, 'SubjectEdit', 34, 'subjects/_edit.php'),
(202, 'SubjectDelete', 34, 'subjects/_delete.php'),
(203, 'SubjectView', 34, 'subjects/_manage.php'),
(204, 'SubjectMove', 34, 'subjects/_manage.php'),
(205, 'SubjectPublish', 34, 'subjects/_manage.php'),
(206, 'SubjectTranslate', 34, 'subjects/_manage.php'),
(207, 'GalleryAdd', 35, 'galleries/_add.php'),
(208, 'GalleryEdit', 35, 'galleries/_edit.php'),
(209, 'GalleryDelete', 35, 'galleries/_delete.php'),
(210, 'GalleryView', 35, 'galleries/_manage.php'),
(211, 'GalleryPublish', 35, 'galleries/_manage.php'),
(212, 'GalleryTranslate', 35, 'galleries/_manage.php'),
(213, 'MediaAdd', 36, 'medias/_add.php'),
(214, 'MediaEdit', 36, 'medias/_edit.php'),
(215, 'MediaDelete', 36, 'medias/_delete.php'),
(216, 'MediaView', 36, 'medias/_manage.php'),
(217, 'MediaMove', 36, 'medias/_manage.php'),
(218, 'MediaTranslate', 36, 'medias/_manage.php'),
(219, 'FileManagerViewCurrentLocation', 30, 'file_manager/?dir=Qzpcd2FtcFx3d3dcaGFyYW1fcG9ydGFsXFxwdWJsaWNcU2F3eUNNUw=='),
(227, 'MediaPublish', 36, 'medias/_manage.php'),
(228, 'MailGroupAdd', 38, 'mailgroups/_add.php'),
(229, 'MailGroupEdit', 38, 'mailgroups/_edit.php'),
(230, 'MailGroupDelete', 38, 'mailgroups/_delete.php'),
(231, 'MailGroupView', 38, 'mailgroups/_manage.php'),
(232, 'MailGroupTranslate', 38, 'mailgroups/_manage.php'),
(233, 'MailGroupPublish', 38, 'mailgroups/_manage.php'),
(234, 'MailAdd', 39, 'mails/_add.php'),
(235, 'MailEdit', 39, 'mails/_edit.php'),
(236, 'MailDelete', 39, 'mails/_delete.php'),
(237, 'MailView', 39, 'mails/_manage.php'),
(238, 'MailSend', 39, 'mail_messages/_send.php'),
(239, 'MailPublish', 39, 'mails/_manage.php'),
(240, 'MailGroupsNewsLetter', 38, 'mailgroups/_manage.php'),
(241, 'MainCategoryMove', 33, 'mains/_manage.php'),
(270, 'FileAdd', 45, 'files/_add.php'),
(271, 'FileEdit', 45, 'files/_edit.php'),
(272, 'FileDelete', 45, 'files/_delete.php'),
(273, 'FileView', 45, 'files/_manage.php'),
(274, 'FilePublish', 45, 'files/_manage.php'),
(277, 'SubscriptionDelete', 46, 'subscriptions/_manage.php'),
(278, 'SubscriptionView', 46, 'subscriptions/_manage.php'),
(279, 'MenuAdmin', 28, 'menus/_manage.php?menu_type=1'),
(280, 'MenuAssignModule', 28, ''),
(281, 'VoteQuestionAdd', 47, 'votequestions/_add.php'),
(282, 'VoteQuestionEdit', 47, 'votequestions/_manage.php'),
(283, 'VoteQuestionDelete', 47, 'votequestions/_manage.php'),
(284, 'VoteQuestionView', 47, 'votequestions/_manage.php'),
(285, 'VoteQuestionTranslate', 47, 'votequestions/_manage.php'),
(286, 'VoteQuestionPublish', 47, 'votequestions/_manage.php'),
(287, 'VoteAnswerAdd', 48, 'voteanswers/_add.php'),
(288, 'VoteAnswerEdit', 48, 'voteanswers/_manage.php'),
(289, 'VoteAnswerDelete', 48, 'voteanswers/_manage.php'),
(290, 'VoteAnswerView', 48, 'voteanswers/_manage.php'),
(291, 'VoteAnswerTranslate', 48, 'voteanswers/_manage.php'),
(292, 'VoteAnswerPublish', 48, 'voteanswers/_manage.php'),
(293, 'VoteAnswerMove', 48, 'voteanswers/_manage.php'),
(294, 'EventAdd', 49, 'events/_add.php'),
(295, 'EventDelete', 49, 'events/_manage.php'),
(296, 'EventEdit', 49, 'events/_manage.php'),
(297, 'EventMove', 49, 'events/_manage.php'),
(298, 'EventPublish', 49, 'events/_manage.php'),
(299, 'EventTranslate', 49, 'events/_manage.php'),
(300, 'EventView', 49, 'events/_manage.php'),
(301, 'EventConfigEdit', 50, 'event_config/_edit.php'),
(302, 'SiteConfigAdd', 25, 'site_config/_add.php'),
(303, 'SiteConfigView', 25, 'site_config/_manage.php'),
(304, 'SiteConfigDelete', 25, 'site_config/_manage.php'),
(305, 'SiteConfigPublish', 25, 'site_config/_manage.php'),
(306, 'LogOut', 18, 'login/logout.php'),
(307, 'JoinRequestView', 51, 'join_requests/_manage.php'),
(308, 'JobRequestView', 52, 'job_requests/_manage.php'),
(309, 'JoinRequestDelete', 51, 'join_requests/_manage.php'),
(310, 'JobRequestDelete', 52, 'job_requests/_manage.php'),
(311, 'ContactsView', 53, 'contacts/_manage.php'),
(312, 'ContactsDelete', 53, 'contacts/_delete.php'),
(313, 'LanguageEditPhrases', 1, 'languages/_edit_phrases.php');

-- --------------------------------------------------------

--
-- Table structure for table `persecs`
--

CREATE TABLE `persecs` (
  `id` int(11) NOT NULL,
  `title` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `persecs`
--

INSERT INTO `persecs` (`id`, `title`) VALUES
(1, 'Languages'),
(2, 'Users'),
(3, 'Roles'),
(4, 'Permissions'),
(5, 'Photos'),
(6, 'Log File'),
(18, 'Member Actions'),
(19, 'Pages'),
(21, 'Ads Sections'),
(22, 'Ads'),
(25, 'Site Config'),
(26, 'Modules'),
(27, 'Parts'),
(28, 'Menus'),
(30, 'FileManager'),
(31, 'Plugins'),
(32, 'Layout'),
(33, 'Main Categories'),
(34, 'Subjects'),
(35, 'Gallaries'),
(36, 'Medias'),
(38, 'MailGroups'),
(39, 'Mails'),
(45, 'File'),
(46, 'Subscription'),
(47, 'VoteQuestion'),
(48, 'VoteAnswer'),
(49, 'Events'),
(50, 'Event Config'),
(51, 'Join Requests'),
(52, 'Job Requests'),
(53, 'Contact Us');

-- --------------------------------------------------------

--
-- Table structure for table `photographs`
--

CREATE TABLE `photographs` (
  `id` int(11) NOT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `parent_type` varchar(50) DEFAULT 'admin',
  `sort_id` int(11) DEFAULT NULL,
  `publish` int(1) DEFAULT NULL,
  `site_id` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `photographs`
--

INSERT INTO `photographs` (`id`, `filename`, `type`, `size`, `caption`, `parent_type`, `sort_id`, `publish`, `site_id`) VALUES
(735, '98295122.png', 'image/png', 54016, 'أكاديمية المسجد النبوي', 'config', 670, 1, 1),
(736, '70722330.png', 'image/png', 27798, 'أكاديمية المسجد النبوي', 'config', 671, 1, 1),
(874, '86040814.png', 'image/png', 6499, 'كابيتال ان', 'config', 789, 1, 1),
(964, '16315684.jpg', 'image/jpeg', 1178396, 'سلايدر ١', 'ad', 879, 1, 1),
(974, '57902506.jpg', 'image/jpeg', 119024, 'الطالب المتمير', 'ad', 889, 1, 1),
(975, '64799246.jpg', 'image/jpeg', 182406, 'المعلم المتميز', 'ad', 890, 1, 1),
(976, '34852794.jpg', 'image/jpeg', 91462, 'الوظائف الشاغرة', 'ad', 891, 1, 1),
(986, '85613882.jpg', 'image/jpeg', 1136601, 'الموقع الرسمي لشركة عبد اللطيف احمد العرفج', 'ad', 901, 1, 1),
(989, '66080097.jpg', 'image/jpeg', 90781, 'الرئيس العام يشارك في أعمال ترميم الجدار القبلي بالمسجد النبوي', 'subject', 904, 1, 1),
(990, '27517013.jpg', 'image/jpeg', 90781, 'الرئيس العام يشارك في أعمال ترميم الجدار القبلي بالمسجد النبوي', 'subject', 905, 1, 1),
(992, '46132413.JPG', 'image/jpeg', 316334, 'بانوراما 1', 'ad', 907, 1, 1),
(993, '90042926.jpg', 'image/jpeg', 113848, 'وكالة شؤون المسجد النبوي تستقبل 100 وافد من حديثي العهد بالإسلام', 'subject', 908, 1, 1),
(994, '41284970.jpg', 'image/jpeg', 28967, 'مسابقات وبرامج لحفظ آيات التسامح في القسم النسائي بالمسجد النبوي', 'subject', 909, 1, 1),
(995, '33431503.jpg', 'image/jpeg', 49111, 'معالي الرئيس العام يصدر قرارًا بإعادة تشكيل الهيئة الاستشارية بوكالة شؤون المسجد النبوي', 'subject', 910, 1, 1),
(996, '47937247.jpeg', 'image/jpeg', 184834, 'تصريح الأستاذ عبد العزيز الأيوبي بمناسبة الثقة بتكليفه الوكيل المساعد لشؤون المسجد النبوي', 'subject', 911, 1, 1),
(997, '97448234.jpg', 'image/jpeg', 92622, 'حملة لتطعيم منسوبي وكالة المسجدالنبوي ضد الانفلونزا الموسمية', 'subject', 912, 1, 1),
(998, '14069171.jpg', 'image/jpeg', 95644, 'معالي الرئيس العام يلقي درسه الدوري في رحاب المسجد النبوي', 'subject', 913, 1, 1),
(999, '55586450.jpg', 'image/jpeg', 128489, 'معالي الرئيس العام يقف على أعمال فرش السجاد الأخضر الجديد في التوسعة السعودية الأولى بالمسجد النبوي', 'subject', 914, 1, 1),
(1003, '35076551.png', 'image/png', 3834, 'ابشر', 'ad', 918, 1, 1),
(1004, '71086317.png', 'image/png', 21903, 'موقع نور', 'ad', 919, 1, 1),
(1005, '71867490.png', 'image/png', 67709, 'البريد السعودي', 'ad', 920, 1, 1),
(1006, '85312288.png', 'image/png', 46607, 'وزارة الصحة', 'ad', 921, 1, 1),
(1007, '64157853.png', 'image/png', 156181, 'مبادرة خير امه', 'ad', 922, 1, 1),
(1008, '11967721.png', 'image/png', 27813, 'رؤية 2030', 'ad', 923, 1, 1),
(1009, '47156798.png', 'image/png', 12394, 'الخدمات الإلكترونية', 'ad', 924, 1, 1),
(1010, '76594782.png', 'image/png', 11910, 'التواصل مع الرئيس', 'ad', 925, 1, 1),
(1011, '31717253.png', 'image/png', 13076, 'الحرمين مباشر', 'ad', 926, 1, 1),
(1012, '68561483.png', 'image/png', 12525, 'استطلاع رأي الزوار', 'ad', 927, 1, 1),
(1013, '69724754.png', 'image/png', 12338, 'معهد المسجد النبوي', 'ad', 928, 1, 1),
(1014, '85642576.png', 'image/png', 10276, 'منبر الحرمين', 'ad', 929, 1, 1),
(1015, '17028955.png', 'image/png', 14798, 'التسجيل الخاص بافراد المجتمع', 'ad', 930, 1, 1),
(1016, '50912367.png', 'image/png', 10944, 'مواقيت الصلاة', 'ad', 931, 1, 1),
(1017, '92350903.png', 'image/png', 12141, 'النادي الإجتماعي', 'ad', 932, 1, 1),
(1018, '33558413.png', 'image/png', 10810, 'جدول الأئمة', 'ad', 933, 1, 1),
(1019, '19729628.png', 'image/png', 29468, 'خير امه', 'ad', 934, 1, 1),
(1021, '26301932.png', 'image/png', 17257, 'هيئة تطوير منطقة المدينة المنورة', 'ad', 936, 1, 1),
(1022, '22057096.JPG', 'image/jpeg', 25639, 'أمانة منطقة المدينة المنورة', 'ad', 937, 1, 1),
(1023, '27123205.jpg', 'image/jpeg', 35161, 'إمارة منطقة المدينة المنورة', 'ad', 938, 1, 1),
(1031, '20531367.jpg', 'image/jpeg', 86358, 'معالي الرئيس العام لشؤون المسجد الحرام و المسجد النبوي يقف ميدانيًا على مشروع الجدار القبلي بعد الانتهاء من ترميمه', 'subject', 946, 1, 1),
(1032, '71719413.jpg', 'image/jpeg', 82379, 'معالي الرئيس العام يوجه بتمكين ودعم رأس المال البشري في الوكالة ويبشر الموظفين والموظفات باعتماد قرار بترقية المجموعة الثانية وعددهم (١٥١)', 'subject', 947, 1, 1),
(1033, '30537021.jpg', 'image/jpeg', 31622, 'معالي الرئيس العام يطلق مبادرة', 'subject', 948, 1, 1),
(1034, '92978779.png', 'image/png', 653237, 'معالي الرئيس العام يعلن صدور الموافقة السامية الكريمة على استكمال المشروعات التشغيلية والفنية والتحديث الرأسمالي في المسجد النبوي', 'subject', 949, 1, 1),
(1035, '8148160.JPG', 'image/jpeg', 2088970, 'معالي الرئيس العام يصدر قرارا بتطوير الهيكله النسائية بوكالة الرئاسة العامة لشؤون المسجد النبوي', 'subject', 950, 1, 1),
(1036, '32908312.jpg', 'image/jpeg', 92524, 'معالي الرئيس العام يصدر قرارا بتكليف عدد من القيادات النسائية بوكالة شؤون المسجد النبوي', 'subject', 951, 1, 1),
(1037, '45370643.JPG', 'image/jpeg', 365156, 'السديس يصدر قرارا بدمج الوكالة المساعدة للمشاريع والمساعدة للشؤون الفنية لتكون الوكالة المساعدة للمشاريع والشؤون الهندسية والفنية', 'subject', 952, 1, 1),
(1038, '39820667.JPG', 'image/jpeg', 365156, 'السديس يصدر قرارا بدمج الوكالة المساعدة للمشاريع والمساعدة للشؤون الفنية لتكون الوكالة المساعدة للمشاريع والشؤون الهندسية والفنية', 'subject', 953, 1, 1),
(1039, '28685765.JPG', 'image/jpeg', 4498218, 'معالي الرئيس العام يصدر قرارا بتشكيل القيادات الهندسية والفنية بوكالة شؤون المسجد النبوي', 'subject', 954, 1, 1),
(1040, '27245734.JPG', 'image/jpeg', 5790197, 'معالي الرئيس العام يصدر قرارا بتغيير ارتباط إدارة خدمات المستفيدين بالوكالة', 'subject', 955, 1, 1),
(1041, '22713355.jpeg', 'image/jpeg', 1345618, 'فضيلة وكيل الرئيس العام يرفع شكره لخادم الحرمين الشريفين على موافقته الكريمة لاستكمال المشروعات التشغيلية والفنية في المسجد النبوي', 'subject', 956, 1, 1),
(1042, '3087267.png', 'image/png', 721158, 'الوكيل المساعد للشؤون النسائية تشكر الرئيس العام وتشيد بالقرارات التي أصدرها', 'subject', 957, 1, 1),
(1043, '87423936.jpeg', 'image/jpeg', 147705, 'بالتعاون مع الهيئة العامة للأوقاف ..وكالة شؤون المسجد النبوي تطلق عرض مختصر للفيلم الوثائقي العالمي (لك الحمد)', 'subject', 958, 1, 1),
(1044, '61528252.JPG', 'image/jpeg', 3699263, 'فضيلة وكيل الرئيس العام يدشن الفرص التطوعية للوكالة في المنصة الوطنية للعمل التطوعي التابعة لوزارة الموارد البشرية', 'subject', 959, 1, 1),
(1045, '77512285.png', 'image/png', 721158, 'وكالة شؤون المسجد النبوي تعلن عن بدء التسجيل الإلكتروني للطلاب والطالبات في كلية المسجد النبوي للعام 1442هـ (الفترة الصباحية)', 'subject', 960, 1, 1),
(1047, '89629768.png', 'image/png', 69381, 'وكالة الرئاسة العامة لشؤون المسجد النبوي', 'config', 962, 1, 1),
(1048, '8386233.png', 'image/png', 184062, 'وكالة الرئاسة العامة لشؤون المسجد النبوي', 'config', 963, 1, 1),
(1049, '13017327.jpg', 'image/jpeg', 131351, 'فضيلة الشيخ الثبيتي في خطبة الجمعة : سيرة النبي صلى الله عليه وسلم تضيء لنا دروب الحياة', 'subject', 964, 1, 1),
(1050, '51078487.jpg', 'image/jpeg', 22611, 'وكالة شؤون المسجد النبوي تقيم برنامجًا تدريبيًا بعنوان (صناعة الأفكار الإبداعية)', 'subject', 965, 1, 1),
(1051, '15338833.jpg', 'image/jpeg', 529827, 'لعامها الثامن على التوالي.. معالي الرئيس العام يدشن حملة ( خدمة الحاج والزائر وسام وفخر لنا  )', 'subject', 966, 1, 1),
(1052, '60954609.jpeg', 'image/jpeg', 1356980, 'أبواب توسعة الملك فهد في المسجد النبوي أين صنعت وما قصتها', 'subject', 967, 1, 1),
(1053, '9195906.jpg', 'image/jpeg', 485433, 'فضيلة الشيخ حسين آل الشيخ في خطبة الجمعة : من المواسم الفاضلة أيام العشر الأولى من شهر ذي الحجة الموفق من جعلها موسمًا يستثمره في الصالحات', 'subject', 968, 1, 1),
(1054, '24086179.jpg', 'image/jpeg', 19495, 'وكالة شؤون المسجد النبوي تعلن عن رغبتها لشغل عدد من الوظائف عن طريق نقل الخدمات لحملة الدكتوراه والماجستير', 'subject', 969, 1, 1),
(1055, '6889815.jpeg', 'image/jpeg', 12796850, 'برعاية معالي الرئيس .. فضيلة وكيل الرئيس العام لشؤون المسجد النبوي يدشن الفلم الوثائقي العالمي لك الحمد', 'subject', 970, 1, 1),
(1056, '92351272.jpg', 'image/jpeg', 79731, 'فضيلة الشيخ القاسم في خطبة الجمعة : دينُ الإسلام دينٌ عظيم مبني على جلب المصالح ودرء المفاسد', 'subject', 971, 1, 1),
(1057, '87710915.jpg', 'image/jpeg', 627193, 'فضيلة وكيل الرئيس العام لشؤون المسجد النبوي يهنئ القيادة الرشيدة بنجاح العملية الجراحية التي أجريت لخادم الحرمين الشريفين', 'subject', 972, 1, 1),
(1058, '36163665.png', 'image/png', 184062, 'The agency of the general presidency for the affair of the prophet\'s mosque', 'config', 973, 1, 1),
(1059, '66006377.png', 'image/png', 78976, 'The agency of the general presidency for the affair of the prophet\'s mosque', 'config', 974, 1, 1),
(1060, '14437344.png', 'image/png', 184062, 'مسجد نبوی کے امور کے لئے جنرل ایوان صدر', 'config', 975, 1, 1),
(1061, '9382571.png', 'image/png', 78976, 'مسجد نبوی کے امور کے لئے جنرل ایوان صدر', 'config', 976, 1, 1),
(1062, '68791373.jpg', 'image/jpeg', 71199, 'فضيلة الشيخ الدكتور عبد الباري الثبيتي خلال خطبة الجمعة اليوم : من سمة عفو الله، مضاعفة الحسنات و الثواب على الهم بها دون السيئات.', 'subject', 977, 1, 1),
(1063, '52341868.jpg', 'image/jpeg', 161543, 'فضيلة الشيخ القاسم في خطبة الجمعة : نصيب الإنسان من الدنيا عمُرُه ، فإن أحسن اغتنامه فيما ينفعه في دار القرار فقد ربحت تجارته', 'subject', 978, 1, 1),
(1064, '85630288.png', 'image/png', 184062, 'Presidensi Umum Urusan Masjid Nabawi', 'config', 979, 1, 1),
(1065, '37741598.png', 'image/png', 78976, 'Presidensi Umum Urusan Masjid Nabawi', 'config', 980, 1, 1),
(1066, '76807365.png', 'image/png', 184062, 'La présidence générale des affaires de la mosquée du prophète', 'config', 981, 1, 1),
(1067, '51496924.png', 'image/png', 78976, 'La présidence générale des affaires de la mosquée du prophète', 'config', 982, 1, 1),
(1068, '83041945.jpeg', 'image/jpeg', 32738, 'الوكيلة المساعدة للشؤون النسائية :\" وكالة الرئاسة العامة لشؤون المسجد النبوي تشهد تمكيناً للمرأة في كافة المجالات\"', 'subject', 983, 1, 1),
(1069, '86423487.jpeg', 'image/jpeg', 32995, 'دعماً لوكالة شؤون المسجد النبوي وتتويجا للقيادات الشابة الرئيس العام يصدر قراراً بتكليف عدداً من الوكلاء المساعدون في  الوكالة', 'subject', 984, 1, 1),
(1070, '9212197.jpg', 'image/jpeg', 51373, 'فضيلة الشيخ أحمد بن طالب في خطبة الجمعة : اعلموا أن قبول الأعمال وكمالها بالنية ، ولكل امرىء من الأجر بقدر ما نوى', 'subject', 985, 1, 1),
(1071, '59704088.jpeg', 'image/jpeg', 31279, 'لتطوير رسالة المعارض والمتاحف  ..الرئيس العام يصدر قراراً بإنشاء الوكالة المساعدة للمعارض والمتاحف  وارتباط عدد من الإدارات العامة بها', 'subject', 986, 1, 1),
(1072, '69696897.jpeg', 'image/jpeg', 32995, 'مواكبة لرؤية المملكة ٢٠٣٠..الرئيس العام يصدر قراراً بإنشاء الوكالة المساعدة للمكتبات والمطبوعات والبحث العلمي بالمسجد النبوي', 'subject', 987, 1, 1),
(1073, '34782716.jpeg', 'image/jpeg', 181643, 'تحقيقا للأهداف والاستراتيجيات ..الرئيس العام يصدر قراراً بإنشاء مكتب بمسمى \"مكتب إدارة البيانات\" بوكالة شؤون المسجد النبوي', 'subject', 988, 1, 1),
(1074, '21912103.jpeg', 'image/jpeg', 2104919, 'مواكبة للتطوير والتقدم .الرئيس العام يصدر قراراً بإنشاء إدارة بمسمى \"إدارة الإشراف على المباني والعناصر المرتبطة بالمسجد النبوي\"', 'subject', 989, 1, 1),
(1075, '58525158.jpeg', 'image/jpeg', 32995, 'استمراراً لتطوير الخدمات ..الرئيس العام يصدر قراراً يإنشاء وحدة إدارية بمسمى\"وحدة تطييب المسجد النبوي\"', 'subject', 990, 1, 1),
(1076, '38576724.jpeg', 'image/jpeg', 31279, 'لتحقيق أعلى المستويات في الأداء والانضباط..الرئيس العام يصدر قراراً  بإنشاء وحدة إدارية بمسمى \"وحدة حسن انتظام الموظفات\"', 'subject', 991, 1, 1),
(1077, '14270182.jpeg', 'image/jpeg', 60815, 'الرئيس العام يصدر قراراً بتغيير اسم (إدارة الصحة والبيئة والمختبر) إلى (إدارة الوقاية البيئية ومكافحة الأوبئة)', 'subject', 992, 1, 1),
(1078, '56813770.jpeg', 'image/jpeg', 144600, 'الرئيس العام يصدر قراراً بتغيير مسمى  (إدارة شؤون الحرم القديم) إلى (إدارة شؤون الحرم القديم والتوسعة السعودية الأولى)', 'subject', 993, 1, 1),
(1079, '61308852.jpeg', 'image/jpeg', 46423, 'الرئيس العام يصدر قراراً بتغيير مسمى(الإدارة العامة للشؤون العلمية والثقافية) إلى (الإدارة العامة للمقرأة والحلقات والمتون)', 'subject', 994, 1, 1),
(1080, '27344099.jpeg', 'image/jpeg', 146586, 'الرئيس العام يصدر قراراً بتغيير مسمى (وحدة قضايا ومشكلات العاملين) إلى (وحدة حقوق وقضايا العاملين والمستفيدين)', 'subject', 995, 1, 1),
(1081, '33067258.jpeg', 'image/jpeg', 32995, 'الرئيس العام يصدر قراراً بتغيير مسمى (إدارة الاستقبال) إلى (إدارة المراسم) بوكالة شؤون المسجد النبوي', 'subject', 996, 1, 1),
(1082, '29724048.jpg', 'image/jpeg', 16827, 'معالي الرئيس العام يصدر قرارا بتكليف عدد من مدراء العموم ومساعديهم بوكالة شؤون المسجد النبوي', 'subject', 997, 1, 1),
(1083, '29825930.jpg', 'image/jpeg', 17893, 'للأرتقاء بمنظومة العمل ..معالي الرئيس العام يصدر قراراً بتكليف عدد من المدراء والوكلاء ومدراء الوحدات بالوكالة', 'subject', 998, 1, 1),
(1084, '7158283.jpg', 'image/jpeg', 17893, 'مواكبة لرؤية المملكة 2030..معالي الرئيس يصدر قرارا بتكليف عدد من القيادات النسائية بوكالة شؤون المسجد النبوي', 'subject', 999, 1, 1),
(1085, '84748729.jpg', 'image/jpeg', 16827, 'تتويجاً للمرأة وتمكينها في مجال المكتبات..الرئيس العام يصدر قرارا بإنشاء (الوكالة المساعدة للمكتبات والمطبوعات والبحث العلمي النسائية)', 'subject', 1000, 1, 1),
(1086, '77252677.jpeg', 'image/jpeg', 32995, 'الرئيس العام يصدر قراراً بتكليف عدد من القيادات النسائية بوكالة شؤون المسجد النبوي', 'subject', 1001, 1, 1),
(1087, '98050142.JPG', 'image/jpeg', 7546305, 'لمواكبة ما هو جديد في الإعلام والصناعة الفنية للإعلام .. وكالة شؤون المسجد النبوي تقيم ورشة عمل ( الصناعةالإعلامية للوكالة خلال عام )', 'subject', 1002, 1, 1),
(1088, '24262409.jpg', 'image/jpeg', 455592, 'وكالة شؤون المسجد النبوي تستعد لفرش توسعات المسجد النبوي وساحاته بالسجاد وفق الإجراءات الاحترازية.', 'subject', 1003, 1, 1),
(1089, '57189481.jpeg', 'image/jpeg', 103732, 'المتحدث الرسمي للوكالة: ما يتم تداوله عن فتح المسجد النبوي والصلاة في الحرم القديم والزيارة لمدة 24 ساعة خبر قديم يعود تاريخه لعام ١٤٢٨هـ', 'subject', 1004, 1, 1),
(1090, '21221710.jpg', 'image/jpeg', 301558, 'فضيلة الشيخ الحذيفي في خطبة الجمعة : التفكر في مخلوقات الله عبادةٌ من المُسلم والاعتبار بهذه المخلوقات يزيد المسلم إيمانًا', 'subject', 1005, 1, 1),
(1093, '18388102.jpg', 'image/jpeg', 627193, 'فضيلة وكيل الرئيس العام : صدور قرار معالي الرئيس العام بالترقية الاستثنائية لعدد من الموظفين دعم لمسيرة العمل بالوكالة وتحفيزاً للعاملين', 'subject', 1008, 1, 1),
(1094, '14560228.jpg', 'image/jpeg', 409632, 'الوكيل المساعد لشؤون المسجد النبوي : أرفع الشكر و التقدير لمعالي الرئيس بمناسبة صدور قرار معاليه بالترقية للمرتبة الثانية عشر', 'subject', 1009, 1, 1),
(1095, '79432667.jpg', 'image/jpeg', 293395, 'فضيلة الشيخ الثبيتي في خطبة الجمعة : لا حياة للقلوب ولا فرح ولا سرور ولا نعيم ولا أنس إلا في معرفة الله سبحانه', 'subject', 1010, 1, 1),
(1096, '73916344.jpg', 'image/jpeg', 517727, 'قرار معالي الرئيس العام بإنشاء الوكالة المساعدة للمكتبات والمطبوعات والبحث العلمي يشكل الاهتمام بتطوير المكتبات وكنوزها المعرفية ', 'subject', 1011, 1, 1),
(1097, '25761036.jpg', 'image/jpeg', 424644, 'فضيلة الشيخ الدكتور حسين آل الشيخ في خطبة الجمعة : إن الحسنات ماحية للسيئات ومنها الإحسان للناس بشتى انواع الإحسان', 'subject', 1012, 1, 1),
(1098, '39583409.jpg', 'image/jpeg', 30009, 'وكالة شؤون المسجد النبوي تعلن بدء الدراسة عن بعد في كلية المسجد النبوي.', 'subject', 1013, 1, 1),
(1099, '41157990.jpg', 'image/jpeg', 569130, 'لمتابعة تنفيذ المشاريع وقياس نسب الإنجاز .. حلقة عمل لمناقشة التحول الرقمي بمبادرات الخطة الاستراتيجية 2024', 'subject', 1014, 1, 1),
(1100, '65461486.JPG', 'image/jpeg', 9245447, 'وكالة شؤون المسجد النبوي تعقد اجتماعاً تنسيقياً لمتابعة تطبيق الاجراءات الاحترازية في المسجد النبوي والمرافق التابعة له', 'subject', 1015, 1, 1),
(1101, '21139402.jpg', 'image/jpeg', 291051, 'فضيلة الشيخ الدكتور عبد الله البعيجان خلال خطبة الجمعة اليوم : أفضل وسيلة لمحبة النبي ﷺ هي التعرف على سيرته وشمائله وأخلاقه', 'subject', 1016, 1, 1),
(1102, '92718885.jpg', 'image/jpeg', 454173, 'فضيلة الشيخ صلاح بن محمد البدير خلال خطبة الجمعة : علم الطب من أجلّ العلوم وأعظمها نفعاً ووقعا وهي ميدان العز والشرف', 'subject', 1017, 1, 1),
(1103, '24511588.JPG', 'image/jpeg', 1372776, 'وكالة شؤون المسجد النبوي تقيم ورشة عمل بعنوان ( التعريف بالذكاء الاصطناعي وتسخير امكانياته في خدمة المسجد النبوي )', 'subject', 1018, 1, 1),
(1104, '93297852.jpg', 'image/jpeg', 181659, 'المسجد النبوي ..جوانبه وزواياه تحكي للعالم قصة عناية واهتمام لم يشهد لها مثيل  ‫', 'subject', 1019, 1, 1),
(1105, '89711327.jpg', 'image/jpeg', 631764, 'فضيلة وكيل الرئيس العام يرفع شكره و تقديره لخادم الحرمين الشريفين بعد صدور موافقته الكريمة على السماح بأداء العمرة والزيارة تدريجيًا', 'subject', 1020, 1, 1),
(1106, '67449872.jpg', 'image/jpeg', 433744, 'فضيلة الشيخ الدكتور عبد الله بن عبد الرحمن البعيجان خلال خطبة الجمعة اليوم : إن احب البقاع إلى الله المساجد و إليها يأوي من آمن به وتولاه.', 'subject', 1021, 1, 1),
(1107, '45650737.jpg', 'image/jpeg', 409632, 'الموافقة الكريمة على الفتح التدريجي لباب العمرة   تأتي في سياق نعود بحذر ضمن الخطة المدروسة المحكمة لإعادة إطلاق مناحي الحياة الطبيعة', 'subject', 1022, 1, 1),
(1108, '45177087.jpeg', 'image/jpeg', 151803, 'وكالة شؤون المسجد النبوي تقيم فعالية بعنوان ( عبق الوطن )', 'subject', 1023, 1, 1),
(1109, '95607811.jpg', 'image/jpeg', 267866, 'الإدارة العامة للشؤون الخدمية النسائية بالوكالة تنظم مبادرة بعنوان \"لحمة وطن \" داخل المسجد النبوي', 'subject', 1024, 1, 1),
(1110, '94914051.jpg', 'image/jpeg', 267866, 'مسابقة الكترونية لأبناء منسوبات وكالة الشؤون النسائية في اليوم بعنوان \" حكاية وطن\"', 'subject', 1025, 1, 1),
(1111, '95569589.jpg', 'image/jpeg', 93517, 'فضيلة الشيخ أحمد بن طالب بن حميد خلال خطبة الجمعة اليوم : \"ومن يطع الله ورسوله فقد فاز فوزا عظيما\"', 'subject', 1026, 1, 1),
(1112, '36639013.jpg', 'image/jpeg', 1706606, 'إدارة شؤون الزيارة تقوم توزيع هدايا للموظفين بمناسبة اليوم الوطني الـ90 للمملكة', 'subject', 1027, 1, 1),
(1113, '80608830.jpg', 'image/jpeg', 67509, 'الإدارة العامة لأكاديمية المسجد النبوي ..عام من العطاء في تدريب وتنمية العناصر البشرية لخدمة المسجد النبوي', 'subject', 1028, 1, 1),
(1114, '32015685.jpg', 'image/jpeg', 67509, 'إدارة العلاقات العامة النسائية بوكالة شؤون المسجد النبوي تشارك في اليوم العالمي لكبار السن', 'subject', 1029, 1, 1),
(1115, '96558358.jpg', 'image/jpeg', 442836, 'وكالة شؤون المسجد النبوي تقيم ورشة عمل بعنوان \"المرحلة الثانية من التحول الرقمي للمشاريع\"', 'subject', 1030, 1, 1),
(1116, '30523825.JPG', 'image/jpeg', 13625106, 'خلال لقائه بمنسوبي الإدارة العامة للإعلام والاتصال ..وكيل الرئيس العام يجب التكاتف على تنفيذ هذه الخطة وترجمتها على أرض الواقع', 'subject', 1031, 1, 1),
(1117, '43676638.jpg', 'image/jpeg', 297003, 'أرسل الله الرسل وآخرهم سيدهم محمد ﷺ لإصلاح الأرض بالطاعات و تطيهرها من ابشرك والموبقات.', 'subject', 1032, 1, 1),
(1118, '27623137.jpeg', 'image/jpeg', 78837, 'أمير منطقة القصيم:العمل في مسجد رسول الله من أشرف الأعمال وأجلها وكل من يملك بصيرة يتمنى أن يكون عاملاً في هذا المكان الطاهر', 'subject', 1033, 1, 1),
(1119, '79650888.jpg', 'image/jpeg', 121853, 'وكالة شؤون المسجد النبوي تكرم 10 إدارات منتظمة في تسجيل الإحصائية خلال عام 1441هـ.', 'subject', 1034, 1, 1),
(1120, '44257855.jpg', 'image/jpeg', 13875973, 'وكالة شؤون المسجد النبوي تقوم بجولة  ميدانية على الأعمال المعمارية والمدنية لمشروع تبليط الساحات الغربية', 'subject', 1035, 1, 1),
(1121, '62386745.JPG', 'image/jpeg', 15527792, 'معالي الرئيس العام يتسلم التقرير السنوي لأكاديمية المسجد النبوي(عام من العطاء)', 'subject', 1036, 1, 1),
(1122, '15452708.jpeg', 'image/jpeg', 817948, 'معالي الرئيس العام يدشن خطة الوكالة لمكافحة العدوى وتطبيق نظم التطهير والتعقيم بالأوزون أو المطهرات الآمنة', 'subject', 1037, 1, 1),
(1123, '41134216.jpg', 'image/jpeg', 90089, 'بتوجيه من معالي الرئيس العام  يعتمد فضيلة وكيل الرئيس العام لشؤون المسجد النبوي ترقية (27) موظفاً وموظفة من القياديين بالوكالة', 'subject', 1038, 1, 1),
(1124, '82636655.jpg', 'image/jpeg', 641454, 'فضيلة الشيخ حسين آل الشيخ في خطبة الجمعة : أعظم المصائب أن تمر الابتلاءات فلا تلينبها القلوب ولا تعود بها الجوارح إلى ربها', 'subject', 1039, 1, 1),
(1128, '82435894.jpg', 'image/jpeg', 67509, 'زائرات الروضة الشريفة : التنظيم أكثر من رائع وشاهدنا اهتماماً كبيراً في التعقيم وحسن الاستقبال', 'subject', 1043, 1, 1),
(1129, '45470552.jpg', 'image/jpeg', 155153, 'وكالة شؤون المسجد النبوي تقوم بعمل جولات ميدانية للتأكد من تطبيق الإجراءات الاحترازية تزامناً مع فتح الزيارة للروضة الشريفة', 'subject', 1044, 1, 1),
(1130, '30494240.jpg', 'image/jpeg', 398049, 'فضيلة الشيخ الدكتور الثبيتي خلال خطبة الجمعة اليوم : تحدث عن نعم الله على سبيل الإقرار والإذعان والاعتراف والوفاء لتستشعر فضله وتعرف حقه', 'subject', 1045, 1, 1),
(1132, '26715509.jpg', 'image/jpeg', 313261, 'فضيلة الشيخ القاسم في خطبة الجمعة : الله جعل القرآن العظيم آيةً خالدة وموعظة بالغة نوّع فيه أساليب الهداية.', 'subject', 1047, 1, 1),
(1133, '70903603.jpg', 'image/jpeg', 67509, 'وكالة شؤون المسجد النبوي تنفذ برنامج علمي بعنوان (فمن أخذه أخذ بحظٍ وافر)', 'subject', 1048, 1, 1),
(1134, '61042798.jpeg', 'image/jpeg', 67696, 'وكالة شؤون المسجد النبوي تقيم لقاء عن بُعد بعنوان ( تاريخ ومعالم المسجد النبوي)', 'subject', 1049, 1, 1),
(1135, '1745782.jpg', 'image/jpeg', 67509, 'بعنوان  ( المرأة في مواكبة رؤية المملكة في خدمة الحرمين ) حلقة نقاش تقيمها وكالة شؤون المسجد النبوي', 'subject', 1050, 1, 1),
(1136, '66578281.JPG.jpg', 'image/jpeg', 5691521, 'وكالة شؤون المسجد النبوي تقيم ورشة عمل بعنوان (تطوير منظومة الترجمة والإعلام في المسجد النبوي)', 'subject', 1051, 1, 1),
(1137, '17719417.jpg', 'image/jpeg', 139656, 'جهود يومية في عملية تعقيم وتطهير المسجد النبوي للمحافظة على سلامة المصلين', 'subject', 1052, 1, 1),
(1139, '4406349.jpg', 'image/jpeg', 326017, 'فضيلة الشيخ البدير في خطبة الجمعة : تأتي على الناس سنون خداعة يصدق فيها الكاذب و يكذب فيها الصادق ويؤتمن فيها الخائن ويخّون فيها الأمين', 'subject', 1054, 1, 1),
(1140, '10936802.jpg', 'image/jpeg', 38358, 'لاكتشاف الموهبة والابداع وتنميتها .. معالي الرئيس العام يصدر قراراً بإنشاء إدارة بمسمى \"إدارة الموهبة والابداع\"بالوكالة', 'subject', 1055, 1, 1),
(1141, '72589826.jpg', 'image/jpeg', 19888, 'معالي الرئيس العام يصدر قراراً بإعادة تشكيل \"لجنة النادي الاجتماعي\" بالوكالة', 'subject', 1056, 1, 1),
(1142, '67215964.jpg', 'image/jpeg', 49441, 'للارتقاء بمنظومة الخدمات .. معالي الرئيس العام يصدر قراراً بإنشاء 12 أكاديمية تدريبية بوكالة شؤون المسجد النبوي', 'subject', 1057, 1, 1),
(1143, '97445381.jpg', 'image/jpeg', 49441, 'في إطار الحرص على سلامة منسوبي الوكالة وزائري المسجد النبوي .. معالي الرئيس العام يؤكد على مواصلة تطبيق الإجراءات الاحترازية', 'subject', 1058, 1, 1),
(1144, '81948211.jpeg', 'image/jpeg', 188411, 'الوكيل المساعد للشؤون الإدارية : الخطط الاستراتيجية التي وضعتها حكومتنا   كان لها الأثر الكبير في دعم الموارد البشرية في الأجهزة الحكومية', 'subject', 1059, 1, 1),
(1145, '62770301.jpg', 'image/jpeg', 205629, 'فضيلة الشيخ البعيجان في خطبة الجمعة : التعليم هو أساس التربية وأصلها فبه تهذّيب الأخلاق وبه تغرس القيم', 'subject', 1060, 1, 1),
(1146, '87917749.jpg', 'image/jpeg', 205629, 'فضيلة الشيخ البعيجان في خطبة الجمعة : التعليم هو أساس التربية وأصلها فبه تهذّب الأخلاق وبه تغرس القيم', 'subject', 1061, 1, 1),
(1147, '71748964.jpeg', 'image/jpeg', 1100439, 'فضيلة وكيل الرئيس العام يشيد بمضامين كلمة سمو ولي العهد مؤكداً أن قيادتنا الرشيدة استطاعت تحقيق المنجزات بجميع القطاعات .', 'subject', 1062, 1, 1),
(1148, '43411909.jpg', 'image/jpeg', 67696, 'بمناسبة اليوم العالمي للسكري ولرفع مستوى الوعي الصحي .. وكالة شؤون المسجد النبوي تقيم برامج تثقيفية وتوعوية لمنسوباتها عن بُعد', 'subject', 1063, 1, 1),
(1149, '91754627.JPG', 'image/jpeg', 6657514, 'زوار المسجد النبوي : نشكر حكومة المملكة على التنظيم المتميز والفريد من نوعه والذي يعكس أقصى درجات الاهتمام والعناية بالأماكن المقدسة', 'subject', 1064, 1, 1),
(1150, '73609857.jpg', 'image/jpeg', 1388768, 'بمناسبة ذكرى البيعة السادسة لخادم الحرمين الشريفين فضيلة وكيل الرئيس العام : نجدد البيعة والولاء لسلمان الحزم والعزم والإباء', 'subject', 1065, 1, 1),
(1151, '45492302.jpg', 'image/jpeg', 45174, 'الوكيل المساعد لشؤون المسجد النبوي :  نحمد الله تعالى على ما أنعم به على بلادنا من تجدد الخيرات وتوالي المكرمات', 'subject', 1066, 1, 1),
(1152, '94915003.jpg', 'image/jpeg', 67696, 'الوكيل المساعد للشؤون النسائية  : خمسة أعوام مضت مع عام يطل من جديد ونحن نجدد البيعة عاماً بعد عام لولاة أمرنا مصدر فخرنا وعزنا.', 'subject', 1067, 1, 1),
(1153, '92724818.jpg', 'image/jpeg', 67696, 'وكالة شؤون المسجد النبوي تقيم مبادرة  بعنوان ( بالعلم ترتقي الأمة) لزائرات المسجد النبوي .', 'subject', 1068, 1, 1),
(1154, '92856496.jpg', 'image/jpeg', 470997, 'الوكيل المساعد للعلاقات والشؤون الإعلامية : شهدت المملكة في ظل قيادة خادم الحرمين الشريفين المزيد من المنجزات التنموية العملاقة', 'subject', 1069, 1, 1),
(1155, '47919220.jpg', 'image/jpeg', 1126895, 'الوكيل المساعد لشؤون العلمية والتوجيهية النسائية : ستة أعوام لمواصلة مسيرة العطاء والنماء وتحقيق رؤية وطن وطموح قيادة وتطلعات شعب', 'subject', 1070, 1, 1),
(1156, '3741459.jpg', 'image/jpeg', 135384, 'بمناسبة اليوم العالمي للفن الإسلامي .. وكالة شؤون المسجد النبوي تقيم مبادرة ( معالم الفن الإسلامي في المسجد النبوي )', 'subject', 1071, 1, 1),
(1157, '57231467.jpg', 'image/jpeg', 21065521, 'استعراض الجهود العلمية والتوجيهية والإرشادية في عهد خادم الحرمين الشريفين', 'subject', 1072, 1, 1),
(1158, '25454729.JPG', 'image/jpeg', 9490044, 'استعراض المشاريع والخدمات في المسجد النبوي في عهد خادم الحرمين الشريفين', 'subject', 1073, 1, 1),
(1159, '38994584.jpg', 'image/jpeg', 328476, 'فضيلة الشيخ القاسم : العلماء حفظوا الدين قرون متتابعة وينقلونه لمن بعدهم بالصبر على الشدائد بين العلم والعبادة والحفظ والتدوين والتعليم', 'subject', 1074, 1, 1),
(1160, '62473683.png', 'image/png', 713815, 'مدير الإدارة العامة لهيئة المسجد النبوي يلتقي بمدير عام فرع الرئاسة العامة لهيئة الأمر بالمعروف بالمدينة', 'subject', 1075, 1, 1),
(1161, '40781659.jpg', 'image/jpeg', 67509, 'الوكالة المساعدة للشؤون العلمية والتوجيهية النسائية تقيم ندوة عن بعد بعنوان \"على السمع والطاعة نبايع خادم الحرمين الشريفين\"', 'subject', 1076, 1, 1),
(1162, '73373265.jpg', 'image/jpeg', 3067191, 'كلية المسجد النبوي تعلن عن بدء التسجيل للفصل الدراسي الثاني لعام 1442هـ إلكترونياً', 'subject', 1077, 1, 1),
(1163, '50433434.jpg', 'image/jpeg', 387267, 'بشعار ( صناعة ، تمكين ، إبراز)..صناعة إعلامية متجددة في حمل رسالة المسجد النبوي للعالمين .', 'subject', 1078, 1, 1),
(1164, '4383675.jpg', 'image/jpeg', 67509, 'الوكالة المساعدة للشؤون العلمية والثقافية النسائية تنظم لقاء بعنوان ( الطرق الصحيحة لاستعمال المضادات الحيوية )', 'subject', 1079, 1, 1),
(1165, '14184573.JPG', 'image/jpeg', 675008, 'ضمن التحول الرقمي ..وكالة شؤون المسجد النبوي تنهي مشروع التتبع الذاتي لصهاريج مياه زمزم أثناء استخدامها', 'subject', 1080, 1, 1),
(1166, '35130826.jpg', 'image/jpeg', 20607607, 'وكالة شؤون المسجد النبوي توقع مذكرة تفاهم مع جمعية المكفوفين الأهلية رؤية.', 'subject', 1081, 1, 1),
(1168, '85391983.png', 'image/png', 67347, 'مدارس عبدالرحمن فقيه النموذجية للبنين', 'config', 1083, 1, 1),
(1169, '62001164.png', 'image/png', 50175, 'مدارس عبدالرحمن فقيه النموذجية للبنين', 'config', 1084, 1, 1),
(1170, '93787607.png', 'image/png', 50175, 'مدارس عبدالرحمن فقيه النموذجية للبنين', 'config', 1085, 1, 1),
(1171, '63030330.png', 'image/png', 67347, 'مدارس عبدالرحمن فقيه النموذجية للبنين', 'config', 1086, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `plugins`
--

CREATE TABLE `plugins` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `has_page` int(1) DEFAULT NULL,
  `related_class` varchar(255) DEFAULT NULL,
  `lang_id` int(11) DEFAULT NULL,
  `layout_id` int(2) DEFAULT NULL,
  `publish` int(1) DEFAULT NULL,
  `show_title` int(1) DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `javascript` mediumtext DEFAULT NULL,
  `css_class` varchar(255) DEFAULT NULL,
  `css_custom` varchar(255) DEFAULT NULL,
  `html_id` varchar(255) DEFAULT NULL,
  `has_menu` int(1) DEFAULT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `site_id` int(11) DEFAULT 1,
  `related_sec` varchar(50) DEFAULT NULL,
  `ads_section_id` int(11) DEFAULT NULL,
  `gallery_id` int(11) DEFAULT NULL,
  `main_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `plugins`
--

INSERT INTO `plugins` (`id`, `title`, `has_page`, `related_class`, `lang_id`, `layout_id`, `publish`, `show_title`, `content`, `javascript`, `css_class`, `css_custom`, `html_id`, `has_menu`, `menu_id`, `site_id`, `related_sec`, `ads_section_id`, `gallery_id`, `main_id`, `created`, `updated`) VALUES
(41, 'الإعلانات الجانبية', 1, 'plugin_side_ads.php', 2, NULL, 1, 0, '', '', '', '', '', 0, NULL, 1, 'adsec', 8, NULL, NULL, '2019-02-22 17:55:27', '2019-03-01 04:02:39'),
(49, 'شعارات اسفل الموقع', 1, 'plugin_logos.php', 2, NULL, 1, NULL, NULL, NULL, NULL, 'direction:ltr;', NULL, NULL, NULL, 1, 'adsec', 9, NULL, NULL, '2019-03-08 22:08:43', '2020-01-25 12:22:03'),
(51, 'عداد الاحصائيات', NULL, NULL, 2, NULL, 1, NULL, '<!-- Counters Section START -->\r\n<div class=\"section-block-parallax section-md\" style=\"background-image: url(./images/img/116.jpg);\">\r\n	<div class=\"container\">\r\n		<div class=\"row\">\r\n			<div class=\"col-md-5 col-sm-5 col-12\">\r\n				<div class=\"section-heading  mt-15\">\r\n					<h3>إحصائيات</h3>\r\n					<div class=\"section-heading-line-left\">\r\n						&nbsp;</div>\r\n				</div>\r\n			</div>\r\n		</div>\r\n	</div>\r\n	<div class=\"container\">\r\n		<div class=\"row\">\r\n			<div class=\"col-md-2 col-sm-6 col-12\">\r\n				<div class=\"counter-box\">\r\n					<img src=\"images/img/02.png\" /><br />\r\n					<h3 class=\"countup\">\r\n						229</h3>\r\n					<p>\r\n						أبواب المسجد النبوي الداخلية والخارجية</p>\r\n				</div>\r\n			</div>\r\n			<div class=\"col-md-2 col-sm-6 col-12\">\r\n				<div class=\"counter-box\">\r\n					<img src=\"images/img/05.png\" /><br />\r\n					<h3 class=\"countup\">\r\n						196</h3>\r\n					<p>\r\n						قباب المسجد النبوي الثابتة والمتحركة</p>\r\n				</div>\r\n			</div>\r\n			<div class=\"col-md-2 col-sm-6 col-12\">\r\n				<div class=\"counter-box\">\r\n					<img src=\"images/img/06.png\" /><br />\r\n					<h3 class=\"countup\">\r\n						10</h3>\r\n					<p>\r\n						مآذن المسجد النبوي</p>\r\n				</div>\r\n			</div>\r\n			<div class=\"col-md-2 col-sm-6 col-12\">\r\n				<div class=\"counter-box\">\r\n					<img src=\"images/img/03.png\" /><br />\r\n					<h3 class=\"countup\">\r\n						10496</h3>\r\n					<p>\r\n						كراسي المصاحف</p>\r\n				</div>\r\n			</div>\r\n			<div class=\"col-md-2 col-sm-6 col-12\">\r\n				<div class=\"counter-box\">\r\n					<img src=\"images/img/07.png\" /><br />\r\n					<h3 class=\"countup\">\r\n						262</h3>\r\n					<p>\r\n						المظلات فى الساحة والداخل</p>\r\n				</div>\r\n			</div>\r\n			<div class=\"col-md-2 col-sm-6 col-12\">\r\n				<div class=\"counter-box\">\r\n					<img src=\"images/img/01.png\" /><br />\r\n					<h3 class=\"countup\">\r\n						424</h3>\r\n					<p>\r\n						مراوح الرذاذ</p>\r\n				</div>\r\n			</div>\r\n		</div>\r\n	</div>\r\n</div>\r\n<!-- Counters Section END -->', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, '2019-12-19 10:42:01', '2020-04-22 21:24:49'),
(52, 'إصدارات الوكالة', NULL, NULL, 2, NULL, 1, NULL, '<div class=\"section-block\">\r\n	<div class=\"container\">\r\n		<div class=\"section-heading\">\r\n			<h4>\r\n				إصدارات الوكالة</h4>\r\n			<div class=\"section-heading-line-left\">\r\n				&nbsp;</div>\r\n		</div>\r\n		<!-- Tabs Start -->\r\n		<div class=\"big-icon-tabs\">\r\n			<div class=\"tabs tabs_animate mt-50\">\r\n				<ul class=\"tab-menu left-holder\">\r\n					<li class=\"active-tab\">\r\n						<a href=\"#tab-f-1\"><i class=\"icon-briefcase\"></i> الدروس</a></li>\r\n					<li>\r\n						<a href=\"#tab-f-2\"><i class=\"icon-idea-2\"></i> التلاوات</a></li>\r\n					<li>\r\n						<a href=\"#tab-f-3\"><i class=\"icon-network-1\"></i> الخطب</a></li>\r\n					<li>\r\n						<a href=\"#tab-f-3\"><i class=\"icon-manager\"></i> العلماء</a></li>\r\n					<li>\r\n						<a href=\"#icon-time\"><i class=\"icon-time\"></i> مواقيت الصلاة</a></li>\r\n					<li>\r\n						<a href=\"#tab-f-3\"><i class=\"icon-notebook2\"></i> جدول الأئمة</a></li>\r\n					<li>\r\n						<a href=\"#tab-f-3\"><i class=\"icon-note2\"></i> جدول المؤذنين</a></li>\r\n				</ul>\r\n				<!-- Tab 1 Start -->\r\n				<div class=\"clearfix tab-body\" id=\"tab-f-1\" style=\"display: block;\">\r\n<DIV CLASS=\"blog-categories\">\r\n					<ul dir=\"rtl\">\r\n						<li>\r\n							&nbsp;باب السهو من قوله وإن نسي التشهد الأول 23/01/1438هـ</li>\r\n						<li>\r\n							&nbsp;من قوله ومّما يحتجّ به الحلولية مّما يلّبسون به على من لا علم معه25/02/1437هـ</li>\r\n						<li>\r\n							&nbsp;باب قول الله تعالى(ايشركون مالا يخلق شيئا وهم يخلقون)2</li>\r\n						<li>\r\n							&nbsp;باب قول الله تعالى(ايشركون مالا يخلق شيئا وهم يخلقون)ا</li>\r\n						<li>\r\n							&nbsp;باب من الشرك ان يستغيث بغير الله او يدعو غيره2</li>\r\n						<li>\r\n							&nbsp;باب من الشرك ان يستغيث بغير الله او يدعو غيره</li>\r\n						<li>\r\n							&nbsp;باب من الشرك النذر لغير الله2</li>\r\n						<li>\r\n							&nbsp;باب من الشرك النذر لغير الله</li>\r\n					</ul>\r\n				</div></div>\r\n				<!-- Tab 1 End --><!-- Tab 2 Start -->\r\n				<div class=\"clearfix tab-body\" id=\"tab-f-2\" style=\"display: none;\">\r\n					<p>\r\n						&nbsp;</p>\r\n				</div>\r\n				<!-- Tab 2 End --><!-- Tab 3 Start -->\r\n				<div class=\"clearfix tab-body\" id=\"tab-f-3\" style=\"display: none;\">\r\n					<p>\r\n						&nbsp;</p>\r\n				</div>\r\n				<!-- Tab 3 End --><!-- Tab 4 Start -->\r\n				<div class=\"clearfix tab-body\" id=\"tab-f-3\" style=\"display: none;\">\r\n					<p>\r\n						&nbsp;</p>\r\n				</div>\r\n				<!-- Tab 4 End --><!-- Tab 5 Start -->\r\n				<div class=\"clearfix tab-body\" id=\"tab-f-3\" style=\"display: none;\">\r\n					<p>\r\n						&nbsp;</p>\r\n				</div>\r\n				<!-- Tab 5 End --><!-- Tab 6 Start -->\r\n				<div class=\"clearfix tab-body\" id=\"tab-f-3\" style=\"display: none;\">\r\n					<p>\r\n						&nbsp;</p>\r\n				</div>\r\n				<!-- Tab 6 End --><!-- Tab 7 Start -->\r\n				<div class=\"clearfix tab-body\" id=\"tab-f-3\" style=\"display: none;\">\r\n					<p>\r\n						&nbsp;</p>\r\n				</div>\r\n				<!-- Tab 7 End --></div>\r\n		</div>\r\n		<!-- Tabs End --></div>\r\n</div>', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, '2019-12-23 09:50:23', '2020-01-25 15:06:30'),
(53, 'الأدلة الإرشادية', NULL, NULL, 2, NULL, 1, NULL, '<div class=\"section-block-parallax black-overlay-60\" style=\"background-image: url(./images/img/ban_2.jpg);\">\r\n	<div>\r\n		<div class=\"container\">\r\n			<div class=\"row\">\r\n				<div class=\"col-lg-6 col-md-6 col-12\">\r\n					<div class=\"pr-30-md\">\r\n						<div class=\"section-heading mt-30\">\r\n							<h6 class=\"primary-color\">\r\n								معالم المسجد النبوي</h6>\r\n							<h3 class=\"white-color\">\r\n								الأدلة الإرشادية للمسجد النبوي</h3>\r\n							<p>\r\n								الحمد لله رب العالمين وصلى الله وسلم على سيد الأولين والآخرين نبينا محمد وعلى آله وصحبه أجمعين وبعد:<br />\r\n								فمما لا شك فيه أن خدمة ضيوف الرحمن فيها أجر عظيم وفضل كبير, يتنافس عليه الناس قديما وحديثا, وانضماما للركب في خدمة ضيوف المسجد النبوي جاءت هذه الأدلة الإرشادية لتوضح أهم ما يحتاجه الزائر مما يتعلق بالمسجد النبوي وما يحيط به, ليستغني به عن السؤال, ويحفظ له وقته, سائلين المولى - عز وجل - الإخلاص في القول والعمل, إنه سميع مجيب.</p>\r\n						</div>\r\n						<a class=\"primary-button button-md mt-15 mb-30\" href=\"./?page=contact-us\">إتصل بنا</a></div>\r\n				</div>\r\n				<div class=\"col-lg-6 col-md-6 col-12\">\r\n					<div class=\"feature-box-6-icon\">\r\n						<div class=\"row no-gutters\">\r\n							<div class=\"col-lg-6 col-md-6 col-12\">\r\n								<div class=\"feature-box-6-icon-text\" onclick=\"window.open(\'./photos/98998771.jpg\')\">\r\n									<i class=\"icon-map\"></i>\r\n									<h4>\r\n										الدليل الإرشادي للمسجد النبوي</h4>\r\n								</div>\r\n							</div>\r\n							<div class=\"col-lg-6 col-md-6 col-12\">\r\n								<div class=\"feature-box-6-icon-text\" onclick=\"window.open(\'./files/45325407.pdf\')\">\r\n									<i class=\"icon-flag2\"></i>\r\n									<h4>\r\n										الدليل الإرشادي للمنطقة المركزية</h4>\r\n								</div>\r\n							</div>\r\n							<div class=\"col-lg-6 col-md-6 col-12\">\r\n								<div class=\"feature-box-6-icon-text\" onclick=\"window.open(\'./files/75076746.pdf\')\">\r\n									<i class=\"icon-push-pin\"></i>\r\n									<h4>\r\n										الدليل الشامل لزائري المسجد النبوي</h4>\r\n								</div>\r\n							</div>\r\n							<div class=\"col-lg-6 col-md-6 col-12\">\r\n								<div class=\"feature-box-6-icon-text\" onclick=\"window.open(\'./?module=module_658268&amp;gallery=gallery_691644\')\">\r\n									<i class=\"icon-worldwide2\"></i>\r\n									<h4>\r\n										صور وفيديو المسجد النبوي</h4>\r\n								</div>\r\n							</div>\r\n						</div>\r\n					</div>\r\n				</div>\r\n			</div>\r\n		</div>\r\n	</div>\r\n</div>', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, '2019-12-23 11:10:14', '2020-01-28 12:07:10'),
(54, 'خدمات الموظفين', NULL, NULL, 2, NULL, 1, NULL, '<!--Services Section START-->\r\n<div class=\"section-block-bg\" style=\"background-image: url(\'./images/img/1.jpg\')\">\r\n<div class=\"container\">\r\n<div class=\"row\" dir=\"LTR\">\r\n<div class=\"owl-carousel owl-theme mt-25\" id=\"services-carousel-2\">\r\n<div class=\"service-box-car-2\"><a href=\"http://172.20.0.51:7778/forms/frmservlet?config=pr\" target=\"_blank\"><i class=\"icon-group\"></i></a>\r\n<h4>نظام شؤون الموظفين</h4>\r\n<a class=\"primary-button button-md mt-30\" href=\"http://172.20.0.51:7778/forms/frmservlet?config=pr\" target=\"_blank\">الدخول للخدمة</a></div>\r\n\r\n<div class=\"service-box-car-2\"><a href=\"http://172.16.22.71:7778/forms/frmservlet?config=ADM\" target=\"_blank\"><i class=\"icon-manager\"></i></a>\r\n\r\n<h4>نظام اللإتصالات الإدارية</h4>\r\n<a class=\"primary-button button-md mt-30\" href=\"http://172.16.22.71:7778/forms/frmservlet?config=ADM\" target=\"_blank\">الدخول للخدمة</a></div>\r\n\r\n<div class=\"service-box-car-2\"><a href=\"http://twjhsrv:81/tj/index.aspx\" target=\"_blank\"><i class=\"icon-notebook\"></i></a>\r\n\r\n<h4>الخدمات العلمية</h4>\r\n<a class=\"primary-button button-md mt-30\" href=\"http://twjhsrv:81/tj/index.aspx\" target=\"_blank\">الدخول للخدمة</a></div>\r\n\r\n<div class=\"service-box-car-2\"><a href=\"http://twjhsrv:81/tj/Rakmiamain.aspx\" target=\"_blank\"><i class=\"icon-document\"></i></a>\r\n\r\n<h4>المكتبة الرقمية</h4>\r\n<a class=\"primary-button button-md mt-30\" href=\"http://twjhsrv:81/tj/Rakmiamain.aspx\" target=\"_blank\">الدخول للخدمة</a></div>\r\n\r\n<div class=\"owl-item active\" style=\"width: 285px;\"><div class=\"service-box-car-2\"><a href=\"http://gate/portal_new_old/\" target=\"_blank\"><i class=\"icon-group\"></i></a>\r\n<h4>بوابة الموظفين </h4>\r\n<a class=\"primary-button button-md mt-30\" href=\"http://gate/portal_new_old/\" target=\"_blank\">الدخول للخدمة</a></div></div>\r\n\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n<!--Services Section END-->', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, '2019-12-23 11:20:50', '2020-08-30 14:09:37'),
(55, 'خدمات اخري', 0, '', 2, NULL, 1, 0, '<!-- Carousel Start -->\r\n    <div class=\"project-carousel\">\r\n      <h4>Related Projects</h4>\r\n      <div class=\"owl-carousel owl-theme\" id=\"project-single\">\r\n\r\n        <div class=\"project-item\">\r\n          <img src=\"http://via.placeholder.com/360x240\" alt=\"project\">\r\n          <div class=\"project-item-overlay\">\r\n            <div class=\"project-item-content\">\r\n              <span>Business, Consulting</span>\r\n              <h6>Independent contractor</h6>\r\n              <a href=\"#\">View More</a>\r\n            </div>\r\n          </div>\r\n        </div>\r\n\r\n        <div class=\"project-item\">\r\n          <img src=\"http://via.placeholder.com/360x240\" alt=\"project\">\r\n          <div class=\"project-item-overlay\">\r\n            <div class=\"project-item-content\">\r\n              <span>Business, Consulting</span>\r\n              <h6>Finance Consultancy</h6>\r\n              <a href=\"#\">View More</a>\r\n            </div>\r\n          </div>\r\n        </div>\r\n\r\n        <div class=\"project-item\">\r\n          <img src=\"http://via.placeholder.com/360x240\" alt=\"project\">\r\n          <div class=\"project-item-overlay\">\r\n            <div class=\"project-item-content\">\r\n              <span>Business, Consulting</span>\r\n              <h6>Immigration consultant</h6>\r\n              <a href=\"#\">View More</a>\r\n            </div>\r\n          </div>\r\n        </div>\r\n\r\n        <div class=\"project-item\">\r\n          <img src=\"http://via.placeholder.com/360x240\" alt=\"project\">\r\n          <div class=\"project-item-overlay\">\r\n            <div class=\"project-item-content\">\r\n              <span>Business, Consulting</span>\r\n              <h6>Finance Consultancy</h6>\r\n              <a href=\"#\">View More</a>\r\n            </div>\r\n          </div>\r\n        </div>\r\n      </div>\r\n    </div>\r\n    <!-- Carousel End -->', '', '', '', '', 0, NULL, 1, '', NULL, NULL, NULL, '2019-12-23 14:20:54', '0000-00-00 00:00:00'),
(56, 'ايكونات الرئيسية خدمات', NULL, 'plugin_ads.php', 2, NULL, 1, NULL, '<div class=\"section-block\">\r\n<div class=\"container\">\r\n<div class=\"row \">\r\n<div class=\"col-md-4 col-sm-4 col-12\">\r\n<div class=\"feature-box-long  auto-height\"><a href=\"https://eservice.gph.gov.sa/ContactShekh/ContactUs.aspx\"><i class=\"icon-smartphone-1\"></i> </a>\r\n<h3><a href=\"https://eservice.gph.gov.sa/ContactShekh/ContactUs.aspx\">التواصل مع الرئيس </a></h3>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-md-4 col-sm-4 col-12\">\r\n<div class=\"feature-box-long  auto-height\"><a href=\"https://wmn.gov.sa/public/?page=page_752248\"><i class=\"fa fa-users\"></i> </a>\r\n\r\n<h3><a href=\"https://wmn.gov.sa/public/?page=page_752248\">تطبيق زائرينا</a></h3>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-md-4 col-sm-4 col-12\">\r\n<div class=\"feature-box-long  auto-height\"><a href=\"#/\"><i class=\"fa fa-table\"></i> </a>\r\n\r\n<h3><a href=\"https://eservices.wmn.gov.sa/SRV/pry_0013.aspx\">جدول الأئمة والمؤذنين</a></h3>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-md-4 col-sm-4 col-12\">\r\n<div class=\"feature-box-long  auto-height\"><a href=\"https://eservices.wmn.gov.sa/\"><i class=\"icon-networking-1\"></i> </a>\r\n\r\n<h3><a href=\"https://eservices.wmn.gov.sa/\">الخدمات الألكترونية</a></h3>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-md-4 col-sm-4 col-12\">\r\n<div class=\"feature-box-long  auto-height\"><a href=\"https://email.wmn.gov.sa\"><i class=\"icon-mail\"></i> </a>\r\n\r\n<h3><a href=\"https://email.wmn.gov.sa\">البريد الداخلى</a></h3>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-md-4 col-sm-4 col-12\">\r\n<div class=\"feature-box-long  auto-height\"><a href=\"https://manaratalharamain.gov.sa/\"><i class=\"fa fa-flag-o\"></i> </a>\r\n\r\n<h3><a href=\"https://manaratalharamain.gov.sa/\">منارة الحرمين</a></h3>\r\n</div>\r\n</div>\r\n<!--\r\n\r\n			<div class=\"col-md-3 col-sm-3 col-12\">\r\n				<div class=\"feature-box-long  auto-height\">\r\n					<a href=\"http://172.16.22.127/TnA/loginScreen.aspx\"><i class=\"fa fa-hand-pointer-o\"></i> </a>\r\n					<h3>\r\n						<a href=\"http://172.16.22.127/TnA/loginScreen.aspx\">نظام البصمة</a></h3>\r\n				</div>\r\n			</div>\r\n			<div class=\"col-md-4 col-sm-4 col-12\">\r\n				<div class=\"feature-box-long  auto-height\">\r\n					<a href=\"https://eservice.gph.gov.sa/Default.aspx\"><i class=\"fa fa-plane\"></i> </a>\r\n					<h3>\r\n						<a href=\"https://eservice.gph.gov.sa/Default.aspx\">الإيفاد والإبتعاث</a></h3>\r\n				</div>\r\n			</div>\r\n			<div class=\"col-md-3 col-sm-3 col-12\">\r\n				<div class=\"feature-box-long  auto-height\">\r\n					<a href=\"./photos/48186599.jpg\" target=\"_blank\"><i class=\"icon-price-tag\"></i> </a>\r\n					<h3>\r\n						<a href=\"./photos/48186599.jpg\" target=\"_blank\">تخفيضات الموظفين</a></h3>\r\n				</div>\r\n			</div>\r\n--></div>\r\n</div>\r\n</div>', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'adsec', 10, NULL, NULL, '2019-12-24 10:32:41', '2020-10-16 17:27:03'),
(57, 'الفيديو البانورامي - الرئيسية', NULL, NULL, 2, NULL, 1, NULL, '<!-- Video Section START -->\r\n<div class=\"main-video-section\">\r\n<div class=\"video-area\" id=\"video-area\">\r\n<div class=\"player\" data-property=\"{videoURL:\'https://www.youtube.com/watch?v=2361u1WYrYg\', containment:\'#video-area\',  ratio:\'auto\',\r\nshowControls:false, autoPlay:true, zoom:0, loop:true, mute:true, startAt:24,stopAt: 160,\r\nopacity:1, quality:\'hd720\',}\" id=\"main-video-play\"></div>\r\n\r\n<div class=\"main-video-overlay\">\r\n<div class=\"main-video-content\">\r\n<div class=\"container\">\r\n<div class=\"white-color\">\r\n<h3><strong>وكالة الرئاسة العامة لشؤون المسجد النبوي</strong></h3>\r\n\r\n<div class=\"mt-15\">\r\n<h6>أنشئت الرئاسة العامة لشؤون المسجد الحرام والمسجد النبوي عام 1397هـ بموجب المرسوم الملكي رقم أ/265 وتاريخ 6/11/1397هـ وعلى ضوئه تم إنشاء وكالة الرئاسة العامة لشؤون المسجد النبوي للقيام بجميع شؤونه الدينية والخدمية والعمل على توفير كافة الإمكانات لراحة زوار مسجد المصطفى صلى الله عليه وسلم .</h6>\r\n</div>\r\n<a class=\"primary-button button-md mt-30\" href=\"./?page=page_674854\">إقرأ المزيد</a></div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n<!-- Video Section END -->', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, '2019-12-30 11:07:13', '2020-11-25 20:26:51'),
(58, 'الرؤية والرسالة', NULL, NULL, 2, NULL, 1, NULL, '<!-- Feature Boxes Section START -->\r\n<div class=\"section-block\">\r\n	<div class=\"container\">\r\n		<div class=\"section-heading center-holder text-center\">\r\n			<h3>\r\n				الرؤية والرسالة والقيم</h3>\r\n			<div class=\"section-heading-line-center\">\r\n				&nbsp;</div>\r\n		</div>\r\n		<div class=\"row mt-50\">\r\n			<div class=\"col-md-6 col-sm-6 col-12\">\r\n				<div class=\"feature-box-long\">\r\n					<i class=\"icon-visualization\"></i>\r\n					<h3>\r\n						الرؤية</h3>\r\n					<p>\r\n						حسن الوفادة للقاصدين ونشر الهداية للعالمين</p>\r\n				</div>\r\n			</div>\r\n			<div class=\"col-md-6 col-sm-6 col-12\">\r\n				<div class=\"feature-box-long\">\r\n					<i class=\"icon-contract\"></i>\r\n					<h3>\r\n						الرسالة</h3>\r\n					<p>\r\n						تمكين القاصدين من أداء العبادة والمناسك على بصرية في بيئة آمنة طاهرة مثرية ،وتحقيق رسالة الحرمين الشرفين العلمية والدعوية مرتكزين على أسس مهنية واحترافية وكفاءات بشرية مؤهلة وتقنيات متجددة وشراكات فاعلة</p>\r\n				</div>\r\n			</div>\r\n		</div>\r\n	</div>\r\n</div>\r\n<!-- Feature Boxes Section END -->\r\n<div class=\"section-block\">\r\n	<div class=\"container\">\r\n		<!--	<div class=\"section-heading text-center\">\r\n<h3>القيم</h3><div class=\"section-heading-line-center\">&nbsp;</div>\r\n		</div>\r\n -->\r\n		<div class=\"row\">\r\n			<div class=\"col-md-2 col-sm-2 col-12\">\r\n				<div class=\"feature-box-3\">\r\n					<i class=\"icon-diamond\"></i>\r\n					<h4>\r\n						تعظيم الحرمين</h4>\r\n				</div>\r\n			</div>\r\n			<div class=\"col-md-2 col-sm-2 col-12\">\r\n				<div class=\"feature-box-3\">\r\n					<i class=\"icon-team2\"></i>\r\n					<h4>\r\n						تمكين الفريق</h4>\r\n				</div>\r\n			</div>\r\n			<div class=\"col-md-2 col-sm-2 col-12\">\r\n				<div class=\"feature-box-3\">\r\n					<i class=\"icon-teamwork-1\"></i>\r\n					<h4>\r\n						حسن الوفادة</h4>\r\n				</div>\r\n			</div>\r\n			<div class=\"col-md-2 col-sm-2 col-12\">\r\n				<div class=\"feature-box-3\">\r\n					<i class=\"icon-sprout\"></i>\r\n					<h4>\r\n						تبني الإبداع</h4>\r\n				</div>\r\n			</div>\r\n			<div class=\"col-md-2 col-sm-2 col-12\">\r\n				<div class=\"feature-box-3\">\r\n					<i class=\"icon-job\"></i>\r\n					<h4>\r\n						إتقان العمل</h4>\r\n				</div>\r\n			</div>\r\n			<div class=\"col-md-2 col-sm-2 col-12\">\r\n				<div class=\"feature-box-3\">\r\n					<i class=\"icon-care\"></i>\r\n					<h4>\r\n						حب الهداية</h4>\r\n				</div>\r\n			</div>\r\n		</div>\r\n	</div>\r\n</div>', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, '2020-01-29 11:57:02', '2020-02-13 08:59:37'),
(59, 'ارقام التواصل لصفحة اتصل بنا', NULL, NULL, 2, NULL, 1, NULL, '<!-- Contact Boxes START -->\r\n<div class=\"section-block-grey\">\r\n	<div class=\"container\">\r\n		<div class=\"row\">\r\n			<div class=\"col-md-3 col-sm-6 col-12\">\r\n				<div class=\"contact-box\">\r\n					<i class=\"fa fa-phone-square\"></i>\r\n					<h4>\r\n						إتصل بنا</h4>\r\n					<span>1966</span><br />\r\n					<span dir=\"ltr\">(+966) 8254241</span><br />\r\n					<span dir=\"ltr\">(+966) 0148233610</span></div>\r\n			</div>\r\n			<div class=\"col-md-3 col-sm-6 col-12\">\r\n				<div class=\"contact-box\">\r\n					<i class=\"fa fa-map\"></i>\r\n					<h4>\r\n						تفضل بزيارتنا</h4>\r\n					<span>المدينة المنورة , شار ع السلام ,<br />\r\n					وكالة الرئاسة العامة لشؤون<br />\r\n					المسجد النبوي</span></div>\r\n			</div>\r\n			<div class=\"col-md-3 col-sm-6 col-12\">\r\n				<div class=\"contact-box\">\r\n					<i class=\"fa fa-envelope\"></i>\r\n					<h4>\r\n						راسلنا</h4>\r\n					<span>wmn@wmn.gov.sa</span></div>\r\n			</div>\r\n			<div class=\"col-md-3 col-sm-6 col-12\">\r\n				<div class=\"contact-box\">\r\n					<i class=\"fa fa-clock-o\"></i>\r\n					<h4>\r\n						أوقات الدوام</h4>\r\n					<span>من 7:30ص إلى 2:30م<br />\r\n					من الأحد إلى الخميس</span></div>\r\n			</div>\r\n		</div>\r\n	</div>\r\n</div>\r\n<!-- Contact Boxes END -->', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, '2020-01-30 08:46:32', '2020-01-30 10:35:23'),
(60, 'عنوان المدرسة على خريطة جوجل', NULL, NULL, 2, NULL, 1, NULL, '<p><iframe allowfullscreen=\"\" aria-hidden=\"false\" frameborder=\"0\" height=\"450\" scrolling=\"no\" src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3714.5965099872737!2d39.71530281540619!3d21.405786380174902!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x15c219ebb416418f%3A0x4cf6f8d7987b681f!2sAbdulrahman%20Fakieh%20Schools!5e0!3m2!1sen!2ssa!4v1607224016864!5m2!1sen!2ssa\" style=\"border:0;\" tabindex=\"0\" width=\"100%\"></iframe></p>', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, '2020-01-30 10:30:58', '2020-12-06 06:07:40'),
(62, 'تغريدات المدرسة', NULL, NULL, 2, NULL, 1, 1, '<a class=\"twitter-timeline\" data-height=\"600\"  href=\"https://twitter.com/fakiehschools?ref_src=twsrc%5Etfw\">التغريدات بواسطة مدارس عبدالرحمن فقية</a> <script async src=\"https://platform.twitter.com/widgets.js\" charset=\"utf-8\"></script>', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, '2020-06-15 13:56:03', '2020-12-06 06:05:01'),
(63, 'HOME VIDEO', NULL, NULL, 1, NULL, 1, NULL, '<!-- Video Section START -->\r\n<div class=\"main-video-section\">\r\n<div class=\"video-area\" id=\"video-area\">\r\n<div class=\"player\" data-property=\"{videoURL:\'https://www.youtube.com/watch?v=tPuTslmInew\', containment:\'#video-area\',  ratio:\'auto\',\r\nshowControls:false, autoPlay:true, zoom:0, loop:true, mute:true, startAt:24,stopAt: 160,\r\nopacity:1, quality:\'low\',}\" id=\"main-video-play\">&nbsp;</div>\r\n\r\n<div class=\"main-video-overlay\">\r\n<div class=\"main-video-content\">\r\n<div class=\"container\">\r\n<div class=\"white-color\">\r\n<h3><strong>General Presidency for the Prophet’s Mosque Affairs</strong></h3>\r\n\r\n<div class=\"mt-15\">\r\n<h6>The General Presidency for the affairs of the Grand Mosque and the Prophet’s Mosque was established in 1397 AH by Royal Decree No. A / 265 dated 6/11/1397 AH. In light of this, the General Presidency of the Prophet’s Mosque Affairs was established to carry out all its religious and service affairs and work to provide all capabilities for the comfort of the visitors of the Mustafa’s Mosque, may God bless him Him.</h6>\r\n</div>\r\n<a class=\"primary-button button-md mt-30\" href=\"./\">Read More..</a></div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n<!-- Video Section END -->', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, '2020-07-26 13:04:30', '2020-07-26 13:06:53'),
(65, 'الرؤية والرسالة', NULL, NULL, 1, NULL, 1, NULL, 'الرؤية والرسالة\r\n\r\n\r\n\r\n\r\n<!-- Feature Boxes Section START -->\r\n<div class=\"section-block\">\r\n<div class=\"container\">\r\n<div class=\"section-heading center-holder text-center\">\r\n<h3>الرؤية والرسالة والقيم</h3>\r\n\r\n<div class=\"section-heading-line-center\">&nbsp;</div>\r\n</div>\r\n\r\n<div class=\"row mt-50\">\r\n<div class=\"col-md-6 col-sm-6 col-12\">\r\n<div class=\"feature-box-long\"><i class=\"icon-visualization\"></i>\r\n\r\n<h3>الرؤية</h3>\r\n\r\n<p>حسن الوفادة للقاصدين ونشر الهداية للعالمين</p>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-md-6 col-sm-6 col-12\">\r\n<div class=\"feature-box-long\"><i class=\"icon-contract\"></i>\r\n\r\n<h3>الرسالة</h3>\r\n\r\n<p>تمكين القاصدين من أداء العبادة والمناسك على بصرية في بيئة آمنة طاهرة مثرية ،وتحقيق رسالة الحرمين الشرفين العلمية والدعوية مرتكزين على أسس مهنية واحترافية وكفاءات بشرية مؤهلة وتقنيات متجددة وشراكات فاعلة</p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n<!-- Feature Boxes Section END -->\r\n\r\n<div class=\"section-block\">\r\n<div class=\"container\"><!--	<div class=\"section-heading text-center\">\r\n<h3>القيم</h3><div class=\"section-heading-line-center\"> </div>\r\n		</div>\r\n -->\r\n<div class=\"row\">\r\n<div class=\"col-md-2 col-sm-2 col-12\">\r\n<div class=\"feature-box-3\"><i class=\"icon-diamond\"></i>\r\n\r\n<h4>تعظيم الحرمين</h4>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-md-2 col-sm-2 col-12\">\r\n<div class=\"feature-box-3\"><i class=\"icon-team2\"></i>\r\n\r\n<h4>تمكين الفريق</h4>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-md-2 col-sm-2 col-12\">\r\n<div class=\"feature-box-3\"><i class=\"icon-teamwork-1\"></i>\r\n\r\n<h4>حسن الوفادة</h4>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-md-2 col-sm-2 col-12\">\r\n<div class=\"feature-box-3\"><i class=\"icon-sprout\"></i>\r\n\r\n<h4>تبني الإبداع</h4>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-md-2 col-sm-2 col-12\">\r\n<div class=\"feature-box-3\"><i class=\"icon-job\"></i>\r\n\r\n<h4>إتقان العمل</h4>\r\n</div>\r\n</div>\r\n\r\n<div class=\"col-md-2 col-sm-2 col-12\">\r\n<div class=\"feature-box-3\"><i class=\"icon-care\"></i>\r\n\r\n<h4>حب الهداية</h4>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, '2020-10-25 11:37:09', NULL),
(66, 'أخر الأخبار', 1, 'plugin_latest_news.php', 2, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'mains', NULL, NULL, 12, '2020-11-26 08:14:59', '2020-11-26 08:15:59');

--
-- Triggers `plugins`
--
DELIMITER $$
CREATE TRIGGER `plugins_AFTER_DELETE` AFTER DELETE ON `plugins` FOR EACH ROW BEGIN
DELETE FROM `translator` where parent_id = OLD.id and item_type='plugin';
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `push_tokens`
--

CREATE TABLE `push_tokens` (
  `id` int(11) NOT NULL,
  `token_id` varchar(255) COLLATE utf8_bin NOT NULL,
  `device` int(1) NOT NULL COMMENT '1:ios - 2:android',
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `push_tokens`
--

INSERT INTO `push_tokens` (`id`, `token_id`, `device`, `created`) VALUES
(1, 'NGEwMGZmMjItY2NkNy0xMWUzLTk5ZDUtMDAwYzI5NDBlNjJj', 1, '2018-11-19 22:47:44'),
(2, 'NGEwMGZmMjItY2NkNy0xMWUzLTk5ZDUtMDAwYzI5NDBlNjJj', 1, '2018-11-19 22:50:24'),
(3, 'NGEwMGZmMjItY2NkNy0xMWUzLTk5ZDUtMDAwYzI5NDBlNjJj', 1, '2018-11-19 22:51:16'),
(4, 'NGEwMGZmMjItY2NkNy0xMWUzLTk5ZDUtMDAwYzI5NDBlNjJj', 1, '2018-11-19 23:31:53');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `site_id` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `title`, `site_id`) VALUES
(7, 'Developer', 1),
(8, 'SuperAdmin', 1),
(11, 'AdminEN', 2);

-- --------------------------------------------------------

--
-- Table structure for table `role_per`
--

CREATE TABLE `role_per` (
  `roles_id` int(11) NOT NULL DEFAULT 0,
  `pers_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role_per`
--

INSERT INTO `role_per` (`roles_id`, `pers_id`) VALUES
(7, 2),
(7, 3),
(7, 4),
(7, 5),
(7, 7),
(7, 8),
(7, 9),
(7, 10),
(7, 12),
(7, 13),
(7, 14),
(7, 15),
(7, 16),
(7, 17),
(7, 18),
(7, 19),
(7, 20),
(7, 21),
(7, 23),
(7, 24),
(7, 25),
(7, 26),
(7, 27),
(7, 28),
(7, 30),
(7, 35),
(7, 43),
(7, 44),
(7, 45),
(7, 46),
(7, 47),
(7, 48),
(7, 88),
(7, 101),
(7, 102),
(7, 103),
(7, 104),
(7, 105),
(7, 106),
(7, 107),
(7, 108),
(7, 117),
(7, 118),
(7, 119),
(7, 120),
(7, 121),
(7, 122),
(7, 123),
(7, 124),
(7, 125),
(7, 126),
(7, 127),
(7, 128),
(7, 129),
(7, 144),
(7, 145),
(7, 146),
(7, 147),
(7, 148),
(7, 149),
(7, 150),
(7, 151),
(7, 152),
(7, 153),
(7, 154),
(7, 155),
(7, 156),
(7, 157),
(7, 158),
(7, 159),
(7, 160),
(7, 162),
(7, 163),
(7, 164),
(7, 165),
(7, 166),
(7, 167),
(7, 168),
(7, 177),
(7, 178),
(7, 179),
(7, 180),
(7, 181),
(7, 182),
(7, 183),
(7, 184),
(7, 185),
(7, 186),
(7, 187),
(7, 188),
(7, 189),
(7, 190),
(7, 191),
(7, 192),
(7, 193),
(7, 194),
(7, 195),
(7, 196),
(7, 197),
(7, 198),
(7, 199),
(7, 200),
(7, 201),
(7, 202),
(7, 203),
(7, 204),
(7, 205),
(7, 206),
(7, 207),
(7, 208),
(7, 209),
(7, 210),
(7, 211),
(7, 212),
(7, 213),
(7, 214),
(7, 215),
(7, 216),
(7, 217),
(7, 218),
(7, 219),
(7, 227),
(7, 228),
(7, 229),
(7, 230),
(7, 231),
(7, 232),
(7, 233),
(7, 234),
(7, 235),
(7, 236),
(7, 237),
(7, 238),
(7, 239),
(7, 240),
(7, 241),
(7, 270),
(7, 271),
(7, 272),
(7, 273),
(7, 274),
(7, 277),
(7, 278),
(7, 279),
(7, 280),
(7, 281),
(7, 282),
(7, 283),
(7, 284),
(7, 285),
(7, 286),
(7, 287),
(7, 288),
(7, 289),
(7, 290),
(7, 291),
(7, 292),
(7, 293),
(7, 294),
(7, 295),
(7, 296),
(7, 297),
(7, 298),
(7, 299),
(7, 300),
(7, 301),
(7, 302),
(7, 303),
(7, 304),
(7, 305),
(7, 306),
(7, 307),
(7, 308),
(7, 309),
(7, 310),
(7, 311),
(7, 312),
(7, 313),
(8, 5),
(8, 7),
(8, 8),
(8, 9),
(8, 10),
(8, 12),
(8, 17),
(8, 18),
(8, 20),
(8, 21),
(8, 23),
(8, 24),
(8, 25),
(8, 26),
(8, 28),
(8, 43),
(8, 44),
(8, 101),
(8, 102),
(8, 103),
(8, 104),
(8, 105),
(8, 106),
(8, 107),
(8, 118),
(8, 120),
(8, 122),
(8, 123),
(8, 124),
(8, 125),
(8, 126),
(8, 127),
(8, 128),
(8, 129),
(8, 144),
(8, 145),
(8, 162),
(8, 163),
(8, 164),
(8, 165),
(8, 166),
(8, 167),
(8, 168),
(8, 187),
(8, 189),
(8, 191),
(8, 195),
(8, 197),
(8, 198),
(8, 200),
(8, 201),
(8, 202),
(8, 203),
(8, 204),
(8, 205),
(8, 206),
(8, 207),
(8, 208),
(8, 209),
(8, 210),
(8, 211),
(8, 212),
(8, 213),
(8, 214),
(8, 215),
(8, 216),
(8, 217),
(8, 218),
(8, 227),
(8, 228),
(8, 229),
(8, 230),
(8, 231),
(8, 232),
(8, 233),
(8, 234),
(8, 235),
(8, 236),
(8, 237),
(8, 238),
(8, 239),
(8, 270),
(8, 271),
(8, 273),
(8, 274),
(8, 280),
(8, 294),
(8, 295),
(8, 296),
(8, 297),
(8, 298),
(8, 299),
(8, 300),
(8, 301),
(8, 303),
(8, 306),
(8, 307),
(8, 308),
(8, 309),
(8, 310),
(11, 4),
(11, 8),
(11, 17),
(11, 18),
(11, 19),
(11, 20),
(11, 25),
(11, 26),
(11, 28),
(11, 101),
(11, 102),
(11, 103),
(11, 104),
(11, 105),
(11, 106),
(11, 108),
(11, 118),
(11, 120),
(11, 123),
(11, 124),
(11, 125),
(11, 126),
(11, 127),
(11, 128),
(11, 144),
(11, 162),
(11, 163),
(11, 164),
(11, 165),
(11, 166),
(11, 167),
(11, 187),
(11, 189),
(11, 195),
(11, 197),
(11, 200),
(11, 201),
(11, 202),
(11, 203),
(11, 204),
(11, 205),
(11, 207),
(11, 208),
(11, 209),
(11, 210),
(11, 211),
(11, 213),
(11, 214),
(11, 215),
(11, 216),
(11, 217),
(11, 227),
(11, 270),
(11, 271),
(11, 272),
(11, 273),
(11, 274),
(11, 311),
(11, 312),
(11, 313);

-- --------------------------------------------------------

--
-- Stand-in structure for view `search_pages`
-- (See below for the actual view)
--
CREATE TABLE `search_pages` (
`page_title` varchar(255)
,`page_url_alias` varchar(255)
,`part_title` varchar(255)
,`part_content` longtext
,`part_id` int(11)
,`page_publish` int(1)
,`part_publish` int(1)
,`description` mediumtext
,`keywords` mediumtext
,`page_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `search_view`
-- (See below for the actual view)
--
CREATE TABLE `search_view` (
`id` int(11)
,`title` varchar(255)
,`url_alias` varchar(255)
,`lang_id` int(11)
,`keywords` longtext
,`description` longtext
,`content` longtext
,`trans_title` longtext
,`trans_content` longtext
,`trans_title_lang_id` int(11)
,`trans_content_lang_id` int(11)
,`trans_keywords` longtext
,`trans_description` longtext
,`item_type` varchar(7)
,`site_id` int(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `site_config`
--

CREATE TABLE `site_config` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `offline` int(1) DEFAULT NULL,
  `offline_msg` mediumtext DEFAULT NULL,
  `seo` int(1) DEFAULT NULL,
  `paging` int(4) DEFAULT NULL,
  `show_lang` int(1) DEFAULT NULL,
  `google_analytics` mediumtext DEFAULT NULL,
  `keywords` mediumtext DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `copyrights` varchar(255) DEFAULT NULL,
  `backgrounds` varchar(255) DEFAULT NULL,
  `lang_id` int(11) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `flickr` varchar(255) DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `counter` int(11) DEFAULT NULL,
  `domain` varchar(255) DEFAULT NULL,
  `url_alias` varchar(255) DEFAULT NULL,
  `show_sites` int(1) DEFAULT 0,
  `google_plus` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `linkedin` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `publish` int(1) DEFAULT 1,
  `logo_path` int(11) DEFAULT NULL,
  `slogan_path` int(11) DEFAULT NULL,
  `elearning_link` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `school_dues_link` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `registration_link` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `jobs_link` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `live_broadcast_link` varchar(255) DEFAULT NULL,
  `default_site` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `site_config`
--

INSERT INTO `site_config` (`id`, `title`, `email`, `offline`, `offline_msg`, `seo`, `paging`, `show_lang`, `google_analytics`, `keywords`, `description`, `copyrights`, `backgrounds`, `lang_id`, `facebook`, `twitter`, `youtube`, `flickr`, `updated`, `phone`, `address`, `counter`, `domain`, `url_alias`, `show_sites`, `google_plus`, `linkedin`, `publish`, `logo_path`, `slogan_path`, `elearning_link`, `school_dues_link`, `registration_link`, `jobs_link`, `live_broadcast_link`, `default_site`) VALUES
(1, 'مدارس عبدالرحمن فقيه النموذجية للبنين', 'info@afsch.edu.sa', NULL, '<div class=\"count-back-box\" style=\"background-image: url(./images/img/14.jpg);\">\r\n<div class=\"container\">\r\n<div class=\"row\"><!-- Cogs START -->\r\n<div class=\"construction-box\">\r\n<div class=\"construction-icons\"><i class=\"icon-settings\" id=\"cons-icon-1\"></i> <i class=\"icon-settings\" id=\"cons-icon-2\"></i></div>\r\n</div>\r\n<!-- Cogs END -->\r\n\r\n<div class=\"wrapper\">\r\n<div class=\"clock\" style=\"display: none;\">\r\n<div class=\"column days mr-20-md\">\r\n<div class=\"timer\" id=\"days\">15</div>\r\n\r\n<h5>يوم</h5>\r\n</div>\r\n\r\n<div class=\"column\">\r\n<div class=\"timer\" id=\"hours\">10</div>\r\n\r\n<h5>ساعة</h5>\r\n</div>\r\n\r\n<div class=\"timer\">:</div>\r\n\r\n<div class=\"column\">\r\n<div class=\"timer\" id=\"minutes\">5</div>\r\n\r\n<h5>دقيقة</h5>\r\n</div>\r\n\r\n<div class=\"timer\">:</div>\r\n\r\n<div class=\"column\">\r\n<div class=\"timer\" id=\"seconds\">10</div>\r\n\r\n<h5>ثانية</h5>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div class=\"count-back-box-text\">\r\n<h3>الموقع تحت الصيانة</h3>\r\n\r\n<h6>عزيزي الزائر نعتذر منك, نقوم ببعض التطويرات على الموقع وسيتم فتحه قريبا</h6>\r\n</div>\r\n</div>\r\n</div>\r\n</div>', 1, 30, NULL, NULL, 'الموقع الرسمي لمدارس عبدالرحمن فقيه النموذجية للبنين -  مكة المكرمة - المملكة العربية السعودية', 'الموقع الرسمي لمدارس عبدالرحمن فقيه النموذجية للبنين -  مكة المكرمة - المملكة العربية السعودية', 'جميع الحقوق مدارس عبدالرحمن فقيه النموذجية  ©  2020', 'BG3.jpg', 2, 'https://www.facebook.com/Fakiehschool', 'https://twitter.com/fakiehschools', 'https://www.youtube.com/channel/UC_FOf9Xk78RGa_1W7GAnSiQ', 'https://www.instagram.com/fakieh.schools/', '2020-11-25 23:14:26', 'ت 035804952 - فاكس 035885081 -  جوال 0534147939', 'المملكة العربية السعودية, مكة المكرمة', 11, NULL, 'wmn', NULL, 'https://twitter.com/fakeh2030', 'https://twitter.com/FakiehNe', 1, 1170, 1171, 'https://school.future-vision.sch.sa', 'https://future-vision.sch.sa/public/?page=page_84352&mobile=1', 'https://future-vision.sch.sa/public/?page=page_860906&mobile=1', 'https://future-vision.sch.sa/public/?page=page_477297&mobile=1', 'https://future-vision.sch.sa/public/?page=live_broadcast&mobile=1', 1),
(2, 'The agency of the general presidency for the affair of the prophet\'s mosque', 'wmn@wmn.gov.sa', NULL, NULL, 1, 30, NULL, NULL, NULL, NULL, 'All rights reserved WMN ©  2020', 'BG3.jpg', 1, 'https://ar-ar.facebook.com/wmngovsa', 'https://twitter.com/wmngovsa?lang=ar', 'https://www.youtube.com/user/wmngovsa', 'https://www.instagram.com/wmngovsa', '2020-08-11 12:04:30', 'Tele 035804952 - Fax 035885081 - Mobile 0534147939', NULL, 10, NULL, 'en', 1, NULL, NULL, 1, 1058, 1059, NULL, NULL, NULL, NULL, NULL, 0);

--
-- Triggers `site_config`
--
DELIMITER $$
CREATE TRIGGER `site_config_AFTER_DELETE` AFTER DELETE ON `site_config` FOR EACH ROW BEGIN
DELETE FROM `translator` where parent_id = OLD.id and item_type='config';
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `url_alias` varchar(255) DEFAULT NULL,
  `lang_id` int(11) DEFAULT NULL,
  `sort_id` int(11) DEFAULT NULL,
  `main_id` int(11) DEFAULT NULL,
  `photo` int(11) DEFAULT NULL,
  `subject_date` datetime DEFAULT NULL,
  `show_date` int(1) DEFAULT NULL,
  `content_short` mediumtext DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `keywords` mediumtext DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `fbcomment` int(1) DEFAULT NULL,
  `publish` int(1) DEFAULT NULL,
  `counter` int(11) DEFAULT 0,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Triggers `subjects`
--
DELIMITER $$
CREATE TRIGGER `subjects_AFTER_DELETE` AFTER DELETE ON `subjects` FOR EACH ROW BEGIN
DELETE FROM `translator` where parent_id = OLD.id and item_type='subject';
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

CREATE TABLE `subscription` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `account_type` int(1) DEFAULT NULL,
  `gender` int(1) DEFAULT NULL,
  `birth_date` varchar(50) DEFAULT NULL,
  `profession` varchar(255) DEFAULT NULL,
  `nationality` varchar(255) DEFAULT NULL,
  `tel` varchar(50) DEFAULT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `program` varchar(255) DEFAULT NULL,
  `interests` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `translator`
--

CREATE TABLE `translator` (
  `id` int(11) NOT NULL,
  `lang_id` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `item_type` varchar(50) DEFAULT NULL,
  `field_type` varchar(255) DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `translator`
--

INSERT INTO `translator` (`id`, `lang_id`, `parent_id`, `item_type`, `field_type`, `content`, `created`, `updated`) VALUES
(1, 1, 40, 'menu', 'title', 'Menus', '2016-02-21 12:30:12', '0000-00-00 00:00:00'),
(2, 1, 41, 'menu', 'title', 'Front-End Menu', '2016-02-21 12:30:21', '2016-02-21 12:30:46'),
(3, 1, 42, 'menu', 'title', 'Admin Menu', '2016-02-21 12:31:16', '0000-00-00 00:00:00'),
(4, 1, 43, 'menu', 'title', 'Layout', '2016-02-21 12:31:28', '0000-00-00 00:00:00'),
(5, 1, 44, 'menu', 'title', 'Pages', '2016-02-21 12:31:36', '0000-00-00 00:00:00'),
(8, 1, 47, 'menu', 'title', 'Modules', '2016-02-21 12:32:27', '0000-00-00 00:00:00'),
(9, 1, 48, 'menu', 'title', 'Plugins', '2016-02-21 12:32:39', '0000-00-00 00:00:00'),
(10, 1, 49, 'menu', 'title', 'Files Manager', '2016-02-21 12:32:58', '0000-00-00 00:00:00'),
(11, 1, 50, 'menu', 'title', 'Photos', '2016-02-21 12:33:08', '0000-00-00 00:00:00'),
(12, 1, 51, 'menu', 'title', 'Files', '2016-02-21 12:33:13', '0000-00-00 00:00:00'),
(13, 1, 52, 'menu', 'title', 'Server Files', '2016-02-21 12:33:25', '0000-00-00 00:00:00'),
(14, 1, 53, 'menu', 'title', 'Site Content', '2016-02-21 12:33:42', '0000-00-00 00:00:00'),
(15, 1, 54, 'menu', 'title', 'Ad Sections', '2016-02-21 12:33:59', '0000-00-00 00:00:00'),
(17, 1, 56, 'menu', 'title', 'Main Sections', '2016-02-21 12:34:17', '0000-00-00 00:00:00'),
(18, 1, 57, 'menu', 'title', 'Subjects', '2016-02-21 12:34:25', '0000-00-00 00:00:00'),
(19, 1, 58, 'menu', 'title', 'Galleries', '2016-02-21 12:34:32', '0000-00-00 00:00:00'),
(21, 1, 60, 'menu', 'title', 'Mail list Groups', '2016-02-21 12:35:01', '0000-00-00 00:00:00'),
(22, 1, 61, 'menu', 'title', 'Email Manager', '2016-02-21 12:35:10', '0000-00-00 00:00:00'),
(23, 1, 62, 'menu', 'title', 'Send Newsletter', '2016-02-21 12:35:26', '0000-00-00 00:00:00'),
(24, 1, 63, 'menu', 'title', 'Subscriptions', '2016-02-21 12:35:37', '0000-00-00 00:00:00'),
(25, 1, 64, 'menu', 'title', 'Administration', '2016-02-21 12:35:51', '0000-00-00 00:00:00'),
(26, 1, 65, 'menu', 'title', 'Site Configuration', '2016-02-21 12:36:13', '0000-00-00 00:00:00'),
(27, 1, 66, 'menu', 'title', 'Users', '2016-02-21 12:36:24', '0000-00-00 00:00:00'),
(28, 1, 67, 'menu', 'title', 'Roles', '2016-02-21 12:36:31', '0000-00-00 00:00:00'),
(29, 1, 68, 'menu', 'title', 'Permission Sections', '2016-02-21 12:36:41', '0000-00-00 00:00:00'),
(30, 1, 69, 'menu', 'title', 'Permissions', '2016-02-21 12:36:52', '2016-02-21 12:37:22'),
(31, 1, 70, 'menu', 'title', 'Languages', '2016-02-21 12:37:51', '2018-08-09 00:00:00'),
(32, 1, 71, 'menu', 'title', 'Log File', '2016-02-21 12:38:00', '0000-00-00 00:00:00'),
(52, 1, 114, 'menu', 'title', 'Home', '2016-07-26 10:29:39', '2016-07-26 10:29:44'),
(58, 1, 324, 'menu', 'title', 'أكاديمية التدريب والتأهيل', '2018-03-19 08:09:41', '0000-00-00 00:00:00'),
(67, 1, 157, 'menu', 'title', 'About us', '2018-09-12 00:07:45', '0000-00-00 00:00:00'),
(68, 1, 158, 'menu', 'title', 'Our Services', '2018-09-12 00:08:10', '0000-00-00 00:00:00'),
(69, 1, 159, 'menu', 'title', 'E-Services', '2018-09-12 00:08:23', '0000-00-00 00:00:00'),
(70, 1, 160, 'menu', 'title', 'Apply Application', '2018-09-12 00:08:43', '0000-00-00 00:00:00'),
(71, 1, 161, 'menu', 'title', 'Update Information', '2018-09-12 00:08:57', '0000-00-00 00:00:00'),
(73, 1, 163, 'menu', 'title', 'Investments', '2018-09-12 00:09:17', '0000-00-00 00:00:00'),
(74, 1, 164, 'menu', 'title', 'Studies', '2018-09-12 00:09:49', '0000-00-00 00:00:00'),
(75, 1, 165, 'menu', 'title', 'Company', '2018-09-12 00:10:04', '0000-00-00 00:00:00'),
(76, 1, 166, 'menu', 'title', 'Control Panel', '2018-09-12 00:10:18', '0000-00-00 00:00:00'),
(77, 1, 167, 'menu', 'title', 'Reports', '2018-09-12 00:10:25', '0000-00-00 00:00:00'),
(78, 1, 168, 'menu', 'title', 'Following up projects', '2018-09-12 00:10:46', '0000-00-00 00:00:00'),
(79, 1, 169, 'menu', 'title', 'Direct Camera', '2018-09-12 00:10:58', '0000-00-00 00:00:00'),
(80, 1, 170, 'menu', 'title', 'E-Marketing', '2018-09-12 00:11:12', '0000-00-00 00:00:00'),
(83, 1, 182, 'menu', 'title', 'Offers', '2018-09-12 00:12:36', '0000-00-00 00:00:00'),
(88, 1, 175, 'menu', 'title', 'Board of Directors', '2018-09-12 00:14:09', '0000-00-00 00:00:00'),
(89, 1, 176, 'menu', 'title', 'Company Structure', '2018-09-12 00:14:29', '0000-00-00 00:00:00'),
(90, 1, 177, 'menu', 'title', 'Certificates and licenses', '2018-09-12 00:14:43', '0000-00-00 00:00:00'),
(91, 1, 178, 'menu', 'title', 'Company Future', '2018-09-12 00:14:59', '2018-09-12 00:15:23'),
(92, 1, 179, 'menu', 'title', 'Trade Marks', '2018-09-12 00:15:37', '0000-00-00 00:00:00'),
(93, 1, 180, 'menu', 'title', 'Jobs', '2018-09-12 00:15:46', '0000-00-00 00:00:00'),
(174, 1, 95, 'menu', 'title', 'Vote Management', '2018-09-12 00:24:53', '2018-09-12 00:25:17'),
(175, 1, 98, 'menu', 'title', 'Event Management', '2018-09-12 00:25:34', '0000-00-00 00:00:00'),
(176, 1, 99, 'menu', 'title', 'Add Event', '2018-09-12 00:25:51', '0000-00-00 00:00:00'),
(177, 1, 100, 'menu', 'title', 'Event Settings', '2018-09-12 00:26:03', '0000-00-00 00:00:00'),
(178, 1, 96, 'menu', 'title', 'Question Management', '2018-09-12 00:26:37', '0000-00-00 00:00:00'),
(179, 1, 97, 'menu', 'title', 'Answers Management', '2018-09-12 00:26:46', '0000-00-00 00:00:00'),
(181, 1, 277, 'menu', 'title', 'List of pages', '2019-02-22 05:16:59', '0000-00-00 00:00:00'),
(182, 1, 274, 'menu', 'title', 'Mailing list groups', '2019-02-22 05:17:38', '0000-00-00 00:00:00'),
(183, 1, 273, 'menu', 'title', 'Users and Permissions', '2019-02-22 05:18:07', '0000-00-00 00:00:00'),
(184, 1, 268, 'menu', 'title', 'Admission requests', '2019-02-22 05:18:58', '0000-00-00 00:00:00'),
(185, 1, 269, 'menu', 'title', 'Career requests', '2019-02-22 05:19:18', '0000-00-00 00:00:00'),
(186, 1, 275, 'menu', 'title', 'List of votes', '2019-02-22 05:19:38', '0000-00-00 00:00:00'),
(187, 1, 278, 'menu', 'title', 'List of categories', '2019-02-22 05:20:24', '2019-02-22 05:20:39'),
(188, 1, 279, 'menu', 'title', 'Permission sections', '2019-02-22 05:21:03', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `active_key` varchar(50) DEFAULT NULL,
  `active_valid` int(1) DEFAULT NULL,
  `publish` int(1) DEFAULT NULL,
  `is_locked` int(1) DEFAULT 0,
  `login_fail_count` int(1) DEFAULT NULL,
  `lock_start_timestamp` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `lang_id` int(11) DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `role_id`, `active_key`, `active_valid`, `publish`, `is_locked`, `login_fail_count`, `lock_start_timestamp`, `created`, `updated`, `lang_id`) VALUES
(13, 'montaserelsawy', '6edfb20604896b5ab51f3bbcbe04a49d', 'montaserelsawy@gmail.com', 7, '0', 1, 1, 0, 0, NULL, '2013-07-03 13:30:03', '2020-05-13 09:55:52', 2),
(14, 'admin', '7f2880c159f890ded55ef4b04b4403b6', 'info@wmn.gov.sa', 8, '0', 1, 1, 0, 0, NULL, '2018-12-15 00:29:30', '2020-02-23 14:04:24', 2);

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `id` int(11) NOT NULL,
  `question_id` int(11) DEFAULT NULL,
  `answer_id` int(11) DEFAULT NULL,
  `ip_address` varchar(50) DEFAULT NULL,
  `created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `vote_answers`
--

CREATE TABLE `vote_answers` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `question_id` int(11) DEFAULT NULL,
  `counter` int(11) DEFAULT NULL,
  `sort_id` int(11) DEFAULT NULL,
  `publish` int(1) DEFAULT NULL,
  `lang_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `vote_questions`
--

CREATE TABLE `vote_questions` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `lang_id` int(11) DEFAULT NULL,
  `publish` int(1) DEFAULT NULL,
  `site_id` int(11) DEFAULT 1,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure for view `search_pages`
--
DROP TABLE IF EXISTS `search_pages`;

CREATE  VIEW `search_pages`  AS  select distinct `pages`.`title` AS `page_title`,`pages`.`url_alias` AS `page_url_alias`,`parts`.`title` AS `part_title`,`parts`.`content` AS `part_content`,`parts`.`id` AS `part_id`,`pages`.`publish` AS `page_publish`,`parts`.`publish` AS `part_publish`,`pages`.`description` AS `description`,`pages`.`keywords` AS `keywords`,`pages`.`id` AS `page_id` from (`pages` join `parts`) where `pages`.`id` = `parts`.`page_id` and `pages`.`publish` = '1' and `parts`.`publish` = '1' ;

-- --------------------------------------------------------

--
-- Structure for view `search_view`
--
DROP TABLE IF EXISTS `search_view`;

CREATE  VIEW `search_view`  AS  select `pg`.`id` AS `id`,`pg`.`title` AS `title`,`pg`.`url_alias` AS `url_alias`,`pg`.`lang_id` AS `lang_id`,`pg`.`keywords` AS `keywords`,`pg`.`description` AS `description`,(select `prt`.`content` from `parts` `prt` where `prt`.`page_id` = `pg`.`id` and `prt`.`publish` = 1 order by `prt`.`id` limit 1) AS `content`,(select `trn`.`content` from `translator` `trn` where `trn`.`item_type` = 'page' and `pg`.`id` = `trn`.`parent_id` and `trn`.`field_type` = 'title') AS `trans_title`,(select `trn`.`content` from `translator` `trn` where `trn`.`item_type` = 'page' and `pg`.`id` = `trn`.`parent_id` and `trn`.`field_type` = 'content') AS `trans_content`,(select `trn`.`lang_id` from `translator` `trn` where `trn`.`item_type` = 'page' and `pg`.`id` = `trn`.`parent_id` and `trn`.`field_type` = 'title') AS `trans_title_lang_id`,(select `trn`.`lang_id` from `translator` `trn` where `trn`.`item_type` = 'page' and `pg`.`id` = `trn`.`parent_id` and `trn`.`field_type` = 'content') AS `trans_content_lang_id`,(select `trn`.`content` from `translator` `trn` where `trn`.`item_type` = 'page' and `pg`.`id` = `trn`.`parent_id` and `trn`.`field_type` = 'keywords') AS `trans_keywords`,(select `trn`.`content` from `translator` `trn` where `trn`.`item_type` = 'page' and `pg`.`id` = `trn`.`parent_id` and `trn`.`field_type` = 'description') AS `trans_description`,'page' AS `item_type`,`pg`.`site_id` AS `site_id` from `pages` `pg` where `pg`.`publish` = 1 union select `mn`.`id` AS `id`,`mn`.`title` AS `title`,NULL AS `null3`,`mn`.`lang_id` AS `lang_id`,NULL AS `null5`,NULL AS `null6`,NULL AS `null7`,(select `trn`.`content` from `translator` `trn` where `trn`.`item_type` = 'menu' and `mn`.`id` = `trn`.`parent_id` and `trn`.`field_type` = 'title') AS `trans_title`,NULL AS `null9`,(select `trn`.`lang_id` from `translator` `trn` where `trn`.`item_type` = 'menu' and `mn`.`id` = `trn`.`parent_id` and `trn`.`field_type` = 'title') AS `trans_title_lang_id`,NULL AS `null11`,NULL AS `null12`,NULL AS `null13`,'menu' AS `item_type`,`mn`.`site_id` AS `site_id` from `menus` `mn` where `mn`.`publish` = 1 and `mn`.`menu_type` = 0 union select `md`.`id` AS `id`,`md`.`title` AS `title`,`md`.`url_alias` AS `url_alias`,`md`.`lang_id` AS `lang_id`,`md`.`keywords` AS `keywords`,`md`.`description` AS `description`,NULL AS `null7`,(select `trn`.`content` from `translator` `trn` where `trn`.`item_type` = 'module' and `md`.`id` = `trn`.`parent_id` and `trn`.`field_type` = 'title') AS `trans_title`,NULL AS `null9`,(select `trn`.`lang_id` from `translator` `trn` where `trn`.`item_type` = 'module' and `md`.`id` = `trn`.`parent_id` and `trn`.`field_type` = 'title') AS `trans_title_lang_id`,NULL AS `null11`,(select `trn`.`content` from `translator` `trn` where `trn`.`item_type` = 'module' and `md`.`id` = `trn`.`parent_id` and `trn`.`field_type` = 'keywords') AS `trans_keywords`,(select `trn`.`content` from `translator` `trn` where `trn`.`item_type` = 'module' and `md`.`id` = `trn`.`parent_id` and `trn`.`field_type` = 'description') AS `trans_description`,'module' AS `item_type`,`md`.`site_id` AS `site_id` from `modules` `md` where `md`.`publish` = 1 union select `main`.`id` AS `id`,`main`.`title` AS `title`,`main`.`url_alias` AS `url_alias`,`main`.`lang_id` AS `lang_id`,`main`.`keywords` AS `keywords`,`main`.`description` AS `description`,`main`.`content` AS `content`,(select `trn`.`content` from `translator` `trn` where `trn`.`item_type` = 'main' and `main`.`id` = `trn`.`parent_id` and `trn`.`field_type` = 'title') AS `trans_title`,(select `trn`.`content` from `translator` `trn` where `trn`.`item_type` = 'main' and `main`.`id` = `trn`.`parent_id` and `trn`.`field_type` = 'content') AS `trans_content`,(select `trn`.`lang_id` from `translator` `trn` where `trn`.`item_type` = 'main' and `main`.`id` = `trn`.`parent_id` and `trn`.`field_type` = 'title') AS `trans_title_lang_id`,(select `trn`.`lang_id` from `translator` `trn` where `trn`.`item_type` = 'main' and `main`.`id` = `trn`.`parent_id` and `trn`.`field_type` = 'content') AS `trans_content_lang_id`,(select `trn`.`content` from `translator` `trn` where `trn`.`item_type` = 'main' and `main`.`id` = `trn`.`parent_id` and `trn`.`field_type` = 'keywords') AS `trans_keywords`,(select `trn`.`content` from `translator` `trn` where `trn`.`item_type` = 'main' and `main`.`id` = `trn`.`parent_id` and `trn`.`field_type` = 'description') AS `trans_description`,'main' AS `item_type`,`main`.`site_id` AS `site_id` from `mains` `main` where `main`.`publish` = 1 union select `sub`.`id` AS `id`,`sub`.`title` AS `title`,`sub`.`url_alias` AS `url_alias`,`sub`.`lang_id` AS `lang_id`,`sub`.`keywords` AS `keywords`,`sub`.`description` AS `description`,`sub`.`content` AS `content`,(select `trn`.`content` from `translator` `trn` where `trn`.`item_type` = 'subject' and `sub`.`id` = `trn`.`parent_id` and `trn`.`field_type` = 'title') AS `trans_title`,(select `trn`.`content` from `translator` `trn` where `trn`.`item_type` = 'subject' and `sub`.`id` = `trn`.`parent_id` and `trn`.`field_type` = 'content') AS `trans_content`,(select `trn`.`lang_id` from `translator` `trn` where `trn`.`item_type` = 'subject' and `sub`.`id` = `trn`.`parent_id` and `trn`.`field_type` = 'title') AS `trans_title_lang_id`,(select `trn`.`lang_id` from `translator` `trn` where `trn`.`item_type` = 'subject' and `sub`.`id` = `trn`.`parent_id` and `trn`.`field_type` = 'content') AS `trans_content_lang_id`,(select `trn`.`content` from `translator` `trn` where `trn`.`item_type` = 'subject' and `sub`.`id` = `trn`.`parent_id` and `trn`.`field_type` = 'keywords') AS `trans_keywords`,(select `trn`.`content` from `translator` `trn` where `trn`.`item_type` = 'subject' and `sub`.`id` = `trn`.`parent_id` and `trn`.`field_type` = 'description') AS `trans_description`,'subject' AS `item_type`,(select `main`.`site_id` from `mains` `main` where `main`.`id` = `sub`.`main_id`) AS `site_id` from `subjects` `sub` where `sub`.`publish` = 1 union select `gal`.`id` AS `id`,`gal`.`title` AS `title`,`gal`.`url_alias` AS `url_alias`,`gal`.`lang_id` AS `lang_id`,NULL AS `null5`,NULL AS `null6`,NULL AS `null7`,(select `trn`.`content` from `translator` `trn` where `trn`.`item_type` = 'gallery' and `gal`.`id` = `trn`.`parent_id` and `trn`.`field_type` = 'title') AS `trans_title`,NULL AS `null9`,(select `trn`.`lang_id` from `translator` `trn` where `trn`.`item_type` = 'gallery' and `gal`.`id` = `trn`.`parent_id` and `trn`.`field_type` = 'title') AS `trans_title_lang_id`,NULL AS `null11`,NULL AS `null12`,NULL AS `null13`,'gallery' AS `item_type`,`gal`.`site_id` AS `site_id` from `galleries` `gal` where `gal`.`publish` = 1 union select `med`.`id` AS `id`,`med`.`title` AS `title`,NULL AS `null3`,`med`.`lang_id` AS `lang_id`,NULL AS `null5`,NULL AS `null6`,NULL AS `null7`,(select `trn`.`content` from `translator` `trn` where `trn`.`item_type` = 'media' and `med`.`id` = `trn`.`parent_id` and `trn`.`field_type` = 'title') AS `trans_title`,NULL AS `null9`,(select `trn`.`lang_id` from `translator` `trn` where `trn`.`item_type` = 'media' and `med`.`id` = `trn`.`parent_id` and `trn`.`field_type` = 'title') AS `trans_title_lang_id`,NULL AS `null11`,NULL AS `null12`,NULL AS `null13`,'media' AS `item_type`,(select `gal`.`site_id` from `galleries` `gal` where `gal`.`id` = `med`.`gallery_id`) AS `site_id` from `medias` `med` where `med`.`publish` = 1 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `site_id_log_idx` (`site_id`);

--
-- Indexes for table `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lang_id` (`lang_id`),
  ADD KEY `adsec_id` (`adsec_id`);

--
-- Indexes for table `ads_sections`
--
ALTER TABLE `ads_sections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lang_id` (`lang_id`),
  ADD KEY `site_id_fk_idx` (`site_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `site_contacts_idx` (`site_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lang_id` (`lang_id`),
  ADD KEY `site_id_fk2_idx` (`site_id`);

--
-- Indexes for table `event_config`
--
ALTER TABLE `event_config`
  ADD PRIMARY KEY (`id`),
  ADD KEY `site_id_fk_idx` (`site_id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `site_id_fk3_idx` (`site_id`);

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lang_id` (`lang_id`),
  ADD KEY `module_id` (`module_id`),
  ADD KEY `site_id_fk4_idx` (`site_id`);

--
-- Indexes for table `job_requests`
--
ALTER TABLE `job_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `join_requests`
--
ALTER TABLE `join_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `photoIndex1` (`photo`);

--
-- Indexes for table `langs`
--
ALTER TABLE `langs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `layout`
--
ALTER TABLE `layout`
  ADD PRIMARY KEY (`id`),
  ADD KEY `page_id` (`page_id`),
  ADD KEY `module_id` (`module_id`),
  ADD KEY `sites_id_fk15_idx` (`site_id`);

--
-- Indexes for table `mails`
--
ALTER TABLE `mails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mail_groups_id` (`mail_groups_id`);

--
-- Indexes for table `mail_groups`
--
ALTER TABLE `mail_groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lang_id` (`lang_id`),
  ADD KEY `site_id_fk5_idx` (`site_id`);

--
-- Indexes for table `mail_messages`
--
ALTER TABLE `mail_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mail_groups_id` (`mail_groups_id`);

--
-- Indexes for table `mains`
--
ALTER TABLE `mains`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lang_id` (`lang_id`),
  ADD KEY `parent_id` (`parent_id`),
  ADD KEY `module_id` (`module_id`),
  ADD KEY `site_it_fk6_idx` (`site_id`);

--
-- Indexes for table `medias`
--
ALTER TABLE `medias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lang_id` (`lang_id`),
  ADD KEY `gallery_id` (`gallery_id`),
  ADD KEY `file_id_fk_idx` (`file_id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lang_id` (`lang_id`),
  ADD KEY `page_id` (`page_id`),
  ADD KEY `module_id` (`module_id`),
  ADD KEY `parent_id` (`parent_id`),
  ADD KEY `permission_id` (`permission_id`),
  ADD KEY `main_id` (`main_id`),
  ADD KEY `gallery_id` (`gallery_id`),
  ADD KEY `site_id_fk7_idx` (`site_id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lang_id` (`lang_id`),
  ADD KEY `site_id_fk8_idx` (`site_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lang_id` (`lang_id`),
  ADD KEY `module_id` (`module_id`),
  ADD KEY `site_id_fk9_idx` (`site_id`);

--
-- Indexes for table `parts`
--
ALTER TABLE `parts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `page_id` (`page_id`),
  ADD KEY `lang_id` (`lang_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `persec_id` (`persec_id`);

--
-- Indexes for table `persecs`
--
ALTER TABLE `persecs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photographs`
--
ALTER TABLE `photographs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `site_id_fk11_idx` (`site_id`);

--
-- Indexes for table `plugins`
--
ALTER TABLE `plugins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lang_id` (`lang_id`),
  ADD KEY `menu_id` (`menu_id`),
  ADD KEY `site_id_fk12_idx` (`site_id`),
  ADD KEY `ads_section_fk_idx` (`ads_section_id`),
  ADD KEY `gallery_id_fkplg_idx` (`gallery_id`),
  ADD KEY `main_id_fkplg_idx` (`main_id`);

--
-- Indexes for table `push_tokens`
--
ALTER TABLE `push_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `site_id_fk13_idx` (`site_id`);

--
-- Indexes for table `role_per`
--
ALTER TABLE `role_per`
  ADD PRIMARY KEY (`roles_id`,`pers_id`),
  ADD KEY `pers_id` (`pers_id`);

--
-- Indexes for table `site_config`
--
ALTER TABLE `site_config`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lang_id` (`lang_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lang_id` (`lang_id`),
  ADD KEY `main_id` (`main_id`);

--
-- Indexes for table `subscription`
--
ALTER TABLE `subscription`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `translator`
--
ALTER TABLE `translator`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lang_id` (`lang_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `lang_user_idx` (`lang_id`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_id` (`question_id`),
  ADD KEY `answer_id` (`answer_id`);

--
-- Indexes for table `vote_answers`
--
ALTER TABLE `vote_answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_id` (`question_id`),
  ADD KEY `lang_id` (`lang_id`);

--
-- Indexes for table `vote_questions`
--
ALTER TABLE `vote_questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lang_id` (`lang_id`),
  ADD KEY `site_id_fk14_idx` (`site_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240;

--
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `ads_sections`
--
ALTER TABLE `ads_sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `event_config`
--
ALTER TABLE `event_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `job_requests`
--
ALTER TABLE `job_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `join_requests`
--
ALTER TABLE `join_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `langs`
--
ALTER TABLE `langs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `layout`
--
ALTER TABLE `layout`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=236;

--
-- AUTO_INCREMENT for table `mails`
--
ALTER TABLE `mails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mail_groups`
--
ALTER TABLE `mail_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mail_messages`
--
ALTER TABLE `mail_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mains`
--
ALTER TABLE `mains`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `medias`
--
ALTER TABLE `medias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=448;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT for table `parts`
--
ALTER TABLE `parts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=314;

--
-- AUTO_INCREMENT for table `persecs`
--
ALTER TABLE `persecs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `photographs`
--
ALTER TABLE `photographs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1173;

--
-- AUTO_INCREMENT for table `plugins`
--
ALTER TABLE `plugins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `push_tokens`
--
ALTER TABLE `push_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `site_config`
--
ALTER TABLE `site_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `subscription`
--
ALTER TABLE `subscription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `translator`
--
ALTER TABLE `translator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=215;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vote_answers`
--
ALTER TABLE `vote_answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vote_questions`
--
ALTER TABLE `vote_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD CONSTRAINT `site_id_log` FOREIGN KEY (`site_id`) REFERENCES `site_config` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ads`
--
ALTER TABLE `ads`
  ADD CONSTRAINT `ads_sections_fk` FOREIGN KEY (`adsec_id`) REFERENCES `ads_sections` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lang_id_ads_fk` FOREIGN KEY (`lang_id`) REFERENCES `langs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ads_sections`
--
ALTER TABLE `ads_sections`
  ADD CONSTRAINT `lang_id_fk` FOREIGN KEY (`lang_id`) REFERENCES `langs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `site_id_fk` FOREIGN KEY (`site_id`) REFERENCES `site_config` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `site_contacts` FOREIGN KEY (`site_id`) REFERENCES `site_config` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`lang_id`) REFERENCES `langs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `site_id_fk2` FOREIGN KEY (`site_id`) REFERENCES `site_config` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `event_config`
--
ALTER TABLE `event_config`
  ADD CONSTRAINT `site_id_fk1` FOREIGN KEY (`site_id`) REFERENCES `site_config` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `site_id_fk3` FOREIGN KEY (`site_id`) REFERENCES `site_config` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `galleries`
--
ALTER TABLE `galleries`
  ADD CONSTRAINT `lang_fk` FOREIGN KEY (`lang_id`) REFERENCES `langs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `module_fk` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`),
  ADD CONSTRAINT `site_id_fk4` FOREIGN KEY (`site_id`) REFERENCES `site_config` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `layout`
--
ALTER TABLE `layout`
  ADD CONSTRAINT `module_layout_fk` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `page_layout_fk` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sites_id_fk15` FOREIGN KEY (`site_id`) REFERENCES `site_config` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mails`
--
ALTER TABLE `mails`
  ADD CONSTRAINT `mail_group_m_fk` FOREIGN KEY (`mail_groups_id`) REFERENCES `mail_groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mail_groups`
--
ALTER TABLE `mail_groups`
  ADD CONSTRAINT `lang_mg_fk` FOREIGN KEY (`lang_id`) REFERENCES `langs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `site_id_fk5` FOREIGN KEY (`site_id`) REFERENCES `site_config` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mail_messages`
--
ALTER TABLE `mail_messages`
  ADD CONSTRAINT `mail_groups_msg_fk` FOREIGN KEY (`mail_groups_id`) REFERENCES `mail_groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mains`
--
ALTER TABLE `mains`
  ADD CONSTRAINT `lang_main_fk` FOREIGN KEY (`lang_id`) REFERENCES `langs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `module_main_pk` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `parent_main_fk` FOREIGN KEY (`parent_id`) REFERENCES `mains` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `site_it_fk6` FOREIGN KEY (`site_id`) REFERENCES `site_config` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `medias`
--
ALTER TABLE `medias`
  ADD CONSTRAINT `file_id_fk` FOREIGN KEY (`file_id`) REFERENCES `files` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gallery_media_fk` FOREIGN KEY (`gallery_id`) REFERENCES `galleries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lang_media_fk` FOREIGN KEY (`lang_id`) REFERENCES `langs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `menus`
--
ALTER TABLE `menus`
  ADD CONSTRAINT `gallery_menu_fk` FOREIGN KEY (`gallery_id`) REFERENCES `galleries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lang_menu_fk` FOREIGN KEY (`lang_id`) REFERENCES `langs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `main_menu_fk` FOREIGN KEY (`main_id`) REFERENCES `mains` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `module_menu_fk` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `page_menu_fk` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `parent_menu_fk` FOREIGN KEY (`parent_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_menu_fk` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `site_id_fk7` FOREIGN KEY (`site_id`) REFERENCES `site_config` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `modules`
--
ALTER TABLE `modules`
  ADD CONSTRAINT `lang_module_fk` FOREIGN KEY (`lang_id`) REFERENCES `langs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `site_id_fk8` FOREIGN KEY (`site_id`) REFERENCES `site_config` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pages`
--
ALTER TABLE `pages`
  ADD CONSTRAINT `lang_page_fk` FOREIGN KEY (`lang_id`) REFERENCES `langs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `module_page_fk` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `site_id_fk9` FOREIGN KEY (`site_id`) REFERENCES `site_config` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `parts`
--
ALTER TABLE `parts`
  ADD CONSTRAINT `lang_part_fk` FOREIGN KEY (`lang_id`) REFERENCES `langs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `page_part_fk` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `persec_fk` FOREIGN KEY (`persec_id`) REFERENCES `persecs` (`id`);

--
-- Constraints for table `photographs`
--
ALTER TABLE `photographs`
  ADD CONSTRAINT `site_id_fk11` FOREIGN KEY (`site_id`) REFERENCES `site_config` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `plugins`
--
ALTER TABLE `plugins`
  ADD CONSTRAINT `ads_section_fk` FOREIGN KEY (`ads_section_id`) REFERENCES `ads_sections` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gallery_id_fkplg` FOREIGN KEY (`gallery_id`) REFERENCES `galleries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lang_plug_fk` FOREIGN KEY (`lang_id`) REFERENCES `langs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `main_id_fkplg` FOREIGN KEY (`main_id`) REFERENCES `mains` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `menu_plug_fk` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `site_id_fk12` FOREIGN KEY (`site_id`) REFERENCES `site_config` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `roles`
--
ALTER TABLE `roles`
  ADD CONSTRAINT `site_id_fk13` FOREIGN KEY (`site_id`) REFERENCES `site_config` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_per`
--
ALTER TABLE `role_per`
  ADD CONSTRAINT `perm_rp_fk` FOREIGN KEY (`pers_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_rp_fk` FOREIGN KEY (`roles_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `site_config`
--
ALTER TABLE `site_config`
  ADD CONSTRAINT `lang_conf_fk` FOREIGN KEY (`lang_id`) REFERENCES `langs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subjects`
--
ALTER TABLE `subjects`
  ADD CONSTRAINT `lang_subject_fk` FOREIGN KEY (`lang_id`) REFERENCES `langs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `main_subject_fk` FOREIGN KEY (`main_id`) REFERENCES `mains` (`id`);

--
-- Constraints for table `translator`
--
ALTER TABLE `translator`
  ADD CONSTRAINT `lang_trans_fk` FOREIGN KEY (`lang_id`) REFERENCES `langs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `lang_user` FOREIGN KEY (`lang_id`) REFERENCES `langs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_user_fk` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `votes_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `vote_questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `votes_ibfk_2` FOREIGN KEY (`answer_id`) REFERENCES `vote_answers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vote_answers`
--
ALTER TABLE `vote_answers`
  ADD CONSTRAINT `vot_lang_answer` FOREIGN KEY (`lang_id`) REFERENCES `langs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vote_answers_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `vote_questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vote_questions`
--
ALTER TABLE `vote_questions`
  ADD CONSTRAINT `site_id_fk14` FOREIGN KEY (`site_id`) REFERENCES `site_config` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vote_questions_ibfk_1` FOREIGN KEY (`lang_id`) REFERENCES `langs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
