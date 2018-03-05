<?php

include_once '../../../../clases/config.php';
include_once '../../../../clases/claseHerramientas.php';
include_once '../../../../clases/claseTabla.php';

$tabla = new Tabla("emp_categorias_eventos");
$id = $_POST['id_categoria'];
$tabla->actualizar($id, $_POST);
?>