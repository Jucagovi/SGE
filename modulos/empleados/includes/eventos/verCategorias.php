<div style="width: 50%; float:left">
    <table style="width: 100%">
        <tr>
            <th>Id</th>
            <th>Nombre</th>
        </tr>
        <?php
        include_once '../../../../clases/config.php';
        include_once '../../../../clases/claseHerramientas.php';
        include_once '../../../../clases/claseTabla.php';
        include_once '../../../../modulos/empleados/clases/evento.php';

        $html = "";
        $evento = new Evento("emp_eventos");
        $rs = $evento->listaCategorias();
        while ($fila = mysqli_fetch_array($rs)) {
            $html .= "<tr class='categoriaEventos' id='$fila[0]'>";
            $html .= "<td align='center'>$fila[0]</td>";
            $html .= "<td align='center'>$fila[1]</td>";
            $html .= "</tr>";
        }
        echo $html;
        ?>
    </table>
</div>
<div style="width: 50%; float:left">
    <div>
        <p>Crear categoría</p>
        <table>
            <tr>
                <td>Nombre: </td>
                <td><input type="text" id="nombre"/></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="button" id="crearCategoriaEventos" value="Crear"/></td>
            </tr>
        </table>
    </div>
    <br/>
    <br/>
    <br/>
    <div id="editarCategoria">

    </div>
</div>