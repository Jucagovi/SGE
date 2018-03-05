<?php
if (!isset($_REQUEST) || empty($_REQUEST))
    die("No puedes estar aquí");

require_once "funciones.php";

$id = $_REQUEST["id"];

$id = ($herramientas->conectar())->real_escape_string($id);
$proyecto = obtener_proyecto($id);
$datos_proy = $proyecto["datos"];
$empleados = obtener_empleados([]);

?>
<div id="moduloproyectos">
    <form action="backend_crearProyecto.php" method="post" id="formCrearPresupuesto">
        <input type="hidden" name="id_presu" value="<?=$datos_proy->id_proyecto?>">
        <div class="contenedor">
            <div class="fila">
                <div style="margin: 10px">
                    <?php if (strlen($datos_proy->imagen)>0) { ?>
                        <img src="<?=$PATH_MODULO_PROYECTOS."files/".$datos_proy->imagen?>" style="max-height: 75px;">
                    <?php } else {
                        $ids = array($datos_proy->id_tipo_proyecto);
                        $tipoproyectos = query(new Tabla("pro_tipo_proyecto"), ['id' => $ids], true, true);
                        $imagen = $tipoproyectos->imagen;
                        if($imagen != ""){
                            ?>
                            <img src="<?=$PATH_MODULO_PROYECTOS."files/".$imagen?>" style="max-height: 75px;">
                            <?php
                        }
                        else {
                            ?>
                            <img src="<?=$PATH_MODULO_PROYECTOS."files/"?>default_tipos.png" style="max-height: 75px;">
                            <?php
                        }
                    } ?>
                </div>
                <div style="margin: 10px">
                    <h1 class="h1" style="font-size: 2em"><?=$datos_proy->nombre?></h1>
                    <hr class="hr">
                    <div class="sub-h1"><?=$datos_proy->descripcion?></div>
                </div>
            </div>
            <div class="fila">
                <label class="label">Elegir una imagen para el proyecto (opcional)
                    <input type="file" name="imagen" class="col-6">
                </label>
            </div>
            <div class="fila">
                <label class="label">Descuento del proyecto
                    <input id="nombreProyecto" name="descuento" value="0" placeholder="Introduce el descuento" required=""
                           aria-label="Introduce el descuento" title="Introduce el descuento" class="input col-6"
                           type="number" step=".01" min="0">
                </label>
            </div>
            <div class="fila">
                <label class="label">Fecha límite del proyecto
                    <input id="nombreProyecto" name="fechafin"  placeholder="Introduce la fecha límite" required=""
                           aria-label="Introduce la fecha límite" title="Introduce la fecha límite" class="input col-6"
                           type="date">
                </label>
            </div>
            <div class="fila">
                <label> Responsable
                    <select class="input col-6" name="responsable" required="" title="Elige un responsable">
                        <?php
                        foreach ($empleados as $empleado) {
                            $id = $empleado->id_empleado;
                            $nombre = $empleado->nombre." ".$empleados->apellidos;
                            echo "<option value='".$id."'>".$nombre."</option>";
                        }
                        ?>
                    </select>
                </label>
            </div>
            <?php
            foreach ( $proyecto["etapas"] as $etapa ) {
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
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <?php
            }
            ?>
            <button class="btn btn-success">Crear proyecto</button>
            <div class="resultado"></div>
        </div>
    </form>
</div>
