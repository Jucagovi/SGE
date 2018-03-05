<?php
define ('SERVIDOR', "localhost");
define ('USUARIO', "root");
define ('CONTRA', "");
define ('BBDD', "sge_proyecto");

function conectar(){
    @$conexion = new mysqli(SERVIDOR,USUARIO,CONTRA,BBDD);
    if($conexion -> connect_errno!=0){
        die('Atencion! Problemas de base de datos, contacte con el administrador');
    }

    return $conexion;
}

function existetabla($tabla){
    $conexion = conectar();
    if($conexion -> query("DESCRIBE $tabla")) {
        $conexion->close();
        return true;
    }else{
        $conexion->close();
        return false;
    }
}

function haydatos($tabla){
    $conexion = conectar();
    $sql = "SELECT COUNT(*) FROM ".$tabla;
    $r = $conexion->query($sql);
    $d = $r->fetch_assoc();
    if($d['COUNT(*)'] > 0){
        $conexion->close();
        return true;
    }else{
        $conexion->close();
        return false;
    }
}

function existeEmpleadoAnonimo(){
    $conexion = conectar();
    $sql = "SELECT COUNT(*) FROM gen_empleados WHERE id_empleado=-1";
    $r = $conexion->query($sql);
    $d = $r->fetch_assoc();
    if($d['COUNT(*)'] > 0){
        $conexion->close();
        return true;
    }else{
        $conexion->close();
        return false;
    }
}

function existeModulo(){
    $conexion = conectar();
    $sql = "SELECT COUNT(*) FROM gen_modulos WHERE nombre LIKE 'Proyectos'";
    $r = $conexion->query($sql);
    $d = $r->fetch_assoc();
    if($d['COUNT(*)'] > 0){
        $conexion->close();
        return true;
    }else{
        $conexion->close();
        return false;
    }
}

function existesSeccionesModulo(){
    $conexion = conectar();
    $sql = "SELECT COUNT(*) FROM gen_secciones WHERE identificador LIKE 'tablonProyectos'
 OR identificador LIKE 'verProyectos' OR identificador LIKE 'verAyudaProyectos' OR identificador LIKE 'herramientas' 
 OR identificador LIKE 'verPresupuestos'";
    $r = $conexion->query($sql);
    $d = $r->fetch_assoc();
    if($d['COUNT(*)'] > 0){
        $conexion->close();
        return true;
    }else{
        $conexion->close();
        return false;
    }
}

function existeSubseccionesModulo(){
    $conexion = conectar();
    $sql = "SELECT COUNT(*) FROM gen_subsecciones WHERE identificador LIKE 'crearTipoProyecto' 
OR identificador LIKE 'crearPresupuesto'";
    $r = $conexion->query($sql);
    $d = $r->fetch_assoc();
    if($d['COUNT(*)'] > 0){
        $conexion->close();
        return true;
    }else{
        $conexion->close();
        return false;
    }
}

