<?php

include_once '../../../../clases/config.php';
include_once '../../../../clases/claseHerramientas.php';
include_once '../../../../clases/claseTabla.php';
include_once '../../../../modulos/empleados/clases/mensaje.php';

$mensaje = new mensaje("emp_mensajes");
$mensaje->marcarLeido($_POST['identificador']);