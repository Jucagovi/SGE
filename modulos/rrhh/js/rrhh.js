$(document).ready(function(e) {
//Cuando añadamos algo como no sabemos como volver cambiamos lo que mostramos si el ajax funciona correctamente y le ponemos un boton con la clase que tenenos aqui indicada para que vea todos los procesos o usuarios etc


  /*Administracion Departamentos*/
  //Administracion de Departamentos
  // Carga la seccion Principal de Departamentos que muestra todos los departamentos
  function imprimirAdministracionDepartamentos(){
      $.ajax({
           url: './modulos/rrhh/includes/mostrarAdministracionDepartamentos.php',
           type: 'POST',
           dataType: 'html',
           error: function(){
              $("article").html("Ha habido un error.").hide().fadeIn(200);
           },
           success: function(datos){
               $("article").html(datos).hide().fadeIn(200);
           }
       });
  }
  $(document).on("click", "#administracionDepartamentos", imprimirAdministracionDepartamentos );
  $("#administracionDepartamentos").keypress(function(e){ if(e.which === 13) imprimirAdministracionDepartamentos(); });


  // Carga la seccion de Informacion de Departamentos que muestra la informacion del departamento indicado
  function imprimirInformacionDepartamento(){
    $.ajax({
      url: './modulos/rrhh/includes/mostrarVerInformacionDepartamento.php',
      type: 'POST',
      data: {id:$(this).val()},
      dataType: 'html',
      error: function(){
        $("article").html("Ha habido un error.").hide().fadeIn(200);
      },
      success: function(datos){
        $("article").html(datos).hide().fadeIn(200);
      }
    });
  }
  $(document).on("click", ".botonVerDepartamento", imprimirInformacionDepartamento);
  $(".botonVerDepartamento").keypress(function(e){ if(e.which === 13) imprimirInformacionDepartamento(); });


  // Carga la seccion de Edicion de Departamentos que muestra el formulario
  function imprimirEditarInformacionDepartamento(){
      $.ajax({
           url: './modulos/rrhh/includes/mostrarEditarInformacionDepartamento.php',
           type: 'POST',
           data: {id:$(this).val()},
           dataType: 'html',
           error: function(){
              $("article").html("Ha habido un error.").hide().fadeIn(200);
           },
           success: function(datos){

             $("article").html(datos).hide().fadeIn(200);
           }
       });
  }
  $(document).on("click", ".botonEditarDepartamento", imprimirEditarInformacionDepartamento);
  $(".botonEditarDepartamento").keypress(function(e){ if(e.which === 13) imprimirEditarInformacionDepartamento(); });

  // Carga el recurso editarDepartamento.php que realiza la actualizacion del Departamento
  function editarDepartamento(){
      $.ajax({
           url: './modulos/rrhh/includes/editarDepartamento.php',
           type: 'POST',
           data: $(".formDepartamento").serialize(),
           dataType: 'html',
           error: function(){
                $("article").html("Ha habido un error.").hide().fadeIn(200);
           },
           success: function(datos){

                $("article").html("Se ha realizado la edicion correctamente.").hide().fadeIn(200);
           }
       });
  }
  $(document).on("click", ".botonEnviarEdicionDepartamento", editarDepartamento);
  $(".botonEnviarEdicionDepartamento").keypress(function(e){ if(e.which === 13) editarDepartamento(); });

// Cambio Personal
/*

FALTA CODIGO DE JORGE

*/

  /*GESTION PROCESOS*/
//Muestra todos los procesos de seleccion
  function imprimirAdministracionProcesosSeleccion(){
    $.ajax({
         url: './modulos/rrhh/includes/mostrarAdministracionProcesosSeleccion.php',
         type: 'POST',
         dataType: 'html',
         error: function(){
             $("article").html("Ha habido un error.").hide().fadeIn(200);
         },
         success: function(datos){
           $("article").html(datos).hide().fadeIn(200);
         }
     });
}

$(document).on("click", "#administracionProcesoSeleccion", imprimirAdministracionProcesosSeleccion);
$("#administracionProcesoSeleccion").keypress(function(e){ if(e.which === 13) imprimirAdministracionProcesosSeleccion(); });


//Muestra el formulario para crear un nuevo candidato
  function imprimirCrearCandidato(){
      $.ajax({
           url: './modulos/rrhh/includes/mostrarCrearCandidato.php',
           type: 'POST',
           dataType: 'html',
           error: function(){
            $("article").html("Ha habido un error.").hide().fadeIn(200);
           },
           success: function(datos){
             $("article").html(datos).hide().fadeIn(200);
           }
       });
  }
// llama al php que hace la insercion en la tabla de candidatos
$(document).on("click", ".botonCrearCandidato", imprimirCrearCandidato);
$(".botonCrearCandidato").keypress(function(e){ if(e.which === 13) imprimirCrearCandidato(); });

function crearCandidato(){
    $.ajax({
         url: './modulos/rrhh/includes/crearCandidato.php',
         type: 'POST',
         dataType: 'html',
         data: $(".formCandidato").serialize(),
         error: function(){
          $("article").html("Ha habido un error.").hide().fadeIn(200);
         },
         success: function(datos){
          $("article").html("Se ha realizado la insercion correctamente.").hide().fadeIn(200);
         }
     });
}
$(document).on("click", ".botonCrearCandidatoFinal", crearCandidato);
$(".botonCrearCandidatoFinal").keypress(function(e){ if(e.which === 13) crearCandidato(); });



//Muestra la informacion de un proceso de seleccion
  function imprimirVerProcesoSeleccion(){
      $.ajax({
           url: './modulos/rrhh/includes/mostrarVerProcesoSeleccion.php',
           type: 'POST',
           data: {id:$(this).val()},
           dataType: 'html',
           error: function(){
            $("article").html("Ha habido un error.").hide().fadeIn(200);
           },
           success: function(datos){
             $("article").html(datos).hide().fadeIn(200);
           }
       });
  }

$(document).on("click", ".botonVerProcesoSeleccion", imprimirVerProcesoSeleccion);
$(".botonVerProcesoSeleccion").keypress(function(e){ if(e.which === 13) imprimirVerProcesoSeleccion(); });

//Muestra un formulario para rellenar e incluir un nuevo candidato al proceso de seleccion
function añadirCandidatoProcesosSeleccion(){
    $.ajax({
         url: './modulos/rrhh/includes/mostrarAñadirCandidatoProcesoSeleccion.php',
         type: 'POST',
         data: {id:$(this).val()},
         dataType: 'html',
         error: function(){
           $("article").html("Ha habido un error.").hide().fadeIn(200);
         },
         success: function(datos){
           $("article").html(datos).hide().fadeIn(200);
         }
     });
}

$(document).on("click", ".botonAñadirCandidatoProcesoSeleccion", añadirCandidatoProcesosSeleccion);
$(".botonAñadirCandidatoProcesoSeleccion").keypress(function(e){ if(e.which === 13) añadirCandidatoProcesosSeleccion(); });
//FALTA EL DE LA CONSULTA DE AÑADIR CANDIDATO
// Carga el recurso añadirCandidatoProcesoSeleccion.php que realiza la actualizacion del Departamento

function añadirCandidatoProcesoSeleccion(){
    $.ajax({
         url: './modulos/rrhh/includes/añadirCandidatoProcesoSeleccion.php',
         type: 'POST',
         data: $(".formCandidatoProcesoSeleccion").serialize(),
         dataType: 'html',
         error: function(){
          $("article").html("Ha habido un error.").hide().fadeIn(200);
         },
         success: function(datos){

          $("article").html("Se ha realizado la insercion correctamente. ").hide().fadeIn(200);
         }
     });
}
$(document).on("click", ".botonIncluirCandidatoProcesoSeleccion", añadirCandidatoProcesoSeleccion);
$(".botonIncluirCandidatoProcesoSeleccion").keypress(function(e){ if(e.which === 13) añadirCandidatoProcesoSeleccion(); });

//Muestra un formulario que permite editar el proceso de seleccion
// primera pagina
function imprimirEditarProcesoSeleccion(){
    $.ajax({
         url: './modulos/rrhh/includes/mostrarEditarProcesoSeleccion.php',
         type: 'POST',
         data: {id:$(this).val()},
         dataType: 'html',
         error: function(){
           $("article").html("Ha habido un error.").hide().fadeIn(200);
         },
         success: function(datos){
           $("article").html(datos).hide().fadeIn(200);
         }
     });
}

$(document).on("click", ".botonEditarProcesoSeleccion", imprimirEditarProcesoSeleccion);
$(".botonEditarProcesoSeleccion").keypress(function(e){ if(e.which === 13) imprimirEditarProcesoSeleccion(); });

//segunda pagina para cambiar el estado , esta muestra el usuario y un formulario
function imprimirEditarEstadoProcesoSeleccion(){
    $.ajax({
         url: './modulos/rrhh/includes/mostrarEditarCandidatoEstadoProceso.php',
         type: 'POST',
         data: {id:$(this).val()},
         dataType: 'html',
         error: function(){
           $("article").html("Ha habido un error.").hide().fadeIn(200);
         },
         success: function(datos){
           $("article").html(datos).hide().fadeIn(200);
         }
     });
}

$(document).on("click", ".botonEditarEstadoProceso", imprimirEditarEstadoProcesoSeleccion);
$(".botonEditarEstadoProceso").keypress(function(e){ if(e.which === 13) imprimirEditarEstadoProcesoSeleccion(); });

//TERCERA PAGINA
//CAMBIO DE ESTADO DE usuario en proceso
function editarEstadoProceso(){
    $.ajax({
         url: './modulos/rrhh/includes/editarEstadoProceso.php',
         type: 'POST',
         dataType: 'html',
         data: $(".editarEstadoProcesoSeleccion").serialize(),
         error: function(){
            $("article").html("Ha habido un error.").hide().fadeIn(200);
         },
         success: function(datos){
           $("article").html("Ha ido bien al edicion del Estado").hide().fadeIn(200);
         }
     });
}

$(document).on("click", ".botonCambiarEstadoProceso", editarEstadoProceso);
$(".botonCambiarEstadoProceso").keypress(function(e){ if(e.which === 13) editarEstadoProceso(); });



//Creacion Proceso de Seleccion
// muestra un formaulario que permite crear un nuevo proceso de seleccion
function imprimirCreacionProcesoSeleccion(){
    $.ajax({
         url: './modulos/rrhh/includes/mostrarCreacionProcesoSeleccion.php',
         type: 'POST',
         dataType: 'html',
         error: function(){
            $("article").html("Ha habido un error.").hide().fadeIn(200);
         },
         success: function(datos){
           $("article").html(datos).hide().fadeIn(200);
         }
     });
}

$(document).on("click", "#creacionProcesoSeleccion", imprimirCreacionProcesoSeleccion);
$("#creacionProcesoSeleccion").keypress(function(e){ if(e.which === 13) imprimirCreacionProcesoSeleccion(); });


function crearProcesoSeleccion(){
    $.ajax({
         url: './modulos/rrhh/includes/crearProcesoSeleccion.php',
         type: 'POST',
         dataType: 'html',
         data: $(".formProcesoSeleccion").serialize(),
         error: function(){
            $("article").html("Ha habido un error.").hide().fadeIn(200);
         },
         success: function(datos){
          
           $("article").html("La creacion ha sido correcta").hide().fadeIn(200);
         }
     });
}

$(document).on("click", ".botonCrearProcesoSeleccion", crearProcesoSeleccion);
$(".botonCrearProcesoSeleccion").keypress(function(e){ if(e.which === 13) crearProcesoSeleccion(); });


/* CODIGO DE JORGE
*/

function imprimirCambioPersonal(){
    $.ajax({
         url: './modulos/rrhh/includes/mostrarCambioPersonal.php',
         type: 'POST',
         dataType: 'html',
         error: function(){
            $("article").html("Ha habido un error.").hide().fadeIn(200);
         },
         success: function(datos){
             $("article").html(datos).hide().fadeIn(200);
         }
     });
}
$(document).on("click", "#cambioPersonal", imprimirCambioPersonal );
$("#cambioPersonal").keypress(function(e){ if(e.which === 13) imprimirCambioPersonal(); });

//BOTÓN DE CAMBIAR DEPARTAMENTO DEL Empleado
function imprimirCambiarDepartamentoEmpleado(){
    $.ajax({
         url: './modulos/rrhh/includes/mostrarCambiarDepartamentoEmpleado.php',
         type: 'POST',
         data: {id:$(this).val()},
         dataType: 'html',
         error: function(){
            $("article").html("Ha habido un error.").hide().fadeIn(200);
         },
         success: function(datos){

           $("article").html(datos).hide().fadeIn(200);
         }
     });
}
$(document).on("click", ".botonCambiarDepartamentoEmpleado", imprimirCambiarDepartamentoEmpleado);
$(".botonCambiarDepartamentoEmpleado").keypress(function(e){ if(e.which === 13) imprimirCambiarDepartamentoEmpleado(); });

/////////////Actualizar departamento en Empleado
function editarDepartamentoEmpleado(){
    $.ajax({
         url: './modulos/rrhh/includes/editarDepartamentoEmpleado.php',
         type: 'POST',
         data: $(".formDepartamentoEmpleado").serialize(),
         dataType: 'html',
         error: function(){
          $("article").html("Ha habido un error.").hide().fadeIn(200);
         },
         success: function(datos){
          $("article").html("Se ha realizado la insercion correctamente.").hide().fadeIn(200);

         }
     });
}
$(document).on("click", ".botonEditarDepartamentoEmpleado", editarDepartamentoEmpleado);
$(".botonEditarDepartamentoEmpleado").keypress(function(e){ if(e.which === 13) editarDepartamentoEmpleado(); });



// Cambio Personal
function imprimirCambioPersonal(){
    $.ajax({
         url: './modulos/rrhh/includes/mostrarCambioPersonal.php',
         type: 'POST',
         dataType: 'html',
         error: function(){
            $("article").html("Ha habido un error.").hide().fadeIn(200);
         },
         success: function(datos){
             $("article").html(datos).hide().fadeIn(200);
         }
     });
}
$(document).on("click", "#cambioPersonal", imprimirCambioPersonal );
$("#cambioPersonal").keypress(function(e){ if(e.which === 13) imprimirCambioPersonal(); });

//BOTÓN DE CAMBIAR DEPARTAMENTO DEL Empleado
function imprimirCambiarDepartamentoEmpleado(){
    $.ajax({
         url: './modulos/rrhh/includes/mostrarCambiarDepartamentoEmpleado.php',
         type: 'POST',
         data: {id:$(this).val()},
         dataType: 'html',
         error: function(){
            $("article").html("Ha habido un error.").hide().fadeIn(200);
         },
         success: function(datos){

           $("article").html(datos).hide().fadeIn(200);
         }
     });
}
$(document).on("click", ".botonCambiarDepartamentoEmpleado", imprimirCambiarDepartamentoEmpleado);
$(".botonCambiarDepartamentoEmpleado").keypress(function(e){ if(e.which === 13) imprimirCambiarDepartamentoEmpleado(); });

/////////////Actualizar departamento en Empleado
function editarDepartamentoEmpleado(){
    $.ajax({
         url: './modulos/rrhh/includes/editarDepartamentoEmpleado.php',
         type: 'POST',
         data: $(".formDepartamentoEmpleado").serialize(),
         dataType: 'html',
         error: function(){
          $("article").html("Ha habido un error.").hide().fadeIn(200);
         },
         success: function(datos){
          $("article").html("Se ha realizado la insercion correctamente.").hide().fadeIn(200);

         }
     });
}
$(document).on("click", ".botonEditarDepartamentoEmpleado", editarDepartamentoEmpleado);
$(".botonEditarDepartamentoEmpleado").keypress(function(e){ if(e.which === 13) editarDepartamentoEmpleado(); });

/////////////HISTÓRICO
function imprimirHistorico(){
    $.ajax({
         url: './modulos/rrhh/includes/mostrarHistorico.php',
         type: 'POST',
         dataType: 'html',
         error: function(){
            $("article").html("Ha habido un error.").hide().fadeIn(200);
         },
         success: function(datos){
             $("article").html(datos).hide().fadeIn(200);
         }
     });
}
$(document).on("click", "#historico", imprimirHistorico );
$("#historico").keypress(function(e){ if(e.which === 13) imprimirHistorico(); });



function filtrarHistorial(){
    $.ajax({
         url: './modulos/rrhh/includes/filtrarHistorial.php',
         type: 'POST',
         dataType: 'html',
         data: $(".formFiltrarPorFechas").serialize(),
         error: function(){
          $("article").html("Ha habido un error.").hide().fadeIn(200);
         },
         success: function(datos){
          $("article").html("Se ha realizado la insercion correctamente. ").hide().fadeIn(200);
         }
     });
}
$(document).on("click", ".botonFiltrarFecha", filtrarHistorial);
  $(".botonFiltrarFecha").keypress(function(e){ if(e.which === 13) filtrarHistorial(); });





});
