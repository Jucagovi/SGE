<?php
include_once '../../../clases/config.php';
include_once '../../../clases/claseHerramientas.php';
include_once '../clases/claseDepartamento.php';
include_once '../clases/claseEmpleado.php';
$feo = new Departamento();
$fea = new Empleado();
if (isset($_REQUEST["id"])) {
$array = array();
$array = $feo->obtenerInformacionDepartamento($_REQUEST["id"]);
foreach ($array as $value) {
  ?>
<!-- Formulario de edicion de departamentos  -->
<!-- Falta el diseño -->
<!-- Si todo esta relleno correctamente se envia el formulario -->
  <form class="formDepartamento"  method="post">
  <fieldset>
    <legend>Edicion Departamento</legend>

ID:<input type="number" name="id_departamento" value="<?php echo $value->id_departamento; ?>" placeholder="ID" readonly>
  <br>
  Nombre:<input type="text" name="nombre" value="<?php echo $value->nombre; ?>" placeholder="Nombre" >
<br>
  Fecha Creacion:<input type="date" name="fecha_creacion" value="<?php echo $value->fecha_creacion; ?>" >
<br>
  Localizacion:<input type="text" name="localizacion" value="<?php echo $value->localizacion; ?>" placeholder="Localizacion" >
<br>
  Responsable:<select name="responsable">
    <?php
    $arrayd = array();
    $arrayd = $fea->obtenerEmpleadosDepartamento($_REQUEST["id"]);
    foreach ($arrayd as $resp) {
      ?> <option value="<?php echo $resp->id_empleado; ?>" <?php
       if ($resp->id_empleado == $value->responsable) { echo "selected";}
       ?> > <?php echo $resp->nombre; ?> </option> <?php
    }
    ?>
  </select>
<br>
  Descripcion:
  <br><textarea name="descripcion" rows="8" cols="80" placeholder="Descripcion"><?php echo $value->descripcion; ?></textarea>
<br>
  <input type="button" class="botonEnviarEdicionDepartamento" value="Editar"/>
  </fieldset>
  </form>
  <?php
}
} else {
  echo "No recivo informacion";
}
?>
