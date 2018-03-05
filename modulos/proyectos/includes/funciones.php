<?php
require_once '../../../clases/config.php';
require_once '../../../clases/claseHerramientas.php';
require_once '../../../clases/claseTabla.php';

$herramientas = new Herramientas();
$PATH_MODULO_PROYECTOS = "./modulos/proyectos/";

// Obvio
function bonita_variable($variable, $echo = true) {
    $a =  "<pre>".var_export($variable, true)."</pre>";
    if ($echo) echo $a;
    else return $a;

    return true;
}

// Función comprobar login
function comprobar_login($usuario, $contrasena){
    try {
        $tabla = new Tabla("gen_empleados");
        $conexion = $tabla->conectar();

        /*$sql = "select contrasena from gen_empleados where usuario like ?";
        $stmt = $conectar->prepare($sql);
        $stmt->bind_param("s", $usuario);
        $stmt->bind_result($pass);
        $stmt->next_result();*/
        // TODO: Ver por qué hostias no funciona con prepare
        $usuario = $conexion->real_escape_string($usuario);
        $rs = $conexion->query("select contrasena from gen_empleados where usuario like '".$usuario."'");
        $result = $rs->fetch_array();
        if ( isset($result['contrasena']) ) {
            $pass = $result['contrasena'];

            return password_verify($contrasena, $pass);
        }

        return 1;
    } catch (Exception $e) {
        return 0;
    }
}

/**
 * @param Tabla $tabla Tabla a leer
 * @param array $params Parámetros a utlizar en la query. Tanto ID como filtros.
 * @param boolean $only_data Solo se quieren los datos
 * @param boolean $single_value Solo va a devolver un valor. Solo funciona si se pasa true a $only_data
 * @return array|bool|object Array con los datos, false si se produce un problema
 */
function query(Tabla $tabla, $params = array(), $only_data = false, $single_value = false) {
    try {
        // Para versiones inferiores de PHP 7
        if (!($tabla instanceof Tabla)) throw new Exception("El objeto pasado 'tabla' no es un objeto tipo Tabla");

        $params_validos = array("id", "filtros", "order_by", "limit");

        $id = null; $filtros = null; $order_by = null; $limit = null;
        foreach ($params as $key => $value) {
            if ( in_array($key, $params_validos) )
                $$key = $value;
        }

        $conexion = $tabla->conectar();
        $columnas = "";

        $cols = $tabla->obtener_columnas();
        for ($i = 0; $i < count($cols); $i++) {
            $columnas .= $cols[$i];
            if ($i < count($cols)-1) $columnas .= ", ";
        }
        $query = "select ".$columnas." from ".$tabla->get_tabla();

        if (!is_null($id) && is_array($id) && count($id) > 0) {
            $query .= " where ".$tabla->obtener_id();
            if (count($id) == 1)
                $query .= " = " . $conexion->real_escape_string($id[0]);
            else {
                $query .= " in (";
                for ($i = 0; $i < count($id); $i++) {
                    $query .= $conexion->real_escape_string($id[$i]);
                    if ($i < count($id) - 1) $query .= ",";
                }
                $query .= ")";
            }
        }

        if ( $filtros != null && is_array($filtros) ) {
            foreach ($filtros as $key => $filtro) {
                $fs = $filtro;
                if ( is_array($filtro) ) {
                    if ( !in_array($key, $cols) || !isset($fs["op"]) || !isset($fs["val"]) )
                        unset($filtros[$key]);
                }
            }

            if ( !empty($filtros) ) {
                if (!is_null($id) && is_array($id) && count($id) > 0)
                    $query .= " and ";
                else
                    $query .= " where ";

                $i = 0;
                foreach ($filtros as $key => $filtro) {
                    $o = $conexion->real_escape_string($filtro["op"]);
                    $v = "'".$conexion->real_escape_string($filtro["val"])."'";
                    $query .= $key." ".$o." ".$v;
                    if ( $i++ < count($filtros) - 1 ) $query .= " and ";
                }
            }
        }

        if ( $order_by != null ) {
            $query .= " order by " . $order_by;
        }

        if ( $limit != null ) {
        	$query .= " limit ".$limit;
        }

        $datos = array();
        $rs = $conexion->query($query);
        while ($result = $rs->fetch_object()) {
            // Objeto genérico con los datos
            $datos[] = $result;
        }

        $respuesta = array(
            0           => $datos,
            "sql_raw"   => $query,
            "params"    => $params,
            "filtros"   => $filtros
        );

        if ($only_data) {
	        $respuesta = $respuesta[0];
	        if ($single_value)
		        $respuesta = $respuesta[0];
        }

	    return $respuesta;
    } catch (Exception $e) {
        return false;
    }
}

/**
 * @param null $id Array con IDs a filtrar
 * @return array|bool Array con los datos, false si se produce un problema
 */
function obtener_empleados($params = array()) {
    try {
        $tabla = new Tabla("gen_empleados");
        $empleados = query($tabla, $params)[0];
        // Borrar la password del usuario del objeto antes de enviarlo por seguridad
        foreach ($empleados as $key => $empleado) {
            unset($empleado->contrasena);
            $empleados[$key] = $empleado;
        }
        return $empleados;
    }
    catch (TypeError $e) {
        return false;
    }
}

/**
 * Versión simplificada para obtener empleados por sus ids
 * @param array $id
 * @return array|bool|int Empleados buscados, 0 si el parámetro pasado no es un array, false si se produce un problema
 */
