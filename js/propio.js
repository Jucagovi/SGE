$(document).ready(function(e) {
    
    $(document).on("click", ".menu", function(){
	//alert($(this).text());
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
                $("aside").html(datos).hide().fadeIn(400);   
            }
        });// Fin ajax	
    });	// Fin "click"
    
});// Fin document.ready


