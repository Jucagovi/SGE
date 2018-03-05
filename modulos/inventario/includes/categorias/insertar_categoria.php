<?php
require_once("../../../../clases/config.php");

// Clases
 include_once '../../../../clases/claseHerramientas.php'; 
 include_once '../../../../clases/claseTabla.php'; 
 include_once '../../../../modulos/inventario/clases/categoria.php';
    $feo = new Categoria('inv_categorias');
    $html = '';  
    try {
        $rs = $feo->insertar($_POST);
        if ($rs){
           echo $feo -> listarCategorias();
		   echo $feo -> obtenerListadoAtributosCategoria(1);
        } else {
            echo 'Datos no insertados '.print_r($_POST);
        }
        
    } catch(Exception $e) {
        echo "<b>Se ha producido el siguiente error:".$e->getMessage().".<b>";
    }
    
?>