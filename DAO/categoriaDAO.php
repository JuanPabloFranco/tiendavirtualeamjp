<?php
session_start();
include '../Conexion/consulSQL.php';
sleep(1);

if ($_POST['funcion'] <> "") { // Verificar si la variable con el tipo de proceso es diferente de vacio
    // Se verifica el valor de la variable POST, cuando es igual al deseado realiza el proceso correspondiente
    if ($_POST['funcion'] == "crearCategoria") {
        // Se obtienen los datos del formulario html por variables POST
        $codeCateg = $_POST['categ-code'];
        $nameCateg = $_POST['categ-name'];
        $descripCateg = $_POST['categ-descrip'];
        //Se verifica que las variables a guardar no esten vacias
        if (!$codeCateg == "" && !$nameCateg == "" && !$descripCateg == "") {
            //Se verifica si ya existe una categoria con el codigo ingresado
            $verificar = ejecutarSQL::consultar("SELECT * FROM categoria WHERE codigo_categoria='" . $codeCateg . "'");
            $verificaltotal = mysqli_num_rows($verificar);

            if ($verificaltotal <= 0) {
                //Se realiza la consulta de registro de categoria
                if (consultasSQL::InsertSQL("categoria", "codigo_categoria, Nombre, Descripcion", "'$codeCateg','$nameCateg','$descripCateg'")) {
?>
                    <img src="Recursos/img/correcto.png" class="center-all-contens"><br>
                    <p class="lead text-center">Categoría añadida éxitosamente</p>
                    <script>
                        limpiarCamposRegCategoria();
                        $(document).ready(function() {
                            $('#tablaCategoriasFull').load("Recursos/includes/tablaCategorias.php");
                        });
                    </script>
                <?php
                } else {
                    echo '<img src="Recursos/img/incorrecto.png" class="center-all-contens"><br><p class="lead text-center">Ha ocurrido un error.<br>Por favor intente nuevamente</p>';
                }
            } else {
                ?>
                <img src="Recursos/img/incorrecto.png" class="center-all-contens"><br>
                <p class="lead text-center">El código que ha ingresado ya existe.<br>Por favor ingrese otro código</p>
                
            <?php
            }
        } else {
            echo '<img src="Recursos/img/incorrecto.png" class="center-all-contens"><br><p class="lead text-center">Error los campos no deben de estar vacíos</p>';
        }
    }

    if ($_POST['funcion'] == "actualizarCategoria") { // Funcion para actualizar datos de la categoria
        // Se obtienen los datos del formulario html por variables POST
        $id = $_POST['id'];
        $codigo_categoria = $_POST['codigo_categoria'];
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        //Se actualiza la categoria en base de datos
        if (consultasSQL::UpdateSQL("categoria", "codigo_categoria='$codigo_categoria',nombre='$nombre',descripcion='$descripcion'", "id=$id")) {
            ?>
            <br>
            <img class="center-all-contens" style="width: 20%" src="Recursos/img/Check.png">
            <p><strong>Actualizado</strong></p>
            <p class="text-center">
            <?php
        } else {
            ?>
                <br>
                <img class="center-all-contens" style="width: 20%" src="Recursos/img/cancel.png">
                <p><strong>Error</strong></p>
                <p class="text-center">
        <?php
        }
    }
} else {
    echo '<img src="recursos/img/incorrecto.png" class="center-all-contens"><br><p class="lead text-center">Error al leer de función ejecutada</p>';
}
