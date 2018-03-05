<?php
session_start();
require_once 'funciones.php';

if (!isset($_REQUEST) || empty($_REQUEST))
    die("No puedes estar aquí");

$tabla = new Tabla("gen_mensajes");
$conexion = $tabla->conectar();

$requestData= $_REQUEST;

$columnasOrdenar = array(0=>'fecha',1=>'nombre_tabla');

$sql = "SELECT 'historico' as nombre_tabla, ph.id_historico as id, ph.fecha as fecha,
 ph.accion as his_accion, gem1.nombre as his_nom_empleado, null as men_texto, null as men_remitente, null as men_tipo
FROM pro_historico ph, gen_empleados gem1 
WHERE ph.id_empleado = gem1.id_empleado
UNION ALL
SELECT 'mensajes' as nombre_tabla, gm.id_mensaje as id, gm.fecha_env as fecha,
 NULL as his_accion, NULL as his_nom_empleado, gm.texto as men_texto, gem2.nombre as men_remitente, IF(gm.id_tipo_mensaje = 3, 'mod','pers') as men_tipo
FROM gen_mensajes gm, gen_empleados gem2 
WHERE gm.id_empleado = gem2.id_empleado AND gm.id_tipo_mensaje != 2 AND gm.id_modulo = (SELECT id_modulo FROM gen_modulos WHERE UPPER(nombre) LIKE 'PROYECTOS') 
AND gm.destinatario = '".$_SESSION['id_usuario']."' ";

$query = $conexion->query($sql) or die("Error");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;

if( !empty($requestData['search']['value']) ) {
    $sql .= " AND ( fecha LIKE '".$requestData['search']['value']."%' ".
        " OR his_accion LIKE '".$requestData['search']['value']."%' ".
        " OR his_nom_empleado LIKE '".$requestData['search']['value']."%' ".
        " OR men_remitente LIKE '".$requestData['search']['value']."%' ".
        " OR men_texto LIKE '".$requestData['search']['value']."%') ";
} else {
    $sql.=" ORDER BY ". $columnasOrdenar[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
    $query = $conexion->query($sql) or die("Error");
}

$data = array();
while( $row= $query->fetch_array() ) {  // preparing an array
    $nestedData=array();

    $nestedData[] = $row["fecha"];
    //$nestedData[] = $row["employee_salary"];
    if($row["nombre_tabla"] == "historico"){
        $nestedData[] = "<p style='padding: 5px'><label style='font-weight: bold'>".$row["his_accion"].
            "</label></p><p style='padding: 5px'> realizado por ".$row["his_nom_empleado"]."</p>";
    }else{
        $tipoMensaje = $row["men_tipo"]=="mod"?"Mensaje General":"Mensaje Personal";
        $nestedData[] = "<p style='padding: 5px'><label style='font-weight: bold'>".$tipoMensaje.
            "</label></p><p style='padding: 5px'>".$row["men_remitente"]." : " .$row["men_texto"]."</p>";
    }

    $data[] = $nestedData;
}

$conexion->close();

$json_data = array(
    "draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
    "recordsTotal"    => intval( $totalData ),  // total number of records
    "recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
    "data"            => $data   // total data array
);

echo json_encode($json_data);  // send data as json format