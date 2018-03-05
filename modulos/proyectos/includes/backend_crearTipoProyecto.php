<?php

if (!isset($_REQUEST) || empty($_REQUEST))
    die("No puedes estar aquí");

require_once "funciones.php";

$d = $_REQUEST;

$respuesta = array( "result" => false, "respuesta" => "Se ha producido un error: ", "data" => $d);

$nombre = isset($d["nombre"]) ? $d["nombre"] : false;
$descripcion = isset($d["descripcion"]) ? $d["descripcion"] : false;
$nombres_etapas = isset($d["nombreEtapa"]) ? $d["nombreEtapa"] : array() ;
$desc_etapas = isset($d["descripcionEtapa"]) ? $d["descripcionEtapa"] : array();
$nombres_tareas = isset($d["nombreTarea"]) ? $d["nombreTarea"] : array();
$desc_tareas = isset($d["descTarea"]) ? $d["descTarea"] : array();
$precios_tareas = isset($d["precioTarea"]) ? $d["precioTarea"] : array();
$id_etapas = isset($d["idEtapa"]) ? $d["idEtapa"] : array();


if ($nombre === false || $descripcion === false || strlen($nombre)<1 || strlen($descripcion)<1) {
	$respuesta["respuesta"] .= "Faltan campos por completar del tipo de proyecto";
}
else if (count($nombres_tareas) !== count($desc_tareas) && count($nombres_tareas) !== count($id_etapas)
         && count($desc_tareas) !== count($id_etapas) ) {
	$respuesta["respuesta"] .= "Faltan campos por completar en las etapas";
}
else if ($nombres_tareas === false || $desc_tareas === false) {
	$respuesta["respuesta"] .= "Faltan campos por completar en las tareas";
}
else if ($id_etapas === false) {
	$respuesta["respuesta"] .= "Una etapa necesita mínimo una tarea";
}
else if (count($id_etapas) < count($nombres_etapas)) {
	$respuesta["respuesta"] .= "Una etapa necesita mínimo una tarea";
}
else if (count($nombres_tareas) != count($id_etapas)) {
	$respuesta["respuesta"] .= "No coinciden la cantidad de datos de tareas con la cantidad de tareas especificada";
}
else {
	$error = false;
	$nuevo_nombre = "";
	// ----- Subida de archivo
	if ( isset( $_FILES["imagen"] ) && $_FILES["imagen"]["size"] > 0 ) {
		$fichero             = $_FILES["imagen"];
		$directorio_ficheros = "../files/";
		$ruta_fichero        = $directorio_ficheros . basename( $fichero["name"] );
		$filetype            = strtolower( pathinfo( $ruta_fichero, PATHINFO_EXTENSION ) );

		// Si es una imagen de verdad y no existe
		if ( getimagesize( $fichero["tmp_name"] ) !== false ) {
			if ( $fichero["size"] > 1000000 ) {
				$respuesta["respuesta"] .= "La imagen es demasiado grande (Max. 1MB)";
			} else if ( $filetype != "jpg" && $filetype != "png" && $filetype != "jpeg" && $filetype != "gif" ) {
				$respuesta["respuesta"] .= "El formato de imagen no es válido. Solo se acepta .JPG, .PNG, .JPEG y .GIF";
			} else {
				$e            = explode( ".", $fichero["name"] );
				$ext          = end( $e );
				$unwanted_array = array(    'Š'=>'S', 'š'=>'s', 'Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
				                            'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U',
				                            'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c',
				                            'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o',
				                            'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y' );
				$nom = strtr( $d["nombre"], $unwanted_array );
				$nom = preg_replace('/\s*/', '', $nom);
				$nom = strtolower($nom);
				$nuevo_nombre = $d["tipo"] . "_" . $nom . "." . $ext;
				$operacion    = move_uploaded_file( $fichero["tmp_name"], $directorio_ficheros . $nuevo_nombre );
				if ( !$operacion ) {
					$error = true;
					$respuesta["respuesta"] .= "La imagen no ha podido guardarse correctamente.";
				}
			}


		}
	}
	// -----

	if ($error === false) {
		$etapas = array();
		for ( $i = 0; $i < count( $nombres_etapas ); $i ++ ) {
			$etapa = array(
				"nom"    => $nombres_etapas[ $i ],
				"desc"   => $desc_etapas[ $i ],
				"tareas" => array()
			);

			for ( $j = 0; $j < count( $nombres_tareas ); $j ++ ) {
				$etapa["tareas"][] = array(
					"nom"  => $nombres_tareas[ $j ],
					"desc" => $desc_tareas[ $j ],
					"prec" => $precios_tareas[ $j ]
				);
			}

			$etapas[] = $etapa;
		}


		$con = $herramientas->conectar();
		$con->begin_transaction();
		try {
			$sql = "INSERT INTO pro_tipo_proyecto (`nombre`, `descripcion`, `imagen`) VALUES(?,?,?)";
			$st  = $con->prepare( $sql );
			$st->bind_param( "sss", $nombre, $descripcion, $nuevo_nombre );
			if ( !$st->execute() ) {
				throw new Exception( $st->error );
			}
			$id_tipo_proy = $con->insert_id;

			foreach ( $etapas as $etapa ) {
				$nom = $etapa["nom"];
				$desc = $etapa["desc"];
				$sql = "INSERT INTO pro_tipo_etapa (`nombre`, `descripcion`, `id_tipo_proyecto`) VALUES(?,?,?)";
				$st  = $con->prepare( $sql );
				$st->bind_param( "ssi", $nom, $desc, $id_tipo_proy );
				if ( !$st->execute() ) {
					throw new Exception( $st->error );
				}

				$id_tipo_etapa = $con->insert_id;
				foreach ( $etapa["tareas"] as $tarea ) {
					$nom = $tarea["nom"];
					$desc = $tarea["desc"];
					$prec = $tarea["prec"];
					$sql = "INSERT INTO pro_tipo_tarea (`nombre`, `descripcion`, `precio`, `id_tipo_etapa`) VALUES(?,?,?,?)";
					$st  = $con->prepare( $sql );
					$st->bind_param( "sssi", $nom, $desc, $prec, $id_tipo_etapa );
						if ( !$st->execute() ) {
						throw new Exception( $st->error );
					}
				}
			}


            $accion = "Crear nuevo tipo de proyecto";
            $fecha = date("Y-m-d");
            $id_emple = isset($_SESSION["id_usuario"]) ? $_SESSION["id_usuario"] : 0;
            $sql = "INSERT INTO pro_historico (accion, fecha, id_empleado) VALUES (?, ?, ?)";
            $prst = $con->prepare($sql);
            $prst->bind_param("ssi", $accion, $fecha, $id_emple);
            if ( !$prst->execute() ) {
                throw new Exception($prst->error);
            }

			$respuesta["result"] = true;
			$con->commit();

		} catch ( Exception $exception ) {
			$con->rollback();
			$respuesta["result"]    = false;
			$respuesta["respuesta"] .= $exception->getMessage();
		}

        $con->close();
	}
}

if ($respuesta["result"] === true) {
	$respuesta["respuesta"] = "Se ha creado correctamente el tipo de proyecto";
}

echo json_encode($respuesta);