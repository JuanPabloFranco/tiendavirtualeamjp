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
                <th class="text-center">Cambiar a</th>
                <th class="text-center">Factura</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $pedido = ejecutarSQL::consultar("SELECT factura.id,factura.total, factura.estado_factura, cliente.nombre_completo, factura.direccion_entrega, factura.metodo_pago FROM factura, cliente WHERE factura.id_cliente=cliente.id AND (factura.estado_factura<>'Entregado' AND factura.estado_factura<>'Anulada') ORDER BY id DESC");
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
                            <?php if ($peU['estado_factura'] <> "En Verificación") { ?>
                                <button type="button" class="btn btn-link btn-sm ver_despacho" value="<?php echo $peU[0]; ?>" data-toggle="modal" data-target="#verDespacho"><span class="fa fa-truck"></span> Despacho</button>
                                <?php
                            } else {
                                echo "No aplica";
                            }
                            ?>
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-success btn-sm cambiarEstado" value="<?php echo $peU[0]; ?>" data-toggle="modal" data-target="#cambiarEstado"> Actualizar</button>                                                        
                        </td>
                        <td class="text-center"><a href='Vista/facturaPDF.php?id=<?php echo $peU['id'] ?>&hoja=carta' target='_blank' ><br><img src='Recursos/img/pdf.png' style='width: 25px' title='Factura PDF'></a></td>

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
<div class="modal fade" id="cambiarEstado" tabindex="-2" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="padding: 20px;" data-dismiss="modal"></div>
<div class="modal fade" id="VerPedido" tabindex="-2" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="padding: 20px;" data-dismiss="modal"></div>
<div class="modal fade" id="verDespacho" tabindex="-2" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="padding: 20px;" data-dismiss="modal"></div>
<script>
    function actualizarTablaPedidos() {
        $('#tablaPedidos').load("Recursos/includes/tablaPedidos.php");
    }
    $(document).ready(function () {
        // Mostrar el modal editar bodega   
        $('#verDespacho').load("Vista/verDespacho.php");
        //Mabrir modal ver pedido
        $('#VerPedido').load("Vista/VerPedido.php");
        //Enviar id a la vista de ver pedido
        $(".ver_pedido").click(function () { //      
            $('#VerPedido').load("Vista/verPedido.php?id=" + $(this).val());
        });


        //enviar valor al modal editar bodega
        $(".ver_pedido").click(function () { //      
            $('#VerPedido').load("Vista/verPedido.php?id=" + $(this).val());
        });

        //enviar valor al modal editar bodega
        $(".cambiarEstado").click(function () { //      
            $('#cambiarEstado').load("Vista/cambiarEstadoFactura.php?id=" + $(this).val());
        });

        $(".ver_despacho").click(function () { //      
            $('#verDespacho').load("Vista/verDespacho.php?id=" + $(this).val());
        });
    });
</script>