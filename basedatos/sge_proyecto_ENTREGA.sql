-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-03-2018 a las 09:04:02
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
-- Estructura de tabla para la tabla `com_atributos`
--

CREATE TABLE `com_atributos` (
  `id_atributo` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `com_contactos`
--

CREATE TABLE `com_contactos` (
  `id_contacto` int(11) NOT NULL,
  `nombre` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `departamento` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `id_proveedor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Volcado de datos para la tabla `com_contactos`
--

INSERT INTO `com_contactos` (`id_contacto`, `nombre`, `departamento`, `id_proveedor`) VALUES
(1, 'Ricardo Gonz?lez', 'Almac?n', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `com_fases_pedido`
--

CREATE TABLE `com_fases_pedido` (
  `id_fase_pedido` int(11) NOT NULL,
  `fase` varchar(50) COLLATE latin1_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Volcado de datos para la tabla `com_fases_pedido`
--

INSERT INTO `com_fases_pedido` (`id_fase_pedido`, `fase`) VALUES
(1, 'Pedido Interno'),
(2, 'Pedido'),
(3, 'En espera de recepcion'),
(4, 'Recibido'),
(5, 'Cancelado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `com_metodos_pago`
--

CREATE TABLE `com_metodos_pago` (
  `id_metodo_pago` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `descripcion` varchar(50) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Volcado de datos para la tabla `com_metodos_pago`
--

INSERT INTO `com_metodos_pago` (`id_metodo_pago`, `nombre`, `descripcion`) VALUES
(1, 'Paypal', 'Famosa forma de pago utilizada en transacciones on');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `com_metodos_proveedor`
--

CREATE TABLE `com_metodos_proveedor` (
  `id_metodo_proveedor` int(11) NOT NULL,
  `id_proveedor` int(11) DEFAULT NULL,
  `id_metodo_pago` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `com_proveedores`
--

CREATE TABLE `com_proveedores` (
  `id_proveedor` int(11) NOT NULL,
  `cif` char(9) COLLATE latin1_general_ci NOT NULL,
  `nombre` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `direccion` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `cod_postal` char(5) COLLATE latin1_general_ci NOT NULL,
  `poblacion` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `provincia` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `telefono` char(9) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(50) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Volcado de datos para la tabla `com_proveedores`
--

INSERT INTO `com_proveedores` (`id_proveedor`, `cif`, `nombre`, `direccion`, `cod_postal`, `poblacion`, `provincia`, `telefono`, `email`) VALUES
(1, 'A23242525', 'Suelas Mart?nez S.L', 'Avda. de Santo domingo 33', '04321', 'Valencia', 'Valencia', '963889254', 'info@suelasmartinez.es');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `emp_categorias_dietas`
--

CREATE TABLE `emp_categorias_dietas` (
  `id_categoria` int(2) NOT NULL,
  `nombre` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `descripcion` text COLLATE latin1_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Volcado de datos para la tabla `emp_categorias_dietas`
--

INSERT INTO `emp_categorias_dietas` (`id_categoria`, `nombre`, `descripcion`) VALUES
(1, 'transporte', 'se mueve'),
(2, 'sobresueldo', 'dinero');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `emp_categorias_eventos`
--

CREATE TABLE `emp_categorias_eventos` (
  `id_categoria` int(2) NOT NULL,
  `nombre` varchar(20) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Volcado de datos para la tabla `emp_categorias_eventos`
--

INSERT INTO `emp_categorias_eventos` (`id_categoria`, `nombre`) VALUES
(1, 'obligatorio'),
(2, 'divertido');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `emp_clientes`
--

CREATE TABLE `emp_clientes` (
  `id_cliente` int(11) NOT NULL,
  `nombre` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `apellidos` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `usuario` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `contrasenya` varchar(20) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `emp_dietas`
--

CREATE TABLE `emp_dietas` (
  `id_dieta` int(11) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `categoria` int(2) NOT NULL,
  `importe` float(5,2) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Volcado de datos para la tabla `emp_dietas`
--

INSERT INTO `emp_dietas` (`id_dieta`, `id_empleado`, `categoria`, `importe`, `fecha`) VALUES
(1, 1, 1, 200.00, '2018-04-13'),
(2, 1, 2, 999.99, '2018-03-15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `emp_empleados_eventos`
--

CREATE TABLE `emp_empleados_eventos` (
  `id_empleado_evento` int(11) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `id_evento` int(11) NOT NULL,
  `confirmado` int(1) NOT NULL,
  `fecha_confirmacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `emp_eventos`
--

CREATE TABLE `emp_eventos` (
  `id_evento` int(11) NOT NULL,
  `nombre` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Volcado de datos para la tabla `emp_eventos`
--

INSERT INTO `emp_eventos` (`id_evento`, `nombre`, `fecha`) VALUES
(1, 'Acampada', '2018-03-22'),
(2, 'Visita', '2018-03-27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `emp_eventos_categorias`
--

CREATE TABLE `emp_eventos_categorias` (
  `id_evento_categoria` int(11) NOT NULL,
  `id_evento` int(11) NOT NULL,
  `id_categoria` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `emp_mensajes`
--

CREATE TABLE `emp_mensajes` (
  `id_mensaje` int(11) NOT NULL,
  `id_emp_emisor` int(11) NOT NULL,
  `contenido` text COLLATE latin1_general_ci,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `emp_mensajes_empleados`
--

CREATE TABLE `emp_mensajes_empleados` (
  `id_mensaje_empleado` int(11) NOT NULL,
  `id_mensaje` int(11) NOT NULL,
  `id_emp_receptor` int(11) NOT NULL,
  `estado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `emp_pedidos_empleados`
--

CREATE TABLE `emp_pedidos_empleados` (
  `id_pedido_empleado` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `for_curso`
--

CREATE TABLE `for_curso` (
  `id_curso` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `vacantes` int(11) NOT NULL DEFAULT '0',
  `descripcion` varchar(200) COLLATE latin1_general_ci NOT NULL DEFAULT '0',
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `periodo_inscripcion` date NOT NULL,
  `periodo_fin_inscripcion` date NOT NULL,
  `id_empleado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Volcado de datos para la tabla `for_curso`
--

INSERT INTO `for_curso` (`id_curso`, `nombre`, `vacantes`, `descripcion`, `fecha_inicio`, `fecha_fin`, `periodo_inscripcion`, `periodo_fin_inscripcion`, `id_empleado`) VALUES
(1, 'Informática', 20, 'Curso de informática avanzada destinado al desarrolo de aplicaciones.', '2018-05-13', '2018-09-13', '2018-04-13', '2018-04-30', 13141516),
(2, 'Inglés', 20, 'Curso dedicado a mejorar el inglés de los empleados.', '2018-09-01', '2018-12-01', '2018-08-01', '2018-08-15', 13141517),
(3, 'Logística', 6, 'Curso de logística.', '2018-05-13', '2018-09-13', '2018-04-13', '2018-04-30', 13141516),
(4, 'Comunicación', 10, 'Curso dedicado al desarrollo la capacidad comunicativa de la gente.', '2018-09-01', '2018-12-01', '2018-08-01', '2018-08-15', 13141517);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `for_solicitud`
--

CREATE TABLE `for_solicitud` (
  `id_solicitud` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL DEFAULT '0',
  `descripcion` varchar(200) COLLATE latin1_general_ci NOT NULL DEFAULT '0',
  `id_empleado` int(11) NOT NULL DEFAULT '0',
  `estado` varchar(20) COLLATE latin1_general_ci NOT NULL DEFAULT 'SIN APROBAR'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Volcado de datos para la tabla `for_solicitud`
--

INSERT INTO `for_solicitud` (`id_solicitud`, `id_curso`, `descripcion`, `id_empleado`, `estado`) VALUES
(53, 4, 'Soy Federico y estoy interesado en comunicarme.', 13141517, 'APROBADA'),
(54, 1, 'Soy Eufrasio y quiero ser informático.', 13141516, 'SIN APROBAR'),
(55, 2, 'Quiero extender mis conocimientos de inglés.', 13141516, 'SIN APROBAR'),
(56, 3, 'Me interesa este curso', 13141517, 'RECHAZADA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `for_unidad`
--

CREATE TABLE `for_unidad` (
  `id_unidad` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `duracion_horas` int(11) NOT NULL,
  `nombre_unidad` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `porcentaje_curso` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Volcado de datos para la tabla `for_unidad`
--

INSERT INTO `for_unidad` (`id_unidad`, `id_curso`, `duracion_horas`, `nombre_unidad`, `porcentaje_curso`) VALUES
(1, 1, 60, 'Ofimática', 40),
(2, 1, 120, 'HTML y CSS', 60),
(3, 2, 260, 'Speaking intensivo', 100),
(4, 3, 300, 'Estudio de mercado', 100),
(5, 4, 200, 'Comunicación oral', 80),
(6, 4, 5, 'Charlas', 20);

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
  `id_departamento` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Volcado de datos para la tabla `gen_empleados`
--

INSERT INTO `gen_empleados` (`id_empleado`, `nombre`, `apellidos`, `fecha_nac`, `fecha_inc`, `usuario`, `contrasena`, `curriculum`, `foto`, `id_departamento`) VALUES
(-1, 'Anonimo', '', '2018-03-01', '2018-03-01', '', '', NULL, NULL, NULL),
(1, 'Maribel', 'Antonio', '2018-03-07', '2018-03-01', 'Maribel', '1234', NULL, NULL, 0),
(2, 'Antonio', 'Antunez', '2018-03-05', '2018-03-06', 'Antionio', '1234', '', '', 0),
(13141516, 'Eufrasio', 'Tomelloso Martínez', '1975-03-02', '2000-03-02', 'eufrasio', 'eufrasio', NULL, NULL, NULL),
(13141517, 'Federico', 'García Maldonado', '1980-03-02', '2000-03-02', 'federico', 'federico', NULL, NULL, NULL);

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
(1, 'Ayuda', 'Muestra la ayuda de la aplicación.', 1000),
(2, 'Empleados', 'Gestiona empleados.', 2),
(3, 'Compras', 'Gestion de pedidos, recepciones y compras', 3),
(5, 'Formacion', 'Gestiona la formación de empleados', 3),
(6, 'Proyectos', NULL, 1),
(7, 'Inventario', 'Módulo de Inventario.', 2000),
(8, 'Ventas', 'Módulo de ventas', 10),
(9, 'RRHH', 'Gestiona Recursos Humanos.', 2);

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
(2, 'Manual', 'Descripción fea del manual', 0, 1, 1, 'manual'),
(3, 'Administración', 'Gestión de empleados', 0, 1, 2, 'administracion'),
(4, 'Eventos', 'Gestión de eventos', 0, 2, 2, 'eventos'),
(5, 'Mensajería', 'Gestión de mensajes internos', 0, 3, 2, 'mensajeria'),
(6, 'Compras', 'Compra de material', 0, 4, 2, 'compras'),
(7, 'Dietas', 'Gestión de dietas', 0, 5, 2, 'dietas'),
(9, 'Proveedores', NULL, 0, 1, 3, 'proveedores'),
(11, 'Presupuestos, pedidos y compras', NULL, 0, 3, 3, 'prepedcom'),
(12, 'Facturas de proveedor', NULL, 0, 4, 3, 'facturas'),
(19, 'Cursos', 'Se mostrarán los cursos disponibles para ser cursados.', 0, 1, 5, 'cursos'),
(20, 'Alumnado', 'Módulo pensado para la gestión del alumnado.', 0, 2, 5, 'alumnado'),
(21, 'Gestión de alumnado', 'Módulo de acceso exclusivo para un responsable de gestión del alumnado.', 0, 10, 5, 'gestionAlumnado'),
(22, 'Inicio', 'Ver el tablÃ³n del mÃ³dulo', 0, 1, 6, 'tablonProyectos'),
(23, 'Proyectos', 'Ver los proyectos', 0, 1, 6, 'verProyectos'),
(24, 'Presupuestos', 'Ver los presupuestos', 0, 1, 6, 'verPresupuestos'),
(25, 'Herramientas', 'Herramientas del mÃ³dulo', 0, 1, 6, 'herramientas'),
(26, 'Ayuda', NULL, 0, 1, 6, 'verAyudaProyectos'),
(27, 'Tablero', 'Tablero resumen.', 0, 1, 7, 'tablero'),
(28, 'Productos', 'Gestión de productos.', 0, 1, 7, 'productos'),
(29, 'Categorías', 'Gestión de categorías.', 0, 1, 7, 'categorias'),
(30, 'Inventario', 'Gestión de Inventario.', 0, 1, 7, 'list_inventario'),
(31, 'Transferencias', 'Gestión de Transferencias.', 0, 1, 7, 'transferencias'),
(32, 'Recepciones', 'Gestión de recepciones.', 0, 1, 7, 'recepciones'),
(33, 'Informes', 'Gestión de Informes.', 0, 1, 7, 'informes'),
(37, 'CLientes', 'Gestión de clientes', 0, 1, 8, 'clientes'),
(38, 'Métodos de pago', 'Gestión de métodos de pago', 0, 2, 8, 'metodos'),
(39, 'Equipos', 'Gestión de equipos de ventas', 0, 3, 8, 'equipos'),
(40, 'Ventas', 'Gestión de las ventas', 0, 4, 8, 'ventas'),
(41, 'Administración de Departamentos', 'Gestión de departamento', 0, 1, 9, 'administracionDepartamentos'),
(42, 'Gestión de Procesos de Seleccion', 'Gestión de procesos de seleccion', 0, 2, 9, 'gestionProcesosSeleccion'),
(43, 'Gestión de Ausencias', 'Gestión de ausencias', 0, 3, 9, 'gestionAusencias');

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
(1, 'Mostrar Versión', 'Muestra la versión del módulo ayuda.', 0, 1, 1, 'mostrarVersion'),
(2, 'Ver tablas', 'Muestra las tablas existentes en la aplicación.', 0, 2, 1, 'mostrarTablas'),
(3, 'Datos empleados', NULL, 0, 1, 3, 'datosEmpleados'),
(4, 'Alta empleado', NULL, 0, 2, 3, 'altaEmpleado'),
(5, 'Ver eventos', NULL, 0, 1, 4, 'verEventos'),
(6, 'Crear eventos', NULL, 0, 2, 4, 'crearEventos'),
(7, 'Categorías', NULL, 0, 3, 4, 'categoriasEventos'),
(8, 'Enviar mensaje', NULL, 0, 1, 5, 'enviarMensaje'),
(9, 'Leer mensajes', NULL, 0, 2, 5, 'leerMensajes'),
(10, 'Crear dieta', NULL, 0, 1, 7, 'crearDieta'),
(11, 'Categorías', NULL, 0, 3, 7, 'categoriasDietas'),
(12, 'Gestionar Proveedores', NULL, 0, 0, 9, 'gestionarProveedores'),
(13, 'Gestionar Metodos de Pago', NULL, 0, 0, 9, 'gestionarMetodos'),
(14, 'Gestionar Contactos', NULL, 0, 0, 9, 'gestionarContactos'),
(15, 'Gestionar Productos', NULL, 0, 0, 10, 'gestionarProductos'),
(16, 'Gestionar Tipos de Producto', NULL, 0, 0, 10, 'gestionarTipos'),
(17, 'Gestionar Categorias de Producto', NULL, 0, 0, 10, 'gestionarCategoria'),
(18, 'Gestionar Pedidos', NULL, 0, 0, 11, 'gestionPedidos'),
(19, 'Crear Fase de Venta', NULL, 0, 0, 11, 'crearFase'),
(20, 'Comprobar Envios a Recibir', NULL, 0, 0, 13, 'comprobarEnvio'),
(21, 'Notificar Estado de Envio', NULL, 0, 0, 13, 'notificarEstado'),
(26, 'Solicitudes Pendientes', 'Solicitudes pendientes a confirmar.', 0, 1, 16, 'solicitudesPendientes'),
(27, 'Unidades', 'Unidades de cada curso', 0, 1, 17, 'unidades'),
(32, 'Unidades', 'Unidades de cada curso', 0, 1, 18, 'unidades'),
(37, 'Unidades', 'Unidades de cada curso', 0, 1, 19, 'unidades'),
(38, 'Consulta De Solicitudes', 'Peticiones para la matriculación de un alumno nuevo a un curso.', 0, 2, 20, 'consultaSolicitudes'),
(39, 'Enviar Solicitud', 'El alumno reliza una soliciitud a un curso.', 0, 3, 20, 'enviarSolicitud'),
(40, 'Añadir Curso', 'Añade un nuevo curso.', 0, 1, 21, 'addCurso'),
(41, 'Solicitudes Pendientes', 'Solicitudes pendientes a confirmar.', 0, 1, 21, 'solicitudesPendientes'),
(42, 'Crear tipo de proyecto', 'Herramienta de generaciÃ³n de tipos de proyecto', 0, 1, 25, 'crearTipoProyecto'),
(43, 'Crear presupuesto', 'Herramienta para crear un presupuesto', 0, 2, 25, 'crearPresupuesto'),
(44, 'Crear Producto', 'Formulario para crear un producto.', 0, 1, 28, 'crearProducto'),
(45, 'Extraer Productos CSV', 'Permite la descarga de un fichero CSV con todos los productos.', 0, 1, 28, 'extraerCsv'),
(46, 'Crear Atributos', 'Formulario para crear atributos.', 0, 1, 29, 'crearAtributos'),
(47, 'Asignar Valores', 'Asigna valores a atributos de un producto.', 0, 1, 29, 'asignarValores'),
(48, 'Almacenes', 'Gestión de Almacenes.', 0, 1, 30, 'mostrarAlmacenes'),
(49, 'Secciones', 'Gestión de Secciones.', 0, 1, 30, 'mostrarSecciones'),
(50, 'Pasillos', 'Gestión de Pasillos.', 0, 1, 30, 'mostrarPasillos'),
(51, 'Crear Transferencia', 'Formulario para crear una transferencia.', 0, 1, 31, 'crearTransferencia'),
(52, 'Informe Productos', 'Muestra un informe de productos', 0, 1, 33, 'informeProductos'),
(63, 'Categorías', NULL, 0, 1, 37, 'categorias'),
(64, 'Comerciales', NULL, 0, 1, 39, 'comerciales'),
(65, 'TPV', NULL, 0, 2, 39, 'tpv'),
(66, 'Estados', NULL, 0, 1, 40, 'estados'),
(67, 'IVA', NULL, 0, 2, 40, 'iva'),
(68, 'Administracion de Departamentos', NULL, 0, 1, 41, 'administracionDepartamentos'),
(69, 'Cambio de Personal', NULL, 0, 2, 41, 'cambioPersonal'),
(70, 'Histórico', NULL, 0, 3, 41, 'historico'),
(71, 'Administracion de Proceso de Seleccion', NULL, 0, 1, 42, 'administracionProcesoSeleccion'),
(72, 'Creacion de Proceso de Seleccion', NULL, 0, 2, 42, 'creacionProcesoSeleccion'),
(73, 'Notificaciones de Ausencias', NULL, 0, 1, 43, 'notificacionesAusencias'),
(74, 'Ausencias', NULL, 0, 2, 43, 'ausencias'),
(75, 'Solicitar Ausencias', NULL, 0, 3, 43, 'solicitarAusencias'),
(76, 'Calendario', NULL, 0, 4, 43, 'calendario'),
(77, 'Configuracion', NULL, 0, 5, 43, 'configuracion');

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

--
-- Volcado de datos para la tabla `gen_tipo_mensaje`
--

INSERT INTO `gen_tipo_mensaje` (`id_tipo_mensaje`, `nombre`, `descripcion`) VALUES
(1, 'Individual', 'Mensaje dirigido específicamente a un empleado'),
(2, 'Público', 'Mensaje enviado a todos los empleados sin distinción de módulo ni permisos.'),
(3, 'Módulo', 'Mensaje enviado a todos los integrantres del módulo desde el que se envía');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inv_almacenes`
--

CREATE TABLE `inv_almacenes` (
  `id_almacen` int(10) NOT NULL,
  `nombre` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `cantProSec` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Volcado de datos para la tabla `inv_almacenes`
--

INSERT INTO `inv_almacenes` (`id_almacen`, `nombre`, `cantProSec`) VALUES
(1, 'Hardware', 0),
(2, 'Software', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inv_almsec`
--

CREATE TABLE `inv_almsec` (
  `id_almsec` int(10) NOT NULL,
  `id_almacen` int(10) DEFAULT NULL,
  `id_seccion` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inv_atributos`
--

CREATE TABLE `inv_atributos` (
  `id_atributo` int(10) NOT NULL,
  `nombre` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `descripcion` varchar(50) COLLATE latin1_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inv_catatr`
--

CREATE TABLE `inv_catatr` (
  `id_catatr` int(10) NOT NULL,
  `id_categoria` int(10) DEFAULT NULL,
  `id_atributo` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inv_categorias`
--

CREATE TABLE `inv_categorias` (
  `id_categoria` int(10) NOT NULL,
  `nombre` varchar(20) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inv_estadorecepciones`
--

CREATE TABLE `inv_estadorecepciones` (
  `id_estado` int(10) NOT NULL,
  `estado` varchar(20) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inv_estadotransferencias`
--

CREATE TABLE `inv_estadotransferencias` (
  `id_estado` int(10) NOT NULL,
  `estado` varchar(20) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inv_historicos`
--

CREATE TABLE `inv_historicos` (
  `id_historico` int(10) NOT NULL,
  `fecha` date NOT NULL,
  `modulo` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `usuario` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `accion` varchar(140) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inv_invalm`
--

CREATE TABLE `inv_invalm` (
  `id_invalm` int(10) NOT NULL,
  `id_inventario` int(10) DEFAULT NULL,
  `id_almacen` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inv_inventarios`
--

CREATE TABLE `inv_inventarios` (
  `id_inventario` int(10) NOT NULL,
  `nombre` varchar(20) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inv_pasillos`
--

CREATE TABLE `inv_pasillos` (
  `id_pasillo` int(10) NOT NULL,
  `nombre` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `cantPro` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inv_productos`
--

CREATE TABLE `inv_productos` (
  `id_producto` int(10) NOT NULL,
  `nombre` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `descripcion` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `fecha_alta` date NOT NULL,
  `fecha_baja` date DEFAULT NULL,
  `imagen` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `cod_barras` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `precio` int(11) DEFAULT NULL,
  `coste` int(11) DEFAULT NULL,
  `peso` int(11) DEFAULT NULL,
  `volumen` int(11) DEFAULT NULL,
  `id_categoria` int(10) DEFAULT NULL,
  `id_tipo_producto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inv_propas`
--

CREATE TABLE `inv_propas` (
  `id_propas` int(10) NOT NULL,
  `id_producto` int(10) DEFAULT NULL,
  `id_pasillo` int(10) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inv_recepciones`
--

CREATE TABLE `inv_recepciones` (
  `id_recepcion` int(10) NOT NULL,
  `nombre` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fecha_recepcion` date DEFAULT NULL,
  `id_producto` int(10) DEFAULT NULL,
  `id_pasillo` int(10) DEFAULT NULL,
  `id_estado` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inv_secciones`
--

CREATE TABLE `inv_secciones` (
  `id_seccion` int(10) NOT NULL,
  `nombre` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `cantProPas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inv_secpas`
--

CREATE TABLE `inv_secpas` (
  `id_secpas` int(10) NOT NULL,
  `id_seccion` int(10) DEFAULT NULL,
  `id_pasillo` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inv_tipos_productos`
--

CREATE TABLE `inv_tipos_productos` (
  `id_tipo_producto` int(11) NOT NULL,
  `tipo` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `descripcion` varchar(50) COLLATE latin1_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Volcado de datos para la tabla `inv_tipos_productos`
--

INSERT INTO `inv_tipos_productos` (`id_tipo_producto`, `tipo`, `descripcion`) VALUES
(1, 'Comprable', 'Puede ser comprado a proveedores.'),
(2, 'Vendible', 'El producto puede ser vendido a clientes.'),
(3, 'Comprable/Vendible', 'El producto puede ser comprado a proveedores y ven');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inv_transferencias`
--

CREATE TABLE `inv_transferencias` (
  `id_transferencia` int(10) NOT NULL,
  `nombre` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `plazo_entrega` int(11) DEFAULT NULL,
  `id_producto` int(10) DEFAULT NULL,
  `id_pasillo_origen` int(10) DEFAULT NULL,
  `id_pasillo_destino` int(10) DEFAULT NULL,
  `id_estado` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inv_valores`
--

CREATE TABLE `inv_valores` (
  `id_valor` int(10) NOT NULL,
  `valor` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `id_producto` int(10) DEFAULT NULL,
  `id_atributo` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pro_historico`
--

CREATE TABLE `pro_historico` (
  `id_historico` int(11) NOT NULL,
  `accion` text COLLATE latin1_general_ci NOT NULL,
  `fecha` date NOT NULL,
  `id_empleado` int(11) NOT NULL COMMENT 'empleado que realizo la accion'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pro_jornada`
--

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

CREATE TABLE `pro_tipo_etapa` (
  `id_tipo_etapa` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `descripcion` text COLLATE latin1_general_ci,
  `id_tipo_proyecto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Volcado de datos para la tabla `pro_tipo_etapa`
--

INSERT INTO `pro_tipo_etapa` (`id_tipo_etapa`, `nombre`, `descripcion`, `id_tipo_proyecto`) VALUES
(1, 'EspecificaciÃ³n de los requerimientos', 'Se concretaran todos los requerimientos para la correcta elaboraciÃ³n del software.', 1),
(2, 'DiseÃ±o', 'Se llevarÃ¡ a cabo el apartado de diseÃ±o del software.', 1),
(3, 'ImplementaciÃ³n', 'ComenzarÃ¡ la implementaciÃ³n del software.', 1),
(4, 'IntegraciÃ³n', 'Comenzaran las pruebas de forma individual de todos los mÃ³dulos', 1),
(5, 'ValidaciÃ³n y VerificaciÃ³n', 'Se llevarÃ¡n a cabo pruebas mÃ¡s concretas al software en busca de posibles errores.', 1),
(6, 'Mantenimiento', 'Una vez finalizado el software, se llevarÃ¡ a cabo un mantemiento del mismo.', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pro_tipo_proyecto`
--

CREATE TABLE `pro_tipo_proyecto` (
  `id_tipo_proyecto` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `descripcion` text COLLATE latin1_general_ci,
  `imagen` varchar(200) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Volcado de datos para la tabla `pro_tipo_proyecto`
--

INSERT INTO `pro_tipo_proyecto` (`id_tipo_proyecto`, `nombre`, `descripcion`, `imagen`) VALUES
(1, 'Desarrollo Software', 'La empresa llevarÃ¡ a cabo un desarrollo de software', 'desarrollo_software.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pro_tipo_tarea`
--

CREATE TABLE `pro_tipo_tarea` (
  `id_tipo_tarea` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `descripcion` text COLLATE latin1_general_ci,
  `precio` decimal(15,5) NOT NULL,
  `id_tipo_etapa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Volcado de datos para la tabla `pro_tipo_tarea`
--

INSERT INTO `pro_tipo_tarea` (`id_tipo_tarea`, `nombre`, `descripcion`, `precio`, `id_tipo_etapa`) VALUES
(1, 'Entrevista con el cliente', 'Se llevarÃ¡ a cabo una entrevista con el cliente para conocer sus requisitos.', '30.00000', 1),
(2, 'AnÃ¡lisis del entorno de implantaciÃ³n', 'Se harÃ¡ un estudio del entorno donde se va a desarrollar la aplicaciÃ³n', '100.00000', 1),
(3, 'ProgramaciÃ³n de Fases', 'Se realizarÃ¡ el programa a seguir para el correcto desarrollo del software', '50.00000', 1),
(4, 'AsignaciÃ³n de tareas', 'Se asignarÃ¡ a toda la plantilla las tareas que deberÃ¡ realizar', '45.00000', 1),
(5, 'Diagrama de clases', 'Se crearÃ¡ el diagrama de clases para planificar el proyecto.', '47.00000', 2),
(6, 'Diagrama Entidad RelaciÃ³n', 'Se crearÃ¡ el diagrama entidad/relaciÃ³n de la base de datos a utilizar en el proyecto.', '150.00000', 2),
(7, 'DivisiÃ³n de subsistemas', 'Se realiza la divisiÃ³n de subsistemas.', '70.00000', 2),
(8, 'Calendario de aplicaciÃ³n', 'Se organizarÃ¡ el calendario a seguir para la elaboraciÃ³n del proyecto.', '30.00000', 2),
(9, 'CreaciÃ³n de la base de datos', 'Se crearÃ¡ la base de datos para el proyecto.', '15.00000', 3),
(10, 'InserciÃ³n de datos', 'Se insertaran en la base de datos los valores necesarios.', '10.00000', 3),
(11, 'ConversiÃ³n de datos previos', 'Se harÃ¡ la conversiÃ³n de datos previos.', '10.00000', 3),
(12, 'ProgramaciÃ³n', 'Se realizarÃ¡ toda la programaciÃ³n del software.', '25.00000', 3),
(13, 'Pruebas unitarias por mÃ³dulo', 'Se llevarÃ¡n a cabo pruebas de forma individual de cada mÃ³dulo', '10.00000', 4),
(14, 'UniÃ³n de los subsistemas', 'Se unirÃ¡n todos los subsistemas.', '10.00000', 4),
(15, 'Pruebas de interfaz', 'Se llevarÃ¡n a cabo pruebas de la interfaz grÃ¡fica del software.', '5.00000', 5),
(16, 'Pruebas en conjunto alfa', 'Se llevarÃ¡n a cabo pruebas en fase alfa', '10.00000', 5),
(17, 'Pruebas beta', 'Se llevarÃ¡n a cabo pruebas en versiÃ³n beta', '10.00000', 5),
(18, 'ModificaciÃ³n de software', 'Se llevarÃ¡n a cabo modificaciones que puedan ser necesarias.', '20.00000', 6),
(19, 'Asistencia', 'Labores de asistencia para la empresa.', '15.00000', 6),
(20, 'FormaciÃ³n', 'Se formarÃ¡ a la empresa en el software desarrollado.', '20.00000', 6),
(21, 'Periodo de garantÃ­a', 'Periodo de garantÃ­a dado a la empresa contratante.', '5.00000', 6);

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
(10, 'Jose', 'Alberti', '2018-03-02', '987654321', 'Foto 2', 'Curriculum Jose', 'Candidato Interesante', 'Buena base para el puesto');

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
(180, 'Recursos Humanos', '2018-02-12', 'Alicante', 150, 'Departamento Recursos Humanos');

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
(180, 180, '2018-03-03', NULL),
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
(1, 180, 1, 1, '2018-03-02', 'Instructor', 2, 'Puesto de Instructor');

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ven_categorias`
--

CREATE TABLE `ven_categorias` (
  `id_categoria` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `descripcion` varchar(50) COLLATE latin1_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Volcado de datos para la tabla `ven_categorias`
--

INSERT INTO `ven_categorias` (`id_categoria`, `descripcion`) VALUES
('cuentasFrecuentes', 'Clientes asiduos'),
('nuevosClientes', 'Clientes nuevos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ven_clientes`
--

CREATE TABLE `ven_clientes` (
  `id_cliente_dni` varchar(9) COLLATE latin1_general_ci NOT NULL,
  `nombre` varchar(15) COLLATE latin1_general_ci DEFAULT NULL,
  `apellido` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `categoria` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `pagoPermitido` varchar(20) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Volcado de datos para la tabla `ven_clientes`
--

INSERT INTO `ven_clientes` (`id_cliente_dni`, `nombre`, `apellido`, `fecha`, `categoria`, `pagoPermitido`) VALUES
('C12345678', 'Paco', 'Rodriguez', '2018-02-17', 'nuevosClientes', 'metodo2'),
('X12345678', 'Antonio', 'Fernández', '2018-02-01', 'cuentasFrecuentes', 'metodo1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ven_comerciales`
--

CREATE TABLE `ven_comerciales` (
  `id_comercial` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `nombre` varchar(20) COLLATE latin1_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Volcado de datos para la tabla `ven_comerciales`
--

INSERT INTO `ven_comerciales` (`id_comercial`, `nombre`) VALUES
('1', 'Comercial 1'),
('2', 'Comercial 2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ven_direccionescliente`
--

CREATE TABLE `ven_direccionescliente` (
  `id_direccionesClientes` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `clientes` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `direccionEnvio` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `direccionFactura` varchar(20) COLLATE latin1_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Volcado de datos para la tabla `ven_direccionescliente`
--

INSERT INTO `ven_direccionescliente` (`id_direccionesClientes`, `clientes`, `direccionEnvio`, `direccionFactura`) VALUES
('dirAntonio', 'X12345678', 'c/ Antonio, 2', 'c/ Antoñito, 22'),
('dirPaco', 'C12345678', 'c/ Paco, 1', 'c/ Paquito, 11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ven_equipo`
--

CREATE TABLE `ven_equipo` (
  `id_equipo` int(11) NOT NULL,
  `nombre` varchar(20) COLLATE latin1_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Volcado de datos para la tabla `ven_equipo`
--

INSERT INTO `ven_equipo` (`id_equipo`, `nombre`) VALUES
(1, 'Equipo 1'),
(2, 'Equipo 2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ven_estadosventas`
--

CREATE TABLE `ven_estadosventas` (
  `id_estadoVenta` int(11) NOT NULL,
  `nombre` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `descripcion` varchar(50) COLLATE latin1_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Volcado de datos para la tabla `ven_estadosventas`
--

INSERT INTO `ven_estadosventas` (`id_estadoVenta`, `nombre`, `descripcion`) VALUES
(1, 'Pedido', NULL),
(2, 'Presupuesto', NULL),
(3, 'Vendido', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ven_factura`
--

CREATE TABLE `ven_factura` (
  `id_factura` int(11) NOT NULL,
  `lineaFactura` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ven_incidencias`
--

CREATE TABLE `ven_incidencias` (
  `id_incidencia` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `cliente` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `descripcion` varchar(20) COLLATE latin1_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Volcado de datos para la tabla `ven_incidencias`
--

INSERT INTO `ven_incidencias` (`id_incidencia`, `cliente`, `descripcion`) VALUES
('agresionAComercial', 'X12345678', NULL),
('roboEnTienda', 'X12345678', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ven_lineasventa`
--

CREATE TABLE `ven_lineasventa` (
  `id_lineasVentas` int(11) NOT NULL,
  `producto` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `cantidad` varchar(11) COLLATE latin1_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Volcado de datos para la tabla `ven_lineasventa`
--

INSERT INTO `ven_lineasventa` (`id_lineasVentas`, `producto`, `cantidad`) VALUES
(1, '1', '3'),
(2, '2', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ven_metodoscliente`
--

CREATE TABLE `ven_metodoscliente` (
  `id_metodosCliente` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `metodos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Volcado de datos para la tabla `ven_metodoscliente`
--

INSERT INTO `ven_metodoscliente` (`id_metodosCliente`, `metodos`) VALUES
('metodo1', 1),
('metodo2', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ven_metodospago`
--

CREATE TABLE `ven_metodospago` (
  `id_metodoPago` int(11) NOT NULL,
  `nombre` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `descripcion` varchar(50) COLLATE latin1_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Volcado de datos para la tabla `ven_metodospago`
--

INSERT INTO `ven_metodospago` (`id_metodoPago`, `nombre`, `descripcion`) VALUES
(1, 'Efectivo', 'Pago en efectivo'),
(2, 'Tarjeta', 'Pago con tarjeta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ven_movimientoequipos`
--

CREATE TABLE `ven_movimientoequipos` (
  `id_movimientoEquipos` int(11) NOT NULL,
  `id_equipo` int(11) NOT NULL,
  `id_comercial` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Volcado de datos para la tabla `ven_movimientoequipos`
--

INSERT INTO `ven_movimientoequipos` (`id_movimientoEquipos`, `id_equipo`, `id_comercial`, `fecha`) VALUES
(1, 1, '1', '2018-03-02'),
(2, 2, '2', '2018-03-02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ven_productos`
--

CREATE TABLE `ven_productos` (
  `id_producto` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `nombre` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `precioUnitario` float(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Volcado de datos para la tabla `ven_productos`
--

INSERT INTO `ven_productos` (`id_producto`, `nombre`, `precioUnitario`) VALUES
('1', 'Producto 1', 1.00),
('2', 'Producto 2', 2.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ven_puntooventa`
--

CREATE TABLE `ven_puntooventa` (
  `id_puntoVenta` int(11) NOT NULL,
  `equipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Volcado de datos para la tabla `ven_puntooventa`
--

INSERT INTO `ven_puntooventa` (`id_puntoVenta`, `equipo`) VALUES
(1, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ven_tiposiva`
--

CREATE TABLE `ven_tiposiva` (
  `id_tipoVenta` varchar(10) COLLATE latin1_general_ci NOT NULL,
  `porcentaje` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Volcado de datos para la tabla `ven_tiposiva`
--

INSERT INTO `ven_tiposiva` (`id_tipoVenta`, `porcentaje`) VALUES
('Básico', '21'),
('Reducido', '16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ven_ventas`
--

CREATE TABLE `ven_ventas` (
  `id_venta` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `empresa` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `cliente` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `domicilioFiscal` varchar(35) COLLATE latin1_general_ci DEFAULT NULL,
  `descripcion` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `IVA` decimal(5,2) NOT NULL,
  `lineaVenta` int(11) NOT NULL,
  `Comercial` varchar(25) COLLATE latin1_general_ci NOT NULL,
  `metodoPago` int(11) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Volcado de datos para la tabla `ven_ventas`
--

INSERT INTO `ven_ventas` (`id_venta`, `fecha`, `empresa`, `cliente`, `domicilioFiscal`, `descripcion`, `IVA`, `lineaVenta`, `Comercial`, `metodoPago`, `estado`) VALUES
(1, '2018-03-02', 'Empresa 1', 'C12345678', 'c/ Calle 1, 1', 'Venta de prueba 1', '21.00', 1, '1', 1, 1),
(2, '2018-03-02', 'Empresa 2', 'X12345678', 'c/ Calle 2, 2', 'Venta de prueba 2', '16.00', 2, '2', 2, 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `com_atributos`
--
ALTER TABLE `com_atributos`
  ADD PRIMARY KEY (`id_atributo`);

--
-- Indices de la tabla `com_contactos`
--
ALTER TABLE `com_contactos`
  ADD PRIMARY KEY (`id_contacto`),
  ADD KEY `fk_proveedor_contactos` (`id_proveedor`);

--
-- Indices de la tabla `com_fases_pedido`
--
ALTER TABLE `com_fases_pedido`
  ADD PRIMARY KEY (`id_fase_pedido`);

--
-- Indices de la tabla `com_metodos_pago`
--
ALTER TABLE `com_metodos_pago`
  ADD PRIMARY KEY (`id_metodo_pago`);

--
-- Indices de la tabla `com_metodos_proveedor`
--
ALTER TABLE `com_metodos_proveedor`
  ADD PRIMARY KEY (`id_metodo_proveedor`),
  ADD KEY `fk_proveedor_metodos_pago` (`id_proveedor`),
  ADD KEY `fk_metodo_metodos_pago` (`id_metodo_pago`);

--
-- Indices de la tabla `com_proveedores`
--
ALTER TABLE `com_proveedores`
  ADD PRIMARY KEY (`id_proveedor`);

--
-- Indices de la tabla `emp_categorias_dietas`
--
ALTER TABLE `emp_categorias_dietas`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `emp_categorias_eventos`
--
ALTER TABLE `emp_categorias_eventos`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `emp_clientes`
--
ALTER TABLE `emp_clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `emp_dietas`
--
ALTER TABLE `emp_dietas`
  ADD PRIMARY KEY (`id_dieta`);

--
-- Indices de la tabla `emp_empleados_eventos`
--
ALTER TABLE `emp_empleados_eventos`
  ADD PRIMARY KEY (`id_empleado_evento`);

--
-- Indices de la tabla `emp_eventos`
--
ALTER TABLE `emp_eventos`
  ADD PRIMARY KEY (`id_evento`);

--
-- Indices de la tabla `emp_eventos_categorias`
--
ALTER TABLE `emp_eventos_categorias`
  ADD PRIMARY KEY (`id_evento_categoria`);

--
-- Indices de la tabla `emp_mensajes`
--
ALTER TABLE `emp_mensajes`
  ADD PRIMARY KEY (`id_mensaje`);

--
-- Indices de la tabla `emp_mensajes_empleados`
--
ALTER TABLE `emp_mensajes_empleados`
  ADD PRIMARY KEY (`id_mensaje_empleado`);

--
-- Indices de la tabla `emp_pedidos_empleados`
--
ALTER TABLE `emp_pedidos_empleados`
  ADD PRIMARY KEY (`id_pedido_empleado`);

--
-- Indices de la tabla `for_curso`
--
ALTER TABLE `for_curso`
  ADD PRIMARY KEY (`id_curso`);

--
-- Indices de la tabla `for_solicitud`
--
ALTER TABLE `for_solicitud`
  ADD PRIMARY KEY (`id_solicitud`);

--
-- Indices de la tabla `for_unidad`
--
ALTER TABLE `for_unidad`
  ADD PRIMARY KEY (`id_unidad`);

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
-- Indices de la tabla `inv_almacenes`
--
ALTER TABLE `inv_almacenes`
  ADD PRIMARY KEY (`id_almacen`);

--
-- Indices de la tabla `inv_almsec`
--
ALTER TABLE `inv_almsec`
  ADD PRIMARY KEY (`id_almsec`),
  ADD KEY `id_almacen` (`id_almacen`),
  ADD KEY `id_seccion` (`id_seccion`);

--
-- Indices de la tabla `inv_atributos`
--
ALTER TABLE `inv_atributos`
  ADD PRIMARY KEY (`id_atributo`);

--
-- Indices de la tabla `inv_catatr`
--
ALTER TABLE `inv_catatr`
  ADD PRIMARY KEY (`id_catatr`),
  ADD KEY `id_categoria` (`id_categoria`),
  ADD KEY `id_atributo` (`id_atributo`);

--
-- Indices de la tabla `inv_categorias`
--
ALTER TABLE `inv_categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `inv_estadorecepciones`
--
ALTER TABLE `inv_estadorecepciones`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indices de la tabla `inv_estadotransferencias`
--
ALTER TABLE `inv_estadotransferencias`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indices de la tabla `inv_historicos`
--
ALTER TABLE `inv_historicos`
  ADD PRIMARY KEY (`id_historico`);

--
-- Indices de la tabla `inv_invalm`
--
ALTER TABLE `inv_invalm`
  ADD PRIMARY KEY (`id_invalm`),
  ADD KEY `id_inventario` (`id_inventario`),
  ADD KEY `id_almacen` (`id_almacen`);

--
-- Indices de la tabla `inv_inventarios`
--
ALTER TABLE `inv_inventarios`
  ADD PRIMARY KEY (`id_inventario`);

--
-- Indices de la tabla `inv_pasillos`
--
ALTER TABLE `inv_pasillos`
  ADD PRIMARY KEY (`id_pasillo`);

--
-- Indices de la tabla `inv_productos`
--
ALTER TABLE `inv_productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_categoria` (`id_categoria`),
  ADD KEY `id_tipo_producto` (`id_tipo_producto`);

--
-- Indices de la tabla `inv_propas`
--
ALTER TABLE `inv_propas`
  ADD PRIMARY KEY (`id_propas`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_pasillo` (`id_pasillo`);

--
-- Indices de la tabla `inv_recepciones`
--
ALTER TABLE `inv_recepciones`
  ADD PRIMARY KEY (`id_recepcion`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_pasillo` (`id_pasillo`),
  ADD KEY `id_estado` (`id_estado`);

--
-- Indices de la tabla `inv_secciones`
--
ALTER TABLE `inv_secciones`
  ADD PRIMARY KEY (`id_seccion`);

--
-- Indices de la tabla `inv_secpas`
--
ALTER TABLE `inv_secpas`
  ADD PRIMARY KEY (`id_secpas`),
  ADD KEY `id_seccion` (`id_seccion`),
  ADD KEY `id_pasillo` (`id_pasillo`);

--
-- Indices de la tabla `inv_tipos_productos`
--
ALTER TABLE `inv_tipos_productos`
  ADD PRIMARY KEY (`id_tipo_producto`);

--
-- Indices de la tabla `inv_transferencias`
--
ALTER TABLE `inv_transferencias`
  ADD PRIMARY KEY (`id_transferencia`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_pasillo_origen` (`id_pasillo_origen`),
  ADD KEY `id_pasillo_destino` (`id_pasillo_destino`),
  ADD KEY `id_estado` (`id_estado`);

--
-- Indices de la tabla `inv_valores`
--
ALTER TABLE `inv_valores`
  ADD PRIMARY KEY (`id_valor`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_atributo` (`id_atributo`);

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
-- Indices de la tabla `ven_categorias`
--
ALTER TABLE `ven_categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `ven_clientes`
--
ALTER TABLE `ven_clientes`
  ADD PRIMARY KEY (`id_cliente_dni`);

--
-- Indices de la tabla `ven_comerciales`
--
ALTER TABLE `ven_comerciales`
  ADD PRIMARY KEY (`id_comercial`);

--
-- Indices de la tabla `ven_direccionescliente`
--
ALTER TABLE `ven_direccionescliente`
  ADD PRIMARY KEY (`id_direccionesClientes`);

--
-- Indices de la tabla `ven_equipo`
--
ALTER TABLE `ven_equipo`
  ADD PRIMARY KEY (`id_equipo`);

--
-- Indices de la tabla `ven_estadosventas`
--
ALTER TABLE `ven_estadosventas`
  ADD PRIMARY KEY (`id_estadoVenta`);

--
-- Indices de la tabla `ven_factura`
--
ALTER TABLE `ven_factura`
  ADD PRIMARY KEY (`id_factura`);

--
-- Indices de la tabla `ven_incidencias`
--
ALTER TABLE `ven_incidencias`
  ADD PRIMARY KEY (`id_incidencia`);

--
-- Indices de la tabla `ven_lineasventa`
--
ALTER TABLE `ven_lineasventa`
  ADD PRIMARY KEY (`id_lineasVentas`);

--
-- Indices de la tabla `ven_metodoscliente`
--
ALTER TABLE `ven_metodoscliente`
  ADD PRIMARY KEY (`id_metodosCliente`);

--
-- Indices de la tabla `ven_metodospago`
--
ALTER TABLE `ven_metodospago`
  ADD PRIMARY KEY (`id_metodoPago`);

--
-- Indices de la tabla `ven_movimientoequipos`
--
ALTER TABLE `ven_movimientoequipos`
  ADD PRIMARY KEY (`id_movimientoEquipos`);

--
-- Indices de la tabla `ven_productos`
--
ALTER TABLE `ven_productos`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `ven_puntooventa`
--
ALTER TABLE `ven_puntooventa`
  ADD PRIMARY KEY (`id_puntoVenta`);

--
-- Indices de la tabla `ven_tiposiva`
--
ALTER TABLE `ven_tiposiva`
  ADD PRIMARY KEY (`id_tipoVenta`);

--
-- Indices de la tabla `ven_ventas`
--
ALTER TABLE `ven_ventas`
  ADD PRIMARY KEY (`id_venta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `com_atributos`
--
ALTER TABLE `com_atributos`
  MODIFY `id_atributo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `com_contactos`
--
ALTER TABLE `com_contactos`
  MODIFY `id_contacto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `com_fases_pedido`
--
ALTER TABLE `com_fases_pedido`
  MODIFY `id_fase_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `com_metodos_pago`
--
ALTER TABLE `com_metodos_pago`
  MODIFY `id_metodo_pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `com_metodos_proveedor`
--
ALTER TABLE `com_metodos_proveedor`
  MODIFY `id_metodo_proveedor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `com_proveedores`
--
ALTER TABLE `com_proveedores`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `emp_categorias_dietas`
--
ALTER TABLE `emp_categorias_dietas`
  MODIFY `id_categoria` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `emp_categorias_eventos`
--
ALTER TABLE `emp_categorias_eventos`
  MODIFY `id_categoria` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `emp_clientes`
--
ALTER TABLE `emp_clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `emp_dietas`
--
ALTER TABLE `emp_dietas`
  MODIFY `id_dieta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `emp_empleados_eventos`
--
ALTER TABLE `emp_empleados_eventos`
  MODIFY `id_empleado_evento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `emp_eventos`
--
ALTER TABLE `emp_eventos`
  MODIFY `id_evento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `emp_eventos_categorias`
--
ALTER TABLE `emp_eventos_categorias`
  MODIFY `id_evento_categoria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `emp_mensajes`
--
ALTER TABLE `emp_mensajes`
  MODIFY `id_mensaje` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `emp_mensajes_empleados`
--
ALTER TABLE `emp_mensajes_empleados`
  MODIFY `id_mensaje_empleado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `emp_pedidos_empleados`
--
ALTER TABLE `emp_pedidos_empleados`
  MODIFY `id_pedido_empleado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `for_curso`
--
ALTER TABLE `for_curso`
  MODIFY `id_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `for_solicitud`
--
ALTER TABLE `for_solicitud`
  MODIFY `id_solicitud` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT de la tabla `gen_accede_his`
--
ALTER TABLE `gen_accede_his`
  MODIFY `id_accede` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `gen_empleados`
--
ALTER TABLE `gen_empleados`
  MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13141518;

--
-- AUTO_INCREMENT de la tabla `gen_mensajes`
--
ALTER TABLE `gen_mensajes`
  MODIFY `id_mensaje` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `gen_modulos`
--
ALTER TABLE `gen_modulos`
  MODIFY `id_modulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `gen_permisos`
--
ALTER TABLE `gen_permisos`
  MODIFY `id_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `gen_secciones`
--
ALTER TABLE `gen_secciones`
  MODIFY `id_seccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `gen_subsecciones`
--
ALTER TABLE `gen_subsecciones`
  MODIFY `id_subsecciones` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

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

--
-- AUTO_INCREMENT de la tabla `inv_almacenes`
--
ALTER TABLE `inv_almacenes`
  MODIFY `id_almacen` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `inv_almsec`
--
ALTER TABLE `inv_almsec`
  MODIFY `id_almsec` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inv_atributos`
--
ALTER TABLE `inv_atributos`
  MODIFY `id_atributo` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inv_catatr`
--
ALTER TABLE `inv_catatr`
  MODIFY `id_catatr` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inv_categorias`
--
ALTER TABLE `inv_categorias`
  MODIFY `id_categoria` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inv_estadorecepciones`
--
ALTER TABLE `inv_estadorecepciones`
  MODIFY `id_estado` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inv_estadotransferencias`
--
ALTER TABLE `inv_estadotransferencias`
  MODIFY `id_estado` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inv_historicos`
--
ALTER TABLE `inv_historicos`
  MODIFY `id_historico` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inv_invalm`
--
ALTER TABLE `inv_invalm`
  MODIFY `id_invalm` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inv_inventarios`
--
ALTER TABLE `inv_inventarios`
  MODIFY `id_inventario` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inv_pasillos`
--
ALTER TABLE `inv_pasillos`
  MODIFY `id_pasillo` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inv_productos`
--
ALTER TABLE `inv_productos`
  MODIFY `id_producto` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inv_propas`
--
ALTER TABLE `inv_propas`
  MODIFY `id_propas` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inv_recepciones`
--
ALTER TABLE `inv_recepciones`
  MODIFY `id_recepcion` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inv_secciones`
--
ALTER TABLE `inv_secciones`
  MODIFY `id_seccion` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inv_secpas`
--
ALTER TABLE `inv_secpas`
  MODIFY `id_secpas` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inv_tipos_productos`
--
ALTER TABLE `inv_tipos_productos`
  MODIFY `id_tipo_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `inv_transferencias`
--
ALTER TABLE `inv_transferencias`
  MODIFY `id_transferencia` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inv_valores`
--
ALTER TABLE `inv_valores`
  MODIFY `id_valor` int(10) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id_tipo_etapa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `pro_tipo_proyecto`
--
ALTER TABLE `pro_tipo_proyecto`
  MODIFY `id_tipo_proyecto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `pro_tipo_tarea`
--
ALTER TABLE `pro_tipo_tarea`
  MODIFY `id_tipo_tarea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `ven_equipo`
--
ALTER TABLE `ven_equipo`
  MODIFY `id_equipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ven_estadosventas`
--
ALTER TABLE `ven_estadosventas`
  MODIFY `id_estadoVenta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `ven_factura`
--
ALTER TABLE `ven_factura`
  MODIFY `id_factura` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ven_lineasventa`
--
ALTER TABLE `ven_lineasventa`
  MODIFY `id_lineasVentas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ven_metodospago`
--
ALTER TABLE `ven_metodospago`
  MODIFY `id_metodoPago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ven_movimientoequipos`
--
ALTER TABLE `ven_movimientoequipos`
  MODIFY `id_movimientoEquipos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ven_puntooventa`
--
ALTER TABLE `ven_puntooventa`
  MODIFY `id_puntoVenta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ven_ventas`
--
ALTER TABLE `ven_ventas`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `com_contactos`
--
ALTER TABLE `com_contactos`
  ADD CONSTRAINT `fk_proveedor_contactos` FOREIGN KEY (`id_proveedor`) REFERENCES `com_proveedores` (`id_proveedor`);

--
-- Filtros para la tabla `com_metodos_proveedor`
--
ALTER TABLE `com_metodos_proveedor`
  ADD CONSTRAINT `fk_metodo_metodos_pago` FOREIGN KEY (`id_metodo_pago`) REFERENCES `com_metodos_pago` (`id_metodo_pago`),
  ADD CONSTRAINT `fk_proveedor_metodos_pago` FOREIGN KEY (`id_proveedor`) REFERENCES `com_proveedores` (`id_proveedor`);

--
-- Filtros para la tabla `inv_almsec`
--
ALTER TABLE `inv_almsec`
  ADD CONSTRAINT `inv_almsec_ibfk_1` FOREIGN KEY (`id_almacen`) REFERENCES `inv_almacenes` (`id_almacen`),
  ADD CONSTRAINT `inv_almsec_ibfk_2` FOREIGN KEY (`id_seccion`) REFERENCES `inv_secciones` (`id_seccion`);

--
-- Filtros para la tabla `inv_catatr`
--
ALTER TABLE `inv_catatr`
  ADD CONSTRAINT `inv_catatr_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `inv_categorias` (`id_categoria`),
  ADD CONSTRAINT `inv_catatr_ibfk_2` FOREIGN KEY (`id_atributo`) REFERENCES `inv_atributos` (`id_atributo`);

--
-- Filtros para la tabla `inv_invalm`
--
ALTER TABLE `inv_invalm`
  ADD CONSTRAINT `inv_invalm_ibfk_1` FOREIGN KEY (`id_inventario`) REFERENCES `inv_inventarios` (`id_inventario`),
  ADD CONSTRAINT `inv_invalm_ibfk_2` FOREIGN KEY (`id_almacen`) REFERENCES `inv_almacenes` (`id_almacen`);

--
-- Filtros para la tabla `inv_productos`
--
ALTER TABLE `inv_productos`
  ADD CONSTRAINT `inv_productos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `inv_categorias` (`id_categoria`),
  ADD CONSTRAINT `inv_productos_ibfk_2` FOREIGN KEY (`id_tipo_producto`) REFERENCES `inv_tipos_productos` (`id_tipo_producto`);

--
-- Filtros para la tabla `inv_propas`
--
ALTER TABLE `inv_propas`
  ADD CONSTRAINT `inv_propas_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `inv_productos` (`id_producto`),
  ADD CONSTRAINT `inv_propas_ibfk_2` FOREIGN KEY (`id_pasillo`) REFERENCES `inv_pasillos` (`id_pasillo`);

--
-- Filtros para la tabla `inv_recepciones`
--
ALTER TABLE `inv_recepciones`
  ADD CONSTRAINT `inv_recepciones_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `inv_productos` (`id_producto`),
  ADD CONSTRAINT `inv_recepciones_ibfk_2` FOREIGN KEY (`id_pasillo`) REFERENCES `inv_pasillos` (`id_pasillo`),
  ADD CONSTRAINT `inv_recepciones_ibfk_3` FOREIGN KEY (`id_estado`) REFERENCES `inv_estadorecepciones` (`id_estado`);

--
-- Filtros para la tabla `inv_secpas`
--
ALTER TABLE `inv_secpas`
  ADD CONSTRAINT `inv_secpas_ibfk_1` FOREIGN KEY (`id_seccion`) REFERENCES `inv_secciones` (`id_seccion`),
  ADD CONSTRAINT `inv_secpas_ibfk_2` FOREIGN KEY (`id_pasillo`) REFERENCES `inv_pasillos` (`id_pasillo`);

--
-- Filtros para la tabla `inv_transferencias`
--
ALTER TABLE `inv_transferencias`
  ADD CONSTRAINT `inv_transferencias_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `inv_productos` (`id_producto`),
  ADD CONSTRAINT `inv_transferencias_ibfk_2` FOREIGN KEY (`id_pasillo_origen`) REFERENCES `inv_pasillos` (`id_pasillo`),
  ADD CONSTRAINT `inv_transferencias_ibfk_3` FOREIGN KEY (`id_pasillo_destino`) REFERENCES `inv_pasillos` (`id_pasillo`),
  ADD CONSTRAINT `inv_transferencias_ibfk_4` FOREIGN KEY (`id_estado`) REFERENCES `inv_estadotransferencias` (`id_estado`);

--
-- Filtros para la tabla `inv_valores`
--
ALTER TABLE `inv_valores`
  ADD CONSTRAINT `inv_valores_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `inv_productos` (`id_producto`),
  ADD CONSTRAINT `inv_valores_ibfk_2` FOREIGN KEY (`id_atributo`) REFERENCES `inv_atributos` (`id_atributo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
