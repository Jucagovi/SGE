<?php

include_once '../../clases/config.php';
include_once '../../clases/claseHerramientas.php';

//TABLAS

$categorias = "CREATE TABLE IF NOT EXISTS ven_categorias(
    id_categoria varchar(20) PRIMARY KEY,
    descripcion varchar(50))";

$clientes = "CREATE TABLE IF NOT EXISTS ven_clientes (
    id_cliente_dni varchar(9) PRIMARY KEY,
    nombre varchar(15),
    apellido varchar(20),
    fecha date,
    categoria varchar(20) NOT NULL,
    pagoPermitido varchar(20) NOT NULL)";

$comerciales = "CREATE TABLE IF NOT EXISTS ven_comerciales (
    id_comercial varchar(20) PRIMARY KEY,
    nombre varchar(20))";

$direccionescliente = "CREATE TABLE IF NOT EXISTS ven_direccionescliente (
    id_direccionesClientes varchar(20) PRIMARY KEY,
    clientes varchar(20) NOT NULL,
    direccionEnvio varchar(20),
    direccionFactura varchar(20))";

$equipo = "CREATE TABLE IF NOT EXISTS ven_equipo (
    id_equipo int(11) PRIMARY KEY AUTO_INCREMENT,
    nombre varchar(20))";

$estadosventas = "CREATE TABLE IF NOT EXISTS ven_estadosventas (
    id_estadoVenta int(11) PRIMARY KEY AUTO_INCREMENT,
    nombre varchar(20),
    descripcion varchar(50))";

$factura = "CREATE TABLE IF NOT EXISTS ven_factura (
    id_factura int(11) PRIMARY KEY AUTO_INCREMENT,
    lineaFactura int(11) NOT NULL)";

$incidencias = "CREATE TABLE IF NOT EXISTS ven_incidencias (
    id_incidencia varchar(20) PRIMARY KEY,
    cliente varchar(20) NOT NULL,
    descripcion varchar(20))";

$lineasventa = "CREATE TABLE IF NOT EXISTS ven_lineasventa (
    id_lineasVentas int(11) PRIMARY KEY AUTO_INCREMENT,
    producto varchar(20) NOT NULL,
    cantidad varchar(11))";

$metodoscliente = "CREATE TABLE IF NOT EXISTS ven_metodoscliente (
    id_metodosCliente varchar(20) PRIMARY KEY,
    metodos int(11) NOT NULL)";

$metodospago = "CREATE TABLE IF NOT EXISTS ven_metodospago (
    id_metodoPago int(11) PRIMARY KEY AUTO_INCREMENT,
    nombre varchar(20),
    descripcion varchar(50))";

$movimientoequipos = "CREATE TABLE IF NOT EXISTS ven_movimientoequipos (
    id_movimientoEquipos int(11) PRIMARY KEY AUTO_INCREMENT,
    id_equipo int(11) NOT NULL,
    id_comercial varchar(20) NOT NULL,
    fecha date)";

$productos = "CREATE TABLE IF NOT EXISTS ven_productos (
    id_producto varchar(20) PRIMARY KEY,
    nombre varchar(20),
    precioUnitario float(5,2))";

$puntooventa = "CREATE TABLE IF NOT EXISTS ven_puntooventa (
    id_puntoVenta int(11) PRIMARY KEY AUTO_INCREMENT,
    equipo int(11) NOT NULL)";

$tiposiva = "CREATE TABLE IF NOT EXISTS ven_tiposiva (
    id_tipoVenta varchar(10) PRIMARY KEY,
    porcentaje decimal(10,0))";

$ventas = "CREATE TABLE IF NOT EXISTS ven_ventas (
    id_venta int(11) PRIMARY KEY AUTO_INCREMENT,
    fecha date,
    empresa varchar(20),
    cliente varchar(20) NOT NULL,
    domicilioFiscal varchar(35),
    descripcion varchar(50),
    IVA decimal(5,2) NOT NULL,
    lineaVenta int(11) NOT NULL,
    Comercial varchar(25) NOT NULL,
    metodoPago int(11) NOT NULL,
    estado int(11) NOT NULL)";

$ven = new Herramientas();
$con = $ven->conectar();

$array = array($categorias,$clientes,$comerciales,$direccionescliente,$equipo,$estadosventas,$factura,$incidencias,$lineasventa,$metodoscliente,$metodospago,$movimientoequipos,$productos,$puntooventa,$tiposiva,$ventas);

echo "<p>Empieza la transacción</p>";
mysqli_begin_transaction($con, MYSQLI_TRANS_START_READ_WRITE);

echo "<p>Creando tablas...</p>";
foreach ($array as $tabla) {
    mysqli_query($con, $tabla);
}
echo "<p>Tablas creadas.</p>";

//MÓDULOS

echo "<p>Creando módulo...</p>";

