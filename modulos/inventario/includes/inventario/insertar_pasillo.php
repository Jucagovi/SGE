<?php
require_once("../../../../clases/config.php");

// Clases
 include_once '../../../../clases/claseHerramientas.php'; 
 include_once '../../../../clases/claseTabla.php'; 
include_once '../../../../modulos/inventario/clases/inventario.php';
$feo = new Inventario('inv_pasillos');
$fea = new Inventario('inv_secpas');
	try {
        $rs = $feo->insertar($_POST);
        if ($rs){
			$secPas = [];
			$secPas['id_seccion'] = isset($_POST['idSec'])?$_POST['idSec']:null;
			$secPas['id_pasillo'] = $feo ->ultimoIdPasillo();
			$fea -> insertar($secPas);
			echo $feo ->obtenerTablaPasillos();
		} else {
            echo 'Datos no insertados '.print_r($_POST);
        }
        
    } catch(Exception $e) {
        echo "<b>Se ha producido el siguiente error:".$e->getMessage().".<b>";
    }
?>
       
    