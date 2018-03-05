<?php

include_once '../../../clases/config.php';
include_once '../../../clases/claseHerramientas.php';
include_once '../../../clases/claseTabla.php';
include_once '../clases/Contacto.php';

$contacto = new Contacto();

$idContacto = $_POST["idContacto"];

$datosContacto = $contacto->obtenerContacto($idContacto);

echo "<form id='formularioEditarContacto'";
while ( $r = $datosContacto->fetch_array() ) {
	echo "<h3>Ficha de " . $r["nombre"] . "</h3>";
	echo "<input id='id_contacto' name='id_contacto' text='hiden' value='" . $r["id_contacto"] . "' />";
			echo "<label for='nombre'>Nombre: <input id='nombre' name='nombre' type='text' value='" . $r["nombre"] . "' /></label>";
	echo "<label for='departamento'>Departamento: <input id='departamento' name='departamento' type='text' value='" . $r["departamento"] . "' /></label>";
echo "<br />";
}

echo "<input id='modificarContacto' name='modificarContacto' type='button' value='Modificar' />";
echo "<br />";
echo "</form>";

?>