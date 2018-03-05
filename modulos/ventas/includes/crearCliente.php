<?php
include_once '../../../clases/config.php';
include_once '../../../clases/claseHerramientas.php';
include_once '../../../clases/claseTabla.php';
include_once '../clases/clientes.php';
$cliente = new clientes();
?>

<h3>Crear Cliente</h3>
 <br>
 <br>
<form method='post' id='formularioGuardar'>
        Nombre :<br><br>
        <input type='text' name='nombre' value=''><br><br>
        Apellido :<br><br>
        <input type='text' name='apellido' value=''><br><br>
        Codigo/DNI :<br><br>
        <input type='text' name='dni' value=''><br><br>
        Fecha :<br><br>
        <input type='text' name='fecha' value=''><br><br>
        Categorias :<br><br>
        <select name="categoria">
          <?php
          $cliente->Categorias();
          ?>
        </select>
        <br><br>
          Pago Permitido :<br><br>
        <select name="pagoPermitido">
          <?php
          $cliente->PagosPirmitidos();
          ?>
        </select>
        <br>
        <br>
        <input type='button'  id='GuardarCliente' value='Guardar'>
        </form>
