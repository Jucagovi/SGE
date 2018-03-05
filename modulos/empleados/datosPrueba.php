<?php

include_once '../../clases/config.php';
include_once '../../clases/claseHerramientas.php';
include_once '../../clases/claseTabla.php';



$tabla=new Tabla("");
$conexion=$tabla->conectar();


$empleado1="INSERT INTO `gen_empleados` (`id_empleado`, `nombre`, `apellidos`, `fecha_nac`, `fecha_inc`, `usuario`, `contrasena`, `curriculum`, `foto`, `id_departamento`) VALUES (NULL, 'Maribel', 'Antonio', '2018-03-07', '2018-03-01', 'Maribel', '1234', NULL, NULL, 'NULL');";
mysqli_query($conexion,$empleado1);
$empleado2="INSERT INTO `gen_empleados` (`id_empleado`, `nombre`, `apellidos`, `fecha_nac`, `fecha_inc`, `usuario`, `contrasena`, `curriculum`, `foto`, `id_departamento`) VALUES (NULL, 'Antonio', 'Antunez', '2018-03-05', '2018-03-06', 'Antionio', '1234', NULL, NULL, 'NULL');";
mysqli_query($conexion,$empleado2);

$evento1="INSERT INTO `emp_eventos` (`id_evento`, `nombre`, `fecha`) VALUES (NULL, 'Acampada', '2018-03-22');";
mysqli_query($conexion,$evento1);
$evento2="INSERT INTO `emp_eventos` (`id_evento`, `nombre`, `fecha`) VALUES (NULL, 'Visita', '2018-03-27');";
mysqli_query($conexion,$evento2);

$cat_evento1="INSERT INTO `emp_categorias_eventos` (`id_categoria`, `nombre`) VALUES (NULL, 'obligatorio');";
$cat_evento2="INSERT INTO `emp_categorias_eventos` (`id_categoria`, `nombre`) VALUES (NULL, 'divertido');";
mysqli_query($conexion,$cat_evento1);
mysqli_query($conexion,$cat_evento2);

$cat_dieta1="INSERT INTO `emp_categorias_dietas` (`id_categoria`, `nombre`, `descripcion`) VALUES (NULL, 'transporte', 'se mueve');";
mysqli_query($conexion,$cat_dieta1);
$cat_dieta2="INSERT INTO `emp_categorias_dietas` (`id_categoria`, `nombre`, `descripcion`) VALUES (NULL, 'sobresueldo', 'dinero');";
mysqli_query($conexion,$cat_dieta2);

$dieta1="INSERT INTO `emp_dietas` (`id_dieta`, `id_empleado`, `categoria`, `importe`, `fecha`) VALUES (NULL, '1', '1', '200', '2018-04-13');";
$dieta2="INSERT INTO `emp_dietas` (`id_dieta`, `id_empleado`, `categoria`, `importe`, `fecha`) VALUES (NULL, '1', '2', '2000', '2018-03-15');";
mysqli_query($conexion,$dieta1);
mysqli_query($conexion,$dieta2);






