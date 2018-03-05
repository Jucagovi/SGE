<?php

include_once '../../clases/config.php';
include_once '../../clases/claseHerramientas.php';

/////////////////////////// TABLAS /////////////////////////

$empleados_eventos = "CREATE TABLE IF NOT EXISTS emp_empleados_eventos(
    id_empleado_evento int(11) PRIMARY KEY AUTO_INCREMENT,
    id_empleado int(11) NOT NULL,
    id_evento  int(11) NOT NULL,
    confirmado int(1) NOT NULL,
    fecha_confirmacion date)";

$eventos_categorias = "CREATE TABLE IF NOT EXISTS emp_eventos_categorias (
    id_evento_categoria int(11) PRIMARY KEY AUTO_INCREMENT,
    id_evento int(11) NOT NULL,
    id_categoria int(2) NOT NULL)";

$categorias_eventos = "CREATE TABLE IF NOT EXISTS emp_categorias_eventos (
    id_categoria int(2) PRIMARY KEY AUTO_INCREMENT,
    nombre varchar(20) NOT NULL)";

$mensajes = "CREATE TABLE IF NOT EXISTS emp_mensajes (
    id_mensaje int(11) PRIMARY KEY AUTO_INCREMENT,
    id_emp_emisor int(11) NOT NULL,
    contenido text,
    fecha date)";

$mensajes_empleados = "CREATE TABLE IF NOT EXISTS emp_mensajes_empleados (
    id_mensaje_empleado int(11) PRIMARY KEY AUTO_INCREMENT,
    id_mensaje int(11) NOT NULL,
    id_emp_receptor int(11) NOT NULL,
    estado int(1) NOT NULL)";

$dietas = "CREATE TABLE IF NOT EXISTS emp_dietas (
    id_dieta int(11) PRIMARY KEY AUTO_INCREMENT,
    id_empleado int(11) NOT NULL,
    categoria int(2) NOT NULL,
    importe float(5,2) NOT NULL,
    fecha date NOT NULL)";

$clientes = "CREATE TABLE IF NOT EXISTS emp_clientes (
    id_cliente int(11) PRIMARY KEY AUTO_INCREMENT,
    nombre varchar(20) NOT NULL,
    apellidos varchar(30) NOT NULL,
    fecha_nacimiento date NOT NULL,
    usuario varchar(20) NOT NULL,
    contrasenya varchar(20) NOT NULL)";

$categorias_dietas = "CREATE TABLE IF NOT EXISTS emp_categorias_dietas (
    id_categoria int(2) PRIMARY KEY AUTO_INCREMENT,
    nombre varchar(20) NOT NULL,
    descripcion text)";

$eventos = "CREATE TABLE IF NOT EXISTS emp_eventos (
    id_evento int(11) PRIMARY KEY AUTO_INCREMENT,
    nombre varchar(20) NOT NULL,
    fecha date NOT NULL)";

$pedidos_empleados = "CREATE TABLE IF NOT EXISTS emp_pedidos_empleados(
        id_pedido_empleado int(11) PRIMARY KEY AUTO_INCREMENT,
        id_pedido int(11) NOT NULL,
        id_empleado int(11) NOT NULL,
        fecha date)";

$emp = new Herramientas();
$con = $emp->conectar();

$array = array($empleados_eventos, $eventos_categorias, $categorias_eventos, $mensajes, $mensajes_empleados, $dietas, $clientes, $categorias_dietas, $eventos, $pedidos_empleados);

echo "<p>Empieza la transacción</p>";
mysqli_begin_transaction($con, MYSQLI_TRANS_START_READ_WRITE);

echo "<p>Creando tablas...</p>";
foreach ($array as $tabla) {
    mysqli_query($con, $tabla);
}
echo "<p>Tablas creadas.</p>";



/////////////////////////// INSERTS /////////////////////////
// MODULO

echo "<p>Creando módulo...</p>";

$mod_empleados = "INSERT INTO `gen_modulos` "
        . "(`nombre`, `descripcion`, `orden`)"
        . " SELECT 'Empleados', 'Gestiona empleados.', '2' AS tmp"
        . " WHERE NOT EXISTS (SELECT nombre FROM gen_modulos WHERE nombre = 'Empleados') LIMIT 1";

