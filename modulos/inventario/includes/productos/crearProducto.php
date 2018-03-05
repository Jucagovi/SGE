<?php
// Archivo de configuración
require_once("../../../../clases/config.php");

// Clases
include_once '../../../../clases/claseHerramientas.php';
include_once '../../../../clases/claseTabla.php';
include_once '../../../../modulos/inventario/clases/producto.php';
$feo = new Producto('inv_productos');
$fea = new Producto('inv_propas');
$feu = new Producto('inv_pasillos');
$fei = new Producto('inv_secciones');
$fee = new Producto('inv_almacenes');
if (!isset($_POST['nombre'])&&!isset($_POST['id_categoria'])&&!isset($_POST['id_tipo_producto'])) {
    try {
        $html = "<div id='formulario'><h3 style='margin-bottom: 10px;'></h3>";
        $html .= $feo -> crearFormularioProducto();
        $html .= "</div>";
        echo $html;
    } catch(Exception $e) {
        echo "<b>Se ha producido el siguiente error:".$e->getMessage().".<b>";
    }
} else {
    try {
        $id_pasillo = isset($_POST['id_pasillo'])?$_POST['id_pasillo']:null;
        $cantidad = isset($_POST['cantidad'])?$_POST['cantidad']:null;
        array_push($_POST, $_POST['id_pasillo']);
        array_push($_POST, $_POST['cantidad']);
        $rs = $feo->insertar($_POST);
        if ($rs){
            $propas = [];
            $propas['id_producto'] = $feo -> ultimoIdProducto();
            $propas['id_pasillo'] = $id_pasillo;
            $propas['cantidad'] = $cantidad;
            $fea -> insertar($propas);
            $pasillo = $feo -> obtenerPasillo($id_pasillo);
            $pasillo['cantPro'] = ($pasillo['cantPro'])+$cantidad;
            $feu -> actualizarCantidadesPasillo($pasillo);
            $seccion = [];
            $id_seccion = $feo ->obtenerIdSeccion($id_pasillo);
            $seccion = $feo -> obtenerSeccion($id_seccion);
            $seccion['cantProPas'] = ($seccion['cantProPas'])+$cantidad;
            $fei -> actualizarCantidadesSeccion($seccion);
            $almacen = [];
            $id_almacen = $feo ->obtenerIdAlmacen($id_seccion);
            $almacen = $feo ->obtenerAlmacen($id_almacen);
            $almacen['cantProSec'] = ($almacen['cantProSec'])+$cantidad;
            $fee -> actualizarCantidadesAlmacen($almacen);
            echo 'Datos insertados de producto.';
        } else {
            echo 'Datos no insertados '.print_r($_POST);
        }
        
    } catch(Exception $e) {
        echo "<b>Se ha producido el siguiente error:".$e->getMessage().".<b>";
    }
}
?>
       
    