$mod_ventas = "INSERT INTO `gen_modulos` "
        . "(`nombre`, `descripcion`, `orden`)"
        . " SELECT 'Ventas', 'Módulo de ventas', '10' AS tmp"
        . " WHERE NOT EXISTS (SELECT nombre FROM gen_modulos WHERE nombre = 'Ventas') LIMIT 1";

mysqli_query($con, $mod_ventas);
$mod = mysqli_insert_id($con);

echo "<p>Módulo creado.</p>";

//SECCIONES Y SUBSECCIONES

echo "<p>Creando secciones y subsecciones...</p>";

$sec_clientes = "INSERT INTO `gen_secciones` "
        . "(`nombre`, `descripcion`, `permiso`, `orden`, `id_modulo`, `identificador`)"
        . " SELECT 'CLientes', 'Gestión de clientes', '0', '1', '$mod', 'clientes' AS tmp"
        . " WHERE NOT EXISTS (SELECT nombre FROM gen_secciones WHERE nombre = 'Clientes') LIMIT 1";

$sec_metodos = "INSERT INTO `gen_secciones` "
        . "(`nombre`, `descripcion`, `permiso`, `orden`, `id_modulo`, `identificador`)"
        . " SELECT 'Métodos de pago', 'Gestión de métodos de pago', '0', '2', '$mod', 'metodos' AS tmp"
        . " WHERE NOT EXISTS (SELECT nombre FROM gen_secciones WHERE nombre = 'Métodos de pago') LIMIT 1";

$sec_equipos = "INSERT INTO `gen_secciones` "
        . "(`nombre`, `descripcion`, `permiso`, `orden`, `id_modulo`, `identificador`)"
        . " SELECT 'Equipos', 'Gestión de equipos de ventas', '0', '3', '$mod', 'equipos' AS tmp"
        . " WHERE NOT EXISTS (SELECT nombre FROM gen_secciones WHERE nombre = 'Equipos') LIMIT 1";

$sec_ventas = "INSERT INTO `gen_secciones` "
        . "(`nombre`, `descripcion`, `permiso`, `orden`, `id_modulo`, `identificador`)"
        . " SELECT 'Ventas', 'Gestión de las ventas', '0', '4', '$mod', 'ventas' AS tmp"
        . " WHERE NOT EXISTS (SELECT nombre FROM gen_secciones WHERE nombre = 'Ventas') LIMIT 1";

mysqli_query($con, $sec_clientes);
$cli = mysqli_insert_id($con);

$sub_categorias = "INSERT INTO `gen_subsecciones` "
        . "(`nombre`, `descripcion`, `permiso`, `orden`, `id_seccion`, `identificador`)"
        . " SELECT 'Categorías', NULL, '0', '1', '$cli', 'categorias' AS tmp"
        . " WHERE NOT EXISTS (SELECT nombre FROM gen_subsecciones WHERE nombre = 'Categorias') LIMIT 1";
mysqli_query($con, $sub_categorias);

mysqli_query($con, $sec_metodos);


mysqli_query($con, $sec_equipos);
$equ = mysqli_insert_id($con);

$sub_comerciales = "INSERT INTO `gen_subsecciones` "
        . "(`nombre`, `descripcion`, `permiso`, `orden`, `id_seccion`, `identificador`)"
        . " SELECT 'Comerciales', NULL, '0', '1', '$equ', 'comerciales' AS tmp"
        . " WHERE NOT EXISTS (SELECT nombre FROM gen_subsecciones WHERE nombre = 'Comerciales') LIMIT 1";

$sub_tpv = "INSERT INTO `gen_subsecciones` "
        . "( `nombre`, `descripcion`, `permiso`, `orden`, `id_seccion`, `identificador`)"
        . " SELECT 'TPV', NULL, '0', '2', '$equ', 'tpv' AS tmp"
        . " WHERE NOT EXISTS (SELECT nombre FROM gen_subsecciones WHERE nombre = 'TPV') LIMIT 1";
mysqli_query($con, $sub_comerciales);
mysqli_query($con, $sub_tpv);


mysqli_query($con, $sec_ventas);
$ven = mysqli_insert_id($con);

$sub_estados = "INSERT INTO `gen_subsecciones` "
        . "(`nombre`, `descripcion`, `permiso`, `orden`, `id_seccion`, `identificador`)"
        . " SELECT 'Estados', NULL, '0', '1', '$ven', 'estados' AS tmp"
        . " WHERE NOT EXISTS (SELECT nombre FROM gen_subsecciones WHERE nombre = 'Estados') LIMIT 1";

$sub_iva = "INSERT INTO `gen_subsecciones` "
        . "(`nombre`, `descripcion`, `permiso`, `orden`, `id_seccion`, `identificador`)"
        . " SELECT 'IVA', NULL, '0', '2', '$ven', 'iva' AS tmp"
        . " WHERE NOT EXISTS (SELECT nombre FROM gen_subsecciones WHERE nombre = 'IVA') LIMIT 1";
