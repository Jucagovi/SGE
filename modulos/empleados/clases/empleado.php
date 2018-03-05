<?php

class Empleado extends Tabla {

    function __construct($fea) {
        parent::__construct($fea);
    }

    function listaEmpleados() {
        $conexion = $this->conectar();
        $sql = "SELECT * FROM gen_empleados";
        $rs = mysqli_query($conexion, $sql);
        return $rs;
    }

    function getEmpleado($id) {
        $conexion = $this->conectar();
        $sql = "SELECT * FROM gen_empleados WHERE id_empleado=$id";
        $resultado = mysqli_query($conexion, $sql);
        $fila = mysqli_fetch_array($resultado);
        return $fila;
    }

    function getEmpleadoNombre($nombre) {
        $conexion = $this->conectar();
        $sql = "SELECT * FROM gen_empleados WHERE nombre LIKE '%$nombre%' or apellidos LIKE '%$nombre%'";
        $rs = mysqli_query($conexion, $sql);
        return $rs;
    }

    function getDepartamento($id) {
        $conexion = $this->conectar();
        $sql = "SELECT nombre FROM rrhh_departamento WHERE id_departamento=$id";
        $resultado = mysqli_query($conexion, $sql);
        $list = mysqli_fetch_array($resultado);
        return $list[0];
    }

    function getUltimoID() {
        $conexion = $this->conectar();
        $sql = "SELECT id_empleado FROM gen_empleados ORDER BY id_empleado DESC LIMIT 1";
        $rs = mysqli_query($conexion, $sql);
        $fila = mysqli_fetch_array($rs);
        return $fila[0];
    }

    function generaContrasena() {
        $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
        $longitudCadena = strlen($cadena);
        $pass = "";
        $longitudPass = 8;
        for ($i = 1; $i <= $longitudPass; $i++) {
            $pos = rand(0, $longitudCadena - 1);
            $pass .= substr($cadena, $pos, 1);
        }
        return $pass;
    }

}

?>