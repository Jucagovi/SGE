<?php

require_once("../../../../clases/config.php");

// Clases
include_once '../../../../clases/claseHerramientas.php';
include_once '../../../../clases/claseTabla.php';
include_once '../../../../modulos/inventario/clases/transferencia.php';

$feo = new Transferencia('inv_transferencias');
try {
    echo $feo->obtenerTablaTransferencias();
} catch (Exception $e) {
    echo "<b>Se ha producido el siguiente error:" . $e->getMessage() . ".<b>";
}
