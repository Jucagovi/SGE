<?php
require_once("../../../../clases/config.php");

// Clases
 include_once '../../../../clases/claseHerramientas.php'; 
 include_once '../../../../clases/claseTabla.php'; 
include_once '../../../../modulos/inventario/clases/atributo.php';
$feo = new Atributo('inv_atributos');
	echo $feo -> crearFormularioAtributo();
	
?>
       
    