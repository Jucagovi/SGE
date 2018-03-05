<?php

require_once("../../../../clases/config.php");

// Clases
include_once '../../../../clases/claseHerramientas.php';
include_once '../../../../clases/claseTabla.php';
include_once '../../../../modulos/inventario/clases/categoria.php';
$feo = new Categoria('inv_valores');
$html = '';
try {
    //$rs = $feo->insertar($_POST);
    $insVal = [];
    $insVal['valor'] = $_POST['valor'];
    $insVal['id_producto'] = isset($_POST['idPro']) ? $_POST['idPro'] : null;
    $insVal['id_atributo'] = isset($_POST['idAtr']) ? $_POST['idAtr'] : null;
    //print_r($catAtr);
    $rs = $feo->insertar($insVal);
    if ($rs) {

        echo $feo->obtenerTablaValores();
    } else {
        echo 'Datos no insertados ' . print_r($_POST);
    }
} catch (Exception $e) {
    echo "<b>Se ha producido el siguiente error:" . $e->getMessage() . ".<b>";
}
?>