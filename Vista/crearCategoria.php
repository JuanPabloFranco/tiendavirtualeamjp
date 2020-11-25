<?php
include '../Conexion/consulSQL.php';
?>
<div class="modal-dialog modal-lm">
    <div class="modal-content center-all-contens" id="crear_categoria">
        <div class="modal-header headerModal">
            <h4 class="modal-title" id="myModalLabel">Crear Categoria</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body center-all-contens text-center" style="width: 95%" >
            <form action="DAO/categoriaDAO.php" method="post" role="form">
                <div class="form-group">
                    <label>Código</label>
                    <input class="form-control" type="text" id="txtCodCategoria" pattern="[0-9]{1,20}" name="categ-code" placeholder="Código de categoria" maxlength="9" required="">
                </div>
                <div class="form-group">
                    <label>Nombre</label>
                    <input class="form-control" type="text" id="txtNomCategoria" name="categ-name" placeholder="Nombre de categoria" maxlength="30" required="">
                </div>
                <div class="form-group">
                    <label>Descripción</label>
                    <input class="form-control" type="text" id="txtDescCategoria" name="categ-descrip" placeholder="Descripcióne de categoria" required="">
                </div>
                <p class="text-center"><button type="submit" class="btn btn-primary">Agregar categoría</button></p>
                <br>
                <input type="text" name="funcion" style="display: none" value="crearCategoria">
                <div id="res-form-add-categori" style="width: 100%;text-align: center;margin: 0;"></div>
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
        $('#crear_categoria form').submit(function (e) {
            e.preventDefault();
            var informacion = $('#crear_categoria form').serialize();
            var metodo = $('#crear_categoria form').attr('method');
            var peticion = $('#crear_categoria form').attr('action');
            $.ajax({
                type: metodo,
                url: peticion,
                data: informacion,
                beforeSend: function () {
                    $("#res-form-add-categori").html(
                            'Creando<br><img src="Recursos/img/enviando.gif" class="center-all-contens">'
                            );
                },
                error: function () {
                    $("#res-form-add-categori").html("Ha ocurrido un error en el sistema");
                },
                success: function (data) {
                    $("#res-form-add-categori").html(data);
                    $('#crearCategoria').modal('hide'); // cerrar
                }
            });
            return false;
        });
    });
</script>