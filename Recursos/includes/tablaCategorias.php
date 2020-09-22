<?php
include '../../Conexion/consulSQL.php';
include '../plantillas/datos.php';
?>
<div class="panel-heading text-center"><h3>Categorias Registradas <small class="tittles-pages-logo"><?php echo EMPRESA . " " . NEMPRESA; ?></small></h3><input class="form-control" id="myInputCat" type="text" placeholder="Buscar un valor en la tabla"></div>
<div class="table-responsive" >
    <table class="table table-bordered" id="tablaCat">
        <thead class="">
            <tr>
                <th class="text-center">Código</th>
                <th class="text-center">Nombre</th>
                <th class="text-center">Descripción</th>
                <th class="text-center">Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $categorias = ejecutarSQL::consultar("select * from categoria");
            $ui = 1;
            while ($cate = mysqli_fetch_array($categorias)) {
                ?>
            <div id="update-category">
                <form method="post" action="DAO/categoriaDAO.php" id="res-update-category-<?php echo $ui ?>">
                    <tr>
                        <td>
                            <label style="display: none;
                                   "><?php echo $cate['nombre'] ?></label>
                            <input class="form-control" type="hidden" name="id" maxlength="9" required="" value="<?php echo $cate['id'] ?>">
                            <input class="form-control" type="text" name="codigo_categoria" maxlength="9" required="" value="<?php echo $cate['codigo_categoria'] ?>">
                        </td>
                        <td><input class="form-control" type="text" name="nombre" maxlength="30" required="" value="<?php echo $cate['nombre'] ?>"></td>
                        <td><input class="form-control" type="text-area" name="descripcion" required="" value="<?php echo $cate['descripcion'] ?>"></td>
                        <td class="text-center">
                            <input type="text" name="funcion" style="display: none" value="actualizarCategoria">
                            <button type="submit" class="btn btn-sm btn-primary button-UC" value="res-update-category-<?php echo $ui ?>">Actualizar</button>
                            <div id="res-update-category-<?php echo $ui ?>" style="width: 100%;
                                 margin:0px;
                                 padding:0px;
                                 "></div>
                        </td>

                    </tr>
                </form>
            </div>
            <?php
            $ui = $ui + 1;
        }
        ?>
        </tbody>
        <script>
            $(document).ready(function () {
                $("#myInputCat").on("keyup", function () {
                    var value = $(this).val().toLowerCase();
                    $("#tablaCat tr").filter(function () {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });
            });
        </script>
    </table>
</div>

