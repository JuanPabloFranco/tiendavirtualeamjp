<?php
include '../library/consulSQL.php';

function monto($table, $mes, $periodo) {
    global $con;
    $fecha_inicial = "$periodo-$mes-1";
    if ($mes == 1 or $mes == 3 or $mes == 5 or $mes == 7 or $mes == 8 or $mes == 10 or $mes == 12) {
        $dia_fin = 31;
    } else if ($mes == 2) {
        if ($periodo % 4 == 0) {
            $dia_fin = 29;
        } else {
            $dia_fin = 28;
        }
    } else {
        $dia_fin = 30;
    }
    $fecha_final = "$periodo-$mes-$dia_fin";

    $query = ejecutarSQL::consultar("select count(id) as cantidad FROM $table WHERE estado_venta='Entregado' AND (fecha between '$fecha_inicial' and '$fecha_final')");
    $row = mysqli_fetch_array($query);
    $monto = floatval($row['cantidad']);
    return $monto;
}

?>
