<table class="infoTabla" style="width: 100%">
    <tr>
        <th><button class="infoOrdenar" id="nombre">Nombre</button></th>
        <th><button class="infoOrdenar" id="apellidos">Apellidos</button></th>
        <th><button class="infoOrdenar" id="fecha_nac">Fecha Nacimiento</button></th>
        <th><button class="infoOrdenar" id="fecha_inc">Antiguedad</button></th>
        <th><button class="infoOrdenar" id="id_departamento">Departamento</button></th>
    </tr>
    <?php
    include_once '../../../../clases/config.php';
    include_once '../../../../clases/claseHerramientas.php';
    include_once '../../../../clases/claseTabla.php';
    include_once '../../../../modulos/empleados/clases/informe.php';
    
    $emple = new Informe("");
    $rse = $emple->listaEmpleados($_POST['orden']);
    while ($inf = mysqli_fetch_array($rse)) {
        echo "<tr>";
        echo "<td align='center'>$inf[0]</td>";
        echo "<td align='center'>$inf[1]</td>";
        echo "<td align='center'>$inf[2]</td>";
        echo "<td align='center'>$inf[3]</td>";
        if ($inf[4] == 0) {
            echo "<td></td>";
        } else {
            echo "<td align='center'>" . $emple->nombreDepartamento($inf[4]) . "</td>";
        }
        echo "</tr>";
    }
    ?>
</table>