<h1>Crear Candidato a Proceso de Seleccion</h1>
<form class="formCandidato" method="post">
<fieldset>
<legend>Nuevo Candidato</legend>
<br>ID Candidato:<input type="text" name="id_candidato" placeholder="Id" readonly>
<br>Nombre:<input type="text" name="nombre"  placeholder="Nombre" required>
<br>Apellidos:<input type="text" name="apellidos" placeholder="Apellidos" required>
<br>Fecha Nacimiento:<input type="text" name="fecha_nac"  placeholder="AAAA-MM-DD" required>
<br>Telefono:<input type="text" name="telefono" maxlength="12" placeholder="Telefono" required>
<br>Foto:<input type="text" name="foto"  placeholder="Aun no esta implementado" required>
<br>Curriculum:<input type="text" name="curriculum"  placeholder="Curriculum" required>
<br>Nota Interna:<input type="text" name="nota_interna" placeholder="Nota Interna" required>
<br>Descripcion<input type="text" name="descripcion"  placeholder="Descripcion" required>
<br><input type="button" class="botonCrearCandidatoFinal" value="Crear"/>
</fieldset>
</form>
