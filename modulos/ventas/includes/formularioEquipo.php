<?php
include_once '../../../clases/config.php';
include_once '../../../clases/claseHerramientas.php';
include_once '../../../clases/claseTabla.php';
include_once '../clases/claseEquipos.php';
$feo = new Tabla("tables");
$conexion = $feo->conectar();
$equipo = new Equipo();

$metodo = "prueba";
if (isset($_POST["metodo"])) { //Esto era para que, al implementar el modificar, enviara los datos del formulario a un php u otro,
  $metodo = "crearEquipo.php"; //pasándole una variable "metodo" para identificar dicho php (el de crear o el de modificar)
}                              //Falta implementar la parte de modificar, que sería un else
?>

<form class="formulario" action=<?php echo "/modulos/ventas/includes/".$metodo ?> method="post">
  <table>
    <tr>
      <td><p>ID: </p></td>
      <td><input type="text" value=<?php echo "'".($equipo->ultimoEquipo($conexion)+1)."'"; ?> id="idEquipo" name="idEquipo"></td>
    </tr>
    <tr>
      <td><p>Nombre: </p></td>
      <td><input type="text" id="nombreEquipo" name="nombreEquipo"></td>
    </tr>
  </table>
  <br>
  <input type="Submit" name="guardar" value="Guardar">
</form>
