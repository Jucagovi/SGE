<?php

class Producto extends Tabla {

    public function __construct($fea) {
        parent::__construct($fea);
    }

    public function obtenerProductos(){
        $conexion = $this->conectar();
        $rs = $conexion->query("SELECT * FROM inv_productos");
        $productos = [];
        while ($fila = $rs->fetch_assoc()) {
            array_push($productos, $fila);
        }
        return $productos;
    }
    
    public function obtenerTablaProductos() {
        $conexion = $this->conectar();
        $rs = $conexion->query("SELECT * FROM inv_productos");
        $tabla = '<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">';
        $tabla .= "<table id='inv_tabla'>";
        $tabla .= "<thead><tr><th>id_producto</th><th>nombre</th><th>descripcion</th><th>fecha alta</th><th>fecha baja</th><th>imagen</th>"
                . "<th>tipo</th><th>cod barras</th><th>precio</th><th>coste</th><th>peso</th><th>volumen</th><th>categoría</th><th>Editar</th></tr></thead>";
        $tabla .= "<tbody>";
        while ($fila = $rs->fetch_array()) {
            $tabla .= "<tr><td>" . $fila['id_producto'] . "</td>"
                    . "<td>" . $fila['nombre'] . "</td>"
                    . "<td>" . $fila['descripcion'] . "</td>"
                    . "<td>" . $fila['fecha_alta'] . "</td>"
                    . "<td>" . ($fila['fecha_baja'] == '0000-00-00' ? '&#10006;' : $fila['fecha_baja']) . "</td>"
                    . "<td>" . $fila['imagen'] . "</td>"
                    . "<td>" . $this->getValorTipo($fila['id_tipo_producto']) . "</td>"
                    . "<td>" . $fila['cod_barras'] . "</td>"
                    . "<td>" . $fila['precio'] . "</td>"
                    . "<td>" . $fila['coste'] . "</td>"
                    . "<td>" . $fila['peso'] . "</td>"
                    . "<td>" . $fila['volumen'] . "</td>"
                    . "<td>" . $this->getValorCategoria($fila['id_categoria']) . "</td>"
                    . "<td><a href='#' class='formulario_editar_producto' id='$fila[0]'><i class='material-icons'>mode_edit</i></a></td>"
                    . "</tr>";
        }
        $tabla .= "</tbody>";
        $tabla .= "</table>";
        return $tabla;
    }

    public function getValorCategoria($key) {
        $conexion = $this->conectar();
        $rs = $conexion->query("SELECT nombre FROM inv_categorias WHERE id_categoria = " . $key);
        $value = "";
        if ($fila = $rs->fetch_array()) {
            $value .= $fila[0];
        }
        return $value;
    }

    public function getValorTipo($key) {
        $conexion = $this->conectar();
        $rs = $conexion->query("SELECT tipo FROM inv_tipos_productos WHERE id_tipo_producto = " . $key);
        $value = "";
        if ($fila = $rs->fetch_array()) {
            $value .= $fila[0];
        }
        return $value;
    }

