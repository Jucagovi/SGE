<?php
include_once '../../../clases/config.php';
include_once '../../../clases/claseHerramientas.php';
include_once '../../../clases/claseTabla.php';
include_once '../clases/claseEquipos.php';
$feo = new Tabla("tables");
$conexion = $feo->conectar();
$equipo = new Equipo();

$id = $_REQUEST['p']; //Recojo el id por parámetro
$equipo->borrarEquipo($conexion,$id);
header("Location: /index.php");
die();
?>
