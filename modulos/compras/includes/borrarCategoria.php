<?php

    include_once '../../../clases/config.php';
    include_once '../../../clases/claseHerramientas.php';
    include_once '../../../clases/claseTabla.php';
    $feo = new Tabla("com_categorias");
    $conexion = $feo->conectar();
      
    try {
        
        $parametro = $_POST["idCategoria"];
        //doctor sapena 45, planta 3, derecha R (roberto)
        $feo->borrar($parametro);
       
       
    } catch(Exception $e) {
        echo "<b>Se ha producido el siguiente error:".$e->getMessage().".<b>";
    }

?>
