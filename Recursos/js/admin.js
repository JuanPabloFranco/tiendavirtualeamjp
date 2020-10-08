function validarTipoPublicacion(tipo) {
    if (tipo == "Imagen") {
        document.getElementById("divImagen").style.display = '';
        document.getElementById("divImagen2").style.display = '';
        document.getElementById("divVideo").style.display = 'none';
        document.getElementById("divVideo2").style.display = 'none';
    } else {
        document.getElementById("divImagen").style.display = 'none';
        document.getElementById("divImagen2").style.display = 'none';
        document.getElementById("divVideo").style.display = '';
        document.getElementById("divVideo2").style.display = '';
    }
}

function limpiarCamposRegCategoria() {
    document.getElementById("txtCodCategoria").value = "";
    document.getElementById("txtNomCategoria").value = "";
    document.getElementById("txtDescCategoria").value = "";
}

function minimoBodega(minimo) {
    document.getElementById("txtMinimoBodega").value = minimo;
}

function precioBodega(precio) {
    document.getElementById("txtPrecioBodega").value = precio;
}

function submitBodega(id, form) {
    document.getElementById("txtidBodega").value = id;
    form.submit;
}

function limpiarCamposRegProveedor() {
    document.getElementById("txtNitProv").value = "";
    document.getElementById("txtNombreProv").value = "";
    document.getElementById("txtDirProv").value = "";
    document.getElementById("txtTelProv").value = "";
    document.getElementById("txtWebProv").value = "";
}

function limpiarCamposBodega() {
    document.getElementById("txtPrecioVentaProducto").value = "";
    document.getElementById("txtCantidadMinProductoBodega").value = "";
    document.getElementById("txtCantidadProductoBodega").value = "";
    document.getElementById("txtCantidadProductoBodegaChange").value = "";
}

function limpiarCamposRegDomiciliario() {
    document.getElementById("txtCedulaRepartidor").value = "";
    document.getElementById("txtNombreRepartidor").value = "";
}

function limpiarCamposRegUsuario() {
    document.getElementById("txtNombreCUsuario").value = "";
    document.getElementById("txtNombreUsuario").value = "";
    document.getElementById("txtPassUsuario").value = "";
}

function limpiarCamposCliente() {
    document.getElementById("txtCedulaCliente").value = "";
    document.getElementById("txtNombreCliente").value = "";
    document.getElementById("txtDirCliente").value = "";
    document.getElementById("txtTelCliente").value = "";
    document.getElementById("txtEmailCliente").value = "";
    document.getElementById("txtNomUsuario").value = "";
    document.getElementById("txtPassCliente").value = "";
}

