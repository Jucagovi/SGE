<div>
    <table style="width: 100%">
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Descripción</th>
        </tr>
        <?php
        include_once '../../../../clases/config.php';
        include_once '../../../../clases/claseHerramientas.php';
        include_once '../../../../clases/claseTabla.php';
        include_once '../../../../modulos/empleados/clases/dieta.php';

        $html = "";
        $dieta = new Dieta("emp_dietas");
        $rs = $dieta->listaCategorias();
        while ($fila = mysqli_fetch_array($rs)) {
            $html .= "<tr>";
            $html .= "<td align='center'>$fila[0]</td>";
            $html .= "<td align='center'>$fila[1]</td>";
            $html .= "<td>$fila[2]</td>";
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
    <p>Crear categoría</p>
    <table>
        <tr>
            <td>Nombre: </td>
            <td><input type="text" id="nombre"/></td>
        </tr>
        <tr>
            <td>Descripción: </td>
            <td><input type="text" id="descripcion"/></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="button" id="crearCategoriaDietas" value="Crear"/></td>
        </tr>
    </table>
</div>