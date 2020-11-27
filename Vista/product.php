<!DOCTYPE html><html lang="es">    <head>        <title>Buscar Productos</title>      </head>    <body id="container-page-product">        <section id="store">            <br>            <div class="container">                <div class="page-header" id="buscar_prod" >                    <form class="form-horizontal" method="post" action="DAO/productoDAO.php">                        <div class="col-lg-12" style="display: flex">                            <select class="form-control" id="SelCategoria" name="valor" style="width: 30%">                                <option value="">Elija una categoria</option>                                <?php                                $categoriac2 = ejecutarSQL::consultar("SELECT id, nombre FROM categoria");                                while ($catec2 = mysqli_fetch_array($categoriac2)) {                                    if ($catec2['id'] == $Producto[5]) {                                        echo '<option selected="selected" value="' . $catec2['id'] . '">' . $catec2['nombre'] . '</option>';                                    } else {                                        echo '<option value="' . $catec2['id'] . '">' . $catec2['nombre'] . '</option>';                                    }                                }                                ?>                            </select>                            <button class="btn btn-sm btn-success" type="submit" name="submit" accesskey="13">Aceptar</button>                            <input type="text" name="funcion" style="display: none" value="buscarProductoCategoria">                        </div>                    </form>                </div>            </div>            <!--Div para imprimir el resultado-->            <div id="searchCarrito" style="width: 100%; text-align: center; margin: 0;">                <div class="container">                    <div class="row" >                                                <?php                        if (empty($_POST['valor'])) {                            $prod_x_pag = 20;                            $iniciar = ($_GET['pagina'] - 1) * $prod_x_pag;                            // Consulta para traer los ultimos 8 productos registrados en bodega                            $sqlPagina = "SELECT producto.id, nombre_prod, marca, precio_venta, estado_prod, imagen, cantidad, estado_prod_bodega FROM producto JOIN bodega ON bodega.id_producto=producto.id WHERE (estado_prod_bodega='Disponible' OR estado_prod_bodega='Agotado') AND (estado_prod='Disponible') ORDER BY bodega.id asc LIMIT " . $iniciar . "," . $prod_x_pag;                                                        $consulta = ejecutarSQL::consultar($sqlPagina);                            $totalproductos = mysqli_num_rows($consulta);                            mysqli_close($consulta);                            if ($totalproductos > 0) {                                $nums = 0;                                while ($fila = mysqli_fetch_array($consulta)) {                                    $nums++;                                    ?>                                    <div class="col-xs-12 col-sm-6 col-md-3" id="divCarrito"><br>                                        <form method="post" action="DAO/carritoDAO.php" id="res-reg-carrito-<?php echo $nums; ?>">                                            <input type="hidden" name="id" value="<?php echo $fila['id']; ?>">                                            <input type="hidden" name="funcion" value="agregarCarrito">                                            <div class="thumbnail" style="width: 90%">                                                <!--se inserta la imagen del producto-->                                                <a onclick="modal_ver_producto(<?php echo $fila['id']; ?>)" ><img style="max-height: 160px" src="Recursos/img-products/<?php echo $fila['imagen'] ?>" data-toggle="popover" data-trigger="hover" data-content="<?php echo $fila['descripcion_prod'] ?>"></a>                                                                                    <div class="caption">                                                    <!--se inserta la información del producto-->                                                                                    <h3  class="text-center"><?php echo $fila['nombre_prod'] ?></h3>                                                    <p  class="text-center"><?php echo $fila['marca'] ?></p>                                                    <p  class="text-center">$<?php echo $fila['precio_venta'] ?></p>                                                    <p class="abs-center">                                                        <a onclick="modal_ver_producto(<?php echo $fila['id']; ?>)" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp; Detalles</a>&nbsp;&nbsp;                                                    </p>                                                    <p class="abs-center">                                                                                   <?php                                                        // El boton de agregar al carrito solo aparece si el usuario es un cliente o no se ha logueado                                                        if (isset($_SESSION['nombreUser']) || empty($_SESSION['nombreAdmin'])) {                                                            // Se verifica el estado del producto para mostrar el boton                                                            if ($fila['estado_prod_bodega'] <> 'Agotado') {                                                                ?>                                                                <input type="number" value="1" min="1" max="<?php echo $fila['cantidad'] ?>" name="cantidad" style="width: 30%" onchange="cantidadCarrito(this.value);" class="form-control all-elements-tooltip">                                                                <button type="submit" class="btn btn-sm btn-success button-carrito" value="res-reg-carrito-<?php echo $nums; ?>"><i class="fa fa-shopping-cart"></i>&nbsp; Añadir</button>                                                                <?php                                                            }                                                        }                                                        ?>                                                    </p>                                                </div>                                            </div>                                        </form>                                    </div>                                    <?php                                    if ($nums % 4 == 0) {                                        echo '<div class="clearfix"></div>';                                    }                                }                            } else {                                echo '<h2>No hay productos registrados en la tienda</h2>';                            }                            ?>                            <div class="container">                                <nav aria-label="Page Navigation example">                                    <ul class="pagination nav2">                                        <li class="page-item <?php echo $_GET['pagina'] <= 1 ? 'disabled' : '' ?>">                                            <a class="page_link" href="index.php?page=product&&pagina=<?php echo $_GET['pagina'] - 1 ?>">Anterior</a>                                        </li>                                        <?php                                        $sqlBod = "SELECT COUNT(bodega.id) FROM producto JOIN bodega ON bodega.id_producto=producto.id WHERE (estado_prod_bodega='Disponible' OR estado_prod_bodega='Agotado') AND (estado_prod='Disponible')";                                        $prod_bodega = mysqli_fetch_row(ejecutarSQL::consultar($sqlBod));                                        $paginas = ceil($prod_bodega[0] / $prod_x_pag);                                        for ($i = 0; $i < $paginas; $i++) {                                            ?>                                                           <li class="page-item <?php echo $_GET['pagina'] == $i + 1 ? 'active' : '' ?>" >                                                <a class="page_link" href="index.php?page=product&&pagina=<?php echo $i + 1; ?>"><?php echo $i + 1; ?></a>                                            </li>                                            <?php                                        }                                        ?>                                        <li class="page-item <?php echo $_GET['pagina'] >= $paginas ? 'disabled' : '' ?>">                                            <a class="page_link" href="index.php?page=product&&pagina=<?php echo $_GET['pagina'] + 1 ?>">Siguiente</a>                                        </li>                                    </ul>                                </nav>                            </div>                            <?php                        }                        ?>                                              </div>                </div>            </div>        </section>        <div class="modal fade" id="verProducto" tabindex="-2" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="padding: 20px;"></div>        <script type="text/javascript">            $(document).ready(function () {                //Metodo ajax que realiza la consulta de la clase DAO y la imprime en el div seleccionado                //al hacer submit al formulario que se encuentra dentro del div llamado buscar_prod                $('#buscar_prod form').submit(function (e) {                    e.preventDefault();                    var informacion = $('#buscar_prod form').serialize();                    var metodo = $('#buscar_prod form').attr('method');                    var peticion = $('#buscar_prod form').attr('action');                    $.ajax({                        type: metodo,                        url: peticion,                        data: informacion,                        beforeSend: function () {                            $("#searchCarrito").html('Buscando productos <br><img src="Recursos/img/enviando.gif" class="center-all-contens">');                        },                        error: function () {                            $("#searchCarrito").html("Ha ocurrido un error en el sistema");                        },                        success: function (data) {                            $("#searchCarrito").html(data);                        }                    });                    return false;                });                $("[type='number']").keypress(function (evt) {                    evt.preventDefault();                });            });            // Metodo para lanzar los detalles del producto en una ventana modal en el div verPrducto            function modal_ver_producto(id) {                $('#verProducto').load("Vista/verProducto.php?id=" + id);                $("#verProducto").modal("toggle");            }        </script>    </body></html>