function borrarDatos($datoshistorico,$datosproyecto,$datostipoproyecto,$datosetapa,$datostipotarea,
                     $datostarea,$datosjornada,$empleadoAnonimo,$modulo,$secciones,$subsecciones){
    echo "\n<p>-Borrando datos previos-</p>\n";
    $conexion = conectar();
    $conexion->begin_transaction();
    if($datoshistorico){
        if($conexion->query("TRUNCATE TABLE pro_historico") == false) {
            $conexion->rollback();
            throw new Exception("truncate failed: ".$conexion->error);
        }
    }
    if($datosproyecto){
        if($conexion->query("TRUNCATE TABLE pro_proyecto") == false) {
            $conexion->rollback();
            throw new Exception("truncate failed: ".$conexion->error);
        }
    }
    if($datostipoproyecto){
        if($conexion->query("TRUNCATE TABLE pro_tipo_proyecto") == false) {
            $conexion->rollback();
            throw new Exception("truncate failed: ".$conexion->error);
        }
    }
    if($datosetapa){
        if($conexion->query("TRUNCATE TABLE pro_tipo_etapa") == false) {
            $conexion->rollback();
            throw new Exception("truncate failed: ".$conexion->error);
        }
    }
    if($datostipotarea){
        if($conexion->query("TRUNCATE TABLE pro_tipo_tarea") == false) {
            $conexion->rollback();
            throw new Exception("truncate failed: ".$conexion->error);
        }
    }
    if($datostarea){
        if($conexion->query("TRUNCATE TABLE pro_tarea") == false) {
            $conexion->rollback();
            throw new Exception("truncate failed: ".$conexion->error);
        }
    }
    if($datosjornada){
        if($conexion->query("TRUNCATE TABLE pro_jornada") == false) {
            $conexion->rollback();
            throw new Exception("truncate failed: ".$conexion->error);
        }
    }
    //datos en tablas generales
    if($empleadoAnonimo){
        if($conexion->query("DELETE FROM gen_empleados WHERE id_empleado=-1") == false) {
            $conexion->rollback();
            throw new Exception("delete failed: ".$conexion->error);
        }
    }
    if($modulo){
        if($conexion->query("DELETE FROM gen_modulos WHERE nombre LIKE 'Proyectos'") == false) {
            $conexion->rollback();
            throw new Exception("delete failed: ".$conexion->error);
        }
        if($secciones){
            if($conexion->query("DELETE FROM gen_secciones WHERE identificador LIKE 'tablonProyectos' OR identificador LIKE 'verProyectos' OR identificador LIKE 'verAyudaProyectos' OR identificador LIKE 'herramientas' OR identificador LIKE 'verPresupuestos'") == false) {
                $conexion->rollback();
                throw new Exception("delete failed: ".$conexion->error);
            }
            if($subsecciones){
                if($conexion->query("DELETE FROM gen_subsecciones WHERE identificador LIKE 'crearTipoProyecto' OR identificador LIKE 'crearPresupuesto'") == false) {
                    $conexion->rollback();
                    throw new Exception("delete failed: ".$conexion->error);
                }
            }
        }
    }
    $conexion->commit();
    $conexion->close();
    echo "\n<p>-Fin de borrado-</p>\n";
}

