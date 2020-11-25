<?php
include '../../Conexion/consulSQL.php';
include '../plantillas/datos.php';
?>
<div class="panel-heading text-center">
    <h3>Productos Registrados</h3>
    <input class="form-control" id="myInputProducto" type="text" placeholder="Buscar un valor en la tabla">
    <button type="button" class="btn btn-info btn-sm"><span class="fa fa-refresh" onclick="actualizarTablaProducto();">Actualizar</span></button>
</div>
<div class="table-responsive">
    <table class="table table-bordered" id="tablaProductos">
        <thead class="">
            <tr>
                <th class="text-center" style="width: 60px">Imagen</th>
                <th class="text-center">Código</th>
                <th class="text-center">Nombre</th>
                <th class="text-center">Categoría</th>
                <th class="text-center">Precio</th>
                <th class="text-center">Marca</th>
                <th class="text-center">Proveedor</th>
                <th class="text-center">Descripción</th>
                <th class="text-center">Editar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $productos = ejecutarSQL::consultar("select P.imagen,P.id,P.codigo_prod,P.nombre_prod,P.precio,P.marca,P.descripcion_prod,PRO.nombre_proveedor,C.nombre 
            FROM producto P JOIN proveedor PRO ON P.id_proveedor=PRO.id JOIN categoria C ON P.id_categoria=C.id ORDER BY P.id DESC LIMIT 100");
            $upr = 1;
            while ($prod = mysqli_fetch_array($productos)) {
            ?>
                <tr>
                    <td><img src="Recursos/img-products/<?php echo $prod['imagen'] ?>" style="max-width: 80px; text-align: center"></td>
                    <td class="text-center"><?php echo $prod['codigo_prod'] ?></td>
                    <td class="text-center"><?php echo $prod['nombre_prod'] ?></td>
                    <td class="text-center"><?php echo $prod['nombre'] ?></td>
                    <td class="text-center"><?php echo $prod['precio'] ?></td>
                    <td class="text-center"><?php echo $prod['marca'] ?></td>
                    <td class="text-center"><?php echo $prod['nombre_proveedor'] ?></td>
                    <td class="text-center"><?php echo $prod['descripcion_prod'] ?></td>
                    <td class="text-center"><button type="button" class="btn btn-info btn-sm editar_producto" value="<?php echo $prod['id']; ?>" data-toggle="modal" data-target="#editarProducto"><span class="fa fa-pencil"></span> Editar</button>
                    </td>
                </tr>
            <?php
                $upr = $upr + 1;
            }
            ?>
        </tbody>
    </table>
</div>

<div class="modal fade" id="editarProducto" tabindex="-2" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="padding: 20px;" data-dismiss="modal"></div>
<script>
    function actualizarTablaProducto() {
        $('#tablaProductos').load("Recursos/includes/tablaProductos.php");
    }
    $(document).ready(function() {
        // Mostrar el modal editar bodega
        $('#editarProducto').load("Vista/editar_producto.php");

        //enviar valor al modal editar bodega
        $(".editar_producto").click(function() { //      
            $('#editarProducto').load("Vista/editar_producto.php?id=" + $(this).val());
        });

        $("#myInputProducto").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#tablaProductos tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>