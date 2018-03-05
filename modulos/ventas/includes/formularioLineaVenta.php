<?php
include_once '../../../clases/config.php';
include_once '../../../clases/claseHerramientas.php';
include_once '../../../clases/claseTabla.php';
include_once '../clases/claseVenta.php';
$feo = new Tabla("tables");
$conexion = $feo->conectar();
$venta = new Venta();
?>

<form class="formulario" action=<?php echo "/modulos/ventas/includes/formularioVenta.php" ?> method="post">
  <table>
    <tr>
      <td><p>ID: </p></td>
      <td><input type="text" value=<?php echo "'".($venta->ultimaLinea($conexion)+1)."'"; ?> id="idLinea" name="idLinea"></td>
    </tr>
    <tr>
      <td><p>Producto: </p></td>
      <td>
        <select name="idProducto" id="idProducto">
          <?php $venta->listaProductos($conexion) ?>
        </select>
      </td>
    </tr>
    <tr>
      <td><p>Cantidad: </p></td>
      <td><input type="number" id="nombreCantidad" name="nombreCantidad"></td>
    </tr>
  </table>
  <br>
  <button type="button" name="btLinea" class="btLinea">Enviar</button>
</form>
