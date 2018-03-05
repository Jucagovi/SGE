<?php

    include_once '../../../clases/config.php';
    include_once '../../../clases/claseHerramientas.php';
    include_once '../../../clases/claseTabla.php';
    $feo = new Tabla("tables");
    $conexion = $feo->conectar();
      
    try {
        //".$fila["nombre"]."
        
        //   =====>   ".$fila["imagen"]."   <=====    
        
        // Ejecutar la consulta
        $rs = $conexion->query("SELECT id_producto,nombre,imagen FROM inv_productos");
        
        $html = "<div id='gestionProductos'><h2>Gestion de Productos.</h2>";
        
        $html .= "<div id='gridProductos'></br>
        <div class='grid-container'>";

        while ($fila = $rs->fetch_array()) {
            $html .= " <div id='gridProducto' feo='".$fila["id_producto"]."'><img src='".$fila["imagen"]."' height='150' width='150'><p id='nombre'>".$fila["nombre"]."</p></div>";
        }
        $html .= "</div></div></div>";
        echo $html;
       
       
    } catch(Exception $e) {
        echo "<b>Se ha producido el siguiente error:".$e->getMessage().".<b>";
    }

?>
