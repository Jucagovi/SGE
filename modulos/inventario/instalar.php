<?php
// Archivo de configuración
require_once("../../clases/config.php");
// Clases
include_once '../../clases/claseHerramientas.php';
include_once '../../clases/claseTabla.php';
include_once '../../modulos/inventario/clases/instalador.php';
$feo = new Instalador('inv_productos');
if (isset($_GET['instalar'])) {
    if ($_GET['instalar'] == true) {
        if (isset($_GET['datos'])) {
            if ($_GET['datos'] == true) {
                $rs = $feo->instalar(true);
                echo $rs ? 'Se han instalado los datos de prueba y el módulo inventario' : 'Error al instalar los datos de prueba y el módulo inventario';
            }
        } else {
            $rs = $feo->instalar();
            echo $rs ? 'Se ha instalado el módulo inventario' : 'Error al instalar el módulo inventario';
        }
    }
}
?>

<a href="<?= $_SERVER['PHP_SELF'] ?>"><h1>Inicio</h1></a>
¿Deseas instalar la base de datos?<br/>
<a href="<?= $_SERVER['PHP_SELF'] ?>?instalar=true"><button>Instalar módulo inventarios.</button></a><br/>
<a href="<?= $_SERVER['PHP_SELF'] ?>?instalar=true&datos=true"><button>Instalar modulo y datos de prueba</button></a>