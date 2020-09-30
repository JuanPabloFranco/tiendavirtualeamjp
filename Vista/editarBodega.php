<?php
include '../Conexion/consulSQL.php';
$id = $_GET['id'];
$bodegaInfo = mysqli_fetch_row(ejecutarSQL::consultar("SELECT nombre_prod, minimo, precio_venta, estado_prod_bodega FROM producto JOIN bodega ON bodega.id_producto=producto.id WHERE bodega.id=$id"));
?>
<div class="modal-dialog modal-lm">
    <div class="modal-content center-all-contens" id="update_bodega">       
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Editar Bodega</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>                                                                    
            </div>
            <div class="modal-body center-all-contens text-center" style="width: 95%" >
                <form action="DAO/bodegaDAO.php" method="post" role="form">
                    <div class="form-group">
                        <label>Producto</label>
                        <input type="text" class="form-control" value="<?php echo $bodegaInfo[0]; ?>" readonly>
                        <input type="hidden" value="<?php echo $id ?>" name="id">
                        <input type="hidden" name="funcion" value="changeProductoBodega">
                    </div>
                    <div class="form-group">
                        <label>Cantidad Mínima</label>
                        <input class="form-control" type="number" id="txtCantidadMinProductoBodega" min="1" name="minimo" placeholder="Cantidad minima en bodega" required="" value="<?php echo $bodegaInfo[1]; ?>">
                    </div>
                    <div class="form-group">
                        <label>Precio Venta $</label>
                        <input class="form-control" id="txtPrecioVentaProducto" type="number" min="0" name="precio_venta" placeholder="Precio de Venta" required="" value="<?php echo $bodegaInfo[2]; ?>">
                    </div>
                    <p class="text-center"><button type="submit" class="btn btn-primary">Actualizar</button></p>
                    <br>
                    <input type="text" name="funcion" style="display: none" value="changeProductoBodega">
                    <div id="respuesta_bodega" style="width: 100%; text-align: center; margin: 0;"></div>
                </form>
            </div>                
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>     
    </div>
</div>
<script>
    $(document).ready(function () {
        // cambiar cantidad de producto en bodega
        //Metodo ajax que realiza la consulta de la clase DAO y la imprime en el div seleccionado
        //al hacer submit al formulario que se encuentra dentro del div llamado buscar_prod
        $('#update_bodega form').submit(function (e) {
            e.preventDefault();
            var informacion = $('#update_bodega form').serialize();
            var metodo = $('#update_bodega form').attr('method');
            var peticion = $('#update_bodega form').attr('action');
            $.ajax({
                type: metodo,
                url: peticion,
                data: informacion,
                beforeSend: function () {
                    $("#respuesta_bodega").html('Actualizando<br><img src="Recursos/img/enviando.gif" class="center-all-contens">');
                },
                error: function () {
                    $("#respuesta_bodega").html("Ha ocurrido un error en el sistema");
                },
                success: function (data) {
                    $("#respuesta_bodega").html(data);
                    $('#editarBodega').modal('hide'); // cerrar
                }

            });
            return false;
        });
    });
</script>