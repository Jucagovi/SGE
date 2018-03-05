<?php
include_once '../../../clases/config.php';
include_once '../../../clases/claseHerramientas.php';
include_once '../../../clases/claseTabla.php';
include_once '../clases/claseEstado.php';
$feo = new Tabla("tables");
$conexion = $feo->conectar();
$estado = new Estado();
$estado->mostrarEstados($conexion);
?>
