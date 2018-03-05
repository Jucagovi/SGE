<?php
if (!isset($_REQUEST) || empty($_REQUEST))
    die("No puedes estar aquí");

require_once "funciones.php";

$d = $_REQUEST;

$respuesta = array( "result" => false, "respuesta" => "Se ha producido un error: ", "data" => $d);
$error = false;
ob_start();
$con = $herramientas->conectar();
$con->begin_transaction();
try {
    $descuento = $d["descuento"];
    $responsable = $d["responsable"];
    $id = $d["id_presu"];
    $estado = "proyecto";
    $fecha = $d["fechafin"];

    $tabla = query(new Tabla("pro_proyecto"), ["id"=>[$id]], true, true);
    if ($tabla->estado !== "presupuesto") {
        throw new Exception("El presupuesto ya está aprobado");
    }

    $nom = $tabla->nombre;
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
                $nom = strtr( $nom, $unwanted_array );
                $nom = preg_replace('/\s*/', '', $nom);
                $nom = strtolower($nom);
                $nuevo_nombre = "proyecto_" . $nom . "." . $ext;
                $operacion    = move_uploaded_file( $fichero["tmp_name"], $directorio_ficheros . $nuevo_nombre );
                if ( !$operacion ) {
                    throw new Exception("La imagen no ha podido guardarse correctamente.");
                }
            }


        }
    }
    // -----

    $sql = "UPDATE pro_proyecto SET descuento = ?, responsables = ?, fecha_fin = ?, estado = ?, imagen = ? WHERE id_proyecto = ?";
    $prst = $con->prepare($sql);
    $prst->bind_param("disssi", $descuento, $responsable, $fecha, $estado, $nuevo_nombre, $id);
    if ( !$prst->execute() ) {
        throw new Exception($prst->error);
    }

    $accion = "Aprobado un nuevo presupuesto";
    $fecha = date("Y-m-d");
    $id_emple = isset($_SESSION["id_usuario"]) ? $_SESSION["id_usuario"] : 0;
    $sql = "INSERT INTO pro_historico (accion, fecha, id_empleado) VALUES (?, ?, ?)";
    $prst = $con->prepare($sql);
    $prst->bind_param("ssi", $accion, $fecha, $id_emple);
    if ( !$prst->execute() ) {
        throw new Exception($prst->error);
    }

    $respuesta["result"] = true;
    $respuesta["respuesta"] = "Proyecto creado correctamente";
    $con->commit();


} catch (Exception $exception) {
    $con->rollback();
    $respuesta["result"]    = false;
    $respuesta["respuesta"] .= $exception->getMessage();
}
$con->close();

$respuesta["petada"] = ob_get_clean();
ob_end_flush();

echo json_encode($respuesta);