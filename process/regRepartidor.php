<html>    <head>        <title>Admin</title>        <meta charset="UTF-8">        <meta http-equiv="Refresh" content="12;url=../configAdmin.php">        <meta name="viewport" content="width=device-width, initial-scale=1">        <link rel="stylesheet" href="../css/font-awesome.min.css">        <link rel="stylesheet" href="../css/normalize.css">        <link rel="stylesheet" href="../css/bootstrap.min.css">        <link rel="stylesheet" href="../css/style.css">        <link rel="stylesheet" href="../css/media.css">        <link rel="Shortcut Icon" type="image/x-icon" href="../assets/icons/logo.ico" />        <script src="../js/jquery.min.js"></script>        <script src="../js/bootstrap.min.js"></script>        <script src="../js/autohidingnavbar.min.js"></script>    </head>    <body>        <section>            <div class="container">                <div class="row">                    <div class="col-xs-12 col-md-6 col-md-offset-3 text-center">                        <?php                        include '../library/consulSQL.php';                        sleep(1);                        $cedula_repartidor = $_POST['cedula_repartidor'];                        $nombre_repartidor = $_POST['nombre_repartidor'];                        if (!$cedula_repartidor == "" && !$nombre_repartidor == "" && $_FILES['foto_repartidor']['name'] <> "") {                            $verificar = ejecutarSQL::consultar("SELECT * FROM repartidor WHERE cedula_repartidor='" . $cedula_repartidor . "'");                            $verificaltotal = mysqli_num_rows($verificar);                            if ($verificaltotal <= 0) {                                if (move_uploaded_file($_FILES['foto_repartidor']['tmp_name'], "../assets/img-repartidor/" . $_FILES['foto_repartidor']['name'])) {                                    $sqlReg = "INSERT INTO repartidor (cedula_repartidor, nombre_repartidor, foto_repartidor, estado_repartidor) VALUES "                                            . "('" . $cedula_repartidor . "','" . $nombre_repartidor . "','" . $_FILES['foto_repartidor']['name'] . "','Activo')";                                    $resultado = ejecutarSQL::consultar($sqlReg);                                    if ($resultado) {                                        ?>                                        <img src="../assets/img/correctofull.png" style="width: 50%" class="center-all-contens">                                        <br>                                        <h3>El Repartidor se registró con éxito con éxito</h3>                                        <p class="lead text-cente">                                            La pagina se redireccionara automaticamente. Si no es asi haga click en el siguiente boton.<br>                                            <a href="../configAdmin.php" class="btn btn-primary btn-lg">Volver a administración</a>                                        </p>                                        <?php                                    } else {                                        echo '<img src="assets/img/incorrecto.png" class="center-all-contens"><br><p class="lead text-center">El nombre que ha ingresado ya existe.<br>Error al registrar el repartidor</p>';                                    }                                } else {                                    echo '<img src="assets/img/incorrecto.png" class="center-all-contens"><br><p class="lead text-center">No se pudo leer la foto<br></p>';                                }                            } else {                                echo '<img src="assets/img/incorrecto.png" class="center-all-contens"><br><p class="lead text-center">El repartidor ya existe<br></p>';                            }                        } else {                            echo '<img src="assets/img/incorrecto.png" class="center-all-contens"><br><p class="lead text-center">Error los campos no deben de estar vacíos</p>';                        }                        ?>                    </div>                </div>        </section>    </body></html>