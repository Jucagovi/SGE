<?php
    include_once '../clases/clases.php';
    $feo = new Tabla("gen_modulos");
    $conexion = $feo->conectar();
    
    try {
        $rs = $conexion->query("SELECT gen_secciones.nombre, gen_secciones.descripcion 
                                FROM ".$feo->get_tabla().", gen_secciones 
                                WHERE gen_modulos.id_modulo = gen_secciones.id_modulo 
                                AND gen_modulos.nombre = '".$_POST["modulo"]."' 
                                ORDER BY gen_secciones.orden;");
        
        $html = "<h3>".$_POST["modulo"]."</h3>";
        while ($fila = $rs->fetch_array()){
            $html .= "<p id='".$fila["nombre"]."' title='".$fila["descripcion"]."'>".$fila["nombre"]."</p>";
        }
        echo $html;
    } catch(Exception $e) {
        echo "<b>Se ha producido el siguiente error:".$e->getMessage().".<b>";
    }
?>