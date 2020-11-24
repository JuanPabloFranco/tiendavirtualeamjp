<!DOCTYPE html>
<html lang="es"> 
    <title>Tienda EAM</title>
    <style>
        /* Make the image fully responsive */
        .carousel-inner img {
            margin-left: 20%;
            margin-right: 20%;
            width: 60%;
        }
    </style>
    <body id="container-page-registration">        
        <div class="jumbotron" id="jumbotron-index">
            <h1><span class="tittles-pages-logo"><?php echo EMPRESA; ?></span> <small style="color: white;"><?php echo NEMPRESA ?></small></h1>
        </div>       
        <section id="new-prod-index">
            <div class="container">
                <div class="page-header">
                    <h1>Nuevos productos<small></small></h1>
                </div>                
                <div class="row" >
                    <?php
                    // Consulta para traer los ultimos 8 productos registrados en bodega
                    $consulta = ejecutarSQL::consultar("SELECT producto.id, nombre_prod, marca, precio_venta, estado_prod, imagen, cantidad, estado_prod_bodega FROM producto JOIN bodega ON bodega.id_producto=producto.id WHERE (estado_prod_bodega='Disponible' OR estado_prod_bodega='Agotado') AND (estado_prod='Disponible') ORDER BY bodega.id asc limit 8");
                    $consulta = ejecutarSQL::consultar("SELECT producto.id, nombre_prod, marca, precio_venta, estado_prod, imagen, cantidad, estado_prod_bodega FROM producto JOIN bodega ON bodega.id_producto=producto.id WHERE (estado_prod_bodega='Disponible' OR estado_prod_bodega='Agotado') AND (estado_prod='Disponible') ORDER BY bodega.id asc limit 8");
                    $totalproductos = mysqli_num_rows($consulta);
                    mysqli_close($consulta);
                    if ($totalproductos > 0) {
                        $nums = 1;
                        while ($fila = mysqli_fetch_array($consulta)) {
                            ?>
                            <div class="col-xs-12 col-sm-6 col-md-3" id="divCarrito">
                                <form method="post" action="DAO/carritoDAO.php" id="res-reg-carrito-<?php echo $nums; ?>">
                                    <input type="hidden" name="id" value="<?php echo $fila['id']; ?>">
                                    <input type="hidden" name="funcion" value="agregarCarrito">
                                    <div class="thumbnail" style="width: 90%">
                                        <!--se inserta la imagen del producto-->
                                        <a onclick="modal_ver_producto(<?php echo $fila['id']; ?>)" ><img style="max-height: 160px" src="Recursos/img-products/<?php echo $fila['imagen'] ?>" data-toggle="popover" data-trigger="hover" data-content="<?php echo $fila['descripcion_prod'] ?>"></a>                                    
                                        <div class="caption">
                                            <!--se inserta la información del producto-->                                
                                            <h3  class="text-center"><?php echo $fila['nombre_prod'] ?></h3>
                                            <p  class="text-center"><?php echo $fila['marca'] ?></p>
                                            <p  class="text-center">$<?php echo $fila['precio_venta'] ?></p>
                                            <p class="abs-center">
                                                <a onclick="modal_ver_producto(<?php echo $fila['id']; ?>)" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp; Detalles</a>&nbsp;&nbsp;
                                            </p>
                                            <p class="abs-center">                           
                                                <?php
                                                // El boton de agregar al carrito solo aparece si el usuario es un cliente o no se ha logueado
                                                if (isset($_SESSION['nombreUser']) || empty($_SESSION['nombreAdmin'])) {
                                                    // Se verifica el estado del producto para mostrar el boton
                                                    if ($fila['estado_prod_bodega'] <> 'Agotado') {
                                                        ?>
                                                        <input type="number" value="1" min="1" max="<?php echo $fila['cantidad'] ?>" name="cantidad" style="width: 30%" onchange="cantidadCarrito(this.value);" class="form-control all-elements-tooltip">
                                                        <button type="submit" class="btn btn-sm btn-success button-carrito" value="res-reg-carrito-<?php echo $nums; ?>"><i class="fa fa-shopping-cart"></i>&nbsp; Añadir</button>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </p>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <?php
                            if ($nums % 4 == 0) {
                                echo '<div class="clearfix"></div>';
                            }
                            $nums++;
                        }
                    } else {
                        echo '<h2>No hay productos registrados en la tienda</h2>';
                    }
                    ?>  
                </div>
            </div>
        </section>
        <?php
        if (!isset($_SESSION['nombreUsuario'])) {
            ?>
            <section id="distribuidores-index">
                <div class="container">
                    <div class="col-xs-12 col-sm-6 text-center">
                        <article style="margin-top:5%;">
                            <p><i class="fa fa-users fa-4x"></i></p>
                            <h3>Registrate</h3>
                            <p>Hágase cliente de <span class="tittles-pages-logo"><?php echo EMPRESA . " " . NEMPRESA ?></span> para hacer efectivo tus pedidos en nuestra tienda virtual.</p>
                            <p><a href="index.php?page=registration" class="btn btn-info btn-block">Registrarse</a></p> 
                        </article>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <article style="margin-top:5%;">
                            <img src="Recursos/img/logo_eam.png" style="width: 65%; margin-left:18%;"  class="img-responsive">
                        </article>
                    </div>
                </div>
            </section>
            <?php
        }
        ?>
        <div class="modal fade" id="verProducto" tabindex="-2" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="padding: 20px;"></div>
    </body>    
    <script>
        // Metodo para lanzar los detalles del producto en una ventana modal en el div verPrducto
        function modal_ver_producto(id) {
            $('#verProducto').load("Vista/verProducto.php?id=" + id);
            $("#verProducto").modal("toggle");
        }
        $(document).ready(function () {
            $("[type='number']").keypress(function (evt) {
                evt.preventDefault();
            });
        });
    </script>
</html>