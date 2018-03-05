<?php
/**
 * Clase para manejar las Metodo de pago del modulo Ventas.
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

class MetodoPago extends Tabla{
  protected $id_metodoPago;
  protected $nombre;
	protected $descripcion;


    function __construct() {

    }
    public function get_id_metodoPago(){
      return $this->id_metodoPago;
    }
    public function get_nombre(){
      return $this->id_nombre;
    }
    public function get_descripcion(){
      return $this->descripcion;
    }

    //////////////////////////////////   Obtener  Categorias   ///////////////////////////////////////////////////
        function obtenerMetodoPago() {
            try {
                $conexion = $this->conectar();
                $sqlClientes = "select * from ven_metodospago";
                $res = $conexion->query($sqlClientes);
                if($res->num_rows>0){
                  $html="<table style='width:50%' border='2px'>
                    <tr>
                      <th>Id MetodoPago</th>
                      <th>Nombre</th>
                      <th>Descripcion</th>
                      <th>Borrar</th>
                      <th>Modificar</th>
                    </tr>";
                while ($fila = $res->fetch_array()) {
                  $html.="  <tr>
                              <th>".$fila['id_metodoPago']." </th>
                              <th>   ".$fila['nombre']." </th>
                              <th>   ".$fila['descripcion']." </th>
                              <th> <img src='./imagenes/borrar.jpg' class='borrarMetodoPago' id='".$fila['id_metodoPago']."'
                               alt='Smiley face' height='25' width='25'></th>
                              <th> <img src='./imagenes/modificar.jpg' class='modificarMetodoPago' id='".$fila['id_metodoPago']."'
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
    ////////////////////////////////////   Modificar Metodo Pago  ///////////////////////////////////////
    function modificarMetodoPago(){
          if (isset($_POST['id'])) {
          $id=trim($_POST['id']);
           try {
                 $conexion = $this->conectar();
                 $sqlMetodoPago="select * from ven_metodospago where id_metodoPago='".$id."'";
                 $res = $conexion->query($sqlMetodoPago);
                   while ($fila = $res->fetch_array()) {
                     $html="
                     <h3>Modificar Metodo Pago</h3>
                      <br>
                      <br>
                     <form method='post' id='FormularioMetodoPago'>
                             Id Metodo Pago :<br>
                            <br>
                            <input type='text' name='id' value='".$fila['id_metodoPago']."' readonly><br><br>
                            Nombre :<br>
                            <input type='text' name='nombre' value='".$fila['nombre']."' size='50'><br><br>
                             Descripcion :<br>
                             <input type='text' name='descripcion' value='".$fila['descripcion']."' size='50'><br><br>
                             <input type='button'  id='modificarMetodoPago' value='Modificar'>
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
    function  GuardarModificacionMetodoPago(){
      if (isset($_POST['id']) && isset($_POST['nombre']) && isset($_POST['descripcion']) ) {
        $id=trim($_POST['id']);
        $nombre=trim($_POST['nombre']);
        $descripcion=trim($_POST['descripcion']);
        if ($nombre != "" && $descripcion !="" ) {
        try {
            $conexion = $this->conectar();
            $sqlMetodoPago="UPDATE ven_metodospago SET nombre= '".$nombre."',descripcion= '".$descripcion."' where id_metodoPago='".$id."'"; // primero se tiene que borrar en la tabla items y luego en la tabla reservas ya que la informacion pertenece a la reserva
            $conexion->query($sqlMetodoPago);
            echo "<p> Se ha modificado con exito El metodo Pago : ".$nombre."</p>";
          } catch(Exception $e) {
              echo "<b>Se ha producido el siguiente error:".$e->getMessage().".<b>";
          }
         }else{
              echo "<p> Hay algun campo vacio no se ha guardado.</p>";
          }
         }
       }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////   borrar Metodo Pago   ///////////////////////////////////////////////////
      function  BorrarMetodoPago(){
        if (isset($_POST['id'])) {
          $id=trim($_POST['id']);
           try {
               $conexion = $this->conectar();
               $sqlBorrar="DELETE  from ven_metodospago where id_metodoPago='".$id."'";
               $conexion->query($sqlBorrar);
               echo "<p> El Metodo de pago se ha borrado con exito.</p>";
             } catch(Exception $e) {
                 echo "<b>Se ha producido el siguiente error:".$e->getMessage().".<b>";
             }
           }
         }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////// Crear Metodo Pago ////////////////////////////////////////////////
    // En otras funciones no me hace este problema, me inserta dos veces he depurado he buscado informacion
    // y nada, y no se por que es.
    function GuardarMetodoPagoNueva(){
      if (isset($_POST['nombre']) &&  isset($_POST['descripcion'])) {
        $nombre=trim($_POST['nombre']);
        $descripcion=trim($_POST['descripcion']);
        if ($nombre != "" && $descripcion !="" ) {
        try {
            $conexion = $this->conectar();
            $sqlMetodoPago="INSERT INTO ven_metodospago (id_metodoPago,nombre,descripcion)
                            VALUES ( null,'".$nombre."','".$descripcion."')";
            $conexion->query($sqlMetodoPago);
            echo "<p> Se ha Guardado con exito el Metodo Pago : ".$nombre."</p>";
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
