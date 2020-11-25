<?php
include '../Conexion/consulSQL.php';
?>
<form class="form-horizontal" method="post" name="guardar_producto" action="DAO/productoDAO.php" id="agregar_producto">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header headerModal">
                <h4 class="modal-title" id="myModalLabel">Agregar Producto</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>                                                
            </div>
            <div id="resFormProducto" style="width: 100%; text-align: center; margin: 0;"></div>
            <div class="modal-body center-all-contens">
                <div class="form-group">
                    <label>Seleccione un producto</label>
                    <select class="form-control" name="id_producto" id="selProductos" tabindex="-2" style="width: 100%">
                        <?php
                        $productos = ejecutarSQL::consultar("SELECT producto.id, nombre_prod, cantidad, codigo_prod FROM producto JOIN bodega ON bodega.id_producto=producto.id WHERE (estado_prod_bodega='Disponible' OR estado_prod_bodega='Agotado') AND (estado_prod='Disponible') ORDER BY bodega.id asc"); //
                        while ($producto = mysqli_fetch_array($productos)) {
                            echo '<option value="' . $producto['id'] . '">' . $producto['nombre_prod'] . " / " . $producto['codigo_prod'] . "  (" . $producto['cantidad'] . ")" . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label>Cantidad</label>
                        <input type="number" value="1" min="1" name="cantidad" style="width: 100%" class="form-control all-elements-tooltip">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <?php echo "valor id: " . $_GET['id'];?>
                <input type="text" name="id_cliente" value="<?php echo $_GET['id'];?>" id="txtId_cliente">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-info" >Agregar</button>
            </div>
        </div>
    </div>
</form>

<script>
    $(document).ready(function () {
        $('#selProductos').select2({
            dropdownParent: $('#modalProducto')
        });
    });
</script>