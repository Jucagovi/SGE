<?php

require_once("../../../../clases/config.php");

// Clases
include_once '../../../../clases/claseHerramientas.php';
include_once '../../../../clases/claseTabla.php';
include_once '../../../../modulos/inventario/clases/inventario.php';

$feo = new Inventario('inv_inventario');
try {
    echo $feo->obtenerTablaInventario();
} catch (Exception $e) {
    echo "<b>Se ha producido el siguiente error:" . $e->getMessage() . ".<b>";
}
