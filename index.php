<!DOCTYPE html>
<?php
include './Conexion/consulSQL.php';
include './Recursos/plantillas/datos.php';
$fecha = date("Y") . "-" . date("m") . "-" . date("d");
?>
<html lang="es">
    <head>
        <link rel="shortcut icon" type="image/x-icon" href="Recursos/icons/logo_eam.ico" />
        <?php include './Recursos/plantillas/link.php'; ?>
    </head>
    <body id="container-page-index">
        <div id="areaNav">
            <?php include 'Recursos/plantillas/navbar.php'; ?>
        </div>
        <?php
        if (isset($_GET['page'])) {
            include "Vista/" . $_GET['page'] . ".php";
        } else {
            include 'Vista/inicio.php';
        }
        ?>
        <div id="divNotificacion1"></div>
    </body> 
    <script>
        $(document).ready(function () {
            setInterval(
                function () {
                    $('#divNotificacion1').load("Recursos/includes/notificacion.php");
                }, 40000
            );
        });
    </script>
    <?php
    include './Recursos/plantillas/footer.php';
    ?>
</html>