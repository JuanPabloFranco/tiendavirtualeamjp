<?php
include '../Conexion/consulSQL.php';
$id = $_GET['id'];
$sql = "SELECT factura.id,factura.estado_factura,cliente.nombre_completo,cliente.nit,cliente.telefono,factura.direccion_entrega,factura.metodo_pago,factura.cambio FROM factura,cliente WHERE factura.id_cliente=cliente.id AND factura.id=$id ";
$vecId = mysqli_fetch_row(ejecutarSQL::consultar($sql));
$consultaCostoDomicilio = mysqli_fetch_row(ejecutarSQL::consultar("SELECT costo_domicilio FROM despacho WHERE id_factura=" . $vecId[0]));
if ($consultaCostoDomicilio[0] == null) {
    $consultaCostoDomicilio[0] = 0;
}
?>

<div class="modal-dialog modal-lg">
    <div class="modal-content center-all-contens" id="divPedido">
        <h2 class="text-center">PEDIDO No. <?php echo $vecId[0] ?></h2>

        <div class="thumbnail" style="width: 100%">
            <h3 class="text-center"><?php echo $vecId[1] ?></h3>
            <h5 style="text-align: center"><b>Cliente: </b><?php echo $vecId[2] ?></h5>
            <p>
                <h5 style="text-align: center"><b>Cédula o Nit:</b><?php echo $vecId[3] ?></h5>
            </p>
            <p>
                <h5 style="text-align: center"><b>Teléfono: </b><?php echo $vecId[4]; ?></h5>
            </p>
            <p>
                <h5 style="text-align: center"><b>Dirección: </b><?php echo $vecId[5]; ?></h5>
            </p>

            <table class="table table-bordered">
                <?php
                $totalPedido = 0;
                $consultaPedVP = ejecutarSQL::consultar("SELECT pedido.precio, pedido.cantidad, producto.nombre_prod, producto.imagen,producto.descripcion_prod FROM pedido, producto,factura
                     WHERE pedido.id_factura=factura.id AND pedido.id_producto=producto.id AND estado_prod<>'Entregado' AND factura.id=" . $vecId[0]);


                ?>
                <tr style="text-align: center">
                    <td colspan="2">
                        <p><b>PRODUCTO</b></p>
                    </td>
                    <td>
                        <p><b>CANTIDAD</b></p>
                    </td>
                    <td>
                        <p><b>PRECIO</b></p>
                    </td>
                    <td>
                        <p><b>SUBTOTAL</b></p>
                    </td>
                </tr>
                <?php
                while ($filaPedVP = mysqli_fetch_array($consultaPedVP)) {
                ?>
                    <tr style="text-align: center">
                        <td style="max-width: 40px"><img style="max-width: 50px" src="Recursos/img-products/<?php echo $filaPedVP['imagen'] ?>" data-toggle="popover" data-trigger="hover" data-content="<?php echo $filaPedVP['descripcion_prod'] ?>"></td>
                        <td>
                            <p><?php echo $filaPedVP['nombre_prod'] ?></p>
                        </td>
                        <td>
                            <p><?php echo $filaPedVP['cantidad'] ?></p>
                        </td>
                        <td>
                            <p>$<?php echo $filaPedVP['precio'] ?></p>
                        </td>
                        <td>
                            <p>$<?php echo ($filaPedVP['precio'] * $filaPedVP['cantidad']) ?></p>
                        </td>
                    </tr>
                <?php
                    $totalPedido = $totalPedido + ($filaPedVP['precio'] * $filaPedVP['cantidad']);
                }
                $total = $totalPedido + $consultaCostoDomicilio[0];
                ?>
                <tr style="text-align: center">
                    <td>
                        <p>Costo Domicilio</p>
                    </td>
                    <td colspan="3">
                        <p>$ <?php echo  $consultaCostoDomicilio[0]   ?></p>
                    </td>
                </tr>
            </table>
            <h3 style="text-align: center">Total Pedido $<?php echo $total ?></h3>
            <h4 style="text-align: center">Método de pago: <?php echo $vecId[6] ?></h4>
            <?php
            if ($vecId[7] <> "0") {
                if ($vecId[6] == "Efectivo") {
            ?>
                    <h4 style="text-align: center">Cambio de $<?php echo $vecId[7] . " = ($" . ($vecId[7] - $total) . ")" ?></h4>
                <?php
                }
            }
            $sqlTotal = "UPDATE factura SET total=" . $total . " WHERE id=" . $_GET['id'];
            ejecutarSQL::consultar($sqlTotal);

            $vecRep = mysqli_fetch_row(ejecutarSQL::consultar("SELECT domiciliario.nombre_repartidor, foto_repartidor FROM domiciliario,despacho WHERE despacho.id_domiciliario=domiciliario.id AND despacho.id_factura=$id"));
            if (!empty($vecRep)) {
                ?>
                <h5 style="text-align: center"><b>Domiciliario Asignado: </b><?php echo $vecRep[0]; ?></h5>
                <img src="Recursos/img-repartidor/<?php echo $vecRep[1]; ?>" style="width: 30%; text-align: center">
            <?php
            }
            ?>
        </div>
        <?php

        ?>
        <p class="text-center">
            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cerrar</button>
        </p>
    </div>
</div>