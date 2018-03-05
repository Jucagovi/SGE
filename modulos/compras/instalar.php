<?php

include_once '../../clases/config.php';
include_once '../../clases/claseHerramientas.php';

/////////////////////////// TABLAS /////////////////////////

$proveedores = "create table com_proveedores(
id_proveedor int auto_increment primary key,
cif char(9) not null,
nombre varchar(50) not null,
direccion varchar(50) not null,
cod_postal char(5) not null,
poblacion varchar(50) not null,
provincia varchar(50) not null,
telefono char(9) not null,
email varchar(50) not null)";

$contactos = "create table com_contactos(
id_contacto int auto_increment primary key,
nombre varchar(30) not null,
departamento varchar(30) not null,
id_proveedor int,
constraint foreign key fk_proveedor_contactos (id_proveedor) references com_proveedores (id_proveedor))";


$atributos = "create table com_atributos(
id_atributo int auto_increment primary key,
nombre varchar(50) not null)";

$lineas_producto = "create table com_lineas_pedido(
id_linea_pedido int auto_increment primary key,
id_producto int,
unidades int not null,
importe int not null,
constraint foreign key fk_producto_linea_pedido (id_producto) references inv_productos(id_producto))";

$fases_pedido = "create table com_fases_pedido(
id_fase_pedido int auto_increment primary key,
fase varchar(50))";

$pedidos = "create table com_pedidos(
id_pedido int auto_increment primary key,
numero_pedido varchar(6) not null,
id_linea_pedido int,
id_fase_pedido int,
constraint foreign key fk_linea_pedido_pedidos (id_linea_pedido) references com_lineas_pedido(id_linea_pedido),
constraint foreign key fk_fase_pedido_pedidos (id_fase_pedido) references com_fases_pedido(id_fase_pedido))";

$metodos_pago = "create table com_metodos_pago(
id_metodo_pago int auto_increment primary key,
nombre varchar(50) not null,
descripcion varchar(50) not null)";

$metodos_proveedor = "create table com_metodos_proveedor(
id_metodo_proveedor int auto_increment primary key,
id_proveedor int,
id_metodo_pago int,
constraint foreign key fk_proveedor_metodos_pago (id_proveedor) references com_proveedores(id_proveedor),
constraint foreign key fk_metodo_metodos_pago (id_metodo_pago) references com_metodos_pago(id_metodo_pago))";

$facturas = "create table com_facturas(
id_factura int auto_increment primary key,
numero_factura varchar(6) not null,
id_pedido int,
constraint foreign key fk_pedido_factura(id_pedido) references com_pedidos(id_pedido))";

$presupuestos = "create table com_presupuestos(
id_presupuesto int auto_increment primary key,
id_pedido int,
constraint foreign key fk_pedido_presupuesto(id_pedido) references com_pedidos(id_pedido))";

$recepciones = "create table com_recepciones(
id_recepcion int auto_increment primary key,
id_pedido int,
fecha_estimada DATE not null,
constraint foreign key fk_pedido_recepcion(id_pedido) references com_pedidos(id_pedido))";

$emp = new Herramientas();
$con = $emp->conectar();

$array = array($proveedores, $contactos, $atributos, $lineas_producto, $fases_pedido, $pedidos, $metodos_pago, $metodos_proveedor, $facturas, $presupuestos, $recepciones);

echo "<p>Empieza la transacci贸n</p>";
mysqli_begin_transaction($con, MYSQLI_TRANS_START_READ_WRITE);

$drop_proveedores="drop table if exists com_proveedores";
$drop_contactos="drop table if exists com_contactos";
$drop_categorias="drop table if exists com_categorias";
$drop_atributos="drop table if exists com_atributos";
$drop_lineas_producto="drop table if exists com_lineas_pedido";
$drop_fases_pedido="drop table if exists com_fases_pedido";
$drop_pedidos="drop table if exists com_pedidos";
$drop_metodos_pago="drop table if exists com_metodos_pago";
$drop_metodos_proveedor="drop table if exists com_metodos_proveedor";
$drop_facturas="drop table if exists com_facturas";
$drop_presupuestos="drop table if exists com_presupuestos";
$drop_recepciones="drop table if exists com_recepciones";

