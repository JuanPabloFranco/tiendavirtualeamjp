<?php
include '../Conexion/consulSQL.php';
?>
<div class="modal-dialog modal-lm">
    <div class="modal-content center-all-contens" id="change_estado_bodega">
        <div class="modal-header headerModal" >
            <h4 class="modal-title" id="myModalLabel">Cambiar estado de productos en bodega</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body center-all-contens text-center" style="width: 95%">
            <form action="DAO/bodegaDAO.php" method="post" role="form">
                <div class="form-group">
                    <label>Producto</label>
                    <select class="form-control" style="width: 100%" name="idBodega" id="productosBodega2">
                        <?php
                        $sqlProdBod2 = ejecutarSQL::consultar("SELECT P.nombre_prod,B.id_producto,B.cantidad,B.id FROM producto P JOIN bodega B ON B.id_producto=P.id ORDER BY P.id");
                        while ($prodBod2 = mysqli_fetch_array($sqlProdBod2)) {
                            echo '<option value="' . $prodBod2['id'] . '">' . $prodBod2['nombre_prod'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Cantidad a agregar</label>
                    <input class="form-control" type="number" id="txtCantidadProductoBodegaChange" min="1" name="cantidad" placeholder="Cantidad en bodega" required="">
                </div>
                <p class="text-center"><button type="submit" class="btn btn-danger">Agregar cantidad a bodega</button></p>
                <br>
                <input type="text" name="funcion" style="display: none" value="changeCantidadBodega">
                <div id="res-form-up-bodega" style="width: 100%; text-align: center; margin: 0;"></div>
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
        $('#productosBodega2').select2({
            dropdownParent: $('#cambiarEstadoBodega')
        });
        // cambiar datos del producto en bodega
        //Metodo ajax que realiza la consulta de la clase DAO y la imprime en el div seleccionado
        //al hacer submit al formulario que se encuentra dentro del div  llamado change_estado_bodega
        $('#change_estado_bodega form').submit(function (e) {
            e.preventDefault();
            var informacion = $('#change_estado_bodega form').serialize();
            var metodo = $('#change_estado_bodega form').attr('method');
            var peticion = $('#change_estado_bodega form').attr('action');
            $.ajax({
                type: metodo,
                url: peticion,
                data: informacion,
                beforeSend: function () {
                    $("#res-form-up-bodega").html(
                            'Actualizando<br><img src="Recursos/img/enviando.gif" class="center-all-contens">'
                            );
                },
                error: function () {
                    $("#res-form-up-bodega").html("Ha ocurrido un error en el sistema");
                },
                success: function (data) {
                    $("#res-form-up-bodega").html(data);
                    $('#cambiarEstadoBodega').modal('hide'); // cerrar
                }
            });
            return false;
        });
    });
</script>