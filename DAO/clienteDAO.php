<?php

if ($_POST['funcion'] <> "") {
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
                if (consultasSQL::InsertSQL("cliente", "nit, nombre_completo, direccion, telefono, email, usuario, clave", "'$nit','$nombre_completo','$direccion','$telefono','$email', '$usuario','$clave'")) {
                    echo '<img src="Recursos/img/ok.png" class="center-all-contens"><br>El registro se completo con éxito';
                } else {
                    echo '<img src="Recursos/img/error.png" class="center-all-contens"><br>Ha ocurrido un error.<br>Por favor informenos del error';
                }
            } else {
                echo '<img src="Recursos/img/error.png" class="center-all-contens"><br>El NIT o Cédula que ha ingresado ya esta registrado.<br>Por favor ingrese otro número';
            }
        } else {
            echo '<img src="Recursos/img/error.png" class="center-all-contens"><br>Error los campos no deben de estar vacíos';
        }
    }
    if ($_POST['funcion'] == "actualizarCliente") {
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
                echo '<img src="assets/img/ok.png" class="center-all-contens"><br>El registro se completo con éxito<script>
                    setTimeout(function () {
                        url = "editar_cliente.php";
                        $(location).attr("href", url);
                    }, 1000);
                </script>';
            } else {
                echo '<img src="Recursos/img/error.png" class="center-all-contens"><br>Ha ocurrido un error.<br>Por favor informenos del error';
            }
        } else {
            echo '<img src="Recursos/img/error.png" class="center-all-contens"><br>Error, los campos no deben de estar vacíos';
        }
    }
    if ($_POST['funcion'] == "inactivarCliente") {
        
    }
} else {
    echo '<img src="Recursos/img/incorrecto.png" class="center-all-contens"><br><p class="lead text-center">Error al leer de función ejecutada</p>';
}
?>
