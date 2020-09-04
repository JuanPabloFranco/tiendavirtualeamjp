<?php
include '../library/consulSQL.php';
?>
<div class="modal-dialog modal-mg" >
    <div class="modal-content center-all-contens" id="divAgregarProd" style="margin: 30px">
        <h2 class="text-center modal-title">AGREGAR PRODUCTO</h2>
        <form action="process/agregar_producto_pedido.php" method="post" role="form" >
            <div class="form-group">
                <label>Buscar Producto</label>
                <select class="form-control" name="id_producto" id="buscaProducto" style="width: 100%">
                    <?php
                    $productoAg = ejecutarSQL::consultar("SELECT * FROM producto WHERE estado_prod<>'Agotado' AND estado_prod<>'No Disponible'");
                    while ($prodG = mysqli_fetch_array($productoAg)) {
                        echo '<option value="' . $prodG['id'] . '">' . $prodG['marca'] . '-' . $prodG['nombre_prod'] . ' / $' . $prodG['precio'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label>Cantidad</label>
                <input type="number" class="form-control"  placeholder="Cantidad" required min="1" name="cantidad" value="1">
                <input type="hidden" class="form-control" name="id_venta" value="<?php echo $_GET['id'] ?>">
            </div>
            <p class="text-center"><button type="submit" class="btn btn-primary">Agregar Producto</button></p>
            <br>
            <div id="res-ag-prod" style="width: 100%; text-align: center; margin: 0;"></div>
        </form>
        <p class = "text-center">
            <a href="eliminar_producto?id=<?php echo $_GET['id']; ?>"><button type = "button" class = "btn btn-danger btn-sm" data-dismiss = "modal">Cerrar</button></a>
        </p>
    </div>
    <script>
        $(document).ready(function () {
            $('#buscaProducto').select2();
        });
    </script>
</div>
