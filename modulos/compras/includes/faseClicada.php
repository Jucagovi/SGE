<?php

    include_once '../../../clases/config.php';
    include_once '../../../clases/claseHerramientas.php';
    include_once '../../../clases/claseTabla.php';
    $feo = new Tabla("tables");
    $conexion = $feo->conectar();
      
    try {
        
        // Ejecutar la consulta
        $parametro = $_POST["identificador"];
        
        $rs = $conexion->query("SELECT id_fase_pedido,fase FROM com_fases_pedido where id_fase_pedido='".$parametro."'");
        $fila = $rs->fetch_array();
        
        
        $html ="<div id='faseClicada'><h2>Edicion de Fases</h2>";
        $html .= "<div id='fase".$fila["fase"]."'>";
        $html .= "</br>";
        $html .= " <div class='item1'></br><p>Fase: ".$fila["fase"]."</p></br></div>";
        
        $html .= "</div></div>";
        
        
        echo $html;
       
       
    } catch(Exception $e) {
        echo "<b>Se ha producido el siguiente error:".$e->getMessage().".<b>";
    }

?>
