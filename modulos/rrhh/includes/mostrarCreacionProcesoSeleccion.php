<?php
include_once '../../../clases/config.php';
include_once '../../../clases/claseHerramientas.php';
include_once '../clases/claseDepartamento.php';
include_once '../clases/claseProcesoSeleccion.php';
include_once '../clases/claseEtapaProceso.php';
$feo = new Departamento();
$fei = new ProcesoSeleccion();
$feu = new EtapaProceso();
 ?>
<form class="formProcesoSeleccion" method="post">
<fieldset>
<legend>Creacion Proceso Seleccion</legend>
<br>ID Proceso:<input type="text" name="id_proceso_seleccion"  value="<?php echo $fei->obtenerNextIdProceso()+1; ?>" placeholder="Id" readonly>
<br>ID Departamento:<select class="" name="id_departamento">
  <?php
  $arraydep = array();
  $arraydep = $feo->obtenerDepartamentos();
foreach ($arraydep as $value) {
   ?>
  <option value="<?php echo $value->id_departamento; ?>"><?php echo $value->nombre; ?></option>
<?php } ?>
</select>
<br>Etapa Proceso:
<select class="" name="id_etapa_proceso">
<?php
$arrayeta =  array();
$arrayeta = $feu->obtenerEtapasProceso();
foreach ($arrayeta as $val) {
?>
  <option value="<?php echo $val->id_etapa_proceso; ?>"><?php echo $val->nombre; ?></option>
<?php }  ?>
</select>

<br>Fecha Creacion:
<input type="text" name="fecha_creacion"  placeholder="AAAA-MM-DD" required>
<br>Puesto:
<input type="text" name="puesto" placeholder="puesto" required>
<br>Numero Plazas:
<input type="text" name="num_plazas"  placeholder="cantidad de plazas" required>
<br>Descripcion:
<input type="text" name="descripcion"  placeholder="descripcion" required>
<br>
<input type="button" class="botonCrearProcesoSeleccion" value="Incluir"/>
</fieldset>
</form>