function crearTablas(){
    echo "\n<p>-Creando tablas necesarias.-</p>\n";
    $sqlhistorico = "CREATE TABLE IF NOT EXISTS pro_historico (
  id_historico int(11) NOT NULL AUTO_INCREMENT,
  accion text COLLATE latin1_general_ci NOT NULL,
  fecha date NOT NULL,
  id_empleado int(11) NOT NULL COMMENT 'empleado que realizo la accion',
  PRIMARY KEY (id_historico))";

    $sqlproyecto = "CREATE TABLE IF NOT EXISTS pro_proyecto (
  id_proyecto int(11) NOT NULL AUTO_INCREMENT,
  nombre varchar(100) COLLATE latin1_general_ci NOT NULL,
  descripcion text COLLATE latin1_general_ci,
  responsables text COLLATE latin1_general_ci NOT NULL,
  fecha_fin date DEFAULT NULL,
  coste decimal(15,5) NOT NULL,
  iva decimal(15,5) NOT NULL,
  descuento decimal(15,5) NOT NULL,
  estado varchar(100) COLLATE latin1_general_ci NOT NULL,
  imagen varchar(200) COLLATE latin1_general_ci NOT NULL,
  id_tipo_proyecto int(11) NOT NULL,
  PRIMARY KEY (id_proyecto)
)";

    $sqltipoproyecto = "CREATE TABLE IF NOT EXISTS pro_tipo_proyecto (
  id_tipo_proyecto int(11) NOT NULL AUTO_INCREMENT,
  nombre varchar(100) COLLATE latin1_general_ci NOT NULL,
  descripcion text COLLATE latin1_general_ci,
  imagen varchar(200) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (id_tipo_proyecto)
)";

    $sqljornada = "CREATE TABLE IF NOT EXISTS pro_jornada (
  id_jornada int(11) NOT NULL AUTO_INCREMENT,
  fecha date NOT NULL,
  horas decimal(15,5) NOT NULL,
  id_tarea int(11) NOT NULL,
  PRIMARY KEY (id_jornada)
)";

    $sqltarea = "CREATE TABLE IF NOT EXISTS pro_tarea (
  id_tarea int(11) NOT NULL AUTO_INCREMENT,
  nombre varchar(100) COLLATE latin1_general_ci NOT NULL,
  descripcion text COLLATE latin1_general_ci,
  horas_presupuestadas decimal(15,5) NOT NULL,
  fecha_fin date DEFAULT NULL,
  ficheros text CHARACTER SET latin1 COLLATE latin1_general_cs,
  id_tipo_tarea int(11) NOT NULL,
  id_empleado int(11) NOT NULL,
  id_proyecto int(11) NOT NULL,
  PRIMARY KEY (id_tarea)
)";

    $sqltipoetapa = "CREATE TABLE IF NOT EXISTS pro_tipo_etapa (
  id_tipo_etapa int(11) NOT NULL AUTO_INCREMENT,
  nombre varchar(100) COLLATE latin1_general_ci NOT NULL,
  descripcion text COLLATE latin1_general_ci,
  id_tipo_proyecto int(11) NOT NULL,
  PRIMARY KEY (id_tipo_etapa)
)";

    $sqltipotarea = "CREATE TABLE IF NOT EXISTS pro_tipo_tarea (
  id_tipo_tarea int(11) NOT NULL AUTO_INCREMENT,
  nombre varchar(100) COLLATE latin1_general_ci NOT NULL,
  descripcion text COLLATE latin1_general_ci,
  precio decimal(15,5) NOT NULL,
  id_tipo_etapa int(11) NOT NULL,
  PRIMARY KEY (id_tipo_tarea)
)";

    $conexion = conectar();
    $conexion->begin_transaction();
    if($conexion->query($sqlhistorico) == false) {
        $conexion->rollback();
        throw new Exception("Creation failed: ".$conexion->error);
    }elseif ($conexion->query($sqlproyecto) == false){
        $conexion->rollback();
        throw new Exception("Creation failed: ".$conexion->error);
    }elseif ($conexion->query($sqltipoproyecto) == false){
        $conexion->rollback();
        throw new Exception("Creation failed: ".$conexion->error);
    }elseif ($conexion->query($sqljornada) == false){
        $conexion->rollback();
        throw new Exception("Creation failed: ".$conexion->error);
    }elseif ($conexion->query($sqltarea) == false){
        $conexion->rollback();
        throw new Exception("Creation failed: ".$conexion->error);
    }elseif ($conexion->query($sqltipoetapa) == false){
        $conexion->rollback();
        throw new Exception("Creation failed: ".$conexion->error);
    }elseif ($conexion->query($sqltipotarea) == false){
        $conexion->rollback();
        throw new Exception("Creation failed: ".$conexion->error);
    }
    $conexion->commit();
    $conexion->close();
    echo "\n<p>-Fin creacion tablas.-</p>\n";
}

