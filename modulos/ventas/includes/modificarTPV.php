<?php
include_once '../../../clases/config.php';
include_once '../../../clases/claseHerramientas.php';
include_once '../../../clases/claseTabla.php';
include_once '../clases/claseTPV.php';
$feo = new Tabla("tables");
$conexion = $feo->conectar();
$tpv = new TPV();

$idTPV = $_REQUEST['idTPV'];
$idEquipo = $_REQUEST['idEquipo'];
$tpv->modificarTPV($conexion,$idTPV,$idEquipo);
header("Location: /index.php");
die();
?>
