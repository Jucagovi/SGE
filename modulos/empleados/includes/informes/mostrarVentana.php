<table>
    <tr>
    <td>Informes</td>
    <td><button id="generarPDF">Generar PDF</button></td>
    </tr>
</table>
<br/>
<hr/>
<br/>
<p>Empleados</p>
<br/>
<div id='informeEmp' style="width: 100%">
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
        $rse = $emple->listaEmpleados("id_empleado");
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
</div>
<br/>
<hr/>
<br/>
<p>Dietas</p>
<br/>
<div style="width: 100%">
    <table class="infoTabla" style="width: 100%">
        <tr>
            <th>Nombre</th>
            <th>Categoría</th>
            <th>Importe</th>
            <th>Fecha</th>
        </tr>
        <?php
        include_once '../../../../clases/config.php';
        include_once '../../../../clases/claseHerramientas.php';
        include_once '../../../../clases/claseTabla.php';
        include_once '../../../../modulos/empleados/clases/informe.php';

        $dieta = new Informe("");
        $rsd = $dieta->listaDietas();
        while ($inf = mysqli_fetch_array($rsd)) {
            echo "<tr>";
            echo "<td align='center'>$inf[0] $inf[1]</td>";
            echo "<td align='center'>$inf[2]</td>";
            echo "<td align='center'>$inf[3] €</td>";
            echo "<td align='center'>$inf[4]</td>";
            echo "</tr>";
        }
        ?>
    </table>
</div>
<br/>
<hr/>
<br/>
<p>Pedidos</p>
<br/>
<div style="width: 100%">
    <table class="infoTabla" style="width: 100%">
        <tr>
            <th>Nombre</th>
            <th>Producto</th>
            <th>Unidades</th>
            <th>Precio</th>
            <th>Fecha</th>
        </tr>
        <?php
        include_once '../../../../clases/config.php';
        include_once '../../../../clases/claseHerramientas.php';
        include_once '../../../../clases/claseTabla.php';
        include_once '../../../../modulos/empleados/clases/informe.php';

        $pedido = new Informe("");
        $rsp = $pedido->listarPedidos();
        while ($inf = mysqli_fetch_array($rsp)) {
            echo "<tr>";
            echo "<td align='center'>$inf[0] $inf[1]</td>";
            echo "<td align='center'>$inf[2]</td>";
            echo "<td align='center'>$inf[3]</td>";
            echo "<td align='center'>$inf[4] €</td>";
            echo "<td align='center'>$inf[5]</td>";
            echo "</tr>";
        }
        ?>
    </table>
</div>