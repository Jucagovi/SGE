$(".crearProyecto").off().submit(function (ev) {
    ev.preventDefault();
    let tipo = $(this).find(".valor").val();
    cargarPagina(ev, "crearProyecto", {"id":tipo});
});