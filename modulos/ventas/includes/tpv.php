<?php
include_once '../../../clases/config.php';
include_once '../../../clases/claseHerramientas.php';
include_once '../../../clases/claseTabla.php';
include_once '../clases/claseTPV.php';
$feo = new Tabla("tables");
$conexion = $feo->conectar();
$tpv = new TPV();
$tpv->mostrarTPV($conexion);
?>
