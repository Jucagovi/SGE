<?php
include_once '../../../clases/config.php';
include_once '../../../clases/claseHerramientas.php';
include_once '../../../clases/claseTabla.php';
include_once '../clases/claseTPV.php';
$feo = new Tabla("tables");
$conexion = $feo->conectar();
$tpv = new TPV();

$id = $_REQUEST['p']; //Recojo el id por parámetro
$tpv->borrarTPV($conexion,$id);
header("Location: /index.php");
die();
?>
