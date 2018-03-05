-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-01-2018 a las 11:15:22
-- Versión del servidor: 10.1.28-MariaDB
-- Versión de PHP: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sge_proyecto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gen_modulos`
--

DROP TABLE IF EXISTS `gen_modulos`;
CREATE TABLE `gen_modulos` (
  `id_modulo` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `descripcion` text COLLATE latin1_general_ci,
  `orden` int(11) NOT NULL COMMENT 'Orden de impresión del módulo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Volcado de datos para la tabla `gen_modulos`
--

INSERT INTO `gen_modulos` (`id_modulo`, `nombre`, `descripcion`, `orden`) VALUES
(1, 'Ayuda', 'Muestra la ayuda de la aplicación.', 1000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gen_secciones`
--

DROP TABLE IF EXISTS `gen_secciones`;
CREATE TABLE `gen_secciones` (
  `id_seccion` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `descripcion` text COLLATE latin1_general_ci,
  `permiso` int(11) NOT NULL COMMENT 'Permiso mínimo de acceso',
  `orden` int(11) NOT NULL COMMENT 'Orden en el que se imprimirá la sección',
  `id_modulo` int(11) NOT NULL,
  `identificador` varchar(100) COLLATE latin1_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Volcado de datos para la tabla `gen_secciones`
--

INSERT INTO `gen_secciones` (`id_seccion`, `nombre`, `descripcion`, `permiso`, `orden`, `id_modulo`, `identificador`) VALUES
(1, 'Versión', 'Descripción fea de la Versión', 0, 1, 1, 'version'),
(2, 'Manual', 'Descripción fea del manual', 0, 1, 1, 'manual');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gen_subsecciones`
--

DROP TABLE IF EXISTS `gen_subsecciones`;
CREATE TABLE `gen_subsecciones` (
  `id_subsecciones` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `descripcion` text COLLATE latin1_general_ci,
  `permiso` int(11) NOT NULL,
  `orden` int(11) NOT NULL,
  `id_seccion` int(11) NOT NULL,
  `identificador` varchar(100) COLLATE latin1_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Volcado de datos para la tabla `gen_subsecciones`
--

INSERT INTO `gen_subsecciones` (`id_subsecciones`, `nombre`, `descripcion`, `permiso`, `orden`, `id_seccion`, `identificador`) VALUES
(1, 'Mostrar Versión', 'Muestra la versión del módulo ayuda.', 0, 1, 1, 'mostrarVersion'),
(2, 'Ver tablas', 'Muestra las tablas existentes en la aplicación.', 0, 2, 1, 'mostrarTablas');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `gen_modulos`
--
ALTER TABLE `gen_modulos`
  ADD PRIMARY KEY (`id_modulo`);

--
-- Indices de la tabla `gen_secciones`
--
ALTER TABLE `gen_secciones`
  ADD PRIMARY KEY (`id_seccion`);

--
-- Indices de la tabla `gen_subsecciones`
--
ALTER TABLE `gen_subsecciones`
  ADD PRIMARY KEY (`id_subsecciones`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `gen_modulos`
--
ALTER TABLE `gen_modulos`
  MODIFY `id_modulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `gen_secciones`
--
ALTER TABLE `gen_secciones`
  MODIFY `id_seccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `gen_subsecciones`
--
ALTER TABLE `gen_subsecciones`
  MODIFY `id_subsecciones` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
