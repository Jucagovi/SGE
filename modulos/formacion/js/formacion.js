$(document).ready(function(e) {

    /*
     * EVENTOS DE CURSO
     */

   function imprimirCursos(){
     $.ajax({
          url: './modulos/formacion/includes/mostrarCurso.php',
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
   $(document).on("click", "#cursos", imprimirCursos );
   $("#cursos").keypress(function(e){ if(e.which === 13) imprimirCursos(); });

   function imprimirUnidades(){
     $.ajax({
          url: './modulos/formacion/includes/mostrarUnidades.php',
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
   $(document).on("click", "#unidades", imprimirUnidades );
   $("#unidades").keypress(function(e){ if(e.which === 13) imprimirUnidades(); });

   function imprimirFormulario(){
     $.ajax({
          url: './modulos/formacion/includes/formularioCurso.html',
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

   $(document).on("click", "#addCurso", imprimirFormulario );
   $("#addCurso").keypress(function(e){ if(e.which === 13) imprimirFormulario(); });

  function crearCurso(){
    $.ajax({
         url: './modulos/formacion/includes/enviarFormularioNuevoCurso.php',
         type: 'POST',
         dataType: 'html',
         data: $("#formCurso").serialize(),
         error: function(datos){
         },
        success: function(datos){
          alert("Curso creado");
        }

     });// Fin ajax
  }

  $(document).on("click", "#btnAnyadir", crearCurso );
  $("#btnAnyadir").keypress(function(e){ if(e.which === 13) crearCurso();});

  function imprimirInformacionCurso(){
  $.ajax({
       url: './modulos/formacion/includes/infoCurso.php',
       type: 'POST',
       dataType: 'html',
       data: {
        id: $(this).attr("value")
      },
       error: function(){
         alert("Ha habido un error con los datos.");
        },
       success: function(datos){
           $("#content").html(datos).hide().fadeIn(200);

       }
   });// Fin ajax
  }

  $(document).on("click", "#itemCurso", imprimirInformacionCurso );
  $("#itemCurso").keypress(function(e){ if(e.which === 13) imprimirInformacionCurso(); });

  function imprimirInformacionUnidad(){
  $.ajax({
       url: './modulos/formacion/includes/mostrarInfoUnidad.php',
       type: 'POST',
       dataType: 'html',
       data: {
        id: $(this).attr("value")
      },
       error: function(){
         alert("Ha habido un error con los datos.");
        },
       success: function(datos){
           $("#content").html(datos).hide().fadeIn(200);

       }
   });// Fin ajax
  }

  $(document).on("click", "#itemUnidad", imprimirInformacionUnidad );
  $("#itemUnidad").keypress(function(e){ if(e.which === 13) imprimirInformacionUnidad(); });

  function imprimirSolicitudes(){
    $.ajax({
         url: './modulos/formacion/includes/mostrarSolicitud.php',
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
  $(document).on("click", "#consultaSolicitudes", imprimirSolicitudes );
  $("#consultaSolicitudes").keypress(function(e){ if(e.which === 13) imprimirSolicitudes(); });

  function imprimirInformacionSolicitud(){
  $.ajax({
       url: './modulos/formacion/includes/infoSolicitud.php',
       type: 'POST',
       dataType: 'html',
       data: {
        id: $(this).attr("value")
      },
       error: function(){
         alert("Ha habido un error con los datos.");
        },
       success: function(datos){
           $("#content").html(datos).hide().fadeIn(200);

       }
   });// Fin ajax
  }

  $(document).on("click", "#itemSolicitud", imprimirInformacionSolicitud );
  $("#itemSolicitud").keypress(function(e){ if(e.which === 13) imprimirInformacionSolicitud(); });


  function imprimirFormularioSolicitudes(){
    $.ajax({
         url: './modulos/formacion/includes/mostrarFormularioSolicitud.php',
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

     $(document).on("click", "#enviarSolicitud", imprimirFormularioSolicitudes );
     $("#enviarSolicitud").keypress(function(e){ if(e.which === 13) imprimirFormularioSolicitudes(); });


       function crearSolicitud(){
         $.ajax({
              url: './modulos/formacion/includes/enviarFormularioSolicitud.php',
              type: 'POST',
              dataType: 'html',
              data: $("#formSolicitud").serialize(),
              error: function(datos){

              },
             success: function(datos){
               alert("Solicitud enviada");
             }

          });// Fin ajax
       }

       $(document).on("click", "#btnEnviarSol", crearSolicitud );
       $("#btnEnviarSol").keypress(function(e){ if(e.which === 13) crearSolicitud();});

/*
 * EVENTOS DE SOLICITUDES PENDIENTES
 */
///////////////////////////////////////////////////////////////////////////////////////////////
 function imprimirSolicitudesPendientes(){
   $.ajax({
        url: './modulos/formacion/includes/mostrarSolicitudesPendientes.php',
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

 $(document).on("click", "#solicitudesPendientes", imprimirSolicitudesPendientes );
 $("#solicitudesPendientes").keypress(function(e){ if(e.which === 13) imprimirSolicitudesPendientes(); });

 function imprimirInformacionSolicitudPendiente(){
 $.ajax({
      url: './modulos/formacion/includes/infoSolicitudPendiente.php',
      type: 'POST',
      dataType: 'html',
      data: {
       id: $(this).attr("value")
     },
      error: function(){
        //eRROR
        alert("Ha habido un error con los datos.");
       },
      success: function(datos){
          $("#content").html(datos).hide().fadeIn(200);

      }
  });// Fin ajax
 }

 $(document).on("click", "#itemSolicitudPendiente", imprimirInformacionSolicitudPendiente );
 $("#itemSolicitudPendiente").keypress(function(e){ if(e.which === 13) imprimirInformacionSolicitudPendiente(); });


function aceptarSolicitud(){
  $.ajax({
       url: './modulos/formacion/includes/aceptarSolicitud.php',
       type: 'POST',
       dataType: 'html',
       data:{
        id: $(this).attr("value")
      },
       error: function(){
         alert("Ha habido un error con los datos.");
        },
       success: function(datos){
           $("article").html(datos).hide().fadeIn(200);
           alert("Solicitud aceptada");

       }
   });// Fin ajax
}

$(document).on("click", "#btAceptarSolicitud", aceptarSolicitud );
$("#btAceptarSolicitud").keypress(function(e){ if(e.which === 13) aceptarSolicitud(); });

function rechazarSolicitud(){
  $.ajax({
       url: './modulos/formacion/includes/denegarSolicitud.php',
       type: 'POST',
       dataType: 'html',
       data:{
        id: $(this).attr("value")
      },
       error: function(){
         alert("Ha habido un error con los datos.");
        },
       success: function(datos){
           $("article").html(datos).hide().fadeIn(200);
           alert("Solicitud rechazada");
       }
   });// Fin ajax
}

$(document).on("click", "#btRechazarSolicitud", rechazarSolicitud );
$("#btRechazarSolicitud").keypress(function(e){ if(e.which === 13) rechazarSolicitud(); });

function recargaComboCursos(){
  document.getElementById("id_c").value = document.getElementById("nombre_solicitud").value;}

$(document).on("click", "#nombre_solicitud", recargaComboCursos );
$("#nombre_solicitud").keypress(function(e){ if(e.which === 13) recargaComboCursos(); });

  });// Fin document.ready

  function recargaComboEmpleados(){
    document.getElementById("id_e").value = document.getElementById("nombre_empleado").value;}

  $(document).on("click", "#nombre_empleado", recargaComboEmpleados );
  $("#nombre_empleado").keypress(function(e){ if(e.which === 13) recargaComboEmpleados(); });
