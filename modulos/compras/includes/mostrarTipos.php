<?php

    include_once '../../../clases/config.php';
    include_once '../../../clases/claseHerramientas.php';
    include_once '../../../clases/claseTabla.php';
    $feo = new Tabla("tables");
    $conexion = $feo->conectar();
      
    try {
        
        //doctor sapena 45, planta 3, derecha R (roberto)
        // Ejecutar la consulta
        $rs = $conexion->query("SELECT id_tipo_producto,tipo,descripcion FROM inv_tipos_producto");
        
        $html = "<h2>Gestion de Tipos de Productos.</h2><div id='gestionesTipos'>";

        $html .= "<div id='tablaTipos' class='tabla'></br>
						    <table id='tiposProducto'>
      <thead>
        <tr>
          <th>Tipo de Producto</th>
          <th>Descripcion</th>
        </tr>
      <thead>
      <tbody>";
        while ($fila = $rs->fetch_array()) {
            $html .= "<tr id='filaTipo' tipoElegido='".$fila["id_tipo_producto"]."'>
                      <td>".$fila["tipo"]."</td>
                      <td>".$fila["descripcion"]."</td>
                      </tr>";
        }
        $html .= "</tbody></table></div><div id='muestrarioTipo'></div>";
        
        $html .="</div>";
        echo $html;
        
    } catch(Exception $e) {
        echo "<b>Se ha producido el siguiente error:".$e->getMessage().".<b>";
    }

?>
