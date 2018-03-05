<?php

require_once("../../../../clases/config.php");

// Clases
include_once '../../../../clases/claseHerramientas.php';
include_once '../../../../clases/claseTabla.php';
include_once '../../../../modulos/inventario/clases/inventario.php';

$feo = new Inventario('inv_pasillos');
try {
    echo $feo->obtenerTablaPasillos();
} catch (Exception $e) {
    echo "<b>Se ha producido el siguiente error:" . $e->getMessage() . ".<b>";
}
