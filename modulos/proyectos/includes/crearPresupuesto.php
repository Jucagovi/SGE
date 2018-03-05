<?php
session_start();
require_once "funciones.php";

$tipos_proyecto = obtener_tipos_proyecto();
//bonita_variable($tipos_proyecto);

?>
<div id="moduloproyectos">
    <h1 class="titulo-seccion">Herramienta de creación de presupuestos</h1>
    <?php
    if (!isset($_REQUEST["tipo"])) {
        ?>
        <form action="crearPresupuesto.php" method="post" id="formElegirTipo" class="contenedor">
            <div class="fila">
                <label class="label">Elige el tipo de proyecto
                    <select name="tipo" id="selecTipoProy" title="Elige el tipo de proyecto" class="col-6">
                        <?php
                        foreach ( $tipos_proyecto as $tipo ) {
                            echo "<option value='".$tipo->id_tipo_proyecto."'>".$tipo->nombre."</option>";
                        }
                        ?>
                    </select>
                </label>
                <br>
            </div>
            <div class="fila">
                <br>
                <button class="btn btn-info" id="elegirTipoPresupuesto">Crear presupuesto</button>
            </div>
        </form>
        <?php
    }
    else {
        $tipo = ($herramientas->conectar())->real_escape_string($_REQUEST["tipo"]);
        $tipo_proyecto = obtener_tipo_proyecto($tipo);
        $datos_tipo = $tipo_proyecto["datos"];
        ?>
        <form action="backend_crearPresupuesto.php" method="post" id="formCrearPresupuesto">
            <input type="hidden" name="id_tipo" value="<?=$datos_tipo->id_tipo_proyecto?>">
            <div class="contenedor">
                <div class="fila">
                    <div style="margin: 10px">
                        <?php if (strlen($datos_tipo->imagen)>0) { ?>
                            <img src="<?=$PATH_MODULO_PROYECTOS."files/".$datos_tipo->imagen?>" style="max-height: 75px;">
                        <?php } else { ?>
                            <img src="<?=$PATH_MODULO_PROYECTOS."files/"?>default_tipos.png" style="max-height: 75px;">
                        <?php } ?>
                    </div>
                    <div style="margin: 10px">
                        <h1 class="h1" style="font-size: 2em"><?=$datos_tipo->nombre?></h1>
                        <hr class="hr">
                        <div class="sub-h1"><?=$datos_tipo->descripcion?></div>
                    </div>
                </div>
                <div class="fila">
                    <label class="label">Nombre del proyecto
                        <input id="nombreProyecto" name="nombre" value="" placeholder="Introduce el nombre" required=""
                               aria-label="Introduce el nombre" title="Introduce el nombre" class="input col-6">
                    </label>
                </div>
                <div class="fila">
                    <label class="label">Descripción del proyecto
                        <textarea id="descripcionProyecto" name="descripcion" placeholder="Introduce una descripción"
                                  aria-label="Introduce la descripción" title="Introduce el descripción" required=""
                                  class="textarea col-6"></textarea>
                    </label>
                </div>
                <br>
		        <?php
		        foreach ( $tipo_proyecto["etapas"] as $etapa ) {
			        $datos = $etapa["datos"];
			        ?>
                    <div class="etapas fila" id="etapa_<?=$datos->id_tipo_etapa?>" style="flex-wrap: wrap;">
                        <div class="col-6">
                            <h2 class="h2 underline"><?=$datos->nombre?></h2>
                            <p><?=$datos->descripcion?></p>
                        </div>
				        <?php
				        foreach ( $etapa["tareas"] as $tarea ) {
					        ?>
                            <div class="tareas" id="tarea_<?=$tarea["id_tipo_tarea"]?>">
                                <div class="underline"><?=$tarea["nombre"]?></div>
                                <p><?=$tarea["descripcion"]?></p>
                                <p><?=$tarea["precio"]?></p>
                                <div class="col-6">
                                    <input class="input" type="number" step=".01" name="horas[]" value="" min="1" required
                                           placeholder="Horas a presupuestar" style="height: 35px;width: 160px;">
                                </div>
                            </div>
					        <?php
				        }
				        ?>
                    </div>
			        <?php
		        }
		        ?>
                <button class="btn btn-success">Crear presupuesto</button>
                <div class="resultado"></div>
            </div>
        </form>
        <?php
    }
    ?>
</div>