function ajaxFormulariosCorrecto(article, datos) {
    let data = JSON.parse(datos);

    let res = article.find(".resultado").first();
    let p = document.createElement("p");
    res.empty();
    if (data.result) {
        p.textContent = data.respuesta;
        p.classList.add("text-success");
        res.append(p);
        cargarPagina({}, "verProyectos", {"success":"Presupuesto aprobado y proyecto creado correctamente"});
    }
    else {
        p.textContent = data.respuesta;
        p.classList.add("text-error");
        res.append(p);
        console.log(datos);
    }
}