<?php

class MetodoPago extends Tabla {
	private $conexion;

	function __construct() {
		parent::__construct("com_metodos_pago");
		$this->conexion = $this->conectar();
	} // Fin del constructor de la clase MetodoPago.

} // Fin de la clase MetodoPago.
?>