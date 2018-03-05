<?php
include_once '../../../clases/config.php';
include_once '../../../clases/claseHerramientas.php';
include_once '../clases/claseDepartamento.php';
$feo = new Departamento();
?>
<!-- Mostrado de todos los departamentos -->
<div id="rrhh">
    <div id="section1">
      <div class="topBar">
        <span class="sectionTittle">Administracion Departamentos</span>
      </div>
      <div class="midCambas">
        <?php
        $array = array();
        $array = $feo->obtenerDepartamentos();
        foreach ($array as $value) {
            ?>
            <div class='fichaDepartamento'>
              <span class='nombreDepartamento'><?php echo $value->nombre; ?></span>
              <span class='fichaDepartamentoBotonera'>
                <button class='botonVerDepartamento' name='BotonVer' value="<?php echo $value->id_departamento; ?>"><i class="icon fa-search" aria-hidden="true"></i></button>
                <button class='botonEditarDepartamento' name='BotonEditar' value="<?php echo $value->id_departamento; ?>" ><i class="icon fa-edit" aria-hidden="true"></i></button>
              </span>
            </div>
            <?php
        }
        ?>
      </div>
    </div>
    <div id="section2"></div>
</div>
