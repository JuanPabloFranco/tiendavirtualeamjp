<?php
//header('Content-Type: text/html; charset=utf-8');
@session_start();
error_reporting(E_PARSE);
?>
<!--Seccion carrito de compras-->
<section id="container-carrito-compras">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6"><br><br>
                <div id="carrito-compras-tienda"></div>
            </div>
            <div class="col-xs-12 col-sm-6"><br><br>
                <p class="text-center" style="font-size: 80px;">
                    <i class="fa fa-shopping-cart"></i>
                </p>
                <p class="text-center">                    
                    <a href="index.php?page=confirmar_pedido" class="btn btn-success btn-block"><i class="fa fa-dollar"></i>   Confirmar pedido</a>
                    <a href="DAO/vaciarcarrito.php" class="btn btn-danger btn-block"><i class="fa fa-trash"></i>   Vaciar carrito</a> 
                </p>
            </div>
        </div>
    </div>
</section>
<!--Menu dispositivos de escritorio-->
<nav id="navbar-auto-hidden" class="nav1">
    <div class="row hidden-xs"><!-- Menu -->
        <div class="col-xs-2">
            <figure class="logo-navbar"></figure>
        </div>
        <div class="col-xs-10">
            <div class="contenedor-tabla pull-right">
                <div class="contenedor-tr" id="botones"> 
                    <a class="table-cell-td" href="index.php?page=inicio">Inicio</a>
                    <a href="index.php?page=buscar_producto" class="table-cell-td">Buscar  <i class="fa fa-search"></i></a>
                    <a href="index.php?page=product&&pagina=1" class="table-cell-td">Productos</a>                     
                    <?php
                    if (!$_SESSION['nombreAdmin'] == "") {
                        if ($_SESSION['tipo'] == "Vendedor") {
                            ?>
                            <a href="index.php?page=ventas" class="table-cell-td">Ventas</a>  
                            <?php
                        } else {
                            ?>
                            <a href="index.php?page=configAdmin" class="table-cell-td">Administración</a>  
                            <?php
                        }
                        ?>
                        <a href="#" class="table-cell-td" data-toggle="modal" data-target=".modal-logout">
                            <i class="fa fa-user"></i>&nbsp;&nbsp;<?php echo $_SESSION['nombreUsuario']; ?> 
                        </a>
                        <?php
                    } else if (!$_SESSION['nombreUser'] == "") {
                        ?>
                        <a href="#" class="table-cell-td carrito-button-nav all-elements-tooltip" data-toggle="tooltip" data-placement="bottom" id="carrito-button-nav">
                            <i class="fa fa-shopping-cart">(<?php echo count($_SESSION['producto']) ?>)</i>&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-caret-down"></i>
                        </a>
                        <a href="index.php?page=pedido&&pagina=1" class="table-cell-td">Pedidos</a>

                        <a href="#" class="table-cell-td" data-toggle="modal" data-target=".modal-logout">
                            <i class="fa fa-user"></i>&nbsp;&nbsp; <?php echo $_SESSION['nombreUsuario']; ?>
                        </a>
                        <?php
                    } else {
                        ?>                        
                        <a href="#" class="table-cell-td carrito-button-nav all-elements-tooltip" id="carrito-button-nav" data-toggle="tooltip" data-placement="bottom" >
                            <div id="marcador_carrito"><i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;&nbsp;<i class="fa fa-caret-down"></i></div>
                        </a>           
                        <a href="#" class="table-cell-td" data-toggle="modal" data-target=".modal-login">
                            <i class="fa fa-user"></i>&nbsp;&nbsp;Login
                        </a>
                        <?php
                    }
                    ?>
                    <a href="index.php?page=contact" class="table-cell-td">Contáctenos</a> 
                </div>
            </div>
        </div>
    </div>
    <div class="row visible-xs"><!-- Menu dispositivos moviles -->
        <div class="col-xs-12">
            <button class="btn btn-default pull-left button-mobile-menu" id="btn-mobile-menu">
                <i class="fa fa-th-list"></i>&nbsp;&nbsp;Menú
            </button>            
            <a href="#" id="button-shopping-cart-xs" class="elements-nav-xs all-elements-tooltip carrito-button-nav" data-toggle="tooltip" data-placement="bottom" title="Ver carrito de compras">
                <i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-caret-down"></i>
            </a>
            <?php
            if (!$_SESSION['nombreUsuario'] == "") {
                ?>
                <a href="#"  id="button-login-xs" class="elements-nav-xs" data-toggle="modal" data-target=".modal-logout">
                    <i class="fa fa-user"></i>&nbsp;<?php echo $_SESSION['nombreUsuario'] ?>
                </a>
                <?php
            } else if (!$_SESSION['nombreUsuario'] == "") {
                ?>
                <a href="#"  id="button-login-xs" class="elements-nav-xs" data-toggle="modal" data-target=".modal-logout">
                    <i class="fa fa-user"></i>&nbsp;<?php echo $_SESSION['nombreUsuario'] ?>
                </a>
                <?php
            } else {
                ?>
                <a href="#" data-toggle="modal" data-target=".modal-login" id="button-login-xs" class="elements-nav-xs">
                    <i class="fa fa-user"></i>&nbsp; Login
                </a>
                <?php
            }
            ?>
        </div>
    </div>