mysqli_query($con, $mod_empleados);
$mod = mysqli_insert_id($con);

echo "<p>Módulo creado.</p>";

// SECCIONES

echo "<p>Creando secciones y subsecciones...</p>";

$sec_administracion = "INSERT INTO `gen_secciones` "
        . "(`nombre`, `descripcion`, `permiso`, `orden`, `id_modulo`, `identificador`)"
        . " SELECT 'Administración', 'Gestión de empleados', '0', '1', '$mod', 'administracion' AS tmp"
        . " WHERE NOT EXISTS (SELECT nombre FROM gen_secciones WHERE nombre = 'Administración') LIMIT 1";

$sec_eventos = "INSERT INTO `gen_secciones` "
        . "(`nombre`, `descripcion`, `permiso`, `orden`, `id_modulo`, `identificador`)"
        . " SELECT 'Eventos', 'Gestión de eventos', '0', '2', '$mod', 'eventos' AS tmp"
        . " WHERE NOT EXISTS (SELECT nombre FROM gen_secciones WHERE nombre = 'Eventos') LIMIT 1";

$sec_mensajeria = "INSERT INTO `gen_secciones` "
        . "(`nombre`, `descripcion`, `permiso`, `orden`, `id_modulo`, `identificador`)"
        . " SELECT 'Mensajería', 'Gestión de mensajes internos', '0', '3', '$mod', 'mensajeria' AS tmp"
        . " WHERE NOT EXISTS (SELECT nombre FROM gen_secciones WHERE nombre = 'Mensajería') LIMIT 1";

$sec_compras = "INSERT INTO `gen_secciones` "
        . "(`nombre`, `descripcion`, `permiso`, `orden`, `id_modulo`, `identificador`)"
        . " SELECT 'Compras', 'Compra de material', '0', '4', '$mod', 'compras' AS tmp"
        . " WHERE NOT EXISTS (SELECT nombre FROM gen_secciones WHERE nombre = 'Compras') LIMIT 1";

$sec_dietas = "INSERT INTO `gen_secciones` "
        . "( `nombre`, `descripcion`, `permiso`, `orden`, `id_modulo`, `identificador`)"
        . " SELECT 'Dietas', 'Gestión de dietas', '0', '5', '$mod', 'dietas' AS tmp"
        . " WHERE NOT EXISTS (SELECT nombre FROM gen_secciones WHERE nombre = 'Dietas') LIMIT 1";

$sec_informe = "INSERT INTO `gen_secciones` "
        . "(`nombre`, `descripcion`, `permiso`, `orden`, `id_modulo`, `identificador`)"
        . " SELECT 'Informes', 'Generar informes', '0', '6', '$mod', 'informes' AS tmp"
        . " WHERE NOT EXISTS (SELECT nombre FROM gen_secciones WHERE nombre = 'Informes') LIMIT 1";

mysqli_query($con, $sec_administracion);
$admin = mysqli_insert_id($con);

$sub_datosEmp = "INSERT INTO `gen_subsecciones` "
        . "(`nombre`, `descripcion`, `permiso`, `orden`, `id_seccion`, `identificador`)"
        . " SELECT 'Datos empleados', NULL, '0', '1', '$admin', 'datosEmpleados' AS tmp"
        . " WHERE NOT EXISTS (SELECT nombre FROM gen_subsecciones WHERE nombre = 'Datos empleados') LIMIT 1";

$sub_altaEmp = "INSERT INTO `gen_subsecciones` "
        . "(`nombre`, `descripcion`, `permiso`, `orden`, `id_seccion`, `identificador`)"
        . " SELECT 'Alta empleado', NULL, '0', '2', '$admin', 'altaEmpleado' AS tmp"
        . " WHERE NOT EXISTS (SELECT nombre FROM gen_subsecciones WHERE nombre = 'Alta empleado') LIMIT 1";

mysqli_query($con, $sub_datosEmp);
mysqli_query($con, $sub_altaEmp);


mysqli_query($con, $sec_eventos);
$eve = mysqli_insert_id($con);

