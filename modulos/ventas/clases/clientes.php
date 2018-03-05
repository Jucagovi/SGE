<?php
/**
 * Clase para manejar los clientes del modulo Ventas.
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

class clientes extends Tabla{
  protected $id_cliente_dni;
	protected $nombre;
	protected $apellido;
	protected $fecha;
	protected $categoria;
	protected $pagoPermitido;

    function __construct() {

    }
    public function get_id_cliente_dni(){
      return $this->id_cliente_dni;
    }
    public function get_nombre(){
      return $this->nombre;
    }
    public function get_apellido(){
      return $this->apellido;
    }
    public function get_fecha(){
      return $this->fecha;
    }
    public function get_categoria(){
      return $this->categoria;
    }
    public function get_pagoPermitido(){
      return $this->pagoPermitido;
    }
//////////////////////////////////   Obtener  clientes   ///////////////////////////////////////////////////
    function obtenerClientes() {
       if (isset($_POST['nombre'])) {
      $buscar=$_POST['nombre'];
      if ($buscar != "") {
        try {
            $conexion = $this->conectar();
            $sqlClientes = "select * from ven_clientes where nombre LIKE  '".$buscar."%' or apellido LIKE  '".$buscar."%' or id_cliente_dni LIKE  '".$buscar."%'";
            $res = $conexion->query($sqlClientes);
            if($res->num_rows>0){
              $html="<table style='width:50%'>
                <tr>
                  <th>Nombre</th>
                  <th>Apellido</th>
                  <th>DNI</th>
                  <th>Borrar</th>
                  <th>Modificar</th>
                </tr>";
            while ($fila = $res->fetch_array()) {
              $html.="  <tr>
                          <th>".$fila['nombre']." </th>
                          <th>   ".$fila['apellido']." </th>
                          <th> ".$fila['id_cliente_dni']."</th>
                          <th> <img src='./imagenes/borrar.jpg' class='borrarCliente' id='".$fila['id_cliente_dni']."'
                           alt='Smiley face' height='25' width='25'></th>
                          <th> <img src='./imagenes/modificar.jpg' class='modificarCliente' id='".$fila['id_cliente_dni']."'
                           alt='Smiley face' height='25' width='25'></th>
                    </tr>";
            }
            $html.="</table>";
            echo $html;
          }
        } catch(Exception $e) {
            echo "<b>Se ha producido el siguiente error:".$e->getMessage().".<b>";
        }
      }// fin if
    }
  }

//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////   borrar cliente   ///////////////////////////////////////////////////
  function  BorrarCliente(){
    if (isset($_POST['id'])) {
      $id=trim($_POST['id']);
       try {
           $conexion = $this->conectar();
           $sqlBorrar="delete from ven_clientes where id_cliente_dni='".$id."'";
           $sqlComprobar = "select * from ventas where cliente='".$id."'";
           $res = $conexion->query($sqlComprobar);
           if($res->num_rows>0){
             echo "<p> El cliente ha realizado compras no se puede dar de baja.</p>";
           }else{
             // si tiene factura no borramos el cliente
             $conexion->query($sqlBorrar);
            echo "<p> El cliente se ha borrado con exito.</p>";
           }
         } catch(Exception $e) {
             echo "<b>Se ha producido el siguiente error:".$e->getMessage().".<b>";
         }
       }
     }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////   Modificar Cliente  ///////////////////////////////////////
function modificarCliente(){
      if (isset($_POST['id'])) {
      $id=trim($_POST['id']);
       try {
             $conexion = $this->conectar();
             $sqlClientes="select * from  ven_clientes where id_cliente_dni='".$id."'"; 
             $res = $conexion->query($sqlClientes);
               while ($fila = $res->fetch_array()) {
                 $html="
                 <h3>Modificar Cliente</h3>
                  <br>
                  <br>
                 <form method='post' id='formulario'>
                         Nombre :<br>
                         <input type='text' name='nombre' value='".$fila['nombre']."'><br>
                         Apellido :<br>
                         <input type='text' name='apellido' value='".$fila['apellido']."'><br><br>
                         Codigo/DNI :<br>
                         <input type='text' name='dni' value='".$fila['id_cliente_dni']."'><br><br>
                         Fecha :<br>
                         <input type='text' name='fecha' value='".$fila['fecha']."'><br><br>
                         <input type='button'  id='modificarClien' value='Modificar'>
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
  if (isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['dni']) && isset($_POST['fecha'])) {
    $nombre=trim($_POST['nombre']);
    $apellido=trim($_POST['apellido']);
    $dni=trim($_POST['dni']);
    $fecha=trim($_POST['fecha']);
    if ($nombre != "" && $apellido != "" && $dni != ""  && $fecha != "") {

    try {
        $conexion = $this->conectar();
        $sqlClientes="UPDATE  ven_clientes SET nombre = '".$nombre."', apellido= '".$apellido."' ,id_cliente_dni='".$dni."',fecha= '".$fecha."'  where id_cliente_dni='".$dni."'"; // primero se tiene que borrar en la tabla items y luego en la tabla reservas ya que la informacion pertenece a la reserva
        $conexion->query($sqlClientes);
        echo "<p> Se ha modificado con exito el cliente : ".$nombre."</p>";
      } catch(Exception $e) {
          echo "<b>Se ha producido el siguiente error:".$e->getMessage().".<b>";
      }
      }else{
           echo "<p> Hay algun campo vacio no se ha guardado.</p>";
       }
     }
   }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////// Crear Cliente ////////////////////////////////////////////////
function GuardarCliente(){
  if (isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['dni']) &&
  isset($_POST['fecha']) && isset($_POST['categoria']) && isset($_POST['pagoPermitido'])) {
    $nombre=trim($_POST['nombre']);
    $apellido=trim($_POST['apellido']);
    $dni=trim($_POST['dni']);
    $fecha=trim($_POST['fecha']);
    $categoria=trim($_POST['categoria']);
    $pagoPermitido=trim($_POST['pagoPermitido']);
    if ($nombre != "" && $apellido != "" && $dni != ""  && $fecha != "" && $categoria != "" && $pagoPermitido != "") {
    try {
        $conexion = $this->conectar();
        $sqlClientes="INSERT INTO  ven_clientes (id_cliente_dni,nombre,apellido,fecha,categoria,pagoPermitido)
                        VALUES ('".$dni."','".$nombre."','".$apellido."','".$fecha."','".$categoria."','".$pagoPermitido."')"; // primero se tiene que borrar en la tabla items y luego en la tabla reservas ya que la informacion pertenece a la reserva
        $conexion->query($sqlClientes);
        echo "<p> Se ha Guardado con exito el cliente : ".$nombre."</p>";
      } catch(Exception $e) {
          echo "<b>Se ha producido el siguiente error:".$e->getMessage().".<b>";
      }
      }else{
           echo "<p> Hay algun campo vacio no se ha guardado.</p>";
       }
     }
    }

  ///////////////////////////////////////////// Categiras ///////////////////////////////////////////////////////
   function Categorias() {
       try {
           $conexion = $this->conectar();
           $sqlClientes = "select * from categorias";
           $res = $conexion->query($sqlClientes);
           if($res->num_rows>0){
             $html="";
           while ($fila = $res->fetch_array()) {
             $html.="<option value='".$fila['id_categoria']."'>".$fila['id_categoria']."</option>";
           }
           echo $html;
         }
       } catch(Exception $e) {
           echo "<b>Se ha producido el siguiente error:".$e->getMessage().".<b>";
       }
     }// fin if

     ///////////////////////////////////////////// Pago Permetido  ///////////////////////////////////////////////////////
      function PagosPirmitidos() {
          try {
              $conexion = $this->conectar();
              $sqlClientes = "select * from metodospago";
              $res = $conexion->query($sqlClientes);
              if($res->num_rows>0){
                $html="";
              while ($fila = $res->fetch_array()) {
                $html.="<option value='".$fila['id_metodoPago']."'>".$fila['nombre']."</option>";
              }
              echo $html;
            }
          } catch(Exception $e) {
              echo "<b>Se ha producido el siguiente error:".$e->getMessage().".<b>";
          }
        }// fin if
} # Fin de la clase
