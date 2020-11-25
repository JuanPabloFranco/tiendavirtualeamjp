<?php
include '../Conexion/consulSQL.php';
$id = $_GET['id'];
$Proveedor = mysqli_fetch_row(ejecutarSQL::consultar("SELECT id,nit,nombre_proveedor,direccion_proveedor,telefono_proveedor,pagina_web FROM proveedor WHERE id=$id"));
?>
<div class="modal-dialog modal-lm">
    <div class="modal-content center-all-contens" id="update-proveedor">       
        <div class="modal-content">
            <div class="modal-header headerModal">
                <h4 class="modal-title" id="myModalLabel">Editar Proveedor</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>                                                                    
            </div>
            <div class="modal-body center-all-contens text-center" style="width: 95%" >
                <form action="DAO/proveedorDAO.php" method="post" role="form">
                    <div class="form-group">
                        <label>NIT</label>
                        <input type="text" class="form-control" name="nit" value="<?php echo $Proveedor[1]; ?>">
                        <input type="hidden" value="<?php echo $id ?>" name="id">
                        <input type="hidden" name="funcion" value="actualizarProveedor">
                    </div>
                    <div class="form-group">
                        <label>Nombre</label>
                        <input class="form-control" type="text" id="txtNombreProveedor" name="nombre_proveedor" placeholder="Nombre del proveedor" required="" value="<?php echo $Proveedor[2]; ?>">
                    </div>
                    <div class="form-group">
                        <label>Direccion</label>
                        <input class="form-control" type="text" id="txtDireccionProveedor"  name="direccion_proveedor" placeholder="Telefono del proveedor" required="" value="<?php echo $Proveedor[3]; ?>">
                    </div>
                    <div class="form-group">
                        <label>Telefono</label>
                        <input class="form-control" type="text" id="txtTelefonoProveedor" pattern="[0-9]{1,20}" name="telefono_proveedor" placeholder="Ingrese la pagina web" required="" value="<?php echo $Proveedor[4]; ?>">
                    </div>
                    <div class="form-group">
                        <label>Pagina web</label>
                        <input class="form-control" type="text" id="txtTelefonoProveedor"  name="pagina_web" placeholder="Ingrese la pagina web" required="" value="<?php echo $Proveedor[5]; ?>">
                    </div>
                    <p class="text-center"><button type="submit" class="btn btn-primary">Actualizar</button></p>
                    <br>
                    <input type="text" name="funcion" style="display: none" value="actualizarProveedor">
                    <div id="respuesta_proveedor" style="width: 100%; text-align: center; margin: 0;"></div>
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
        // cambiar cantidad de producto en bodega
        //Metodo ajax que realiza la consulta de la clase DAO y la imprime en el div seleccionado
        //al hacer submit al formulario que se encuentra dentro del div llamado buscar_prod
        $('#update-proveedor form').submit(function (e) {
            e.preventDefault();
            var informacion = $('#update-proveedor form').serialize();
            var metodo = $('#update-proveedor form').attr('method');
            var peticion = $('#update-proveedor form').attr('action');
            $.ajax({
                type: metodo,
                url: peticion,
                data: informacion,
                beforeSend: function () {
                    $("#respuesta_proveedor").html('Actualizando<br><img src="Recursos/img/enviando.gif" class="center-all-contens">');
                },
                error: function () {
                    $("#respuesta_proveedor").html("Ha ocurrido un error en el sistema");
                },
                success: function (data) {
                    $("#respuesta_proveedor").html(data);
                    $('#editarProveedor').modal('hide'); // cerrar
                }

            });
            return false;
        });
    });
</script>