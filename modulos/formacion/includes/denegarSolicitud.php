<?php

include_once '../../../clases/config.php';
include_once '../../../clases/claseHerramientas.php';
include_once '../clases/claseSolicitud.php';

$feo = new Solicitud();
$feo->rechazarSolicitud($_POST['id']);
?>
