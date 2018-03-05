<?php

include_once '../../../clases/claseTabla.php';

class Equipo extends Tabla{

    protected $id_equipo;
    protected $nombre;

    function __construct() {
        $id_equipo = 0;
        $nombre = "";
    }

    public function get_id_equipo(){
      return $this->$id_equipo;
    }

    public function get_nombre(){
      return $this->$nombre;
    }

    public function set_id_equipo($x){
      return $this->$id_equipo=$x;
    }

    public function set_nombre($x){
      return $this->$nombre=$x;
    }

    function mostrarEquipos() {
      $conexion = $this->conectar();
      $sql = "select * from equipo";
      $resultado = $conexion->query($sql);
      echo "<table border='1'><tr><th>ID</th><th>Nombre</th><th></th><th></th></tr>";
      while ($fila = $resultado->fetch_array()) {
        echo "<tr>";
        echo "<td>".$fila['id_equipo']."</td>";
        echo "<td>".$fila['nombre']."</td>";
        echo "<td><a href='/modulos/ventas/includes/borrarEquipo.php?p=".$fila['id_equipo']."'><button class='delEquipo'>Borrar</button></a></td>";
        echo "</tr>";
      }
      echo "</table><br/><button class='addEquipo'>Nuevo Equipo</button>";
    }

    function crearEquipo($id,$nombre) {
      $conexion = $this->conectar();
      $sql = "INSERT INTO equipo(id_equipo, nombre) VALUES (".$id.",'".$nombre."')";
      $conexion->query($sql);
    }

    function modificarEquipo($id,$nombre) {
      $conexion = $this->conectar();
      $sql = "";
      $conexion->query($sql);
    }

    function borrarEquipo($id) {
      $conexion = $this->conectar();
      $sql = "DELETE FROM equipo WHERE id_equipo=".$id;
      $conexion->query($sql);
    }

    function ultimoEquipo(){ //Función para sacar el id de un nuevo Equipo, sumándole 1 al último de la base de datos
      $ultimo=0;
      $conexion = $this->conectar();
      $sql = "select id_equipo from equipo";
      $resultado = $conexion->query($sql);
      while ($fila = $resultado->fetch_array()) {
        $ultimo = $fila["id_equipo"];
      }
      return $ultimo;
    }

    function listaEquipos($equipo) { //Método para rellenar los select de los formularios que lo necesiten, sacando todos los Equipos de la base de datos
      $conexion = $this->conectar(); //En este caso, le he añadido más cosas según lo he ido necesitando
      if ($equipo != 0) { //Muestra todos los equipos, y ya
        $sql = "select * from equipo";
      } else { //Muestra solo los que no tiene asignado un punto de venta (para el formulario de creación de un TPV)
        $sql = "select * from equipo,puntooventa where equipo.id_equipo!=puntooventa.id_puntoVenta";
      }
      $resultado = $conexion->query($sql);
      while ($fila = $resultado->fetch_array()) {
        if ($fila['id_equipo'] == $equipo) {
          echo "<option value='".$fila['id_equipo']."' selected>".$fila['nombre']."</option>";
        } else {
          echo "<option value='".$fila['id_equipo']."'>".$fila['nombre']."</option>";
        }
      }
    }
}

?>
