<table style="width: 100%">
    <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>Fecha</th>
        <th>Categorías</th>
        <th>Participantes (Confirmado)</th>
    </tr>
    <?php
    include_once '../../../../clases/config.php';
    include_once '../../../../clases/claseHerramientas.php';
    include_once '../../../../clases/claseTabla.php';
    include_once '../../../../modulos/empleados/clases/evento.php';
    $evento = new Evento("emp_eventos");
    $rs = $evento->listaEventos();
    while ($fila = mysqli_fetch_array($rs)) {
        echo "<tr>";
        echo "<td align='center'>" . $fila[0] . "</td>";
        echo "<td align='center'>" . $fila[1] . "</td>";
        echo "<td align='center'>" . $fila[2] . "</td>";
        $categorias = $evento->categoriasPorEvento($fila[0]);
        echo "<td align='center'>";
        while ($cat = mysqli_fetch_array($categorias)) {
            echo $cat[0] . "<br/>";
        }
        echo "</td>";
        $participantes = $evento->participantesPorEvento($fila[0]);
        echo "<td align='center'>";
        while ($par = mysqli_fetch_array($participantes)) {
            echo $par[0]." ".$par[1];
            if ($par[2] == 1) {
                echo " (no)<br/>";
            } else {
                echo " (sí)<br/>";
            }
        }
        echo"</td>";
        echo "</tr>";
    }
    ?>
</table>