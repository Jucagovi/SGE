<?php
include_once '../../../clases/config.php';
include_once '../../../clases/claseHerramientas.php';
include_once '../clases/claseEmpleado.php';
include_once '../clases/claseDepartamento.php';
$fea = new Empleado();
$dept =new Departamento();
$array = array();
$array = $fea->obtenerEmpleados();
foreach ($array as $value) {
?>
<div class="fichaEmpleado">
<span class="departamento"><?php echo $dept->obtenerNombreDepartamento($value->id_departamento);?></span>
<span><img class="fotoEmpleado" src="'.$value->$foto.'" alt=""></span>
<p class="textoFicha">
<span class="nombreEmpleado"><?php echo $value->nombre; ?></span>
<span class="dniEmpleado"><?php echo $value->nif; ?></span>
</p>
<button class='botonCambiarDepartamentoEmpleado' id="<?php echo $value->id_empleado; ?>" name='BotonEditar' value="<?php echo $value->id_empleado; ?>">Editar</button>
</div>
<?php
}
 ?>
