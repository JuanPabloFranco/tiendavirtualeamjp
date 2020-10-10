<?php

$action = (isset($_REQUEST['action']) && $_REQUEST['action'] != NULL) ? $_REQUEST['action'] : '';
$id = (isset($_REQUEST['id']) && $_REQUEST['id'] != NULL) ? $_REQUEST['id'] : '';
if ($action == 'ajax') {
    session_start();
    include '../../Conexion/consulSQL.php';
    $id = intval($_REQUEST['id']);
    consultasSQL::DeleteSQL("pedido_tmp", "id=$id");
}