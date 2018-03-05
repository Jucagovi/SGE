<?php
//Crea un nuevo Candidato
include_once '../../../clases/config.php';
include_once '../../../clases/claseHerramientas.php';
include_once '../clases/claseCandidato.php';
$feo = new Candidato();
$feo->insertarCandidato($_POST);
?>
