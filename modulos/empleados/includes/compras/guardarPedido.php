<?php

include_once '../../../../clases/config.php';
include_once '../../../../clases/claseHerramientas.php';
include_once '../../../../clases/claseTabla.php';
include_once '../../../../modulos/empleados/clases/compra.php';

//print_r($_POST);
$lineaP = new Compra("com_lineas_producto");
$id_producto = $_POST["id_producto"];
$cantidad = $_POST["cantidad"];
$precio = $lineaP->precioProducto($id_producto);
$preciototal = $precio * $cantidad;


$arrayCosas = array("id_producto" => $id_producto, "unidades" => $cantidad, "importe" => $preciototal);
//print_r($arrayCosas);
$lineaP->insertar($arrayCosas);

$lineaProducto = $lineaP->ultimaLinea();

$pedido = new Compra("com_pedidos");
$rand = $id_producto * $precio * $preciototal;
$nPedido = rand(1, $rand);
$arrayPedidos = array("numero_pedido" => $nPedido, "id_linea_producto" => $lineaProducto, "id_fase_pedido" => "1");
$pedido->insertar($arrayPedidos);

$pedidoEmpleado = new Tabla("emp_pedidos_empleados");
$arrayPedEmp = array("id_pedido" => $lineaProducto, "id_empleado" => $_POST['id_empleado'], "fecha" => $_POST['fecha']);
$pedidoEmpleado->insertar($arrayPedEmp);
?>
