<?php

include_once "../../../clases/claseTabla.php";

class Solicitud extends Tabla{


//$tabla = "for_curso";

    function __construct() {
      parent::__construct("for_solicitud");
    }
        function obtenerSolicitudes(){
          try {
            $conexion = $this->conectar();
              $rs = $conexion->query("SELECT s.id_solicitud, c.nombre, c.id_curso FROM for_solicitud s JOIN for_curso c ON s.id_curso = c.id_curso ;");
              $html ="
                        <h1 id='titulo_cursos'>Listado de Solicitudes del Alumno</h1>
                        <br>
                        <div id='parteSuperior'>
                          <div id='list'>
                            <ol id='cursosItem'>";
                              while ($fila = $rs->fetch_array()){
                                $html .="<li><a href='#' id='itemSolicitud' value=".$fila[0].">".$fila[1]."</a></li>";
                              }
                              $html .="</ol>
                          </div>
                                <div id='content'>
                                  <p>Información de la solicitud</p>
                                </div>
                              </div>";
              echo $html;



            } catch(Exception $e) {
              echo "<b>Se ha producido el siguiente error:".$e->getMessage().".<b>";
          }


        }

        function obtenerInfoSolicitud($id){
          $html="";
          $conexion = $this->conectar();
            $rs = $conexion->query("SELECT * FROM for_solicitud WHERE id_solicitud = ".$id.";");
            while ($fila = $rs->fetch_array()){
              $html .="<p>Estado: ".$fila[4]."</p>
                       <p>Descripción: ".$fila[2]."</p>";
            }
            echo $html;
        }

        function obtenerFormularioSolicitud() {
            try {
              $primeraVez = 0;
                $conexion = $this->conectar();
                $rs = $conexion->query("SELECT * FROM for_curso;");
                if($rs->num_rows>0){
                  $primero = $rs->fetch_assoc();
                  $html= "
                		<form id='formSolicitud'>
                			<div class='espacioMedio'>
                				<label for='nombre_curso'>Nombre del curso: </label>
                          <input name='id_curso' type='hidden' id='id_c' value='".$primero['id_curso']."' >
                          <select id='nombre_solicitud'>";
                          while ($fila = $rs->fetch_array()) {
                            if($primeraVez == 0){
                              $html.="<option value='".$fila['id_curso']."'>".$primero['nombre']."</option>";
                              $primeraVez = 1;
                            }
                 $html.="<option value='".$fila['id_curso']."'>".$fila['nombre']."</option>";
               }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
              $rs2 = $conexion->query("SELECT * FROM gen_empleados;");
              $primero2 = $rs2->fetch_assoc();

              $html.= "</select>
              </div>

              <div class='espacioMedio'>";

                $html.="<label for='id_emple'>Identificador empleado: </label>
                <input name='id_empleado' type='hidden' id='id_e' value='".$primero2['id_empleado']."' >
                <select id='nombre_empleado'>";
                while ($fila = $rs2->fetch_array()) {
                  if($primeraVez == 1){
                    $html.="<option value='".$primero2['id_empleado']."'>".$primero2['nombre']."</option>";
                    $primeraVez = 0;
                  }
              $html.="<option value='".$fila['id_empleado']."'>".$fila['nombre']."</option>";
              }

              $html.= "</select>
              </div>

              <div class='espacioMedio'>
                <label for='id_descripcion'>Descripción de la solicitud: </label>
                <input name='descripcion' placeholder='Descripción' id='description' required>
              </div>

              <div id='btn_formSolicitudes'>
                <button id='btnEnviarSol'>Añadir</button>
                <button>Cancelar</button>
              </div>
            </form>";
          echo $html;
              }
            } catch(Exception $e) {
                echo "<b>Se ha producido el siguiente error:".$e->getMessage().".<b>";
            }
          }

          function enviarFormularioSolicitud($form){
                $form += [ "estado" => "SIN APROBAR" ];
                $conexion=$this->conectar();
                $this->insertar($form);
          }

          function obtenerSolicitudesPendientes(){
            try {
              $conexion = $this->conectar();
                $rs = $conexion->query("SELECT s.id_solicitud, c.nombre FROM for_solicitud s JOIN for_curso c ON s.id_curso = c.id_curso WHERE estado = 'SIN APROBAR';");
                $html ="
                          <h1 id='titulo_cursos'>Listado de Cursos de la Empresa</h1>
                          <div id='parteSuperior'>
                            <div id='list'>
                              <ol id='cursosItem'>";
                                while ($fila = $rs->fetch_array()){
                                  $html .="<li><a href='#' id='itemSolicitudPendiente' value=".$fila[0].">Solicitud para: ".$fila[1]."</a></li>";
                                }
                                $html .="</ol>
                            </div>
                                  <div id='content'>
                                    <p>Información de la solicitud</p>
                                  </div>
                                </div>";
                echo $html;



              } catch(Exception $e) {
                echo "<b>Se ha producido el siguiente error:".$e->getMessage().".<b>";
            }


          }

          function obtenerInfoSolicitudPendiente($id){
            $html="";
            $conexion = $this->conectar();
              $rs = $conexion->query("SELECT s.descripcion, s.estado, e.nombre
                FROM for_solicitud s JOIN gen_empleados e ON e.id_empleado = s.id_empleado WHERE s.id_solicitud = '".$id."';");
              while ($fila = $rs->fetch_array()){
                $html .="<p>Estado: ".$fila[1]."</p>
                         <p>Descripción: ".$fila[0]."</p>
                         <p>Solicitante: ".$fila[2]."</p>
                         <button id='btAceptarSolicitud' value='".$id."'>Aceptar Solicitud</button>
                         <button id='btRechazarSolicitud' value='".$id."'>Rechazar Solicitud</button> ";
              }
              echo $html;
          }

          function aceptarSolicitud($id){
            $conexion = $this->conectar();
              $rs = $conexion->query("SELECT *
                FROM for_solicitud WHERE id_solicitud = '".$id."';");
                $sol = $rs->fetch_assoc();
                $sol['estado'] = 'APROBADA';
            $conexion=$this->conectar();
            $this->actualizar($id, $sol);
          }

          function rechazarSolicitud($id){
            $conexion = $this->conectar();
              $rs = $conexion->query("SELECT *
                FROM for_solicitud WHERE id_solicitud = '".$id."';");
                $sol = $rs->fetch_assoc();
                $sol['estado'] = 'RECHAZADA';
            $conexion=$this->conectar();
            $this->actualizar($id, $sol);
          }

          function cambiarCombo(){


          }



} # Fin de la clase
