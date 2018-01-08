<!DOCTYPE html>
 
<html lang="es">
 
<head>
<title>Proyecto SGE 2017-2018</title>
<meta charset="utf-8" />
<link rel="stylesheet" href="./css/estilo.css" />
<link rel="shortcut icon" href="./imagenes/favicon.png" />
<script src="./js/jquery-3.2.1.min.js" type="text/javascript"></script>
<script src="./js/propio.js" type="text/javascript"></script>
<?php
    include_once './clases/config.php';
    include_once './clases/claseherramientas.php'; 
    include_once './clases/claseTabla.php';
?>
</head>
 
<body>
    <header>
        <?php include_once './html/header.php'; ?>
    </header>
    <nav>
        <?php include_once './includes/menu.php'; ?>
    </nav>
    <aside>
       <h3>Nombre Módulo</h3>
       <p>Aplicación</p>
       <p>Aplicación</p>
       <p>Aplicación</p>
       <p>Aplicación</p>
       <p>Aplicación</p>
    </aside>
    <section>
       <article>
           <h2>Título de contenido<h2>
           <p> Contenido (ademas de imagenes, citas, videos etc.) </p>
           <p>
               <?php
               
               $feo = new Tabla('gen_secciones');
               
               if ($feo->existe_tabla('gen_secciones')) {
                   echo "Existe<br>";
               } else {
                   echo "No existe<br>";
               }
               /*
               echo $feo->get_tabla()."<br>";
               
                */
               echo $feo->fecha_a_mysql("21/05/1978")."<br>";
               echo $feo->fecha_a_normal("1978-05-21")."<br>";
               /*
               echo $feo->numero_filas()."<br>";
               echo "<pre>";
               print_r($feo->obtener_columnas());
               echo "</pre>";
               echo $feo->obtener_id()."<br>";
               echo $feo->cortar("El perro verde", 12);
                * /
                */
               echo "<pre>";
               print_r($feo->obtener_tablas());
               echo "</pre>";
               /*
               $feos = array (
                   'nombre' => "00000000",
                   'descripcion' => "00000000",
                   'permiso' => 0,
                   'orden' => 0,
                   'id_modulo' => 0
               );
               /*
               echo "<pre>";
               print_r($feos);
               echo "</pre>";
               */
               echo $feo->mostrar_insertar($feos)."<br><br>";
               /*
               if ($feo->insertar($feos)){
                   echo "TODO BIEN<br>";
               } else {
                   echo "TODO MAL<br>";
               }
               */
               
               $feos = array (
                   'nombre' => "11111111",
                   'descripcion' => "1111111111",
                   'permiso' => 1,
                   'orden' => 1,
                   'id_modulo' => 1
               );
               
               /*
               if ($feo->borrar(4)){
                   echo "TODO BIEN";
               } else {
                   echo "TODO MAL";
               }
               */
               
               echo $feo->mostrar_actualizar(3, $feos)."<br><br>";
               /*
               if ($feo->actualizar(3, $feos)){
                   echo "TODO BIEN A<br>";
               } else {
                   echo "TODO MAL A<br>";
               }
                */
               ?>
           </p>
       </article>
    </section>

    <footer>
        <p>GPL SGE 2017-2018</p>
    </footer>
</body>
</html>