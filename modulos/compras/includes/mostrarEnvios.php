<?php

    include_once '../../../clases/config.php';
    include_once '../../../clases/claseHerramientas.php';
    include_once '../../../clases/claseTabla.php';
    $feo = new Tabla("tables");
    $conexion = $feo->conectar();
      
    try {
        
        
        //doctor sapena 45, planta 3, derecha R (roberto)
        // Ejecutar la consulta
        $rs = $conexion->query("SELECT p.id_pedido,p.id_proveedor,o.nombre,p.numero_pedido, f.fase FROM com_pedidos p,com_proveedores o,com_fases_pedido f where p.id_fase_pedido=f.id_fase_pedido and p.id_proveedor=o.id_proveedor and p.id_fase_pedido='3'");
        $rs2 = $conexion->query("SELECT id_proveedor,nombre FROM com_proveedores where id_proveedor=");
        
        $html = "<h2>Gestion de Envios a Recibir.</h2><div id='gestionesEnvios'>";

        $html .= "<div id='tablaEnvios' class='tabla' tipo='tabla60'></br>
						    <table id='pedidosTabla'>
      <thead>
        <tr>
          <th>Numero de Pedido</th>
          <th>Proveedor</th>
        </tr>
      <thead>
      <tbody>";
        
        
        while ($fila = $rs->fetch_array()) {
            $html .= "<tr id='filaEnvio' envioElegido='".$fila["id_pedido"]."'>
                      <td>".$fila["numero_pedido"]."</td>
                      <td>".$fila["nombre"]."</td></tr>"; 
        }
        $html .= "</tbody></table></div><div id='muestrarioEnvio'></div>";
        
        $html .="</div>";
        echo $html;
       
       
    } catch(Exception $e) {
        echo "<b>Se ha producido el siguiente error:".$e->getMessage().".<b>";
    }

?>
