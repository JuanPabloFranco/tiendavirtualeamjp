<?php
include '../../Conexion/consulSQL.php';
include '../plantillas/datos.php';
?>
<div class="panel panel-info">
    <div class="panel-heading text-center"><h3>ACTUALIZAR PRODUCTOS</h3><input class="form-control" id="myInput" type="text" placeholder="Buscar un valor en la tabla"></div>
    <div class="table-responsive">
        <table class="table table-bordered" id="tabla">
            <thead class="">
                <tr>
                    <th class="text-center" style="width: 60px">Imagen</th>
                    <th class="text-center">Código</th>
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Categoría</th>
                    <th class="text-center">Precio</th>
                    <th class="text-center">Marca</th>
                    <th class="text-center">Proveedor</th>
                    <th class="text-center">Descripción</th>
                    <th class="text-center">Actualizar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $productos = ejecutarSQL::consultar("select * from producto ORDER BY id_proveedor LIMIT 100");
                $upr = 1;
                while ($prod = mysqli_fetch_array($productos)) {
                    ?>                
                    <tr>
                        <td><img src="Recursos/img-products/' . $prod['imagen'] . '" style="max-width: 80px; text-align: center" ></td>
                        <td>                                
                            <label style="display: none;">' . $prod['codigo_prod'] . '</label>
                            <label style="display: none;">' . $prod['nombre_prod'] . '</label>
                            <input class="form-control" type="hidden" name="id" required="" value="' . $prod['id'] . '">
                            <input class="form-control" type="text" name="codigo_prod" maxlength="40" required="" value="' . $prod['codigo_prod'] . '">
                        </td>
                        <td><input class="form-control" type="text" name="nombre_prod" maxlength="40" required="" value="' . $prod['nombre_prod'] . '"></td>
                        <td>
                            <select class="form-control" name="id_categoria">
                                <option value="Sin Categoria">Elija una opción</option>
                                <?php
                                $categoriac2 = ejecutarSQL::consultar("SELECT * FROM categoria");
                                while ($catec2 = mysqli_fetch_array($categoriac2)) {
                                    if ($catec2['id'] <> $prod['id_categoria']) {
                                        echo '<option value="' . $catec2['id'] . '">' . $catec2['nombre'] . '</option>';
                                    } else {
                                        echo '<option  selected="selected" value="' . $catec2['id'] . '">' . $catec2['nombre'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </td>
                        <td><input class="form-control" type="text-area" name="precio" required="" value="' . $prod['precio'] . '"></td>
                        <td><input class="form-control" type="text-area" name="marca" maxlength="30" required="" value="' . $prod['marca'] . '"></td>
                        <td>
                            <select class="form-control" name="id_proveedor">
                                <option value="0">Elija una opción</option>
                                <?php
                                $proveedoresc2 = ejecutarSQL::consultar("SELECT id, nombre_proveedor FROM proveedor");
                                while ($provc2 = mysqli_fetch_array($proveedoresc2)) {

                                    if ($provc2['id'] <> $prod['id_proveedor']) {
                                        echo '<option value="' . $provc2['id'] . '">' . $provc2['nombre_proveedor'] . '</option>';
                                    } else {
                                        echo '<option selected="selected" value="' . $provc2['id'] . '">' . $provc2['nombre_proveedor'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </td>
                        <td><input class="form-control" type="text" name="descripcion_prod" value="' . $prod['descripcion_prod'] . '"></td>
                        <td class="text-center">
                            <button type="submit" class="btn btn-sm btn-primary button-UPR" value="update-product-' . $upr . '">Actualizar</button>                                                    
                            <div id="update-product-' . $upr . '" style="width: 100%; margin:0px; padding:0px;"></div>
                            <input type="text" name="funcion" style="display: none" value="actualizarProducto">
                        </td>
                    </tr>
                    <?php
                    $upr = $upr + 1;
                }
                ?>
            </tbody >
        </table>
    </div>
    <script>
        $(document).ready(function () {
            $("#myInputProd").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $("#tablaProd tr").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
</div>