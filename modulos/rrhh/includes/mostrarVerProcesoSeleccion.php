<?php
include_once '../../../clases/config.php';
include_once '../../../clases/claseHerramientas.php';
include_once '../clases/claseProcesoSeleccion.php';
include_once '../clases/claseCandidatoProcesoSeleccion.php';
include_once '../clases/claseDepartamento.php';
include_once '../clases/claseEtapaProceso.php';
include_once '../clases/claseEstadoProceso.php';
include_once '../clases/claseCandidato.php';
$feo = new ProcesoSeleccion();
$fea = new Departamento();
$fee = new EtapaProceso();
$fei = new EstadoProceso();
$feu = new Candidato();
$fae = new CandidatoProcesoSeleccion();
if (isset($_REQUEST["id"])) {
  $array = array();
  $array = $feo->obtenerInformacionProcesoSeleccion($_REQUEST["id"]);
?>
<h1>Ver proceso seleccion</h1>
<?php
  foreach ($array as $value) {
    echo "ID Proceso:";
    echo $value->id_proceso_seleccion;
    echo " Nombre Departamento:";
    echo $fea->obtenerNombreDepartamento($value->id_departamento);
    echo " Etapa Proceso:";
    echo $fee->obtenerNombreEtapaProceso($value->id_etapa_proceso);
    echo " Fecha Creacion:";
    echo $value->fecha_creacion;
    echo " Puesto:";
    echo $value->puesto;
    echo " Numero de Plazas:";
    echo $value->numero_plazas;
    echo " Descripcion:";
    echo $value->descripcion;
  }
?>
<br><br>
<h1>Informacion de los candidatos</h1>
<?php
  $arrayps = array();
  $arremp= array();
$arrayps = $fae->obtenerInformacionCandidatoProcesoSeleccion($_REQUEST["id"]);
foreach ($arrayps as  $value) {
$arremp= $feu->obtenerInformacionCandidato($value->id_candidato);
foreach ($arremp as  $valuee) {
  echo " Nombre y Apellidos:";
  echo $valuee->nombre;
  echo " ";
  echo $valuee->apellidos;
  echo " Nota Interna:";
  echo $valuee->nota_interna;
  echo " Estado Proceso:";
  echo $fei->obtenerNombreEstadoProceso($value->id_estado_proceso);
  echo "<br>";
}
}
} else {
  echo "No recivo informacion";
}
?>
