<?php

include_once '../../../../clases/config.php';
include_once '../../../../clases/claseHerramientas.php';
include_once '../../../../clases/claseTabla.php';

$tabla = new Tabla("emp_categorias_eventos");
$id = $_POST['id_categoria'];
$conexion = $tabla->conectar();
$sql = "SELECT * FROM emp_eventos_categorias WHERE id_categoria=$id";
$rs = mysqli_query($conexion, $sql);
$filas = mysqli_num_rows($rs);
if ($filas > 0) {
    echo "Hay eventos con esta categoría.";
} else {
    $tabla->borrar($id);
    echo "La categoría ha sido borrada.";
}
?>