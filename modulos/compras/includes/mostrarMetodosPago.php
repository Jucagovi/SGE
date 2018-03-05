<?php

    include_once '../../../clases/config.php';
    include_once '../../../clases/claseHerramientas.php';
    include_once '../../../clases/claseTabla.php';
    $feo = new Tabla("tables");
    $conexion = $feo->conectar();
      
    try {
        
        
        //doctor sapena 45, planta 3, derecha R (roberto)
        // Ejecutar la consulta
        $rs = $conexion->query("SELECT id_metodo_pago,nombre,descripcion FROM com_metodos_pago");
        
        $html = "<div id='botonesMetodos'><button id='anyadirMetodo' tipo='boton'>Anadir</button></div><h2>Gestion de Metodos de Pago.</h2><div id='gestionesMetodos'>";

        $html .= "<div id='tablaMetodos' class='tabla' tipo='tabla60'></br>
						    <table id='metodosTabla'>
      <thead>
        <tr>
          <th>Metodo de Pago</th>
          <th>Descripcion</th>
        </tr>
      <thead>
      <tbody>";
        
        
        while ($fila = $rs->fetch_array()) {
            $html .= "<tr id='filaMetodo' metodoElegido='".$fila["id_metodo_pago"]."'>
                      <td>".$fila["nombre"]."</td>
                      <td>".$fila["descripcion"]."</td></tr>"; 
        }
        $html .= "</tbody></table></div><div id='muestrarioMetodo'></div>";
        
        $html .="</div>";
        echo $html;
       
       
    } catch(Exception $e) {
        echo "<b>Se ha producido el siguiente error:".$e->getMessage().".<b>";
    }

?>
