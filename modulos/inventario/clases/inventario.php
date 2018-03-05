<?php

class Inventario extends Tabla {

    public function __construct($fea) {
        parent::__construct($fea);
    }

    public function obtenerTablaInventario() {
        $conexion = $this->conectar();
        $rs = $conexion->query("SELECT * FROM inv_inventarios");
        $tabla = '';
        $tabla .= "<div id='tablaInv' style='width:100%; clear: both; display: table;'>";
        $tabla .= "<h3>Listado Inventario</h3></br>";
        $tabla .= "<table id='inv_tabla'>";
        $tabla .= "<thead><tr><th>id_inventario</th><th>nombre</th></tr></thead>";
        $tabla .= "<tbody>";
        while ($fila = $rs->fetch_array()) {
            $tabla .= "<tr><td>" . $fila[0] . "</td>"
                    . "<td>" . $fila[1] . "</td>"
                    . "</tr>";
        }
        $tabla .= "</tbody>";
        $tabla .= "</table>";
        $tabla .= "</div>";
        $tabla .= $this->obtenerFormularioInsertarInventario();
        $tabla .= "</br><h3>Listado de almacenes por Inventario</h3>";
        $tabla .= 'Inventario ' . $this->obtenerInventariosFormulario() . '<br/>';
        $tabla .= "</div>";
        $tabla .= "<div id='tablaAlmInv'></div>";
        return $tabla;
    }

    public function obtenerTablaAlmacenesPorInventario($id = 0) {
        $conexion = $this->conectar();
        $rs = $conexion->query("SELECT a.* FROM inv_almacenes a, inv_invalm ia WHERE a.id_almacen = ia.id_almacen and ia.id_inventario=" . $id);
        $tabla = '';
        $tabla .= "<div id='tablaAlmInv' >";
        $tabla .= "<table id='inv_tabla'>";
        $tabla .= "<thead><tr><td style='background-color: #6bff71; text-align: center' colspan='3'>Almacen</td></tr><tr><th>id_almacen</th><th>nombre</th><th>Cantidad Producto</th></tr></thead>";
        $tabla .= "<tbody>";
        while ($fila = $rs->fetch_array()) {
            $tabla .= "<tr><td>" . $fila[0] . "</td>"
                    . "<td>" . $fila[1] . "</td>"
                    . "<td>" . $fila[2] . "</td>"
                    . "</tr>"
                    . "<tr><td style='background-color: #6ad5ff; text-align: center' colspan='2'>Secciones</td></tr>"
                    . "<tr style='background-color: #bafffd;'><td>id_seccion</td><td>nombre</td></tr>"
                    . $this->obtenerTablaSeccionesPorAlmacen($fila[0]);
        }
        $tabla .= "</tbody>";
        $tabla .= "</table>";
        $tabla .= "</div>";
        return $tabla;
    }

    public function obtenerTablaSeccionesPorAlmacen($id = 0) {
        $conexion = $this->conectar();
        $rs = $conexion->query("SELECT s.* FROM inv_secciones s, inv_almsec als WHERE s.id_seccion = als.id_seccion and als.id_almacen=" . $id);
        $tabla = '';
        while ($fila = $rs->fetch_array()) {
            $tabla .= "<tr><td>" . $fila[0] . "</td>"
                    . "<td>" . $fila[1] . "</td>"
                    . "</tr>"
                    . "<tr><td style='background-color: #8569ff; text-align: center' colspan='2'>Pasillos</td></tr>"
                    . "<tr style='background-color: #cebaff;'><td>id_pasillo</td><td>nombre</td></tr>"
                    . $this->obtenerTablaPasillosPorSeccion($fila[0])
                    . "<tr><td colspan='2' style='background-color: #eaeaea';></td></tr>";
        }
        return $tabla;
    }

    public function obtenerTablaPasillosPorSeccion($id = 0) {
        $conexion = $this->conectar();
        $rs = $conexion->query("SELECT p.* FROM inv_pasillos p, inv_secpas sp WHERE p.id_pasillo = sp.id_pasillo and sp.id_seccion=" . $id);
        $tabla = '';
        while ($fila = $rs->fetch_array()) {
            $tabla .= "<tr><td>" . $fila[0] . "</td>"
                    . "<td>" . $fila[1] . "</td>"
                    . "</tr>";
        }
        return $tabla;
    }

