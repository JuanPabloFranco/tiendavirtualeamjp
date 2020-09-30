<?php
include '../Conexion/consulSQL.php';
$id = $_GET['id'];
$productoinfo = ejecutarSQL::consultar("SELECT producto.id, producto.nombre_prod, producto.marca, bodega.precio_venta, bodega.estado_prod_bodega, producto.descripcion_prod, categoria.nombre, producto.imagen, bodega.cantidad FROM producto, categoria, bodega WHERE bodega.id_producto=producto.id AND producto.id_categoria=categoria.id AND producto.id=$id");
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
                    <div class="modal-body center-all-contens text-center" style="width: 95%" > 
                        <img class = "img-responsive" src = "Recursos/img-products/<?php echo $fila['imagen'] ?>">
                        <?php
                        if ($fila['descripcion_prod'] <> "") {
                            echo '<h4>' . $fila['descripcion_prod'] . '</h4>';
                        }
                        ?>
                        <h4><strong>Precio: </strong>$<?php echo $fila['precio_venta'] ?></h4>
                        <h4><strong>Marca: </strong><?php echo $fila['marca'] ?></h4>                        
                        <h4><strong>Categoria: </strong><?php echo $fila['nombre'] ?></h4>
                        <h4><strong style="color: #2d4789">Producto <?php echo $fila['estado_prod_bodega'] ?></strong></h4>
                        <?php
                        if ($fila['estado_prod_bodega'] == "Disponible") {
                            ?>
                            <h4><strong>Cantidad disponible: </strong><?php echo $fila['cantidad'] ?></h4>
                            <?php
                        }
                        ?>
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