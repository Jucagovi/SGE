<?php
//Etapa es para los Procesos de seleccion
include_once("..\..\..\clases\claseTabla.php");
class EtapaProceso extends Tabla {
function __construct() {
  parent::__construct("rrhh_etapa_proceso");
}
//Obtiene todas las etapas de un proceso existentes
function obtenerEtapasProceso(){
try {
      $array = array();
      $conexion = $this->conectar();
      $rs = $conexion->query("SELECT * FROM rrhh_etapa_proceso;");
      while ($fila = $rs->fetch_object()){
        $array[]=$fila;
      }
      } catch(Exception $e) {
      echo "<b>Se ha producido el siguiente error:".$e->getMessage().".<b>";
      }
      return $array;
}
///obtiene el nombre de una etapa a partir de su id
function obtenerNombreEtapaProceso($id_etapaproceso){
  try {
        $conexion = $this->conectar();
        $rs = $conexion->query("SELECT * FROM rrhh_etapa_proceso WHERE id_etapa_proceso=".$id_etapaproceso.";");
        $fila = $rs->fetch_object();
        } catch(Exception $e) {
        echo "<b>Se ha producido el siguiente error:".$e->getMessage().".<b>";
        }
        return $fila->nombre;
}

}
 ?>
