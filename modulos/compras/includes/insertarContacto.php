<?php

include_once '../../../clases/config.php';
include_once '../../../clases/claseHerramientas.php';
include_once '../../../clases/claseTabla.php';
include_once '../clases/Contacto.php';

$contacto = new Contacto();

$datosContacto = $_POST;

$insercionCorrecta = $contacto->insertar($datosContacto);

 if ( $insercionCorrecta ) {
	echo "Contacto guardado correctamente.";
} else {
	echo "Error al insertar el contacto en la base de datos.";
}

?>