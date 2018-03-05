<?php

include_once '../../../clases/config.php';
include_once '../../../clases/claseHerramientas.php';
include_once '../clases/claseCurso.php';

$feo = new Curso();
$feo->enviarFormulario($_POST);
?>
