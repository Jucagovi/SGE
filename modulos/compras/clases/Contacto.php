<?php

class Contacto extends Tabla {
	private $conexion;

	function __construct() {
		parent::__construct("com_contactos");
		$this->conexion = $this->conectar();
	} // Fin del constructor de la clase Contacto.

	function obtenerContacto($idContacto) {
		$rs = $this->conexion->query("select * from " . $this->get_tabla() . " where id_contacto = " . $idContacto );
		return $rs;
	} // Fin de la función obtenerContacto();

	function obtenerContactos($idProveedor) {
		$rs = $this->conexion->query("select * from " . $this->get_tabla() . " where id_proveedor = " . $idProveedor );
		return $rs;
	} // Fin de la función obtenerContacto.

	} // Fin de la clase Contacto.

?>