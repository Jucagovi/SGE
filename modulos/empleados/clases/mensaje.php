<?php

class mensaje extends Tabla {

    function __construct($fea) {
        parent::__construct($fea);
    }

    function listaMensajes() {
        $conexion = $this->conectar();
        $sql = "SELECT * FROM emp_mensajes";
        $rs = mysqli_query($conexion, $sql);
        return $rs;
    }

    function emisoresMensajes() {
        $conexion = $this->conectar();
        $sql = "SELECT DISTINCT id_emp_emisor FROM emp_mensajes";
        $rs = mysqli_query($conexion, $sql);
        return $rs;
    }

    function ultimoMensaje() {
        $conexion = $this->conectar();
        $sql = "SELECT * FROM emp_mensajes ORDER BY id_mensaje DESC LIMIT 1";
        $rs = mysqli_query($conexion, $sql);
        $fila = mysqli_fetch_array($rs);
        return $fila[0];
    }

    function datosMensaje($id) {
        $conexion = $this->conectar();
        $sql = "SELECT me.id_mensaje_empleado, e.nombre, e.apellidos, m.contenido, m.fecha, me.estado FROM emp_mensajes m, gen_empleados e, emp_mensajes_empleados me WHERE m.id_emp_emisor=e.id_empleado AND m.id_mensaje=me.id_mensaje AND me.id_emp_receptor=$id ORDER BY fecha DESC";
        return mysqli_query($conexion, $sql);
    }

    function marcarLeido($id) {
        $conexion = $this->conectar();
        "UPDATE `emp_mensajes_empleados` SET `estado` = '1' WHERE `emp_mensajes_empleados`.`id_mensaje_empleado` = 6 ";
        $sql = "UPDATE emp_mensajes_empleados SET estado='1' WHERE id_mensaje_empleado=$id";
        mysqli_query($conexion, $sql);
    }

}
?>

