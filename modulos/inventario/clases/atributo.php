<?php

class Atributo extends Tabla {
    public function __construct($fea) {
        parent::__construct($fea);
    }
    
	public function crearFormularioAtributo(){
        $html = "<div id='invFormulario'><h3>Añadir Atributo</h3><br/>Nombre<input type='text' id='nombre'/><br/>"
                . 'Descripcion<textarea style="resize:none" rows="4" cols="50" id="descripcion"  placeholder="Inserta descripción aquí..."></textarea><br/>'
                . 'Categoría '.$this -> obtenerCategoriasFormulario() .'<br/>'
                . '<button id="insertar_atributo">Insertar Atributo</button></div>'
                . "";
        $html .= "</div>";
        echo $html;
    }
	
	public function obtenerCategoriasFormulario($cat = 0){
        $salida = "<select id='form_categorias'>";
        $conexion = $this -> conectar();
        $rs = $conexion->query("SELECT * FROM inv_categorias");
        while ($fila = $rs->fetch_array()){
            $salida .= '<option value="'.$fila[0].'" '.($fila[0]==$cat?'selected':'').'>'.$fila[1].'</option>';
        }
        $salida .= "</select>";
        return $salida;
    }
	public function ultimoIdAtributo(){
        $conexion = $this -> conectar();
		$rs = $conexion->query("SELECT MAX(id_atributo) FROM inv_atributos");
		if($fila = $rs->fetch_array()){
			return $fila[0];
		}
        }
}
?>
	
