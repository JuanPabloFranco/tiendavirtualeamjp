<?php//error_reporting(E_PARSE);include '../Conexion/consulSQL.php';session_start();$suma = 0;if (isset($_POST['funcion']) && ($_POST['funcion'] == "agregarCarrito")) {    $idProducto = $_POST['id'];    $cantidad = $_POST['cantidad'];    $cant = 0;    $change = 0; // Variable para identificar si se cambio cantidad//    Inicialmente se recorre el carrito verificando si el producto ya se encuentra en el carrito    if (isset($_SESSION['producto'])) { // Si existe carrito        $cant = count($_SESSION['producto']);        foreach ($_SESSION['producto'] as $key => $producto) { //Se recorre el carrito            if ($producto['id'] == $_POST['id']) {// Si el Id de la posicion actual es igual al registrado                //Se crea un nuevo producto                $producto = array('id' => $producto['id'], 'nombre' => $producto['nombre'], 'cantidad' => ($producto['cantidad'] + $cantidad), 'precio' => $producto['precio']);                //Se ingresa el producto nuevo en la posicion del anterior producto cambiando la cantidad                $_SESSION['producto'][$key] = $producto;                $change++;                $break;            }        }    }    if ($change == 0) { // Si no se ha cambiado la cantidad de un producto        $sql = "SELECT nombre_prod, precio_venta FROM producto JOIN bodega ON bodega.id_producto=producto.id WHERE id_producto=" . $_POST['id'];        $vec = mysqli_fetch_row(ejecutarSQL::consultar($sql));        $nombre = $vec[0]; // Se almacena el nombre en una variable        $precio = $vec[1]; // Se almacena el precio en una variable        //Se crea un producto        $prod = array('id' => $idProducto, 'nombre' => $nombre, 'cantidad' => $cantidad, 'precio' => $precio);        if (isset($_SESSION['producto'])) {// Si existe productos en el carrito            //Se almacena el producto nuevo en una posicion consecutiva            $_SESSION['producto'][count($_SESSION['producto'])] = $prod;        } else {            //Se almacena el producto en la primera posicion            $_SESSION['producto'][0] = $prod;        }    }}if (isset($_POST['funcion']) && ($_POST['funcion'] == "eliminarCarrito")) {    }?><div class="caption">    <table class="table table-bordered" style="color: white">        <tr style='text-align: center'><td>PRODUCTO</td><td>CANTIDAD</td><td>PRECIO</td><td>SUBTOTAL</td></tr>        <?php        if (isset($_SESSION['producto'])) {            foreach ($_SESSION['producto'] as $key => $producto) {                ?>                <tr style='text-align: center'><td><?php echo $producto['nombre'] ?></td><td><?php echo $producto['cantidad'] ?></td><td>$<?php echo $producto['precio'] ?></td>                    <td>$<?php echo $producto['precio'] * $producto['cantidad']; ?></td>                                    </tr>                <?php                $suma += ($producto['precio'] * $producto['cantidad']);            }        }        $_SESSION['sumaTotal'] = $suma;        ?>        <tr style='text-align: center'><td colspan='3' >TOTAL</td><td>$<?php echo $suma; ?> + Domicilio</td></tr>            </table><br><br>El valor del domicilio oscila entre $0 y $5000 según de la distancia</div><script>        $('#carrito-compras-tienda').load("DAO/carritoDAO.php");</script>