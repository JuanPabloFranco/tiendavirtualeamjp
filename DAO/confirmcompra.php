<?phpsession_start();include '../Conexion/consulSQL.php';include '../Recursos/plantillas/datos.php';$num = $_POST['clien-number'];if ($num == 'notlog') {    $nombreUsuario = $_POST['nombreUsuario'];    $claveUser = md5($_POST['claveUser']);}if ($num == 'log') {    $nombreUsuario = $_POST['nombreUsuario'];    $claveUser = $_POST['claveUser'];}$direccion_venta = $_POST['direccion_venta'];$cambio = $_POST['cambio'];$metodo_pago = $_POST['metodo_pago'];$descuento = 0;$iva = IVA;sleep(1);$verdata = ejecutarSQL::consultar("SELECT id, nombre_completo, usuario, clave FROM cliente WHERE (clave='" . $claveUser . "' and usuario='" . $nombreUsuario . "') OR (clave='" . $claveUser . "' and email='" . $nombreUsuario . "')");$vec = mysqli_fetch_row($verdata);if (isset($vec) && $vec[0] <> "" && $direccion_venta <> "") {    if (isset($_SESSION['sumaTotal']) && $_SESSION['sumaTotal'] > 0) {        if ($metodo_pago == "Efectivo") {            if ($cambio >= $_SESSION['sumaTotal']) {                $estado_factura = "En Verificación";                ini_set('date.timezone', 'America/Bogota');                /* Insertando datos en tabla venta */                $timestamp = date("Y-m-d H:i:s");                consultasSQL::InsertSQL("factura", "fecha, id_cliente, descuento, total, direccion_entrega, metodo_pago, estado_factura, cambio, id_vendedor, iva_factura", "'" . date('Y-m-d') . "'," . $vec[0] . "," . $descuento . "," . $_SESSION['sumaTotal'] . ",'" . $direccion_venta . "','" . $metodo_pago . "','" . $estado_factura . "',$cambio,0,$iva");                /* recuperando el número del pedido actual */                $verId = ejecutarSQL::consultar("SELECT id FROM factura WHERE fecha='" . date('Y-m-d') . "' AND total=" . $_SESSION['sumaTotal'] . " AND id_cliente=" . $vec[0] . " ORDER BY id DESC limit 1");                $vecId = mysqli_fetch_row($verId);                if (isset($vecId) && $vecId[0] <> "") {                    $_SESSION['nombreUser'] = $vec[1];                    $_SESSION['nombreUsuario'] = $vec[2];                    $_SESSION['claveUser'] = $vec[3];                    $_SESSION['id_user'] = $vec[0];                    $_SESSION['tipo'] = "";                    $_SESSION['nombreAdmin'] = "";                    foreach ($_SESSION['producto'] as $key => $producto) { //Se recorre el carrito                        consultasSQL::InsertSQL("pedido", "id_factura, id_producto, cantidad, precio", $vecId[0] . "," . $producto['id'] . "," . $producto['cantidad'] . "," . $producto['precio']);                    }                    /* Vaciando el carrito */                    unset($_SESSION['producto']);                    $total = $_SESSION['sumaTotal'];                    unset($_SESSION['sumaTotal']);                    ?>                    <img src="Recursos/img/ok.png" class="center-all-contens"><br>El pedido se ha realizado con éxito                    <script>                        setTimeout(function () {                            url = "index.php?page=pedido";                            $(location).attr("href", url);                        }, 3000);                    </script>                    <?php                } else {                    ?>                    <img src="Recursos/img/error.png" class="center-all-contens"><br>No fue posible leer el Id de la venta                    <?php                }            } else {                ?>                <img src="Recursos/img/error.png" class="center-all-contens"><br>El valor del cambio debe ser mayor o igual al valor de la compra                <?php            }        } else {            $estado_factura = "En Verificación";            ini_set('date.timezone', 'America/Bogota');            /* Insertando datos en tabla venta */            $timestamp = date("Y-m-d H:i:s");            consultasSQL::InsertSQL("factura", "fecha, id_cliente, descuento, total, direccion_entrega, metodo_pago, estado_factura, cambio, id_vendedor, iva_factura", "'" . date('Y-m-d') . "'," . $vec[0] . "," . $descuento . "," . $_SESSION['sumaTotal'] . ",'" . $direccion_venta . "','" . $metodo_pago . "','" . $estado_factura . "',$cambio,0,$iva");            /* recuperando el número del pedido actual */            $verId = ejecutarSQL::consultar("SELECT id FROM factura WHERE fecha='" . date('Y-m-d') . "' AND total=" . $_SESSION['sumaTotal'] . " AND id_cliente=" . $vec[0] . " ORDER BY id DESC limit 1");            $vecId = mysqli_fetch_row($verId);            if (isset($vecId) && $vecId[0] <> "") {                $_SESSION['nombreUser'] = $vec[1];                $_SESSION['nombreUsuario'] = $vec[2];                $_SESSION['claveUser'] = $vec[3];                $_SESSION['id_user'] = $vec[0];                $_SESSION['tipo'] = "";                $_SESSION['nombreAdmin'] = "";                foreach ($_SESSION['producto'] as $key => $producto) { //Se recorre el carrito                    consultasSQL::InsertSQL("pedido", "id_factura, id_producto, cantidad, precio", $vecId[0] . "," . $producto['id'] . "," . $producto['cantidad'] . "," . $producto['precio']);                }                /* Vaciando el carrito */                unset($_SESSION['producto']);                $total = $_SESSION['sumaTotal'];                unset($_SESSION['sumaTotal']);                ?>                <img src="Recursos/img/ok.png" class="center-all-contens"><br>El pedido se ha realizado con éxito                <script>                    setTimeout(function () {                        url = "index.php?page=pedido";                        $(location).attr("href", url);                    }, 3000);                </script>                <?php            } else {                ?>                <img src="Recursos/img/error.png" class="center-all-contens"><br>No fue posible leer el Id de la venta                <?php            }        }    } else {        ?>        <img src="Recursos/img/error.png" class="center-all-contens"><br>El Carrito de Compras se encuentra vacio        <?php    }} else {    ?>    <script type="text/javascript" src="../Recursos/js/admin.js"></script>    <!--<img src="assets/img/error.png" class="center-all-contens"><br>-->    El nombre o contraseña invalidos    <p><h5 style="text-align: center">Si olvidaste tu contraseña escríbenos para restaurarla haciendo clic aquí</h5></p>    <a target="_blanck" href="https://api.whatsapp.com/send?phone=57<?php echo WP; ?>&text=Hola!&nbsp;quiero&nbsp;restaurar&nbsp;mi&nbsp;login&nbsp;en&nbsp;la&nbsp;página" title="Whatsapp" >        <img src="Recursos/icons/whatsapp_108042.png" alt="Whatsapp" style="max-width: 10%">    </a>    <?php}