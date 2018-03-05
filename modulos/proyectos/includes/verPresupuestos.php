<?php
include_once 'funciones.php';
$params = array("filtros" =>
    array("estado"=>
        ["op"=>"like", "val"=>"presupuesto"]
    )
);
$proyectos = obtener_proyectos($params);
//var_dump($proyectos);

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

            if($proyectos[$i]->imagen!=""){

	            $imagen = $proyectos[$i]->imagen;
	            $imagen = $PATH_MODULO_PROYECTOS."files/".$imagen;

            }else{

                $ids = array($proyectos[$i]->id_tipo_proyecto);
                $tipoproyectos = query(new Tabla("pro_tipo_proyecto"),array('id' => $ids))[0];

                if($tipoproyectos[0]->imagen != ""){

	                $imagen = $tipoproyectos[0]->imagen;
	                $imagen = $PATH_MODULO_PROYECTOS."files/".$imagen;

                }else {

                    $imagen = $PATH_MODULO_PROYECTOS."files/default_tipos.png";

                }

            }


            $fecha = $proyectos[$i]->fecha_fin;
            if (strlen($fecha) > 0) $fecha = $herramientas->fecha_a_normal($fecha);

            echo "<tr class='tr'><td class='td'><a href='$imagen' target='_blank'><img src='$imagen' width='15%'></a></td>";
            echo "<td class='td'>".strtoupper($proyectos[$i]->nombre)."</td>";
            echo "<td class='td'>".$proyectos[$i]->descripcion."</td>";
            echo "<td class='td'>".$proyectos[$i]->responsables."</td>";
            echo "<td class='td'>".$fecha."</td>";
            echo "<td class='td'>".$proyectos[$i]->coste."€</td>";
            $idproyectos = $proyectos[$i]->id_proyecto;
            echo "<td class='td'>
                    <form action='crearProyecto.php' method='post' class='crearProyecto'>
                        <input type='hidden' id='idproyecto".$i."' name='idproyecto' value='$idproyectos' class='valor'>
                        <input type='submit' class='btn btn-info' id='aceptar' name='aceptar' value='Aceptar Presupuesto'>
                    </form>
                </td>";


        }
        echo "</tr></table>";
        ?>
    </div>
</div>
