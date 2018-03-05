<?php
include_once '../../../clases/config.php';
include_once '../../../clases/claseHerramientas.php';
include_once '../clases/claseProcesoSeleccion.php';
include_once '../clases/claseDepartamento.php';
$feo = new ProcesoSeleccion();
$fea = new Departamento();
$array = array();
$array = $feo->obtenerProcesosSeleccion();
?>
<!-- Muestra todos los procesos de seleccion -->
<div id="rrhh">
    <div id="section1">
      <div class="topBar">
        <span class="sectionTittle">Administracion Proceso Seleccion</span>
        <button class="botonCrearCandidato" name="crearCandidato">Crear Candidato</button>
      </div>
      <div class="midCambas">
<?php
foreach ($array as $value) {
     ?>
    <div class='fichaDepartamento'>
      <span class='nombreDepartamento'><?php echo $fea->obtenerNombreDepartamento($value->id_departamento);  ?></span>
      <span class='nombreDepartamento'><?php echo $value->puesto; ?></span>
      <span class='fichaDepartamentoBotonera'>
        <button class='botonVerProcesoSeleccion' name='verInformacion' value="<?php echo $value->id_proceso_seleccion; ?>" >Ver Informacion</button>
        <button class='botonAñadirCandidatoProcesoSeleccion' name='añadirCandidato' value="<?php echo $value->id_proceso_seleccion; ?>">Añadir Candidato</button>
        <button class='botonEditarProcesoSeleccion' name='editarInformacion' value="<?php echo $value->id_proceso_seleccion; ?>">Editar Informacion</button>
      </span>
    </div>
     <?php } ?>
</div>
</div>
<div id="section2"></div>
</div>
