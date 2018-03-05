<?php
include_once '../../../clases/config.php';
include_once '../../../clases/claseHerramientas.php';
include_once '../clases/claseEmpleado.php';
$empleado = new Empleado();
$empleado->cambiarDepartamento($_POST);
?>
