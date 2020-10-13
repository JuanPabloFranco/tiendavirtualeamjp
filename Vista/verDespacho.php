<?php
include '../Conexion/consulSQL.php';
$id = $_GET['id'];
$DespachoInfo = mysqli_fetch_row(ejecutarSQL::consultar("SELECT id,id_domiciliario,id_factura,recibe,estado_despacho,costo_domicilio FROM despacho WHERE id_factura=$id"));

if (empty($DespachoInfo)) {
?>
    <div class="modal-dialog modal-lm">
        <div class="modal-content center-all-contens" id="Add_despacho">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Registrar Despacho</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body center-all-contens text-center" style="width: 95%">
                    <form action="DAO/despachoDAO.php" method="post" role="form">
                        <div class="form-group">
                            <label>ID FACTURA</label>
                            <input type="text" class="form-control" name="id_factura" id="txtIdFacturaDespachoRegistrar" value="<?php echo $id ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Domiciliario</label>
                            <select class="form-control" name="id_domiciliario">
                                <?php
                                $Domiciliario = ejecutarSQL::consultar("SELECT * FROM domiciliario");
                                while ($buscar = mysqli_fetch_array($Domiciliario)) {
                                    echo '<option value="' . $buscar['id'] . '">' . $buscar['nombre_repartidor'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Costo de domicilio</label>
                            <select class="form-control" id="txtCostoDespachoRegistrar" name="costo_domicilio">
                                <?php
                                $costo = 0;
                                while ($costo <= 5000) {
                                    echo '<option value="' . $costo . '">$' . $costo . '</option>';
                                    $costo += 500;
                                }
                                ?>
                            </select>
                        </div>
                        <p class="text-center"><button type="submit" class="btn btn-primary">Registrar</button></p>
                        <br>
                        <input type="text" name="funcion" style="display: none" value="registrarDespacho">
                        <div id="respuesta_Despacho" style="width: 100%; text-align: center; margin: 0;"></div>
                    </form>
                </div>
                <p class="text-center">
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cerrar</button>
                </p>
            </div>
        </div>
    </div>

<?php
} else {   ?>

    <div class="modal-dialog modal-lm">
        <div class="modal-content center-all-contens" id="update_despacho">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Editar Despacho</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body center-all-contens text-center" style="width: 95%">
                    <form action="DAO/despachoDAO.php" method="post" role="form">
                        <div class="form-group">
                            <label>ID FACTURA</label>
                            <input type="text" class="form-control" name="id_factura" value="<?php echo $id ?>" readonly>
                            <input type="hidden" name="id" value="<?php echo $DespachoInfo[0] ?>">
                        </div>
                        <div class="form-group">
                            <label>Domiciliario</label>
                            <select class="form-control" name="id_domiciliario">
                                <?php
                                $Domiciliario = ejecutarSQL::consultar("SELECT * FROM domiciliario");
                                while ($buscar = mysqli_fetch_array($Domiciliario)) {
                                    if ($buscar['id'] == $DespachoInfo[1]) {
                                        echo '<option selected="selected" value="' . $buscar['id'] . '">' . $buscar['nombre_repartidor'] . '</option>';
                                    } else {
                                        echo '<option value="' . $buscar['id'] . '">' . $buscar['nombre_repartidor'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Estado de despacho</label>
                            <select class="form-control" name="estado_despacho">
                                <?php
                                if ($DespachoInfo[4] == "En Proceso") {
                                    echo '<option selected="selected" value="En Proceso">En Proceso</option>';
                                } else {
                                    echo '<option value="En Proceso">En Proceso</option>';
                                }
                                if ($DespachoInfo[4] == "Despachado") {
                                    echo '<option selected="selected" value="Despachado">Despachado</option>';
                                } else {
                                    echo '<option value="Despachado">Despachado</option>';
                                }
                                if ($DespachoInfo[4] == "Entregado") {
                                    echo '<option selected="selected" value="Entregado">Entregado</option>';
                                } else {
                                    echo '<option value="Entregado">Entregado</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Costo de domicilio</label>
                            <select class="form-control" name="costo_domicilio">
                                <?php
                                $costo = 0;
                                while ($costo <= 5000) {
                                    if ($costo == $DespachoInfo[5]) {
                                        echo '<option selected="selected" value="' . $costo . '">$' . $costo . '</option>';
                                    } else {
                                        echo '<option  value="' . $costo . '">$' . $costo . '</option>';
                                    }
                                    $costo += 500;
                                }
                                ?>
                            </select>
                        </div>
                        <p class="text-center"><button type="submit" class="btn btn-primary">Modificar</button></p>
                        <br>
                        <input type="text" name="funcion" style="display: none" value="actualizarDespacho">
                        <div id="respuesta_Despacho" style="width: 100%; text-align: center; margin: 0;"></div>
                    </form>
                </div>
                <p class="text-center">
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cerrar</button>
                </p>
            </div>
        </div>
    </div>
<?php
}
?>

<script>
    $(document).ready(function() {
        // cambiar datos de la categoria
        //Metodo ajax que realiza la consulta de la clase DAO y la imprime en el div seleccionado
        //al hacer submit al formulario que se encuentra dentro del div  llamado buscar_prod
        $('#Add_despacho form').submit(function(e) {
            e.preventDefault();
            var informacion = $('#Add_despacho form').serialize();
            var metodo = $('#Add_despacho form').attr('method');
            var peticion = $('#Add_despacho form').attr('action');
            $.ajax({
                type: metodo,
                url: peticion,
                data: informacion,
                beforeSend: function() {
                    $("#respuesta_Despacho").html(
                        'Actualizando<br><img src="Recursos/img/enviando.gif" class="center-all-contens">'
                    );
                },
                error: function() {
                    $("#respuesta_Despacho").html("Ha ocurrido un error en el sistema");
                },
                success: function(data) {
                    $("#respuesta_Despacho").html(data);
                    $('#Add_despacho').modal('hide'); // cerrar
                }

            });
            return false;
        });

        $('#update_despacho form').submit(function(e) {
            e.preventDefault();
            var informacion = $('#update_despacho form').serialize();
            var metodo = $('#update_despacho form').attr('method');
            var peticion = $('#update_despacho form').attr('action');
            $.ajax({
                type: metodo,
                url: peticion,
                data: informacion,
                beforeSend: function() {
                    $("#respuesta_Despacho").html(
                        'Actualizando<br><img src="Recursos/img/enviando.gif" class="center-all-contens">'
                    );
                },
                error: function() {
                    $("#respuesta_Despacho").html("Ha ocurrido un error en el sistema");
                },
                success: function(data) {
                    $("#respuesta_Despacho").html(data);
                    $('#update_despacho').modal('hide'); // cerrar
                }

            });
            return false;
        });
    });
</script>