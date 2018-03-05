<?php

include_once '../../../clases/claseHerramientas.php';
include_once '../../../clases/claseTabla.php';
include_once '../../../clases/config.php';
include_once '../clases/Proveedor.php';
include_once '../clases/MetodoPago.php';

$proveedor = new Proveedor();

$nombre = $_POST["nombre"];
$identificador = $_POST["identificador"];
$cif = $proveedor->obtenerCifProveedor($identificador);
$idProveedor = $proveedor->obtenerIdProveedor($cif);
$resultado = $proveedor->obtenerProveedor($cif);

echo "<h2>" . $nombre . "</h2>";
echo "<br />";

	while ( $datos = $resultado->fetch_array() ) {
		echo "CIF: " . $datos["cif"] . "<br />";
		echo "Nombre: " . $datos["nombre"] . "<br />";
		echo "Dirección: " . $datos["direccion"] . "<br />";
		echo "Código Postal: " . $datos["cod_postal"] . "<br />";
		echo "Población: " . $datos["poblacion"] . "<br />";
		echo "Provincia: " . $datos["provincia"] . "<br />";
		echo "Teléfono: " . $datos["telefono"] . "<br />";
		echo "E-Mail: " . $datos["email"] . "<br />";
	}

	echo "<h3>personas de contacto</h3>";

// 	$contacto = $proveedor->obtenerDatosContacto($idProveedor);

// 	while ( $r = $contacto->fetch_array() ) {
// 		$departamento = ( $r["departamento"] === '' ) ? "No especificado" : $r["departamento"];
// 		echo "Contacto: " . $r["nombre"] . "(" . $departamento . ")";
// 		echo "<br />";
// 	}

		echo "<input id='" . $identificador . "' class='.iniciarCompra' name='botonIniciarCompra' type='button' value='Iniciar Compra' />";
	echo "<input id='" . $cif . "' class='editarProveedor' name='editarProveedor' type='button' value='Editar' />";
	echo "<input id='" . $identificador . "' class='eliminarProveedor' name='eliminarProveedor' type='button' value='Eliminar' />";

?>