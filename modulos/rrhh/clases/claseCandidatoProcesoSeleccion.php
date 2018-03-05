<?php
include_once("..\..\..\clases\claseTabla.php");
class CandidatoProcesoSeleccion extends Tabla {
  function __construct() {
    parent::__construct("rrhh_candidato_proceso_seleccion");
  }
//Inserta un candidato en un proceso de seleccion
  function insertarCandidatoProcesoSeleccion($form){
    $conexion=$this->conectar();
    $sql = "INSERT INTO `rrhh_candidato_proceso_seleccion`(`id_candidato`, `id_proceso_seleccion`, `id_estado_proceso`, `descripcion`) VALUES (".$form["id_candidato"].",".$form["id_proceso_seleccion"].",".$form["id_estado_proceso"].",'".$form["descripcion"]."')";
    $resultado = $conexion->query($sql);
}
//Editar el estado de proceso de un usuario (no va)
function editarEstadoProceso($form){
  $conexion=$this->conectar();
  $sql = "UPDATE  `rrhh_candidato_proceso_seleccion`
  SET  `id_estado_proceso`=".$form["id_estado_proceso"]."
  WHERE `id_cps`=".$form["id_cps"].";";
  $resultado = $conexion->query($sql);
}
//Obtiene la linea de informacion de rrhh_candidato_proceso_seleccion a partir del id de un proceso de seleccion
// es el que me sirve para obtener los empleados que hay en un proceso de seleccion
function obtenerInformacionCandidatoProcesoSeleccion($idprocesoseleccion){
  try {
      $array = array();
      $conexion = $this->conectar();
      $rs = $conexion->query("SELECT * FROM rrhh_candidato_proceso_seleccion WHERE id_proceso_seleccion=".$idprocesoseleccion.";");
      while ($fila = $rs->fetch_object()){
        $array[]=$fila;
      }
      } catch(Exception $e) {
      echo "<b>Se ha producido el siguiente error:".$e->getMessage().".<b>";
      }
      return $array;
}
//obtener informacion de una linea cps
function obtenerInformacionCPS($idcps){
  try {
      $array = array();
      $conexion = $this->conectar();
      $rs = $conexion->query("SELECT * FROM rrhh_candidato_proceso_seleccion WHERE id_cps=".$idcps.";");
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
