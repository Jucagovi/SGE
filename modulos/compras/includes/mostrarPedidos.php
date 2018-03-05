<?php

    include_once '../../../clases/config.php';
    include_once '../../../clases/claseHerramientas.php';
    include_once '../../../clases/claseTabla.php';
    $feo = new Tabla("tables");
    $conexion = $feo->conectar();
      
    try {
        
        
        //doctor sapena 45, planta 3, derecha R (roberto)
        // Ejecutar la consulta
        $rs = $conexion->query("SELECT p.id_pedido,p.numero_pedido, f.fase FROM com_pedidos p,com_fases_pedido f where p.id_fase_pedido=f.id_fase_pedido");
        $rs2 = $conexion->query("SELECT fase FROM com_fases_pedido");
        
        $html = "<div id='botonesPedido'><button id='anyadirPedido' tipo='boton'>Anadir</button></div><h2>Gestion de Pedidos.</h2><div id='gestionesPedidos'>";

        $html .= "<div id='tablaPedidos' class='tabla' tipo='tabla60'></br>
						    <table id='pedidosTabla'>
      <thead>
        <tr>
          <th>Numero de Pedido</th>
          <th>Fase del Pedido</th>
        </tr>
      <thead>
      <tbody>";
        
        
        while ($fila = $rs->fetch_array()) {
            $html .= "<tr id='filaPedido' pedidoElegido='".$fila["id_pedido"]."'>
                      <td>".$fila["numero_pedido"]."</td>
                      <td>".$fila["fase"]."</td></tr>"; 
        }
        $html .= "</tbody></table></div><div id='muestrarioPedido'></div>";
        
        $html .="</div>";
        echo $html;
       
       
    } catch(Exception $e) {
        echo "<b>Se ha producido el siguiente error:".$e->getMessage().".<b>";
    }

?>
