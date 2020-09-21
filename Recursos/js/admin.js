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

$(document).ready(function () {
    
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
                $("#res-form-update_inf").html('Agregando<br><img src="recursos/img/enviando.gif" class="center-all-contens">');
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
                $("#res-form-add-bodega").html('Agregando<br><img src="recursos/img/enviando.gif" class="center-all-contens">');
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
                $("#res-form-up-bodega").html('Agregando cantidad<br><img src="recursos/img/enviando.gif" class="center-all-contens">');
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
    
    //Cambiar estado publicación
    //Metodo ajax que realiza la consulta de la clase DAO y la imprime en el div seleccionado
    //al hacer submit al formulario que se encuentra dentro del div llamado buscar_prod
    $('#change_publicacion form').submit(function (e) {
        e.preventDefault();
        var informacion = $('#change_publicacion form').serialize();
        var metodo = $('#change_publicacion form').attr('method');
        var peticion = $('#change_publicacion form').attr('action');
        $.ajax({
            type: metodo,
            url: peticion,
            data: informacion,
            beforeSend: function () {
                $("#res-form-change-pub").html('Agregando<br><img src="Recursos/img/enviando.gif" class="center-all-contens">');
            },
            error: function () {
                $("#res-form-change-pub").html("Ha ocurrido un error en el sistema");
            },
            success: function (data) {
                $("#res-form-change-pub").html(data);
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
    
    //Actualizar una publicacion
    $('.button-PUB').click(function () {
        var myId = $(this).val();
        $('#divPublicaciones form#' + myId).submit(function (e) {

            e.preventDefault();
            var informacion = $('#divPublicaciones form#' + myId).serialize();
            var metodo = $('#divPublicaciones form#' + myId).attr('method');
            var peticion = $('#divPublicaciones form#' + myId).attr('action');
            $.ajax({
                type: metodo,
                url: peticion,
                data: informacion,
                beforeSend: function () {
                    $("div#" + myId).html('<br><img src="Recursos/img/Update.gif" class="center-all-contens"><br>Actualizando...');
                },
                error: function () {
                    $("div#" + myId).html("Ha ocurrido un error en el sistema");
                },
                success: function (data) {
                    $("div#" + myId).html(data);
                }
            });
            return false;
        });
    });
    $('.button-Bodega').click(function () {
        var myId = $(this).val();
        $('#update-bodega form#' + myId).submit(function (e) {

            e.preventDefault();
            var informacion = $('#update-bodega form#' + myId).serialize();
            var metodo = $('#update-bodega form#' + myId).attr('method');
            var peticion = $('#update-bodega form#' + myId).attr('action');
            $.ajax({
                type: metodo,
                url: peticion,
                data: informacion,
                beforeSend: function () {
                    $("div#" + myId).html('<br><img src="Recursos/img/Update.gif" class="center-all-contens"><br>Actualizando...');
                },
                error: function () {
                    $("div#" + myId).html("Ha ocurrido un error en el sistema");
                },
                success: function (data) {
                    $("div#" + myId).html(data);
                }
            });
            return false;
        });
    });
    //Actualizar un pedido a proveedor
    $('.button-UPP').click(function () {
        var myId = $(this).val();
        $('#res-del-ped form#' + myId).submit(function (e) {

            e.preventDefault();
            var informacion = $('#res-del-ped form#' + myId).serialize();
            var metodo = $('#res-del-ped form#' + myId).attr('method');
            var peticion = $('#res-del-ped form#' + myId).attr('action');
            $.ajax({
                type: metodo,
                url: peticion,
                data: informacion,
                beforeSend: function () {
                    $("div#" + myId).html('<br><img src="Recursos/img/Update.gif" class="center-all-contens"><br>Actualizando...');
                },
                error: function () {
                    $("div#" + myId).html("Ha ocurrido un error en el sistema");
                },
                success: function (data) {
                    $("div#" + myId).html(data);
                }
            });
            return false;
        });
    });

    //Pagar un pedido a proveedor
    $('.button-UPP2').click(function () {
        var myId = $(this).val();
        $('#res-change-ped form#' + myId).submit(function (e) {

            e.preventDefault();
            var informacion = $('#res-change-ped form#' + myId).serialize();
            var metodo = $('#res-change-ped form#' + myId).attr('method');
            var peticion = $('#res-change-ped form#' + myId).attr('action');
            $.ajax({
                type: metodo,
                url: peticion,
                data: informacion,
                beforeSend: function () {
                    $("div#" + myId).html('<br><img src="Recursos/img/Update.gif" class="center-all-contens"><br>Actualizando...');
                },
                error: function () {
                    $("div#" + myId).html("Ha ocurrido un error en el sistema");
                },
                success: function (data) {
                    $("div#" + myId).html(data);
                }
            });
            return false;
        });
    });

    //Eliminar un pedido a proveedor
    $('.button-PD').click(function () {
        var myId = $(this).val();
        $('#res-update-ped form#' + myId).submit(function (e) {

            e.preventDefault();
            var informacion = $('#res-update-ped form#' + myId).serialize();
            var metodo = $('#res-update-ped form#' + myId).attr('method');
            var peticion = $('#res-update-ped form#' + myId).attr('action');
            $.ajax({
                type: metodo,
                url: peticion,
                data: informacion,
                beforeSend: function () {
                    $("div#" + myId).html('<br><img src="Recursos/img/Update.gif" class="center-all-contens"><br>Actualizando...');
                },
                error: function () {
                    $("div#" + myId).html("Ha ocurrido un error en el sistema");
                },
                success: function (data) {
                    $("div#" + myId).html(data);
                }
            });
            return false;
        });
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

    //Enviar email a clientes
    //Metodo ajax que realiza la consulta de la clase DAO y la imprime en el div seleccionado
    //al hacer submit al formulario send_mail_clientes
    $('#send_email_clientes').submit(function (e) {
        e.preventDefault();
        var informacion = $('#send_email_clientes form').serialize();
        var metodo = $('#send_email_clientes form').attr('method');
        var peticion = $('#send_email_clientes form').attr('action');
        $.ajax({
            type: metodo,
            url: peticion,
            data: informacion,
            beforeSend: function () {
                $("#res_send_clientes").html('Enviando Email a Clientes <br><img src="Recursos/img/enviando.gif" class="center-all-contens">');
            },
            error: function () {
                $("#res_send_clientes").html("Ha ocurrido un error en el sistema");
            },
            success: function (data) {
                $("#res_send_clientes").html(data);
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


    //*Envio del formulario con Ajax para restaurar login cliente*/

    $('.button_UP_res_cliente').click(function () {
        var myId = $(this).val();
        $('#restaurar_cliente form#' + myId).submit(function (e) {
            e.preventDefault();
            var informacion = $('#restaurar_cliente form#' + myId).serialize();
            var metodo = $('#restaurar_cliente form#' + myId).attr('method');
            var peticion = $('#restaurar_cliente form#' + myId).attr('action');
            $.ajax({
                type: metodo,
                url: peticion,
                data: informacion,
                beforeSend: function () {
                    $("div#" + myId).html('<br><img src="Recursos/img/Update.gif" class="center-all-contens"><br>Restaurando...');
                },
                error: function () {
                    $("div#" + myId).html("Ha ocurrido un error en el sistema");
                },
                success: function (data) {
                    $("div#" + myId).html(data);
                }
            });
            return false;
        });
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
    /*Actualizar categoria con ajax*/

    $('.button-UC').click(function () {

        var myId = $(this).val();
        $('#update-category form#' + myId).submit(function (e) {

            e.preventDefault();
            var informacion = $('#update-category form#' + myId).serialize();
            var metodo = $('#update-category form#' + myId).attr('method');
            var peticion = $('#update-category form#' + myId).attr('action');
            $.ajax({

                type: metodo,
                url: peticion,
                data: informacion,
                beforeSend: function () {

                    $("div#" + myId).html('<br><img src="Recursos/img/Update.gif" class="center-all-contens"><br>Actualizando...');
                },
                error: function () {

                    $("div#" + myId).html("Ha ocurrido un error en el sistema");
                },
                success: function (data) {

                    $("div#" + myId).html(data);
                }

            });
            return false;
        });
    });
    /*Actualizar proveedores con ajax*/

    $('.button-UP').click(function () {
        var myId = $(this).val();
        $('#update-proveedor form#' + myId).submit(function (e) {

            e.preventDefault();
            var informacion = $('#update-proveedor form#' + myId).serialize();
            var metodo = $('#update-proveedor form#' + myId).attr('method');
            var peticion = $('#update-proveedor form#' + myId).attr('action');
            $.ajax({
                type: metodo,
                url: peticion,
                data: informacion,
                beforeSend: function () {
                    $("div#" + myId).html('<br><img src="Recursos/img/Update.gif" class="center-all-contens"><br>Actualizando...');
                },
                error: function () {
                    $("div#" + myId).html("Ha ocurrido un error en el sistema");
                },
                success: function (data) {
                    $("div#" + myId).html(data);
                }
            });
            return false;
        });
    });

    /*Actualizar producto con ajax*/

    $('.button-UPR').click(function () {

        var myId = $(this).val();
        $("input#t" + myId).val(myId);

        $('#update-product form#' + myId).submit(function (e) {

            e.preventDefault();
            var informacion = $('#update-product form#' + myId).serialize();
            var metodo = $('#update-product form#' + myId).attr('method');
            var peticion = $('#update-product form#' + myId).attr('action');

            $.ajax({
                type: metodo,
                url: peticion,
                data: informacion,
                beforeSend: function () {
                    $("div#" + myId).html('<br><img src="Recursos/img/Update.gif" class="center-all-contens"><br>Actualizando...');
                },
                error: function () {

                    $("div#" + myId).html("Ha ocurrido un error en el sistema");
                },
                success: function (data) {

                    $("div#" + myId).html(data);
                }
            });
            return false;
        });
    });

    /*Actualizar producto con ajax*/

    $('.button-DEL').click(function () {

        var myId = $(this).val();
        $("input#t" + myId).val(myId);

        $('#del-pedido form#' + myId).submit(function (e) {

            e.preventDefault();
            var informacion = $('#del-pedido form#' + myId).serialize();
            var metodo = $('#del-pedido form#' + myId).attr('method');
            var peticion = $('#del-pedido form#' + myId).attr('action');

            $.ajax({
                type: metodo,
                url: peticion,
                data: informacion,
                beforeSend: function () {
                    $("div#" + myId).html('<br><img src="Recursos/img/Update.gif" class="center-all-contens"><br>Actualizando...');
                },
                error: function () {

                    $("div#" + myId).html("Ha ocurrido un error en el sistema");
                },
                success: function (data) {

                    $("div#" + myId).html(data);
                }
            });
            return false;
        });
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
    /*Actualizar pedido con ajax*/

    $('.button-UPPE').click(function () {
        var myId = $(this).val();
        $('#update-pedido form#' + myId).submit(function (e) {
            e.preventDefault();
            var informacion = $('#update-pedido form#' + myId).serialize();
            var metodo = $('#update-pedido form#' + myId).attr('method');
            var peticion = $('#update-pedido form#' + myId).attr('action');
            $.ajax({
                type: metodo,
                url: peticion,
                data: informacion,
                beforeSend: function () {
                    $("div#" + myId).html('<br><img src="Recursos/img/Update.gif" class="center-all-contens"><br>Actualizando...');
                },
                error: function () {
                    $("div#" + myId).html("Ha ocurrido un error en el sistema");
                },
                success: function (data) {
                    $("div#" + myId).html(data);
                }
            });
            return false;
        });
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





