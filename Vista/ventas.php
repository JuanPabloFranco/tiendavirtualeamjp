<?php
include './library/consulSQL.php';
include './process/securityPanel.php';
ini_set('date.timezone', 'America/Bogota');
$año = date("Y");

if (!$_SESSION['nombreUsuario'] ==""&&$_SESSION['tipo'] == "Administrador" || !$_SESSION['nombreUsuario'] ==""&&$_SESSION['tipo'] == "Vendedor") {
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Ventas <?php echo EMPRESA . " " . NEMPRESA ?></title>
        <script>
            $('#verFactura').on('show.bs.modal', function () {
                $('.modal .modal-body').css('overflow-y', 'auto');
                var _height = $(window).height() * 0.8;
                $('.modal .modal-body').css('max-height', _height);
            });
        </script>
    </head>
    <body id="container-page-configAdmin">
        <section id="prove-product-cat-config">
            <div class="container">
                <div class="page-header">
                    <h1>Panel de Ventas <small class = "tittles-pages-logo"><?php echo EMPRESA ?></small></h1>
                    <?php
                    if ($_SESSION['tipo'] == "Administrador") {
                        ?>
                        <a href="index.php?page=configAdmin"><button  class="btn btn-primary">Administración</button></a>
                        <?php
                    }
                    ?>
                </div>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#Pedidos" role="tab" data-toggle="tab">Pedidos</a></li> 
                    <li role="presentation"><a href="#Facturacion" role="tab" data-toggle="tab">Facturación</a></li>
                    <li role="presentation"><a href="#Clientes" role="tab" data-toggle="tab">Clientes</a></li>
                    <li role="presentation"><a href="#Ventas" role="tab" data-toggle="tab">Panel Ventas</a></li>

                </ul>               
                <div class="tab-content">
                    <!--==============================Panel pedidos===============================-->

                    <div role="tabpanel" class="tab-pane fade in active" id="Pedidos">
                        <div class="row">
                            <div class="col-xs-12">                                
                                <br><br>
                                <div class="panel panel-info" > 
                                    <div class="panel-heading text-center"><h3>Pedidos en Espera <small class="tittles-pages-logo"><?php echo EMPRESA . " " . NEMPRESA ?></small></h3>
                                        <button type="button" class="btn btn-info btn-sm"><span class="fa fa-refresh" onclick="actualizarTablaPedidos()"></span></button>                                           
                                    </div>
                                    <div class="table-responsive" id="tablaPedidos"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade modal-ver_pedido" id="verPedido" tabindex="-2" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="padding: 20px;">
                    </div>
                    <!--==============================Panel facturacion===============================-->

                    <div role="tabpanel" class="tab-pane fade" id="Facturacion">
                        <div class="row">
                            <div class="col-xs-12">                                
                                <br><br>
                                <div class="panel panel-info" id="tablaFacturasFull"></div>
                            </div>
                        </div>
                    </div>

                    <!--==============================Panel ventas===============================-->
                    <div role="tabpanel" class="tab-pane fade" id="Ventas">
                        <div class="row">  
                            <div class="col-xs-12">
                                <?php
                                $num = mysqli_fetch_row(ejecutarSQL::consultar("SELECT LAST_INSERT_ID(id) AS LAST FROM factura ORDER BY id desc limit 0,1"));
                                $numero = $num[0] + 1;
                                ?>
                                <div class="container outer-section" id="divFactura">
                                    <form action="DAO/facturaDAO.php" method="post" role="form">
                                        <div id="print-area">
                                            <div class="row pad-top font-big">
                                                <div class="col-lg-4 col-md-4 col-sm-4">
                                                    <img src="Recursos/img/logo_eam.png" alt="Logo <?php echo EMPRESA; ?>" style="width: 50%">
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4">
                                                    <strong>E-mail : </strong> <?php echo EMAIL; ?>
                                                    <br>
                                                    <strong>Teléfono :</strong> <?php echo TELEFONOS; ?> <br>
                                                    <strong>Nit :</strong> <?php echo NIT; ?>                    
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4">
                                                    <strong><?php echo EMPRESA . " " . NEMPRESA; ?></strong>
                                                    <br>
                                                    Dirección : <?php echo DIRECCION; ?> 
                                                </div>
                                            </div>
                                            <div class="row ">
                                                <hr />
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <h2>Detalles del Cliente :</h2>
                                                    <select class="cliente form-control" name="cliente" id="selCliente" style="width: 100%" required>
                                                        <option value="">Selecciona el cliente</option>   
                                                    </select>
                                                    <h4><strong>Documento: </strong><span id="doc_id"></span></h4>
                                                    <h4><strong>E-mail: </strong><span id="email"></span></h4>
                                                    <h4><strong>Teléfono: </strong><span id="telefono"></span></h4>
                                                    <h4 class="input-group"><strong>Dirección entrega: </strong></h4><input type="text" class="form-control" id="txtDireccion" required name="direccion_entrega">
                                                    <input type="hidden" id="txtId_c" name="id_cliente" >
                                                    <input type="hidden" name="id_vendedor" value="<?php echo $_SESSION['id_user']; ?>">
                                                    <input type="hidden" name="total" id="txtTotal"  required>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <h2>Detalles de la factura:</h2>
                                                    <h4><strong>Factura No. </strong><?php echo $numero; ?></h4>
                                                    <div class="form-group" >
                                                        <h4 class="input-group"><strong>Fecha: </strong></h4><input type="date" class="form-control" required value="<?php echo $fecha; ?>" name="fecha">
                                                    </div>   
                                                    <div class="form-group" >
                                                        <h4 class="input-group"><strong>Método de pago: </strong></h4>
                                                        <select class="form-control" name="metodo_pago" id="selMetodoPago">
                                                            <option value="Efectivo">Efectivo</option>                                                      
                                                            <option value="Transferencia">Transferencia</option>
                                                        </select>
                                                    </div>                     
                                                </div>
                                            </div>
                                            <div class="row">
                                                <hr />
                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-hover">
                                                            <thead>
                                                                <tr style="text-align: center">
                                                                    <th class='text-center'>Item</th>
                                                                    <th>Producto</th>
                                                                    <th class='text-center'>Cantidad</th>
                                                                    <th class='text-right'>Precio unitario</th>
                                                                    <th class='text-right'>Total</th>
                                                                    <th class='text-right'></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class='items'>
                                                            <div id=""></div>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row"> <hr /></div>
                                        <div class="row pad-bottom  pull-right">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <input type="hidden" name="funcion" value="facturar_pedido">
                                                <button type="button" class="btn btn-primary btn-sm" style='display: none' id="btnProducto" data-toggle="modal" data-target="#modalProducto"><span class="glyphicon glyphicon-plus"></span> Agregar Producto</button>                                                
                                                <button type="submit" class="btn btn-success" id="btnCobrar" style='display: none'>Cobrar</button>
                                            </div>
                                        </div>
                                        <div id="resFormFactura" style="width: 100%; text-align: center; margin: 0;"></div>
                                    </form>
                                </div>
                            </div>
                            <!--Modal para agregar productos a la factura-->
                            <div id="formModalProducto">
                                <form class="form-horizontal" method="post" name="guardar_producto" action="DAO/productoDAO.php" id="agregar_producto">
                                    <!-- Modal -->
                                    <div class="modal fade bs-example-modal-lg" id="modalProducto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myModalLabel">Agregar Producto</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>                                                
                                                </div>
                                                <div id="resFormProducto" style="width: 100%; text-align: center; margin: 0;"></div>
                                                <div class="modal-body center-all-contens">
                                                    <div class="form-group">
                                                        <label>Seleccione un producto</label>
                                                        <select class="form-control" id="selProductos" name="id_producto" style="width: 100%">
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
                                                            <input type="number" value="1" min="1" name="cantidad" id="txtCantidadProdFac" style="width: 100%" class="form-control all-elements-tooltip">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="hidden" name="id_cliente" id="txtId_cliente">
                                                    <input type="hidden" name="funcion" value="agregarProducto">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                                    <button type="submit" class="btn btn-info" >Agregar</button>
                                                </div>
                                            </div>                                            
                                        </div>
                                    </div>
                                </form>
                            </div>                            
                            <script type="text/javascript" src="js/VentanaCentrada.js"></script>                            
                        </div>
                    </div>

                    <!-- === === === === === === === === === === Panel Clientes === === === === === === === === === === = -->

                    <div role = "tabpanel" class = "tab-pane fade" id = "Clientes">
                        <div class = "row">
                            <div class = "col-xs-12">
                                <br><br>
                                <div class = "panel panel-info">
                                    <div class = "panel-heading text-center"><h3>Clientes Registrados <small class="tittles-pages-logo"><?php echo EMPRESA . " " . NEMPRESA ?></small></h3>
                                        <input class="form-control" id="myInputClientes" type="text" placeholder="Buscar un valor en la tabla"></div>
                                    <div class = "table-responsive">
                                        <table class = "table table-bordered" id="tablaClientes">
                                            <thead class = "">
                                                <tr>
                                                    <th class = "text-center">#</th>
                                                    <th class = "text-center">Cédula o Nit</th>
                                                    <th class = "text-center">Nombre Completo</th>
                                                    <th class = "text-center">Dirección</th>
                                                    <th class = "text-center">Telefono</th>
                                                    <th class = "text-center">Email</th>
                                                    <th class = "text-center">Usuario</th>
                                                    <th class = "text-center">Login</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $pedidoU = ejecutarSQL::consultar("SELECT * FROM cliente ORDER BY nombre_completo");
                                                $cant = 0;
                                                $upp = 1;
                                                while ($cliente = mysqli_fetch_array($pedidoU)) {
                                                    $cant = $cant + 1;
                                                    ?>
                                                <div id="restaurar_cliente">
                                                    <form method="post" action="DAO/clienteDAO.php" id="restaurar_login_<?php echo $upp; ?>">
                                                        <tr>
                                                            <td><?php echo $cant ?>
                                                                <input class="form-control" type="hidden" name="id" required="" value="<?php echo $cliente['id'] ?>">
                                                            </td>
                                                            <td><?php echo $cliente['nit'] ?></td>
                                                            <td><?php echo $cliente['nombre_completo'] ?></td>
                                                            <td><?php echo $cliente['direccion'] ?></td>
                                                            <td><?php echo $cliente['telefono'] ?></td>
                                                            <td><?php echo $cliente['email'] ?></td>
                                                            <td><?php echo $cliente['usuario'] ?></td>
                                                            <td class="text-center">
                                                                <input type="hidden" name="funcion" value="restaurar">
                                                                <button type="submit" class="btn btn-sm btn-primary button_UP_res_cliente" value="restaurar_login_<?php echo $upp; ?>">Restaurar</button>
                                                                <div id="restaurar_login_<?php echo $upp; ?>" style="width: 100%; margin:0px; padding:0px;"></div>
                                                            </td>
                                                        </tr>
                                                    </form>
                                                </div>
                                                <?php
                                                $upp = $upp + 1;
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script type="text/javascript">
            mostrar_items();
        </script>
    </body>
</html>
<?php
 } else{
    
        include 'Vista/inicio.php';
    
 }
?>