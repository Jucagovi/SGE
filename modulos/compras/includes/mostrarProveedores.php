<?php

    include_once '../../../clases/config.php';
    include_once '../../../clases/claseHerramientas.php';
    include_once '../../../clases/claseTabla.php';

    $feo = new Tabla("tables");
    $conexion = $feo->conectar();

    try {

        // Ejecutar la consulta
        $rs = $conexion->query("SELECT nombre,poblacion,provincia FROM com_proveedores");

        $html = "<div id='botonesProveedor'><button id='anyadirProveedor' tipo='boton'>Anadir</button></div><h2>Gestion de Proveedores.</h2><div id='gestionesProveedores'>";
        $html .= "<div id='tablaProveedores' class='tabla'></br>
						    <table id='proveedoresTabla'>
      <thead>
        <tr>
          <th>Nombre de Proveedor</th>
          <th>Localizacion</th>
        </tr>
      <thead>
      <tbody>";
        while ($fila = $rs->fetch_array()) {
            $html .= "<tr id='filaProveedor' proveedorElegido='".$fila["nombre"]."'>
                      <td>".$fila["nombre"]."</td>
                      <td>".$fila["poblacion"].", ".$fila["provincia"]."</td>
                      </tr>";

        }
        $html .= "</tbody></table></div><div id='muestrarioProveedor'></div>";

        $html .="</div>";
        echo $html;


    } catch(Exception $e) {
        echo "<b>Se ha producido el siguiente error:".$e->getMessage().".<b>";
    }

?>
