<?php
include_once '../../../clases/config.php';
include_once '../../../clases/claseHerramientas.php';
include_once '../../../clases/claseTabla.php';
include_once '../clases/claseComercial.php';
$feo = new Tabla("tables");
$conexion = $feo->conectar();
$comercial = new Comercial();
$comercial->mostrarComerciales($conexion);
?>
