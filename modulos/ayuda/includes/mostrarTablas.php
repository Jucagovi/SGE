<?php

    include_once '../../../clases/config.php';
    include_once '../../../clases/claseHerramientas.php';
    include_once '../../../clases/claseTabla.php';
    $feo = new Tabla("tables");
    $conexion = $feo->conectar();
      
    try {
        $rs = $conexion->query("SHOW TABLES;");
        
        $html = "<div id='ayuda'><h3>Listado de tablas de la aplicación.</h3>";
        while ($fila = $rs->fetch_array()){
            $html .= "<p class='gen_tabla'>".$fila["Tables_in_sge_proyecto"]."</p>";
        }
        $html .= "</div>";
        echo $html;
       
    } catch(Exception $e) {
        echo "<b>Se ha producido el siguiente error:".$e->getMessage().".<b>";
    }

?>
