<?php
session_start();
include '../Conexion/consulSQL.php';
sleep(1);
/** */
if ($_POST['funcion'] <> "") {
    if ($_POST['funcion'] == "agregar_a_bodega") {
        $idProducto = $_POST['id_producto'];
        $cantidadProducto = $_POST['cantidad'];
        $cantidadMinima = $_POST['minimo'];
        $precioVenta = $_POST['precio_venta'];

        if (!$cantidadProducto == "" && !$cantidadMinima == "" && !$precioVenta == "") {
            $verificar = ejecutarSQL::consultar("select * from bodega where id_producto=" . $idProducto . "");
            $verificaltotal = mysqli_num_rows($verificar);
            if ($verificaltotal <= 0) {
                if (consultasSQL::InsertSQL("bodega", "id_producto,cantidad,minimo,precio_venta,estado_prod_bodega","$idProducto,$cantidadProducto,$cantidadMinima,$precioVenta,'Disponible'")) {
                    echo '<img src="Recursos/img/correcto.png" class="center-all-contens"><br><p class="lead text-center">El producto se ha añadido éxitosamente a la bodega</p>';
                } else {
                    echo '<img src="Recursos/img/incorrecto.png" class="center-all-contens"><br><p class="lead text-center">Ha ocurrido un error.<br>Por favor intente nuevamente</p>';
                }
            } else {
                echo '<img src="Recursos/img/incorrecto.png" class="center-all-contens"><br><p class="lead text-center">El código que ha ingresado ya existe.<br>Por favor ingrese otro código</p>';
            }
        } else {
            echo '<img src="Recursos/img/incorrecto.png" class="center-all-contens"><br><p class="lead text-center">Error los campos no deben de estar vacíos</p>';
        }
    }
    

    if ($_POST['funcion'] == "changeProductoBodega") {
        $idBodega = $_POST['id'];
        $precioVenta= $_POST['precio_venta'];
        $minimo = $_POST['minimo'];

        if (consultasSQL::UpdateSQL("bodega","minimo=$minimo,precio_venta=$precioVenta","id=$idBodega")) {
            ?>
            <br>
            <img class="center-all-contens" style="width: 20%" src="Recursos/img/Check.png">
            <p><strong>Actualizado</strong></p>
            <p class="text-center">
            <?php
        } else {
            ?>
            <br>
            <img class="center-all-contens" style="width: 20%" src="Recursos/img/cancel.png">
            <p><strong>Error</strong></p>
            <p class="text-center">
            <?php
        }
    }
    if ($_POST['funcion'] == "changeCantidadBodega") {
        $idBodega= $_POST['idBodega'];
        $cantidadProducto=$_POST['cantidad'];
        $consulta = ejecutarSQL::consultar("select cantidad from bodega where id=". $idBodega ."");
        $extraido= mysqli_fetch_array($consulta);
        $cantidadProducto+=$extraido['cantidad'];
        if (consultasSQL::UpdateSQL("bodega","cantidad=$cantidadProducto","id=$idBodega")) {
            ?>
            <br>
            <img class="center-all-contens" style="width: 20%" src="Recursos/img/Check.png">
            <p><strong>Actualizado</strong></p>
            <p class="text-center">
            <?php
        } else {
            ?>
            <br>
            <img class="center-all-contens" style="width: 20%" src="Recursos/img/cancel.png">
            <p><strong>Error</strong></p>
            <p class="text-center">
            <?php
        }
    }
} else {
    echo '<img src="Recursos/img/incorrecto.png" class="center-all-contens"><br><p class="lead text-center">Error al leer de función ejecutada</p>';
}
?>
