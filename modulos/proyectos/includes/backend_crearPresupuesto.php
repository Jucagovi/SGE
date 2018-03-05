<?php
if (!isset($_REQUEST) || empty($_REQUEST))
	die("No puedes estar aquí");

require_once "funciones.php";

$d = $_REQUEST;

$respuesta = array( "result" => false, "respuesta" => "Se ha producido un error: ", "data" => $d);

$iva = 21;
$estado = "presupuesto";
$id_tipo = $d["id_tipo"];
$nom = $d["nombre"];
$dsc = $d["descripcion"];

$error = false;
$con = $herramientas->conectar();
$con->begin_transaction();
$sql = "INSERT INTO pro_proyecto (nombre, descripcion, iva, estado, id_tipo_proyecto) VALUES (?, ?, ?, ?, ?)";
$prst = $con->prepare($sql);
$prst->bind_param("ssdsi", $nom, $dsc, $iva, $estado, $id_tipo);
$prst->execute();
if ($con->errno != 0) {
	$error = true;
	$con->rollback();
}

if (!$error) {
    $id_proy = $con->insert_id;

    $tipo = $con->real_escape_string($id_tipo);
    $tareas = obtener_tipo_tareas_proyecto($tipo);
    $respuesta["tareas"] = $tareas;
    $coste = 0;
    $i = 0;
    foreach ($tareas as $tarea) {
        $horas = $d["horas"][$i++];
        $coste += $horas * $tarea["precio"];
        $tipo = $tarea["id_tipo_tarea"];
        $nom = $tarea["nombre"];
        $desc = $tarea["descripcion"];

        $sql = "INSERT INTO pro_tarea (nombre, descripcion, horas_presupuestadas, id_tipo_tarea, id_proyecto) VALUES (?, ?, ?, ?, ?)";
        $prst = $con->prepare($sql);
        $prst->bind_param("ssdii", $nom, $desc, $horas, $tipo, $id_proy);
        $prst->execute();
        if ($con->errno != 0) {
            $error = true;
            $con->rollback();
            break;
        }
    }

    if (!$error) {
        $sql = "UPDATE pro_proyecto SET coste = ? WHERE id_proyecto = ?";
        $prst = $con->prepare($sql);
        $prst->bind_param("di", $coste, $id_proy);
        $prst->execute();
        if ($con->errno != 0) {
            $error = true;
            $con->rollback();
        }
    }

    if (!$error) {
        $accion = "Crear nuevo presupuesto";
        $fecha = date("Y-m-d");
        $id_emple = isset($_SESSION["id_usuario"]) ? $_SESSION["id_usuario"] : 0;
        $sql = "INSERT INTO pro_historico (accion, fecha, id_empleado) VALUES (?, ?, ?)";
        $prst = $con->prepare($sql);
        $prst->bind_param("ssi", $accion, $fecha, $id_emple);
        $prst->execute();
        if ($con->errno != 0) {
            $error = true;
            $con->rollback();
        }
    }
}

if (!$error) {
    $respuesta["result"] = true;
    $respuesta["respuesta"] = "Presupuesto creado correctamente";
    $con->commit();
}

$con->close();

echo json_encode($respuesta);