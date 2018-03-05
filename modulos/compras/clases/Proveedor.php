<?php

class Proveedor extends Tabla {
	private $conexion;

	function __construct() {
				parent::__construct("com_proveedores");
				$this->conexion = $this->conectar();
									} // Fin del constructor de la clase Proveedor.

	function obtenerProveedores() {
		$proveedores = $this->conexion->query("select * from " . $this->get_tabla() );
		return $proveedores;
	} // Fin de la función obtenerProveedores.

	function obtenerProveedor($cif) {
		$resultado = $this->conexion->query("select * from " . $this->get_tabla() . " where cif = '" . $cif . "'");
				return $resultado;
	} // Fin de la función obtenerProveedor.

	function obtenerCifProveedor($nombre) {
		$resultado = $this->conexion->query("select cif from " . $this->get_tabla() . " where nombre = '" . $nombre . "'");
		$cif = "";

		while ( $r = $resultado->fetch_array() ) {
			$cif = $r["cif"];
		}

		return $cif;
	} // Fin de la función obtenerCifProveedor.

	function obtenerIdProveedor($cif) {
		$rs = $this->conexion->query("select id_proveedor from " . $this->get_tabla() . " where cif = '" . $cif . "'");
		$id = "";

		while ( $r = $rs->fetch_array() ) {
			$id = $r["id_proveedor"];
		}

		return $id;
	} // Fin de la función obtenerIdProveedor.

	function obtenerDatosContacto($idProveedor) {
		$rs = $this->conexion->query("select * from com_contactos  where id_proveedor = " . $idProveedor );
		return $rs;
	} // Fin de la función obtenerDatosContacto.

} // Fin de la clase Proveedor.

function obtenerMetodosPago($idProveedor) {
	$rs = $this->conexion->query("select * from com_metodos_proveedor where id_proveedor = " . $idProveedor );
	return $rs;
} // Fin de la función obtenerMetodosPago.

?>
