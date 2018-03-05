<?php

include_once '../../../../clases/config.php';
include_once '../../../../clases/claseHerramientas.php';
include_once '../../../../clases/claseTabla.php';
include_once '../../../../modulos/empleados/clases/empleado.php';

$empleado = new Empleado("gen_empleados");
try {

    print_r($_FILES);
    if ($_FILES['foto']['name'] != "") {
        $nombre_archivo = $_FILES['foto']['name'];
        $tipo_archivo = $_FILES['foto']['type'];
        $tamano_archivo = $_FILES['foto']['size'];

        $tipo_archivo = explode('/', $tipo_archivo)[1];
        $nombre_foto = "/fotos/" . $_POST['nombre'] . $_POST['apellidos'] . "." . $tipo_archivo;
        if ($tamano_archivo < 100000) {
            if ($tipo_archivo == "png" || $tipo_archivo == "jpeg" || $tipo_archivo == "jpg") {
                if (move_uploaded_file($_FILES['foto']['tmp_name'], "../.." . $nombre_foto)) {
                    echo "El archivo ha sido cargado correctamente.";
                    $_POST['foto'] = $nombre_foto;
                } else {
                    echo "Ocurrió algún error al subir el fichero. No pudo guardarse.";
                }
            } else {
                echo "El archivo debe ser un png, jpg o jpeg.";
            }
        }
    }

    if ($_FILES['curriculum']['name'] != "") {
        $nombre_archivo = $_FILES['curriculum']['name'];
        $tipo_archivo = $_FILES['curriculum']['type'];
        $tamano_archivo = $_FILES['curriculum']['size'];

        $tipo_archivo = explode('/', $tipo_archivo)[1];
        $nombre_curr = "/curriculums/" . $_POST['nombre'] . $_POST['apellidos'] . "." . $tipo_archivo;
        if ($tamano_archivo < 10000000) {
            if ($tipo_archivo == "pdf") {
                if (move_uploaded_file($_FILES['curriculum']['tmp_name'], "../.." . $nombre_curr)) {
                    echo "El archivo ha sido cargado correctamente.";
                    $_POST['curriculum'] = $nombre_curr;
                } else {
                    echo "Ocurrió algún error al subir el fichero. No pudo guardarse.";
                }
            } else {
                echo "El arhcivo debe ser un pdf.";
            }
        }
    }

    print_r($_POST);
    $empleado->insertar($_POST);

    $emp = $empleado->getUltimoID();

    if (!$_POST['id_departamento'] == 0) {
        $historico = new Tabla("rrhh_historico");
        $hist = array('id_departamento' => $_POST['id_departamento'], 'id_empleado' => $emp, 'fecha' => $_POST['fecha_inc']);
        $historico->insertar($hist);
    }
} catch (Exception $ex) {
    
}
?>