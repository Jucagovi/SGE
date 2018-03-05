<?php

class Pedido extends Tabla {
	private $conexion;

	function __construct() {
		parent::__construct("com_pedidos");
		$this->conexion = $this->conectar();
	} // fin del constructor de la clase Pedido.

	function obtenerIdPedido($numPedido) {
		$resultado = $this->conexion->query("select id_pedido from " . $this->get_tabla() . " where numero_pedido = " . $numPedido );
		$idPedido = "";

		while ( $r = $resultado->fetch_array() ) {
			$idPedido = $r["id_pedido"];
		}

		return $idPedido;
	} // Fin del método obtenerIdPedido.

	function obtenerPedido($numeroPedido) {
		$rs = $this->conexion->query("select * from " . get_tabla() . " where numero_pedido = " . $numeroPedido );
	} // Fin de la función obtenerPedido.

} // Fin de la clase Pedido.
?>