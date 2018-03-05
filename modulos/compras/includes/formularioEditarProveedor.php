<?php

include_once '../../../clases/config.php';
include_once '../../../clases/claseHerramientas.php';
include_once '../../../clases/claseTabla.php';
include_once '../clases/Proveedor.php';

$proveedor = new Proveedor();

$cifProveedor = $_POST["cif"];
$datosProveedor = $proveedor->obtenerProveedor($cifProveedor);

echo "<form id='formularioEditarProveedor'>";
while ( $r = $datosProveedor->fetch_array() ) {
	echo "<input id='id_proveedor' name='id_proveedor' text='hide' value='" . $r["id_proveedor"] . "' />";
	echo "<label for='cif'>C.I.F: <input id='cif' name='cif' type='text' value='" . $r["cif"] . "' /></label>";
echo "<label for='nombre'>Nombre: <input id='nombre' name='nombre' type='text' value='" . $r["nombre"] . "' /></label>";
echo "<label for='direccion'>Dirección: <input id='direccion' name='direccion' type='text' value='" . $r["direccion"] . "' /></label>";
echo "<label for='cod_postal'>Código Postal: <input id='cod_postal' name='cod_postal' type='text' value='" . $r["cod_postal"] . "' /></label>";
echo "<label for='poblacion'>Población: <input id='poblacion' name='poblacion' type='text' value='" . $r["poblacion"] . "' /></label>";
echo "<label for='provincia'>Provincia: <input id='pprovincia' name='provincia' type='text' value='" . $r["provincia"] . "' /></label>";
echo "<label for='telefono'>Teléfono: <input id='telefono' name='telefono' type='text' value='" . $r["telefono"] . "' /></label>";
echo "<label for='email'>E-Mail: <input id='email' name='email' type='text' value='" . $r["email"] . "' /></label>";
echo "<br />";

$contacto = $proveedor->obtenerDatosContacto($r["id_proveedor"]);

echo "<h3>Personas de contacto</h3>";
echo "<br />";

while ( $c = $contacto->fetch_array() ) {
	echo "Contacto: " . $c["nombre"] . "(" . $c["departamento"] . ")<br />";
	echo "<input id='" . $c["id_contacto"] . "' name='editarContacto' class='editarContacto' type='button' value='Editar' />";
	echo "<input id='" . $c["id_contacto"] . "' name='eliminarContacto' class='eliminarContacto' type='button' value='Eliminar' />";
	echo "<br />";
}
}
echo "<input id='modificarProveedor' name='modificarProveedor' type='button' value='Modificar' />";
echo "<br />";
echo "</form>";

?>