mysqli_query($con, $sub_estados);
mysqli_query($con, $sub_iva);

echo "<p>Secciones y subsecciones creadas.</p>";

echo "<p>Insertando datos de prueba...</p>";

$datos_categorias = "INSERT INTO `ven_categorias`(`id_categoria`, `descripcion`) VALUES ('cuentasFrecuentes','Clientes asiduos'), ('nuevosClientes','Clientes nuevos')";
mysqli_query($con, $datos_categorias);

$datos_clientes = "INSERT INTO `ven_clientes`(`id_cliente_dni`, `nombre`, `apellido`, `fecha`, `categoria`, `pagoPermitido`) VALUES ('C12345678','Paco','Rodriguez','2018-02-17','nuevosClientes','metodo2'), ('X12345678','Antonio','Fernández','2018-02-01','cuentasFrecuentes','metodo1')";
mysqli_query($con, $datos_clientes);

$datos_comerciales = "INSERT INTO `ven_comerciales`(`id_comercial`, `nombre`) VALUES (1,'Comercial 1'), (2,'Comercial 2')";
mysqli_query($con, $datos_comerciales);

$datos_direcciones = "INSERT INTO `ven_direccionescliente`(`id_direccionesClientes`, `clientes`, `direccionEnvio`, `direccionFactura`) VALUES ('dirPaco','C12345678','c/ Paco, 1','c/ Paquito, 11'), ('dirAntonio','X12345678','c/ Antonio, 2','c/ Antoñito, 22')";
mysqli_query($con, $datos_direcciones);

$datos_equipo = "INSERT INTO `ven_equipo`(`id_equipo`, `nombre`) VALUES (1,'Equipo 1'),(2,'Equipo 2')";
mysqli_query($con, $datos_equipo);

$datos_estados = "INSERT INTO `ven_estadosventas`(`id_estadoVenta`, `nombre`, `descripcion`) VALUES (1,'Pedido',null), (2,'Presupuesto',null), (3,'Vendido',null)";
mysqli_query($con, $datos_estados);

$datos_incidencias = "INSERT INTO `ven_incidencias` (`id_incidencia`, `cliente`, `descripcion`) VALUES ('roboEnTienda', 'X12345678', NULL), ('agresionAComercial', 'X12345678', NULL)";
mysqli_query($con, $datos_incidencias);

$datos_lineas = "INSERT INTO `ven_lineasventa` (`id_lineasVentas`, `producto`, `cantidad`) VALUES ('1', '1', '3'), ('2', '2', '1')";
mysqli_query($con, $datos_lineas);

$datos_metodosCliente = "INSERT INTO `ven_metodoscliente`(`id_metodosCliente`, `metodos`) VALUES ('metodo1',1), ('metodo2',2)";
mysqli_query($con, $datos_metodosCliente);

$datos_metodosPago = "INSERT INTO `ven_metodospago`(`id_metodoPago`, `nombre`, `descripcion`) VALUES (1,'Efectivo','Pago en efectivo'), (2,'Tarjeta','Pago con tarjeta')";
mysqli_query($con, $datos_metodosPago);

$datos_movimientos = "INSERT INTO `ven_movimientoequipos`(`id_movimientoEquipos`, `id_equipo`, `id_comercial`, `fecha`) VALUES (1,1,1,'2018-03-02'), (2,2,2,'2018-03-02')";
mysqli_query($con, $datos_movimientos);

$datos_productos = "INSERT INTO `ven_productos`(`id_producto`, `nombre`, `precioUnitario`) VALUES (1,'Producto 1',1), (2,'Producto 2',2)";
mysqli_query($con, $datos_productos);

$datos_tpv = "INSERT INTO `ven_puntooventa`(`id_puntoVenta`, `equipo`) VALUES (1,1), (2,2)";
mysqli_query($con, $datos_tpv);

$datos_iva = "INSERT INTO `ven_tiposiva`(`id_tipoVenta`, `porcentaje`) VALUES ('Básico',21), ('Reducido',16)";
mysqli_query($con, $datos_iva);

$datos_ventas = "INSERT INTO `ven_ventas`(`id_venta`, `fecha`, `empresa`, `cliente`, `domicilioFiscal`, `descripcion`, `IVA`, `lineaVenta`, `Comercial`, `metodoPago`, `estado`) VALUES (1,'2018-03-02','Empresa 1','C12345678','c/ Calle 1, 1','Venta de prueba 1',21,1,1,1,1), (2,'2018-03-02','Empresa 2','X12345678','c/ Calle 2, 2','Venta de prueba 2',16,2,2,2,2)";
mysqli_query($con, $datos_ventas);

echo "<p>Datos de prueba insertados</p>";

mysqli_commit($con);

echo "<p>Transacción finalizada.</p>";
