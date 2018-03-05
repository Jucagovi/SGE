<?php
include_once '../../../clases/config.php';
include_once '../../../clases/claseHerramientas.php';
include_once '../../../clases/claseTabla.php';
include_once '../clases/MetodoPago.php';
$metodoPago = new MetodoPago();
$metodoPago->GuardarModificacionMetodoPago();
?>
