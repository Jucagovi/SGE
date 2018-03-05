$(document).ready(function(e) {
  //////////////////////   INICIO Clientes  ////////////////////////////////
     function  mostrarBuscador(){
         $.ajax({
              url: './modulos/ventas/includes/inicioCliente.php',
              type: 'POST',
              dataType: 'html',
              error: function(){
                  alert("Ha habido un error con los datos.");
              },
              success: function(datos){
              $("article").html(datos).hide().fadeIn(200);
              }
          });// Fin ajax
     }
     $(document).on("click", "#Clientes", mostrarBuscador);
     $("#Clientes").keypress(function(e){ if(e.which === 13) imprimirSecciones(); });
//////////////////////// Mostrar Clientes Buscados  //////////////////////////
     function mostrarClientes(){
       var nombre = $('#buscarCliente').val();
        if($.trim(nombre).length > 0){
       $.ajax({
            url: './modulos/ventas/includes/mostrarClientes.php',
            type: 'POST',
            dataType: 'html',
          data: {
            nombre:nombre
          },
            error: function(){
                alert("Ha habido un error con los datos.");
            },
            success: function(datos){
                $("#resultado").html(datos).hide().fadeIn(200);
            }
        });// Fin ajax
      }
   }
   $(document).on("keyup", "#buscarCliente", mostrarClientes);
   $("#buscarCliente").keypress(function(e){ if(e.which === 13) imprimirTercera(); });
   ////////////////////     borrar cliente   ///////////////////////////////////
   function  BorrarCliente(){
       $.ajax({
            url: './modulos/ventas/includes/borrarCliente.php',
            type: 'POST',
            dataType: 'html',
          data: {
            id: $(this).attr("id")
          },
            error: function(){
                alert("Ha habido un error con los datos.");
            },
            success: function(datos){
            $("article").html(datos).hide().fadeIn(200);
            }
        });// Fin ajax
   }
   $(document).on("click", ".borrarCliente", BorrarCliente);
   $(".borrarCliente").keypress(function(e){ if(e.which === 13) imprimirSecciones(); });

   ////////////////////     Modificar  cliente   ///////////////////////////////////
   function modificarCliente(){
       $.ajax({
            url: './modulos/ventas/includes/modificarCliente.php',
            type: 'POST',
            dataType: 'html',
          data: {
            id: $(this).attr("id")
          },
            error: function(){
                alert("Ha habido un error con los datos.");
            },
            success: function(datos){
            $("article").html(datos).hide().fadeIn(200);
            }
        });// Fin ajax
   }
   $(document).on("click", ".modificarCliente", modificarCliente);
   $(".modificarCliente").keypress(function(e){ if(e.which === 13) imprimirSecciones(); });
////////////////////////////////////////// Guardar Modificacion   /////////////////////////////////////////
   function modificar(){
       $.ajax({
            url: './modulos/ventas/includes/GuardarModificacionCliente.php',
            type: 'POST',
            dataType: 'html',
          data: $("#formulario").serialize(),
            error: function(){
                alert("Ha habido un error con los datos.");
            },
            success: function(datos){
            $("article").html(datos).hide().fadeIn(200);
            }
        });// Fin ajax
   }
   $(document).on("click", "#modificarClien", modificar);
   $("#modificarClien").keypress(function(e){ if(e.which === 13) imprimirSecciones(); });
///////////////////////////////////  Crear Ciente ////////////////////////////////////////////////
function crearCliente(){
    $.ajax({
         url: './modulos/ventas/includes/crearCliente.php',
         type: 'POST',
         dataType: 'html',
         error: function(){
             alert("Ha habido un error con los datos.");
         },
         success: function(datos){
         $("article").html(datos).hide().fadeIn(200);
         }
     });// Fin ajax
}
$(document).on("click", "#crearCliente", crearCliente);
$("#crearCliente").keypress(function(e){ if(e.which === 13) imprimirSecciones(); });
});// Fin document.ready

