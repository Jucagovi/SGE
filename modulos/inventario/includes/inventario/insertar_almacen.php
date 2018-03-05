<?php
require_once("../../../../clases/config.php");

// Clases
 include_once '../../../../clases/claseHerramientas.php'; 
 include_once '../../../../clases/claseTabla.php'; 
include_once '../../../../modulos/inventario/clases/inventario.php';
$feo = new Inventario('inv_almacenes');
$fea = new Inventario('inv_invalm');
	try {
        $rs = $feo->insertar($_POST);
        if ($rs){
			$invAlm = [];
			$invAlm['id_inventario'] = isset($_POST['id'])?$_POST['id']:null;
			$invAlm['id_almacen'] = $feo -> ultimoIdAtributo();
			//print_r($catAtr);
			$fea -> insertar($invAlm);
			echo $feo -> crearFormularioAtributo();
		} else {
            echo 'Datos no insertados '.print_r($_POST);
        }
        
    } catch(Exception $e) {
        echo "<b>Se ha producido el siguiente error:".$e->getMessage().".<b>";
    }
?>
       
    