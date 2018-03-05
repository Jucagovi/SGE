<?php

include_once '../../../../clases/config.php';
include_once '../../../../clases/claseHerramientas.php';
include_once '../../../../clases/claseTabla.php';
include_once '../../../../modulos/empleados/clases/evento.php';

$evento = new Evento("emp_eventos");
$datosEvento = array('nombre' => $_POST["nombre"], 'fecha' => $_POST["fecha"]);
$evento->insertar($datosEvento);

$ultimoEvento = $evento->ultimoEvento();

$categoria = new Tabla("emp_eventos_categorias");
$categorias = explode(',', $_POST['categorias']);
foreach ($categorias as $cat) {
    $categ = array('id_evento' => $ultimoEvento[0], 'id_categoria' => $cat);
    $categoria->insertar($categ);
}

$empleado = new Tabla("emp_empleados_eventos");
$empleados = explode(',', $_POST['empleados']);
foreach ($empleados as $emp) {
    $emple = array('id_empleado' => $emp, 'id_evento' => $ultimoEvento[0], 'confirmado' => $_POST['confirmar']);
    $empleado->insertar($emple);
}