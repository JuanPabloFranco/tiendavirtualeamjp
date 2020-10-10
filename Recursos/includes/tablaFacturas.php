<?php
include '../../Conexion/consulSQL.php';
include '../plantillas/datos.php';
?>
<div class="panel-heading text-center">
    <h3>Facturas Registradas <small class="tittles-pages-logo"><?php echo EMPRESA . " " . NEMPRESA; ?></small></h3>
    <input class="form-control" id="myInputFacturas" type="text" placeholder="Buscar un valor en la tabla">
    <button type="button" class="btn btn-info btn-sm"><span class="fa fa-refresh" onclick="actualizarTablaFacturas()"></span></button>
</div>
<div id="res_update_categoria" style="width: 100%; padding:0px;"></div>

<div class="table-responsive">
    <table class="table table-bordered" id="tablaFacturas">
        <thead class="">
            <tr>
                <th class="text-center"># Factura</th>
                <th class="text-center">Estado</th>
                <th class="text-center">Fecha</th>
                <th class="text-center">Cliente</th>
                <th class="text-center">Valor</th>
                <th class="text-center">Método Pago</th>
                <th class="text-center">Vendedor</th>                
                <th class="text-center" colspan="2">Detalle Pedido</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $facturas = ejecutarSQL::consultar("SELECT factura.id, factura.estado_factura, factura.fecha, cliente.nombre_completo AS 'CLIENTE', factura.total, factura.metodo_pago, usuarios.nombre_completo AS 'VENDEDOR' FROM factura JOIN cliente ON factura.id_cliente=cliente.id JOIN usuarios ON factura.id_vendedor=usuarios.id");
            while ($factura = mysqli_fetch_array($facturas)) {
                ?>
                <tr>
                    <td class="text-center"><?php echo $factura['id'] ?></td>
                    <td class="text-center"><?php echo $factura['estado_factura'] ?></td>
                    <td class="text-center"><?php echo $factura['fecha'] ?></td>
                    <td class="text-center"><?php echo $factura['CLIENTE'] ?></td>
                    <td class="text-center"><?php echo $factura['total'] ?></td>
                    <td class="text-center"><?php echo $factura['metodo_pago'] ?></td>
                    <td class="text-center"><?php echo $factura['VENDEDOR'] ?></td>
                    <td class="text-center"><button type="button" class="btn btn-info btn-sm ver_ped" value="<?php echo $factura['id']; ?>" data-toggle="modal" data-target="#verPedido"><span class="fa fa-eye"></span> Ver Detalle</button></td>
                    <td class="text-center"><a href='Vista/facturaPDF.php?id=<?php echo $factura['id'] ?>&hoja=carta' target='_blank' ><br><img src='Recursos/img/pdf.png' style='width: 25px' title='Factura PDF'></a></td>
                </tr>
                </form>
                </div>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>
<div class="modal fade" id="editarCategorias" tabindex="-2" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="padding: 20px;" data-dismiss="modal"></div>
<script>
    function actualizarTablaFacturas() {
        $('#tablaFacturasFull').load("Recursos/includes/tablaFacturas.php");
    }
    $(document).ready(function () {
        $("#myInputFacturas").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $("#tablaFacturas tr").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>