<?php

    include_once '../../../clases/config.php';
    include_once '../../../clases/claseHerramientas.php';
    include_once '../../../clases/claseTabla.php';
    $feo = new Tabla("tables");
    $conexion = $feo->conectar();
      
    try {
        
        // Ejecutar la consulta
        $parametro = $_POST["identificador"];
        
        $rs = $conexion->query("SELECT id_tipo_producto,tipo,descripcion FROM inv_tipos_producto where id_tipo_producto='".$parametro."'");
        $fila = $rs->fetch_array();
        
        $rs2 = $conexion->query("SELECT id_producto,nombre,id_tipo_producto FROM inv_productos where id_tipo_producto='".$fila["id_tipo_producto"]."'");
        
        
        $html ="<div id='tipoClicado'><h2>Tipo: ".$fila["tipo"]."</h2>";
        $html .= "<div id='tipo".$fila["tipo"]."'>";
        $html .= "</br>";
        $html .= " <div class='item1'></br><p>Descripcion: ".$fila["descripcion"]."</p>
                    <p>Productos: <select name='productosPorTipo'>";
                    while ($fila2 = $rs2->fetch_array()) {
                        $html .= "<option value='producto".$fila2["id_producto"]."'>".$fila2["nombre"]."</option>";
                    }


                    $html.="</select> </p></br></div>";
        
        $html .= "</div></div>";
        
        
        echo $html;
       
       
    } catch(Exception $e) {
        echo "<b>Se ha producido el siguiente error:".$e->getMessage().".<b>";
    }

?>
