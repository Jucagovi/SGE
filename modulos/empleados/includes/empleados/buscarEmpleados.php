<?php

include_once '../../../../clases/config.php';
include_once '../../../../clases/claseHerramientas.php';
include_once '../../../../clases/claseTabla.php';
include_once '../../../../modulos/empleados/clases/empleado.php';

$empleado = new Empleado("gen_empleados");
try {
    $lista = $empleado->getEmpleadoNombre($_POST["nombre"]);
    $html = "<ul>";
    while($fila = mysqli_fetch_array($lista)){
        $html .= "<li id='$fila[0]' class='empleado'>" . $fila['nombre'] . " " . $fila['apellidos'] . "</li>";
    }
    $html .= "</ul>";
    echo $html;
} catch (Exception $ex) {
    
}
?>