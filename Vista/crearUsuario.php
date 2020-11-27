<?php
include '../Conexion/consulSQL.php';
?>
<div class="modal-dialog modal-lm">
    <div class="modal-content center-all-contens" id="crear_usuario">
        <div class="modal-header headerModal">
            <h4 class="modal-title" id="myModalLabel">Crear Usuario</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body center-all-contens text-center" style="width: 95%" >
            <form action="DAO/usuarioDAO.php" method="post" role="form">
                <div class="form-group">
                    <label>Nombre Completo</label>
                    <input class="form-control" type="text" id="txtNombreCUsuario" pattern="[A-Za-z ]{8,60}" name="nombre_completo" placeholder="Nombre Completo (Máx 60)" maxlength="60" required="" title="Minimo 8, Max 60 carácteres (Sin números)">
                </div>
                <div class="form-group">
                    <label>Nombre Usuario</label>
                    <input class="form-control" type="text" id="txtNombreUsuario" pattern="[A-Za-z0-9 ]{8,20}"  name="Nombre" placeholder="Sólo se permiten letras (mayúsculas y minúsculas) y números, Minimo 8, Max 20 carácteres" title="Sólo se permiten letras (mayúsculas y minúsculas) y números, Minimo 8, Max 20 carácteres" maxlength="20" required="">
                </div>
                <div class="form-group">
                    <label>Contraseña</label>
                    <input class="form-control" type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" id="txtPassUsuario" name="Clave" placeholder="Introduzca una contraseña que debe contener 8 o más caracteres de al menos un número y una letra mayúscula y minúscula" required="" title="Debe contener 8 o más caracteres de al menos un número y una letra mayúscula y minúscula">
                </div>
                <div class="form-group">
                    <label>Tipo Usuario</label>
                    <select class="form-control" name="tipo">
                        <option value="Administrador">Administrador</option>
                        <option value="Vendedor">Vendedor</option>
                    </select>
                </div>
                <p class="text-center"><button type="submit" class="btn btn-primary">Agregar Usuario</button></p>
                <br>
                <input type="text" name="funcion" style="display: none" value="crearUsuario">
                <div id="res-form-add-admin" style="width: 100%;text-align: center;margin: 0;"></div>
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
        $('#crear_usuario form').submit(function (e) {
            e.preventDefault();
            var informacion = $('#crear_usuario form').serialize();
            var metodo = $('#crear_usuario form').attr('method');
            var peticion = $('#crear_usuario form').attr('action');
            $.ajax({
                type: metodo,
                url: peticion,
                data: informacion,
                beforeSend: function () {
                    $("#res-form-add-admin").html(
                            'Creando<br><img src="Recursos/img/enviando.gif" class="center-all-contens">'
                            );
                },
                error: function () {
                    $("#res-form-add-admin").html("Ha ocurrido un error en el sistema");
                },
                success: function (data) {
                    $("#res-form-add-admin").html(data);
                    $('#crearProveedor').modal('hide'); // cerrar
                }
            });
            return false;
        });
    });
</script>