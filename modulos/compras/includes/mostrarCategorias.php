<?php

    include_once '../../../clases/config.php';
    include_once '../../../clases/claseHerramientas.php';
    include_once '../../../clases/claseTabla.php';
    $feo = new Tabla("tables");
    $conexion = $feo->conectar();
      
    try {
        
        // Ejecutar la consulta
        $rs = $conexion->query("SELECT id_categoria,nombre,descripcion FROM inv_categorias");
        
        $html = "<h2>Gestion de Categorias.</h2><div id='gestionesCategorias'>";
        

        $html .= "<div id='tablaCategorias' class='tabla'></br>
						    <table id='tiposProducto'>
      <thead>
        <tr>
          <th>Categoria</th>
          <th>Descripcion</th>
        </tr>
      <thead>
      <tbody>";
        while ($fila = $rs->fetch_array()) {
            $html .= "<tr id='filaCategoria' categoriaElegida='".$fila["id_categoria"]."'>
                      <td>".$fila["nombre"]."</td>
                      <td>".$fila["descripcion"]."</td>
                      </tr>";
            
        }
        $html .= "</tbody></table></div><div id='muestrarioCategoria'></div>";
        
        $html .="</div>";
        echo $html;
       
       
    } catch(Exception $e) {
        echo "<b>Se ha producido el siguiente error:".$e->getMessage().".<b>";
    }

?>
