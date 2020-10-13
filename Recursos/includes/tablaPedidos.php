<?php
include '../../Conexion/consulSQL.php';
include '../plantillas/datos.php';
?>
<div class="table-responsive">
    <table class="table table-bordered" id="tablaPedidos">
        <thead class="">
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">Pedido</th>
                <th class="text-center">Estado</th>
                <th class="text-center">Cliente</th>
                <th class="text-center">Direccion</th>
                <th class="text-center">Total</th>
                <th class="text-center">Método Pago</th>
                <th class="text-center">Despacho</th>
                <th class="text-center">Cambiar Estado</th>
                <th class="text-center">Opciones</th>
            </tr>
        </thead>
        <tbody>


            <?php
            $pedido = ejecutarSQL::consultar("SELECT factura.id,factura.total, factura.estado_factura, cliente.nombre_completo, factura.direccion_entrega, factura.metodo_pago FROM factura, cliente WHERE factura.id_cliente=cliente.id AND (factura.estado_factura<>'Entregado' AND factura.estado_factura<>'Cancelado')");
            $upp = 1;
            while ($peU = mysqli_fetch_array($pedido)) {
            ?>
                <div id="update-pedido">
                    <form method="post" action="DAO/facturaDAO.php" id="res-update-pedido-<?php echo $upp ?>">
                        <tr style="text-align: center">
                            <td><?php echo $peU[0] ?><input type="hidden" name="id_factura" value="<?php echo $peU[0] ?>"></td>
                            <td class="text-center"><button type="button" class="btn btn-info btn-sm ver_pedido" value="<?php echo $peU['id'] ?>" data-toggle="modal" data-target="#VerPedido"><span class="fa fa-pencil"></span> Ver Pedido</button>
                            </td>
                            <td><?php echo $peU['estado_factura'] ?></td>
                            <td><?php echo $peU['nombre_completo'] ?></td>
                            <td><?php echo $peU['direccion_entrega'] ?></td>
                            <td>$<?php echo $peU['total'] ?></td>
                            <td><?php echo $peU['metodo_pago'] ?></td>
                            <td>
                                <?php
                                if ($peU['estado_factura'] <> "En Verificación") { ?>
                                    <button type="button" class="btn btn-link btn-sm ver_despacho" value="<?php echo $peU[0]; ?>" data-toggle="modal" data-target="#verDespacho"><span class="fa fa-truck"></span> Despacho</button>
                                <?php
                                } else {
                                    echo "No aplica";
                                }            ?>

                            </td>

                            <td>
                                <select class="form-control" name="estadoFactura">
                                    <?php
                                    if ($peU[2] == "En verificacion") {
                                        echo '<option selected="selected" value="En verificacion">En verificacion</option>';
                                    } else {
                                        echo '<option value="En verificacion">En verificacion</option>';
                                    }
                                    if ($peU[2] == "En Proceso") {
                                        echo '<option selected="selected" value="En Proceso">En Proceso</option>';
                                    } else {
                                        echo '<option value="En Proceso">En Proceso</option>';
                                    }
                                    if ($peU[2]  == "Anulada") {
                                        echo '<option selected="selected" value="Anulada">Anulada</option>';
                                    } else {
                                        echo '<option value="Anulada">Anulada</option>';
                                    }

                                    if ($peU[2]  == "Finalizada") {
                                        echo '<option selected="selected" value="Finalizada">Finalizada</option>';
                                    } else {
                                        echo '<option value="Finalizada">Finalizada</option>';
                                    }
                                    if ($peU[2]  == "Cancelada") {
                                        echo '<option selected="selected" value="Cancelada">Cancelada</option>';
                                    } else {
                                        echo '<option value="Cancelada">Cancelada</option>';
                                    }
                                    ?>
                                </select>
                            </td>
                            

                            <td class="text-center">
                                <button type="submit" class="btn btn-sm btn-primary button-UPP" value="res-update-pedido-<?php echo $upp ?>">Actualizar</button>
                                <input type="text" name="funcion" style="display: none" value="actualizarFactura">
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
</div>

<div class="modal fade" id="VerPedido" tabindex="-2" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="padding: 20px;" data-dismiss="modal"></div>
<div class="modal fade" id="verDespacho" tabindex="-2" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="padding: 20px;" data-dismiss="modal"></div>
<script>
    function actualizarTablaProveedor() {
        $('#tablaPedidos').load("Recursos/includes/tablaProveedores.php");
    }
    $(document).ready(function() {
        // Mostrar el modal editar bodega   
        $('#verDespacho').load("Vista/verDespacho.php");

        $('#VerPedido').load("Vista/VerPedido.php");

        $('#update-pedido').load("Vista/tablaPedidos.php");

        $(".ver_pedido").click(function() { //      
            $('#VerPedido').load("Vista/verPedido.php?id=" + $(this).val());
        });

        //enviar valor al modal editar bodega
        $(".ver_pedido").click(function() { //      
            $('#VerPedido').load("Vista/verPedido.php?id=" + $(this).val());
        });

        $(".ver_despacho").click(function() { //      
            $('#verDespacho').load("Vista/verDespacho.php?id=" + $(this).val());
        });

        $("#myInputProveedor").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#tablaProveedores tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>