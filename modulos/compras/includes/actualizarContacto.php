<?php

include_once '../../../clases/config.php';
include_once '../../../clases/claseHerramientas.php';
include_once '../../../clases/claseTabla.php';
include_once '../clases/Contacto.php';

$contacto = new Contacto();

$datosRecibidos = $_POST;

$actualizado = $contacto->mostrar_actualizar($datosRecibidos["id_contacto"], $datosRecibidos);

if ( $actualizado ) {
	echo "Contacto actualizado correctamente.";
} else {
	echo "Error al actualizar el contacto en la base de datos.";
}

?>