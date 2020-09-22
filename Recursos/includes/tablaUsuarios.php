<?php
include '../../Conexion/consulSQL.php';
include '../plantillas/datos.php';
?>
<div class = "panel-heading text-center"><h3>Usuarios Registrados <small class="tittles-pages-logo"><?php echo EMPRESA . " " . NEMPRESA; ?></small></h3></div>
<div class = "table-responsive">
    <table class = "table table-bordered" >
        <thead class = "">
            <tr>
                <th class = "text-center">#</th>
                <th class = "text-center">Cédula o Nit</th>
                <th class = "text-center">Nombre Completo</th>
                <th class = "text-center">Estado</th>
                <th class = "text-center">Tipo de Usuario</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $vendedor = ejecutarSQL::consultar("SELECT * FROM usuarios ORDER BY nombre_completo");
            $cantVendedor = 0;
            $upp = 1;
            while ($vendedorRow = mysqli_fetch_array($vendedor)) {
                $cantVendedor = $cantVendedor + 1;
                ?>
            <div id="listar_vendededores">
                <tr style="text-align: center">
                    <td><?php echo $cantVendedor ?><input class="form-control" type="hidden" name="id" required="" value="<?php echo $repartidorRow['id'] ?>"></td>                                                    
                    <td><?php echo $vendedorRow['nombre_completo'] ?></td>
                    <td><?php echo $vendedorRow['Nombre'] ?></td>
                    <td><?php echo $vendedorRow['estado'] ?></td>
                    <td><?php echo $vendedorRow['tipo'] ?></td>
                </tr>
            </div>
            <?php
        }
        ?>
        </tbody>
    </table>
</div>