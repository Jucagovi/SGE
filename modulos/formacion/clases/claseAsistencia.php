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
                          	</div>";
            echo $html;



          } catch(Exception $e) {
            echo "<b>Se ha producido el siguiente error:".$e->getMessage().".<b>";
        }
    }


} # Fin de la clase
