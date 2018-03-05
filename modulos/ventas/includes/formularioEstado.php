<?php
include_once '../../../clases/config.php';
include_once '../../../clases/claseHerramientas.php';
include_once '../../../clases/claseTabla.php';
include_once '../clases/claseEstado.php';
$feo = new Tabla("tables");
$conexion = $feo->conectar();
$estado = new Estado();

$metodo = "prueba";
if (isset($_POST["metodo"])) { //Esto era para que, al implementar el modificar, enviara los datos del formulario a un php u otro,
  $metodo = "crearEstado.php"; //pasándole una variable "metodo" para identificar dicho php (el de crear o el de modificar)
}                              //Falta implementar la parte de modificar, que sería un else
?>

<form class="formulario" action=<?php echo "/modulos/ventas/includes/".$metodo ?> method="post">
  <table>
    <tr>
      <td><p>ID: </p></td>
      <td><input type="text" value=<?php echo "'".($estado->ultimoEstado($conexion)+1)."'"; ?> id="idEstado" name="idEstado"></td>
    </tr>
    <tr>
      <td><p>Nombre: </p></td>
      <td><input type="text" id="nombreEstado" name="nombreEstado"></td>
    </tr>
    <tr>
      <td><p>Descripción: </p></td>
      <td><textarea id="descripcionEstado" name="descripcionEstado" rows="2" cols="30" maxlength="50" placeholder="Descripción del estado de venta..."></textarea></td>
    </tr>
  </table>
  <br>
  <input type="Submit" name="guardar" value="Guardar">
</form>
