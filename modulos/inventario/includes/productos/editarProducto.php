<?php
// Archivo de configuración
require_once("../../../../clases/config.php");

// Clases
include_once '../../../../clases/claseHerramientas.php';
include_once '../../../../clases/claseTabla.php';
include_once '../../../../modulos/inventario/clases/producto.php';
$feo = new Producto('inv_productos');
$fea = new Producto('inv_propas');
$editar = isset($_POST['editar']) ? $_POST['editar'] : false;
if ($editar) {
    try {
        $rs = $feo->editarProducto($_POST);
        $id_pasillo = isset($_POST['id_pasillo'])?$_POST['id_pasillo']:null;
        $cantidad = isset($_POST['cantidad'])?$_POST['cantidad']:null;
        if ($rs) {
            if(existeRelacionPropas($_POST['id_producto'],$id_pasillo)){
                $fea -> borrarRelacionPropas($_POST['id_producto'],$id_pasillo);
            }
            $propas = [];
            $propas['id_producto'] = $feo -> ultimoIdProducto();
            $propas['id_pasillo'] = $id_pasillo;
            $propas['cantidad'] = $cantidad;
            $fea -> insertar($propas);
            echo '<h3>Datos editados</h3>';
            echo "<div id='ayuda'><h3 style='margin-bottom: 10px;'>Listado de productos</h3>";
                echo $feo->obtenerTablaProductos();
            echo '</div>';
         }  { 
            echo "Datos no editados print_r($_POST) ";
         }
    } catch (Exception $e) {
        
        echo "<b>Se ha producido el siguiente error:". $e->getMessage() .".<b>";
    
    }
} else {
    try {
        echo $html = $feo->obtenerFormularioProducto($_POST['id_producto']);
    } catch (Exception $e) {
        echo "<b>Se ha producido el siguiente error:" . $e->getMessage() . ".<b>";
    }
}
?>