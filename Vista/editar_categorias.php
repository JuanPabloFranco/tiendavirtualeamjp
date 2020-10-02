<?php
include '../Conexion/consulSQL.php';
$id = $_GET['id'];
$CategoriasInfo = mysqli_fetch_row(ejecutarSQL::consultar("SELECT id,nombre,codigo_categoria,descripcion FROM categoria WHERE id=$id"));
?>
<div class="modal-dialog modal-lm">
    <div class="modal-content center-all-contens" id="update_Categorias">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Editar Categorias</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body center-all-contens text-center" style="width: 95%">
                <form action="DAO/categoriaDAO.php" method="post" role="form">
                    <div class="form-group">
                        <label>Codigo</label>
                        <input type="text" class="form-control" name="codigo_categoria"
                            value="<?php echo $CategoriasInfo[2]; ?>" readonly>
                        <input type="hidden" value="<?php echo $id ?>" name="id">
                        <input type="hidden" name="funcion" value="actualizarCategoria">
                    </div>
                    <div class="form-group">
                        <label>Nombre</label>
                        <input class="form-control" type="text" id="txtNombreCategorias" name="nombre"
                            placeholder="Nombre de la categoria" required="" value="<?php echo $CategoriasInfo[1]; ?>">
                    </div>
                    <div class="form-group">
                        <label>Descripción</label>
                        <input class="form-control" id="txtDescripcionCategorias" type="text" name="descripcion"
                            placeholder="Descripcion de la categoria" required=""
                            value="<?php echo $CategoriasInfo[3]; ?>">
                    </div>
                    <p class="text-center"><button type="submit" class="btn btn-primary">Actualizar</button></p>
                    <br>
                    <input type="text" name="funcion" style="display: none" value="actualizarCategoria">
                    <div id="respuesta_Categorias" style="width: 100%; text-align: center; margin: 0;"></div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    // cambiar datos de la categoria
    //Metodo ajax que realiza la consulta de la clase DAO y la imprime en el div seleccionado
    //al hacer submit al formulario que se encuentra dentro del div  llamado buscar_prod
    $('#update_Categorias form').submit(function(e) {
        e.preventDefault();
        var informacion = $('#update_Categorias form').serialize();
        var metodo = $('#update_Categorias form').attr('method');
        var peticion = $('#update_Categorias form').attr('action');
        $.ajax({
            type: metodo,
            url: peticion,
            data: informacion,
            beforeSend: function() {
                $("#respuesta_Categorias").html(
                    'Actualizando<br><img src="Recursos/img/enviando.gif" class="center-all-contens">'
                );
            },
            error: function() {
                $("#respuesta_Categorias").html("Ha ocurrido un error en el sistema");
            },
            success: function(data) {
                $("#respuesta_Categorias").html(data);
                $('#editarCategorias').modal('hide'); // cerrar
            }

        });
        return false;
    });
});
</script>