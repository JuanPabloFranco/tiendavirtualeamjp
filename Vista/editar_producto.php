<?php
include '../Conexion/consulSQL.php';
$id = $_GET['id'];
$Producto = mysqli_fetch_row(ejecutarSQL::consultar("SELECT codigo_prod,nombre_prod,precio,marca,imagen,id_categoria,id_proveedor,descripcion_prod FROM producto WHERE id=$id"));
?>
<div class="modal-dialog modal-lm">
    <div class="modal-content center-all-contens" id="update_producto">
        <div class="modal-content">
            <div class="modal-header headerModal">
                <h4 class="modal-title" id="myModalLabel">Editar Producto</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body center-all-contens text-center" style="width: 95%">
                <form action="DAO/productoDAO.php" method="post" role="form">
                    <div class="form-group">
                        <label>Codigo del producto</label>
                        <input type="text" class="form-control" type="text" id="txtCodigoProducto" pattern="[0-9]{1,20}" name="codigo_prod" value="<?php echo $Producto[0]; ?>">
                        <input type="hidden" value="<?php echo $id ?>" name="id">
                        <input type="hidden" name="funcion" value="actualizarProducto">
                    </div>
                    <div class="form-group">
                        <label>Nombre</label>
                        <input class="form-control" type="text" id="txtNombreProducto" name="nombre_prod" placeholder="Nombre del Producto" required="" value="<?php echo $Producto[1]; ?>">
                    </div>
                    <div class="form-group">
                        <label>Precio</label>
                        <input class="form-control" type="text" id="txtPrecioProducto" name="precio" pattern="[0-9]{1,20}" placeholder="Precio del Producto" required="" value="<?php echo $Producto[2]; ?>">
                    </div>
                    <div class="form-group">
                        <label>Categoria</label>
                        <select class="form-control" name="id_categoria">
                            <option value="Sin Categoria">Elija una opción</option>
                            <?php
                            $categoriac2 = ejecutarSQL::consultar("SELECT * FROM categoria");
                            while ($catec2 = mysqli_fetch_array($categoriac2)) {
                                if ($catec2['id'] == $Producto[5]) {
                                    echo '<option selected="selected" value="' . $catec2['id'] . '">' . $catec2['nombre'] . '</option>';
                                } else {
                                    echo '<option value="' . $catec2['id'] . '">' . $catec2['nombre'] . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Marca</label>
                        <input class="form-control" type="text" id="txtMarcaProducto" name="marca"
                               placeholder="Marca del Producto" required="" value="<?php echo $Producto[3]; ?>">
                    </div>
                    <div class="form-group">
                        <label>Proveedor</label>
                        <select class="form-control" name="id_proveedor">
                            <option value="0">Elija una opción</option>
                            <?php
                            $proveedoresc2 = ejecutarSQL::consultar("SELECT id, nombre_proveedor FROM proveedor ");
                            while ($provc2 = mysqli_fetch_array($proveedoresc2)) {
                                if ($provc2['id'] == $Producto[6]) {
                                    echo '<option selected="selected" value="' . $provc2['id'] . '">' . $provc2['nombre_proveedor'] . '</option>';
                                } else {
                                    echo '<option value="' . $provc2['id'] . '">' . $provc2['nombre_proveedor'] . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Descripcion</label>
                        <input class="form-control" type="text" id="txtDescripcionProducto" name="descripcion_prod"
                               placeholder="Descripcion del producto" required="" value="<?php echo $Producto[7]; ?>">
                    </div>

                    <p class="text-center"><button type="submit" class="btn btn-primary">Actualizar</button></p>
                    <br>
                    <input type="text" name="funcion" style="display: none" value="actualizarProducto">
                    <div id="respuesta_producto" style="width: 100%; text-align: center; margin: 0;"></div>
                </form>
            </div>
            <div class="modal-footer">
                <p class="text-center">
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cerrar</button>
                </p>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        // cambiar los datos del producto
        //Metodo ajax que realiza la consulta de la clase DAO y la imprime en el div seleccionado
        //al hacer submit al formulario que se encuentra dentro del div llamado buscar_prod
        $('#update_producto form').submit(function (e) {
            e.preventDefault();
            var informacion = $('#update_producto form').serialize();
            var metodo = $('#update_producto form').attr('method');
            var peticion = $('#update_producto form').attr('action');
            $.ajax({
                type: metodo,
                url: peticion,
                data: informacion,
                beforeSend: function () {
                    $("#respuesta_producto").html(
                            'Actualizando<br><img src="Recursos/img/enviando.gif" class="center-all-contens">'
                            );
                },
                error: function () {
                    $("#respuesta_producto").html("Ha ocurrido un error en el sistema");
                },
                success: function (data) {
                    $("#respuesta_producto").html("Se actualizo con exito");
                    $('#editarProducto').modal('hide'); // cerrar
                }

            });
            return false;
        });
    });
</script>