<?php

    include_once '../../../clases/config.php';
    include_once '../../../clases/claseHerramientas.php';
    include_once '../../../clases/claseTabla.php';
    $feo = new Tabla("tables");
    $conexion = $feo->conectar();
      
    try {
        
        // Ejecutar la consulta
        $parametro = $_POST["identificador"];
        
        $rs = $conexion->query("SELECT id_metodo_pago,nombre,descripcion FROM com_metodos_pago where id_metodo_pago='".$parametro."'");
        $fila = $rs->fetch_array();
        
        $html ="<div id='metodoClicado'><h2>Metodo de Pago: ".$fila["nombre"]."</h2>";
        $html .= "<div id='metodo".$fila["nombre"]."'>";
        $html .= "</br>";
        $html .= " <div class='item1'></br><p>Descripcion: ".$fila["descripcion"]."</p>";
        $html.="</br></div> <button id='borrarMetodoElegido' idMetodo='".$parametro."' tipo='botonInterior'>Eliminar Metodo</button>";
        
        $html .= "</div></div>";
        
        
        echo $html;
       
       
    } catch(Exception $e) {
        echo "<b>Se ha producido el siguiente error:".$e->getMessage().".<b>";
    }

?>
