<?php

include_once '../../../clases/claseTabla.php';

class Venta extends Tabla{

    protected $id_venta;
    protected $fecha;
    protected $empresa;
    protected $cliente;
    protected $domicilioFiscal;
    protected $descripcion;
    protected $IVA;
    protected $lineaVenta;
    protected $cantidad;
    protected $comercial;
    protected $metodoPago;
    protected $estado;

    function __construct() {
        $id_venta = "";
        $fecha = "01-01-2001";
        $empresa = "";
        $cliente = "";
        $domicilioFiscal = "";
        $descripcion = "";
        $IVA = 0;
        $lineaVenta = 0;
        $cantidad = 0;
        $comercial = "";
        $metodoPago = "";
        $estado = 0;
    }

    public function get_id_venta(){
      return $this->$id_venta;
    }

    public function get_fecha(){
      return $this->$fecha;
    }

    public function get_empresa(){
      return $this->$empresa;
    }

    public function get_cliente(){
      return $this->$cliente;
    }

    public function get_domicilioFiscal(){
      return $this->$domicilioFiscal;
    }

    public function get_descripcion(){
      return $this->$descripcion;
    }

    public function get_IVA(){
      return $this->$IVA;
    }

    public function get_lineaVenta(){
      return $this->$lineaVenta;
    }

    public function get_cantidad(){
      return $this->$cantidad;
    }

    public function get_comercial(){
      return $this->$comercial;
    }

    public function get_metodoPago(){
      return $this->$metodoPago;
    }

    public function get_estado(){
      return $this->$estado;
    }

    public function set_id_venta($x){
      return $this->$id_venta=$x;
    }

    public function set_fecha($x){
      return $this->$fecha=$x;
    }

    public function set_empresa($x){
      return $this->$empresa=$x;
    }

    public function set_cliente($x){
      return $this->$cliente=$x;
    }

    public function set_domicilioFiscal($x){
      return $this->$domicilioFiscal=$x;
    }

    public function set_descripcion($x){
      return $this->$descripcion=$x;
    }

    public function set_IVA($x){
      return $this->$IVA=$x;
    }

    public function set_lineaVenta($x){
      return $this->$lineaVenta=$x;
    }

    public function set_cantidad($x){
      return $this->$cantidad=$x;
    }

    public function set_comercial($x){
      return $this->$comercial=$x;
    }

    public function set_metodoPago($x){
      return $this->$metodoPago=$x;
    }

    public function set_estado($x){
      return $this->$estado=$x;
    }

    function mostrarVentas() {
      $conexion = $this->conectar();
      $sql = "select * from ventas";
      $resultado = $conexion->query($sql);
      echo "<table border='1'><tr><th>ID</th><th>Fecha</th><th>Empresa</th><th>Cliente</th><th>Domicilio</th><th>Descripción</th><th>IVA</th><th>Línea de Venta</th><th>Comercial</th><th>Método de Pago</th><th>Estado</th></th></tr>";
      while ($fila = $resultado->fetch_array()) {
        echo "<tr>";
        echo "<td>".$fila['id_venta']."</td>";
        echo "<td>".$fila['fecha']."</td>";
        echo "<td>".$fila['empresa']."</td>";
        echo "<td>".$fila['cliente']."</td>";
        echo "<td>".$fila['domicilioFiscal']."</td>";
        echo "<td>".$fila['descripcion']."</td>";
        echo "<td>".$fila['IVA']."</td>";
        echo "<td>".$fila['lineaVenta']."</td>";
        echo "<td>".$fila['Comercial']."</td>";
        echo "<td>".$fila['metodoPago']."</td>";
        echo "<td>".$fila['estado']."</td>";
        echo "<td><button class='modVenta'>Modificar</button></td>";
        echo "</tr>";
      }
      echo "</table><br/><button class='addVenta'>Generar nueva Venta</button>";
    }

    function crearVenta($id,$fecha,$empresa,$cliente,$domicilio,$descripcion,$iva,$linea,$comercial,$metodo,$estado) { //Falta notificar a módulo Almacén
      $conexion = $this->conectar();
      $sql = "INSERT INTO estadosventas(id_venta, fecha, empresa, cliente, domicilioFiscal, descripcion, IVA, lineaVenta, Comercial, metodoPago, estado) VALUES (".$id.",'".$fecha."','".$empresa."','".$cliente."','".$domicilio."','".$descripcion."',".$iva.",".$linea.",".$comercial.",".$metodo.",".$estado.")";
      $conexion->query($sql);
    }

    function ultimaVenta(){ //Función para sacar el id de una nueva Venta, sumándole 1 a la última de la base de datos
      $ultimo=0;
      $conexion = $this->conectar();
      $sql = "select id_venta from ventas";
      $resultado = $conexion->query($sql);
      while ($fila = $resultado->fetch_array()) {
        $ultimo = $fila["id_venta"];
      }
      return $ultimo;
    }

    function ultimaLinea(){ //Función para sacar el id de una nueva Línea de venta, sumándole 1 a la última de la base de datos
      $ultimo=0;
      $conexion = $this->conectar();
      $sql = "select id_lineasVentas from lineasventa";
      $resultado = $conexion->query($sql);
      while ($fila = $resultado->fetch_array()) {
        $ultimo = $fila["id_lineasVentas"];
      }
      return $ultimo;
    }

    function listaIVA() { //Método para rellenar los select de los formularios que lo necesiten, sacando todos los tipos de IVA de la base de datos
      $conexion = $this->conectar();
      $sql = "select * from tiposiva";
      $resultado = $conexion->query($sql);
      while ($fila = $resultado->fetch_array()) {
        echo "<option value='".$fila['porcentaje']."'>".$fila['id_tipoVenta'].": ".$fila['porcentaje']."</option>";
      }
    }

    function listaMetodos() { //Método para rellenar los select de los formularios que lo necesiten, sacando todos los Métodos de pago de la base de datos
      $conexion = $this->conectar();
      $sql = "select * from metodospago";
      $resultado = $conexion->query($sql);
      while ($fila = $resultado->fetch_array()) {
        echo "<option value='".$fila['id_metodoPago']."'>".$fila['nombre']."</option>";
      }
    }

    function listaEstados() { //Método para rellenar los select de los formularios que lo necesiten, sacando todos los Estados de venta de la base de datos
      $conexion = $this->conectar();
      $sql = "select * from estadosventas";
      $resultado = $conexion->query($sql);
      while ($fila = $resultado->fetch_array()) {
        echo "<option value='".$fila['id_estadoVenta']."'>".$fila['nombre']."</option>";
      }
    }

    function listaProductos() { //Método para rellenar los select de los formularios que lo necesiten, sacando todos los Productos de la base de datos
      $conexion = $this->conectar();
      $sql = "select * from productos";
      $resultado = $conexion->query($sql);
      while ($fila = $resultado->fetch_array()) {
        echo "<option value='".$fila['id_producto']."'>".$fila['nombre']." (".$fila['precioUnitario'].")</option>";
      }
    }
    //Todas estas listas con para el formulario de creación de una venta, por todas las claves foráneas que tiene
}

?>
