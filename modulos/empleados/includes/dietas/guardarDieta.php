<?php

include_once '../../../../clases/config.php';
include_once '../../../../clases/claseHerramientas.php';
include_once '../../../../clases/claseTabla.php';
include_once '../../../../modulos/empleados/clases/dieta.php';

$dieta = new Dieta("emp_dietas");
try {
    $dieta->insertar($_POST);
    
} catch (Exception $ex) {
    
}
?>