    public function obtenerFormularioInsertarInventario() {
        $html = '';
        $html .= "<div id='invFormularioInv'><br/>Nombre: <input type='text' id='nombre'/><button type='button' id='insertar_inventario' class='btn btn-primary'>Insertar Inventario</button></div>";
        return $html;
    }

    public function obtenerInventariosFormulario($cat = 0) {
        $salida = "<select id='jcbInvAlm'>";
        $conexion = $this->conectar();
        $rs = $conexion->query("SELECT * FROM inv_inventarios");
        while ($fila = $rs->fetch_array()) {
            $salida .= '<option value="' . $fila[0] . '" ' . ($fila[0] == $cat ? 'selected' : '') . '>' . $fila[1] . '</option>';
        }
        $salida .= "</select>";
        return $salida;
    }

    public function obtenerTablaAlmacenes() {
        $conexion = $this->conectar();
        $rs = $conexion->query("SELECT * FROM inv_almacenes");
        $tabla = '';
        $tabla .= "<div id='tablaInv' style='width:100%; clear: both; display: table;'>";
        $tabla .= "<h3>Listado Almacenes</h3></br>";
        $tabla .= "<table id='inv_tabla'>";
        $tabla .= "<thead><tr><th>id_almacen</th><th>nombre</th><th>Inventario</th></tr></thead>";
        $tabla .= "<tbody>";
        while ($fila = $rs->fetch_array()) {
            $tabla .= "<tr><td>" . $fila[0] . "</td>"
                    . "<td>" . $fila[1] . "</td>"
                    . "<td>" . $this -> obtenerInventarioAlmacen($fila[0]) . "</td>"
                    . "</tr>";
        }
        $tabla .= "</tbody>";
        $tabla .= "</table>";
        $tabla .= "</div>";
        $tabla .= $this->obtenerFormularioInsertarAlmacen();
        return $tabla;
    }
    
    public function obtenerFormularioInsertarAlmacen() {
        $html = '';
        $html .= "<div id='invFormularioAlm'>"
                . "</br><h3>Insertar Almacen</h3>"
                . "</br>Nombre: <input type='text' id='nombre'/>"
                . "</br>Inventario al que pertenece:" .$this->obtenerInventariosFormulario()
                . "</br><button type='button' id='insertar_almacen' class='btn btn-primary'>Insertar Almacen</button>"
                . "</div>";
        return $html;
    }
    
    public function ultimoIdAlmacen(){
        $conexion = $this -> conectar();
		$rs = $conexion->query("SELECT MAX(id_almacen) FROM inv_almacenes");
		if($fila = $rs->fetch_array()){
			return $fila[0];
		}
        }
        
    public function obtenerInventarioAlmacen($idAlm = 0){
        $conexion = $this->conectar();
        $rs = $conexion->query("SELECT nombre FROM inv_inventarios iv, inv_invalm ia WHERE iv.id_inventario = ia.id_inventario AND ia.id_almacen =".$idAlm);
        if($fila = $rs->fetch_array()){
			return $fila[0];
		}
        return null;        
    }
    
    //secciones
    
    public function obtenerTablaSecciones() {
        $conexion = $this->conectar();
        $rs = $conexion->query("SELECT * FROM inv_secciones");
        $tabla = '';
        $tabla .= "<div id='tablaInv' style='width:100%; clear: both; display: table;'>";
        $tabla .= "<h3>Listado Secciones</h3></br>";
        $tabla .= "<table id='inv_tabla'>";
        $tabla .= "<thead><tr><th>id_seccion</th><th>nombre</th><th>Almacen</th></tr></thead>";
        $tabla .= "<tbody>";
        while ($fila = $rs->fetch_array()) {
            $tabla .= "<tr><td>" . $fila[0] . "</td>"
                    . "<td>" . $fila[1] . "</td>"
                    . "<td>" . $this -> obtenerNombreAlmacen($fila[0]) . "</td>"
                    . "</tr>";
        }
        $tabla .= "</tbody>";
        $tabla .= "</table>";
        $tabla .= "</div>";
        $tabla .= $this->obtenerFormularioInsertarSeccion();
        return $tabla;
    }

