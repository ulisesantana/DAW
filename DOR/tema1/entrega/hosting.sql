-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 04-11-2016 a las 12:27:02
-- Versión del servidor: 10.1.16-MariaDB
-- Versión de PHP: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `datatables`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hosting`
--

CREATE TABLE `hosting` (
  `id` int(6) NOT NULL,
  `nif` varchar(13) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `surname` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `state` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `town` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `createdDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `hosting`
--

INSERT INTO `hosting` (`id`, `nif`, `name`, `surname`, `email`, `state`, `town`, `address`, `phone`, `createdDate`) VALUES
(2, '123456789A', 'Antonio', 'del Carmen', 'correo@falso.com', 'Las Palmas', 'Vecindario', 'C/ Velero, 80', '+34680240934', '2016-11-04 08:41:51'),
(3, '123456789A', 'Antonio', 'del Carmen', 'correo@falso.com', 'Las Palmas', 'Vecindario', 'C/ Velero, 80', '+34680240934', '2016-11-04 08:42:41'),
(4, '123456789A', 'Antonio', 'del Carmen', 'correo@falso.com', 'Las Palmas', 'Vecindario', 'C/ Velero, 80', '+34680240934', '2016-11-04 08:42:41'),
(5, '123456789A', 'Antonio', 'del Carmen', 'correo@falso.com', 'Las Palmas', 'Vecindario', 'C/ Velero, 80', '+34680240934', '2016-11-04 08:43:10'),
(6, '123456789A', 'Antonio', 'del Carmen', 'correo@falso.com', 'Las Palmas', 'Vecindario', 'C/ Velero, 80', '+34680240934', '2016-11-04 08:43:10'),
(7, '123456789A', 'Antonio', 'del Carmen', 'correo@falso.com', 'Las Palmas', 'Vecindario', 'C/ Velero, 80', '+34680240934', '2016-11-04 08:43:10'),
(8, '123456789A', 'Antonio', 'del Carmen', 'correo@falso.com', 'Las Palmas', 'Vecindario', 'C/ Velero, 80', '+34680240934', '2016-11-04 08:43:10'),
(9, '123456789A', 'Antonio', 'del Carmen', 'correo@falso.com', 'Las Palmas', 'Vecindario', 'C/ Velero, 80', '+34680240934', '2016-11-04 08:43:10'),
(10, '123456789A', 'Antonio', 'del Carmen', 'correo@falso.com', 'Las Palmas', 'Vecindario', 'C/ Velero, 80', '+34680240934', '2016-11-04 08:43:10'),
(11, '123456789A', 'Antonio', 'del Carmen', 'correo@falso.com', 'Las Palmas', 'Vecindario', 'C/ Velero, 80', '+34680240934', '2016-11-04 08:43:10'),
(12, '123456789A', 'Antonio', 'del Carmen', 'correo@falso.com', 'Las Palmas', 'Vecindario', 'C/ Velero, 80', '+34680240934', '2016-11-04 08:43:10'),
(13, '123456789A', 'Antonio', 'del Carmen', 'correo@falso.com', 'Las Palmas', 'Vecindario', 'C/ Velero, 80', '+34680240934', '2016-11-04 08:43:10');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `hosting`
--
ALTER TABLE `hosting`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `hosting`
--
ALTER TABLE `hosting`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
