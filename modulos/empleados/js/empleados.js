$(document).ready(function (e) {

    function listar_empleados() {
        $.ajax({
            url: './modulos/empleados/includes/empleados/listaEmpleados.php',
            type: 'POST',
            dataType: 'html',
            data: {
            },
            error: function () {
                alert("Ha habido un error con los datos.");
            },
            success: function (datos) {
                $("article").html(datos).hide().fadeIn(200);
                buscar_empleado();
            }
        });// Fin ajax
    }

    $(document).on("click", "#datosEmpleados", listar_empleados);
    //Método accesible, mietras pulse el INTRO del teclado.
    $("#datosEmpleados").keypress(function (e) {
        if (e.which === 13)
            listar_empleados();
    });

    function buscar_empleado() {
        $.ajax({
            url: './modulos/empleados/includes/empleados/buscarEmpleados.php',
            type: 'POST',
            dataType: 'html',
            data: {
                nombre: $("#nombre").val()
            },
            error: function () {
                alert("Ha habido un error con los datos.");
            },
            success: function (datos) {
                $("#empleados").html(datos).hide().fadeIn(200);
            }
        });// Fin ajax
    }

    $(document).on("click", "#buscarEmpleado", buscar_empleado);
    //Método accesible, mietras pulse el INTRO del teclado.
    $("#buscarEmpleado").keypress(function (e) {
        if (e.which === 13)
            buscar_empleado();
    });

    function editar_empleado() {
        var nombreEmpleado = $("#nombree").val() + " " + $("#apellidos").val();
        var form = $('#formEditar')[0];
        var formData = new FormData(form);
        console.log(formData);
        $.ajax({
            url: './modulos/empleados/includes/empleados/editarEmpleado.php',
            type: 'POST',
            dataType: 'html',
            data: formData,
            error: function () {
                alert("Ha habido un error con los datos.");
            },
            success: function () {
                alert("¡Empleado " + nombreEmpleado + " modificado!")
                buscar_empleado();
            },
            cache: false,
            contentType: false,
            processData: false
        });// Fin ajax
    }

    $(document).on("click", "#modificar", editar_empleado);
    //Método accesible, mietras pulse el INTRO del teclado.
    $("#modificar").keypress(function (e) {
        if (e.which === 13)
            editar_empleado();
    });

    function datos_empleado() {
        $.ajax({
            url: './modulos/empleados/includes/empleados/datosEmpleado.php',
            type: 'POST',
            dataType: 'html',
            data: {
                identificador: $(this).attr("id")
            },
            error: function () {
                alert("Ha habido un error con los datos.");
            },
            success: function (datos) {
                $("#detalles").html(datos).hide().fadeIn(200);
            }
        });// Fin ajax
    }

    $(document).on("click", ".empleado", datos_empleado);
    //Método accesible, mietras pulse el INTRO del teclado.
    $(".empleado").keypress(function (e) {
        if (e.which === 13)
            datos_empleado();
    });

    function alta_Empleado() {
        $.ajax({
            url: './modulos/empleados/includes/empleados/insertarEmpleados.php',
            type: 'POST',
            dataType: 'html',
            data: {
            },
            error: function () {
                alert("Ha habido un error con los datos.");
            },
            success: function (datos) {
                $("article").html(datos).hide().fadeIn(200);
            }
        });// Fin ajax
    }

    $(document).on("click", "#altaEmpleado", alta_Empleado);
    //Método accesible, mietras pulse el INTRO del teclado.
    $("#altaEmpleado").keypress(function (e) {
        if (e.which === 13)
            alta_Empleado();
    });

    function guardar_Empleado() {
        var form = $('#formAlta')[0];
        var formData = new FormData(form);
        $.ajax({
            url: './modulos/empleados/includes/empleados/guardarEmpleado.php',
            type: 'POST',
            dataType: 'html',
            data: formData,
            error: function () {
                alert("Ha habido un error con los datos.");
            },
            success: function () {
                alert("¡Se ha insertado correctamente!");
            },
            cache: false,
            contentType: false,
            processData: false
        });// Fin ajax
    }

    $(document).on("click", "#guardarEmpleado", guardar_Empleado);
    //Método accesible, mietras pulse el INTRO del teclado.
    $("#guardarEmpleado").keypress(function (e) {
        if (e.which === 13)
            alta_Empleado();
    });

    function generar_contrasena() {
        $.ajax({
            url: './modulos/empleados/includes/empleados/generarContrasena.php',
            type: 'POST',
            dataType: 'html',
            data: {
            },
            error: function () {
                alert("Ha habido un error con los datos.");
            },
            success: function (datos) {
                $("#contrasena").val(datos);
            }
        });// Fin ajax
    }

    $(document).on("click", "#generarContrasena", generar_contrasena);
    //Método accesible, mietras pulse el INTRO del teclado.
    $("#generarContrasena").keypress(function (e) {
        if (e.which === 13)
            generar_contrasena();
    });







    //EVENTOS

    function lista_eventos() {
        $.ajax({
            url: './modulos/empleados/includes/eventos/listaEventos.php',
            type: 'POST',
            dataType: 'html',
            data: {
            },
            error: function () {
                alert("Ha habido un error con los datos.");
            },
            success: function (datos) {
                $("article").html(datos).hide().fadeIn(200);
            }
        });// Fin ajax
    }
    $(document).on("click", "#verEventos", lista_eventos);
    //Método accesible, mietras pulse el INTRO del teclado.
    $("#verEventos").keypress(function (e) {
        if (e.which === 13)
            lista_eventos();
    });

    function crear_eventos() {
        $.ajax({
            url: './modulos/empleados/includes/eventos/crearEvento.php',
            type: 'POST',
            dataType: 'html',
            data: {
            },
            error: function () {
                alert("Ha habido un error con los datos.");
            },
            success: function (datos) {
                $("article").html(datos).hide().fadeIn(200);
            }
        });// Fin ajax
    }
    $(document).on("click", "#crearEventos", crear_eventos);
    //Método accesible, mietras pulse el INTRO del teclado.
    $("#crearEventos").keypress(function (e) {
        if (e.which === 13)
            crear_eventos();
    });

    function guardar_evento() {
        var cat = [];
        var emp = [];
        var confirmar = 0;
        $(".categorias:checked").each(function () {
            cat.push($(this).attr("id"));
        });
        $(".empleados:checked").each(function () {
            emp.push($(this).attr("id"));
        });
        if ($("#confirmar").is(":checked")) {
            confirmar = 1;
        }
        $.ajax({
            url: './modulos/empleados/includes/eventos/guardarEvento.php',
            type: 'POST',
            dataType: 'html',
            data: {
                nombre: $("#nombre").val(),
                fecha: $("#fecha").val(),
                confirmar: confirmar,
                categorias: cat.join(),
                empleados: emp.join()
            },
            error: function () {
                alert("Ha habido un error con los datos.");
            },
            success: function () {
                alert("Evento guardado correctamente");
            }
        });// Fin ajax
    }
    $(document).on("click", "#guardarEvento", guardar_evento);
    //Método accesible, mietras pulse el INTRO del teclado.
    $("#guardarEvento").keypress(function (e) {
        if (e.which === 13)
            guardar_evento();
    });

    function categorias_eventos() {
        $.ajax({
            url: './modulos/empleados/includes/eventos/verCategorias.php',
            type: 'POST',
            dataType: 'html',
            data: {
            },
            error: function () {
                alert("Ha habido un error con los datos.");
            },
            success: function (datos) {
                $("article").html(datos).hide().fadeIn(200);
            }
        });// Fin ajax
    }
    $(document).on("click", "#categoriasEventos", categorias_eventos);
    //Método accesible, mietras pulse el INTRO del teclado.
    $("#categoriasEventos").keypress(function (e) {
        if (e.which === 13)
            categorias_eventos();
    });

    function crear_categoria_evento() {
        $.ajax({
            url: './modulos/empleados/includes/eventos/crearCategoria.php',
            type: 'POST',
            dataType: 'html',
            data: {
                nombre: $("#nombre").val()
            },
            error: function () {
                alert("Ha habido un error con los datos.");
            },
            success: function () {
                alert("Categoria añadida.");
                categorias_eventos();
            }
        });// Fin ajax
    }
    $(document).on("click", "#crearCategoriaEventos", crear_categoria_evento);
    //Método accesible, mietras pulse el INTRO del teclado.
    $("#crearCategoriaEventos").keypress(function (e) {
        if (e.which === 13)
            crear_categoria_evento();
    });

    function editar_categoria_evento() {
        $.ajax({
            url: './modulos/empleados/includes/eventos/editarCategoria.php',
            type: 'POST',
            dataType: 'html',
            data: {
                identificador: $(this).attr("id")
            },
            error: function () {
                alert("Ha habido un error con los datos.");
            },
            success: function (datos) {
                $("#editarCategoria").html(datos).hide().fadeIn(200);
            }
        });// Fin ajax
    }
    $(document).on("click", ".categoriaEventos", editar_categoria_evento);
    //Método accesible, mietras pulse el INTRO del teclado.
    $(".categoriaEventos").keypress(function (e) {
        if (e.which === 13)
            editar_categoria_evento();
    });

    function actualizar_categoria_evento() {
        $.ajax({
            url: './modulos/empleados/includes/eventos/actualizarCategoria.php',
            type: 'POST',
            dataType: 'html',
            data: {
                id_categoria: $("#idModificar").text(),
                nombre: $("#nombreModificar").val()
            },
            error: function () {
                alert("Ha habido un error con los datos.");
            },
            success: function () {
                alert("Categoría modificada.");
                categorias_eventos();
            }
        });// Fin ajax
    }
    $(document).on("click", "#modificarCategoriaEvento", actualizar_categoria_evento);
    //Método accesible, mietras pulse el INTRO del teclado.
    $("#modificarCategoriaEvento").keypress(function (e) {
        if (e.which === 13)
            actualizar_categoria_evento();
    });

    function borrar_categoria_evento() {
        $.ajax({
            url: './modulos/empleados/includes/eventos/borrarCategoria.php',
            type: 'POST',
            dataType: 'html',
            data: {
                id_categoria: $("#idModificar").text()
            },
            error: function () {
                alert("Ha habido un error con los datos.");
            },
            success: function (datos) {
                alert(datos);
                categorias_eventos();
            }
        });// Fin ajax
    }
    $(document).on("click", "#borrarCategoriaEvento", borrar_categoria_evento);
    //Método accesible, mietras pulse el INTRO del teclado.
    $("#borrarCategoriaEvento").keypress(function (e) {
        if (e.which === 13)
            borrar_categoria_evento();
    });



    //DIETAS

    function crear_dieta() {
        $.ajax({
            url: './modulos/empleados/includes/dietas/insertarDieta.php',
            type: 'POST',
            dataType: 'html',
            data: {
            },
            error: function () {
                alert("Ha habido un error con los datos.");
            },
            success: function (datos) {
                $("article").html(datos).hide().fadeIn(200);
            }
        });// Fin ajax
    }
    $(document).on("click", "#crearDieta", crear_dieta);
    //Método accesible, mietras pulse el INTRO del teclado.
    $("#crearDieta").keypress(function (e) {
        if (e.which === 13)
            crear_dieta();
    });

    function guardar_dieta() {
        $.ajax({
            url: './modulos/empleados/includes/dietas/guardarDieta.php',
            type: 'POST',
            dataType: 'html',
            data: {
                id_empleado: $("#id_empleado").val(),
                categoria: $("#categoria").val(),
                importe: $("#importe").val(),
                fecha: $("#fecha").val()
            },
            error: function () {
                alert("Ha habido un error con los datos.");
            },
            success: function () {
                alert("Dieta creada.");
                crear_dieta();
            }
        });// Fin ajax
    }
    $(document).on("click", "#guardarDieta", guardar_dieta);
    //Método accesible, mietras pulse el INTRO del teclado.
    $("#guardarDieta").keypress(function (e) {
        if (e.which === 13)
            guardar_dieta();
    });

    function categorias_dietas() {
        $.ajax({
            url: './modulos/empleados/includes/dietas/verCategorias.php',
            type: 'POST',
            dataType: 'html',
            data: {
            },
            error: function () {
                alert("Ha habido un error con los datos.");
            },
            success: function (datos) {
                $("article").html(datos).hide().fadeIn(200);
            }
        });// Fin ajax
    }
    $(document).on("click", "#categoriasDietas", categorias_dietas);
    //Método accesible, mietras pulse el INTRO del teclado.
    $("#guardarDieta").keypress(function (e) {
        if (e.which === 13)
            categorias_dietas();
    });

    function crear_categoria_dieta() {
        $.ajax({
            url: './modulos/empleados/includes/dietas/crearCategoria.php',
            type: 'POST',
            dataType: 'html',
            data: {
                nombre: $("#nombre").val(),
                descripcion: $("#descripcion").val()
            },
            error: function () {
                alert("Ha habido un error con los datos.");
            },
            success: function (datos) {
                alert("Categoria añadida.");
                categorias_dietas();
            }
        });// Fin ajax
    }
    $(document).on("click", "#crearCategoriaDietas", crear_categoria_dieta);
    //Método accesible, mietras pulse el INTRO del teclado.
    $("#crearCategoriaDietas").keypress(function (e) {
        if (e.which === 13)
            crear_categoria_dieta();
    });




    /*********************************************
     *          	mensajes                 	*
     *********************************************/
    function crear_mensaje() {
        $.ajax({
            url: './modulos/empleados/includes/mensajeria/crearMensaje.php',
            type: 'POST',
            dataType: 'html',
            data: {
            },
            error: function () {
                alert("Ha habido un error con los datos.");
            },
            success: function (datos) {
                $("article").html(datos).hide().fadeIn(200);
            }
        });// Fin ajax
    }
    $(document).on("click", "#enviarMensaje", crear_mensaje);
    //Método accesible, mietras pulse el INTRO del teclado.
    $("#enviarMensaje").keypress(function (e) {
        if (e.which === 13)
            crear_mensaje();
    });


    function enviar_mensaje() {
        var fechaActual = (new Date()).toISOString().substring(0, 10);
        var emp = [];
        $(".empleados:checked").each(function () {
            emp.push($(this).attr("id"));
        });
        $.ajax({
            url: './modulos/empleados/includes/mensajeria/guardarMensaje.php',
            type: 'POST',
            dataType: 'html',
            data: {
                id_emp_emisor: $("#id_empleado_emisor").val(),
                contenido: $("#contenido").val(),
                fecha: fechaActual,
                empleados: emp.join()
            },
            error: function () {
                alert("Ha habido un error con los datos.");
            },
            success: function () {
                alert("¡Mensaje enviado correctamente!");
                crear_mensaje();
            }
        });
    }
    $(document).on("click", "#btEnviarMensaje", enviar_mensaje);
    //Método accesible, mietras pulse el INTRO del teclado.
    $("#btEnviarMensaje").keypress(function (e) {
        if (e.which === 13)
            enviar_mensaje();
    });


    function leer_mensajes() {
        $.ajax({
            url: './modulos/empleados/includes/mensajeria/leerMensajes.php',
            type: 'POST',
            dataType: 'html',
            data: {
            },
            error: function () {
                alert("Ha habido un error con los datos.");
            },
            success: function (datos) {
                $("article").html(datos).hide().fadeIn(200);
            }
        });// Fin ajax
    }
    $(document).on("click", "#leerMensajes", leer_mensajes);
    //Método accesible, mietras pulse el INTRO del teclado.
    $("#leerMensajes").keypress(function (e) {
        if (e.which === 13)
            leer_mensajes();
    });

    function listar_mensajes() {
        $.ajax({
            url: './modulos/empleados/includes/mensajeria/buscarMensajes.php',
            type: 'POST',
            dataType: 'html',
            data: {
                identificador: $("#id_empleado_emisor").val()
            },
            error: function () {
                alert("Ha habido un error con los datos.");
            },
            success: function (datos) {
                $("#listaMensajes").html(datos).hide().fadeIn(200);
            }
        });// Fin ajax
    }
    $(document).on("click", "#listarMensajes", listar_mensajes);
    //Método accesible, mietras pulse el INTRO del teclado.
    $("#listarMensajes").keypress(function (e) {
        if (e.which === 13)
            listar_mensajes();
    });

    function marcar_mensaje_leido() {
        $(this).prop('disabled', true);
        $(this).text("Leído");
        $.ajax({
            url: './modulos/empleados/includes/mensajeria/marcarLeido.php',
            type: 'POST',
            dataType: 'html',
            data: {
                identificador: $(this).attr("id")
            },
            error: function () {
                alert("Ha habido un error con los datos.");
            },
            success: function () {
            }
        });// Fin ajax
    }
    $(document).on("click", ".marcarLeido", marcar_mensaje_leido);
    //Método accesible, mietras pulse el INTRO del teclado.
    $(".marcarLeido").keypress(function (e) {
        if (e.which === 13)
            marcar_mensaje_leido();
    });

    /******************************************
     *              compras                    *
     *******************************************/

    function crear_compra() {
        $.ajax({
            url: './modulos/empleados/includes/compras/crearCompra.php',
            type: 'POST',
            dataType: 'html',
            data: {
            },
            error: function () {
                alert("Ha habido un error con los datos.");

            },
            success: function (datos) {
                $("article").html(datos).hide().fadeIn(200);
            }
        });// Fin ajax
    }
    $(document).on("click", "#compras", crear_compra);
    //Método accesible, mietras pulse el INTRO del teclado.
    $("#enviarMensaje").keypress(function (e) {
        if (e.which === 13)
            crear_compra();
    });

    function guardar_pedido() {
        var fechaActual = (new Date()).toISOString().substring(0, 10);
        $.ajax({
            url: './modulos/empleados/includes/compras/guardarPedido.php',
            type: 'POST',
            dataType: 'html',
            data: {
                id_empleado: $("#id_empleado").val(),
                id_producto: $("#id_producto").val(),
                cantidad: $("#cantidad").val(),
                fecha: fechaActual
            },
            error: function () {
                alert("Ha habido un error con los datos.");
            },
            success: function () {
                alert("Pedido realizado.");
                crear_compra();
            }
        });// Fin ajax

    }
    $(document).on("click", "#btHacerPedido", guardar_pedido);
    //Método accesible, mietras pulse el INTRO del teclado.
    $("#btHacerPedido").keypress(function (e) {
        if (e.which === 13)
            guardar_pedido();
    });




    // Informes

    function informe() {
        $.ajax({
            url: './modulos/empleados/includes/informes/mostrarVentana.php',
            type: 'POST',
            dataType: 'html',
            data: {
            },
            error: function () {
                alert("Ha habido un error con los datos.");
            },
            success: function (datos) {
                $("article").html(datos).hide().fadeIn(200);
            }
        });// Fin ajax

    }
    $(document).on("click", "#informes", informe);
    //Método accesible, mietras pulse el INTRO del teclado.
    $("#informes").keypress(function (e) {
        if (e.which === 13)
            informe();
    });

    function ordenarInforme() {
        $.ajax({
            url: './modulos/empleados/includes/informes/ordenarEmpleados.php',
            type: 'POST',
            dataType: 'html',
            data: {
                orden: $(this).attr("id")
            },
            error: function () {
                alert("Ha habido un error con los datos.");
            },
            success: function (datos) {
//                alert(datos);
                $("#informeEmp").html(datos).hide().fadeIn(200);
            }
        });// Fin ajax

    }
    $(document).on("click", ".infoOrdenar", ordenarInforme);
    //Método accesible, mietras pulse el INTRO del teclado.
    $(".infoOrdenar").keypress(function (e) {
        if (e.which === 13)
            ordenarInforme();
    });

    function generarPDF() {
        $.ajax({
            url: './modulos/empleados/includes/informes/generarPDF.php',
            type: 'POST',
            dataType: 'html',
            data: {
            },
            error: function () {
                alert("Ha habido un error con los datos.");
            },
            success: function () {
            }
        });// Fin ajax

    }
    $(document).on("click", "#generarPDF", generarPDF);
    //Método accesible, mietras pulse el INTRO del teclado.
    $("#generarPDF").keypress(function (e) {
        if (e.which === 13)
            generarPDF();
    });

});// Fin document.ready
