<?php
include '../../Conexion/consulSQL.php';
include '../plantillas/datos.php';
?>
<div class="panel-heading text-center">
    <h3>Domiciliarios Registrados <small class="tittles-pages-logo"><?php echo EMPRESA . " " . NEMPRESA; ?></small></h3>
</div>
<div class="table-responsive">
    <table class="table table-bordered">
        <thead class="">
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">Cédula o Nit</th>
                <th class="text-center">Nombre Completo</th>
                <th class="text-center">Estado</th>
                <th class="text-center">Foto</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $repartidor = ejecutarSQL::consultar("SELECT * FROM domiciliario ORDER BY nombre_repartidor");
            $cantRep = 0;
            $upp = 1;
            while ($repartidorRow = mysqli_fetch_array($repartidor)) {
                $cantRep = $cantRep + 1;
            ?>
                <div id="restaurar_cliente">
                    <tr style="text-align: center">
                        <td><?php echo $cantRep ?><input class="form-control" type="hidden" name="id" required="" value="<?php echo $repartidorRow['id'] ?>"></td>
                        <td><?php echo $repartidorRow['cedula_repartidor'] ?></td>
                        <td><?php echo $repartidorRow['nombre_repartidor'] ?></td>
                        <td><?php echo $repartidorRow['estado_repartidor'] ?></td>
                        <td><img src="Recursos/img-repartidor/<?php echo $repartidorRow['foto_repartidor'] ?>" style="width: 40px"></td>
                    </tr>
                </div>
            <?php
            }
            ?>
        </tbody>
        <script>
            $(document).ready(function () {
                $("#myInputProv").on("keyup", function () {
                    var value = $(this).val().toLowerCase();
                    $("#tablaProv tr").filter(function () {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });
            });
        </script>
    </table>
</div>