<?php

require_once("../../../../clases/config.php");

// Clases
include_once '../../../../clases/claseHerramientas.php';
include_once '../../../../clases/claseTabla.php';
include_once '../../../../modulos/inventario/clases/producto.php';

$feo = new Producto('inv_productos');
try {
    $feo->extraerFicheroCSV();
    
} catch (Exception $e) {
    echo "<b>Se ha producido el siguiente error:" . $e->getMessage() . ".<b>";
}
