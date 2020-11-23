<?php
 if (!$_SESSION['nombreUsuario'] =="") {
?>
<!DOCTYPE html>
<html lang="es">
    <head>    
        <title>Pedido</title>   
        <!--<script>setTimeout('document.location.reload()', 20000);</script>-->
    </head>
    <body id="container-page-index">
        <section id="container-pedido">
            <div class="container">
                <div class="page-header">
                    <h1>Mis Pedidos</h1>
                </div>         
                <?php
                include '../Recursos/plantillas/datos.php';
                if (empty($_SESSION['producto'])) {
                    ?>
                    <div class="page-header">
                        <h3>No tienes productos en el carrito</h3>
                    </div>
                    <?php
                }
                ?>
                <div class="row">
                    <?php
                    // Consulta para listar los pedidos realizados por el cliente que no esten entregados o cancelados
                    if (!$_SESSION['nombreUsuario'] == "" && !$_SESSION['claveUser'] == "" && !$_SESSION['id_user'] == "") {
                        $consultaVP = ejecutarSQL::consultar("SELECT * FROM factura WHERE id_cliente=" . $_SESSION['id_user'] . " AND (factura.estado_factura<>'Finalizada' AND factura.estado_factura<>'Pagada' AND factura.estado_factura<>'Anulada') ORDER BY factura.id DESC");
                        while ($filaVP = mysqli_fetch_array($consultaVP)) {
                            $sql = "SELECT nombre_repartidor, foto_repartidor, estado_despacho, costo_domicilio FROM despacho, factura, domiciliario WHERE despacho.id_factura=factura.id AND despacho.id_domiciliario=domiciliario.id AND despacho.id_factura=" . $filaVP['id'];
                            $filaDespVP = mysqli_fetch_row(ejecutarSQL::consultar($sql));
                            ?>
                            <div class="col-xs-12 col-sm-6" >
                                <div class="thumbnail" style="width: 90%; background-color: #d9edf7" >
                                    <img style="max-width: 20%" src="Recursos/img/logo_eam.png" ><h3 style="text-align: center">Pedido <?php echo $filaVP['estado_factura'] ?></h3>
                                    <?php
                                    if ($filaVP['estado_factura'] == "En Verificación" || $filaVP['estado_factura'] == "En Proceso") {
                                        ?>
                                        <p><h5 style="text-align: center">Confirma tu pedido escribiendonos a Whatsapp dando clic en el icono</h5></p>
                                        <a target="_blanck" href="https://api.whatsapp.com/send?phone=57<?php echo WP ?>&text=Hola!,&nbsp;quiero&nbsp;confirmar&nbsp;mi&nbsp;pedido&nbsp;a&nbsp;nombre&nbsp;de&nbsp;<?php echo $_SESSION['nombreUser']; ?>" title="Whatsapp" >
                                            <img src="Recursos/icons/whatsapp_108042.png" alt="Whatsapp" style="max-width: 10%">
                                        </a>
                                        <?php
                                    }
                                    if ($filaVP['metodo_pago'] == "Transferencia") {
                                        ?>
                                        <p class="text-center">Cuenta de ahorros No. <?php echo CUENTA; ?> <img src="Recursos/img/logo-bancolombia.png" style="max-width: 15%; text-align: center" ></p>
                                        <?php
                                    }
                                    ?>
                                    <table class="table table-bordered" >
                                        <?php
                                        $consultaPedVP = ejecutarSQL::consultar("SELECT pedido.precio, pedido.cantidad, producto.nombre_prod FROM pedido, producto, factura WHERE pedido.id_factura=factura.id AND pedido.id_producto=producto.id AND estado_prod<>'Entregado' AND id_factura=" . $filaVP['id']);
                                        ?>
                                        <tr style="text-align: center"><td><p><b>PRODUCTO</b></p></td><td><p><b>CANTIDAD</b></p></td><td><p><b>PRECIO</b></p></td><td><p><b>SUBTOTAL</b></p></td></tr>
                                        <?php
                                        $subtotal = 0;
                                        while ($filaPedVP = mysqli_fetch_array($consultaPedVP)) {
                                            $totalProducto = $filaPedVP['precio'] * $filaPedVP['cantidad'];
                                            ?>
                                            <tr style="text-align: center"><td><p><?php echo $filaPedVP['nombre_prod'] ?></p></td><td><p><?php echo $filaPedVP['cantidad'] ?></p></td><td><p>$<?php echo $filaPedVP['precio'] ?></p></td><td><p>$<?php echo $totalProducto ?></p></td></tr>
                                            <?php
                                            $subtotal = $subtotal + ($filaPedVP['precio'] * $filaPedVP['cantidad']);
                                        }
                                        ?>
                                        <tr style="text-align: center"><td colspan="2"><p><b>Total Pedido: </b></p></td><td colspan="2"><p><b>$<?php echo $subtotal ?></p></b></td></tr>
                                    </table>
                                    <?php if (isset($filaDespVP) && $filaDespVP[0] <> "") { ?>
                                        <h4 style="text-align: center"><b>Dirección de entrega:</b><br> <?php echo $filaVP['direccion_entrega'] ?></h4>

                                        <h4 style="text-align: center"><b>Valor Domicilio:</b><br> $<?php echo $filaDespVP[3] ?></h4>
                                        <h4 style="text-align: center"><b>Entregado por: </b><br><?php echo $filaDespVP[0] ?></h4>
                                        <img src="Recursos/img-repartidor/<?php echo $filaDespVP[1] ?>" width="30%">

                                        <br>
                                        <h4 style="text-align: center"><b>Estado de la entrega</b><br><?php echo $filaDespVP[2]; ?></h4>

                                        <?php
                                    }
                                    if ($filaVP['estado_venta'] <> "En Verificación") {
                                        if (isset($filaDespVP) && $filaDespVP[0] <> "") {
                                            ?>
                                            <h2 style="text-align: center">Total $<?php echo $subtotal + $filaDespVP[3]; ?></h2>
                                            <?php
                                        } else {
                                            ?>
                                            <h2 style="text-align: center">Total $<?php echo $subtotal; ?></h2>
                                            <?php
                                        }
                                        ?>
                                        <h4 style="text-align: center">Método de pago: <?php echo $filaVP['metodo_pago'] ?></h4>
                                        <?php
                                        if ($filaVP['cambio'] <> "0") {
                                            if ($filaVP['metodo_pago'] == "Efectivo") {
                                                ?>
                                                <h4 style="text-align: center">Cambio de $<?php echo $filaVP['cambio'] . " = ($" . ($filaVP['cambio'] - ($subtotal + $filaVP['costo_domicilio'])) . ")" ?></h4>                                           
                                                <?php
                                            }
                                        }
                                        ?>
                                        <a href='Vista/facturaPDF.php?id=<?php echo $filaVP['id'] ?>&hoja=carta' target='_blank' ><img src='Recursos/img/pdf.png' style='width: 25px' title='Factura PDF'><h5 style="text-align: center">Descarga tu factura aqui</h5></a>
                                        <?php
                                    } else {
                                        ?>
                                        <h4 style="text-align: center">Costo Domicilio pendiente</h4>
                                        <h2 style="text-align: center">Total $<?php echo $subtotal ?> + Domicilio</h2>
                                        <h4 style="text-align: center">Método de pago: <?php echo $filaVP['metodo_pago'] ?></h4>
                                        <?php
                                    }//                                    
                                    ?>

                                </div>
                            </div>
                            <?php
                        }
                        // Consulta para listar los pedidos realizados por el cliente que si esten entregados o cancelados
                        $consultaVPV = ejecutarSQL::consultar("SELECT * FROM factura WHERE id_cliente=" . $_SESSION['id_user'] . " AND (factura.estado_factura='Finalizada' OR factura.estado_factura='Pagada') ORDER BY factura.id DESC");
                        while ($filaVPV = mysqli_fetch_array($consultaVPV)) {
                            ?>
                            <div class="col-xs-12 col-sm-6" >
                                <?php
                                if ($filaVPV['estado_factura'] == "Finalizada") {
                                    ?>
                                    <div class="thumbnail" style="width: 90%; background-color: #a0f197" >
                                        <?php
                                    } else {
                                        ?>
                                        <div class="thumbnail" style="width: 90%; background-color: #e4c6e2" >
                                            <?php
                                        }
                                        ?>
                                        <img style="max-width: 20%" src="Recursos/img/logo_eam.png" ></h3>
                                        <h5 style="text-align: center">Fecha <?php echo $filaVPV['fecha'] ?></h5>
                                        <table class="table table-bordered; background-color: #e4c6e2" >
                                            <?php
                                            $consultaPedVPV = ejecutarSQL::consultar("SELECT pedido.precio, pedido.cantidad, producto.nombre_prod FROM pedido, producto, factura WHERE pedido.id_factura=factura.id AND pedido.id_producto=producto.id AND estado_prod<>'Entregado' AND id_factura=" . $filaVPV['id']);
                                            ?>
                                            <tr style="text-align: center"><td><p><b>PRODUCTO</b></p></td><td><p><b>CANTIDAD</b></p></td><td><p><b>PRECIO</b></p></td><td><p><b>SUBTOTAL</b></p></td></tr>
                                            <?php
                                            $subtotal = 0;
                                            while ($filaPedVPV = mysqli_fetch_array($consultaPedVPV)) {
                                                $totalProducto = $filaPedVPV['precio'] * $filaPedVPV['cantidad'];
                                                ?>
                                                <tr style="text-align: center"><td><p><?php echo $filaPedVPV['nombre_prod'] ?></p></td><td><p><?php echo $filaPedVPV['cantidad'] ?></p></td><td><p>$<?php echo $filaPedVPV['precio'] ?></p></td><td><p>$<?php echo ($totalProducto) ?></p></td></tr>
                                                <?php
                                                $subtotal = $subtotal + $totalProducto;
                                            }
                                            ?>
                                            <tr style="text-align: center"><td colspan="2"><p><b>Total Pedido: </b></p></td><td colspan="2"><p><b>$<?php echo $subtotal ?></p></b></td></tr>
                                        </table>
                                        <?php
                                        if ($filaVPV['estado_factura'] == "Finalizada") {
                                            ?>
                                            <h5 style="text-align: center">Entregado en: <?php echo $filaVPV['direccion_entrega'] ?></h5>
                                            <h2 style="text-align: center">Total $<?php echo ($subtotal) ?></h2>
                                            <h4 style="text-align: center">Método de pago: <?php echo $filaVPV['metodo_pago'] ?></h4>
                                            <a href='Vista/facturaPDF.php?id=<?php echo $filaVPV['id'] ?>&hoja=carta' target='_blank' ><img src='Recursos/img/pdf.png' style='width: 25px' title='Factura PDF'><h5 style="text-align: center">Descarga tu factura aqui</h5></a>

                                            <?php
                                            if ($filaVP['cambio'] <> "0") {
                                                if ($filaVP['metodo_pago'] == "Efectivo") {
                                                    ?>
                                                    <h4 style="text-align: center">Cambio de $<?php echo $filaVP['cambio'] . " = ($" . ($filaVP['cambio'] - ($subtotal + $filaVP['costo_domicilio'])) . ")" ?></h4>                                           
                                                    <?php
                                                }
                                            }
                                        } else {
                                            ?>
                                            <h2 style="text-align: center">Total Pedido $<?php echo $subtotal ?></h2>
                                            <?php
                                        }
                                        ?>

                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>     
                </div> 
        </section>    <?php include './inc/footer.php'; ?>
    </body>
</html>
<?php
 } else{
    
        include 'Vista/inicio.php';
    
 }
?>
