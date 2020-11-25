<?php
include '../Conexion/consulSQL.php';
?>
<div class="modal-dialog modal-lm">
    <div class="modal-content center-all-contens" id="crear_domiciliario">
        <div class="modal-header headerModal">
            <h4 class="modal-title" id="myModalLabel">Crear Domiciliario</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body center-all-contens text-center" style="width: 95%" >
            <form action="DAO/domiciliarioDAO.php" method="post" role="form" enctype="multipart/form-data" id="crearDomi">
                <div class="form-group">
                    <label>Cédula</label>
                    <input class="form-control" type="number" id="txtCedulaRepartidor" pattern="[0-9]{1,20}" name="cedula_repartidor" placeholder="Cédula o No. de Documento del Domiciliario" maxlength="50" required="" title="Cédula o No. de Documento del domiciliario">
                </div>
                <div class="form-group">
                    <label>Nombre Completo</label>
                    <input class="form-control" type="text" id="txtNombreRepartidor" name="nombre_repartidor" pattern="[A-Za-z ]+" placeholder="Nombre completo del domiciliario" required="" title="Nombre completo del domiciliario">
                </div>
                <div class="form-group">
                    <label>Foto del domiciliario</label>
                    <input type="file" name="foto_repartidor">
                    <p class="help-block">Formato de imagenes admitido png, jpg, gif, jpeg</p>
                </div>
                <p class="text-center"><button type="submit" class="btn btn-primary">Agregar Domiciliario</button></p>
                <br>
                <input type="text" name="funcion" style="display: none" value="crearDomiciliario">
                <div id="res-form-add-rep" style="width: 100%; text-align: center; margin: 0;"></div>
            </form>
        </div>
        <div class="modal-footer">
            <p class="text-center">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cerrar</button>
            </p>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $("#crearDomi").on("submit", function (e) {
            e.preventDefault();
            var f = $(this);
            var formData = new FormData(document.getElementById("crearDomi"));
            formData.append("dato", "valor");
            var peticion = $('#crearDomi').attr('action');
            $.ajax({
                url: peticion,
                type: "post",
                dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $("#res-form-add-rep").html(
                            'Creando<br><img src="Recursos/img/enviando.gif" class="center-all-contens">'
                            );
                },
                error: function () {
                    $("#res-form-add-rep").html("Ha ocurrido un error en el sistema");
                },
                success: function (data) {
                    $("#res-form-add-rep").html(data);
                }
            })
        });
    });
</script>