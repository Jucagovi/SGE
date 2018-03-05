<?php

include_once '../../../clases/config.php';
include_once '../../../clases/claseHerramientas.php';
include_once '../../../clases/claseTabla.php';
include_once '../clases/Proveedor.php';

$proveedor = new Proveedor();

$cif = $_POST["cif"];
$resultado = $proveedor->obtenerProveedor($cif);

while ( $rs = $resultado->fetch_array() ) {
	echo $rs["nombre"];
}

?>