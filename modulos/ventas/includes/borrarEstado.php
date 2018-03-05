<?php
include_once '../../../clases/config.php';
include_once '../../../clases/claseHerramientas.php';
include_once '../../../clases/claseTabla.php';
include_once '../clases/claseEstado.php';
$feo = new Tabla("tables");
$conexion = $feo->conectar();
$estado = new Estado();

$id = $_REQUEST['p']; //Recojo el id por parámetro
$estado->borrarEstado($conexion,$id);
header("Location: /index.php");
die();
?>
