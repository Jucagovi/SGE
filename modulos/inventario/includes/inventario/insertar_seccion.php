<?php
require_once("../../../../clases/config.php");

// Clases
 include_once '../../../../clases/claseHerramientas.php'; 
 include_once '../../../../clases/claseTabla.php'; 
include_once '../../../../modulos/inventario/clases/inventario.php';
$feo = new Inventario('inv_secciones');
$fea = new Inventario('inv_almsec');
	try {
        $rs = $feo->insertar($_POST);
        if ($rs){
			$almSec = [];
			$almSec['id_almacen'] = isset($_POST['idAlm'])?$_POST['idAlm']:null;
			$almSec['id_seccion'] = $feo -> ultimoIdSeccion();
			$fea -> insertar($almSec);
			echo $feo ->obtenerTablaSecciones();
		} else {
            echo 'Datos no insertados '.print_r($_POST);
        }
        
    } catch(Exception $e) {
        echo "<b>Se ha producido el siguiente error:".$e->getMessage().".<b>";
    }
?>
       
    