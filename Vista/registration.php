<!DOCTYPE html><html lang="es">    <head>        <title><?php echo EMPRESA?> / Registro</title>    </head>    <body id="container-page-registration">        <section id="form-registration" >            <div class="container">                <div class="row">                    <div class="page-header col-xs-12">                        <h1>Registro de clientes <small class="tittles-pages-logo"><?php echo EMPRESA . " ". NEMPRESA?></small></h1>                    </div>                    <div class="col-xs-12 col-sm-6 text-center" >                        <br><br><br>                        <p><i class="fa fa-users fa-5x"></i></p>                        <p class="lead">                            Al registrarse podrás hacer tu pedido a tu domicilio.                        </p>                        <img src="Recursos/img/logo_eam.png" style="text-align: center; width: 60%">                    </div>                    <div class="col-xs-12 col-sm-6">                        <br><br>                        <div id="container-form">                            <p style="color:#fff;" class="text-center lead">Diligencie todos los campos para registrarse</p>                            <br>                            <form class="form-horizontal FormCatElec" action="DAO/clienteDAO.php" role="form" method="post" data-form="save">                                <div class="form-group">                                    <div class="input-group">                                        <div class="input-group-addon"><i class="fa fa-credit-card"></i></div>                                        <input class="form-control all-elements-tooltip" type="text" id="txtCedulaCliente" placeholder="Ingrese su número de Cedula" required name="nit" data-toggle="tooltip" data-placement="top" title="Ingrese su número de Cedula. Solamente números y guiones(-)" maxlength="30" pattern="[0-9-]{7,30}">                                    </div>                                </div>                                <br>                                <div class="form-group">                                    <div class="input-group">                                        <div class="input-group-addon"><i class="fa fa-user"></i></div>                                        <input class="form-control all-elements-tooltip" type="text" id="txtNombreCliente" placeholder="Ingrese su nombre completo" required name="nombre_completo" data-toggle="tooltip" data-placement="top" title="Ingrese su nombre completo"  maxlength="100">                                    </div>                                </div>                                 <br>                                <div class="form-group">                                    <div class="input-group">                                        <div class="input-group-addon"><i class="fa fa-home"></i></div>                                        <input class="form-control all-elements-tooltip" type="text" id="txtDirCliente" placeholder="Ingrese su dirección" required name="direccion" data-toggle="tooltip" data-placement="top" title="Ingrese la direción en la reside actualmente" maxlength="100">                                    </div>                                </div>                                                                <br>                                <div class="form-group">                                    <div class="input-group">                                        <div class="input-group-addon"><i class="fa fa-mobile"></i></div>                                        <input class="form-control all-elements-tooltip" type="tel" id="txtTelCliente" placeholder="Ingrese su número fijo o celular" required name="telefono" maxlength="11" pattern="[0-9]{8,11}" data-toggle="tooltip" data-placement="top" title="Ingrese su número telefónico. Mínimo 8 digitos máximo 11">                                    </div>                                </div>                                <br>                                <div class="form-group">                                    <div class="input-group">                                        <div class="input-group-addon"><i class="fa fa-at"></i></div>                                        <input class="form-control all-elements-tooltip" type="email" id="txtEmailCliente" placeholder="Ingrese su Email" required name="email" data-toggle="tooltip" data-placement="top" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Ingrese la dirección de su Email" maxlength="100">                                    </div>                                </div>                                <br>                                <div class="form-group">                                    <div class="input-group">                                        <div class="input-group-addon"><i class="fa fa-user-md"></i></div>                                        <input class="form-control all-elements-tooltip" type="text" id="txtNomUsuario" pattern="[A-Za-z0-9 ]{8,20}" placeholder="Sólo se permiten letras (mayúsculas y minúsculas) y números, Minimo 8, Max 20 carácteres" title="Sólo se permiten letras (mayúsculas y minúsculas) y números, Minimo 8, Max 20 carácteres" maxlength="20"name="usuario" data-toggle="tooltip" data-placement="top">                                    </div>                                </div>                                <br>                                <div class="form-group">                                    <div class="input-group">                                        <div class="input-group-addon"><i class="fa fa-lock"></i></div>                                        <input class="form-control all-elements-tooltip" type="password" id="txtPassCliente" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder="Introduzca una contraseña que debe contener 8 o más caracteres de al menos un número y una letra mayúscula y minúscula" required name="clave" data-toggle="tooltip" data-placement="top" title="Debe contener 8 o más caracteres de al menos un número y una letra mayúscula y minúscula">                                    </div>                                </div>                                <br>                                <input type="text" style="display: none" name="funcion" value="crearCliente">                                <p><button type="submit" class="btn btn-success btn-block"><i class="fa fa-pencil"></i>&nbsp; Registrarse</button></p>                                <div class="ResForm" style="width: 100%; color: black; text-align: center; margin: 0;"></div>                            </form>                         </div>                     </div>                </div>            </div>        </section>    </body></html>