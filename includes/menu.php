<?php

    $feo = new Tabla("gen_modulos");
    $conexion = $feo->conectar();
    
    try {
        $rs = $conexion->query("SELECT * FROM ".$feo->get_tabla()." ORDER BY orden;");
        while ($fila = $rs->fetch_array()) {
            echo "<p class='menu'>".$fila['nombre']."</p>";
        }
    } catch(Exception $e) {
        echo "<b>Se ha producido el siguiente error:".$e->getMessage().".<b>";
    }


?>
