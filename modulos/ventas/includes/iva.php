<?php
include_once '../../../clases/config.php';
include_once '../../../clases/claseHerramientas.php';
include_once '../../../clases/claseTabla.php';
include_once '../clases/claseIVA.php';
$feo = new Tabla("tables");
$conexion = $feo->conectar();
$iva = new IVA();
$iva->mostrarIVA($conexion);
?>
