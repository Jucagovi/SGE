$("#formElegirTipo").off();

$("#elegirTipoPresupuesto").click(function (ev) {
    ev.preventDefault();
    let tipo = $("#selecTipoProy").val();
    cargarPagina(ev, "crearPresupuesto", {"tipo":tipo});
});

function ajaxFormulariosCorrecto(article, datos) {
    let data = JSON.parse(datos);

    let res = article.find(".resultado").first();
    let p = document.createElement("p");
    res.empty();
    if (data.result) {
        p.textContent = data.respuesta;
        p.classList.add("text-success");
        res.append(p);
        cargarPagina({}, "verPresupuestos", {"success":"Presupuesto creado correctamente"});
    }
    else {
        p.textContent = data.respuesta;
        p.classList.add("text-error");
        res.append(p);
        console.log(datos);
    }
}