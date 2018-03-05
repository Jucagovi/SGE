<div>
    <table style="width: 100%">
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Categoría</th>
            <th>Importe</th>
            <th>Fecha</th>
        </tr>
        <?php
        include_once '../../../../clases/config.php';
        include_once '../../../../clases/claseHerramientas.php';
        include_once '../../../../clases/claseTabla.php';
        include_once '../../../../modulos/empleados/clases/dieta.php';

        $html = "";
        $dieta = new Dieta("emp_dietas");
        $rs = $dieta->getDatosDietas();
        while ($fila = mysqli_fetch_array($rs)) {
            $html .= "<tr>";
            $html .= "<td align='center'>$fila[0]</td>";
            $html .= "<td align='center'>$fila[1]</td>";
            $html .= "<td align='center'>$fila[2]</td>";
            $html .= "<td align='center'>$fila[3]</td>";
            $html .= "<td align='center'>$fila[4]</td>";
            $html .= "</tr>";
        }
        echo $html;
        ?>
    </table>
</div>
<br/>
<br/>
<hr/>
<br/>
<br/>
<div>
    <p>Crear dieta</p>
    <form id="formNuevaDieta" method="POST">
        <table>
            <tr>
                <td>Empleado:</td>
                <td>
                    <select id="id_empleado" size=1> 
                        <?php
                        include_once '../../../../clases/config.php';
                        include_once '../../../../clases/claseHerramientas.php';
                        include_once '../../../../clases/claseTabla.php';
                        include_once '../../../../modulos/empleados/clases/empleado.php';
                        $empleado = new Empleado("gen_empleados");
                        $rs = $empleado->listaEmpleados();
                        while ($fila = mysqli_fetch_array($rs)) {
                            echo "<option value='" . $fila[0] . "'>" . $fila['nombre'] . "</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Categoría:</td>
                <td>
                    <select id="categoria" size=1>
                        <?php
                        include_once '../../../../clases/config.php';
                        include_once '../../../../clases/claseHerramientas.php';
                        include_once '../../../../clases/claseTabla.php';
                        include_once '../../../../modulos/empleados/clases/dieta.php';
                        $dieta = new Dieta("emp_dietas");
                        $rs = $dieta->listaCategorias();
                        while ($fila = mysqli_fetch_array($rs)) {
                            echo "<option value='" . $fila[0] . "'>" . $fila['nombre'] . "</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Inporte:</td>
                <td><input type="number" id="importe" value="0"/></td>
            </tr>
            <tr>
                <td>Fecha:</td>
                <td><input type="date" id="fecha"/></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="button" id="guardarDieta" value="Guardar"/></td>
            </tr>
        </table>
    </form>
</div>