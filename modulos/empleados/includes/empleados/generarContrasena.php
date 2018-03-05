<?php

include_once '../../../../clases/config.php';
include_once '../../../../clases/claseHerramientas.php';
include_once '../../../../clases/claseTabla.php';
include_once '../../../../modulos/empleados/clases/empleado.php';

$emp = new Empleado("gen_empleados");
$pass = $emp->generaContrasena();
echo $pass;