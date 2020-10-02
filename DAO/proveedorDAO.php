<?php
session_start();
include '../Conexion/consulSQL.php';
sleep(1);

if ($_POST['funcion'] <> "") { // Verificar si la variable con el tipo de proceso es diferente de vacio
    // Se verifica el valor de la variable POST, cuando es igual al deseado realiza el proceso correspondiente
    if ($_POST['funcion'] == "crearProveedor") {
        // Se obtienen los datos del formulario html por variables POST
        $nitProve = $_POST['prove-nit'];
        $nameProve = $_POST['prove-name'];
        $dirProve = $_POST['prove-dir'];
        $telProve = $_POST['prove-tel'];
        $webProve = $_POST['prove-web'];

        if (!$nitProve == "" && !$nameProve == "" && !$dirProve == "" && !$telProve == "" && !$webProve == "") {
            $verificar = ejecutarSQL::consultar("select * from proveedor where NIT='" . $nitProve . "'");
            $verificaltotal = mysqli_num_rows($verificar);
            if ($verificaltotal <= 0) {

                if (consultasSQL::InsertSQL("proveedor", "NIT, 	nombre_proveedor, direccion_proveedor, telefono_proveedor, pagina_web", "'$nitProve','$nameProve','$dirProve','$telProve','$webProve'")) {
                    ?>
                    <img src="Recursos/img/correcto.png" class="center-all-contens"><br><p class="lead text-center">Proveedor añadido éxitosamente</p>
                    <script>                        
                        $(document).ready(function () {
                            $('#tablaProveedores').load("Recursos/includes/tablaProveedores.php");
                        });
                        limpiarCamposRegProveedor();
                    </script>
                    <?php
                } else {
                    ?>
                    <img src="Recursos/img/incorrecto.png" class="center-all-contens"><br><p class="lead text-center">Ha ocurrido un error.<br>Por favor intente nuevamente</p>                    
                    <?php
                }
            } else {
                ?>
                <img src="Recursos/img/incorrecto.png" class="center-all-contens"><br><p class="lead text-center">El número de NIT que ha ingresado ya existe.<br>Por favor ingrese otro número de NIT</p>
                
                <?php
            }
        } else {
            echo '<img src="Recursos/img/incorrecto.png" class="center-all-contens"><br><p class="lead text-center">Error los campos no deben de estar vacíos</p>';
        }
    }
    if ($_POST['funcion'] == "actualizarProveedor") {
        // Se obtienen los datos del formulario html por variables POST
        $id = $_POST['id'];
        $nit = $_POST['nit'];
        $nombre_proveedor = $_POST['nombre_proveedor'];
        $direccion_proveedor = $_POST['direccion_proveedor'];
        $telefono_proveedor = $_POST['telefono_proveedor'];
        $pagina_web = $_POST['pagina_web'];
        // Se realiza la consulta de actualizacion de proveedor
        if (consultasSQL::UpdateSQL("proveedor", "nit='$nit',nombre_proveedor='$nombre_proveedor',direccion_proveedor='$direccion_proveedor',telefono_proveedor='$telefono_proveedor',	pagina_web='$pagina_web'", "id='$id'")) {
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

