<?phpinclude '../Conexion/consulSQL.php';sleep(1);if ($_POST['funcion'] <> "") { // Verificar si la variable con el tipo de proceso es diferente de vacio    // Se verifica el valor de la variable POST, cuando es igual al deseado realiza el proceso correspondiente    if ($_POST['funcion'] == "crearUsuario") {        // Se obtienen los datos del formulario html por variables POST        $nombre_completo = $_POST['nombre_completo'];        $Nombre = $_POST['Nombre'];        $Clave = md5($_POST['Clave']);        $tipo = $_POST['tipo'];        //  Se verifica que los campos a guardar no esten vacios        if (!$nombre_completo == "" && !$Nombre == "" && !$Clave == "" && !$tipo == "") {            //Se verifica si existe ya existe el nombre de usuario en bd            $verificar = ejecutarSQL::consultar("SELECT * FROM usuarios WHERE Nombre='" . $Nombre . "'");            $verificaltotal = mysqli_num_rows($verificar);            if ($verificaltotal <= 0) { // si no existe el usuario se continua el proceso de registro                if (consultasSQL::InsertSQL("usuarios", "nombre_completo, Nombre, Clave, estado, tipo", "'$nombre_completo','$Nombre','$Clave','Activo','$tipo'")) {                    ?>                    <script>                        $(document).ready(function () {                            $('#tablaUsuarios').load("Recursos/includes/tablaUsuarios.php");                        });                        limpiarCamposRegUsuario()();                    </script>                    <img src="Recursos/img/correcto.png" class="center-all-contens"><br><p class="lead text-center">Administrador añadido éxitosamente</p>                    <?php                } else {                    ?>                    <img src="Recursos/img/incorrecto.png" class="center-all-contens"><br><p class="lead text-center">Ha ocurrido un error.<br>Por favor intente nuevamente</p>                    <?php                }            } else {                ?>                <img src="Recursos/img/incorrecto.png" class="center-all-contens"><br><p class="lead text-center">El nombre que ha ingresado ya existe.<br>Por favor ingrese otro nombre</p>                <?php            }        } else {            ?>            <img src="Recursos/img/incorrecto.png" class="center-all-contens"><br><p class="lead text-center">Error los campos no deben de estar vacíos</p>            <?php        }    }    if ($_POST['funcion'] == "changeUsuario") {        // Se obtienen el id del formulario html por variable POST        $id = $_POST['id'];        // Se obtiene el estado actual del usuario en bd        $vec = mysqli_fetch_row(ejecutarSQL::consultar("SELECT estado FROM usuarios WHERE id=$id"));        if (isset($vec) && $vec[0] <> "") {            //Se actualiza el estado según el caso            if ($vec[0] == "Activo") {                $consA = ejecutarSQL::consultar("UPDATE usuarios SET estado='Inactivo' WHERE id=$id");            } else {                $consA = ejecutarSQL::consultar("UPDATE usuarios SET estado='Activo' WHERE id=$id");            }            if ($consA) {                ?>                <script>                    $(document).ready(function () {                        $('#tablaUsuarios').load("Recursos/includes/tablaUsuarios.php");                    });                </script>                <img src="Recursos/img/correcto.png" class="center-all-contens"><br><p class="lead text-center">Se cambió el estado</p>                <?php            } else {                ?>                <img src="Recursos/img/incorrecto.png" class="center-all-contens"><br><p class="lead text-center">Error al cambiar el estado</p>                <?php            }        } else {            ?>            <img src="Recursos/img/incorrecto.png" class="center-all-contens"><br><p class="lead text-center">No se encontró el id del administrador</p>            <?php        }    }} else {    ?>    <img src="Recursos/img/incorrecto.png" class="center-all-contens"><br><p class="lead text-center">Error al leer de función ejecutada</p>    <?php}