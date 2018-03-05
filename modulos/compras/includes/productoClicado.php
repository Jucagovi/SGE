<?php

    include_once '../../../clases/config.php';
    include_once '../../../clases/claseHerramientas.php';
    include_once '../../../clases/claseTabla.php';
    $feo = new Tabla("tables");
    $conexion = $feo->conectar();
      
    try {
        
        // Ejecutar la consulta
        $parametro = $_POST["identificador"];
        $rs = $conexion->query("SELECT id_producto,nombre,descripcion,imagen,precio FROM inv_productos where id_producto='".$parametro."'");
        
        $fila = $rs->fetch_array();
        $html ="<div id='productoClicado'>";
        $html .= "<div id='".$fila["nombre"]."'><h1>".$fila["nombre"]."</h1>";
        $html .= "</br>";
        $html .= " <div class='item1'></br><img src='".$fila["imagen"]."' height='350' width='350'><p>".$fila["descripcion"]."</p><p>Precio: ".$fila["precio"]." euros.</p></br>
                    <button id='editarProductoElegido' idProducto='".$fila["id_producto"]."' tipo='botonInterior'>Editar</button><button id='borrarProductoElegido' idProducto='".$fila["id_producto"]."' tipo='botonInterior'>Borrar</button></div>";
        
        $html .= "</div></div>";
        
        
        echo $html;
       
       
    } catch(Exception $e) {
        echo "<b>Se ha producido el siguiente error:".$e->getMessage().".<b>";
    }

?>
