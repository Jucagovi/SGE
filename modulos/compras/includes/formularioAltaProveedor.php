<div id="altaProveedor">

<h3>Alta de nuevo Proveedor</h3>
<br />
<form id="formularioAltaProveedor" action="insertarProveedor.php" method="post">
<label for="cif">C.I.F: <input id="cif" name="cif" type="text/plain" REQUIRED /></label>
<br />
<label for="nombre">Nombre: <input id="nombre" name="nombre" type="text/plain" REQUIRED /></label>
<br />
<label for="direccion">Dirección: <input id="direccion" name="direccion" type="text/plain" REQUIRED /></label>
<br />
<label for="cod_postal">Código Postal: <input id="cod_postal" name="cod_postal" type="text/plain" REQUIRED /></label>
<br />
<label for="poblacion">Población: <input id="poblacion" name="poblacion" type="text/plain" REQUIRED /></label>
<br />
<label for="provincia">Provincia: <input id="provincia" name="provincia" type="text/plain" REQUIRED /></label>
<br />
<label for="telefono">Teléfono: <input id="telefono" name="telefono" type="tel" REQUIRED /></label>
<br />
<label for="email">E-Mail: <input id="email" name="email" type="email" REQUIRED /></label>
<br />
<input id="botonInsertarProveedor" name="insertarProveedor" type="button" value="Crear Proveedor" />
</form>

</div>