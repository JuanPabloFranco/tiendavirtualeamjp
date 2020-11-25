<?php
include '../Conexion/consulSQL.php';
?>
<div class="modal-dialog modal-lm">
    <div class="modal-content center-all-contens" id="change_estado_domiciliario">
        <div class="modal-header headerModal" >
            <h4 class="modal-title" id="myModalLabel">Cambiar estado de domiciliario</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body center-all-contens text-center" style="width: 95%">
            <form action="DAO/domiciliarioDAO.php" method="post" role="form">
                <div class="form-group">
                    <label>Domiciliarios</label>
                    <select class="form-control" name="id" style="width: 100%" id="cambiarEstadoRepartidor">
                        <?php
                        $repCon = ejecutarSQL::consultar("SELECT * FROM domiciliario");
                        while ($repIna = mysqli_fetch_array($repCon)) {
                            echo '<option value="' . $repIna['id'] . '">' . $repIna['nombre_repartidor'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <p class="text-center"><button type="submit" class="btn btn-danger">Cambiar Estado</button></p>
                <br>
                <input type="text" name="funcion" style="display: none" value="changeDomiciliario">
                <div id="res-form-change-rep" style="width: 100%; text-align: center; margin: 0;"></div>
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
        // cambiar datos del domiciliario
        //Metodo ajax que realiza la consulta de la clase DAO y la imprime en el div seleccionado
        //al hacer submit al formulario que se encuentra dentro del div  llamado res-form-change-prod
        $('#change_estado_domiciliario form').submit(function (e) {
            e.preventDefault();
            var informacion = $('#change_estado_domiciliario form').serialize();
            var metodo = $('#change_estado_domiciliario form').attr('method');
            var peticion = $('#change_estado_domiciliario form').attr('action');
            $.ajax({
                type: metodo,
                url: peticion,
                data: informacion,
                beforeSend: function () {
                    $("#res-form-change-rep").html(
                            'Actualizando<br><img src="Recursos/img/enviando.gif" class="center-all-contens">'
                            );
                },
                error: function () {
                    $("#res-form-change-rep").html("Ha ocurrido un error en el sistema");
                },
                success: function (data) {
                    $("#res-form-change-rep").html(data);
                    $('#cambiarEstadoDom').modal('hide'); // cerrar
                }
            });
            return false;
        });
    });
</script>