function obtener_empleados_ids($id) {
    try {
        if (!is_array($id)) return 0;
        $params = array("id" => $id);
        return obtener_empleados($params);
    }
    catch (TypeError $e) {
        return false;
    }
}

function obtener_tareas_dia($usuario){
    try {
        $tabla = new Tabla("pro_tarea");
        $params = array(
            "filtros" => array(
                "id_empleado" => array(
                    "op" => "=",
                    "value" => $usuario
                )

            ),
            "order_by" => "fecha_fin ASC"
        );
        $tareas = query($tabla, $params)[0];
        return $tareas;
    }
    catch (TypeError $e) {
        return false;
    }
}

function obtener_proyectos($params = array()){
    try{
        $tabla = new Tabla("pro_proyecto");
        $proyectos = query($tabla, $params, true);
        return $proyectos;
    }catch(TypeError $e){
        return false;
    }
}

function _select($query) {
	$respuesta = array();

	$conexion = (new Herramientas())->conectar();
	$result = $conexion->query($query);
	while ($res = $result->fetch_assoc()) {
		$respuesta[] = $res;
	}

	return $respuesta;
}

function obtener_tipos_proyecto(){
	try{
		$tabla = new Tabla("pro_tipo_proyecto");
		$tipos_proy = query($tabla, array(), true);
		return $tipos_proy;
	}catch(TypeError $e){
		return false;
	}
}

function obtener_tipo_proyecto($id) {
	try{
		$tipo_proyecto = array(
			"datos"  => array(),
			"etapas" => array()
		);

		$tProy = new Tabla("pro_tipo_proyecto");
		$tipo_proyecto["datos"] = query($tProy, ["id"=>[$id]], true, true);

		$tEts = new Tabla("pro_tipo_etapa");
		$filtros = ["filtros" => array("id_tipo_proyecto" => ["op"=>"=", "val"=>$id])];
		$etapas = query($tEts, $filtros, true);
		if (count($etapas) > 0) $tipo_proyecto["etapas"] = array();

		foreach ( $etapas as $etapa ) {
			$id_etapa = $etapa->id_tipo_etapa;
			$tipo_proyecto["etapas"][$id_etapa]["datos"] = $etapa;
		}

		$tareas = _select("SELECT t.* from pro_tipo_etapa e, pro_tipo_tarea t where e.id_tipo_proyecto = ".$id." and t.id_tipo_etapa = e.id_tipo_etapa");
		foreach ( $tareas as $tarea ) {
			$id_etapa = $tarea["id_tipo_etapa"];
			$id_tarea = $tarea["id_tipo_tarea"];
			$tipo_proyecto["etapas"][$id_etapa]["tareas"][$id_tarea] = $tarea;
		}

		// Rellenar etapas sin tareas
		foreach ( $tipo_proyecto["etapas"] as $index => $etapa ) {
			if (!isset($etapa["tareas"]) || !is_array($etapa["tareas"]) || count($etapa["tareas"])<0)
				$tipo_proyecto["etapas"][$index]["tareas"] = array();
		}

		return $tipo_proyecto;
	}catch(TypeError $e){
		return false;
	}
}

function obtener_tipo_tareas_proyecto($id) {
	try{
		$query = "SELECT t.* from pro_tipo_etapa e, pro_tipo_tarea t where e.id_tipo_proyecto = ".$id." and t.id_tipo_etapa = e.id_tipo_etapa";
		return _select($query);
	}catch(TypeError $e){
		return false;
	}
}

function obtener_tareas_proyecto($id) {
	try{
		$query = "SELECT t.* from pro_tarea t where t.id_proyecto = ".$id;
		return _select($query);
	}catch(TypeError $e){
		return false;
	}
}

function obtener_proyecto($id) {
    try{
        $proyecto = array(
            "datos"  => array(),
            "etapas" => array()
        );

        $tProy = new Tabla("pro_proyecto");
        $proyecto["datos"] = query($tProy, ["id"=>[$id]], true, true);

        $id_tipo = $proyecto["datos"]->id_tipo_proyecto;

        $tEts = new Tabla("pro_tipo_etapa");
        $filtros = ["filtros" => array("id_tipo_proyecto" => ["op"=>"=", "val"=>$id_tipo])];
        $etapas = query($tEts, $filtros, true);
        if (count($etapas) > 0) $proyecto["etapas"] = array();

        foreach ( $etapas as $etapa ) {
            $id_etapa = $etapa->id_tipo_etapa;
            $proyecto["etapas"][$id_etapa]["datos"] = $etapa;
        }

        $tipo_tareas = array();
        foreach (obtener_tipo_tareas_proyecto($id_tipo) as $tarea) {
            $tipo_tareas[$tarea["id_tipo_tarea"]] = $tarea;
        }

        $tareas = obtener_tareas_proyecto($id);
        foreach ( $tareas as $tarea ) {
            $id_tarea = $tarea["id_tipo_tarea"];
            $id_etapa = $tipo_tareas[$id_tarea]["id_tipo_etapa"];
            $proyecto["etapas"][$id_etapa]["tareas"][$id_tarea] = $tarea;
        }

        // Rellenar etapas sin tareas
        foreach ( $proyecto["etapas"] as $index => $etapa ) {
            if (!isset($etapa["tareas"]) || !is_array($etapa["tareas"]) || count($etapa["tareas"])<0)
                $proyecto["etapas"][$index]["tareas"] = array();
        }

        return $proyecto;
    }catch(TypeError $e){
        return false;
    }
}