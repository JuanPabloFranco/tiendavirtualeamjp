<?php
include '../Conexion/consulSQL.php';
?>
<div class="modal-dialog modal-lm">
    <div class="modal-content center-all-contens" id="crear_bodega">
        <div class="modal-header headerModal">
            <h4 class="modal-title" id="myModalLabel">Agregar producto a bodega</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body center-all-contens text-center" style="width: 95%" >
            <form action="DAO/bodegaDAO.php" method="post" role="form">
                <div class="form-group">
                    <label>Producto</label>
                    <select class="form-control" name="id_producto" style="width: 100%" id="productosBodega">
                        <?php
                        $sqlProdBod = ejecutarSQL::consultar("SELECT P.id,P.nombre_prod,P.precio FROM producto P WHERE P.id NOT IN (SELECT B.id_producto FROM bodega B ) AND P.estado_prod='Disponible'");
                        while ($prodBod = mysqli_fetch_array($sqlProdBod)) {
                            echo '<option value="' . $prodBod['id'] . '">' . $prodBod['nombre_prod'] . " ($" . $prodBod['precio'] . ")" . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Cantidad en Bodega</label>
                    <input class="form-control" type="number" id="txtCantidadProductoBodega" min="1" name="cantidad" placeholder="Cantidad en bodega" required="">
                </div>
                <div class="form-group">
                    <label>Cantidad Mínima</label>
                    <input class="form-control" type="number" id="txtCantidadMinProductoBodega" min="1" name="minimo" placeholder="Cantidad minima en bodega" required="">
                </div>
                <div class="form-group">
                    <label>Precio Venta $</label>
                    <input class="form-control" id="txtPrecioVentaProducto" type="number" min="0" name="precio_venta" placeholder="Precio de Venta" required="">
                </div>
                <p class="text-center"><button type="submit" class="btn btn-primary">Agregar</button></p>
                <br>
                <input type="text" name="funcion" style="display: none" value="agregar_a_bodega">
                <div id="res-form-add-bodega" style="width: 100%; text-align: center; margin: 0;"></div>
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
        $('#productosBodega').select2({
            dropdownParent: $('#crearBodega')
        });
        // Agregar un producto a bodega
        //Metodo ajax que realiza la consulta de la clase DAO y la imprime en el div seleccionado
        //al hacer submit al formulario que se encuentra dentro del div  llamado crear_bodega
        $('#crear_bodega form').submit(function (e) {
            e.preventDefault();
            var informacion = $('#crear_bodega form').serialize();
            var metodo = $('#crear_bodega form').attr('method');
            var peticion = $('#crear_bodega form').attr('action');
            $.ajax({
                type: metodo,
                url: peticion,
                data: informacion,
                beforeSend: function () {
                    $("#res-form-add-bodega").html(
                            'Creando<br><img src="Recursos/img/enviando.gif" class="center-all-contens">'
                            );
                },
                error: function () {
                    $("#res-form-add-bodega").html("Ha ocurrido un error en el sistema");
                },
                success: function (data) {
                    $("#res-form-add-bodega").html(data);
                    $('#cambiarEstadoBodega').modal('hide'); // cerrar
                }
            });
            return false;
        });
    });
</script>