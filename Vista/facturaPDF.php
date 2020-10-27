<?php
ob_start();
$mes = date("m");
$año = date("Y");
include '../Conexion/consulSQL.php';
require '../Recursos/fpdf/plantillas/PDFCarta.php';
?><html>
    <body>
        <?php
        // Consulta para los datos de la empresa
        $sqlFactura = "SELECT factura.fecha, cliente.nit, cliente.nombre_completo, cliente.telefono, cliente.email, factura.total, factura.direccion_entrega, factura.metodo_pago, factura.descuento, factura.estado_factura FROM factura JOIN cliente ON factura.id_cliente=cliente.id AND factura.id=" . $_GET['id'];
        $vecFactura = mysqli_fetch_row(ejecutarSQL::consultar($sqlFactura));
        $sqlPedido = "SELECT pedido.cantidad, producto.nombre_prod, pedido.precio FROM pedido JOIN factura ON pedido.id_factura=factura.id JOIN producto ON pedido.id_producto=producto.id WHERE pedido.id_factura=" . $_GET['id'];
        $productos_factura = ejecutarSQL::consultar($sqlPedido);

        $pdf = new PDFCarta('P', 'mm', array(216, 280));

        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetMargins(10, 23, 23);

        $pdf->Ln(8);
        $pdf->SetFillColor(255, 255, 255);
        $pdf->RoundedRect(137, 28, 60, 20, 2, '12', 'DF'); //CUADRO FECHA Y NUM FACTURA
        $pdf->RoundedRect(26, 50, 171, 23, 2, '12', 'DF'); // CUADRO INFORMACION CLIENTE
        $pdf->RoundedRect(26, 72, 171, 10, 2, '0', 'DF'); // CUADRO CONDICIONES DE VENTA

        $pdf->SetTextColor(34, 79, 147);
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(17, 5, "", 0, 0, 'L');
        $pdf->Cell(60, 5, utf8_decode("Dirección: " . DIRECCION), 0, 0, 'L');
        $pdf->Ln(5);
        $pdf->Cell(17, 5, "", 0, 0, 'L');
        $pdf->Cell(60, 5, utf8_decode("Teléfonos: " . TELEFONOS), 0, 0, 'L');
        $pdf->Cell(50, 5, "", 0, 0, 'L');
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(50, 5, utf8_decode("FACTURA No. " . $_GET['id']), 0, 0, 'L');
        $pdf->Ln(5);
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(17, 5, "", 0, 0, 'L');
        $pdf->Cell(60, 5, utf8_decode("Email: " . EMAIL), 0, 0, 'L');
        $pdf->Ln(5);
        $pdf->Cell(17, 5, "", 0, 0, 'L');
        $pdf->Cell(60, 5, utf8_decode("Responsable de IVA"), 0, 0, 'L');
        $pdf->Cell(50, 5, "", 0, 0, 'L');
        $pdf->SetFont('Arial', 'B', 13);
        $pdf->Cell(50, 5, utf8_decode("Fecha: " . $vecFactura[0]), 0, 0, 'L');
        $pdf->Ln(10);
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(18, 5, "", 0, 0, 'L');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(100, 5, utf8_decode("Señor(es) "), 0, 0, 'L');
        $pdf->Cell(50, 5, utf8_decode("C.C. o Nit "), 0, 0, 'L');
        $pdf->Ln(5);
        $pdf->SetFont('Arial', '', 14);
        $pdf->Cell(18, 5, "", 0, 0, 'L');
        $pdf->SetTextColor(1, 1, 1);
        $pdf->Cell(100, 5, utf8_decode($vecFactura[2]), 0, 0, 'L');
        $pdf->Cell(50, 5, utf8_decode($vecFactura[1]), 0, 0, 'L');

        $pdf->Ln(6);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetTextColor(34, 79, 147);
        $pdf->Cell(18, 5, "", 0, 0, 'L');
        $pdf->Cell(100, 5, utf8_decode("Teléfono "), 0, 0, 'L');
        $pdf->Cell(50, 5, utf8_decode("Email "), 0, 0, 'L');
        $pdf->Ln(5);
        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(18, 5, "", 0, 0, 'L');
        $pdf->SetTextColor(1, 1, 1);
        $pdf->Cell(100, 5, utf8_decode($vecFactura[3]), 0, 0, 'L');
        $pdf->Cell(50, 5, utf8_decode($vecFactura[4]), 0, 0, 'L');

        $pdf->Ln(7);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetTextColor(34, 79, 147);
        $pdf->Cell(18, 5, "", 0, 0, 'L');
        $pdf->Cell(50, 5, utf8_decode("Condiciones de venta "), 0, 0, 'L');
        $pdf->Cell(30, 5, utf8_decode("Método de pago: "), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->SetTextColor(1, 1, 1);
        $pdf->Cell(40, 5, utf8_decode($vecFactura[7]), 0, 0, 'L');
        $pdf->SetTextColor(34, 79, 147);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(30, 5, utf8_decode("Descuento: "), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->SetTextColor(1, 1, 1);
        $pdf->Cell(40, 5, utf8_decode("$" . $vecFactura[8]), 0, 0, 'L');
        
        if($vecFactura[9]=="Anulada"){
            $pdf->RotatedImage('../Recursos/img/anulada.png', 30,170, 180, 40, 45);
        }

        $pdf->Ln(12);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetTextColor(34, 79, 147);
        $pdf->Cell(16, 5, "", 0, 0, 'L');
        $pdf->Cell(13, 5, utf8_decode("CANT"), 1, 0, 'C');
        $pdf->Cell(108, 5, utf8_decode("DESCRIPCIÓN"), 1, 0, 'C');
        $pdf->Cell(25, 5, utf8_decode("V UNITARIO"), 1, 0, 'C');
        $pdf->Cell(25, 5, utf8_decode("SUBTOTAL"), 1, 0, 'C');
        $total = 0;
        if ($productos_factura->num_rows > 0) { //si la variable tiene al menos 1 fila entonces seguimos con el codigo
            while ($rowP = $productos_factura->fetch_array(MYSQLI_ASSOC)) {
                $subtotal = $rowP['cantidad'] * $rowP['precio'];
                $pdf->Ln(5);
                $pdf->SetFont('Arial', '', 9);
                $pdf->SetTextColor(1, 1, 1);
                $pdf->Cell(16, 5, "", 0, 0, 'L');
                $pdf->Cell(13, 5, utf8_decode($rowP['cantidad']), 0, 0, 'C');
                $pdf->SetFont('Arial', '', 8);
                $pdf->Cell(108, 5, utf8_decode($rowP['nombre_prod']), 0, 0, 'L');
                $pdf->SetFont('Arial', '', 9);
                $pdf->Cell(25, 5, utf8_decode("$" . $rowP['precio']), 0, 0, 'R');
                $pdf->Cell(25, 5, utf8_decode("$" . $subtotal), 0, 0, 'R');
                $total = $total + $subtotal;
            }
        }
        $pdf->Ln(10);
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->SetTextColor(34, 79, 147);
        $pdf->Cell(140, 5, "", 0, 0, 'C');
        $pdf->Cell(20, 5, "TOTAL", 0, 0, 'R');
        $pdf->SetTextColor(1, 1, 1);
        $pdf->Cell(25, 5, utf8_decode("$".$total), 0, 0, 'C');















        $title = 'FACTURA DE COMPRA No. ' . utf8_decode($_GET['id']);
        $pdf->SetTitle($title);
        $pdf->SetAuthor($vecEmpresa[0]);
        $pdf->Output();
        ?>
    </body>
</html>
<?php
ob_end_flush();
?>
