<?php

include_once '../../../clases/config.php';
include_once '../../../clases/claseHerramientas.php';
include_once '../../../clases/claseTabla.php';
include_once '../clases/Proveedor.php';

$proveedor = new Proveedor();

$cif = $proveedor->obtenerCifProveedor($_POST["nombre"]);
$id = $proveedor->obtenerIdProveedor($cif);
$borradoCorrectamente = $proveedor->borrar($id);

 if ( $borradoCorrectamente ) {
 	echo true;
 } else {
 	echo false;
 }

?>