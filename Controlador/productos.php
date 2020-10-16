<?php

require '../Modelo/clsProducto.php';
require '../DAO/productoDAO.php';

isset($_POST['id']) ? $id = $_POST['id'] : $id = "";
isset($_POST['codigo_prod']) ? $codigo_prod = $_POST['codigo_prod'] : $codigo_prod = "";
isset($_POST['nombre_prod']) ? $nombre_prod = $_POST['nombre_prod'] : $nombre_prod = "";
isset($_POST['nombreAcudiente']) ? $nombreAcudiente = $_POST['nombreAcudiente'] : $nombreAcudiente = "";
isset($_POST['parentezcoAcudiente']) ? $parentezcoAcudiente = $_POST['parentezcoAcudiente'] : $parentezcoAcudiente = "";
isset($_POST['telefonoAcudiente']) ? $telefonoAcudiente = $_POST['telefonoAcudiente'] : $telefonoAcudiente = "";
isset($_POST['generoAcudiente']) ? $generoAcudiente = $_POST['generoAcudiente'] : $generoAcudiente = "";
isset($_POST['nacionalidadAcudiente']) ? $nacionalidadAcudiente = $_POST['nacionalidadAcudiente'] : $nacionalidadAcudiente = "";
isset($_POST['id_beneficiario']) ? $id_beneficiario = $_POST['id_beneficiario'] : $id_beneficiario = "";
isset($_POST['fec_nac']) ? $fec_nac = $_POST['fec_nac'] : $fec_nac = "";
isset($_POST['direccion_acudiente']) ? $direccion_acudiente = $_POST['direccion_acudiente'] : $direccion_acudiente = "";
isset($_POST['pagina']) ? $pagina = $_POST['pagina'] : $pagina = "";
isset($_POST['uds']) ? $uds = $_POST['uds'] : $uds = "";
isset($_POST['typeAcudiente']) ? $accion = $_POST['typeAcudiente'] : $accion = "";

$acudiente = new clsAcudiente($id, $tipoDocAc, $docAcudiente, $nombreAcudiente, $parentezcoAcudiente, $telefonoAcudiente, $generoAcudiente, $nacionalidadAcudiente, $id_beneficiario, $fec_nac, $direccion_acudiente, $pagina, $uds);

$dao = new acudienteDAO(); 

switch ($accion) {

    case "save":
        $dao->crear($acudiente);
        break;   

    case "update":
        $dao->editar($acudiente);
        break;      

    case "enviarEditar":
        $dao->enviarEditar($acudiente);
        break;

    case "delete":
        $dao->eliminar($acudiente);
        break;

    case "validarDocumento":
        $dao->validarDocumento($acudiente);
        break;
   
}
?>

