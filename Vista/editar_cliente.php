<?php
session_start();

if (!$_SESSION['nombreUsuario'] ==""&&$_SESSION['tipo'] == "Cliente") {
    $vecCliente = mysqli_fetch_row(ejecutarSQL::consultar("SELECT id, nit, nombre_completo, direccion, telefono, email, usuario, clave FROM cliente WHERE id=" . $_SESSION['id_user']));
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title><?php echo EMPRESA?> / Mis datos</title>
    </head>
    <body id="container-page-registration">
        <section id="form-registration" >
            <div class="container">
                <div class="row">
                    <div class="page-header">
                        <h1>Mis datos personales <small class="tittles-pages-logo"><?php echo EMPRESA . " ". NEMPRESA?></small></h1>
                    </div>                    
                    <div class="col-xs-12 col-sm-6">
                        <br><br>
                        <div id="container-form">
                            <form class="form-horizontal FormCatElec" action="DAO/clienteDAO.php" role="form" method="post" data-form="save">
                                <input class="form-control all-elements-tooltip" value="<?php echo $vecCliente[0]?>" type="hidden" required name="id" >
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-credit-card"></i></div>
                                        <input class="form-control all-elements-tooltip" type="text" id="txtCedulaCliente" placeholder="Ingrese su número de Cedula" required name="nit" data-toggle="tooltip" data-placement="top" title="Ingrese su número de Cedula. Solamente números y guiones(-)" maxlength="30" pattern="[0-9-]{7,30}" value="<?php echo $vecCliente[1]?>">
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                        <input class="form-control all-elements-tooltip" value="<?php echo $vecCliente[2]?>" type="text" pattern="[A-Za-z ]+" id="txtNombreCliente" placeholder="Ingrese su nombre completo" required name="nombre_completo" data-toggle="tooltip" data-placement="top" title="Ingrese su nombre completo"  maxlength="100">
                                    </div>
                                </div> 
                                <br>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-home"></i></div>
                                        <input class="form-control all-elements-tooltip" type="text" value="<?php echo $vecCliente[3]?>" id="txtDirCliente" placeholder="Ingrese su dirección" required name="direccion" data-toggle="tooltip" data-placement="top" title="Ingrese la direción en la reside actualmente" maxlength="100">
                                    </div>
                                </div>                                
                                <br>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-mobile"></i></div>
                                        <input class="form-control all-elements-tooltip" type="tel" value="<?php echo $vecCliente[4]?>" id="txtTelCliente" placeholder="Ingrese su número fijo o celular" required name="telefono" maxlength="11" pattern="[0-9]{8,11}" data-toggle="tooltip" data-placement="top" title="Ingrese su número telefónico. Mínimo 8 digitos máximo 11">
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-at"></i></div>
                                        <input class="form-control all-elements-tooltip" type="email" value="<?php echo $vecCliente[5]?>" id="txtEmailCliente" placeholder="Ingrese su Email" required name="email" data-toggle="tooltip" data-placement="top" title="Ingrese la dirección de su Email" maxlength="50">
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-user-md"></i></div>
                                        <input class="form-control all-elements-tooltip" type="text" value="<?php echo $vecCliente[6]?>" id="txtNomUsuario" placeholder="Ingrese su nombre de usuario en nuestro sitio" required name="usuario" data-toggle="tooltip" data-placement="top" title="Ingrese su nombre. Máximo 14 caracteres (solamente letras)" pattern="[a-zA-Z]{1,14}" maxlength="14">
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-lock"></i></div>
                                        <input class="form-control all-elements-tooltip" type="password" id="txtPassCliente" placeholder="Introduzca tu contraseña actual o una nueva" required name="clave" data-toggle="tooltip" data-placement="top" title="Defina una contraseña para iniciar sesión">
                                    </div>
                                </div>
                                <br>
                                <input type="text" style="display: none" name="funcion" value="editarCliente">
                                <p><button type="submit" class="btn btn-success btn-block"><i class="fa fa-pencil"></i>&nbsp; Actualizar</button></p>
                                <div class="ResForm" style="width: 100%; color: #fff; text-align: center; margin: 0;"></div>
                            </form> 
                        </div> 
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>
<?php
 } else{    
        include 'Vista/inicio.php';    
 }
?>