function insertarDatosRequeridos(){
    echo "\n<p>-Insertando datos requeridos.-</p>\n";
    $conexion = conectar();
    $conexion->set_charset("latin1_general_ci");
    $conexion->begin_transaction();

    $sqlinsertarempleado = "INSERT INTO gen_empleados
(id_empleado, nombre, apellidos, fecha_nac, fecha_inc, usuario, contrasena, curriculum, foto, id_departamento) 
VALUES ('-1', 'Anonimo', '', '2018-03-01', '2018-03-01', '', '', NULL, NULL, NULL)";
    if($conexion->query($sqlinsertarempleado) == false) {
        $conexion->rollback();
        throw new Exception("Insert failed: ".$conexion->error);
    }
    $sqlinsertarmodulo = "INSERT INTO gen_modulos (nombre, descripcion, orden) VALUES ('Proyectos', NULL, 1)";
    if ($conexion->query($sqlinsertarmodulo) == false){
        $conexion->rollback();
        throw new Exception("Insert failed: ".$conexion->error);
    }
    $idModulo = $conexion->insert_id;
    $sqlsecc1 = "INSERT INTO gen_secciones (nombre, descripcion, permiso, orden, id_modulo, identificador)
 VALUES ('Inicio', 'Ver el tablón del módulo', 0, 1, ".$idModulo.", 'tablonProyectos')";
    if ($conexion->query($sqlsecc1) == false){
        $conexion->rollback();
        throw new Exception("Insert failed: ".$conexion->error);
    }
    $sqlsecc2 = "INSERT INTO gen_secciones (nombre, descripcion, permiso, orden, id_modulo, identificador)
 VALUES ('Proyectos', 'Ver los proyectos', 0, 1, ".$idModulo.", 'verProyectos')";
    if ($conexion->query($sqlsecc2) == false){
        $conexion->rollback();
        throw new Exception("Insert failed: ".$conexion->error);
    }
    $sqlsecc3 = "INSERT INTO gen_secciones (nombre, descripcion, permiso, orden, id_modulo, identificador)
 VALUES ('Presupuestos', 'Ver los presupuestos', 0, 1, ".$idModulo.", 'verPresupuestos')";
    if ($conexion->query($sqlsecc3) == false){
        $conexion->rollback();
        throw new Exception("Insert failed: ".$conexion->error);
    }
    $sqlsecc4 = "INSERT INTO gen_secciones (nombre, descripcion, permiso, orden, id_modulo, identificador)
 VALUES ('Herramientas', 'Herramientas del módulo', 0, 1, ".$idModulo.", 'herramientas')";
    if ($conexion->query($sqlsecc4) == false){
        $conexion->rollback();
        throw new Exception("Insert failed: ".$conexion->error);
    }
    $idseccionherramientas = $conexion->insert_id;
    $sqlsubsecc1 = "INSERT INTO gen_subsecciones ( nombre, descripcion, permiso, orden, id_seccion, identificador)
 VALUES ('Crear tipo de proyecto', 'Herramienta de generación de tipos de proyecto', 0, 1, ".$idseccionherramientas.", 'crearTipoProyecto')";
    if ($conexion->query($sqlsubsecc1) == false){
        $conexion->rollback();
        throw new Exception("Insert failed: ".$conexion->error);
    }
    $sqlsubsecc2 = "INSERT INTO gen_subsecciones ( nombre, descripcion, permiso, orden, id_seccion, identificador)
 VALUES ('Crear presupuesto', 'Herramienta para crear un presupuesto', 0, 2, ".$idseccionherramientas.", 'crearPresupuesto')";
    if ($conexion->query($sqlsubsecc2) == false){
        $conexion->rollback();
        throw new Exception("Insert failed: ".$conexion->error);
    }
    $sqlsecc5 = "INSERT INTO gen_secciones (nombre, descripcion, permiso, orden, id_modulo, identificador)
 VALUES ('Ayuda', NULL, 0, 1, ".$idModulo.", 'verAyudaProyectos')";
    if ($conexion->query($sqlsecc5) == false){
        $conexion->rollback();
        throw new Exception("Insert failed: ".$conexion->error);
    }
    $inserttipoproyecto = "INSERT INTO pro_tipo_proyecto (nombre, descripcion, imagen)
 VALUES ('Desarrollo Software', 'La empresa llevará a cabo un desarrollo de software', 'desarrollo_software.png')";
    if ($conexion->query($inserttipoproyecto) == false){
        $conexion->rollback();
        throw new Exception("Insert failed: ".$conexion->error);
    }
    $idtipoproyecto = $conexion->insert_id;
    $datostipoetapa = array(
        array('Especificación de los requerimientos','Se concretaran todos los requerimientos para la correcta elaboración del software.'),
        array('Diseño', 'Se llevará a cabo el apartado de diseño del software.',),
        array('Implementación', 'Comenzará la implementación del software.'),
        array('Integración', 'Comenzaran las pruebas de forma individual de todos los módulos'),
        array('Validación y Verificación', 'Se llevarán a cabo pruebas más concretas al software en busca de posibles errores.'),
        array('Mantenimiento', 'Una vez finalizado el software, se llevará a cabo un mantemiento del mismo.'));
    $idstipoetapa = [];
    $sqlinsertartipoetapa = "INSERT INTO pro_tipo_etapa ( nombre, descripcion, id_tipo_proyecto)
 VALUES (?, ?, ?)";
    $preparadatipoetapa = $conexion->prepare($sqlinsertartipoetapa);
    foreach ($datostipoetapa as $datos){
        $preparadatipoetapa->bind_param("ssi",$datos[0],$datos[1],$idtipoproyecto);
        if ($preparadatipoetapa->execute() == false){
            $conexion->rollback();
            throw new Exception("Insert failed: ".$conexion->error);
        }
        $idstipoetapa[]=$conexion->insert_id;
    }
    $preparadatipoetapa->close();
    $datostipotarea = array(
        array('Entrevista con el cliente', 'Se llevará a cabo una entrevista con el cliente para conocer sus requisitos.', 30, 0),
        array ('Análisis del entorno de implantación', 'Se hará un estudio del entorno donde se va a desarrollar la aplicación', 100, 0),
        array ('Programación de Fases', 'Se realizará el programa a seguir para el correcto desarrollo del software', 50, 0),
        array ('Asignación de tareas', 'Se asignará a toda la plantilla las tareas que deberá realizar', 45, 0),
        array ('Diagrama de clases', 'Se creará el diagrama de clases para planificar el proyecto.', 47, 1),
        array ('Diagrama Entidad Relación', 'Se creará el diagrama entidad/relación de la base de datos a utilizar en el proyecto.', 150, 1),
        array ('División de subsistemas', 'Se realiza la división de subsistemas.', 70, 1),
        array ('Calendario de aplicación', 'Se organizará el calendario a seguir para la elaboración del proyecto.', 30, 1),
        array ('Creación de la base de datos', 'Se creará la base de datos para el proyecto.', 15, 2),
        array ('Inserción de datos', 'Se insertaran en la base de datos los valores necesarios.', 10, 2),
        array ('Conversión de datos previos', 'Se hará la conversión de datos previos.', 10, 2),
        array ('Programación', 'Se realizará toda la programación del software.', 25, 2),
        array ('Pruebas unitarias por módulo', 'Se llevarán a cabo pruebas de forma individual de cada módulo', 10, 3),
        array ('Unión de los subsistemas', 'Se unirán todos los subsistemas.', 10, 3),
        array ('Pruebas de interfaz', 'Se llevarán a cabo pruebas de la interfaz gráfica del software.', 5, 4),
        array ('Pruebas en conjunto alfa', 'Se llevarán a cabo pruebas en fase alfa', 10, 4),
        array ('Pruebas beta', 'Se llevarán a cabo pruebas en versión beta', 10, 4),
        array ('Modificación de software', 'Se llevarán a cabo modificaciones que puedan ser necesarias.', 20, 5),
        array ('Asistencia', 'Labores de asistencia para la empresa.', 15, 5),
        array ('Formación', 'Se formará a la empresa en el software desarrollado.', 20, 5),
        array ('Periodo de garantía', 'Periodo de garantía dado a la empresa contratante.', 5, 5)
    );
    $sqlinsertartipotarea = "INSERT INTO pro_tipo_tarea (nombre, descripcion, precio, id_tipo_etapa) VALUES (?, ?, ?, ?)";
    $preparadatipotarea = $conexion->prepare($sqlinsertartipotarea);
    foreach ($datostipotarea as $datostarea){
        $n = $datostarea[3];
        $preparadatipotarea->bind_param("ssdi",$datostarea[0],$datostarea[1],
            $datostarea[2],$idstipoetapa[$n]);
        if ($preparadatipotarea->execute() == false){
            $conexion->rollback();
            throw new Exception("Insert failed: ".$conexion->error);
        }
    }
    $preparadatipotarea->close();
    $conexion->commit();
    $conexion->close();
    echo "\n<p>-Fin insercion de datos requeridos.-</p>\n";
}

