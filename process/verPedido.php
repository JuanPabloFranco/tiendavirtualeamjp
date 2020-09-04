<?php
include '../library/consulSQL.php';
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content center-all-contens" id="divPedido">
        <h2 class="text-center">PEDIDO No. <?php echo $_GET['id'] ?></h2>
        <?php
        $consultaVP = ejecutarSQL::consultar("SELECT venta.id, cliente.nit, cliente.telefono, venta.direccion_venta, cliente.nombre_completo, venta.estado_venta, venta.total, venta.costo_domicilio, venta.id_repartidor, venta.metodo_pago, venta.cambio FROM venta, cliente WHERE venta.id_cliente=cliente.id AND venta.id=" . $_GET['id']);
        while ($filaVP = mysqli_fetch_array($consultaVP)) {
            ?>
            <div class="thumbnail" style="width: 100%">
                <h3 class="text-center"><?php echo $filaVP['estado_venta'] ?></h3>
                <h5 style="text-align: center"><b>Cliente: </b><?php echo $filaVP['nombre_completo'] ?></h5>
                <p><h5 style="text-align: center"><b>Cédula o Nit: </b><?php echo "\n" . $filaVP['nit'] ?></h5></p>
                <p><h5 style="text-align: center"><b>Teléfono: </b><?php echo "\n" . $filaVP['telefono'] ?></h5></p>
                <p><h5 style="text-align: center"><b>Dirección: </b><?php echo "\n" . $filaVP['direccion_venta'] ?></h5></p>
                <table class="table table-bordered">
                    <?php
                    $totalPedido = 0;
                    $consultaPedVP = ejecutarSQL::consultar("SELECT pedido.precio, pedido.cantidad, producto.nombre_prod, producto.imagen FROM pedido, producto, venta WHERE pedido.id_venta=venta.id AND pedido.id_producto=producto.id AND estado_prod<>'Entregado' AND id_venta=" . $filaVP['id']);
                    ?>
                    <tr style="text-align: center"><td colspan="2"><p><b>PRODUCTO</b></p></td><td><p><b>CANTIDAD</b></p></td><td><p><b>PRECIO</b></p></td><td><p><b>SUBTOTAL</b></p></td></tr>
                    <?php
                    while ($filaPedVP = mysqli_fetch_array($consultaPedVP)) {
                        ?>
                        <tr style="text-align: center">
                            <td style="max-width: 40px"><img style="max-width: 50px" src="assets/img-products/<?php echo $filaPedVP['imagen'] ?>"  data-toggle="popover" data-trigger="hover" data-content="<?php echo $filaPedVP['descripcion_prod'] ?>"></td>
                            <td><p><?php echo $filaPedVP['nombre_prod'] ?></p></td><td><p><?php echo $filaPedVP['cantidad'] ?></p></td><td><p>$<?php echo $filaPedVP['precio'] ?></p></td><td><p>$<?php echo ($filaPedVP['precio'] * $filaPedVP['cantidad']) ?></p></td></tr>
                        <?php
                        $totalPedido = $totalPedido + ($filaPedVP['precio'] * $filaPedVP['cantidad']);
                    }
                    $total = $totalPedido + $filaVP['costo_domicilio'];
                    ?>
                    <tr style="text-align: center"><td><p>Costo Domicilio</p></td><td colspan="3"><p>$<?php echo $filaVP['costo_domicilio'] ?></p></td></tr>
                </table>
                <h3 style="text-align: center">Total Pedido $<?php echo $total ?></h3>
                <h4 style="text-align: center">Método de pago: <?php echo $filaVP['metodo_pago'] ?></h4>
                <?php
                if ($filaVP['cambio'] <> "0") {
                    if ($filaVP['metodo_pago'] == "Efectivo") {
                        ?>
                        <h4 style="text-align: center">Cambio de $<?php echo $filaVP['cambio'] . " = ($" . ($filaVP['cambio'] - $total) . ")" ?></h4>                                           
                        <?php
                    }
                }
                $sqlTotal = "UPDATE venta SET total=" . $total . " WHERE id=" . $_GET['id'];
                ejecutarSQL::consultar($sqlTotal);
                if ($filaVP['id_repartidor'] <> "0") {
                    $vecRep = mysqli_fetch_row(ejecutarSQL::consultar("SELECT nombre_repartidor FROM repartidor WHERE id=" . $filaVP['id_repartidor']));
                    ?>
                    <h5 style="text-align: center"><b>Domiciliario Asignado: </b><?php echo $vecRep[0]; ?></h5>
                    <?php
                }
                ?>

            </div>
            <?php
        }
        ?>
        <p class = "text-center">
            <button type = "button" class = "btn btn-danger btn-sm" data-dismiss = "modal">Cerrar</button>
        </p>
    </div>
</div>