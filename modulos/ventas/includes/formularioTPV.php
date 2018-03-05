<?php
include_once '../../../clases/config.php';
include_once '../../../clases/claseHerramientas.php';
include_once '../../../clases/claseTabla.php';
include_once '../clases/claseTPV.php';
$feo = new Tabla("tables");
$conexion = $feo->conectar();
include_once '../clases/claseEquipos.php';
$tpv = new TPV();
$equipo = new Equipo();
$idEquipo = 0;

if (isset($_POST['id'])) {
  $idTPV=trim($_POST['id']);
  $sql = "select * from puntooventa where id_puntoVenta=".$idTPV;
  $resultado = $conexion->query($sql);
  while ($fila = $resultado->fetch_array()) {
    $idEquipo = $fila['id_puntoVenta'];
  }
}

$metodo = "prueba";
if (isset($_POST["metodo"])) {
  if ($_POST["metodo"] == "crear") {
    $metodo = "crearTPV.php";
  } else if ($_POST["metodo"] == "modif") {
    $metodo = "modificarTPV.php";
  }
}
?>

<form class="formulario" action=<?php echo "/modulos/ventas/includes/".$metodo ?> method="post">
  <table>
    <tr>
      <td><p>TPV: </p></td>
      <td><input type="text" value=<?php if (isset($_POST["id"])) {echo $idTPV." readonly";} else {echo $tpv->ultimoTPV($conexion)+1;} ?> id="idTPV" name="idTPV"></td>
    </tr>
    <tr>
      <td><p>Equipo: </p></td>
      <td>
        <select name="idEquipo" id="idEquipo">
          <?php $equipo->listaEquipos($conexion,$idEquipo);false; ?>
        </select>
      </td>
    </tr>
  </table>
  <br>
  <input type="Submit" name="guardar" value="Guardar">
</form>
