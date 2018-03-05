<?php

include_once '../../../clases/config.php';
include_once '../../../clases/claseHerramientas.php';
include_once '../../../clases/claseTabla.php';
include_once '../clases/Pedido.php';

$pedido = new Pedido();

$rs = $pedido->obtenerIdPedido($_POST["numero_pedido"]);

while ( $r = $rs->fetch_array() ) {
	echo "Número de Pedido: " . $r["numero_pedido"];
}

?>