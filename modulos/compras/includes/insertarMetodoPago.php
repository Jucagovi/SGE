<?php

include_once './../../../clases/config.php';
include_once '../../../clases/claseHerramientas.php';
include_once '../../../clases/claseTabla.php';
include_once '../clases/MetodoPago.php';

$metodoPago = new MetodoPago();

$datos = $_POST;

$insercionCorrecta = $metodoPago->insertar($datos);

if ( $insercionCorrecta ) {
	echo "Método de pago insertado correctamente en la base de datos.";
	echo "<button id='volverAMetodos' tipo='boton'>Volver</button>";
} else {
	echo "Error al insertar el método de pago en la base de datos.";
}

?>