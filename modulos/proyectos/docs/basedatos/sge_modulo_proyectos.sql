-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-02-2018 a las 19:45:00
-- Versión del servidor: 10.1.29-MariaDB
-- Versión de PHP: 7.2.0

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
-- Estructura de tabla para la tabla `pro_historico`
--

DROP TABLE IF EXISTS `pro_historico`;
CREATE TABLE `pro_historico` (
  `id_historico` int(11) NOT NULL,
  `accion` text COLLATE latin1_general_ci NOT NULL,
  `fecha` datetime NOT NULL,
  `id_empleado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pro_jornada`
--

DROP TABLE IF EXISTS `pro_jornada`;
CREATE TABLE `pro_jornada` (
  `id_jornada` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `horas` decimal(15,5) NOT NULL,
  `id_tarea` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pro_proyecto`
--

DROP TABLE IF EXISTS `pro_proyecto`;
CREATE TABLE `pro_proyecto` (
  `id_proyecto` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `descripcion` text COLLATE latin1_general_ci,
  `responsables` text COLLATE latin1_general_ci NOT NULL,
  `fecha_fin` date DEFAULT NULL,
  `coste` decimal(15,5) NOT NULL,
  `iva` decimal(15,5) NOT NULL,
  `descuento` decimal(15,5) NOT NULL,
  `estado` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `imagen` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `id_tipo_proyecto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pro_tarea`
--

DROP TABLE IF EXISTS `pro_tarea`;
CREATE TABLE `pro_tarea` (
  `id_tarea` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `descripcion` text COLLATE latin1_general_ci,
  `horas_presupuestadas` decimal(15,5) NOT NULL,
  `fecha_fin` date DEFAULT NULL,
  `ficheros` text CHARACTER SET latin1 COLLATE latin1_general_cs,
  `id_tipo_tarea` int(11) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `id_proyecto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pro_tipo_etapa`
--

DROP TABLE IF EXISTS `pro_tipo_etapa`;
CREATE TABLE `pro_tipo_etapa` (
  `id_tipo_etapa` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `descripcion` text COLLATE latin1_general_ci,
  `id_tipo_proyecto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pro_tipo_proyecto`
--

DROP TABLE IF EXISTS `pro_tipo_proyecto`;
CREATE TABLE `pro_tipo_proyecto` (
  `id_tipo_proyecto` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `descripcion` text COLLATE latin1_general_ci,
  `imagen` varchar(200) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pro_tipo_tarea`
--

DROP TABLE IF EXISTS `pro_tipo_tarea`;
CREATE TABLE `pro_tipo_tarea` (
  `id_tipo_tarea` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `descripcion` text COLLATE latin1_general_ci,
  `precio` decimal(15,5) NOT NULL,
  `id_tipo_etapa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `pro_historico`
--
ALTER TABLE `pro_historico`
  ADD PRIMARY KEY (`id_historico`);

--
-- Indices de la tabla `pro_jornada`
--
ALTER TABLE `pro_jornada`
  ADD PRIMARY KEY (`id_jornada`);

--
-- Indices de la tabla `pro_proyecto`
--
ALTER TABLE `pro_proyecto`
  ADD PRIMARY KEY (`id_proyecto`);

--
-- Indices de la tabla `pro_tarea`
--
ALTER TABLE `pro_tarea`
  ADD PRIMARY KEY (`id_tarea`);

--
-- Indices de la tabla `pro_tipo_etapa`
--
ALTER TABLE `pro_tipo_etapa`
  ADD PRIMARY KEY (`id_tipo_etapa`);

--
-- Indices de la tabla `pro_tipo_proyecto`
--
ALTER TABLE `pro_tipo_proyecto`
  ADD PRIMARY KEY (`id_tipo_proyecto`);

--
-- Indices de la tabla `pro_tipo_tarea`
--
ALTER TABLE `pro_tipo_tarea`
  ADD PRIMARY KEY (`id_tipo_tarea`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `pro_historico`
--
ALTER TABLE `pro_historico`
  MODIFY `id_historico` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pro_jornada`
--
ALTER TABLE `pro_jornada`
  MODIFY `id_jornada` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pro_proyecto`
--
ALTER TABLE `pro_proyecto`
  MODIFY `id_proyecto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pro_tarea`
--
ALTER TABLE `pro_tarea`
  MODIFY `id_tarea` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pro_tipo_etapa`
--
ALTER TABLE `pro_tipo_etapa`
  MODIFY `id_tipo_etapa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pro_tipo_proyecto`
--
ALTER TABLE `pro_tipo_proyecto`
  MODIFY `id_tipo_proyecto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pro_tipo_tarea`
--
ALTER TABLE `pro_tipo_tarea`
  MODIFY `id_tipo_tarea` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
