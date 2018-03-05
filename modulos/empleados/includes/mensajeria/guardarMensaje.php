<?php

include_once '../../../../clases/config.php';
include_once '../../../../clases/claseHerramientas.php';
include_once '../../../../clases/claseTabla.php';
include_once '../../../../modulos/empleados/clases/mensaje.php';

$mensaje = new Mensaje("emp_mensajes");
try {
    $empleado = $_POST['empleados'];
    unset($_POST['empleados']);
    $mensaje->insertar($_POST);

    $MensajeEmpleados = new Tabla("emp_mensajes_empleados");
    $empleados = explode(',', $empleado);
    $nMens = $mensaje->ultimoMensaje();
    foreach ($empleados as $emp) {
        $emple = array('id_mensaje' => $nMens, 'id_emp_receptor' => $emp, 'estado' => 0);
        $MensajeEmpleados->insertar($emple);
    }
} catch (Exception $ex) {
    
}
?>