$sub_verEventos = "INSERT INTO `gen_subsecciones` "
        . "(`nombre`, `descripcion`, `permiso`, `orden`, `id_seccion`, `identificador`)"
        . " SELECT 'Ver eventos', NULL, '0', '1', '$eve', 'verEventos' AS tmp"
        . " WHERE NOT EXISTS (SELECT nombre FROM gen_subsecciones WHERE nombre = 'Ver eventos') LIMIT 1";

$sub_crearEvento = "INSERT INTO `gen_subsecciones` "
        . "( `nombre`, `descripcion`, `permiso`, `orden`, `id_seccion`, `identificador`)"
        . " SELECT 'Crear eventos', NULL, '0', '2', '$eve', 'crearEventos' AS tmp"
        . " WHERE NOT EXISTS (SELECT nombre FROM gen_subsecciones WHERE nombre = 'Crear eventos') LIMIT 1";

$sub_eveCategoria = "INSERT INTO `gen_subsecciones` "
        . "(`nombre`, `descripcion`, `permiso`, `orden`, `id_seccion`, `identificador`)"
        . " SELECT 'Categorías', NULL, '0', '3', '$eve', 'categoriasEventos' AS tmp"
        . " WHERE NOT EXISTS (SELECT identificador FROM gen_subsecciones WHERE identificador = 'categoriasEventos') LIMIT 1";

mysqli_query($con, $sub_verEventos);
mysqli_query($con, $sub_crearEvento);
mysqli_query($con, $sub_eveCategoria);


mysqli_query($con, $sec_mensajeria);
$mens = mysqli_insert_id($con);

$sub_enviarMensaje = "INSERT INTO `gen_subsecciones` "
        . "(`nombre`, `descripcion`, `permiso`, `orden`, `id_seccion`, `identificador`)"
        . " SELECT 'Enviar mensaje', NULL, '0', '1', '$mens', 'enviarMensaje' AS tmp"
        . " WHERE NOT EXISTS (SELECT nombre FROM gen_subsecciones WHERE nombre = 'Enviar mensaje') LIMIT 1";

$sub_leerMensaje = "INSERT INTO `gen_subsecciones` "
        . "(`nombre`, `descripcion`, `permiso`, `orden`, `id_seccion`, `identificador`)"
        . " SELECT 'Leer mensajes', NULL, '0', '2', '$mens', 'leerMensajes' AS tmp"
        . " WHERE NOT EXISTS (SELECT nombre FROM gen_subsecciones WHERE nombre = 'Leer mensajes') LIMIT 1";

mysqli_query($con, $sub_enviarMensaje);
mysqli_query($con, $sub_leerMensaje);


mysqli_query($con, $sec_compras);
$comp = mysqli_insert_id($con);


mysqli_query($con, $sec_dietas);
$die = mysqli_insert_id($con);

$sub_crearDieta = "INSERT INTO `gen_subsecciones` (`nombre`, `descripcion`, `permiso`, `orden`, `id_seccion`, `identificador`)"
        . " SELECT 'Crear dieta', NULL, '0', '1', '$die', 'crearDieta' AS tmp"
        . " WHERE NOT EXISTS (SELECT nombre FROM gen_subsecciones WHERE nombre = 'Crear dieta') LIMIT 1";

$sub_dietasCat = "INSERT INTO `gen_subsecciones` "
        . "(`nombre`, `descripcion`, `permiso`, `orden`, `id_seccion`, `identificador`)"
        . " SELECT 'Categorías', NULL, '0', '3', '$die', 'categoriasDietas' AS tmp"
        . " WHERE NOT EXISTS (SELECT identificador FROM gen_subsecciones WHERE identificador = 'categoriasDietas') LIMIT 1";

mysqli_query($con, $sub_crearDieta);
mysqli_query($con, $sub_dietasCat);


mysqli_query($con, $sec_informe);

echo "<p>Secciones y subsecciones creadas.</p>";

mysqli_commit($con);

echo "<p>Transacción finalizada.</p>";

echo "IMPORTANTE: Para el correcto funcionamiento del módulo es necesario instalar los módulos 'Inventario', 'Compras' y 'RRHH'";

echo "Si se desea cargar unos datos de prueba, se debe ejecutar el archivo 'datosPrueba.php'";