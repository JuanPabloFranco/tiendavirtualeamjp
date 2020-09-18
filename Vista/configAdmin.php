<html lang="es">
    <head>
        <title>Administación</title>
    </head>
    <body id="container-page-configAdmin">
        <section id="prove-product-cat-config">
            <div class="container">
                <div class="page-header">                    
                    <h1>Panel de Administración <small class="tittles-pages-logo"><?php echo EMPRESA . " " . NEMPRESA ?></small></h1><a href="index.php?page=ventas"><button class="btn btn-primary">Ventas</button></a>
                </div>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <?php
                    if ($_SESSION['tipo'] == "Administrador") {
                        ?>
                        <li role="presentation"><a href="#Usuarios" role="tab" data-toggle="tab">Usuarios</a></li>
                        <li role="presentation"><a href="#Domiciliarios" role="tab" data-toggle="tab">Domiciliarios</a></li>                        
                        <li role="presentation"><a href="#Productos" role="tab" data-toggle="tab">Productos</a></li>
                        <li role="presentation"><a href="#Proveedores" role="tab" data-toggle="tab">Proveedores</a></li>
                        <li role="presentation"><a href="#Categorias" role="tab" data-toggle="tab">Categorías</a></li>
                        <li role="presentation"><a href="#Bodega" role="tab" data-toggle="tab">Bodega</a></li>
                        <li role="presentation" class="active"><a href="#General" role="tab" data-toggle="tab">Inf General</a></li>
                        <?php
                    }
                    ?>
                </ul>
                <div class="tab-content">
                    <!--==============================Panel productos===============================-->
                    <div role="tabpanel" class="tab-pane fade" id="Productos">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <br><br>
                                <div id="add-product">
                                    <h2 class="text-info text-center"><small><i class="fa fa-plus"></i></small>&nbsp;&nbsp;Agregar un producto nuevo</h2>
                                    <form role="form" action="DAO/productoDAO.php" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Código de producto</label>
                                            <input type="text" class="form-control" id="txtCodigo_prod" placeholder="Código" required maxlength="40" name="codigo_prod">
                                        </div>
                                        <div class="form-group">
                                            <label>Nombre de producto</label>
                                            <input type="text" class="form-control"  placeholder="Nombre" required maxlength="40" name="nombre_prod">
                                        </div>
                                        <div class="form-group">
                                            <label>Categoría</label>
                                            <select class="form-control" name="id_categoria">
                                                <?php
                                                $categoriac = ejecutarSQL::consultar("SELECT * FROM categoria");
                                                while ($catec = mysqli_fetch_array($categoriac)) {
                                                    echo '<option value="' . $catec['codigo_categoria'] . '">' . $catec['nombre'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Precio</label>
                                            <input type="text" class="form-control"  placeholder="Precio" required maxlength="20" pattern="[0-9]{1,20}" name="precio">
                                        </div> 
                                        <div class="form-group">
                                            <label>Marca</label>
                                            <input type="text" class="form-control"  placeholder="Marca" required maxlength="30" name="marca">
                                        </div>                              
                                        <div class="form-group">
                                            <label>Proveedor</label>
                                            <select class="form-control" name="id_proveedor">
                                                <?php
                                                $proveedoresc = ejecutarSQL::consultar("SELECT * FROM proveedor");
                                                while ($provc = mysqli_fetch_array($proveedoresc)) {
                                                    echo '<option value="' . $provc['id'] . '">' . $provc['nombre_proveedor'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Descripción</label>
                                            <textarea class="form-control" placeholder="Agregue una descripción del producto" name="descripcion_prod"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Imagen de producto</label>
                                            <input type="file" name="img">
                                            <p class="help-block">Formato de imagenes admitido png, jpg, gif, jpeg</p>
                                        </div>
                                        <input type="text" style="display: none" name="funcion" value="crearProducto">
                                        <input type="hidden"  name="id_admin" value="<?php echo $_SESSION['id_user'] ?>">
                                        <p class="text-center"><button type="submit" class="btn btn-primary">Agregar a la tienda</button></p>
                                        <div id="res-form-add" style="width: 100%; text-align: center; margin: 0;"></div>
                                    </form>
                                </div>
                            </div>                            
                            <div class="col-xs-12 col-sm-6">
                                <br><br>
                                <div id="change-prod-form">
                                    <h2 class="text-info text-center"><small><i></i></small>&nbsp;&nbsp;Cambiar Disponible/No Disponible</h2>
                                    <form action="DAO/productoDAO.php" method="post" role="form" >
                                        <div class="form-group">
                                            <label>Productos</label>
                                            <select class="form-control" name="id" style="width: 100%" id="cambiarEstadoProducto">
                                                <?php
                                                $productoCh = ejecutarSQL::consultar("SELECT producto.id, marca, nombre_prod, estado_prod FROM producto ORDER BY id DESC LIMIT 100");
                                                if ($productoCh) {
                                                    while ($prodc = mysqli_fetch_array($productoCh)) {
                                                        echo '<option value="' . $prodc['id'] . '">' . $prodc['marca'] . '-' . $prodc['nombre_prod'] . ' / ' . $prodc['estado_prod'] . '</option>';
                                                    }
                                                } else {
                                                    echo '<option value="0">No existen productos creados</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <p class="text-center"><button type="submit" class="btn btn-primary">Cambiar Estado</button></p>
                                        <br>
                                        <input type="text" name="funcion" style="display: none" value="changeProducto">
                                        <div id="res-form-change-prod" style="width: 100%; text-align: center; margin: 0;"></div>
                                    </form>
                                </div>
                            </div> 
                            <div class = "col-xs-12">
                                <br>
                                <div class="panel panel-info">
                                    <div class="panel-heading text-center"><h3>ACTUALIZAR PRODUCTOS</h3><input class="form-control" id="myInput" type="text" placeholder="Buscar un valor en la tabla"></div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="tabla">
                                            <thead class="">
                                                <tr>
                                                    <th class="text-center" style="width: 60px">Imagen</th>
                                                    <th class="text-center">Código</th>
                                                    <th class="text-center">Nombre</th>
                                                    <th class="text-center">Categoría</th>
                                                    <th class="text-center">Precio</th>
                                                    <th class="text-center">Marca</th>
                                                    <th class="text-center">Proveedor</th>
                                                    <th class="text-center">Descripción</th>
                                                    <th class="text-center">Actualizar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $productos = ejecutarSQL::consultar("SELECT * FROM producto ORDER BY id DESC LIMIT 100");
                                                if ($productos) {
                                                    $upr = 1;
                                                    while ($prod = mysqli_fetch_array($productos)) {
                                                        ?>
                                                    <div id="update-product">
                                                        <form method="post" action="DAO/productoDAO.php" id="update-product-<?php echo $upr; ?>">
                                                            <tr>
                                                                <td><img src="Recursos/img-products/<?php echo $prod['imagen'] ?>" style="max-width: 80px; text-align: center" ></td>
                                                                <td>                                
                                                                    <label style="display: none;"><?php echo $prod['codigo_prod'] ?></label>
                                                                    <label style="display: none;"><?php echo $prod['nombre_prod'] ?></label>
                                                                    <input class="form-control" type="hidden" name="id" required="" value="<?php echo $prod['id'] ?>">
                                                                    <input class="form-control" type="text" name="codigo_prod" maxlength="40" required="" value="<?php echo $prod['codigo_prod'] ?>">
                                                                </td>
                                                                <td><input class="form-control" type="text" name="nombre_prod" maxlength="40" required="" value="<?php echo $prod['nombre_prod'] ?>"></td>
                                                                <td>
                                                                    <select class="form-control" name="id_categoria">
                                                                        <option value="Sin Categoria">Elija una opción</option>
                                                                        <?php
                                                                        $categoriac2 = ejecutarSQL::consultar("SELECT * FROM categoria");
                                                                        while ($catec2 = mysqli_fetch_array($categoriac2)) {
                                                                            if ($catec2['id'] <> $prod['id_categoria']) {
                                                                                echo '<option value="' . $catec2['id'] . '">' . $catec2['nombre'] . '</option>';
                                                                            } else {
                                                                                echo '<option  selected="selected" value="' . $catec2['id'] . '">' . $catec2['nombre'] . '</option>';
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </td>
                                                                <td><input class="form-control" type="text-area" name="precio" required="" value="<?php echo $prod['precio']; ?>"></td>
                                                                <td><input class="form-control" type="text-area" name="marca" maxlength="30" required="" value="<?php echo $prod['marca'] ?>"></td>
                                                                <td>
                                                                    <select class="form-control" name="id_proveedor">
                                                                        <option value="0">Elija una opción</option>
                                                                        <?php
                                                                        $proveedoresc2 = ejecutarSQL::consultar("SELECT id, nombre_proveedor FROM proveedor");

                                                                        while ($provc2 = mysqli_fetch_array($proveedoresc2)) {
                                                                            if ($provc2['id'] <> $prod['id_proveedor']) {
                                                                                echo '<option value="' . $provc2['id'] . '">' . $provc2['nombre_proveedor'] . '</option>';
                                                                            } else {
                                                                                echo '<option selected="selected" value="' . $provc2['id'] . '">' . $provc2['nombre_proveedor'] . '</option>';
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </td>
                                                                <td><input class="form-control" type="text" name="descripcion_prod" value="<?php echo $prod['descripcion_prod'] ?>"></td>
                                                                <td class="text-center">
                                                                    <button type="submit" class="btn btn-sm btn-primary button-UPR" value="update-product-<?php echo $upr ?>">Actualizar</button>                                                    
                                                                    <div id="update-product-<?php echo $upr ?>" style="width: 100%; padding:0px;"></div>
                                                                </td>
                                                                <td><input type="text" name="funcion" style="display: none" value="actualizarProducto"></td>                                                                                                                
                                                            </tr>
                                                        </form>
                                                    </div>
                                                    <?php
                                                    $upr = $upr + 1;
                                                }
                                            } else {
                                                ?>
                                                <h4>No existen productos registrados</h4>
                                                <?php
                                            }
                                            ?>
                                            </tbody >
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--==============================Panel Proveedores===============================-->
                    <div role="tabpanel" class="tab-pane fade" id="Proveedores">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <br><br>
                                <div id="add-provee">
                                    <h2 class="text-info text-center"><small><i class="fa fa-plus"></i></small>&nbsp;&nbsp;Agregar un proveedor</h2>
                                    <form action="DAO/proveedorDAO.php" method="post" role="form">
                                        <div class="form-group">
                                            <label>NIT</label>
                                            <input class="form-control" type="text" name="prove-nit" placeholder="NIT proveedor" maxlength="30" required="">
                                        </div >
                                        <div class="form-group">
                                            <label>Nombre</label>
                                            <input class="form-control" type="text" name="prove-name" placeholder="Nombre proveedor" maxlength="30" required="">
                                        </div>
                                        <div class="form-group">
                                            <label>Dirección</label>
                                            <input class="form-control" type="text" name="prove-dir" placeholder="Dirección proveedor" >
                                        </div>
                                        <div class="form-group">
                                            <label>Teléfono</label>
                                            <input class="form-control" type="tel" name="prove-tel" placeholder="Número telefónico" pattern="[0-9] {
                                                   1, 20
                                                   }" maxlength="20" required="">
                                        </div>
                                        <div class="form-group">
                                            <label>Página web o Email</label>
                                            <input class="form-control" type="text" name="prove-web" placeholder="Página web proveedor" >
                                        </div>
                                        <p class="text-center"><button type="submit" class="btn btn-primary">Añadir proveedor</button></p>
                                        <br>
                                        <input type="text" name="funcion" style="display: none" value="crearProveedor">
                                        <div id="res-form-add-prove" style="width: 100%;
                                             text-align: center;
                                             margin: 0;
                                             "></div>
                                    </form>
                                </div>
                            </div>                            
                            <div class="col-xs-12">
                                <br><br>
                                <div class="panel panel-info">
                                    <div class="panel-heading text-center"><h3>Proveedores Registrados <small class="tittles-pages-logo"><?php echo EMPRESA . " " . NEMPRESA; ?></small></h3><input class="form-control" id="myInput" type="text" placeholder="Buscar un valor en la tabla"></div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="tabla">
                                            <thead class="">
                                                <tr>
                                                    <th class="text-center">NIT</th>
                                                    <th class="text-center">Nombre</th>
                                                    <th class="text-center">Dirección</th>
                                                    <th class="text-center">Telefono</th>
                                                    <th class="text-center">Página web</th>
                                                    <th class="text-center">Opciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $proveedores = ejecutarSQL::consultar("select * from proveedor");

                                                $up = 1;

                                                while ($prov = mysqli_fetch_array($proveedores)) {
                                                    echo '
                                                      <div id="update-proveedor">
                                                        <form method="post" action="DAO/proveedorDAO.php" id="res-update-prove-' . $up . '">
                                                          <tr>
                                                              <td>
                                                              <label style="display: none;
                                                                ">' . $prov['nombre_proveedor'] . '</label>
                                                              <input class="form-control" type="hidden" name="id" required="" value="' . $prov['id'] . '">
                                                              <input class="form-control" type="text" name="nit" maxlength="30" required="" value="' . $prov['nit'] . '">
                                                              </td>
                                                              <td><input class="form-control" type="text" name="nombre_proveedor" maxlength="30" required="" value="' . $prov['nombre_proveedor'] . '"></td>
                                                              <td><input class="form-control" type="text-area" name="direccion_proveedor" required="" value="' . $prov['direccion_proveedor'] . '"></td>
                                                              <td><input class="form-control" type="tel" name="telefono_proveedor" required="" maxlength="20" value="' . $prov['telefono_proveedor'] . '"></td>
                                                              <td><input class="form-control" type="text-area" name="pagina_web" maxlength="30" required="" value="' . $prov['pagina_web'] . '"></td>
                                                              <td class="text-center">
                                                                  <input type="text" name="funcion" style="display: none" value="actualizarProveedor">
                                                                  <button type="submit" class="btn btn-sm btn-primary button-UP" value="res-update-prove-' . $up . '">Actualizar</button>
                                                                  <div id="res-update-prove-' . $up . '" style="width: 100%;
                                                                margin:0px;
                                                                padding:0px;
                                                                "></div>
                                                              </td>
                                                          </tr>
                                                        </form>
                                                      </div>
                                                      ';
                                                    $up = $up + 1;
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--==============================Panel Categorias===============================-->

                    <div role="tabpanel" class="tab-pane fade" id="Categorias">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <br><br>
                                <div id="add-categori">
                                    <h2 class="text-info text-center"><small><i class="fa fa-plus"></i></small>&nbsp;&nbsp;Agregar categoría</h2>
                                    <form action="DAO/categoriaDAO.php" method="post" role="form">
                                        <div class="form-group">
                                            <label>Código</label>
                                            <input class="form-control" type="text" name="categ-code" placeholder="Código de categoria" maxlength="9" required="">
                                        </div>
                                        <div class="form-group">
                                            <label>Nombre</label>
                                            <input class="form-control" type="text" name="categ-name" placeholder="Nombre de categoria" maxlength="30" required="">
                                        </div>
                                        <div class="form-group">
                                            <label>Descripción</label>
                                            <input class="form-control" type="text" name="categ-descrip" placeholder="Descripcióne de categoria" required="">
                                        </div>
                                        <p class="text-center"><button type="submit" class="btn btn-primary">Agregar categoría</button></p>
                                        <br>
                                        <input type="text" name="funcion" style="display: none" value="crearCategoria">
                                        <div id="res-form-add-categori" style="width: 100%;
                                             text-align: center;
                                             margin: 0;
                                             "></div>
                                    </form>
                                </div>
                            </div>                            
                            <div class="col-xs-12">
                                <br><br>
                                <div class="panel panel-info">
                                    <div class="panel-heading text-center"><h3>Categorias Registradas <small class="tittles-pages-logo"><?php echo EMPRESA . " " . NEMPRESA; ?></small></h3><input class="form-control" id="myInput2" type="text" placeholder="Buscar un valor en la tabla"></div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="tabla2">
                                            <thead class="">
                                                <tr>
                                                    <th class="text-center">Código</th>
                                                    <th class="text-center">Nombre</th>
                                                    <th class="text-center">Descripción</th>
                                                    <th class="text-center">Opciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $categorias = ejecutarSQL::consultar("select * from categoria");
                                                $ui = 1;
                                                while ($cate = mysqli_fetch_array($categorias)) {
                                                    echo '
                                                      <div id="update-category">
                                                        <form method="post" action="DAO/categoriaDAO.php" id="res-update-category-' . $ui . '">
                                                          <tr>
                                                              <td>
                                                              <label style="display: none;
                                                                ">' . $cate['nombre'] . '</label>
                                                                <input class="form-control" type="hidden" name="id" maxlength="9" required="" value="' . $cate['id'] . '">
                                                                <input class="form-control" type="text" name="codigo_categoria" maxlength="9" required="" value="' . $cate['codigo_categoria'] . '">
                                                              </td>
                                                              <td><input class="form-control" type="text" name="nombre" maxlength="30" required="" value="' . $cate['nombre'] . '"></td>
                                                              <td><input class="form-control" type="text-area" name="descripcion" required="" value="' . $cate['descripcion'] . '"></td>
                                                              <td class="text-center">
                                                                  <input type="text" name="funcion" style="display: none" value="actualizarCategoria">
                                                                  <button type="submit" class="btn btn-sm btn-primary button-UC" value="res-update-category-' . $ui . '">Actualizar</button>
                                                                  <div id="res-update-category-' . $ui . '" style="width: 100%;
                                                                margin:0px;
                                                                padding:0px;
                                                                "></div>
                                                              </td>
                                                          </tr>
                                                        </form>
                                                      </div>
                                                      ';
                                                    $ui = $ui + 1;
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--==============================Panel Usuario===============================-->
                    <div role="tabpanel" class="tab-pane fade" id="Usuarios">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <br><br>
                                <div id="add-admin">
                                    <h2 class="text-info text-center"><small><i class="fa fa-plus"></i></small>&nbsp;&nbsp;Agregar Usuarios</h2>
                                    <form action="DAO/usuarioDAO.php" method="post" role="form">
                                        <div class="form-group">
                                            <label>Nombre Completo</label>
                                            <input class="form-control" type="text" name="nombre_completo" placeholder="Nombre Completo" maxlength="50" required="">
                                        </div>
                                        <div class="form-group">
                                            <label>Nombre Usuario</label>
                                            <input class="form-control" type="text" name="Nombre" placeholder="Nombre" maxlength="20" pattern="[a-zA-Z] {
                                                   5, 20
                                                   }" required="">
                                        </div>
                                        <div class="form-group">
                                            <label>Contraseña</label>
                                            <input class="form-control" type="password" name="Clave" placeholder="Contraseña" required="">
                                        </div>
                                        <div class="form-group">
                                            <label>Tipo Usuario</label>
                                            <select class="form-control" name="tipo">
                                                <option value="Administrador">Administrador</option>
                                                <option value="Vendedor">Vendedor</option>
                                            </select>
                                        </div>
                                        <p class="text-center"><button type="submit" class="btn btn-primary">Agregar Usuario</button></p>
                                        <br>
                                        <input type="text" name="funcion" style="display: none" value="crearUsuario">
                                        <div id="res-form-add-admin" style="width: 100%;
                                             text-align: center;
                                             margin: 0;
                                             "></div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <br><br>
                                <div id="del-admin">
                                    <h2 class="text-danger text-center"><small><i class="fa fa-user-md"></i></small>&nbsp;&nbsp;Cambiar Estado Usuario</h2>
                                    <form action="process/cambiar_estado_admin.php" method="post" role="form">
                                        <div class="form-group">
                                            <label>Administradores</label>
                                            <select class="form-control" name="id">
                                                <?php
                                                $adminCon = ejecutarSQL::consultar("SELECT * FROM usuarios");

                                                while ($AdminD = mysqli_fetch_array($adminCon)) {
                                                    echo '<option value="' . $AdminD['id'] . '">' . $AdminD['Nombre'] . " / " . $AdminD['nombre_completo'] . " - " . $AdminD['estado'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <p class="text-center"><button type="submit" class="btn btn-danger">Cambiar Estado Usuario</button></p>
                                        <br>
                                        <input type="text" name="funcion" style="display: none" value="changeUsuario">
                                        <div id="res-form-del-admin" style="width: 100%;
                                             text-align: center;
                                             margin: 0;
                                             "></div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <br><br>
                                <div class = "panel panel-info">
                                    <div class = "panel-heading text-center"><h3>Usuarios Registrados <small class="tittles-pages-logo"><?php echo EMPRESA . " " . NEMPRESA; ?></small></h3></div>
                                    <div class = "table-responsive">
                                        <table class = "table table-bordered" >
                                            <thead class = "">
                                                <tr>
                                                    <th class = "text-center">#</th>
                                                    <th class = "text-center">Cédula o Nit</th>
                                                    <th class = "text-center">Nombre Completo</th>
                                                    <th class = "text-center">Estado</th>
                                                    <th class = "text-center">Tipo de Usuario</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $vendedor = ejecutarSQL::consultar("SELECT * FROM usuarios ORDER BY nombre_completo");
                                                $cantVendedor = 0;
                                                $upp = 1;
                                                while ($vendedorRow = mysqli_fetch_array($vendedor)) {
                                                    $cantVendedor = $cantVendedor + 1;
                                                    ?>
                                                <div id="listar_vendededores">
                                                    <tr style="text-align: center">
                                                        <td><?php echo $cantVendedor ?><input class="form-control" type="hidden" name="id" required="" value="<?php echo $repartidorRow['id'] ?>"></td>                                                    
                                                        <td><?php echo $vendedorRow['nombre_completo'] ?></td>
                                                        <td><?php echo $vendedorRow['Nombre'] ?></td>
                                                        <td><?php echo $vendedorRow['estado'] ?></td>
                                                        <td><?php echo $vendedorRow['tipo'] ?></td>
                                                    </tr>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12"></div>
                        </div>
                    </div>
                    <!--==============================Panel Domiciliarios===============================-->

                    <div role="tabpanel" class="tab-pane fade" id="Domiciliarios">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <br><br>
                                <div id="add-repartidor">
                                    <h2 class="text-info text-center"><small><i class="fa fa-plus"></i></small>&nbsp;&nbsp;Agregar Domiciliario</h2>
                                    <form action="DAO/domiciliarioDAO.php" method="post" role="form" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Cédula</label>
                                            <input class="form-control" type="number" name="cedula_repartidor" placeholder="Cédula o No. de Documento del Domiciliario" maxlength="50" required="" title="Cédula o No. de Documento del domiciliario">
                                        </div>
                                        <div class="form-group">
                                            <label>Nombre Completo</label>
                                            <input class="form-control" type="text" name="nombre_repartidor" placeholder="Nombre completo del domiciliario" required="" title="Nombre completo del domiciliario">
                                        </div>
                                        <div class="form-group">
                                            <label>Foto del repartidor</label>
                                            <input type="file" name="foto_repartidor">
                                            <p class="help-block">Formato de imagenes admitido png, jpg, gif, jpeg</p>
                                        </div>
                                        <p class="text-center"><button type="submit" class="btn btn-primary">Agregar Domiciliario</button></p>
                                        <br>
                                        <input type="text" name="funcion" style="display: none" value="crearDomiciliario">
                                        <div id="res-form-add-rep" style="width: 100%; text-align: center; margin: 0;"></div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <br><br>
                                <div id="change_repartidor">
                                    <h2 class="text-danger text-center"><small><i class="fa fa-user-md"></i></small>&nbsp;&nbsp;Activar/Inactivar Domiciliario</h2>
                                    <form action="DAO/domiciliarioDAO.php" method="post" role="form">
                                        <div class="form-group">
                                            <label>Domiciliarios</label>
                                            <select class="form-control" name="id" style="width: 100%" id="cambiarEstadoRepartidor" >
                                                <?php
                                                $repCon = ejecutarSQL::consultar("SELECT * FROM domiciliario");
                                                while ($repIna = mysqli_fetch_array($repCon)) {
                                                    echo '<option value="' . $repIna['id'] . '">' . $repIna['nombre_repartidor'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <p class="text-center"><button type="submit" class="btn btn-danger">Cambiar Estado</button></p>
                                        <br>
                                        <input type="text" name="funcion" style="display: none" value="changeDomiciliario">
                                        <div id="res-form-change-rep" style="width: 100%; text-align: center; margin: 0;"></div>
                                    </form>
                                </div>
                            </div>

                            <div class="col-xs-12">
                                <br><br>
                                <div class = "panel panel-info">
                                    <div class = "panel-heading text-center"><h3>Domiciliarios Registrados <small class="tittles-pages-logo"><?php echo EMPRESA . " " . NEMPRESA; ?></small></h3></div>
                                    <div class = "table-responsive">
                                        <table class = "table table-bordered" >
                                            <thead class = "">
                                                <tr>
                                                    <th class = "text-center">#</th>
                                                    <th class = "text-center">Cédula o Nit</th>
                                                    <th class = "text-center">Nombre Completo</th>
                                                    <th class = "text-center">Estado</th>
                                                    <th class = "text-center">Foto</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $repartidor = ejecutarSQL::consultar("SELECT * FROM domiciliario ORDER BY nombre_repartidor");
                                                $cantRep = 0;
                                                $upp = 1;
                                                while ($repartidorRow = mysqli_fetch_array($repartidor)) {
                                                    $cantRep = $cantRep + 1;
                                                    ?>
                                                <div id="restaurar_cliente">
                                                    <tr style="text-align: center">
                                                        <td><?php echo $cantRep ?><input class="form-control" type="hidden" name="id" required="" value="<?php echo $repartidorRow['id'] ?>"></td>                                                    
                                                        <td><?php echo $repartidorRow['cedula_repartidor'] ?></td>
                                                        <td><?php echo $repartidorRow['nombre_repartidor'] ?></td>
                                                        <td><?php echo $repartidorRow['estado_repartidor'] ?></td>
                                                        <td><img src="Recursos/img-repartidor/<?php echo $repartidorRow['foto_repartidor'] ?>" style="width: 40px"></td>
                                                    </tr>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>  

                    <!--==============================Panel Bodega===============================-->
                    <div role="tabpanel" class="tab-pane fade" id="Bodega">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <br><br>
                                <div id="add-bodega">
                                    <h2 class="text-info text-center"><small><i class="fa fa-plus"></i></small>&nbsp;&nbsp;Agregar Productos a Bodega</h2>
                                    <form action="DAO/bodegaDAO.php" method="post" role="form">
                                        <div class="form-group">
                                            <label>Producto</label>
                                            <select class="form-control" name="id_producto" style="width: 100%" id="productosBodega">
                                                <?php
                                                $sqlProdBod = ejecutarSQL::consultar("SELECT * FROM producto");
                                                while ($prodBod = mysqli_fetch_array($sqlProdBod)) {
                                                    echo '<option value="' . $prodBod['id'] . '">' . $prodBod['nombre_prod'] . " ($" . $prodBod['precio'] . ")" . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Cantidad en Bodega</label>
                                            <input class="form-control" type="number" min="1" name="cantidad" placeholder="Cantidad en bodega" required="">
                                        </div>
                                        <div class="form-group">
                                            <label>Cantidad Mínima</label>
                                            <input class="form-control" type="number" min="1" name="minimo" placeholder="Cantidad minima en bodega" required="">
                                        </div>
                                        <div class="form-group">
                                            <label>Precio Venta $</label>
                                            <input class="form-control" type="number" min="0" name="precio_venta" placeholder="Precio de Venta" required="">
                                        </div>
                                        <p class="text-center"><button type="submit" class="btn btn-primary">Agregar</button></p>
                                        <br>
                                        <input type="text" name="funcion" style="display: none" value="agregar_a_bodega">
                                        <div id="res-form-add-bodega" style="width: 100%; text-align: center; margin: 0;"></div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <br><br>
                                <div id="up-bodega">
                                    <h2 class="text-danger text-center"><small><i class="fa fa-user-md"></i></small>&nbsp;&nbsp;Actualizar Cantidad en bodega</h2>
                                    <form action="DAO/bodegaDAO.php" method="post" role="form">
                                        <div class="form-group">
                                            <label>Producto</label>
                                            <select class="form-control" style="width: 100%" name="idBodega" id="productosBodega2">
                                                <?php
                                                $sqlProdBod2 = ejecutarSQL::consultar("SELECT P.nombre_prod,B.id_producto,B.cantidad,B.id FROM producto P JOIN bodega B ON B.id_producto=P.id ORDER BY P.id");
                                                while ($prodBod2 = mysqli_fetch_array($sqlProdBod2)) {
                                                    echo '<option value="' . $prodBod2['id'] . '">' . $prodBod2['nombre_prod'] . '</option>';
                                                }
                                                ?>
                                                 
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Cantidad a agregar</label>
                                            <input class="form-control" type="number" min="1" name="cantidad" placeholder="Cantidad en bodega" required="">
                                            
                                        </div>
                                        <p class="text-center"><button type="submit" class="btn btn-danger">Agregar cantidad a bodega</button></p>
                                        <br>
                                        <input type="text" name="funcion" style="display: none" value="changeCantidadBodega">
                                        <div id="res-form-up-bodega" style="width: 100%; text-align: center; margin: 0;"></div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <br><br>
                                <div class = "panel panel-info">
                                    <div class = "panel-heading text-center"><h3>Productos en bodega <small class="tittles-pages-logo"><?php echo EMPRESA . " " . NEMPRESA; ?></small></h3></div>
                                    <div class = "table-responsive">
                                        <table class = "table table-bordered" >
                                            <thead class = "">
                                                <tr>
                                                    <th class = "text-center">#</th>
                                                    <th class = "text-center">Código Producto</th>
                                                    <th class = "text-center">Nombre Producto</th>
                                                    <th class = "text-center">Marca</th>
                                                    <th class = "text-center">Proveedor</th>
                                                    <th class = "text-center">Categoria</th>
                                                    <th class = "text-center">Cant Bodega</th>
                                                    <th class = "text-center">Cant Mínima</th>
                                                    <th class = "text-center">Precio Venta</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sqlProdBodega = ejecutarSQL::consultar("SELECT B.id_producto,P.nombre_prod,P.codigo_prod,P.marca,PRO.nombre_proveedor,C.nombre,"
                                                                . "B.cantidad,B.minimo,B.precio_venta,B.estado_prod_bodega,B.id FROM producto P JOIN proveedor PRO ON P.id_proveedor=PRO.id
                                                                 JOIN bodega B ON B.id_producto=P.id JOIN categoria C ON P.id_categoria=C.id ORDER BY nombre");
                                                $cantVendedor = 0;
                                                $contPB = 1;
                                                while ($prodBodega = mysqli_fetch_array($sqlProdBodega)) {
                                                    $color = "white";
                                                    if ($prodBodega['estado_prod_bodega'] == "Agotado") {
                                                        $color = "Rgb(255,0,0,0.4)";
                                                    }
                                                    ?>
                                                <div id="update-bodega">
                                                            <form method="post" action="DAO/bodegaDAO.php" id="update-bodega-<?php echo $contPB; ?>">
                                                            <tr style="background-color: <?php echo $color ?>">                                                            
                                                            <td> <input class="form-control" type="hidden" name="id" required="" value="<?php echo $prodBodega['id'] ?>">   </td>
                                                            <td><label><?php echo $prodBodega['codigo_prod'] ?></label></td>
                                                            <td><label><?php echo $prodBodega['nombre_prod'] ?></label></td> 
                                                            <td><label><?php echo $prodBodega['marca'] ?></label></td>
                                                            <td><label><?php echo $prodBodega['nombre_proveedor'] ?></label></td> 
                                                            <td><label><?php echo $prodBodega['nombre'] ?></label></td>
                                                            <td><label><?php echo $prodBodega['cantidad'] ?></label></td>
                                                            <td><input class="form-control" type="number" name="minimo" required="" value="<?php echo $prodBodega['minimo'] ?>"></td>
                                                            <td><input class="form-control" type="number" name="precio_venta" required="" value="<?php echo $prodBodega['precio_venta'] ?>"></td>
                                                            <td class="text-center">
                                                                <button type="submit" class="btn btn-sm btn-primary button-UPR" value="update-bodega-<?php echo $contPB ?>">Actualizar</button>                                                    
                                                                <div id="update-bodega-<?php echo $contPB ?>" style="width: 100%; margin:0px; padding:0px;"></div>
                                                            </td>
                                                            <td><input type="text" name="funcion" style="display: none" value="changeProductoBodega"></td>                                                                                                                
                                                        </tr>
                                                    </form>
                                                </div>
                                                <?php
                                                $contPB = $contPB + 1;
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12"></div>
                        </div>
                    </div>

                    <!--==============================General===============================-->

                    <div role="tabpanel" class="tab-pane fade  in active" id="General">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <br><br>
                                <!--GENERAL-->
                                <div class="thumbnail" style="width: 90%">
                                    <img style="max-width: 20%" src="Recursos/img/logo_eam.png">                                    
                                    <div class="caption center-all-contens" >
                                        <h3 style="text-align: center">PRODUCTOS</h3>   
                                        <?php
                                        $sqlProd = mysqli_fetch_row(ejecutarSQL::consultar("SELECT count(id) FROM producto"));
                                        $sqlProdD = mysqli_fetch_row(ejecutarSQL::consultar("SELECT count(id) FROM producto WHERE estado_prod='Disponible'"));
                                        $sqlProdN = mysqli_fetch_row(ejecutarSQL::consultar("SELECT count(id) FROM bodega WHERE estado_prod_bodega='Disponible'"));
                                        $sqlProdAg = mysqli_fetch_row(ejecutarSQL::consultar("SELECT count(id) FROM bodega WHERE estado_prod_bodega='Agotado'"));
                                        ?>
                                        <p><b>Productos Registrados:  </b><?php echo $sqlProd[0]; ?></p>                                        
                                        <p><b>Productos Registrados No Disponibles:  </b><?php echo $sqlProdN[0]; ?></p>    
                                        <p><b>Productos En Bodega Disponibles:  </b><?php echo $sqlProdN[0]; ?></p>       
                                        <p><b>Productos En Bodega Agotados:  </b><?php echo $sqlProdAg[0]; ?></p>
                                    </div>
                                    <div class="caption center-all-contens" >
                                        <h3 style="text-align: center">PROVEEDORES</h3>   
                                        <?php
                                        $sqlProv = mysqli_fetch_row(ejecutarSQL::consultar("SELECT count(id) FROM proveedor"));
                                        ?>
                                        <p><b>Cantidad Proveedores:  </b><?php echo $sqlProv[0]; ?></p>                                        
                                    </div>
                                    <div class="caption center-all-contens" >
                                        <h3 style="text-align: center">CATEGORIAS</h3>   
                                        <?php
                                        $sqlCatD = mysqli_fetch_row(ejecutarSQL::consultar("SELECT count(id) FROM categoria"));
                                        ?>
                                        <p><b>Cantidad Categorias:  </b><?php echo $sqlCatD[0]; ?></p>                                        
                                    </div>
                                    <div class="caption center-all-contens" >
                                        <h3 style="text-align: center">VENDEDORES</h3>   
                                        <?php
                                        $sqlCatnAdmin = mysqli_fetch_row(ejecutarSQL::consultar("SELECT count(id) FROM usuarios WHERE tipo='Vendedor'"));
                                        ?>
                                        <p><b>Cantidad Vendedores:  </b><?php echo $sqlCatnAdmin[0]; ?></p>                                        
                                    </div>                                        
                                    <div class="caption center-all-contens" >
                                        <h3 style="text-align: center">DOMICILIARIOS</h3>   
                                        <?php
                                        $sqlCatnAdmin = mysqli_fetch_row(ejecutarSQL::consultar("SELECT count(id) FROM domiciliario"));
                                        ?>
                                        <p><b>Cantidad Domiciliarios:  </b><?php echo $sqlCatnAdmin[0]; ?></p>                                        
                                    </div> 
                                </div>                                
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <br><br>
                                <div id="add-inf_empresa">
                                    <?php
                                    $sqlInf = "SELECT nit, representante_legal, telefonos, whatsapp, direccion, pagina_web, facebook, instagram, email FROM informacion_empresa WHERE id=1";
                                    $VecInf = mysqli_fetch_row(ejecutarSQL::consultar($sqlInf));
                                    ?>
                                    <h2 class="text-info text-center"><small><i class="fa fa-edit"></i></small>&nbsp;&nbsp;Actualizar Informacion </h2>
                                    <form action="DAO/informacion_empresa.php" method="post" role="form">
                                        <div class="form-group">
                                            <label>Nit</label>
                                            <input class="form-control" type="text" name="nit"  value="<?php echo $VecInf[0]; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Representante Legal</label>
                                            <input class="form-control" type="text" name="representante_legal"   value="<?php echo $VecInf[1]; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Telefonos</label>
                                            <input class="form-control" type="text" name="telefonos"   value="<?php echo $VecInf[2]; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Whastapp principal</label>
                                            <input class="form-control" type="text" name="whatsapp"  required="" value="<?php echo $VecInf[3]; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Direccion</label>
                                            <input class="form-control" type="text" name="direccion"  required="" value="<?php echo $VecInf[4]; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input class="form-control" type="email" name="email"   value="<?php echo $VecInf[8]; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Pagina Web</label>
                                            <input class="form-control" type="text" name="pagina_web"   value="<?php echo $VecInf[5]; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Facebook</label>
                                            <input class="form-control" type="text" name="facebook"   value="<?php echo $VecInf[6]; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Instagram</label>
                                            <input class="form-control" type="text" name="instagram"   value="<?php echo $VecInf[7]; ?>">
                                        </div>
                                        <p class="text-center"><button type="submit" class="btn btn-primary">Actualizar</button></p>
                                        <br>
                                        <div id="res-form-update_inf" style="width: 100%; text-align: center; margin: 0;"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
        </section>
        <?php include './inc/footer.php'; ?>
        <script>
            //Productos
            $(document).ready(function () {
                $('#cambiarEstadoProducto').select2();
            });
            $(document).ready(function () {
                $('#cambiarAgotadoProducto').select2();
            });
            //Domiciliarios
            $(document).ready(function () {
                $('#cambiarEstadoRepartidor').select2();
            });
            //Bodega
            $(document).ready(function () {
                $('#productosBodega').select2();
            });
            $(document).ready(function () {
                $('#productosBodega2').select2();
            });

            $(document).ready(function () {
                $("#myInput").on("keyup", function () {
                    var value = $(this).val().toLowerCase();
                    $("#tabla tr").filter(function () {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });
            });
            $(document).ready(function () {
                $("#myInput2").on("keyup", function () {
                    var value = $(this).val().toLowerCase();
                    $("#tabla2 tr").filter(function () {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });
            });
            $(document).ready(function () {
                $("#myInput3").on("keyup", function () {
                    var value = $(this).val().toLowerCase();
                    $("#tabla3 tr").filter(function () {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });
            });
            $(document).ready(function () {
                $("#myInput4").on("keyup", function () {
                    var value = $(this).val().toLowerCase();
                    $("#tabla4 tr").filter(function () {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });
            });
        </script>
    </body>
</html>
