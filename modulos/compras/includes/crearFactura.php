<?php

include_once '../../../clases/config.php';
include_once '../../../clases/claseHerramientas.php';
include_once '../../../clases/claseTabla.php';
include_once '../clases/Factura.php';

$factura = new Factura();

if ( $factura->insertar($_POST) ) {
echo "Factura insertada correctamente en la base de datos.";
} else {
echo "Error al insertar la factura en la base de datos.";
}

  ?>