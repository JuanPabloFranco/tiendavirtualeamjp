<?php
include '../../Conexion/consulSQL.php';
include '../plantillas/datos.php';
?>
<div class="panel-heading text-center"><h3>Proveedores Registrados <small class="tittles-pages-logo"><?php echo EMPRESA . " " . NEMPRESA; ?></small></h3><input class="form-control" id="myInputProv" type="text" placeholder="Buscar un valor en la tabla"></div>
<div class="table-responsive">
    <table class="table table-bordered" id="tablaProv">
        <thead class="">
            <tr>
                <th class="text-center">NIT</th>
                <th class="text-center">Nombre</th>
                <th class="text-center">Dirección</th>
                <th class="text-center">Telefono</th>
                <th class="text-center">Página web</th>
                <th class="text-center">Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $proveedores = ejecutarSQL::consultar("SELECT * FROM proveedor");
            $up = 1;
            while ($prov = mysqli_fetch_array($proveedores)) {
                ?>
            <div id="update-proveedor">
                <form method="post" action="DAO/proveedorDAO.php" id="res-update-prove-<?php echo $up ?>">
                    <tr>
                        <td>
                            <label style="display: none;
                                   "><?php echo $prov['nombre_proveedor'] ?></label>
                            <input class="form-control" type="hidden" name="id" required="" value="<?php echo $prov['id'] ?>">
                            <input class="form-control" type="text" name="nit" maxlength="30" required="" value="<?php echo $prov['nit'] ?>">
                        </td>
                        <td><input class="form-control" type="text" name="nombre_proveedor" maxlength="30" required="" value="<?php echo $prov['nombre_proveedor'] ?>"></td>
                        <td><input class="form-control" type="text-area" name="direccion_proveedor" required="" value="<?php echo $prov['direccion_proveedor'] ?>"></td>
                        <td><input class="form-control" type="tel" name="telefono_proveedor" required="" maxlength="20" value="<?php echo $prov['telefono_proveedor'] ?>"></td>
                        <td><input class="form-control" type="text-area" name="pagina_web" maxlength="30" required="" value="<?php echo $prov['pagina_web'] ?>"></td>
                        <td class="text-center">
                            <input type="text" name="funcion" style="display: none" value="actualizarProveedor">
                            <button type="submit" class="btn btn-sm btn-primary button-UP" value="res-update-prove-<?php echo $up ?>">Actualizar</button>
                            <div id="res-update-prove-<?php echo $up ?>" style="width: 100%;
                                 margin:0px;
                                 padding:0px;
                                 "></div>
                        </td>
                    </tr>
                </form>
            </div>
            <?php
            $up = $up + 1;
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