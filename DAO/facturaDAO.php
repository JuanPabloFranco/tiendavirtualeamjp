<?php

if ($_POST['funcion'] <> "") {
    if ($_POST['funcion'] == "") {
        
    } else {
        echo '<img src="recursos/img/incorrecto.png" class="center-all-contens"><br><p class="lead text-center">Error al leer el tipo de función</p>';
    }
} else {
    echo '<img src="recursos/img/incorrecto.png" class="center-all-contens"><br><p class="lead text-center">Error al leer de función ejecutada</p>';
}
?>