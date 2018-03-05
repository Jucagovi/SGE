<?php
include_once '../../../clases/config.php';
include_once '../../../clases/claseHerramientas.php';
include_once '../../../clases/claseTabla.php';
include_once '../clases/claseVenta.php';
$feo = new Tabla("tables");
$conexion = $feo->conectar();
$venta = new Venta();
$venta->mostrarVentas($conexion);
?>
