<?php

class Evento extends Tabla {

    public function __construct($fea) {
        parent::__construct($fea);
    }

    function listaEventos() {
        $conexion = $this->conectar();
        $sql = "SELECT * FROM emp_eventos";
        return mysqli_query($conexion, $sql);
    }

    function categoriasPorEvento($id) {
        $conexion = $this->conectar();
        $sql = "SELECT cat.nombre FROM emp_eventos_categorias ec, emp_categorias_eventos cat WHERE ec.id_categoria=cat.id_categoria AND ec.id_evento=$id";
        return mysqli_query($conexion, $sql);
    }

    function participantesPorEvento($id) {
        $conexion = $this->conectar();
        $sql = "SELECT emp.nombre, emp.apellidos, ee.confirmado FROM emp_empleados_eventos ee, gen_empleados emp WHERE ee.id_empleado=emp.id_empleado AND ee.id_evento=$id";
        return mysqli_query($conexion, $sql);
    }

    function listaCategorias() {
        $conexion = $this->conectar();
        $sql = "SELECT * FROM emp_categorias_eventos";
        return mysqli_query($conexion, $sql);
    }

    function getCategoria($id) {
        $conexion = $this->conectar();
        $sql = "SELECT * FROM emp_categorias_eventos WHERE id_categoria=$id";
        $rs = mysqli_query($conexion, $sql);
        return mysqli_fetch_array($rs);
    }

    function ultimoEvento() {
        $conexion = $this->conectar();
        $sql = "SELECT * FROM emp_eventos ORDER BY id_evento DESC LIMIT 1";
        $rs = mysqli_query($conexion, $sql);
        return mysqli_fetch_array($rs);
    }

}
