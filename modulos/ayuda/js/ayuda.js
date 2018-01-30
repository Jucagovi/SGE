$(document).ready(function(e) {
     
    /*
     * EVENTOS DE LA SECCIÓN PRINCIPAL
     */
        
   function imprimirAyuda(){
       $.ajax({
            url: './modulos/ayuda/includes/mostrarAyuda.php',
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
   
   $(document).on("click", "#manual", imprimirAyuda );
   $("#manual").keypress(function(e){ if(e.which === 13) imprimirAyuda(); });
/*
 * EVENTOS DE LAS SECCIONES INTERNAS
 */
     
   function imprimirVersion(){
       $.ajax({
            url: './modulos/ayuda/includes/mostrarVersion.php',
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
   
   $(document).on("click", "#mostrarVersion", imprimirVersion );
   $("#mostrarVersion").keypress(function(e){ if(e.which === 13) imprimirVersion(); });
   
   function imprimirTablas(){
       $.ajax({
            url: './modulos/ayuda/includes/mostrarTablas.php',
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
   
   $(document).on("click", "#mostrarTablas", imprimirTablas );
   $("#mostrarTablas").keypress(function(e){ if(e.which === 13) imprimirTablas(); });
    
    function imprimirSegunda(){
       $.ajax({
            url: './modulos/ayuda/includes/mostrarSegunda.php',
            type: 'POST',
            dataType: 'html',
            error: function(){
                alert("Ha habido un error con los datos.");
            },
            success: function(datos){
                $("#segunda").html(datos).hide().fadeIn(200);   
            }
        });// Fin ajax
   }
   
   $(document).on("click", "#boton1", imprimirSegunda );
   $("#boton1").keypress(function(e){ if(e.which === 13) imprimirSegunda(); });
   
   function imprimirTercera(){
       $.ajax({
            url: './modulos/ayuda/includes/mostrarTercera.php',
            type: 'POST',
            dataType: 'html',
            error: function(){
                alert("Ha habido un error con los datos.");
            },
            success: function(datos){
                $("#tercera").html(datos).hide().fadeIn(200);   
            }
        });// Fin ajax
   }
   
   $(document).on("click", "#boton2", imprimirTercera );
   $("#boton2").keypress(function(e){ if(e.which === 13) imprimirTercera(); });





});// Fin document.ready

