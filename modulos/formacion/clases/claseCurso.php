<?php

include_once "../../../clases/claseTabla.php";

class Curso extends Tabla{


//$tabla = "for_curso";

    function __construct() {
      parent::__construct("for_curso");
    }

    function obtenerCursos() {
        try {
          $conexion = $this->conectar();
            $rs = $conexion->query("SELECT * FROM for_curso;");
            $html ="
                      <h1 id='titulo_cursos'>Listado de Cursos de la Empresa</h1>
                      <div id='parteSuperior'>
                        <div id='list'>
                          <ol id='cursosItem'>";
                            while ($fila = $rs->fetch_array()){
                              $html .="<li><a href='#' id='itemCurso' value=".$fila[0].">".$fila[1]."</a></li>";
                            }
                            $html .="</ol>
                        </div>
                          		<div id='content'>
                          			<p>Información del curso</p>
                          		</div>
                          	</div>


                          	";
            echo $html;



          } catch(Exception $e) {
            echo "<b>Se ha producido el siguiente error:".$e->getMessage().".<b>";
        }
    }

    function obtenerInfoCurso($id){
      $html="";
      $conexion = $this->conectar();
        $rs = $conexion->query("SELECT c.nombre, c.vacantes, c.descripcion, c.fecha_inicio, c.fecha_fin,
          c.periodo_inscripcion, c.periodo_fin_inscripcion, e.nombre FROM for_curso c JOIN gen_empleados e ON c.id_empleado = e.id_empleado WHERE c.id_curso = ".$id.";");
        while ($fila = $rs->fetch_array()){
          $html .="<p>Nombre: ".$fila[0]."</p>
                   <p>Vacantes: ".$fila[1]."</p>
                   <p>Descripción: ".$fila[2]."</p>
                   <p>Fecha inicio: ".$fila[3]."</p>
                   <p>Fecha fin: ".$fila[4]."</p>
                   <p>Inicio inscripción: ".$fila[5]."</p>
                   <p>Fin inscripción: ".$fila[6]."</p>
                   <p>Responsable: ".$fila[7]."</p>";
        }
        $rs = $conexion->query("SELECT sum(duracion_horas) FROM for_unidad WHERE id_curso = ".$id.";");
        while ($fila = $rs->fetch_array()){
          $html .= "Horas del curso: ".$fila[0];

        }

        echo $html;

    }

    function obtenerUnidades() {
        try {
          $conexion = $this->conectar();
            $rs = $conexion->query("SELECT u.nombre_unidad, c.nombre, u.id_unidad  FROM for_unidad u, for_curso c WHERE u.id_curso = c.id_curso;");
            $html ="
                      <h1 id='titulo_unidades'>Listado de Unidades de los Cursos</h1>
                      <div id='parteSuperior'>
                        <div id='list'>
                          <ol id='cursosItem'>";
                            while ($fila = $rs->fetch_array()){
                              $html .="<li><a href='#' id='itemUnidad' value=".$fila[2].">Unidad: ".$fila[0]." Curso: ".$fila[1]."</a></li>";
                            }
                            $html .="</ol>
                        </div>
                              <div id='content'>
                                <p>Información del curso</p>
                              </div>
                            </div>


                          ";
            echo $html;



          } catch(Exception $e) {
            echo "<b>Se ha producido el siguiente error:".$e->getMessage().".<b>";
        }
    }

    function obtenerInfoUnidad($id){
      $html="";
      $conexion = $this->conectar();
        $rs = $conexion->query("SELECT nombre_unidad, duracion_horas, porcentaje_curso FROM for_unidad WHERE id_unidad = ".$id.";");
        while ($fila = $rs->fetch_array()){
          $html .="<p>Unidad: ".$fila[0]."</p>
                   <p>Horas: ".$fila[1]."</p>
                   <p>Porcentaje en el curso: ".$fila[2]."%</p>";
        }

        echo $html;
    }


        function enviarFormulario($form){

          $rellenado = 0;
          foreach($form as $valor){
            if($valor == null){
              $rellenado = 1;
            }
          }

          if($rellenado == 0){
              $conexion=$this->conectar();
              $this->insertar($form);
            }
        }

} # Fin de la clase
