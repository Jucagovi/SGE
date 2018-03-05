<?php

class Dieta extends Tabla {

    function __construct($fea) {
        parent::__construct($fea);
    }

    function listaDietas() {
        $conexion = $this->conectar();
        $sql = "SELECT * FROM emp_dietas";
        $rs = mysqli_query($conexion, $sql);
        return $rs;
    }

    function getDatosDietas() {
        $conexion = $this->conectar();
        $sql = "SELECT d.id_dieta, e.nombre, c.nombre, d.importe, d.fecha FROM emp_dietas d, emp_categorias_dietas c, gen_empleados e WHERE d.id_empleado=e.id_empleado AND d.categoria=c.id_categoria";
        return mysqli_query($conexion, $sql);
    }

    function getDieta($id) {
        $conexion = $this->conectar();
        $sql = "SELECT * FROM emp_dietas WHERE id_dieta=$id";
        $rs = mysqli_query($conexion, $sql);
        return $rs;
    }

    function listaCategorias() {
        $conexion = $this->conectar();
        $sql = "SELECT * FROM emp_categorias_dietas";
        $rs = mysqli_query($conexion, $sql);
        return $rs;
    }

}

?>