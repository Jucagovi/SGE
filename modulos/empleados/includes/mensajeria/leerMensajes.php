<div>
    <select id="id_empleado_emisor" size="1">
        <?php
        include_once '../../../../clases/config.php';
        include_once '../../../../clases/claseHerramientas.php';
        include_once '../../../../clases/claseTabla.php';
        include_once '../../../../modulos/empleados/clases/empleado.php';
        $empleado = new Empleado("gen_empleados");
        $empleados = $empleado->listaEmpleados();
        while ($emp = mysqli_fetch_array($empleados)) {
            echo "<option value='$emp[0]'>$emp[1]</option>";
        }
        ?>
    </select>
    <input type="button" value="Listar mensajes" id="listarMensajes"/>
</div>
<br/>
<br/>
<br/>
<div style="width: 100%" id="listaMensajes">
    <table style="width: 100%">
        <tr>
            <th>Enviado por...</th>
            <th>Mensaje</th>
            <th>Fecha</th>
            <th>Leído</th>
        </tr>
        <tr>
            <td colspan="4"><hr/></td>
        </tr>
    </table>
</div>