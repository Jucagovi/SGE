$("#addTipoEtapa").click(addTipoEtapa);

function addTipoTarea(e) {
    let div, fila1, label1, input1, fila2, label2, input2, fila3, label3, input3;
    div = crearElemento("div", {class: "contenedor tipo-etapa"});
    fila1 = crearElemento("div", {class: "fila"});
    fila2 = crearElemento("div", {class: "fila"});
    fila3 = crearElemento("div", {class: "fila"});
    label1 = crearElemento("div", {class: "label", texto: "Nombre de la tarea"});
    label2 = crearElemento("div", {class: "label", texto: "Descripción de la tarea"});
    label3 = crearElemento("div", {class: "label", texto: "Precio de la tarea"});

    input1 = crearElemento("input", {
        name: "nombreTarea[]", value: "", placeholder: "Introduce el nombre de la tarea", required: "",
        "aria-label": "Introduce el nombre", title: "Introduce el nombre", class: "input col-6"
    });
    label1.append(input1);

    input2 = crearElemento("textarea", {
        name: "descTarea[]", placeholder: "Introduce una descripción", class: "textarea col-6", required: "",
        "aria-label": "Introduce la descripción", title: "Introduce el descripción"
    });
    label2.append(input2);

    input3 = crearElemento("input", {
        name: "precioTarea[]", value: "", placeholder: "Introduce el precio de la tarea", type: "number",
        "aria-label": "Introduce el precio", title: "Introduce el precio", class: "input col-6", min: "0",
        required: ""
    });
    label3.append(input3);

    let valor = $(e.target).attr("value");
    let input4 = crearElemento("input", {name: "idEtapa[]", value: valor, hidden: ""});

    fila1.appendChild(label1);
    div.appendChild(fila1);
    fila2.appendChild(label2);
    div.appendChild(fila2);
    fila3.appendChild(label3);
    div.appendChild(fila3);

    let contenedor;
    let nodos = e.target.parentNode.parentNode.childNodes;
    for(let i = 0; i < nodos.length; i++) {
        if (nodos[i].classList.contains("tareas-etapa"))
            contenedor = nodos[i];
    }

    contenedor.appendChild(div).appendChild(input4);
}

function addTipoEtapa() {
    let div, fila1, fila2, fila3, label1, label2, br, span, div2, input1, input2;
    div = crearElemento("div", {class: "tipo-etapa contenedor"});
    fila1 = crearElemento("div", {class: "fila"});
    fila2 = fila1.cloneNode(); fila3 = fila1.cloneNode();
    label1 = crearElemento("label", {class: "label", texto: "Nombre de la etapa"});
    label2 = crearElemento("label", {class: "label", texto: "Descripción de la etapa"});
    br = crearElemento("br");
    span = crearElemento("span", {class: "btn btn-info addTareaEtapa", texto: "Añadir tarea", value: ""});
    div2 = crearElemento("div", {class: "contenedor tareas-etapa"});

    $(span).click(addTipoTarea);

    input1 = crearElemento("input", {
        name: "nombreEtapa[]", value: "", placeholder: "Introduce el nombre de la etapa", required: "",
        "aria-label": "Introduce el nombre", title: "Introduce el nombre", class: "input col-6"
    });
    label1.append(input1);

    input2 = crearElemento("textarea", {
        name: "descripcionEtapa[]", placeholder: "Introduce una descripción", class: "textarea col-6",
        "aria-label": "Introduce la descripción", title: "Introduce el descripción", required: ""
    });
    label2.append(input2);

    fila1.appendChild(label1);
    fila2.appendChild(label2);
    fila3.appendChild(span);
    div.appendChild(fila1).appendChild(br);
    div.appendChild(fila2).appendChild(br);
    div.appendChild(div2);
    div.appendChild(fila3).appendChild(br);

    let botonEtapa = $("#addTipoEtapa");
    let i = botonEtapa.attr("value");
    span.setAttribute("value", i++);

    botonEtapa.attr("value", i);

    $(div).insertBefore(botonEtapa.parent());

}

function ajaxFormulariosCorrecto(article, datos) {
    let data = JSON.parse(datos);

    let res = article.find(".resultado").first();
    let p = document.createElement("p");
    res.empty();
    if (data.result) {
        p.textContent = data.respuesta;
        p.classList.add("text-success");
        res.append(p);
        cargarPagina({}, "crearTipoProyecto", {"success":"Tipo de proyecto creado correctamente"});
    }
    else {
        p.textContent = data.respuesta;
        p.classList.add("text-error");
        res.append(p);
        console.log(datos);
    }
}