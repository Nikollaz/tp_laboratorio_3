-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 13, 2018 at 01:28 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u487508290_aaaaa`
--
CREATE DATABASE IF NOT EXISTS `u487508290_aaaaa` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `u487508290_aaaaa`;

-- --------------------------------------------------------

--
-- Table structure for table `cocheras`
--

CREATE TABLE `cocheras` (
  `id` int(11) NOT NULL,
  `ReservadoDiscEmbar` tinyint(1) NOT NULL DEFAULT '0',
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `piso` int(11) NOT NULL,
  `ocupada` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cocheras`
--

INSERT INTO `cocheras` (`id`, `ReservadoDiscEmbar`, `nombre`, `piso`, `ocupada`) VALUES
(1, 1, '102', 1, 0),
(2, 1, '283', 1, 0),
(3, 1, '197', 1, 0),
(4, 0, '151', 1, 0),
(5, 0, '127', 1, 1),
(6, 0, '387', 1, 1),
(7, 0, '372', 2, 0),
(8, 0, '420', 2, 0),
(9, 0, '199', 2, 0),
(10, 0, '448', 2, 0),
(11, 0, '259', 2, 0),
(12, 0, '428', 2, 0),
(13, 0, '261', 3, 0),
(14, 0, '285', 3, 0),
(15, 0, '396', 3, 0),
(16, 0, '175', 3, 0),
(17, 0, '388', 3, 1),
(18, 0, '296', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `empleados`
--

CREATE TABLE `empleados` (
  `id` int(11) NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `turno` int(11) NOT NULL,
  `sexo` int(11) NOT NULL,
  `perfil` int(11) NOT NULL,
  `suspendido` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `empleados`
--

INSERT INTO `empleados` (`id`, `email`, `password`, `turno`, `sexo`, `perfil`, `suspendido`) VALUES
(1, 'Vladimir001@estacionamiento.com', '25021544', 1, 1, 2, 0),
(2, 'Jorge001@estacionamiento.com', '45678921', 2, 1, 1, 0),
(3, 'Dulce001@estacionamiento.com', '42512354', 3, 2, 1, 0),
(4, 'suspendido001@estacionamiento.com', 'suspendido001@estacionamiento.com', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `logueos`
--

CREATE TABLE `logueos` (
  `id` int(11) NOT NULL,
  `empleado` int(11) DEFAULT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `logueos`
--

INSERT INTO `logueos` (`id`, `empleado`, `fecha`) VALUES
(1, 1, '2017-11-26 17:10:06'),
(2, 2, '2017-11-26 17:10:06'),
(3, 3, '2017-11-26 17:10:06'),
(4, 1, '2017-11-26 17:10:06'),
(5, 2, '2017-11-26 17:10:06'),
(6, 3, '2017-11-26 17:10:06'),
(7, 1, '2017-11-26 17:14:27'),
(8, 3, '2017-11-26 17:50:44'),
(9, 1, '2017-11-26 14:59:36'),
(10, 1, '2017-11-26 16:10:48'),
(11, 1, '2017-11-26 16:25:06'),
(12, 1, '2017-11-26 16:26:57'),
(13, 1, '2017-11-26 16:27:20'),
(14, 1, '2017-11-26 16:27:26'),
(15, 1, '2017-11-26 16:27:32'),
(16, 1, '2017-11-26 16:27:51'),
(17, 1, '2017-11-26 16:28:23'),
(18, 1, '2017-11-26 16:28:35'),
(19, 1, '2017-11-26 16:28:42'),
(20, 1, '2017-11-26 16:28:45'),
(21, 1, '2017-11-26 16:29:29'),
(22, 1, '2017-11-26 16:29:40'),
(23, 1, '2017-11-26 16:30:50'),
(24, 1, '2017-11-26 16:31:42'),
(25, 1, '2017-11-26 16:32:05'),
(26, 1, '2017-11-26 16:35:12'),
(27, 1, '2017-11-26 16:35:28'),
(28, 1, '2017-11-26 16:37:28'),
(29, 1, '2017-11-26 16:44:19'),
(30, 1, '2017-11-26 16:48:47'),
(31, 1, '2017-11-26 16:50:24'),
(32, 1, '2017-11-26 16:51:27'),
(33, 1, '2017-11-26 16:52:58'),
(34, 1, '2017-11-26 16:53:36'),
(35, 1, '2017-11-26 16:55:06'),
(36, 1, '2017-11-26 16:56:02'),
(37, 1, '2017-11-26 16:56:22'),
(38, 1, '2017-11-26 16:59:44'),
(39, 1, '2017-11-26 17:02:01'),
(40, 1, '2017-11-26 17:03:37'),
(41, 1, '2017-11-26 17:04:12'),
(42, 1, '2017-11-26 17:05:39'),
(43, 1, '2017-11-26 17:06:09'),
(44, 1, '2017-11-26 17:06:59'),
(45, 1, '2017-11-26 17:10:08'),
(46, 1, '2017-11-26 17:10:45'),
(47, 1, '2017-11-26 17:11:38'),
(48, 1, '2017-11-26 17:11:52'),
(49, 1, '2017-11-26 17:12:37'),
(50, 2, '2017-11-26 17:14:10'),
(51, 1, '2017-11-26 17:14:36'),
(52, 1, '2017-11-26 17:15:33'),
(53, 1, '2017-11-26 17:15:51'),
(54, 1, '2017-11-26 17:16:08'),
(55, 1, '2017-11-26 17:18:16'),
(56, 1, '2017-11-26 17:18:32'),
(57, 1, '2017-11-26 17:20:08'),
(58, 1, '2017-11-26 17:20:19'),
(59, 1, '2017-11-26 17:21:02'),
(60, 1, '2017-11-26 17:22:25'),
(61, 1, '2017-11-26 18:14:37'),
(62, 1, '2017-11-26 18:15:36'),
(63, 1, '2017-11-26 18:15:48'),
(64, 1, '2017-11-26 18:17:07'),
(65, 1, '2017-11-26 18:19:27'),
(66, 1, '2017-11-26 18:20:56'),
(67, 1, '2017-11-26 18:23:40'),
(68, 1, '2017-11-26 18:24:33'),
(69, 1, '2017-11-26 18:26:42'),
(70, 1, '2017-11-26 18:26:54'),
(71, 1, '2017-11-26 18:29:46'),
(72, 1, '2017-11-26 18:30:54'),
(73, 1, '2017-11-26 18:36:16'),
(74, 1, '2017-11-26 18:37:37'),
(75, 1, '2017-11-26 18:37:49'),
(76, 1, '2017-11-26 18:54:57'),
(77, 1, '2017-11-26 18:55:57'),
(78, 1, '2017-11-26 18:56:20'),
(79, 1, '2017-11-26 18:56:57'),
(80, 1, '2017-11-26 18:57:11'),
(81, 1, '2017-11-26 18:57:30'),
(82, 1, '2017-11-26 19:03:58'),
(83, 1, '2017-11-26 19:04:20'),
(84, 1, '2017-11-26 19:05:22'),
(85, 1, '2017-11-26 19:05:42'),
(86, 1, '2017-11-26 19:06:17'),
(87, 1, '2017-11-26 19:07:48'),
(88, 1, '2017-11-26 19:09:20'),
(89, 1, '2017-11-26 19:29:01'),
(90, 1, '2017-11-27 10:14:22'),
(91, 1, '2017-11-27 10:17:49'),
(92, 1, '2017-11-27 10:34:06'),
(93, 1, '2017-11-27 11:15:34'),
(94, 1, '2017-11-27 11:17:10'),
(95, 1, '2017-11-27 11:19:26'),
(96, 1, '2017-11-27 11:20:16'),
(97, 1, '2017-11-27 11:20:42'),
(98, 1, '2017-11-27 11:22:13'),
(99, 1, '2017-11-27 11:31:27'),
(100, 1, '2017-11-27 12:04:10'),
(101, 1, '2017-11-27 12:08:36'),
(102, 1, '2017-11-27 12:09:52'),
(103, 1, '2017-11-27 12:11:17'),
(104, 1, '2017-11-27 12:28:28'),
(105, 1, '2017-11-27 12:28:47'),
(106, 1, '2017-11-27 12:43:49'),
(107, 1, '2017-11-27 12:50:27'),
(108, 1, '2017-11-27 15:50:26'),
(109, 1, '2017-11-27 18:54:12'),
(110, 1, '2017-11-27 19:01:33'),
(111, 1, '2017-11-27 19:19:40'),
(112, 2, '2017-11-27 19:36:34'),
(113, 1, '2017-11-27 19:48:21'),
(114, 1, '2017-11-27 20:12:50'),
(115, 1, '2017-11-27 21:57:15'),
(116, 1, '2017-11-27 22:01:04'),
(117, 1, '2017-11-27 22:02:12'),
(118, 1, '2017-11-27 22:02:46'),
(119, 1, '2017-11-28 13:20:24'),
(120, 2, '2017-11-28 13:25:32'),
(121, 2, '2017-11-28 13:26:20'),
(122, 2, '2017-11-28 13:36:35'),
(123, 2, '2017-11-28 13:36:40'),
(124, 1, '2017-11-28 13:36:43'),
(125, 1, '2017-11-28 13:37:05'),
(126, 2, '2017-11-28 13:37:08'),
(127, 1, '2017-11-28 13:37:19'),
(128, 1, '2017-11-28 13:37:24'),
(129, 1, '2017-11-28 13:37:33'),
(130, 2, '2017-11-28 13:37:52'),
(131, 1, '2017-11-28 13:46:58'),
(132, 2, '2017-11-28 13:49:49'),
(133, 2, '2017-11-28 13:51:52'),
(134, 1, '2017-11-28 13:52:03'),
(135, 1, '2017-11-28 14:04:53'),
(136, 2, '2017-11-28 16:06:54'),
(137, 1, '2017-11-28 21:06:51'),
(138, 1, '2017-11-29 11:14:08'),
(139, 2, '2017-11-29 13:06:22'),
(140, 1, '2017-11-29 13:19:24'),
(141, 1, '2017-11-29 13:19:49'),
(142, 1, '2017-11-29 13:19:56'),
(143, 1, '2017-11-29 13:20:11'),
(144, 1, '2017-11-29 13:42:00'),
(145, 1, '2017-11-29 17:00:21'),
(146, 1, '2017-11-29 21:13:12'),
(147, 1, '2017-11-30 11:30:43'),
(148, 1, '2017-11-30 13:58:58'),
(149, 1, '2017-12-01 10:27:42'),
(150, 1, '2017-12-01 11:55:34'),
(151, 1, '2017-12-01 15:24:17'),
(152, 2, '2017-12-01 15:25:33'),
(153, 1, '2017-12-01 15:25:59'),
(154, 1, '2017-12-01 15:44:10'),
(155, 1, '2017-12-01 16:09:55'),
(156, 1, '2017-12-01 16:12:53'),
(157, 1, '2017-12-01 16:33:33'),
(158, 1, '2017-12-01 19:01:33'),
(159, 2, '2017-12-01 19:15:55'),
(160, 1, '2017-12-01 19:16:04'),
(161, 2, '2017-12-01 19:16:26'),
(162, 1, '2017-12-01 19:19:07'),
(163, 2, '2017-12-02 11:21:23'),
(164, 1, '2017-12-02 11:21:32'),
(165, 2, '2017-12-02 11:23:12'),
(166, 1, '2017-12-02 11:23:44'),
(167, 1, '2017-12-04 14:00:21'),
(168, 1, '2017-12-04 14:15:54'),
(169, 1, '2017-12-05 18:59:41'),
(170, 1, '2017-12-06 11:51:13'),
(171, 3, '2017-12-06 12:57:01'),
(172, 3, '2017-12-06 12:57:10'),
(173, 3, '2017-12-06 13:02:01'),
(174, 2, '2017-12-06 13:04:55'),
(175, 1, '2017-12-06 13:42:09'),
(176, 1, '2017-12-06 13:43:53'),
(177, 1, '2017-12-06 13:52:22'),
(178, 1, '2017-12-06 13:59:47'),
(179, 2, '2017-12-06 14:13:50'),
(180, 1, '2017-12-06 14:14:00'),
(181, 2, '2017-12-06 15:46:47'),
(182, 1, '2017-12-06 15:52:38'),
(183, 1, '2017-12-07 15:59:21'),
(184, 1, '2017-12-07 16:44:21'),
(185, 1, '2017-12-09 09:35:02'),
(186, 1, '2017-12-09 09:40:37'),
(187, 1, '2017-12-09 09:41:02'),
(188, 1, '2017-12-11 11:23:50'),
(189, 1, '2017-12-11 12:59:57'),
(190, 1, '2017-12-11 13:12:17'),
(191, 1, '2017-12-11 13:19:01'),
(192, 1, '2017-12-11 13:56:35'),
(193, 1, '2017-12-11 14:36:55'),
(194, 1, '2017-12-11 15:24:04'),
(195, 2, '2017-12-11 15:56:21'),
(196, 1, '2017-12-11 15:56:47'),
(197, 1, '2017-12-11 16:25:13'),
(198, 1, '2017-12-11 16:28:37'),
(199, 1, '2017-12-11 16:29:18'),
(200, 1, '2017-12-11 16:31:08'),
(201, 1, '2017-12-11 16:31:08'),
(202, 1, '2017-12-11 16:38:26'),
(203, 1, '2017-12-11 16:46:41'),
(204, 1, '2017-12-11 16:48:06'),
(205, 1, '2017-12-11 16:51:40'),
(206, 1, '2017-12-11 18:09:32'),
(207, 1, '2017-12-11 19:01:13'),
(208, 1, '2017-12-11 19:35:23'),
(209, 2, '2017-12-12 12:59:38'),
(210, 1, '2017-12-12 13:01:12'),
(211, 1, '2017-12-12 13:06:22'),
(212, 1, '2017-12-12 13:15:20'),
(213, 1, '2017-12-12 13:15:29'),
(214, 1, '2017-12-12 13:15:47'),
(215, 1, '2017-12-12 13:19:27'),
(216, 1, '2017-12-12 13:20:58'),
(217, 1, '2017-12-12 13:23:21'),
(218, 1, '2017-12-12 13:24:25'),
(219, 1, '2017-12-12 13:25:26'),
(220, 1, '2017-12-12 13:30:16'),
(221, 1, '2017-12-12 13:30:29'),
(222, 1, '2017-12-12 13:41:47'),
(223, 1, '2017-12-12 13:45:18'),
(224, 1, '2017-12-12 14:07:25'),
(225, 1, '2017-12-12 14:07:31'),
(226, 1, '2017-12-12 14:38:30'),
(227, 1, '2017-12-12 18:07:13'),
(228, 1, '2017-12-12 19:16:41'),
(229, 1, '2017-12-15 10:13:43'),
(230, 1, '2017-12-16 22:50:02'),
(231, 1, '2017-12-18 16:37:37'),
(232, 1, '2017-12-20 11:49:34'),
(233, 1, '2017-12-20 19:03:45'),
(234, 2, '2017-12-20 19:16:19'),
(235, 2, '2017-12-20 19:17:52'),
(236, 1, '2017-12-20 19:19:27'),
(237, 1, '2017-12-20 19:27:08'),
(238, 1, '2018-01-03 15:10:09'),
(239, 1, '2018-02-10 17:15:06'),
(240, 1, '2018-03-26 10:51:08'),
(241, 1, '2018-03-30 22:57:26'),
(242, 1, '2018-03-30 22:57:44'),
(243, 1, '2018-03-30 22:58:57');

-- --------------------------------------------------------

--
-- Table structure for table `perfiles`
--

CREATE TABLE `perfiles` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `perfiles`
--

INSERT INTO `perfiles` (`id`, `nombre`) VALUES
(2, 'admin'),
(1, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `sexos`
--

CREATE TABLE `sexos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sexos`
--

INSERT INTO `sexos` (`id`, `nombre`) VALUES
(2, 'Femenino'),
(1, 'Masculino');

-- --------------------------------------------------------

--
-- Table structure for table `turnos`
--

CREATE TABLE `turnos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `turnos`
--

INSERT INTO `turnos` (`id`, `nombre`) VALUES
(1, 'mañana'),
(3, 'noche'),
(2, 'tarde');

-- --------------------------------------------------------

--
-- Table structure for table `vehiculos`
--

CREATE TABLE `vehiculos` (
  `id` int(11) NOT NULL,
  `patente` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Color` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Marca` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Foto` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `IDEmpleadoIngreso` int(11) DEFAULT NULL,
  `HoraDeEntrada` datetime NOT NULL,
  `Cochera` int(11) NOT NULL,
  `IDEmpleadoSalida` int(11) DEFAULT NULL,
  `HoraDeSalida` datetime DEFAULT NULL,
  `importe` decimal(19,2) DEFAULT NULL,
  `tiempo_seg` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `vehiculos`
--

INSERT INTO `vehiculos` (`id`, `patente`, `Color`, `Marca`, `Foto`, `IDEmpleadoIngreso`, `HoraDeEntrada`, `Cochera`, `IDEmpleadoSalida`, `HoraDeSalida`, `importe`, `tiempo_seg`) VALUES
(1, 'ABC123', 'Rojo', 'Peugeot', '1_ABC123.png', 1, '2017-10-31 13:12:05', 2, 1, '2017-12-01 20:26:46', '5340.00', 2704481),
(6, 'ABC129', 'Gris', 'Peugeot', '1_ABC129.png', 3, '2017-10-31 23:09:12', 3, 1, '2017-11-28 15:56:21', '4720.00', 2393229),
(7, '67046-223', 'Purple', 'Mazda', '675998924-4', 2, '2016-12-26 15:11:20', 3, 1, '2017-11-26 14:38:09', '56980.00', 28942009),
(19, '62175-152', 'Puce', 'Buick', '373938037-3', 1, '2017-04-23 03:38:31', 3, 1, '2017-11-26 14:43:21', '37000.00', 18788690),
(28, '42291-600', 'Pink', 'Ford', '700446980-8', 2, '2017-06-09 00:25:12', 5, 1, '2017-11-28 16:03:12', '29360.00', 14917080),
(31, '61589-5311', 'Violet', 'Mazda', '535857582-0', 3, '2017-06-11 11:16:56', 5, 1, '2017-11-28 15:51:28', '28940.00', 14704472),
(36, '63736-072', 'Turquoise', 'Kia', '263406978-2', 3, '2017-04-29 02:48:37', 6, 1, '2017-11-26 14:45:40', '35980.00', 18273423),
(49, '0115-2122', 'Indigo', 'BMW', '462915191-5', 2, '2017-04-29 22:31:49', 6, 1, '2017-11-26 14:43:46', '35830.00', 18202317),
(69, '59779-912', 'Goldenrod', 'Nissan', '354109186-X', 1, '2017-03-25 18:18:16', 6, 1, '2017-11-26 14:43:57', '41820.00', 21241541),
(308, 'ABC 882', 'Rojo', 'Peugeot', 'Placeholder', 1, '2017-11-28 15:17:27', 4, 1, '2017-11-28 15:50:53', '0.00', 2006),
(309, 'IEJ 284', 'Azul', 'Peugeot', 'Placeholder', 1, '2017-11-28 15:20:20', 3, 1, '2017-11-28 15:48:44', '0.00', 1704),
(313, 'LKJS 492', 'Blanco', 'Peugeot', 'Placeholder', 2, '2017-11-28 16:08:33', 4, 2, '2017-11-28 16:09:06', '0.00', 33),
(339, 'ASD 435', 'Rojo', 'Peugeot', 'Placeholder', 1, '2017-12-06 12:26:31', 4, 1, '2017-12-06 14:12:05', '10.00', 6334),
(342, 'ASD 435', 'Rojo', 'Peugeot', 'Placeholder', 1, '2017-12-06 14:05:20', 4, 1, '2017-12-06 14:12:05', '10.00', 6334),
(343, 'ASD 123', 'Rojo', 'Peugeot', 'Placeholder', 1, '2017-12-06 14:29:03', 1, 1, '2017-12-06 14:33:47', '0.00', 284),
(347, 'AUY 853', 'Rojo', 'Peugeot', 'Placeholder', 1, '2017-12-09 10:24:55', 8, 1, '2017-12-20 19:21:46', '1950.00', 982611),
(348, 'ASD 783', 'Azul', 'Peugeot', 'Placeholder', 1, '2017-12-11 15:35:04', 6, NULL, NULL, NULL, NULL),
(350, 'LKE 938', '#00f0f0', 'Peugeot', 'Placeholder', 1, '2017-12-12 15:23:02', 18, NULL, NULL, NULL, NULL),
(351, 'AKL 198', '#000000', 'Peugeot', 'Placeholder', 1, '2017-12-20 19:20:19', 17, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cocheras`
--
ALTER TABLE `cocheras`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indexes for table `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `turno` (`turno`),
  ADD KEY `sexo` (`sexo`),
  ADD KEY `perfil` (`perfil`);

--
-- Indexes for table `logueos`
--
ALTER TABLE `logueos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `empleado` (`empleado`);

--
-- Indexes for table `perfiles`
--
ALTER TABLE `perfiles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indexes for table `sexos`
--
ALTER TABLE `sexos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indexes for table `turnos`
--
ALTER TABLE `turnos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indexes for table `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDEmpleadoIngreso` (`IDEmpleadoIngreso`),
  ADD KEY `IDEmpleadoSalida` (`IDEmpleadoSalida`),
  ADD KEY `Cochera` (`Cochera`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cocheras`
--
ALTER TABLE `cocheras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `logueos`
--
ALTER TABLE `logueos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=244;

--
-- AUTO_INCREMENT for table `perfiles`
--
ALTER TABLE `perfiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sexos`
--
ALTER TABLE `sexos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `turnos`
--
ALTER TABLE `turnos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vehiculos`
--
ALTER TABLE `vehiculos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=352;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `empleados`
--
ALTER TABLE `empleados`
  ADD CONSTRAINT `empleados_ibfk_1` FOREIGN KEY (`turno`) REFERENCES `turnos` (`id`),
  ADD CONSTRAINT `empleados_ibfk_2` FOREIGN KEY (`sexo`) REFERENCES `sexos` (`id`),
  ADD CONSTRAINT `empleados_ibfk_3` FOREIGN KEY (`perfil`) REFERENCES `perfiles` (`id`);

--
-- Constraints for table `logueos`
--
ALTER TABLE `logueos`
  ADD CONSTRAINT `logueos_ibfk_1` FOREIGN KEY (`empleado`) REFERENCES `empleados` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD CONSTRAINT `vehiculos_ibfk_1` FOREIGN KEY (`IDEmpleadoIngreso`) REFERENCES `empleados` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `vehiculos_ibfk_2` FOREIGN KEY (`IDEmpleadoSalida`) REFERENCES `empleados` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `vehiculos_ibfk_3` FOREIGN KEY (`Cochera`) REFERENCES `cocheras` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
