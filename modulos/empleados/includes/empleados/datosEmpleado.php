<form id='formEditar'>

    <table>

        <?php
        include_once '../../../../clases/config.php';
        include_once '../../../../clases/claseHerramientas.php';
        include_once '../../../../clases/claseTabla.php';
        include_once '../../../../modulos/empleados/clases/empleado.php';

        $empleado = new Empleado("gen_empleados");

        try {
            $lista = $empleado->getEmpleado($_POST["identificador"]);

            $html = "<tr>";
            $html .= "<td>ID</td><td>" . $_POST['identificador'] . "<input type='hidden' name='id_empleado' value='" . $_POST['identificador'] . "'></td>";
            $html .= "</tr>";

            $html .= "<tr>";
            $html .= "<td>Nombre</td><td><input type='text' name='nombre' value='" . $lista["nombre"] . "'/></td>";
            $html .= "</tr>";

            $html .= "<tr>";
            $html .= "<td>Apellidos</td><td><input type='text' name='apellidos' value='" . $lista["apellidos"] . "'/></td>";
            $html .= "</tr>";

            $html .= "<tr>";
            $html .= "<td>Fecha nacimiento</td><td><input type='date' name='fecha_nac' value='" . $lista["fecha_nac"] . "'/></td>";
            $html .= "</tr>";

            $html .= "<tr>";
            $html .= "<td> </td>";
            $html .= "</tr>";

            $html .= "<tr>";
            $html .= "<td>Fecha iniciación</td><td><input type='date' name='fecha_inc' value='" . $lista["fecha_inc"] . "'/></td>";
            $html .= "</tr>";

            $html .= "<tr>";
            $html .= "<td>Usuario</td><td><input type='text' name='usuario' value='" . $lista["usuario"] . "'/></td>";
            $html .= "</tr>";

            $html .= "<tr>";
            $html .= "<td>Contraseña</td><td><input type='password' name='contrasena' value='" . $lista["contrasena"] . "'/></td>";
            $html .= "</tr>";

            $html .= "<tr>";
            $html .= "<td>Currículum</td><td><a href='./modulos/empleados" . $lista['curriculum'] . "'>Curriculum</a></td>";
            $html .= "</tr>";

            $html .= "<tr>";
            $html .= "<td>Currículum</td><td><input type='file' name='curriculum'/></td>";
            $html .= "</tr>";

            $html .= "<tr>";
            $html .= "<td>Foto</td><td><img style='border: 1px solid black' src='./modulos/empleados" . $lista["foto"] . "' height='100' width='100'/></td>";
            $html .= "</tr>";

            $html .= "<tr>";
            $html .= "<td></td><td><input type='file' name='foto'/></td>";
            $html .= "</tr>";

            $feo = new Tabla("rrhh_departamento");
            $conexion = $feo->conectar();
            $sql = "SELECT * FROM rrhh_departamento";
            $res = mysqli_query($conexion, $sql);

            $html .= "<tr>";
            $html .= "<td>Departamento</td><td><SELECT name='id_departamento' selected='" . $lista["id_departamento"] . "'>";
            $html .= "<OPTION VALUE=''/>";
            while ($dep = mysqli_fetch_array($res)) {
                $html .= "<OPTION VALUE='" . $dep[0] . "' ";
                if ($dep[0] == $lista["id_departamento"]) {
                    $html .= "selected";
                }
                $html .= ">" . $dep['nombre'] . "</OPTION>";
            }
            $html .= "</SELECT>";
            $html .= "</td>";
            $html .= "</tr>";

            $html .= "<tr>";
            $html .= "<td>Histórico</td>";
            $html .= "<td>";

            $historio = new Tabla("rrhh_historico");
            $con = $historio->conectar();
            $sql = "SELECT d.nombre, h.fecha FROM rrhh_historico h, rrhh_departamento d WHERE h.id_departamento=d.id_departamento AND h.id_empleado=" . $_POST['identificador'];
            $rs = mysqli_query($con, $sql);
            while ($fila = mysqli_fetch_array($rs)) {
                $html .= $fila[0] . " - " . $fila[1] . "<br/>";
            }
            $html .= "</td>";
            $html .= "</tr>";

            echo $html;
        } catch (Exception $ex) {
            
        }
        ?>

        <tr>
            <td><input type="button" id='modificar' value='Modificar'/></td>
        </tr>

    </table>

</form>