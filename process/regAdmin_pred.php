<?phpinclude '../library/consulSQL.php';sleep(3);$nombre_completo = "Administrador";$Nombre = "Admin";$Clave = md5("Minimarket19");$verificar = ejecutarSQL::consultar("SELECT * FROM administrador WHERE Nombre='" . $Nombre . "'");$verificaltotal = mysqli_num_rows($verificar);if ($verificaltotal <= 0) {    if (consultasSQL::InsertSQL("administrador", "nombre_completo, Nombre, Clave", "'$nombre_completo','$Nombre','$Clave'")) {        echo '<img src="assets/img/ok.png" class="center-all-contens"><br>El registro se completo con éxito';    } else {        echo '<img src="assets/img/error.png" class="center-all-contens"><br>Ha ocurrido un error.<br>Por favor informenos del error';    }} else {    echo '<img src="assets/img/error.png" class="center-all-contens"><br>El usuario administrador que ha ingresado ya esta registrado.<br>Por favor ingrese otro nombre';}