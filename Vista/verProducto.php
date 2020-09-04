<?php
include '../Conexion/consulSQL.php';
$id = $_GET['id'];
$productoinfo = ejecutarSQL::consultar("SELECT producto.id, producto.nombre_prod, producto.marca, producto.precio, producto.estado_prod, producto.descripcion_prod, categoria.nombre, producto.imagen FROM producto, categoria WHERE producto.id_categoria=categoria.id AND producto.id=$id");
?>
<div class="modal-dialog modal-lm">
    <div class="modal-content center-all-contens" id="divInscripcion">
        <form class="form-horizontal" method="post" name="rev_visitante" action="procesos/inscripcionEvento.php" id="rev_visitante">
            <div class="modal-content">
                <?php
                while ($fila = mysqli_fetch_array($productoinfo)) {
                    ?>
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel"><?php echo $fila['nombre_prod']; ?></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>                                                                    
                    </div>
                    <div class="modal-body center-all-contens" style="width: 90%"> 
                        <img class = "img-responsive" src = "Recursos/img-products/<?php echo $fila['imagen'] ?>">
                        <?php
                        if ($fila['descripcion_prod'] <> "") {
                            echo '<h4>' . $fila['descripcion_prod'] . '</h4>';
                        }
                        ?>
                        <h4><strong>Precio: </strong>$<?php echo $fila['precio'] ?></h4>
                        <h4><strong>Marca: </strong><?php echo $fila['marca'] ?></h4>                        
                        <h4><strong>Categoria: </strong><?php echo $fila['nombre'] ?></h4>
                        <h4><strong style="color: #2d4789">Producto <?php echo $fila['estado_prod'] ?></strong></h4>                       
                    </div> <br>
                    <?php
                }
                ?>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div> 
        </form>        
    </div>
</div>