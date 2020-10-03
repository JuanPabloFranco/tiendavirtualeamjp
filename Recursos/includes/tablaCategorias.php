<?php
include '../../Conexion/consulSQL.php';
include '../plantillas/datos.php';
?>
<div class="panel-heading text-center">
    <h3>Categorias Registradas <small class="tittles-pages-logo"><?php echo EMPRESA . " " . NEMPRESA; ?></small></h3>
    <input class="form-control" id="myInputCategorias" type="text" placeholder="Buscar un valor en la tabla">
    <button type="button" class="btn btn-info btn-sm"><span class="fa fa-refresh" onclick="actualizarTablaCategoria()"></span></button>
</div>
<div id="res_update_categoria" style="width: 100%; padding:0px;"></div>

<div class="table-responsive">
    <table class="table table-bordered" id="tablaCategoriasFull">
        <thead class="">
            <tr>
                <th class="text-center">Código</th>
                <th class="text-center">Nombre</th>
                <th class="text-center">Descripción</th>
                <th class="text-center">Editar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $categorias = ejecutarSQL::consultar("select * from categoria ORDER BY id");
            $ui = 1;
            while ($cate = mysqli_fetch_array($categorias)) {
            ?>
                <tr>
                    <td class="text-center"><?php echo $cate['codigo_categoria'] ?></td>
                    <td class="text-center"><?php echo $cate['nombre'] ?></td>
                    <td class="text-center"><?php echo $cate['descripcion'] ?></td>
                    <td class="text-center"><button type="button" class="btn btn-info btn-sm editar_Categorias" value="<?php echo $cate['id'] ?>" data-toggle="modal" data-target="#editarCategorias"><span class="fa fa-pencil"></span> Editar</button>
                </tr>
                </form>
</div>
<?php
                $ui = $ui + 1;
            }
?>
</tbody>
</table>
</div>
<div class="modal fade" id="editarCategorias" tabindex="-2" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="padding: 20px;" data-dismiss="modal"></div>
<script>
    function actualizarTablaCategoria() {
        $('#tablaCategoriasFull').load("Recursos/includes/tablaCategorias.php");
    }
    $(document).ready(function() {
        // Mostrar el modal editar bodega
        $('#editarCategorias').load("Vista/editar_categorias.php");

        //enviar valor al modal editar bodega
        $(".editar_Categorias").click(function() { //      
            $('#editarCategorias').load("Vista/editar_categorias.php?id=" + $(this).val());
        });

        $("#myInputCategorias").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#tablaCategoriasFull tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>