    public function obtenerFormularioProducto($id_producto) {
        $conexion = $this->conectar();
        $rs = $conexion->query("SELECT * FROM inv_productos WHERE id_producto='" . $id_producto . "'");
        $html = '';
        if ($fila = $rs->fetch_array()) {
            $id_pasillo = $this->obtenerIdPasillo($fila['id_producto']);
            if ($id_pasillo != null) {
                $id_seccion = $this->obtenerIdSeccion($id_pasillo);
                $id_almacen = $this->obtenerIdAlmacen($id_seccion);
                $id_inventario = $this->obtenerIdInventario($id_almacen);
            }
            $html .= "<div id='invFormulario'>Nombre<input type='text' id='nombre'value='" . $fila['nombre'] . "'/><br/>"
                    . 'Descripcion<textarea style="resize:none" rows="4" cols="50" id="descripcion"  placeholder="Inserta descripción aquí...">' . $fila['descripcion'] . '</textarea><br/>'
                    . 'Tipo: ' . $this->obtenerTipos($fila['id_tipo_producto']) . '<br/>'
                    . 'Cod Barras<input type="number" id="cod_barras"  value="' . $fila['cod_barras'] . '"/><br/>'
                    . 'Precio<input type="number" id="precio" value="' . $fila['precio'] . '"/><br/>'
                    . 'Coste<input type="number" id="coste" value="' . $fila['coste'] . '"/><br/>'
                    . 'Peso<input type="number" id="peso" value="' . $fila['peso'] . '"/><br/>'
                    . 'Volumen<input type="number" id="volumen" value="' . $fila['volumen'] . '"/><br/>'
                    . 'Categoría <select id="form_categorias">' . $this->obtenerCategoriasFormulario($fila['id_categoria']) . '</select><br/>'
                    . 'Inventario <select id="jcb_inventarios">' . $this->obtenerInventariosFormulario($id_inventario) . '</select><br/>'
                    . 'Almacén <select id="jcb_almacenes">' . ($id_pasillo != null ? $this->obtenerAlmacenesFormulario($id_inventario, $id_almacen) : '<option value="0">Selecciona un inventario</option>') . '</select><br/>'
                    . 'Sección <select id="jcb_secciones">' . ($id_pasillo != null ? $this->obtenerSeccionesFormulario($id_almacen, $id_seccion) : '<option value="0">Selecciona un almacén</option>') . '</select><br/>'
                    . 'Pasillo <select id="jcb_pasillos">' . ($id_pasillo != null ? $this->obtenerPasillosFormulario($id_seccion, $id_pasillo) : '<option value="0">Selecciona una sección</option>') . '</select><br/>'
                    . 'Cantidad<input type="number" id="cantidad" value="'.($id_pasillo != null ? $this->obtenerCantidadProductos($fila['id_producto'], $id_pasillo):0).'"/><br/>'
                    . '<br/>'
                    . '<button id="editar_producto">Editar producto</button></div>';
            return $html;
        } else {
            return false;
        }
    }

    public function obtenerIdPasillo($id) {
        $conexion = $this->conectar();
        $rs = $conexion->query("SELECT id_pasillo FROM inv_propas WHERE id_producto = " . $id);
        if ($fila = $rs->fetch_array()) {
            return $fila[0];
        }
        return null;
    }

    public function obtenerIdSeccion($id) {
        $conexion = $this->conectar();
        $rs = $conexion->query("SELECT id_seccion FROM inv_secpas WHERE id_pasillo = " . $id);
        if ($fila = $rs->fetch_array()) {
            return $fila[0];
        }
        return null;
    }

    public function obtenerIdAlmacen($id) {
        $conexion = $this->conectar();
        $rs = $conexion->query("SELECT id_almacen FROM inv_almsec WHERE id_seccion = " . $id);
        if ($fila = $rs->fetch_array()) {
            return $fila[0];
        }
        return null;
    }

    public function obtenerIdInventario($id) {
        $conexion = $this->conectar();
        $rs = $conexion->query("SELECT id_inventario FROM inv_invalm WHERE id_almacen = " . $id);
        if ($fila = $rs->fetch_array()) {
            return $fila[0];
        }
        return null;
    }
    public function obtenerCantidadProductos($id_prod, $id_pas){
        $conexion = $this->conectar();
        $rs = $conexion->query("SELECT cantidad FROM inv_propas WHERE id_producto = $id_prod AND id_pasillo = $id_pas");
        if ($fila = $rs->fetch_array()) {
            return $fila[0];
        }
        return null;
    }
    public function obtenerPasillo($id_pas){
        $conexion = $this->conectar();
        $rs = $conexion->query("SELECT * FROM inv_pasillos WHERE id_pasillo = $id_pas");
        if ($fila = $rs->fetch_assoc()) {
            return $fila[0];
        }
        return null;
    }
    public function actualizarCantidadesPasillo($pasillo){
        $conexion = $this->conectar();
        $keys = array_keys($tabla);
        $edit = "UPDATE inv_pasillos SET cantPro = '".$pasillo['cantPro']."' WHERE id_pasillo = '" . $pasillo['id_pasillo'] . "'";
        $resultado = mysqli_query($conexion, $edit);
    }
    public function obtenerSeccion($id_sec){
        $conexion = $this->conectar();
        $rs = $conexion->query("SELECT * FROM inv_secciones WHERE id_seccion = $id_sec");
        if ($fila = $rs->fetch_assoc()) {
            return $fila[0];
        }
        return null;
    }
    public function actualizarCantidadesSeccion($seccion){
        $conexion = $this->conectar();
        $keys = array_keys($tabla);
        $edit = "UPDATE inv_secciones SET cantProPas = '".$seccion['cantProPas']."' WHERE id_seccion = '" . $seccion['id_seccion'] . "'";
        $resultado = mysqli_query($conexion, $edit);
    }
    public function obtenerAlmacen($id_alm){
        $conexion = $this->conectar();
        $rs = $conexion->query("SELECT * FROM inv_almacenes WHERE id_almacen = $id_alm");
        if ($fila = $rs->fetch_assoc()) {
            return $fila[0];
        }
        return null;
    }
    public function actualizarCantidadesAlmacen($almacen){
        $conexion = $this->conectar();
        $keys = array_keys($tabla);
        $edit = "UPDATE inv_almacenes SET cantProSec = '".$pasillo['cantPro']."' WHERE id_almacen = '" . $almacen['id_almacen'] . "'";
        $resultado = mysqli_query($conexion, $edit);
    }
    