$arrayDrops = array($drop_recepciones,$drop_presupuestos,$drop_facturas,$drop_metodos_proveedor,$drop_metodos_pago,$drop_pedidos,$drop_fases_pedido,$drop_lineas_producto,$drop_atributos,$drop_categorias,$drop_contactos,$drop_proveedores);


echo "<p>Borrando tablas si ya existen...</p>";
foreach ($arrayDrops as $i) {
    mysqli_query($con, $i);
}

echo "<p>Creando tablas...</p>";
foreach ($array as $tabla) {
    mysqli_query($con, $tabla);
}
echo "<p>Tablas creadas.</p>";


echo "<p>Creando m贸dulo...</p>";

$mod_compras = "INSERT INTO `gen_modulos` "
    . "(`id_modulo`,`nombre`, `descripcion`, `orden`)"
        . " SELECT '3','Compras', 'Gestion de pedidos, recepciones y compras', '3' AS tmp"
            . " WHERE NOT EXISTS (SELECT nombre FROM gen_modulos WHERE nombre = 'Compras') LIMIT 1";
            
            mysqli_query($con, $mod_compras);
            $mod = mysqli_insert_id($con);
            
            echo "<p>M贸dulo creado.</p>";
            
            // SECCIONES
            
            echo "<p>Creando secciones y subsecciones...</p>";
            
            $sec_proveedores = "INSERT INTO `gen_secciones` 
