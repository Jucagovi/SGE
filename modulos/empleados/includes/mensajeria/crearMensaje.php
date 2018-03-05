<div>
    <!-- lista de empleados en combo-->
    <div style="width: 50%; float: left">
        <p>Empleados</p>
        <select id="id_empleado_emisor" size="1">
            <?php
            include_once '../../../../clases/config.php';
            include_once '../../../../clases/claseHerramientas.php';
            include_once '../../../../clases/claseTabla.php';
            include_once '../../../../modulos/empleados/clases/empleado.php';
            $empleado = new Empleado("gen_empleados");
            $empleados = $empleado->listaEmpleados();
            while ($emp = mysqli_fetch_array($empleados)) {
                echo "<option VALUE='$emp[0]'>$emp[1]</option>";
            }
            ?>
        </select>
        <!-- boton de enviar mensaje-->
        <input type="button" value="Enviar Mensaje" id="btEnviarMensaje"/>

        <div>
            <textarea  id="contenido" cols="40" rows="5"/>
        </div>
    </div>
    <label>Enviar a:</label>
    <!-- lista de empleados en checkbox-->
    <div style="width: 50%; float: left">
        <p>Empleados</p>
        <?php
        include_once '../../../../clases/config.php';
        include_once '../../../../clases/claseHerramientas.php';
        include_once '../../../../clases/claseTabla.php';
        include_once '../../../../modulos/empleados/clases/empleado.php';
        $empleado = new Empleado("gen_empleados");
        $empleados = $empleado->listaEmpleados();
        while ($emp = mysqli_fetch_array($empleados)) {
            echo "<input class='empleados' type='checkbox' name='emp[]' id='$emp[0]'>$emp[1]<br/>";
        }
        ?>
    </div>
</div>
