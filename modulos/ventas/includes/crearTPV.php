<?php
include_once '../../../clases/config.php';
include_once '../../../clases/claseHerramientas.php';
include_once '../../../clases/claseTabla.php';
include_once '../clases/claseTPV.php';
$feo = new Tabla("tables");
$conexion = $feo->conectar();
$tpv = new TPV();
$tpv->crearTPV($conexion,$_POST['idTPV'], $_POST['idEquipo']);
header("Location: /index.php"); //header() redirecciona la página al inicio, para que no se quede en crearComercial.php, que es una página en blanco
die(); //die() no se para qué sirve, pero en internet vi que había que ponerlo para evitar errores con el header o algo
?>
