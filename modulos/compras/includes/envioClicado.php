<?php

    include_once '../../../clases/config.php';
    include_once '../../../clases/claseHerramientas.php';
    include_once '../../../clases/claseTabla.php';
    $feo = new Tabla("tables");
    $conexion = $feo->conectar();
      
    try {
        
        // Ejecutar la consulta
        $parametro = $_POST["identificador"];
        
        $rs = $conexion->query("SELECT p.numero_pedido,p.id_proveedor,p.id_linea_producto,f.fase FROM com_pedidos p,com_fases_pedido f where p.id_pedido='".$parametro."' and p.id_fase_pedido=f.id_fase_pedido");
        $fila = $rs->fetch_array();
        
        $rs2 = $conexion->query("SELECT l.id_producto,l.unidades,l.importe,p.nombre FROM com_lineas_producto l,inv_productos p where id_linea_producto='".$fila["id_linea_producto"]."' and l.id_producto=p.id_producto");
        $fila2 = $rs2->fetch_array();
        
        
        $rs4 = $conexion->query("SELECT nombre FROM com_proveedores where id_proveedor='".$fila["id_proveedor"]."'");
        $fila4 = $rs4->fetch_array();
        
        
        $precio = $fila2["nombre"];
        
        $html ="<div id='envioClicado'><h2>Pedido: ".$fila["numero_pedido"]."</h2>";
        $html .= "<div id='pedido".$parametro."'>";
        $html .= "</br>";
        $html .= " <div class='item1'></br><p>Producto pedido: ".$fila2["nombre"]."</p><p>Unidades Pedidas: ".$fila2["unidades"]." unidades.</p>
                    <p>Proveedor: ".$fila4["nombre"]."</p>
                    <p>".$fila["fase"]."</p></br>
                    <button id='cancelarPedidoElegido' idPedido='".$parametro."' tipo='botonInterior'>Cancelar Pedido</button></div>";
        
        $html .= "</div></div>";
        
        
        echo $html;
       
       
    } catch(Exception $e) {
        echo "<b>Se ha producido el siguiente error:".$e->getMessage().".<b>";
    }

?>
