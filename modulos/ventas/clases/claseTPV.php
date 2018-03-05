<?php

include_once '../../../clases/claseTabla.php';

class TPV extends Tabla{

    protected $id_puntoVenta;
    protected $equipo;

    function __construct() {
        $id_puntoVenta = 0;
        $equipo = 0;
    }

    public function get_id_puntoVenta(){
      return $this->$id_puntoVenta;
    }

    public function get_equipo(){
      return $this->$equipo;
    }

    public function set_id_puntoVenta($x){
      return $this->$id_puntoVenta=$x;
    }

    public function set_equipo($x){
      return $this->$equipo=$x;
    }

    function mostrarTPV() {
      $conexion = $this->conectar();
      $sql = "select * from puntooventa";
      $resultado = $conexion->query($sql);
      echo "<table border='1'><tr><th>TPV</th><th>Equipo</th><th></th><th></th></tr>";
      while ($fila = $resultado->fetch_array()) {
        echo "<tr>";
        echo "<td>".$fila['id_puntoVenta']."</td>";
        echo "<td>".$fila['equipo']."</td>";
        echo "<td><button class='modTPV' id='".$fila['id_puntoVenta']."'>Modificar</button></td>";
        echo "<td><a href='/modulos/ventas/includes/borrarTPV.php?p=".$fila['id_puntoVenta']."'><button class='delTPV'>Borrar</button></a></td>";
        echo "</tr>";
      }
      echo "</table><br/><button class='addTPV'>Nuevo TPV</button>";
    }

    function crearTPV($tpv,$equipo) {
      $conexion = $this->conectar();
      $sql = "INSERT INTO puntooventa(id_puntoVenta, equipo) VALUES (".$tpv.",".$equipo.")";
      $conexion->query($sql);
    }

    function modificarTPV($tpv,$equipo) {
      $conexion = $this->conectar();
      $sql = "UPDATE puntooventa SET equipo=".$equipo." WHERE id_puntoVenta=".$tpv;
      $conexion->query($sql);
    }

    function borrarTPV($tpv) {
      $conexion = $this->conectar();
      $sql = "DELETE FROM puntooventa WHERE id_puntoVenta=".$tpv;
      $conexion->query($sql);
    }

    function ultimoTPV(){ //Función para sacar el id de un nuevo Punto de venta, sumándole 1 al último de la base de datos
      $ultimo=0;
      $conexion = $this->conectar();
      $sql = "select id_puntoVenta from puntooventa";
      $resultado = $conexion->query($sql);
      while ($fila = $resultado->fetch_array()) {
        $ultimo = $fila["id_puntoVenta"];
      }
      return $ultimo;
    }
}

?>
