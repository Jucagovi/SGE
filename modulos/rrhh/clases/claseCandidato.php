<?php
include_once("..\..\..\clases\claseTabla.php");
class Candidato extends Tabla {
function __construct() {
  parent::__construct("rrhh_candidato");
}
//Obtiene todos los candidatos que existen
function obtenerCandidatos(){
try {
      $array = array();
      $conexion = $this->conectar();
      $rs = $conexion->query("SELECT * FROM rrhh_candidato;");
      while ($fila = $rs->fetch_object()){
        $array[]=$fila;
      }
      } catch(Exception $e) {
      echo "<b>Se ha producido el siguiente error:".$e->getMessage().".<b>";
      }
      return $array;
}
//Obtiene un candidato de un proceso de seleccion
function obtenerCandidatosProcesoSeleccion($id_candidato , $id_procesoseleccion){
try {
      $array = array();
      $conexion = $this->conectar();
      $rs = $conexion->query("SELECT * FROM rrhh_candidato_proceso_seleccion WHERE id_candidato=".$id_candidato." AND id_proceso_seleccion=".$id_procesoseleccion.";");
      while ($fila = $rs->fetch_object()){
        $array[]=$fila;
      }
      } catch(Exception $e) {
      echo "<b>Se ha producido el siguiente error:".$e->getMessage().".<b>";
      }
      return $array;
}
//Obtiene la informacion de un candidato
function obtenerInformacionCandidato($id_candidato){
try {
      $conexion = $this->conectar();
      $rs = $conexion->query("SELECT * FROM rrhh_candidato WHERE id_candidato=".$id_candidato.";");
      $fila = $rs->fetch_object();
      $array = array();
      $array[]=$fila;
      } catch(Exception $e) {
        echo "<b>Se ha producido el siguiente error:".$e->getMessage().".<b>";
      }
      return $array;
}
//Inserta un candidato en la bd
function insertarCandidato($form){
$conexion=$this->conectar();
$sql ="INSERT INTO `rrhh_candidato` (`id_candidato`, `nombre`, `apellidos`, `fecha_nac`, `telefono`, `foto`, `curriculum`, `nota_interna`, `descripcion`) VALUES
 ('".$form["id_candidato"]."','".$form["nombre"]."','".$form["apellidos"]."','".$form["fecha_nac"]."','".$form["telefono"]."','".$form["foto"]."','".$form["curriculum"]."'
 ,'".$form["nota_interna"]."','".$form["descripcion"]."')";
$resultado = $conexion->query($sql);
}
}
 ?>
