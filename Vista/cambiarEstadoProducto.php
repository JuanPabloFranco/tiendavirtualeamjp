<?php
include '../Conexion/consulSQL.php';
?>
<div class="modal-dialog modal-lm">
    <div class="modal-content center-all-contens" id="change_estado_producto">
        <div class="modal-header headerModal" >
            <h4 class="modal-title" id="myModalLabel">Cambiar estado de productos</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body center-all-contens text-center" style="width: 95%">
            <form action="DAO/productoDAO.php" method="post" role="form">
                <div class="form-group">
                    <label>Productos</label>
                    <select class="form-control" name="id" style="width: 100%" id="cambiarEstadoProducto">
                        <?php
                        $productoCh = ejecutarSQL::consultar("SELECT producto.id, marca, nombre_prod, estado_prod FROM producto ORDER BY id DESC LIMIT 100");
                        if ($productoCh) {
                            while ($prodc = mysqli_fetch_array($productoCh)) {
                                echo '<option value="' . $prodc['id'] . '">' . $prodc['marca'] . '-' . $prodc['nombre_prod'] . ' / ' . $prodc['estado_prod'] . '</option>';
                            }
                        } else {
                            echo '<option value="0">No existen productos creados</option>';
                        }
                        ?>
                    </select>
                </div>
                <p class="text-center"><button type="submit" class="btn btn-primary">Cambiar Estado</button></p>
                <br>
                <input type="text" name="funcion" style="display: none" value="changeProducto">
                <div id="res-form-change-prod" style="width: 100%; text-align: center; margin: 0;"></div>
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
        $('#cambiarEstadoProducto').select2({
            dropdownParent: $('#cambiarEstadoProdAd')
        });
        // cambiar datos del producto
        //Metodo ajax que realiza la consulta de la clase DAO y la imprime en el div seleccionado
        //al hacer submit al formulario que se encuentra dentro del div  llamado res-form-change-prod
        $('#change_estado_producto form').submit(function (e) {
            e.preventDefault();
            var informacion = $('#change_estado_producto form').serialize();
            var metodo = $('#change_estado_producto form').attr('method');
            var peticion = $('#change_estado_producto form').attr('action');
            $.ajax({
                type: metodo,
                url: peticion,
                data: informacion,
                beforeSend: function () {
                    $("#res-form-change-prod").html(
                            'Actualizando<br><img src="Recursos/img/enviando.gif" class="center-all-contens">'
                            );
                },
                error: function () {
                    $("#res-form-change-prod").html("Ha ocurrido un error en el sistema");
                },
                success: function (data) {
                    $("#res-form-change-prod").html(data);
//                    $('#cambiarEstado').modal('hide'); // cerrar
                }
            });
            return false;
        });
    });
</script>