    public function obtenerFormularioInsertarSeccion() {
        $html = '';
        $html .= "<div id='invFormularioSec'>"
                . "</br><h3>Insertar Sección</h3>"
                . "</br>Nombre: <input type='text' id='nombre'/>"
                . '</br> Inventario <select id="jcb_inventarios">'. $this -> obtenerCombosInv() . '</select><br/>'
                . 'Almacén <select id="jcb_almacenes"><option value="0">Selecciona un almacen</option></select><br/>'
                . "</br><button type='button' id='insertar_seccion' class='btn btn-primary'>Insertar Sección</button>"
                . "</div>";
        return $html;
    }
    
    public function ultimoIdSeccion(){
        $conexion = $this -> conectar();
		$rs = $conexion->query("SELECT MAX(id_seccion) FROM inv_secciones");
		if($fila = $rs->fetch_array()){
			return $fila[0];
		}
        }
        
    public function obtenerNombreAlmacen($idSec = 0){
        $conexion = $this->conectar();
        $rs = $conexion->query("SELECT nombre FROM inv_almacenes al, inv_almsec als WHERE al.id_almacen = als.id_almacen AND als.id_seccion =".$idSec);
        if($fila = $rs->fetch_array()){
			return $fila[0];
		}
        return null;        
    }
    
    public function obtenerCombosInv($cat = 0){
        $salida = "";
        $conexion = $this -> conectar();
        $rs = $conexion->query("SELECT * FROM inv_inventarios");
        $salida .= '<option value="0">Selecciona un inventario</option>';
        while ($fila = $rs->fetch_array()){
            $salida .= '<option value="'.$fila[0].'" '.($fila[0]==$cat?'selected':'').'>'.$fila[1].'</option>';
        }
        return $salida;
    }
    
   //pasillos
    
    public function obtenerTablaPasillos() {
        $conexion = $this->conectar();
        $rs = $conexion->query("SELECT * FROM inv_pasillos");
        $tabla = '';
        $tabla .= "<div id='tablaInv' style='width:100%; clear: both; display: table;'>";
        $tabla .= "<h3>Listado Pasillos</h3></br>";
        $tabla .= "<table id='inv_tabla'>";
        $tabla .= "<thead><tr><th>id_pasillo</th><th>nombre</th><th>sección</th></tr></thead>";
        $tabla .= "<tbody>";
        while ($fila = $rs->fetch_array()) {
            $tabla .= "<tr><td>" . $fila[0] . "</td>"
                    . "<td>" . $fila[1] . "</td>"
                    . "<td>" . $this -> obtenerNombreSeccion($fila[0]) . "</td>"
                    . "</tr>";
        }
        $tabla .= "</tbody>";
        $tabla .= "</table>";
        $tabla .= "</div>";
        $tabla .= $this->obtenerFormularioInsertarPasillo();
        return $tabla;
    }

    public function obtenerFormularioInsertarPasillo() {
        $html = '';
        $html .= "<div id='invFormularioPas'>"
                . "</br><h3>Insertar Pasillo</h3>"
                . "</br>Nombre: <input type='text' id='nombre'/>"
                . '</br> Inventario <select id="jcb_inventarios">'. $this -> obtenerCombosInv() . '</select><br/>'
                . 'Almacén <select id="jcb_almacenes"><option value="0">Selecciona un inventario</option></select><br/>'
                . 'Sección <select id="jcb_secciones"><option value="0">Selecciona un almacén</option></select><br/>'
                . "</br><button type='button' id='insertar_pasillo' class='btn btn-primary'>Insertar Pasillo</button>"
                . "</div>";
        return $html;
    }
    
    public function ultimoIdPasillo(){
        $conexion = $this -> conectar();
		$rs = $conexion->query("SELECT MAX(id_pasillo) FROM inv_pasillos");
		if($fila = $rs->fetch_array()){
			return $fila[0];
		}
        }
        
    public function obtenerNombreSeccion($idPas = 0){
        $conexion = $this->conectar();
        $rs = $conexion->query("SELECT nombre FROM inv_secciones s, inv_secpas sp WHERE s.id_seccion = sp.id_seccion AND sp.id_pasillo =".$idPas);
        if($fila = $rs->fetch_array()){
			return $fila[0];
		}
        return null;        
    }
    

}
