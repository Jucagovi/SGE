<?php

include_once 'claseVenta.php';

class Estado extends Venta{

    protected $id_estadoVenta;
    protected $nombre;
    protected $descripcion;

    function __construct() {
        $id_estadoVenta = 0;
        $nombre = "";
        $descripcion = "";
    }

    public function get_id_estadoVenta(){
      return $this->$id_estadoVenta;
    }

    public function get_nombre(){
      return $this->$nombre;
    }

    public function get_descripcion(){
      return $this->$descripcion;
    }

    public function set_id_estadoVenta($x){
      return $this->$id_estadoVenta=$x;
    }

    public function set_nombre($x){
      return $this->$nombre=$x;
    }

    public function set_descripcion($x){
      return $this->$descripcion=$x;
    }

    function mostrarEstados() {
      $conexion = $this->conectar();
      $sql = "select * from estadosventas";
      $resultado = $conexion->query($sql);
      echo "<table border='1'><tr><th>ID</th><th>Nombre</th><th>Descripción</th><th></th><th></th></tr>";
      while ($fila = $resultado->fetch_array()) {
        echo "<tr>";
        echo "<td>".$fila['id_estadoVenta']."</td>";
        echo "<td>".$fila['nombre']."</td>";
        echo "<td>".$fila['descripcion']."</td>";
        echo "<td><button class='modEstado'>Modificar</button></td>";
        echo "<td><a href='/modulos/ventas/includes/borrarEstado.php?p=".$fila['id_estadoVenta']."'><button class='delEstado'>Borrar</button></a></td>";
        echo "</tr>";
      }
      echo "</table><br/><button class='addEstado'>Nuevo Estado de Venta</button>";
    }

    function crearEstado($id,$nombre,$descripcion) {
      $conexion = $this->conectar();
      $sql = "INSERT INTO estadosventas(id_estadoVenta, nombre, descripcion) VALUES (".$id.",'".$nombre."','".$descripcion."')";
      $conexion->query($sql);
    }

    function modificarEstado($id,$nombre,$descripcion) {
      $conexion = $this->conectar();
      $sql = "";
      $conexion->query($sql);
    }

    function borrarEstado($id) {
      $conexion = $this->conectar();
      $sql = "DELETE FROM estadosventas WHERE id_estadoVenta=".$id;
      $conexion->query($sql);
    }

    function ultimoEstado(){ //Función para sacar el id de un nuevo Estado de venta, sumándole 1 al último de la base de datos
      $ultimo=0;
      $conexion = $this->conectar();
      $sql = "select id_estadoVenta from estadosventas";
      $resultado = $conexion->query($sql);
      while ($fila = $resultado->fetch_array()) {
        $ultimo = $fila["id_estadoVenta"];
      }
      return $ultimo;
    }
}

?>
