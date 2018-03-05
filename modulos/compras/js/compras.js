$(document).ready(function(e) {
     
 
   
   
   function imprimeProductos(){
       $.ajax({
            url: './modulos/compras/includes/mostrarProductos.php',
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
   
   $(document).on("click", "#gestionarProductos", imprimeProductos );
   $("#gestionarProductos").keypress(function(e){ if(e.which === 13) imprimeProductos(); });
   
   function imprimeProductoClicado(){
       $.ajax({
            url: './modulos/compras/includes/productoClicado.php',
            type: 'POST',
            data:{
            	identificador: $(this).attr("feo")
            },
            dataType: 'html',
            error: function(){
                alert("Ha habido un error con los datos.");
            },
            success: function(datos){
                $("article").html(datos).hide().fadeIn(200);   
            }
        });// Fin ajax
   }
   
   $(document).on("click", "#gridProducto", imprimeProductoClicado );
   $("#gridProducto").keypress(function(e){ if(e.which === 13) imprimeProductoClicado(); });
   
   
   function imprimeTipos(){
       $.ajax({
            url: './modulos/compras/includes/mostrarTipos.php',
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
   
   $(document).on("click", "#gestionarTipos", imprimeTipos );
   $("#gestionarTipos").keypress(function(e){ if(e.which === 13) imprimeTipos(); });
   
   
   function imprimeCategorias(){
       $.ajax({
            url: './modulos/compras/includes/mostrarCategorias.php',
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
   
   $(document).on("click", "#gestionarCategoria", imprimeCategorias );
   $("#gestionarCategoria").keypress(function(e){ if(e.which === 13) imprimeCategorias(); });
   
   
   function borrarProducto(){
       $.ajax({
            url: './modulos/compras/includes/borrarProducto.php',
            type: 'POST',
            data:{
            	idProducto: $(this).attr("idProducto")
            },
            dataType: 'html',
            error: function(){
                alert("Ha habido un error con los datos.");
            },
            success: function(datos){
            	alert("Producto borrado correctamente.");
            	imprimeProductos();
            }
        });// Fin ajax
   }
   
   $(document).on("click", "#borrarProductoElegido", borrarProducto );
   $("#borrarProductoElegido").keypress(function(e){ if(e.which === 13) borrarProducto(); });
   
   
   function imprimePedidos(){
       $.ajax({
            url: './modulos/compras/includes/mostrarPedidos.php',
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
   
   $(document).on("click", "#gestionPedidos", imprimePedidos );
   $("#gestionPedidos").keypress(function(e){ if(e.which === 13) imprimePedidos(); });
   
   
   function immprimePedidoClicado(){
       $.ajax({
            url: './modulos/compras/includes/pedidoClicado.php',
            type: 'POST',
            data:{
            	identificador: $(this).attr("pedidoElegido")
            },
            dataType: 'html',
            error: function(){
                alert("Ha habido un error con los datos.");
            },
            success: function(datos){
                $("article #muestrarioPedido").html(datos).hide().fadeIn(200);   
            }
        });// Fin ajax
   }
   
   $(document).on("click", "#filaPedido", immprimePedidoClicado );
   $("#filaPedido").keypress(function(e){ if(e.which === 13) immprimePedidoClicado(); });
   
   
   function imprimeTipoClicado(){
       $.ajax({
            url: './modulos/compras/includes/tipoClicado.php',
            type: 'POST',
            data:{
            	identificador: $(this).attr("tipoElegido")
            },
            dataType: 'html',
            error: function(){
                alert("Ha habido un error con los datos.");
            },
            success: function(datos){
                $("article #muestrarioTipo").html(datos).hide().fadeIn(200);   
            }
        });// Fin ajax
   }
   
   $(document).on("click", "#filaTipo", imprimeTipoClicado );
   $("#filaTipo").keypress(function(e){ if(e.which === 13) imprimeTipoClicado(); });
   
   
   function imprimeFaseClicada(){
       $.ajax({
            url: './modulos/compras/includes/faseClicada.php',
            type: 'POST',
            data:{
            	identificador: $(this).attr("faseElegida")
            },
            dataType: 'html',
            error: function(){
                alert("Ha habido un error con los datos.");
            },
            success: function(datos){
                $("article #muestrarioFase").html(datos).hide().fadeIn(200);   
            }
        });// Fin ajax
   }
   
   $(document).on("click", "#filaFase", imprimeFaseClicada );
   $("#filaFase").keypress(function(e){ if(e.which === 13) imprimeFaseClicada(); });
   
   
   function imprimeCategoriaClicada(){
       $.ajax({
            url: './modulos/compras/includes/categoriaClicada.php',
            type: 'POST',
            data:{
            	identificador: $(this).attr("categoriaElegida")
            },
            dataType: 'html',
            error: function(){
                alert("Ha habido un error con los datos.");
            },
            success: function(datos){
                $("article #muestrarioCategoria").html(datos).hide().fadeIn(200);   
            }
        });// Fin ajax
   }
   
   $(document).on("click", "#filaCategoria", imprimeCategoriaClicada );
   $("#filaCategoria").keypress(function(e){ if(e.which === 13) imprimeCategoriaClicada(); });
   
   
   function borrarCategoria(){
       $.ajax({
            url: './modulos/compras/includes/borrarCategoria.php',
            type: 'POST',
            data:{
            	idCategoria: $(this).attr("idCategoria")
            },
            dataType: 'html',
            error: function(){
                alert("Ha habido un error con los datos.");
            },
            success: function(datos){
            	alert("Producto borrado correctamente.");
            	imprimeCategorias();
            }
        });// Fin ajax
   }
   
   $(document).on("click", "#borrarCategoriaElegida", borrarCategoria );
   $("#borrarCategoriaElegida").keypress(function(e){ if(e.which === 13) borrarCategoria(); });
   
   
   function imprimeEnvios(){
       $.ajax({
            url: './modulos/compras/includes/mostrarEnvios.php',
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
   

   $(document).on("click", "#comprobarEnvio", imprimeEnvios );
   $("#comprobarEnvio").keypress(function(e){ if(e.which === 13) imprimeEnvios(); });
   
   function imprimeFases(){
       $.ajax({
            url: './modulos/compras/includes/mostrarFases.php',
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
   

   $(document).on("click", "#crearFase", imprimeFases );
   $("#crearFase").keypress(function(e){ if(e.which === 13) imprimeFases(); });
   
   
   
   function cargarFormularioNuevaFase() {
		$
				.ajax({
					url : './modulos/compras/includes/formularioNuevaFase.php',
					type : 'POST',
					dataType : 'html',
					error : function() {
						alert("Ha habido un error");
					},
					success : function(datos) {
						$("article #muestrarioFase").html(datos).hide().fadeIn(
								200);
					}
				}); // Fin de ajax.
	} // Fin de la función cargarFormularioNuevoContacto.
   
   $(document).on("click", "#anyadirFase", cargarFormularioNuevaFase );
   $("#anyadirFase").keypress(function(e){ if(e.which === 13) cargarFormularioNuevaFase(); });
   
   function imprimeMetodosPago(){
       $.ajax({
            url: './modulos/compras/includes/mostrarMetodosPago.php',
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
   
   $(document).on("click", "#gestionarMetodos", imprimeMetodosPago );
   $("#gestionarMetodos").keypress(function(e){ if(e.which === 13) imprimeMetodosPago(); });
   
   function imprimeEnvioClicado(){
       $.ajax({
            url: './modulos/compras/includes/envioClicado.php',
            type: 'POST',
            data:{
            	identificador: $(this).attr("envioElegido")
            },
            dataType: 'html',
            error: function(){
                alert("Ha habido un error con los datos.");
            },
            success: function(datos){
                $("article #muestrarioEnvio").html(datos).hide().fadeIn(200);   
            }
        });// Fin ajax
   }
   
   $(document).on("click", "#filaEnvio", imprimeEnvioClicado );
   $("#filaEnvio").keypress(function(e){ if(e.which === 13) imprimeEnvioClicado(); });
   
   
   
   $(document).on("click", "#volverAMetodos", imprimeMetodosPago );
   $("#volverAMetodos").keypress(function(e){ if(e.which === 13) imprimeMetodosPago(); });
   
   
   function imprimeMetodoClicado(){
       $.ajax({
            url: './modulos/compras/includes/metodoClicado.php',
            type: 'POST',
            data:{
            	identificador: $(this).attr("metodoElegido")
            },
            dataType: 'html',
            error: function(){
                alert("Ha habido un error con los datos.");
            },
            success: function(datos){
                $("article #muestrarioMetodo").html(datos).hide().fadeIn(200);   
            }
        });// Fin ajax
   }
   
   $(document).on("click", "#filaMetodo", imprimeMetodoClicado );
   $("#filaMetodo").keypress(function(e){ if(e.which === 13) imprimeMetodoClicado(); });
   
   
   function borrarMetodo(){
       $.ajax({
            url: './modulos/compras/includes/borrarMetodo.php',
            type: 'POST',
            data:{
            	idCategoria: $(this).attr("idMetodo")
            },
            dataType: 'html',
            error: function(){
                alert("Ha habido un error con los datos.");
            },
            success: function(datos){
            	alert("Metodo borrado correctamente.");
            	imprimeMetodosPago();
            }
        });// Fin ajax
   }
   
   $(document).on("click", "#borrarMetodoElegido", borrarMetodo );
   $("#borrarMetodoElegido").keypress(function(e){ if(e.which === 13) borrarMetodo(); });
   
   
   
   ///////////////////////////////////////////////////////////////////////////////////////////////////////

					   
   function cargarFormularioAltaProveedor() {
						$
								.ajax({
									url : './modulos/compras/includes/formularioAltaProveedor.php',
									type : 'POST',
									dataType : 'html',
									error : function() {
										alert("Ha habido un error.");
									},
									success : function(datos) {
										$("article").html(datos).hide().fadeIn(
												200);
									}
								}); // Fin de Ajax.
					} // Fin de la función mostrarTexto.

					$(document).on("click", "#anyadirProveedor",
							cargarFormularioAltaProveedor);
					$("#anyadirProveedor").keypress(function(e) {
						if (e.which === 13)
							cargarFormularioAltaProveedor();
					});

					function insertarProveedor() {
						$
								.ajax({
									url : './modulos/compras/includes/insertarProveedor.php',
									type : 'POST',
									data : $("#formularioAltaProveedor")
											.serialize(),
									dataType : 'html',
									error : function() {
										alert("Ha habido un error.");
									},
									success : function(datos) {
										$("article").html(datos).hide().fadeIn(
												200);
									}
								}); // Fin de Ajax.
					} // Fin de la función insertarProveedor.

					$(document).on("click", "#botonInsertarProveedor",
							insertarProveedor);
					$("#botonInsertarProveedor").keypress(function(e) {
						if (e.which === 13)
							insertarProveedor();
					});

					function imprimirTablas() {
						$
								.ajax({
									url : './modulos/compras/includes/mostrarProveedores.php',
									type : 'POST',
									dataType : 'html',
									error : function() {
										alert("Ha habido un error con los datos.");
									},
									success : function(datos) {
										$("article").html(datos).hide().fadeIn(
												200);
									}
								});// Fin ajax
					}

					$(document).on("click", "#gestionarProveedores",
							imprimirTablas);
					$("#gestionarProveedores").keypress(function(e) {
						if (e.which === 13)
							imprimirTablas();
					});

					function crearFactura() {
						$
								.ajax({
									url : './modulos/compras/includes/formularioNuevaFactura.php',
									type : 'POST',
									dataType : 'html',
									error : function() {
										alert("Ha habido un error.");
									},
									success : function(datos) {
										$("article").html(datos).hide().fadeIn(
												200);
									}
								}); // Fin de Ajax.
					} // Fin de la función crearFactura.

					$(document).on("click", "#crearFactura", crearFactura);
					$("#crearFactura").keypress(function(e) {
						if (e.which === 13)
							crearFactura();
					});

					function insertarFactura() {
						$
								.ajax({
									url : './modulos/compras/includes/crearFactura.php',
									type : 'POST',
									data : $("#nuevaFactura").serialize(),
									dataType : 'html',
									error : function() {
										alert("Ha habido un error.");
									},
									success : function(datos) {
										$("article").html(datos).hide().fadeIn(
												200);
									}
								}); // Fin de Ajax.
					} // Fin de la función crearFactura.

					$(document).on("click", "#botonCrearFactura",
							insertarFactura);
					$("#botonCrearFactura").keypress(function(e) {
						if (e.which === 13)
							insertarFactura();
					});

					function eliminarProveedor() {
						$respuesta = confirm("¿Estás realmente seguro de que quieres eliminar el proveedor de la base de datos?");

						if ($respuesta) {
							$
									.ajax({
										url : './modulos/compras/includes/eliminarProveedor.php',
										type : 'POST',
										data : {
											"nombre" : $(this).attr('id')
										},
										dataType : 'html',
										error : function() {
											alert("Ha habido un error.");
										},
										success : function(datos) {
											if (datos == true) {
												$("article")
														.html(
																"Proveedor eliminado correctamente.")
														.hide().fadeIn(200);
											} else {
												alert("Imposible eliminar el proveedor de la base de datos.");
												imprimirTablas();
											}
											$("article").html(datos).hide()
													.fadeIn(200);
										}
									}); // Fin de ajax.
						} else {
							alert("Operación cancelada.");
						}
					} // Fin de la función eliminarProveedor.

					$(document).on("click", ".eliminarProveedor",
							eliminarProveedor);
					$(".eliminarProveedor").keypress(function(e) {
						if (e.which === 13)
							eliminarProveedor();
					});

					function buscarProveedor() {
						$
								.ajax({
									url : './modulos/compras/includes/buscarProveedor.php',
									type : 'POST',
									data : $("#formularioEliminarProveedor")
											.serialize(),
									dataType : 'html',
									error : function() {
										alert("Ha habido un error.");
									},
									success : function(datos) {
										$("#resultadosEliminacionProveedor")
												.html(datos).hide().fadeIn(200);
									}
								}); // Fin de Ajax.
					} // Fin de la función mostrarTexto.

					$(document).on("click", "#botonBuscarProveedor",
							buscarProveedor);
					$("#botonBuscarProveedor").keypress(function(e) {
						if (e.which === 13)
							buscarProveedor(); });
	
	function mostrarFichaProveedor() {
$.ajax({
									url : './modulos/compras/includes/fichaProveedor.php',
									type : 'POST',
									data : {
										"nombre" : $(this).text(),
										"identificador": $(this).attr("proveedorElegido")
									},
									dataType : 'html',
									error : function(e) {
										alerta("Se ha producido el siguiente error: ".e
												.getMessage());
									},
									success : function(datos) {
										$("article #muestrarioProveedor").html(datos).hide().fadeIn(
												200);
									}
								}); // Fin de ajax.
					} // Fin de la función mostrarFichaProveedor.

					$(document).on("click", "#filaProveedor",
							mostrarFichaProveedor);
					$("#filaProveedor").keypress(function(e) {
						if (e.which === 13)
							mostrarFichaProveedor();
					});

					function editarProveedor() {
						$
								.ajax({
									url : './modulos/compras/includes/formularioEditarProveedor.php',
									type : 'POST',
									data : {
										"cif" : $(this).attr('id')
									},
									dataType : 'html',
									error : function(e) {
										alerta("Se ha producido el siguiente error: ".e
												.getMessage());
									},
									success : function(datos) {
										$("article").html(datos).hide().fadeIn(
												200);
									}
								}); // Fin de ajax.
					} // Fin de la función editarProveedor.

					$(document)
							.on("click", ".editarProveedor", editarProveedor);
					$(".editarProveedor").keypress(function(e) {
						if (e.which === 13)
							editarProveedor();
					});

					function cargarFormularioNuevoContacto() {
						$
								.ajax({
									url : './modulos/compras/includes/formularioNuevoContacto.php',
									type : 'POST',
									dataType : 'html',
									error : function() {
										alert("Ha habido un error");
									},
									success : function(datos) {
										$("article").html(datos).hide().fadeIn(
												200);
									}
								}); // Fin de ajax.
					} // Fin de la función cargarFormularioNuevoContacto.

					$(document).on("click", "#gestionarContactos",
							cargarFormularioNuevoContacto);
					$("#gestionarContactos").keypress(function(e) {
						if (e.which === 13)
							cargarFormularioNuevoContacto();
					});

					function insertarContacto() {
						$
								.ajax({
									url : './modulos/compras/includes/insertarContacto.php',
									type : 'POST',
									data : {
										"nombre" : $(
												"#formularioNuevoContacto #nombre")
												.val(),
										"departamento" : $(
												"#formularioNuevoContacto #departamento")
												.val(),
										"id_proveedor" : $(
												"#formularioNuevoContacto #proveedoresRegistrados")
												.val()
									},
									dataType : 'html',
									error : function(e) {
										alerta("Se ha producido el siguiente error: ".e
												.getMessage());
									},
									success : function(datos) {
										$("article").html(datos).hide().fadeIn(
												200);
									}
								}); // Fin de ajax.
					} // Fin de la función mostrarFichaProveedor.

					$(document).on("click", "#botonCrearContacto",
							insertarContacto);
					$("#botonCrearContacto").keypress(function(e) {
						if (e.which === 13)
							insertarContacto(); });
					
					function modificarProveedor() {
$.ajax({
									url : './modulos/compras/includes/actualizarProveedor.php',
									type : 'POST',
									data : $("#formularioEditarProveedor")
											.serialize(),
									dataType : 'html',
									error : function() {
										alert("Ha habido un error.");
									},
									success : function(datos) {
										$("article").html(datos).hide().fadeIn(
												200);
									}
								}); // Fin de ajax.
					} // Fin de la función modificarProveedor.

					$(document).on("click", "#modificarProveedor",
							modificarProveedor);
					$("#modificarProveedor").keypress(function(e) {
						if (e.which === 13)
							modificarProveedor(); });
					
					function editarContacto() {
$.ajax({
									url : './modulos/compras/includes/formularioEditarContacto.php',
									type : 'POST',
									data : {
										"idContacto" : $(this).attr('id')
									},
									dataType : 'html',
									error : function() {
										alert("Ha habido un error.");
									},
									success : function(datos) {
										$("article").html(datos).hide().fadeIn(
												200);
									}
								});// Fin del ajax.
					} // Fin de la función editarContacto.

					$(document).on("click", ".editarContacto", editarContacto);
					$(".editarContacto").keypress(function(e) {
						if (e.which === 13)
							editarContacto(); })
					
					function eliminarContacto() {
						$.ajax({
									url : './modulos/compras/includes/eliminarContacto.php',
									type : 'POST',
									data : {
										"id_contacto" : $(this).attr('id')
									},
									dataType : 'html',
									error : function() {
										alert("Ha habido un error.");
									},
									succes : function(datos) {
										$("article").html(datos).hide().fadeIN(
												200);
									}
								}); // Fin de ajax.
					} // Fin de la función eliminarContacto.

					$(document).on("click", ".eliminarContacto",
							eliminarContacto);
					$(".eliminarContacto").keypress(function(e) {
						if (e.which === 13)
							eliminarContacto(); });
					
					function modificarContacto() {
$.ajax({
									url : './modulos/compras/includes/actualizarContacto.php',
									type : 'POST',
									data : $("#formularioEditarContacto")
											.serialize(),
									dataType : 'html',
									error : function() {
										alert("Ha habido un error.");
									},
									success : function(datos) {
										$("article").html(datos).hide().fadeIn(
												200);
									}
								}); // Fin de ajax.						
					} // Fin de la función modificarContacto.

					$(document).on("click", "#modificarContacto",
							modificarContacto);
					$("#modificarContacto").keypress(function(e) {
						if (e.which === 13)
							modificarContacto();
					});
					
					function cargarFormularioNuevoMetodoPago() {
$.ajax({
									url : './modulos/compras/includes/formularioNuevoMetodoPago.php',
									type : 'POST',
									dataType : 'html',
									error : function() {
										alert("Ha habido un error.");
									},
									success : function(datos) {
										$("article").html(datos).hide().fadeIn(
												200);
									}
								}); // Fin del ajax.						
					} // Fin de la función cargarFormularioNuevoMetodoPago.

					$(document).on("click", "#anyadirMetodo",
							cargarFormularioNuevoMetodoPago);
					$("#anyadirMetodo").keypress(function(e) {
						if (e.which === 13) {
							cargarFormularioNuevoMetodoPago();
						}});
					
					function insertarMetodoPago() {
$.ajax({
									url : './modulos/compras/includes/insertarMetodoPago.php',
									type : 'POST',
									data : $("#formularioNuevoMetodoPago")
											.serialize(),
									dataType : 'html',
									error : function() {
										alert("Ha habido un error.");
									},
									success : function(datos) {
										$("article").html(datos).hide().fadeIn(
												200);
									}
								}); // Fin de ajax.						
					} // Fin de la función insertarMetodoPago.

					$(document).on("click", "#botonCrearMetodoPago",
							insertarMetodoPago);
					$("#botonCrearMetodoPago").keypress(function(e) {
						if (e.which === 13)
							insertarMetodoPago(); });
					
					function obtenerDatosPedido() {
$.ajax({
									url : './modulos/compras/includes/obtenerPedido.php',
									type : 'POST',
									data : $("#formularioNuevaFactura")
											.serialize(),
									dataType : 'html',
									error : function() {
										alert("Ha habido un error.");
									},
									success : function(datos) {
										$("article").html(datos).hide().fadeIn(
												200);
									}
								}); // Fin de ajax.						
					} // Fin de la función obtenerDatosPedido.

					$(document).on("click", "#botonObtenerDatosFactura",
							obtenerDatosPedido);
   

});// Fin document.ready

