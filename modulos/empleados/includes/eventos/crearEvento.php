<div style="width: 50%; float: left">
    <input type="button" value="Guardar" id="guardarEvento"/>
    <br/>
    <br/>
    <div>
        <label>Nombre: </label>
        <input type="text" id="nombre"/>
    </div>
    <br/>
    <div>
        <label>Fecha: </label>
        <input type="date" id="fecha"/>
    </div>
    <br/>
    <div>
        <input type="checkbox" id="confirmar">Necesita confirmación.
    </div>
    <br/>
    <br/>
    <div>
        <p>Categorías</p>
        <?php
        include_once '../../../../clases/config.php';
        include_once '../../../../clases/claseHerramientas.php';
        include_once '../../../../clases/claseTabla.php';
        include_once '../../../../modulos/empleados/clases/evento.php';
        $evento = new Evento("emp_eventos");
        $categorias = $evento->listaCategorias();
        while ($cat = mysqli_fetch_array($categorias)) {
            echo "<input class='categorias' type='checkbox' name='cat[]' id='$cat[0]'>$cat[1]<br/>";
        }
        ?>
    </div>
</div>
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