<?php

include_once 'claseEquipos.php';

class Comercial extends Equipo{

    protected $id_comercial;
    protected $nombre;

    function __construct() {
        $id_comercial = "";
        $nombre = "";
    }

    public function get_id_comercial(){
      return $this->$id_comercial;
    }

    public function get_nombre(){
      return $this->$nombre;
    }

    public function set_id_comercial($x){
      return $this->$id_comercial=$x;
    }

    public function set_nombre($x){
      return $this->$nombre=$x;
    }

    function mostrarComerciales() {
      $conexion = $this->conectar();
      $sql = "select * from comerciales";
      $resultado = $conexion->query($sql);
      echo "<table border='1'><tr><th>ID</th><th>Nombre</th><th></th><th></th></tr>";
      while ($fila = $resultado->fetch_array()) {
        echo "<tr>";
        echo "<td>".$fila['id_comercial']."</td>";
        echo "<td>".$fila['nombre']."</td>";
        echo "<td><a href='/modulos/ventas/includes/borrarComercial.php?p=".$fila['id_comercial']."'><button class='delComercial'>Borrar</button></a></td>";
        echo "</tr>";
      }
      echo "</table><br/><button class='addComercial'>Nuevo Comercial</button><br/><button class='addMovimiento'>Comercial a Equipo</button>";
    }

    function crearComercial($id,$nombre) {
      $conexion = $this->conectar();
      $sql = "INSERT INTO comerciales(id_comercial, nombre) VALUES (".$id.",'".$nombre."')";
      $conexion->query($sql);
    }

    function modificarComercial($id,$nombre) {
      $conexion = $this->conectar();
      $sql = "";
      $conexion->query($sql);
    }

    function borrarComercial($id) {
      $conexion = $this->conectar();
      $sql = "DELETE FROM comerciales WHERE id_comercial=".$id;
      $conexion->query($sql);
    }

    function ultimoComercial(){ //Función para sacar el id de un nuevo Comercial, sumándole 1 al último de la base de datos
      $ultimo=0;
      $conexion = $this->conectar();
      $sql = "select id_comercial from comerciales";
      $resultado = $conexion->query($sql);
      while ($fila = $resultado->fetch_array()) {
        $ultimo = $fila["id_comercial"];
      }
      return $ultimo;
    }

    function ultimoMovimiento(){ //Función para sacar el id de un nuevo Movimiento, sumándole 1 al último de la base de datos
      $ultimo=0;
      $conexion = $this->conectar();
      $sql = "select id_movimientoEquipos from movimientoequipos";
      $resultado = $conexion->query($sql);
      while ($fila = $resultado->fetch_array()) {
        $ultimo = $fila["id_movimientoEquipos"];
      }
      return $ultimo;
    }

    function listaComerciales() { //Método para rellenar los select de los formularios que lo necesiten, sacando todos los Comerciales de la base de datos
      $conexion = $this->conectar();
      $sql = "select * from comerciales";
      $resultado = $conexion->query($sql);
      while ($fila = $resultado->fetch_array()) {
        echo "<option value='".$fila['id_comercial']."'>".$fila['nombre']."</option>";
      }
    }

    function crearMovimiento($id,$equipo,$comercial,$fecha) {
      $conexion = $this->conectar();
      $sql = "INSERT INTO movimientoequipos(id_movimientoEquipos,id_equipo,id_comercial,fecha) VALUES (".$id.",'".$equipo."','".$comercial."','".$fecha."')";
      $conexion->query($sql);
    }
}

?>
