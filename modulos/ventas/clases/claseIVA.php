<?php

include_once 'claseVenta.php';

class IVA extends Venta{

    protected $id_tiposIVA;
    protected $porcentaje;

    function __construct() {
        $id_tiposIVA = "";
        $porcentaje = 0;
    }

    public function get_id_tiposIVA(){
      return $this->$id_tiposIVA;
    }

    public function get_porcentaje(){
      return $this->$porcentaje;
    }

    public function set_id_tiposIVA($x){
      return $this->$id_tiposIVA=$x;
    }

    public function set_porcentaje($x){
      return $this->$porcentaje=$x;
    }

    function mostrarIVA() {
      $conexion = $this->conectar();
      $sql = "select * from tiposiva";
      $resultado = $conexion->query($sql);
      echo "<table border='1'><tr><th>Tipo</th><th>Porcentaje</th>";
      while ($fila = $resultado->fetch_array()) {
        echo "<tr>";
        echo "<td>".$fila['id_tipoVenta']."</td>";
        echo "<td>".$fila['porcentaje']."</td>";
        echo "</tr>";
      }
      echo "</table>";
    }
}

?>
