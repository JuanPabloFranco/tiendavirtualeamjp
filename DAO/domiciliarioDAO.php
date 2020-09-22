 <?php
    include '../Conexion/consulSQL.php';
    sleep(1);

    if ($_POST['funcion'] <> "") { // Verificar si la variable con el tipo de proceso es diferente de vacio
        // Se verifica el valor de la variable POST, cuando es igual al deseado realiza el proceso correspondiente
        if ($_POST['funcion'] == "crearDomiciliario") { // Funcion para registrar un domiciliario

    ?>
         <html>

         <head>
             <title>Admin</title>
             <meta charset="UTF-8">
             <meta http-equiv="Refresh" content="4;url=../index.php?page=configAdmin">
             <meta name="viewport" content="width=device-width, initial-scale=1">
             <link rel="stylesheet" href="../Recursos/css/font-awesome.min.css">
             <link rel="stylesheet" href="../Recursos/css/normalize.css">
             <link rel="stylesheet" href="../Recursos/css/bootstrap.min.css">
             <link rel="stylesheet" href="../Recursos/css/style.css">
             <link rel="stylesheet" href="../Recursos/css/media.css">
             <link rel="Shortcut Icon" type="image/x-icon" href="../Recursos/assets/icons/logo.ico" />
             <script src="../Recursos/js/jquery.min.js"></script>
             <script src="../Recursos/js/bootstrap.min.js"></script>
             <script src="../Recursos/js/autohidingnavbar.min.js"></script>
         </head>

         <body>
             <section>
                 <div class="container">
                     <div class="row">
                         <div class="col-xs-12 col-md-6 col-md-offset-3 text-center">
                             <?php
                                sleep(1);
                                // Se obtienen los datos del formulario html por variables POST
                                $cedula_repartidor = $_POST['cedula_repartidor'];
                                $nombre_repartidor = $_POST['nombre_repartidor'];
                                //Se verifica que las variables a guardar no esten vacias
                                if (!$cedula_repartidor == "" && !$nombre_repartidor == "" && $_FILES['foto_repartidor']['name'] <> "") {
                                    // Se verifica si existe el repartidor en base de datos
                                    $verificar = ejecutarSQL::consultar("SELECT * FROM domiciliario D WHERE D.cedula_repartidor='" . $cedula_repartidor . "'");
                                    $verificaltotal = mysqli_num_rows($verificar);
                                    if ($verificaltotal <= 0) { //Si no existe se ingresa al proceso de registro
                                        // Se mueve la foto del domiciliario a la carpeta repositorio
                                        if (move_uploaded_file($_FILES['foto_repartidor']['tmp_name'], "../Recursos/img-repartidor/" . $_FILES['foto_repartidor']['name'])) { // Si es exitoso el guardado de la foto continua 
                                            // Se ejecuta la consulta de registro de domiciliario
                                            $sqlReg = "INSERT INTO domiciliario (cedula_repartidor, nombre_repartidor, foto_repartidor, estado_repartidor) VALUES "
                                                . "('" . $cedula_repartidor . "','" . $nombre_repartidor . "','" . $_FILES['foto_repartidor']['name'] . "','Activo')";
                                            $resultado = ejecutarSQL::consultar($sqlReg);
                                            if ($resultado) {
                                ?>
                                             <img src="../Recursos/img/correctofull.png" style="width: 50%" class="center-all-contens">
                                             <script>
                                                 limpiarCamposRegDomiciliario();
                                                 $(document).ready(function() {
                                                     $('#tablaDomiciliario').load("Recursos/includes/tablaDomiciliario.php");
                                                 });
                                             </script>
                                             <br>
                                             <h3>El Repartidor se registró con éxito con éxito</h3>
                                             <p class="lead text-cente">
                                                 La pagina se redireccionara automaticamente. Si no es asi haga click en el siguiente boton.<br>
                                             </p>
                             <?php
                                            } else {
                                                echo '<img src="../Recursos/img/incorrecto.png" class="center-all-contens"><br><p class="lead text-center">El nombre que ha ingresado ya existe.<br>Error al registrar el repartidor</p>';
                                            }
                                        } else {
                                            echo '<img src="../Recursos/img/incorrecto.png" class="center-all-contens"><br><p class="lead text-center">No se pudo leer la foto<br></p>';
                                        }
                                    } else {
                                        echo '<img src="../Recursos/img/incorrecto.png" class="center-all-contens"><br><p class="lead text-center">El repartidor ya existe<br></p>';
                                    }
                                } else {
                                    echo '<img src="../Recursos/img/incorrecto.png" class="center-all-contens"><br><p class="lead text-center">Error los campos no deben de estar vacíos</p>';
                                }
                                ?>
                         </div>
                     </div>
             </section>
         </body>

         </html>
         <?php
        }

        if ($_POST['funcion'] == "changeDomiciliario") {
            // Se obtienen el id del formulario html por variable POST
            $id = $_POST['id'];
            // se obtiene el estado actual del domiciliario
            $sql = "SELECT estado_repartidor FROM domiciliario WHERE id=" . $id;
            $vec = mysqli_fetch_row(ejecutarSQL::consultar($sql));
            // Depende del caso se ejecuta la consulta para activar o inactivar
            if (isset($vec[0]) && $vec[0] <> "") {
                if ($vec[0] == "Activo") {
                    $sqlAc = "UPDATE domiciliario SET estado_repartidor='Inactivo' WHERE id=" . $id;
                } else {
                    $sqlAc = "UPDATE domiciliario SET estado_repartidor='Activo' WHERE id=" . $id;
                }
                $result = ejecutarSQL::consultar($sqlAc);

                if ($result) {
                    echo '<img src="Recursos/img/correcto.png" style="width: 20%" class="center-all-contens"><br><p class="lead text-center">El repartidor se actualizó exitosamente</p>';
            ?>
                 <script>
                     limpiarCamposRegDomiciliario();
                     $(document).ready(function() {
                         $('#tablaDomiciliario').load("Recursos/includes/tablaDomiciliario.php");
                     });
                 </script>
 <?php
                } else {
                    echo '<img src="Recursos/img/incorrecto.png"  style="width: 20%" class="center-all-contens"><br><p class="lead text-center">Ha ocurrido un error.<br>Por favor intente nuevamente</p>';
                }
            } else {
                echo '<img src="Recursos/img/incorrecto.png" style="width: 20%" class="center-all-contens"><br><p class="lead text-center">La cédula del repartidor no existe</p>';
            }
        }
    } else {
        echo '<img src="recursos/img/incorrecto.png" class="center-all-contens"><br><p class="lead text-center">Error al leer de función ejecutada</p>';
    }
    ?>