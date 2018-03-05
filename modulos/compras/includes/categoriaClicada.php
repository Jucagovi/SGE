<?php

    include_once '../../../clases/config.php';
    include_once '../../../clases/claseHerramientas.php';
    include_once '../../../clases/claseTabla.php';
    $feo = new Tabla("tables");
    $conexion = $feo->conectar();
      
    try {
        
        // Ejecutar la consulta
        $parametro = $_POST["identificador"];
        
        $rs = $conexion->query("SELECT id_categoria,nombre,descripcion FROM inv_categorias where id_categoria='".$parametro."'");
        $fila = $rs->fetch_array();
        
        $rs2 = $conexion->query("SELECT id_producto,nombre,id_tipo_producto FROM inv_productos where id_categoria='".$parametro."'");
        
        
        $html ="<div id='tipoClicado'><h2>Categoria: ".$fila["nombre"]."</h2>";
        $html .= "<div id='categoria".$fila["nombre"]."'>";
        $html .= "</br>";
        $html .= " <div class='item1'></br><p>Descripcion: ".$fila["descripcion"]."</p>
                    <p>Productos: <select name='productosPorTipo'>";
                    while ($fila2 = $rs2->fetch_array()) {
                        $html .= "<option value='producto".$fila2["id_producto"]."'>".$fila2["nombre"]."</option>";
                    }
                    
                    $html.="</select> </p></br>
                    <button id='borrarCategoriaElegida' idCategoria='".$parametro."' tipo='botonInterior'>Borrar Categoria</button></div>";
        
        $html .= "</div></div>";
        
        
        echo $html;
       
       
    } catch(Exception $e) {
        echo "<b>Se ha producido el siguiente error:".$e->getMessage().".<b>";
    }

?>
