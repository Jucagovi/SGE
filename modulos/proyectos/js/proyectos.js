const ModuloProyectos = {
    config: {
        pathModulo: './modulos/proyectos/'
    }
};

$(document).ready(function() {
    $(document).on("click", "#tablonProyectos", cargarPagina);
    $("#tablonProyectos").keypress(function(e){ if(e.which === 13) cargarPagina(e); });

    $(document).on("click", "#verProyectos", cargarPagina);
    $("#verProyectos").keypress(function(e){ if(e.which === 13) cargarPagina(e); });

    $(document).on("click", "#verPresupuestos", cargarPagina);
    $("#verPresupuestos").keypress(function(e){ if(e.which === 13) cargarPagina(e); });

    $(document).on("click", "#crearProyecto", cargarPagina);
    $("#crearProyecto").keypress(function(e){ if(e.which === 13) cargarPagina(e); });

    $(document).on("click", "#crearTipoProyecto", cargarPagina);
    $("#crearTipoProyecto").keypress(function(e){if(e.which === 13) cargarPagina(e);});

    $(document).on("click", "#crearPresupuesto", cargarPagina);
    $("#crearPresupuesto").keypress(function(e){ if(e.which === 13) cargarPagina(e); });

    $(document).on("click", "#verAyudaProyectos", cargarPagina);
    $("#verAyudaProyectos").keypress(function(e){ if(e.which === 13) cargarPagina(e); });

});// Fin document.ready

// Función para cargar la página por la ID del enlace
function cargarPagina(evento, n, datos) {
    if (datos === undefined)
        datos = {};

    let nombre = ((n === undefined) ? evento.target.id : n);

    let config = ModuloProyectos.config;

    let urlRel = config.pathModulo;
    let article = $("article");
    article.html("<p>Cargando página...</p>");
    $.ajax({
        url: urlRel+'includes/'+nombre+'.php',
        data: datos,
        type: 'POST',
        context: article,
        dataType: 'html'
    }) // Fin ajax
    .done( function(datos) {
        this.html(datos).hide().fadeIn(200);
        bindJStoNewDOM(article);
        $.getScript(urlRel + 'js/' + nombre + '.js');
    })
    .fail( function(err) {
        console.log(err);
        alert("Ha habido un error con los datos.");
    })
}

function bindJStoNewDOM(article) {
    bindModals(article);
    ajaxFormularios(article);
}

function bindModals(article) {
    let modals = article.find(".modal");
    if (modals.length > 0) {
        modals.each(function (index, modal) {
            $(modal).click(function (e) {
                e.preventDefault();
                if (modal.href !== undefined && modal.href.length > 0) {
                    let params = {};
                    ($(this).find("input.modal-param")).each(function (index, el) {
                        if (el.name !== undefined && el.name.length > 0 && el.value !== undefined)
                            params[el.name] = el.value;
                    });
                    let referenciaDiv = crearModal(article);

                    let url = modal.href;
                    $.post(url, {data: params})
                        .done(function (data) {
                            $(referenciaDiv)
                                .empty()
                                .append(data);
                        })
                        .fail(function (data) {
                            console.log(data);
                        });
                    
                }
            })
        })
    }
}

function crearModal(article) {
    let divFondo = crearElemento("div", {"class": "modal-fondo"});
    let divPrincipal = crearElemento("div", {"class": "modal-principal"});
    divFondo.addEventListener("click", function(){this.remove()});
    divPrincipal.addEventListener("click", function(e){e.stopPropagation()});

    let d = crearElemento("p", {texto: "Cargando datos...", "class": "text-success en-medio"});
    divPrincipal.append(d);

    divFondo.append(divPrincipal);
    article.find("#moduloproyectos").append(divFondo);

    return divPrincipal;
}

function ajaxFormularios(article) {
    let forms = article.find("form");
    if (forms.length > 0) {
        forms.each(function (index, form) {
            $(form).submit(function(e) {
                e.preventDefault();
                let action = this.attributes.action;
                if (action === undefined || form.id.length === 0)
                    return;

                let pagina = action.value;

                $.ajax({
                    url: './modulos/proyectos/includes/' + pagina,
                    type: 'POST',
                    data: new FormData(form),
                    processData: false,
                    contentType: false,
                    dataType: 'html',
                    error: function () {
                        alert("Ha habido un error con los datos.");
                    },
                    success: function (datos) {
                        // article.html(datos).hide().fadeIn(200);
                        ajaxFormulariosCorrecto(article, datos);
                    }
                });// Fin ajax
            });
        });
    }
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
    }
    else {
        p.textContent = data.respuesta;
        p.classList.add("text-error");
        res.append(p);
        console.log(datos);
    }
}

function crearElemento(nombre, params) {
    if (params === undefined)
        params = {};

    let d = document;
    let elemento = d.createElement(nombre);
    let keys = Object.keys(params);
    keys.forEach(function (el) {
        switch (el) {
            case "id": elemento.id = params.id; break;
            case "class":
                params.class.split(" ")
                    .forEach(value => elemento.classList.add(value));
                break;
            case "texto":
                let t = d.createTextNode(params.texto);
                elemento.appendChild(t);
                break;
            default:
                elemento.setAttribute(el, params[el]);
        }
    });

    return elemento;
}