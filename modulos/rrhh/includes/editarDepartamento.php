<?php
//Actualiza un departamento
include_once '../../../clases/config.php';
include_once '../../../clases/claseHerramientas.php';
include_once '../clases/claseDepartamento.php';
$feo = new Departamento();
$feo->actualizarDepartamento($_POST);
?>
