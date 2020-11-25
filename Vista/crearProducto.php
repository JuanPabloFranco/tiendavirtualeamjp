<?php
include '../Conexion/consulSQL.php';
?>
<div class="modal-dialog modal-lm">
    <div class="modal-content center-all-contens" id="crear_producto">
        <div class="modal-header headerModal">
            <h4 class="modal-title" id="myModalLabel">Crear Producto</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body center-all-contens text-center" style="width: 95%" >
            <form role="form" action="DAO/productoDAO.php" method="post" enctype="multipart/form-data" id="formProd">
                <div class="form-group">
                    <label>Código de producto</label>
                    <input type="text" class="form-control" id="txtCodigo_prod" placeholder="Código" pattern="[0-9]{1,20}" required maxlength="40" name="codigo_prod">
                </div>
                <div class="form-group">
                    <label>Nombre de producto</label>
                    <input type="text" class="form-control" placeholder="Nombre" required maxlength="40" id="txtNombreProd" name="nombre_prod">
                </div>
                <div class="form-group">
                    <label>Categoría</label>
                    <select class="form-control" name="id_categoria" id="selCatProd">
                        <?php
                        $categoriac = ejecutarSQL::consultar("SELECT * FROM categoria");
                        while ($catec = mysqli_fetch_array($categoriac)) {
                            echo '<option value="' . $catec['codigo_categoria'] . '">' . $catec['nombre'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Precio Compra</label>
                    <input type="text" class="form-control" id="txtPrecioProd" placeholder="Precio" required maxlength="20" pattern="[0-9]{1,20}" name="precio">
                </div>
                <div class="form-group">
                    <label>Marca</label>
                    <input type="text" class="form-control" id="txtMarcaProd" placeholder="Marca" required maxlength="30" name="marca">
                </div>
                <div class="form-group">
                    <label>Proveedor</label>
                    <select class="form-control" name="id_proveedor" id="selProvProd">
                        <?php
                        $proveedoresc = ejecutarSQL::consultar("SELECT * FROM proveedor");
                        while ($provc = mysqli_fetch_array($proveedoresc)) {
                            echo '<option value="' . $provc['id'] . '">' . $provc['nombre_proveedor'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Descripción</label>
                    <textarea class="form-control" id="txtDescProd" placeholder="Agregue una descripción del producto" name="descripcion_prod"></textarea>
                </div>
                <div class="form-group">
                    <label>Imagen de producto</label>
                    <input type="file" name="img" id="fileImg">
                    <p class="help-block">Formato de imagenes admitido png, jpg, gif, jpeg</p>
                </div>
                <input type="text" style="display: none" name="funcion" value="crearProducto">
                <input type="hidden" name="id_admin" value="<?php echo $_GET['id'] ?>">
                <p class="text-center"><button type="submit" class="btn btn-success">Agregar producto</button></p>
                <div id="res-form-add" style="width: 100%; text-align: center; margin: 0;"></div>
            </form>
        </div>
        <div class="modal-footer">
            <p class="text-center">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cerrar</button>
            </p>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $("#formProd").on("submit", function (e) {
            e.preventDefault();
            var f = $(this);
            var formData = new FormData(document.getElementById("formProd"));
            formData.append("dato", "valor");
            var peticion = $('#formProd').attr('action');
            $.ajax({
                url: peticion,
                type: "post",
                dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $("#res-form-add").html(
                            'Creando<br><img src="Recursos/img/enviando.gif" class="center-all-contens">'
                            );
                },
                error: function () {
                    $("#res-form-add").html("Ha ocurrido un error en el sistema");
                },
                success: function (data) {
                    $("#res-form-add").html(data);
                    document.getElementById("txtCodigo_prod").value = "";
                    document.getElementById("txtNombreProd").value = "";
                    document.getElementById("txtPrecioProd").value = "";
                    document.getElementById("txtMarcaProd").value = "";
                    document.getElementById("txtDescProd").value = "";
                    document.getElementById("fileImg").value = "";
                }
            })
        });
    });
</script>