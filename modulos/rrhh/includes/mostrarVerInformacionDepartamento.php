<?php
include_once '../../../clases/config.php';
include_once '../../../clases/claseHerramientas.php';
include_once '../clases/claseDepartamento.php';
include_once '../clases/claseEmpleado.php';
include_once '../clases/claseProcesoSeleccion.php';
include_once '../clases/claseEtapaProceso.php';
$feo = new Departamento();
$fea = new Empleado();
$feu = new ProcesoSeleccion();
$fei = new EtapaProceso();

if (isset($_REQUEST["id"])) {
  $array = array();
  $array = $feo->obtenerInformacionDepartamento($_REQUEST["id"]);
?>
<h1>Informacion del Departamento</h1>
<?php
  foreach ($array as $value) {
    // Falta el diseño
    echo "ID del Departamento: ";
    echo $value->id_departamento;
    echo " Nombre: ";
    echo $value->nombre;
    echo " Fecha Creacion: ";
    echo $value->fecha_creacion;
    echo " Localizacion: ";
    echo $value->localizacion;
    echo " Responsable: ";
    echo $fea->obtenerNombreEmpleado($value->responsable);
    echo " Descripcion: ";
    echo $value->descripcion;
    echo " ";
  }
echo "<br><br>";
?><h1>Informacion de los Empleados</h1><?php
$arrayemp = array();
$arrayemp = $fea->obtenerEmpleadosDepartamento($_REQUEST["id"]);
foreach ($arrayemp as $value) {
echo "Nombre y Apellidos: ";
  echo $value->nombre;
  echo " ";
  echo $value->apellidos;
  echo " Fecha Nacimiento: ";
  echo $value->fecha_nac;
  echo " Fecha Inicio: ";
  echo $value->fecha_inc;
  echo " Usuario: ";
  echo $value->usuario;
  echo " Curriculum: ";
  echo $value->curriculum;
echo "<br>";
}
echo "<br>";
?><h1>Informacion de los Procesos de Seleccion</h1><?php
$arrayemp = array();
$arrayemp = $feu->obtenerProcesosSeleccionDepartamento($_REQUEST["id"]);
foreach ($arrayemp as $value) {
echo "Puesto: ";
  echo $value->puesto;
  echo " Fecha Creacion: ";
  echo $value->fecha_creacion;
  echo " Numero de Plazas: ";
  echo $value->numero_plazas;
  echo " Descripcion: ";
  echo $value->descripcion;
  echo " Etapa del Proceso: ";
  echo $fei->obtenerNombreEtapaProceso($value->id_etapa_proceso);
echo "<br>";
}

} else {
  echo "No recivo informacion";
}
?>
