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
    <?php
    include_once '../../../../clases/config.php';
    include_once '../../../../clases/claseHerramientas.php';
    include_once '../../../../clases/claseTabla.php';
    include_once '../../../../modulos/empleados/clases/mensaje.php';
    $mensaje = new mensaje("emp_mensajes");
    $rs = $mensaje->datosMensaje($_POST['identificador']);
    while ($mens = mysqli_fetch_array($rs)) {
        echo "<tr>";
        echo "<td align='center'>$mens[1] $mens[2]</td>";
        echo "<td align='center'>$mens[3]</td>";
        echo "<td align='center'>$mens[4]</td>";
        if($mens[5] == 0) {
            echo "<td align='center'><button class='marcarLeido' id='$mens[0]'>Marcar como leído</button></td>";
        }else{
            echo "<td align='center'><button disabled>Leído</button></td>";
        }
        echo "</tr>";
        echo "<tr>";
        echo "<td colspan='4'><hr/></td>";
        echo "</tr>";
    }
    ?>
</table>