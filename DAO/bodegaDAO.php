<?php
session_start();
include '../Conexion/consulSQL.php';
sleep(1);
/** */
if ($_POST['funcion'] <> "") { // Verificar si la variable con el tipo de proceso es diferente de vacio
    // Se verifica el valor de la variable POST, cuando es igual al deseado realiza el proceso correspondiente
    if ($_POST['funcion'] == "agregar_a_bodega") {  //Registrar producto en bodeba
        // Se obtienen los datos del formulario html por variables POST
        $idProducto = $_POST['id_producto'];
        $cantidadProducto = $_POST['cantidad'];
        $cantidadMinima = $_POST['minimo'];
        $precioVenta = $_POST['precio_venta'];
        //Se verifica que las variables a guardar no esten vacias
        if (!$cantidadProducto == "" && !$cantidadMinima == "" && !$precioVenta == "") {
            // Se verifica si ya existe el producto en bodega, 
            $verificar = ejecutarSQL::consultar("SELECT * FROM bodega WHERE id_producto=" . $idProducto . "");
            $verificaltotal = mysqli_num_rows($verificar);
            if ($verificaltotal <= 0) { // En caso de no existir el producto en bodega se procede a registrar
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
    

    if ($_POST['funcion'] == "UpdateProductoBodega") {// Actualizar cantidad minima y precio de venta
        // Se obtienen los datos del formulario html por variables POST
        $idProducto = $_POST['id'];
        $precioVenta= $_POST['precio_venta'];
        $minimo = $_POST['minimo'];
        $cantidadProducto=$_POST['cantidad'];
        // Se ejecuta la consulta para actualizar 
        if (consultasSQL::UpdateSQL("bodega","minimo=$minimo,precio_venta=$precioVenta","id=$idProducto")) {
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
    if ($_POST['funcion'] == "changeCantidadBodega") { // Sumar productos en bodega
        // Se obtienen los datos del formulario html por variables POST
        $idBodega= $_POST['idBodega'];
        $cantidadProducto=$_POST['cantidad'];
        //Se obtiene la cantidad actual en bodega del producto
        $consulta = ejecutarSQL::consultar("SELECT cantidad FROM bodega where id=". $idBodega ."");
        $extraido= mysqli_fetch_array($consulta);
        //Se suma la cantidad actual con la cantidad ingresada
        $cantidadProducto+=$extraido['cantidad'];
        // Se actualiza la cantidad en base de datos
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
