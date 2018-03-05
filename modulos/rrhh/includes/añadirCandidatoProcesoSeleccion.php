<?php
//Inserta un nuevo Candidato en un proceso de Seleccion
include_once '../../../clases/config.php';
include_once '../../../clases/claseHerramientas.php';
include_once '../clases/claseCandidatoProcesoSeleccion.php';
$feo = new CandidatoProcesoSeleccion();
$feo->insertarCandidatoProcesoSeleccion($_POST);
?>
