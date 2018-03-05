<form id="formAlta">
    <div>
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre"/>
    </div>

    <div>
        <label for="apellidos">Apellidos:</label>
        <input type="text" name="apellidos"/>
    </div>

    <div>
        <label for="fecha_nac">Fecha de nacimiento:</label>
        <input type="date" name="fecha_nac"/>
    </div>

    <div>
        <label for="fechaInc">Fecha de incorporacion:</label>
        <input type="date" name="fecha_inc"/>
    </div>

    <div>
        <label for="usuario">Nombre de usuario:</label>
        <input type="text" name="usuario"/>
    </div>

    <div>
        <label for="contrasena">Password:</label>
        <input type="password" id="contrasena" name="contrasena"/>
        <input type="button" id="generarContrasena" value="Generar contraseña"/>
    </div>

    <div>
        <label for="curriculum">Currriculum:</label>
        <input type="file" name="curriculum"/>
    </div>

    <div>
        <label for="foto">Foto:</label>
        <input type="file" name="foto"/>
    </div>

    <div>
        <label for="id_departamento">Departamento:</label>
        <SELECT name="id_departamento" SIZE=1>
            <option value="0"/>
            <?php
            include_once '../../../../clases/config.php';
            include_once '../../../../clases/claseHerramientas.php';
            include_once '../../../../clases/claseTabla.php';
            $feo = new Tabla("rrhh_departamento"); //cambiar nombre despues
            $conexion = $feo->conectar();
            $sql = "SELECT * FROM rrhh_departamento";
            $res = mysqli_query($conexion, $sql);
            while ($lista = mysqli_fetch_array($res)) {
                echo "<OPTION VALUE='" . $lista[0] . "'>" . $lista['nombre'] . "</OPTION>";
            }
            ?>
        </SELECT>
    </div>
    <div>
        <input type="button" id="guardarEmpleado" value="Guardar"/>
    </div>
</form>
