<?php

class Categoria extends Tabla {
    public function __construct($fea) {
        parent::__construct($fea);
    }
    
     public function obtenerTablaCategoria(){             
        $conexion = $this->conectar();
        $rs = $conexion->query("SELECT * FROM inv_categorias");
        $tabla = ''; 
        $tabla .= "<div id='leftDiv' >";
        $tabla .= "<table id='inv_tabla'>";
        $tabla .= "<thead><tr><th>id_categoria</th><th>nombre</th></tr></thead>";
        $tabla .= "<tbody>";
        while ($fila = $rs->fetch_array()){
            $tabla .= "<tr><td>".$fila[0]."</td>"
                    . "<td>".$fila[1]."</td>"
                    . "</tr>";
        }
        $tabla .= "</tbody>";
        $tabla .= "</table>";
        $tabla .= "</div>";
        return $tabla;
    }
    
    public function obtenerFormularioInsertarCategoria(){
        $html = '';
        $html .= "<div id='invFormularioCat'><br/>Nombre: <input type='text' id='nombre'/>  <button type='button' id='insertar_categoria' class='btn btn-primary'>Insertar categoria</button></div></div>"; 
        return $html;
    }
    
    public function insertarCategoria($feo){
        $rs = $feo->insertar($_POST);
        if ($rs){
            echo 'Datos insertados';
        } else {
            echo 'Datos no insertados '.print_r($_POST);
        }
    }
	
	public function listarCategorias($id = 0){
	$html = "<div style='width:100%; clear: both; display: table;'>";
        $html .= "<div id='listCategoria'><h3>Listado de categorias</h3>";
        $html .= $this -> obtenerTablaCategoria();
        $html .= "</div>";
        $html .= "<div id='anyadirCategoria'><h3>Añadir categoria</h3>";
        $html .= $this -> obtenerFormularioInsertarCategoria();
        $html .= "</div>";
	$html .= "</div>";
	$html .= "<div style='width:100%; clear: both; display: table;'>";
	$html .= "<div id='inventario'><br/>";
        $html .= $this -> obtenerCategoriasFormulario();
        $html .= "</div>";
	$html .= "</div>";
        return $html;
	}
	
	public function obtenerCategoriasFormulario($cat = 0){
        $salida = "<div id='inventario' style='text-align: center;'><h3>Listado Atributos por Categoria</h3><select id='form_categorias'>";
        $conexion = $this -> conectar();
        $rs = $conexion->query("SELECT * FROM inv_categorias");
        while ($fila = $rs->fetch_array()){
            $salida .= '<option value="'.$fila[0].'" '.($fila[0]==$cat?'selected':'').'>'.$fila[1].'</option>';
        }
        $salida .= "</select></div>";
        return $salida;
    }
	
	public function obtenerListadoAtributosCategoria($id = 1){
        $conexion = $this->conectar();
        $rs = $conexion->query("SELECT a.* from inv_atributos a, inv_catatr ca WHERE a.id_atributo=ca.id_atributo and ca.id_categoria =".$id);
        $tabla = ''; 
        $tabla .= "<table id='tabla_atributos_categoria'>";
        $tabla .= "<thead><tr><th>id_atributo</th><th>nombre</th><th>descripcion</th></tr></thead>";
        $tabla .= "<tbody>";
        while ($fila = $rs->fetch_array()){
            $tabla .= "<tr><td>".$fila[0]."</td>"
                    . "<td>".$fila[1]."</td>"
		    . "<td>".$fila[2]."</td>"
                    . "</tr>";
        }
        $tabla .= "</tbody>";
        $tabla .= "</table>";
        return $tabla;
	}
        
