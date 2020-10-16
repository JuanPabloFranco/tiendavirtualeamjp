<?php
include '../Conexion/consulSQL.php';
$id = $_GET['id'];
$sql = "SELECT factura.estado_factura FROM factura WHERE factura.id=$id ";
$vecId = mysqli_fetch_row(ejecutarSQL::consultar($sql));
?>
<div class="modal-dialog modal-lm">
    <div class="modal-content center-all-contens" id="change_factura">
        <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Actualizar Pedido No. <?php echo $_GET['id'] ?></h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body center-all-contens text-center" style="width: 95%">
            <form action="DAO/facturaDAO.php" method="post" role="form">            
                <div class="form-group">
                    <label>Elija una opción</label>
                    <select class="form-control" name="estadoFactura">                        
                        <?php
                        if ($vecId[0] == "En Verificación") {
                            ?>
                            <option value="En Proceso">En Proceso</option>
                            <option value="En Despacho">En Despacho</option>
                            <option value="Finalizada">Finalizada</option>
                            <option value="Anulada">Anulada</option>
                            <?php
                        }
                        if ($vecId[0] == "En Proceso") {
                            ?>
                            <option value="En Despacho">En Despacho</option>
                            <option value="Finalizada">Finalizada</option>
                            <option value="Anulada">Anulada</option>
                            <?php
                        }
                        if ($vecId[0] == "En Despacho") {
                            ?>
                            <option value="Finalizada">Finalizada</option>
                            <option value="Anulada">Anulada</option>
                            <?php
                        }
                        ?>                        
                    </select>
                </div>
                <p class="text-center"><button type="submit" class="btn btn-primary">Actualizar</button></p>
                <br>
                <input type="hidden" name="id_factura" value="<?php echo $_GET['id'] ?>">
                <input type="hidden" name="funcion"  value="actualizarFactura">
                <div id="respuesta_fact" style="width: 100%; text-align: center; margin: 0;"></div>
            </form>
        </div>
        <p class="text-center">
            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cerrar</button>
        </p>
    </div>
</div>
<script>
    $(document).ready(function () {
        // cambiar datos de la categoria
        //Metodo ajax que realiza la consulta de la clase DAO y la imprime en el div seleccionado
        //al hacer submit al formulario que se encuentra dentro del div  llamado buscar_prod
        $('#change_factura form').submit(function (e) {
            e.preventDefault();
            var informacion = $('#change_factura form').serialize();
            var metodo = $('#change_factura form').attr('method');
            var peticion = $('#change_factura form').attr('action');
            $.ajax({
                type: metodo,
                url: peticion,
                data: informacion,
                beforeSend: function () {
                    $("#respuesta_fact").html(
                            'Actualizando<br><img src="Recursos/img/enviando.gif" class="center-all-contens">'
                            );
                },
                error: function () {
                    $("#respuesta_fact").html("Ha ocurrido un error en el sistema");
                },
                success: function (data) {
                    $("#respuesta_fact").html(data);
                    $('#cambiarEstado').modal('hide'); // cerrar
                }
            });
            return false;
        });
    });
</script>