    public function editarProducto($valores) {
        $conexion = $this->conectar();
        $edit = "UPDATE inv_productos SET ";
        unset($valores['editar']);
        unset($valores['id_pasillo']);
        unset($valores['cantidad']);
        foreach ($valores as $key => $value) {
            $value = mysqli_escape_string($conexion, $value);
            $edit .= $key . "= '" . $value . "', ";
        }
        $edit = substr($edit, 0, -2);
        $edit .= " WHERE id_producto = '" . $valores['id_producto'] . "'";
        try {
            $resultado = mysqli_query($conexion, $edit);
            if (!$resultado) {
                printf("Errormessage: %s\nSQL: %s\n", mysqli_error($conexion), $edit);
            }
            return $resultado;
        } catch (Exception $e) {
            return false;
        }
    }

    function existeRelacionPropas($id_prod, $id_pad){
        $conexion = $this->conectar();
        $sql = "SELECT * FROM inv_propas WHERE id_producto = ".$id_prod." AND id_pasillo = ".$id_pas;
        $resultado = mysqli_query($conexion, $sql);
        if ($fila = $rs->fetch_assoc()) {
            return true;
        }
        return false;
    }
    
    function borrarRelacionPropas($id_prod, $id_pas){
        $conexion = $this->conectar();
        $sql = "DELETE FROM inv_propas WHERE id_producto = ".$id_prod." AND id_pasillo = ".$id_pas;
        $resultado = mysqli_query($conexion, $sql);
        if (!$resultado) {
            printf("Errormessage: %s\nSQL: %s\n", mysqli_error($conexion), $edit);
        }
        return $resultado;
    }
    
    public function crearFormularioProducto() {
        $html = "<div id='invFormulario'>Nombre<input type='text' id='nombre'/><br/>"
                . 'Descripcion<textarea style="resize:none" rows="4" cols="50" id="descripcion"  placeholder="Inserta descripción aquí..."></textarea><br/>'
                . 'Tipo: ' . $this->obtenerTipos() . '<br/>'
                . 'Cod Barras<input type="number" id="cod_barras"/><br/>'
                . 'Precio<input type="number" id="precio"/><br/>'
                . 'Coste<input type="number" id="coste"/><br/>'
                . 'Peso<input type="number" id="peso"/><br/>'
                . 'Volumen<input type="number" id="volumen"/><br/>'
                . 'Categoría <select id="form_categorias">' . $this->obtenerCategoriasFormulario() . '</select><br/>'
                . 'Inventario <select id="jcb_inventarios">' . $this->obtenerInventariosFormulario() . '</select><br/>'
                . 'Almacén <select id="jcb_almacenes"><option value="0">Selecciona un inventario</option></select><br/>'
                . 'Sección <select id="jcb_secciones"><option value="0">Selecciona un almacén</option></select><br/>'
                . 'Pasillo <select id="jcb_pasillos"><option value="0">Selecciona una sección</option></select><br/>'
                . 'Cantidad<input type="number" id="cantidad" value="0"/><br/>'
                . '<br/>'
                . '<button id="insertar_producto">Insertar producto</button></div>'
                . "";
        $html .= "</div>";
        echo $html;
    }

