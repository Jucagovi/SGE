<table>
    <tr>
        <th>Productos</th>
        <th>Cantidad</th>
        <th></th>
    </tr>
    <tr>
        <td>
            <select id="id_empleado" size="1">
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
        <td align="center">
            <select id="id_producto" size="1">
                <?php
                include_once '../../../../clases/config.php';
                include_once '../../../../clases/claseHerramientas.php';
                include_once '../../../../clases/claseTabla.php';
                include_once '../../../../modulos/empleados/clases/compra.php';
                $producto = new Compra("inv_productos");
                $productos = $producto->listaProductos();
                while ($emp = mysqli_fetch_array($productos)) {
                    echo "<option value='$emp[0]'>$emp[1]</option>";
                }
                ?>
            </select>
        </td>
        <td align="center">
            <input type="number" id="cantidad" value="1"/>
        </td>
        <td align="center"><input type="button" id="btHacerPedido" value="Hacer pedido"/></td>
    </tr>
</table>
<hr/>
<br/>
<table style="width: 100%">
    <tr>
        <th>Productos</th>
        <th>Cantidad</th>
        <th>Precio</th>
        <th>Fase del pedido</th>
    </tr>   
    <?php
    include_once '../../../../clases/config.php';
    include_once '../../../../clases/claseHerramientas.php';
    include_once '../../../../clases/claseTabla.php';
    include_once '../../../../modulos/empleados/clases/compra.php';
    $pedido = new Compra("aquivalgo");
    $productos = $pedido->obtenerCosasCompra();
    while ($emp = mysqli_fetch_array($productos)) {
        echo "<tr>";
        echo "<td id='nombreProducto' align='center'>$emp[0]</td>";
        echo "<td id='cantidad' align='center'>$emp[1]</td>";
        echo "<td id='precio' align='center'>$emp[2]</td>";
        echo "<td id='fase' align='center'>Interno</td>";
        echo "</tr>";
    }
    ?>
</table>


