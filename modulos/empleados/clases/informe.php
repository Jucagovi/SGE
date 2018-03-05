<?php

class Informe extends Tabla {

    function __construct($fea) {
        parent::__construct($fea);
    }

    function listaEmpleados($orden) {
        $conexion = $this->conectar();
        $sql = "SELECT nombre, apellidos, fecha_nac, fecha_inc, id_departamento FROM gen_empleados ORDER BY $orden";
        return mysqli_query($conexion, $sql);
    }

    function nombreDepartamento($id) {
        $conexion = $this->conectar();
        $sql = "SELECT nombre FROM rrhh_departamento WHERE id_departamento=$id";
        $rs = mysqli_query($conexion, $sql);
        $fila = mysqli_fetch_array($rs);
        return $fila[0];
    }

    function listaDietas() {
        $conexion = $this->conectar();
        $sql = "SELECT e.nombre, e.apellidos, cd.nombre, d.importe, d.fecha FROM emp_dietas d, gen_empleados e, emp_categorias_dietas cd WHERE d.id_empleado=e.id_empleado AND d.categoria=cd.id_categoria ORDER BY d.fecha DESC";
        return mysqli_query($conexion, $sql);
    }

    function listarPedidos() {
        $conexion = $this->conectar();
        $sql = "SELECT e.nombre, e.apellidos, p.nombre, lp.unidades, lp.importe, pe.fecha FROM gen_empleados e, emp_pedidos_empleados pe, com_lineas_producto lp, inv_productos p WHERE e.id_empleado=pe.id_empleado AND pe.id_pedido=lp.id_linea_producto AND lp.id_producto=p.id_producto ORDER BY pe.fecha DESC";
        return mysqli_query($conexion, $sql);
    }

}
