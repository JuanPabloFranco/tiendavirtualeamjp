<!DOCTYPE html>
<html lang="es">
    <head>    
        <title>Pedido</title>   
    </head>
    <body id="container-page-index">
        <section id="container-pedido">
            <div class="container">
                <div class="page-header">
                   <h1>Confirmar pedido en  <small class="tittles-pages-logo"><?php echo EMPRESA ." ".NEMPRESA;?></small></h1>
                </div>         
                <?php
                if (empty($_SESSION['producto'])) {
                    ?>
                    <div class="page-header">
                        <h3>No tienes productos en el carrito</h3>
                    </div>
                    <?php
                }
                ?>
                <div class="row">
                    <?php
                    if (count($_SESSION['producto']) > 0) {
                        include '../Recursos/plantillas/datos.php';
                        ini_set('date.timezone', 'America/Bogota');
                        $hora = date("G");
                        ?>
                        <div class="col-xs-12 col-sm-6">
                            <div id="form-compra">
                                <form action="DAO/confirmcompra.php" method="post" role="form" class="FormCatElec" data-form="save">
                                    <?php
                                    // Si el usuario ha iniciado sesion muestra el siguiente codigo html
                                    if (!$_SESSION['nombreUsuario'] == "" && !$_SESSION['claveUser'] == "") {
                                        ?>
                                        <table class="table table-bordered">
                                            <tr style='text-align: center'><td><b>PRODUCTO</b></td><td><b>CANTIDAD</b></td><td><b>PRECIO</b></td><td><b>SUBTOTAL</b></td></tr>
                                            <?php
                                            // Metodo para listar los productos existentes en el carrito de compras ($_SESSION['producto'])
                                            foreach ($_SESSION['producto'] as $key => $producto) {
                                                ?>
                                                <tr style='text-align: center'><td><?php echo $producto['nombre'] ?></td><td><?php echo $producto['cantidad'] ?></td><td>$<?php echo $producto['precio'] ?></td>
                                                    <td>$<?php echo $producto['precio'] * $producto['cantidad']; ?></td>
                                                    <?php
                                                    ?>
                                                </tr>
                                                <?php
                                                $suma += ($producto['precio'] * $producto['cantidad']);
                                            }
                                            ?>
                                            <tr style='text-align: center'><td colspan='3' >TOTAL</td><td>$<?php echo $suma; ?> + Domicilio</td></tr>
                                        </table>
                                        <div class="form-group">
                                            <div class="input-group"><div class="input-group-addon"><i class="fa fa-home"></i></div>
                                                <input class="form-control all-elements-tooltip" type="text" value="<?php echo $_SESSION['direccion'] ?>" placeholder="Ingrese la dirección de entrega" required name="direccion_venta" data-toggle="tooltip" data-placement="top" title="Ingrese la dirección de entrega" >
                                            </div>
                                        </div>
                                        <p>Método de Pago</p>                                        
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="metodo_pago" value="Efectivo" checked id="pagoEfectivo">
                                                Efectivo
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="metodo_pago" value="Transferencia" id="pagoTransferencia">
                                                Transferencia Electrónica
                                            </label>
                                        </div>
                                        <p class="text-center" id="titleTransferencia" style="display: none"><img src="Recursos/img/logo-bancolombia.png" style="max-width: 20%; text-align: center" >  Transferencia electrónica a la cuenta de ahorros No. <?php ECHO CUENTA;?></p>                                            
                                        <div class="form-group" id="divCcambio">
                                            <p>¿Cambio de?  <i class="fa fa-money"></i></p>
                                            <div class="input-group"><div class="input-group-addon"><i class="fa fa-usd"></i></div>
                                                <input class="form-control all-elements-tooltip" type="text" placeholder="Cambio de $" required name="cambio" data-toggle="tooltip" data-placement="top" value="0" min="0" title="Cambio de $" id="txtCambio">
                                            </div>
                                        </div>
                                        <div>                                             
                                            <p class="text-center">Para confirmar tu pedido verifica la dirección, elije un método de pago y presiona el botón confirmar</p><br>
                                        </div>
                                        <input type="hidden" name="nombreUsuario" value="<?php echo $_SESSION['nombreUsuario'] ?>">
                                        <input type="hidden" name="claveUser" value="<?php echo $_SESSION['claveUser'] ?>">
                                        <input type="hidden"  name="clien-number" value="log">
                                        <p class="text-center"><button class="btn btn-success" type="submit">Confirmar</button></p>
                                        <?php                                        
                                    } else { // Si el usuario no ha iniciado sesion
                                        ?>
                                        <p>Para confirmar tu compra debes haber iniciar sesión o introducir tu nombre de usuario y contraseña con la cual te registraste en <span class="tittles-pages-logo"> <?php echo EMPRESA ." ".NEMPRESA;?></span>, Verifica la dirección, elije un método de pago y presiona el botón confirmar<br>
                                        <table class="table table-bordered">
                                            <tr style='text-align: center'><td><b>PRODUCTO</b></td><td><b>CANTIDAD</b></td><td><b>PRECIO</b></td><td><b>SUBTOTAL</b></td></tr>
                                            <?php
                                            foreach ($_SESSION['producto'] as $key => $producto) {
                                                ?>
                                                <tr style='text-align: center'><td><?php echo $producto['nombre'] ?></td><td><?php echo $producto['cantidad'] ?></td><td>$<?php echo $producto['precio'] ?></td>
                                                    <td>$<?php echo $producto['precio'] * $producto['cantidad']; ?></td>
                                                    <?php
                                                    ?>
                                                </tr>
                                                <?php
                                                $suma += ($producto['precio'] * $producto['cantidad']);
                                            }
                                            ?>
                                            <tr style='text-align: center'><td colspan='3' >TOTAL</td><td>$<?php echo $suma; ?> + Domicilio</td></tr>
                                        </table>
                                        <div class="form-group">
                                            <div class="input-group"><div class="input-group-addon"><i class="fa fa-home"></i></div>
                                                <input class="form-control all-elements-tooltip" type="text" value="<?php echo $_SESSION['direccion'] ?>" placeholder="Ingrese la dirección de entrega" required name="direccion_venta" data-toggle="tooltip" data-placement="top" title="Ingrese la dirección de entrega" >
                                            </div>
                                        </div>
                                        <p>Método de Pago</p>                                        
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="metodo_pago" value="Efectivo" checked id="pagoEfectivo">
                                                Efectivo
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="metodo_pago" value="Transferencia" id="pagoTransferencia">
                                                Transferencia Electrónica
                                            </label>
                                        </div>                                
                                        <p class="text-center" id="titleTransferencia" style="display: none"><img src="Recursos/img/logo-bancolombia.png" style="max-width: 20%; text-align: center" >  Transferencia electrónica a la cuenta de ahorros No. <?php ECHO CUENTA;?></p>                                            
                                        <div class="form-group" id="divCcambio">
                                            <p>¿Cambio de?  <i class="fa fa-money"></i></p> 
                                            <div class="input-group"><div class="input-group-addon"><i class="fa fa-usd"></i></div>
                                                <input class="form-control all-elements-tooltip" type="text" placeholder="Cambio de $" required name="cambio" data-toggle="tooltip" data-placement="top" value="0" min="0" title="Cambio de $" id="txtCambio">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group"><div class="input-group-addon"><i class="fa fa-user"></i></div>
                                                <input class="form-control all-elements-tooltip" type="text" placeholder="Ingrese su nombre de usuario o email" required name="nombreUsuario" data-toggle="tooltip" data-placement="top" title="Ingrese su nombre" >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-lock"></i>
                                                </div>
                                                <input class="form-control all-elements-tooltip" type="password" placeholder="Introduzca su contraseña" required name="claveUser" data-toggle="tooltip" data-placement="top" title="Introduzca su contraseña">
                                            </div>
                                        </div>
                                        <p class="text-center"><button class="btn btn-success" type="submit">Confirmar</button></p>
                                        <input type="hidden"  name="clien-number" value="notlog"><br>
                                        <?php
                                    }
                                    ?> <div class="ResForm" style="width: 100%; text-align: center; margin: 0;"></div>
                                </form>                    
                            </div>                                  
                        </div>  
                        <?php
                    }
                    ?>
                </div>     
            </div> 
        </section> 
    </body>
</html>