$historico = existetabla("pro_historico");
$datoshistorico = $historico?haydatos("pro_historico"):false;

$proyecto = existetabla("pro_proyecto");
$datosproyecto = $proyecto?haydatos("pro_proyecto"):false;

$tipoproyecto = existetabla("pro_tipo_proyecto");
$datostipoproyecto = $tipoproyecto?haydatos("pro_tipo_proyecto"):false;

$etapa = existetabla("pro_tipo_etapa");
$datosetapa = $etapa?haydatos("pro_tipo_etapa"):false;

$tipotarea = existetabla("pro_tipo_tarea");
$datostipotarea = $tipotarea?haydatos("pro_tipo_tarea"):false;

$tarea = existetabla("pro_tarea");
$datostarea = $tarea?haydatos("pro_tarea"):false;

$jornada = existetabla("pro_jornada");
$datosjornada = $jornada?haydatos("pro_jornada"):false;

$empleadoAnonimo= existeEmpleadoAnonimo();
$modulo = existeModulo();
$secciones=false;
$subsecciones=false;
if($modulo){
    $secciones=existesSeccionesModulo();
    if($secciones){
        $subsecciones=existeSubseccionesModulo();
    }
}

$p = $_POST;
if(isset($p["instalar"])){
    //var_dump($p);
    $insertarRequeridos = true;
    if(isset($p["borrar_datos_previos"]) && $p["borrar_datos_previos"] === "on"){
        borrarDatos($datoshistorico,$datosproyecto,$datostipoproyecto,$datosetapa,$datostipotarea,
            $datostarea,$datosjornada,$empleadoAnonimo,$modulo,$secciones,$subsecciones);
    }
    crearTablas();
    $tipoproyecto = existetabla("pro_tipo_proyecto");
    $datostipoproyecto = $tipoproyecto?haydatos("pro_tipo_proyecto"):false;
    if(!$datostipoproyecto) insertarDatosRequeridos();
    if(isset($p["datos_de_prueba"]) && $p["datos_de_prueba"] === "on"){
        echo "\n<p>Hola, soy Julio, son las 3 de la mañana del sabado, llevo programando 11/16 horas, no puedo más, no hay datos de prueba.</p>\n";
    }
    echo "\n<p>-Fin instalacion-\n</p>";
}else{
    ?>
    <div style="margin: 1%">
        <form action="instalador.php" method="post">
            <?php
            $hidden = true;
            if ($datoshistorico || $datosproyecto || $datostipoproyecto || $datosetapa || $datostipotarea
                || $datostarea || $datosjornada || $empleadoAnonimo || $modulo || $secciones || $subsecciones){
                $hidden = false;
                ?>
            <p style="color: red">Se han detectado datos previos.</p>
                <?php
            }
            ?>
            <label <?php if ($hidden) echo "hidden"?>>
                Borrar datos previos :
                <input type="checkbox" name="borrar_datos_previos">
            </label>
            <br>
            <br>
            <label>
                Insertar datos de prueba :
                <input type="checkbox" name="datos_de_prueba">
            </label>
            <br>
            <br>
            <input type="submit" name="instalar" value="Comenzar instalación">
        </form>
    </div>
    <?php
}