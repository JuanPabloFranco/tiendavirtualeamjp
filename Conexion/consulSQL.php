<?php

/* Clase para ejecutar las consultas a la Base de Datos */

class ejecutarSQL {
    // Conexion a la BD
    public static function conectar() {
        include 'configServer.php'; // Incluye las variables estaticas con los valores de la bd
        if (!$con = mysqli_connect(HOST, USER, PASS, BD)) {
            die(mysqli_error(ejecutarSQL::conectar()) . "Error en el servidor, verifique sus datos");
        }
        mysqli_set_charset($con, 'utf8');
        return $con;
    }

    public static function consultar($query) { // Funcion para ejecutar una consulta
        if (!$consul = mysqli_query(ejecutarSQL::conectar(), $query)) {
            die(mysqli_error(ejecutarSQL::conectar()) . 'Error en la consulta SQL ejecutada ' . $query);
        }
        return $consul;
    }

}

/* Clase para hacer las consultas Insertar, Eliminar y Actualizar */

class consultasSQL {

    public static function InsertSQL($tabla, $campos, $valores) {
        if (!$consul = ejecutarSQL::consultar("insert into $tabla ($campos) VALUES($valores)")) {
            die("Ha ocurrido un error al insertar los datos en la tabla $tabla");
        }
        return $consul;
    }

    public static function DeleteSQL($tabla, $condicion) {
        if (!$consul = ejecutarSQL::consultar("DELETE FROM $tabla WHERE $condicion")) {
            die("Ha ocurrido un error al eliminar los registros en la tabla $tabla");
        }
        return $consul;
    }

    public static function UpdateSQL($tabla, $campos, $condicion) {
        if (!$consul = ejecutarSQL::consultar("UPDATE $tabla SET $campos WHERE $condicion")) {
            die("Ha ocurrido un error al actualizar los datos en la tabla $tabla");
        }
        return $consul;
    }

}