</nav>
<!-- Modal login -->
<div class="modal fade modal-login" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content" id="modal-form-login">
            <div class="modal-header">                
                <h4 class="modal-title text-center text-primary" id="myModalLabel">Iniciar sesión en <?php echo EMPRESA . " " . NEMPRESA; ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <form action="DAO/login.php" method="post" role="form" style="margin: 20px;" class="FormCatElec" data-form="login">
                <div class="form-group">
                    <label><span class="glyphicon glyphicon-user"></span>&nbsp;Nombre</label>
                    <input type="text" class="form-control" name="nombre-login" placeholder="Escribe tu nombre de usuario o email" required=""/>
                </div>
                <div class="form-group">
                    <label><span class="glyphicon glyphicon-lock"></span>&nbsp;Contraseña</label>
                    <input type="password" class="form-control" name="clave-login" placeholder="Escribe tu contraseña" required=""/>
                </div>
                <p>¿Cómo iniciaras sesión?</p>
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios" value="option1" checked>
                        Cliente
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios" value="option2">
                        Vendedor
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios" value="option3">
                        Administrador
                    </label>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-sm">Iniciar sesión</button>
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancelar</button>
                    <br><br><br>
                    <a href="index.php?page=registration">Registrate aquí como cliente</a>    
                </div>
                <div class="ResFormL" style="width: 100%; text-align: center; margin: 0;"></div>
            </form>
        </div>
    </div>
</div>
<!-- Fin Modal login -->
<!-- submenu dispotivo movil -->
<div id="mobile-menu-list" class="hidden-sm hidden-md hidden-lg">
    <br>
    <h3 class="text-center tittles-pages-logo"><?php echo EMPRESA; ?></h3>
    <button class="btn btn-default button-mobile-menu" id="button-close-mobile-menu">
        <i class="fa fa-times"></i>
    </button>
    <br><br>
    <ul class="list-unstyled text-center">
        <li><a href="index.php?page=inicio">Inicio</a></li>
        <li><a href="index.php?page=product">Productos</a></li>
        <li><a href="index.php?page=buscar_producto">Buscar Producto</a></li>
        <li><a href="index.php?page=contact">Contáctanos</a></li>
        <?php
        if (!$_SESSION['nombreAdmin'] == "") {
            echo '<li><a href="index.php?page=configAdmin">Administración</a></li>';
        } elseif (!$_SESSION['nombreUsuario'] == "") {
            echo '<li><a href="index.php?page=pedido">Pedidos</a></li>';
        } else {
            echo '<li><a href="index.php?page=registration.php">Login</a></li>';
        }
        ?>
    </ul>
</div>
<!-- Modal carrito -->
<div class="modal fade modal-carrito" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="padding: 20px;">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <br>
            <p class="text-center"><i class="fa fa-shopping-cart fa-5x"></i></p>
            <p class="text-center">El producto se añadió al carrito</p>
            <p class="text-center"><button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Aceptar</button></p>
        </div>
    </div>
</div>
<div class="modal fade modal-carrito-del" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="padding: 20px;">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <br>
            <p class="text-center"><i class="fa fa-shopping-cart fa-5x"></i></p>
            <p class="text-center">Se eliminó el producto del carrito</p>
            <p class="text-center"><button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Aceptar</button></p>
        </div>
    </div>
</div>
<!-- Fin Modal carrito -->
<!-- Modal logout -->
<div class="modal fade modal-logout" tabindex="-2" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="padding: 20px;">
    <div class="modal-dialog modal-mg">
        <div class="modal-content">
            <br>
            <p class="text-center">¿Que desea hacer?</p>
            <p class="text-center"><img src="Recursos/img/carrito.png" style="text-align: center; width: 12%;" ></p>
            <p class="text-center">
                <?php
                if (isset($_SESSION['nombreUser']) || empty($_SESSION['nombreAdmin'])) {
                    ?>
                    <a href="index.php?page=pedido" class="btn btn-primary btn-sm">Ver mis pedidos</a>
                    <a href="index.php?page=editar_cliente" class="btn btn-success btn-sm">Editar datos</a>
                    <?php
                }
                ?>
                <a href="DAO/logout.php" class="btn btn-danger btn-sm">Cerrar la sesión</a>
                <button type="button" class="btn btn-sm" style="background-color: #2c3e50; color: white;" data-dismiss="modal">Cancelar</button>
            </p>
        </div>
    </div>
</div>
<!-- Fin Modal logout -->