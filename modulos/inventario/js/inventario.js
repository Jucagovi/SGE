$(document).ready(function (e) {
    /////////////////////////////////////////////// PRODUCTOS ////////////////////////////////////////////// 
    function listarProductos() {
        $.ajax({
            url: './modulos/inventario/includes/productos/listarProductos.php',
            type: 'POST',
            dataType: 'html',
            error: function () {
                alert("Ha habido un error con los datos.");
            },
            success: function (datos) {
                $("article").html(datos).hide().fadeIn(200);
            }
        });
    }
    $(document).on("click", "#productos", listarProductos);
    $("#productos").keypress(function (e) {
        if (e.which === 13)
            listarProductos();
    });

    function crearProducto() {
        $.ajax({
            url: './modulos/inventario/includes/productos/crearProducto.php',
            type: 'POST',
            dataType: 'html',
            error: function () {
                alert("Ha habido un error con los datos.");
            },
            success: function (datos) {
                $("article").html(datos).hide().fadeIn(200);
            }
        });
    }
    $(document).on("click", "#crearProducto", crearProducto);
    $("#crearProducto").keypress(function (e) {
        if (e.which === 13)
            crearProducto();
    });

    function insertarProducto() {
        var id_pasillo = $('select[id=jcb_pasillos]').val();
        var cantidad = $('#cantidad').val();
        if (id_pasillo == 0) {
            alert('Debes seleccionar un pasillo');
        }else if(cantidad < 0){
            alert('Debes añadir una cantidad')
        }else {
            var fechaActual = (new Date()).toISOString().substring(0, 10);
            $.ajax({
                url: './modulos/inventario/includes/productos/crearProducto.php',
                type: 'POST',
                dataType: 'html',
                data: {
                    nombre: $("#nombre").val(),
                    descripcion: $("#descripcion").val(),
                    fecha_alta: fechaActual,
                    id_tipo_producto: $('select[id=form_tipos]').val(),
                    cod_barras: $("#cod_barras").val(),
                    precio: $("#precio").val(),
                    coste: $("#coste").val(),
                    peso: $("#peso").val(),
                    volumen: $("#volumen").val(),
                    id_categoria: $('select[id=form_categorias]').val(),
                    id_pasillo: id_pasillo,
                    cantidad: cantidad
                },
                error: function (datos) {
                    alert(datos);
                },
                success: function (datos) {
                    alert(datos);
                }
            });// Fin 
        }
    }

    $(document).on("click", "#insertar_producto", insertarProducto);
    $("#insertar_producto").keypress(function (e) {
        if (e.which === 13)
            insertarProducto();
    });

    function mostrarEditarProducto() {
        $.ajax({
            url: './modulos/inventario/includes/productos/editarProducto.php',
            type: 'POST',
            dataType: 'html',
            data: {
                id_producto: $(this).attr("id")
            },
            error: function () {
                alert("Ha habido un error con los datos.");
            },
            success: function (datos) {
                $("article").html(datos).hide().fadeIn(200);
            }
        });
    }
    $(document).on("click", ".formulario_editar_producto", mostrarEditarProducto);
    $(".formulario_editar_producto").keypress(function (e) {
        if (e.which === 13)
            mostrarEditarProducto();
    });

    function editarProducto() {
        var fechaActual = (new Date()).toISOString().substring(0, 10);
        $.ajax({
            url: './modulos/inventario/includes/productos/editarProducto.php',
            type: 'POST',
            dataType: 'html',
            data: {
                editar: true,
                id_producto: $(this).attr('class'),
                nombre: $("#nombre").val(),
                descripcion: $("#descripcion").val(),
                id_tipo_producto: $('select[id=form_tipos]').val(),
                cod_barras: $("#cod_barras").val(),
                precio: $("#precio").val(),
                coste: $("#coste").val(),
                peso: $("#peso").val(),
                volumen: $("#volumen").val(),
                id_categoria: $('select[id=form_categorias]').val()
            },
            error: function () {
                alert("Error");
            },
            success: function (datos) {
                $("article").html(datos).hide().fadeIn(200);
            }
        });// Fin 
    }
    $(document).on("click", "#editar_producto", editarProducto);
    $("#editar_producto").keypress(function (e) {
        if (e.which === 13)
            editarProducto();
    });

    function listarAlmacenes() {
        $("#jcb_almacenes").html('');
        $("#jcb_secciones").html('');
        $("#jcb_pasillos").html('');
        $.ajax({
            url: './modulos/inventario/includes/productos/listarAlmacenes.php',
            type: 'POST',
            dataType: 'html',
            data: {
                id_inventario: $("#jcb_inventarios").val()
            },
            success: function (datos) {
                $("#jcb_almacenes").html(datos);
                listarSecciones();
            }
        });
    }
    $(document).on("change", "#jcb_inventarios", listarAlmacenes);

    function listarAtributos() {
        $("#cb_atributos").html('');
        $.ajax({
            url: './modulos/inventario/includes/categorias/optionAtributos.php',
            type: 'POST',
            dataType: 'html',
            data: {
                id_producto: $("#cb_productos").val()
            },
            success: function (datos) {
                $("#cb_atributos").html(datos);
            }
        });
    }
    $(document).on("change", "#cb_productos", listarAtributos);
    
    function listarSecciones() {
        $("#jcb_secciones").html('');
        $("#jcb_pasillos").html('');
        $.ajax({
            url: './modulos/inventario/includes/productos/listarSecciones.php',
            type: 'POST',
            dataType: 'html',
            data: {
                id_almacen: $("#jcb_almacenes").val()
            },
            success: function (datos) {
                $("#jcb_secciones").html(datos);
                listarPasillos();
            }
        });
    }
    $(document).on("change", "#jcb_almacenes", listarSecciones);

    function listarPasillos() {
        $("#jcb_pasillos").html('');
        $.ajax({
            url: './modulos/inventario/includes/productos/listarPasillos.php',
            type: 'POST',
            dataType: 'html',
            data: {
                id_seccion: $("#jcb_secciones").val()
            },
            success: function (datos) {
                $("#jcb_pasillos").html(datos);
            }
        });
    }
    $(document).on("change", "#jcb_secciones", listarPasillos);


    function extraerCSV() {
        document.location.href = './modulos/inventario/includes/productos/extraerProductosCSV.php';
    }
    $(document).on("click", "#extraerCsv", extraerCSV);
    $("#extraerCsv").keypress(function (e) {
        if (e.which === 13)
            extraerCSV();
    });

    /////////////////////////////////////////////// CATEGORIAS ////////////////////////////////////////////// 
    function insertarCategoria() {
        $.ajax({
            url: './modulos/inventario/includes/categorias/insertar_categoria.php',
            type: 'POST',
            dataType: 'html',
            data: {
                nombre: $("#nombre").val(),
            },
            error: function () {
                alert(datos);
            },
            success: function (datos) {
                $("article").html(datos).hide().fadeIn(200);
            }
        });// Fin 
    }
    $(document).on("click", "#insertar_categoria", insertarCategoria);
    $("#insertar_categoria").keypress(function (e) {
        if (e.which === 13)
            insertarCategoria();
    });


    function listarCategorias() {
        $.ajax({
            url: './modulos/inventario/includes/categorias/listarCategorias.php',
            type: 'POST',
            dataType: 'html',
            error: function () {
                alert("Ha habido un error con los datos.");
            },
            success: function (datos) {
                $("article").html(datos).hide().fadeIn(200);
            }
        });
    }
    $(document).on("click", "#categorias", listarCategorias);
    $("#categorias").keypress(function (e) {
        if (e.which === 13)
            listarCategorias();
    });

    function obtenerIdCategoria() {
        $.ajax({
            url: './modulos/inventario/includes/categorias/listarAtributosPorCategoria.php',
            type: 'POST',
            dataType: 'html',
            data: {
                id: $("#form_categorias").val()
            },
            error: function () {
                alert("Ha habido un error con los datos.");
            },
            success: function (datos) {
                $("#tabla_atributos_categoria").html(datos).hide().fadeIn(200);
            }
        });
    }
    $(document).on("change", "#form_categorias", obtenerIdCategoria);

    /////////////////////////////////////////////// ATRIBUTOS ////////////////////////////////////////////// 
    function formularioAtributo() {
        $.ajax({
            url: './modulos/inventario/includes/categorias/formularioAtributo.php',
            type: 'POST',
            dataType: 'html',
            error: function () {
                alert(datos);
            },
            success: function (datos) {
                $("article").html(datos).hide().fadeIn(200);
            }
        });// Fin 
    }
    $(document).on("click", "#crearAtributos", formularioAtributo);
    $("#crearAtributos").keypress(function (e) {
        if (e.which === 13)
            formularioAtributo();
    });

    function insertarAtributo() {
        $.ajax({
            url: './modulos/inventario/includes/categorias/insertar_Atributo.php',
            type: 'POST',
            dataType: 'html',
            data: {
                nombre: $("#nombre").val(),
                descripcion: $("#descripcion").val(),
                id: $("#form_categorias").val()
            },
            error: function () {
                alert(datos);
            },
            success: function (datos) {
                $("article").html(datos).hide().fadeIn(200);
            }
        });// Fin 
    }
    $(document).on("click", "#insertar_atributo", insertarAtributo);
    $("#insertar_atributo").keypress(function (e) {
        if (e.which === 13)
            insertarAtributo();
    });
    
    function listarCategorias() {
        $.ajax({
            url: './modulos/inventario/includes/categorias/listarCategorias.php',
            type: 'POST',
            dataType: 'html',
            error: function () {
                alert("Ha habido un error con los datos.");
            },
            success: function (datos) {
                $("article").html(datos).hide().fadeIn(200);
            }
        });
    }
    $(document).on("click", "#categorias", listarCategorias);
    $("#categorias").keypress(function (e) {
        if (e.which === 13)
            listarCategorias();
    });

    // VALORES

    function listarTablaValores() {
        $.ajax({
            url: './modulos/inventario/includes/categorias/listarValores.php',
            type: 'POST',
            dataType: 'html',
            error: function (datos) {
                alert(datos);
            },
            success: function (datos) {
                $("article").html(datos).hide().fadeIn(200);
            }
        });// Fin 
    }
    $(document).on("click", "#asignarValores", listarTablaValores);
    $("#asignarValores").keypress(function (e) {
        if (e.which === 13)
            listarTablaValores();
    });
    
     function insertarValor() {
        $.ajax({
            url: './modulos/inventario/includes/categorias/insertar_valor.php',
            type: 'POST',
            dataType: 'html',
            data: {
                valor: $("#valor").val(),
                idPro: $("#cb_productos").val(),
                idAtr: $("#cb_atributos").val()
            },
            error: function () {
                alert(datos);
            },
            success: function (datos) {
                $("article").html(datos).hide().fadeIn(200);
            }
        });// Fin 
    }
    $(document).on("click", "#insertar_valor", insertarValor);
    $("#insertar_valor").keypress(function (e) {
        if (e.which === 13)
            insertarValor();
    });
    
    //Inventario
    
    function listarInventario() {
        $.ajax({
            url: './modulos/inventario/includes/inventario/listarInventario.php',
            type: 'POST',
            dataType: 'html',
            error: function () {
                alert(datos);
            },
            success: function (datos) {
                $("article").html(datos).hide().fadeIn(200);
            }
        });// Fin 
    }
    $(document).on("click", "#list_inventario", listarInventario);
    $("#list_inventario").keypress(function (e) {
        if (e.which === 13)
            listarInventario();
    });
    
    function insertarInventario() {
        $.ajax({
            url: './modulos/inventario/includes/inventario/insertar_inventario.php',
            type: 'POST',
            dataType: 'html',
            data: {
                nombre: $("#nombre").val()
            },
            error: function () {
                alert(datos);
            },
            success: function (datos) {
                $("article").html(datos).hide().fadeIn(200);
            }
        });// Fin 
    }
    $(document).on("click", "#insertar_inventario", insertarInventario);
    $("#insertar_inventario").keypress(function (e) {
        if (e.which === 13)
            insertarInventario();
    });

    
    function obtenerIdInventario() {
        $.ajax({
            url: './modulos/inventario/includes/inventario/listarAlmacenesPorInventario.php',
            type: 'POST',
            dataType: 'html',
            data: {
                idInv: $("#jcbInvAlm").val()
            },
            error: function () {
                alert("Ha habido un error con los datos.");
            },
            success: function (datos) {
                $("#tablaAlmInv").html(datos).hide().fadeIn(200);
            }
        });
    }
    $(document).on("change", "#jcbInvAlm", obtenerIdInventario);

    //Almacen
    function listarAlmacen() {
        $.ajax({
            url: './modulos/inventario/includes/inventario/listarAlmacenes.php',
            type: 'POST',
            dataType: 'html',
            error: function (datos) {
                alert(datos);
            },
            success: function (datos) {
                $("article").html(datos).hide().fadeIn(200);
            }
        });// Fin 
    }
    $(document).on("click", "#mostrarAlmacenes", listarAlmacen);
    $("#mostrarAlmacenes").keypress(function (e) {
        if (e.which === 13)
            listarAlmacen();
    });

    function insertarAlmacen() {
        $.ajax({
            url: './modulos/inventario/includes/inventario/insertar_almacen.php',
            type: 'POST',
            dataType: 'html',
            data: {
                nombre: $("#nombre").val(),
                idInv: $("#jcbInvAlm").val()
            },
            error: function (datos) {
                alert(datos);
            },
            success: function (datos) {
                $("article").html(datos).hide().fadeIn(200);
            }
        });// Fin 
    }
    $(document).on("click", "#insertar_almacen", insertarAlmacen);
    $("#insertar_almacen").keypress(function (e) {
        if (e.which === 13)
            insertarAlmacen();
    });

    //Secciones
    function listarSeccionesTabla() {
        $.ajax({
            url: './modulos/inventario/includes/inventario/listarSecciones.php',
            type: 'POST',
            dataType: 'html',
            error: function (datos) {
                alert(datos);
            },
            success: function (datos) {
                $("article").html(datos).hide().fadeIn(200);
            }
        });// Fin 
    }
    $(document).on("click", "#mostrarSecciones", listarSeccionesTabla);
    $("#mostrarSecciones").keypress(function (e) {
        if (e.which === 13)
            listarSeccionesTabla();
    });

    function insertarSeccion() {
        $.ajax({
            url: './modulos/inventario/includes/inventario/insertar_seccion.php',
            type: 'POST',
            dataType: 'html',
            data: {
                nombre: $("#nombre").val(),
                idAlm: $("#jcb_almacenes").val()
            },
            error: function (datos) {
                alert(datos);
            },
            success: function (datos) {
                $("article").html(datos).hide().fadeIn(200);
            }
        });// Fin 
    }
    $(document).on("click", "#insertar_seccion", insertarSeccion);
    $("#insertar_seccion").keypress(function (e) {
        if (e.which === 13)
            insertarSeccion();
    });
    
    //Pasillos
    function listarPasillosTabla() {
        $.ajax({
            url: './modulos/inventario/includes/inventario/listarPasillos.php',
            type: 'POST',
            dataType: 'html',
            error: function (datos) {
                alert(datos);
            },
            success: function (datos) {
                $("article").html(datos).hide().fadeIn(200);
            }
        });// Fin 
    }
    $(document).on("click", "#mostrarPasillos", listarPasillosTabla);
    $("#mostrarPasillos").keypress(function (e) {
        if (e.which === 13)
            listarPasillosTabla();
    });

    function insertarPasillo() {
        $.ajax({
            url: './modulos/inventario/includes/inventario/insertar_pasillo.php',
            type: 'POST',
            dataType: 'html',
            data: {
                nombre: $("#nombre").val(),
                idSec: $("#jcb_secciones").val()
            },
            error: function (datos) {
                alert(datos);
            },
            success: function (datos) {
                $("article").html(datos).hide().fadeIn(200);
            }
        });// Fin 
    }
    $(document).on("click", "#insertar_pasillo", insertarPasillo);
    $("#insertar_pasillo").keypress(function (e) {
        if (e.which === 13)
            insertarPasillo();
    });
    
     //Transferencia
    function listarTransferenciasTabla() {
        $.ajax({
            url: './modulos/inventario/includes/transferencias/listarTransferencias.php',
            type: 'POST',
            dataType: 'html',
            error: function (datos) {
                alert(datos);
            },
            success: function (datos) {
                $("article").html(datos).hide().fadeIn(200);
            }
        });// Fin 
    }
    $(document).on("click", "#transferencias", listarTransferenciasTabla);
    $("#transferencias").keypress(function (e) {
        if (e.which === 13)
            listarTransferenciasTabla();
    });
    
    //Informes
    function extraerPDF() {
        document.location.href = './modulos/inventario/includes/productos/extraerProductosPDF.php';
    }
    $(document).on("click", "#informeProductos", extraerPDF);
    $("#informeProductos").keypress(function (e) {
        if (e.which === 13)
            extraerPDF();
    });
});          