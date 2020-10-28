<?php
include '../../Conexion/consulSQL.php';
include '../plantillas/datos.php';
?>
<div class="panel-heading text-center">
    <h3>Productos en bodega <small class="tittles-pages-logo"><?php echo EMPRESA . " " . NEMPRESA; ?></small></h3>    
    <input class="form-control" id="myInputBodega" type="text" placeholder="Buscar un valor en la tabla">
    <button type="button" class="btn btn-info btn-sm"><span class="fa fa-refresh" onclick="actualizarTablaBodega()"></span></button>    
</div>
<div id="res_update_bodega" style="width: 100%; padding:0px;"></div>

<div class="table-responsive" >    
    <table class="table table-bordered" id="tablaBodega">
        <thead class="">
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">Código Producto</th>
                <th class="text-center">Nombre Producto</th>
                <th class="text-center">Marca</th>
                <th class="text-center">Proveedor</th>
                <th class="text-center">Categoria</th>
                <th class="text-center">Cant Bodega</th>
                <th class="text-center">Cant Mínima</th>
                <th class="text-center">Precio Venta</th>
                <th class="text-center">Editar</th>
            </tr>
        </thead>
        <tbody>                
            <?php
            $sqlProdBodega = ejecutarSQL::consultar("SELECT B.id_producto,P.nombre_prod,P.codigo_prod,P.marca,PRO.nombre_proveedor,C.nombre,"
                            . "B.cantidad,B.minimo,B.precio_venta,B.estado_prod_bodega,B.id FROM producto P JOIN proveedor PRO ON P.id_proveedor=PRO.id
                                                                 JOIN bodega B ON B.id_producto=P.id JOIN categoria C ON P.id_categoria=C.id ORDER BY B.id ");
            $cantVendedor = 0;
            $contPB = 1;
            while ($prodBodega = mysqli_fetch_array($sqlProdBodega)) {
                $color = "white";
                if ($prodBodega['cantidad'] <= $prodBodega['minimo']) {
                    $color = "Rgb(255,0,0,0.4)";
                }
                if ($prodBodega['estado_prod_bodega'] == "Agotado") {
                    $color = "red";
                }
                ?>
            <div>
                    <tr style="background-color: <?php echo $color ?>">
                    <td class="text-center"><?php echo $contPB; ?> </td>
                    <td class="text-center"><?php echo $prodBodega['codigo_prod'] ?></td>
                    <td class="text-center"><?php echo $prodBodega['nombre_prod'] ?></td>
                    <td class="text-center"><?php echo $prodBodega['marca'] ?></td>
                    <td class="text-center"><?php echo $prodBodega['nombre_proveedor'] ?></td>
                    <td class="text-center"><?php echo $prodBodega['nombre'] ?></td>
                    <td class="text-center"><?php echo $prodBodega['cantidad'] ?></td>
                    <td class="text-center"><?php echo $prodBodega['minimo'] ?></td>
                    <td class="text-center">$<?php echo $prodBodega['precio_venta'] ?></td>
                    <td class="text-center"><button type="button" class="btn btn-info btn-sm editar_bodega" value="<?php echo $prodBodega['id']; ?>" data-toggle="modal" data-target="#editarBodega"><span class="fa fa-pencil"></span> Editar</button>
                    </td>
                </tr>
            </div>
            <?php
            $contPB = $contPB + 1;
        }
        ?>
        </tbody>        
    </table>    
</div>
<div class="modal fade" id="editarBodega" tabindex="-2" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="padding: 20px;" data-dismiss="modal"></div>
<script>
    function actualizarTablaBodega() {
        $('#tablaBodega').load("Recursos/includes/tablaBodega.php");
    }
    $(document).ready(function () {     
        // Mostrar el modal editar bodega
        $('#editarBodega').load("Vista/editarBodega.php");

        //enviar valor al modal editar bodega
        $(".editar_bodega").click(function () { //      
            $('#editarBodega').load("Vista/editarBodega.php?id=" + $(this).val());
        });

        $("#myInputBodega").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $("#tablaBodega tr").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>