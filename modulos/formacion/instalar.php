<?php

include_once '../../clases/config.php';
include_once '../../clases/claseHerramientas.php';

/////////////////////////// TABLAS /////////////////////////

$formacion_curso = "CREATE TABLE IF NOT EXISTS `for_curso` (
  `id_curso` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `vacantes` int(11) NOT NULL DEFAULT '0',
  `descripcion` varchar(200) COLLATE latin1_general_ci NOT NULL DEFAULT '0',
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `periodo_inscripcion` date NOT NULL,
  `periodo_fin_inscripcion` date NOT NULL,
  `id_empleado` int(11) NOT NULL,
  PRIMARY KEY (`id_curso`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;";

$formacion_solicitud = "CREATE TABLE IF NOT EXISTS `for_solicitud` (
  `id_solicitud` int(11) NOT NULL AUTO_INCREMENT,
  `id_curso` int(11) NOT NULL DEFAULT '0',
  `descripcion` varchar(200) COLLATE latin1_general_ci NOT NULL DEFAULT '0',
  `id_empleado` int(11) NOT NULL DEFAULT '0',
  `estado` varchar(20) COLLATE latin1_general_ci NOT NULL DEFAULT 'SIN APROBAR',
  PRIMARY KEY (`id_solicitud`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;";

$formacion_unidad = "CREATE TABLE IF NOT EXISTS `for_unidad` (
  `id_unidad` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `duracion_horas` int(11) NOT NULL,
  `nombre_unidad` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `porcentaje_curso` int(3) DEFAULT NULL,
  PRIMARY KEY (`id_unidad`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;";

$for = new Herramientas();
$con = $for->conectar();

$array = array($formacion_curso, $formacion_solicitud, $formacion_unidad);

echo "<p>Iniciando instalación</p>";
mysqli_begin_transaction($con, MYSQLI_TRANS_START_READ_WRITE);

echo "<p>Generando tablas...</p>";
foreach ($array as $tabla) {
    mysqli_query($con, $tabla);
}
echo "<p>Tablas creadas.</p>";



/////////////////////////// INSERTS /////////////////////////

// MODULO

echo "<p>Creando módulo...</p>";

$gen_modulos = "INSERT INTO `gen_modulos` "
        . "(`nombre`, `descripcion`, `orden`)"
        . " SELECT 'Formacion', 'Gestiona la formación de empleados', '3' AS tmp"
        . " WHERE NOT EXISTS (SELECT nombre FROM gen_modulos WHERE nombre = 'Formacion') LIMIT 1";

mysqli_query($con, $gen_modulos);
$mod = mysqli_insert_id($con);

echo "<p>Módulo creado.</p>";

// SECCIONES

echo "<p>Creando secciones y subsecciones...</p>";

$sec_cursos = "INSERT INTO `gen_secciones` "
        . "(`nombre`, `descripcion`, `permiso`, `orden`, `id_modulo`, `identificador`)"
        . " SELECT 'Cursos', 'Se mostrarán los cursos disponibles para ser cursados.', '0', '1', '$mod', 'cursos' AS tmp"
        . " WHERE NOT EXISTS (SELECT nombre FROM gen_secciones WHERE nombre = 'Formacion') LIMIT 1";


$sec_alumnado = "INSERT INTO `gen_secciones` "
        . "(`nombre`, `descripcion`, `permiso`, `orden`, `id_modulo`, `identificador`)"
        . " SELECT 'Alumnado', 'Módulo pensado para la gestión del alumnado.', '0', '2', '$mod', 'alumnado' AS tmp"
        . " WHERE NOT EXISTS (SELECT nombre FROM gen_secciones WHERE nombre = 'Alumnado') LIMIT 1";


$sec_gestion = "INSERT INTO `gen_secciones` "
        . "(`nombre`, `descripcion`, `permiso`, `orden`, `id_modulo`, `identificador`)"
        . " SELECT 'Gestión de alumnado', 'Módulo de acceso exclusivo para un responsable de gestión del alumnado.', '0', '10', '$mod', 'gestionAlumnado' AS tmp"
        . " WHERE NOT EXISTS (SELECT nombre FROM gen_secciones WHERE nombre = 'Gestión de alumnado') LIMIT 1";


mysqli_query($con, $sec_cursos);
$und = mysqli_insert_id($con);

$sub_unidades = "INSERT INTO `gen_subsecciones` "
        . "(`nombre`, `descripcion`, `permiso`, `orden`, `id_seccion`, `identificador`)"
        . " SELECT 'Unidades', 'Unidades de cada curso', '0', '1', '$und', 'unidades' AS tmp"
        . " WHERE NOT EXISTS (SELECT nombre FROM gen_secciones WHERE nombre = 'Unidades') LIMIT 1";

        mysqli_query($con, $sub_unidades);


        mysqli_query($con, $sec_alumnado);
        $alu = mysqli_insert_id($con);

        $sub_consulta_sol = "INSERT INTO `gen_subsecciones` "
                . "(`nombre`, `descripcion`, `permiso`, `orden`, `id_seccion`, `identificador`)"
                . " SELECT 'Consulta De Solicitudes', 'Peticiones para la matriculación de un alumno nuevo a un curso.', '0', '2', '$alu', 'consultaSolicitudes' AS tmp"
                . " WHERE NOT EXISTS (SELECT nombre FROM gen_secciones WHERE nombre = 'Consulta De Solicitudes') LIMIT 1";

        $sub_enviar_sol = "INSERT INTO `gen_subsecciones` "
                . "( `nombre`, `descripcion`, `permiso`, `orden`, `id_seccion`, `identificador`)"
                . " SELECT 'Enviar Solicitud', 'El alumno reliza una soliciitud a un curso.', '0', '3', '$alu', 'enviarSolicitud' AS tmp"
                . " WHERE NOT EXISTS (SELECT nombre FROM gen_secciones WHERE nombre = 'Enviar Solicitud') LIMIT 1";

                mysqli_query($con, $sub_consulta_sol);
                mysqli_query($con, $sub_enviar_sol);

                mysqli_query($con, $sec_gestion);
                $ges = mysqli_insert_id($con);

      $sub_nuevo_curso = "INSERT INTO `gen_subsecciones` "
              . "( `nombre`, `descripcion`, `permiso`, `orden`, `id_seccion`, `identificador`)"
              . " SELECT 'Añadir Curso', 'Añade un nuevo curso.', '0', '1', '$ges', 'addCurso' AS tmp"
              . " WHERE NOT EXISTS (SELECT nombre FROM gen_secciones WHERE nombre = 'Añadir Curso') LIMIT 1";

              $sub_solPendientes = "INSERT INTO `gen_subsecciones` "
                      . "( `nombre`, `descripcion`, `permiso`, `orden`, `id_seccion`, `identificador`)"
                      . " SELECT 'Solicitudes Pendientes', 'Solicitudes pendientes a confirmar.', '0', '1', '$ges', 'solicitudesPendientes' AS tmp"
                      . " WHERE NOT EXISTS (SELECT nombre FROM gen_secciones WHERE nombre = 'Solicitudes Pendientes') LIMIT 1";


                        mysqli_query($con, $sub_nuevo_curso);
                        mysqli_query($con, $sub_solPendientes);

echo "<p>Secciones y subsecciones creadas.</p>";

mysqli_commit($con);

echo "<p>Insertando datos a las tablas.</p>";



$insert_cursos = "REPLACE INTO `for_curso` (`id_curso`, `nombre`, `vacantes`, `descripcion`, `fecha_inicio`, `fecha_fin`, `periodo_inscripcion`, `periodo_fin_inscripcion`, `id_empleado`) VALUES
	(1, 'Informática', 20, 'Curso de informática avanzada destinado al desarrolo de aplicaciones.', '2018-05-13', '2018-09-13', '2018-04-13', '2018-04-30', 13141516),
	(2, 'Inglés', 20, 'Curso dedicado a mejorar el inglés de los empleados.', '2018-09-01', '2018-12-01', '2018-08-01', '2018-08-15', 13141517),
	(3, 'Logística', 6, 'Curso de logística.', '2018-05-13', '2018-09-13', '2018-04-13', '2018-04-30', 13141516),
	(4, 'Comunicación', 10, 'Curso dedicado al desarrollo la capacidad comunicativa de la gente.', '2018-09-01', '2018-12-01', '2018-08-01', '2018-08-15', 13141517)";
mysqli_query($con, $insert_cursos);

$insert_solicitud = "REPLACE INTO `for_solicitud` (`id_solicitud`, `id_curso`, `descripcion`, `id_empleado`, `estado`) VALUES
	(53, 4, 'Soy Federico y estoy interesado en comunicarme.', 13141517, 'APROBADA'),
	(54, 1, 'Soy Eufrasio y quiero ser informático.', 13141516, 'SIN APROBAR'),
	(55, 2, 'Quiero extender mis conocimientos de inglés.', 13141516, 'SIN APROBAR'),
	(56, 3, 'Me interesa este curso', 13141517, 'RECHAZADA');";

  mysqli_query($con, $insert_solicitud);

$insert_unidad = "REPLACE INTO `for_unidad` (`id_unidad`, `id_curso`, `duracion_horas`, `nombre_unidad`, `porcentaje_curso`) VALUES
	(1, 1, 60, 'Ofimática', 40),
	(2, 1, 120, 'HTML y CSS', 60),
	(3, 2, 260, 'Speaking intensivo', 100),
	(4, 3, 300, 'Estudio de mercado', 100),
	(5, 4, 200, 'Comunicación oral', 80),
	(6, 4, 5, 'Charlas', 20);";

  mysqli_query($con, $insert_unidad);

$insert_empleado = "REPLACE INTO `gen_empleados` (`id_empleado`, `nombre`, `apellidos`, `fecha_nac`, `fecha_inc`, `usuario`, `contrasena`, `curriculum`, `foto`) VALUES
	(13141516, 'Eufrasio', 'Tomelloso Martínez', '1975-03-02', '2000-03-02', 'eufrasio', 'eufrasio', NULL, NULL),
	(13141517, 'Federico', 'García Maldonado', '1980-03-02', '2000-03-02', 'federico', 'federico', NULL, NULL);";

  mysqli_query($con, $insert_empleado);


echo "<p>Transacción finalizada.</p>";

rename ( "instalacion.php", "for" );