$(document).ready(function () {
    //Incluye el archivo de la lista de productos en el carrito al div correspondiente
    $('#carrito-compras-tienda').load("DAO/carritoDAO.php");
    //Animacion boton carrito
    $(".carrito-button-nav").click(function () {
        $("#container-carrito-compras").animate({height: 'toggle'}, 200);
    });

    // Incluye el archivo de la tabla de categorias dentro del DIV correspondiente en configAdmin
    $('#tablaCategoriasFull').load("Recursos/includes/tablaCategorias.php");

    // Incluye el archivo de la tabla de proveedores dentro del DIV correspondiente en configAdmin
    $('#tablaProveedores').load("Recursos/includes/tablaProveedores.php");

    // Incluye el archivo de la tabla de productos dentro del DIV correspondiente en configAdmin
    $('#tablaProductos').load("Recursos/includes/tablaProductos.php");

    // Incluye el archivo de la tabla de usuarios dentro del DIV correspondiente en configAdmin
    $('#tablaUsuarios').load("Recursos/includes/tablaUsuarios.php");

    // Incluye el archivo de la tabla de usuarios dentro del DIV correspondiente en configAdmin
    $('#tablaBodega').load("Recursos/includes/tablaBodega.php");

    // Incluye el archivo de la tabla de usuarios dentro del DIV correspondiente en configAdmin
    $('#tablaDomiciliario').load("Recursos/includes/tablaDomiciliario.php");

    // Incluye el archivo de la tabla de pedidos dentro del DIV correspondiente en ventas
    $('#tablaPedidos').load("Recursos/includes/tablaPedidos.php");

    //*Envio del formulario con Ajax para agregar productos al carrito*/

    $('.button-carrito').click(function () {
        var myId = $(this).val();
        $('#divCarrito form#' + myId).submit(function (e) {
            e.preventDefault();
            var informacion = $('#divCarrito form#' + myId).serialize();
            var metodo = $('#divCarrito form#' + myId).attr('method');
            var peticion = $('#divCarrito form#' + myId).attr('action');
            $.ajax({
                type: metodo,
                url: peticion,
                data: informacion,
                beforeSend: function () {
                    $('.modal-carrito').modal('show'); // Muestra el modal con progreso
                    $("#msjCarrito").html('Agregando<br><img src="Recursos/img/enviando.gif" class="center-all-contens">');
                },
                error: function () {
                    $('.modal-carrito').modal('show'); // Muestra el modal diciendo que hubo un error
                    $("#res-form-update_inf").html("Hubo un error al añadir el producto al carrito");
                },
                success: function (data) {
                    $('.modal-carrito').modal('show'); // Muestra el modal diciendo que se agrego al carrito el producto
                    $("#res-form-update_inf").html("El producto se añadió al carrito");
                }
            });
            return false;
        });
    });

    //Actualizar informacion empresa
    //Metodo ajax que realiza la consulta de la clase DAO y la imprime en el div seleccionado
    //al hacer submit al formulario que se encuentra dentro del div llamado buscar_prod
    $('#add-inf_empresa form').submit(function (e) {
        e.preventDefault();
        var informacion = $('#add-inf_empresa form').serialize();
        var metodo = $('#add-inf_empresa form').attr('method');
        var peticion = $('#add-inf_empresa form').attr('action');
        $.ajax({
            type: metodo,
            url: peticion,
            data: informacion,
            beforeSend: function () {
                $("#res-form-update_inf").html('Agregando<br><img src="Recursos/img/enviando.gif" class="center-all-contens">');
            },
            error: function () {
                $("#res-form-update_inf").html("Ha ocurrido un error en el sistema");
            },
            success: function (data) {
                $("#res-form-update_inf").html(data);
            }

        });
        return false;
    });
    // Agregar producto a bodega
    //Metodo ajax que realiza la consulta de la clase DAO y la imprime en el div seleccionado
    //al hacer submit al formulario que se encuentra dentro del div llamado buscar_prod
    $('#add-bodega form').submit(function (e) {
        e.preventDefault();
        var informacion = $('#add-bodega form').serialize();
        var metodo = $('#add-bodega form').attr('method');
        var peticion = $('#add-bodega form').attr('action');
        $.ajax({
            type: metodo,
            url: peticion,
            data: informacion,
            beforeSend: function () {
                $("#res-form-add-bodega").html('Agregando<br><img src="Recursos/img/enviando.gif" class="center-all-contens">');
            },
            error: function () {
                $("#res-form-add-bodega").html("Ha ocurrido un error en el sistema");
            },
            success: function (data) {
                $("#res-form-add-bodega").html(data);
            }

        });
        return false;
    });

    // cambiar cantidad de producto en bodega
    //Metodo ajax que realiza la consulta de la clase DAO y la imprime en el div seleccionado
    //al hacer submit al formulario que se encuentra dentro del div llamado buscar_prod
    $('#up-bodega form').submit(function (e) {
        e.preventDefault();
        var informacion = $('#up-bodega form').serialize();
        var metodo = $('#up-bodega form').attr('method');
        var peticion = $('#up-bodega form').attr('action');
        $.ajax({
            type: metodo,
            url: peticion,
            data: informacion,
            beforeSend: function () {
                $("#res-form-up-bodega").html('Agregando cantidad<br><img src="Recursos/img/enviando.gif" class="center-all-contens">');
            },
            error: function () {
                $("#res-form-up-bodega").html("Ha ocurrido un error en el sistema");
            },
            success: function (data) {
                $("#res-form-up-bodega").html(data);
            }

        });
        return false;
    });




    //Agregar Pedido a proveedor
    //Metodo ajax que realiza la consulta de la clase DAO y la imprime en el div seleccionado
    //al hacer submit al formulario que se encuentra dentro del div llamado buscar_prod
    $('#add-pedido_proveedor form').submit(function (e) {
        e.preventDefault();
        var informacion = $('#add-pedido_proveedor form').serialize();
        var metodo = $('#add-pedido_proveedor form').attr('method');
        var peticion = $('#add-pedido_proveedor form').attr('action');
        $.ajax({
            type: metodo,
            url: peticion,
            data: informacion,
            beforeSend: function () {
                $("#res-form-add-pedido").html('Agregando<br><img src="Recursos/img/enviando.gif" class="center-all-contens">');
            },
            error: function () {
                $("#res-form-add-pedido").html("Ha ocurrido un error en el sistema");
            },
            success: function (data) {
                $("#res-form-add-pedido").html(data);
            }
        });
        return false;
    });

    //Verificar si se paga en efectivo, en caso de que si deshabilitar el campo de CAMBIO
    $("#pagoEfectivo").click(function () {
        if ($("#pagoEfectivo").is(':checked')) {
            $("#txtCambio").prop('readonly', false);
            $('#titleTransferencia').hide();
            $('#divCcambio').show();
        }
    });

    $("#pagoTransferencia").click(function () {
        if ($("#pagoTransferencia").is(':checked')) {
            $("#txtCambio").prop('readonly', true);
            $('#titleTransferencia').show();
            $('#divCcambio').hide();
        }
    });

    $("#pagoTCredito").click(function () {
        if ($("#pagoTCredito").is(':checked')) {
            $("#txtCambio").prop('readonly', true);
            $('#titleTransferencia').hide();
            $('#divCcambio').hide();
        }
    });

    $("#pagoDatafono").click(function () {
        if ($("#pagoDatafono").is(':checked')) {
            $("#txtCambio").prop('readonly', true);
            $('#titleTransferencia').hide();
            $('#divCcambio').hide();
        }
    });

    //Metodo ajax que realiza la consulta de la clase DAO y la imprime en el div seleccionado
    //al hacer submit al formulario que se encuentra dentro del div llamado buscar_prod
    //Funcion para agregar productos
    $('#divAgregarProd form').submit(function (e) {
        e.preventDefault();
        var informacion = $('#divAgregarProd form').serialize();
        var metodo = $('#divAgregarProd form').attr('method');
        var peticion = $('#divAgregarProd form').attr('action');
        $.ajax({
            type: metodo,
            url: peticion,
            data: informacion,
            beforeSend: function () {
                $("#res-ag-prod").html('Agregando<br><img src="Recursos/img/enviando.gif" class="center-all-contens">');
            },
            error: function () {
                $("#res-ag-prod").html("Ha ocurrido un error en el sistema");
            },
            success: function (data) {
                $("#res-ag-prod").html(data);
            }

        });
        return false;
    });

    //*Envio del formulario con Ajax para cambiar estado de un domiciliario*/

    $('#change_repartidor').submit(function (e) {
        e.preventDefault();
        var informacion = $('#change_repartidor form').serialize();
        var metodo = $('#change_repartidor form').attr('method');
        var peticion = $('#change_repartidor form').attr('action');
        $.ajax({
            type: metodo,
            url: peticion,
            data: informacion,
            beforeSend: function () {
                $("#res-form-change-rep").html('Cambiando estado del domicilario <br><img src="Recursos/img/enviando.gif" class="center-all-contens">');
            },
            error: function () {
                $("#res-form-change-rep").html("Ha ocurrido un error en el sistema");
            },
            success: function (data) {
                $("#res-form-change-rep").html(data);
            }

        });
        return false;
    });

    //*Envio del formulario con Ajax para cambiar estado producto*/

    $('#change-prod-form form').submit(function (e) {
        e.preventDefault();
        var informacion = $('#change-prod-form form').serialize();
        var metodo = $('#change-prod-form form').attr('method');
        var peticion = $('#change-prod-form form').attr('action');
        $.ajax({
            type: metodo,
            url: peticion,
            data: informacion,
            beforeSend: function () {
                $("#res-form-change-prod").html('Cambiando estado del producto <br><img src="Recursos/img/enviando.gif" class="center-all-contens">');
            },
            error: function () {
                $("#res-form-change-prod").html("Ha ocurrido un error en el sistema");
            },
            success: function (data) {
                $("#res-form-change-prod").html(data);
            }

        });
        return false;
    });
    //*Envio del formulario con Ajax para cambiar estado producto a agotado*/

    $('#change-prod-ag-form form').submit(function (e) {
        e.preventDefault();
        var informacion = $('#change-prod-ag-form form').serialize();
        var metodo = $('#change-prod-ag-form form').attr('method');
        var peticion = $('#change-prod-ag-form form').attr('action');
        $.ajax({
            type: metodo,
            url: peticion,
            data: informacion,
            beforeSend: function () {
                $("#res-form-agotado-prod").html('Cambiando estado del producto <br><img src="Recursos/img/enviando.gif" class="center-all-contens">');
            },
            error: function () {
                $("#res-form-agotado-prod").html("Ha ocurrido un error en el sistema");
            },
            success: function (data) {
                $("#res-form-agotado-prod").html(data);
            }

        });
        return false;
    });
    /*Envio del formulario con Ajax para eliminar producto*/

    $('#del-prod-form form').submit(function (e) {
        e.preventDefault();
        var informacion = $('#del-prod-form form').serialize();
        var metodo = $('#del-prod-form form').attr('method');
        var peticion = $('#del-prod-form form').attr('action');
        $.ajax({
            type: metodo,
            url: peticion,
            data: informacion,
            beforeSend: function () {
                $("#res-form-del-prod").html('Eliminando producto <br><img src="Recursos/img/enviando.gif" class="center-all-contens">');
            },
            error: function () {
                $("#res-form-del-prod").html("Ha ocurrido un error en el sistema");
            },
            success: function (data) {
                $("#res-form-del-prod").html(data);
            }

        });
        return false;
    });
    /*Envio del formulario con Ajax para añadir categoria*/

    $('#add-categori form').submit(function (e) {
        e.preventDefault();
        var informacion = $('#add-categori form').serialize();
        var metodo = $('#add-categori form').attr('method');
        var peticion = $('#add-categori form').attr('action');
        $.ajax({
            type: metodo,
            url: peticion,
            data: informacion,
            beforeSend: function () {
                $("#res-form-add-categori").html('Añadiendo categoria <br><img src="Recursos/img/enviando.gif" class="center-all-contens">');
            },
            error: function () {
                $("#res-form-add-categori").html("Ha ocurrido un error en el sistema");
            },
            success: function (data) {
                $("#res-form-add-categori").html(data);
            }
        });
        return false;
    });
    /*Envio del formulario con Ajax para eliminar categoria*/

    $('#del-categori form').submit(function (e) {
        e.preventDefault();
        var informacion = $('#del-categori form').serialize();
        var metodo = $('#del-categori form').attr('method');
        var peticion = $('#del-categori form').attr('action');
        $.ajax({
            type: metodo,
            url: peticion,
            data: informacion,
            beforeSend: function () {
                $("#res-form-del-cat").html('Eliminando categoria <br><img src="Recursos/img/enviando.gif" class="center-all-contens">');
            },
            error: function () {
                $("#res-form-del-cat").html("Ha ocurrido un error en el sistema");
            },
            success: function (data) {
                $("#res-form-del-cat").html(data);
            }
        });
        return false;
    });
    /*Envio del formulario con Ajax para agregar proveedor*/

    $('#add-provee form').submit(function (e) {
        e.preventDefault();
        var informacion = $('#add-provee form').serialize();
        var metodo = $('#add-provee form').attr('method');
        var peticion = $('#add-provee form').attr('action');
        $.ajax({
            type: metodo,
            url: peticion,
            data: informacion,
            beforeSend: function () {
                $("#res-form-add-prove").html('Agregando proveedor <br><img src="Recursos/img/enviando.gif" class="center-all-contens">');
            },
            error: function () {
                $("#res-form-add-prove").html("Ha ocurrido un error en el sistema");
            },
            success: function (data) {
                $("#res-form-add-prove").html(data);
            }
        });
        return false;
    });
    /*Envio del formulario con Ajax para eliminar proveedor*/

    $('#del-prove form').submit(function (e) {

        e.preventDefault();
        var informacion = $('#del-prove form').serialize();
        var metodo = $('#del-prove form').attr('method');
        var peticion = $('#del-prove form').attr('action');
        $.ajax({

            type: metodo,
            url: peticion,
            data: informacion,
            beforeSend: function () {

                $("#res-form-del-prove").html('Eliminando proveedor <br><img src="Recursos/img/enviando.gif" class="center-all-contens">');
            },
            error: function () {

                $("#res-form-del-prove").html("Ha ocurrido un error en el sistema");
            },
            success: function (data) {

                $("#res-form-del-prove").html(data);
            }

        });
        return false;
    });

    //Registrar usuario con ajax
    $('#add-admin form').submit(function (e) {

        e.preventDefault();
        var informacion = $('#add-admin form').serialize();
        var metodo = $('#add-admin form').attr('method');
        var peticion = $('#add-admin form').attr('action');
        $.ajax({
            type: metodo,
            url: peticion,
            data: informacion,
            beforeSend: function () {

                $("#res-form-add-admin").html('Agregando Administrador...<br><img src="Recursos/img/enviando.gif" class="center-all-contens">');
            },
            error: function () {

                $("#res-form-add-admin").html("Ha ocurrido un error en el sistema");
            },
            success: function (data) {

                $("#res-form-add-admin").html(data);
            }

        });
        return false;
    });
    /*Envio del formulario con Ajax para cambiar estado de un usuario*/

    $('#del-admin form').submit(function (e) {

        e.preventDefault();
        var informacion = $('#del-admin form').serialize();
        var metodo = $('#del-admin form').attr('method');
        var peticion = $('#del-admin form').attr('action');
        $.ajax({

            type: metodo,
            url: peticion,
            data: informacion,
            beforeSend: function () {
                $("#res-form-del-admin").html('Cambiando estado de Administrador<br><img src="Recursos/img/enviando.gif" class="center-all-contens">');
            },
            error: function () {
                $("#res-form-del-admin").html("Ha ocurrido un error en el sistema");
            },
            success: function (data) {
                $("#res-form-del-admin").html(data);
            }
        });
        return false;
    });
    /*Envio del formulario con Ajax para eliminar pedido*/

    $('#del-pedido form').submit(function (e) {

        e.preventDefault();
        var informacion = $('#del-pedido form').serialize();
        var metodo = $('#del-pedido form').attr('method');
        var peticion = $('#del-pedido form').attr('action');
        $.ajax({
            type: metodo,
            url: peticion,
            data: informacion,
            beforeSend: function () {

                $("#res-form-del-pedido").html('Eliminando Pedido...<br><img src="Recursos/img/enviando.gif" class="center-all-contens">');
            },
            error: function () {

                $("#res-form-del-pedido").html("Ha ocurrido un error en el sistema");
            },
            success: function (data) {

                $("#res-form-del-pedido").html(data);
            }

        });
        return false;
    });
});