<?php
require_once("../../../../clases/config.php");
// Clases
include_once '../../../../clases/claseHerramientas.php';
include_once '../../../../clases/claseTabla.php';
include_once '../../../../modulos/inventario/clases/producto.php';
include_once '../../../../modulos/inventario/clases/pdf.php';
$pdf = new PDF();
$feo = new Producto('inv_productos');
try {
    $data = $feo -> obtenerProductos();
    $columns = array_keys($data[0]);
    $pdf->extraerFicheroPDF($columns, $data,'Informe de productos');
} catch (Exception $e) {
    echo "<b>Se ha producido el siguiente error:" . $e->getMessage() . ".<b>";
}

