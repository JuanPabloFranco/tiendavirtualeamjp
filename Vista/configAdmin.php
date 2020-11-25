<?php
if (!$_SESSION['nombreUsuario'] == "" && $_SESSION['tipo'] == "Administrador") {
    ?>
    <html lang="es">

        <head>
            <title>Administación</title>
        </head>

        <body id="container-page-configAdmin">
            <section id="prove-product-cat-config">
                <div class="container">
                    <div class="page-header">
                        <h1>Panel de Administración <small class="tittles-pages-logo"><?php echo EMPRESA . " " . NEMPRESA ?></small></h1><a href="index.php?page=ventas"><button class="btn btn-primary">Ventas</button></a>
                    </div>
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <?php
                        if ($_SESSION['tipo'] == "Administrador") {
                            ?>
                            <li role="presentation"><a href="#Usuarios" role="tab" data-toggle="tab">Usuarios</a></li>
                            <li role="presentation"><a href="#Domiciliarios" role="tab" data-toggle="tab">Domiciliarios</a></li>
                            <li role="presentation"><a href="#Productos" role="tab" data-toggle="tab">Productos</a></li>
                            <li role="presentation"><a href="#Proveedores" role="tab" data-toggle="tab">Proveedores</a></li>
                            <li role="presentation"><a href="#Categorias" role="tab" data-toggle="tab">Categorías</a></li>
                            <li role="presentation"><a href="#Bodega" role="tab" data-toggle="tab">Bodega</a></li>
                            <li role="presentation" class="active"><a href="#General" role="tab" data-toggle="tab">Inf General</a></li>
                            <?php
                        }
                        ?>
                    </ul>
                    <div class="tab-content">
                        <!--==============================Panel productos===============================-->
                        <div role="tabpanel" class="tab-pane fade" id="Productos">
                            <div class="col-xs-12">
                                <button type="button" class="btn btn-success btn-sm crearProducto" value="<?php echo $_SESSION['id_user'] ?>" data-toggle="modal" data-target="#crearProducto"> Crear Producto</button>                                                       
                                <button type="button" class="btn btn-primary btn-sm cambiarEstadoProdAd" data-toggle="modal" data-target="#cambiarEstadoProdAd"> Cambiar Estado</button>
                            </div>
                            <div class="row">                                   
                                <div class="col-xs-12">
                                    <br>
                                    <div class="panel panel-info" id="tablaProductos"></div>
                                </div>
                                <div class="modal fade" id="crearProducto" tabindex="-2" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="padding: 20px;" data-dismiss="modal"></div>
                                <div class="modal fade" id="cambiarEstadoProdAd" tabindex="-2" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="padding: 20px;" data-dismiss="modal"></div>
                            </div>
                        </div>

                        <!--==============================Panel Proveedores===============================-->
                        <div role="tabpanel" class="tab-pane fade" id="Proveedores">
                            <div class="row">
                                <div class="col-xs-12">
                                    <button type="button" class="btn btn-success btn-sm crearProveedor" data-toggle="modal" data-target="#crearProveedor"> Crear Proveedor</button>                                                       
                                </div>
                                <div class="col-xs-12">
                                    <br>
                                    <div class="panel panel-info" id="tablaProveedores"></div>
                                    <div class="modal fade" id="crearProveedor" tabindex="-2" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="padding: 20px;" data-dismiss="modal"></div>
                                </div>
                            </div>
                        </div>
                        <!--==============================Panel Categorias===============================-->

                        <div role="tabpanel" class="tab-pane fade" id="Categorias">
                            <div class="row">
                                <div class="col-xs-12">
                                    <button type="button" class="btn btn-success btn-sm crearCategoria" data-toggle="modal" data-target="#crearCategoria"> Crear Categoria</button>
                                </div>
                                <div class="col-xs-12">
                                    <br>
                                    <div class="panel panel-info" id="tablaCategoriasFull"></div>
                                    <div class="modal fade" id="crearCategoria" tabindex="-2" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="padding: 20px;" data-dismiss="modal"></div>
                                </div>
                            </div>
                        </div>

                        <!--==============================Panel Usuario===============================-->
                        <div role="tabpanel" class="tab-pane fade" id="Usuarios">
                            <div class="row">
                                <div class="col-xs-12">
                                    <button type="button" class="btn btn-success btn-sm crearUsuario" data-toggle="modal" data-target="#crearUsuario"> Crear Usuario</button>                                    
                                    <button type="button" class="btn btn-primary btn-sm cambiarEstadoUsuario" data-toggle="modal" data-target="#cambiarEstadoUsuario"> Cambiar Estado Usuario</button>
                                </div>
                                <div class="col-xs-12">
                                    <br>
                                    <div class = "panel panel-info" id="tablaUsuarios"></div>
                                    <div class="modal fade" id="crearUsuario" tabindex="-2" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="padding: 20px;" data-dismiss="modal"></div>
                                    <div class="modal fade" id="cambiarEstadoUsuario" tabindex="-2" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="padding: 20px;" data-dismiss="modal"></div>
                                </div>
                                <div class="col-xs-12"></div>
                            </div>
                        </div>
                        <!--==============================Panel Domiciliarios===============================-->

                        <div role="tabpanel" class="tab-pane fade" id="Domiciliarios">
                            <div class="row">
                                <div class="col-xs-12">
                                    <button type="button" class="btn btn-success btn-sm crearDomicilario" data-toggle="modal" data-target="#crearDomicilario"> Crear Domiciliario</button>                                                                        
                                    <button type="button" class="btn btn-primary btn-sm cambiarEstadoDom" data-toggle="modal" data-target="#cambiarEstadoDom"> Cambiar Domiciliario</button>
                                </div>
                                <div class="col-xs-12">
                                    <br>
                                    <div class = "panel panel-info" id="tablaDomiciliario"></div>
                                    <div class="modal fade" id="crearDomicilario" tabindex="-2" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="padding: 20px;" data-dismiss="modal"></div>
                                    <div class="modal fade" id="cambiarEstadoDom" tabindex="-2" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="padding: 20px;" data-dismiss="modal"></div>
                                </div>
                            </div>
                        </div>
                        <!--==============================Panel Bodega===============================-->
                        <div role="tabpanel" class="tab-pane fade" id="Bodega">
                            <div class="row">
                                <div class="col-xs-12">
                                    <button type="button" class="btn btn-success btn-sm crearBodega" data-toggle="modal" data-target="#crearBodega"> Agregar Producto</button>                                                                        
                                    <button type="button" class="btn btn-primary btn-sm cambiarEstadoBodega" data-toggle="modal" data-target="#cambiarEstadoBodega"> Actualizar cantidad</button>
                                </div>
                                <div class="col-xs-12">
                                    <br>
                                    <div class="panel panel-info" id="tablaBodega"></div>
                                    <div class="modal fade" id="crearBodega" tabindex="-2" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="padding: 20px;" data-dismiss="modal"></div>
                                    <div class="modal fade" id="cambiarEstadoBodega" tabindex="-2" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="padding: 20px;" data-dismiss="modal"></div>
                                </div>
                                <div class="col-xs-12"></div>
                            </div>
                        </div>

                        <!--==============================General===============================-->

                        <div role="tabpanel" class="tab-pane fade  in active" id="General">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6">
                                    <br><br>
                                    <!--GENERAL-->
                                    <div class="thumbnail" style="width: 90%">
                                        <img style="max-width: 20%" src="Recursos/img/logo_eam.png">
                                        <div class="caption center-all-contens">
                                            <h3 style="text-align: center">PRODUCTOS</h3>
                                            <?php
                                            $sqlProd = mysqli_fetch_row(ejecutarSQL::consultar("SELECT count(id) FROM producto"));
                                            $sqlProdD = mysqli_fetch_row(ejecutarSQL::consultar("SELECT count(id) FROM producto WHERE estado_prod='Disponible'"));
                                            $sqlProdN = mysqli_fetch_row(ejecutarSQL::consultar("SELECT count(id) FROM bodega WHERE estado_prod_bodega='Disponible'"));
                                            $sqlProdAg = mysqli_fetch_row(ejecutarSQL::consultar("SELECT count(id) FROM bodega WHERE estado_prod_bodega='Agotado'"));
                                            ?>
                                            <p><b>Productos Registrados: </b><?php echo $sqlProd[0]; ?></p>
                                            <p><b>Productos Registrados No Disponibles: </b><?php echo $sqlProdN[0]; ?></p>
                                            <p><b>Productos En Bodega Disponibles: </b><?php echo $sqlProdN[0]; ?></p>
                                            <p><b>Productos En Bodega Agotados: </b><?php echo $sqlProdAg[0]; ?></p>
                                        </div>
                                        <div class="caption center-all-contens">
                                            <h3 style="text-align: center">PROVEEDORES</h3>
                                            <?php
                                            $sqlProv = mysqli_fetch_row(ejecutarSQL::consultar("SELECT count(id) FROM proveedor"));
                                            ?>
                                            <p><b>Cantidad Proveedores: </b><?php echo $sqlProv[0]; ?></p>
                                        </div>
                                        <div class="caption center-all-contens">
                                            <h3 style="text-align: center">CATEGORIAS</h3>
                                            <?php
                                            $sqlCatD = mysqli_fetch_row(ejecutarSQL::consultar("SELECT count(id) FROM categoria"));
                                            ?>
                                            <p><b>Cantidad Categorias: </b><?php echo $sqlCatD[0]; ?></p>
                                        </div>
                                        <div class="caption center-all-contens">
                                            <h3 style="text-align: center">VENDEDORES</h3>
                                            <?php
                                            $sqlCatnAdmin = mysqli_fetch_row(ejecutarSQL::consultar("SELECT count(id) FROM usuarios WHERE tipo='Vendedor'"));
                                            ?>
                                            <p><b>Cantidad Vendedores: </b><?php echo $sqlCatnAdmin[0]; ?></p>
                                        </div>
                                        <div class="caption center-all-contens">
                                            <h3 style="text-align: center">DOMICILIARIOS</h3>
                                            <?php
                                            $sqlCatnAdmin = mysqli_fetch_row(ejecutarSQL::consultar("SELECT count(id) FROM domiciliario"));
                                            ?>
                                            <p><b>Cantidad Domiciliarios: </b><?php echo $sqlCatnAdmin[0]; ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <br><br>
                                    <div id="add-inf_empresa">
                                        <?php
                                        $sqlInf = "SELECT nit, representante_legal, telefonos, whatsapp, direccion, pagina_web, facebook, instagram, email, cuenta_bancaria, iva FROM informacion_empresa WHERE id=1";
                                        $VecInf = mysqli_fetch_row(ejecutarSQL::consultar($sqlInf));
                                        ?>
                                        <h2 class="text-info text-center"><small><i class="fa fa-edit"></i></small>&nbsp;&nbsp;Actualizar Informacion </h2>
                                        <form action="DAO/informacion_empresa.php" method="post" role="form">
                                            <div class="form-group">
                                                <label>Nit</label>
                                                <input class="form-control" type="text" name="nit" value="<?php echo $VecInf[0]; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Representante Legal</label>
                                                <input class="form-control" type="text" name="representante_legal" value="<?php echo $VecInf[1]; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Telefonos</label>
                                                <input class="form-control" type="text" name="telefonos" value="<?php echo $VecInf[2]; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Whastapp principal</label>
                                                <input class="form-control" type="text" name="whatsapp" required="" value="<?php echo $VecInf[3]; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Direccion</label>
                                                <input class="form-control" type="text" name="direccion" required="" value="<?php echo $VecInf[4]; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input class="form-control" type="email" name="email" value="<?php echo $VecInf[8]; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Pagina Web</label>
                                                <input class="form-control" type="text" name="pagina_web" value="<?php echo $VecInf[5]; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Facebook</label>
                                                <input class="form-control" type="text" name="facebook" value="<?php echo $VecInf[6]; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Instagram</label>
                                                <input class="form-control" type="text" name="instagram" value="<?php echo $VecInf[7]; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>No. Cuenta Bancaria</label>
                                                <input class="form-control" type="text" name="cuenta_bancaria" value="<?php echo $VecInf[9]; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>IVA</label>
                                                <input class="form-control" type="number" name="iva" value="<?php echo $VecInf[10]; ?>">
                                            </div>
                                            <p class="text-center"><button type="submit" class="btn btn-primary">Actualizar</button></p>
                                            <br>
                                            <div id="res-form-update_inf" style="width: 100%; text-align: center; margin: 0;"></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </section>
            <div class="modal fade modal-actualizacion" id="verMsj" tabindex="-2" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="padding: 20px;">
                <div class="modal-dialog modal-mg">
                    <div class="modal-content center-all-contens" id="divMsj"></div>
                </div>
            </div>
            <script>
                $(document).ready(function () {
                    $('#crearProducto').load("Vista/crearProducto.php");
                    $('#cambiarEstadoProdAd').load("Vista/cambiarEstadoProducto.php");
                    $(".crearProducto").click(function () { //      
                        $('#crearProducto').load("Vista/crearProducto.php?id=" + $(this).val());
                    });
                    $('#crearProveedor').load("Vista/crearProveedor.php");
                    $('#crearCategoria').load("Vista/crearCategoria.php");
                    $('#crearUsuario').load("Vista/crearUsuario.php");
                    $('#cambiarEstadoUsuario').load("Vista/cambiarEstadoUsuario.php");
                    $('#crearDomicilario').load("Vista/crearDomiciliario.php");
                    $('#cambiarEstadoDom').load("Vista/cambiarEstadoDomiciliario.php");
                    $('#crearBodega').load("Vista/crearBodega.php");
                    $('#cambiarEstadoBodega').load("Vista/cambiarEstadoBodega.php");
                });
            </script>
        </body>

    </html>

    <?php
} else {
    include 'Vista/inicio.php';
}
?>