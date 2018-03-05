<?php
include_once 'funciones.php';

$proyectos = _select("SELECT * FROM pro_proyecto WHERE estado = 'proyecto' OR estado = 'finalizado'");

?>


<div id="moduloproyectos">
    <div class="contenedor">
        <?php
        if (isset($_REQUEST["success"])) {
            ?>
            <div class='fila' style='margin-bottom: 10px;'>
                <div class='col-6 text-success bg-success borde'><?=$_REQUEST["success"]?></div>
            </div>
            <?php
        }
        echo "<table width='100%'>";
        echo "<th>Imagen del proyecto</th><th>Nombre Proyecto</th><th>Descripcion</th><th>Responsable</th><th>Fecha Fin</th><th>Coste</th>";
            for($i=0;$i<count($proyectos);$i++){

                if($proyectos[$i]["imagen"]==""){
                    $imagen = $PATH_MODULO_PROYECTOS."files/default_tipos.png";
                }else{
                    $imagen = $PATH_MODULO_PROYECTOS."files/".$proyectos[$i]["imagen"];
                }

                $fecha = $proyectos[$i]["fecha_fin"];
                if (strlen($fecha) > 0) $fecha = $herramientas->fecha_a_normal($fecha);

                echo "<tr class='tr'><td class='td'><img src='$imagen' height='20px'></td>";
                echo "<td class='td'>".strtoupper($proyectos[$i]["nombre"])."</td>";
                echo "<td class='td'>".$proyectos[$i]["descripcion"]."</td>";
                echo "<td class='td'>".  obtener_empleados_ids([$proyectos[$i]["responsables"]])[0]->nombre ."</td>";
                echo "<td class='td'>".$fecha."</td>";
                echo "<td class='td'>".$proyectos[$i]["coste"]."€</td>";
                $idproyectos = $proyectos[$i]["id_proyecto"];
                $j=0;
                echo "<td class='td'>
                    <form action='verProyecto.php' method='post' class='ver-proyectos'>
                        <input type='hidden' id='idproyecto$j' name='idproyecto' class='valor' value='$idproyectos'>
                        <input type='submit' class='btn btn-info btnVerProyectos' id='imprimir' name='imprimir' value='Ver el proyecto'>
                    </form>
                </td>";

                if($proyectos[$i]["estado"] == "finalizado") {
                    echo "<td class='td'>
                    <form class='informes' action='modulos/proyectos/includes/informeproyecto.php' method='post' target='_blank'>
                        <input type='hidden' id='idproyecto$j' name='idproyecto' value='$idproyectos'>
                        <input type='submit' class='btn btn-info' id='imprimir' name='imprimir' value='Imprimir Informe'>
                    </form>
                    </td>";
                }

            }
        echo "</tr></table>";
        ?>
    </div>
</div>
