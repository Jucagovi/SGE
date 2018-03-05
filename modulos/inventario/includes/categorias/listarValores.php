<?php
// Archivo de configuración
 require_once("../../../../clases/config.php");

// Clases
 include_once '../../../../clases/claseHerramientas.php'; 
 include_once '../../../../clases/claseTabla.php'; 
 include_once '../../../../modulos/inventario/clases/categoria.php';

  $feo = new Categoria('inv_valores');
    try {
	 echo $feo -> obtenerTablaValores();
       
    } catch(Exception $e) {
        echo "<b>Se ha producido el siguiente error:".$e->getMessage().".<b>";
    }

?>