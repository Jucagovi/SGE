<?php
include_once '../../../clases/config.php';
include_once '../../../clases/claseHerramientas.php';
include_once '../clases/claseEmpleado.php';
include_once '../clases/claseDepartamento.php';

$empleado = new Empleado();
$departamento =new Departamento();
if (isset($_REQUEST["id"])) {
$array = array();
$array = $empleado->obtenerEmpleado($_REQUEST["id"]);
foreach ($array as $value) {
?>
<form class="formDepartamentoEmpleado"  method="post">
  <fieldset>
    <legend>Cambio de departamento</legend>
<p> Nombre: <?php echo $value->nombre; ?> </p>
<p> DNI/NIF: <?php echo $value->nif; ?> </p>
<select class="id_departamento" name="id_departamento">
  <?php
$arrayD = $departamento->obtenerDepartamentos();
foreach ($arrayD as $dep) {
   ?>
     <option value="<?php echo $dep->id_departamento; ?>" <?php if ($dep->id_departamento==$value->id_departamento) {echo "selected";} ?> ><?php echo $departamento->obtenerNombreDepartamento($dep->id_departamento); ?></option>
  <?php
}
  ?>
</select>
<input type="button" class="botonEditarDepartamentoEmpleado" value="Realizar cambio"/>
<input type="hidden" name="id_empleado" value="<?php echo $value->id_empleado; ?>"/>
  </fieldset>
</form>
<?php
}
} else {
  echo "No recivo informacion";
}
 ?>
