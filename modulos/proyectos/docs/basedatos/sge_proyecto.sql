-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-01-2018 a las 10:09:49
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
CREATE DATABASE IF NOT EXISTS `sge_proyecto` DEFAULT CHARACTER SET latin1 COLLATE latin1_general_ci;
USE `sge_proyecto`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gen_accede`
--

DROP TABLE IF EXISTS `gen_accede`;
CREATE TABLE `gen_accede` (
  `id_modulo` int(11) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `id_permiso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Truncar tablas antes de insertar `gen_accede`
--

TRUNCATE TABLE `gen_accede`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gen_accede_his`
--

DROP TABLE IF EXISTS `gen_accede_his`;
CREATE TABLE `gen_accede_his` (
  `id_accede` int(11) NOT NULL,
  `id_modulo` int(11) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `id_permiso` int(11) NOT NULL,
  `fecha_acc` datetime NOT NULL COMMENT 'Fecha de acceso a la aplicación',
  `id_tipo_acceso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Truncar tablas antes de insertar `gen_accede_his`
--

TRUNCATE TABLE `gen_accede_his`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gen_empleados`
--

DROP TABLE IF EXISTS `gen_empleados`;
CREATE TABLE `gen_empleados` (
  `id_empleado` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `apellidos` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `fecha_nac` date NOT NULL COMMENT 'Fecha nacimiento',
  `fecha_inc` date NOT NULL COMMENT 'Fecha de incorporación',
  `usuario` varchar(100) COLLATE latin1_general_ci NOT NULL COMMENT 'Ususario de acceso a la aplicación',
  `contrasena` text COLLATE latin1_general_ci NOT NULL COMMENT 'Contraseña de acceso a la aplicación'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Truncar tablas antes de insertar `gen_empleados`
--

TRUNCATE TABLE `gen_empleados`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gen_mensajes`
--

DROP TABLE IF EXISTS `gen_mensajes`;
CREATE TABLE `gen_mensajes` (
  `id_mensaje` int(11) NOT NULL,
  `destinatario` int(11) NOT NULL,
  `fecha_env` date NOT NULL,
  `texto` text COLLATE latin1_general_ci NOT NULL COMMENT 'Cuerpo del mensaje',
  `id_empleado` int(11) NOT NULL COMMENT 'Remitente del mensaje',
  `id_modulo` int(11) NOT NULL COMMENT 'Módulo al que va dirigido',
  `id_tipo_mensaje` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Truncar tablas antes de insertar `gen_mensajes`
--

TRUNCATE TABLE `gen_mensajes`;
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
-- Truncar tablas antes de insertar `gen_modulos`
--

TRUNCATE TABLE `gen_modulos`;
--
-- Volcado de datos para la tabla `gen_modulos`
--

INSERT INTO `gen_modulos` (`id_modulo`, `nombre`, `descripcion`, `orden`) VALUES
(1, 'Inicio', NULL, 0),
(2, 'Ayuda', NULL, 1000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gen_permisos`
--

DROP TABLE IF EXISTS `gen_permisos`;
CREATE TABLE `gen_permisos` (
  `id_permiso` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `descripcion` text COLLATE latin1_general_ci,
  `valor` int(11) NOT NULL COMMENT 'Valor numérico del permiso'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Truncar tablas antes de insertar `gen_permisos`
--

TRUNCATE TABLE `gen_permisos`;
--
-- Volcado de datos para la tabla `gen_permisos`
--

INSERT INTO `gen_permisos` (`id_permiso`, `nombre`, `descripcion`, `valor`) VALUES
(1, 'Sin acceso', 'No tiene acceso al módulo', 0),
(2, 'Lectura', 'Puede leer datos', 3),
(3, 'Edición', 'El usuario puede editar sus datos', 6),
(4, 'Administración', 'El usuario tiene pleno control de módulo', 10);

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
  `id_modulo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Truncar tablas antes de insertar `gen_secciones`
--

TRUNCATE TABLE `gen_secciones`;
--
-- Volcado de datos para la tabla `gen_secciones`
--

INSERT INTO `gen_secciones` (`id_seccion`, `nombre`, `descripcion`, `permiso`, `orden`, `id_modulo`) VALUES
(1, 'Presentación', NULL, 0, 0, 1),
(2, 'Preguntas frecuentes', NULL, 0, 1, 1),
(3, 'Versión', 'Descripción fea de la Versión', 0, 1, 2),
(4, 'Manual', 'Descripción fea del manual', 0, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gen_tipo_acceso`
--

DROP TABLE IF EXISTS `gen_tipo_acceso`;
CREATE TABLE `gen_tipo_acceso` (
  `id_tipo_acceso` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `descripcion` text COLLATE latin1_spanish_ci
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Truncar tablas antes de insertar `gen_tipo_acceso`
--

TRUNCATE TABLE `gen_tipo_acceso`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gen_tipo_mensaje`
--

DROP TABLE IF EXISTS `gen_tipo_mensaje`;
CREATE TABLE `gen_tipo_mensaje` (
  `id_tipo_mensaje` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `descripcion` text COLLATE latin1_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Truncar tablas antes de insertar `gen_tipo_mensaje`
--

TRUNCATE TABLE `gen_tipo_mensaje`;
--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `gen_accede`
--
ALTER TABLE `gen_accede`
  ADD PRIMARY KEY (`id_modulo`,`id_empleado`,`id_permiso`);

--
-- Indices de la tabla `gen_accede_his`
--
ALTER TABLE `gen_accede_his`
  ADD PRIMARY KEY (`id_accede`);

--
-- Indices de la tabla `gen_empleados`
--
ALTER TABLE `gen_empleados`
  ADD PRIMARY KEY (`id_empleado`);

--
-- Indices de la tabla `gen_mensajes`
--
ALTER TABLE `gen_mensajes`
  ADD PRIMARY KEY (`id_mensaje`);

--
-- Indices de la tabla `gen_modulos`
--
ALTER TABLE `gen_modulos`
  ADD PRIMARY KEY (`id_modulo`);

--
-- Indices de la tabla `gen_permisos`
--
ALTER TABLE `gen_permisos`
  ADD PRIMARY KEY (`id_permiso`);

--
-- Indices de la tabla `gen_secciones`
--
ALTER TABLE `gen_secciones`
  ADD PRIMARY KEY (`id_seccion`);

--
-- Indices de la tabla `gen_tipo_acceso`
--
ALTER TABLE `gen_tipo_acceso`
  ADD PRIMARY KEY (`id_tipo_acceso`);

--
-- Indices de la tabla `gen_tipo_mensaje`
--
ALTER TABLE `gen_tipo_mensaje`
  ADD PRIMARY KEY (`id_tipo_mensaje`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `gen_accede_his`
--
ALTER TABLE `gen_accede_his`
  MODIFY `id_accede` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `gen_empleados`
--
ALTER TABLE `gen_empleados`
  MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `gen_mensajes`
--
ALTER TABLE `gen_mensajes`
  MODIFY `id_mensaje` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `gen_modulos`
--
ALTER TABLE `gen_modulos`
  MODIFY `id_modulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `gen_permisos`
--
ALTER TABLE `gen_permisos`
  MODIFY `id_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `gen_secciones`
--
ALTER TABLE `gen_secciones`
  MODIFY `id_seccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `gen_tipo_acceso`
--
ALTER TABLE `gen_tipo_acceso`
  MODIFY `id_tipo_acceso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `gen_tipo_mensaje`
--
ALTER TABLE `gen_tipo_mensaje`
  MODIFY `id_tipo_mensaje` int(11) NOT NULL AUTO_INCREMENT;
