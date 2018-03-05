<?php
/**
 * Clase para manejar las categorias del modulo Ventas.
 * Hereda de la clase Herramientas.
 *
 * @author   Youssef  y  Dani <Ventas@gmail.com>
 * @license  Generic Public License
 *
 * ***************************************************************
 * * LISTADO DE PROCEDIMIENTOS DE LA CLASE                       *
 * ***************************************************************
 *
 *
 */

class Categoria extends Tabla{
  protected $id_categoria;
	protected $descripcion;


    function __construct() {

    }
    public function get_id_categoria(){
      return $this->id_categoria;
    }
    public function get_descripcion(){
      return $this->descripcion;
    }
    //////////////////////////////////   Obtener  Categorias   ///////////////////////////////////////////////////
        function obtenerCategorias() {
            try {
                $conexion = $this->conectar();
                $sqlCategoria = "select * from ven_categorias";
                $res = $conexion->query($sqlCategoria);
                if($res->num_rows>0){
                  $html="<table style='width:50%' border='2px'>
                    <tr>
                      <th>Id Categoria</th>
                      <th>Descripcion</th>
                      <th>Borrar</th>
                      <th>Modificar</th>
                    </tr>";
                while ($fila = $res->fetch_array()) {
                  $html.="  <tr>
                              <th>".$fila['id_categoria']." </th>
                              <th>   ".$fila['descripcion']." </th>
                              <th> <img src='./imagenes/borrar.jpg' class='borrarCategoria' id='".$fila['id_categoria']."'
                               alt='Smiley face' height='25' width='25'></th>
                              <th> <img src='./imagenes/modificar.jpg' class='modificarCategoria' id='".$fila['id_categoria']."'
                               alt='Smiley face' height='25' width='25'></th>
                        </tr>";
                }
                $html.="</table>";
                echo $html;
              }
            } catch(Exception $e) {
                echo "<b>Se ha producido el siguiente error:".$e->getMessage().".<b>";
            }
      }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////   Modificar Categoria  ///////////////////////////////////////
    function modificarCategorias(){
          if (isset($_POST['id'])) {
          $id=trim($_POST['id']);
           try {
                 $conexion = $this->conectar();
                 $sqlCategoria="select * from ven_categorias where id_categoria='".$id."'";
                 $res = $conexion->query($sqlCategoria);
                   while ($fila = $res->fetch_array()) {
                     $html="
                     <h3>Modificar Categoria</h3>
                      <br>
                      <br>
                     <form method='post' id='FormularioCategoria'>
                             Id Categoria :<br>
                            <br>
                            <input type='text' name='id' value='".$fila['id_categoria']."' readonly><br><br>
                             Descripcion :<br>
                             <input type='text' name='descripcion' value='".$fila['descripcion']."' size='50'><br><br>
                             <input type='button'  id='modificarCateg' value='Modificar'>
                             </form>
                             ";
                   }
                   echo $html;
             } catch(Exception $e) {
                 echo "<b>Se ha producido el siguiente error:".$e->getMessage().".<b>";
           }
        }
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////   Guardar Modificacion //////////////////////////////////////
    function  GuardarModificacion(){
      if (isset($_POST['id']) && isset($_POST['descripcion']) ) {
        $id=trim($_POST['id']);
        $descripcion=trim($_POST['descripcion']);
        if ($id != "" && $descripcion != "") {
        try {
            $conexion = $this->conectar();
            $sqlCategoria="UPDATE ven_categorias SET descripcion= '".$descripcion."' where id_categoria='".$id."'";
            $conexion->query($sqlCategoria);
            echo "<p> Se ha modificado con exito la categoria : ".$id."</p>";
          } catch(Exception $e) {
              echo "<b>Se ha producido el siguiente error:".$e->getMessage().".<b>";
          }
          }else{
               echo "<p> Hay algun campo vacio no se ha guardado.</p>";
           }
         }
       }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////   borrar Categoria   ///////////////////////////////////////////////////
      function  BorrarCategoria(){
        if (isset($_POST['id'])) {
          $id=trim($_POST['id']);
           try {
               $conexion = $this->conectar();
               $sqlBorrar="delete from ven_categorias where id_categoria='".$id."'";
               $conexion->query($sqlBorrar);
               echo "<p> La Categoria se ha borrado con exito.</p>";
             } catch(Exception $e) {
                 echo "<b>Se ha producido el siguiente error:".$e->getMessage().".<b>";
             }
           }
         }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////// Crear CAtegoria ////////////////////////////////////////////////
    function GuardarCategoriaNueva(){
      if (isset($_POST['id']) && isset($_POST['descripcion'])) {
        $id=trim($_POST['id']);
        $descripcion=trim($_POST['descripcion']);
        if ($id != "" && $descripcion != "") {
        try {
            $conexion = $this->conectar();
            $sqlCategoria="INSERT INTO ven_categorias (id_categoria,descripcion)
                            VALUES ('".$id."','".$descripcion."')";
                            echo $sqlCategoria;
            $conexion->query($sqlCategoria);
            echo "<p> Se ha Guardado con exito La categoria : ".$id."</p>";
          } catch(Exception $e) {
              echo "<b>Se ha producido el siguiente error:".$e->getMessage().".<b>";
          }
          }else{
               echo "<p> Hay algun campo vacio no se ha guardado.</p>";
           }
         }
        }
 //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

} # Fin de la clase
