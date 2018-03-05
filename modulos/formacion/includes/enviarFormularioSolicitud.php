<?php

include_once '../../../clases/config.php';
include_once '../../../clases/claseHerramientas.php';
include_once '../clases/claseSolicitud.php';

echo $POST['id'];
$feo = new Solicitud();
$feo->enviarFormularioSolicitud($_POST);
?>
