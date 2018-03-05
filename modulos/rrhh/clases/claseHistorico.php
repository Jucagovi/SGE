<?php
include_once("..\..\..\clases\claseTabla.php");
class Historico extends Tabla {

function __construct() {
  parent::__construct("rrhh_historiaco");
}

function obtenerHistorico(){
  try {
      $array = array();
      $conexion = $this->conectar();
      $rs = $conexion->query("SELECT * FROM rrhh_historico;");
      while ($fila = $rs->fetch_object()){
        $array[]=$fila;
      }
      } catch(Exception $e) {
      echo "<b>Se ha producido el siguiente error:".$e->getMessage().".<b>";
      }
      return $array;
}

function obtenerHistoricoEntreFechas($fechaInicio, $fechaFinal){
  try {
      $array = array();
      $conexion = $this->conectar();
      $rs = $conexion->query("SELECT * FROM rrhh_historico WHERE fecha BETWEEN '".$fechaInicio."' AND '".$fechaFinal."';");
      while ($fila = $rs->fetch_object()){
        $array[]=$fila;
      }
      } catch(Exception $e) {
      echo "<b>Se ha producido el siguiente error:".$e->getMessage().".<b>";
      }
      return $array;
}

}
 ?>
