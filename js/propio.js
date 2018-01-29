$(document).ready(function(e) {
    
    /*
    *    MÉTODO OBSOLETO NO ACCESIBLE
    *   $(document).on("click", ".menu", function(){
    *       $.ajax({
    *           url: './includes/secciones.php',
    *           type: 'POST',
    *           data: {
    *               modulo: $(this).text()
    *               },
    *           dataType: 'html',
    *           error: function(){
    *               alert("Ha habido un error con los datos.");
    *        },
    *           success: function(datos){
    *               $("aside").html(datos).hide().fadeIn(400);   
    *           }
    *       });// Fin ajax	
    *   });	// Fin "click"
    */
   
   function imprimir_secciones(){
       $.ajax({
            url: './includes/secciones.php',
            type: 'POST',
            data: {
                modulo: $(this).text()
                },
            dataType: 'html',
            error: function(){
                alert("Ha habido un error con los datos.");
            },
            success: function(datos){
                $("aside").html(datos).hide().fadeIn(200);   
            }
        });// Fin ajax
   }
   
   $(document).on("click", ".menu", imprimir_secciones );
   //Método accesible, mietras pulse el INTRO del teclado.
   $(".menu").keypress(function(e){ if(e.which === 13) imprimir_secciones(); });
   
});// Fin document.ready


