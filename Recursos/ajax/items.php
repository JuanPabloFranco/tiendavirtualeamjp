<?php
$action = (isset($_REQUEST['action']) && $_REQUEST['action'] != NULL) ? $_REQUEST['action'] : '';
$id = (isset($_REQUEST['id']) && $_REQUEST['id'] != NULL) ? $_REQUEST['id'] : '';
if ($action == 'ajax') {
    /* Connect To Database */
    include '../../Conexion/consulSQL.php';

    if (isset($id) && $id <> "") {
        $queryPedido = ejecutarSQL::consultar("SELECT pedido_tmp.id, producto.nombre_prod, pedido_tmp.cantidad, bodega.precio_venta FROM pedido_tmp JOIN producto ON pedido_tmp.id_producto=producto.id JOIN bodega ON bodega.id_producto=producto.id WHERE id_cliente=$id");
        $items = 1;
        $suma = 0;
        while ($rowPedido = $queryPedido->fetch_array(MYSQLI_ASSOC)) {
            $total = $rowPedido['cantidad'] * $rowPedido['precio_venta'];
            $tipo = "Pasadia";
            ?>
            <tr>
                <td class='text-center'><?php echo $items; ?></td>
                <td><?php echo $rowPedido['nombre_prod']?></td>
                <td class='text-center'><?php echo $rowPedido['cantidad']; ?></td>
                <td class='text-right'>$<?php echo $rowPedido['precio_venta']; ?></td>
                <td class='text-right'>$<?php echo $total; ?></td>
                <td class='text-right'><a href="#" onclick="eliminar_item('<?php echo $rowPedido['id'] . "," . $tipo; ?>')" ><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAMAAAAoLQ9TAAAAeFBMVEUAAADnTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDx+VWpeAAAAJ3RSTlMAAQIFCAkPERQYGi40TVRVVlhZaHR8g4WPl5qdtb7Hys7R19rr7e97kMnEAAAAaklEQVQYV7XOSQKCMBQE0UpQwfkrSJwCKmDf/4YuVOIF7F29VQOA897xs50k1aknmnmfPRfvWptdBjOz29Vs46B6aFx/cEBIEAEIamhWc3EcIRKXhQj/hX47nGvt7x8o07ETANP2210OvABwcxH233o1TgAAAABJRU5ErkJggg=="></a></td>
            </tr>	
            <?php
            $items++;
            $suma += $total;
        }        
        ?>
        <tr>
            <td colspan='4' class='text-right'>
                TOTAL
            </td>
            <th class='text-right'>
                <?php
                if (isset($suma)) {
                    echo "$" . $suma;
                };
                ?>
            </th>
            <td></td>
        </tr>
        <script>
            document.getElementById("txtTotal").value = "<?php echo $suma; ?>";
        </script>
        <?php
    }
}