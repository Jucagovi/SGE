<?php
include_once '../../../clases/config.php';
include_once '../../../clases/claseHerramientas.php';
include_once '../../../clases/claseTabla.php';
include_once '../clases/claseComercial.php';
$feo = new Tabla("tables");
$conexion = $feo->conectar();
$comercial = new Comercial();

$metodo = "prueba";
if (isset($_POST["metodo"])) { //Esto era para que, al implementar el modificar, enviara los datos del formulario a un php u otro,
  $metodo = "crearComercial.php"; //pasándole una variable "metodo" para identificar dicho php (el de crear o el de modificar)
}                              //Falta implementar la parte de modificar, que sería un else
?>

<form class="formulario" action=<?php echo "/modulos/ventas/includes/".$metodo ?> method="post">
  <table>
    <tr>
      <td><p>ID: </p></td>
      <td><input type="text" value=<?php echo "'".($comercial->ultimoComercial($conexion)+1)."'"; ?> id="idComercial" name="idComercial"></td>
    </tr>
    <tr>
      <td><p>Nombre: </p></td>
      <td><input type="text" id="nombreComercial" name="nombreComercial"></td>
    </tr>
  </table>
  <br>
  <input type="Submit" name="guardar" value="Guardar">
</form>
