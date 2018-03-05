<?php
include_once '../../../clases/config.php';
include_once '../../../clases/claseHerramientas.php';
include_once '../../../clases/claseTabla.php';
include_once '../clases/claseComercial.php';
$feo = new Tabla("tables");
$conexion = $feo->conectar();
$comercial = new Comercial();

$id = $_REQUEST['p']; //Recojo el id por parámetro
$comercial->borrarComercial($conexion,$id);
header("Location: /index.php");
die();
?>