///////////////////////////////////// Guardar Cliente ///////////////////////////////////////////
function GuardarCliente(){
    $.ajax({
         url: './modulos/ventas/includes/GuardarCliente.php',
         type: 'POST',
         dataType: 'html',
       data: $("#formularioGuardar").serialize(),
         error: function(){
             alert("Ha habido un error con los datos.");
         },
         success: function(datos){
         $("article").html(datos).hide().fadeIn(200);
         }
     });// Fin ajax
}
$(document).on("click", "#GuardarCliente", GuardarCliente);
$("#GuardarCliente").keypress(function(e){ if(e.which === 13) imprimirSecciones(); });
//
///
///
//                              C A T E G O R I A
//
//
//
//
     //////////////////////   Mostrar Categoria   ////////////////////////////////
        function  inicioCategorias(){
            $.ajax({
                 url: './modulos/ventas/includes/inicioCategoria.php',
                 type: 'POST',
                 dataType: 'html',
                 error: function(){
                     alert("Ha habido un error con los datos.");
                 },
                 success: function(datos){
                 $("article").html(datos).hide().fadeIn(200);
                 }
             });// Fin ajax
        }
        $(document).on("click", "#categorias", inicioCategorias);
        $("#categorias").keypress(function(e){ if(e.which === 13) imprimirSecciones(); });

///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////// Categorias //////////////////////////////////////////////////
     function mostrarCategorias(){
       $.ajax({
            url: './modulos/ventas/includes/mostrarCategorias.php',
            type: 'POST',
            dataType: 'html',
            error: function(){
                alert("Ha habido un error con los datos.");
            },
            success: function(datos){
                $("#resultado").html(datos).hide().fadeIn(200);
            }
        });// Fin ajax
      }

   $(document).on("click", "#mostrar", mostrarCategorias);
   $("#mostrar").keypress(function(e){ if(e.which === 13) imprimirTercera(); });
   ////////////////////     Modificar  categoria   ///////////////////////////////////
   function modificarCategorias(){
       $.ajax({
            url: './modulos/ventas/includes/modificarCategoria.php',
            type: 'POST',
            dataType: 'html',
          data: {
            id: $(this).attr("id")
          },
            error: function(){
                alert("Ha habido un error con los datos.");
            },
            success: function(datos){
            $("article").html(datos).hide().fadeIn(200);
            }
        });// Fin ajax
   }
   $(document).on("click", ".modificarCategoria", modificarCategorias);
   $(".modificarCategoria").keypress(function(e){ if(e.which === 13) imprimirSecciones(); });
//////////////////////////////////////////Guardar  Categoria  /////////////////////////////////////////
   function GuradarModificacion(){
       $.ajax({
            url: './modulos/ventas/includes/GuardarModificacionCategoria.php',
            type: 'POST',
            dataType: 'html',
          data: $("#FormularioCategoria").serialize(),
            error: function(){
                alert("Ha habido un error con los datos.");
            },
            success: function(datos){
            $("article").html(datos).hide().fadeIn(200);
            }
        });// Fin ajax
   }
   $(document).on("click", "#modificarCateg", GuradarModificacion);
   $("#modificarCateg").keypress(function(e){ if(e.which === 13) imprimirSecciones(); });

   ////////////////////     borrar cliente   ///////////////////////////////////
   function  BorrarCategoria(){
       $.ajax({
            url: './modulos/ventas/includes/borrarCategoria.php',
            type: 'POST',
            dataType: 'html',
          data: {
            id: $(this).attr("id")
          },
            error: function(){
                alert("Ha habido un error con los datos.");
            },
            success: function(datos){
            $("article").html(datos).hide().fadeIn(200);
            }
        });// Fin ajax
   }
   $(document).on("click", ".borrarCategoria", BorrarCategoria);
   $(".borrarCategoria").keypress(function(e){ if(e.which === 13) imprimirSecciones(); });
   ////////////////////     Guardar Categoria nueva   ///////////////////////////////////
   function  crearCategoria(){
       $.ajax({
            url: './modulos/ventas/includes/crearCategoria.php',
            type: 'POST',
            dataType: 'html',
            error: function(){
                alert("Ha habido un error con los datos.");
            },
            success: function(datos){
            $("article").html(datos).hide().fadeIn(200);
            }
        });// Fin ajax
   }
   $(document).on("click", "#crearCategoriaNueva", crearCategoria);
   $("#crearCategoriaNueva").keypress(function(e){ if(e.which === 13) imprimirSecciones(); });



   ////////////////////     Guardar Categoria nueva   ///////////////////////////////////
   function  GuardarCategoriaNueva(){
       $.ajax({
            url: './modulos/ventas/includes/GuardarCategoriaNueva.php',
            type: 'POST',
            dataType: 'html',
            data: $("#NuevaCategoria").serialize(),
            error: function(){
                alert("Ha habido un error con los datos.");
            },
            success: function(datos){
            $("article").html(datos).hide().fadeIn(200);
            }
        });// Fin ajax
   }
   $(document).on("click", "#GuardarCategoriaNueva", GuardarCategoriaNueva);
   $("#GuardarCategoriaNueva").keypress(function(e){ if(e.which === 13) imprimirSecciones(); });

   //
   ///
   ///
   //                              M E T D O    D E     P A G O
   //
   //
   //
   //
   //////////////////////   Mostrar Metodo de Pago   ////////////////////////////////
      function  inicioMetodoPago(){
          $.ajax({
               url: './modulos/ventas/includes/inicioMetodosPago.php',
               type: 'POST',
               dataType: 'html',
               error: function(){
                   alert("Ha habido un error con los datos.");
               },
               success: function(datos){
               $("article").html(datos).hide().fadeIn(200);
               }
           });// Fin ajax
      }
      $(document).on("click", "#Metodos", inicioMetodoPago);
      $("#Metodos").keypress(function(e){ if(e.which === 13) imprimirSecciones(); });

