<?php
    $feo = new Tabla("gen_modulos");
    $conexion = $feo->conectar();
    
    try {
        $rs = $conexion->query("SELECT * FROM ".$feo->get_tabla()." ORDER BY orden;");
        while ($fila = $rs->fetch_array()) {
            echo "<script src='./modulos/".strtolower($fila['nombre'])."/js/".strtolower($fila['nombre']).".js' type='text/javascript'></script>";
            echo "<link rel='stylesheet' href='./modulos/".strtolower($fila['nombre'])."/css/".strtolower($fila['nombre']).".css' />";
        }
    } catch(Exception $e) {
        return false;
    }
?>
