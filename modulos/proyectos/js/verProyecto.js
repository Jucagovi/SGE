function ajaxFormulariosCorrecto(article, datos) {
    console.log(datos);
    let data = JSON.parse(datos);
    console.log(data);

    let res = article.find(".resultado").first();
    let p = document.createElement("p");
    res.empty();
    if (data.result) {
        p.textContent = data.respuesta;
        p.classList.add("text-success");
        res.append(p);
        if (data.data.finalizadas !== undefined) {
            let horasFin = data.total_horas_finalizadas;
            if (Array.isArray(data.data.finalizadas)) {
                data.data.finalizadas.forEach(function (v, i) {
                    let divTarea = article.find("#tarea_"+v);
                    let label = divTarea.find("label");
                    label.addClass("text-success");
                    let cbFinalizada = divTarea.find("[name='finalizadas[]']");
                    let inHoras = divTarea.find("[name='horas[]']");
                    cbFinalizada.prop("disabled", true);
                    inHoras.prop("disabled", true);
                    if (Array.isArray(horasFin))
                        inHoras.val(horasFin[i]);
                })
            }
        }

        if (data.finalizado === true)
            cargarPagina({}, "verProyectos", {"success":"El proyecto ha finalizado"});
    }
    else {
        p.textContent = data.respuesta;
        p.classList.add("text-error");
        res.append(p);
        console.log(datos);
    }
}