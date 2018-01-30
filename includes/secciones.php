<?php
    include_once '../clases/clases.php';
    $feo = new Tabla("gen_secciones");
    $conexion = $feo->conectar();
      
    try {
        $rs = $conexion->query("SELECT gen_secciones.id_seccion, gen_secciones.nombre, gen_secciones.descripcion 
                                FROM ".$feo->get_tabla().", gen_modulos 
                                WHERE gen_modulos.id_modulo = gen_secciones.id_modulo 
                                AND gen_modulos.nombre = '".$_POST["modulo"]."' 
                                ORDER BY gen_secciones.orden;");
        
        $html = "<h3>".$_POST["modulo"]."</h3>";
        while ($fila = $rs->fetch_array()){
            //Muestro el enlace del primer módulo
            $html .= "<p class='seccion' id='".$feo->generar_identificador($fila["id_seccion"])."' title='".$fila["descripcion"]."'>".$fila["nombre"]."</p>";
            //Consulto las subsecciones del módulo en cuentión de la tabla gen_subsecciones
            $rs_sub = $conexion->query("SELECT * FROM gen_subsecciones WHERE id_seccion = ".$fila["id_seccion"]." ORDER BY orden");
            //Muestro las subsecciones
            $html .= "<div class='subsecciones' id='sub_".$feo->generar_identificador($fila["id_seccion"])."'>";
            while ($fila_sub = $rs_sub->fetch_array()){
                $html .= "<p class='subseccion' id='".$fila_sub["identificador"]."'>".$fila_sub["nombre"]."</p>";
            }
            $html .= "</div>";
        }
        echo $html;
       
    } catch(Exception $e) {
        echo "<b>Se ha producido el siguiente error:".$e->getMessage().".<b>";
    }
?>