///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////// Mostrar Metodos de Pago //////////////////////////////////////////////////
   function mostrarMetodoPago(){
     $.ajax({
          url: './modulos/ventas/includes/mostrarMetodoPago.php',
          type: 'POST',
          dataType: 'html',
          error: function(){
              alert("Ha habido un error con los datos.");
          },
          success: function(datos){
              $("#resultado").html(datos).hide().fadeIn(200);
          }
      });// Fin ajax
    }

 $(document).on("click", "#mostrarMetodoPago", mostrarMetodoPago);
 $("#mostrarMetodoPago").keypress(function(e){ if(e.which === 13) imprimirTercera(); });
 ////////////////////     Modificar  Metodo Pago   ///////////////////////////////////
 function modificarMetodoPago(){
     $.ajax({
          url: './modulos/ventas/includes/modificarMetodoPago.php',
          type: 'POST',
          dataType: 'html',
        data: {
          id: $(this).attr("id")
        },
          error: function(){
              alert("Ha habido un error con los datos.");
          },
          success: function(datos){
          $("article").html(datos).hide().fadeIn(200);
          }
      });// Fin ajax
 }
 $(document).on("click", ".modificarMetodoPago", modificarMetodoPago);
 $(".modificarMetodoPago").keypress(function(e){ if(e.which === 13) imprimirSecciones(); });
//////////////////////////////////////////Guardar  Metodo de pago  /////////////////////////////////////////
 function GuradarModificacionMetodoPago(){
     $.ajax({
          url: './modulos/ventas/includes/GuradarModificacionMetodoPago.php',
          type: 'POST',
          dataType: 'html',
        data: $("#FormularioMetodoPago").serialize(),
          error: function(){
              alert("Ha habido un error con los datos.");
          },
          success: function(datos){
          $("article").html(datos).hide().fadeIn(200);
          }
      });// Fin ajax
 }
 $(document).on("click", "#modificarMetodoPago", GuradarModificacionMetodoPago);
 $("#modificarMetodoPago").keypress(function(e){ if(e.which === 13) imprimirSecciones(); });

 ////////////////////     borrar Metodo de pago   ///////////////////////////////////
 function  borrarMetodoPago(){
     $.ajax({
          url: './modulos/ventas/includes/borrarMetodoPago.php',
          type: 'POST',
          dataType: 'html',
        data: {
          id: $(this).attr("id")
        },
          error: function(){
              alert("Ha habido un error con los datos.");
          },
          success: function(datos){
          $("article").html(datos).hide().fadeIn(200);
          }
      });// Fin ajax
 }
 $(document).on("click", ".borrarMetodoPago", borrarMetodoPago);
 $(".borrarMetodoPago").keypress(function(e){ if(e.which === 13) imprimirSecciones(); });
 ////////////////////     mostrar Metodo Pago nueva   ///////////////////////////////////
 function  CrearMetodoPago(){
     $.ajax({
          url: './modulos/ventas/includes/CrearMetodoPago.php',
          type: 'POST',
          dataType: 'html',
          error: function(){
              alert("Ha habido un error con los datos.");
          },
          success: function(datos){
          $("article").html(datos).hide().fadeIn(200);
          }
      });// Fin ajax
 }
 $(document).on("click", "#CrearMetodoPago", CrearMetodoPago);
 $("#CrearMetodoPago").keypress(function(e){ if(e.which === 13) imprimirSecciones(); });

 ////////////////////     Guardar Metodo Pago nueva   ///////////////////////////////////
 function  GuardarMetodoPago(){
     $.ajax({
          url: './modulos/ventas/includes/GuardarMetodoPagoNueva.php',
          type: 'POST',
          dataType: 'html',
          data: $("#NuevoMetodoPago").serialize(),
          error: function(){
              alert("Ha habido un error con los datos.");
          },
          success: function(datos){
          $("article").html(datos).hide().fadeIn(200);
          }
      });// Fin ajax
    }
 $(document).on("click", "#GuardarMetodoPagoNueva", GuardarMetodoPago);
 $("#GuardarMetodoPagoNueva").keypress(function(e){ if(e.which === 13) imprimirSecciones(); });

 //
 ///
 ///
 //                                T  P  V
 //
 //
 //
 //
