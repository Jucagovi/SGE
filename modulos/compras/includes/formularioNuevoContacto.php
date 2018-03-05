<?php

include_once '../../../clases/config.php';
include_once '../../../clases/claseHerramientas.php';
include_once '../../../clases/claseTabla.php';
include_once '../clases/Proveedor.php';

$proveedor = new Proveedor();

echo "<div id='nuevoContacto'>";
echo "<form id='formularioNuevoContacto'>";
echo "<h2>NUEVO CONTACTO</h2>";
echo "<label for='nombre'>Nombre: <input id='nombre' name='nombre' type='text' /></label>";
echo "<label for='departamento'>Departamento: <input id='departamento' name='departamento' type='text' /></label>";

echo "<label for='proveedoresRegistrados'>Proveedores: <select id='proveedoresRegistrados'>";
$proveedoresRegistrados = $proveedor->obtenerProveedores();
while ( $proveedor = $proveedoresRegistrados->fetch_array() ) {
	echo "<option value='" . $proveedor['id_proveedor'] . "'>" . $proveedor['nombre'] . "</option>";
}
echo "</select></label>";
echo "<input id='botonCrearContacto' name='botonCrearContacto' type='button' value='Crear Contacto' />";
echo "</form>";
echo "</div>";

?>