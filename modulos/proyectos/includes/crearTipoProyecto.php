<?php
session_start();
require_once "funciones.php";

?>
<div id="moduloproyectos">
    <form action="backend_crearTipoProyecto.php" id="formCrearTipoProyecto">
        <input type="hidden" name="tipo" value="tipo_proyecto">
        <h1 class="titulo-seccion">Herramienta de generación de tipos de proyecto</h1>
        <div class="contenedor">
            <div class="fila">
                <label class="label">Nombre del tipo de proyecto
                    <input id="nombreProyecto" name="nombre" value="" placeholder="Introduce el nombre" required=""
                           aria-label="Introduce el nombre" title="Introduce el nombre" class="input col-6">
                </label>
            </div>
            <div class="fila">
                <label class="label">Descripción del tipo de proyecto
                    <textarea id="descripcionProyecto" name="descripcion" placeholder="Introduce una descripción"
                              aria-label="Introduce la descripción" title="Introduce el descripción" required=""
                              class="textarea col-6"></textarea>
                </label>
            </div>

            <div class="fila">
                <label class="label">Imagen del tipo de proyecto
                    <input type="file" class="col-6" name="imagen">
                </label>
            </div>

            <div class="fila">
                <span id="addTipoEtapa" class="btn btn-info" value="0">Añadir etapa</span>
            </div>

            <div class="fila resultado"></div>
            <div class="fila">
                <button class="btn btn-success">Crear tipo proyecto</button>
            </div>
        </div>
    </form>
</div>