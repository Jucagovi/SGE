<?php
include_once '../../../clases/config.php';
include_once '../../../clases/claseHerramientas.php';

include_once '../clases/claseCandidato.php';
include_once '../clases/claseEstadoProceso.php';
include_once '../clases/claseProcesoSeleccion.php';
include_once '../clases/claseCandidatoProcesoSeleccion.php';

$fea = new Candidato();
$feo= new EstadoProceso();
$feu = new ProcesoSeleccion();
$fei = new CandidatoProcesoSeleccion();

//Candidato para obtener nombre por id
//EstadoProceso para obtener el nombre por id
//Proceso seleccion para obtener nombre por id
//Candidato proceso seleccion para hacer el update
 ?>
<h1>Mostrar Editar Candidato Estado Proceso</h1>
<form class="editarEstadoProcesoSeleccion" method="post">
<br>ID CPS:
<input type="text" name="id_cps" value="<?php echo $_REQUEST["id"]; ?>" readonly>
<?php
$arraycps = array();
$arraycps = $fei->obtenerInformacionCPS($_REQUEST["id"]);
foreach ($arraycps as $value) {

  $arrayc = array();
  $arrayc = $fea->obtenerInformacionCandidato($value->id_candidato);
  foreach ($arrayc as $c) {
echo " Nombre:";
      echo $c->nombre;
    }
  $arrayps = array();
  $arrayps = $feu->obtenerInformacionProcesoSeleccion($value->id_proceso_seleccion);
  foreach ($arrayps as  $ps) {
    echo " Puesto:";
      echo $ps->puesto;
    }
?>

<br>ID Estado Proceso:
<select class="" name="id_estado_proceso">
<?php
    $arrayep = array();
    $arrayep = $feo->obtenerEstadosProceso();
    foreach ($arrayep as $ep) {
      ?>
<option value="<?php echo $ep->id_estado_proceso; ?>" <?php if($ep->id_estado_proceso==$value->id_estado_proceso) ?> ><?php echo $feo->obtenerNombreEstadoProceso($ep->id_estado_proceso); ?></option>
      <?php } ?>
</select>
<?php } ?>
<br>
<input type="button" class="botonCambiarEstadoProceso" value="Actualizar">
</form>
