<?php
session_start();
include '../Conexion/consulSQL.php';
sleep(1);

if ($_POST['funcion'] <> "") { // Verificar si la variable con el tipo de proceso es diferente de vacio
    // Se verifica el valor de la variable POST, cuando es igual al deseado realiza el proceso correspondiente
    if ($_POST['funcion'] == "crearCliente") {
        $nit = $_POST['nit'];
        $nombre_completo = $_POST['nombre_completo'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];
        $email = $_POST['email'];
        $usuario = $_POST['usuario'];
        $clave = md5($_POST['clave']);

        if (!$nit == "" && !$nombre_completo == "" && !$direccion == "" && !$telefono == "" && !$email == "" && !$usuario == "" && !$clave == "") {
            $verificar = ejecutarSQL::consultar("SELECT * FROM cliente WHERE nit='" . $nit . "'");
            $verificaltotal = mysqli_num_rows($verificar);
            if ($verificaltotal <= 0) {
                if (consultasSQL::InsertSQL("cliente", "nit, nombre_completo, direccion, telefono, email, usuario, clave", "'$nit','$nombre_completo','$direccion','$telefono','$email', '$usuario','$clave'")) {//            
                    ?>
                    <img src="Recursos/img/ok.png" class="center-all-contens"><br>El registro se completo con éxito
                    <script>
                        limpiarCamposCliente();
                    </script>
                    <?php
                } else {
                    ?>
                    <img src="Recursos/img/error.png" class="center-all-contens"><br>Ha ocurrido un error.<br>Por favor informenos del error
                    <?php
                }
            } else {
                ?>
                <img src="Recursos/img/error.png" class="center-all-contens"><br>El NIT o Cédula que ha ingresado ya esta registrado.<br>Por favor ingrese otro número
                <?php
            }
        } else {
            ?>
            <img src="Recursos/img/error.png" class="center-all-contens"><br>Error los campos no deben de estar vacíos
            <?php
        }
    }

    if ($_POST['funcion'] == "editarCliente") {
        $id = $_POST['id'];
        $nit = $_POST['nit'];
        $nombre_completo = $_POST['nombre_completo'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];
        $email = $_POST['email'];
        $usuario = $_POST['usuario'];
        $clave = md5($_POST['clave']);

        if (!$nit == "" && !$nombre_completo == "" && !$direccion == "" && !$telefono == "" && !$email == "" && !$usuario == "" && !$clave == "") {
            $verificar = ejecutarSQL::consultar("UPDATE cliente SET nit='" . $nit . "', nombre_completo='" . $nombre_completo . "',direccion='" . $direccion . "',telefono='" . $telefono . "',email='" . $email . "',usuario='" . $usuario . "',clave='" . $clave . "' WHERE id=" . $id);
            if ($verificar) {
                ?>
                <img src="Recursos/img/ok.png" class="center-all-contens"><br>El registro se completo con éxito
                <script>
                    setTimeout(function () {
                        url = "index.php?page=editar_cliente";
                        $(location).attr("href", url);
                    }, 1000);
                </script>
                <?php
            } else {
                ?>
                <img src="Recursos/img/error.png" class="center-all-contens"><br>Ha ocurrido un error.<br>Por favor informenos del error
                <?php
            }
        } else {
            ?>
            <img src="Recursos/img/error.png" class="center-all-contens"><br>Error, los campos no deben de estar vacíos
            <?php
        }
    }
    if ($_POST['funcion'] == "inf_cliente") {
        $id = $_POST['id'];
        $vec = mysqli_fetch_row(ejecutarSQL::consultar("SELECT nit, telefono, email FROM cliente WHERE id=" . $id));
        ?>
        <script>
            document.getElementById("doc_id").innerHTML = <?php echo $vec[0]; ?>;
        </script>
        <?php
    }
    if ($_POST['funcion'] == "restaurar") {
        $id = $_POST['id'];
        if(consultasSQL::UpdateSQL("cliente", "cliente.clave=cliente.nit", "id=$id")) {
            ?>
            <img src="Recursos/img/ok.png" class="center-all-contens"><br>Se actualizo la contraseña al documento con éxito
            <?php
        } else {
            ?>
            <img src="Recursos/img/incorrecto.png" class="center-all-contens"><br>Error al restaurar la contraseña
            <?php
        }
    }
} else {
    ?>
    <img src="Recursos/img/incorrecto.png" class="center-all-contens"><br><p class="lead text-center">Error al leer de función ejecutada</p>
    <?php
}   