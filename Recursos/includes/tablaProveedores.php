<?php
include '../../Conexion/consulSQL.php';
include '../plantillas/datos.php';
?>
<div class="panel-heading text-center">
    <h3>Proveedores Registrados <small class="tittles-pages-logo"><?php echo EMPRESA . " " . NEMPRESA; ?></small></h3>
    <input class="form-control" id="myInputProveedor" type="text" placeholder="Buscar un valor en la tabla">
    <button type="button" class="btn btn-info btn-sm"><span class="fa fa-refresh" onclick="actualizarTablaProveedor()"></span></button>   
</div>
<div id="res_update_categoria" style="width: 100%; padding:0px;"></div>
<div class="table-responsive">
    <table class="table table-bordered" id="tablaProveedores">
        <thead class="">
            <tr>
                <th class="text-center">NIT</th>
                <th class="text-center">Nombre</th>
                <th class="text-center">Dirección</th>
                <th class="text-center">Telefono</th>
                <th class="text-center">Página web</th>
                <th class="text-center">Editar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $proveedores = ejecutarSQL::consultar("SELECT * FROM proveedor ORDER BY id ");
            $up = 1;
            while ($prov = mysqli_fetch_array($proveedores)) {
            ?>
                <div id="update-proveedor">
                    
                        <tr>
                            <td class="text-center"><?php echo $prov['nit'] ?></td>
                            <td class="text-center"><?php echo $prov['nombre_proveedor'] ?></td>
                            <td class="text-center"><?php echo $prov['direccion_proveedor'] ?></td>
                            <td class="text-center"><?php echo $prov['telefono_proveedor'] ?></td>
                            <td class="text-center"><?php echo $prov['pagina_web'] ?></td>
                            <td class="text-center"><button type="button" class="btn btn-info btn-sm editar_proveedor"
                             value="<?php echo $prov['id'] ?>" data-toggle="modal" data-target="#editarProveedor"><span class="fa fa-pencil"></span> Editar</button>
                            </td>
                        </tr>
                    </form>
                </div>
            <?php
                $up = $up + 1;
            }
            ?>
        </tbody>
        
    </table>
</div>
<div class="modal fade" id="editarProveedor" tabindex="-2" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="padding: 20px;" data-dismiss="modal"></div>
<script>
    function actualizarTablaProveedor() {
        $('#tablaProveedores').load("Recursos/includes/tablaProveedores.php");
    }
    $(document).ready(function () {     
        // Mostrar el modal editar bodega
        $('#editarProveedor').load("Vista/editar_proveedor.php");

        //enviar valor al modal editar bodega
        $(".editar_proveedor").click(function () { //      
            $('#editarProveedor').load("Vista/editar_proveedor.php?id=" + $(this).val());
        });

        $("#myInputProveedor").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $("#tablaProveedores tr").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>
