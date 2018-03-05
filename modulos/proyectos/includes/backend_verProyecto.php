<?php
if (!isset($_REQUEST) || empty($_REQUEST))
    die("No puedes estar aquí");

require_once "funciones.php";

$d = $_REQUEST;

$respuesta = array( "result" => false, "respuesta" => "Se ha producido un error: ", "data" => $d, "finalizado" => false);
$error = false;

$con = $herramientas->conectar();
$con->begin_transaction();
try {
    $id = $d["id_proy"];
    $horas = $d["horas"];
    $fecha = date("Y-m-d");

    $tareas_finalizadas = isset($d["finalizadas"]) ? $d["finalizadas"] : array() ;
    $_id = $con->real_escape_string($id);
    $tareas = _select("SELECT * FROM pro_tarea WHERE fecha_fin IS NULL AND id_proyecto = ".$_id);
    $i = 0; $num_avances = 0;
    foreach ($tareas as $tarea) {
        $horas_tarea = $horas[$i++];
        if ($tarea["fecha_fin"] == null && $horas_tarea > 0) {
            $id_tarea = $tarea["id_tarea"];
            $num_avances++;

            $sql = "INSERT INTO pro_jornada (fecha, horas, id_tarea) VALUES (?, ?, ?)";
            $prst = $con->prepare($sql);
            $prst->bind_param("ssi", $fecha, $horas_tarea, $id_tarea);
            if (!$prst->execute()) {
                throw new Exception($prst->error);
            }
        }
    }

    $total_horas_tareas_finalizadas = array();
    foreach ($tareas_finalizadas as $tarea_finalizada) {
        $id_tarea = $tarea_finalizada;
        $sql = "UPDATE pro_tarea SET fecha_fin = ? WHERE id_tarea = ? AND id_proyecto = ?";
        $prst = $con->prepare($sql);
        $prst->bind_param("sii", $fecha, $id_tarea, $id);
        if (!$prst->execute()) {
            throw new Exception($prst->error);
        }

        $_id_tarea = $con->real_escape_string($id_tarea);
        $query = "SELECT SUM(horas) as horas FROM pro_jornada WHERE id_tarea = ".$_id_tarea;
        $result = $con->query($query);
        if ($res = $result->fetch_assoc()) {
            $total_horas_tareas_finalizadas[] = $res["horas"];
        }
    }
    $respuesta["total_horas_finalizadas"] = $total_horas_tareas_finalizadas;

    if ($num_avances > 0) {
        $accion = "Se ha avanzado en un proyecto";
        $id_emple = isset($_SESSION["id_usuario"]) ? $_SESSION["id_usuario"] : 0;
        $sql = "INSERT INTO pro_historico (accion, fecha, id_empleado) VALUES (?, ?, ?)";
        $prst = $con->prepare($sql);
        $prst->bind_param("ssi", $accion, $fecha, $id_emple);
        if (!$prst->execute()) {
            throw new Exception($prst->error);
        }

        $hay_tareas_pendiendes = true;
        $query = "SELECT count(*) as pendientes FROM pro_tarea WHERE fecha_fin IS NULL AND id_proyecto = ".$id;
        $result = $con->query($query);
        if ($res = $result->fetch_assoc()) {
            $hay_tareas_pendiendes = $res["pendientes"] > 0;
        }

        if (!$hay_tareas_pendiendes) {
            $estado = "finalizado";
            $sql = "UPDATE pro_proyecto SET estado = ? WHERE id_proyecto = ?";
            $prst = $con->prepare($sql);
            $prst->bind_param("si", $estado, $id);
            if (!$prst->execute()) {
                throw new Exception($prst->error);
            }

            $accion = "Se ha finalizado en un proyecto";
            $id_emple = isset($_SESSION["id_usuario"]) ? $_SESSION["id_usuario"] : 0;
            $sql = "INSERT INTO pro_historico (accion, fecha, id_empleado) VALUES (?, ?, ?)";
            $prst = $con->prepare($sql);
            $prst->bind_param("ssi", $accion, $fecha, $id_emple);
            if (!$prst->execute()) {
                throw new Exception($prst->error);
            }

            $respuesta["finalizado"] = true;
        }

        $con->commit();
        $respuesta["result"] = true;
        $respuesta["respuesta"] = "Proyecto avanzado correctamente";
    }
    else
        $respuesta["respuesta"] = "No se ha avanzado en ninguna nueva tarea";

    $con->close();
} catch (Exception $exception) {
    $con->rollback();
    $respuesta["result"]    = false;
    $respuesta["respuesta"] .= $exception->getMessage();
    $con->close();
}

echo json_encode($respuesta);