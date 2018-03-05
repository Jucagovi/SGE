<?php
include_once '../../../clases/config.php';
include_once '../../../clases/claseHerramientas.php';
include_once '../clases/claseCandidatoProcesoSeleccion.php';
$feo = new CandidatoProcesoSeleccion();
$feo->editarEstadoProceso($_POST);
?>
