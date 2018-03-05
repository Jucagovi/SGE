
<?php

include_once 'funciones.php';
require_once ("../mpdf60/mpdf.php");

error_reporting(E_ERROR | E_PARSE);

$css= ".clearfix:after {
  content: '';
  display: table;
  clear: both;
}

a {
  color: #5D6975;
  text-decoration: underline;
}

body {
  position: relative;
  width: 21cm;  
  height: 29.7cm; 
  margin: 0 auto; 
  color: #001028;
  background: #FFFFFF; 
  font-family: Arial, sans-serif; 
  font-size: 12px; 
  font-family: Arial;
}

header {
  padding: 10px 0;
  margin-bottom: 5px;
}

#logo {
  text-align: center;
  margin-bottom: 10px;
}

#logo img {
  width: 90px;
}

h1 {
  border-top: 1px solid  #5D6975;
  border-bottom: 1px solid  #5D6975;
  color: #5D6975;
  font-size: 2.4em;
  line-height: 1.4em;
  font-weight: normal;
  text-align: center;
  margin: 0 0 20px 0;
  background: url(../../../imagenes/fondo.png);
}

#project {
  float: left;
}

#project span {
  color: #5D6975;
  text-align: right;
  width: 52px;
  margin-right: 10px;
  display: inline-block;
  font-size: 0.8em;
}

#project div{
  white-space: nowrap;        
}

table {
  width: 100%;
  border-collapse: collapse;
  border-spacing: 0;
  margin-bottom: 20px;
}

table tr:nth-child(2n-1) td {
  background: #F5F5F5;
}

table th,
table td {
  text-align: center;
}

table th {
  padding: 5px 20px;
  color: #5D6975;
  border-bottom: 1px solid #C1CED9;
  white-space: nowrap;        
  font-weight: normal;
}

table .service,
table .desc {
  text-align: left;
}

table td {
  padding: 20px;
  text-align: right;
}

table td.total {
  border-top: 1px solid #5D6975;;
}

#etapa span{
    color: #5D6975;
    font-weight: bold;
    display: inline-block;
    font-size: 1.4em;
    float: left;
}

footer {
  color: #5D6975;
  width: 100%;
  height: 30px;
  bottom: 0;
  border-top: 1px solid #C1CED9;
  padding: 8px 0;
  text-align: center;
}

";

$id = $_REQUEST["idproyecto"];

$fmt = new NumberFormatter( 'en_EN', NumberFormatter::DECIMAL );
$tabla = new Tabla("pro_proyecto");
$conexion = $tabla->conectar();

$sqlDatosPro="SELECT pp.nombre as nomPro, pp.descripcion as descPro, ge.nombre as nomRes,
 (SELECT pj.fecha from pro_jornada pj, pro_tarea pt, pro_proyecto ppr WHERE ppr.id_proyecto=pt.id_proyecto
  AND pt.id_tarea = pj.id_tarea AND ppr.id_proyecto =pp.id_proyecto ORDER BY pj.fecha ASC LIMIT 1) as fechaInicio, 
  pp.fecha_fin as fechaFin, pp.coste, pp.iva, pp.descuento, pp.imagen, pp.id_tipo_proyecto FROM pro_proyecto pp, gen_empleados ge 
  WHERE ge.id_empleado=pp.responsables AND pp.id_proyecto=".$id." ";

$query = $conexion->query($sqlDatosPro) or die("Error");
$datosPro = $query->fetch_array();

//var_dump($datosPro); die();

$html = "<header class=\"clearfix\">
    <div id=\"logo\">
        <img src=\"../../../imagenes/logo.png\">
    </div>
    <h1>Empresa SGE 2017-2018</h1>
    <div id=\"project\">
        <div><span>Fecha</span> ".date("d/m/Y")."</div>
        <div><span>PROYECTO</span> ".$datosPro["nomPro"]."</div>
        <div><span>Responsable</span> ".$datosPro["nomRes"]."</div>
        <div><span>Coste</span> ".$fmt->parse($datosPro["coste"])." €</div>
        <div><span>IVA</span> ".$fmt->parse($datosPro["iva"])." %</div>
        <div><span>Descuento</span> ".$fmt->parse($datosPro["descuento"])." %</div>
        <div><span>Fecha Inicio de Proyecto</span> ".$herramientas->fecha_a_normal($datosPro["fechaInicio"])."</div>
        <div><span>Fecha Fin  de Proyecto</span> ".$herramientas->fecha_a_normal($datosPro["fechaFin"])."</div>
        <!--<div><span>Descripción</span> ".$datosPro["descPro"]."</div>-->
    </div>
