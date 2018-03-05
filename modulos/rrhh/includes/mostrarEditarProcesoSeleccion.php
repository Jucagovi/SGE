
<?php
include_once '../../../clases/config.php';
include_once '../../../clases/claseHerramientas.php';
include_once '../clases/claseCandidato.php';
include_once '../clases/claseCandidatoProcesoSeleccion.php';
include_once '../clases/claseEstadoProceso.php';
$feo = new CandidatoProcesoSeleccion();
$feu = new Candidato();
$fei = new EstadoProceso();
?>
<h1>Editar Estado de Candidatos en el Proceso de Seleccion</h1>
<?php
$arraycps = array();
$arraycps = $feo->obtenerInformacionCandidatoProcesoSeleccion($_REQUEST["id"]);
foreach ($arraycps as  $valuecps) {
$arrayc = array();
$arrayc = $feu->obtenerInformacionCandidato($valuecps->id_candidato);
foreach ($arrayc as $valuec) {
echo " Nombre:";
echo $valuec->nombre;
echo " ";
echo $valuec->apellidos;
echo " Estado Proceso:";
echo $fei->obtenerNombreEstadoProceso($valuecps->id_estado_proceso);
echo "  ";
?>
<button type="button" name="id_cps" class="botonEditarEstadoProceso" value="<?php echo $valuecps->id_cps; ?>">Editar</button>
<br><br>
<?php }
} ?>
