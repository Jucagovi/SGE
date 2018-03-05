<p>Editar categoría</p>
<table>
    <?php
    include_once '../../../../clases/config.php';
    include_once '../../../../clases/claseHerramientas.php';
    include_once '../../../../clases/claseTabla.php';
    include_once '../../../../modulos/empleados/clases/evento.php';
    $evento = new Evento("emp_eventos");
    $categoria = $evento->getCategoria($_POST['identificador']);
    echo "<tr>";
    echo "<td>Id:</td>";
    echo "<td id='idModificar'>$categoria[0]</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>Nombre:</td>";
    echo "<td><input type='text' id='nombreModificar' value='$categoria[1]'/></td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td><input type='button' id='modificarCategoriaEvento' value='Modificar'/></td>";
    echo "<td><input type='button' id='borrarCategoriaEvento' value='Borrar'/></td>";
    echo "</tr>";
    ?>
</tr>
</table>