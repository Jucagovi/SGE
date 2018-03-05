<?php
if (!isset($_REQUEST) || empty($_REQUEST))
    die("No puedes estar aquí");

require_once "funciones.php";

$proyecto = obtener_proyecto($_REQUEST['id']);
$etapas = $proyecto['etapas'];

$datos = $proyecto['datos'];
$responsable = "";
$disabled = ($datos->estado=="finalizado" ? "disabled" : "");
$tabla = new Tabla("pro_jornadas");
$conexion = $tabla->conectar();

?>
<div id="moduloproyectos">
    <form action="backend_verProyecto.php" method="post" id="formCrearPresupuesto">
        <input type="hidden" name="id_proy" value="<?=$datos->id_proyecto?>">
        <div class="contenedor">
            <div class="fila">
                <div style="margin: 10px">
                    <?php if (strlen($datos->imagen)>0) { ?>
                        <img src="<?=$PATH_MODULO_PROYECTOS."files/".$datos->imagen?>" style="max-height: 75px;">
                    <?php } else { ?>
                        <img src="<?=$PATH_MODULO_PROYECTOS."files/"?>default_tipos.png" style="max-height: 75px;">
                    <?php } ?>
                </div>
                <div style="margin: 10px">
                    <h1 class="h1" style="font-size: 2em"><?=$datos->nombre?></h1>
                    <hr class="hr">
                    <div class="sub-h1">Descripción: <?=$datos->descripcion?></div>
                    <?php
                    if ($datos->responsables == ""){
                        $responsable = "Sin responsable";
                    } else {
                        $responsable = obtener_empleados_ids([$datos->responsables])[0]->nombre;
                    }
                    ?>
                    <div class="sub-h1">Responsable del proyecto: <?=$responsable?></div>


                </div>
            </div>

            <br>
            <?php
            foreach ( $proyecto["etapas"] as $etapa ) {
                $datos = $etapa["datos"];
                ?>
                <div class="etapas fila" id="etapa_<?=$datos->id_tipo_etapa?>" style="flex-wrap: wrap;">
                    <div class="col-6">
                        <h2 class="h2 underline">Etapa: <?=$datos->nombre?></h2>
                        <p><?=$datos->descripcion?></p>
                    </div>
                    <?php
                    $fmt = new NumberFormatter( 'en_EN', NumberFormatter::DECIMAL );
                    foreach ( $etapa["tareas"] as $tarea ) {
                        $h_p = $fmt->parse($tarea["horas_presupuestadas"]);
                        ?>
                        <div class="tareas" id="tarea_<?=$tarea["id_tipo_tarea"]?>">
                            <div class="underline"><?=$tarea["nombre"]?></div>
                            <p><?=$tarea["descripcion"]?></p>
                            <p><?=$h_p?> Horas presupuestadas.</p>
                            <div class="col-6" id="tarea_<?=$tarea['id_tarea']?>">
                                <?php
                                if($tarea['fecha_fin'] != null) {
                                    $sql="select sum(horas) from pro_jornada WHERE id_tarea LIKE ".$tarea['id_tarea'].";";
                                    $res=$conexion->query($sql);
                                    $sumatorioHoras = $res->fetch_array()[0];
                                    ?>
                                    <label class="label text-success">
                                        <input type='checkbox' name='finalizadas[]' checked disabled>
                                        Tarea finalizada
                                    </label>
                                    <input class="input col-6" type="number" step=".01" name="horas[]" value="<?=$sumatorioHoras?>" min="0"
                                           placeholder="Insertar horas trabajadas" disabled>
                                    <?php
                                } else {
                                    ?>
                                    <label class="label">
                                        <input type='checkbox' name='finalizadas[]' value='<?=$tarea['id_tarea']?>'>
                                        Tarea finalizada
                                    </label>
                                    <input class="input col-6" type="number" step=".01" name="horas[]" value="0" min="0"
                                           placeholder="Insertar horas trabajadas">
                                    <?php
                                }
                                ?>

                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <?php
            }
            $conexion->close();
            ?>
            <button class="btn btn-success" <?=$disabled?>>Guardar Horas Trabajadas</button>
            <div class="resultado"></div>
        </div>
    </form>
</div>


