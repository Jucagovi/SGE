<?php

include_once '../../../clases/config.php';
include_once '../../../clases/claseHerramientas.php';
include_once '../../../clases/claseTabla.php';
include_once '../clases/Contacto.php';

$contacto = new Contacto();

$idContacto = $_POST;

print($idContacto);

?>