<?php//Lista los datos de la empresa y los carga en variables estaticas$sqldatos = "SELECT tipoEmpresa, nombreEmpresa, nit, telefonos, whatsapp, direccion, facebook, instagram, email FROM informacion_empresa WHERE id=1";$Vecdatos = mysqli_fetch_row(ejecutarSQL::consultar($sqldatos));if (isset($Vecdatos)) {    define("EMPRESA", $Vecdatos[0]);    define("NEMPRESA", $Vecdatos[1]);    define("NIT", $Vecdatos[2]);    define("TELEFONOS", $Vecdatos[3]);    define("WP", $Vecdatos[4]);    define("DIRECCION", $Vecdatos[5]);    define("FB", $Vecdatos[6]);    define("INSTAGRAM", $Vecdatos[7]);    define("EMAIL", $Vecdatos[8]);} else {    echo "Error al conectar con la base de datos";}?>