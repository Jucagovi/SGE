<?php
include_once("..\..\..\clases\claseTabla.php");
class Departamento extends Tabla {
function __construct() {
  parent::__construct("rrhh_departamento");
}
//Obtiene todos los departamentos existentes
function obtenerDepartamentos(){
try {
      $array = array();
      $conexion = $this->conectar();
      $rs = $conexion->query("SELECT * FROM rrhh_departamento;");
      while ($fila = $rs->fetch_object()){
        $array[]=$fila;
      }
      } catch(Exception $e) {
      echo "<b>Se ha producido el siguiente error:".$e->getMessage().".<b>";
      }
      return $array;
}
//Obtiene la informacion de un unico departamento
function obtenerInformacionDepartamento($id_departamento){
try {
      $conexion = $this->conectar();
      $rs = $conexion->query("SELECT * FROM rrhh_departamento WHERE id_departamento=".$id_departamento.";");
      $fila = $rs->fetch_object();
      $array = array();
      $array[]=$fila;
      } catch(Exception $e) {
        echo "<b>Se ha producido el siguiente error:".$e->getMessage().".<b>";
      }
      return $array;
}
//obtiene el nombre de un departamento partiendo su id
function obtenerNombreDepartamento($id_departamento){
  try {
        $conexion = $this->conectar();
        $rs = $conexion->query("SELECT * FROM rrhh_departamento WHERE id_departamento=".$id_departamento.";");
        $fila = $rs->fetch_object();
        } catch(Exception $e) {
        echo "<b>Se ha producido el siguiente error:".$e->getMessage().".<b>";
        }
        return $fila->nombre;
}
//actualiza un departamento
function actualizarDepartamento($form){
  $conexion=$this->conectar();
  $sql = "UPDATE `rrhh_departamento`
  SET `nombre`='".$form["nombre"]."',
  `localizacion`='".$form["localizacion"]."',
  `responsable`=".$form["responsable"].",
  `descripcion`='".$form["descripcion"]."'
  WHERE `id_departamento`=".$form["id_departamento"].";";
  $resultado = $conexion->query($sql);
}
}
 ?>
