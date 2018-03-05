<?php

class Transferencia extends Tabla {
    public function __construct($fea) {
        parent::__construct($fea);
    }
    
   
    public function obtenerTablaTransferencias(){             
        $conexion = $this->conectar();
        $rs = $conexion->query("SELECT * FROM inv_transferencias");
        $tabla = ''; 
        $tabla .= "<div id='leftDiv' >";
        $tabla .= "<table id='inv_tabla'>";
        $tabla .= "<thead><tr><th>id_transferencia</th><th>nombre</th><th>cantidad</th><th>plazo_entrega</th><th>id_producto</th><th>Pasillo Origen</th><th>Pasillo Destino</th><th>Estado</th></tr></thead>";
        $tabla .= "<tbody>";
        while ($fila = $rs->fetch_array()){
            $tabla .= "<tr><td>".$fila[0]."</td>"
                    . "<td>".$fila[1]."</td>"
                    . "<td>".$fila[2]."</td>"
                    . "<td>".$fila[3]."</td>"
                    . "<td>".obtenerNombreProducto($fila[4])."</td>"
                    . "<td>".obtenerNombrePasillo($fila[5])."</td>"
                    . "<td>".obtenerNombrePasillo($fila[6])."</td>"
                    . "<td>".obtenerNombreEstado($fila[7])."</td>"
                    . "</tr>";
        }
        $tabla .= "</tbody>";
        $tabla .= "</table>";
        $tabla .= "</div>";
        return $tabla;
    }
    
    public function obtenerNombreProducto($idPro){
        $conexion = $this->conectar();
        $rs = $conexion->query("SELECT nombre from inv_productos where id_producto =".$idPro);
        if($fila = $rs->fetch_array()){
			return $fila[0];
		}
        return null;   
    }
    
    public function obtenerNombrePasillo($idPas){
        $conexion = $this->conectar();
        $rs = $conexion->query("SELECT nombre from inv_pasillos where id_pasillo =".$idPas);
        if($fila = $rs->fetch_array()){
			return $fila[0];
		}
        return null;   
    }
    
     public function obtenerNombreEstado($idEst){
        $conexion = $this->conectar();
        $rs = $conexion->query("SELECT nombre from inv_estadotransferencias where id_estado =".$idEst);
        if($fila = $rs->fetch_array()){
			return $fila[0];
		}
        return null;   
    }
    
   
    
}

?>