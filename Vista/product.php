<?phpinclude './library/consulSQL.php';?><!DOCTYPE html><html lang="es">    <head>        <title>Productos</title>        <?php include './inc/link.php'; ?>    </head>    <body id="container-page-product">        <section id="store">            <br>            <div class="container">                <div class="page-header">                    <h1>Productos en <?php echo EMPRESA. " " . NEMPRESA?></h1>                </div>                <div class="row">                    <div class="col-xs-12">                        <ul id="store-links" class="nav nav-tabs" role="tablist">                            <li role="presentation"><a href="#all-product" role="tab" data-toggle="tab" aria-controls="all-product" aria-expanded="false">Todos los productos</a></li>                            <li role="presentation" class="dropdown active">                                <a href="#" id="myTabDrop1" class="dropdown-toggle" data-toggle="dropdown" aria-controls="myTabDrop1-contents" aria-expanded="false">Categorías <span class="caret"></span></a>                                <ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop1" id="myTabDrop1-contents">                                    <!-- ==================== Lista categorias =============== -->                                    <?php                                    $categorias = ejecutarSQL::consultar("select * from categoria");                                    while ($cate = mysqli_fetch_array($categorias)) {                                        echo '                                    <li>                                        <a href="#' . $cate['id'] . '" tabindex="-1" role="tab" id="' . $cate['id'] . '-tab" data-toggle="tab" aria-controls="' . $cate['id'] . '" aria-expanded="false">' . $cate['nombre'] . '                                        </a>                                    </li>';                                    }                                    ?>                                    <!-- ==================== Fin lista categorias =============== -->                                </ul>                            </li>                        </ul>                        <div id="myTabContent" class="tab-content">                            <div role="tabpanel" class="tab-pane fade" id="all-product" aria-labelledby="all-product-tab">                                <br><br>                                <div class="row">                                    <?php                                    $consulta = ejecutarSQL::consultar("SELECT producto.id, nombre_prod, marca, precio_venta, estado_prod, imagen FROM producto, bodega WHERE bodega.id_producto=producto.id AND estado_prod='Disponible' OR estado_prod='Agotado' ORDER BY id_categoria");                                    $totalproductos = mysqli_num_rows($consulta);                                    if ($totalproductos > 0) {                                        $nums = 1;                                        while ($fila = mysqli_fetch_array($consulta)) {                                            ?>                                            <div class="col-xs-12 col-sm-6 col-md-3">                                                <div class="thumbnail" style="width: 90%">                                                    <a onclick="modal_ver_producto(<?php echo $fila['id'];?>)"><img style="max-width: 70%" src="Recursos/img-products/<?php echo $fila['imagen'] ?>"></a>                                                    <div class="caption">                                                        <h3><?php echo $fila['nombre_prod'] ?></h3>                                                        <p><?php echo $fila['marca'] ?></p>                                                        <p>$<?php echo $fila['precio'] ?></p>                                                                                                                <p class="text-center">                                                            <a onclick="modal_ver_producto(<?php echo $fila['id'];?>)" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp; Detalles</a>&nbsp;&nbsp;                                                            <?php                                                            if (isset($_SESSION['nombreUser']) || empty($_SESSION['nombreAdmin'])) {                                                                if ($fila['estado_prod'] <> 'Agotado') {                                                                    ?>                                                                    <button value="<?php echo $fila['id'] ?>" class="btn btn-success btn-sm botonCarrito"><i class="fa fa-shopping-cart"></i>&nbsp; Añadir</button>                                                                    <?php                                                                }                                                            }                                                            ?>                                                        </p>                                                    </div>                                                </div>                                            </div>                                            <?php                                            if ($nums % 4 == 0) {                                                echo '<div class="clearfix"></div>';                                            }                                            $nums++;                                        }                                    } else {                                        echo '<h2>No hay productos en esta categoria</h2>';                                    }                                    ?>                                </div>                            </div><!-- Fin del contenedor de todos los productos -->                            <!-- ==================== Contenedores de categorias =============== -->                            <?php                            $consultar_categorias = ejecutarSQL::consultar("SELECT * FROM categoria");                            $nums = 1;                            while ($categ = mysqli_fetch_array($consultar_categorias)) {                                echo '<div role="tabpanel" class="tab-pane fade active in" id="' . $categ['id'] . '" aria-labelledby="' . $categ['id'] . '-tab"><br>';                                $consultar_productos = ejecutarSQL::consultar("SELECT producto.id, nombre_prod, marca, precio_venta, estado_prod, imagen FROM producto, bodega WHERE bodega.id_producto=producto.id AND id_categoria='" . $categ['codigo_categoria'] . "' AND (estado_prod='Disponible' OR estado_prod='Agotado') ");                                if ($consultar_productos > 0) {                                    $nums = 1;                                    while ($fila = mysqli_fetch_array($consultar_productos)) {                                        ?>                                        <div class="col-xs-12 col-sm-6 col-md-3">                                            <div class="thumbnail" style="width: 90%">                                                <a onclick="modal_ver_producto(<?php echo $fila['id'];?>)"><img style="max-width: 70%" src="Recursos/img-products/<?php echo $fila['imagen'] ?>"></a>                                                <div class="caption">                                                    <h3><?php echo $fila['nombre_prod'] ?></h3>                                                    <p><?php echo $fila['marca'] ?></p>                                                    <p>$<?php echo $fila['precio'] ?></p>                                                                                                        <p class="text-center">                                                        <a onclick="modal_ver_producto(<?php echo $fila['id'];?>)" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp; Detalles</a>&nbsp;&nbsp;                                                        <?php                                                        if (isset($_SESSION['nombreUser']) || empty($_SESSION['nombreAdmin'])) {                                                            if ($fila['estado_prod'] <> 'Agotado') {                                                                ?>                                                                <button value="<?php echo $fila['id'] ?>" class="btn btn-success btn-sm botonCarrito"><i class="fa fa-shopping-cart"></i>&nbsp; Añadir</button>                                                                <?php                                                            }                                                        }                                                        ?>                                                    </p>                                                </div>                                            </div>                                        </div>                                        <?php                                        if ($nums % 4 == 0) {                                            echo '<div class="clearfix"></div>';                                        }                                        $nums++;                                    }                                } else {                                    echo '<h2>No hay productos en esta categoría</h2>';                                }                                echo '</div>';                            }                            ?>                            <!-- ==================== Fin contenedores de categorias =============== -->                        </div>                    </div>                </div>            </div>        </section>        <div class="modal fade" id="verProducto" tabindex="-2" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="padding: 20px;"></div>        <?php include './inc/footer.php'; ?>        <script>            $(document).ready(function () {                $('#store-links a:first').tab('show');            });            $(document).ready(function () {                $("#myInput").on("keyup", function () {                    var value = $(this).val().toLowerCase();                    $("#tabla tr").filter(function () {                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)                    });                });            });            function modal_ver_producto(id) {                $('#verProducto').load("Vista/verProducto.php?id=" + id);                $("#verProducto").modal("toggle");            }        </script>    </body></html>