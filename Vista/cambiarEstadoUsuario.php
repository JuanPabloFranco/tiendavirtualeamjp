<?php
include '../Conexion/consulSQL.php';
?>
<div class="modal-dialog modal-lm">
    <div class="modal-content center-all-contens" id="change_estado_usuario">
        <div class="modal-header headerModal" >
            <h4 class="modal-title" id="myModalLabel">Cambiar estado de usuarios</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body center-all-contens text-center" style="width: 95%">
            <form action="DAO/usuarioDAO.php" method="post" role="form">
                <div class="form-group">
                    <label>Administradores</label>
                    <select class="form-control" name="id">
                        <?php
                        $adminCon = ejecutarSQL::consultar("SELECT * FROM usuarios WHERE id<>1");
                        while ($AdminD = mysqli_fetch_array($adminCon)) {
                            echo '<option value="' . $AdminD['id'] . '">' . $AdminD['Nombre'] . " / " . $AdminD['nombre_completo'] . " - " . $AdminD['estado'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <p class="text-center"><button type="submit" class="btn btn-danger">Cambiar Estado Usuario</button></p>
                <br>
                <input type="text" name="funcion" style="display: none" value="changeUsuario">
                <div id="res-form-del-admin" style="width: 100%;
                     text-align: center;
                     margin: 0;
                     "></div>
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
        // cambiar datos del usuario
        //Metodo ajax que realiza la consulta de la clase DAO y la imprime en el div seleccionado
        //al hacer submit al formulario que se encuentra dentro del div  llamado res-form-change-prod
        $('#change_estado_usuario form').submit(function (e) {
            e.preventDefault();
            var informacion = $('#change_estado_usuario form').serialize();
            var metodo = $('#change_estado_usuario form').attr('method');
            var peticion = $('#change_estado_usuario form').attr('action');
            $.ajax({
                type: metodo,
                url: peticion,
                data: informacion,
                beforeSend: function () {
                    $("#res-form-del-admin").html(
                            'Actualizando<br><img src="Recursos/img/enviando.gif" class="center-all-contens">'
                            );
                },
                error: function () {
                    $("#res-form-del-admin").html("Ha ocurrido un error en el sistema");
                },
                success: function (data) {
                    $("#res-form-del-admin").html(data);
                    $('#cambiarEstadoUsuario').modal('hide'); // cerrar
                }
            });
            return false;
        });
    });
</script>