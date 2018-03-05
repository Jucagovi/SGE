-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-03-2018 a las 14:50:49
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Estructura de tabla para la tabla `gen_accede`
--

CREATE TABLE `gen_accede` (
  `id_modulo` int(11) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `id_permiso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gen_accede_his`
--

CREATE TABLE `gen_accede_his` (
  `id_accede` int(11) NOT NULL,
  `id_modulo` int(11) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `id_permiso` int(11) NOT NULL,
  `fecha_acc` datetime NOT NULL COMMENT 'Fecha de acceso a la aplicación',
  `id_tipo_acceso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gen_empleados`
--

CREATE TABLE `gen_empleados` (
  `id_empleado` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `apellidos` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `fecha_nac` date NOT NULL COMMENT 'Fecha nacimiento',
  `fecha_inc` date NOT NULL COMMENT 'Fecha de incorporación',
  `usuario` varchar(100) COLLATE latin1_general_ci NOT NULL COMMENT 'Ususario de acceso a la aplicación',
  `contrasena` text COLLATE latin1_general_ci NOT NULL COMMENT 'Contraseña de acceso a la aplicación',
  `curriculum` varchar(512) CHARACTER SET latin1 COLLATE latin1_general_cs DEFAULT NULL,
  `foto` varchar(512) COLLATE latin1_general_ci DEFAULT NULL,
  `id_departamento` int(11) DEFAULT NULL,
  `nif` varchar(15) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Volcado de datos para la tabla `gen_empleados`
--

INSERT INTO `gen_empleados` (`id_empleado`, `nombre`, `apellidos`, `fecha_nac`, `fecha_inc`, `usuario`, `contrasena`, `curriculum`, `foto`, `id_departamento`, `nif`) VALUES
(150, 'Manuel Alejandro', 'Ruiz Hernandez', '2018-01-12', '2018-02-08', 'Nellex', '988788', 'Alex Curriculum', 'Alex Foto', 180, '456456'),
(180, 'Jorge Nombre', 'Jorge Apellidos', '2018-01-28', '2018-02-28', 'Jorge Usuario', 'Jorge Contraseña', 'Jorge Curriculum', 'Jorge Foto', 180, '654654');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gen_mensajes`
--

CREATE TABLE `gen_mensajes` (
  `id_mensaje` int(11) NOT NULL,
  `destinatario` int(11) NOT NULL,
  `fecha_env` date NOT NULL,
  `texto` text COLLATE latin1_general_ci NOT NULL COMMENT 'Cuerpo del mensaje',
  `id_empleado` int(11) NOT NULL COMMENT 'Remitente del mensaje',
  `id_modulo` int(11) NOT NULL COMMENT 'Módulo al que va dirigido',
  `id_tipo_mensaje` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gen_modulos`
--

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
(4, 'RRHH', 'Gestiona Recursos Humanos.', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gen_permisos`
--

CREATE TABLE `gen_permisos` (
  `id_permiso` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `descripcion` text COLLATE latin1_general_ci,
  `valor` int(11) NOT NULL COMMENT 'Valor numérico del permiso'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gen_secciones`
--

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
(9, 'Administración de Departamentos', 'Gestión de departamento', 0, 1, 4, 'administracionDepartamentos'),
(10, 'Gestión de Procesos de Seleccion', 'Gestión de procesos de seleccion', 0, 2, 4, 'gestionProcesosSeleccion'),
(11, 'Gestión de Ausencias', 'Gestión de ausencias', 0, 3, 4, 'gestionAusencias');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gen_subsecciones`
--

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
(23, 'Administracion de Departamentos', NULL, 0, 1, 9, 'administracionDepartamentos'),
(24, 'Cambio de Personal', NULL, 0, 2, 9, 'cambioPersonal'),
(25, 'Histórico', NULL, 0, 3, 9, 'historico'),
(26, 'Administracion de Proceso de Seleccion', NULL, 0, 1, 10, 'administracionProcesoSeleccion'),
(27, 'Creacion de Proceso de Seleccion', NULL, 0, 2, 10, 'creacionProcesoSeleccion'),
(28, 'Notificaciones de Ausencias', NULL, 0, 1, 11, 'notificacionesAusencias'),
(29, 'Ausencias', NULL, 0, 2, 11, 'ausencias'),
(30, 'Solicitar Ausencias', NULL, 0, 3, 11, 'solicitarAusencias'),
(31, 'Calendario', NULL, 0, 4, 11, 'calendario'),
(32, 'Configuracion', NULL, 0, 5, 11, 'configuracion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gen_tipo_acceso`
--

CREATE TABLE `gen_tipo_acceso` (
  `id_tipo_acceso` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `descripcion` text COLLATE latin1_spanish_ci
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gen_tipo_mensaje`
--

CREATE TABLE `gen_tipo_mensaje` (
  `id_tipo_mensaje` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `descripcion` text COLLATE latin1_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rrhh_ausencia`
--

CREATE TABLE `rrhh_ausencia` (
  `id_empleado` int(15) NOT NULL,
  `id_tipo_ausencia` int(15) NOT NULL,
  `id_estado_tramite` int(15) NOT NULL,
  `fecha_solicitud` date NOT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `duracion` int(3) DEFAULT NULL,
  `descripcion` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rrhh_candidato`
--

CREATE TABLE `rrhh_candidato` (
  `id_candidato` int(15) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `fecha_nac` date NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `curriculum` varchar(300) DEFAULT NULL,
  `nota_interna` text,
  `descripcion` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `rrhh_candidato`
--

INSERT INTO `rrhh_candidato` (`id_candidato`, `nombre`, `apellidos`, `fecha_nac`, `telefono`, `foto`, `curriculum`, `nota_interna`, `descripcion`) VALUES
(9, 'Juan Francisco', 'Jimenez', '2018-03-02', '987654321', 'Foto 1', 'Curriculum Juan', 'Gran actitud', 'Buena presentacion'),
(10, 'Jose', 'Alberti', '2018-03-02', '987654321', 'Foto 2', 'Curriculum Jose', 'Candidato Interesante', 'Buena base para el puesto'),
(0, 'Paco', 'Alca', '2018-02-01', '987654312', 'Foto', 'Curriculum', 'Nota Interna', 'Buena');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rrhh_candidato_proceso_seleccion`
--

CREATE TABLE `rrhh_candidato_proceso_seleccion` (
  `id_cps` int(11) NOT NULL,
  `id_candidato` int(15) NOT NULL,
  `id_proceso_seleccion` int(15) NOT NULL,
  `id_estado_proceso` int(15) NOT NULL,
  `descripcion` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `rrhh_candidato_proceso_seleccion`
--

INSERT INTO `rrhh_candidato_proceso_seleccion` (`id_cps`, `id_candidato`, `id_proceso_seleccion`, `id_estado_proceso`, `descripcion`) VALUES
(1, 9, 1, 1, 'Descripcion'),
(2, 10, 1, 1, 'Descripcion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rrhh_departamento`
--

CREATE TABLE `rrhh_departamento` (
  `id_departamento` int(15) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `fecha_creacion` date NOT NULL,
  `localizacion` text,
  `responsable` int(15) DEFAULT NULL,
  `descripcion` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `rrhh_departamento`
--

INSERT INTO `rrhh_departamento` (`id_departamento`, `nombre`, `fecha_creacion`, `localizacion`, `responsable`, `descripcion`) VALUES
(180, 'Recursos Humanos', '2018-02-12', 'Elche', 150, 'Departamento Recursos Humanos Nuevo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rrhh_estado_proceso`
--

CREATE TABLE `rrhh_estado_proceso` (
  `id_estado_proceso` int(15) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `rrhh_estado_proceso`
--

INSERT INTO `rrhh_estado_proceso` (`id_estado_proceso`, `nombre`, `descripcion`) VALUES
(1, 'Entrevistado', 'Se ha realizado la entrevista'),
(2, 'Preseleccionado', 'Se ha añadido al proceso'),
(3, 'Seleccionado', 'Se ha seleccionado para el trabajo'),
(4, 'Descartado', 'Se ha descartado para el trabajo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rrhh_estado_tramite`
--

CREATE TABLE `rrhh_estado_tramite` (
  `id_estado_tramite` int(15) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `rrhh_estado_tramite`
--

INSERT INTO `rrhh_estado_tramite` (`id_estado_tramite`, `nombre`, `descripcion`) VALUES
(1, 'Tramite', 'Se esta valorando'),
(2, 'Confirmado', 'Se confirma'),
(3, 'Denegada', 'Peticion denegada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rrhh_etapa_proceso`
--

CREATE TABLE `rrhh_etapa_proceso` (
  `id_etapa_proceso` int(15) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `rrhh_etapa_proceso`
--

INSERT INTO `rrhh_etapa_proceso` (`id_etapa_proceso`, `nombre`, `descripcion`) VALUES
(1, 'Inicial', NULL),
(2, 'Entrevista', NULL),
(3, 'Preseleccionado', NULL),
(4, 'Seleccionado', NULL),
(5, 'Cerrado', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rrhh_historico`
--

CREATE TABLE `rrhh_historico` (
  `id_departamento` int(15) NOT NULL,
  `id_empleado` int(15) NOT NULL,
  `fecha` date DEFAULT NULL,
  `descripcion` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `rrhh_historico`
--

INSERT INTO `rrhh_historico` (`id_departamento`, `id_empleado`, `fecha`, `descripcion`) VALUES
(180, 150, '2018-03-03', NULL),
(180, 150, '2018-03-03', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rrhh_proceso_seleccion`
--

CREATE TABLE `rrhh_proceso_seleccion` (
  `id_proceso_seleccion` int(15) NOT NULL,
  `id_departamento` int(15) NOT NULL,
  `id_etapa_proceso` int(15) NOT NULL,
  `id_estado_proceso` int(15) NOT NULL,
  `fecha_creacion` date NOT NULL,
  `puesto` varchar(50) NOT NULL,
  `numero_plazas` int(5) DEFAULT NULL,
  `descripcion` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `rrhh_proceso_seleccion`
--

INSERT INTO `rrhh_proceso_seleccion` (`id_proceso_seleccion`, `id_departamento`, `id_etapa_proceso`, `id_estado_proceso`, `fecha_creacion`, `puesto`, `numero_plazas`, `descripcion`) VALUES
(1, 180, 1, 1, '2018-03-02', 'Instructor', 2, 'Puesto de Instructor'),
(2, 180, 1, 0, '2005-12-12', 'Jefe', 1, 'Buen Jefe');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rrhh_tipo_ausencia`
--

CREATE TABLE `rrhh_tipo_ausencia` (
  `id_tipo_ausencia` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `duracion_maxima` int(11) DEFAULT NULL,
  `descripcion` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
-- Indices de la tabla `gen_subsecciones`
--
ALTER TABLE `gen_subsecciones`
  ADD PRIMARY KEY (`id_subsecciones`);

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
-- Indices de la tabla `rrhh_ausencia`
--
ALTER TABLE `rrhh_ausencia`
  ADD KEY `id_ausencia` (`id_tipo_ausencia`);

--
-- Indices de la tabla `rrhh_estado_tramite`
--
ALTER TABLE `rrhh_estado_tramite`
  ADD KEY `id_estado_tramite` (`id_estado_tramite`);

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
  MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;
--
-- AUTO_INCREMENT de la tabla `gen_mensajes`
--
ALTER TABLE `gen_mensajes`
  MODIFY `id_mensaje` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `gen_modulos`
--
ALTER TABLE `gen_modulos`
  MODIFY `id_modulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `gen_permisos`
--
ALTER TABLE `gen_permisos`
  MODIFY `id_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `gen_secciones`
--
ALTER TABLE `gen_secciones`
  MODIFY `id_seccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `gen_subsecciones`
--
ALTER TABLE `gen_subsecciones`
  MODIFY `id_subsecciones` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT de la tabla `gen_tipo_acceso`
--
ALTER TABLE `gen_tipo_acceso`
  MODIFY `id_tipo_acceso` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `gen_tipo_mensaje`
--
ALTER TABLE `gen_tipo_mensaje`
  MODIFY `id_tipo_mensaje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