    public function obtenerCategoriasFormulario($cat = 0) {
        $salida = "";
        $conexion = $this->conectar();
        $rs = $conexion->query("SELECT * FROM inv_categorias");
        while ($fila = $rs->fetch_array()) {
            $salida .= '<option value="' . $fila[0] . '" ' . ($fila[0] == $cat ? 'selected' : '') . '>' . $fila[1] . '</option>';
        }
        return $salida;
    }

    public function obtenerInventariosFormulario($cat = 0) {
        $salida = "";
        $conexion = $this->conectar();
        $rs = $conexion->query("SELECT * FROM inv_inventarios");
        $salida .= '<option value="0">Selecciona un inventario</option>';
        while ($fila = $rs->fetch_array()) {
            $salida .= '<option value="' . $fila[0] . '" ' . ($fila[0] == $cat ? 'selected' : '') . '>' . $fila[1] . '</option>';
        }
        return $salida;
    }

    public function obtenerAlmacenesFormulario($id, $cat = 0) {
        $salida = "";
        $conexion = $this->conectar();
        $rs = $conexion->query("SELECT a.* FROM inv_almacenes a, inv_invalm ia WHERE a.id_almacen = ia.id_almacen and ia.id_inventario=" . $id);
        while ($fila = $rs->fetch_array()) {
            $salida .= '<option value="' . $fila[0] . '" ' . ($fila[0] == $cat ? 'selected' : '') . '>' . $fila[1] . '</option>';
        }
        return $salida;
    }

    public function obtenerSeccionesFormulario($id, $cat = 0) {
        $salida = "";
        $conexion = $this->conectar();
        $rs = $conexion->query("SELECT s.* FROM inv_secciones s, inv_almsec al WHERE s.id_seccion = al.id_seccion and al.id_almacen=" . $id);
        while ($fila = $rs->fetch_array()) {
            $salida .= '<option value="' . $fila[0] . '" ' . ($fila[0] == $cat ? 'selected' : '') . '>' . $fila[1] . '</option>';
        }
        return $salida;
    }

    public function obtenerPasillosFormulario($id, $cat = 0) {
        $salida = "";
        $conexion = $this->conectar();
        $rs = $conexion->query("SELECT p.* FROM inv_pasillos p, inv_secpas sp WHERE p.id_pasillo = sp.id_pasillo and sp.id_seccion=" . $id);
        while ($fila = $rs->fetch_array()) {
            $salida .= '<option value="' . $fila[0] . '" ' . ($fila[0] == $cat ? 'selected' : '') . '>' . $fila[1] . '</option>';
        }
        return $salida;
    }

    public function obtenerTipos($id = 0) {
        $salida = "<select id='form_tipos'>";
        $conexion = $this->conectar();
        $rs = $conexion->query("SELECT * FROM inv_tipos_productos");
        while ($fila = $rs->fetch_array()) {
            $salida .= '<option value="' . $fila[0] . '" ' . ($fila[0] == $id ? 'selected' : '') . '>' . $fila[1] . '</option>';
        }
        $salida .= "</select>";
        return $salida;
    }

    function ultimoIdProducto() {
        $conexion = $this->conectar();
        $rs = $conexion->query("SELECT MAX(id_producto) FROM inv_productos");
        if ($fila = $rs->fetch_array()) {
            return $fila[0];
        }
    }

    function extraerFicheroCSV() {
        $conexion = $this -> conectar();
        $query = "SELECT * FROM inv_productos";
        $rs = $conexion -> query($query) or die("database error:" . $conexion -> error());
        $records = array();
        while ($rows = $rs -> fetch_assoc()) {
            $records[] = $rows;
        }
        $csv_file = "productos_" . date('Ymd') . ".csv";
        header("Content-Type: text/csv");
        header("Content-Disposition: attachment; filename='".$csv_file."'");
        
        $fh = fopen('php://output', 'w');
        $is_coloumn = true;
        if (!empty($records)) {
            foreach ($records as $record) {
                if ($is_coloumn) {
                    fputcsv($fh, array_keys($record), ';', ' ');
                    $is_coloumn = false;
                }
                fputcsv($fh, array_values($record), ';', ' ');
            }
            fclose($fh);
        }
    }
    
    

}
