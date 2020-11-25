<?php
include '../Conexion/consulSQL.php';
?>
<div class="modal-dialog modal-lm">
    <div class="modal-content center-all-contens" id="crear_proveedor">
        <div class="modal-header headerModal">
            <h4 class="modal-title" id="myModalLabel">Crear Proveedor</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body center-all-contens text-center" style="width: 95%" >
            <form action="DAO/proveedorDAO.php" method="post" role="form">
                <div class="form-group">
                    <label>NIT</label>
                    <input class="form-control" type="text" id="txtNitProv" name="prove-nit" placeholder="NIT proveedor" maxlength="30" required="">
                </div>
                <div class="form-group">
                    <label>Nombre</label>
                    <input class="form-control" type="text" id="txtNombreProv" pattern="[A-Za-z ]+" name="prove-name" placeholder="Nombre proveedor" maxlength="30" required="">
                </div>
                <div class="form-group">
                    <label>Dirección</label>
                    <input class="form-control" type="text" id="txtDirProv" name="prove-dir" placeholder="Dirección proveedor">
                </div>
                <div class="form-group">
                    <label>Teléfono</label>
                    <input class="form-control" type="tel" id="txtTelProv" name="prove-tel" placeholder="Número telefónico" pattern="[0-9] {
                           1, 20
                           }" maxlength="20" required="">
                </div>
                <div class="form-group">
                    <label>Página web o Email</label>
                    <input class="form-control" type="text" id="txtWebProv" name="prove-web" placeholder="Página web proveedor">
                </div>
                <p class="text-center"><button type="submit" class="btn btn-primary">Añadir proveedor</button></p>
                <br>
                <input type="text" name="funcion" style="display: none" value="crearProveedor">
                <div id="res-form-add-prove" style="width: 100%; text-align: center; margin: 0;"></div>
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
        // Crear un proveedor
        //Metodo ajax que realiza la consulta de la clase DAO y la imprime en el div seleccionado
        //al hacer submit al formulario que se encuentra dentro del div  llamado crear_proveedor
        $('#crear_proveedor form').submit(function (e) {
            e.preventDefault();
            var informacion = $('#crear_proveedor form').serialize();
            var metodo = $('#crear_proveedor form').attr('method');
            var peticion = $('#crear_proveedor form').attr('action');
            $.ajax({
                type: metodo,
                url: peticion,
                data: informacion,
                beforeSend: function () {
                    $("#res-form-add-prove").html(
                            'Creando<br><img src="Recursos/img/enviando.gif" class="center-all-contens">'
                            );
                },
                error: function () {
                    $("#res-form-add-prove").html("Ha ocurrido un error en el sistema");
                },
                success: function (data) {
                    $("#res-form-add-prove").html(data);
                    $('#crearProveedor').modal('hide'); // cerrar
                }
            });
            return false;
        });
    });
</script>