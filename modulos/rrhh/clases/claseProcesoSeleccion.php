<?php
include_once("..\..\..\clases\claseTabla.php");
class ProcesoSeleccion extends Tabla {
  function __construct() {
    parent::__construct("rrhh_proceso_seleccion");
  }
//Obtiene todos los Procesos de Seleccion
  function obtenerProcesosSeleccion(){
    try {
        $array = array();
        $conexion = $this->conectar();
        $rs = $conexion->query("SELECT * FROM rrhh_proceso_seleccion;");
        while ($fila = $rs->fetch_object()){
          $array[]=$fila;
        }
        } catch(Exception $e) {
        echo "<b>Se ha producido el siguiente error:".$e->getMessage().".<b>";
        }
        return $array;
  }
//Obtiene los procesos de seleccion de un departamento
  function obtenerProcesosSeleccionDepartamento($id_departamento){
    try {
        $array = array();
        $conexion = $this->conectar();
        $rs = $conexion->query("SELECT * FROM rrhh_proceso_seleccion WHERE id_departamento=".$id_departamento.";");
        while ($fila = $rs->fetch_object()){
          $array[]=$fila;
        }
        } catch(Exception $e) {
        echo "<b>Se ha producido el siguiente error:".$e->getMessage().".<b>";
        }
        return $array;
  }
//Obtiene la informacion de un proceso de seleccion
  function obtenerInformacionProcesoSeleccion($id_procesoseleccion){
    try {
        $array = array();
        $conexion = $this->conectar();
        $rs = $conexion->query("SELECT * FROM rrhh_proceso_seleccion WHERE id_proceso_seleccion=".$id_procesoseleccion.";");
        $fila = $rs->fetch_object();
        $array[]=$fila;
        } catch(Exception $e) {
        echo "<b>Se ha producido el siguiente error:".$e->getMessage().".<b>";
        }
        return $array;
  }
//Obtiene el siguiente ID de proceso_seleccion
  function obtenerNextIdProceso(){
    $conexion = $this->conectar();
    $rs = $conexion->query("SELECT MAX(id_proceso_seleccion) FROM rrhh_proceso_seleccion;");
    if ($fila = $rs->fetch_array()) {
      $dato =  $fila[0];
    }
    return $dato;
  }
//Inserta un nuevo proceso seleccion
  function insertarProcesoSeleccion($form){
    $conexion=$this->conectar();
    echo $form["id_etapa_proceso"];
    $sql ="INSERT INTO `rrhh_proceso_seleccion`(`id_proceso_seleccion`, `id_departamento`, `id_etapa_proceso`,`fecha_creacion`, `puesto`, `numero_plazas`, `descripcion`)
    VALUES (".$form["id_proceso_seleccion"].",".$form["id_departamento"].",".$form["id_etapa_proceso"].",'".$form["fecha_creacion"]."','".$form["puesto"]."',".$form["num_plazas"].",'".$form["descripcion"]."')";
    $resultado = $conexion->query($sql);
  }
}
 ?>
