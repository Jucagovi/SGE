<?php

include_once '../../clases/config.php';
include_once '../../clases/claseHerramientas.php';

$ausencia = "CREATE TABLE IF NOT EXISTS `rrhh_ausencia` (
  `id_empleado` int(15) NOT NULL,
  `id_tipo_ausencia` int(15) NOT NULL,
  `id_estado_tramite` int(15) NOT NULL,
  `fecha_solicitud` date NOT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `duracion` int(3) DEFAULT NULL,
  `descripcion` text,
  KEY `id_ausencia` (`id_tipo_ausencia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8";

$candidato = "CREATE TABLE IF NOT EXISTS `rrhh_candidato` (
  `id_candidato` int(15) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `fecha_nac` date NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `curriculum` varchar(300) DEFAULT NULL,
  `nota_interna` text,
  `descripcion` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8";

$candidato_proceso_seleccion="CREATE TABLE IF NOT EXISTS `rrhh_candidato_proceso_seleccion` (
  `id_cps` int(11) NOT NULL,
  `id_candidato` int(15) NOT NULL,
  `id_proceso_seleccion` int(15) NOT NULL,
  `id_estado_proceso` int(15) NOT NULL,
  `descripcion` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8";

$departamento="CREATE TABLE IF NOT EXISTS `rrhh_departamento` (
  `id_departamento` int(15) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `fecha_creacion` date NOT NULL,
  `localizacion` text,
  `responsable` int(15) DEFAULT NULL,
  `descripcion` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8";

$estado_proceso="CREATE TABLE IF NOT EXISTS `rrhh_estado_proceso` (
  `id_estado_proceso` int(15) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8";

$estado_tramite="CREATE TABLE IF NOT EXISTS `rrhh_estado_tramite` (
  `id_estado_tramite` int(15) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` text,
  KEY `id_estado_tramite` (`id_estado_tramite`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8";

$etapa_proceso = "CREATE TABLE IF NOT EXISTS `rrhh_etapa_proceso` (
  `id_etapa_proceso` int(15) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8";

$historico = "CREATE TABLE IF NOT EXISTS `rrhh_historico` (
  `id_departamento` int(15) NOT NULL,
  `id_empleado` int(15) NOT NULL,
  `fecha` date DEFAULT NULL,
  `descripcion` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8";

$proceso_seleccion="CREATE TABLE IF NOT EXISTS `rrhh_proceso_seleccion` (
  `id_proceso_seleccion` int(15) NOT NULL,
  `id_departamento` int(15) NOT NULL,
  `id_etapa_proceso` int(15) NOT NULL,
  `id_estado_proceso` int(15) NOT NULL,
  `fecha_creacion` date NOT NULL,
  `puesto` varchar(50) NOT NULL,
  `numero_plazas` int(5) DEFAULT NULL,
  `descripcion` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8";

$tipo_ausencia="CREATE TABLE IF NOT EXISTS `rrhh_tipo_ausencia` (
  `id_tipo_ausencia` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `duracion_maxima` int(11) DEFAULT NULL,
  `descripcion` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8";

$emp = new Herramientas();
$con = $emp->conectar();

$array = array($ausencia, $candidato, $candidato_proceso_seleccion, $departamento, $estado_proceso, $estado_tramite, $etapa_proceso, $historico, $proceso_seleccion, $tipo_ausencia);

echo "<p>Empieza la transacción</p>";
mysqli_begin_transaction($con, MYSQLI_TRANS_START_READ_WRITE);

echo "<p>Creando tablas...</p>";
foreach ($array as $tabla) {
    mysqli_query($con, $tabla);
}
echo "<p>Tablas creadas.</p>";


echo "<p>Creando módulo...</p>";

$mod_rrhh = "INSERT INTO `gen_modulos` "
        . "(`nombre`, `descripcion`, `orden`)"
        . " SELECT 'RRHH', 'Gestiona Recursos Humanos.', '2' AS tmp"
        . " WHERE NOT EXISTS (SELECT nombre FROM gen_modulos WHERE nombre = 'RRHH') LIMIT 1";

        mysqli_query($con, $mod_rrhh);
        $mod = mysqli_insert_id($con);

        echo "<p>Módulo creado.</p>";



        echo "<p>Creando secciones y subsecciones...</p>";
$sec_administracion = "INSERT INTO `gen_secciones` "
                . "(`nombre`, `descripcion`, `permiso`, `orden`, `id_modulo`, `identificador`)"
                . " SELECT 'Administración de Departamentos', 'Gestión de departamento', '0', '1', '$mod', 'administracionDepartamentos' AS tmp"
                . " WHERE NOT EXISTS (SELECT nombre FROM gen_secciones WHERE nombre = 'Administración de Departamentos') LIMIT 1";

  $sec_gestion = "INSERT INTO `gen_secciones` "
          . "(`nombre`, `descripcion`, `permiso`, `orden`, `id_modulo`, `identificador`)"
          . " SELECT 'Gestión de Procesos de Seleccion', 'Gestión de procesos de seleccion', '0', '2', '$mod', 'gestionProcesosSeleccion' AS tmp"
      . " WHERE NOT EXISTS (SELECT nombre FROM gen_secciones WHERE nombre = 'Gestión de Procesos de Seleccion') LIMIT 1";

    $sec_ausencias = "INSERT INTO `gen_secciones` "
              . "(`nombre`, `descripcion`, `permiso`, `orden`, `id_modulo`, `identificador`)"
              . " SELECT 'Gestión de Ausencias', 'Gestión de ausencias', '0', '3', '$mod', 'gestionAusencias' AS tmp"
          . " WHERE NOT EXISTS (SELECT nombre FROM gen_secciones WHERE nombre = 'Gestión de Ausencias') LIMIT 1";

  mysqli_query($con, $sec_administracion);
    $admin = mysqli_insert_id($con);

    $sub_admDep = "INSERT INTO `gen_subsecciones` "
            . "(`nombre`, `descripcion`, `permiso`, `orden`, `id_seccion`, `identificador`)"
            . " SELECT 'Administracion de Departamentos', NULL, '0', '1', '$admin', 'administracionDepartamentos' AS tmp"
            . " WHERE NOT EXISTS (SELECT nombre FROM gen_subsecciones WHERE nombre = 'Administracion de Departamentos') LIMIT 1";

    $sub_cmbPer = "INSERT INTO `gen_subsecciones` "
            . "(`nombre`, `descripcion`, `permiso`, `orden`, `id_seccion`, `identificador`)"
            . " SELECT 'Cambio de Personal', NULL, '0', '2', '$admin', 'cambioPersonal' AS tmp"
            . " WHERE NOT EXISTS (SELECT nombre FROM gen_subsecciones WHERE nombre = 'Cambio de Personal') LIMIT 1";

            $sub_hist = "INSERT INTO `gen_subsecciones` "
                    . "(`nombre`, `descripcion`, `permiso`, `orden`, `id_seccion`, `identificador`)"
                    . " SELECT 'Histórico', NULL, '0', '3', '$admin', 'historico' AS tmp"
                    . " WHERE NOT EXISTS (SELECT nombre FROM gen_subsecciones WHERE nombre = 'Histórico') LIMIT 1";


    mysqli_query($con, $sub_admDep);
    mysqli_query($con, $sub_cmbPer);
    mysqli_query($con, $sub_hist);

    mysqli_query($con, $sec_gestion );
    $eve = mysqli_insert_id($con);
    $sub_admPr = "INSERT INTO `gen_subsecciones` "
            . "(`nombre`, `descripcion`, `permiso`, `orden`, `id_seccion`, `identificador`)"
            . " SELECT 'Administracion de Proceso de Seleccion', NULL, '0', '1', '$eve', 'administracionProcesoSeleccion' AS tmp"
            . " WHERE NOT EXISTS (SELECT nombre FROM gen_subsecciones WHERE nombre = 'Administracion de Proceso de Seleccion') LIMIT 1";

      $sub_crePrc = "INSERT INTO `gen_subsecciones` "
                    . "(`nombre`, `descripcion`, `permiso`, `orden`, `id_seccion`, `identificador`)"
                    . " SELECT 'Creacion de Proceso de Seleccion', NULL, '0', '2', '$eve', 'creacionProcesoSeleccion' AS tmp"
                    . " WHERE NOT EXISTS (SELECT nombre FROM gen_subsecciones WHERE nombre = 'Creacion de Proceso de Seleccion') LIMIT 1";

    mysqli_query($con, $sub_admPr);
    mysqli_query($con, $sub_crePrc);


    mysqli_query($con, $sec_ausencias);
    $mens = mysqli_insert_id($con);

    $sub_notAus = "INSERT INTO `gen_subsecciones` "
            . "(`nombre`, `descripcion`, `permiso`, `orden`, `id_seccion`, `identificador`)"
            . " SELECT 'Notificaciones de Ausencias', NULL, '0', '1', '$mens', 'notificacionesAusencias' AS tmp"
            . " WHERE NOT EXISTS (SELECT nombre FROM gen_subsecciones WHERE nombre = 'Notificaciones de Ausencias') LIMIT 1";

            $sub_aus = "INSERT INTO `gen_subsecciones` "
                    . "(`nombre`, `descripcion`, `permiso`, `orden`, `id_seccion`, `identificador`)"
                    . " SELECT 'Ausencias', NULL, '0', '2', '$mens', 'ausencias' AS tmp"
                    . " WHERE NOT EXISTS (SELECT nombre FROM gen_subsecciones WHERE nombre = 'Ausencias') LIMIT 1";

    $sub_solAus = "INSERT INTO `gen_subsecciones` "
                      . "(`nombre`, `descripcion`, `permiso`, `orden`, `id_seccion`, `identificador`)"
                  . " SELECT 'Solicitar Ausencias', NULL, '0', '3', '$mens', 'solicitarAusencias' AS tmp"
              . " WHERE NOT EXISTS (SELECT nombre FROM gen_subsecciones WHERE nombre = 'Solicitar Ausencias') LIMIT 1";

                  $sub_cal = "INSERT INTO `gen_subsecciones` "
                                . "(`nombre`, `descripcion`, `permiso`, `orden`, `id_seccion`, `identificador`)"
                  . " SELECT 'Calendario', NULL, '0', '4', '$mens', 'calendario' AS tmp"
                              . " WHERE NOT EXISTS (SELECT nombre FROM gen_subsecciones WHERE nombre = 'Calendario') LIMIT 1";

                $sub_conf = "INSERT INTO `gen_subsecciones` "
                              . "(`nombre`, `descripcion`, `permiso`, `orden`, `id_seccion`, `identificador`)"
                              . " SELECT 'Configuracion', NULL, '0', '5', '$mens', 'configuracion' AS tmp"
                          . " WHERE NOT EXISTS (SELECT nombre FROM gen_subsecciones WHERE nombre = 'Configuracion') LIMIT 1";

mysqli_query($con, $sub_notAus);
mysqli_query($con, $sub_aus);
mysqli_query($con,   $sub_solAus);
mysqli_query($con,   $sub_cal);
mysqli_query($con,   $sub_conf);

echo "<p>Secciones y subsecciones creadas.</p>";

mysqli_commit($con);

echo "<p>Transacción finalizada.</p>";
echo "<p>Realizando introduccion de datos.</p>";


$insert_empleados="REPLACE INTO `gen_empleados` (`id_empleado`, `nombre`, `apellidos`, `fecha_nac`, `fecha_inc`, `usuario`, `contrasena`, `curriculum`, `foto`, `id_departamento`, `nif`) VALUES
(180, 'Jorge Nombre', 'Jorge Apellidos', '2018-01-28', '2018-02-28', 'Jorge Usuario', 'Jorge Contraseña', 'Jorge Curriculum', 'Jorge Foto', 180, '654654'),
(150, 'Manuel Alejandro', 'Ruiz Hernandez', '2018-01-12', '2018-02-08', 'Nellex', '988788', 'Alex Curriculum', 'Alex Foto', 180, '456456');";
mysqli_query($con, $insert_empleados);

$insert_dep="INSERT INTO `rrhh_departamento`(`id_departamento`, `nombre`, `fecha_creacion`, `localizacion`, `responsable`, `descripcion`) VALUES
(180,'Recursos Humanos','2018-02-12','Alicante',150,'Departamento Recursos Humanos')";
mysqli_query($con, $insert_dep);

$insert_historico="REPLACE INTO `rrhh_historico` (`id_departamento`, `id_empleado`, `fecha`, `descripcion`) VALUES
 	(180, 180, '2018-03-03', NULL),
 	(180, 150, '2018-03-03', NULL);";

$insert_candidatos="REPLACE INTO `rrhh_candidato` (`id_candidato`, `nombre`, `apellidos`, `fecha_nac`, `telefono`, `foto`, `curriculum`, `nota_interna`, `descripcion`) VALUES
	(9, 'Juan Francisco', 'Jimenez', '2018-03-02', '987654321', 'Foto 1', 'Curriculum Juan', 'Gran actitud', 'Buena presentacion'),
	(10, 'Jose', 'Alberti', '2018-03-02', '987654321', 'Foto 2', 'Curriculum Jose', 'Candidato Interesante', 'Buena base para el puesto');";
mysqli_query($con, $insert_candidatos);

$insert_procesoselec="REPLACE INTO `rrhh_proceso_seleccion` (`id_proceso_seleccion`, `id_departamento`, `id_etapa_proceso`, `id_estado_proceso`, `fecha_creacion`, `puesto`, `numero_plazas`, `descripcion`) VALUES
 	(1, 180, 1, 1, '2018-03-02', 'Instructor', 2, 'Puesto de Instructor');";
mysqli_query($con, $insert_procesoselec);

$insert_cps = "REPLACE INTO `rrhh_candidato_proceso_seleccion` (`id_cps`, `id_candidato`, `id_proceso_seleccion`, `id_estado_proceso`, `descripcion`) VALUES
	(1, 9, 1, 1, 'Descripcion'),
	(2, 10, 1, 1, 'Descripcion');";
mysqli_query($con, $insert_cps);

$insert_estadopro="REPLACE INTO `rrhh_estado_proceso` (`id_estado_proceso`, `nombre`, `descripcion`) VALUES
	(1, 'Entrevistado', 'Se ha realizado la entrevista'),
	(2, 'Preseleccionado', 'Se ha añadido al proceso'),
	(3, 'Seleccionado', 'Se ha seleccionado para el trabajo'),
	(4, 'Descartado', 'Se ha descartado para el trabajo');";
mysqli_query($con, $insert_estadopro);

$insert_estadotra="REPLACE INTO `rrhh_estado_tramite` (`id_estado_tramite`, `nombre`, `descripcion`) VALUES
  	(1, 'Tramite', 'Se esta valorando'),
  	(2, 'Confirmado', 'Se confirma'),
  	(3, 'Denegada', 'Peticion denegada');";
mysqli_query($con, $insert_estadotra);

$insert_etapapro = "REPLACE INTO `rrhh_etapa_proceso` (`id_etapa_proceso`, `nombre`, `descripcion`) VALUES
      	(1, 'Inicial', NULL),
      	(2, 'Entrevista', NULL),
      	(3, 'Preseleccionado', NULL),
      	(4, 'Seleccionado', NULL),
      	(5, 'Cerrado', NULL);";
mysqli_query($con, $insert_etapapro);


mysqli_query($con, $insert_historico);






//rename("instalar.php", "".$timestamp = time());
