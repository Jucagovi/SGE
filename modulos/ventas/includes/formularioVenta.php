<?php
include_once '../../../clases/config.php';
include_once '../../../clases/claseHerramientas.php';
include_once '../../../clases/claseTabla.php';
include_once '../clases/claseVenta.php';
$feo = new Tabla("tables");
$conexion = $feo->conectar();
include_once '../clases/claseComercial.php';
$venta = new Venta();
$comercial = new Comercial();

if (isset($_POST['idLinea'])) {
  $idLinea=trim($_POST['idLinea']);
  $producto=$_POST['idProducto'];
  $cantidad=$_POST['nombreCantidad'];
}
?>

<form class="formulario" action=<?php echo "/modulos/ventas/includes/crearVenta.php" ?> method="post">
  <table>
    <tr>
      <td><p>ID: </p></td>
      <td><input type="text" value=<?php echo "'".($venta->ultimaVenta($conexion)+1)."'"; ?> id="idVenta" name="idVenta"></td>
    </tr>
    <tr>
      <td><p>Empresa: </p></td>
      <td><input type="text" id="nombreEmpresa" name="nombreEmpresa"></td>
    </tr>
    <tr>
      <td><p>Cliente: </p></td>
      <td><input type="text" id="nombreCliente" name="nombreCliente"></td>
    </tr>
    <tr>
      <td><p>Domicilio: </p></td>
      <td><input type="text" id="nombreDomicilio" name="nombreDomicilio"></td>
    </tr>
    <tr>
      <td><p>Descripción: </p></td>
      <td><input type="text" id="nombreDescripcion" name="nombreDescripcion"></td>
    </tr>
    <tr>
      <td><p>IVA: </p></td>
      <td>
        <select name="idIVA" id="idIVA">
          <?php $venta->listaIVA($conexion) ?>
        </select>
      </td>
    </tr>
    <tr>
      <td><p>Línea de Venta: </p></td>
      <td><input type="text" id="idLinea" name="idLinea" value=<?php echo "'".$idLinea." - ".$producto." x ".$cantidad."'"; ?> readonly></td>
    </tr>
    <tr>
      <td><p>Comercial: </p></td>
      <td>
        <select name="idComercial" id="idComercial">
          <?php $comercial->listaComerciales($conexion) ?>
        </select>
      </td>
    </tr>
    <tr>
      <td><p>Método: </p></td>
      <td>
        <select name="idMetodo" id="idMetodo">
          <?php $venta->listaMetodos($conexion) ?>
        </select>
      </td>
    </tr>
    <tr>
      <td><p>Estado: </p></td>
      <td>
        <select name="idEstado" id="idEstado">
          <?php $venta->listaEstados($conexion) ?>
        </select>
      </td>
    </tr>
  </table>
  <br>
  <input type="Submit" name="guardar" value="Guardar">
</form>
