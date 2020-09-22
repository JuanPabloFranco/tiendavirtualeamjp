<?php
include '../../Conexion/consulSQL.php';
include '../plantillas/datos.php';
?>
<div class="panel-heading text-center">
    <h3>Productos en bodega <small class="tittles-pages-logo"><?php echo EMPRESA . " " . NEMPRESA; ?></small></h3>
</div>
<div class="table-responsive">
    <table class="table table-bordered">
        <thead class="">
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">Código Producto</th>
                <th class="text-center">Nombre Producto</th>
                <th class="text-center">Marca</th>
                <th class="text-center">Proveedor</th>
                <th class="text-center">Categoria</th>
                <th class="text-center">Cant Bodega</th>
                <th class="text-center">Cant Mínima</th>
                <th class="text-center">Precio Venta</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sqlProdBodega = ejecutarSQL::consultar("SELECT B.id_producto,P.nombre_prod,P.codigo_prod,P.marca,PRO.nombre_proveedor,C.nombre,"
                . "B.cantidad,B.minimo,B.precio_venta,B.estado_prod_bodega,B.id FROM producto P JOIN proveedor PRO ON P.id_proveedor=PRO.id
                                                                 JOIN bodega B ON B.id_producto=P.id JOIN categoria C ON P.id_categoria=C.id ORDER BY nombre");
            $cantVendedor = 0;
            $contPB = 1;
            while ($prodBodega = mysqli_fetch_array($sqlProdBodega)) {
                $color = "white";
                if ($prodBodega['estado_prod_bodega'] == "Agotado") {
                    $color = "Rgb(255,0,0,0.4)";
                }
            ?>
                <div id="update-bodega">
                    <form method="post" action="DAO/bodegaDAO.php" id="update-bodega-<?php echo $contPB; ?>">
                        <tr style="background-color: <?php echo $color ?>">
                            <td> <input class="form-control" type="hidden" name="id" required="" value="<?php echo $prodBodega['id'] ?>"> </td>
                            <td><label><?php echo $prodBodega['codigo_prod'] ?></label></td>
                            <td><label><?php echo $prodBodega['nombre_prod'] ?></label></td>
                            <td><label><?php echo $prodBodega['marca'] ?></label></td>
                            <td><label><?php echo $prodBodega['nombre_proveedor'] ?></label></td>
                            <td><label><?php echo $prodBodega['nombre'] ?></label></td>
                            <td><label><?php echo $prodBodega['cantidad'] ?></label></td>
                            <td><input class="form-control" type="number" name="minimo" required="" value="<?php echo $prodBodega['minimo'] ?>"></td>
                            <td><input class="form-control" type="number" name="precio_venta" required="" value="<?php echo $prodBodega['precio_venta'] ?>"></td>
                            <td class="text-center">
                                <button type="submit" class="btn btn-sm btn-primary button-Bodega" value="update-bodega-<?php echo $contPB ?>">Actualizar</button>
                                <div id="update-bodega-<?php echo $contPB ?>" style="width: 100%; margin:0px; padding:0px;"></div>
                            </td>
                            <td><input type="text" name="funcion" style="display: none" value="changeProductoBodega"></td>
                        </tr>
                    </form>
                    </tr>

                </div>
            <?php
                $contPB = $contPB + 1;
            }
            ?>
        </tbody>
        <script>
            $(document).ready(function () {
                $("#myInputProv").on("keyup", function () {
                    var value = $(this).val().toLowerCase();
                    $("#tablaProv tr").filter(function () {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });
            });
        </script>
    </table>
</div>