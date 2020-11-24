<?php
if (!$_SESSION['nombreUsuario'] == "") {
    ?>
    <!DOCTYPE html>
    <html lang="es">
        <head>    
            <title>Mis Pedidos</title>   
            <!--<script>setTimeout('document.location.reload()', 20000);</script>-->
        </head>
        <body id="container-page-index" style="width: 100%; text-align: center; margin: 0;">
            <section id="container-pedido" >
                <div class="container">
                    <div class="page-header">
                        <h1>Mis Pedidos</h1>
                    </div>         
                    <?php
                    include '../Recursos/plantillas/datos.php';
                    if (empty($_SESSION['producto'])) {
                        ?>
                        <div class="page-header">
                            <h4>No tienes productos en el carrito de compras actualmente</h4>
                        </div>
                        <?php
                    } else {
                        ?>
                        <table class="table table-bordered">
                            <tr><th colspan="4" style="text-align: center"><h4>CARRITO DE COMPRAS</h4></th></tr>
                            <tr style='text-align: center'><td><b>PRODUCTO</b></td><td><b>CANTIDAD</b></td><td><b>PRECIO</b></td><td><b>SUBTOTAL</b></td></tr>
                            <?php
                            foreach ($_SESSION['producto'] as $key => $producto) {
                                ?>
                                <tr style='text-align: center'><td><?php echo $producto['nombre'] ?></td><td><?php echo $producto['cantidad'] ?></td><td>$<?php echo $producto['precio'] ?></td>
                                    <td>$<?php echo $producto['precio'] * $producto['cantidad']; ?></td>
                                    <?php
                                    ?>
                                </tr>
                                <?php
                                $suma += ($producto['precio'] * $producto['cantidad']);
                            }
                            ?>
                            <tr style='text-align: center'><td colspan='3' >TOTAL</td><td>$<?php echo $suma; ?> + Domicilio</td></tr>
                        </table>
                        <?php
                    }
                    ?>
                </div>
                <div class="container" >
                    <?php
                    // Consulta para listar los pedidos realizados por el cliente que no esten entregados o cancelados
                    if (!$_SESSION['nombreUsuario'] == "" && !$_SESSION['claveUser'] == "" && !$_SESSION['id_user'] == "") {
                        $prod_x_pag = 10;
                        $iniciar = ($_GET['pagina'] - 1) * $prod_x_pag;
                        ?>
                        <div class="panel panel-info">
                            <div class="panel-heading text-center">
                                <h3>Pedidos Registrados por mi en <small class="tittles-pages-logo"><?php echo EMPRESA . " " . NEMPRESA; ?></small></h3>                                
                            </div>
                            <div id="res_update_categoria" style="width: 100%; padding:0px;"></div>
                            <div class="table-responsive">
                                <table class="table table-bordered" >
                                    <thead class="">
                                        <tr>
                                            <th class="text-center">Fecha Pedido</th>
                                            <th class="text-center">Estado Pedido</th>
                                            <th class="text-center">Valor Total</th>
                                            <th class="text-center">Detalle</th>
                                            <th class="text-center">Factura</th>
                                        </tr>
                                    </thead>
                                    <tbody> 
                                        <?php
                                        $consultaFacCliente = ejecutarSQL::consultar("SELECT id, fecha, total, estado_factura FROM factura WHERE id_cliente=" . $_SESSION['id_user'] . " ORDER BY factura.id DESC LIMIT " . $iniciar . "," . $prod_x_pag);
                                        while ($filaFC = mysqli_fetch_array($consultaFacCliente)) {
                                            ?>
                                        <div>
                                            <tr style="background-color: <?php echo $color ?>">
                                                <td class="text-center"><?php echo $filaFC['fecha'] ?></td>
                                                <td class="text-center"><?php echo $filaFC['estado_factura'] ?></td>
                                                <td class="text-center">$<?php echo $filaFC['total'] ?></td>
                                                <td class="text-center"><button type="button" class="btn btn-info btn-sm detalle_facCl" value="<?php echo $filaFC['id']; ?>" data-toggle="modal" data-target="#detalle_facCl"><span class="fa fa-pencil"></span> Detalle</button>
                                                <td class="text-center"><a href='Vista/facturaPDF.php?id=<?php echo $filaFC['id'] ?>&hoja=carta' target='_blank' ><img src='Recursos/img/pdf.png' style='width: 25px' title='Factura PDF'></a></td>
                                                </td>
                                            </tr>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div> 
                        <?php
                    }
                    ?>

                </div> 
                <div class="container" >
                    <nav aria-label="Page Navigation example">
                        <ul class="pagination nav2">
                            <li class="page-item <?php echo $_GET['pagina'] <= 1 ? 'disabled' : '' ?>">
                                <a class="page_link" href="index.php?page=pedido&&pagina=<?php echo $_GET['pagina'] - 1 ?>">Anterior</a>
                            </li>
                            <?php
                            $sqlFactura = "SELECT COUNT(factura.id) FROM factura WHERE id_cliente=" . $_SESSION['id_user'];
                            $facturas = mysqli_fetch_row(ejecutarSQL::consultar($sqlFactura));
                            $paginas = ceil($facturas[0] / $prod_x_pag);
                            for ($i = 0; $i < $paginas; $i++) {
                                ?>               
                                <li class="page-item <?php echo $_GET['pagina'] == $i + 1 ? 'active' : '' ?>" >
                                    <a class="page_link" href="index.php?page=pedido&&pagina=<?php echo $i + 1; ?>"><?php echo $i + 1; ?></a>
                                </li>
                                <?php
                            }
                            ?>
                            <li class="page-item <?php echo $_GET['pagina'] >= $paginas ? 'disabled' : '' ?>">
                                <a class="page_link" href="index.php?page=pedido&&pagina=<?php echo $_GET['pagina'] + 1 ?>">Siguiente</a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="modal fade" id="detalle_facCl" tabindex="-2" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="padding: 20px;" data-dismiss="modal"></div>
                <script>
                    $(document).ready(function () {
                        //Mabrir modal ver pedido
                        $('#detalle_facCl').load("Vista/VerPedido.php");
                        //Enviar id a la vista de ver pedido
                        $(".detalle_facCl").click(function () { //      
                            $('#detalle_facCl').load("Vista/verPedidoCL.php?id=" + $(this).val());
                        });

                        $("#myInputFacturas").on("keyup", function () {
                            var value = $(this).val().toLowerCase();
                            $("#tablaFacturas tr").filter(function () {
                                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                            });
                        });
                    });
                </script>
            </section>    
        </body>
    </html>
    <?php
} else {
    include 'Vista/inicio.php';
}
?>