( `nombre`, `descripcion`, `permiso`, `orden`, `id_modulo`,`identificador`)
 select 'Proveedores', NULL, '0', '1', '$mod','proveedores' AS tmp WHERE NOT EXISTS (SELECT nombre FROM gen_secciones WHERE nombre = 'Proveedores') LIMIT 1";
            
            $sec_productos = "INSERT INTO `gen_secciones` ( `nombre`, `descripcion`, `permiso`, `orden`, `id_modulo`,`identificador`)
 select 'Productos', NULL, '0', '2', '$mod','productos' AS tmp WHERE NOT EXISTS (SELECT nombre FROM gen_secciones WHERE nombre = 'Productos') LIMIT 1";
            
            $sec_presupuestos = "INSERT INTO `gen_secciones` ( `nombre`, `descripcion`, `permiso`, `orden`, `id_modulo`,`identificador`)
 select 'Presupuestos, pedidos y compras', NULL, '0', '3', '$mod','prepedcom' AS tmp WHERE NOT EXISTS (SELECT nombre FROM gen_secciones WHERE nombre = 'Presupuestos, pedidos y compras') LIMIT 1";
            
            $sec_facturas = "INSERT INTO `gen_secciones` ( `nombre`, `descripcion`, `permiso`, `orden`, `id_modulo`,`identificador`)
 select 'Facturas de proveedor', NULL, '0', '4', '$mod','facturas' AS tmp WHERE NOT EXISTS (SELECT nombre FROM gen_secciones WHERE nombre = 'Facturas de proveedor') LIMIT 1";
            
            $sec_recepciones = "INSERT INTO `gen_secciones` ( `nombre`, `descripcion`, `permiso`, `orden`, `id_modulo`,`identificador`)
 select 'Recepciones', NULL, '0', '5', '$mod','recepciones' AS tmp WHERE NOT EXISTS (SELECT nombre FROM gen_secciones WHERE nombre = 'Recepciones') LIMIT 1";
            
            
            mysqli_query($con, $sec_proveedores);
            $prov = mysqli_insert_id($con);
            
            $sub_gestionarProveedores = "INSERT INTO `gen_subsecciones` ( `nombre`, `descripcion`, `permiso`, `orden`, `id_seccion`, `identificador`)
 select 'Gestionar Proveedores', NULL, '0', '0', '$prov', 'gestionarProveedores' AS tmp WHERE NOT EXISTS (SELECT nombre FROM gen_subsecciones WHERE nombre = 'Gestionar Proveedores') LIMIT 1";
            
            $sub_gestionarMetodos = "INSERT INTO `gen_subsecciones` ( `nombre`, `descripcion`, `permiso`, `orden`, `id_seccion`, `identificador`)
 select 'Gestionar Metodos de Pago', NULL, '0', '0', '$prov', 'gestionarMetodos' AS tmp WHERE NOT EXISTS (SELECT nombre FROM gen_subsecciones WHERE nombre = 'Gestionar Metodos de Pago') LIMIT 1";
            
            $sub_gestionarContactos = "INSERT INTO `gen_subsecciones` ( `nombre`, `descripcion`, `permiso`, `orden`, `id_seccion`, `identificador`)
 select 'Gestionar Contactos', NULL, '0', '0', '$prov', 'gestionarContactos' AS tmp WHERE NOT EXISTS (SELECT nombre FROM gen_subsecciones WHERE nombre = 'Gestionar Contactos') LIMIT 1";
            
            mysqli_query($con, $sub_gestionarProveedores);
            mysqli_query($con, $sub_gestionarMetodos);
            mysqli_query($con, $sub_gestionarContactos);
            
            mysqli_query($con, $sec_productos);
            $prod = mysqli_insert_id($con);
            
            $sub_gestionarProductos = "INSERT INTO `gen_subsecciones` ( `nombre`, `descripcion`, `permiso`, `orden`, `id_seccion`, `identificador`)
 select 'Gestionar Productos', NULL, '0', '0', '$prod', 'gestionarProductos' AS tmp WHERE NOT EXISTS (SELECT nombre FROM gen_subsecciones WHERE nombre = 'Gestionar Productos') LIMIT 1";
            
            $sub_gestionarTipos = "INSERT INTO `gen_subsecciones` ( `nombre`, `descripcion`, `permiso`, `orden`, `id_seccion`, `identificador`)
 select 'Gestionar Tipos de Producto', NULL, '0', '0', '$prod', 'gestionarTipos' AS tmp WHERE NOT EXISTS (SELECT nombre FROM gen_subsecciones WHERE nombre = 'Gestionar Tipos de Producto') LIMIT 1";
            
            $sub_gestionarCategorias = "INSERT INTO `gen_subsecciones` ( `nombre`, `descripcion`, `permiso`, `orden`, `id_seccion`, `identificador`)
 select 'Gestionar Categorias de Producto', NULL, '0', '0', '$prod', 'gestionarCategoria' AS tmp WHERE NOT EXISTS (SELECT nombre FROM gen_subsecciones WHERE nombre = 'Gestionar Categorias de Producto') LIMIT 1";
            
            mysqli_query($con, $sub_gestionarProductos);
            mysqli_query($con, $sub_gestionarTipos);
            mysqli_query($con, $sub_gestionarCategorias);
            
            
            mysqli_query($con, $sec_presupuestos);
            $presup = mysqli_insert_id($con);
            
            $sub_gestionarPedidos = "INSERT INTO `gen_subsecciones` ( `nombre`, `descripcion`, `permiso`, `orden`, `id_seccion`, `identificador`)
 select 'Gestionar Pedidos', NULL, '0', '0', '$presup', 'gestionPedidos' AS tmp WHERE NOT EXISTS (SELECT nombre FROM gen_subsecciones WHERE nombre = 'Gestionar Pedidos') LIMIT 1";
            
            $sub_crearFases = "INSERT INTO `gen_subsecciones` ( `nombre`, `descripcion`, `permiso`, `orden`, `id_seccion`, `identificador`)
 select 'Crear Fase de Venta', NULL, '0', '0', '$presup', 'crearFase' AS tmp WHERE NOT EXISTS (SELECT nombre FROM gen_subsecciones WHERE nombre = 'Crear Fase de Venta') LIMIT 1";
            
            mysqli_query($con, $sub_gestionarPedidos);
            mysqli_query($con, $sub_crearFases);
            
            
            mysqli_query($con, $sec_facturas);
            $comp = mysqli_insert_id($con);
            
            
            mysqli_query($con, $sec_recepciones);
            $recep = mysqli_insert_id($con);
            
            $sub_comprobarEnvio = "INSERT INTO `gen_subsecciones` ( `nombre`, `descripcion`, `permiso`, `orden`, `id_seccion`, `identificador`)
 select 'Comprobar Envios a Recibir', NULL, '0', '0', '$recep', 'comprobarEnvio' AS tmp WHERE NOT EXISTS (SELECT nombre FROM gen_subsecciones WHERE nombre = 'Comprobar Envios a Recibir') LIMIT 1";
            
            $sub_notificarEstado = "INSERT INTO `gen_subsecciones` ( `nombre`, `descripcion`, `permiso`, `orden`, `id_seccion`, `identificador`)
 select 'Notificar Estado de Envio', NULL, '0', '0', '$recep', 'notificarEstado' AS tmp WHERE NOT EXISTS (SELECT nombre FROM gen_subsecciones WHERE nombre = 'Notificar Estado de Envio') LIMIT 1";
            
            mysqli_query($con, $sub_comprobarEnvio);
            mysqli_query($con, $sub_notificarEstado);
            
            
            
            ////////////////////// INSERCIONES /////////////////////////
            
            $insertarFases1="INSERT INTO `com_fases_pedido` (`id_fase_pedido`, `fase`) VALUES (NULL, 'Pedido Interno')";
            $insertarFases2="INSERT INTO `com_fases_pedido` (`id_fase_pedido`, `fase`) VALUES (NULL, 'Pedido')";
            $insertarFases3="INSERT INTO `com_fases_pedido` (`id_fase_pedido`, `fase`) VALUES (NULL, 'En espera de recepcion')";
            $insertarFases4="INSERT INTO `com_fases_pedido` (`id_fase_pedido`, `fase`) VALUES (NULL, 'Recibido')";
            $insertarFases5="INSERT INTO `com_fases_pedido` (`id_fase_pedido`, `fase`) VALUES (NULL, 'Cancelado')";
            
            mysqli_query($con, $insertarFases1);
            mysqli_query($con, $insertarFases2);
            mysqli_query($con, $insertarFases3);
            mysqli_query($con, $insertarFases4);
            mysqli_query($con, $insertarFases5);
            
            $insertarProveedor="insert into com_proveedores(cif, nombre, direccion, cod_postal, poblacion, provincia, telefono, email) values('A23242525', 'Suelas Mart韓ez S.L', 'Avda. de Santo domingo 33', '04321', 'Valencia', 'Valencia', '963889254', 'info@suelasmartinez.es')";
            $insertarContacto="insert into com_contactos(id_proveedor, nombre, departamento) values(1, 'Ricardo Gonz醠ez', 'Almac閚')";
            $insertarMetodo="insert into com_metodos_pago(nombre, descripcion) values('Paypal', 'Famosa forma de pago utilizada en transacciones online.')";
            $insertarFactura="insert into com_facturas(numero_factura, id_pedido) values(21, 1)";
            $insertarProducto="insert into inv_productos(id_producto, nombre,fecha_alta,imagen) values(666, 'producto estrella','2018-03-05','https://vignette.wikia.nocookie.net/umineko/images/5/5e/Estrella.png/revision/latest?cb=20140715085659&path-prefix=es')";
            $insertarLineaPedido="insert into com_lineas_pedido(id_linea_pedido,id_producto,unidades, importe ) values(666,666,2,170)";
            $insertarPedido="insert into com_pedidos(numero_pedido, id_linea_pedido,id_fase_pedido) values('2221', 666,3)";
            
            
            mysqli_query($con, $insertarProveedor);
            mysqli_query($con, $insertarContacto);
            mysqli_query($con, $insertarMetodo);
            mysqli_query($con, $insertarFactura);
            mysqli_query($con, $insertarProducto);
            mysqli_query($con, $insertarLineaPedido);
            mysqli_query($con, $insertarPedido);
            
            
            
            echo "<p>Secciones y subsecciones creadas.</p>";
            
            mysqli_commit($con);
            
            echo "<p>Transacci贸n finalizada.</p>";
            