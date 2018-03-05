<?php
include_once '../../../clases/config.php';
include_once '../../../clases/claseHerramientas.php';
include_once '../../../clases/claseTabla.php';
include_once '../clases/claseEquipos.php';
$feo = new Tabla("tables");
$conexion = $feo->conectar();
$tpv = new Equipo();
$tpv->mostrarEquipos($conexion);
?>
