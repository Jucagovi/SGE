<!DOCTYPE html>
 
<html lang="es">
 
<head>
<?php
    # Cargo las propiedades del head
    include_once './html/head.php';
    # Configuración de la base de datos
    include_once './clases/config.php';
    # Cargo las clases del proyecto
    include_once './clases/claseherramientas.php'; 
    include_once './clases/claseTabla.php';
?>
</head>
 
<body>
    <header>
        <!-- Cargo la cabecera de la web -->
        <?php include_once './html/header.php'; ?>
    </header>
    <nav>
        <!-- Cargo el menú desde la base de datos -->
        <?php include_once './includes/menu.php'; ?>
    </nav>
    <aside>

    </aside>
    <section>
       <article>
           <h2>Título del Módulo<h2>
           <p> Contenido del módulo. </p>
       </article>
    </section>
    
    <footer>
        <p>GPL SGE 2017-2018</p>
    </footer>
</body>

</html>