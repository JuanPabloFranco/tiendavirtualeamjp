<?php

include '../Conexion/consulSQL.php';
session_start();
sleep(2);
$nombre = $_POST['nombre-login'];
$clave = md5($_POST['clave-login']);
$radio = $_POST['optionsRadios'];

if (!$nombre == "" && !$clave == "") {
    if ($radio == "option1") {
        $verUser = mysqli_fetch_row(ejecutarSQL::consultar("SELECT nombre_completo, usuario, clave, id, direccion FROM cliente WHERE (usuario='$nombre' AND clave='$clave') OR (email='$nombre' AND clave='$clave')"));
        if (isset($verUser) && $verUser[0] <> "") {
            $_SESSION['nombreUser'] = $verUser[0];
            $_SESSION['nombreUsuario'] = $verUser[1];
            $_SESSION['claveUser'] = $verUser[2];
            $_SESSION['id_user'] = $verUser[3];
            $_SESSION['direccion'] = $verUser[4];
            $_SESSION['tipo'] = "Cliente";
             echo '<script> location.href="index.php"; </script>';
        } else {
            ?>
            <img src="Recursos/img/error.png" class="center-all-contens"><br>Error, nombre o contraseña invalido
            <p><h5 style="text-align: center">Si olvidaste tu contraseña escríbenos para restaurarla</h5></p>
            <a target="_blanck" href="https://api.whatsapp.com/send?phone=573146790840&text=Hola!&nbsp;quiero&nbsp;restaurar&nbsp;mi&nbsp;login&nbsp;en&nbsp;la&nbsp;página" title="Whatsapp" >
                <img src="Recursos/icons/whatsapp_108042.png" alt="Whatsapp" style="max-width: 10%">
            </a>
            <?php
        }
    }

    if ($radio == "option2" || $radio == "option3") {
        if($radio == "option2"){
            $tipo = "Vendedor";
        }else{
            $tipo = "Administrador";
        }
        $verAdmin = mysqli_fetch_row(ejecutarSQL::consultar("SELECT nombre_completo, Nombre, Clave, id, estado, tipo FROM usuarios WHERE Nombre='$nombre' AND Clave='$clave' AND tipo='$tipo'"));
        if (isset($verAdmin) && $verAdmin[0] <> "") {
            if ($verAdmin[4] == "Activo") {
                $_SESSION['nombreAdmin'] = $verAdmin[0];
                $_SESSION['nombreUsuario'] = $verAdmin[1];
                $_SESSION['claveAdmin'] = $verAdmin[2];
                $_SESSION['id_user'] = $verAdmin[3];
                $_SESSION['tipo'] = $verAdmin[5];
                echo '<script> location.href="index.php"; </script>';
            } else {
                echo '<img src="Recursos/img/error.png" class="center-all-contens"><br>Administrador Inactivo';
            }
        } else {
            echo '<img src="Recursos/img/error.png" class="center-all-contens"><br>Error... nombre, contraseña o tipo de usuario invalido';
        }
    }
} else {
    echo '<img src="Recursos/img/error.png" class="center-all-contens"><br>Error campo vacío<br>Intente nuevamente';
}