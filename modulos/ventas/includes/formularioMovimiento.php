<?php
include_once '../../../clases/config.php';
include_once '../../../clases/claseHerramientas.php';
include_once '../../../clases/claseTabla.php';
include_once '../clases/claseComercial.php';
$feo = new Tabla("tables");
$conexion = $feo->conectar();
include_once '../clases/claseEquipos.php';
$comercial = new Comercial();
$equipo = new Equipo;
?>

<form class="formulario" action=<?php echo "/modulos/ventas/includes/crearMovimiento.php" ?> method="post">
  <table>
    <tr>
      <td><p>ID: </p></td>
      <td><input type="text" value=<?php echo "'".($comercial->ultimoMovimiento($conexion)+1)."'"; ?> id="idMovimiento" name="idMovimiento"></td>
    </tr>
    <tr>
      <td><p>Equipo: </p></td>
      <td>
        <select name="idEquipo" id="idEquipo">
          <?php $equipo->listaEquipos($conexion,0); ?>
        </select>
      </td>
    </tr>
    <tr>
      <td><p>Comercial: </p></td>
      <td>
        <select name="idComercial" id="idComercial">
          <?php $comercial->listaComerciales($conexion); ?>
        </select>
      </td>
    </tr>
  </table>
  <br>
  <input type="Submit" name="guardar" value="Guardar">
</form>
