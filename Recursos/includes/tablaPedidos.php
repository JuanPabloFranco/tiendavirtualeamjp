<?php
include '../../Conexion/consulSQL.php';
include '../plantillas/datos.php';
?>
<table class="table table-bordered" id="tabla">
    <thead class="">
        <tr>
            <th class="text-center">#</th>
            <th class="text-center">Pedido</th>
            <th class="text-center">Estado</th> 
            <th class="text-center">Cliente</th>
            <th class="text-center">Direccion</th>    
            <th class="text-center">Costo Domicilio</th>
            <th class="text-center">Total</th>                                                    
            <th class="text-center">Método Pago</th>
            <th class="text-center">Despacho</th>
            <th class="text-center">Cambiar Estado</th>                                                    
            <th class="text-center">Opciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $pedido = ejecutarSQL::consultar("SELECT factura.id, factura.fecha, factura.total, factura.estado_factura, cliente.nombre_completo, factura.direccion_venta, factura.costo_domicilio, factura.metodo_pago FROM factura, cliente WHERE factura.id_cliente=cliente.id AND (factura.estado_factura<>'Entregado' AND factura.estado_factura<>'Cancelado')");
        $upp = 1;
        while ($peU = mysqli_fetch_array($pedido)) {
            ?>
        <div id="update-pedido">
            <form method="post" action="process/updatePedido.php" id="res-update-pedido-<?php echo $upp; ?>">
                <tr style="text-align: center">
                    <td><?php echo $peU['id'] ?><input type="hidden" name="id" value="<?php echo $peU['id'] ?>"></td>
                    <td>
                        <button type="button" class="btn btn-info btn-sm ver_ped" value="<?php echo $peU['id']; ?>" data-toggle="modal" data-target="#verPedido"><span class="fa fa-eye"></span> Ver Pedido</button>
                    </td>
                    <td><?php echo $peU['estado_factura'] ?></td>
                    <td><?php echo $peU['nombre_completo'] ?></td>
                    <td><?php echo $peU['direccion_venta'] ?></td>
                    <td>                                                                
                        <?php
                        if ($peU['estado_factura'] <> "En Verificación") {
                            echo "$" . $peU['costo_domicilio'];
                        } else {
                            ?>
                            <select class="form-control" name="costo_domicilio">
                                <option selected="selected" value="">Elija una opción</option>
                                <option value="0">$0</option>
                                <option value="1500">$1500</option>
                                <option value="2000">$2000</option>
                                <option value="3000">$3000</option>
                                <option value="3500">$3500</option>
                                <option value="4000">$4000</option>
                            </select>
                            <?php
                        }
                        ?>
                    </td>
                    <td>$<?php echo $peU['total'] ?></td>
                    <td><?php echo $peU['metodo_pago'] ?></td>              
                    <td>
                        <?php
                        if ($peU['estado_factura'] <> "En Verificación") {
                            ?>
                            <button type="button" class="btn btn-info btn-sm ver_ped" value="<?php echo $peU['id']; ?>" data-toggle="modal" data-target="#verDespacho"><span class="fa fa-eye"></span> Despacho</button>
                            <?php
                        } else {
                            echo "No aplica";
                        }
                        ?>

                    </td>
                    <?php
                    if ($peU['estado_factura'] == "En Verificación") {
                        ?>
                        <td>
                            <select class="form-control" name="estado_venta">
                                <option selected="selected" value="En Proceso">En Proceso</option>
                                <option value="Despachado">Despachado</option>
                                <option value="Entregado">Entregado</option>
                                <option value="Cancelado">Cancelado</option>
                            </select>
                        </td>
                        <?php
                    }
                    if ($peU['estado_factura'] == "En Proceso") {
                        ?>
                        <td>
                            <select class="form-control" name="estado_venta">
                                <option value="En Proceso">En Proceso</option>
                                <option selected="selected" value="Despachado">Despachado</option>
                                <option value="Entregado">Entregado</option>
                                <option value="Cancelado">Cancelado</option>
                            </select>
                        </td>
                        <?php
                    }
                    if ($peU['estado_factura'] == "Despachado") {
                        ?>
                        <td>
                            <select class="form-control" name="estado_venta">
                                <option value="En Proceso">En Proceso</option>
                                <option value="Despachado">Despachado</option>
                                <option selected="selected" value="Entregado">Entregado</option>
                                <option value="Cancelado">Cancelado</option>
                            </select>
                        </td>
                        <?php
                    }
                    ?>                                                            
                    <td class="text-center">                                                                
                        <button type="submit" class="btn btn-sm btn-primary button-UPPE" value="res-update-pedido-<?php echo $upp ?>">Actualizar</button>
                        <div id="res-update-pedido-<?php echo $upp ?>" style="width: 100%; margin:0px; padding:0px;"></div>
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