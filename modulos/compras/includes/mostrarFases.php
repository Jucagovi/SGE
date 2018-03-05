<?php

    include_once '../../../clases/config.php';
    include_once '../../../clases/claseHerramientas.php';
    include_once '../../../clases/claseTabla.php';
    $feo = new Tabla("tables");
    $conexion = $feo->conectar();
      
    try {
        
        //doctor sapena 45, planta 3, derecha R (roberto)
        // Ejecutar la consulta
        $rs = $conexion->query("SELECT id_fase_pedido,fase FROM com_fases_pedido");
        
        $html = "<div id='botonesFase'><button id='anyadirFase' tipo='boton'>Anadir</button></div><h2>Gestion de Fases de Pedido.</h2><div id='gestionesTipos'>";

        $html .= "<div id='tablaTipos' class='tabla'></br>
						    <table id='tiposProducto'>
      <thead>
        <tr>
          <th>Fases de Pedido</th>
        </tr>
      <thead>
      <tbody>";
        while ($fila = $rs->fetch_array()) {
            $html .= "<tr id='filaFase' faseElegida='".$fila["id_fase_pedido"]."'>
                      <td>".$fila["fase"]."</td>
                      </tr>";
        }
        $html .= "</tbody></table></div><div id='muestrarioFase'></div>";
        
        $html .="</div>";
        echo $html;
        
    } catch(Exception $e) {
        echo "<b>Se ha producido el siguiente error:".$e->getMessage().".<b>";
    }

?>
