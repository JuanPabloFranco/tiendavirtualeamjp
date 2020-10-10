<?php

include '../Conexion/consulSQL.php';
sleep(1);
if ($_POST['funcion'] <> "") { // Verificar si la variable con el tipo de proceso es diferente de vacio
    // Se verifica el valor de la variable POST, cuando es igual al deseado realiza el proceso correspondiente
    if ($_POST['funcion'] == "facturar_pedido") {

        // Se obtienen los datos del formulario html por variables POST
        $fecha = $_POST['fecha'];
        $id_cliente = $_POST['id_cliente'];
        $metodo_pago = $_POST['metodo_pago'];
        $direccion_entrega = $_POST['direccion_entrega'];
        $id_vendedor = $_POST['id_vendedor'];
        $estado_factura = "En Verificación";
        $descuento = 0;
        $total = $_POST['total'];

        if (consultasSQL::InsertSQL("factura", "fecha, id_cliente, descuento, total, direccion_entrega, metodo_pago, estado_factura, cambio, id_vendedor", "'" . $fecha . "'," . $id_cliente . "," . $descuento . "," . $total . ",'" . $direccion_entrega . "','" . $metodo_pago . "','" . $estado_factura . "',0,$id_vendedor")) {
            /* recuperando el id de la factura actual */
            $sql = "SELECT id FROM factura WHERE fecha='" . $fecha . "' AND total=" . $total . " AND id_cliente=" . $id_cliente . " ORDER BY id DESC limit 1";
            $vecId = mysqli_fetch_row(ejecutarSQL::consultar($sql));
            if (isset($vecId) && $vecId[0] <> "") {
                $pedidos = ejecutarSQL::consultar("SELECT * FROM pedido_tmp WHERE id_cliente=$id_cliente"); //
                while ($pedido = mysqli_fetch_array($pedidos)) {
                    $datos = $vecId[0] . "," . $pedido['id_producto'] . "," . $pedido['cantidad'] . "," . $pedido['precio'];
                    if (consultasSQL::InsertSQL("pedido", "id_factura, id_producto, cantidad, precio", $datos)) {
                        consultasSQL::DeleteSQL("pedido_tmp", "id=" . $pedido['id']);
                    }
                }
                ?>
                <img src="Recursos/img/ok.png" class="center-all-contens"><br>Factura Realizada
                <a href='Vista/facturaPDF.php?id=<?php echo $vecId[0]?>&hoja=carta' target='_blank' ><br><img border='0px' src='Recursos/img/pdf.png' style='width: 40px' title='Factura PDF'></a>
                <?php
            } else {
                ?>
                <img src="Recursos/img/error.png" class="center-all-contens"><br>No fue posible leer el Id de la venta
                <?php
            }
        } else {
            ?>
            <img src="Recursos/img/error.png" class="center-all-contens"><br><p class="lead text-center">Error al crear la factura</p>';
            <?php
        }
    } else {
        ?>
        <img src="Recursos/img/error.png" class="center-all-contens"><br><p class="lead text-center">Error al leer de función ejecutada</p>';
        <?php
    }
} else {
    ?>
    <img src="Recursos/img/error.png" class="center-all-contens"><br><p class="lead text-center">Error función vacia</p>';
    <?php
}
?>