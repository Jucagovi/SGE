<?php
include_once '../../../clases/config.php';
include_once '../../../clases/claseHerramientas.php';
include_once '../clases/claseHistorico.php';
include_once '../clases/claseEmpleado.php';
include_once '../clases/claseDepartamento.php';
$empleado = new Empleado();
$departamento =new Departamento();
$historico = new Historico();
$array = array();
$array = $historico->obtenerHistorico();
?>
<div id="rrhh">
    <div id="section1">
      <div class="topBar">
        <span class="sectionTittle">Consultar Histórico</span>
        <form class="formFiltrarPorFechas">
        <span class="sectionDate"><input type="date"></input></span>
        <span class="sectionDate"><input type="date"></input></span>
        <span class="sectionDate"><button>Filtrar</button></span>
      </form>
      </div>
      <div class="midCambas">
        <?php
        foreach($array as $value){
            ?>
            <div class='fichaDepartamento'>
              <span class='nombreDepartamento'>[<?php echo $value->fecha; ?>] El empleado <?php echo $empleado->obtenerNombreEmpleado($value->id_empleado); ?> ahora pertenece al departamento de <?php echo $departamento->obtenerNombreDepartamento($value->id_departamento); ?></span>
            </div>
            <?php
          }
                ?>
      </div>
    </div>
    <div id="section2"></div>
</div>