///////////////////////////////////   TPV     //////////////////////////////
   function mostrarTPV(){ //Todos los mostrarAlgo llaman a un php que invoca a la funcion de la clase que muestra un
     $.ajax({             //listado del tipo de la clase (en este caso muestra TPVs)
          url: './modulos/ventas/includes/tpv.php',
          type: 'POST',
          dataType: 'html',
          error: function(){
              alert("Ha habido un error.");
          },
          success: function(datos){
            $("article").html(datos).hide().fadeIn(200);
          }
      });
   }
   $(document).on("click", "#tpv", mostrarTPV ); //Se invoca al hacer click en la sección/subsección correspondiente

   function formCrearTPV(){ //Todos los formCrearAlgo llaman al fomulario de creación de un objeto del tipo de la clase
     $.ajax({
          data: {metodo: "crear"},
          url: './modulos/ventas/includes/formularioTPV.php',
          type: 'POST',
          dataType: 'html',
          error: function(){
              alert("Ha habido un error.");
          },
          success: function(datos){
            $("article").html(datos).hide().fadeIn(200);
          }
      });
   }
   $(document).on("click", ".addTPV", formCrearTPV );

   function formModifTPV(){
     $.ajax({
          data: {
            id: $(this).attr("id"),
            metodo: "modif"
          },
          url: './modulos/ventas/includes/formularioTPV.php',
          type: 'POST',
          dataType: 'html',
          error: function(){
              alert("Ha habido un error.");
          },
          success: function(datos){
            $("article").html(datos).hide().fadeIn(200);
          }
      });
   }
   $(document).on("click", ".modTPV", formModifTPV );
   //
   ///
   ///
   //                                E Q U I P O S
   //
   //
   //
   //
  ///////////////////////////////////   EQUIPOS     //////////////////////////////
   function mostrarEquipos(){ //Lo demás igual
     $.ajax({
          url: './modulos/ventas/includes/equipo.php',
          type: 'POST',
          dataType: 'html',
          error: function(){
              alert("Ha habido un error.");
          },
          success: function(datos){
            $("article").html(datos).hide().fadeIn(200);
          }
      });
   }
   $(document).on("click", "#equipos", mostrarEquipos );

   function formCrearEquipo(){
     $.ajax({
          data: {metodo: "crear"},
          url: './modulos/ventas/includes/formularioEquipo.php',
          type: 'POST',
          dataType: 'html',
          error: function(){
              alert("Ha habido un error.");
          },
          success: function(datos){
            $("article").html(datos).hide().fadeIn(200);
          }
      });
   }
   $(document).on("click", ".addEquipo", formCrearEquipo );
   //
   ///
   ///
   //                              C O M E R C I A L E S
   //
   //
   //
   //
  ///////////////////////////////////   COMERCIALES     //////////////////////////////
   function mostrarComerciales(){
     $.ajax({
          url: './modulos/ventas/includes/comercial.php',
          type: 'POST',
          dataType: 'html',
          error: function(){
              alert("Ha habido un error.");
          },
          success: function(datos){
            $("article").html(datos).hide().fadeIn(200);
          }
      });
   }
   $(document).on("click", "#comerciales", mostrarComerciales );

   function formCrearComercial(){
     $.ajax({
          data: {metodo: "crear"},
          url: './modulos/ventas/includes/formularioComercial.php',
          type: 'POST',
          dataType: 'html',
          error: function(){
              alert("Ha habido un error.");
          },
          success: function(datos){
            $("article").html(datos).hide().fadeIn(200);
          }
      });
   }
   $(document).on("click", ".addComercial", formCrearComercial );

   function formMovimientoEquipo(){ //Ya que comerciales contiene los movimientos de los comerciales a los distintos equipos
     $.ajax({                       //decidi hacer un formulario para crear dichos movimientos dentro del apartado de comerciales
          url: './modulos/ventas/includes/formularioMovimiento.php',
          type: 'POST',
          dataType: 'html',
          error: function(){
              alert("Ha habido un error.");
          },
          success: function(datos){
            $("article").html(datos).hide().fadeIn(200);
          }
      });
   }
   $(document).on("click", ".addMovimiento", formMovimientoEquipo );
   //
   ///
   ///
   //                        E S T A D O S    D E    V E N T A
   //
   //
   //
   //
  ///////////////////////////////////   ESTADOS DE VENTA     //////////////////////////////
   function mostrarEstados(){
     $.ajax({
          url: './modulos/ventas/includes/estado.php',
          type: 'POST',
          dataType: 'html',
          error: function(){
              alert("Ha habido un error.");
          },
          success: function(datos){
            $("article").html(datos).hide().fadeIn(200);
          }
      });
   }
   $(document).on("click", "#estados", mostrarEstados );

   function formCrearEstado(){
     $.ajax({
          data: {metodo: "crear"},
          url: './modulos/ventas/includes/formularioEstado.php',
          type: 'POST',
          dataType: 'html',
          error: function(){
              alert("Ha habido un error.");
          },
          success: function(datos){
            $("article").html(datos).hide().fadeIn(200);
          }
      });
   }
   $(document).on("click", ".addEstado", formCrearEstado );
   //
   ///
   ///
   //                                I V A
   //
   //
   //
   //
  ///////////////////////////////////   IVA     //////////////////////////////
   function mostrarIVA(){
     $.ajax({
          url: './modulos/ventas/includes/iva.php',
          type: 'POST',
          dataType: 'html',
          error: function(){
              alert("Ha habido un error.");
          },
          success: function(datos){
            $("article").html(datos).hide().fadeIn(200);
          }
      });
   }
   $(document).on("click", "#iva", mostrarIVA ); //No creí necesario el crear o borrar los tipos de IVA ya que no pone nada
   //
   ///
   ///
   //                                V E N T A S
   //
   //
   //
   //
  ///////////////////////////////////   VENTAS     //////////////////////////////                                               //de eso en el pdf de nuestro módulo
   function mostrarVentas(){
     $.ajax({
          url: './modulos/ventas/includes/venta.php',
          type: 'POST',
          dataType: 'html',
          error: function(){
              alert("Ha habido un error.");
          },
          success: function(datos){
            $("article").html(datos).hide().fadeIn(200);
          }
      });
   }
   $(document).on("click", "#ventas", mostrarVentas );

   function formLineaVenta(){ //Aquí es donde me quedé. Igual me estoy rallando un poco, pero creo que lo suyo sería primero hacer la línea
     $.ajax({                 //de venta, con el producto y la cantidad, y de ahi hacer la venta completa
          url: './modulos/ventas/includes/formularioLineaVenta.php',
          type: 'POST',
          dataType: 'html',
          error: function(){
              alert("Ha habido un error.");
          },
          success: function(datos){
            $("article").html(datos).hide().fadeIn(200);
          }
      });
   }
   $(document).on("click", ".addVenta", formLineaVenta ); //Por eso hago que un formulario llame a otro. Se ve mejor en la web, aunque
                                                          //sigue faltándome el pasarle los datos por ajax, para que muestre la línea y
   function formCrearVenta(){                             //la meta en la base de datos
     $.ajax({
          data: {idLinea: $("#idLinea").val(), idProducto: $("#idProducto").val(), nombreCantidad: $("#nombreCantidad").val()},
          url: './modulos/ventas/includes/formularioVenta.php',
          type: 'POST',
          dataType: 'html',
          error: function(){
              alert("Ha habido un error.");
          },
          success: function(datos){
            $("article").html(datos).hide().fadeIn(200);
          }
      });
   }
   $(document).on("click", ".btLinea", formCrearVenta );
   //
   ///
   ///
   //                                I N S T A L A D O R
   //
   //
   //
   //
  ///////////////////////////////////   INSTALADOR     //////////////////////////////
   function instalarBD(){                             //la meta en la base de datos
     $.ajax({
          url: './instalar.php',
          type: 'POST',
          dataType: 'html',
          error: function(){
              alert("Ha habido un error.");
          },
          success: function(datos){
            $("article").html(datos).hide().fadeIn(200);
          }
      });
   }
   $(document).on("click", ".btInstalar", instalarBD );
