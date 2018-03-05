<?php

include_once '../../../../clases/config.php';
include_once '../../../../clases/claseHerramientas.php';
include_once '../../../../clases/claseTabla.php';

$tabla = new Tabla("emp_categorias_dietas");
try {
    $tabla->insertar($_POST);
    
} catch (Exception $ex) {
    
}
?>
