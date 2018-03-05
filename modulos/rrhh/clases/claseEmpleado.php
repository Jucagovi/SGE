<?php
include_once("..\..\..\clases\claseTabla.php");
class Empleado extends Tabla {
  function __construct() {
    parent::__construct("gen_empleados");
  }
//Obtiene todos los empleados existentes
  function obtenerEmpleados(){
    try {
        $array = array();
        $conexion = $this->conectar();
        $rs = $conexion->query("SELECT * FROM gen_empleados;");
        while ($fila = $rs->fetch_object()){
          $array[]=$fila;
        }
        } catch(Exception $e) {
        echo "<b>Se ha producido el siguiente error:".$e->getMessage().".<b>";
        }
        return $array;
  }
//Obtiene todos los empleados de un departamento
  function obtenerEmpleadosDepartamento($id_departamento){
    try {
        $array = array();
        $conexion = $this->conectar();
        $rs = $conexion->query("SELECT * FROM gen_empleados WHERE id_departamento=".$id_departamento.";");
        while ($fila = $rs->fetch_object()){
          $array[]=$fila;
        }
        } catch(Exception $e) {
        echo "<b>Se ha producido el siguiente error:".$e->getMessage().".<b>";
        }
        return $array;
  }
//Obtiene la informacion de un empleado a partir de su id
  function obtenerEmpleado($id_empleado){
    try {
        $conexion = $this->conectar();
        $rs = $conexion->query("SELECT * FROM gen_empleados WHERE id_empleado=".$id_empleado.";");
        $fila = $rs->fetch_object();
        $array = array();
        $array[]=$fila;
        } catch(Exception $e) {
        echo "<b>Se ha producido el siguiente error:".$e->getMessage().".<b>";
        }
        return $array;
  }
//obtiene el nombre de un empleado a partir de su id
  function obtenerNombreEmpleado($id_empleado){
    try {
          $conexion = $this->conectar();
          $rs = $conexion->query("SELECT * FROM gen_empleados WHERE id_empleado=".$id_empleado.";");
          $fila = $rs->fetch_object();
          } catch(Exception $e) {
          echo "<b>Se ha producido el siguiente error:".$e->getMessage().".<b>";
          }
          return $fila->nombre;
  }
  //Cambia el departamento de un usuario e inserta el movimiento en el historicos
  function cambiarDepartamento($form){
    $conexion=$this->conectar();
    $sql ="UPDATE gen_empleados SET id_departamento=".$form["id_departamento"]." WHERE  id_empleado=".$form["id_empleado"].";";
    $resultado = $conexion->query($sql);
    $hoy = date(Y-m-d);
    $sql ="INSERT INTO rrhh_historico (id_departamento, id_empleado, fecha) VALUES ('".$form["id_departamento"]."', '".$form["id_empleado"]."',".$hoy." );";
    $resultado = $conexion->query($sql);
  }
}
?>
