<?php

include_once '../../../clases/config.php';
include_once '../../../clases/claseHerramientas.php';
include_once '../../../clases/claseTabla.php';
include_once '../clases/Proveedor.php';

$proveedor = new Proveedor();

$datosRecibidos = $_POST;

$actualizado = $proveedor->actualizar($datosRecibidos["id_proveedor"], $datosRecibidos);

if ( $actualizado ) {
	echo "Proveedor actualizado correctamente.";
} else {
	echo "Error al actualizar el proveedor en la base de datos.";
}

?>