$(".ver-proyectos").off().submit(function (ev) {
    ev.preventDefault();
    let tipo = $(this).find(".valor").val();
    cargarPagina(ev, "verProyecto", {"id":tipo});
});

$(".informes").off();