<?php
include_once '../../../clases/config.php';
include_once '../../../clases/claseHerramientas.php';
include_once '../clases/claseCandidato.php';
include_once '../clases/claseProcesoSeleccion.php';
include_once '../clases/claseDepartamento.php';
include_once '../clases/claseEstadoProceso.php';
$feo = new Candidato();
$fea = new ProcesoSeleccion();
$fee = new Departamento();
$feu = new EstadoProceso();
?>
<form class="formCandidatoProcesoSeleccion" method="post">

  <fieldset>

      <legend>Incluir Candidato en Proceso de Seleccion</legend>

    <!-- Id del candidato en value , el texto sera el nombre -->
<br>ID Candidato:
<select class="id_candidato" name="id_candidato">
  <?php
$arrayc = array();
$arrayc = $feo->obtenerCandidatos();
foreach ($arrayc as $can) { ?>
     <option value="<?php echo $can->id_candidato; ?>"><?php echo $can->nombre." ".$can->apellidos; ?></option>
<?php } ?>
</select>

<br>
ID Proceso Seleccion:
<select class="id_proceso_seleccion" name="id_proceso_seleccion">
  <?php
$arrayp = array();
$arrayp = $fea->obtenerProcesosSeleccion();
foreach ($arrayp as $prc) {
   ?>
     <option value="<?php echo $prc->id_proceso_seleccion; ?>" <?php if ($prc->id_proceso_seleccion==$_REQUEST["id"]) {echo "selected";} ?> ><?php echo $fee->obtenerNombreDepartamento($prc->id_departamento)." ".$prc->puesto; ?></option>
  <?php
}
  ?>
</select>

<br>ID Estado Proceso:
<select class="id_estado_proceso" name="id_estado_proceso">
  <?php
 $arrayep = array();
 $arrayep = $feu->obtenerEstadosProceso();
 foreach ($arrayep as $esp) {?>
      <option value="<?php echo $esp->id_estado_proceso; ?>"><?php echo $esp->nombre; ?></option>
      <?php } ?>
</select>
<br>
Descripcion:
<br><textarea name="descripcion" rows="8" cols="80"></textarea>
<br>
<input type="button" class="botonIncluirCandidatoProcesoSeleccion" value="Incluir"/>
  </fieldset>

</form>