        //Valores de atributos de categorias de productos
        public function obtenerTablaValores() {
        $conexion = $this->conectar();
        $rs = $conexion->query("SELECT * FROM inv_valores");
        
        $tabla = '';
        $tabla .= "<div id='tablaInv' style='width:100%; clear: both; display: table;'>";
        $tabla .= "<h3>Listado Valores</h3></br>";
        $tabla .= "<table id='inv_tabla'>";
        $tabla .= "<thead><tr><th>id_valor</th><th>valor</th><th>Atributo</th><th>Categoria</th><th>Producto</th></tr></thead>";
        $tabla .= "<tbody>";
        while ($fila = $rs->fetch_array()) {
            $idCat = $this -> obtenerIdCategoriaPorProducto($fila[2]);
            $tabla .= "<tr><td>" . $fila[0] . "</td>"
                    . "<td>" . $fila[1] . "</td>"
                    . "<td>" . $this -> obtenerNombreAtributo($idCat) . "</td>"
                    . "<td>" . $this -> obtenerNombreCategoria($fila[2]) . "</td>"
                    . "<td>" . $this -> obtenerNombreProducto($fila[2]) . "</td>"
                    . "</tr>";
        }
        $tabla .= "</tbody>";
        $tabla .= "</table>";
        $tabla .= "</div>";
        $tabla .= $this->obtenerFormularioInsertarValores();
        return $tabla;
    }

    public function obtenerFormularioInsertarValores() {
        $html = '';
        $html .= "<div id='invFormularioVal'>"
                . "</br><h3>Insertar Valores</h3>"
                . '</br> Producto <select id="cb_productos">'. $this -> obtenerCombosPro() . '</select><br/>'
                . '</br> Atributo <select id="cb_atributos"><option value="0">Selecciona un producto</option></select><br/>'
                . "</br>Valor: <input type='text' id='valor'/>"
                . "</br><button type='button' id='insertar_valor' class='btn btn-primary'>Insertar Valor</button>"
                . "</div>";
        return $html;
    }
    
    public function obtenerDropDownAtributos($id_prod){
        $salida = '';
        $id_cat = $this ->obtenerIdCategoriaPorProducto($id_prod);
        $conexion = $this -> conectar();
        $rs = $conexion->query("SELECT * FROM inv_atributos at, inv_catatr ca WHERE ca.id_atributo = at.id_atributo AND ca.id_categoria = ".$id_cat);
        while ($fila = $rs->fetch_array()){
            $salida .= '<option value="'.$fila[0].'" '.($fila[0]==$cat?'selected':'').'>'.$fila[1].'</option>';
        }
        return $salida;
    }
    
    public function ultimoIdValor(){
        $conexion = $this -> conectar();
		$rs = $conexion->query("SELECT MAX(id_valor) FROM inv_valores");
		if($fila = $rs->fetch_array()){
			return $fila[0];
		}
        }
        
    public function obtenerNombreCategoria($idPro = 0){
        $conexion = $this->conectar();
        $rs = $conexion->query("SELECT c.nombre from inv_categorias c, inv_productos p where c.id_categoria = p.id_categoria and p.id_producto =".$idPro);
        if($fila = $rs->fetch_array()){
			return $fila[0];
		}
        return null;        
    }
    
    public function obtenerNombreProducto($idPro = 0){
        $conexion = $this->conectar();
        $rs = $conexion->query("SELECT nombre from inv_productos where id_producto =".$idPro);
        if($fila = $rs->fetch_array()){
			return $fila[0];
		}
        return null;        
    }
    
    public function obtenerNombreAtributo($idCat = 0){
        $conexion = $this->conectar();
        $rs = $conexion->query("SELECT nombre FROM inv_atributos a, inv_catatr ca where a.id_atributo = ca.id_atributo AND ca.id_categoria=".$idCat);
        if($fila = $rs->fetch_array()){
			return $fila[0];
		}
               
        return null;        
    }
    
    public function obtenerIdCategoriaPorProducto($idPro = 0){
        $conexion = $this->conectar();
        $rs = $conexion->query("SELECT id_categoria from inv_productos where id_producto=".$idPro);
        if($fila =  $rs->fetch_array()){
			return $fila[0];
		}
        return null;        
    }
    
    public function obtenerCombosPro($cat = 0){
        $salida = "";
        $conexion = $this -> conectar();
        $rs = $conexion->query("SELECT * FROM inv_productos");
        $salida .= '<option value="0">Selecciona un producto</option>';
        while ($fila = $rs->fetch_array()){
            $salida .= '<option value="'.$fila[0].'" '.($fila[0]==$cat?'selected':'').'>'.$fila[1].'</option>';
        }
        return $salida;
    }
}
?>