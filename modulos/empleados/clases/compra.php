<?php

class compra extends Tabla {

    function __construct($fea) {
        parent::__construct($fea);
    }

    function listaProductos() {
        $conexion = $this->conectar();
        $sql = "SELECT * FROM inv_productos";
        $rs = mysqli_query($conexion, $sql);
        return $rs;
    }

    function listaLineas() {
        $conexion = $this->conectar();
        $sql = "SELECT * FROM com_lineas_producto";
        $rs = mysqli_query($conexion, $sql);
        return $rs;
    }

    function obtenerCosasCompra() {
        $conexion = $this->conectar();
        //inv_productos, com_lineas_producto, com_pedidos
        $sql = "SELECT i.nombre, l.unidades, l.importe FROM inv_productos i, com_lineas_producto l, com_pedidos p WHERE p.id_linea_producto=l.id_linea_producto and l.id_producto=i.id_producto ORDER BY id_pedido";
        $rs = mysqli_query($conexion, $sql);
        return $rs;
    }

    function precioProducto($id) {
        $conexion = $this->conectar();
        $sql = "SELECT precio FROM inv_productos WHERE id_producto=$id";
        $rs = mysqli_query($conexion, $sql);
        $fila = mysqli_fetch_array($rs);
        return $fila[0];
    }

    function ultimaLinea() {
        $conexion = $this->conectar();
        $sql = "SELECT * FROM com_lineas_producto ORDER BY id_linea_producto DESC LIMIT 1";
        $rs = mysqli_query($conexion, $sql);
        $fila = mysqli_fetch_array($rs);
        return $fila[0];
    }

}
?>

