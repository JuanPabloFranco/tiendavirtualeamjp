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
                        $consultaVP = ejecutarSQL::consultar("SELECT * FROM factura WHERE id_cliente=" . $_SESSION['id_user'] . " AND (factura.estado_factura<>'Entregado' AND factura.estado_factura<>'Cancelado') ORDER BY factura.id DESC");
                        while ($filaVP = mysqli_fetch_array($consultaVP)) {
                            $vecRepartidor = mysqli_fetch_row(ejecutarSQL::consultar("SELECT nombre_repartidor, foto_repartidor FROM repartidor WHERE id=" . $filaVP['id_repartidor']));
                            ?>
                            <div class="col-xs-12 col-sm-6" >
                                <div class="thumbnail" style="width: 90%; background-color: #d9edf7" >
                                    <img style="max-width: 20%" src="Recursos/img/logo_eam.png" ><h3 style="text-align: center">Pedido <?php echo $filaVP['estado_venta'] ?></h3>
                                    <?php
                                    if ($filaVP['estado_venta'] == "En Verificación" || $filaVP['estado_venta'] == "En Proceso") {
                                        ?>
                                        <p><h5 style="text-align: center">Confirma tu pedido escribiendonos a Whatsapp dando clic en el icono</h5></p>
                                        <a target="_blanck" href="https://api.whatsapp.com/send?phone=57<?php echo WP?>&text=Hola!,&nbsp;quiero&nbsp;confirmar&nbsp;mi&nbsp;pedido&nbsp;a&nbsp;nombre&nbsp;de&nbsp;<?php echo $_SESSION['nombreUser']; ?>" title="Whatsapp" >
                                            <img src="Recursos/icons/whatsapp_108042.png" alt="Whatsapp" style="max-width: 10%">
                                        </a>
                                        <?php
                                    }
                                    if ($filaVP['metodo_pago'] == "Transferencia") {
                                        ?>
                                        <p class="text-center">Cuenta de ahorros No. XXX-XXXXX-XX <img src="Recursos/img/logo-bancolombia.png" style="max-width: 15%; text-align: center" ></p>
                                        <?php
                                    }
                                    ?>
                                    <table class="table table-bordered" >
                                        <?php
                                        $consultaPedVP = ejecutarSQL::consultar("SELECT pedido.precio, pedido.cantidad, producto.nombre_prod FROM pedido, producto, venta WHERE pedido.id_venta=venta.id AND pedido.id_producto=producto.id AND estado_prod<>'Entregado' AND id_venta=" . $filaVP['id']);
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
                                    <h5 style="text-align: center">Entregado en: <?php echo $filaVP['direccion_venta'] ?></h5>
                                    <?php
                                    if ($filaVP['estado_venta'] <> "En Verificación") {
                                        ?>
                                        <h4 style="text-align: center">Costo Domicilio $<?php echo $filaVP['costo_domicilio'] ?></h4>
                                        <h2 style="text-align: center">Total $<?php echo $subtotal + $filaVP['costo_domicilio']; ?></h2>
                                        <h4 style="text-align: center">Método de pago: <?php echo $filaVP['metodo_pago'] ?></h4>
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
                                        <h4 style="text-align: center">Costo Domicilio pendiente</h4>
                                        <h2 style="text-align: center">Total $<?php echo $subtotal ?> + Domicilio</h2>
                                        <h4 style="text-align: center">Método de pago: <?php echo $filaVP['metodo_pago'] ?></h4>
                                        <?php
                                    }
                                    if (isset($vecRepartidor) && $vecRepartidor[0] <> "") {
                                        ?>
                                        <h5 style="text-align: center">Pedido Entregado por:</h5>
                                        <h5 style="text-align: center"><?php echo $vecRepartidor[0]; ?></h5>
                                        <?php
                                        if ($filaVP['estado_venta'] <> "Entregado") {
                                            ?>
                                            <img style="max-width: 20%" src="Recursos/img-repartidor/<?php echo $vecRepartidor[1] ?>" >
                                            <?php
                                        }
                                    }
                                    ?>

                                </div>
                            </div>
                            <?php
                        }
                        // Consulta para listar los pedidos realizados por el cliente que si esten entregados o cancelados
                        $consultaVPV = ejecutarSQL::consultar("SELECT * FROM factura WHERE id_cliente=" . $_SESSION['id_user'] . " AND (factura.estado_factura='Entregado' OR factura.estado_factura='Cancelado') ORDER BY factura.id DESC");
                        while ($filaVPV = mysqli_fetch_array($consultaVPV)) {
                            $vecRepartidor = mysqli_fetch_row(ejecutarSQL::consultar("SELECT nombre_repartidor, foto_repartidor FROM repartidor WHERE id=" . $filaVPV['id_repartidor']));
                            ?>
                            <div class="col-xs-12 col-sm-6" >
                                <?php
                                if ($filaVPV['estado_venta'] == "Entregado") {
                                    ?>
                                    <div class="thumbnail" style="width: 90%; background-color: #a0f197" >
                                        <?php
                                    } else {
                                        ?>
                                        <div class="thumbnail" style="width: 90%; background-color: #e4c6e2" >
                                            <?php
                                        }
                                        ?>
                                        <img style="max-width: 20%" src="Recursos/img/logo_eam.png" ><h3 style="text-align: center">Pedido <?php echo $filaVPV['estado_venta'] ?></h3>
                                        <h5 style="text-align: center">Fecha <?php echo $filaVPV['fecha'] ?></h5>
                                        <table class="table table-bordered; background-color: #e4c6e2" >
                                            <?php
                                            $consultaPedVPV = ejecutarSQL::consultar("SELECT pedido.precio, pedido.cantidad, producto.nombre_prod FROM pedido, producto, venta WHERE pedido.id_venta=venta.id AND pedido.id_producto=producto.id AND estado_prod<>'Entregado' AND id_venta=" . $filaVPV['id']);
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
                                        if ($filaVPV['estado_venta'] == "Entregado") {
                                            ?>
                                            <h5 style="text-align: center">Entregado en: <?php echo $filaVPV['direccion_venta'] ?></h5>
                                            <h4 style="text-align: center">Costo Domicilio $<?php echo $filaVPV['costo_domicilio'] ?></h4>
                                            <h2 style="text-align: center">Total $<?php echo ($subtotal + $filaVPV['costo_domicilio']) ?></h2>
                                            <h4 style="text-align: center">Método de pago: <?php echo $filaVPV['metodo_pago'] ?></h4>
                                            <?php
                                            if ($filaVP['cambio'] <> "0") {
                                                if ($filaVP['metodo_pago'] == "Efectivo") {
                                                    ?>
                                                    <h4 style="text-align: center">Cambio de $<?php echo $filaVP['cambio'] . " = ($" . ($filaVP['cambio'] - ($subtotal + $filaVP['costo_domicilio'])) . ")" ?></h4>                                           
                                                    <?php
                                                }
                                            }
                                            if ($filaVP['metodo_pago'] == "Transferencia") {
                                                ?>
                                                <p class="text-center">Cuenta de ahorros No. 865-320706-37 <img src="Recursos/img/logo-bancolombia.png" style="max-width: 15%; text-align: center" ></p>
                                                <?php
                                            }
                                            if (isset($vecRepartidor) && $vecRepartidor[0] <> "") {
                                                ?>
                                                <h5 style="text-align: center">Pedido Entregado por:</h5>
                                                <h5 style="text-align: center"><?php echo $vecRepartidor[0]; ?></h5>
                                                <?php
                                                if ($filaVPV['estado_venta'] <> "Entregado") {
                                                    ?>
                                                    <img style="max-width: 20%" src="Recursos/img-repartidor/<?php echo $vecRepartidor[1] ?>" >
                                                    <?php
                                                }
                                                ?>

                                                <?php
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