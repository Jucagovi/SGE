<?php
//Estado es para los Candidatos
include_once("..\..\..\clases\claseTabla.php");
class EstadoProceso extends Tabla {
function __construct() {
  parent::__construct("rrhh_estado_proceso");
}
//Obtener todos los estados de procesos existentes
function obtenerEstadosProceso(){
try {
      $array = array();
      $conexion = $this->conectar();
      $rs = $conexion->query("SELECT * FROM rrhh_estado_proceso;");
      while ($fila = $rs->fetch_object()){
        $array[]=$fila;
      }
      } catch(Exception $e) {
      echo "<b>Se ha producido el siguiente error:".$e->getMessage().".<b>";
      }
      return $array;
}
//obtiene el nombre de un estado a partir de su id
function obtenerNombreEstadoProceso($id_estadoproceso){
  try {
        $conexion = $this->conectar();
        $rs = $conexion->query("SELECT * FROM rrhh_estado_proceso WHERE id_estado_proceso=".$id_estadoproceso.";");
        $fila = $rs->fetch_object();
        } catch(Exception $e) {
        echo "<b>Se ha producido el siguiente error:".$e->getMessage().".<b>";
        }
        return $fila->nombre;
}

}
 ?>