</header>
<main>
<div id='etapa'><span style='color: #0c0c0c'>Etapas : </span><br></div>";

$sqlDatosEta="SELECT * FROM pro_tipo_etapa WHERE id_tipo_proyecto = ".$datosPro["id_tipo_proyecto"]." ";

$query1 = $conexion->query($sqlDatosEta) or die("Error");
$datosEta = $query1->fetch_all();

//var_dump($datosEta); die();
$TotalFacturacionProyecto = 0;
$TotalRealProyecto = 0;
foreach ($datosEta as $etapa){
    //var_dump($etapa); die();
    $html .= "<div id='etapa'><span>".$etapa[1]."</span> <br>".$etapa[2]."</div>";
    $html .= "<table>
        <thead>
        <tr>
            <th>TAREA</th>
            <th>DESCRIPCIÓN</th>
            <th>FECHA INICIO</th>
            <th>FECHA FIN</th>
            <th>H. TRABA.</th>
            <th>H. PRESUP.</th>
            <th>PRECIO</th>
            <th>COSTE</th>
            <th>COSTE PROPIO</th>
        </tr>
        </thead>
        <tbody>";

    $sqlDatosTar=" SELECT pt.nombre AS nombreTar, pt.descripcion AS descTar, 
 (SELECT pj.fecha from pro_jornada pj, pro_tarea pt2 WHERE pt2.id_tarea = pj.id_tarea AND pt2.id_tarea = pt.id_tarea ORDER BY pj.fecha ASC LIMIT 1 ) AS fechaInicio, 
 pt.fecha_fin as fechaFin, 
 (SELECT SUM(pj.horas) from pro_jornada pj, pro_tarea pt3 WHERE pt3.id_tarea = pj.id_tarea AND pt3.id_tarea = pt.id_tarea) AS hTrab, 
 pt.horas_presupuestadas AS hPre, ptt.precio AS precio, (pt.horas_presupuestadas*ptt.precio) AS coste, 
 ((SELECT SUM(pj.horas) from pro_jornada pj, pro_tarea pt3 WHERE pt3.id_tarea = pj.id_tarea AND pt3.id_tarea = pt.id_tarea)*ptt.precio) AS costePropio 
 FROM pro_tarea pt, pro_tipo_tarea ptt WHERE pt.id_tipo_tarea=ptt.id_tipo_tarea AND ptt.id_tipo_etapa=".$etapa[0]." AND pt.id_proyecto = ".$id." ";

    $query2 = $conexion->query($sqlDatosTar) or die("Error");
    $datosTar = $query2->fetch_all();
    //bonita_variable($datosTar);die();

    $totalF = 0;
    $totalR = 0;
    foreach ($datosTar as $tarea){
        $html.="<tr>
            <td>".$tarea[0]."</td>
            <td>".$tarea[1]."</td>
            <td>".$herramientas->fecha_a_normal($tarea[2])."</td>
            <td>".$herramientas->fecha_a_normal($tarea[3])."</td>
            <td>".$fmt->parse($tarea[4])." h</td>
            <td>".$fmt->parse($tarea[5])." h</td>
            <td>".$fmt->parse($tarea[6])." €/h</td>
            <td>".$fmt->parse($tarea[7])." €</td>
            <td>".$fmt->parse($tarea[8])." €</td>
        </tr>";
        $totalF+=$fmt->parse($tarea[7]);
        $totalR+=$fmt->parse($tarea[8]);
    }
    $TotalFacturacionProyecto += $totalF;
    $TotalRealProyecto += $totalR;
    $html .="<tr><td colspan='7' class='total'></td><td class='total'>Total Facturar<br>$totalF €</td><td class='total'>Total Coste<br>$totalR €</td></tr></tbody></table>";
}
$iva = $TotalFacturacionProyecto*$fmt->parse($datosPro["iva"])/100;
$descuento = -1*$TotalFacturacionProyecto*$fmt->parse($datosPro["descuento"])/100;
$html .="<div id='etapa'><span style='color: #0c0c0c'>Facturación : </span><br></div>
<p>Coste Real : ".$TotalRealProyecto." €</p>
<p>Coste Facturacion : ".$TotalFacturacionProyecto." €</p>
<p>IVA: ".$iva." €</p>
<p>Descuento : ".$descuento." €</p>
<p>Total : ".($TotalFacturacionProyecto+$iva+$descuento)." €</p>";
$html .= "</main><footer>
    Empresa SGE 2017-2018 ©2018
</footer>";
//echo $html;die();
$conexion->close();
$mpdf = new mPDF('c','A4');
$mpdf->WriteHTML($css,1);
$mpdf->WriteHTML($html,2);
$mpdf->Output('informeproyecto.pdf','I');