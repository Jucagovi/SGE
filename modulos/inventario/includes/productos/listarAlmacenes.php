<?php
// Archivo de configuración
require_once("../../../../clases/config.php");

// Clases
include_once '../../../../clases/claseHerramientas.php';
include_once '../../../../clases/claseTabla.php';
include_once '../../../../modulos/inventario/clases/producto.php';
$feo = new Producto('inv_productos');
echo $feo->obtenerAlmacenesFormulario($_POST['id_inventario']);
       
?>