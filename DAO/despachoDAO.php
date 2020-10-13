<?php
include '../Conexion/consulSQL.php';

if ($_POST['funcion'] <> "") { // Verificar si la variable con el tipo de proceso es diferente de vacio
    // Se verifica el valor de la variable POST, cuando es igual al deseado realiza el proceso correspondiente
    if ($_POST['funcion'] == "registrarDespacho") { // Funcion para registrar un despacho de pedido

        // Se obtienen los datos del formulario html por variables POST
        $idFactura = $_POST['id_factura'];
        $idDomiciliario = $_POST['id_domiciliario'];
        $costoDomicilio = $_POST['costo_domicilio'];
        //Se verifica que las variables a guardar no esten vacias
        if (!$idFactura == "" && !$idDomiciliario == "" && !$costoDomicilio == "") {
            //Se verifica si ya existe una categoria con el codigo ingresado
            $sqlReg = "INSERT INTO despacho (id,id_domiciliario,id_factura,recibe,estado_despacho,costo_domicilio) VALUES "
                . "(null," . $idDomiciliario . "," . $idFactura . ",'No entregado','En proceso'," . $costoDomicilio . ")";
            $resultado = ejecutarSQL::consultar($sqlReg);
            //Se realiza la consulta de registro de categoria
            if ($resultado) {
?>
                <img src="Recursos/img/correcto.png" class="center-all-contens"><br>
                <p class="lead text-center">Despacho añadido éxitosamente</p>
                <script>
                    $(document).ready(function() {
                        $('#tablaPedidos').load("Recursos/includes/tablaPedidos.php");
                    });
                </script>
            <?php
            } else {
                echo '<img src="Recursos/img/incorrecto.png" class="center-all-contens"><br><p class="lead text-center">Ha ocurrido un error.<br>Por favor intente nuevamente</p>';
            }
        } else {
            echo '<img src="Recursos/img/incorrecto.png" class="center-all-contens"><br><p class="lead text-center">Error los campos no deben de estar vacíos</p>';
        }
    }

    if ($_POST['funcion'] == "actualizarDespacho") {
        // Se obtienen los datos del formulario html por variables POST
        $idFactura = $_POST['id_factura'];
        $idDomiciliario = $_POST['id_domiciliario'];
        $Estado = $_POST['estado_despacho'];
        $costoDomicilio = $_POST['costo_domicilio'];
        $id = $_POST['id'];
        $recibeDomicilio = "No Entregado";
        if ($Estado == 'Entregado') {
            $recibeDomicilio = "Entregado";
        }
        // Se realiza la consulta de actualizacion de proveedor
        $sqlReg = "UPDATE despacho SET id_domiciliario=".$idDomiciliario.",estado_despacho='".$Estado."',costo_domicilio=".$costoDomicilio.",recibe='".$recibeDomicilio."' WHERE id=".$id;
        $resultado = ejecutarSQL::consultar($sqlReg);
        if ($resultado) {
            ?>
            <br>
            <img class="center-all-contens" style="width: 20%" src="Recursos/img/Check.png">
            <p><strong>Hecho</strong></p>
        <?php
        } else {
        ?>
            <br>
            <img class="center-all-contens" style="width: 20%" src="Recursos/img/cancel.png">
            <p><strong>Error</strong></p>
<?php
        }
    }
} else {
    echo '<img src="recursos/img/incorrecto.png" class="center-all-contens"><br><p class="lead text-center">Error al leer de función ejecutada</p>';
}
?>