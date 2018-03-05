<?php
// Crea un nuevo Proceso de Seleccion
include_once '../../../clases/config.php';
include_once '../../../clases/claseHerramientas.php';
include_once '../clases/claseProcesoSeleccion.php';
$feo = new ProcesoSeleccion();
$feo->insertarProcesoSeleccion($_POST);
?>
